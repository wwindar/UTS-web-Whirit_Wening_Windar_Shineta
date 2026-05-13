<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'uts_web');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("<div style='font-family:sans-serif;padding:20px;background:#fee;border:1px solid #f00;margin:20px;border-radius:8px;'>
        <strong>Koneksi Database Gagal:</strong> " . $conn->connect_error . "
        <br><small>Pastikan MySQL berjalan dan database <em>uts_web</em> sudah dibuat.</small>
    </div>");
}

$conn->set_charset("utf8mb4");
?>