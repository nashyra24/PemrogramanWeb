

CREATE DATABASE IF NOT EXISTS sitaris_hmti
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE sitaris_hmti;

-- Tabel barang (posisi sama dengan tabel `buku` di referensi)
CREATE TABLE IF NOT EXISTS barang (
    id          INT AUTO_INCREMENT PRIMARY KEY,       -- pengganti SERIAL di referensi
    nama_barang VARCHAR(255) NOT NULL,                -- kolom wajib, seperti `judul` di referensi
    kategori    VARCHAR(50),
    kondisi     VARCHAR(20),
    status      VARCHAR(20),
    jumlah      INT NOT NULL DEFAULT 0                -- seperti `stok` di referensi
);

-- Tabel peminjam (posisi sama dengan tabel `anggota` di referensi)
CREATE TABLE IF NOT EXISTS peminjam (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nim    VARCHAR(50) NOT NULL UNIQUE,               -- UNIQUE, meniru `no_anggota` di referensi
    nama   VARCHAR(255) NOT NULL,
    oki    VARCHAR(50),
    no_hp  VARCHAR(30)
);
