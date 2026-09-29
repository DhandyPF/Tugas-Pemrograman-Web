<?php
// admin/berita/tambah.php
session_start();
require __DIR__ . '/../../config/auth_check.php';
require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../includes/functions.php';

$kategoriList = $pdo->query('SELECT * FROM kategori_berita ORDER BY nama_kategori ASC')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul      = trim($_POST['judul'] ?? '');
    $id_kategori = (int)($_POST['id_kategori'] ?? 0);
    $konten     = trim($_POST['konten'] ?? '');
    $slug       = slugify($judul) . '-' . time();

    // File upload
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];
        if (in_array($ext, $allowed)) {
            $gambar = uniqid('news_', true) . '.' . $ext;
            move_uploaded_file($_FILES['gambar']['tmp_name'],
                __DIR__ . '/../../assets/img/berita/' . $gambar);
        }
    }

    $stmt = $pdo->prepare('INSERT INTO berita (id_user, id_kategori, judul, slug, konten, gambar_sampul)
                           VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $id_kategori, $judul, $slug, $konten, $gambar]);
    setFlash('success', 'Berita berhasil ditambahkan.');
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Berita – Admin SMK</title>
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
    <li><a href="../logout.php">🚪 Logout</a></li>
  </ul>
</nav>
<div class="admin-main">
  <div class="admin-topbar"><button id="sidebar-toggle">☰</button><span>Tambah Berita</span></div>
  <div class="admin-content">
    <?php showFlash(); ?>
    <h2>Tambah Berita Baru</h2>
    <form class="admin-form" action="tambah.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" id="judul" name="judul" required>
      </div>
      <div class="form-group">
        <label for="id_kategori">Kategori</label>
        <select id="id_kategori" name="id_kategori" required>
          <option value="">-- Pilih Kategori --</option>
          <?php
          foreach ($kategoriList as $k): 
          ?>
            <option value="<?= $k['id_kategori'] ?>"><?= h($k['nama_kategori']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="konten">Konten</label>
        <textarea id="konten" name="konten" rows="8" required></textarea>
      </div>
      <div class="form-group">
        <label for="gambar">Gambar Sampul (JPG/PNG/WebP)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">
      </div>
      <div style="display:flex;gap:1rem;">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-delete">Batal</a>
      </div>
    </form>
  </div>
</div>

<!-- <script src="../../assets/js/admin.js"></script> -->
</body>
</html>