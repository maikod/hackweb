-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: 62.149.150.193
-- Generato il: Nov 23, 2017 alle 13:20
-- Versione del server: 5.5.57
-- Versione PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Sql677570_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `cat` int(11) NOT NULL,
  `title` text,
  `subtitle` text,
  `description` text,
  `image` text,
  `video_link` text,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `cat`, `title`, `subtitle`, `description`, `image`, `video_link`, `added`, `order`) VALUES
(120, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 15:56:22', 3),
(124, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2017/03/CAM5254-705x881.jpg', NULL, '2017-11-15 15:56:22', 5),
(125, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_9434-705x881.jpg', NULL, '2017-11-15 15:56:22', 6),
(139, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/Foto-01-08-16-12-52-24-PM-705x881.jpg', NULL, '2017-11-15 15:56:22', 12),
(136, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/occhio-705x882.jpg', NULL, '2017-11-15 15:56:22', 10),
(135, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2017/03/3A71EF58-5F60-42E7-AED0-1811793E20C1-705x881.jpg', NULL, '2017-11-15 15:56:22', 9),
(134, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/parfum-705x886.jpg', NULL, '2017-11-15 15:56:22', 8),
(116, NULL, 2, 'Milan', '- Watch -', 'aa', '', 'https://www.youtube.com/watch?v=gWrtnQMt4R0', '2017-11-15 15:56:22', 8.1),
(148, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-5-705x705.jpg', NULL, '2017-11-15 15:56:22', 21),
(147, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/L3300011-copy-705x450.jpg', NULL, '2017-11-15 15:56:22', 20),
(146, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/L1100990-705x881.jpg', NULL, '2017-11-15 15:56:22', 19),
(145, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0370-705x470.jpg', NULL, '2017-11-15 15:56:22', 18),
(144, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/06/marta_velo-705x886.jpg', NULL, '2017-11-15 15:56:22', 17),
(143, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/donna_torii-705x881.jpg', NULL, '2017-11-15 15:56:22', 16),
(138, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/canale-lucine-705x881.jpg', NULL, '0000-00-00 00:00:00', 11),
(107, NULL, 2, 'Trentino', '- View -', 'aa', '', 'https://www.youtube.com/watch?v=StCK-zEMGro', '2017-11-15 15:56:22', 22.1),
(142, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2017/03/camillo_2-705x564.jpg', NULL, '2017-11-15 15:56:22', 15),
(141, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_7028-705x881.jpg', NULL, '2017-11-15 15:56:22', 14),
(140, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4418-705x881.jpg', NULL, '2017-11-15 15:56:22', 13),
(123, NULL, 2, 'YEAH', '- Watch -', 'faefea', NULL, 'https://www.youtube.com/watch?v=S3pv_NhdtKQ', '2017-11-16 16:26:46', 14.1),
(158, NULL, 2, 'Trentino', '- View -', 'aa', '', 'https://www.youtube.com/watch?v=g75tgOV5iRQ', '2017-11-15 15:56:22', 0.66),
(132, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0710-705x881.jpg', NULL, '0000-00-00 00:00:00', 7),
(149, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2145-705x881.jpg', NULL, '2017-11-15 15:56:22', 22),
(150, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2012/09/Fluctus_Cover.jpg', NULL, '2017-11-15 15:56:22', 23),
(151, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2032-705x886.jpg', NULL, '2017-11-15 15:56:22', 24),
(152, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-705x1058.jpg', NULL, '2017-11-15 15:56:22', 25),
(153, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4984-705x881.jpg', NULL, '2017-11-15 15:56:22', 26),
(155, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_6539-705x705.jpeg', NULL, '2017-11-15 15:56:22', 27),
(156, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4626-705x881.jpg', NULL, '2017-11-15 15:56:22', 28),
(157, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/beart-705x886.jpg', NULL, '2017-11-15 15:56:22', 29),
(1, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/06/Foto-13-09-16-705x881.jpeg', NULL, '2017-11-15 15:56:22', 99),
(159, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-1-705x886.jpg', NULL, '2017-11-15 15:56:22', 0.2),
(160, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_1776-1-705x881.jpg', NULL, '2017-11-15 15:56:22', 0.3),
(161, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4208-705x886.jpg', NULL, '2017-11-15 15:56:22', 0.1),
(162, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_3207-705x881.jpg', NULL, '2017-11-15 15:56:22', 0.6),
(163, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-3-705x1058.jpg', NULL, '2017-11-15 15:56:22', 0.7),
(164, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_0401-705x855.jpg', NULL, '2017-11-15 15:56:22', 0.8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
