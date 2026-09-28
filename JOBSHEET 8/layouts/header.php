<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menentukan root path dinamis agar link CSS dan Navigasi tetap valid dari subfolder mana pun
$base_url = (basename(dirname($_SERVER['PHP_SELF'])) == 'barang' || basename(dirname($_SERVER['PHP_SELF'])) == 'peminjam') ? '../' : './';

// Menentukan title default jika tidak diset di halaman utama
$page_title = $page_title ?? 'SITARIS HMTI';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SITARIS HMTI</h1>
        <!-- Tombol hamburger -->
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?php echo $base_url; ?>index.php">Beranda</a></li>
                <li><a href="<?php echo $base_url; ?>barang/list.php">Daftar Barang</a></li>
                <li><a href="<?php echo $base_url; ?>barang/tambah.php">Tambah Barang</a></li>
                <li><a href="<?php echo $base_url; ?>peminjam/list.php">Daftar Peminjam</a></li>
                <li><a href="<?php echo $base_url; ?>peminjam/tambah.php">Tambah Peminjam</a></li>
            </ul>
        </nav>
    </header>