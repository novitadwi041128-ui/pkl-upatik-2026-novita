<?php
// 1. Menggunakan include untuk memanggil header
include 'header.php';

// Data siswa
$data_siswa = [
    ["nama" => "Andi", "kelas" => "XII RPL 1", "nilai" => 85],
    ["nama" => "Budi", "kelas" => "XII RPL 1", "nilai" => 90],
    ["nama" => "Citra", "kelas" => "XII RPL 2", "nilai" => 78],
    ["nama" => "Dwi", "kelas" => "XII RPL 2", "nilai" => 95],
    ["nama" => "Eko", "kelas" => "XII RPL 1", "nilai" => 88]
];

// 2. Membuat Fungsi (Function) untuk menghitung rata-rata
function hitungRataRata($data) {
    $total = 0;
    $jumlah = count($data);
    foreach ($data as $siswa) {
        $total += $siswa["nilai"];
    }
    return $total / $jumlah;
}

$rata_rata = hitungRataRata($data_siswa);
?>

    <h3>Tabel Data Siswa</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Nilai</th>
        </tr>
        <?php
        $no = 1;
        // 3. Perulangan foreach untuk tabel dinamis
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
    </table>

    <p><b>Rata-rata Kelas:</b> <?php echo $rata_rata; ?></p>

<?php
// 4. Menggunakan include untuk memanggil footer
include 'footer.php';
?>