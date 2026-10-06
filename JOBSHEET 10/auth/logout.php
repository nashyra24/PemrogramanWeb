<?php
// [BARU] auth/logout.php — akhiri session petugas.
session_start();
$_SESSION = [];
session_destroy();
header('Location: login.php');
exit;
