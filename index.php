<?php
// index.php
include __DIR__ . '/includes/header.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/functions.php';

// Fetch 6 latest news
$latestNews = $pdo->query(
    'SELECT judul, slug, gambar_sampul, SUBSTRING(konten,1,100) AS excerpt, created_at
     FROM berita ORDER BY created_at DESC LIMIT 6'
)->fetchAll();

// Fetch 5 latest announcements
$announcements = $pdo->query(
    'SELECT judul, tanggal_kegiatan FROM pengumuman
     WHERE status = "publikasi" ORDER BY created_at DESC LIMIT 5'
)->fetchAll();

// Fetch jurusan
$jurusanList = $pdo->query('SELECT * FROM jurusan LIMIT 6')->fetchAll();
?>

<!-- ── Hero Slider (CSS-only keyframes) ── -->
<div class="hero">
  <div class="hero-slides">
    <div class="hero-slide">
      <img src="assets/img/hero/slide1.jpg" alt="Kegiatan Praktek">
      <div class="hero-caption">
        <h2>Selamat Datang di SMK Blater</h2>
        <p>Mencetak generasi kompeten dan siap kerja sejak 1945</p>
      </div>
    </div>
    <div class="hero-slide">
      <img src="assets/img/hero/slide2.jpg" alt="Fasilitas Bengkel">
      <div class="hero-caption">
        <h2>Fasilitas Bengkel &amp; Lab Modern</h2>
        <p>Belajar langsung dengan peralatan standar industri</p>
      </div>
    </div>
    <div class="hero-slide">
      <img src="assets/img/hero/slide3.jpg" alt="PPDB 2027">
      <div class="hero-caption">
        <h2>Penerimaan Peserta Didik Baru 2030</h2>
        <p>Daftarkan dirimu sekarang dan raih masa depanmu</p>
      </div>
    </div>
  </div>
</div>

<!-- ── Sambutan Kepala Sekolah ── -->
<div class="section">
  <div class="container">
    <h2 class="section-title">Sambutan Kepala Sekolah</h2>
    <div class="sambutan">
      <img src="assets/img/kepsek.jpg" alt="Kepala Sekolah">
      <div>
        <h3>Prof. Dr. Ir. Akhmad Sodiq, M.Sc. Agr., IPU., ASEAN Eng</h3>
        <p style="color:#888;font-size:0.88rem;margin-bottom:0.75rem;">Kepala SMK Blater</p>
        <blockquote>
          "Pendidikan kejuruan adalah jembatan antara potensi generasi muda dengan
          kebutuhan dunia industri. Kami berkomitmen mencetak lulusan yang tidak hanya
          terampil, tetapi juga berkarakter dan berdaya saing global."
        </blockquote>
        <p>Kami terus berinovasi dalam kurikulum, fasilitas, dan kemitraan industri
           agar setiap siswa mendapatkan pengalaman belajar terbaik dan siap memasuki
           dunia kerja dengan percaya diri.</p>
      </div>
    </div>
  </div>
</div>

<!-- ── Stats Bar ── -->
<div class="stats-bar">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <div class="stat-number">1.200+</div>
        <div class="stat-label">Siswa Aktif</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">85</div>
        <div class="stat-label">Guru &amp; Tenaga Kependidikan</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">3</div>
        <div class="stat-label">Program Keahlian</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">40+</div>
        <div class="stat-label">Mitra DU/DI</div>
      </div>
    </div>
  </div>
</div>

<!-- ── Katalog Jurusan ── -->
<div class="section">
  <div class="container">
    <h2 class="section-title">Program Keahlian</h2>
    <p class="section-subtitle">Pilih jurusan sesuai minat dan bakat kamu</p>
    <div class="card-grid">
      <?php if (!empty($jurusanList)): ?>
        <?php foreach ($jurusanList as $j): ?>
          <div class="card">
            <img src="assets/img/jurusan/<?= h($j['gambar'] ?? 'default.jpg') ?>" alt="<?= h($j['nama_jurusan']) ?>">
            <div class="card-body">
              <h3><?= h($j['nama_jurusan']) ?></h3>
              <p><?= h(mb_substr($j['deskripsi'], 0, 100)) ?>…</p>
            </div>
            <div class="card-footer">
              <a href="detail-jurusan.php?slug=<?= h($j['slug']) ?>" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Placeholder cards -->
        <?php
        $placeholders = [
          ['Rekayasa Perangkat Lunak', 'Mengembangkan aplikasi web & mobile berbasis industri.', 'RPL'],
          ['Teknik Kendaraan Ringan', 'Perawatan & perbaikan kendaraan bermotor modern.', 'TKR'],
          ['Desain Komunikasi Visual', 'Desain grafis, multimedia, dan visual branding.', 'DKV'],
        ];
        foreach ($placeholders as $p):
        ?>
          <div class="card">
            <img src="https://placehold.co/400x200/e8eaf6/1a237e?text=<?= urlencode($p[2]) ?>" alt="<?= $p[0] ?>">
            <div class="card-body">
              <h3><?= $p[0] ?></h3>
              <p><?= $p[1] ?></p>
            </div>
            <div class="card-footer">
              <a href="jurusan.php" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div style="text-align:center;margin-top:2rem;">
      <a href="jurusan.php" class="btn btn-outline">Lihat Semua Jurusan</a>
    </div>
  </div>
</div>

<!-- ── Berita & Pengumuman ── -->
<div class="section" style="background:#fff;padding:3rem 0;">
  <div class="container">
    <h2 class="section-title">Berita &amp; Pengumuman</h2>
    <div class="news-layout">
      <!-- Berita (70%) -->
      <div class="news-col">
        <h3>📰 Berita Terkini</h3>
        <?php if (!empty($latestNews)): ?>
          <?php foreach ($latestNews as $n): ?>
            <div class="news-list-item">
              <img src="<?= !empty($n['gambar_sampul']) ? 'assets/img/berita/' . h($n['gambar_sampul']) : 'https://placehold.co/100x70/e8eaf6/1a237e?text=News' ?>"
                   alt="<?= h($n['judul']) ?>">
              <div>
                <h4><a href="detail-berita.php?slug=<?= h($n['slug']) ?>"><?= h($n['judul']) ?></a></h4>
                <span><?= formatTanggal($n['created_at']) ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="color:#888;">Belum ada berita.</p>
        <?php endif; ?>
        <a href="berita.php" class="btn btn-outline" style="margin-top:1rem;">Semua Berita</a>
      </div>

      <!-- Pengumuman (30%) -->
      <div class="announce-col">
        <h3>📢 Pengumuman</h3>
        <?php if (!empty($announcements)): ?>
          <?php foreach ($announcements as $a):
            $tgl = $a['tanggal_kegiatan'] ? date('d', strtotime($a['tanggal_kegiatan'])) : '–';
            $bln = $a['tanggal_kegiatan'] ? strtoupper(date('M', strtotime($a['tanggal_kegiatan']))) : '';
          ?>
            <div class="announce-item">
              <div class="announce-date">
                <strong><?= $tgl ?></strong>
                <?= $bln ?>
              </div>
              <p style="font-size:0.88rem;"><?= h($a['judul']) ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <?php
          $sampleAnn = [
            ['Libur Hari Raya Idul Fitri 1448H', '2030-03-28'],
            ['Ujian Akhir Semester Gasal', '2030-12-10'],
            ['PPDB Gelombang 1 Dibuka', '2030-11-01'],
          ];
          foreach ($sampleAnn as $sa):
            $tgl = date('d', strtotime($sa[1]));
            $bln = strtoupper(date('M', strtotime($sa[1])));
          ?>
            <div class="announce-item">
              <div class="announce-date"><strong><?= $tgl ?></strong><?= $bln ?></div>
              <p style="font-size:0.88rem;"><?= $sa[0] ?></p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- ── Mitra DU/DI ── -->
<div class="section">
  <div class="container">
    <h2 class="section-title">Mitra Industri</h2>
    <p class="section-subtitle">Tempat PKL, magang, dan penyerapan lulusan kami</p>
    <div class="mitra-grid">
      <img src="https://placehold.co/160x60/f0f4ff/1a237e?text=PT+Teknologi" alt="Mitra 1">
      <img src="https://placehold.co/160x60/f0f4ff/1a237e?text=CV+Industri" alt="Mitra 2">
      <img src="https://placehold.co/160x60/f0f4ff/1a237e?text=PT+Mandiri" alt="Mitra 3">
      <img src="https://placehold.co/160x60/f0f4ff/1a237e?text=PT+Karya" alt="Mitra 4">
      <img src="https://placehold.co/160x60/f0f4ff/1a237e?text=UD+Sejahtera" alt="Mitra 5">
    </div>
  </div>
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
