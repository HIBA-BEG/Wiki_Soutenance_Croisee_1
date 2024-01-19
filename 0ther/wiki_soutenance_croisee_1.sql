-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 19 jan. 2024 à 22:54
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
-- Base de données : `wiki_soutenance_croisee_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL,
  `Created_AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Created_AdminID`) VALUES
(12, 'Livrables', 1),
(14, 'Soutenance Croisée', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `TagID` int(11) NOT NULL,
  `TagName` varchar(255) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`TagID`, `TagName`, `created_id`) VALUES
(2, 'HTML5', 1),
(3, 'UML', 1),
(4, 'HTML', 1),
(5, 'CSS', 1),
(6, 'JavaScript', 1),
(7, 'SEO', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PasswordHash` varchar(255) DEFAULT NULL,
  `role` enum('Author','Admin') NOT NULL DEFAULT 'Author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserID`, `Firstname`, `Lastname`, `Email`, `PasswordHash`, `role`) VALUES
(1, 'Hiba', 'Beghdi', 'beghiba@gmail.com', '$2y$10$QW4jld/a.kzzD.yl00nUJO9mESP1VzLIGWd2Zlh8mjIeUbv5A1Eay', 'Admin'),
(2, 'eytch', 'creations', 'eytchcreations@gmail.com', '$2y$10$hhsFEq2lII6RuF.imZUYHuoOmiDI8m1ONMPyHvAjYjFuf/8ggJfk.', 'Author'),
(8, 'Abdelilah', 'abdelilah', 'abdelilah@gmail.com', '$2y$10$au0oiXe9hILV.mf.K79VSuU1nH/UvGT.J/Befb6IHJlU5aU8prGWa', 'Author'),
(9, 'gjdzeh', 'hdznof', 'relirnir', '$2y$10$xavllnzWQ7WnMRHAMuoTP.7HaViVaFZkoq/QYCf6AlQzl4iMMgAku', 'Author'),
(10, 'rayane', 'fiache', 'rayane@hhh.com', '$2y$10$lJAjsTKs/scA.9byUyf6QOcNpgQw9/O152JSJjTxz/53x5pnUX1Te', 'Author'),
(11, 'soumia', 'sahtani', 'soumia', '$2y$10$aSD1qYsjkHbMpaQj7qfdo.zGNsGTFKFjC6QK9EULWhL0Zmp0B6QI.', 'Author'),
(12, 'aidar', 'aidar', 'aidar@gmail.com', '$2y$10$0qdhKspz00d/y2Btn31QuOw19ZKrlaJsSJZBysyVo4iwamUdS5Ntu', 'Author'),
(13, 'zineb', 'zineb', 'zineb@gmail.com', '$2y$10$7tE07eDO6wRVvEFBMhuL7OVGveYi6pefu1FMO.QYSsqQyrdoGP7d6', 'Author');

-- --------------------------------------------------------

--
-- Structure de la table `wikis`
--

CREATE TABLE `wikis` (
  `WikiID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `CreationDate` date DEFAULT NULL,
  `LastModifiedDate` date DEFAULT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `isArchived` tinyint(1) DEFAULT 0,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wikis`
--

INSERT INTO `wikis` (`WikiID`, `Title`, `Content`, `CreationDate`, `LastModifiedDate`, `AuthorID`, `isArchived`, `CategoryID`) VALUES
(4, 'Realisation d\'un siteweb pour une Société de vente de matériel de gaming\n', 'Ce brief met l\'accent sur la création de maquettes et de sites web pour une Société de vente de matériel de gaming, en réalisant sa page d\'accueil, page Catalogue, À propos et page Contact. en utilisant HTML, CSS, Framework CSS et JavaScript.', '2024-01-15', '2024-01-15', 2, 0, 12),
(7, 'Systeme de plannification des taches', 'Créer un Système de planification des taches en utilisant HTML, CSS, JAVASCRIPT et PHP ', '2024-01-15', '2024-01-15', 2, 0, 12),
(12, 'Wiki™ : Explorez, Créez et Partagez des Savoirs Ensemble!', 'Wiki™ a besoin d\'un gestionnaire de contenu et d\'un front office, pour faciliter la gestion des wikis sur la plateforme.', '2024-01-10', '2024-01-16', 10, 0, 14),
(14, 'Realisation d\'un siteweb pour une Salle de sport', 'Ce brief met l\'accent sur la création de maquettes et de sites web pour une Salle de sport, en réalisant sa page d\'accueil, page programmes, galerie et page inscription. en utilisant HTML, CSS et JavaScript.', '2024-01-16', '2024-01-16', 10, 0, 14);

-- --------------------------------------------------------

--
-- Structure de la table `wikitags`
--

CREATE TABLE `wikitags` (
  `WikiID` int(11) DEFAULT NULL,
  `TagID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wikitags`
--

INSERT INTO `wikitags` (`WikiID`, `TagID`) VALUES
(7, 2),
(7, 3),
(9, 2),
(10, 2),
(10, 3),
(11, 3),
(11, 2),
(12, 2),
(14, 4),
(14, 6),
(16, 2),
(16, 3),
(16, 6),
(16, 5),
(17, 4),
(18, 4),
(18, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `Created_AdminID` (`Created_AdminID`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`TagID`),
  ADD KEY `created_id` (`created_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Index pour la table `wikis`
--
ALTER TABLE `wikis`
  ADD PRIMARY KEY (`WikiID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `fk_wiki_categorie` (`CategoryID`);

--
-- Index pour la table `wikitags`
--
ALTER TABLE `wikitags`
  ADD KEY `WikiID` (`WikiID`),
  ADD KEY `TagID` (`TagID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `TagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `wikis`
--
ALTER TABLE `wikis`
  MODIFY `WikiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wikis`
--
ALTER TABLE `wikis`
  ADD CONSTRAINT `fk_wiki_categorie` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
