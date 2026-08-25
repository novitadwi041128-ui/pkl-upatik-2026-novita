<?php
$errors = [];
$sukses = "";
$nama = "";
$email = "";
$umur = "";

$fileData = "data_pendaftar.json";

// Proses jika tombol daftar dikirim
if (isset($_POST['daftar'])) {
    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $umur  = trim($_POST['umur']);

    // Validasi sederhana
    if (empty($nama)) {
        $errors[] = "Nama wajib diisi.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email wajib diisi dan harus valid.";
    }
    if (empty($umur) || !is_numeric($umur)) {
        $errors[] = "Umur wajib diisi dengan angka.";
    }

    // Jika lolos validasi, simpan ke file JSON
    if (empty($errors)) {
        // Data baru yang akan dimasukkan
        $dataBaru = [
            'nama' => $nama,
            'email' => $email,
            'umur' => $umur,
            'waktu' => date('Y-m-d H:i:s')
        ];

        // Ambil data lama dari file jika sudah ada
        $daftarPendaftar = [];
        if (file_exists($fileData)) {
            $jsonContent = file_get_contents($fileData);
            $daftarPendaftar = json_decode($jsonContent, true) ?? [];
        }

        // Tambahkan data baru ke dalam array
        $daftarPendaftar[] = $dataBaru;

        // Simpan kembali ke file JSON dengan format yang rapi
        file_put_contents($fileData, json_encode($daftarPendaftar, JSON_PRETTY_PRINT));

        $sukses = "Data berhasil divalidasi dan disimpan ke dalam file!";
        
        // Reset input setelah sukses
        $nama = ""; $email = ""; $umur = "";
    }
}

// Membaca data dari file untuk ditampilkan ke tabel
$dataPendaftar = [];
if (file_exists($fileData)) {
    $jsonContent = file_get_contents($fileData);
    $dataPendaftar = json_decode($jsonContent, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penyimpanan Data ke File (Kamis M9)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .error-box { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; width: 400px; margin-bottom: 15px; }
        .sukses-box { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; width: 400px; margin-bottom: 15px; }
        input { padding: 5px; width: 100%; margin-top: 5px; margin-bottom: 15px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Form Pendaftaran & Penyimpanan ke File</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($sukses)): ?>
        <div class="sukses-box"><?php echo $sukses; ?></div>
    <?php endif; ?>

    <form method="POST" action="" style="width: 400px;">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>">

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">

        <label>Umur:</label>
        <input type="text" name="umur" value="<?php echo htmlspecialchars($umur); ?>">

        <button type="submit" name="daftar">Daftar & Simpan</button>
    </form>

    <hr style="margin: 40px 0;">

    <h3>Tabel Data Pendaftar (Dibaca dari File)</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Umur</th>
            <th>Waktu Daftar</th>
        </tr>
        <?php if (!empty($dataPendaftar)): ?>
            <?php foreach ($dataPendaftar as $index => $pendaftar): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($pendaftar['nama']); ?></td>
                    <td><?php echo htmlspecialchars($pendaftar['email']); ?></td>
                    <td><?php echo htmlspecialchars($pendaftar['umur']); ?></td>
                    <td><?php echo htmlspecialchars($pendaftar['waktu']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada data tersimpan di file.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>