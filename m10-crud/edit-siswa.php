<?php
require_once 'koneksi.php';

$pesan = "";
$siswa = null;

// 1. Cek apakah parameter 'id' ada di URL dan berupa angka
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data siswa berdasarkan ID (Prepared SELECT)
    $stmt = $pdo->prepare("SELECT * FROM siswa WHERE id = ?");
    $stmt->execute([$id]);
    $siswa = $stmt->fetch();

    // 2. Penanganan ID tidak valid (jika ID tidak ditemukan di database)
    if (!$siswa) {
        $pesan = "Maaf, data siswa dengan ID tersebut tidak ditemukan.";
    }
} else {
    // Jika parameter ID di URL bukan angka atau kosong
    $pesan = "ID siswa tidak valid.";
}

// 3. Proses saat form disubmit (UPDATE data)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $siswa) {
    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $kelas = trim($_POST['kelas']);

    if (!empty($nama) && !empty($email) && !empty($kelas)) {
        try {
            // Prepared Statement UPDATE WHERE id = ?
            $stmtUpdate = $pdo->prepare("UPDATE siswa SET nama = ?, email = ?, kelas = ? WHERE id = ?");
            $stmtUpdate->execute([$nama, $email, $kelas, $id]);

            // Redirect kembali ke halaman daftar siswa setelah sukses
            header('Location: daftar-siswa.php');
            exit;
        } catch (PDOException $e) {
            $pesan = "Gagal memperbarui data: " . $e->getMessage();
        }
    } else {
        $pesan = "Semua kolom wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa - CRUD Pertama</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9; }
        .container { max-width: 500px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #ffc107; color: black; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px; font-weight: bold; }
        button:hover { background: #e0a800; }
        .error { color: red; margin-bottom: 15px; font-weight: bold; }
        a { display: inline-block; margin-top: 15px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data Siswa</h2>

    <!-- Jika ID tidak valid / tidak ditemukan, tampilkan pesan sopan & tombol kembali -->
    <?php if (!empty($pesan) && !$siswa): ?>
        <div class="error"><?= $pesan; ?></div>
        <a href="daftar-siswa.php">&larr; Kembali ke Daftar Siswa</a>

    <?php else: ?>

        <?php if (!empty($pesan)): ?>
            <div class="error"><?= $pesan; ?></div>
        <?php endif; ?>

        <!-- Form Edit dengan nilai lama yang sudah otomatis terisi -->
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($siswa['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>

        <a href="daftar-siswa.php">&larr; Batal / Kembali ke Daftar Siswa</a>

    <?php endif; ?>
</div>

</body>
</html>