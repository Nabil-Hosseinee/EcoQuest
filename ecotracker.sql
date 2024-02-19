-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 19 fév. 2024 à 08:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecotracker`
--

-- --------------------------------------------------------

--
-- Structure de la table `acquisition`
--

CREATE TABLE `acquisition` (
  `Id_acquisition` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `item_Id` int(11) NOT NULL,
  `Date achat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `défis`
--

CREATE TABLE `défis` (
  `Id_defis` int(11) NOT NULL,
  `Intitule defis` varchar(200) NOT NULL,
  `Difficulte` varchar(50) NOT NULL COMMENT '0:Facile\r\n1:Moyen\r\n2:Difficile',
  `Score` int(11) NOT NULL,
  `Status` tinyint(3) NOT NULL COMMENT '0:Etat initial\r\n1:En cours\r\n2:Résolu\r\n',
  `Argent gagne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `défis`
--

INSERT INTO `défis` (`Id_defis`, `Intitule defis`, `Difficulte`, `Score`, `Status`, `Argent gagne`) VALUES
(1, 'Finir ses assiettes !', '0', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `Id_item` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL COMMENT '0:Banniere\r\n1:Avatar',
  `Image` int(11) NOT NULL,
  `Intitule item` varchar(100) NOT NULL,
  `Prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `Id_post` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `Photo` int(11) NOT NULL,
  `Commentaire` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realisation`
--

CREATE TABLE `realisation` (
  `Id_realisation` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `defis_Id` int(11) NOT NULL,
  `Niveau realisation` float NOT NULL,
  `Date debut` date NOT NULL,
  `Date fin` date NOT NULL,
  `Total score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `Identifiant` varchar(50) NOT NULL,
  `Mot de passe` varchar(50) NOT NULL,
  `Pseudo` varchar(50) NOT NULL,
  `Grade` varchar(50) NOT NULL,
  `Monnaie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id_user`, `Identifiant`, `Mot de passe`, `Pseudo`, `Grade`, `Monnaie`) VALUES
(1, 'dydy@gmail.com', 'caca', 'Dydy', 'Bandeur de pétrole', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acquisition`
--
ALTER TABLE `acquisition`
  ADD PRIMARY KEY (`Id_acquisition`),
  ADD KEY `user_Id` (`user_Id`,`item_Id`),
  ADD KEY `item_Id` (`item_Id`);

--
-- Index pour la table `défis`
--
ALTER TABLE `défis`
  ADD PRIMARY KEY (`Id_defis`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Id_item`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Id_post`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Index pour la table `realisation`
--
ALTER TABLE `realisation`
  ADD PRIMARY KEY (`Id_realisation`),
  ADD KEY `user_Id` (`user_Id`),
  ADD KEY `defis_Id` (`defis_Id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acquisition`
--
ALTER TABLE `acquisition`
  MODIFY `Id_acquisition` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `défis`
--
ALTER TABLE `défis`
  MODIFY `Id_defis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `Id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `Id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realisation`
--
ALTER TABLE `realisation`
  MODIFY `Id_realisation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acquisition`
--
ALTER TABLE `acquisition`
  ADD CONSTRAINT `acquisition_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `user` (`Id_user`),
  ADD CONSTRAINT `acquisition_ibfk_2` FOREIGN KEY (`item_Id`) REFERENCES `item` (`Id_item`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `user` (`Id_user`);

--
-- Contraintes pour la table `realisation`
--
ALTER TABLE `realisation`
  ADD CONSTRAINT `realisation_ibfk_1` FOREIGN KEY (`defis_Id`) REFERENCES `défis` (`Id_defis`),
  ADD CONSTRAINT `realisation_ibfk_2` FOREIGN KEY (`user_Id`) REFERENCES `user` (`Id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
