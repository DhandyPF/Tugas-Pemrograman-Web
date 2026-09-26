<?php
// detail-berita.php
include __DIR__ . '/includes/header.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$article = null;
if ($slug) {
    $stmt = $pdo->prepare(
        'SELECT b.*, u.nama_lengkap AS penulis, k.nama_kategori
         FROM berita b
         JOIN users u ON b.id_user = u.id_user
         JOIN kategori_berita k ON b.id_kategori = k.id_kategori
         WHERE b.slug = ?'
    );
    $stmt->execute([$slug]);
    $article = $stmt->fetch();

    // Increment view counter
    if ($article) {
        $pdo->prepare('UPDATE berita SET dibaca = dibaca + 1 WHERE id_berita = ?')
            ->execute([$article['id_berita']]);
    }
}
?>
<div class="container" style="margin-top:2rem;max-width:800px;">
<?php if ($article): ?>
  <a href="berita.php" style="color:#1a237e;">← Kembali ke Berita</a>
  <h2 style="margin-top:1rem;"><?= h($article['judul']) ?></h2>
  <p style="color:#888;font-size:0.85rem;margin-bottom:1rem;">
    <?= formatTanggal($article['created_at']) ?> &nbsp;|&nbsp;
    Penulis: <?= h($article['penulis']) ?> &nbsp;|&nbsp;
    Kategori: <?= h($article['nama_kategori']) ?>
  </p>
  <?php if (!empty($article['gambar_sampul'])): ?>
    <img src="assets/img/berita/<?= h($article['gambar_sampul']) ?>"
         alt="<?= h($article['judul']) ?>"
         style="width:100%;border-radius:12px;margin-bottom:1.5rem;">
  <?php endif; ?>
  <div style="line-height:1.8;">
    <?= nl2br(h($article['konten'])) ?>
  </div>
<?php else: ?>
  <h2>Berita tidak ditemukan.</h2>
  <a href="berita.php">← Kembali ke Berita</a>
<?php endif; ?>
</div>
<footer>
  <div class="container">
    <div class="footer">
      <p>&copy; <?= date('Y'); ?> SMK Kejuruan. All rights reserved.</p>
      <p>Alamat: Jalan Pendidikan No. 1, Kota Contoh, Indonesia | Tel: (021) 12345678 | Email: info@smkexample.id</p>
    </div>
  </div>
</footer>
</body>
</html>
