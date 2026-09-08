<?php
require_once 'koneksi.php';

// Query rekap jumlah siswa per kelas menggunakan GROUP BY dan fungsi COUNT()
$query = "SELECT k.nama_kelas, j.nama_jurusan, COUNT(s.id) as jumlah_siswa 
          FROM kelas k 
          JOIN jurusan j ON k.id_jurusan = j.id 
          LEFT JOIN siswa s ON k.id = s.id_kelas 
          GROUP BY k.id";
$stmt = $pdo->query($query);
$rekap_kelas = $stmt->fetchAll();
?>

<h3>Rekap Jumlah Siswa per Kelas</h3>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Jumlah Siswa</th>
    </tr>
    <?php $no = 1; foreach ($rekap_kelas as $r): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($r['nama_kelas']); ?></td>
        <td><?= htmlspecialchars($r['nama_jurusan']); ?></td>
        <td><?= htmlspecialchars($r['jumlah_siswa']); ?> Orang</td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="daftar-siswa.php">← Kembali ke Daftar Siswa</a> | 
<a href="index.php">Menu Utama</a>