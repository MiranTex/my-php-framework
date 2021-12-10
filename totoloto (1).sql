-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 09:24 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `totoloto`
--

-- --------------------------------------------------------

--
-- Table structure for table `apostas`
--

CREATE TABLE `apostas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nif` varchar(141) NOT NULL,
  `totoloto` varchar(255) NOT NULL,
  `joker` varchar(255) NOT NULL,
  `id_jogo` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `points` varchar(255) NOT NULL,
  `joker_win` tinyint(1) NOT NULL,
  `from_third` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apostas`
--

INSERT INTO `apostas` (`id`, `nif`, `totoloto`, `joker`, `id_jogo`, `id_user`, `points`, `joker_win`, `from_third`, `created_at`, `updated_at`) VALUES
(1, '', '', '12345685', 1, 1, '0', 0, 1, '2021-12-01 21:26:34', '2021-12-10 22:13:40'),
(2, '', '', '41553544', 1, 6, '0', 0, 0, '2021-12-09 14:47:29', '2021-12-10 22:13:40'),
(3, '', '4-5-15-16-26-27', '82935050', 1, 6, '1', 0, 0, '2021-12-09 15:01:34', '2021-12-10 22:13:40'),
(4, '', '3-4-5-13-14-15', '41360791', 1, 6, '0', 0, 0, '2021-12-09 15:04:30', '2021-12-10 22:13:40'),
(5, '', '', '27216887', 1, 6, '0', 0, 0, '2021-12-09 15:04:38', '2021-12-10 22:13:40'),
(6, '', '', '16588115', 1, 6, '0', 0, 0, '2021-12-09 15:04:41', '2021-12-10 22:13:40'),
(7, '', '', '30716921', 1, 6, '0', 0, 0, '2021-12-09 15:05:44', '2021-12-10 22:13:40'),
(8, '', '', '83885560', 1, 6, '0', 0, 0, '2021-12-09 15:06:30', '2021-12-10 22:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `jogos`
--

CREATE TABLE `jogos` (
  `id` int(10) UNSIGNED NOT NULL,
  `totoloto` varchar(255) NOT NULL,
  `joker` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `premio_totoloto` varchar(141) NOT NULL,
  `premio_joker` varchar(145) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jogos`
--

INSERT INTO `jogos` (`id`, `totoloto`, `joker`, `start`, `end`, `premio_totoloto`, `premio_joker`, `active`, `created_at`, `updated_at`) VALUES
(1, '16-6-31-6-12-34', '44459999', '2021-11-04', '2021-11-10', '50000', '200000', 0, '2021-12-01 00:36:42', '2021-12-10 22:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'app\\model\\User', 1),
(2, 'app\\model\\User', 5),
(2, 'app\\model\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'bet', 'bet', '2021-11-29 00:34:42', '2021-11-29 00:34:42'),
(3, 'create game', 'create game', '2021-11-29 00:36:42', '2021-11-29 00:36:42'),
(4, 'view all game', 'view all game', '2021-11-30 13:09:39', '2021-11-30 13:09:39'),
(5, 'third play', 'third play', '2021-12-01 18:34:01', '2021-12-01 18:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', '2021-11-28 19:01:41', '2021-11-28 19:01:41'),
(2, 'player', 'player', '2021-11-29 01:05:32', '2021-11-29 01:05:32'),
(3, 'store', 'store', '2021-12-01 18:33:31', '2021-12-01 18:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 1),
(1, 2),
(4, 1),
(5, 3),
(5, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nif` varchar(141) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userimage` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `cash` varchar(141) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nif`, `name`, `email`, `password`, `userimage`, `api_key`, `remember_token`, `cash`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'Ariel Teixeira', 'arielmirantex@gmail.com', '7C222FB2927D828AF22F592134E8932480637C0D', NULL, NULL, '1b8fd368c68bb0921cc4344d9e5eaef3', '0', '2021-11-28 18:59:36', '2021-12-10 22:16:04'),
(2, '12345678', 'Artur', 'artur@gmail.com', '7C222FB2927D828AF22F592134E8932480637C0D', NULL, NULL, '54e89a2381fce2e2664543585fddaf55', '0', '2021-11-30 23:53:55', '2021-12-01 00:02:39'),
(3, '12345678', 'Arielle', 'arielle@gmail.com', '7C222FB2927D828AF22F592134E8932480637C0D', NULL, NULL, 'ff667cc2133225227fc2947c92a4a32f', '0', '2021-12-01 01:14:09', '2021-12-01 01:14:09'),
(4, '12345678', 'Ariana', 'ariana@gmail.com', '7C222FB2927D828AF22F592134E8932480637C0D', NULL, NULL, '069d5a113013f6f60c293f155aeca201', '0', '2021-12-01 01:17:50', '2021-12-01 01:42:06'),
(5, '123456798', 'Arcangela Teixeira', 'arcangela@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', NULL, NULL, 'd00f1b4f8a8616cb2696c8513a9595cf', '0', '2021-12-01 15:28:17', '2021-12-01 15:49:49'),
(6, '123456789', 'Artur Ariano Miranda Teixeira', 'arturmirantex2001@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', NULL, NULL, '9fb7b1bb0a7b29de6300764d1201c7ff', '0', '2021-12-09 01:32:22', '2021-12-10 22:16:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apostas`
--
ALTER TABLE `apostas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD KEY `role_has_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_key_unique` (`api_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apostas`
--
ALTER TABLE `apostas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
