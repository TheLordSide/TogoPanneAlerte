-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 23 fév. 2024 à 15:39
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `togopannealerte`
--

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `fournisseur` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `designation`, `fournisseur`, `type`, `description`) VALUES
(1, 'd', 'dde', 'efe', 'f'),
(2, 'togo', 'togocom', 'mobile money', 'blabla'),
(3, 'togog', 'togocom', 'mobile money', 'blabla');

-- --------------------------------------------------------

--
-- Structure de la table `signaler`
--

CREATE TABLE `signaler` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_services` int(11) NOT NULL,
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_on` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_on`) VALUES
(1, 'ss', 'c', 'f', '2024-02-20 20:32:26.000000'),
(2, 'ss', 'c', 'f', '2024-02-20 20:34:35.000000'),
(3, 'ss', 'c', 'f', '2024-02-20 20:39:12.000000'),
(4, 'ssddd', 'cdd', 'fdd', '2024-02-20 20:44:59.000000'),
(5, 'ssddde', 'cdd', 'fdd', '2024-02-20 20:45:05.000000'),
(6, 'ssdddeyxsa', 'cdd', 'fdd', '2024-02-20 20:46:55.000000'),
(7, 'antoine', '7788', 'sdsdd', '2024-02-20 22:09:55.000000'),
(8, 'toto', '$2y$10$NvxbKrRm4lGK3rKCl26/1euAKBw.qIhoZ9ZyMtonUEzbw3AQFPbtm', 'mobile money', '2024-02-21 14:04:57.000000'),
(9, 'koffi', '$2y$10$OkTYchzZzP66LysBrRCFg.qLl3uHurHQhPdXJ8d4DiihoqGwKH8uu', 'mobile', '2024-02-21 14:45:15.000000'),
(10, 'ruben', '$2y$10$FX/2siBhxWkIHfE91BwDVOpE3U5rklKe4SSWyQl.chHwWVFxtrxXe', 'mobile', '2024-02-21 15:32:28.000000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signaler`
--
ALTER TABLE `signaler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Cle secondaire` (`id_users`),
  ADD KEY `Cle secondaire 2` (`id_services`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `signaler`
--
ALTER TABLE `signaler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `signaler`
--
ALTER TABLE `signaler`
  ADD CONSTRAINT `Cle secondaire` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `Cle secondaire 2` FOREIGN KEY (`id_services`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
