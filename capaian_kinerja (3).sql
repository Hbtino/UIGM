-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 03:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capaian_kinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `capaiankinerja`
--

CREATE TABLE `capaiankinerja` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` enum('draft','submitted','approved') DEFAULT 'draft',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_content`
--

CREATE TABLE `dashboard_content` (
  `id` int(11) UNSIGNED NOT NULL,
  `section` varchar(100) NOT NULL COMMENT 'Section name: header, about, stats, ranking, etc',
  `key` varchar(100) NOT NULL COMMENT 'Content key identifier',
  `value` text NOT NULL COMMENT 'Content value (text, number, JSON)',
  `type` varchar(50) NOT NULL DEFAULT 'text' COMMENT 'Data type: text, number, json, html',
  `description` text DEFAULT NULL COMMENT 'Description for admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard_content`
--

INSERT INTO `dashboard_content` (`id`, `section`, `key`, `value`, `type`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'hero', 'title', 'UI GreenMetric', 'text', 'Hero title', 1, NULL, NULL),
(2, 'hero', 'subtitle', 'World University Rankings', 'text', 'Hero subtitle', 1, NULL, NULL),
(3, 'hero', 'description', 'Universitas Indonesia berkomitmen untuk menjadi kampus hijau yang berkelanjutan', 'text', 'Hero description', 1, NULL, NULL),
(4, 'stats', 'total_score', '8450', 'number', 'Total score current year', 1, NULL, NULL),
(5, 'stats', 'world_rank', '52', 'number', 'World ranking current year', 1, NULL, NULL),
(6, 'stats', 'indonesia_rank', '1', 'number', 'Indonesia ranking current year', 1, NULL, NULL),
(7, 'stats', 'year', '2024', 'number', 'Current assessment year', 1, NULL, NULL),
(8, 'criteria_indicator', 'si_percent', '85', 'number', 'Setting & Infrastructure percentage', 1, NULL, NULL),
(9, 'criteria_indicator', 'ec_percent', '78', 'number', 'Energy & Climate percentage', 1, NULL, NULL),
(10, 'criteria_indicator', 'ws_percent', '92', 'number', 'Waste Management percentage', 1, NULL, NULL),
(11, 'criteria_indicator', 'wr_percent', '88', 'number', 'Water Management percentage', 1, NULL, NULL),
(12, 'criteria_indicator', 'tr_percent', '75', 'number', 'Transportation percentage', 1, NULL, NULL),
(13, 'criteria_indicator', 'ed_percent', '90', 'number', 'Education & Research percentage', 1, NULL, NULL),
(14, 'total_score', '2023', '8200', 'number', 'Total score 2023', 1, NULL, NULL),
(15, 'total_score', '2024', '8450', 'number', 'Total score 2024', 1, NULL, NULL),
(16, 'total_score', '2025', '8600', 'number', 'Total score 2025 (target)', 1, NULL, NULL),
(17, 'total_score', '2026', '8750', 'number', 'Total score 2026 (target)', 1, NULL, NULL),
(18, 'total_score', '2027', '8900', 'number', 'Total score 2027 (target)', 1, NULL, NULL),
(19, 'total_score', '2028', '9000', 'number', 'Total score 2028 (target)', 1, NULL, NULL),
(20, 'ranking_world', '2023', '60', 'number', 'World ranking 2023', 1, NULL, NULL),
(21, 'ranking_world', '2024', '52', 'number', 'World ranking 2024', 1, NULL, NULL),
(22, 'ranking_world', '2025', '45', 'number', 'World ranking 2025 (target)', 1, NULL, NULL),
(23, 'ranking_world', '2026', '40', 'number', 'World ranking 2026 (target)', 1, NULL, NULL),
(24, 'ranking_world', '2027', '35', 'number', 'World ranking 2027 (target)', 1, NULL, NULL),
(25, 'ranking_world', '2028', '30', 'number', 'World ranking 2028 (target)', 1, NULL, NULL),
(26, 'ranking_indonesia', '2023', '1', 'number', 'Indonesia ranking 2023', 1, NULL, NULL),
(27, 'ranking_indonesia', '2024', '1', 'number', 'Indonesia ranking 2024', 1, NULL, NULL),
(28, 'ranking_indonesia', '2025', '1', 'number', 'Indonesia ranking 2025 (target)', 1, NULL, NULL),
(29, 'ranking_indonesia', '2026', '1', 'number', 'Indonesia ranking 2026 (target)', 1, NULL, NULL),
(30, 'ranking_indonesia', '2027', '1', 'number', 'Indonesia ranking 2027 (target)', 1, NULL, NULL),
(31, 'ranking_indonesia', '2028', '1', 'number', 'Indonesia ranking 2028 (target)', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `education_research`
--

CREATE TABLE `education_research` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` int(4) NOT NULL,
  `total_konsumsi_air` decimal(15,2) NOT NULL COMMENT 'Total konsumsi air dalam m³',
  `air_daur_ulang` decimal(15,2) NOT NULL COMMENT 'Air daur ulang dalam m³',
  `persentase_air_daur_ulang` decimal(5,2) NOT NULL COMMENT 'Auto-calculated percentage',
  `konsumsi_air_per_orang` decimal(10,2) NOT NULL COMMENT 'Auto-calculated per capita',
  `program_konservasi_air` tinyint(1) NOT NULL DEFAULT 0,
  `sistem_daur_ulang_air` tinyint(1) NOT NULL DEFAULT 0,
  `teknologi_hemat_air` tinyint(1) NOT NULL DEFAULT 0,
  `program_edukasi_air` tinyint(1) NOT NULL DEFAULT 0,
  `capaian_persen` decimal(5,2) NOT NULL COMMENT 'Auto-calculated achievement',
  `keterangan` text DEFAULT NULL,
  `status_verifikasi` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL,
  `verified_by` int(11) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education_research_revisions`
--

CREATE TABLE `education_research_revisions` (
  `id` int(11) UNSIGNED NOT NULL,
  `education_research_id` int(11) UNSIGNED NOT NULL,
  `revision_type` enum('request','approved','rejected') NOT NULL DEFAULT 'request',
  `requested_by` int(11) UNSIGNED NOT NULL,
  `alasan_revisi` text NOT NULL,
  `data_revisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_revisi`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` int(11) UNSIGNED DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `energy_climate`
--

CREATE TABLE `energy_climate` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` int(4) NOT NULL,
  `total_konsumsi_listrik` decimal(15,2) NOT NULL COMMENT 'Total konsumsi listrik dalam kWh',
  `konsumsi_energi_terbarukan` decimal(15,2) NOT NULL COMMENT 'Konsumsi energi terbarukan dalam kWh',
  `persentase_energi_terbarukan` decimal(5,2) NOT NULL COMMENT 'Auto-calculated percentage',
  `peralatan_hemat_energi` int(11) NOT NULL COMMENT 'Jumlah peralatan hemat energi',
  `bangunan_cerdas` int(11) NOT NULL COMMENT 'Jumlah bangunan cerdas',
  `jumlah_energi_terbarukan` int(11) NOT NULL COMMENT 'Jumlah sumber energi terbarukan',
  `total_listrik_per_orang` decimal(10,2) NOT NULL COMMENT 'Total listrik per orang (kWh)',
  `rasio_energi_terbarukan` decimal(10,2) NOT NULL COMMENT 'Auto-calculated ratio',
  `bangunan_ramah_lingkungan` int(11) NOT NULL COMMENT 'Jumlah bangunan ramah lingkungan',
  `program_pengurangan_emisi` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Ada program pengurangan emisi (0/1)',
  `jejak_karbon_per_orang` decimal(10,2) NOT NULL COMMENT 'Jejak karbon per orang (ton CO2)',
  `program_inovatif_energi` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Ada program inovatif energi (0/1)',
  `program_dampak_iklim` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Ada program dampak iklim (0/1)',
  `capaian_persen` decimal(5,2) NOT NULL COMMENT 'Auto-calculated achievement percentage',
  `keterangan` text DEFAULT NULL,
  `status_verifikasi` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL,
  `verified_by` int(11) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `energy_climate_revisions`
--

CREATE TABLE `energy_climate_revisions` (
  `id` int(11) UNSIGNED NOT NULL,
  `energy_climate_id` int(11) UNSIGNED NOT NULL,
  `revision_type` enum('request','approved','rejected') NOT NULL DEFAULT 'request',
  `requested_by` int(11) UNSIGNED NOT NULL,
  `alasan_revisi` text NOT NULL,
  `data_revisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_revisi`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` int(11) UNSIGNED DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_contents`
--

CREATE TABLE `landing_contents` (
  `id` int(11) UNSIGNED NOT NULL,
  `section` varchar(50) NOT NULL COMMENT 'deskripsi, program, berita, kontak',
  `title` varchar(255) NOT NULL COMMENT 'Judul section',
  `subtitle` varchar(255) DEFAULT NULL COMMENT 'Subtitle section',
  `content` text NOT NULL COMMENT 'Konten section',
  `image` varchar(255) DEFAULT NULL COMMENT 'Gambar section',
  `button_text` varchar(100) DEFAULT NULL COMMENT 'Text tombol (jika ada)',
  `button_url` varchar(255) DEFAULT NULL COMMENT 'URL tombol (jika ada)',
  `order` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampil',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=aktif, 0=nonaktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_contents`
--

INSERT INTO `landing_contents` (`id`, `section`, `title`, `subtitle`, `content`, `image`, `button_text`, `button_url`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'deskripsi', 'Tentang Kampus Berkelanjutan', 'Komitmen Kami untuk Lingkungan', '<p>Politeknik Negeri Bandung berkomitmen untuk menjadi kampus berkelanjutan yang peduli terhadap lingkungan. Kami mengintegrasikan prinsip-prinsip keberlanjutan dalam setiap aspek operasional kampus.</p><p>Melalui berbagai program dan inisiatif, kami berupaya mengurangi dampak lingkungan, meningkatkan efisiensi energi, dan menciptakan lingkungan kampus yang hijau dan sehat.</p>', '1764141549_255cfdaeed32c059c614.png', 'Pelajari Lebih Lanjut', '#program', 0, 1, '2025-11-24 14:01:36', '2025-11-26 07:19:26'),
(2, 'program', 'Program Kampus Berkelanjutan', 'Inisiatif Kami', '<ul><li><strong>Pengelolaan Energi:</strong> Penggunaan energi terbarukan dan efisiensi energi</li><li><strong>Manajemen Air:</strong> Konservasi air dan pengolahan air limbah</li><li><strong>Pengelolaan Limbah:</strong> Reduce, reuse, recycle</li><li><strong>Transportasi Hijau:</strong> Promosi transportasi ramah lingkungan</li><li><strong>Ruang Terbuka Hijau:</strong> Peningkatan area hijau kampus</li><li><strong>Pendidikan Lingkungan:</strong> Integrasi dalam kurikulum</li></ul>', NULL, 'Lihat Detail Program', '/dashboard', 2, 1, '2025-11-24 14:01:36', NULL),
(3, 'kontak', 'Hubungi Kami', 'Tim Kampus Berkelanjutan', '<p><strong>Email:</strong> greenmetric@polban.ac.id</p><p><strong>Telepon:</strong> (022) 1234567</p><p><strong>Alamat:</strong> Jl. Gegerkalong Hilir, Bandung 40559</p><p><strong>Jam Operasional:</strong> Senin - Jumat, 08:00 - 16:00 WIB</p>', NULL, 'Kirim Pesan', 'mailto:greenmetric@polban.ac.id', 4, 1, '2025-11-24 14:01:36', NULL),
(4, 'berita', 'Berita Terkini', 'Update Kampus Berkelanjutan', '<p>Ikuti perkembangan terbaru</p>', NULL, 'Lihat Semua Berita', '/news-admin', 3, 1, '2025-11-24 15:03:59', NULL),
(5, 'berita', 'Berita Terkini', 'Update Kampus Berkelanjutan', '<p>Ikuti perkembangan terbaru program kampus berkelanjutan kami</p>', NULL, 'Lihat Semua Berita', '/news-admin', 3, 1, '2025-11-24 15:14:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_dosen`
--

CREATE TABLE `laporan_dosen` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `program_studi` varchar(255) DEFAULT NULL,
  `data_laporan` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_dosen`
--

INSERT INTO `laporan_dosen` (`id`, `user_id`, `user_name`, `jurusan`, `program_studi`, `data_laporan`, `created_at`, `updated_at`) VALUES
(1, 23, 'Ahmad Hidayat', 'jjjjj', 'jjjjjj', '{\"user_id\":\"23\",\"user_name\":\"Ahmad Hidayat\",\"selected_dosen_id\":\"23\",\"jurusan\":\"jjjjj\",\"program_studi\":\"jjjjjj\",\"mata_kuliah\":\"[{\\\"kode\\\":\\\"12345\\\",\\\"nama\\\":\\\"qwerty\\\",\\\"deskripsi\\\":\\\"jkl\\\",\\\"sks\\\":\\\"78\\\"},{\\\"kode\\\":\\\"\\\",\\\"nama\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"sks\\\":\\\"\\\"}]\",\"acara\":\"[{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"},{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"}]\",\"praktik\":\"[{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"}]\",\"kontribusi\":\"[{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"},{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"}]\"}', '2025-11-25 05:45:30', '2025-11-25 05:45:30'),
(2, 23, 'Ahmad Hidayat', 'jjjjj', 'jjjjjj', '{\"user_id\":\"23\",\"user_name\":\"Ahmad Hidayat\",\"selected_dosen_id\":\"23\",\"jurusan\":\"jjjjj\",\"program_studi\":\"jjjjjj\",\"mata_kuliah\":\"[{\\\"kode\\\":\\\"123456\\\",\\\"nama\\\":\\\"qwrty\\\",\\\"deskripsi\\\":\\\"wdfghjk\\\",\\\"sks\\\":\\\"76\\\"},{\\\"kode\\\":\\\"\\\",\\\"nama\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"sks\\\":\\\"\\\"}]\",\"acara\":\"[{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"},{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"}]\",\"praktik\":\"[{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"}]\",\"kontribusi\":\"[{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"},{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"}]\"}', '2025-11-25 06:26:54', '2025-11-25 06:26:54'),
(3, 23, 'Ahmad Hidayat', 'jjj', 'jjj', '{\"user_id\":\"23\",\"user_name\":\"Ahmad Hidayat\",\"selected_dosen_id\":\"23\",\"jurusan\":\"jjj\",\"program_studi\":\"jjj\",\"mata_kuliah\":\"[{\\\"kode\\\":\\\"123456\\\",\\\"nama\\\":\\\"nnn\\\",\\\"deskripsi\\\":\\\"hjk\\\",\\\"sks\\\":\\\"67\\\"},{\\\"kode\\\":\\\"\\\",\\\"nama\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"sks\\\":\\\"\\\"}]\",\"acara\":\"[{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"},{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"}]\",\"praktik\":\"[{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"}]\",\"kontribusi\":\"[{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"},{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"}]\"}', '2025-11-25 06:46:32', '2025-11-25 06:46:32'),
(4, 23, 'Ahmad Hidayat', 'jjjjj', 'jjjjjj', '{\"user_id\":\"23\",\"user_name\":\"Ahmad Hidayat\",\"selected_dosen_id\":\"23\",\"jurusan\":\"jjjjj\",\"program_studi\":\"jjjjjj\",\"mata_kuliah\":\"[{\\\"kode\\\":\\\"1234\\\",\\\"nama\\\":\\\"nn\\\",\\\"deskripsi\\\":\\\"bjndnsj\\\",\\\"sks\\\":\\\"12\\\"},{\\\"kode\\\":\\\"\\\",\\\"nama\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"sks\\\":\\\"\\\"}]\",\"acara\":\"[{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"},{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"}]\",\"praktik\":\"[{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"}]\",\"kontribusi\":\"[{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"},{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"}]\"}', '2025-11-25 06:58:40', '2025-11-25 06:58:40'),
(5, 15, 'Dosen', 'jjjjj', 'jjjjjj', '{\"user_id\":\"15\",\"user_name\":\"Dosen\",\"selected_dosen_id\":\"15\",\"jurusan\":\"jjjjj\",\"program_studi\":\"jjjjjj\",\"mata_kuliah\":\"[{\\\"kode\\\":\\\"12345\\\",\\\"nama\\\":\\\"nn\\\",\\\"deskripsi\\\":\\\"mmmm\\\",\\\"sks\\\":\\\"123\\\"},{\\\"kode\\\":\\\"\\\",\\\"nama\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"sks\\\":\\\"\\\"}]\",\"acara\":\"[{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"},{\\\"nama\\\":\\\"\\\",\\\"tanggal\\\":\\\"\\\",\\\"peran\\\":\\\"Narasumber\\\",\\\"topik\\\":\\\"\\\"}]\",\"praktik\":\"[{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"},{\\\"inisiatif\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"WS\\\"}]\",\"kontribusi\":\"[{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"},{\\\"bentuk\\\":\\\"\\\",\\\"deskripsi\\\":\\\"\\\",\\\"kategori\\\":\\\"TR\\\"}]\"}', '2025-11-25 07:05:37', '2025-11-25 07:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kaprodi`
--

CREATE TABLE `laporan_kaprodi` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `prodi_name` varchar(255) DEFAULT NULL,
  `kaprodi_name` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `data_laporan` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'ID parent menu untuk submenu',
  `title` varchar(255) NOT NULL COMMENT 'Judul menu',
  `url` varchar(255) DEFAULT NULL COMMENT 'URL/route menu',
  `icon` varchar(100) DEFAULT NULL COMMENT 'Icon class (Font Awesome)',
  `order` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampilan menu',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=aktif, 0=nonaktif',
  `roles` text DEFAULT NULL COMMENT 'Role yang bisa akses (JSON array)',
  `menu_type` varchar(50) DEFAULT 'dashboard' COMMENT 'dashboard atau landing',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dashboard', '/dashboard', 'fas fa-tachometer-alt', 1, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', '2025-11-24 08:48:41'),
(2, NULL, 'Kriteria SDGs', '#', 'fas fa-leaf', 2, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(3, 2, 'Transportation', '/transportation', 'fas fa-car', 1, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(4, 2, 'Setting & Infrastructure', '/setting-infrastructure', 'fas fa-building', 2, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(5, 2, 'Energy & Climate', '/energy-climate', 'fas fa-bolt', 3, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(6, 2, 'Water Management', '/water-management', 'fas fa-tint', 4, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(7, 2, 'Waste Management', '/waste-management', 'fas fa-recycle', 5, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(8, 2, 'Education & Research', '/education-research', 'fas fa-graduation-cap', 6, 1, '[\"admin\",\"reviewer\",\"kaprodi\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(9, NULL, 'Manajemen User', '/users', 'fas fa-users', 3, 1, '[\"admin\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(11, NULL, 'Pengaturan', '/settings', 'fas fa-cog', 5, 1, '[\"admin\"]', 'dashboard', '2025-11-21 07:51:19', NULL),
(14, NULL, 'Deskripsi', '#deskripsi', 'fas fa-tachometer-alt', 101, 1, '[\"admin\",\"reviewer\",\"kaprodi\",\"dosen\"]', 'landing', '2025-11-24 09:49:32', '2025-11-24 08:49:11'),
(16, NULL, 'Berita', '#berita', NULL, 103, 1, '[\"admin\",\"reviewer\",\"kaprodi\",\"dosen\"]', 'landing', '2025-11-24 09:51:17', NULL),
(17, NULL, 'Kontak', '#kontak', NULL, 104, 1, '[\"admin\",\"reviewer\",\"kaprodi\",\"dosen\"]', 'landing', '2025-11-24 09:55:30', NULL),
(24, NULL, 'Manajemen Menu', '/menus', 'fas fa-bars', 105, 1, '[\"admin\"]', 'Dashboard', '2025-11-26 12:25:57', NULL),
(25, NULL, 'Manajemen Berita', '/news-admin', 'fas fa-newspaper', 106, 1, '[\"admin\"]', 'Dashboard', '2025-11-26 12:25:57', NULL),
(26, NULL, 'Konten Landing Page', '/landing-contents', 'fas fa-file-alt', 107, 1, '[\"admin\"]', 'Dashboard', '2025-11-26 12:25:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-10-23-040657', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1761193667, 1),
(2, '2025-10-23-040658', 'App\\Database\\Migrations\\CreateActivitiesTable', 'default', 'App', 1761193667, 1),
(3, '2025-10-23-040658', 'App\\Database\\Migrations\\CreatePerformanceTable', 'default', 'App', 1761193667, 1),
(4, '2025-11-13-000000', 'App\\Database\\Migrations\\CreateTransportationTable', 'default', 'App', 1763017761, 2),
(5, '2025-11-13-000002', 'App\\Database\\Migrations\\CreateTransportationRevisionsTable', 'default', 'App', 1763018216, 3),
(6, '2025-11-13-100000', 'App\\Database\\Migrations\\CreateSettingInfrastructureTable', 'default', 'App', 1763020150, 4),
(7, '2025-11-13-100001', 'App\\Database\\Migrations\\CreateSettingInfrastructureRevisionsTable', 'default', 'App', 1763020150, 4),
(8, '2025-11-13-200000', 'App\\Database\\Migrations\\AddApprovalStatusToUsers', 'default', 'App', 1763021298, 5),
(9, '2025-11-14-200000', 'App\\Database\\Migrations\\CreateEnergyClimateTable', 'default', 'App', 1763104975, 6),
(10, '2025-11-14-200001', 'App\\Database\\Migrations\\CreateEnergyClimateRevisionsTable', 'default', 'App', 1763104975, 6),
(11, '2025-11-14-300000', 'App\\Database\\Migrations\\CreateWaterManagementTable', 'default', 'App', 1763104975, 6),
(12, '2025-11-14-300001', 'App\\Database\\Migrations\\CreateWaterManagementRevisionsTable', 'default', 'App', 1763104975, 6),
(13, '2025-11-14-400000', 'App\\Database\\Migrations\\CreateWasteManagementTable', 'default', 'App', 1763104975, 6),
(14, '2025-11-14-400001', 'App\\Database\\Migrations\\CreateWasteManagementRevisionsTable', 'default', 'App', 1763104975, 6),
(15, '2025-11-14-500000', 'App\\Database\\Migrations\\CreateEducationResearchTable', 'default', 'App', 1763104975, 6),
(16, '2025-11-14-500001', 'App\\Database\\Migrations\\CreateEducationResearchRevisionsTable', 'default', 'App', 1763104975, 6),
(17, '2025-11-14-120000', 'App\\Database\\Migrations\\AddJurusanToUsers', 'default', 'App', 1763369021, 7),
(18, '2025-11-18-000001', 'App\\Database\\Migrations\\CreatePasswordChangeRequests', 'default', 'App', 1763441761, 8),
(19, '2025-11-18-060000', 'App\\Database\\Migrations\\AddProfilePhotoToUsers', 'default', 'App', 1763447732, 9),
(20, '2025-11-21-000001', 'App\\Database\\Migrations\\CreateMenusTable', 'default', 'App', 1763711443, 10),
(21, '2025-11-21-000002', 'App\\Database\\Migrations\\CreateNewsTable', 'default', 'App', 1763714413, 11),
(22, '2025-11-21-000003', 'App\\Database\\Migrations\\AddRememberTokenToUsers', 'default', 'App', 1763741973, 12),
(23, '2025-11-21-000004', 'App\\Database\\Migrations\\CreateDashboardContentTable', 'default', 'App', 1763915553, 13),
(24, '2024-01-01-000001', 'App\\Database\\Migrations\\CreateLaporanTable', 'default', 'App', 1764043920, 14),
(25, '2025-11-25-044702', 'App\\Database\\Migrations\\AddMultipleLaporanSupport', 'default', 'App', 1764046090, 15),
(26, '2025-11-26-083025', 'App\\Database\\Migrations\\AddRememberTokenActiveToUsers', 'default', 'App', 1764146079, 16);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Judul berita',
  `slug` varchar(255) NOT NULL COMMENT 'URL-friendly slug',
  `excerpt` text NOT NULL COMMENT 'Ringkasan berita',
  `content` text NOT NULL COMMENT 'Isi berita lengkap',
  `image` varchar(255) DEFAULT NULL COMMENT 'Gambar berita',
  `category` varchar(100) DEFAULT NULL COMMENT 'Kategori berita',
  `is_published` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=published, 0=draft',
  `published_at` datetime DEFAULT NULL COMMENT 'Tanggal publikasi',
  `views` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah views',
  `created_by` int(11) UNSIGNED NOT NULL COMMENT 'User ID pembuat',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `excerpt`, `content`, `image`, `category`, `is_published`, `published_at`, `views`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Polban Raih Peringkat UI GreenMetric 2024', 'polban-raih-peringkat-ui-greenmetric-2024', 'Politeknik Negeri Bandung berhasil meraih peringkat yang membanggakan dalam UI GreenMetric World University Rankings 2024, menunjukkan komitmen kampus terhadap keberlanjutan lingkungan.', '<p>Politeknik Negeri Bandung (Polban) kembali menunjukkan komitmennya terhadap keberlanjutan lingkungan dengan meraih peringkat yang membanggakan dalam UI GreenMetric World University Rankings 2024.</p>\r\n\r\n<p>Pencapaian ini merupakan hasil dari berbagai program dan inisiatif kampus hijau yang telah dilaksanakan secara konsisten, termasuk pengelolaan energi, air, limbah, dan transportasi yang ramah lingkungan.</p>\r\n\r\n<p>\"Kami sangat bangga dengan pencapaian ini. Ini adalah bukti nyata dari dedikasi seluruh civitas akademika Polban dalam mewujudkan kampus yang berkelanjutan,\" ujar Direktur Polban.</p>\r\n\r\n<p>Program-program unggulan yang berkontribusi terhadap pencapaian ini antara lain:</p>\r\n<ul>\r\n<li>Penggunaan energi terbarukan di seluruh gedung kampus</li>\r\n<li>Sistem pengelolaan air dan limbah yang efisien</li>\r\n<li>Program transportasi ramah lingkungan</li>\r\n<li>Peningkatan area hijau dan ruang terbuka</li>\r\n<li>Integrasi pendidikan keberlanjutan dalam kurikulum</li>\r\n</ul>\r\n\r\n<p>Polban akan terus berkomitmen untuk meningkatkan kualitas lingkungan kampus dan berkontribusi terhadap pencapaian Sustainable Development Goals (SDGs).</p>', 'news-greenmetric-2024.jpg', 'Prestasi', 1, '2025-11-19 08:41:26', 249, 1, '2025-11-19 08:41:26', NULL),
(2, 'Launching Sistem Monitoring Capaian SDGs Polban', 'launching-sistem-monitoring-capaian-sdgs-polban', 'Polban meluncurkan sistem monitoring capaian SDGs berbasis digital untuk memudahkan tracking dan pelaporan data keberlanjutan kampus secara real-time.', '<p>Dalam upaya meningkatkan transparansi dan efisiensi pengelolaan data keberlanjutan, Politeknik Negeri Bandung resmi meluncurkan Sistem Monitoring Capaian SDGs berbasis digital.</p>\r\n\r\n<p>Sistem ini dikembangkan oleh tim internal Polban dan dirancang khusus untuk memudahkan proses pengumpulan, verifikasi, dan pelaporan data terkait kriteria UI GreenMetric.</p>\r\n\r\n<h3>Fitur Unggulan Sistem:</h3>\r\n<ul>\r\n<li>Dashboard real-time untuk monitoring capaian</li>\r\n<li>Sistem verifikasi data multi-level</li>\r\n<li>Upload dan manajemen dokumen pendukung</li>\r\n<li>Perhitungan otomatis persentase capaian</li>\r\n<li>Laporan komprehensif untuk berbagai stakeholder</li>\r\n</ul>\r\n\r\n<p>\"Sistem ini akan sangat membantu kami dalam mengelola data keberlanjutan kampus secara lebih efektif dan efisien,\" kata Ketua Tim UI GreenMetric Polban.</p>\r\n\r\n<p>Dengan sistem ini, diharapkan Polban dapat terus meningkatkan kualitas data dan pelaporan untuk UI GreenMetric World University Rankings di tahun-tahun mendatang.</p>', '1764130870_82d960cc6bac6841dd2b.png', 'Teknologi', 1, '2025-11-20 08:41:26', 198, 1, '2025-11-20 08:41:26', '2025-11-26 04:21:10'),
(3, 'Workshop Kampus Berkelanjutan untuk Civitas Akademika', 'workshop-kampus-berkelanjutan-untuk-civitas-akademika', 'Polban mengadakan workshop tentang kampus berkelanjutan yang diikuti oleh dosen, tendik, dan mahasiswa untuk meningkatkan awareness terhadap isu lingkungan. seperti itu', '<p>Politeknik Negeri Bandung menggelar Workshop Kampus Berkelanjutan yang dihadiri oleh lebih dari 200 peserta dari kalangan dosen, tenaga kependidikan, dan mahasiswa.</p>\r\n\r\n<p>Workshop ini bertujuan untuk meningkatkan pemahaman dan kesadaran seluruh civitas akademika tentang pentingnya keberlanjutan lingkungan di kampus.</p>\r\n\r\n<h3>Materi Workshop:</h3>\r\n<ol>\r\n<li><strong>Pengenalan UI GreenMetric</strong> - Kriteria dan indikator penilaian</li>\r\n<li><strong>Pengelolaan Energi</strong> - Efisiensi dan energi terbarukan</li>\r\n<li><strong>Manajemen Air dan Limbah</strong> - Best practices pengelolaan</li>\r\n<li><strong>Transportasi Ramah Lingkungan</strong> - Strategi pengurangan emisi</li>\r\n<li><strong>Green Building</strong> - Konsep bangunan hijau</li>\r\n<li><strong>Pendidikan Keberlanjutan</strong> - Integrasi dalam pembelajaran</li>\r\n</ol>\r\n\r\n<p>Narasumber workshop adalah para ahli dari berbagai universitas terkemuka dan praktisi di bidang keberlanjutan lingkungan.</p>\r\n\r\n<p>\"Workshop ini sangat bermanfaat untuk meningkatkan kapasitas kami dalam mendukung program kampus berkelanjutan,\" ujar salah satu peserta.</p>\r\n\r\n<p>Ke depannya, Polban akan terus mengadakan kegiatan serupa secara berkala untuk memastikan seluruh civitas akademika memiliki pemahaman yang sama tentang pentingnya keberlanjutan.</p>', '1764130346_3edeaa5ac01dcd19fef9.png', 'Kegiatan', 1, '2025-11-24 12:41:05', 168, 1, '2025-11-21 08:41:26', '2025-11-26 04:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_change_requests`
--

CREATE TABLE `password_change_requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `new_password` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `requested_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `processed_by` int(11) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_change_requests`
--

INSERT INTO `password_change_requests` (`id`, `user_id`, `new_password`, `status`, `requested_at`, `processed_at`, `processed_by`, `notes`) VALUES
(1, 16, '$2y$10$ZopkCY6PvzmtXi1dWABrouXJ.yt7H1cPYC/dooV2S7M1cn4jA7bjK', 'approved', '2025-11-18 05:38:47', '2025-11-18 06:12:20', 2, NULL),
(2, 21, '$2y$10$efZuIhJXSZBGNKwQLiHAh.8zEYnnj5EdD8Rq1tRPmjhx3YsUf2eM6', 'approved', '2025-11-18 05:49:22', '2025-11-18 06:12:14', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE `performance` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `metric` varchar(150) NOT NULL,
  `target` decimal(10,2) NOT NULL,
  `achievement` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_infrastructure`
--

CREATE TABLE `setting_infrastructure` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` int(4) NOT NULL,
  `luas_ruang_terbuka` decimal(12,2) NOT NULL DEFAULT 0.00,
  `luas_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `persentase_area_hijau` decimal(5,2) NOT NULL DEFAULT 0.00,
  `vegetasi_hutan` decimal(12,2) NOT NULL DEFAULT 0.00,
  `area_tanaman` decimal(12,2) NOT NULL DEFAULT 0.00,
  `area_resapan` decimal(12,2) NOT NULL DEFAULT 0.00,
  `persentase_anggaran` decimal(5,2) NOT NULL DEFAULT 0.00,
  `persentase_pemeliharaan` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fasilitas_disabilitas` text DEFAULT NULL,
  `fasilitas_energi_terbarukan` text DEFAULT NULL,
  `capaian_persen` decimal(5,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `status_verifikasi` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL,
  `verified_by` int(11) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting_infrastructure_revisions`
--

CREATE TABLE `setting_infrastructure_revisions` (
  `id` int(11) UNSIGNED NOT NULL,
  `setting_infrastructure_id` int(11) UNSIGNED NOT NULL,
  `revision_type` enum('request','approved','rejected') NOT NULL DEFAULT 'request',
  `requested_by` int(11) UNSIGNED NOT NULL,
  `alasan_revisi` text NOT NULL,
  `data_revisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_revisi`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` int(11) UNSIGNED DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` int(4) NOT NULL,
  `total_perjalanan` int(11) NOT NULL DEFAULT 0,
  `perjalanan_ramah_lingkungan` int(11) NOT NULL DEFAULT 0,
  `jumlah_kendaraan` int(11) NOT NULL DEFAULT 0,
  `jumlah_populasi` int(11) NOT NULL DEFAULT 0,
  `rasio_kendaraan` varchar(50) DEFAULT NULL,
  `layanan_antar_jemput` varchar(255) DEFAULT NULL,
  `kebijakan_zev` varchar(255) DEFAULT NULL,
  `luas_parkir` varchar(50) DEFAULT NULL,
  `program_pembatasan_parkir` varchar(255) DEFAULT NULL,
  `inisiatif_pengurangan_kendaraan` int(11) NOT NULL DEFAULT 0,
  `jalur_pejalan_kaki` varchar(255) DEFAULT NULL,
  `sepeda_kampus` int(11) NOT NULL DEFAULT 0,
  `capaian_persen` decimal(5,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `status_verifikasi` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL,
  `verified_by` int(11) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transportation_revisions`
--

CREATE TABLE `transportation_revisions` (
  `id` int(11) UNSIGNED NOT NULL,
  `transportation_id` int(11) UNSIGNED NOT NULL,
  `revision_type` enum('request','approved','rejected') NOT NULL DEFAULT 'request',
  `requested_by` int(11) UNSIGNED NOT NULL,
  `alasan_revisi` text NOT NULL,
  `data_revisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_revisi`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` int(11) UNSIGNED DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL COMMENT 'Token untuk remember me functionality',
  `role` enum('admin','dosen','kaprodi','mahasiswa') NOT NULL DEFAULT 'mahasiswa',
  `jurusan` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` int(11) UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token_expires` datetime DEFAULT NULL,
  `remember_token_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `role`, `jurusan`, `profile_photo`, `approval_status`, `approved_by`, `approved_at`, `rejection_reason`, `created_at`, `updated_at`, `remember_token_expires`, `remember_token_active`) VALUES
(2, 'nabil muhammad', 'sayang@gmail.com', '$2y$10$fkPEK.Sxr1uMyzKWdqvN/eskBKb2gTgsRTF15jYAQBM38Zp.7Vlei', 'd259b07c3744caae136765134720e485074c25bcf4f05b6bec5dd1b68b85c1eb', 'admin', '', 'profile_2_1763448614.png', 'approved', 5, '2025-11-14 06:23:29', NULL, '2025-10-23 05:40:20', '2025-11-26 15:54:42', '2025-12-26 08:54:23', 0),
(5, 'Habib', 'habibtino83@gmail.com', '$2y$10$BmxKvSE/XGW3UT/EPO/Yy.zhIxu4XvZFjdVRnM1jDHyEdhRgaWpXe', NULL, 'admin', NULL, NULL, 'approved', 5, '2025-11-14 06:23:32', NULL, '2025-10-23 06:43:57', '2025-11-14 06:23:32', NULL, 1),
(15, 'Dosen', 'dosen@gmail.com', '$2y$10$rDI3OSEGaBUsGP.G2.s1gup/J1SoxrkwFwYGuPimJkZsGvyE2DBfu', NULL, 'dosen', NULL, NULL, 'approved', 5, '2025-11-14 06:23:36', NULL, '2025-10-24 12:05:24', '2025-11-14 06:23:36', NULL, 1),
(16, 'Kaprodi', 'kaprodi@gmail.com', '$2y$10$ZopkCY6PvzmtXi1dWABrouXJ.yt7H1cPYC/dooV2S7M1cn4jA7bjK', NULL, 'kaprodi', 'Jurusan Teknik Mesin', 'profile_16_1763448570.png', 'approved', 5, '2025-11-14 06:23:39', NULL, '2025-10-24 12:06:53', '2025-11-18 06:49:30', NULL, 1),
(19, 'SMK TI Garuda Nusantara', 'Sekola@gmail.com', '$2y$10$zpuf7CJCghrHbrsEmxY4BuBC/4qzgHlGtHXiJnuHwbh7zKo8a7eTW', NULL, 'admin', NULL, NULL, 'approved', 5, '2025-11-14 06:23:43', NULL, '2025-11-11 08:07:21', '2025-11-14 06:23:43', NULL, 1),
(20, 'yani', 'polban@gmail.com', '$2y$10$P03mR7C/kf0VXDvtunbVe.uWSMa.sLBS2xiOtTErITmcm7vNJmpr2', NULL, 'admin', NULL, NULL, 'approved', 5, '2025-11-14 06:23:45', NULL, '2025-11-12 08:02:00', '2025-11-14 06:23:45', NULL, 1),
(21, 'Lutungkasarung', 'Mabarepep@gmail.com', '$2y$10$efZuIhJXSZBGNKwQLiHAh.8zEYnnj5EdD8Rq1tRPmjhx3YsUf2eM6', NULL, 'mahasiswa', 'Jurusan Teknik Sipil', NULL, 'approved', 5, '2025-11-14 06:23:24', NULL, '2025-11-13 08:41:27', '2025-11-18 06:12:14', NULL, 1),
(23, 'Ahmad Hidayat', 'Madsky@gmail.com', '$2y$10$O4wFWrzKq9JL.bRxFkK2N.z5lHebKPzEmCVz76EwFl.RHNPSKZ9.C', NULL, 'dosen', 'Jurusan Teknik Elektro', NULL, 'approved', 5, '2025-11-14 08:59:35', NULL, '2025-11-14 08:59:11', '2025-11-19 08:29:16', NULL, 1),
(25, 'Grace', 'grace@gmail.com', '$2y$10$NEFWGTlyz8vJYtnfj1QOw.LbSSOQ1KZr6zEGj4OoysnDiF.f/BJzO', NULL, 'mahasiswa', 'Jurusan Teknik Komputer dan Informatika', NULL, 'approved', 2, '2025-11-19 02:51:34', NULL, '2025-11-19 02:50:07', '2025-11-19 08:29:03', NULL, 1),
(26, 'kiranti', 'kiran@gmail.com', '$2y$10$mjnejZpBZRsEPrbsKOM2V.iWuI8K5YbAH1TrFyMTuoO/gRg0OWfX2', NULL, 'mahasiswa', NULL, NULL, 'approved', 2, '2025-11-21 08:52:16', NULL, '2025-11-20 06:53:04', '2025-11-21 08:52:16', NULL, 1),
(27, 'mobil brem brem', 'mobil@gmail.com', '$2y$10$yg7fyrgaZemCLpnYDYI9/uWyspCFkNxDSVP6KU8zg/PvEF7SHUZde', NULL, 'mahasiswa', NULL, NULL, 'approved', 2, '2025-11-21 08:52:13', NULL, '2025-11-20 07:21:41', '2025-11-21 08:52:13', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `waste_management`
--

CREATE TABLE `waste_management` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` int(4) NOT NULL,
  `total_konsumsi_air` decimal(15,2) NOT NULL COMMENT 'Total konsumsi air dalam m³',
  `air_daur_ulang` decimal(15,2) NOT NULL COMMENT 'Air daur ulang dalam m³',
  `persentase_air_daur_ulang` decimal(5,2) NOT NULL COMMENT 'Auto-calculated percentage',
  `konsumsi_air_per_orang` decimal(10,2) NOT NULL COMMENT 'Auto-calculated per capita',
  `program_konservasi_air` tinyint(1) NOT NULL DEFAULT 0,
  `sistem_daur_ulang_air` tinyint(1) NOT NULL DEFAULT 0,
  `teknologi_hemat_air` tinyint(1) NOT NULL DEFAULT 0,
  `program_edukasi_air` tinyint(1) NOT NULL DEFAULT 0,
  `capaian_persen` decimal(5,2) NOT NULL COMMENT 'Auto-calculated achievement',
  `keterangan` text DEFAULT NULL,
  `status_verifikasi` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL,
  `verified_by` int(11) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waste_management_revisions`
--

CREATE TABLE `waste_management_revisions` (
  `id` int(11) UNSIGNED NOT NULL,
  `waste_management_id` int(11) UNSIGNED NOT NULL,
  `revision_type` enum('request','approved','rejected') NOT NULL DEFAULT 'request',
  `requested_by` int(11) UNSIGNED NOT NULL,
  `alasan_revisi` text NOT NULL,
  `data_revisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_revisi`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` int(11) UNSIGNED DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_management`
--

CREATE TABLE `water_management` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` int(4) NOT NULL,
  `total_konsumsi_air` decimal(15,2) NOT NULL COMMENT 'Total konsumsi air dalam m³',
  `air_daur_ulang` decimal(15,2) NOT NULL COMMENT 'Air daur ulang dalam m³',
  `persentase_air_daur_ulang` decimal(5,2) NOT NULL COMMENT 'Auto-calculated percentage',
  `konsumsi_air_per_orang` decimal(10,2) NOT NULL COMMENT 'Auto-calculated per capita',
  `program_konservasi_air` tinyint(1) NOT NULL DEFAULT 0,
  `sistem_daur_ulang_air` tinyint(1) NOT NULL DEFAULT 0,
  `teknologi_hemat_air` tinyint(1) NOT NULL DEFAULT 0,
  `program_edukasi_air` tinyint(1) NOT NULL DEFAULT 0,
  `capaian_persen` decimal(5,2) NOT NULL COMMENT 'Auto-calculated achievement',
  `keterangan` text DEFAULT NULL,
  `status_verifikasi` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` text DEFAULT NULL,
  `bukti_pendukung` varchar(255) DEFAULT NULL,
  `verified_by` int(11) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `water_management_revisions`
--

CREATE TABLE `water_management_revisions` (
  `id` int(11) UNSIGNED NOT NULL,
  `water_management_id` int(11) UNSIGNED NOT NULL,
  `revision_type` enum('request','approved','rejected') NOT NULL DEFAULT 'request',
  `requested_by` int(11) UNSIGNED NOT NULL,
  `alasan_revisi` text NOT NULL,
  `data_revisi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_revisi`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` int(11) UNSIGNED DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `capaiankinerja`
--
ALTER TABLE `capaiankinerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dashboard_content`
--
ALTER TABLE `dashboard_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section` (`section`),
  ADD KEY `key` (`key`);

--
-- Indexes for table `education_research`
--
ALTER TABLE `education_research`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`),
  ADD KEY `status_verifikasi` (`status_verifikasi`);

--
-- Indexes for table `education_research_revisions`
--
ALTER TABLE `education_research_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_research_id` (`education_research_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `energy_climate`
--
ALTER TABLE `energy_climate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`),
  ADD KEY `status_verifikasi` (`status_verifikasi`);

--
-- Indexes for table `energy_climate_revisions`
--
ALTER TABLE `energy_climate_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `energy_climate_id` (`energy_climate_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `landing_contents`
--
ALTER TABLE `landing_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section` (`section`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `laporan_dosen`
--
ALTER TABLE `laporan_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_dosen_user_id_foreign` (`user_id`);

--
-- Indexes for table `laporan_kaprodi`
--
ALTER TABLE `laporan_kaprodi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_kaprodi_user_id_foreign` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `order` (`order`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`),
  ADD KEY `is_published` (`is_published`),
  ADD KEY `published_at` (`published_at`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `password_change_requests`
--
ALTER TABLE `password_change_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_change_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performance_user_id_foreign` (`user_id`),
  ADD KEY `performance_activity_id_foreign` (`activity_id`);

--
-- Indexes for table `setting_infrastructure`
--
ALTER TABLE `setting_infrastructure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`);

--
-- Indexes for table `setting_infrastructure_revisions`
--
ALTER TABLE `setting_infrastructure_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_infrastructure_id` (`setting_infrastructure_id`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`);

--
-- Indexes for table `transportation_revisions`
--
ALTER TABLE `transportation_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportation_id` (`transportation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `waste_management`
--
ALTER TABLE `waste_management`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`),
  ADD KEY `status_verifikasi` (`status_verifikasi`);

--
-- Indexes for table `waste_management_revisions`
--
ALTER TABLE `waste_management_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste_management_id` (`waste_management_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `water_management`
--
ALTER TABLE `water_management`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`),
  ADD KEY `status_verifikasi` (`status_verifikasi`);

--
-- Indexes for table `water_management_revisions`
--
ALTER TABLE `water_management_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `water_management_id` (`water_management_id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `capaiankinerja`
--
ALTER TABLE `capaiankinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard_content`
--
ALTER TABLE `dashboard_content`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `education_research`
--
ALTER TABLE `education_research`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education_research_revisions`
--
ALTER TABLE `education_research_revisions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `energy_climate`
--
ALTER TABLE `energy_climate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `energy_climate_revisions`
--
ALTER TABLE `energy_climate_revisions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_contents`
--
ALTER TABLE `landing_contents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laporan_dosen`
--
ALTER TABLE `laporan_dosen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_kaprodi`
--
ALTER TABLE `laporan_kaprodi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_change_requests`
--
ALTER TABLE `password_change_requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `performance`
--
ALTER TABLE `performance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_infrastructure`
--
ALTER TABLE `setting_infrastructure`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting_infrastructure_revisions`
--
ALTER TABLE `setting_infrastructure_revisions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transportation_revisions`
--
ALTER TABLE `transportation_revisions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `waste_management`
--
ALTER TABLE `waste_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waste_management_revisions`
--
ALTER TABLE `waste_management_revisions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `water_management`
--
ALTER TABLE `water_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `water_management_revisions`
--
ALTER TABLE `water_management_revisions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `capaiankinerja`
--
ALTER TABLE `capaiankinerja`
  ADD CONSTRAINT `capaiankinerja_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_dosen`
--
ALTER TABLE `laporan_dosen`
  ADD CONSTRAINT `laporan_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_kaprodi`
--
ALTER TABLE `laporan_kaprodi`
  ADD CONSTRAINT `laporan_kaprodi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_change_requests`
--
ALTER TABLE `password_change_requests`
  ADD CONSTRAINT `password_change_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `performance_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performance_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
