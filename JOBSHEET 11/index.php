<?php
// =====================================================================
// [PERUBAHAN] index.php — versinya sekarang meniru index.php referensi:
// halaman BERANDA berupa ringkasan, bukan lagi daftar peminjam dari
// $_SESSION. Data total dibaca langsung dari database dengan query
// SELECT COUNT(*), sama seperti referensi membaca total buku & anggota.
// =====================================================================
$page_title = "Beranda";
include __DIR__ . '/layouts/header.php';   // pola include sama dengan referensi
require __DIR__ . '/layouts/koneksi.php';  // [PERUBAHAN] koneksi PDO kini benar-benar dipakai

// [BARU - meniru referensi] Menghitung jumlah baris tabel lewat SQL,
// fetchColumn() mengambil kolom pertama dari hasil COUNT(*).
$totalBarang   = $pdo->query("SELECT COUNT(*) FROM barang")->fetchColumn();
$totalPeminjam = $pdo->query("SELECT COUNT(*) FROM peminjam")->fetchColumn();

// [PERBEDAAN DENGAN REFERENSI] Di referensi "Sedang Dipinjam" masih
// hardcode 0. Karena tabel barang punya kolom status, angka ini kita
// hitung sungguhan dari database: barang dengan status 'dipinjam'.
$sedangDipinjam = $pdo->query("SELECT COUNT(*) FROM barang WHERE status = 'dipinjam'")->fetchColumn();
?>
        <section>
            <h2>Selamat Datang di SITARIS HMTI</h2>
            <p>Aplikasi sederhana untuk mengelola data barang dan peminjam organisasi HMTI.</p>
        </section>

        <section>
            <h2>Ringkasan</h2>
            <!-- [KOTAK RINGKASAN] Menggunakan class .dashboard-grid dan
                 .card-stat milik style.css project sendiri (sudah ada dari
                 awal), karena style project tidak mengenal tag <article>
                 polos yang dipakai referensi. Alur datanya tetap sama:
                 angka diambil dari hasil query COUNT(*). -->
            <div class="dashboard-grid">
                <div class="card-stat">
                    <h3>Total Barang</h3>
                    <p><?php echo $totalBarang; ?></p>
                </div>
                <div class="card-stat">
                    <h3>Total Peminjam</h3>
                    <p><?php echo $totalPeminjam; ?></p>
                </div>
                <div class="card-stat">
                    <h3>Sedang Dipinjam</h3>
                    <p><?php echo $sedangDipinjam; ?></p>
                </div>
            </div>
        </section>
<?php include __DIR__ . '/layouts/footer.php'; ?>
