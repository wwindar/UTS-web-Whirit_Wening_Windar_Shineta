<?php

session_start();
require_once '../config/db.php';
require_once '../includes/auth.php';

requireLogin();

$pageTitle = 'Katalog';
$basePath = '../';

$search = trim($_GET['search'] ?? '');
$genre = trim($_GET['genre'] ?? '');
$sort = $_GET['sort'] ?? 'terbaru';

$where = [];
$params = [];
$types = '';

if ($search !== '') {
    $where[] = "(judul_buku LIKE ? OR penulis LIKE ?)";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $types .= 'ss';
}
if ($genre !== '') {
    $where[] = "genre = ?";
    $params[] = $genre;
    $types .= 's';
}

$whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$orderClause = match($sort) {
    'judul' => 'ORDER BY judul_buku ASC',
    'rating_tinggi' => 'ORDER BY rating DESC',
    'rating_rendah' => 'ORDER BY rating ASC',
    default => 'ORDER BY tgl_input DESC'
};

$sql = "SELECT * FROM resensi $whereClause $orderClause";
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$genreResult = $conn->query("SELECT DISTINCT genre FROM resensi WHERE genre IS NOT NULL AND genre != '' ORDER BY genre");

$flashMsg = $_SESSION['flash'] ?? '';
$flashType = $_SESSION['flash_type'] ?? 'info';
unset($_SESSION['flash'], $_SESSION['flash_type']);

function renderStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= $i <= $rating ? '★' : '☆';
    }
    return $stars;
}
?>
<?php include '../includes/header.php'; ?>

<div class="main-content">
    <div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem">
        <div>
            <h1>Katalog Resensi</h1>
            <p>Seluruh koleksi ulasan buku yang telah ditambahkan.</p>
        </div>
        <a href="tambah.php" class="btn btn-gold">+ Tambah Resensi</a>
    </div>

    <?php if ($flashMsg): ?>
        <div class="alert alert-<?= $flashType ?>"><?= htmlspecialchars($flashMsg) ?></div>
    <?php endif; ?>

    <form method="GET" action="">
        <div class="filter-bar">
            <input type="text" name="search" placeholder="🔍 Cari judul atau penulis..."
                   value="<?= htmlspecialchars($search) ?>">
            <select name="genre">
                <option value="">Semua Genre</option>
                <?php while ($g = $genreResult->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($g['genre']) ?>"
                        <?= $genre === $g['genre'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($g['genre']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <select name="sort">
                <option value="terbaru" <?= $sort === 'terbaru' ? 'selected' : '' ?>>Terbaru</option>
                <option value="judul" <?= $sort === 'judul' ? 'selected' : '' ?>>A–Z Judul</option>
                <option value="rating_tinggi" <?= $sort === 'rating_tinggi' ? 'selected' : '' ?>>Rating Tertinggi</option>
                <option value="rating_rendah" <?= $sort === 'rating_rendah' ? 'selected' : '' ?>>Rating Terendah</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <?php if ($search || $genre): ?>
                <a href="katalog.php" class="btn btn-outline">Reset</a>
            <?php endif; ?>
        </div>
    </form>

    <?php if ($result->num_rows === 0): ?>
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h3>Tidak ada resensi ditemukan</h3>
            <p><?= $search || $genre ? 'Coba kata kunci atau filter yang berbeda.' : 'Jadilah yang pertama menambahkan resensi!' ?></p>
            <a href="tambah.php" class="btn btn-gold" style="margin-top:1rem">+ Tambah Resensi</a>
        </div>
    <?php else: ?>
        <p style="color:var(--ink-light);font-size:0.85rem;margin-bottom:1rem">
            Menampilkan <strong><?= $result->num_rows ?></strong> resensi
        </p>
        <div class="books-grid">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="book-card">
                <div class="book-card-spine"></div>
                <div class="book-card-body">
                    <?php if ($row['genre']): ?>
                        <span class="book-genre-badge"><?= htmlspecialchars($row['genre']) ?></span>
                    <?php endif; ?>
                    <div class="book-title"><?= htmlspecialchars($row['judul_buku']) ?></div>
                    <div class="book-author">oleh <span><?= htmlspecialchars($row['penulis']) ?></span></div>
                    <div class="book-ulasan"><?= htmlspecialchars($row['ulasan']) ?></div>
                    <div class="book-meta">
                        <span class="stars"><?= renderStars($row['rating']) ?></span>
                        <span class="book-date"><?= date('d M Y', strtotime($row['tgl_input'])) ?></span>
                    </div>
                    <div class="book-actions">
                        <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-outline btn-sm">Detail</a>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-gold btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm btn-hapus">Hapus</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>