<?php
// =====================================================================
// [BARU] auth/register.php — form pendaftaran petugas.
// Role TIDAK diminta dari form (user bisa memanipulasi request), semua
// akun baru otomatis berrole 'petugas' di proses_register.php.
// =====================================================================
$page_title = "Register";

// Cek status login SEBELUM header.php: header.php mencetak HTML, setelah itu
// header('Location: ...') tidak bisa dipanggil lagi. Session dimulai manual
// di sini (aman, karena header.php nanti mengecek session_status() dulu).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');   // sudah login, tidak perlu form ini
    exit;
}

include __DIR__ . '/../layouts/header.php';


$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Register Petugas</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <form method="post" action="proses_register.php">
                <p>
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password (minimal 6 karakter)</label>
                    <input type="password" id="password" name="password" minlength="6" required>
                </p>
                <p>
                    <label for="konfirmasi">Konfirmasi Password</label>
                    <input type="password" id="konfirmasi" name="konfirmasi" minlength="6" required>
                </p>
                <p>
                    <button type="submit">Daftar</button>
                </p>
                <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
