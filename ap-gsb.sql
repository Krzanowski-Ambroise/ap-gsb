-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 nov. 2023 à 09:23
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ap-gsb`
--


-- --------------------------------------------------------

--
-- Structure de la table `outpackages`
--

CREATE TABLE `outpackages` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` float NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sheets`
--

CREATE TABLE `sheets` (
  `id` int(11) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `sheetvalidated` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sheets_outpackages`
--

CREATE TABLE `sheets_outpackages` (
  `outpackage_id` int(11) NOT NULL,
  `sheet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sheets_packages`
--

CREATE TABLE `sheets_packages` (
  `sheet_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

-- Index pour les tables déchargées
--

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
-- Index pour la table `sheets_outpackages`
--
ALTER TABLE `sheets_outpackages`
  ADD PRIMARY KEY (`outpackage_id`,`sheet_id`),
  ADD KEY `sheet_id` (`sheet_id`);

--
-- Index pour la table `sheets_packages`
--
ALTER TABLE `sheets_packages`
  ADD PRIMARY KEY (`sheet_id`,`package_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `outpackages`
--
ALTER TABLE `outpackages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sheets`
--
ALTER TABLE `sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sheets`
--
ALTER TABLE `sheets`
  ADD CONSTRAINT `sheets_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `sheets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `sheets_outpackages`
--
ALTER TABLE `sheets_outpackages`
  ADD CONSTRAINT `sheets_outpackages_ibfk_1` FOREIGN KEY (`sheet_id`) REFERENCES `sheets` (`id`),
  ADD CONSTRAINT `sheets_outpackages_ibfk_2` FOREIGN KEY (`outpackage_id`) REFERENCES `outpackages` (`id`);

--
-- Contraintes pour la table `sheets_packages`
--
ALTER TABLE `sheets_packages`
  ADD CONSTRAINT `sheets_packages_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  ADD CONSTRAINT `sheets_packages_ibfk_2` FOREIGN KEY (`sheet_id`) REFERENCES `sheets` (`id`);

--
-- Index pour la table `sheets`
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `user_id` (`user_id`);