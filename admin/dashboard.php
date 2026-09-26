<?php
// admin/dashboard.php - No JS
session_start();
require __DIR__ . '/../config/auth_check.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/functions.php';

$totalBerita     = $pdo->query('SELECT COUNT(*) FROM berita')->fetchColumn();
$totalPengumuman = $pdo->query('SELECT COUNT(*) FROM pengumuman')->fetchColumn();
$totalJurusan    = $pdo->query('SELECT COUNT(*) FROM jurusan')->fetchColumn();
$latestBerita    = $pdo->query(
    'SELECT judul, created_at FROM berita ORDER BY created_at DESC LIMIT 5'
)->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard – Admin SMK</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-body">

<!-- CSS-only sidebar toggle: checkbox OUTSIDE .admin-wrapper -->
<input type="checkbox" id="sidebar-toggle-cb">

<div class="admin-wrapper">
  <!-- Sidebar -->
  <nav id="admin-sidebar">
    <div class="sidebar-brand">⚙ Admin SMK</div>
    <ul>
      <li><a href="dashboard.php" class="active">🏠 Dashboard</a></li>
      <li><a href="berita/index.php">📰 Berita</a></li>
      <li><a href="pengumuman/index.php">📢 Pengumuman</a></li>
      <li><a href="jurusan/index.php">🎓 Jurusan</a></li>
      <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
  </nav>

  <!-- Main -->
  <div class="admin-main">
    <div class="admin-topbar">
      <label class="sidebar-toggle-label" for="sidebar-toggle-cb">☰</label>
      <span>Selamat datang, <strong><?= h($_SESSION['nama_lengkap'] ?? 'Admin') ?></strong></span>
      <a href="logout.php" style="color:#c62828;font-size:0.88rem;">Logout</a>
    </div>

    <div class="admin-content">
      <?php showFlash(); ?>
      <h2>Dashboard</h2>

      <div class="stat-grid">
        <div class="stat-card">
          <div class="stat-number"><?= $totalBerita ?></div>
          <div class="stat-label">Total Berita</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?= $totalPengumuman ?></div>
          <div class="stat-label">Total Pengumuman</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?= $totalJurusan ?></div>
          <div class="stat-label">Program Keahlian</div>
        </div>
      </div>

      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h3 style="color:#1a237e;">Berita Terbaru</h3>
        <a href="berita/tambah.php" class="btn btn-primary">+ Tambah Berita</a>
      </div>
      <table class="admin-table">
        <thead>
          <tr><th>#</th><th>Judul</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
          <?php foreach ($latestBerita as $i => $b): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= h($b['judul']) ?></td>
              <td><?= formatTanggal($b['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($latestBerita)): ?>
            <tr><td colspan="3" style="text-align:center;color:#888;">Belum ada berita.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div><!-- end .admin-wrapper -->

</body>
</html>
