<?php
// berita.php
include __DIR__ . '/includes/header.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/functions.php';

$perPage = 9;
$page    = max(1, (int)($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;

$total = $pdo->query('SELECT COUNT(*) FROM berita')->fetchColumn();
$pages = (int)ceil($total / $perPage);

$stmt = $pdo->prepare(
    'SELECT id_berita, judul, slug, gambar_sampul,
            SUBSTRING(konten,1,160) AS excerpt, created_at
     FROM berita ORDER BY created_at DESC LIMIT ? OFFSET ?'
);
$stmt->bindValue(1, $perPage, PDO::PARAM_INT);
$stmt->bindValue(2, $offset,  PDO::PARAM_INT);
$stmt->execute();
$newsList = $stmt->fetchAll();
?>
<div class="container" style="margin-top:2rem;">
  <h2>Berita &amp; Pengumuman</h2>
  <div class="card-grid">
    <?php foreach ($newsList as $item): ?>
      <div class="card">
        <?php if (!empty($item['gambar_sampul'])): ?>
          <img src="assets/img/berita/<?= h($item['gambar_sampul']) ?>" alt="<?= h($item['judul']) ?>">
        <?php else: ?>
          <img src="https://placehold.co/400x200/e0e7ff/1a237e?text=SMK" alt="Placeholder">
        <?php endif; ?>
        <h3><?= h($item['judul']) ?></h3>
        <p style="font-size:0.8rem;color:#888;margin-bottom:0.5rem;"><?= formatTanggal($item['created_at']) ?></p>
        <p><?= h($item['excerpt']) ?>…</p>
        <a href="detail-berita.php?slug=<?= h($item['slug']) ?>" class="btn btn-primary" style="margin-top:0.75rem;">Baca Selengkapnya</a>
      </div>
    <?php endforeach; ?>
    <?php if (empty($newsList)): ?>
      <p>Belum ada berita yang dipublikasikan.</p>
    <?php endif; ?>
  </div>

  <?php if ($pages > 1): ?>
    <nav style="margin-top:2rem;text-align:center;">
      <?php for ($i = 1; $i <= $pages; $i++): ?>
        <a href="?page=<?= $i ?>"
           style="margin:0 4px;padding:0.4rem 0.8rem;border-radius:6px;
                  background:<?= $i == $page ? '#1a237e' : '#e0e7ff' ?>;
                  color:<?= $i == $page ? '#fff' : '#1a237e' ?>;
                  text-decoration:none;">
          <?= $i ?>
        </a>
      <?php endfor; ?>
    </nav>
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
