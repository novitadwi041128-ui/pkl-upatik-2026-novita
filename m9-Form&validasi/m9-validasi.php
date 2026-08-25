<?php
$errors = [];
$nama = "";
$email = "";
$umur = "";

if (isset($_POST['daftar'])) {
    // 1. Ambil inputan dari form
    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $umur  = trim($_POST['umur']);

    // 2. Validasi Nama: Tidak boleh kosong, hanya huruf & spasi, minimal 3 karakter
    if (empty($nama)) {
        $errors[] = "Nama wajib diisi.";
    } elseif (strlen($nama) < 3) {
        $errors[] = "Nama minimal harus 3 karakter.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
        $errors[] = "Nama hanya boleh berisi huruf dan spasi.";
    }

    // 3. Validasi Email: Tidak boleh kosong & format harus valid
    if (empty($email)) {
        $errors[] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // 4. Validasi Umur: Harus angka dan dalam rentang wajar (misal 10 - 100)
    if (empty($umur)) {
        $errors[] = "Umur wajib diisi.";
    } elseif (!is_numeric($umur)) {
        $errors[] = "Umur harus berupa angka.";
    } elseif ($umur < 10 || $umur > 100) {
        $errors[] = "Umur harus berada di rentang 10 sampai 100 tahun.";
    }

    // 5. Jika array errors kosong, berarti lolos validasi semua
    if (empty($errors)) {
        $sukses = "Selamat! Semua data berhasil divalidasi dengan aman di server.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Server-Side M9</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .error-box { background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; margin-bottom: 20px; border-radius: 5px; width: 400px; }
        .sukses-box { background-color: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; margin-bottom: 20px; border-radius: 5px; width: 400px; }
        input { padding: 5px; width: 100%; margin-top: 5px; margin-bottom: 15px; box-sizing: border-box; }
    </style>
</head>
<body>

    <h2>Form Pendaftaran dengan Validasi Server-Side</h2>

    <!-- Tampilkan semua pesan error jika ada -->
    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <strong>Terjadi Kesalahan:</strong>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Tampilkan pesan sukses jika lolos -->
    <?php if (!empty($sukses)): ?>
        <div class="sukses-box">
            <?php echo $sukses; ?>
        </div>
    <?php endif; ?>

    <!-- Form Input -->
    <form method="POST" action="" style="width: 400px;">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>">

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">

        <label>Umur:</label>
        <input type="text" name="umur" value="<?php echo htmlspecialchars($umur); ?>">

        <button type="submit" name="daftar">Daftar Sekarang</button>
    </form>

</body>
</html>