<?php
require_once 'koneksi.php';

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $kelas = trim($_POST['kelas']);
    $tgl_daftar = date('Y-m-d'); // Tambahkan tanggal otomatis hari ini

    if (!empty($nama) && !empty($email) && !empty($kelas)) {
        try {
            // Masukkan tgl_daftar juga ke dalam query SQL
            $stmt = $pdo->prepare("INSERT INTO siswa (nama, email, kelas, tgl_daftar) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nama, $email, $kelas, $tgl_daftar]);

            header('Location: daftar-siswa.php');
            exit;
        } catch (PDOException $e) {
            $pesan = "Gagal menyimpan data: " . $e->getMessage();
        }
    } else {
        $pesan = "Semua kolom wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa - CRUD Pertama</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 500px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px; }
        button:hover { background: #218838; }
        .error { color: red; margin-bottom: 15px; }
        a { display: inline-block; margin-top: 15px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Siswa Baru</h2>

    <!-- Tampilkan pesan error jika validasi gagal -->
    <?php if (!empty($pesan)): ?>
        <div class="error"><?= $pesan; ?></div>
    <?php endif; ?>

    <!-- Form Input Data -->
    <form action="" method="POST">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Kelas:</label>
            <input type="text" name="kelas" required>
        </div>
        <button type="submit">Simpan Data</button>
    </form>

    <a href="daftar-siswa.php">&larr; Kembali ke Daftar Siswa</a>
</div>

</body>
</html>