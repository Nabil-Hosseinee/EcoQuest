-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 27 mars 2024 à 08:38
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
  `Argent gagne` int(11) NOT NULL,
  `Impact` int(11) NOT NULL,
  `Icone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `defis`
--

INSERT INTO `defis` (`Id_defis`, `Intitule defis`, `Difficulte`, `Score`, `Argent gagne`, `Impact`, `Icone`) VALUES
(8, 'Utilise un sac de courses réutilisable pour tous tes achats.', 'Facile', 25, 50, 50, 'images/icons/shopping-cart-solid.svg'),
(9, 'Achète au moins trois produits d\'une marque écologique ou éthique.', 'Facile', 25, 50, 50, 'images/icons/shopping-cart-solid.svg'),
(10, 'Achète uniquement des produits locaux et de saison pour tous tes repas de la journée.', 'Facile', 30, 60, 60, 'images/icons/shopping-cart-solid.svg'),
(11, 'Mange un produit provenant d’un rayon anti-gaspi d’un supermarché.', 'Facile', 20, 40, 40, 'images/icons/utensils-solid.svg'),
(12, 'Bois uniquement de l’eau du robinet et non en bouteille.', 'Facile', 20, 40, 40, 'images/icons/utensils-solid.svg'),
(13, 'Utilise une gourde ou une tasse réutilisable.', 'Facile', 20, 40, 40, 'images/icons/bolt-solid.svg'),
(14, 'Sèche ton linge à l’air libre.', 'Facile', 20, 40, 40, 'images/icons/bolt-solid.svg'),
(15, 'Remplace au moins un produit jetable par une alternative réutilisable.', 'Facile', 25, 50, 50, 'images/icons/utensils-solid.svg'),
(16, 'Donne ou vends au moins un article inutilisé ou non désiré.', 'Facile', 25, 50, 50, 'images/icons/utensils-solid.svg'),
(17, 'Achète un produit seconde main.', 'Facile', 25, 50, 50, 'images/icons/utensils-solid.svg'),
(18, 'Rapporte une boîte de médicaments périmés à la pharmacie.', 'Facile', 20, 40, 40, 'images/icons/utensils-solid.svg'),
(19, 'Sensibilise une personne de ton entourage sur les actions à entreprendre pour réduire son empreinte carbone.', 'Facile', 25, 50, 50, 'images/icons/shopping-basket-solid.svg'),
(20, 'Réalise tes achats sans aucun emballage plastique.', 'Moyen', 35, 70, 70, 'images/icons/shopping-cart-solid.svg'),
(21, 'Prépare et consomme un repas végétalien.', 'Moyen', 40, 80, 80, 'images/icons/utensils-solid.svg'),
(22, 'Prépare et consomme un repas végétarien.', 'Moyen', 40, 80, 80, 'images/icons/utensils-solid.svg'),
(23, 'Évite les aliments transformés et cuisine uniquement des produits frais.', 'Moyen', 35, 70, 70, 'images/icons/utensils-solid.svg'),
(24, 'Estime et réduis le gaspillage alimentaire pour la journée.', 'Moyen', 35, 70, 70, 'images/icons/utensils-solid.svg'),
(25, 'Utilise uniquement des modes de transport écologiques (vélo, transports en commun, marche) pour tous tes déplacements.', 'Moyen', 40, 80, 80, 'images/icons/bus-alt-solid.svg'),
(26, 'Planifie une journée sans voiture et utilise exclusivement les transports en commun ou la marche.', 'Moyen', 40, 80, 80, 'images/icons/bus-alt-solid.svg'),
(27, 'Réduis ta vitesse de conduite de 10 km/h par rapport à ta vitesse habituelle pour économiser du carburant.', 'Moyen', 35, 70, 70, 'images/icons/bus-alt-solid.svg'),
(28, 'Opte pour le télétravail ou des réunions virtuelles plutôt que des déplacements physiques pour la journée.', 'Moyen', 35, 70, 70, 'images/icons/bus-alt-solid.svg'),
(29, 'Opte pour le covoiturage ou le partage de véhicules pour tous tes trajets de la journée.', 'Moyen', 40, 80, 80, 'images/icons/bus-alt-solid.svg'),
(30, 'Utilise uniquement des produits de nettoyage écologiques pour toutes les tâches ménagères.', 'Moyen', 35, 70, 70, 'images/icons/bolt-solid.svg'),
(31, 'Éteins tous les appareils électroniques non essentiels pendant toute la journée.', 'Moyen', 35, 70, 70, 'images/icons/bolt-solid.svg'),
(32, 'Réduis ta consommation d\'eau pour la journée en prenant des douches plus courtes et en limitant l\'utilisation de l\'eau courante.', 'Moyen', 35, 70, 70, 'images/icons/bolt-solid.svg'),
(33, 'Privilégie la douche au bain.', 'Moyen', 35, 70, 70, 'images/icons/bolt-solid.svg'),
(34, 'Utilise des ampoules à faible consommation.', 'Moyen', 35, 70, 70, 'images/icons/bolt-solid.svg'),
(35, 'Mets les chauffages en dessous de 20 degrés.', 'Moyen', 35, 70, 70, 'images/icons/bolt-solid.svg'),
(36, 'Trouve et achète un produit de seconde main dans un magasin de seconde main ou sur une plateforme en ligne.', 'Difficile', 50, 100, 100, 'images/icons/shopping-basket-solid.svg'),
(37, 'Réduis la consommation de viande et opte pour des alternatives végétales pour tous les repas de la journée.', 'Difficile', 45, 95, 95, 'images/icons/shopping-basket-solid.svg'),
(38, 'Récupère les invendus', 'Difficile', 45, 95, 95, 'images/icons/shopping-basket-solid.svg'),
(39, 'Plante un arbre ou une plante indigène dans ton jardin ou sur ton balcon.', 'Difficile', 50, 100, 100, 'images/icons/tree-solid.svg'),
(40, 'Crée un espace de jardinage écologique ou un potager sur ton balcon.', 'Difficile', 50, 100, 100, 'images/icons/tree-solid.svg'),
(41, 'Installe un système d\'arrosage économiseur d\'eau ou un récupérateur d\'eau de pluie pour une utilisation dans ton jardin.', 'Difficile', 50, 100, 100, 'images/icons/tree-solid.svg'),
(42, 'Récupère l’eau de pluie', 'Difficile', 50, 100, 100, 'images/icons/tree-solid.svg'),
(43, 'Organise ou participe à une opération de nettoyage de rue ou de plage dans ta communauté.', 'Difficile', 45, 95, 95, 'images/icons/globe-solid.svg'),
(44, 'Participe à un défi écologique en ligne ou rejoins une communauté virtuelle axée sur la durabilité.', 'Difficile', 45, 95, 95, 'images/icons/globe-solid.svg'),
(45, 'Implique la famille ou les amis dans un défi écologique pour une journée.', 'Difficile', 50, 100, 100, 'images/icons/globe-solid.svg');

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
(6, 6, '2024-03-26', 38, 17, 43),
(7, 5, '2024-03-26', 28, 44, 21),
(8, 8, '2024-03-26', 11, 40, 42),
(9, 9, '2024-03-26', 38, 30, 10),
(10, 10, '2024-03-26', 35, 30, 34),
(11, 11, '2024-03-26', 32, 44, 12),
(12, 12, '2024-03-26', 30, 31, 45),
(13, 13, '2024-03-26', 21, 37, 32),
(14, 14, '2024-03-26', 22, 23, 39),
(15, 1, '2024-03-27', 41, 32, 19);

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

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`Id_item`, `Type`, `Lien image`, `Intitule item`, `Prix`) VALUES
(1, 'Banniere', './images/items/ban1.jpg', 'Bannière 1', 1200),
(2, 'Banniere', './images/items/ban2.jpg', 'Bannière 2', 1000),
(3, 'Banniere', './images/items/ban3.jpg', 'Bannière 3', 800),
(4, 'Banniere', './images/items/ban4.jpg', 'Bannière 4', 500),
(5, 'Banniere', './images/items/banner4.jpg', 'Bannière 5', 1500),
(6, 'Banniere', './images/items/banner5.jpg', 'Bannière 6', 1100),
(7, 'Banniere', './images/items/ban5.png', 'Bannière 7', 1200),
(8, 'Avatar', './images/items/pp1.png', 'Avatar 1', 150),
(9, 'Avatar', './images/items/pp2.png', 'Avatar 2', 250),
(10, 'Avatar', './images/items/pp3.png', 'Avatar 3', 350),
(11, 'Avatar', './images/items/pp4.png', 'Avatar 4', 200),
(12, 'Avatar', './images/items/pp5.png', 'Avatar 5', 170),
(13, 'Avatar', './images/items/pp6.png', 'Avatar 6', 350),
(14, 'Avatar', './images/items/pp7.png', 'Avatar 7', 320),
(15, 'Avatar', './images/items/pp8.png', 'Avatar 8', 175),
(16, 'Avatar', './images/items/pp9.png', 'Avatar 9', 125),
(17, 'Avatar', './images/items/pp10.png', 'Avatar 10', 150);

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
  `Statut` tinyint(4) NOT NULL COMMENT '0:Etat initial\r\n1:En cours\r\n2:Résolu\r\n3:Sélectionné'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `realisation`
--

INSERT INTO `realisation` (`Id_realisation`, `user_Id`, `defis_Id`, `Statut`) VALUES
(16, 1, 13, 2),
(17, 1, 20, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
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

INSERT INTO `user` (`Id_user`, `Nom`, `Identifiant`, `Mot de passe`, `Pseudo`, `Grade`, `Total score`, `Monnaie`) VALUES
(1, 'Dylan', 'dydy@gmail.com', 'a16358be6e2306b153b1f071477e68837266075e', 'Dydy', 'Débutant Écolo', 145, 290),
(5, 'Félix', 'fefe@gmail.com', '70c881d4a26984ddce795f6f71817c9cf4480e79', 'Félix', 'Éco-Héros', 1000, 0),
(6, 'Nabil', 'nab@gmail.com', '842ba8199bc58660cf8f8d5b93c232d9d8911b4a', 'Nab', 'Gardien de la Terre', 500, 0),
(8, 'Théo', 'theo@gmail.com', 'cf91a9cfe0882326bc9e5276dcdb1cce8cbef4ce', 'Tété', 'Éco-Héros', 1200, 0),
(9, 'Alison', 'alison@gmail.com', '4a4f22fbabc5d6375b354538de0249eb0a80f614', 'Ashley', 'Gardien de la Terre', 500, 0),
(10, 'Manaelle', 'manaelle@gmail.com', '01a4c628bf98d409ada357ab6ad62302160d8013', 'Manaelle', 'Éco-Héros', 1800, 0),
(11, 'Mathieu', 'mathieu@gmail.com', 'cc7c5be316e48d137cbb549833b85d91034d799d', 'Mathieu', 'Gardien de la Terre', 800, 0),
(12, 'Carpentier', 'carpentier@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Carpentier', 'Gardien de la Terre', 700, 0),
(13, 'admin', 'admin@gmail.com', 'ab5311135a23a194fec8882cfa18ab24fa286f10', 'admin', 'Éco-Héros', 1300, 0),
(14, 'Joetzer', 'joetzer@gmail.com', '1af2dd2154acccc0985ba300880ea1157825b016', 'Joetzer', 'Éco-Héros', 1700, 0);

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
  MODIFY `Id_defis_quotidiens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `Id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `Id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realisation`
--
ALTER TABLE `realisation`
  MODIFY `Id_realisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
