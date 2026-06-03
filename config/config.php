<?php

declare(strict_types=1);

$localConfigPath = __DIR__ . '/config.local.php';
$localConfig = is_file($localConfigPath) ? require $localConfigPath : [];

function uraca_config_value(string $key, string $fallback, array $localConfig): string
{
    $envValue = getenv('URACA_' . $key);
    if (is_string($envValue) && $envValue !== '') {
        return $envValue;
    }

    $localValue = $localConfig[$key] ?? null;
    if (is_string($localValue) && $localValue !== '') {
        return $localValue;
    }

    return $fallback;
}

define('DB_HOST', uraca_config_value('DB_HOST', '127.0.0.1', $localConfig));
define('DB_NAME', uraca_config_value('DB_NAME', 'uraca_realty_backend', $localConfig));
define('DB_USER', uraca_config_value('DB_USER', 'root', $localConfig));
define('DB_PASS', uraca_config_value('DB_PASS', '', $localConfig));
define('DB_CHARSET', uraca_config_value('DB_CHARSET', 'utf8mb4', $localConfig));

define('SITE_URL', uraca_config_value('SITE_URL', 'https://uracarealtyph.com', $localConfig));
const ADMIN_SESSION_NAME = 'uraca_admin';
const UPLOAD_DIR = __DIR__ . '/../uploads/listings';
const UPLOAD_URL = 'uploads/listings';
