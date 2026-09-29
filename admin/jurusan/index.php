<?php
// admin/berita/index.php – CRUD list for news
session_start();
require __DIR__ . '/../../config/auth_check.php';
require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../includes/functions.php';

// Handle delete
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $stmt = $pdo->prepare('DELETE FROM berita WHERE id_berita = ?');
    $stmt->execute([(int)$_GET['hapus']]);
    setFlash('success', 'Berita berhasil dihapus.');
    redirect('index.php');
}

// Fetch all news
$beritaList = $pdo->query('SELECT b.id_berita, b.judul, b.created_at, u.nama_lengkap AS penulis
    FROM berita b JOIN users u ON b.id_user = u.id_user
    ORDER BY b.created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Berita – Admin SMK</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body class="admin-body">

<nav id="admin-sidebar">
  <div class="sidebar-brand">⚙ Admin SMK</div>
  <ul>
    <li><a href="../dashboard.php">🏠 Dashboard</a></li>
    <li><a href="index.php" class="active">📰 Berita</a></li>
    <li><a href="../pengumuman/index.php">📢 Pengumuman</a></li>
    <li><a href="../jurusan/index.php">🎓 Jurusan</a></li>
    <li><a href="../logout.php">🚪 Logout</a></li>
  </ul>
</nav>

<div class="admin-main">
  <div class="admin-topbar">
    <button id="sidebar-toggle">☰</button>
    <span>Kelola Berita</span>
  </div>

  <div class="admin-content">
    <?php showFlash(); ?>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
      <h2>Daftar Berita</h2>
      <a href="tambah.php" class="btn btn-primary">+ Tambah Berita</a>
    </div>

    <table class="admin-table">
      <thead>
        <tr>
          <th>#</th><th>Judul</th><th>Penulis</th><th>Tanggal</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($beritaList as $i => $b): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= h($b['judul']) ?></td>
          <td><?= h($b['penulis']) ?></td>
          <td><?= formatTanggal($b['created_at']) ?></td>
          <td>
            <a href="edit.php?id=<?= $b['id_berita'] ?>" class="btn btn-warning">Edit</a>
            <a href="?hapus=<?= $b['id_berita'] ?>" class="btn btn-delete">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($beritaList)): ?>
          <tr><td colspan="5" style="text-align:center;color:#888;">Belum ada berita.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- <script src="../../assets/js/admin.js"></script> -->
</body>
</html>
