<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun</title>
</head>
<body>
    <h2>Registrasi Akun Sastra</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="register">Daftar</button>
    </form>
</body>
</html>

<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Berhasil daftar!'); window.location='login.php';</script>";
    }
}
?>