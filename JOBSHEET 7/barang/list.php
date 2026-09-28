<?php
// Set judul halaman secara dinamis
$pageTitle = "SITARIS HMTI | Daftar Barang";
// Sertakan file header
include '../layouts/header.php'; 
?>

<main>
    <section>
        <h2>Daftar Barang</h2>     
        
        <!-- Kolom Pencarian -->
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
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan dimuat melalui JavaScript atau Fetch API dari PHP Backend -->
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
// Menambahkan script khusus halaman ini sebelum footer dipanggil
$extraScripts = '<script src="../assets/js/barang.js"></script>';
// Sertakan file footer
include '../layouts/footer.php'; 
?>