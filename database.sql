-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 13 mai 2022 à 08:39
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `share_tools`
--

-- --------------------------------------------------------
-- Creation de la base de données

DROP DATABASE IF EXISTS share_tools;
CREATE DATABASE share_tools;
USE share_tools;

--
-- Structure de la table `pot`
--

CREATE TABLE `pot` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  `tool_booking_start` date NOT NULL,
  `tool_booking_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tool`
--

CREATE TABLE `tool` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tool`
--

INSERT INTO `tool` (`id`, `name`, `image`) VALUES
(1, 'Marteau', 'https://cdn.chausson.fr/catalog-image/e262b6fe-f792-4dab-aacc-13d2c7dc097c/400-400/masse-angle-abattue.png'),
(2, 'Pistolet laser', 'https://m.media-amazon.com/images/I/61I7fSUSSrS._SL1500_.jpg'),
(3, 'Nimbus 2001', 'https://addict-boe.com/6307-thickbox_default/replique-1-1-balai-magique-nimbus-2000-edition-limitee-numerotee.jpg'),
(4, 'Snowboard', 'https://www.splitboardshop.fr/media/cache/product_slider/products/1476/54008ADB0A2175A48441BED55304D41844DF838E5A35DBE7E2194A237F115827.jpg'),
(5, 'Couscoussier', 'https://resize.ovh/o/1bd7b730-4c2e-11ea-aae7-a3c70233f1bc'),
(6, 'Télémètre laser', 'https://m.media-amazon.com/images/I/819viI-zgOL._AC_SL1500_.jpg');


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`) VALUES
(1, 'Bob', 'Léponge'),
(2, 'Ranma', 'Demi'),
(3, 'Dark', 'Vador'),
(4, 'Sailor', 'Moon');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `wishlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `vote` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id`, `name`, `price`, `image`, `website`, `vote`) VALUES
(1, 'Sabre laser', 280, 'https://static.lacitedesnuages.be/153097-large_default/star-wars-episode-ix-black-series-replique-11-sabre-laser-force-fx-elite-leia-organa.webp', 'https://www.micromania.fr/replique-black-series-star-wars-sabre-laser-leia-force-fx-elite-116646.html', 1),
(2, 'Appareil à raclette', 48, 'https://www.backmarket.fr/cdn-cgi/image/format=auto,quality=75,width=3840/https://d1eh9yux7w8iql.cloudfront.net/product_images/1575526783.81.jpg', 'https://www.backmarket.fr/grill-raclette-oneconcept-woklette-pas-cher/309945.html#l=10', 1),
(3, 'Appareil à fondue', 50, 'https://www.papillesetpupilles.fr/wp-content/uploads/2019/07/Fondue-savoyarde-%C2%A9margouillat-photo-shutterstock.jpg', 'https://www.backmarket.fr/appareil-a-fondue-tefal-ef351412-pas-cher/261725.html?shopping=gmc&gclid=Cj0KCQjw4PKTBhD8ARIsAHChzRIYk0yOuA-rpWiTjjcPBtK3pFgKkhR3OdfIJRx-NHK_TZN24d2FD9oaAsiOEALw_wcB#?l=12', 1),
(4, 'Glacière électrique', 55, 'https://www.backmarket.fr/cdn-cgi/image/format=auto,quality=75,width=3840/https://d1eh9yux7w8iql.cloudfront.net/product_images/1524819912.57.jpg', 'https://www.backmarket.fr/severin-kb2922-glaciere-electrique-20l-cool-box-pas-cher/12302.html#l=10', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pot`
--
ALTER TABLE `pot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_user_id` (`user_id`),
  ADD KEY `reservation_tool_id` (`tool_id`);

--
-- Index pour la table `tool`
--
ALTER TABLE `tool`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vote_user` (`user_id`),
  ADD KEY `fk_vote_wishlist` (`wishlist_id`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pot`
--
ALTER TABLE `pot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tool`
--
ALTER TABLE `tool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_tool_id` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`id`),
  ADD CONSTRAINT `reservation_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `fk_vote_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_vote_wishlist` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`id`);
COMMIT;

--
-- Insert pot
--
INSERT INTO `pot` (`amount`) VALUES
('300');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
