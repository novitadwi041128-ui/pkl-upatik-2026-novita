<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = $_POST['nama_kelas'];
    $id_jurusan = $_POST['id_jurusan'];

    $stmt = $pdo->prepare("INSERT INTO kelas (nama_kelas, id_jurusan) VALUES (?, ?)");
    $stmt->execute([$nama_kelas, $id_jurusan]);

    header('Location: daftar-kelas.php');
    exit;
}
?>

<h3>Tambah Kelas Baru</h3>
<form method="POST">
    <label>Nama Kelas:</label><br>
    <input type="text" name="nama_kelas" required><br><br>

    <label>Jurusan:</label><br>
    <select name="id_jurusan" required>
        <option value="">-- Pilih Jurusan --</option>
        <?php
        $stmt_jurusan = $pdo->query("SELECT * FROM jurusan");
        while ($j = $stmt_jurusan->fetch()) {
            echo "<option value='{$j['id']}'>{$j['nama_jurusan']}</option>";
        }
        ?>
    </select><br><br>
    
    <button type="submit">Simpan Kelas</button>
</form>
<br>
<a href="daftar-kelas.php">← Kembali ke Daftar Kelas</a>