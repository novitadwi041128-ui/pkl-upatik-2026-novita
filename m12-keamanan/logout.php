<?php
session_start(); // Memulai session yang sedang aktif

// 1. Kosongkan semua array session
$_SESSION = array();

// 2. Hancurkan session dari server
session_destroy();

// 3. Redirect kembali ke halaman login
header("Location: login.php");
exit;
?>