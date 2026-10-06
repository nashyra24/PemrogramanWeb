<?php
// =====================================================================
// [PERUBAHAN] peminjam/proses_tambah.php — inti Jobsheet 8.
// Versi lama menyimpan ke $_SESSION['peminjam'] yang hanya dibaca
// index.php; sekarang data di-INSERT ke tabel `peminjam` di MySQL
// lewat prepared statement, meniru anggota/proses_tambah.php referensi.
// =====================================================================
// [BARU Jobsheet 9] Proses simpan juga terkunci: auth.php WAJIB menjadi include pertama,
// sebelum header.php, agar redirect ke login masih bisa dikirim.
require __DIR__ . '/../layouts/auth.php';
// (auth.php sudah memulai session, jadi session_start() tidak perlu lagi.)
require __DIR__ . '/../layouts/koneksi.php'; // [BARU] koneksi PDO dipakai

// 1. Ambil & bersihkan input
$nama  = trim($_POST['nama'] ?? '');
$nim   = trim($_POST['nim'] ?? '');
$oki   = trim($_POST['oki'] ?? '');
$noHp  = trim($_POST['no_hp'] ?? '');

// 2. [SAMA DENGAN REFERENSI] Validasi server-side wajib ada meski
//    sudah ada validasi JS di client.
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

// 3. [BARU - meniru referensi] Prepared statement dengan named parameter.
//    Catatan: kolom `nim` dibuat UNIQUE di skema SQL (meniru no_anggota
//    UNIQUE di referensi). NIM duplikat akan memicu exception PDO —
//    penanganan error duplikat yang lebih ramah penguna belum dibuat,
//    sama seperti referensi yang juga belum menanganinya.
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
