-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-12-2020 a las 10:03:42
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfony-taskmanager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201215081518', '2020-12-15 08:15:57', 124),
('DoctrineMigrations\\Version20201215082710', '2020-12-15 08:27:40', 145),
('DoctrineMigrations\\Version20201215082956', '2020-12-15 08:35:14', 152),
('DoctrineMigrations\\Version20201215112202', '2020-12-15 11:22:19', 157);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hours` int DEFAULT NULL,
  `priority` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_50586597A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `content`, `hours`, `priority`, `completed`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tarea 1', 'contenido tarea 1', 25, 'NORMAL', 'YES', '2020-12-31 10:30:05', '2020-12-15 10:30:05', NULL),
(2, 2, 'Tarea 2', 'contenido tarea 2', 235, 'HIGH', 'NO', '2020-12-31 10:30:05', '2020-12-15 10:30:05', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `roles`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Francisco', 'Marcet Prieto', 'fcomarcet1@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$aGZNNmtRdC5OOFpkRDdzWg$PG5KsEKLTwwkQISFBPJFHGo3JJoehXywo3BA3E5a1S8', '2020-12-15 11:17:24', NULL),
(7, 'Francisco2', 'Marcet Prieto2', 'fcomarcet12@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$TzUzYWgyQ3JrNmh0dkhCVA$2+fT/sNvaodznb8C9DcOsBBxOAgEpWE5bn5Kw0mArVQ', '2020-12-15 11:34:40', NULL),
(8, 'pppppppppp', 'ppppppppppppp', 'ppppppp@ppp.es', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZGZ2ek1RcE9BdGNrMUdnRA$6Jhu5Vx+N017cgeasD+UxBLBMz0IqNg+Jt/C92wrKrk', '2020-12-17 10:38:57', NULL),
(9, 'elcongp', 'linga', 'congo@linga.es', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$cHpaN0QwanVueklyTnhxUw$miPe6Ssi/n3JeaHrFKpbKhaQSU0hBELqw/y8/BxOWXI', '2020-12-17 11:06:22', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `FK_50586597A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
