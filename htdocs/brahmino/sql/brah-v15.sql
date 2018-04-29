-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2018 at 05:16 PM
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
  `last_update` date DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_accounts`
--

INSERT INTO `brah_accounts` (`id`, `username`, `password`, `email`, `sess_id`, `potere`, `last_update`, `added`) VALUES
(1, 'root', '17166193b35a231d8031c52931e06a70', 'frankie@hackweb.it', '1161580695', 0, '2018-01-27', '2017-12-02 16:41:52');

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
  `updated` timestamp NULL DEFAULT NULL,
  `ord2` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ord` float DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_posts`
--

INSERT INTO `brah_posts` (`id`, `title`, `subtitle`, `image`, `video_link`, `description`, `cat`, `id_user`, `added`, `updated`, `ord2`, `ord`, `status`) VALUES
(123, 'YEAH', '- Watch -', NULL, 'https://www.youtube.com/watch?v=S3pv_NhdtKQ', 'faefea', 2, NULL, '2017-11-16 16:26:46', '2018-01-31 18:07:35', '2018-01-31 17:59:59', 14.1, 0),
(140, 'Strada', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4418-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:57', 13, 1),
(141, 'Bologna', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_7028-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:59', 14, 1),
(142, 'Scarpe', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/camillo_2-705x564.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:50', 15, 1),
(107, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=StCK-zEMGro', 'aa', 2, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:44', 22.1, 1),
(138, 'Rimini', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/canale-lucine-705x881.jpg', NULL, 'aa', 1, NULL, '2018-01-24 23:00:00', '2018-01-31 18:07:35', '2018-01-31 17:59:50', 11, 0),
(143, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/donna_torii-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:48', 16, 1),
(144, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/marta_velo-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:55', 17, 1),
(145, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0370-705x470.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:52', 18, 1),
(146, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/L1100990-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:29:45', 19, 1),
(147, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/L3300011-copy-705x450.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2011-01-31 17:59:43', 20, 1),
(116, 'Milan', '- Watch -', '', 'https://www.youtube.com/watch?v=gWrtnQMt4R0', 'aa', 2, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-04-10 16:59:50', 8.1, 1),
(148, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-5-705x705.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-03-01 17:59:50', 21, 1),
(134, 'Foglie Fighe', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/parfum-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-03-31 16:59:50', 8, 1),
(135, 'Scale', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/3A71EF58-5F60-42E7-AED0-1811793E20C1-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2017-01-31 17:59:43', 9, 1),
(136, 'Occhio', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/occhio-705x882.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-28 17:59:45', 10, 1),
(139, 'Monte', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/Foto-01-08-16-12-52-24-PM-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-30 17:59:45', 12, 1),
(125, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_9434-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-20 17:59:44', 6, 1),
(124, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2017/03/CAM5254-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:54', 5, 1),
(120, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/E72A7C15-7635-4227-8F24-A5D95D331783-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:52:45', 3, 1),
(158, 'Trentino', '- View -', '', 'https://www.youtube.com/watch?v=g75tgOV5iRQ', 'aa', 2, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:49:45', 0.66, 1),
(132, 'Foglie', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_0710-705x881.jpg', NULL, 'aa', 1, NULL, '2018-01-08 23:00:00', '2018-01-31 18:07:35', '2018-01-31 17:31:15', 7, 1),
(149, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2145-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:57:47', 22, 1),
(150, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2012/09/Fluctus_Cover.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-31 17:59:52', 23, 1),
(151, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_2032-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2017-01-01 17:59:36', 24, 1),
(152, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-705x1058.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-02 17:59:36', 25, 1),
(153, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4984-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '1995-01-31 17:59:36', 26, 1),
(155, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_6539-705x705.jpeg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-03 17:59:36', 27, 1),
(156, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_4626-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-05 17:59:38', 28, 1),
(157, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/beart-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-05 17:59:36', 29, 1),
(1, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/Foto-13-09-16-705x881.jpeg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-01-20 17:59:46', 99, 1),
(159, 'Cappuccio', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-1-1-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '1996-01-31 17:59:36', 0.2, 1),
(160, 'Nascondino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_1776-1-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '1997-01-31 17:59:36', 0.3, 1),
(161, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_4208-705x886.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '1998-01-31 17:59:36', 0.1, 1),
(162, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/IMG_3207-705x881.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '1981-01-31 17:59:41', 0.6, 1),
(163, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/05/FullSizeRender-3-705x1058.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2016-01-31 17:59:36', 0.7, 1),
(164, 'Trentino', '- View -', 'http://www.brahmino.com/wp-content/uploads/2016/06/IMG_0401-705x855.jpg', NULL, 'aa', 1, NULL, '2017-11-15 15:56:22', '2018-01-31 18:07:35', '2018-03-16 17:59:43', 0.8, 1),
(168, 'wwwwwwwo', 'www', 'files/file_upload/img/info-header.jpg', NULL, NULL, 1, NULL, '2018-01-21 16:31:20', '2018-01-31 18:07:35', '2018-01-31 17:59:46', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brah_presets`
--

CREATE TABLE `brah_presets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` text,
  `code` varchar(255) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_presets`
--

INSERT INTO `brah_presets` (`id`, `title`, `img`, `code`, `price`, `added`) VALUES
(1, 'sto', 'files/file_upload/img/header2.jpg', 'enormeca', '50,00 €', '2018-02-01 16:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `brah_purchases`
--

CREATE TABLE `brah_purchases` (
  `id` int(11) NOT NULL,
  `article` varchar(255) NOT NULL,
  `auth_code` text,
  `tx_id` text,
  `user_ip` text,
  `response` text,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `downloaded` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brah_purchases`
--

INSERT INTO `brah_purchases` (`id`, `article`, `auth_code`, `tx_id`, `user_ip`, `response`, `added`, `downloaded`) VALUES
(1, 'preset-1', 'IsTMlPn9yzypor4uZI9vl4HMffhX1nWY02dhc99UuPYsPhMAlIDPe97eR2YwrZa7PJGfuwgwAOmYQUzsk0zYlQt6QmrqoV4ESajXrzI7TDEr5rI3CPOfkWHnDzqiNoMM', NULL, NULL, NULL, '2018-01-28 14:41:37', 0),
(2, 'preset-1', 'O7I61wweFpsFlsOKjpLNeWQ7LpssdoVNTS32N6m1sJwnbs8iQClXQlVF2jixzpitDZRnLAPlBdykF8P2snUqUAqI8VtrOP5NQK0Crh2I8n00WiRDMi4Iw0Zo69I5baH4', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=06%3A45%3A11+Jan+28%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=8SS393204A8233720\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-28 14:44:54', 0),
(3, 'preset-1', 'yFj8BOKtlPbNvETxL0mXQaEc1UGG6dPbnnPAlTLVwahYzaIq06yPsQ9Cwgb2cTp4jxifudncAopvg9IkNO58NAgCvEixYDatPcrsUTOVZOyjmas2rx9zytXD9WtO92NK', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=12%3A42%3A54+Jan+28%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=8AV415172W301125S\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-28 20:41:43', 0),
(4, 'preset-1', 'Jr4PQUeYsmqeWndXHWKjLb4ijPZZ3bXBXTJb3JIUIS1crXhhhvdbRglKdIxv9AK9Jm4CnAvZMIeXBaFujsmsIoEuMXhcbr8ymC44qBtE7820s3AawoQqMo9ZVZK6zHdS', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=12%3A47%3A44+Jan+28%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=51Y24799YD8507736\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-28 20:46:51', 0),
(5, 'preset-1', NULL, NULL, NULL, NULL, '2018-01-29 09:31:33', 0),
(6, 'preset-1', 'tNUN9NtpGn120IF43u7QnIvHG6tbTTuq8zwIKDBN8YeOaXkyTk5zedFoyVavVBZonQE5Nxum3xBT2Aq8tNRK5nEBO7sGiC5PPdFxZZia7vUdQSWdhWyPpIgRsT3UGi0Z', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=01%3A32%3A20+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=3LC67070TF729571C\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 09:31:47', 0),
(7, 'preset-1', 'QqQPNTKRrVFPmrkmLD5lILLIYC2HZmHWH2LtzNAmGSQySwk5HMBm1h8WxXTpf9LgE5hOvnmzCQpOeiGHgTH7hYMZ8j8L1JriuVxKgY1BibTOI7899ohQw3qpGeJ4hsgv', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=01%3A41%3A44+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=3UA95821GB706235A\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 09:41:11', 0),
(8, 'preset-1', 'kiDDDmBNZMOFrQV4UbKwr0N3cCQv89kOmzgKsJaHyIN5NhyUN9aHp6CoLHjuquGMxYFQw77i5azTaLsfOMU9cnXOjjfX3XZXVB6oKSh8fi68PSbKFBnV95mriMrfC6Aq', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=01%3A43%3A45+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=8XS33445F3271443E\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 09:43:22', 0),
(9, 'preset-1', 'iUcICsPHJhTayEzYxr303PaX0Wwuc9sQd3coAi7V3UIOGytJ0Q6cTg1JTiPSnUADEYjLK4aQRyhjS4cu3lvXc2nyCyYBrmWxeQkMRLSxz0pfS0brrfA15qQnwAoGix6Q', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=02%3A30%3A41+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=2L876549KW117370D\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 10:29:43', 0),
(10, 'preset-1', 'CaQiorOLbdOhBTrqLGRGfER3MgEYIJtbjvnRS4ZuuiVvcwXTPLxailzmg5IlEFIhXY6ClORQwSyoyBP7MvJWu3ljJO743k6DwcEmCrQfgjaG61LXNE40NCFX6e5ogPyj', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=02%3A42%3A07+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=4FB910252X000454P\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 10:41:39', 0),
(11, 'preset-1', 'Hj33zUOM77oK8br2h1W0Ags0dwD9GqGklU0AYTFythWFlfSuj4vcx9y8uy3dJHEeqVTfC8kU8TCSCk3F0cHJWK3Avcng9vKmMKBL0b5JqKCCEsdIcQ94RTss6UL51bpf', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=03%3A17%3A34+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=5NW34958TD825354W\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 11:17:14', 0),
(12, 'preset-1', 'ZjrTf6tmqKFQvyON45rK4mp6wz8DmP55UM4Oj3nnU8ESsXO2fxGj1psjisqULxtuR584y0jYXZN2H8h2ghG8LVr5d3ZSGCLFeqWpDj8ybWVx2iQMqF98OcZoVT58peBt', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=03%3A35%3A01+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=1RH7949255506925T\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 11:34:29', 0),
(13, 'preset-1', 'rWc8IUWSqUA8ovQ7Jy8XZ8rJpstLUknhIhjvsbf1kSISprONgZxQokFo85jAEWQHM3rOFw0opzmZghNFyqX87kWEcTLGBiFl7z9c7i8QeyKECLOKneuDVx1T4vnc3cjO', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=03%3A45%3A17+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=77710634DN259581F\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 11:44:58', 0),
(14, 'preset-1', 'ucgllM0CON6tNSmXzp7gAFfjRpSVdnGEuKoYM8mwbl4YEIlouXFZS6aVjFwtwxwPDAc03Uc76V6ASaLwUOtxEU8wTwhSSR7Oyb2ujeXiV83egeBc3BWf7AICTWDH0emG', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=03%3A57%3A59+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=4B026883YU758473E\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 11:57:24', 0),
(15, 'preset-1', NULL, NULL, NULL, NULL, '2018-01-29 12:15:22', 0),
(16, 'preset-1', 'X9Bx0HelzOnQ0zHyHG76yc42Ecu4yo4mne2hjZW0qvwnrefiYKgQ89lSEzDqpvsyHYEd4iAyjqMa4ZlGpBdp8H236i102AJGQFbalIN46ZQnmse4KI6TIJ5EVDr6QK3b', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=04%3A16%3A03+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=3HV40017MD0669126\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 12:15:29', 0),
(17, 'preset-2', 'eXVfSqLimqEd5Y81jgbKnmt9ARY4afDoDP6l21pNxHpbGypYKVFAC0IzJMq3EkEXrClaGaqDwFfngEAzbrPOs4BR6VoFiuNVfUJgLp6gz1Bq1TJnK6bVpnWjkUE7ewuX', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=08%3A23%3A42+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=4TY00078T78706411\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 16:23:22', 0),
(18, 'preset-1', '6zbeT9ImRU1VLEwJgKQvViHyD9eup6gWEMljuMfX5pDMzk7B9JHzN8FicqoPwXruUjv7SLpIPIsE3wOw2iyJGiztQtZhyOLlFXyqqatIcMWVjh2acN07Fg4WnuvXjKbE', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=08%3A51%3A52+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=8GL26010CU195411X\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 16:51:12', 0),
(19, 'preset-1', '7HmmtKhbc7bGwj2xQoleiRG4tbJuFJhFRGVcw5cYnNd5t4RHUQz0XbRLatvlnGspP1HGnCW1dDAKRMpcjaGYTXXpdxfBhq3tdahmTT55VWrofBoSxtB0rX2twGHn9DiH', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=08%3A57%3A30+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=3WH35413NU998821B\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 16:56:17', 0),
(20, 'preset-1', 'mNxIQWVt5hEn2z5uqbDScFAg0yQnrHoZvj0iiLqVbc6q9HIyKGouPrIhmxlSKWvnxc2CKk9KTZKnXZwCKLiPTi83eiUiCRNoIx3l9DjUEiTFtcPXfhQa7aNy2ncWp25K', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=10%3A07%3A44+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=8M150293BY3583814\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 18:07:25', 0),
(21, 'preset-1', NULL, NULL, NULL, NULL, '2018-01-29 18:17:15', 0),
(22, 'preset-1', 'TuvLOl3xQQ1ieGMvGiV6jNocNzpZ9qtK0aIoKLfz2vrVZQFb8m2hyVTeG8WsxdCVHtgWSjASx0GstqV3bQEZ1kBjZiL5PdLvFUadB87AAlN9yNc16PkKwdMVINlZhziu', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=10%3A18%3A40+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=22634337KR3099307\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 18:18:05', 0),
(23, 'preset-1', 'b7UCY79qV9YyoKTS3bsEb3KXYtIXIbM4UJ52DXzS7JigzUXnWlu31eUH8gtGEy3CPIDhQS4Ap7jWpYmeJ4H1zxZytNU2J0Y6YMmC2xM0kMd3a3mg7z4sLvqZMEbPY39Z', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=10%3A19%3A57+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=5F50361603987522P\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 18:19:14', 0),
(24, 'preset-1', 'qDTRfxz32LgFmL9s3QSUn1Iyz7eqf4b6P4terzq2PuY1A0zqBEIk6s78nsFGLNgI2uJEIUwc3oTm30bIfAXSfnQ1fYXNTRWefblEOHRRYDXbQmdywJDUiLZmWYp4ZurU', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=10%3A44%3A03+Jan+29%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=80G46740DF883005S\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-29 18:43:18', 0),
(25, 'preset-1', 'MOZJkn4skNz8gRv6s4cCuI0r1Eq5SKbIu2RQJWF1toidabQyIqGYbV4Dl8K2iwEJ6aHSHcoY9HyRzqJ40rtTmxab8b8QOvnJC0WG36APkVGOmm9FtgusrMqFwr8IWybq', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=04%3A19%3A24+Jan+30%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=6MH04594340469005\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-30 12:19:01', 0),
(26, 'preset-1', '2GnFHzBFwNwsZLmbaaNwj4scjPp6NzClLlyrMGFLYYXPrLGA34JmcE0Pxqqaa3R19VdCT4s1sZnflDxvLMHMoC98yLZZofdWJA7TN5lErw6mjWf1KxksoSrJLIWNUqJc', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=04%3A35%3A21+Jan+30%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=6T506266WJ657104P\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-30 12:34:50', 0),
(27, 'preset-1', 'Xen5OP4rAWPuZa6WOPfitRXJFitY0yb7ycF6EhX8QfvXnI6M9Kz0u1zUXc0J6TYQcZXKsNl1p7EpkflsVInSsLV8yvIf1iI7vRQgzLR0v6GbrB8jwIHn9YndcvseQRrU', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=04%3A55%3A06+Jan+30%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=0BL44396DV4649341\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-30 12:54:13', 0),
(28, 'preset-1', 'Nx4Kg9ktUUPRBS6oafSRTsrqMnLbfMJCyv13TgWD22m1FebAqEWnkKoM31eMPP3LMEI3XjUGE6k0cwZfuUStHNw4raeEl9KEEvfJtwxRQwJK0WgWJ7yGyRDDj2H3fH5b', NULL, NULL, 'SUCCESS\nmc_gross=50.00\nprotection_eligibility=Eligible\naddress_status=confirmed\npayer_id=XQFC7VMWRB6XC\ntax=0.00\naddress_street=Via+Unit%3F+d%27Italia%2C+5783296\npayment_date=05%3A07%3A55+Jan+30%2C+2018+PST\npayment_status=Completed\ncharset=windows-1252\naddress_zip=80127\nfirst_name=test\nmc_fee=2.05\naddress_country_code=IT\naddress_name=test+buyer\ncustom=\npayer_status=verified\nbusiness=frank10gm-facilitator%40gmail.com\naddress_country=Italy\naddress_city=Napoli\nquantity=1\npayer_email=frank10gm-buyer%40gmail.com\ntxn_id=1D069630FL750163Y\npayment_type=instant\nlast_name=buyer\naddress_state=Napoli\nreceiver_email=frank10gm-facilitator%40gmail.com\npayment_fee=\nshipping_discount=0.00\ninsurance_amount=0.00\nreceiver_id=G7KKQ7M86HGL8\ntxn_type=web_accept\nitem_name=Brahmino+Preset\ndiscount=0.00\nmc_currency=EUR\nitem_number=brah-preset\nresidence_country=IT\nshipping_method=Default\nhandling_amount=0.00\ntransaction_subject=\npayment_gross=\nshipping=0.00\n', '2018-01-30 13:07:18', 0);

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
(18, 'gino', 'files/file_upload/img/cover_storia-960x636.jpg', 'faefae', NULL, '&lt;p&gt;faefea&lt;/p&gt;', '63C93321-6CDB-40E0-B7DE-1F7728211DD5.jpeg/', NULL, '2018-01-20 17:43:01', 0, 0);

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
-- Indexes for table `brah_presets`
--
ALTER TABLE `brah_presets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brah_purchases`
--
ALTER TABLE `brah_purchases`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `brah_presets`
--
ALTER TABLE `brah_presets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brah_purchases`
--
ALTER TABLE `brah_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `brah_stories`
--
ALTER TABLE `brah_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
