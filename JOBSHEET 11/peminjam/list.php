<?php
// =====================================================================
// [PERUBAHAN] peminjam/list.php — meniru alur anggota/list.php referensi.
// Versi lama adalah HTML hasil salin-tempel (tidak memakai layouts/)
// dan tbody-nya diisi JavaScript dengan fetch ../data/peminjam.json.
// Sekarang: pakai header/footer bersama + render tabel dari database
// lewat SELECT, persis referensi. Tampilan search-box tetap style lama.
// =====================================================================
$page_title = "Daftar Peminjam";
include __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/koneksi.php';

// [BUG LAMA DIPERBAIKI] Flash success/error kini dibaca & ditampilkan
// lalu di-unset — versi lama tidak pernah menampilkannya.
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// [BARU - meniru referensi] Ambil semua peminjam dari database.
$daftarPeminjam = $pdo->query("SELECT * FROM peminjam ORDER BY id DESC")->fetchAll();
?>
        <section>
            <h2>Daftar Peminjam</h2>

            <!-- Flash memakai class .flash milik referensi (sudah
                 ditambahkan ke style.css project) + escape htmlspecialchars -->
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <!-- [STYLE LAMA] Search-box project awal (counter + label "Cari") -->
            <div class="search-box">
                <p id="table-counter" style="font-size: 0.9rem; color: #555; margin-bottom: 0.5rem;"></p>
                <label for="search-input">Cari</label>
                <input type="text" id="search-input" placeholder="Ketik kata kunci...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>OKI</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarPeminjam)): ?>
                    <tr>
                        <td colspan="5">Belum ada data peminjam. Silakan tambah lewat menu "Tambah Peminjam".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarPeminjam as $peminjam): ?>
                        <tr>
                            <?php // htmlspecialchars() untuk mencegah XSS dari data database ?>
                            <td><?php echo htmlspecialchars($peminjam['nim']); ?></td>
                            <td><?php echo htmlspecialchars($peminjam['nama']); ?></td>
                            <td><?php echo htmlspecialchars($peminjam['oki']); ?></td>
                            <td><?php echo htmlspecialchars($peminjam['no_hp']); ?></td>
                            <td>
                                <!-- Sama seperti referensi: tombol masih dummy, aksi ke server belum dibuat -->
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
