<?php
include "server.php";
include "client.php";


if (php_sapi_name() === 'cli') {
    $mode = $argv[1] ?? null;
    if ($mode === 'server') {
        (new RSAServer())->start();
    } elseif ($mode === 'client') {
        (new RSAClient())->connect();
    } else {
        echo "Gebruik: php script.php [server|client]\n";
    }
}