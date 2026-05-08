<?php
session_start();
include 'config/koneksi.php'; // Baris ini sekarang benar karena file sudah di luar

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['status'] = "login";
        header("location:dashboard.php"); // Otomatis pindah ke dashboard
        exit();
    } else {
        echo "Login Gagal!";
    }
}
?>