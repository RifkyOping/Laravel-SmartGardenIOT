<?php

$storagePath = '/tmp/storage';

if (!is_dir($storagePath)) {
    mkdir($storagePath, 0777, true);
    mkdir($storagePath . '/framework/cache/data', 0777, true);
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/framework/views', 0777, true);
    mkdir($storagePath . '/logs', 0777, true);
    mkdir('/tmp/bootstrap/cache', 0777, true);
}

putenv("APP_STORAGE={$storagePath}");
$_SERVER['APP_STORAGE'] = $storagePath;
$_ENV['APP_STORAGE'] = $storagePath;

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "ERROR VERCEL PHP:\n";
    echo $e->getMessage() . "\n\n";
    echo $e->getTraceAsString();
}
