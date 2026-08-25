<?php
$hasil_nama = "";
$hasil_email = "";
$pesan_error = "";

// Cek apakah tombol "Kirim" sudah ditekan
if (isset($_POST['kirim'])) {
    
    // Validasi sederhana menggunakan empty()
    if (empty($_POST['nama']) || empty($_POST['email'])) {
        $pesan_error = "Semua field wajib diisi!";
    } else {
        // Amankan data inputan
        $hasil_nama  = htmlspecialchars($_POST['nama']);
        $hasil_email = htmlspecialchars($_POST['email']);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Self-Processing Form M9</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .kotak-hasil { margin-top: 20px; padding: 15px; background-color: #e9f7ef; border: 1px solid #27ae60; width: 300px; }
        .error { color: red; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>

    <h2>Latihan Nomor 5: Form dan Hasil dalam Satu Halaman</h2>

    <!-- Menampilkan pesan error jika kosong -->
    <?php if (!empty($pesan_error)): ?>
        <div class="error"><?php echo $pesan_error; ?></div>
    <?php endif; ?>

    <!-- Form mengirim data ke halaman ini sendiri (action="") -->
    <form method="POST" action="">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <button type="submit" name="kirim">Kirim Data</button>
    </form>

    <!-- Hasil data akan muncul di bawah form jika sudah disubmit -->
    <?php if (!empty($hasil_nama)): ?>
        <div class="kotak-hasil">
            <h3>Hasil Input Data:</h3>
            <p><strong>Nama:</strong> <?php echo $hasil_nama; ?></p>
            <p><strong>Email:</strong> <?php echo $hasil_email; ?></p>
        </div>
    <?php endif; ?>

</body>
</html>