<?php
require __DIR__ . '/../layouts/auth.php'; 
require __DIR__ . '/../layouts/koneksi.php'; // [BARU] koneksi PDO kini dipakai

// 1. Ambil & bersihkan input (trim), sama seperti referensi
$namaBarang = trim($_POST['nama_barang'] ?? '');
$kategori   = trim($_POST['kategori'] ?? '');
$kondisi    = trim($_POST['kondisi'] ?? '');
$status     = trim($_POST['status'] ?? '');
$jumlah     = $_POST['jumlah'] ?? '';

// 2. [SAMA DENGAN REFERENSI] Validasi SERVER-side wajib ada meskipun
//    form sudah divalidasi JS, karena validasi client bisa dilewati
//    (nonaktifkan JS / kirim request manual).
$errors = [];
if ($namaBarang === '') {
    $errors[] = "Nama barang wajib diisi.";
}
if ($jumlah === '' || !is_numeric($jumlah) || $jumlah < 0) {
    $errors[] = "Jumlah harus berupa angka dan tidak boleh negatif.";
}
// Catatan: kategori/kondisi/status adalah <select> yang selalu punya
// opsi terpilih, jadi tidak divalidasi "wajib" — membebani alur tanpa
// nilai; referensi juga hanya memvalidasi field yang bisa kosong.

if (!empty($errors)) {
    // [POLA REFERENSI] Simpan pesan ke flash session, kembali ke form.
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

// 3. [BARU - meniru INSERT referensi] Prepared statement dengan named
//    parameter (:nama_barang dst) mencegah SQL injection karena nilai
//    user tidak pernah ditempel langsung ke string SQL.
$stmt = $pdo->prepare(
    "INSERT INTO barang (nama_barang, kategori, kondisi, status, jumlah)
     VALUES (:nama_barang, :kategori, :kondisi, :status, :jumlah)"
);
$stmt->execute([
    'nama_barang' => $namaBarang,
    'kategori'    => $kategori,
    'kondisi'     => $kondisi,
    'status'      => $status,
    'jumlah'      => (int) $jumlah, // cast ke integer, sama seperti referensi
]);

// 4. [CATATAN PERBEDAAN] Referensi (PostgreSQL) memakai `RETURNING id`
//    untuk mendapatkan id baris baru. MySQL tidak mendukung RETURNING,
//    padanannya adalah lastInsertId().
$newId = $pdo->lastInsertId();

// 5. [POLA REFERENSI] Flash sukses lalu redirect ke list (PRG:
//    Post -> Redirect -> Get), supaya refresh tidak mengirim data dua kali.
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Barang berhasil ditambahkan.'];
header('Location: list.php');
exit;
