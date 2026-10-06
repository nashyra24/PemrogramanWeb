<?php
// =====================================================================
// [BARU] layouts/auth.php — guard clause: halaman yang meng-include file
// ini hanya bisa diakses setelah login.
//
// WAJIB di-include sebagai BARIS PERTAMA halaman (sebelum header.php).
// Alasan: header('Location: ...') hanya bisa dipanggil selama belum ada
// output HTML sama sekali. header.php mencetak <!DOCTYPE html>, jadi
// jika auth.php diletakkan sesudahnya, redirect gagal ("headers already sent").
// =====================================================================

// Sama dengan header.php: hanya mulai session bila belum aktif,
// supaya tidak muncul notice "session already active".
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // Hitung prefix relatif ke root proyek (logika sama dengan $base di
    // header.php; dihitung ulang di sini karena header.php belum dimuat).
    $__root = dirname(__DIR__);
    $__dir  = dirname($_SERVER['SCRIPT_FILENAME']);
    $__rel  = ltrim(str_replace('\\', '/', substr($__dir, strlen($__root))), '/');
    $__base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu.'];
    header('Location: ' . $__base . 'auth/login.php');
    exit; // wajib: hentikan script agar isi halaman terkunci tidak ikut dieksekusi
}
