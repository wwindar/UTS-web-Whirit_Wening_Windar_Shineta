<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "resensi_buku";

$conn = mysqli_connect($host, $user, $pass, $db);

if 
(!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>
