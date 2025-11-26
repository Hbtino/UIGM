-- Tabel untuk menyimpan laporan dosen
CREATE TABLE IF NOT EXISTS `laporan_dosen` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `program_studi` varchar(255) DEFAULT NULL,
  `data_laporan` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_dosen_user_id_foreign` (`user_id`),
  CONSTRAINT `laporan_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel untuk menyimpan laporan kaprodi
CREATE TABLE IF NOT EXISTS `laporan_kaprodi` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
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
