-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 18 avr. 2024 à 13:25
-- Version du serveur : 8.1.0
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsb-cake`
--

-- --------------------------------------------------------

--
-- Structure de la table `cake_d_c_users_phinxlog`
--

CREATE TABLE `cake_d_c_users_phinxlog` (
  `version` bigint NOT NULL,
  `migration_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cake_d_c_users_phinxlog`
--

INSERT INTO `cake_d_c_users_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20150513201111, 'Initial', '2023-11-14 09:19:25', '2023-11-14 09:19:25', 0),
(20161031101316, 'AddSecretToUsers', '2023-11-14 09:19:25', '2023-11-14 09:19:25', 0),
(20190208174112, 'AddAdditionalDataToUsers', '2023-11-14 09:19:25', '2023-11-14 09:19:25', 0),
(20210929202041, 'AddLastLoginToUsers', '2023-11-14 09:19:25', '2023-11-14 09:19:25', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `doctor` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`id`, `doctor`) VALUES
(1, 'Pas de docteur'),
(2, 'Mr.X');

-- --------------------------------------------------------

--
-- Structure de la table `outpackages`
--

CREATE TABLE `outpackages` (
  `id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `outpackages`
--

INSERT INTO `outpackages` (`id`, `date`, `price`, `title`, `body`) VALUES
(120, '2023-11-24 13:41:38', 299.99, 'Échappez à l\'ordinaire', ' Préparez-vous à l\'aventure de votre vie avec notre pack extrême ! Comprend une séance de saut en parachute, une expédition en montagne, et une journée de rafting palpitante. Des sensations fortes garanties !'),
(121, '2023-11-24 13:42:10', 129.99, 'Voyage dans le Temps', 'Plongez dans l\'histoire et la culture avec notre pack spécial. Inclut des billets pour des musées renommés, une visite guidée du centre historique de la ville, et un spectacle captivant mettant en lumière le patrimoine local.'),
(122, '2023-11-24 13:45:58', 199.99, 'Voyage Culinaire', 'Explorez les délices de la gastronomie avec notre pack exclusif. Dégustez un repas gourmet dans un restaurant étoilé, suivi d\'une visite guidée dans une chocolaterie artisanale. Un festin pour les amateurs de bonne cuisine !'),
(123, '2023-11-24 13:46:20', 149.99, 'Oubliez le stress', 'Offrez-vous une pause bien méritée avec notre pack détente totale. Profitez d\'un massage relaxant dans un spa haut de gamme, suivi d\'une journée d\'accès à un centre de bien-être. Le moyen idéal de se ressourcer.'),
(124, '2023-11-24 14:18:54', 1, 'a', 'bbb'),
(125, '2023-11-24 14:19:04', 5, 'abc', 'body'),
(126, '2023-11-24 14:32:45', 55, 'df', ''),
(127, '2023-11-27 13:27:49', 2, 'petit pain', ''),
(128, '2023-11-27 13:28:13', 13, 'diner midi hors hotel', ''),
(129, '2023-12-05 09:19:55', 1234, 'ze', 'zedz'),
(130, '2024-03-14 16:51:38', 322, 'fvdfv', 'vdvfdv');

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `id` int NOT NULL,
  `price` float NOT NULL,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `packages`
--

INSERT INTO `packages` (`id`, `price`, `title`, `body`) VALUES
(1, 50, 'Hotel', 'Ressourcez-vous dans le luxe absolu avec notre carte \'Hôtel\'. Des escapades de rêve, des nuits inoubliables. Découvrez le confort et le charme à chaque séjour.'),
(2, 20, 'Taxi', 'Prenez le volant de l\'excitation avec Taxi! Des trajets sans tracas, des aventures urbaines en toute simplicité. Faites de chaque course une expérience mémorable.'),
(3, 500, 'Location Clement escort', 'Explorez le monde avec Clément en tant qu\'escort privé. Des destinations uniques, une aventure personnalisée. Découvrez le voyage ultime avec Clément Escort.'),
(4, 234, 'Thomas Ordinateur', '123');

-- --------------------------------------------------------

--
-- Structure de la table `sheets`
--

CREATE TABLE `sheets` (
  `id` int NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `state_id` int NOT NULL,
  `sheetvalidated` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  `doctor_id` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sheets`
--

INSERT INTO `sheets` (`id`, `user_id`, `state_id`, `sheetvalidated`, `created`, `modified`, `doctor_id`) VALUES
(8, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2023-11-14 12:43:51', '2023-12-15 07:57:19', 2),
(44, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 1, '2023-11-23 15:40:11', '2023-11-24 14:22:35', 1),
(45, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 2, 0, '2023-11-24 13:08:41', '2023-12-07 16:30:30', 1),
(47, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 3, 1, '2023-11-24 14:18:00', '2023-11-24 14:58:44', 1),
(49, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 4, 1, '2023-11-24 14:20:48', '2023-11-24 14:58:48', 1),
(50, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 5, 1, '2023-11-24 15:00:55', '2023-11-24 15:03:47', 1),
(52, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2023-12-05 08:07:49', '2023-12-05 08:07:49', 1),
(54, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 2, 0, '2023-12-05 09:19:35', '2024-03-14 16:45:12', 1),
(57, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2023-12-07 14:40:11', '2023-12-07 14:40:11', 1),
(58, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2023-12-07 15:03:42', '2023-12-07 15:03:42', 1),
(60, '92127281-9667-4410-8301-afafbc406394', 1, 0, '2023-12-07 16:27:33', '2023-12-07 16:27:33', 1),
(61, '92127281-9667-4410-8301-afafbc406394', 1, 0, '2023-12-07 16:27:34', '2023-12-07 16:27:34', 1),
(62, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2023-12-08 07:28:48', '2023-12-08 07:28:48', 1),
(63, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2023-12-14 15:31:08', '2023-12-14 15:31:08', 1),
(64, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2024-01-09 10:20:53', '2024-01-09 10:20:53', 1),
(65, '83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 1, 0, '2024-04-18 11:59:27', '2024-04-18 11:59:27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sheets_outpackages`
--

CREATE TABLE `sheets_outpackages` (
  `outpackage_id` int NOT NULL,
  `sheet_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sheets_outpackages`
--

INSERT INTO `sheets_outpackages` (`outpackage_id`, `sheet_id`) VALUES
(120, 8),
(121, 8),
(130, 8),
(122, 44),
(123, 44),
(126, 47),
(129, 54);

-- --------------------------------------------------------

--
-- Structure de la table `sheets_packages`
--

CREATE TABLE `sheets_packages` (
  `sheet_id` int NOT NULL,
  `package_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sheets_packages`
--

INSERT INTO `sheets_packages` (`sheet_id`, `package_id`, `quantity`) VALUES
(8, 1, 19),
(44, 1, 1),
(47, 1, 3),
(49, 1, 0),
(50, 1, 0),
(52, 1, 0),
(54, 1, 5),
(57, 1, 0),
(58, 1, 0),
(60, 1, 0),
(61, 1, 0),
(62, 1, 0),
(63, 1, 0),
(64, 1, 0),
(65, 1, 0),
(8, 2, 11),
(44, 2, 1),
(47, 2, 0),
(49, 2, 0),
(50, 2, 0),
(52, 2, 0),
(54, 2, 0),
(57, 2, 0),
(58, 2, 0),
(60, 2, 0),
(61, 2, 0),
(62, 2, 0),
(63, 2, 0),
(64, 2, 0),
(65, 2, 0),
(8, 3, 110),
(44, 3, 1),
(47, 3, 0),
(49, 3, 0),
(50, 3, 0),
(52, 3, 0),
(54, 3, 0),
(57, 3, 0),
(58, 3, 0),
(60, 3, 0),
(61, 3, 0),
(62, 3, 0),
(63, 3, 0),
(64, 3, 0),
(65, 3, 0),
(63, 4, 0),
(64, 4, 0),
(65, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` text,
  `link` varchar(255) NOT NULL,
  `token` varchar(500) NOT NULL,
  `token_secret` varchar(500) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `data` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `id` int NOT NULL,
  `state` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `states`
--

INSERT INTO `states` (`id`, `state`) VALUES
(1, 'Créé'),
(2, 'Fermé'),
(3, 'Paiement'),
(4, 'Remboursé'),
(5, 'Fini');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `api_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '123',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `secret` varchar(32) DEFAULT NULL,
  `secret_verified` tinyint(1) DEFAULT NULL,
  `tos_date` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_superuser` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(255) DEFAULT 'user',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `additional_data` text,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `api_password`, `first_name`, `last_name`, `token`, `token_expires`, `api_token`, `activation_date`, `secret`, `secret_verified`, `tos_date`, `active`, `is_superuser`, `role`, `created`, `modified`, `additional_data`, `last_login`) VALUES
('6ce815a0-ef68-4a2c-8d95-833792f13b94', 'comptable', 'comptable@test.test', '$2y$10$XdyWGiRMVtXoCbi2Z.ae4..NN0QOTvXs2WIk2D2rYBqqA8ZFnWemO', '123', '', '', 'f6a2be9b3c7c993139c15ef6161a7fc8', '2023-11-24 08:20:41', '', NULL, NULL, NULL, '2023-11-24 07:20:41', 1, 0, 'comptable', '2023-11-24 07:20:41', '2024-01-12 08:14:20', NULL, '2024-04-18 13:15:01'),
('83ccb8fd-b212-4f0c-8067-2d238eb9c0b3', 'superadmin', 'superadmin@example.com', '$2y$10$zsU7SNm5sZMgClAM.Is4euIim.7VcwpL.SjOHdAhaGyQtrCEXnqfa', '123', 'Ambroise', 'KRZANOWSKI', '', NULL, 'a9c26ca69c071286fc540c37154751cdca90f894cbe0f2f1d5277b649aba712f', NULL, NULL, NULL, NULL, 1, 1, 'superuser', '2023-11-14 10:19:26', '2024-04-16 21:29:31', NULL, '2024-04-18 13:14:18'),
('92127281-9667-4410-8301-afafbc406394', 'client', 'client@test.test', '$2y$10$n6vE1JWFIIoc0PGLk/dOMuwQ2SQPgsieSC91BMKbQBP/CAdyKsYAq', '123', '', '', '761d0a44ee252588b60674f444f6d5ce', '2023-11-24 08:20:57', '9997027f809789ae817a0bd6a93a4c4cb65800c21b055503568695651bd40f71', NULL, NULL, NULL, '2023-11-24 07:20:57', 1, 0, 'user', '2023-11-24 07:20:57', '2024-01-12 10:22:53', NULL, '2024-04-18 13:15:21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cake_d_c_users_phinxlog`
--
ALTER TABLE `cake_d_c_users_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `outpackages`
--
ALTER TABLE `outpackages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sheets`
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id --> id - FK` (`user_id`),
  ADD KEY `etat_id --> id - FK` (`state_id`),
  ADD KEY `doctor_id --> id - FK` (`doctor_id`);

--
-- Index pour la table `sheets_outpackages`
--
ALTER TABLE `sheets_outpackages`
  ADD PRIMARY KEY (`outpackage_id`,`sheet_id`),
  ADD KEY `fichefrais_id2 --> id - FK` (`sheet_id`),
  ADD KEY `lignefraishf_id --> id - FK` (`outpackage_id`);

--
-- Index pour la table `sheets_packages`
--
ALTER TABLE `sheets_packages`
  ADD PRIMARY KEY (`package_id`,`sheet_id`),
  ADD KEY `sheets_id` (`sheet_id`),
  ADD KEY `packages_id` (`package_id`);

--
-- Index pour la table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `outpackages`
--
ALTER TABLE `outpackages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT pour la table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sheets`
--
ALTER TABLE `sheets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sheets`
--
ALTER TABLE `sheets`
  ADD CONSTRAINT `doctor_id --> id - FK` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `etat_id --> id - FK` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sheets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `sheets_outpackages`
--
ALTER TABLE `sheets_outpackages`
  ADD CONSTRAINT `sheets_outpackages_ibfk_1` FOREIGN KEY (`outpackage_id`) REFERENCES `outpackages` (`id`),
  ADD CONSTRAINT `sheets_outpackages_ibfk_2` FOREIGN KEY (`sheet_id`) REFERENCES `sheets` (`id`);

--
-- Contraintes pour la table `sheets_packages`
--
ALTER TABLE `sheets_packages`
  ADD CONSTRAINT `sheets_packages_ibfk_1` FOREIGN KEY (`sheet_id`) REFERENCES `sheets` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sheets_packages_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
