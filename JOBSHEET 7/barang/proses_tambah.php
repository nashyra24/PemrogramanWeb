<?php
session_start();

// Mengambil data dari form
$nama_barang = trim($_POST['nama_barang'] ?? '');
$kategori    = trim($_POST['kategori'] ?? '');
$kondisi     = trim($_POST['kondisi'] ?? '');
$status      = trim($_POST['status'] ?? '');
$jumlah      = $_POST['jumlah'] ?? '';

// Validasi server-side
$errors = [];

if ($nama_barang === '') {
    $errors[] = "Nama barang wajib diisi.";
}

if ($kategori === '') {
    $errors[] = "Kategori wajib dipilih.";
}

if ($kondisi === '') {
    $errors[] = "Kondisi wajib dipilih.";
}

if ($status === '') {
    $errors[] = "Status wajib dipilih.";
}

if ($jumlah === '' || !is_numeric($jumlah) || $jumlah < 0) {
    $errors[] = "Jumlah barang harus berupa angka dan tidak boleh negatif.";
}

// Jika terdapat error validasi, simpan pesan error ke flash session dan kembalikan ke form
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type'  => 'error',
        'pesan' => implode(' ', $errors)
    ];
    header('Location: tambah.php');
    exit;
}

// Inisialisasi array session barang jika belum ada
if (!isset($_SESSION['barang'])) {
    $_SESSION['barang'] = [];
}

// Simpan data barang baru ke dalam session
$_SESSION['barang'][] = [
    'nama_barang' => $nama_barang,
    'kategori'    => $kategori,
    'kondisi'     => $kondisi,
    'status'      => $status,
    'jumlah'      => (int) $jumlah,
];

// Set pesan sukses dan redirect ke halaman daftar barang
$_SESSION['flash'] = [
    'type'  => 'success',
    'pesan' => 'Barang berhasil ditambahkan.'
];
header('Location: list.php');
exit;