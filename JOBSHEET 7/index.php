<?php
session_start();

// Mengambil data peminjam dari session, atau array kosong jika belum ada
$peminjamList = $_SESSION['peminjam'] ?? [];
$flash = $_SESSION['flash'] ?? null;

// Hapus flash message setelah dibaca agar tidak muncul terus-menerus
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SITARIS HMTI | Daftar Peminjam</title>
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
                <li><a href="list.php" class="active">Daftar Peminjam</a></li>
                <li><a href="tambah.php">Tambah Peminjam</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Daftar Peminjam</h2>

            <?php if ($flash): ?>
                <div class="alert alert-<?php echo htmlspecialchars($flash['type']); ?>">
                    <p><?php echo htmlspecialchars($flash['pesan']); ?></p>
                </div>
            <?php endif; ?>

            <?php if (empty($peminjamList)): ?>
                <p>Belum ada data peminjam yang tersimpan.</p>
            <?php else: ?>
                <table border="1" cellpadding="8" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>OKI</th>
                            <th>No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peminjamList as $index => $item): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($item['nim']); ?></td>
                                <td><?php echo htmlspecialchars($item['nama']); ?></td>
                                <td><?php echo htmlspecialchars($item['oki']); ?></td>
                                <td><?php echo htmlspecialchars($item['no_hp']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>© <?php echo date('Y'); ?> SITARIS HMTI — Jobsheet 7</p>
    </footer>

    <script src="../assets/js/app.js"></script>
</body>
</html>