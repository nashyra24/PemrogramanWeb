<?php
// =====================================================================
// [PERUBAHAN] koneksi.php — meniru alur includes/koneksi.php referensi.
// Di versi lama file ini ADA tapi TIDAK PERNAH dipakai halaman mana pun
// (data hanya disimpan di $_SESSION dan file JSON). Sekarang file ini
// di-require oleh index.php, list.php dan proses_tambah.php, persis
// seperti pola referensi (buku & anggota memakai $pdo yang sama).
// Catatan: referensi memakai PostgreSQL (pgsql); project ini memakai
// MySQL/MariaDB bawaan XAMPP, jadi driver dan port yang berbeda.
// =====================================================================

$host = "localhost";
$port = "3306";            // port default MySQL/XAMPP (referensi: 5432 untuk PostgreSQL)
$db   = "sitaris_hmti";    // database yang dibuat lewat sql/01_barang_peminjam.sql
$user = "root";
$pass = "";                // password default XAMPP kosong

try {
    // Membuat koneksi PDO. Charset utf8mb4 ditambahkan karena MySQL
    // memerlukan deklarasi charset eksplisit (PostgreSQL tidak).
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);

    // [PENTING, sama seperti referensi] Jika query error, lempar exception
    // supaya error tidak diam-diam menghasilkan tabel kosong.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tambahan kenyamanan khas MySQL: hasil fetch berupa array asosiatif
    // berkey nama kolom, sehingga tidak perlu menulis PDO::FETCH_ASSOC
    // berulang kali (di referensi ditulis eksplisit di setiap fetch).
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Pola sama dengan referensi: hentikan script dengan pesan jelas.
    die("Koneksi database gagal: " . $e->getMessage());
}
