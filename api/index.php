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

putenv("APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php");
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';

putenv("APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php");
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
$_ENV['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "ERROR VERCEL PHP:\n";
    echo $e->getMessage() . "\n\n";
    echo $e->getTraceAsString();
}
