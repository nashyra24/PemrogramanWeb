<?php
// =====================================================================
// [BARU] auth/proses_register.php — memproses form register.
// Alur: ambil input -> validasi -> cek username duplikat ->
//       password_hash() -> INSERT -> flash + redirect (pola PRG).
// =====================================================================
session_start();
require __DIR__ . '/../layouts/koneksi.php';

// Hanya menerima POST; akses langsung lewat URL dikembalikan ke form.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// 1. Ambil & bersihkan input. Password TIDAK di-trim: spasi bisa jadi bagian password.
$nama       = trim($_POST['nama'] ?? '');
$username   = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi'] ?? '';

// 2. Validasi server-side
$errors = [];
if ($nama === '')     $errors[] = "Nama wajib diisi.";
if ($username === '') $errors[] = "Username wajib diisi.";
if ($username !== '' && !preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
    $errors[] = "Username 3-50 karakter, hanya huruf, angka, dan underscore.";
}
if (strlen($password) < 6)        $errors[] = "Password minimal 6 karakter.";
if ($password !== $konfirmasi)    $errors[] = "Konfirmasi password tidak sama.";

// 3. Cek username duplikat (hanya jika format username sudah benar)
if (empty($errors)) {
    $cek = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $cek->execute(['username' => $username]);
    if ($cek->fetchColumn() > 0) {
        $errors[] = "Username \"$username\" sudah dipakai, pilih username lain.";
    }
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

// 4. Simpan. password_hash() menghasilkan hash bcrypt + salt otomatis;
//    password asli TIDAK PERNAH disimpan ke database.
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare(
        "INSERT INTO users (nama, username, password, role)
         VALUES (:nama, :username, :password, 'petugas')"
    );
    $stmt->execute([
        'nama'     => $nama,
        'username' => $username,
        'password' => $hash,
    ]);
} catch (PDOException $e) {
    // Sabuk pengaman: dua orang mendaftar username sama bersamaan lolos
    // pengecekan di atas, tapi ditolak constraint UNIQUE (SQLSTATE 23000).
    if ($e->getCode() === '23000') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => "Username \"$username\" sudah dipakai, pilih username lain."];
        header('Location: register.php');
        exit;
    }
    throw $e; // error lain: jangan disembunyikan
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil. Silakan login.'];
header('Location: login.php');
exit;
