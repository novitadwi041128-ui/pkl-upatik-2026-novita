<?php
require_once 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM siswa WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: daftar-siswa.php');
    exit;
}

// Konfigurasi Pagination
$batas = 5; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// Menangkap keyword pencarian
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// Hitung total data untuk pagination
if ($cari != '') {
    $stmt_jml = $pdo->prepare("SELECT COUNT(*) FROM siswa s WHERE s.nama LIKE ?");
    $stmt_jml->execute(["%$cari%"]);
} else {
    $stmt_jml = $pdo->query("SELECT COUNT(*) FROM siswa");
}
$jumlah_data = $stmt_jml->fetchColumn();
$total_halaman = ceil($jumlah_data / $batas);

// Query utama dengan JOIN, Pencarian, dan LIMIT OFFSET
$query = "SELECT s.id, s.nama, s.email, s.tanggal_daftar, k.nama_kelas, j.nama_jurusan 
          FROM siswa s 
          JOIN kelas k ON s.id_kelas = k.id 
          JOIN jurusan j ON k.id_jurusan = j.id";

if ($cari != '') {
    $query .= " WHERE s.nama LIKE ? LIMIT $halaman_awal, $batas";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$cari%"]);
} else {
    $query .= " LIMIT $halaman_awal, $batas";
    $stmt = $pdo->query($query);
}

$list_siswa = $stmt->fetchAll();
?>

<h3>Daftar Siswa</h3>
<a href="tambah-siswa.php">+ Tambah Siswa Baru</a> | 
<a href="rekap-siswa.php">📊 Lihat Rekap Siswa</a><br><br>

<!-- Form Pencarian -->
<form method="GET" action="">
    <input type="text" name="cari" placeholder="Cari nama siswa..." value="<?= htmlspecialchars($cari); ?>">
    <button type="submit">Cari</button>
    <?php if ($cari != ''): ?>
        <a href="daftar-siswa.php">Reset</a>
    <?php endif; ?>
</form>
<br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Tanggal Daftar</th>
        <th>Aksi</th>
    </tr>
    <?php if (count($list_siswa) > 0): ?>
        <?php $no = $halaman_awal + 1; foreach ($list_siswa as $s): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($s['nama']); ?></td>
            <td><?= htmlspecialchars($s['email']); ?></td>
            <td><?= htmlspecialchars($s['nama_kelas']); ?></td>
            <td><?= htmlspecialchars($s['nama_jurusan']); ?></td>
            <td><?= htmlspecialchars($s['tanggal_daftar']); ?></td>
            <td>
                <a href="edit-siswa.php?id=<?= $s['id']; ?>">Edit</a> | 
                <a href="daftar-siswa.php?hapus=<?= $s['id']; ?>" onclick="return confirm('Yakin ingin menghapus data siswa ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" align="center">Data siswa tidak ditemukan.</td>
        </tr>
    <?php endif; ?>
</table>

<br>
<!-- Navigasi Pagination -->
<div>
    <span>Halaman: </span>
    <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
        <?php if ($i == $halaman): ?>
            <strong>[<?= $i; ?>]</strong>
        <?php else: ?>
            <a href="daftar-siswa.php?halaman=<?= $i; ?><?= $cari != '' ? '&cari=' . urlencode($cari) : ''; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>

<br>
<a href="index.php">← Kembali ke Menu Utama</a>