<?php
// =====================================================================
// [BARU] auth/proses_login.php — memverifikasi username & password.
// =====================================================================
session_start();
require __DIR__ . '/../layouts/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// 1. Ambil user berdasarkan username (prepared statement -> aman dari SQL injection)
$stmt = $pdo->prepare("SELECT id, nama, username, password, role FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(); // false bila username tidak ditemukan

// 2. password_verify() membandingkan password input dengan hash di database.
//    Pesan error sengaja SAMA untuk "username salah" dan "password salah"
//    supaya penyerang tidak bisa menebak username mana yang terdaftar.
if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau password salah.'];
    header('Location: login.php');
    exit;
}

// 3. Login sukses. Ganti ID session untuk mencegah session fixation.
session_regenerate_id(true);
$_SESSION['user_id']  = $user['id'];
$_SESSION['nama']     = $user['nama'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];

header('Location: ../index.php');
exit;
