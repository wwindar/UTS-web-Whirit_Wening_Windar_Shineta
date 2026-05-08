<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
}
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Katalog Sastra</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <nav>
        <h2>KatalogResensi.id</h2>
        <div>
            <a href="dashboard.php">Home</a> | 
            <a href="tambah.php">Tambah Buku</a> | 
            <a href="logout.php">Keluar</a>
        </div>
    </nav>

    <div class="container">
        <h1>Daftar Resensi Buku</h1>
        <table border="1" cellpadding="10">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $no = 1;
            $data = mysqli_query($conn, "SELECT * FROM resensi");
            while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['judul_buku']; ?></td>
                <td><?= $d['penulis']; ?></td>
                <td><?= $d['rating']; ?>/5</td>
                <td>
                    <a href="edit.php?id=<?= $d['id']; ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $d['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>