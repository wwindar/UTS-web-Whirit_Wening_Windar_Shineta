<?php

session_start();
require_once '../config/db.php';
require_once '../includes/auth.php';

requireLogin();

$pageTitle = 'Tambah Resensi';
$basePath = '../';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST;

    $judul = trim($_POST['judul_buku'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $ulasan = trim($_POST['ulasan'] ?? '');
    $rating = intval($_POST['rating'] ?? 0);

    if (empty($judul)) $errors[] = 'Judul buku wajib diisi.';
    elseif (strlen($judul) > 255) $errors[] = 'Judul buku maksimal 255 karakter.';

    if (empty($penulis)) $errors[] = 'Nama penulis wajib diisi.';
    elseif (strlen($penulis) > 100) $errors[] = 'Nama penulis maksimal 100 karakter.';

    if (empty($ulasan)) $errors[] = 'Ulasan wajib diisi.';
    elseif (strlen($ulasan) < 20) $errors[] = 'Ulasan minimal 20 karakter.';

    if ($rating < 1 || $rating > 5) $errors[] = 'Rating wajib dipilih (1-5 bintang).';

    if (empty($errors)) {
        $userId = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO resensi (judul_buku, penulis, genre, ulasan, rating, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $judul, $penulis, $genre, $ulasan, $rating, $userId);

        if ($stmt->execute()) {
            $_SESSION['flash'] = 'Resensi "' . $judul . '" berhasil ditambahkan!';
            $_SESSION['flash_type'] = 'success';
            header("Location: katalog.php");
            exit();
        } else {
            $errors[] = 'Gagal menyimpan data. Silakan coba lagi.';
        }
        $stmt->close();
    }
}

$genreOptions = ['Fiksi Ilmiah', 'Horor', 'Bromance', 'Fiksi Remaja', 'Supranatural', 'Omegaverse', 'Romantic Comedy', 'Angst', 'Biografi', 'Filsafat', 'Hurt/Comfort', 'Local/Lokal AU', 'Family', 'Friendship', 'Novel', 'Puisi', 'Cerpen', 'Sejarah', 'Romance', 'Horor', 'Thriller', 'Mystery', 'Fantasy', 'Science Fiction', 'Slice of Life', 'Young Adult', 'Adult', 'Childrens Literature', 'Urban Fantasy', 'Historical', 'Dystopian', 'Contemporary', 'Adventure',  'Thriller & Mystery', 'Lainnya'];
?>
<?php include '../includes/header.php'; ?>

<div class="main-content">
    <div class="page-header">
        <h1>Tambah Resensi</h1>
        <p>Tulis ulasan buku baru untuk koleksi katalog.</p>
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
            <div class="form-row">
                <div class="form-group">
                    <label for="judul_buku">Judul Buku <span style="color:#c0392b">*</span></label>
                    <input type="text" id="judul_buku" name="judul_buku"
                           value="<?= htmlspecialchars($old['judul_buku'] ?? '') ?>"
                           placeholder="Contoh: Not The Best, But Still Good" required maxlength="255">
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis <span style="color:#c0392b">*</span></label>
                    <input type="text" id="penulis" name="penulis"
                           value="<?= htmlspecialchars($old['penulis'] ?? '') ?>"
                           placeholder="Contoh: peachhplease" required maxlength="100">
                </div>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <select id="genre" name="genre">
                    <option value="">— Pilih Genre —</option>
                    <?php foreach ($genreOptions as $g): ?>
                        <option value="<?= $g ?>" <?= ($old['genre'] ?? '') === $g ? 'selected' : '' ?>>
                            <?= $g ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="ulasan">Ulasan / Resensi <span style="color:#c0392b">*</span></label>
                <textarea id="ulasan" name="ulasan" placeholder="Tuliskan ulasan Anda tentang buku ini... (minimal 20 karakter)" required><?= htmlspecialchars($old['ulasan'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label>Rating <span style="color:#c0392b">*</span></label>
                <div class="star-select" id="starSelect">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" id="rating<?= $i ?>" name="rating" value="<?= $i ?>"
                               <?= (intval($old['rating'] ?? 0) === $i) ? 'checked' : '' ?>>
                        <label for="rating<?= $i ?>">★</label>
                    <?php endfor; ?>
                </div>
                <small style="color:var(--ink-light);font-size:0.8rem">Klik bintang untuk memberi rating</small>
            </div>

            <div style="display:flex;gap:0.75rem;margin-top:0.5rem">
                <button type="submit" class="btn btn-primary">Simpan Resensi</button>
                <a href="katalog.php" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>