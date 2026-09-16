<?php
session_start();
require_once 'koneksi.php';

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username']; // Sengaja dibiarkan mentah tanpa proteksi

    // RENTAN SQL INJECTION: Input langsung digabung ke string query
    $sql = "SELECT * FROM user WHERE username = '$username'";
    
    $query = $pdo->query($sql);
    $user = $query->fetch();

    if ($user) {
        // Jika data ketemu, langsung login (bypass password demi uji coba)
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login gagal, username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Rentan - SQLi</title>
</head>
<body>
    <h2 style="color: red;">Form Login RENTAN (SQL Injection)</h2>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form action="" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" style="width: 250px;" required><br><br>
        <button type="submit" name="login">Login Jebol</button>
    </form>
</body>
</html>