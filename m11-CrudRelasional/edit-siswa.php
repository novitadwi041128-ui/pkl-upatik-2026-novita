<?php
require_once 'koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id == '') {
    header('Location: daftar-siswa.php');
    exit;
}

// Ambil data siswa berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM siswa WHERE id = ?");
$stmt->execute([$id]);
$siswa = $stmt->fetch();

if (!$siswa) {
    header('Location: daftar-siswa.php');
    exit;
}

// Ambil data kelas untuk pilihan dropdown
$stmt_kelas = $pdo->query("SELECT * FROM kelas");
$daftar_kelas = $stmt_kelas->fetchAll();

// Proses form jika disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $id_kelas = $_POST['id_kelas'];

    $stmt_update = $pdo->prepare("UPDATE siswa SET nama = ?, email = ?, id_kelas = ? WHERE id = ?");
    $stmt_update->execute([$nama, $email, $id_kelas, $id]);

    header('Location: daftar-siswa.php');
    exit;
}
?>

<h3>Edit Data Siswa</h3>
<form method="POST" action="">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($siswa['email']); ?>" required><br><br>

    <label>Kelas:</label><br>
    <select name="id_kelas" required>
        <option value="">-- Pilih Kelas --</option>
        <?php foreach ($daftar_kelas as $k): ?>
            <!-- Menjaga agar kelas siswa saat ini terpilih (selected) -->
            <option value="<?= $k['id']; ?>" <?= ($k['id'] == $siswa['id_kelas']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($k['nama_kelas']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="submit">Simpan Perubahan</button>
</form>
<br>
<a href="daftar-siswa.php">← Batal / Kembali</a>