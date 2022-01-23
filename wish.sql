-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 23 jan. 2022 à 20:13
-- Version du serveur : 5.5.68-MariaDB
-- Version de PHP : 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wish`
--

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `descr` text,
  `img` text,
  `url` text,
  `tarif` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `liste_id`, `nom`, `descr`, `img`, `url`, `tarif`) VALUES
(1, 2, 'Champagne', 'Bouteille de champagne + flutes + jeux à gratter', 'champagne.jpg', '', '20.00'),
(2, 2, 'Musique', 'Partitions de piano à 4 mains', 'musique.jpg', '', '25.00'),
(3, 2, 'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', 'poirelregarder.jpg', '', '14.00'),
(4, 3, 'Goûter', 'Goûter au FIFNL', 'gouter.jpg', '', '20.00'),
(5, 3, 'Projection', 'Projection courts-métrages au FIFNL', 'film.jpg', '', '10.00'),
(6, 2, 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', 'rose.jpg', '', '16.00'),
(7, 2, 'Diner Stanislas', 'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)', 'bonroi.jpg', '', '60.00'),
(8, 3, 'Origami', 'Baguettes magiques en Origami en buvant un thé', 'origami.jpg', '', '12.00'),
(9, 3, 'Livres', 'Livre bricolage avec petits-enfants + Roman', 'bricolage.jpg', '', '24.00'),
(10, 2, 'Diner  Grand Rue ', 'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', 'grandrue.jpg', '', '59.00'),
(11, 0, 'Visite guidée', 'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', 'place.jpg', '', '11.00'),
(12, 2, 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil', 'bijoux.jpg', '', '29.00'),
(19, 0, 'Jeu contacts', 'Jeu pour échange de contacts', 'contact.png', '', '5.00'),
(22, 0, 'Concert', 'Un concert à Nancy', 'concert.jpg', '', '17.00'),
(23, 1, 'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', 'apparthotel.jpg', '', '56.00'),
(24, 2, 'Hôtel d\'Haussonville', 'Hôtel d\'Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', 'hotel_haussonville_logo.jpg', '', '169.00'),
(25, 1, 'Boite de nuit', 'Discothèque, Boîte tendance avec des soirées à thème & DJ invités', 'boitedenuit.jpg', '', '32.00'),
(26, 1, 'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', 'laser.jpg', '', '15.00'),
(27, 1, 'Fort Aventure', 'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l\'élastique inversé, Toboggan géant... et bien plus encore.', 'fort.jpg', '', '25.00'),
(28, 4, 'Quad', 'Rend mon quad', 'Quad.png', '', '150.00'),
(29, 5, 'a', 'b', 'https://www.nautiljon.com/images/jeuxvideo_persos/00/01/ganyu_5010.jpg', 'https://www.actugaming.net/guide-ganyu-genshin-impact-390476/', '12.00'),
(30, 4, 'Quad', 'Rend mon quad', 'Quad.png', '', '150.00'),
(31, 8, 'item 1', '1er item de la liste', '', '', '3.50'),
(32, 6, 'Quad', 'Rend mon quad', 'Quad.png', '', '150.00'),
(33, 12, 'itemTest', 'a', '', '', '0.00'),
(34, 13, 'Un item', 'Une description', '', '', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `expiration` date DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentaire` varchar(240) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publique` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `token`, `commentaire`, `publique`) VALUES
(1, 1, 'Pour fêter le bac !', 'Pour un week-end à Nancy qui nous fera oublier les épreuves. ', '2018-06-27', 'nosecure1', NULL, 1),
(2, 2, 'Liste de mariage d\'Alice et Bob', 'Nous souhaitons passer un week-end royal à Nancy pour notre lune de miel :)', '2018-06-30', 'nosecure2', NULL, 1),
(3, 3, 'C\'est l\'anniversaire de Charlie', 'Pour lui préparer une fête dont il se souviendra :)', '2017-12-12', 'nosecure3', NULL, 1),
(6, 83, 'UneListe', 'UneDescription', '2022-01-23', 'a0e4f0e09cf01772', NULL, 0),
(7, 90, 'listelea2', 'jesuisuneliste', '2022-01-28', 'a6af3fb5f002c9fe', NULL, 0),
(8, 91, 'liste test', 'je suis une liste de l\'utilisateur test', '2022-03-26', 'ff3ec919a34add19', NULL, 0),
(9, 91, 'liste test publique', 'je suis une liste publique de test', '2022-04-21', 'd234e888195052fc', NULL, 1),
(11, 83, 'UneDeuxiemeListe', 'C\'est un test tmtc', '2022-01-23', '1d7c9b3a50b07462', NULL, 0),
(12, 90, 'testListe', 'je suis le test de la liste ', '2022-01-26', '5e521640f612c533', NULL, 0),
(13, 91, 'TestListeExpirer', 'Une Liste esxpirer', '2022-01-21', 'b198cb24580a4232', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idreservation` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `nom` text,
  `commentaire` text,
  `iditem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `userid`, `nom`, `commentaire`, `iditem`) VALUES
(1, 1, 'Michel', 'Cest réservé', 1),
(2, 91, 'test', 'je réserve l\'item', 23),
(3, 83, 'Adrien', 'wesh', 32),
(4, 90, 'dz', 'qdzff', 33),
(5, 90, 'Paul', 'Joyeux anniversaire !', 25),
(6, 91, 'Adrien', 'Cette item est reserver', 34);

-- --------------------------------------------------------

--
-- Structure de la table `reservation2`
--

CREATE TABLE `reservation2` (
  `userid` int(11) DEFAULT NULL,
  `nom` text,
  `commentaire` text
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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`uid`, `username`, `passwd`) VALUES
(1, 'Admin', '204b5003e97662ca4258ab593ec0360b'),
(83, 'Adrien', 'dcb46cd20f18a528f7181579d5c8aab6'),
(84, 'schloess5u', 'dcb46cd20f18a528f7181579d5c8aab6'),
(85, 'TestAcc', 'dcb46cd20f18a528f7181579d5c8aab6'),
(88, 'TestAcc2', 'dcb46cd20f18a528f7181579d5c8aab6'),
(89, 'juwu', '7682fe272099ea26efe39c890b33675b'),
(90, 'lea2', '7682fe272099ea26efe39c890b33675b'),
(91, 'test', 'f1cf3e36753081de676611e34731088f');

--
-- Index pour les tables déchargées
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
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
