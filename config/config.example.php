<?php

declare(strict_types=1);

// Production values should be supplied with URACA_* environment variables
// or a private config/config.local.php file that is not committed to Git.
const DB_HOST = 'localhost';
const DB_NAME = 'cpanel_database_name';
const DB_USER = 'cpanel_database_user';
const DB_PASS = 'cpanel_database_password';
const DB_CHARSET = 'utf8mb4';

const SITE_URL = 'https://uracarealtyph.com';
const ADMIN_SESSION_NAME = 'uraca_admin';
const UPLOAD_DIR = __DIR__ . '/../uploads/listings';
const UPLOAD_URL = 'uploads/listings';
