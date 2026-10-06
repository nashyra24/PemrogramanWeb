<?php
require __DIR__ . '/../layouts/auth.php'; 
require __DIR__ . '/../layouts/koneksi.php'; 

// 1. Ambil & bersihkan input
$nama  = trim($_POST['nama'] ?? '');
$nim   = trim($_POST['nim'] ?? '');
$oki   = trim($_POST['oki'] ?? '');
$noHp  = trim($_POST['no_hp'] ?? '');


$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($nim === '') {
    $errors[] = "NIM wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}


$stmt = $pdo->prepare(
    "INSERT INTO peminjam (nama, nim, oki, no_hp)
     VALUES (:nama, :nim, :oki, :no_hp)"
);
$stmt->execute([
    'nama' => $nama,
    'nim'  => $nim,
    'oki'  => $oki,
    'no_hp' => $noHp,
]);

// 4. [CATATAN PERBEDAAN] Referensi memakai `RETURNING id` (PostgreSQL);
//    padanan MySQL adalah lastInsertId().
$newId = $pdo->lastInsertId();

// 5. Flash sukses + redirect ke list (pola PRG, sama dengan referensi)
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjam berhasil ditambahkan.'];
header('Location: list.php');
exit;
