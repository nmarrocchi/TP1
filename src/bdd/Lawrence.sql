-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 05 oct. 2021 à 03:41
-- Version du serveur :  10.3.29-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Lawrence`
--

-- --------------------------------------------------------

--
-- Structure de la table `boats`
--

CREATE TABLE `boats` (
  `_ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Color` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boats`
--

INSERT INTO `boats` (`_ID`, `Name`, `Color`) VALUES
(1, 'Concordia', '#0000ff'),
(2, 'Salut', '#00ff00'),
(3, 'LeBoDoggo', '#e1e114');

-- --------------------------------------------------------

--
-- Structure de la table `pins`
--

CREATE TABLE `pins` (
  `_ID` int(11) NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pins`
--

INSERT INTO `pins` (`_ID`, `x`, `y`, `name`) VALUES
(7, 49.8438, 1.22501, 'Meulers, Chez le Big Doggo'),
(5, 49.8774, 2.30134, 'Lapro');

-- --------------------------------------------------------

--
-- Structure de la table `traces`
--

CREATE TABLE `traces` (
  `_ID` int(11) NOT NULL,
  `_IDboat` varchar(30) NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `traces`
--

INSERT INTO `traces` (`_ID`, `_IDboat`, `x`, `y`, `timestamp`) VALUES
(1, '1', 49.8769, 2.30471, '2021-09-20 14:23:31'),
(2, '1', 49.8652, 2.31724, '2021-09-20 14:23:31'),
(23, '2', 38, 21, '2021-09-21 14:23:31'),
(24, '2', 40, 25, '2021-09-21 14:23:31'),
(25, '2', 40, 30, '2021-09-21 14:23:31'),
(26, '2', 50, 80, '2021-09-21 14:23:31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(2505) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `admin`) VALUES
(13, '1234', '098f6bcd4621d373cade4e832627b4f6', 1),
(14, 'admin', 'admin', 1),
(15, 'Doggo', 'Doggo', 1),
(16, 'lucas', 'lucas', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boats`
--
ALTER TABLE `boats`
  ADD PRIMARY KEY (`_ID`);

--
-- Index pour la table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`_ID`);

--
-- Index pour la table `traces`
--
ALTER TABLE `traces`
  ADD PRIMARY KEY (`_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boats`
--
ALTER TABLE `boats`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `pins`
--
ALTER TABLE `pins`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `traces`
--
ALTER TABLE `traces`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
