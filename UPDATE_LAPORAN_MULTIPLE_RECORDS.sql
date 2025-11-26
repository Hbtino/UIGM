-- Update database untuk mendukung multiple laporan records
-- Backup data lama terlebih dahulu jika ada

-- Drop foreign key constraints
ALTER TABLE `laporan_dosen` DROP FOREIGN KEY `laporan_dosen_user_id_foreign`;
ALTER TABLE `laporan_kaprodi` DROP FOREIGN KEY `laporan_kaprodi_user_id_foreign`;

-- Drop existing tables
DROP TABLE IF EXISTS `laporan_dosen`;
DROP TABLE IF EXISTS `laporan_kaprodi`;

-- Recreate laporan_dosen table with support for multiple records per user
CREATE TABLE `laporan_dosen` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `program_studi` varchar(255) DEFAULT NULL,
  `data_laporan` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_dosen_user_id_foreign` (`user_id`),
  CONSTRAINT `laporan_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Recreate laporan_kaprodi table with support for multiple records per user
CREATE TABLE `laporan_kaprodi` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `prodi_name` varchar(255) DEFAULT NULL,
  `kaprodi_name` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `data_laporan` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_kaprodi_user_id_foreign` (`user_id`),
  CONSTRAINT `laporan_kaprodi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
