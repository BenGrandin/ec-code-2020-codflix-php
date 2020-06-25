-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 25 juin 2020 à 18:21
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `codflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `season_number` int(2) NOT NULL,
  `episode_number` int(3) NOT NULL,
  `title` varchar(250) NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(250) NOT NULL,
  `still_path` varchar(250) NOT NULL,
  `type` varchar(20) NOT NULL,
  `release_date` date DEFAULT NULL,
  `duration` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `show_id`, `season_number`, `episode_number`, `title`, `summary`, `trailer_url`, `still_path`, `type`, `release_date`, `duration`) VALUES
(10, 2, 1, 1, 'Winter Is Coming', 'Jon Arryn, the Hand of the King, is dead. King Robert Baratheon plans to ask his oldest friend, Eddard Stark, to take Jon\'s place. Across the sea, Viserys Targaryen plans to wed his sister to a nomadic warlord in exchange for an army.', 'https://www.youtube.com/embed/gcTkNV5Vg1E&feature=youtu.be', 'qqq', 'tvshow', '2010-06-08', '005400');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT '0' COMMENT 'in seconds'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `user_id`, `media_id`, `start_date`, `finish_date`, `watch_duration`) VALUES
(1, 39, 1, '2020-06-25 17:41:25', NULL, 0),
(2, 39, 3, '2020-06-25 17:41:25', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL,
  `duration` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `gender_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`, `duration`) VALUES
(1, 3, 'Artemis Fowl', 'movie', 'Released', '2020-06-12', 'Descendant d’une longue lignée de criminels, le jeune et richissime Artemis Fowl – 12 ans et déjà doté d’une intelligence hors du commun – s’apprête à livrer un éprouvant combat contre le Peuple des Fées, des créatures puissantes et mystérieuses qui vivent dans un monde souterrain et qui pourraient bien être à l’origine de la disparition de son père 2 ans plus tôt. Pour mener sa lutte à bien, il devra faire appel à toute sa force et à son ingéniosité diabolique, quitte à prendre en otage le capitaine Holly Short - une elfe réputée pour sa bravoure - et l’échanger contre une rançon en or. Pour le nain gaffeur et kleptomane Mulch Diggums – qui va tout tenter pour venir en aide à Holly – et la commandante Root, chef du F.A.R.F.A.DET (Forces Armées de Régulation et Fées Aériennes de DETection, le département de reconnaissance de la police des fées), la partie s’annonce plus que serrée…', 'https://www.youtube.com/embed/fl2r3Fwxz_o', '013023'),
(2, 1, 'Game of Thrones', 'tvshow', 'Returning Series', '2011-04-17', 'Seven noble families fight for control of the mythical land of Westeros. Friction between the houses leads to full-scale war. All while a very ancient evil awakens in the farthest north. Amidst the war, a neglected military order of misfits, the Night\'s Watch, is all that stands between the realms of men and icy horrors beyond.', 'https://www.youtube.com/embed/gcTkNV5Vg1E', '323022'),
(3, 1, 'Les indestrucibles', 'movie', 'Released', '2004-05-11', 'Bob Parr has given up his superhero days to log in time as an insurance adjuster and raise his three children with his formerly heroic wife in suburbia. But when he receives a mysterious assignment, it\'s time to get back into costume.', 'https://www.youtube.com/embed/SOKY7XyOHTA', '015500'),
(4, 1, 'Les Misérables ', 'movie', 'Released', '1982-10-20', 'The story of Jean Valjean, a Frenchman convicted of minor crimes, who is hounded for years by an unforgiving and unrelenting police inspector, Javert.', 'https://www.youtube.com/embed/JTPTVX8TGLk', '034000');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  `keyEmail` varchar(32) DEFAULT NULL,
  `emailVerified` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `keyEmail`, `emailVerified`) VALUES
(1, 'coding@gmail.com', '123456', '', NULL),
(3, 'bengrandin88@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '', NULL),
(39, 'bengrandin@hotmail.com', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', 'fa82edd716006174b74f13d2bf262355', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tv_show_episodes_media_type_fk_media_id` (`type`),
  ADD KEY `FK_tvShowEpisodes_media_showId` (`show_id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_user_id_fk_media_id` (`user_id`),
  ADD KEY `history_media_id_fk_media_id` (`media_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_genre_id_fk_genre_id` (`gender_id`) USING BTREE,
  ADD KEY `media_type_fk_type` (`type`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `FK_tvShowEpisodes_media_showId` FOREIGN KEY (`show_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`gender_id`) REFERENCES `genre` (`id`);
