-- Database: mvp_kandidat_db
CREATE DATABASE IF NOT EXISTS `mvp_kandidat_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mvp_kandidat_db`;

-- --------------------------------------------------------
-- Struktur & Data Awal Tabel `kandidat`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `kandidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `domisili` varchar(100) NOT NULL,
  `skorTes` int(11) NOT NULL DEFAULT 0,
  `pengalamanTahun` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kandidat` (`id`, `nama`, `posisi`, `domisili`, `skorTes`, `pengalamanTahun`) VALUES
(1, 'Raka Pratama', 'Backend Developer', 'Bandung', 92, 3),
(2, 'Sinta Maharani', 'UI/UX Designer', 'Jakarta', 88, 2),
(3, 'Dimas Nugroho', 'Data Analyst', 'Yogyakarta', 85, 1),
(4, 'Nadia Kusuma', 'Frontend Developer', 'Surabaya', 90, 2),
(5, 'Bagas Setiawan', 'QA Engineer', 'Bandung', 81, 1);

-- --------------------------------------------------------
-- Struktur & Data Awal Tabel `lowongan` (Modul HR Tambahan)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lowongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judulPosisi` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kuota` int(11) NOT NULL DEFAULT 1,
  `status` varchar(50) NOT NULL DEFAULT 'Dibuka',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `lowongan` (`id`, `judulPosisi`, `departemen`, `lokasi`, `kuota`, `status`) VALUES
(1, 'Backend Developer', 'Engineering', 'Bandung', 2, 'Dibuka'),
(2, 'UI/UX Designer', 'Product & Design', 'Jakarta', 1, 'Dibuka'),
(3, 'Data Analyst', 'Data & Analytics', 'Yogyakarta', 1, 'Dibuka'),
(4, 'Frontend Developer', 'Engineering', 'Surabaya', 2, 'Dibuka'),
(5, 'QA Engineer', 'Quality Assurance', 'Bandung', 1, 'Ditutup');
