<?php
// Sesi Siang (Nomor 4): Simpan pesan ke dalam array sederhana
$pesanList = [];

if (isset($_POST['kirim_pesan'])) {
    $pesanBaru = $_POST['pesan'];
    // Simpan ke array
    $pesanList[] = $pesanBaru;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>M9 Sanitasi & Demo XSS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .box { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; width: 450px; }
        .rentan { background-color: #f8d7da; border-color: #f5c6cb; }
        .aman { background-color: #d4edda; border-color: #c3e6cb; }
        textarea { width: 100%; height: 60px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <h2>Demo Sesi Pagi: XSS (Rentan vs Aman)</h2>
    <form method="POST" action="">
        <label>Ketik teks uji coba (contoh: <code>&lt;b&gt;tebal&lt;/b&gt;</code> atau <code>&lt;script&gt;alert('kena')&lt;/script&gt;</code>):</label><br><br>
        <input type="text" name="teks_uji" style="width: 100%; padding: 5px;" value="<?php echo isset($_POST['teks_uji']) ? $_POST['teks_uji'] : ''; ?>"><br><br>
        <button type="submit" name="uji_xss">Uji XSS</button>
    </form>

    <?php if (isset($_POST['uji_xss'])): ?>
        <div class="box rentan">
            <h4 style="color: #721c24; margin-top: 0;">Versi Rentan (Tanpa htmlspecialchars):</h4>
            <!-- Langsung dicetak mentah (Bahaya XSS) -->
            <p><?php echo $_POST['teks_uji']; ?></p>
        </div>

        <div class="box aman">
            <h4 style="color: #155724; margin-top: 0;">Versi Aman (Dengan htmlspecialchars):</h4>
            <!-- Dibersihkan dulu menggunakan htmlspecialchars -->
            <p><?php echo htmlspecialchars($_POST['teks_uji'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>

    <hr style="width: 480px; text-align: left; margin: 30px 0;">

    <h2>Sesi Siang (Nomor 4): Kotak Masuk Pesan Sederhana</h2>
    <form method="POST" action="">
        <textarea name="pesan" placeholder="Tulis pesanmu di sini..."></textarea><br>
        <button type="submit" name="kirim_pesan">Kirim Pesan ke Kotak Masuk</button>
    </form>

    <div class="box aman" style="margin-top: 15px;">
        <h3>Daftar Pesan Masuk (Aman dari XSS):</h3>
        <ul>
            <?php 
            // Mensimulasikan daftar pesan (dalam praktiknya bisa dari array/file)
            if (isset($_POST['kirim_pesan']) && !empty($_POST['pesan'])) {
                $pesanAman = htmlspecialchars($_POST['pesan'], ENT_QUOTES, 'UTF-8');
                echo "<li>" . $pesanAman . "</li>";
            } else {
                echo "<li>Belum ada pesan.</li>";
            }
            ?>
        </ul>
    </div>

    <!-- 
        CATATAN ATURAN SEUMUR HIDUP (Nomor 5):
        - Validasi saat menerima data (Cek format, pastikan tidak kosong di server).
        - Sanitasi saat menampilkan data (Selalu gunakan htmlspecialchars() saat mencetak output ke browser).
    -->

</body>
</html>