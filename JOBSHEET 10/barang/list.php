<?php

$page_title = "Daftar Barang";
include __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/koneksi.php';


$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// [BARU - meniru referensi] Ambil semua barang dari database,
// urut id DESC agar data terbaru tampil paling atas.
$daftarBarang = $pdo->query("SELECT * FROM barang ORDER BY id DESC")->fetchAll();
?>
        <section>
            <h2>Daftar Barang</h2>

            <!-- Flash memakai class .flash milik referensi (sudah
                 ditambahkan ke style.css project) + escape htmlspecialchars -->
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <!-- [STYLE LAMA] Search-box project awal (counter + label "Cari");
                 filtrasi tetap client-side via app.js (initTableFilter) -->
            <div class="search-box">
                <p id="table-counter" style="font-size: 0.9rem; color: #555; margin-bottom: 0.5rem;"></p>
                <label for="search-input">Cari</label>
                <input type="text" id="search-input" placeholder="Ketik kata kunci...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <?php if (isset($_SESSION['user_id'])): ?><th>Aksi</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBarang)): ?>
                    <!-- [BARU] State kosong, meniru pesan "Belum ada data" di referensi -->
                    <tr>
                        <td colspan="<?php echo isset($_SESSION['user_id']) ? 6 : 5; ?>">Belum ada data barang. Silakan tambah lewat menu "Tambah Barang".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBarang as $barang): ?>
                        <tr>
                            <?php
                            // [PERBAIKAN KEAMANAN] Semua output dinamis dibungkus
                            // htmlspecialchars() untuk mencegah XSS dari data yang
                            // tersimpan di database (JS lama merakit innerHTML
                            // tanpa escape).
                            ?>
                            <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                            <td><?php echo htmlspecialchars($barang['kategori']); ?></td>
                            <td><?php echo htmlspecialchars($barang['kondisi']); ?></td>
                            <td><?php echo htmlspecialchars($barang['status']); ?></td>
                            <td><?php echo $barang['jumlah']; ?></td>
                            <?php if (isset($_SESSION['user_id'])): ?>
                            <td>
                                <!-- [Jobsheet 9] Aksi hanya tampil untuk petugas login; Tamu hanya melihat katalog -->
                                <button type="button">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
