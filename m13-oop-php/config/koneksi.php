<?php
$host = 'localhost';
$db   = 'sekolah_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "koneksi berhasil<br>";

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>