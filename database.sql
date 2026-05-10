CREATE DATABASE IF NOT EXISTS uts_web;
USE uts_web;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

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


INSERT INTO users (username, password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample data resensi
INSERT INTO resensi (judul_buku, penulis, genre, ulasan, rating, user_id) VALUES
('Not The Best, But Still Good', 'peachhplease', 'Romance Comedy', 'Kisah ini berpusat pada Duang, mahasiswa jurusan seni dekoratif yang ceria dan pantang menyerah. Ia jatuh cinta pada Qin, mahasiswa jurusan musik yang sangat populer namun dikenal dingin dan sulit didekati. Keberanian Duang diuji saat festival Loy Krathong, di mana ia mengungkapkan perasaannya. Meski tidak langsung diterima, Qin memberikan kesempatan bagi Duang untuk membuktikan ketulusannya. Hubungan mereka semakin dalam ketika keduanya dipasangkan dalam sebuah pertunjukan musikal kampus, memaksa mereka untuk saling memahami dunia satu sama lain.', 5, 1),
('Thame-Po', 'Chiffon_cake', 'Romance', 'Serial ini menceritakan tentang Thame, seorang remaja yang memiliki bakat luar biasa dalam bermusik namun memiliki kepribadian yang cukup tertutup dan kaku. Kehidupannya mulai berubah secara tidak terduga saat ia bertemu dengan Po, seorang pemuda yang ceria dan penuh semangat. Pertemuan mereka berawal dari ketidaksengajaan yang membuat "jantung berdegup kencang"—sesuai dengan judulnya. Melalui musik dan interaksi sehari-hari di sekolah, Po perlahan-lahan mencairkan dinding es di sekitar Thame, sementara Thame membantu Po menemukan kedalaman dalam ekspresi seninya.', 5, 1),
('Khemjira Tong Rot', 'Cali', 'Supranatural', 'Keluarga Khemjira dihantui oleh kutukan kuno yang menargetkan anak laki-laki; konon, tidak ada anak laki-laki di garis keturunan mereka yang akan bertahan hidup melewati usia 20 tahun. Untuk mengelabui takdir, Khemjira dibesarkan dengan nama perempuan. Menjelang ulang tahunnya yang ke-20, teror mistis mulai menguat. Satu-satunya harapan Khemjira adalah Peem, seorang pemuda yang memiliki ilmu spiritual tinggi dan kekuatan okultisme. Hubungan mereka berkembang dari rasa takut dan ketergantungan menjadi ikatan emosional yang mendalam, di mana Peem berusaha keras melindungi Khemjira dari entitas gelap yang ingin mencabut nyawanya.', 4, 1);
