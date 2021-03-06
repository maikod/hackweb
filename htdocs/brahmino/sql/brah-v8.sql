-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2018 at 06:01 PM
-- Server version: 5.7.20
-- PHP Version: 7.1.7

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

CREATE TABLE `brah_accounts` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `sess_id` text,
  `potere` int(11) NOT NULL DEFAULT '0',
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_accounts`
--

INSERT INTO `brah_accounts` (`id`, `username`, `password`, `email`, `sess_id`, `potere`, `last_update`, `added`) VALUES
(1, 'root', '17166193b35a231d8031c52931e06a70', 'frankie@hackweb.it', '354254890', 0, '2018-01-17 13:46:59', '2017-12-02 17:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `brah_posts`
--

CREATE TABLE `brah_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `subtitle` varchar(50) DEFAULT NULL,
  `image` text,
  `video_link` text,
  `description` text,
  `cat` int(11) DEFAULT '1',
  `id_user` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` float DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_posts`
--

INSERT INTO `brah_posts` (`id`, `title`, `subtitle`, `image`, `video_link`, `description`, `cat`, `id_user`, `added`, `order`, `status`) VALUES
(123, 'YEAH', '- Watch -', NULL, 'https://www.youtube.com/watch?v=S3pv_NhdtKQ', 'faefea', 2, NULL, '2017-11-16 16:26:46', 14.1, 0),
(140, 'Strada', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4418-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 13, 1),
(141, 'Bologna', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_7028-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 14, 1),
(142, 'Scarpe', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/camillo_2-705x564.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', 15, 1),
(107, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=StCK-zEMGro', 'aa', 2, NULL, '2017-11-15 15:56:22', 22.1, 1),
(138, 'Rimini', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/canale-lucine-705x881.jpg', NULL, 'aa', 1, NULL, '2018-01-24 23:00:00', 11, 0),
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

CREATE TABLE `brah_stories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `cat` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `gallery` text,
  `id_user` int(11) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `ord` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_stories`
--

INSERT INTO `brah_stories` (`id`, `title`, `img`, `tags`, `cat`, `content`, `gallery`, `id_user`, `added`, `status`, `ord`) VALUES
(1, 'Gino', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, '<div id=\"post-2012\" class=\"post-2012 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-adamas tag-backstage tag-blue tag-greece tag-manfrotto tag-milos tag-sarakiniko tag-white\">\r\n\r\n	<div class=\"post_wrapper\">\r\n	    \r\n	    <div class=\"post_content_wrapper\">\r\n	    \r\n	    			    \r\n		    				    <div class=\"post_header\">\r\n				    \r\n				    <div class=\"like-button\" style=\"float: right; clear: both; text-align: right; width = 100%;\">\r\n<p style=\"text-align: center;\"><strong>Why M&#236;los.</strong><br>\r\nTraveling. One of the fun parts of my job expecially in low season, when most of the restaurants&nbsp;are close and locals are happy to talk with someone unexpected like.</p>\r\n<p><img class=\"aligncenter size-full wp-image-2061\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/524A6592.jpg\" alt=\"brahmino_backstage_milos_manfrotto_6\" width=\"1613\" ></p>\r\n<p style=\"text-align: center;\">When I&#8217;ve been in Cassola &#8211; Vicenza, for a meeting at Manfrotto&nbsp;HQ, I imagined to plan a trip in Greece to test and use their tripod &#8216;<em>BeFree Advanced</em>&#8221; but not in mainstream islands as Santorini or Mykonos but where I&#8217;d find isolated villages with as less people as possible.</p>\r\n<p style=\"text-align: center;\">Mandrakia, fishermen&#8217;s village,&nbsp;I counted 2 groups of cats 8 each and two humans.<br>\r\n&#8595;</p>\r\n<p style=\"text-align: center;\"><img class=\"aligncenter size-full wp-image-2122\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/brahmino_manfrotto_3.jpg\" alt=\"brahmino_manfrotto_3\" width=\"1400\" height=\"1026\"></p>\r\n<p style=\"text-align: center;\">My plan is to visit these spots.<br>\r\n&#8595;</p>\r\n<p style=\"text-align: center;\"><img class=\"aligncenter size-full wp-image-2075\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/mappa.jpg\" alt=\"brahmino_backstage_milos_manfrotto_10\" width=\"100%\" height=\"100%\"></p>\r\n<p style=\"text-align: center;\"></p><div id=\"1515339353257366291\" class=\"portfolio_filter_wrapper gallery two_cols wide visible isotope\" data-columns=\"2\" style=\"position: relative; overflow: hidden; height: 251px;\"><div class=\"element grid  classic2_cols isotope-item\" style=\"position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);\"><div class=\"one_half gallery2 static filterable gallery_type animated1 fadeIn\"><a class=\"fancy-gallery\" href=\"http://www.brahmino.com/wp-content/uploads/2017/12/giphy.gif\"><img src=\"http://www.brahmino.com/wp-content/uploads/2017/12/giphy.gif\" alt=\"\"></a></div></div><div class=\"element grid  classic2_cols isotope-item\" style=\"position: absolute; left: 0px; top: 0px; transform: translate3d(446px, 0px, 0px);\"><div class=\"one_half gallery2 static filterable gallery_type animated2 fadeIn\"><a class=\"fancy-gallery\" href=\"http://www.brahmino.com/wp-content/uploads/2017/12/mandrakia.gif\"><img src=\"http://www.brahmino.com/wp-content/uploads/2017/12/mandrakia.gif\" alt=\"\"></a></div></div></div><p></p>\r\n<p style=\"text-align: center;\">&#8593;<br>\r\nSarakiniko, my favourite place I worked to create my series { Day vs Night } and Mandrakia, where I was based in the island.</p>\r\n<p style=\"text-align: center;\">This time of the year the sky is full of small clouds and in Adamas I&#8217;ve found single boats floating so I checked the sky&#8217;s conditions for&nbsp;four days, so at sunset all colours were perfect for the idea of loneliness, with a lucky touch of orange.<br>\r\n&#8595;</p>\r\n<p style=\"text-align: center;\"><img class=\"aligncenter size-full wp-image-2114\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/barchino_amadas.jpg\" alt=\"brahmino_backstage_milos_manfrotto_13\" width=\"1431\" height=\"1799\"><br>\r\n<img class=\"aligncenter size-full wp-image-2121\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/brahmino_manfrotto_2.jpg\" alt=\"brahmino_manfrotto_16\" width=\"1400\" height=\"1091\"></p>\r\n<p style=\"text-align: center;\">&#8593;<br>\r\nWorking with this light tripod even during the day with the proper filter and to catch more details.<br>\r\nHere below the wild beach in Firiplaka.<br>\r\n&#8595;<br>\r\n<img class=\"aligncenter size-full wp-image-2192\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/brahmino_manfrotto_7.jpg\" alt=\"brahmino_backstage_milos_manfrotto_7\" width=\"1600\" height=\"1600\"></p>\r\n<p style=\"text-align: center;\"><img class=\"aligncenter size-full wp-image-2101\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/Snapseed.jpg\" alt=\"brahmino_backstage_milos_manfrotto_12\" width=\"1467\" height=\"2000\"><br>\r\n&#8593;<br>\r\nSarakiniko beach, probably the most famous spot located in the Northern part of the island, beautifully shaped by grey-white volcanic rocks, where I made my series &#8216;Day vs Night&#8217;, check it out { <a href=\"http://www.brahmino.com/day_vs_night/\">here</a> }<br>\r\n&#8595;</p>\r\n<p style=\"text-align: center;\"><img class=\"aligncenter size-full wp-image-2126\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/brahmino_manfrotto_4.jpg\" alt=\"brahmino_backstage_milos_manfrotto_7\" width=\"1400\" height=\"933\"><br>\r\nI&#8217;ve found clouds for days and sometimes breathtaking sunsets with them, like in Klima.<br>\r\n&#8595;</p>\r\n<p><img class=\"aligncenter size-full wp-image-2127\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/brahmino_manfrotto_5.jpg\" alt=\"brahmino_backstage_milos_manfrotto_17\" width=\"1491\" height=\"994\"></p>\r\n<p style=\"text-align: center;\"><img class=\"aligncenter size-full wp-image-2119\" src=\"http://www.brahmino.com/wp-content/uploads/2017/12/brahmino_manfrotto_1.jpg\" alt=\"brahmino_backstage_milos_manfrotto_14\" width=\"1400\" height=\"1172\"><br>\r\nA story made in collaboration w/ <a href=\"https://www.manfrotto.com\">Manfrotto</a>&nbsp;using the &#8216;<em>BeFree Advanced</em>&#8216; tripod.<br>\r\nMore Informations on the product<br>\r\n&#8595;<br>\r\n<a class=\"button small \" style=\"background-color:#000000 !important;color:#ffffff !important;border:1px solid #000000 !important;\" onclick=\"window.open(\'https://www.manfrotto.it/collezioni/supporti/collezione-befree-advanced\', \'_self\')\">BeFree Advanced</a><br>\r\n</p><div class=\"social_share_wrapper shortcode\"><h5>Share On</h5><br><br><ul><li><a target=\"_blank\" href=\"https://www.facebook.com/sharer/sharer.php?u=http://www.brahmino.com/lonely_milos/\"><i class=\"fa fa-facebook marginright\"></i></a></li><li><a target=\"_blank\" href=\"https://twitter.com/intent/tweet?original_referer=http://www.brahmino.com/lonely_milos/&amp;url=http://www.brahmino.com/lonely_milos/\"><i class=\"fa fa-twitter marginright\"></i></a></li><li><a target=\"_blank\" href=\"http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.brahmino.com%2Flonely_milos%2F\"><i class=\"fa fa-pinterest marginright\"></i></a></li><li><a target=\"_blank\" href=\"https://plus.google.com/share?url=http://www.brahmino.com/lonely_milos/\"><i class=\"fa fa-google-plus marginright\"></i></a></li></ul></div><p></p>\r\n				    \r\n			    	</div>\r\n		    		    \r\n		    			    <div class=\"post_excerpt post_tag\">\r\n			    	<i class=\"fa fa-tags\"></i>\r\n			    	<a href=\"http://www.brahmino.com/tag/adamas/\" rel=\"tag\">adamas</a><a href=\"http://www.brahmino.com/tag/backstage/\" rel=\"tag\">backstage</a><a href=\"http://www.brahmino.com/tag/blue/\" rel=\"tag\">blue</a><a href=\"http://www.brahmino.com/tag/greece/\" rel=\"tag\">greece</a><a href=\"http://www.brahmino.com/tag/manfrotto/\" rel=\"tag\">manfrotto</a><a href=\"http://www.brahmino.com/tag/milos/\" rel=\"tag\">milos</a><a href=\"http://www.brahmino.com/tag/sarakiniko/\" rel=\"tag\">sarakiniko</a><a href=\"http://www.brahmino.com/tag/white/\" rel=\"tag\">white</a><br>			    </div>\r\n			    <br class=\"clear\">\r\n						\r\n					    \r\n			<hr>\r\n			\r\n						\r\n						\r\n						 	<hr><br class=\"clear\"><br>\r\n			  	<h6 class=\"subtitle\"><span>You might also like</span></h6><hr class=\"title_break\"><br class=\"clear\">\r\n			  	<div class=\"post_related\">\r\n			    			       <div class=\"one_third \">\r\n					   <!-- Begin each blog post -->\r\n						<div id=\"post-1977\" class=\"post-1977 post type-post status-publish format-standard has-post-thumbnail hentry category-still-life category-video-2 tag-brahmino tag-greece tag-manfrotto tag-milos tag-sarakiniko tag-stars\">\r\n						\r\n							<div class=\"post_wrapper grid_layout\">\r\n							\r\n																\r\n								    	    <div class=\"post_img small static\">\r\n								    	    	<a href=\"http://www.brahmino.com/day_vs_night/\">\r\n								    	    		<img src=\"http://www.brahmino.com/wp-content/uploads/2017/11/Cover_Milos-960x636.jpg\" alt=\"\" class=\"\" style=\"width:960px;height:636px;\">\r\n								                </a>\r\n								    	    </div>\r\n								\r\n															    \r\n							    <div class=\"blog_grid_content\">\r\n									<div class=\"post_header grid\">\r\n									    <strong><a href=\"http://www.brahmino.com/day_vs_night/\" title=\"M&#236;los | Day vs Night\">M&#236;los | Day vs Night</a></strong>\r\n									    <div class=\"post_detail\">\r\n									        11/26/2017									    </div>\r\n									</div>\r\n							    </div>\r\n							    \r\n							</div>\r\n						\r\n						</div>\r\n						<!-- End each blog post -->\r\n			       </div>\r\n			     			       <div class=\"one_third \">\r\n					   <!-- Begin each blog post -->\r\n						<div id=\"post-1928\" class=\"post-1928 post type-post status-publish format-standard has-post-thumbnail hentry category-still-life tag-blue tag-orange tag-pink tag-pop-culture tag-portraits tag-second-hand-economy tag-subito tag-teal\">\r\n						\r\n							<div class=\"post_wrapper grid_layout\">\r\n							\r\n																\r\n								    	    <div class=\"post_img small static\">\r\n								    	    	<a href=\"http://www.brahmino.com/stories-from-a-past-future/\">\r\n								    	    		<img src=\"http://www.brahmino.com/wp-content/uploads/2017/10/subito_cover-960x636.jpg\" alt=\"\" class=\"\" style=\"width:960px;height:636px;\">\r\n								                </a>\r\n								    	    </div>\r\n								\r\n															    \r\n							    <div class=\"blog_grid_content\">\r\n									<div class=\"post_header grid\">\r\n									    <strong><a href=\"http://www.brahmino.com/stories-from-a-past-future/\" title=\"Stories from a past future\">Stories from a past future</a></strong>\r\n									    <div class=\"post_detail\">\r\n									        10/06/2017									    </div>\r\n									</div>\r\n							    </div>\r\n							    \r\n							</div>\r\n						\r\n						</div>\r\n						<!-- End each blog post -->\r\n			       </div>\r\n			     			       <div class=\"one_third last\">\r\n					   <!-- Begin each blog post -->\r\n						<div id=\"post-1542\" class=\"post-1542 post type-post status-publish format-standard has-post-thumbnail hentry category-still-life category-video-2 tag-creative-series tag-manfrotto tag-martina-merlini tag-video-portrait\">\r\n						\r\n							<div class=\"post_wrapper grid_layout\">\r\n							\r\n																\r\n								    	    <div class=\"post_img small static\">\r\n								    	    	<a href=\"http://www.brahmino.com/simone-meets-martina-merlini/\">\r\n								    	    		<img src=\"http://www.brahmino.com/wp-content/uploads/2017/01/cover_manfrotto_simone_meets-960x636.jpg\" alt=\"\" class=\"\" style=\"width:960px;height:636px;\">\r\n								                </a>\r\n								    	    </div>\r\n								\r\n															    \r\n							    <div class=\"blog_grid_content\">\r\n									<div class=\"post_header grid\">\r\n									    <strong><a href=\"http://www.brahmino.com/simone-meets-martina-merlini/\" title=\"Simone Meets Martina Merlini\">Simone Meets Martina Merlini</a></strong>\r\n									    <div class=\"post_detail\">\r\n									        01/24/2017									    </div>\r\n									</div>\r\n							    </div>\r\n							    \r\n							</div>\r\n						\r\n						</div>\r\n						<!-- End each blog post -->\r\n			       </div>\r\n			     			  	</div>\r\n			    <br class=\"clear\">\r\n						\r\n						\r\n	    </div>\r\n	    \r\n	</div>\r\n\r\n</div>', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(2, 'Storia 2', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(3, 'Gino', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(4, 'Storia 2', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(5, 'Gino', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(6, 'Storia 2', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(7, 'Gino', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(8, 'Storia 2', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels / Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(9, 'Storia 2', 'http://www.brahmino.com/wp-content/uploads/2017/12/Cover_Green_Roadtrip-960x636.jpg', 'Stories of Travels, Video', 1, 'Cioaocaio', NULL, 0, '2018-01-07 11:40:24', 1, 0),
(11, 'The Wind & The Fire', 'files/file_upload/img/cover_storia-960x636 (20).jpg', '', NULL, '<p><br></p><div class=\"video-container note-video-clip\"><iframe webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\" frameborder=\"0\" src=\"//player.vimeo.com/video/249574295\" width=\"100%\" height=\"100%\" style=\"position: absolute; top: 0px; left: 0px;\"></iframe></div><p>il resto lo mettiamo qui sotto.</p>', NULL, NULL, '2018-01-13 16:40:36', 0, 0),
(12, 'gaegea', 'files/file_upload/img/cover_storia-960x636 (21).jpg', '', NULL, '<div>&nbsp;</div><div class=\"video-container note-video-clip\"><iframe webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\" frameborder=\"0\" src=\"//player.vimeo.com/video/249574295\" width=\"100%\" height=\"100%\" style=\"position: absolute; top: 0px; left: 0px;\"></iframe></div><div>&nbsp;gaegaegea aegf</div><div>geajgealgae&nbsp;</div><div>gejpogejqwp&nbsp;</div>', NULL, NULL, '2018-01-13 16:49:08', 0, 0),
(13, 'stupendezza!', 'files/file_upload/img/cover_storia-960x636 (28).jpg', 'paura, amore, odio', NULL, '&lt;p&gt;&lt;img class=&quot;summer-img&quot; src=&quot;files/file_upload/img/da4fb5c6e93e74d3df8527599fa62642.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;ciao come stai? mi manchi sei stupendo.&lt;/p&gt;&lt;p&gt;Da paura!&lt;/p&gt;', NULL, NULL, '2018-01-14 13:45:11', 0, 0),
(14, 'gea', 'files/file_upload/img/cover_storia-960x636 (30).jpg', 'geage', NULL, '&lt;p&gt;gaegae&lt;/p&gt;', NULL, NULL, '2018-01-14 16:40:57', 0, 0),
(15, 'gea', 'files/file_upload/img/dashboard.jpg', 'gae', NULL, '&lt;p&gt;gaegea&lt;/p&gt;', 'faro-dettaglio.jpg/freno (1).jpg/logo.jpg/', NULL, '2018-01-14 16:52:36', 0, 0),
(16, 'feafea', 'files/file_upload/img/faro.jpg', '', NULL, '&lt;p&gt;faefea&lt;/p&gt;', NULL, NULL, '2018-01-14 16:53:33', 0, 0),
(17, 'prova', 'files/file_upload/img/brahmino_the_pasta_opera_screenshot_3.jpg', 'wow', NULL, '&lt;p&gt;ciao&lt;/p&gt;', 'cover_storia-960x636.jpg/brahmino_the_pasta_opera_screenshot_3 (1).jpg/brahmino_the_pasta_opera_screenshot_2.jpg/', NULL, '2018-01-17 13:50:10', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brah_accounts`
--
ALTER TABLE `brah_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brah_posts`
--
ALTER TABLE `brah_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brah_stories`
--
ALTER TABLE `brah_stories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brah_accounts`
--
ALTER TABLE `brah_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brah_posts`
--
ALTER TABLE `brah_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `brah_stories`
--
ALTER TABLE `brah_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
