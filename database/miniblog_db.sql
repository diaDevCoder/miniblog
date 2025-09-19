-- Adminer 4.8.4 MySQL 11.8.2-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `miniblog_db`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `job_batches`;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'0001_01_01_000000_create_users_table',	1),
(2,	'0001_01_01_000001_create_cache_table',	1),
(3,	'0001_01_01_000002_create_jobs_table',	1),
(4,	'2025_09_19_062732_create_personal_access_tokens_table',	1),
(5,	'2025_09_19_144433_create_posts_table',	2);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2,	'App\\Models\\User',	2,	'user',	'dd4f0073411b6c7169a21abea7ee9f5d230931248cccc641c912f2fd08cc2b41',	'[\"*\"]',	NULL,	NULL,	'2025-09-19 13:28:43',	'2025-09-19 13:28:43'),
(3,	'App\\Models\\User',	1,	'user',	'f7f4be36f342e2e474f204790e11ef9ca97adf3ee29c3dc0404b651b41bac104',	'[\"*\"]',	NULL,	NULL,	'2025-09-19 13:33:08',	'2025-09-19 13:33:08'),
(5,	'App\\Models\\User',	1,	'user',	'5f9d2f8558ae909ee1158f196ada27796dcab4fe8698be4517cb8633846d3484',	'[\"*\"]',	'2025-09-19 15:27:39',	NULL,	'2025-09-19 14:40:44',	'2025-09-19 15:27:39'),
(6,	'App\\Models\\User',	1,	'user',	'2dafab5a230966901c0b8c661b36db4a4c824e67b08b624a403424ead69f8f19',	'[\"*\"]',	'2025-09-19 16:29:00',	NULL,	'2025-09-19 16:11:54',	'2025-09-19 16:29:00'),
(7,	'App\\Models\\User',	1,	'user',	'e81aff709eac957dd4e12baa0052fcf6713c9e0076f50efc494ab0896201251b',	'[\"*\"]',	NULL,	NULL,	'2025-09-19 16:18:41',	'2025-09-19 16:18:41'),
(8,	'App\\Models\\User',	1,	'user',	'06c8cfd4427a98a9da546103a29b6778650a8c1150937f749883e7d1743fb368',	'[\"*\"]',	NULL,	NULL,	'2025-09-19 16:35:45',	'2025-09-19 16:35:45');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1,	1,	'post 1',	'Recusandae fuga culpa laboriosam dicta rerum. Vitae non expedita et vel in voluptatem aut accusantium tempora. Veritatis autem quas. Consequatur debitis quidem nesciunt. Id non totam dolores aperiam.\n \rNesciunt delectus unde qui exercitationem cum ut architecto. Sed et modi. Adipisci enim facilis. Minima fugiat nemo voluptatum culpa ipsa laudantium vel praesentium.\n \rQuo et beatae labore repudiandae perspiciatis sed necessitatibus ut nisi. Temporibus qui unde nihil. Similique enim aliquam impedit nihil.',	'2025-09-19 14:41:10',	'2025-09-19 14:41:10'),
(2,	2,	'integrated',	'Quia vel sint nisi tempore cum cupiditate amet. Placeat minima tempora qui ipsam ducimus eos magni. Nihil aut quibusdam. Ipsam facere omnis veniam dolorum doloribus aperiam voluptatum culpa doloremque. Laborum placeat laboriosam ipsum sapiente. Porro ex aut.\n \rLaborum perferendis enim rerum quia. Quas quia nobis necessitatibus quae. Molestiae molestiae illum qui sint necessitatibus iste. Laboriosam autem repellat autem est aliquam eveniet. Expedita sint illum ut sed. Fugiat maiores dolores praesentium alias nobis.\n \rEt ut ea voluptatem quia et. Aspernatur eos neque consequatur quia dolore et in. Ut officia ut.',	'2025-09-19 14:41:31',	'2025-09-19 14:41:31'),
(4,	1,	'lorem',	'Lorem Ipsum',	'2025-09-19 16:29:00',	'2025-09-19 16:29:00');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uSd9d7x301gNHAxHkQgH4Bgm3l9sOnexgMXhCnfq',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0FGZlJHT1RzOGhwUmJESmRacDJOU3NDZ292SEtROEd3cUgzQW9oSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vbWluaWJsb2cudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',	1758303502);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1,	'Felicita Gleason',	'Maudie47',	'iraoyahdavid200@gmail.com',	'2025-09-19 13:12:54',	'$2y$12$KFieJMDGK5.yenrdWfoJSebecrD/41iqJEN9EgfRvsyg4oKNi1s6i',	'2025-09-19 13:12:54',	'2025-09-19 13:12:54'),
(2,	'Brice Fadel',	'Brandy_Hoeger76',	'Drake_Herman@gmail.com',	'2025-09-19 13:28:43',	'$2y$12$wDeODJBq9aGuJYsJ5wq75enrDCcGybIFBkd8aL.tfF0w2yGQnohJC',	'2025-09-19 13:28:43',	'2025-09-19 13:28:43');

-- 2025-09-19 17:41:14
