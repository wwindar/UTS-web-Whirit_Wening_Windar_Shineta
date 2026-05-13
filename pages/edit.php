<?php

session_start();
require_once '../config/db.php';
require_once '../includes/auth.php';

requireLogin();

$pageTitle = 'Edit Resensi';
$basePath = '../';

$id = intval($_GET['id'] ?? $_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: katalog.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM resensi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: katalog.php");
    exit();
}
$buku = $result->fetch_assoc();
$stmt->close();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul_buku'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $ulasan = trim($_POST['ulasan'] ?? '');
    $rating = intval($_POST['rating'] ?? 0);

    if (empty($judul)) $errors[] = 'Judul buku wajib diisi.';
    elseif (strlen($judul) > 255) $errors[] = 'Judul buku maksimal 255 karakter.';
    if (empty($penulis)) $errors[] = 'Nama penulis wajib diisi.';
    if (empty($ulasan)) $errors[] = 'Ulasan wajib diisi.';
    elseif (strlen($ulasan) < 20) $errors[] = 'Ulasan minimal 20 karakter.';
    if ($rating < 1 || $rating > 5) $errors[] = 'Rating wajib dipilih (1-5 bintang).';

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE resensi SET judul_buku=?, penulis=?, genre=?, ulasan=?, rating=? WHERE id=?");
        $stmt->bind_param("ssssii", $judul, $penulis, $genre, $ulasan, $rating, $id);

        if ($stmt->execute()) {
            $_SESSION['flash'] = 'Resensi "' . $judul . '" berhasil diperbarui!';
            $_SESSION['flash_type'] = 'success';
            header("Location: katalog.php");
            exit();
        } else {
            $errors[] = 'Gagal memperbarui data. Silakan coba lagi.';
        }
        $stmt->close();
    }

    $buku['judul_buku'] = $judul;
    $buku['penulis'] = $penulis;
    $buku['genre'] = $genre;
    $buku['ulasan'] = $ulasan;
    $buku['rating'] = $rating;
}

// FIX: tambah koma yang hilang antara 'Urban Fantasy' dan 'Historical'
$genreOptions = [
    'Fiksi Ilmiah', 'Horor', 'Bromance', 'Fiksi Remaja', 'Supranatural',
    'Omegaverse', 'Romantic Comedy', 'Angst', 'Biografi', 'Filsafat',
    'Hurt/Comfort', 'Local/Lokal AU', 'Family', 'Friendship', 'Novel',
    'Puisi', 'Cerpen', 'Sejarah', 'Romance', 'Thriller', 'Mystery',
    'Fantasy', 'Science Fiction', 'Slice of Life', 'Young Adult', 'Adult',
    "Children's Literature", 'Urban Fantasy', 'Historical', 'Dystopian',
    'Contemporary', 'Adventure', 'Thriller & Mystery', 'Lainnya'
];
?>
<?php include '../includes/header.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1>Edit Resensi</h1>
        <p>Perbarui informasi resensi buku.</p>
    </div>

    <?php if ($errors): ?>
        <div class="alert alert-error">
            <strong>Mohon periksa kembali:</strong><br>
            <?php foreach ($errors as $e): ?>
                • <?= htmlspecialchars($e) ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-card">
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="judul_buku">Judul Buku <span style="color:#c0392b">*</span></label>
                    <input type="text" id="judul_buku" name="judul_buku"
                           value="<?= htmlspecialchars($buku['judul_buku']) ?>"
                           required maxlength="255">
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis <span style="color:#c0392b">*</span></label>
                    <input type="text" id="penulis" name="penulis"
                           value="<?= htmlspecialchars($buku['penulis']) ?>"
                           required maxlength="100">
                </div>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <select id="genre" name="genre">
                    <option value="">— Pilih Genre —</option>
                    <?php foreach ($genreOptions as $g): ?>
                        <option value="<?= htmlspecialchars($g) ?>" <?= $buku['genre'] === $g ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ulasan">Ulasan / Resensi <span style="color:#c0392b">*</span></label>
                <textarea id="ulasan" name="ulasan" required><?= htmlspecialchars($buku['ulasan']) ?></textarea>
            </div>

            <div class="form-group">
                <label>Rating <span style="color:#c0392b">*</span></label>
                <div class="star-select">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" id="rating<?= $i ?>" name="rating" value="<?= $i ?>"
                               <?= intval($buku['rating']) === $i ? 'checked' : '' ?>>
                        <label for="rating<?= $i ?>">★</label>
                    <?php endfor; ?>
                </div>
            </div>

            <div style="display:flex;gap:0.75rem;margin-top:0.5rem">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="detail.php?id=<?= $id ?>" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>