-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 31 jan. 2025 à 15:04
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
-- Base de données : `TER_DB`
--

-- --------------------------------------------------------

--
-- Structure de la table `post-it`
--

CREATE TABLE `post-it` (
  `idPostIt` varchar(25) NOT NULL,
  `titrePostIt` varchar(200) NOT NULL,
  `contenuPostIt` varchar(1000) NOT NULL,
  `datecreatePostIt` datetime NOT NULL,
  `datemodificationPostIt` datetime NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `idUser` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post-it-partager`
--

CREATE TABLE `post-it-partager` (
  `idPostItShare` int(11) NOT NULL,
  `idPostIt` varchar(25) NOT NULL,
  `idUser` varchar(25) NOT NULL,
  `datePartage` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeuser`
--

CREATE TABLE `typeuser` (
  `idTypeUser` int(11) NOT NULL,
  `nomTypeUser` varchar(25) NOT NULL,
  `numeroTypeUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `typeuser`
--

INSERT INTO `typeuser` (`idTypeUser`, `nomTypeUser`, `numeroTypeUser`) VALUES
(1, 'user', 2),
(2, 'admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` varchar(25) NOT NULL,
  `nomUser` varchar(25) NOT NULL,
  `prenomUser` varchar(25) NOT NULL,
  `pseudoUser` varchar(10) NOT NULL,
  `mailUser` varchar(255) NOT NULL,
  `datenaissanceUser` date NOT NULL,
  `dateinscriptionUser` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `passwordUser` varchar(255) NOT NULL,
  `idTypeUser` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `nomUser`, `prenomUser`, `pseudoUser`, `mailUser`, `datenaissanceUser`, `dateinscriptionUser`, `image`, `passwordUser`, `idTypeUser`) VALUES
('US001', 'Fomat', 'Gide', 'adrien', 'azanguefomatgide@gmail.com', '2025-01-15', '2025-01-29 12:41:38', '/opt/lampp/htdocs/TER_MIAGE/view/inscription_View.php', '$2y$10$JO3BsHOfCRUpj5o/bzdt0uw.pjZp0UDVQZRQgR.DgAWWtu9uxN1Yq', 2),
('US002', 'faye', 'Fallou', 'fgfgkk', 'falloufay@gmail.com', '2025-01-07', '2025-01-29 15:09:33', '/opt/lampp/htdocs/TER_MIAGE/view/inscription_View.php', '$2y$10$FRSDMN8UZbPp97byQpQbpO3nvLZbDd2JPwOW8Aq6MrAZV10m0jJP6', 2),
('US003', 'Seck', 'Fatim', 'faa', 'sel@gmail.com', '2025-01-08', '2025-01-30 17:11:47', '/opt/lampp/htdocs/TER_MIAGE/view/inscription_View.php', '$2y$10$7qmwuWKJdr6Z34LvQDmYyOQR4CiB/Pxrd0uYCfjIedYi8o38NwOlq', 2),
('US004', 'abc', 'azerty', 'abcd', 'abc@gmail.com', '2025-01-31', '2025-01-30 17:31:22', '/opt/lampp/htdocs/TER_MIAGE/view/inscription_View.php', '$2y$10$vXhE8N2S.fM2gSkES30PtOqDoa/5Nlnm/0Ek.UIO7uD42WP.zK25S', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `post-it`
--
ALTER TABLE `post-it`
  ADD PRIMARY KEY (`idPostIt`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `post-it-partager`
--
ALTER TABLE `post-it-partager`
  ADD PRIMARY KEY (`idPostItShare`),
  ADD KEY `idPostIt` (`idPostIt`,`idUser`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `typeuser`
--
ALTER TABLE `typeuser`
  ADD PRIMARY KEY (`idTypeUser`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `pseudoUser` (`pseudoUser`),
  ADD UNIQUE KEY `mailUser` (`mailUser`),
  ADD KEY `idTypeUser` (`idTypeUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `post-it-partager`
--
ALTER TABLE `post-it-partager`
  MODIFY `idPostItShare` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeuser`
--
ALTER TABLE `typeuser`
  MODIFY `idTypeUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post-it`
--
ALTER TABLE `post-it`
  ADD CONSTRAINT `post-it_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post-it-partager`
--
ALTER TABLE `post-it-partager`
  ADD CONSTRAINT `post-it-partager_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post-it-partager_ibfk_2` FOREIGN KEY (`idPostIt`) REFERENCES `post-it` (`idPostIt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idTypeUser`) REFERENCES `typeuser` (`idTypeUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
