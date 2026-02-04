-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2025 at 01:12 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gama_kta`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nomor unik anggota KUD',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dusun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Untuk filter Laporan per Wilayah',
  `desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Telaga Sari',
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luasan_lahan` double DEFAULT NULL COMMENT 'Luasan dalam Hektar',
  `tanggal_bergabung` date NOT NULL COMMENT 'Untuk filter Laporan Anggota per Periode',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Path file foto yang diupload',
  `status_cetak` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_cetak` timestamp NULL DEFAULT NULL COMMENT 'Tercatat otomatis saat admin klik cetak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_sertifikat_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Scan Bukti Kepemilikan Lahan',
  `file_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Scan KTP',
  `file_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Scan Kartu Keluarga',
  `biaya_pendaftaran` int NOT NULL DEFAULT '150000',
  `file_bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Foto Struk/Transfer',
  `tanggal_bayar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `nomor_anggota`, `status`, `nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat_lengkap`, `dusun`, `desa`, `no_hp`, `pekerjaan`, `luasan_lahan`, `tanggal_bergabung`, `foto`, `status_cetak`, `tanggal_cetak`, `created_at`, `updated_at`, `file_sertifikat_tanah`, `file_ktp`, `file_kk`, `biaya_pendaftaran`, `file_bukti_bayar`, `tanggal_bayar`) VALUES
(1, 'KUD-GM-0001', 'active', '6312819728912211', 'Putri Ayunda Saraswati', 'BANJARMASIN', '2000-07-09', 'L', 'Jalan Hamengkubowono No 3', 'Muara Ujung', 'Telaga Sari', '0852892729328', 'Dewan Legislatif', 100, '2025-12-23', 'members-photos/YO0ivXZGnEIqREKa3sZCU3oX5yxhdlQR9hQPD2Qv.jpg', 1, '2025-12-23 12:27:11', '2025-12-22 22:36:05', '2025-12-23 12:27:11', 'members-docs/jIYITBIzDbCCL49zyQT7Du5Y1YZzrKpmlxAn629v.pdf', 'members-docs/XjhSCeuOJsD03WJExgUrbsyhDyl3Pg624UvYgQED.jpg', 'members-docs/40jXKvETZsz7GwohC828wx46ouQBIagk2S27RT0K.jpg', 150000, 'members-payments/OLdnv9kyFoPifbZWirIV0GPTs7B5TP94n9BsrtpR.png', '2025-12-23'),
(2, 'KUD-GM-0002', 'active', '4435239800423983', 'Mariyani', 'Palangka Raya', '2004-06-20', 'P', 'Jalan Melati No 8, RT 001', 'Dusun Melati', 'Telaga Sari', '085845876833', 'Mahasiwa', 2.5, '2025-12-23', 'members-photos/5dIiMJyzM0hXn1TT3sjNd3AfGNQEJUCkTBzHPLwi.jpg', 1, '2025-12-23 12:44:29', '2025-12-23 00:00:23', '2025-12-23 12:44:29', 'members-docs/mk03qNuWcBsjLi8Rxp4YEpNZMDyJlIl2U3jCI866.pdf', 'members-docs/iUtpQGzvl7m0i0RH2w0L4vWEj1GxnCo8LFpkXbfe.jpg', 'members-docs/Dkb61nkPNYN3MpeC32YHEjIOqehzXrlzHEW1q9kT.jpg', 150000, 'members-payments/khOcdceRv3uHAJPDmZddMAAFKfIoOwCXIRZEjxnZ.webp', '2025-12-23'),
(3, 'KUD-GM-0003', 'active', '6304041512730003', 'Budi', 'BANJARMASIN', '2000-02-01', 'L', 'Jl. Hasan Basry No 3', 'Dusun I', 'Telaga Sari', NULL, NULL, 1.5, '2025-12-23', 'members-photos/88wwqZyUwGWUMu4Gd9YUg2YEkG8VDfboOLmvo4MV.jpg', 0, NULL, '2025-12-23 13:25:03', '2025-12-23 13:30:05', 'members-docs/O2aazMMbuqMICeRgEJovFGxQtwTg1Ka7TLX4aTWl.jpg', 'members-docs/31O0Bz87c1imGRhevaXeEFbxIruPXX1o7Vp4k3Zc.jpg', 'members-docs/IMbF4cca9UkBs41CyOxfwc8G3wjr4TyLPRXxnncI.jpg', 150000, NULL, NULL),
(5, 'KUD-GM-0005', 'active', '1896281928971891', 'TEST', 'BANJARMASIN', '2025-12-23', 'P', 'Jl. Kenanga No 8', 'Dusun I', 'Telaga Sari', '08123456789', NULL, 1.3, '2025-12-23', 'members-photos/uzJks5NpYUdIjrNY6YCPQhhtc8ZhztQtQttjgNU1.jpg', 0, NULL, '2025-12-23 14:00:21', '2025-12-23 14:01:13', 'members-docs/TnADIKPgKM4pvPRIkYwa1k9cWwXVf0aCn0RFyHko.webp', 'members-docs/mzuIKJGLNtzax93QbcnjYPW9I01ZLB5LbtFxPkc8.jpg', 'members-docs/c8y6Ulw18bj6bKet7NusacL55uGZxAzsfmIQ81sk.jpg', 150000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_23_055059_create_members_table', 1),
(5, '2025_12_23_064903_add_luasan_lahan_to_members_table', 2),
(6, '2025_12_23_070810_add_documents_to_members_table', 3),
(7, '2025_12_23_072820_add_payment_to_members_table', 4),
(8, '2025_12_23_211337_add_status_to_members_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('H1sbkN2hxWACgUEAwcSVkswcvGkjLqKAQE3gn2qN', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUlvTjRta2tENXhReG5HZWV2Q013QkZPQ0VnVHFvWU1kV0NnWjRZeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1766499859),
('mbw4ngL1fu8jRlWmX4vlduDLW3pDrf6bImJx8dtt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRWpBZ1JSeFp4M056bnFqcVNwQ0Njam91VkVXM1ZvT1pkakhLR2NBZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1766499634),
('tcc8Mzvo3kC7ug0C8RoAq7bveSkQQNIg8AmFS9Qz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia05BVUhOVm5uY2VXNEVKOVhNRXJzcVhoZlNqdGd1Z2JCbjNUVHBMSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766499252);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aya', 'admin@gmail.com', NULL, '$2y$12$E3YLnF/vykYiJQpWc/rDfuZ9rFTu8MLCZ60ReqpVf9UdFrlvc3DFu', '1jO6XY9RDU', '2025-12-22 22:14:06', '2025-12-23 03:41:18'),
(2, 'Administrator', 'admin2@gmail.com', NULL, '$2y$12$tJdNZgT7WtTcfjPeZ2jlFOXLYPBKN4Dy1KxUHfCal24LLsj/AiQUa', NULL, '2025-12-23 14:24:10', '2025-12-23 14:24:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_nomor_anggota_unique` (`nomor_anggota`),
  ADD UNIQUE KEY `members_nik_unique` (`nik`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
