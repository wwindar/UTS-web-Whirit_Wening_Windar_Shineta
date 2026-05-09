# 📚 Katalog Resensi Buku
### UTS Praktikum Pemrograman Web 1

Aplikasi web katalog resensi buku berbasis PHP Native, MySQL, HTML, dan CSS.

---

## 🛠️ Teknologi
- **Frontend**: HTML5, CSS3 (Responsive)
- **Backend**: PHP Native
- **Database**: MySQL
- **Version Control**: Git & GitHub

---

## 📁 Struktur Folder

```
uts-web-resensi-buku/
├── index.php               # Halaman Login
├── database.sql            # File SQL database
├── config/
│   └── db.php              # Koneksi database
├── includes/
│   ├── auth.php            # Fungsi autentikasi (session)
│   ├── header.php          # Template navbar
│   └── footer.php          # Template footer
├── pages/
│   ├── register.php        # Halaman Register
│   ├── dashboard.php       # Dashboard + statistik
│   ├── katalog.php         # Katalog (READ + Search + Filter)
│   ├── tambah.php          # Tambah resensi (CREATE)
│   ├── edit.php            # Edit resensi (UPDATE)
│   ├── detail.php          # Detail resensi
│   ├── hapus.php           # Hapus resensi (DELETE)
│   └── logout.php          # Logout
├── assets/
│   ├── css/style.css       # Stylesheet utama
│   └── js/main.js          # JavaScript (navbar, konfirmasi hapus)
```

---

## ⚙️ Cara Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/uts-web-nama_anda.git
   cd uts-web-nama_anda
   ```

2. **Import database**
   - Buka phpMyAdmin atau MySQL CLI
   - Jalankan file `database.sql`
   ```sql
   source database.sql;
   ```

3. **Konfigurasi koneksi**
   - Buka `config/db.php`
   - Sesuaikan `DB_USER` dan `DB_PASS` dengan konfigurasi MySQL Anda

4. **Jalankan dengan XAMPP**
   - Letakkan folder project di `htdocs/`
   - Akses via browser: `http://localhost/uts-web-resensi-buku/`

---

## 🔐 Akun Default
| Username | Password |
|----------|----------|
| admin    | admin123 |

> ⚠️ Ganti password setelah login pertama kali.

---

## ✅ Fitur CRUD
| Operasi | Halaman | Keterangan |
|---------|---------|------------|
| **Create** | `tambah.php` | Tambah resensi buku baru |
| **Read** | `katalog.php`, `detail.php` | Lihat semua / detail resensi |
| **Update** | `edit.php` | Edit data resensi |
| **Delete** | `hapus.php` | Hapus resensi (dengan konfirmasi) |

---

## 🗃️ ERD Sederhana

```
users (id, username, password, created_at)
   │
   └─── 1:N ───▶ resensi (id, judul_buku, penulis, genre, ulasan, rating, tgl_input, user_id)
```

---

## 🔒 Keamanan
- Password di-hash dengan `password_hash()` (bcrypt)
- Semua query menggunakan **prepared statement** (mencegah SQL Injection)
- Semua output di-escape dengan `htmlspecialchars()` (mencegah XSS)
- Session-based authentication
- Validasi form di sisi server

---

## 📸 Halaman
- **Login** — Masuk dengan username & password
- **Register** — Buat akun baru
- **Dashboard** — Statistik total resensi, rata-rata rating, genre
- **Katalog** — Semua resensi dengan fitur search & filter genre
- **Tambah Resensi** — Form input data buku baru
- **Edit Resensi** — Perbarui data resensi
- **Detail Resensi** — Tampilan lengkap satu resensi
