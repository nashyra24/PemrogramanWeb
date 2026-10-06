<?php
require __DIR__ . '/../layouts/auth.php'; 
$page_title = "Tambah Peminjam";
include __DIR__ . '/../layouts/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Peminjam</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <form id="form-tambah" method="post" action="proses_tambah.php">
                <p>
                    <label for="nim">NIM</label><br>
                    <input type="text" id="nim" name="nim" required>
                </p>
                <p>
                    <label for="nama">Nama</label><br>
                    <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="oki">Nama OKI</label><br>
                    <select id="oki" name="oki">
                        <option value="HMTK">HMTK</option>
                        <option value="HMA">HMA</option>
                        <option value="PL FM">PL FM</option>
                        <option value="BEM">BEM</option>
                    </select>
                </p>
                <p>
                    <label for="no_hp">No. HP</label><br>
                    <input type="text" id="no_hp" name="no_hp">
                </p>
                <p>
                    <button type="submit">Simpan</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
