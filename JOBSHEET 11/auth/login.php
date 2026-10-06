<?php
// =====================================================================
// [BARU] auth/login.php — form login petugas.
// =====================================================================
$page_title = "Login";

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
            <h2>Login Petugas</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
            <?php endif; ?>

            <form method="post" action="proses_login.php">
                <p>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </p>
                <p>
                    <button type="submit">Login</button>
                </p>
                <p>Belum punya akun? <a href="register.php">Register di sini</a>.</p>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
