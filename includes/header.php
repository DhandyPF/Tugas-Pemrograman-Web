<?php
// includes/header.php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMK Blater – Portal Resmi</title>
  <meta name="description" content="Website resmi SMK Kejuruan. Profil, program keahlian, berita, dan informasi PPDB.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= time(); ?>">
  <link rel="stylesheet" href="assets/css/responsive.css?v=<?= time(); ?>">
</head>
<body>

<!-- Utility bar -->
<div class="utility-bar">
  <div class="container">
    <span>📍 Jl. Pendidikan No. 1, Blater, Purbalingga | ✉ info@smkblater.com</span>
    <span>
      <a href="https://github.com/">Facebook</a> &nbsp;|&nbsp;
      <a href="https://www.instagram.com/dhandyputra.f/">Instagram</a> &nbsp;|&nbsp;
      <a href="admin/index.php">Login Petugas</a>
    </span>
  </div>
</div>

<!-- Navigation (CSS-only hamburger) -->
<nav>
  <div class="nav-inner">
    <div class="nav-logo"><a href="index.php">⚙ SMK Blater</a></div>

    <!-- Checkbox hack for mobile menu -->
    <input type="checkbox" id="menu-toggle">
    <label class="menu-label" for="menu-toggle">☰</label>

    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="profil.php">Profil</a></li>
      <li><a href="jurusan.php">Jurusan</a></li>
      <li><a href="berita.php">Berita</a></li>
      <!-- <li><a href="kontak.php">Kontak</a></li>
      <li><a href="#ppdb" class="cta">Daftar PPDB</a></li> -->
    </ul>
  </div>
</nav>
