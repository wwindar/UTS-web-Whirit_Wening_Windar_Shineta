<?php 
include 'config/koneksi.php'; 

if(isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $genre = $_POST['genre'];
    $resensi = $_POST['isi_resensi'];
    $rating = $_POST['rating'];

    if(!empty($judul) && !empty($resensi)) {
        $sql = "INSERT INTO resensi (judul_buku, penulis, genre, ulasan, rating) 
                VALUES ('$judul', '$penulis', '$genre', '$resensi', '$rating')";
        if(mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resensi - Katalog Buku</title>
    <link rel="stylesheet" href="assets/style.css"> 
</head>
<body>
    <nav>
        <h2>ResensiBuku.id</h2>
        <a href="index.php">Kembali ke Daftar</a>
    </nav>

    <div class="container">
        <h1>Tambah Resensi Baru</h1>

        <form method="POST">
            <input type="text" name="judul" placeholder="Judul Buku" required><br>
            <input type="text" name="penulis" placeholder="Penulis"><br>
            <input type="text" name="genre" placeholder="Genre (misal: Fiksi)"><br>
            <textarea name="isi_resensi" placeholder="Tulis Resensi..."></textarea><br>
            
            <label>Rating:</label>
            <select name="rating">
                <option value="5">5 - Bagus Sekali</option>
                <option value="4">4 - Bagus</option>
                <option value="3">3 - Biasa</option>
                <option value="2">2 - Kurang</option>
                <option value="1">1 - Buruk</option>
            </select><br>
            
            <button type="submit" name="submit">Simpan Resensi</button>
        </form>
    </div>
</body>
</html>