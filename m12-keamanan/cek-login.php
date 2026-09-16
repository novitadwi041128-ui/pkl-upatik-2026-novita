<?php
// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum login, tendang (redirect) ke halaman login
    header("Location: login.php?pesan=belum_login");
    exit;
}
?>