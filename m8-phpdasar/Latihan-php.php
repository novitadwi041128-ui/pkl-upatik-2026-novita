Latihan-php.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Nilai Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Daftar Nilai Siswa PKL</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 1. Membuat array multidimensi berisi 5 siswa
            $data_siswa = [
                ["nama" => "Andi", "kelas" => "XII RPL 1", "nilai" => 85],
                ["nama" => "Budi", "kelas" => "XII RPL 1", "nilai" => 90],
                ["nama" => "Citra", "kelas" => "XII RPL 2", "nilai" => 78],
                ["nama" => "Dwi", "kelas" => "XII RPL 2", "nilai" => 95],
                ["nama" => "Eko", "kelas" => "XII RPL 1", "nilai" => 88]
            ];

            // 2. Menggunakan foreach untuk mencetak data ke dalam baris tabel HTML
            $no = 1;
            foreach ($data_siswa as $siswa) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $siswa["nama"] . "</td>";
                echo "<td>" . $siswa["kelas"] . "</td>";
                echo "<td>" . $siswa["nilai"] . "</td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>

</body>
</html>

Penjelasan Singkat:
Array Multidimensi ($data_siswa): Berisi 5 elemen array di dalamnya, di mana setiap siswa punya kunci "nama", "kelas", dan "nilai".
Perulangan foreach: PHP secara otomatis melingkar (looping) sebanyak 5 kali sesuai jumlah data siswa. Setiap kali berputar, PHP membuat baris tabel HTML (<tr> dan <td>) secara berulang-ulang. Inilah yang disebut web dinamis!