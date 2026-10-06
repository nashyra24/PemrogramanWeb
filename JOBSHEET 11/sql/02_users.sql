-- =====================================================================
-- [BARU] Jobsheet 9: tabel users untuk autentikasi (login/register).
-- Cara menjalankan (terminal):
--   mysql -u root < sql/02_users.sql
-- Jalankan SETELAH 01_barang_peminjam.sql (database sudah ada).
-- =====================================================================

USE sitaris_hmti;

CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100) NOT NULL,
    username   VARCHAR(50)  NOT NULL UNIQUE,   -- UNIQUE: mencegah username ganda di level database
    password   VARCHAR(255) NOT NULL,          -- hasil password_hash() (bcrypt = 60 char, 255 disiapkan utk algoritma lain)
    role       VARCHAR(20)  NOT NULL DEFAULT 'petugas',  -- 'petugas' atau 'admin'
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
