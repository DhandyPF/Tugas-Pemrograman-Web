<?php
// kontak.php
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/functions.php';

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = h(trim($_POST['nama'] ?? ''));
    $email = h(trim($_POST['email'] ?? ''));
    $pesan = h(trim($_POST['pesan'] ?? ''));
    // TODO: kirim email via mail() atau SMTP mailer
    $success = 'Terima kasih, pesan Anda telah dikirim!';
}
?>
<div class="container" style="margin-top:2rem;">
  <h2>Hubungi Kami</h2>
  <p>Punya pertanyaan atau ingin berkolaborasi? Isi formulir di bawah ini atau kunjungi kami langsung.</p>

  <?php if ($success): ?>
    <div class="flash-message flash-success"><?= $success ?></div>
  <?php endif; ?>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;margin-top:1.5rem;">
    <!-- Contact Form -->
    <form action="kontak.php" method="POST" style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label for="nama"><strong>Nama</strong></label>
        <input type="text" id="nama" name="nama" required
               style="width:100%;padding:0.6rem;border:1px solid #ddd;border-radius:8px;margin-top:0.3rem;">
      </div>
      <div>
        <label for="email"><strong>Email</strong></label>
        <input type="email" id="email" name="email" required
               style="width:100%;padding:0.6rem;border:1px solid #ddd;border-radius:8px;margin-top:0.3rem;">
      </div>
      <div>
        <label for="pesan"><strong>Pesan</strong></label>
        <textarea id="pesan" name="pesan" rows="6" required
                  style="width:100%;padding:0.6rem;border:1px solid #ddd;border-radius:8px;margin-top:0.3rem;resize:vertical;"></textarea>
      </div>
      <button type="submit"
              style="padding:0.7rem 1.4rem;background:#1a237e;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:1rem;">
        Kirim Pesan
      </button>
    </form>

    <!-- Info & Map -->
    <div>
      <h3>Informasi Kontak</h3>
      <p>📍 Jl. Pendidikan No. 1, Blater, Purbalingga Indonesia</p>
      <p>📞 (021) 12345678</p>
      <p>✉ info@smkblater.com</p>
      <p>🕐 Senin–Jumat: 07.00 – 15.30 WIB</p>

      <!-- Google Maps embed placeholder -->
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15145.449116412821!2d109.32911774503069!3d-7.425093553474637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655984febfe03b%3A0x5027a76e35517f0!2sBlater%2C%20Kec.%20Kalimanah%2C%20Kabupaten%20Purbalingga%2C%20Jawa%20Tengah!5e1!3m2!1sid!2sid!4v1790568942613!5m2!1sid!2sid" 
        width="100%" height="220" 
        style="border:0;border-radius:12px;margin-top:1rem;" 
        allowfullscreen="" loading="lazy">
      </iframe>
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
