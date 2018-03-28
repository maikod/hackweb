-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              5.7.9 - MySQL Community Server (GPL)
-- S.O. server:                  Win64
-- HeidiSQL Versione:            9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dump dei dati della tabella brah.posts: 22 rows
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `id_user`, `cat`, `title`, `subtitle`, `description`, `image`, `video_link`, `added`) VALUES
	(120, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(121, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(122, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(118, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(119, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(117, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(115, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(116, NULL, 2, 'Milan', '- Watch -', 'aa', '', 'https://www.youtube.com/watch?v=gWrtnQMt4R0', '2017-11-15 16:56:22'),
	(114, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(112, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(113, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(111, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(109, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(110, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(106, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/L3300011-copy-705x450.jpg', NULL, '2017-11-15 16:56:22'),
	(107, NULL, 2, 'Trentino', '- View -', 'aa', '', 'https://www.youtube.com/watch?v=StCK-zEMGro', '2017-11-15 16:56:22'),
	(105, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(103, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(101, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22'),
	(123, NULL, 2, 'YEAH', '- Watch -', 'faefea', NULL, 'https://www.youtube.com/watch?v=S3pv_NhdtKQ', '2017-11-16 17:26:46'),
	(102, NULL, 2, 'Trentino', '- View -', 'aa', '', 'https://www.youtube.com/watch?v=g75tgOV5iRQ', '2017-11-15 16:56:22'),
	(58, NULL, 1, 'Trentino', '- View -', 'aa', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, '2017-11-15 16:56:22');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
