-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 27 Des 2024 pada 16.46
-- Versi server: 8.3.0
-- Versi PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repository_ug2024`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'Menyimpan password dalam bentuk hash',
  `status_admin_reg` enum('AKTIF','NON AKTIF') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `email`, `password`, `status_admin_reg`) VALUES
(1, 'ADMIN', 'admin@test.com', '21232f297a57a5a743894a0e4a801fc3', 'AKTIF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_repository`
--

DROP TABLE IF EXISTS `berita_repository`;
CREATE TABLE IF NOT EXISTS `berita_repository` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul_berita` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `konten_berita` text COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_berita` date NOT NULL,
  `penulis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email_dosen` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_kartu_tanda_dosen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_induk_dosen` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_general_ci NOT NULL,
  `status_dosen_reg` enum('TAHAP VERIFIKASI','DITOLAK','DITERIMA') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `email_dosen` (`email_dosen`),
  UNIQUE KEY `nomor_induk_dosen` (`nomor_induk_dosen`),
  PRIMARY KEY (`id_dosen`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `repository_pi2024`
--

DROP TABLE IF EXISTS `repository_pi2024`;
CREATE TABLE IF NOT EXISTS `repository_pi2024` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `npm` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_penelitian` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dosen_pembimbing` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_pi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tingkat` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `angkatan` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_upload` date NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status_pi` enum('diterima','ditolak','direview') COLLATE utf8mb4_general_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `upload_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `abstrak` text DEFAULT NULL,
  `kata_kunci` varchar(255) DEFAULT NULL,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `npm` (`npm`),
  KEY `dosen_pembimbing` (`dosen_pembimbing`),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `repository_ta2024`
--

DROP TABLE IF EXISTS `repository_ta2024`;
CREATE TABLE IF NOT EXISTS `repository_ta2024` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `npm` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `judul_skripsi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dosen_pembimbing` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_ta` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_upload` date NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status_ta` enum('diterima','ditolak','direview') COLLATE utf8mb4_general_ci NOT NULL,
  `file_poster` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `upload_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `abstrak` text DEFAULT NULL,
  `kata_kunci` varchar(255) DEFAULT NULL,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `npm` (`npm`),
  KEY `dosen_pembimbing` (`dosen_pembimbing`),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `npm` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_ktm_krs` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` enum('1','2','3','4') COLLATE utf8mb4_general_ci NOT NULL,
  `status_mhs_reg` enum('TAHAP VERIFIKASI','DITERIMA','DITOLAK') COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `angkatan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `npm` (`npm`),
  UNIQUE KEY `email` (`email`),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
