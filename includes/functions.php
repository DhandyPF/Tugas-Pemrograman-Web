<?php
// includes/functions.php

/**
 * Escape HTML special characters (prevent XSS).
 */
function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Generate a simple URL slug from a string.
 */
function slugify(string $text): string {
    $text = mb_strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Format a MySQL date string to Indonesian locale (e.g. "25 September 2026").
 */
function formatTanggal(string $date): string {
    $bulan = [
        1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
        5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
        9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
    ];
    $ts = strtotime($date);
    return date('d', $ts) . ' ' . $bulan[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

/**
 * Redirect to a URL and exit.
 */
function redirect(string $url): void {
    header("Location: $url");
    exit();
}

/**
 * Set a flash message in session.
 */
function setFlash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

/**
 * Display and clear the flash message, if any.
 */
function showFlash(): void {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        $class = $f['type'] === 'success' ? 'flash-success' : 'flash-error';
        echo '<div class="flash-message ' . $class . '">' . h($f['message']) . '</div>';
        unset($_SESSION['flash']);
    }
}
?>
