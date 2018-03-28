-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              5.7.11 - MySQL Community Server (GPL)
-- S.O. server:                  Win64
-- HeidiSQL Versione:            9.4.0.5188
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database brah
DROP DATABASE IF EXISTS `brah`;
CREATE DATABASE IF NOT EXISTS `brah` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Sql677570_1`;

-- Dump della struttura di tabella brah.brah_accounts
DROP TABLE IF EXISTS `brah_accounts`;
CREATE TABLE IF NOT EXISTS `brah_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `sess_id` text,
  `potere` int(11) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella brah.brah_accounts: 1 rows
/*!40000 ALTER TABLE `brah_accounts` DISABLE KEYS */;
REPLACE INTO `brah_accounts` (`id`, `username`, `password`, `email`, `sess_id`, `potere`, `last_update`, `added`) VALUES
	(1, 'root', '17166193b35a231d8031c52931e06a70', 'frankie@hackweb.it', '22946', 0, '2017-12-03 19:55:46', '2017-12-02 17:41:52');
/*!40000 ALTER TABLE `brah_accounts` ENABLE KEYS */;

-- Dump della struttura di tabella brah.brah_posts
DROP TABLE IF EXISTS `brah_posts`;
CREATE TABLE IF NOT EXISTS `brah_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `image` text,
  `video_link` text,
  `description` text,
  `cat` int(11) DEFAULT '1',
  `id_user` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

-- Dump dei dati della tabella brah.brah_posts: 37 rows
/*!40000 ALTER TABLE `brah_posts` DISABLE KEYS */;
REPLACE INTO `brah_posts` (`id`, `title`, `subtitle`, `image`, `video_link`, `description`, `cat`, `id_user`, `added`, `order`) VALUES
	(123, 'YEAH', '- Watch -', NULL, 'https://www.youtube.com/watch?v=S3pv_NhdtKQ', 'faefea', 2, NULL, '2017-11-16 17:26:46', 14.1),
	(140, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4418-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 13),
	(141, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_7028-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 14),
	(142, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/camillo_2-705x564.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 15),
	(107, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=StCK-zEMGro', 'aa', 2, NULL, '2017-11-15 16:56:22', 22.1),
	(138, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/canale-lucine-705x881.jpg', NULL, 'aa', 1, NULL, '0000-00-00 00:00:00', 11),
	(143, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/donna_torii-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 16),
	(144, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/marta_velo-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 17),
	(145, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0370-705x470.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 18),
	(146, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/L1100990-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 19),
	(147, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/L3300011-copy-705x450.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 20),
	(116, 'Milan', '- Watch -', '', 'https://www.youtube.com/watch?v=gWrtnQMt4R0', 'aa', 2, NULL, '2017-11-15 16:56:22', 8.1),
	(148, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-5-705x705.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 21),
	(134, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/parfum-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 8),
	(135, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/3A71EF58-5F60-42E7-AED0-1811793E20C1-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 9),
	(136, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/occhio-705x882.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 10),
	(139, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/Foto-01-08-16-12-52-24-PM-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 12),
	(125, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_9434-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 6),
	(124, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/CAM5254-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 5),
	(120, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 3),
	(158, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=g75tgOV5iRQ', 'aa', 2, NULL, '2017-11-15 16:56:22', 0.66),
	(132, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0710-705x881.jpg', NULL, 'aa', 1, NULL, '0000-00-00 00:00:00', 7),
	(149, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2145-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 22),
	(150, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2012/09/Fluctus_Cover.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 23),
	(151, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2032-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 24),
	(152, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-705x1058.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 25),
	(153, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4984-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 26),
	(155, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_6539-705x705.jpeg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 27),
	(156, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4626-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 28),
	(157, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/beart-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 29),
	(1, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/Foto-13-09-16-705x881.jpeg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 99),
	(159, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-1-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 0.2),
	(160, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_1776-1-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 0.3),
	(161, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4208-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 0.1),
	(162, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_3207-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 0.6),
	(163, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-3-705x1058.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 0.7),
	(164, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_0401-705x855.jpg', NULL, 'aa', 1, NULL, '2017-11-15 16:56:22', 0.8);
/*!40000 ALTER TABLE `brah_posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
