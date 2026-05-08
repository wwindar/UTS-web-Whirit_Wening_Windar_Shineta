<?php

session_start();
include 'koneksi.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
    }

$query = "SELECT * FROM resensi ORDER BY id DESC";
$result = mysqli_connect($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Sastra</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <nav>
        <span>Halo, <?php echo $_SESSION['user']; ?></span>
        <div>
            <a href="dashboard.php">Home</a>
            <a href="tambah.php">Tambah Resensi</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Katalog Resensi Buku</h2>
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Buku</a>
        <table>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['judul_buku']; ?></td>
                <td><?php echo $row['penulis']; ?></td>
                <td><?php echo $row['rating']; ?>/5</td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>