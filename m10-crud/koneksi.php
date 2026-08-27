<?php
$host = 'localhost';
$dbname = 'sekolah_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Tambahkan baris ini kalau mau tulisannya ikutan muncul:
    echo "Koneksi berhasil! <br>"; 

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>