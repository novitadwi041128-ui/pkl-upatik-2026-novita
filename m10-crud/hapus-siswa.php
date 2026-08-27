<?php
require_once 'koneksi.php';

// Cek apakah parameter ID dikirimkan
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepared Statement DELETE yang aman dari SQL Injection
        $stmt = $pdo->prepare("DELETE FROM siswa WHERE id = ?");
        $stmt->execute([$id]);

        // Redirect kembali ke halaman daftar siswa setelah berhasil
        header('Location: daftar-siswa.php');
        exit;
    } catch (PDOException $e) {
        echo "Gagal menghapus data: " . $e->getMessage();
    }
} else {
    echo "ID siswa tidak valid.";
}
?>