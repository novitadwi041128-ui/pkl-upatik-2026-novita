<?php
// Mengecek apakah parameter "cari" ada di URL menggunakan isset()
if (isset($_GET['cari'])) {
    $keyword = htmlspecialchars($_GET['cari']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Metode GET M9</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .hasil { margin-top: 15px; font-weight: bold; color: blue; }
    </style>
</head>
<body>

    <h2>Latihan Nomor 4: Form Pencarian dengan Metode GET</h2>

    <!-- Form menggunakan method="GET" -->
    <form method="GET" action="">
        <label>Cari Kata Kunci:</label><br>
        <input type="text" name="cari" placeholder="Ketik sesuatu..."><br><br>
        <button type="submit">Cari Data</button>
    </form>

    <!-- Menampilkan hasil pencarian jika tombol diklik -->
    <?php if (isset($_GET['cari'])): ?>
        <div class="hasil">
            Hasil pencarian untuk kata kunci: "<?php echo $_GET['cari']; ?>"
        </div>
    <?php endif; ?>

</body>
</html>