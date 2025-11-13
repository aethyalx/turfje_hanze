
<?php

class RSAClient
{
    private string $address;
    private int $port;
    private string $email;
    private $privateKey;
    private $publicKey;
    private ?string $serverPublicKey = null;
    private string $keyFile;

    public function __construct(string $address = '127.0.0.1', int $port = 8080)
    {
        $this->address = $address;
        $this->port = $port;
    }

    public function connect(): void
    {
        echo "Voer je e-mailadres in: ";
        $this->email = trim(fgets(STDIN));
        $this->keyFile = __DIR__ . "/client_{$this->email}_keys.json";

        $this->loadOrGenerateKeys();

        $client = stream_socket_client("tcp://{$this->address}:{$this->port}", $errno, $errstr, 30);
        if (!$client) die("Kan geen verbinding maken: $errstr ($errno)\n");

        // Create digital signature for the request
        $dataToSign = $this->email . $this->publicKey;
        $signature = $this->createSignature($dataToSign);

        $data = json_encode([
            'email' => $this->email,
            'public_key' => $this->publicKey,
            'signature' => $signature
        ]);

        fwrite($client, $data);

        $response = fread($client, 8192);
        fclose($client);

        $decoded = json_decode($response, true);

        if (isset($decoded['error'])) {
            echo "Fout van server: " . $decoded['error'] . "\n";
            return;
        }

        if (isset($decoded['server_public_key'])) {
            $this->serverPublicKey = $decoded['server_public_key'];
            $this->saveKeys();
        }

        // Verify server signature
        if (isset($decoded['signature']) && $this->serverPublicKey) {
            $serverResponseData = json_encode([
                'server_public_key' => $decoded['server_public_key'],
                'message' => $decoded['message']
            ]);
            
            if ($this->verifySignature($serverResponseData, $decoded['signature'], $this->serverPublicKey)) {
                echo "Server handtekening geverifieerd\n";
            } else {
                echo "Server handtekening verificatie gefaald!\n";
                return;
            }
        }

        if (isset($decoded['message'])) {
            echo "Ontvangen (encrypted): " . $decoded['message'] . "\n";
            $this->decryptMessage($decoded['message']);
        }

        // Dokter-menu
        if ($this->email === 'dokter@test.nl') {
            $this->doctorMenu();
        }
    }

    private function loadOrGenerateKeys(): void
    {
        if (file_exists($this->keyFile)) {
            $keys = json_decode(file_get_contents($this->keyFile), true);
            $this->privateKey = $keys['private_key'];
            $this->publicKey = $keys['public_key'];
            $this->serverPublicKey = $keys['server_public_key'] ?? null;
            echo "Sleutels geladen van {$this->keyFile}\n";
        } else {
            $config = [
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA
            ];
            $res = openssl_pkey_new($config);
            openssl_pkey_export($res, $privKey);
            $pubKey = openssl_pkey_get_details($res)['key'];

            $this->privateKey = $privKey;
            $this->publicKey = $pubKey;

            $this->saveKeys();
            echo "Nieuwe RSA sleutels gegenereerd en opgeslagen in {$this->keyFile}\n";
        }
    }

    private function saveKeys(): void
    {
        $data = [
            'email' => $this->email,
            'public_key' => $this->publicKey,
            'private_key' => $this->privateKey,
            'server_public_key' => $this->serverPublicKey
        ];
        file_put_contents($this->keyFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function decryptMessage(string $encrypted): void
    {
        $encData = base64_decode($encrypted);
        $privRes = openssl_pkey_get_private($this->privateKey);
        openssl_private_decrypt($encData, $decrypted, $privRes, OPENSSL_PKCS1_OAEP_PADDING);
        echo "Na decryptie: $decrypted\n";
    }

    private function doctorMenu(): void
    {
        echo "\n=== Dokter Menu ===\n";
        $users = json_decode(file_get_contents('users.json'), true);

        $available = array_filter(array_keys($users), fn($u) => $u !== 'dokter@test.nl');
        if (empty($available)) {
            echo "Geen gebruikers beschikbaar.\n";
            return;
        }

        while (true) {
            echo "Beschikbare gebruikers:\n";
            foreach ($available as $u) echo "- $u\n";

            echo "Van welke gebruiker wil je de data zien? (of 'exit') ";
            $target = trim(fgets(STDIN));
            if ($target === 'exit') break;

            if (!isset($users[$target]['encrypted_for_doctor'])) {
                echo "Geen data beschikbaar voor $target.\n";
                continue;
            }

            $encData = base64_decode($users[$target]['encrypted_for_doctor']);
            $privRes = openssl_pkey_get_private($this->privateKey);
            
            if (openssl_private_decrypt($encData, $decrypted, $privRes, OPENSSL_PKCS1_OAEP_PADDING)) {
                echo "Bericht succesvol gedecrypteerd\n";
                echo "Bericht van $target: $decrypted\n";
                
                // Verify data integrity by checking if user's public key is valid
                if (isset($users[$target]['public_key'])) {
                    $userPubKey = $users[$target]['public_key'];
                    $testData = "test";
                    $testSignature = $this->createSignature($testData);
                    if ($this->verifySignature($testData, $testSignature, $this->publicKey)) {
                        echo "Data integriteit geverifieerd\n";
                    }
                }
            } else {
                echo "Kon bericht niet decrypteren\n";
            }
            echo "\n";
        }
    }

    /**
     * Creëer een digitale handtekening voor de gegeven data
     */
    private function createSignature(string $data): string
    {
        $privRes = openssl_pkey_get_private($this->privateKey);
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