<?php

declare(strict_types=1);

define('URACA_BASE_PATH', dirname(__DIR__));

require_once URACA_BASE_PATH . '/config/config.php';
require_once URACA_BASE_PATH . '/includes/helpers.php';
require_once URACA_BASE_PATH . '/includes/database.php';
require_once URACA_BASE_PATH . '/includes/listing-repository.php';
require_once URACA_BASE_PATH . '/includes/cms-repository.php';
require_once URACA_BASE_PATH . '/includes/cms-render.php';

if (PHP_SAPI !== 'cli' && session_status() !== PHP_SESSION_ACTIVE) {
    $sessionPath = URACA_BASE_PATH . '/storage/sessions';
    if (!is_dir($sessionPath)) {
        mkdir($sessionPath, 0755, true);
    }
    session_save_path($sessionPath);
    session_name(ADMIN_SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}
