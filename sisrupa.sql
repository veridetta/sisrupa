-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sisrupa.bloks
CREATE TABLE IF NOT EXISTS `bloks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_kios` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.bloks: ~0 rows (approximately)
INSERT INTO `bloks` (`id`, `id_lokasi`, `nomor_kios`, `blok`, `status`, `created_at`, `updated_at`) VALUES
	(1, '1', 'A01', 'C', '0', '2023-03-25 22:57:45', '2023-03-25 23:28:56'),
	(2, '1', 'A03', 'A', '0', '2023-03-25 23:15:30', '2023-03-25 23:29:05');

-- Dumping structure for table sisrupa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table sisrupa.informasis
CREATE TABLE IF NOT EXISTS `informasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.informasis: ~0 rows (approximately)
INSERT INTO `informasis` (`id`, `judul`, `isi`, `tanggal`, `foto`, `created_at`, `updated_at`) VALUES
	(1, 'Percobaan', 'pengumuman', '2023-03-26', 'informasi/1679822799.informasi.png', '2023-03-26 02:26:40', '2023-03-26 02:26:40');

-- Dumping structure for table sisrupa.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.jenis: ~0 rows (approximately)
INSERT INTO `jenis` (`id`, `kode`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'JPS-01', 'Sayuran', 'Pedagang Sayur Lengkap', '2023-03-25 22:28:02', '2023-03-25 22:28:09'),
	(3, 'JPB-01', 'Buah', 'Pedagang Buah', '2023-03-25 22:28:42', '2023-03-25 22:28:42');

-- Dumping structure for table sisrupa.kontrakans
CREATE TABLE IF NOT EXISTS `kontrakans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pedagang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_blok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tagihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.kontrakans: ~0 rows (approximately)
INSERT INTO `kontrakans` (`id`, `id_pedagang`, `id_blok`, `tanggal`, `id_tagihan`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
	(1, '1', '1', '2023-03-26', '2', 'Penyewaan untuk 1 tahun', '1', '2023-03-25 23:54:43', '2023-03-25 23:54:43'),
	(3, '2', '2', '2023-03-25', '1', 'Sewa 3 bulan', '1', '2023-03-26 00:11:27', '2023-03-26 00:11:27');

-- Dumping structure for table sisrupa.lokasis
CREATE TABLE IF NOT EXISTS `lokasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.lokasis: ~0 rows (approximately)
INSERT INTO `lokasis` (`id`, `kode`, `nama`, `lokasi`, `created_at`, `updated_at`) VALUES
	(1, 'PS01', 'Pasar Mambo', 'Majalengka 1', '2023-03-25 22:32:26', '2023-03-25 22:53:33'),
	(3, 'PS-02', 'Pasar Balong', 'Majalengka 23', '2023-03-25 23:29:41', '2023-03-25 23:29:47');

-- Dumping structure for table sisrupa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2023_01_01_041151_create_sessions_table', 1),
	(7, '2023_03_21_163456_create_rtrws_table', 1),
	(8, '2023_03_21_163710_create_jenis_surats_table', 1),
	(9, '2023_03_21_163819_create_rts_table', 1),
	(10, '2023_03_21_163903_create_rws_table', 1),
	(11, '2023_03_21_163925_create_surats_table', 1),
	(12, '2023_03_21_163950_create_pengaduans_table', 1),
	(13, '2023_03_21_164007_create_informasis_table', 1),
	(14, '2023_03_21_164845_create_wargas_table', 1),
	(15, '2023_03_25_090321_create_pedagangs_table', 1),
	(16, '2023_03_25_090424_create_lokasis_table', 1),
	(17, '2023_03_25_090443_create_tagihans_table', 1),
	(18, '2023_03_25_090504_create_bloks_table', 1),
	(19, '2023_03_25_090522_create_pembayarans_table', 1),
	(20, '2023_03_25_090548_create_kontrakans_table', 1),
	(21, '2023_03_25_090609_create_jenis_table', 1);

-- Dumping structure for table sisrupa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.password_resets: ~0 rows (approximately)

-- Dumping structure for table sisrupa.pedagangs
CREATE TABLE IF NOT EXISTS `pedagangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `ttl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.pedagangs: ~0 rows (approximately)
INSERT INTO `pedagangs` (`id`, `id_users`, `ttl`, `alamat`, `telp`, `jk`, `jenis`, `created_at`, `updated_at`) VALUES
	(1, 9, 'Majalengka/12-02-1992', 'Cirebon', '08999282982', 'Laki-laki', '3', '2023-03-25 23:41:32', '2023-03-25 23:41:32'),
	(2, 10, 'Majalengka/11-09-1827', 'Surabaya', '0800909', 'Laki-laki', '1', '2023-03-25 23:44:34', '2023-03-25 23:49:35');

-- Dumping structure for table sisrupa.pembayarans
CREATE TABLE IF NOT EXISTS `pembayarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_tagihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pedagang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.pembayarans: ~0 rows (approximately)
INSERT INTO `pembayarans` (`id`, `id_tagihan`, `id_pedagang`, `tanggal_pembayaran`, `nominal`, `keterangan`, `id_petugas`, `created_at`, `updated_at`) VALUES
	(1, '1', '2', '2023-03-26', '500000', 'Pembayaran pertama', '5', '2023-03-26 00:18:59', '2023-03-26 00:25:40'),
	(2, '2', '1', '2023-03-26', '500000', 'Pembayaran kedua', '5', '2023-03-26 00:20:06', '2023-03-26 00:20:06');

-- Dumping structure for table sisrupa.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table sisrupa.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.sessions: ~0 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('FfLFd5scWFU7mM9Y633FpDf4QxBHSsVsPZl64GrZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.51', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYnlJbzJOSmFuTEZLdXFUV3UzeG5FM3Z4U2s5QVdaVkprYkRYbUpabyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9zaXNydXBhLnRlc3QvYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1679823155);

-- Dumping structure for table sisrupa.tagihans
CREATE TABLE IF NOT EXISTS `tagihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.tagihans: ~0 rows (approximately)
INSERT INTO `tagihans` (`id`, `kode`, `nama`, `nominal`, `jenis`, `created_at`, `updated_at`) VALUES
	(1, 'TGK', 'Sewa Kios', '500000', 'Bulanan', '2023-03-25 23:30:12', '2023-03-25 23:30:12'),
	(2, 'TK-BA', 'Sewa Kios Tipe B4', '1500000', 'Bulanan', '2023-03-25 23:30:33', '2023-03-25 23:30:42');

-- Dumping structure for table sisrupa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sisrupa.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Mrs. Sallie Roob II', 'ephraim.jacobi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'admin', NULL, '2023-03-25 08:50:42', '2023-03-25 08:50:42'),
	(2, 'Mrs. Mossie Hickle', 'nicolette74', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'admin', NULL, '2023-03-25 08:50:42', '2023-03-25 08:50:42'),
	(3, 'Marcelo Quigley', 'maryjane.boyle', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 'admin', NULL, '2023-03-25 08:50:42', '2023-03-25 08:50:42'),
	(5, 'Jaka', 'jaka', '$2y$10$gCF.Y.v8cEth6/aG2QbFTe8tnEFhGu5JOTigBLsYXworbFThwdVAu', NULL, NULL, NULL, 'petugas', NULL, '2023-03-25 23:34:00', '2023-03-25 23:34:00'),
	(9, 'H. Salim', 'salim', '$2y$10$Fym9Tu8dYAiIbAeqDxWf3u1t3S3IM.f/cZ8XRXur4LWUCslVaduJK', NULL, NULL, NULL, 'pedagang', NULL, '2023-03-25 23:41:32', '2023-03-25 23:41:32'),
	(10, 'H Dakar', 'dakar', '$2y$10$8W6MKz8lTBbxl21uYqZJiuzzv0mm.KHxE3z.nr4ClGVaW8KCZsVoy', NULL, NULL, NULL, 'pedagang', NULL, '2023-03-25 23:44:34', '2023-03-25 23:49:35'),
	(11, 'Hj Sukma', 'sukma', '$2y$10$6hjSuT96y1nBO0vicPpNJuRfUF8jEAt1LYA/0DKo4l8ZMzh89sUgS', NULL, NULL, NULL, 'pedagang', NULL, '2023-03-25 23:50:03', '2023-03-25 23:50:03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
