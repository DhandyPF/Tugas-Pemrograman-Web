<?php
// admin/login_action.php
session_start();
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    setFlash('error', 'Username dan password wajib diisi.');
    redirect('index.php');
}

// Fetch user by username
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    // Regenerate session ID to prevent session fixation
    session_regenerate_id(true);
    $_SESSION['user_id']     = $user['id_user'];
    $_SESSION['username']    = $user['username'];
    $_SESSION['nama_lengkap']= $user['nama_lengkap'];
    $_SESSION['role']        = $user['role'];

    redirect('dashboard.php');
} else {
    setFlash('error', 'Username atau password salah.');
    redirect('index.php');
}
?>
