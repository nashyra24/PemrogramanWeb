<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$__projectRoot = dirname(__DIR__);                 
$__scriptDir   = dirname($_SERVER['SCRIPT_FILENAME']); 
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- [PERUBAHAN Jobsheet 9] Menu kelola hanya untuk petugas yang login -->
                    <li><a href="<?php echo $base; ?>barang/tambah.php">Tambah Barang</a></li>
                    <li><a href="<?php echo $base; ?>peminjam/list.php">Daftar Peminjam</a></li>
                    <li><a href="<?php echo $base; ?>peminjam/tambah.php">Tambah Peminjam</a></li>
                    <li class="nav-user">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?></li>
                    <li><a href="<?php echo $base; ?>auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $base; ?>auth/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
