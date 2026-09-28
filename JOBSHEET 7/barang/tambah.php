<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SITARIS HMTI | Tambah Barang</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>SITARIS HMTI</h1>
        <!-- Tombol hamburger ditambahkan -->
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="list.php">Daftar Barang</a></li>
                <li><a href="tambah.php">Tambah Barang</a></li>
                <li><a href="../peminjam/list.php">Daftar Peminjam</a></li>
                <li><a href="../peminjam/tambah.php">Tambah Peminjam</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Tambah Barang</h2>
            <!-- Mengarahkan form ke proses simpan/action PHP -->
            <form id="form-tambah" action="proses_tambah.php" method="POST" novalidate>
                <p> 
                    <label for="nama_barang">Nama Barang</label><br> 
                    <input type="text" id="nama_barang" name="nama_barang" required> 
                </p> 
                 
                <p> 
                    <label for="kategori">Kategori</label><br> 
                    <select id="kategori" name="kategori"> 
                        <option value="elektronik">Elektronik</option> 
                        <option value="furnitur">Furnitur</option> 
                        <option value="alat-kebersihan">Alat Kebersihan</option> 
                        <option value="lainnya">Lainnya</option> 
                    </select> 
                </p> 
                 
                <p> 
                    <label for="kondisi">Kondisi</label><br> 
                    <select id="kondisi" name="kondisi"> 
                        <option value="baik">Baik</option> 
                        <option value="rusak">Rusak</option> 
                    </select> 
                </p> 
                 
                <p> 
                    <label for="status">Status</label><br> 
                    <select id="status" name="status"> 
                        <option value="tersedia">Tersedia</option> 
                        <option value="dipinjam">Dipinjam</option> 
                    </select> 
                </p> 
                 
                <p> 
                    <label for="jumlah">Jumlah</label><br> 
                    <input type="number" id="jumlah" name="jumlah" min="0"> 
                </p> 
                <p> 
                    <button type="submit" name="submit">Simpan</button> 
                </p> 
            </form>
        </section>
    </main>

    <footer>
        <p>© <?php echo date('Y'); ?> SITARIS HMTI — Jobsheet 7</p>
    </footer>

    <!-- Tag script JS -->
    <script src="../assets/js/app.js"></script>
</body>
</html>