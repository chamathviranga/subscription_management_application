-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2023 at 01:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subscription_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'admin', '2023-11-17 09:57:23'),
(2, 2, 'user', '2023-11-17 09:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@gmail.com', '$2y$12$a.fwPa8IUR6V5lfVEtWweuYGDU32VQAIVmweDOcPXaA4s8PvUd/oa', NULL, NULL, 0, '2023-11-17 09:57:51', '2023-11-17 09:57:23', '2023-11-17 09:57:51'),
(2, 2, 'email_password', NULL, 'chamathviranga@gmail.com', '$2y$12$ijJLy7MtovMttsIs6/720ee8rVxarNb.U793rsWCkacIJiLyyqGrO', NULL, NULL, 0, NULL, '2023-11-17 09:58:13', '2023-11-17 09:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'email_password', 'admin@gmail.com', 1, '2023-11-17 09:57:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(5) UNSIGNED NOT NULL,
  `customer_id` int(5) UNSIGNED NOT NULL,
  `subscription_id` varchar(255) NOT NULL,
  `valid_from` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(25) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `customer_id`, `subscription_id`, `valid_from`, `valid_to`, `price`, `status`, `created_at`) VALUES
(2, 2, '3', '2023-11-17 11:38:03', '2023-12-16 18:30:00', 500.00, 'renewed', '2023-11-17 10:30:52'),
(3, 2, '3', '2023-11-17 11:51:00', '2024-04-16 18:30:00', 500.00, 'renewed', '2023-11-17 11:50:40'),
(4, 2, '3', '2023-11-17 11:51:21', '2024-11-16 18:30:00', 500.00, 'renewed', '2023-11-17 11:51:00'),
(5, 2, '3', '2023-11-17 11:55:25', '2024-01-16 18:30:00', 500.00, 'renewed', '2023-11-17 11:51:21'),
(6, 2, '3', '2023-11-17 11:55:42', '2024-02-16 18:30:00', 500.00, 'renewed', '2023-11-17 11:55:25'),
(7, 2, '3', '2023-11-17 11:55:53', '2024-12-16 18:30:00', 500.00, 'renewed', '2023-11-17 11:55:42'),
(8, 2, '3', '2023-11-17 12:05:14', '2025-12-16 18:30:00', 500.00, 'renewed', '2023-11-17 11:55:53'),
(9, 2, '3', '2023-11-16 18:30:00', '2026-12-16 18:30:00', 500.00, 'valid', '2023-11-17 12:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `billing_disputes`
--

CREATE TABLE `billing_disputes` (
  `id` int(5) UNSIGNED NOT NULL,
  `customer_id` int(5) UNSIGNED NOT NULL,
  `subscription_id` int(5) UNSIGNED NOT NULL,
  `issue` text NOT NULL,
  `other_details` text NOT NULL,
  `preferred_resolution` varchar(25) NOT NULL,
  `support_document` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_requests`
--

CREATE TABLE `customer_requests` (
  `id` int(5) UNSIGNED NOT NULL,
  `customer_id` int(5) UNSIGNED NOT NULL,
  `type` varchar(25) NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_requests`
--

INSERT INTO `customer_requests` (`id`, `customer_id`, `type`, `payload`, `status`, `created_at`) VALUES
(1, 2, 'subscription_suspend', '{\"reason\":\"Test\",\"additional_comment\":\"Test\",\"from\":\"2023-11-17\",\"to\":\"2023-11-25\"}', 'pending', '2023-11-17 12:04:44'),
(2, 2, 'subscription_cancellation', '{\"email\":1,\"reason\":\"Test\",\"feedback\":\"Test\"}', 'pending', '2023-11-17 12:04:56'),
(3, 2, 'subscription_modification', '{\"subscription_details\":{\"subscription_id\":\"1\",\"payment_method\":\"6\",\"additional_comments\":\"\"},\"billing_details\":{\"billing_street\":\"1st lane\",\"billing_city\":\"colombo\",\"billing_state\":\"Western Province\",\"billing_postal_code\":\"10500\",\"billing_country\":\"Sri Lanka\"},\"personal_details\":{\"name\":\"chamathviranga\",\"email\":\"chamathviranga@gmail.com\",\"phone\":\"0115666400\"}}', 'pending', '2023-11-17 12:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_subscriptions`
--

CREATE TABLE `customer_subscriptions` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_state` varchar(100) NOT NULL,
  `billing_postal_code` varchar(10) NOT NULL,
  `billing_country` varchar(50) NOT NULL,
  `subscription_id` int(5) UNSIGNED NOT NULL,
  `payment_method` int(5) UNSIGNED NOT NULL,
  `customer_id` int(5) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_subscriptions`
--

INSERT INTO `customer_subscriptions` (`id`, `name`, `email`, `phone`, `billing_street`, `billing_city`, `billing_state`, `billing_postal_code`, `billing_country`, `subscription_id`, `payment_method`, `customer_id`, `status`, `created_at`) VALUES
(3, 'chamathviranga', 'chamathviranga@gmail.com', '0711076100', '1st lane', 'colombo', 'Western Province', '10500', 'Sri Lanka', 1, 6, 2, 'cancelled', '2023-11-17 10:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(5) UNSIGNED NOT NULL,
  `customer_id` int(5) UNSIGNED NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `customer_id`, `feedback`, `created_at`) VALUES
(1, 2, 'Test', '2023-11-17 12:04:56');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-11-16-085223', 'App\\Database\\Migrations\\CreateSubscriptionsTable', 'default', 'App', 1700214673, 1),
(2, '2023-11-16-163528', 'App\\Database\\Migrations\\CreatePaymentMethodsTable', 'default', 'App', 1700214673, 1),
(3, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1700215029, 2),
(4, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1700215029, 2),
(5, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1700215029, 2),
(6, '2023-11-16-170101', 'App\\Database\\Migrations\\CreateCustomerSubscriptionsTable', 'default', 'App', 1700215029, 2),
(7, '2023-11-16-220829', 'App\\Database\\Migrations\\CreateCustomerRequestsTable', 'default', 'App', 1700215029, 2),
(8, '2023-11-16-230105', 'App\\Database\\Migrations\\CreateFeedbackTable', 'default', 'App', 1700215029, 2),
(9, '2023-11-17-002218', 'App\\Database\\Migrations\\CreateBillingDisputeTable', 'default', 'App', 1700215029, 2),
(10, '2023-11-17-005706', 'App\\Database\\Migrations\\CreateBillingTable', 'default', 'App', 1700215029, 2),
(11, '2023-11-17-073119', 'App\\Database\\Migrations\\AddColumnToUsersTable', 'default', 'App', 1700215029, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(5) UNSIGNED NOT NULL,
  `method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method`) VALUES
(1, 'Visa'),
(2, 'Master'),
(3, 'Cash'),
(4, 'Bank Deposit'),
(5, 'Google Pay'),
(6, 'Paypal');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `duration` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `description`, `is_active`, `price`, `duration`) VALUES
(1, '1 Months package', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ', 1, 500.00, 1),
(2, '3 Months package', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ', 1, 1500.00, 3),
(3, '6 Months package', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ', 1, 3000.00, 6),
(4, '12 Months package', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy ', 1, 6000.00, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, 0, '2023-11-17 09:57:56', '2023-11-17 09:57:23', '2023-11-17 09:57:23', NULL),
(2, 'chamathviranga', NULL, NULL, 1, '2023-11-17 12:05:40', '2023-11-17 09:58:13', '2023-11-17 09:58:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_disputes`
--
ALTER TABLE `billing_disputes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_requests`
--
ALTER TABLE `customer_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_subscriptions_payment_method_foreign` (`payment_method`),
  ADD KEY `customer_subscriptions_subscription_id_foreign` (`subscription_id`),
  ADD KEY `customer_subscriptions_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `billing_disputes`
--
ALTER TABLE `billing_disputes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_requests`
--
ALTER TABLE `customer_requests`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  ADD CONSTRAINT `customer_subscriptions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_subscriptions_payment_method_foreign` FOREIGN KEY (`payment_method`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_subscriptions_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
