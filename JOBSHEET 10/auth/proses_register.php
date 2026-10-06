<?php
// [BARU] auth/proses_register.php — simpan petugas baru.
// Password disimpan dengan password_hash(), TIDAK PERNAH sebagai teks asli.
session_start();
require __DIR__ . '/../layouts/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nama       = trim($_POST['nama'] ?? '');
$username   = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

// 1. Validasi server-side
$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
    $errors[] = "Username 3-30 karakter, hanya huruf, angka, dan underscore.";
}
if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}
if ($password !== $konfirmasi) {
    $errors[] = "Konfirmasi password tidak sama.";
}

// 2. Cek username duplikat
if (empty($errors)) {
    $cek = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $cek->execute(['username' => $username]);
    if ($cek->fetchColumn() > 0) {
        $errors[] = "Username sudah dipakai, silakan pilih yang lain.";
    }
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

// 3. Simpan. Role TIDAK diambil dari form (agar tidak bisa dipalsukan
//    jadi 'admin'); pendaftar baru selalu 'petugas'.
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare(
    "INSERT INTO users (nama, username, password, role)
     VALUES (:nama, :username, :password, 'petugas')"
);
try {
    $stmt->execute([
        'nama'     => $nama,
        'username' => $username,
        'password' => $hash,
    ]);
} catch (PDOException $e) {
    // 23000 = pelanggaran UNIQUE (dua pendaftar dengan username sama bersamaan)
    if ($e->getCode() === '23000') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah dipakai, silakan pilih yang lain.'];
        header('Location: register.php');
        exit;
    }
    throw $e;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil. Silakan login.'];
header('Location: login.php');
exit;
