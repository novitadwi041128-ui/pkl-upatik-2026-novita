<?php
require_once 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM kelas WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: daftar-kelas.php');
    exit;
}

// Mengambil data kelas digabung (JOIN) dengan nama jurusan supaya keterangannya jelas
$query = "SELECT kelas.*, jurusan.nama_jurusan 
          FROM kelas 
          JOIN jurusan ON kelas.id_jurusan = jurusan.id";
$stmt = $pdo->query($query);
$list_kelas = $stmt->fetchAll();
?>

<h3>Daftar Kelas</h3>
<a href="tambah-kelas.php">+ Tambah Kelas Baru</a><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; foreach ($list_kelas as $k): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($k['nama_kelas']); ?></td>
        <td><?= htmlspecialchars($k['nama_jurusan']); ?></td>
        <td>
            <a href="daftar-kelas.php?hapus=<?= $k['id']; ?>" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="index.php">← Kembali ke Menu Utama</a>