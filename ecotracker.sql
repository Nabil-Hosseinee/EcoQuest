-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 mars 2024 à 09:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

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
  `Date achat` date NOT NULL,
  `Obtenu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `defis`
--

CREATE TABLE `defis` (
  `Id_defis` int(11) NOT NULL,
  `Intitule defis` varchar(200) NOT NULL,
  `Difficulte` varchar(50) NOT NULL COMMENT '0:Facile\r\n1:Moyen\r\n2:Difficile',
  `Score` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '0:Etat initial\r\n1:En cours\r\n2:Résolu\r\n3:Sélectionné',
  `Argent gagne` int(11) NOT NULL,
  `date_expiration` datetime NOT NULL DEFAULT concat(curdate(),' 23:59:59'),
  `Date_debut` date NOT NULL DEFAULT (curdate() + interval 7 - dayofweek(curdate()) day)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `defis`
--

INSERT INTO `defis` (`Id_defis`, `Intitule defis`, `Difficulte`, `Score`, `Status`, `Argent gagne`, `date_expiration`, `Date_debut`) VALUES
(2, 'Utilise un sac de courses réutilisable\r\n', '0', 25, 0, 100, '2024-03-01 23:59:59', '2024-03-02'),
(3, 'Fais un repas végétarien', '1', 50, 0, 250, '2024-03-01 23:59:59', '2024-03-02'),
(4, 'Fais du covoiturage', '2', 100, 0, 400, '2024-03-01 23:59:59', '2024-03-02'),
(5, 'Utilise une gourde', '0', 20, 0, 80, '2024-03-01 23:59:59', '2024-03-02'),
(6, 'Prend les transports en commun au lieu de ta voiture', '1', 45, 0, 200, '2024-03-01 23:59:59', '2024-03-02'),
(7, 'Répare un objet', '2', 90, 0, 350, '2024-03-01 23:59:59', '2024-03-02');

-- --------------------------------------------------------

--
-- Structure de la table `defis_quotidiens`
--

CREATE TABLE `defis_quotidiens` (
  `Id_defis_quotidiens` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `defi_id1` int(11) NOT NULL,
  `defi_id2` int(11) NOT NULL,
  `defi_id3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `defis_quotidiens`
--

INSERT INTO `defis_quotidiens` (`Id_defis_quotidiens`, `user_id`, `date`, `defi_id1`, `defi_id2`, `defi_id3`) VALUES
(3, 1, '2024-03-19', 7, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `Id_item` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL COMMENT '0:Banniere\r\n1:Avatar',
  `Lien image` varchar(200) NOT NULL,
  `Intitule item` varchar(50) NOT NULL,
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
  `Date fin` date NOT NULL
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
  `Total score` int(11) NOT NULL,
  `Monnaie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id_user`, `Identifiant`, `Mot de passe`, `Pseudo`, `Grade`, `Total score`, `Monnaie`) VALUES
(1, 'dydy@gmail.com', 'a16358be6e2306b153b1f071477e68837266075e', 'Dydy', 'Bandeur de pétrole', 0, 0),
(2, 'theo.francius.pro@gmail.com', '45e7527f4b4f3facc568dc2cc04d50a4af877cb9', 'francth6', '', 0, 0),
(3, 'nabil@gmail.com', 'b448adef6d5c7477a52776f504adc55d94364a98', 'Hambouk', '', 0, 0);

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
-- Index pour la table `defis`
--
ALTER TABLE `defis`
  ADD PRIMARY KEY (`Id_defis`);

--
-- Index pour la table `defis_quotidiens`
--
ALTER TABLE `defis_quotidiens`
  ADD PRIMARY KEY (`Id_defis_quotidiens`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `defi_id1` (`defi_id1`,`defi_id2`,`defi_id3`),
  ADD KEY `defi_id2` (`defi_id2`),
  ADD KEY `defi_id3` (`defi_id3`);

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
-- AUTO_INCREMENT pour la table `defis`
--
ALTER TABLE `defis`
  MODIFY `Id_defis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `defis_quotidiens`
--
ALTER TABLE `defis_quotidiens`
  MODIFY `Id_defis_quotidiens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Contraintes pour la table `defis_quotidiens`
--
ALTER TABLE `defis_quotidiens`
  ADD CONSTRAINT `defis_quotidiens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id_user`),
  ADD CONSTRAINT `defis_quotidiens_ibfk_2` FOREIGN KEY (`defi_id1`) REFERENCES `defis` (`Id_defis`),
  ADD CONSTRAINT `defis_quotidiens_ibfk_3` FOREIGN KEY (`defi_id2`) REFERENCES `defis` (`Id_defis`),
  ADD CONSTRAINT `defis_quotidiens_ibfk_4` FOREIGN KEY (`defi_id3`) REFERENCES `defis` (`Id_defis`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `user` (`Id_user`);

--
-- Contraintes pour la table `realisation`
--
ALTER TABLE `realisation`
  ADD CONSTRAINT `realisation_ibfk_1` FOREIGN KEY (`defis_Id`) REFERENCES `defis` (`Id_defis`),
  ADD CONSTRAINT `realisation_ibfk_2` FOREIGN KEY (`user_Id`) REFERENCES `user` (`Id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
