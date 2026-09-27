<?php
include __DIR__ . '/includes/header.php';
?>
<div class="container" style="margin-top:2rem;">
  <h2>Program Keahlian</h2>
  <div class="card-grid">
    <div class="card">
      <img src="assets/img/jurusan/rpl.jpg" alt="RPL">
      <h3>Rekayasa Perangkat Lunak (RPL)</h3>
      <p>Pengembangan aplikasi berbasis web dan mobile.</p>
      <a href="detail-jurusan.php?slug=rpl" class="btn">Lihat Detail</a>
    </div>
    <div class="card">
      <img src="assets/img/jurusan/tkr.jpg" alt="TKR">
      <h3>Teknik Kendaraan Ringan (TKR)</h3>
      <p>Perawatan dan perbaikan kendaraan bermotor.</p>
      <a href="detail-jurusan.php?slug=tkr" class="btn">Lihat Detail</a>
    </div>
    <div class="card">
      <img src="assets/img/jurusan/dkv.jpg" alt="DKV">
      <h3>Desain Komunikasi Visual (DKV)</h3>
      <p>Desain grafis, multimedia, dan branding.</p>
      <a href="detail-jurusan.php?slug=dkv" class="btn">Lihat Detail</a>
    </div>
    <!-- Add more program cards as needed -->
  </div>
</div>
<footer>
  <div class="container">
    <div class="footer">
      <p>&copy; <?= date('Y'); ?> SMK Blater. All rights reserved.</p>
      <p>Alamat: Jalan Pendidikan No. 1, Kota Contoh, Indonesia | Tel: (021) 12345678 | Email: info@smkexample.id</p>
    </div>
  </div>
</footer>
</body>
</html>
