<?php
require_once 'koneksi.php'; // Menghubungkan ke database menggunakan PDO

// Data akun awal yang ingin dibuat
$akun_awal = [
    [
        'username' => 'admin_novita',
        'password' => 'admin123', // Password asli sebelum di-hash
        'role'     => 'admin'
    ],
    [
        'username' => 'user_biasa',
        'password' => 'user123',   // Password asli sebelum di-hash
        'role'     => 'user'
    ]
];

foreach ($akun_awal as $akun) {
    // 1. Amankan password menggunakan password_hash dengan algoritma default (Bcrypt/Argon2)
    $password_terhash = password_hash($akun['password'], PASSWORD_DEFAULT);

    // 2. Masukkan ke database menggunakan prepared statement agar aman dari SQL Injection
    $stmt = $pdo->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$akun['username'], $password_terhash, $akun['role']]);
        echo "Akun dengan username <b>{$akun['username']}</b> berhasil dibuat!<br>";
    } catch (PDOException $e) {
        echo "Gagal membuat akun {$akun['username']} (Kemungkinan username sudah ada): " . $e->getMessage() . "<br>";
    }
}
?>