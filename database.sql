CREATE DATABASE uts_web;
USE uts_web;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE resensi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul_buku VARCHAR(255) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    genre VARCHAR(50),
    ulasan TEXT NOT NULL,
    rating INT(1),
    tanggal_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
