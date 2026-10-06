<?php
// [BARU] auth/register.php — form pendaftaran petugas (publik).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Register";
include __DIR__ . '/../layouts/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Daftar Petugas</h2>

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
                    <input type="text" id="username" name="username" required minlength="3" maxlength="30">
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required minlength="6">
                </p>
                <p>
                    <label for="konfirmasi">Konfirmasi Password</label>
                    <input type="password" id="konfirmasi" name="konfirmasi" required minlength="6">
                </p>
                <p>
                    <button type="submit">Daftar</button>
                </p>
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
