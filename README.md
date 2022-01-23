# MyWhishList_Loiseau_Jarosz_Schloesser

base de donnée local :

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- HÃ´te : 127.0.0.1
-- GÃ©nÃ©rÃ© le : sam. 22 jan. 2022 Ã  21:27
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de donnÃ©es : `wish`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `descr` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `tarif` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- DÃ©chargement des donnÃ©es de la table `item`
--

INSERT INTO `item` (`id`, `liste_id`, `nom`, `descr`, `img`, `url`, `tarif`) VALUES
(1, 2, 'Champagne', 'Bouteille de champagne + flutes + jeux Ã  gratter', 'champagne.jpg', '', '20.00'),
(2, 2, 'Musique', 'Partitions de piano Ã  4 mains', 'musique.jpg', '', '25.00'),
(3, 2, 'Exposition', 'Visite guidÃ©e de lâ€™exposition â€˜REGARDERâ€™ Ã  la galerie Poirel', 'poirelregarder.jpg', '', '14.00'),
(4, 3, 'GoÃ»ter', 'GoÃ»ter au FIFNL', 'gouter.jpg', '', '20.00'),
(5, 3, 'Projection', 'Projection courts-mÃ©trages au FIFNL', 'film.jpg', '', '10.00'),
(6, 2, 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', 'rose.jpg', '', '16.00'),
(7, 2, 'Diner Stanislas', 'Diner Ã  La Table du Bon Roi Stanislas (ApÃ©ritif /EntrÃ©e / Plat / Vin / Dessert / CafÃ© / Digestif)', 'bonroi.jpg', '', '60.00'),
(8, 3, 'Origami', 'Baguettes magiques en Origami en buvant un thÃ©', 'origami.jpg', '', '12.00'),
(9, 3, 'Livres', 'Livre bricolage avec petits-enfants + Roman', 'bricolage.jpg', '', '24.00'),
(10, 2, 'Diner  Grand Rue ', 'Diner au Grandâ€™Ru(e) (ApÃ©ritif / EntrÃ©e / Plat / Vin / Dessert / CafÃ©)', 'grandrue.jpg', '', '59.00'),
(11, 0, 'Visite guidÃ©e', 'Visite guidÃ©e personnalisÃ©e de Saint-Epvre jusquâ€™Ã  Stanislas', 'place.jpg', '', '11.00'),
(12, 2, 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait aprÃ¨s-soleil', 'bijoux.jpg', '', '29.00'),
(19, 0, 'Jeu contacts', 'Jeu pour Ã©change de contacts', 'contact.png', '', '5.00'),
(22, 0, 'Concert', 'Un concert Ã  Nancy', 'concert.jpg', '', '17.00'),
(23, 1, 'Appart Hotel', 'Appartâ€™hÃ´tel Coeur de Ville, en plein centre-ville', 'apparthotel.jpg', '', '56.00'),
(24, 2, 'HÃ´tel d\'Haussonville', 'HÃ´tel d\'Haussonville, au coeur de la Vieille ville Ã  deux pas de la place Stanislas', 'hotel_haussonville_logo.jpg', '', '169.00'),
(25, 1, 'Boite de nuit', 'DiscothÃ¨que, BoÃ®te tendance avec des soirÃ©es Ã  thÃ¨me & DJ invitÃ©s', 'boitedenuit.jpg', '', '32.00'),
(26, 1, 'PlanÃ¨tes Laser', 'Laser game : Gilet Ã©lectronique et pistolet laser comme matÃ©riel, vous voilÃ  Ã©quipÃ©.', 'laser.jpg', '', '15.00'),
(27, 1, 'Fort Aventure', 'DÃ©couvrez Fort Aventure Ã  Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut Ã  l\'Ã©lastique inversÃ©, Toboggan gÃ©ant... et bien plus encore.', 'fort.jpg', '', '25.00'),
(28, 4, 'Quad', 'Rend mon quad', 'Quad.png', '', '150.00');

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentaire` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `liste`
--

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `token`, `commentaire`) VALUES
(1, 1, 'Pour fÃªter le bac !', 'Pour un week-end Ã  Nancy qui nous fera oublier les Ã©preuves. ', '2018-06-27', 'nosecure1', NULL),
(2, 2, 'Liste de mariage d\'Alice et Bob', 'Nous souhaitons passer un week-end royal Ã  Nancy pour notre lune de miel :)', '2018-06-30', 'nosecure2', NULL),
(3, 3, 'C\'est l\'anniversaire de Charlie', 'Pour lui prÃ©parer une fÃªte dont il se souviendra :)', '2017-12-12', 'nosecure3', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idreservation` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `nom` text DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `iditem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- DÃ©chargement des donnÃ©es de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `userid`, `nom`, `commentaire`, `iditem`) VALUES
(1, 1, 'Michel', 'Cest rÃ©servÃ©', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation2`
--

CREATE TABLE `reservation2` (
  `userid` int(11) DEFAULT NULL,
  `nom` text DEFAULT NULL,
  `commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `roleid` int(11) NOT NULL,
  `label` varchar(256) DEFAULT NULL,
  `authlevel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `passwd` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- DÃ©chargement des donnÃ©es de la table `users`
--

INSERT INTO `users` (`uid`, `username`, `passwd`) VALUES
(1, 'Admin', '204b5003e97662ca4258ab593ec0360b'),
(83, 'Adrien', 'dcb46cd20f18a528f7181579d5c8aab6');

--
-- Index pour les tables dÃ©chargÃ©es
--

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`no`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD UNIQUE KEY `idreservation` (`idreservation`),
  ADD KEY `userid` (`userid`),
  ADD KEY `iditem` (`iditem`);

--
-- Index pour la table `reservation2`
--
ALTER TABLE `reservation2`
  ADD KEY `userid` (`userid`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT pour les tables dÃ©chargÃ©es
--

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idreservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Contraintes pour les tables dÃ©chargÃ©es
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`iditem`) REFERENCES `item` (`id`);

--
-- Contraintes pour la table `reservation2`
--
ALTER TABLE `reservation2`
  ADD CONSTRAINT `reservation2_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
