-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 08:41 PM
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
-- Database: `laravel_gym_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `member_id`, `group_id`, `attendance_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2024-11-04', 1, '2024-11-11 09:28:15', '2024-11-11 12:04:29'),
(3, 3, 1, '2024-11-10', 0, '2024-11-11 09:31:43', '2024-11-11 09:31:43'),
(4, 1, 1, '2024-11-14', 1, '2024-11-11 09:33:15', '2024-11-11 10:15:22'),
(5, 3, 1, '2024-11-05', 0, '2024-11-11 09:46:57', '2024-11-11 09:47:06'),
(6, 1, 1, '2024-11-09', 0, '2024-11-11 09:52:22', '2024-11-11 09:52:30'),
(7, 3, 1, '2024-11-27', 1, '2024-11-11 10:03:24', '2024-11-11 10:03:24'),
(8, 1, 1, '2024-11-12', 0, '2024-11-11 10:32:27', '2024-11-11 10:32:35'),
(9, 1, 1, '2024-11-04', 1, '2024-11-11 11:39:36', '2024-11-11 12:04:03'),
(10, 3, 1, '2024-11-13', 0, '2024-11-11 11:43:33', '2024-11-11 11:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`) VALUES
(1, 'Standard', 'lorem ipsum'),
(2, 'xyz', 'xyz'),
(4, 'abc', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `total_members` varchar(150) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `total_members`) VALUES
(1, 'Morning Fitnesses Group', 'lorem ipsum', '3'),
(2, 'Fitness Maniacs', 'lorem ipsum', '0'),
(3, 'Stride Pride', 'lorem ipsum', '0');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `chest` int(11) NOT NULL,
  `waist` int(11) NOT NULL,
  `thigh` int(11) NOT NULL,
  `arm` int(11) NOT NULL,
  `fat` int(11) NOT NULL,
  `staff_member` varchar(255) NOT NULL,
  `membership` bigint(20) UNSIGNED NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fname`, `lname`, `image`, `gender`, `birth`, `group`, `address`, `city`, `state`, `phone`, `email`, `weight`, `height`, `chest`, `waist`, `thigh`, `arm`, `fat`, `staff_member`, `membership`, `start_date`, `end_date`) VALUES
(1, 'xyz', 'xyz', '1731184740.png', 'male', '2024-10-27', '1', 'xyz', 'xyz', 'xyz', '9999', 'xyz@gmail.com', 10, 10, 10, 10, 10, 10, 10, '1', 1, '2024-11-13', '2024-12-13'),
(3, 'xyz', 'xyz', NULL, 'male', '2024-10-27', '1', 'xyz', 'xyz', 'xyz', '999999', 'abc@gmail.com', 10, 10, 10, 10, 10, 10, 10, '1', 1, '2024-11-13', '2024-12-13'),
(4, 'Muhammad', 'Rafay', '1731257691.png', 'male', '2024-10-27', '3', 'yxz', 'Karachi', 'xyz', '99999', 'rafay@gmail.com', 10, 10, 10, 10, 10, 10, 10, '1, 2', 1, '2024-11-28', '2024-12-30'),
(6, 'Junaid', 'Khan', NULL, 'male', '2024-10-29', '1', 'xyz', 'xyz', 'xyz', '999999999', 'junaid@gmail.com', 10, 10, 10, 10, 10, 10, 10, '1', 1, '2024-11-18', '2024-12-18'),
(7, 'Umer', 'Khan', NULL, 'male', '2024-10-29', '1, 3', 'xyz', 'xyz', 'xyz', '3141', 'umer@gmail.com', 10, 10, 10, 10, 10, 10, 10, '2', 1, '2024-11-13', '2024-12-13'),
(8, 'Parvaiz', 'Khan', NULL, 'male', '2024-10-28', '1, 3', 'xyz', 'xyz', 'xyz', '8349048', 'parvaiz@gmail.com', 10, 10, 10, 10, 10, 10, 10, '2', 1, '2024-11-21', '2024-12-21'),
(9, 'Wajahat', 'Khan', NULL, 'male', '2024-10-28', '1, 3', 'xyz', 'xyz', 'xyz', '99432443', 'wajahat@gmail.com', 10, 10, 10, 10, 10, 10, 10, '1', 1, '2024-11-28', '2024-12-28'),
(10, 'Muhammad', 'Rafay', NULL, 'male', '2024-10-28', '2', 'xyz', 'xyz', 'xyz', '03153307757', 'rafayshaikh405@gmail.com', 10, 10, 10, 10, 10, 10, 10, '2', 1, '2024-11-18', '2024-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `period` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `name`, `category_id`, `period`, `amount`, `description`) VALUES
(1, 'xyz', 2, '10', '1000', 'lorem ipsum');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_11_07_140820_create_categories_table', 1),
(3, '2024_11_07_140953_create_membership_table', 1),
(4, '2024_11_07_170659_create_users_table', 2),
(5, '2024_11_08_135751_create_roles_table', 3),
(6, '2024_11_08_161846_create_roles_table', 4),
(7, '2024_11_08_162112_create_specializations_table', 5),
(8, '2024_11_08_171012_create_groups_table', 6),
(9, '2024_11_08_172855_create_staff_members_table', 7),
(10, '2024_11_09_191157_create_members_table', 8),
(11, '2024_11_10_182259_create_attendances_table', 9),
(12, '2024_11_11_161603_create_staff_attendance_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Training', 'lorem ipsum'),
(2, 'xyz', 'lorem ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `description`) VALUES
(1, 'Weight Training', 'lorem ipsum'),
(2, 'Leg', 'lorem ipsum'),
(3, 'xyz', 'lorem ipsum');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_attendance`
--

INSERT INTO `staff_attendance` (`id`, `staff_id`, `attendance_date`, `status`) VALUES
(1, 1, '2024-11-06', 0),
(3, 1, '2024-11-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_members`
--

CREATE TABLE `staff_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_members`
--

INSERT INTO `staff_members` (`id`, `fname`, `lname`, `image`, `gender`, `birth`, `role`, `specialization`, `address`, `city`, `state`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad', 'Rafay', NULL, 'male', '2024-10-27', '1, 2', '1, 2, 3', 'xyz', 'xyz', 'xzy', 315330775, 'rafay@gmail.com', NULL, NULL),
(3, 'Sana', 'Khan', NULL, 'female', '2024-10-27', '1', '3', 'xyz', 'xyz', 'xyz', 90423840, 'xtylishlarka029@gmail.com', NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Rafay Shaikh', 'rafay6744@gmail.com', NULL, '$2y$12$B87n3Qd6k2ROPvOIuEipaeB4A4vin65jsbBe09rzZN.BJUFXiEgPO', NULL, '2024-11-07 12:08:49', '2024-11-07 12:27:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_member_id_group_id_attendance_date_unique` (`member_id`,`group_id`,`attendance_date`),
  ADD KEY `attendances_group_id_foreign` (`group_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_phone_unique` (`phone`),
  ADD UNIQUE KEY `members_email_unique` (`email`),
  ADD KEY `members_membership_foreign` (`membership`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `membership_name_unique` (`name`),
  ADD KEY `membership_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_attendance_staff_id_attendance_date_unique` (`staff_id`,`attendance_date`);

--
-- Indexes for table `staff_members`
--
ALTER TABLE `staff_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_members_phone_unique` (`phone`),
  ADD UNIQUE KEY `staff_members_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_members`
--
ALTER TABLE `staff_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_membership_foreign` FOREIGN KEY (`membership`) REFERENCES `memberships` (`id`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `membership_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD CONSTRAINT `staff_attendance_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff_members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
