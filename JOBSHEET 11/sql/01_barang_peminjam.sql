-- =====================================================================
-- [BARU] Jobsheet 8: skema awal database sitaris_hmti (MySQL/MariaDB)
-- File ini meniru struktur sql/01_buku_anggota.sql pada referensi,
-- tetapi sintaksnya disesuaikan ke MySQL:
--   - SERIAL (PostgreSQL)  -> INT AUTO_INCREMENT (MySQL)
--   - tabel `buku`    -> digantikan modul `barang`   di project ini
--   - tabel `anggota` -> digantikan modul `peminjam` di project ini
-- Cara menjalankan (terminal):
--   mysql -u root < sql/01_barang_peminjam.sql
-- =====================================================================

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
