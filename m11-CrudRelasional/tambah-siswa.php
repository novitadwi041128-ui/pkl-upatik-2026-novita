<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $id_kelas = $_POST['id_kelas'];
    $tanggal_daftar = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO siswa (nama, email, id_kelas, tanggal_daftar) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $email, $id_kelas, $tanggal_daftar]);

    header('Location: daftar-siswa.php');
    exit;
}
?>

<h3>Tambah Siswa Baru</h3>
<form method="POST">
    <label>Nama Lengkap:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Kelas:</label><br>
    <select name="id_kelas" required>
        <option value="">-- Pilih Kelas --</option>
        <?php
        // Query mengambil data kelas dari tabel master kelas
        $stmt_kelas = $pdo->query("SELECT * FROM kelas");
        while ($k = $stmt_kelas->fetch()) {
            echo "<option value='{$k['id']}'>{$k['nama_kelas']}</option>";
        }
        ?>
    </select><br><br>
    
    <button type="submit">Simpan Siswa</button>
</form>
<br>
<a href="daftar-siswa.php">← Kembali ke Daftar Siswa</a>