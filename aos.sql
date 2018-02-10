-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Sam 10 Février 2018 à 15:58
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `aos`
--

-- --------------------------------------------------------

--
-- Structure de la table `date`
--

CREATE TABLE `date` (
  `date_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_link` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`img_id`, `img_link`, `id_user`) VALUES
(1, 'fichier', 1);

-- --------------------------------------------------------

--
-- Structure de la table `img_comments`
--

CREATE TABLE `img_comments` (
  `comimg_id` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `id_friend` int(11) NOT NULL,
  `comm` text NOT NULL,
  `id_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `label` enum('jpg','png','jpeg','bmp','gif','avi','mp4','mkv') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_nom` varchar(65) NOT NULL,
  `users_prenom` varchar(65) NOT NULL,
  `users_login` varchar(65) NOT NULL,
  `users_mdp` varchar(65) NOT NULL,
  `users_active` tinyint(1) NOT NULL DEFAULT '0',
  `users_role` enum('ADMIN','USER','','') NOT NULL,
  `users_mail` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`users_id`, `users_nom`, `users_prenom`, `users_login`, `users_mdp`, `users_active`, `users_role`, `users_mail`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMIN', 'ADMIN', 1, 'ADMIN', 'admin.admin@gmail.com'),
(2, 'USER', 'USER', 'USER', 'USER', 1, 'USER', 'user.user@hotmail.fr'),
(3, 'DOLAIS', 'Alizée', 'Soon', 'Soon', 1, 'ADMIN', ''),
(31, 'camara', 'magou', 'c', 'c', 1, 'USER', 'c@d.com'),
(32, 'mamma', 'halima', 'm', 'm', 1, 'USER', 'm@m.com');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `vid_id` int(11) NOT NULL,
  `vid_blob` blob NOT NULL,
  `vid_nom` varchar(65) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vid_comments`
--

CREATE TABLE `vid_comments` (
  `comvid_id` int(11) NOT NULL,
  `id_vid` int(11) NOT NULL,
  `id_friend` int(11) NOT NULL,
  `comm` text NOT NULL,
  `id_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`date_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `img_comments`
--
ALTER TABLE `img_comments`
  ADD PRIMARY KEY (`comimg_id`),
  ADD KEY `id_user` (`id_friend`),
  ADD KEY `id_img` (`id_img`),
  ADD KEY `id_date` (`id_date`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`vid_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `vid_comments`
--
ALTER TABLE `vid_comments`
  ADD PRIMARY KEY (`comvid_id`),
  ADD KEY `id_user` (`id_friend`),
  ADD KEY `id_vid` (`id_vid`),
  ADD KEY `id_date` (`id_date`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `date`
--
ALTER TABLE `date`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `img_comments`
--
ALTER TABLE `img_comments`
  MODIFY `comimg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `vid_comments`
--
ALTER TABLE `vid_comments`
  MODIFY `comvid_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `img_comments`
--
ALTER TABLE `img_comments`
  ADD CONSTRAINT `img_comments_ibfk_1` FOREIGN KEY (`id_friend`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `img_comments_ibfk_2` FOREIGN KEY (`id_img`) REFERENCES `images` (`img_id`),
  ADD CONSTRAINT `img_comments_ibfk_3` FOREIGN KEY (`id_date`) REFERENCES `date` (`date_id`);

--
-- Contraintes pour la table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `vid_comments`
--
ALTER TABLE `vid_comments`
  ADD CONSTRAINT `vid_comments_ibfk_1` FOREIGN KEY (`id_vid`) REFERENCES `videos` (`vid_id`),
  ADD CONSTRAINT `vid_comments_ibfk_2` FOREIGN KEY (`id_date`) REFERENCES `date` (`date_id`),
  ADD CONSTRAINT `vid_comments_ibfk_3` FOREIGN KEY (`id_friend`) REFERENCES `users` (`users_id`);
