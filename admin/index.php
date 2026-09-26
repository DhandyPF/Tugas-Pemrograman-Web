<?php
// admin/index.php - Login page (no JS)
session_start();
require __DIR__ . '/../includes/functions.php';

// If already logged in, go to dashboard
if (!empty($_SESSION['user_id'])) {
    redirect('dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin – SMK Kejuruan</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-body">
<div class="admin-login-wrap">
  <div class="admin-login-box">
    <h2>⚙ Login Admin</h2>
    <?php showFlash(); ?>
    <form action="login_action.php" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus
               placeholder="Masukkan username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required
               placeholder="Masukkan password">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;padding:0.7rem;font-size:1rem;">
        Masuk
      </button>
    </form>
    <p style="text-align:center;margin-top:1rem;font-size:0.85rem;">
      <a href="../index.php" style="color:#1a237e;">← Kembali ke website</a>
    </p>
  </div>
</div>
</body>
</html>
