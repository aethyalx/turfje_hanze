<?php
/**
 * Eenvoudige PHP WebSocket-achtige server + client met AES-256 encryptie.
 * LET OP: Dit is een demo; geen productieklare beveiliging of echte WebSocket-protocol.
 */

/**
 * ────────────────────────────────────────────────
 * SERVER KLASSE
 * ────────────────────────────────────────────────
 */
class RSAServer
{
    private string $address;
    private int $port;
    private string $usersFile;
    private string $serverKeyFile;
    private string $serverPublicKey;
    private string $serverPrivateKey;

    public function __construct(string $address = '127.0.0.1', int $port = 8080)
    {
        $this->address = $address;
        $this->port = $port;
        $this->usersFile = __DIR__ . '/users.json';
        $this->serverKeyFile = __DIR__ . '/server_keys.json';

        $this->initServerKeys();
    }

    private function initServerKeys(): void
    {
        if (!file_exists($this->serverKeyFile)) {
            echo "Geen server keys gevonden, nieuwe genereren...\n";
            $config = [
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA
            ];
            $res = openssl_pkey_new($config);
            openssl_pkey_export($res, $privKey);
            $pubKey = openssl_pkey_get_details($res)['key'];
            file_put_contents($this->serverKeyFile, json_encode([
                'public_key' => $pubKey,
                'private_key' => $privKey
            ], JSON_PRETTY_PRINT));
        }

        $keys = json_decode(file_get_contents($this->serverKeyFile), true);
        $this->serverPublicKey = $keys['public_key'];
        $this->serverPrivateKey = $keys['private_key'];

        echo "Server keys geladen.\n";
    }

    public function start(): void
    {
        if (!file_exists($this->usersFile)) file_put_contents($this->usersFile, '{}');

        $server = stream_socket_server("tcp://{$this->address}:{$this->port}", $errno, $errstr);
        if (!$server) die("Kan server niet starten: $errstr ($errno)\n");

        echo "Server gestart op {$this->address}:{$this->port}\n";

        while ($conn = @stream_socket_accept($server, -1)) {
            $this->handleConnection($conn);
        }

        fclose($server);
    }

    private function handleConnection($conn): void
    {
        $data = fread($conn, 8192);
        if (!$data) return;

        $input = json_decode($data, true);
        $email = $input['email'] ?? null;
        $pubKey = $input['public_key'] ?? null;
        $signature = $input['signature'] ?? null;

        if (!$email || !$pubKey) {
            fwrite($conn, json_encode(['error' => 'Ongeldige gegevens']));
            fclose($conn);
            return;
        }

        // Verify client signature if provided
        if ($signature) {
            $dataToVerify = $email . $pubKey;
            if (!$this->verifySignature($dataToVerify, $signature, $pubKey)) {
                fwrite($conn, json_encode(['error' => 'Ongeldige digitale handtekening']));
                fclose($conn);
                return;
            }
            echo "Digitale handtekening geverifieerd voor $email\n";
        }

        $users = json_decode(file_get_contents($this->usersFile), true);

        // Haal dokter public key op
        $doctorKey = $users['dokter@test.nl']['public_key'] ?? null;

        // Bericht genereren
        $message = "Dit was de encrypted data van gebruiker $email. Hier staan meerdere zinnen die je eerst niet kon lezen.";

        // Encrypt voor gebruiker
        $pubResUser = openssl_pkey_get_public($pubKey);
        openssl_public_encrypt($message, $encUser, $pubResUser, OPENSSL_PKCS1_OAEP_PADDING);

        // Encrypt voor dokter (indien beschikbaar)
        $encDoctor = null;
        if ($doctorKey) {
            $pubResDoctor = openssl_pkey_get_public($doctorKey);
            openssl_public_encrypt($message, $encDoctor, $pubResDoctor, OPENSSL_PKCS1_OAEP_PADDING);
        }

        // Update user records
        $users[$email] = [
            'public_key' => $pubKey,
            'encrypted_for_user' => base64_encode($encUser)
        ];

        if ($encDoctor) {
            $users[$email]['encrypted_for_doctor'] = base64_encode($encDoctor);
        }

        file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));

        // Create server signature for the response
        $responseData = json_encode([
            'server_public_key' => $this->serverPublicKey,
            'message' => base64_encode($encUser)
        ]);
        $serverSignature = $this->createSignature($responseData);

        // Verstuur response terug met digitale handtekening
        fwrite($conn, json_encode([
            'server_public_key' => $this->serverPublicKey,
            'message' => base64_encode($encUser),
            'signature' => $serverSignature
        ]));

        echo "Gebruiker $email verwerkt.\n";
        fclose($conn);
    }

    /**
     * Creëer een digitale handtekening voor de gegeven data
     */
    private function createSignature(string $data): string
    {
        $privRes = openssl_pkey_get_private($this->serverPrivateKey);
        openssl_sign($data, $signature, $privRes, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }

    /**
     * Verifieer een digitale handtekening
     */
    private function verifySignature(string $data, string $signature, string $publicKey): bool
    {
        $pubRes = openssl_pkey_get_public($publicKey);
        $signatureData = base64_decode($signature);
        return openssl_verify($data, $signatureData, $pubRes, OPENSSL_ALGO_SHA256) === 1;
    }
}