<?php
// =====================================================================
// [PERUBAHAN] barang/tambah.php — versinya sekarang meng-include
// header/footer bersama (meniru buku/tambah.php referensi), bukan lagi
// menyalin-tempel HTML penuh sehingga navigasi konsisten.
// =====================================================================
$page_title = "Tambah Barang";
include __DIR__ . '/../layouts/header.php';

// [BUG LAMA DIPERBAIKI] Halaman ini kini MENAMPILKAN flash error.
// Di versi lama, proses_tambah.php mengirim balik ke sini berisi flash
// "Nama barang wajib diisi", tapi flash tidak pernah dirender sehingga
// pesan error hilang tanpa jejak — sama seperti pola di referensi.
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Barang</h2>

            <!-- Flash memakai class .flash milik referensi -->
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <!-- Form POST ke proses_tambah.php, pola sama dengan referensi -->
            <form id="form-tambah" method="post" action="proses_tambah.php">
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
                    <input type="number" id="jumlah" name="jumlah" min="0" required>
                </p>
                <p>
                    <button type="submit">Simpan</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
