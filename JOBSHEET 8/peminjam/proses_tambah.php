<?php
session_start();

// Mengambil data dari form dengan proteksi nilai bawaan jika kosong
$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$oki = trim($_POST['oki'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

// Array untuk menyimpan pesan kesalahan validasi
$errors = [];

if ($nim === '') {
    $errors[] = "NIM wajib diisi.";
}
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}

// Jika terdapat error validasi, kirim flash message error dan kembalikan ke form
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => implode(' ', $errors)
    ];
    header('Location: tambah.php');
    exit;
}

// Inisialisasi session peminjam jika belum ada
if (!isset($_SESSION['peminjam'])) {
    $_SESSION['peminjam'] = [];
}

// Menyimpan data peminjam baru ke dalam session
$_SESSION['peminjam'][] = [
    'nim' => $nim,
    'nama' => $nama,
    'oki' => $oki,
    'no_hp' => $noHp,
];

// Set pesan sukses dan alihkan ke halaman daftar peminjam
$_SESSION['flash'] = [
    'type' => 'success', 
    'pesan' => 'Peminjam berhasil ditambahkan.'
];

header('Location: list.php');
exit;