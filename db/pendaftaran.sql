-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2025 at 01:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('ketua','fasilitator','sekretaris','anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `user_id`, `nama`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 9, 'Fazlur Rachman', 'fasilitator', '2025-06-04 06:44:27', '2025-06-28 01:14:23'),
(2, 9, 'alul', 'ketua', '2025-06-28 01:14:12', '2025-06-28 01:14:12'),
(3, 11, 'Fazlur Rachman', 'ketua', '2025-08-11 07:58:05', '2025-08-11 07:58:05'),
(4, 11, 'Farid', 'anggota', '2025-08-11 07:58:19', '2025-08-11 07:58:19'),
(5, 11, 'Sarah', 'sekretaris', '2025-08-11 07:58:38', '2025-08-11 07:58:38'),
(6, 11, 'rokcy', 'fasilitator', '2025-09-10 07:57:55', '2025-09-10 07:57:55');

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
-- Table structure for table `final_karya`
--

CREATE TABLE `final_karya` (
  `id` bigint UNSIGNED NOT NULL,
  `karya_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `final_karya`
--

INSERT INTO `final_karya` (`id`, `karya_id`, `file_path`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 'final_karya/CxlJQ4OmyvxUqVMQfw4u6O9Xoozq8J4sp279NTSU.pdf', 'disetujui', NULL, '2025-07-31 08:07:34', '2025-07-31 08:24:06'),
(2, 3, 'final_karya/9D2GfG0PHC3RB9sWVP74QEkkeCHCvrPzIKmikJJw.pdf', 'pending', NULL, '2025-07-31 08:23:56', '2025-07-31 08:23:56'),
(6, 4, 'proposals/hiroteammate/final/Lembar Surat Keterangan Sehat.pdf', 'pending', NULL, '2025-08-14 20:21:49', '2025-08-14 20:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `karya_tulis`
--

CREATE TABLE `karya_tulis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_judul` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_judul` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karya_tulis`
--

INSERT INTO `karya_tulis` (`id`, `user_id`, `judul`, `status_judul`, `catatan_judul`, `created_at`, `updated_at`) VALUES
(1, 9, 'Kelola Makalah Testing', 'disetujui', 'Disetujui dengan Catatan \" Perbaikan bagian abstrak\"', '2025-07-01 06:50:18', '2025-07-15 09:03:35'),
(2, 11, 'Kelola Makalah test', 'disetujui', NULL, '2025-07-30 08:06:11', '2025-07-30 08:06:31'),
(3, 9, 'Implementasi IOT pada penimbangan bahan baku', 'ditolak', NULL, '2025-07-31 08:12:18', '2025-09-16 06:58:16'),
(4, 13, 'Penunjang Alat Kontraktrok', 'disetujui', 'Lanjutkan', '2025-08-14 09:06:01', '2025-08-14 09:06:38'),
(5, 9, 'Slow Testing', 'pending', NULL, '2025-09-16 06:58:35', '2025-09-16 06:58:35');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_02_132430_create_karya_tulis_table', 2),
(6, '2025_05_04_045641_create_proposals_table', 3),
(7, '2025_05_07_140446_create_final_karyas_table', 4),
(8, '2025_05_17_081123_create_anggotas_table', 5),
(9, '2025_05_28_154637_tahapan', 6),
(10, '2025_05_28_155003_add_tahap_id_to_proposal_table', 6),
(11, '2025_09_10_145344_update_jabatan_enum_in_anggota_table', 7),
(12, '2025_09_11_144911_add_unit_kerja_to_users_table', 8);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` bigint UNSIGNED NOT NULL,
  `karya_id` bigint UNSIGNED NOT NULL,
  `tahap_id` bigint UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `karya_id`, `tahap_id`, `file_path`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(5, 2, 4, 'proposals/gugus testing/tahap-2/2NB5tSz6zxKrKN9CcjcE76CSCXdIOxePIDvVsmm5.pdf', 'ditolak', 'lenkapi bed peserta', '2025-07-31 08:07:23', '2025-08-20 07:07:41'),
(6, 3, 1, 'proposals/TeamAlul/tahap-1/YHjOqdFKjohPuAREEeRxsZKAe6ooq2GKjinGpelV.pdf', 'disetujui', NULL, '2025-07-31 08:12:33', '2025-07-31 08:23:38'),
(7, 4, 1, 'proposals/hiroTeamMate/tahap-1/fJKnMZk5FQ1SELv1TtzDjIVhtdRDmijAMU7w8R1v.pdf', 'disetujui', 'Lanjut', '2025-08-14 09:07:00', '2025-08-14 09:07:45'),
(8, 4, 4, 'proposals/hiroTeamMate/tahap-2/0qRFrqg8Y2YGuCChQT4dk9BF2GjQ7QlkDUO7m59v.pdf', 'disetujui', 'lanjut', '2025-08-14 09:08:21', '2025-08-14 09:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `tahapan`
--

CREATE TABLE `tahapan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `urutan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahapan`
--

INSERT INTO `tahapan` (`id`, `nama`, `deskripsi`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Tahap 1', 'Bab 1 s/d Bab 3', 1, '2025-06-04 04:42:21', '2025-06-04 04:42:21'),
(4, 'Tahap 2', 'Bab 4-5', 2, '2025-06-28 01:15:57', '2025-06-28 01:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `unit_kerja`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, 'user@gmail.com', NULL, '$2y$10$2thd2PQ8gmdl6/7mOplbg.7nnketj5BsBKSwScS2rZpqXFrHbVYhy', 'user', NULL, '2025-04-29 00:15:32', '2025-04-29 00:16:30'),
(2, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$10$b9GjGSkKNHgZBL3WTTpFSex/6t43dpyfE.el0F6iBePZToIB81UcS', 'admin', NULL, '2025-04-29 00:23:15', '2025-04-29 00:23:15'),
(8, 'Fazlur', NULL, 'fazlur@gmail.com', NULL, '$2y$10$n69yI5YlfhYgujP5nsuGQugo66t1OxzdvdRyR2HYz4ZHHRNjSIcV6', 'user', NULL, '2025-05-01 08:49:19', '2025-05-01 08:49:19'),
(9, 'TeamAlul', NULL, 'alul@gmail.com', NULL, '$2y$10$b0yY4PezAxuE/82SRBTKEeoJDQ5XxNuBzIyp/XTogRrq6V1f8tQ.e', 'user', NULL, '2025-06-04 04:28:46', '2025-07-31 08:11:49'),
(10, 'kanap', NULL, 'staff_it@example.com', NULL, '$2y$10$wlwJ0dyZaZwvAwzoqtgAkenM.e6noWlxQRe0KLyWO3RaGiX0kMRDO', 'user', NULL, '2025-06-23 07:24:40', '2025-06-23 07:24:40'),
(11, 'gugus testing', NULL, 'gugus@gmail.com', NULL, '$2y$10$j/ZGlZBzMu69NO6ahlBLHedHVn4Lu6SOPi6KwhZHver3mCXMHx3U2', 'user', NULL, '2025-07-17 08:07:13', '2025-07-30 08:05:32'),
(12, 'gugus2', NULL, 'gugus2@gmail.com', NULL, '$2y$10$5JWmbVVwFB4boFdG0wL1a.YztXsJq.FiIMwPBLoV2/TMsursuWeR6', 'user', NULL, '2025-07-17 08:08:31', '2025-07-17 08:08:31'),
(13, 'hiroTeamMate', NULL, 'hiro@gmail.com', NULL, '$2y$10$kldfptqlF3izRSm4riAdfeJRDC3Hdy4JI/kR1owDjcXNMl3gQDs9a', 'user', NULL, '2025-08-14 08:55:48', '2025-08-14 08:55:48'),
(14, 'ITTeam', 'Informasi Teknologi', 'it@gmail.com', NULL, '$2y$10$h06cdNQAgliJvqks3SsdAetwSpFNQ11gpNcv83s4fYQ7Iu94Nf2/e', 'user', NULL, '2025-09-11 08:47:35', '2025-09-11 20:33:56'),
(15, 'Marketing', 'Markom', 'markom@gmail.com', NULL, '$2y$10$FQY0Lzep2Lry7nZ4thzqOelN2NqFXgHIlyEy/7W5ExWgYKx7tJytW', 'user', NULL, '2025-09-11 20:34:20', '2025-09-11 20:34:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `final_karya`
--
ALTER TABLE `final_karya`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_karya_karya_id_foreign` (`karya_id`);

--
-- Indexes for table `karya_tulis`
--
ALTER TABLE `karya_tulis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karya_tulis_user_id_foreign` (`user_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_karya_id_foreign` (`karya_id`),
  ADD KEY `proposal_tahap_id_foreign` (`tahap_id`);

--
-- Indexes for table `tahapan`
--
ALTER TABLE `tahapan`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_karya`
--
ALTER TABLE `final_karya`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `karya_tulis`
--
ALTER TABLE `karya_tulis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tahapan`
--
ALTER TABLE `tahapan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `final_karya`
--
ALTER TABLE `final_karya`
  ADD CONSTRAINT `final_karya_karya_id_foreign` FOREIGN KEY (`karya_id`) REFERENCES `karya_tulis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karya_tulis`
--
ALTER TABLE `karya_tulis`
  ADD CONSTRAINT `karya_tulis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_karya_id_foreign` FOREIGN KEY (`karya_id`) REFERENCES `karya_tulis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proposal_tahap_id_foreign` FOREIGN KEY (`tahap_id`) REFERENCES `tahapan` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
