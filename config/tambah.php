<?php 
session_start();
if($_SESSION['status'] != "login"){ header("location:login.php"); }
include 'config/koneksi.php';

if(isset($_POST['simpan'])){
    $judul = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

    mysqli_query($conn, "INSERT INTO resensi (judul_buku, penulis, ulasan, rating) VALUES ('$judul', '$penulis', '$ulasan', '$rating')");
    header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Resensi Buku</h2>
        <form method="POST">
            <input type="text" name="judul_buku" placeholder="Judul Buku" required><br>
            <input type="text" name="penulis" placeholder="Penulis" required><br>
            <textarea name="ulasan" placeholder="Ulasan"></textarea><br>
            <select name="rating">
                <option value="5">5 - Sempurna</option>
                <option value="4">4 - Bagus</option>
            </select><br>
            <button type="submit" name="simpan">Simpan</button>
            <a href="dashboard.php">Kembali</a>
        </form>
    </div>
</body>
</html>