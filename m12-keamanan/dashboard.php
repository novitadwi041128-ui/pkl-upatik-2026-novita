<?php
require_once 'cek-login.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Terproteksi</title>
</head>
<body>
    <h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Halaman ini sekarang sudah diproteksi menggunakan file <code>cek_login.php</code>.</p>
    <a href="logout.php">Logout</a>
    <hr>
    <h3>Menu Navigasi & Hak Akses</h3>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <!-- Tombol khusus untuk Admin -->
        <p style="color: green;"><b>Panel Admin:</b> Anda memiliki akses penuh.</p>
        <button>+ Tambah Data Siswa</button>
        <button>Edit Data</button>
        <button>Hapus Data</button>
    <?php else: ?>
        <!-- Tampilan untuk User Biasa -->
        <p style="color: blue;"><b>Panel Pengguna:</b> Anda hanya dapat melihat data.</p>
        <p><i>(Tombol tambah/edit/hapus disembunyikan karena hak akses Anda dibatasi).</i></p>
    <?php endif; ?>

    <hr>
    <h3>Keamanan Form (CSRF Protection)</h3>
    <?php
    // 1. Buat token CSRF jika belum ada di session
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // 2. Cek saat form dikirim (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi_hapus'])) {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo "<p style='color: red;'>Peringatan: Gagal verifikasi CSRF Token! Aksi ditolak.</p>";
        } else {
            echo "<p style='color: green;'>Sukses: Token valid, aksi penghapusan diizinkan!</p>";
        }
    }
    ?>

    <!-- Form dengan Token CSRF Tersembunyi -->
    <form action="" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit" name="aksi_hapus">Hapus Data Aman (Uji CSRF)</button>
    </form>
</body>
</html>