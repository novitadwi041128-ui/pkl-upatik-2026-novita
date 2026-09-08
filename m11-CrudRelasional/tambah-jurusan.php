<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_jurusan = $_POST['nama_jurusan'];

    $stmt = $pdo->prepare("INSERT INTO jurusan (nama_jurusan) VALUES (?)");
    $stmt->execute([$nama_jurusan]);

    header('Location: daftar-jurusan.php');
    exit;
}
?>

<h3>Tambah Jurusan Baru</h3>
<form method="POST">
    <label>Nama Jurusan:</label><br>
    <input type="text" name="nama_jurusan" required><br><br>
    
    <button type="submit">Simpan Jurusan</button>
</form>
<br>
<a href="daftar-jurusan.php">← Kembali ke Daftar Jurusan</a>