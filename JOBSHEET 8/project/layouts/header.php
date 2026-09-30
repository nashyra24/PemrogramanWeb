<?php
// =====================================================================
// [PERUBAHAN] header.php — kini dipakai oleh SEMUA halaman (index,
// barang/*, peminjam/*), sama seperti referensi. Versi lama memuat
// header hanya di sebagian halaman sehingga navigasi tidak konsisten.
// =====================================================================

session_start();
// ↑ Sama dengan referensi: session dibuka sekali di header, dan
//   dipanggil paling atas karena session_start() mengirim HTTP header.

// =====================================================================
// [DIAMBIL DARI REFERENSI] Logika $base: menghitung prefix relatif
// (mis. "../") dari folder halaman saat ini ke root proyek, sehingga
// link /assets dan menu navigasi tetap benar walau proyek diakses lewat
// subfolder. Versi lama mengecek nama folder ('barang'/'peminjam') yang
// rapuh; logika referensi membandingkan path nyata, lebih aman.
// =====================================================================
$__projectRoot = dirname(__DIR__);                 // folder project/ (root aplikasi)
$__scriptDir   = dirname($_SERVER['SCRIPT_FILENAME']); // folder file yang sedang dieksekusi
$__rel  = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__projectRoot))), '/');
$base   = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SITARIS HMTI<?php echo isset($page_title) && $page_title !== '' ? ' | ' . htmlspecialchars($page_title) : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SITARIS HMTI</h1>
        <!-- Tombol hamburger; interaksinya ditangani app.js (initNavToggle) -->
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <!-- [PERUBAHAN] Semua link memakai $base agar konsisten
                     dari folder mana pun, meniru struktur nav referensi. -->
                <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                <li><a href="<?php echo $base; ?>barang/list.php">Daftar Barang</a></li>
                <li><a href="<?php echo $base; ?>barang/tambah.php">Tambah Barang</a></li>
                <li><a href="<?php echo $base; ?>peminjam/list.php">Daftar Peminjam</a></li>
                <li><a href="<?php echo $base; ?>peminjam/tambah.php">Tambah Peminjam</a></li>
            </ul>
        </nav>
    </header>

    <main>
