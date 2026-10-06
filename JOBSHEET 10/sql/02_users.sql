-- =====================================================================
-- [BARU] Jobsheet 9: tabel users untuk login petugas SITARIS HMTI.
-- Cara menjalankan (terminal):
--   mysql -u root < sql/02_users.sql
-- =====================================================================

USE sitaris_hmti;

CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100) NOT NULL,
    username   VARCHAR(50)  NOT NULL UNIQUE,          -- UNIQUE: username tidak boleh kembar
    password   VARCHAR(255) NOT NULL,                 -- hasil password_hash() (bcrypt = 60 char, sisakan ruang)
    role       VARCHAR(20)  NOT NULL DEFAULT 'petugas', -- 'admin' atau 'petugas'
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
