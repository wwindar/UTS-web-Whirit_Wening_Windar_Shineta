-- =============================================
-- DATABASE: uts_sastra
-- Katalog Resensi Buku
-- =============================================

CREATE DATABASE IF NOT EXISTS uts_sastra;
USE uts_sastra;

-- Tabel untuk akun pengguna
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel untuk data resensi buku
CREATE TABLE IF NOT EXISTS resensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul_buku VARCHAR(255) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    genre VARCHAR(50),
    ulasan TEXT NOT NULL,
    rating INT(1) CHECK (rating BETWEEN 1 AND 5),
    tgl_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Sample data user (password: admin123)
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample data resensi
INSERT INTO resensi (judul_buku, penulis, genre, ulasan, rating, user_id) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Novel', 'Kisah inspiratif tentang semangat anak-anak Belitung dalam meraih mimpi. Novel ini menggugah hati dan membuat pembaca bersemangat untuk tidak menyerah.', 5, 1),
('Bumi Manusia', 'Pramoedya Ananta Toer', 'Sejarah', 'Mahakarya sastra Indonesia yang menggambarkan masa kolonial dengan sangat detail. Minke adalah karakter yang kompleks dan penuh perjuangan.', 5, 1),
('Dilan 1990', 'Pidi Baiq', 'Romansa', 'Cerita cinta remaja yang manis di era 90-an Bandung. Ringan dibaca namun meninggalkan kesan mendalam tentang kenangan masa muda.', 4, 1);
