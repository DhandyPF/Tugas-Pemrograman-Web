<?php
// config/auth_check.php
// Simple authentication guard for admin pages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
