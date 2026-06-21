<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function site_url(string $path = ''): string
{
    return rtrim(SITE_URL, '/') . '/' . ltrim($path, '/');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? '';

    if (!is_string($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        exit('Invalid CSRF token.');
    }
}

function is_admin_logged_in(): bool
{
    return isset($_SESSION['admin_id']);
}

function require_admin(): void
{
    if (!is_admin_logged_in()) {
        redirect('login.php');
    }
}

function flash(?string $message = null, string $type = 'success'): ?array
{
    if ($message !== null) {
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
        return null;
    }

    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return $flash;
}

function slugify(string $value): string
{
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';
    $value = trim($value, '-');

    return $value !== '' ? $value : bin2hex(random_bytes(4));
}

function phone_href(?string $phone): string
{
    $digits = preg_replace('/[^0-9+]/', '', (string) $phone) ?? '';

    return $digits !== '' ? 'tel:' . $digits : 'page-contact.php';
}

function whatsapp_href(?string $phone): string
{
    $digits = preg_replace('/\D+/', '', (string) $phone) ?? '';

    return $digits !== '' ? 'https://wa.me/' . $digits : 'page-contact.php';
}

function split_lines(?string $value): array
{
    $lines = preg_split('/\R+/', trim((string) $value)) ?: [];

    return array_values(array_filter(array_map('trim', $lines), static fn ($line) => $line !== ''));
}

function limit_text(?string $value, int $maxLength): string
{
    $value = trim((string) $value);

    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $maxLength);
    }

    return substr($value, 0, $maxLength);
}

function sanitize_html_fragment(?string $value): string
{
    $value = (string) $value;
    $value = preg_replace('#<(script|style|iframe|object|embed|link|meta|base|form|input|button|textarea|select|option)[^>]*>.*?</\1>#is', '', $value) ?? '';
    $value = preg_replace('#</?(script|style|iframe|object|embed|link|meta|base|form|input|button|textarea|select|option)[^>]*>#i', '', $value) ?? '';
    $value = preg_replace('/\s+on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $value) ?? '';
    $value = preg_replace('/\s+(href|src)\s*=\s*([\'"])\s*javascript:[^\'"]*\2/i', ' $1="#"', $value) ?? '';

    return strip_tags($value, '<em><strong><b><i><br><span>');
}

function validate_public_url(?string $url, string $fallback = '#', bool $allowRelative = true): string
{
    $url = trim((string) $url);
    if ($url === '') {
        return $fallback;
    }

    if (preg_match('/[\x00-\x1F\x7F]/', $url)) {
        return $fallback;
    }

    if ($allowRelative && preg_match('~^(?!//)[a-z0-9][a-z0-9/_\-.]*(?:\.php)?(?:\?[a-z0-9_%=&.\-]+)?(?:#[a-z0-9_\-]+)?$~i', $url)) {
        return $url;
    }

    $parts = parse_url($url);
    $scheme = strtolower((string) ($parts['scheme'] ?? ''));
    if (in_array($scheme, ['https', 'mailto', 'tel'], true)) {
        return $url;
    }

    return $fallback;
}

function validate_asset_path(?string $path, string $fallback = ''): string
{
    $path = trim((string) $path);
    if ($path === '') {
        return $fallback;
    }

    if (preg_match('/[\x00-\x1F\x7F]/', $path) || str_contains($path, '..') || str_starts_with($path, '//')) {
        return $fallback;
    }

    if (preg_match('#^(images|uploads)/[a-z0-9 _.,()/\-]+?\.(?:jpg|jpeg|png|webp|gif|svg)$#i', $path)) {
        return $path;
    }

    if (preg_match('#^https://[a-z0-9.-]+(?:/[a-z0-9 _.,%=&?()/\-]*)?$#i', $path)) {
        return $path;
    }

    return $fallback;
}

function validate_video_path(?string $path, string $fallback = ''): string
{
    $path = trim((string) $path);
    if ($path === '') {
        return $fallback;
    }

    if (preg_match('/[\x00-\x1F\x7F]/', $path) || str_contains($path, '..') || str_starts_with($path, '//')) {
        return $fallback;
    }

    if (preg_match('#^(images|uploads)/[a-z0-9 _.,()/\-]+?\.(?:mp4|webm)$#i', $path)) {
        return $path;
    }

    return $fallback;
}

function validate_embed_url(?string $url, string $fallback = ''): string
{
    $url = trim((string) $url);
    if ($url === '') {
        return $fallback;
    }

    $parts = parse_url(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $scheme = strtolower((string) ($parts['scheme'] ?? ''));
    $host = strtolower((string) ($parts['host'] ?? ''));

    if ($scheme === 'https' && (str_ends_with($host, 'google.com') || str_ends_with($host, 'google.com.ph'))) {
        return $url;
    }

    return $fallback;
}
