<?php
require_once 'koneksi.php';

// Proses hapus data jika tombol hapus diklik
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM jurusan WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: daftar-jurusan.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM jurusan");
$list_jurusan = $stmt->fetchAll();
?>

<h3>Daftar Jurusan</h3>
<a href="tambah-jurusan.php">+ Tambah Jurusan Baru</a><br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Jurusan</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; foreach ($list_jurusan as $j): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($j['nama_jurusan']); ?></td>
        <td>
            <a href="daftar-jurusan.php?hapus=<?= $j['id']; ?>" onclick="return confirm('Yakin ingin menghapus jurusan ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="index.php">← Kembali ke Menu Utama</a>