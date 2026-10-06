<?php
require __DIR__ . '/../layouts/auth.php'; 
$page_title = "Daftar Peminjam";
include __DIR__ . '/../layouts/header.php';
require __DIR__ . '/../layouts/koneksi.php';


$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarPeminjam = $pdo->query("SELECT * FROM peminjam ORDER BY id DESC")->fetchAll();
?>
        <section>
            <h2>Daftar Peminjam</h2>

            
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

           
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
                            <?php ?>
                            <td><?php echo htmlspecialchars($peminjam['nim']); ?></td>
                            <td><?php echo htmlspecialchars($peminjam['nama']); ?></td>
                            <td><?php echo htmlspecialchars($peminjam['oki']); ?></td>
                            <td><?php echo htmlspecialchars($peminjam['no_hp']); ?></td>
                            <td>
                                
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
