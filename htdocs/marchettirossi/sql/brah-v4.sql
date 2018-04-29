-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 06, 2018 at 05:12 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brah`
--

-- --------------------------------------------------------

--
-- Table structure for table `brah_accounts`
--

DROP TABLE IF EXISTS `brah_accounts`;
CREATE TABLE IF NOT EXISTS `brah_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `sess_id` text,
  `potere` int(11) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_accounts`
--

INSERT INTO `brah_accounts` (`id`, `username`, `password`, `email`, `sess_id`, `potere`, `last_update`, `added`) VALUES
(1, 'root', '17166193b35a231d8031c52931e06a70', 'frankie@hackweb.it', '15693', 0, '2018-01-03 13:27:37', '2017-12-02 16:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `brah_posts`
--

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
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_posts`
--

INSERT INTO `brah_posts` (`id`, `title`, `subtitle`, `image`, `video_link`, `description`, `cat`, `id_user`, `added`, `order`, `status`) VALUES
(123, 'YEAH', '- Watch -', NULL, 'https://www.youtube.com/watch?v=S3pv_NhdtKQ', 'faefea', 2, NULL, '2017-11-16 16:26:46', 14.1, 0),
(140, 'Strada', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4418-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 13, 1),
(141, 'Bologna', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_7028-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 14, 1),
(142, 'Scarpe', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/camillo_2-705x564.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 15, 1),
(107, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=StCK-zEMGro', 'aa', 2, NULL, '2017-11-15 15:56:22', 22.1, 1),
(138, 'Rimini', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/canale-lucine-705x881.jpg', NULL, 'aa', 1, NULL, '2018-01-24 23:00:00', 11, 1),
(143, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/donna_torii-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 16, 1),
(144, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/marta_velo-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 17, 1),
(145, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0370-705x470.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 18, 1),
(146, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/L1100990-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 19, 1),
(147, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/L3300011-copy-705x450.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 20, 1),
(116, 'Milan', '- Watch -', '', 'https://www.youtube.com/watch?v=gWrtnQMt4R0', 'aa', 2, NULL, '2017-11-15 15:56:22', 8.1, 1),
(148, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-5-705x705.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 21, 1),
(134, 'Foglie Fighe', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/parfum-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 8, 1),
(135, 'Scale', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/3A71EF58-5F60-42E7-AED0-1811793E20C1-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 9, 1),
(136, 'Occhio', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/occhio-705x882.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 10, 1),
(139, 'Monte', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/Foto-01-08-16-12-52-24-PM-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 12, 1),
(125, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_9434-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 6, 1),
(124, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/CAM5254-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 5, 1),
(120, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 3, 1),
(158, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=g75tgOV5iRQ', 'aa', 2, NULL, '2017-11-15 15:56:22', 0.66, 1),
(132, 'Foglie', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0710-705x881.jpg', NULL, 'aa', 1, NULL, '2018-01-08 23:00:00', 7, 1),
(149, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2145-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 22, 1),
(150, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2012/09/Fluctus_Cover.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 23, 1),
(151, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2032-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 24, 1),
(152, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-705x1058.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 25, 1),
(153, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4984-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 26, 1),
(155, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_6539-705x705.jpeg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 27, 1),
(156, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4626-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 28, 1),
(157, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/beart-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 29, 1),
(1, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/Foto-13-09-16-705x881.jpeg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 99, 1),
(159, 'Cappuccio', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-1-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 0.2, 1),
(160, 'Nascondino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_1776-1-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 0.3, 1),
(161, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4208-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 0.1, 1),
(162, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_3207-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 0.6, 1),
(163, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-3-705x1058.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 0.7, 1),
(164, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_0401-705x855.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 0.8, 1),
(167, 'fae', 'fae', 'files/file_upload/img/favicon (1).png', NULL, NULL, 1, NULL, '2018-01-03 18:30:20', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brah_stories`
--

DROP TABLE IF EXISTS `brah_stories`;
CREATE TABLE IF NOT EXISTS `brah_stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `tags` text NOT NULL,
  `category` int(11) NOT NULL,
  `content` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `ord` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
