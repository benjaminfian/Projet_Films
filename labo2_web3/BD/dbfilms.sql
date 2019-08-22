-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 15 avr. 2019 à 22:23
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbfilms`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pw` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `idMembre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`email`, `pw`, `admin`, `idMembre`) VALUES
('admin@mail.com', '1234', 1, 2),
('benjamin@mail.com', '123', 0, 1),
('test@mail.com', '123', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `idFilm` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `realisateur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prix` float NOT NULL,
  `duree` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trailer` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`idFilm`, `titre`, `realisateur`, `categorie`, `prix`, `duree`, `image`, `trailer`) VALUES
(5, 'Le chemin du pardon', 'Stuart Hazeldine', 'Drame', 12.99, 133, '7a433c5cbd15ae08046191866b8baa8a6e27e93f.jpg', 'vhD8rxOlzXk'),
(6, 'Green book', 'Peter Farrelly', 'Drame', 16.99, 130, '20e5d0a4abe61e78d946486937d17820644041df.jpg', 'QkZxoko_HC0'),
(7, 'Lost journey', 'Ant Horasanli', 'Drame', 10.99, 90, 'ce004277db46ad341f8958848ecebe9ebf3fb0cd.jpg', 'iCN-aqktiCQ'),
(8, 'La reine des jeux', 'Evan Oppenheimer', 'Drame', 19.99, 92, 'a29d56133c787afb18090af33868c28eb889b31a.jpg', 'W6g8B6Pxfyk'),
(9, 'Aquaman', 'James Wan', 'Action', 24.99, 142, 'ce6fd12d9498a88bbc21bf2eb9a48faadd6f7aa5.jpg', 'KMR-6-YizZQ'),
(10, 'Hunter killer', 'Donovan Marsh', 'Action', 5.99, 121, 'feef30810746e8552d000940d4a0d7b8dbedbc25.jpg', '7PGdkzfbylI'),
(11, 'Avengers : Age of Ultron', 'Joss Whedon', 'Action', 19.99, 142, 'd06ed68a0e2bc3cd0652651e537e6a3add485a7d.jpg', 'tmeOjFno6Do'),
(12, 'Mission impossible fallout', 'Christopher McQuarrie', 'Action', 19.99, 148, 'c36f5de1779d84e72a8306cd6470848fdaecd010.jpg', 'UVkqr69F5mA'),
(13, 'Annihilation', 'Alex Garland', 'Science-fiction', 24.99, 120, '162f594477de4daaccc6e7de2ec959d5bd581c01.jpg', 'ufaDurSCKOk'),
(14, 'Prometheus', 'Ridley Scott', 'Science-fiction', 14.99, 124, 'eb9d1e5820dc59fafb6e267ee13ce66fc8cb2c9c.jpg', 'sftuxbvGwiU'),
(15, 'En eaux troubles', 'Jon Turteltaub', 'Science-fiction', 24.99, 112, '1dd672d38dbae990a32abe59d3fefc576b22839b.jpg', '1ePgiiLpoyI'),
(16, 'Blade runner 2049', 'Denis Villeneuve', 'Science-fiction', 18.99, 164, '17fcf195bb984696d333373e5a46276563f30555.jpg', 'UiLKaU_n-gY'),
(17, 'Halloween', 'David Gordon Green', 'Horreur', 24.99, 104, '64c2f403d4af9079f644cf8f1a2c87d6eed3adf5.jpg', 'ek1ePFp-nBI'),
(18, 'Mischief night', 'Richard Schenkman', 'Horreur', 8.99, 87, '3b7c21958e8fcb1a5faa53e607c8e4669005f682.jpg', 'PrcWuoYwpwM'),
(19, 'The reef', 'Andrew Traucki', 'Horreur', 9.99, 94, '213fb638884138c068e623a4fe075ab8e25e1edc.jpg', 'GCB6ejamx-k'),
(20, 'Poltergeist', 'Gil Kenan', 'Horreur', 19.99, 101, '06c81419b107a6c530d5e10d3434f1431991b6ca.jpg', 'HD2sz9RVzfM');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `idLocation` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `idMembre` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `dateLocation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`idLocation`, `idFilm`, `idMembre`, `quantite`, `dateLocation`) VALUES
(9, 5, 1, 1, '2019-04-13'),
(10, 9, 1, 3, '2019-04-13'),
(11, 16, 1, 5, '2019-04-13'),
(12, 13, 1, 2, '2019-04-13'),
(18, 5, 4, 10, '2019-04-15'),
(19, 6, 4, 10, '2019-04-15'),
(20, 7, 4, 10, '2019-04-15'),
(21, 8, 4, 10, '2019-04-15'),
(22, 9, 4, 10, '2019-04-15'),
(23, 10, 4, 10, '2019-04-15'),
(24, 11, 4, 10, '2019-04-15'),
(25, 12, 4, 10, '2019-04-15'),
(26, 13, 4, 10, '2019-04-15'),
(27, 14, 4, 10, '2019-04-15'),
(28, 15, 4, 10, '2019-04-15'),
(29, 16, 4, 10, '2019-04-15'),
(30, 17, 4, 10, '2019-04-15'),
(31, 18, 4, 10, '2019-04-15'),
(32, 19, 4, 10, '2019-04-15'),
(33, 20, 4, 10, '2019-04-15');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `idMembre` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `panier` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`idMembre`, `nom`, `prenom`, `dateNaissance`, `sexe`, `panier`) VALUES
(1, 'fian', 'benjamin', '1985-07-12', 'M', ''),
(2, 'min', 'ad', '2000-04-07', 'M', ''),
(4, 'test', 'test', '2019-04-11', 'M', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`email`),
  ADD KEY `idMembre` (`idMembre`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`idFilm`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`idLocation`),
  ADD KEY `location_ibfk_1` (`idFilm`),
  ADD KEY `location_ibfk_2` (`idMembre`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`idMembre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `idFilm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `idLocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_ibfk_1` FOREIGN KEY (`idMembre`) REFERENCES `membre` (`idMembre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
