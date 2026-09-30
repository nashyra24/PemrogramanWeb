<?php
// =====================================================================
// [PERUBAHAN] barang/list.php — meniru alur buku/list.php referensi.
// Versi lama: tbody kosong dan diharapkan diisi JavaScript dengan
// fetch ../data/barang.json — yang ternyata tidak pernah dimuat
// (bug footer) sehingga tabel selalu kosong. Sekarang data dirender
// langsung oleh PHP dari database lewat SELECT, persis referensi.
// Tampilan (search-box + counter) tetap memakai style lama project.
// =====================================================================
$page_title = "Daftar Barang";
include __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/koneksi.php';

// [BUG LAMA DIPERBAIKI] Flash message kini dibaca & ditampilkan di
// halaman ini, lalu di-unset supaya tidak muncul dua kali — pola
// identik dengan referensi (versi lama menyetel flash di
// proses_tambah.php tapi tidak pernah menampilkannya di sini).
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBarang)): ?>
                    <!-- [BARU] State kosong, meniru pesan "Belum ada data" di referensi -->
                    <tr>
                        <td colspan="6">Belum ada data barang. Silakan tambah lewat menu "Tambah Barang".</td>
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
                            <td>
                                <!-- Sama seperti referensi: tombol masih dummy, aksi Edit/Hapus ke server belum dibuat -->
                                <button type="button">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
