<?php
// Panggil file koneksi database
require_once 'koneksi.php';

// Ambil semua data dari tabel siswa
$stmt = $pdo->query("SELECT * FROM siswa");
$daftar_siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Siswa - CRUD Pertama</title>
    <style>
        body { font-family: sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h2>Daftar Siswa (Read dari Database)</h2>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Tanggal Daftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_siswa) > 0): ?>
            <?php foreach ($daftar_siswa as $siswa): ?>
            <tr>
                <td><?= htmlspecialchars($siswa['id']) ?></td>
                <td><?= htmlspecialchars($siswa['nama']) ?></td>
                <td><?= htmlspecialchars($siswa['email']) ?></td>
                <td><?= htmlspecialchars($siswa['kelas']) ?></td>
                <td><?= htmlspecialchars($siswa['tgl_daftar']) ?></td>
                <td>
                    <a href="edit-siswa.php?id=<?= $siswa['id']; ?>">Edit</a> | 
                    <a href="hapus-siswa.php?id=<?= $siswa['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada data siswa.</td>
            </tr>
        <?php endif; ?>
    </tbody>
    </table>

</body>
</html>