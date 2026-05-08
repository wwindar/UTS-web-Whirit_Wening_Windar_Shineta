<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Resensi Buku</title>
    <link rel="stylesheet" href="assets/style.css"> </head>
<body>
    <nav>
        <h2>ResensiBuku.id</h2>
        <a href="tambah.php">Tambah Resensi</a>
    </nav>

    <div class="container">
        <h1>Daftar Resensi Buku</h1>

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Genre</th>
                <th>Ulasan</th>
                <th>Rating</th>
                <th>Tanggal Input</th>
            </tr>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM resensi");
            $no = 1;
            while($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['judul_buku']; ?></td>
                <td><?= $data['penulis']; ?></td>
                <td><?= $data['genre']; ?></td>
                <td><?= $data['ulasan']; ?></td>
                <td><?= $data['rating']; ?>/5</td>
                <td>
                    <a href="edit.php?id=<?= $data['id']; ?>">Edit</a> | 
                    <a href="hapus.php?id=<?= $data['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>