<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    
    $__root   = dirname(__DIR__);
    $__dir    = dirname($_SERVER['SCRIPT_FILENAME']);
    $__rel    = ltrim(str_replace('\\', '/', substr($__dir, strlen($__root))), '/');
    $__prefix = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu.'];
    header('Location: ' . $__prefix . 'auth/login.php');
    exit;
}
