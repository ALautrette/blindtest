-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table blindtest. games
CREATE TABLE IF NOT EXISTS `games` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` datetime NOT NULL,
    `playlist_id` int(11) NOT NULL DEFAULT '0',
    `user_id` int(11) NOT NULL,
    `step` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `games.playlist_id` (`playlist_id`),
    KEY `games.user_id` (`user_id`),
    CONSTRAINT `games.playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `games.user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.games : ~2 rows (environ)
DELETE FROM `games`;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
/*!40000 ALTER TABLE `games` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. game_user
CREATE TABLE IF NOT EXISTS `game_user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `game_id` int(11) NOT NULL DEFAULT '0',
    `user_id` int(11) NOT NULL DEFAULT '0',
    `score` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `game_user.game_id` (`game_id`),
    KEY `game_user.user_id` (`user_id`),
    CONSTRAINT `game_user.game_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `game_user.user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.game_user : ~0 rows (environ)
DELETE FROM `game_user`;
/*!40000 ALTER TABLE `game_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_user` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. musics
CREATE TABLE IF NOT EXISTS `musics` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `url` varchar(50) NOT NULL,
    `title` varchar(50) NOT NULL,
    `artist` varchar(50) NOT NULL,
    `timecode` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `U_Music` (`url`,`timecode`)
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.musics : ~1 rows (environ)
DELETE FROM `musics`;
/*!40000 ALTER TABLE `musics` DISABLE KEYS */;
INSERT INTO `musics` (`id`, `url`, `title`, `artist`, `timecode`) VALUES
                                                                      (3, 'https://www.youtube.com/watch?v=O3yry4-S2HM', '915', 'MXfive', 40),
                                                                      (4, 'https://www.youtube.com/watch?v=kffacxfA7G4', 'Baby', 'Justin Bieber', 0),
                                                                      (5, 'https://www.youtube.com/watch?v=l482T0yNkeo', 'Highway To Hell', 'AC/DC', 0);
/*!40000 ALTER TABLE `musics` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. music_playlist
CREATE TABLE IF NOT EXISTS `music_playlist` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `music_id` int(11) NOT NULL DEFAULT '0',
    `playlist_id` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `music_playlist.music_id` (`music_id`),
    KEY `music_playlist.playlist_id` (`playlist_id`),
    CONSTRAINT `music_playlist.music_id` FOREIGN KEY (`music_id`) REFERENCES `musics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `music_playlist.playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.music_playlist : ~0 rows (environ)
DELETE FROM `music_playlist`;
/*!40000 ALTER TABLE `music_playlist` DISABLE KEYS */;
INSERT INTO `music_playlist` (`id`, `music_id`, `playlist_id`) VALUES
                                                                   (9, 4, 3),
                                                                   (10, 5, 3),
                                                                   (12, 3, 3);
/*!40000 ALTER TABLE `music_playlist` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. playlists
CREATE TABLE IF NOT EXISTS `playlists` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `is_public` tinyint(4) NOT NULL DEFAULT '0',
    `user_id` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `playlists.user_id` (`user_id`),
    CONSTRAINT `playlists.user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.playlists : ~0 rows (environ)
DELETE FROM `playlists`;
/*!40000 ALTER TABLE `playlists` DISABLE KEYS */;
INSERT INTO `playlists` (`id`, `name`, `is_public`, `user_id`) VALUES
    (3, 'Trop cool', 0, 44);
/*!40000 ALTER TABLE `playlists` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. playlist_tag
CREATE TABLE IF NOT EXISTS `playlist_tag` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `playlist_id` int(11) NOT NULL DEFAULT '0',
    `tag_id` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `playlist_tag.playlist_id` (`playlist_id`),
    KEY `playlist_tag.tag_id` (`tag_id`),
    CONSTRAINT `playlist_tag.playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `playlist_tag.tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.playlist_tag : ~0 rows (environ)
DELETE FROM `playlist_tag`;
/*!40000 ALTER TABLE `playlist_tag` DISABLE KEYS */;
INSERT INTO `playlist_tag` (`id`, `playlist_id`, `tag_id`) VALUES
    (8, 3, 3);
/*!40000 ALTER TABLE `playlist_tag` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. tags
CREATE TABLE IF NOT EXISTS `tags` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.tags : ~2 rows (environ)
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `name`) VALUES
    (3, 'Divers');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. users
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(50) NOT NULL,
    `is_admin` tinyint(4) DEFAULT '0',
    `reset_token` varchar(256) DEFAULT NULL,
    `token_expiry` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `reset_token` (`reset_token`)
    ) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.users : ~5 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `reset_token`, `token_expiry`) VALUES
                                                                                                           (42, 'admin', 'admin@test.fr', 'sa3tHJ3/KuYvI', 1, NULL, NULL),
                                                                                                           (43, 'robinator', 'robinator@test.fr', 'sa3tHJ3/KuYvI', 0, NULL, NULL),
                                                                                                           (44, 'gdc27', 'gdc27@test.fr', 'sa3tHJ3/KuYvI', 0, NULL, NULL),
                                                                                                           (45, 'htmldev', 'htmldev@test.fr', 'sa3tHJ3/KuYvI', 0, NULL, NULL),
                                                                                                           (46, 'mrbacquet', 'mrbacquet@test.fr', 'sa3tHJ3/KuYvI', 0, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table blindtest. user_user
CREATE TABLE IF NOT EXISTS `user_user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_user_id` int(11) NOT NULL DEFAULT '0',
    `second_user_id` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `user_user.first_user_id` (`first_user_id`),
    KEY `user_user.second_user_id` (`second_user_id`),
    CONSTRAINT `user_user.first_user_id` FOREIGN KEY (`first_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `user_user.second_user_id` FOREIGN KEY (`second_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table blindtest.user_user : ~0 rows (environ)
DELETE FROM `user_user`;
/*!40000 ALTER TABLE `user_user` DISABLE KEYS */;
INSERT INTO `user_user` (`id`, `first_user_id`, `second_user_id`) VALUES
                                                                      (1, 43, 44),
                                                                      (2, 43, 45);
/*!40000 ALTER TABLE `user_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
