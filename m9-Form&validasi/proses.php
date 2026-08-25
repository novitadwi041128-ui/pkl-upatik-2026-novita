<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Data POST</title>
</head>
<body>
    <h2>Data yang Diterima:</h2>
    
    <?php
    // Membaca data yang dikirim dari form menggunakan metode POST
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $kelas = $_POST['kelas'];

    // Menampilkan kembali data ke layar
    echo "Nama: " . $nama . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Kelas: " . $kelas . "<br>";
    ?>
</body>
</html>