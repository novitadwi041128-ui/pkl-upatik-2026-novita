<?php
$pesan_error = "";
$sukses = "";

// Cek apakah tombol "Kirim" sudah ditekan menggunakan isset()
if (isset($_POST['kirim'])) {
    
    // Cek apakah ada field yang kosong menggunakan empty()
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['kelas'])) {
        $pesan_error = "Peringatan: Semua field wajib diisi! (Mencegah warning error)";
    } else {
        // Amankan data jika berhasil diisi
        $nama  = htmlspecialchars($_POST['nama']);
        $email = htmlspecialchars($_POST['email']);
        $kelas = htmlspecialchars($_POST['kelas']);
        $sukses = "Halo $nama, data berhasil divalidasi dengan aman menggunakan isset() dan empty()!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Isset & Empty M9</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .error { color: red; font-weight: bold; margin-bottom: 15px; }
        .sukses { color: green; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>

    <h2>Latihan Nomor 3: Validasi isset() & empty()</h2>

    <!-- Menampilkan pesan error jika kosong -->
    <?php if (!empty($pesan_error)): ?>
        <div class="error"><?php echo $pesan_error; ?></div>
    <?php endif; ?>

    <!-- Menampilkan pesan sukses jika terisi lengkap -->
    <?php if (!empty($sukses)): ?>
        <div class="sukses"><?php echo $sukses; ?></div>
    <?php endif; ?>

    <!-- Form dikirim ke halaman ini sendiri -->
    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Kelas:</label><br>
        <input type="text" name="kelas"><br><br>

        <button type="submit" name="kirim">Kirim & Validasi</button>
    </form>

</body>
</html>