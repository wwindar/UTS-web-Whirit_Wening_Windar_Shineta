<?php
include 'config/koneksi.php';

if(isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $genre = $_POST['genre'];
    $resensi = $_POST['isi_resensi'];
    $rating = $_POST['rating'];

    if(!empty($judul) && ($resensi)) {
        $sql = "INSERT INTO buku (judul, penulis, genre, isi_resensi, rating) VALUES ('$judul, $penulis, $genre, $resensi, $rating')";
        if(mysqli_query($conn, $sql)) {
            header("Location: index.php");
        }
    }
}
?>

<form method="POST">
    <input type="text" name="judul" placeholder="Judul Buku" required><br>
    <input type="text" name="penulis" placeholder="Penulis"><br>
    <textarea name="isi_resensi" placeholder="Tulis Resensi..."></textarea><br>
    <select name="rating">
        <option value="5">5 - Bagus Sekali</option>
        <option value="4">4 - Bagus</option>
        <option value="3">3 - Biasa</option>
    </select><br>
    <button type="submit" name="submit">Simpan</button>
</form>
