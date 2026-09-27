<?php
// detail-jurusan.php
include __DIR__ . '/includes/header.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$program = null;
if ($slug) {
    $stmt = $pdo->prepare('SELECT * FROM jurusan WHERE slug = ?');
    $stmt->execute([$slug]);
    $program = $stmt->fetch();
}
?>
<div class="container" style="margin-top:2rem;">
<?php if ($program): ?>
  <a href="jurusan.php" style="color:#1a237e;">← Kembali ke Daftar Jurusan</a>
  <h2 style="margin-top:1rem;"><?= h($program['nama_jurusan']) ?></h2>
  <?php if (!empty($program['gambar'])): ?>
    <img src="assets/img/jurusan/<?= h($program['gambar']) ?>" alt="<?= h($program['nama_jurusan']) ?>"
         style="width:100%;max-width:600px;border-radius:12px;margin:1rem 0;">
  <?php endif; ?>
  <h3>Deskripsi</h3>
  <p><?= nl2br(h($program['deskripsi'])) ?></p>
  <h3 style="margin-top:1.5rem;">Prospek Karir</h3>
  <p><?= nl2br(h($program['prospek_karir'])) ?></p>
<?php else: ?>
  <h2>Program tidak ditemukan.</h2>
  <a href="jurusan.php">← Kembali ke Daftar Jurusan</a>
<?php endif; ?>
</div>
<footer>
  <div class="container">
    <div class="footer">
      <p>&copy; <?= date('Y'); ?> SMK Blater. All rights reserved.</p>
      <p>Alamat: Jalan Pendidikan No. 1, Blater, Purbalingga Indonesia | Tel: (021) 12345678 | Email: info@smkblater.com</p>
    </div>
  </div>
</footer>
</body>
</html>
