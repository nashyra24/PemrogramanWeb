<?php
// Set judul halaman secara dinamis
$page_title = "SITARIS HMTI | Daftar Peminjam";

// Memanggil header/template atas (jika dipisah)
// require_once '../includes/header.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>SITARIS HMTI</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="../barang/list.php">Daftar Barang</a></li>
                <li><a href="../barang/tambah.php">Tambah Barang</a></li>
                <li><a href="list.php">Daftar Peminjam</a></li>
                <li><a href="tambah.php">Tambah Peminjam</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Daftar Peminjam</h2>

            <!-- Kolom Pencarian di luar table-responsive -->
            <div class="search-box">
                <p id="table-counter" style="font-size: 0.9rem; color: #555; margin-bottom: 0.5rem;"></p>
                <label for="search-input">Cari</label>
                <input type="text" id="search-input" placeholder="Ketik kata kunci...">
            </div>

            <!-- Pembungkus Tabel Responsif -->
            <p id="loading-indicator" style="display:none;">Memuat data...</p>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Nama OKI</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        /* 
                         * JIKA DATA DIAMBIL DARI DATABASE (MySQL/PDO):
                         * Anda bisa menggantikan data dynamic JS dengan loop PHP di sini.
                         * 
                         * Contoh:
                         * foreach ($data_peminjam as $row) {
                         *     echo "<tr>";
                         *     echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                         *     echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                         *     echo "<td>" . htmlspecialchars($row['oki']) . "</td>";
                         *     echo "<td>" . htmlspecialchars($row['hp']) . "</td>";
                         *     echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
                         *     echo "</tr>";
                         * }
                         */
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <p>© <?= date('Y'); ?> SITARIS HMTI — Jobsheet 6</p>
    </footer>

    <!-- Perhatikan tanda ../ -->
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/peminjam.js"></script>
</body>
</html>