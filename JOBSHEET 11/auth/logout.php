<?php
// =====================================================================
// [BARU] auth/logout.php — mengakhiri session petugas.
// =====================================================================
session_start();

$_SESSION = [];     // kosongkan data session
session_destroy();  // hapus session di server

// session_destroy() menghapus flash juga, jadi mulai session baru
// yang bersih khusus untuk membawa pesan "berhasil logout".
session_start();
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anda telah logout.'];

header('Location: login.php');
exit;
