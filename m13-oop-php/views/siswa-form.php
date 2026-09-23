<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa Baru</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        form { width: 300px; }
        div { margin-bottom: 10px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 8px 15px; background: #28a745; color: #fff; border: none; cursor: pointer; }
    </style>
</head>
<body>

<h2>Form Tambah Siswa</h2>

<form action="index.php?controller=siswa&aksi=simpan" method="POST">
    <div>
        <label>Nama:</label>
        <input type="text" name="nama" required>
    </div>
    <div>
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>ID Kelas:</label>
        <input type="number" name="id_kelas" required placeholder="Contoh: 1 atau 2">
    </div>
    <div>
        <label>Tanggal Daftar:</label>
        <input type="date" name="tanggal_daftar" required>
    </div>
    <button type="submit" name="submit">Simpan Data</button>
</object>
<br><br>
<a href="index.php?controller=siswa&aksi=index">Kembali ke Daftar</a>

</body>
</html>