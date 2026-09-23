<?php
// 1. Panggil koneksi dan model
require_once 'koneksi.php';
require_once 'SiswaModel.php';

// 2. Inisialisasi object SiswaModel dengan mengirim koneksi PDO
$siswaModel = new SiswaModel($pdo);

// 3. Ambil data siswa (yang sudah di-JOIN dengan kelas dan jurusan)
$dataSiswa = $siswaModel->ambilSemua();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa (Mini-MVC)</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #e2f0d9; }
    </style>
</head>
<body>

<h2>Daftar Siswa (dari Model)</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Tgl Daftar</th>
    </tr>
    
    <?php 
    $no = 1; 
    foreach ($dataSiswa as $siswa): 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($siswa['nama']); ?></td>
        <td><?= htmlspecialchars($siswa['email']); ?></td>
        <!-- Kolom tambahan hasil JOIN model -->
        <td><?= htmlspecialchars($siswa['nama_kelas']); ?></td>
        <td><?= htmlspecialchars($siswa['nama_jurusan']); ?></td>
        <td><?= htmlspecialchars($siswa['tanggal_daftar'] ?? '-'); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>