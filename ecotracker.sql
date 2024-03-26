-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 mars 2024 à 00:37
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
  `Argent gagne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `defis`
--

INSERT INTO `defis` (`Id_defis`, `Intitule defis`, `Difficulte`, `Score`, `Status`, `Argent gagne`) VALUES
(8, 'Utilise un sac de courses réutilisable pour tous tes achats.', 'Facile', 25, 0, 50),
(9, 'Achète au moins trois produits d\'une marque écologique ou éthique.', 'Facile', 25, 0, 50),
(10, 'Achète uniquement des produits locaux et de saison pour tous tes repas de la journée.', 'Facile', 30, 0, 60),
(11, 'Mange un produit provenant d’un rayon anti-gaspi d’un supermarché.', 'Facile', 20, 0, 40),
(12, 'Bois uniquement de l’eau du robinet et non en bouteille.', 'Facile', 20, 0, 40),
(13, 'Utilise une gourde ou une tasse réutilisable.', 'Facile', 20, 0, 40),
(14, 'Sèche ton linge à l’air libre.', 'Facile', 20, 0, 40),
(15, 'Remplace au moins un produit jetable par une alternative réutilisable.', 'Facile', 25, 0, 50),
(16, 'Donne ou vends au moins un article inutilisé ou non désiré.', 'Facile', 25, 0, 50),
(17, 'Achète un produit seconde main.', 'Facile', 25, 0, 50),
(18, 'Rapporte une boîte de médicaments périmés à la pharmacie.', 'Facile', 20, 0, 40),
(19, 'Sensibilise une personne de ton entourage sur les actions à entreprendre pour réduire son empreinte carbone.', 'Facile', 25, 0, 50),
(20, 'Réalise tes achats sans aucun emballage plastique.', 'Moyen', 35, 0, 70),
(21, 'Prépare et consomme un repas végétalien.', 'Moyen', 40, 0, 80),
(22, 'Prépare et consomme un repas végétarien.', 'Moyen', 40, 0, 80),
(23, 'Évite les aliments transformés et cuisine uniquement des produits frais.', 'Moyen', 35, 0, 70),
(24, 'Estime et réduis le gaspillage alimentaire pour la journée.', 'Moyen', 35, 0, 70),
(25, 'Utilise uniquement des modes de transport écologiques (vélo, transports en commun, marche) pour tous tes déplacements.', 'Moyen', 40, 0, 80),
(26, 'Planifie une journée sans voiture et utilise exclusivement les transports en commun ou la marche.', 'Moyen', 40, 0, 80),
(27, 'Réduis ta vitesse de conduite de 10 km/h par rapport à ta vitesse habituelle pour économiser du carburant.', 'Moyen', 35, 0, 70),
(28, 'Opte pour le télétravail ou des réunions virtuelles plutôt que des déplacements physiques pour la journée.', 'Moyen', 35, 0, 70),
(29, 'Opte pour le covoiturage ou le partage de véhicules pour tous tes trajets de la journée.', 'Moyen', 40, 0, 80),
(30, 'Utilise uniquement des produits de nettoyage écologiques pour toutes les tâches ménagères.', 'Moyen', 35, 0, 70),
(31, 'Éteins tous les appareils électroniques non essentiels pendant toute la journée.', 'Moyen', 35, 0, 70),
(32, 'Réduis ta consommation d\'eau pour la journée en prenant des douches plus courtes et en limitant l\'utilisation de l\'eau courante.', 'Moyen', 35, 0, 70),
(33, 'Privilégie la douche au bain.', 'Moyen', 35, 0, 70),
(34, 'Utilise des ampoules à faible consommation.', 'Moyen', 35, 0, 70),
(35, 'Mets les chauffages en dessous de 20 degrés.', 'Moyen', 35, 0, 70),
(36, 'Trouve et achète un produit de seconde main dans un magasin de seconde main ou sur une plateforme en ligne.', 'Difficile', 50, 0, 100),
(37, 'Réduis la consommation de viande et opte pour des alternatives végétales pour tous les repas de la journée.', 'Difficile', 45, 0, 95),
(38, 'Récupère les invendus', 'Difficile', 45, 0, 95),
(39, 'Plante un arbre ou une plante indigène dans ton jardin ou sur ton balcon.', 'Difficile', 50, 0, 100),
(40, 'Crée un espace de jardinage écologique ou un potager sur ton balcon.', 'Difficile', 50, 0, 100),
(41, 'Installe un système d\'arrosage économiseur d\'eau ou un récupérateur d\'eau de pluie pour une utilisation dans ton jardin.', 'Difficile', 50, 0, 100),
(42, 'Récupère l’eau de pluie', 'Difficile', 50, 0, 100),
(43, 'Organise ou participe à une opération de nettoyage de rue ou de plage dans ta communauté.', 'Difficile', 45, 0, 95),
(44, 'Participe à un défi écologique en ligne ou rejoins une communauté virtuelle axée sur la durabilité.', 'Difficile', 45, 0, 95),
(45, 'Implique la famille ou les amis dans un défi écologique pour une journée.', 'Difficile', 50, 0, 100);

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
(5, 1, '2024-03-26', 20, 13, 32);

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
(5, 'fefe@gmail.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', 'Félix', '', 0, 0);

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
  MODIFY `Id_defis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `defis_quotidiens`
--
ALTER TABLE `defis_quotidiens`
  MODIFY `Id_defis_quotidiens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
