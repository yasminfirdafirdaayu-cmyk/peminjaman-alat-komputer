-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2026 at 07:57 AM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alats`
--

CREATE TABLE `alats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `kondisi` varchar(255) NOT NULL,
  `lokasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alats`
--

INSERT INTO `alats` (`id`, `nama_alat`, `kategori_id`, `stok`, `kondisi`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Lenovo', 1, 35, 'Baik', 'Laboratorium Kompoter', '2026-11-16 17:56:06', '2026-11-18 23:31:37'),
(2, 'Keybord', 7, 20, 'Baik', 'Laboratorium Kompoter', '2026-11-16 17:57:11', '2026-11-16 17:57:20'),
(3, 'Asus', 2, 53, 'Baik', 'Laboratorium Komputer', '2026-11-16 19:39:04', '2026-11-19 06:41:46'),
(4, 'Joystik', 3, 163, 'Baik', 'Laboratorium Komputer', '2026-11-16 19:43:32', '2026-11-18 23:31:52'),
(5, 'Monitor', 4, 95, 'Baik', 'Laboratorium Komputer', '2026-11-16 19:44:29', '2026-11-17 00:28:02'),
(7, 'wifi', 5, 160, 'Baik', 'Laboratorium Komputer', '2026-11-18 23:29:08', '2026-11-18 23:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Komputer', '2026-11-16 17:51:59', '2026-11-16 17:51:59'),
(2, 'Laptop', '2026-11-16 17:51:59', '2026-11-16 17:51:59'),
(3, 'Perangkat Input', '2026-11-16 17:51:59', '2026-11-16 17:51:59'),
(4, 'Perangkat Output', '2026-11-16 17:51:59', '2026-11-16 17:51:59'),
(5, 'Jaringan', '2026-11-16 17:51:59', '2026-11-16 17:51:59'),
(7, 'Aksesoris Komputer', '2026-11-16 17:52:00', '2026-11-16 17:52:00'),
(8, 'Perangkat Audio', '2026-11-16 18:14:29', '2026-11-16 18:14:29'),
(9, 'sparepart', '2026-11-18 23:15:01', '2026-11-18 23:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `deskripsi`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 6, 'Mengajukan Peminjaman', 'mimin mengajukan peminjaman alat Joystik sebanyak 3 unit. ID transaksi: 5', '127.0.0.1', '2026-11-17 00:35:20', '2026-11-17 00:35:20'),
(2, 2, 'Menyetujui Peminjaman', 'Petugas menyetujui peminjaman milik mimin untuk alat Joystik sebanyak 3 unit. ID transaksi: 5', '127.0.0.1', '2026-11-17 00:35:46', '2026-11-17 00:35:46'),
(3, 6, 'Mengajukan Pengembalian', 'mimin mengembalikan alat Joystik sebanyak 3 unit. Total denda: Rp30.000. ID transaksi: 5', '127.0.0.1', '2026-11-17 17:42:19', '2026-11-17 17:42:19'),
(4, 6, 'Mengajukan Peminjaman', 'mimin mengajukan peminjaman alat Lenovo sebanyak 1 unit. ID transaksi: 6', '127.0.0.1', '2026-11-17 18:14:13', '2026-11-17 18:14:13'),
(5, 2, 'Menyetujui Peminjaman', 'Petugas menyetujui peminjaman milik mimin untuk alat Lenovo sebanyak 1 unit. ID transaksi: 6', '127.0.0.1', '2026-11-17 18:16:31', '2026-11-17 18:16:31'),
(6, 3, 'Mengajukan Peminjaman', 'Peminjam mengajukan peminjaman alat Keybord sebanyak 10 unit. ID transaksi: 7', '127.0.0.1', '2026-11-18 23:25:18', '2026-11-18 23:25:18'),
(7, 3, 'Mengajukan Peminjaman', 'Peminjam mengajukan peminjaman alat Lenovo sebanyak 35 unit. ID transaksi: 8', '127.0.0.1', '2026-11-18 23:25:55', '2026-11-18 23:25:55'),
(8, 2, 'Menyetujui Peminjaman', 'Petugas menyetujui peminjaman milik Peminjam untuk alat Lenovo sebanyak 35 unit. ID transaksi: 8', '127.0.0.1', '2026-11-18 23:27:20', '2026-11-18 23:27:20'),
(9, 2, 'Menolak Peminjaman', 'Petugas menolak peminjaman milik Peminjam untuk alat Keybord. ID transaksi: 7', '127.0.0.1', '2026-11-18 23:27:23', '2026-11-18 23:27:23'),
(10, 3, 'Mengajukan Pengembalian', 'Peminjam mengembalikan alat Lenovo sebanyak 35 unit. Total denda: Rp0. ID transaksi: 8', '127.0.0.1', '2026-11-18 23:31:38', '2026-11-18 23:31:38'),
(11, 3, 'Mengajukan Pengembalian', 'Peminjam mengembalikan alat Joystik sebanyak 3 unit. Total denda: Rp10.000. ID transaksi: 3', '127.0.0.1', '2026-11-18 23:31:52', '2026-11-18 23:31:52'),
(12, 3, 'Mengajukan Peminjaman', 'Peminjam mengajukan peminjaman alat Asus sebanyak 2 unit. ID transaksi: 9', '127.0.0.1', '2026-11-19 06:41:01', '2026-11-19 06:41:01'),
(13, 2, 'Menyetujui Peminjaman', 'Petugas menyetujui peminjaman milik Peminjam untuk alat Asus sebanyak 2 unit. ID transaksi: 9', '127.0.0.1', '2026-11-19 06:41:46', '2026-11-19 06:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_11_16_022300_create_kategori_table', 1),
(5, '2026_11_16_022425_create_alats_table', 1),
(6, '2026_11_16_034158_add_role_to_users_table', 2),
(7, '2026_11_17_012439_create_peminjaman_table', 3),
(8, '2026_11_17_021217_add_pengembalian_fields_to_peminjamans_table', 4),
(9, '2026_11_17_070050_create_log_aktivitas_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `alat_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `denda` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `user_id`, `alat_id`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_dikembalikan`, `denda`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 5, '2026-11-17', '2026-11-17', '2026-11-17', 0, 'dikembalikan', '2026-11-16 18:50:19', '2026-11-16 19:20:08'),
(2, 3, 4, 1, '2026-11-17', '2026-11-17', '2026-11-17', 0, 'dikembalikan', '2026-11-16 20:08:34', '2026-11-16 20:26:50'),
(3, 3, 4, 3, '2026-11-17', '2026-11-18', '2026-11-19', 10000, 'dikembalikan', '2026-11-16 23:41:37', '2026-11-18 23:31:52'),
(4, 5, 5, 1, '2026-11-17', '2026-11-17', NULL, 0, 'disetujui', '2026-11-17 00:27:29', '2026-11-17 00:28:02'),
(5, 6, 4, 3, '2026-11-17', '2026-11-17', '2026-11-18', 30000, 'dikembalikan', '2026-11-17 00:35:20', '2026-11-17 17:42:19'),
(6, 6, 1, 1, '2026-11-18', '2026-11-18', NULL, 0, 'disetujui', '2026-11-17 18:14:13', '2026-11-17 18:16:31'),
(7, 3, 2, 10, '2026-11-19', '2026-11-19', NULL, 0, 'ditolak', '2026-11-18 23:25:18', '2026-11-18 23:27:23'),
(8, 3, 1, 35, '2026-11-19', '2026-11-19', '2026-11-19', 0, 'dikembalikan', '2026-11-18 23:25:55', '2026-11-18 23:31:37'),
(9, 3, 3, 2, '2026-11-19', '2026-11-19', NULL, 0, 'disetujui', '2026-11-19 06:41:01', '2026-11-19 06:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PGpioQZPK2Bk2ot70u5wPGGS67hIgjt8lubWHXAl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJvZWxlZEI3dnE5VFVkUUhBNTl1SEU4aURGQU1Pek9HT1ZQbnk5OVJCIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC9sb2ctYWt0aXZpdGFzIiwicm91dGUiOiJhZG1pbi5sb2ctYWt0aXZpdGFzLmluZGV4In0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjEwMjFhZGI1YmExYTMwYTMxYTcyMzkxZWY5N2ZlODJkMDhiYmI4MGY4YzMxMzEyNzY5Nzg1YzhmODdhMjEzYjYifQ==', 1795071142);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL DEFAULT 'peminjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$7h9iyruaJ8FEECG9Dh9v..dnuH2C4nwXRzX/yxocQyDsqCgG03OMm', NULL, '2026-11-15 21:25:46', '2026-11-15 21:25:46', 'admin'),
(2, 'Petugas', 'petugas@gmail.com', NULL, '$2y$12$BNLwZDO00GPmrRbgbP/wbeeDZquz0uqW/N0.rovXiQUzudh5E7E3i', NULL, '2026-11-15 21:26:04', '2026-11-15 21:26:04', 'petugas'),
(3, 'Peminjam', 'peminjam@gmail.com', NULL, '$2y$12$QQ8q2qEekwlcjEvrZmEHCuBfJ8fUKKJC8uJk4d6UG6Qyu/p8Y3F9.', NULL, '2026-11-15 21:26:28', '2026-11-15 21:26:28', 'peminjam'),
(5, 'firda', 'firda@gmail.com', NULL, '$2y$12$nvviOFF/90vqR2YviGkUb.WbxFVGC7nqX.BRwPaICgmHKkiwpCgqO', NULL, '2026-11-16 19:37:26', '2026-11-16 19:37:26', 'peminjam'),
(6, 'mimin', 'mimin@gmail.com', NULL, '$2y$12$ecQbJzc4KBlF47sIM6jyFe3hi5C7/YRTiKVdh/cYQlzMoKjTSktg.', NULL, '2026-11-17 00:34:33', '2026-11-17 00:34:33', 'peminjam'),
(7, 'basmalah', 'malaku@gmail.com', NULL, '$2y$12$49AeLJYRgQHSQpiVnhguB.59NLOpbw51r/W8mhrPT1J8M8EFbETEe', NULL, '2026-11-17 19:04:21', '2026-11-18 23:03:05', 'peminjam'),
(12, 'nova', 'nova@gmail.com', NULL, '$2y$12$f611lnM9e5STrD1FzdOCKuuLFn6lMj353Lx.6H8PF7obI0780SyK2', NULL, '2026-11-18 23:36:10', '2026-11-18 23:36:10', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alats_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_aktivitas_user_id_foreign` (`user_id`);

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
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_user_id_foreign` (`user_id`),
  ADD KEY `peminjamans_alat_id_foreign` (`alat_id`);

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
-- AUTO_INCREMENT for table `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alats`
--
ALTER TABLE `alats`
  ADD CONSTRAINT `alats_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `peminjamans_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`),
  ADD CONSTRAINT `peminjamans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
