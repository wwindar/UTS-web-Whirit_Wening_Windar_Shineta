<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — ' : '' ?>Katalog Resensi Buku</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/uts_webwhirit/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <span class="brand-icon">📚</span>
            <span class="brand-name">Resensi<em>Buku</em></span>
        </div>
        <button class="nav-toggle" id="navToggle">☰</button>
        <ul class="nav-links" id="navLinks">
            <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="katalog.php" class="<?= basename($_SERVER['PHP_SELF']) == 'katalog.php' ? 'active' : '' ?>">Katalog</a></li>
            <li><a href="tambah.php" class="<?= basename($_SERVER['PHP_SELF']) == 'tambah.php' ? 'active' : '' ?>">+ Tambah Resensi</a></li>
            <li><a href="logout.php" class="nav-logout">Keluar</a></li>
        </ul>
    </nav>