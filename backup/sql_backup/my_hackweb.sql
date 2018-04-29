-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2017 alle 07:54
-- Versione del server: 5.1.71-community-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_hackweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `verifica` varchar(255) NOT NULL DEFAULT '0',
  `cod_verifica` text NOT NULL,
  `potere` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7501 ;

--
-- Dump dei dati per la tabella `accounts`
--

INSERT INTO `accounts` (`id`, `login`, `password`, `mail`, `verifica`, `cod_verifica`, `potere`) VALUES
(1, 'frankie', 'franci', 'frank10gm@gmail.com', '1', '1', 100),
(40, 'Benja', 'amipaul', 'dij_black@yahoo.fr', '1', '1', 0),
(41, 'MAtti', 'zxc', 'mattiweb@gmail.com', '1', '1', 0),
(89, 'test', 'test', 'frenki51@gmail.com', '1', '1', 0),
(7495, 'francesco', 'franci', 'francesco.laplaca@gmail.com', '1', '1', 0),
(7496, 'giovi', 'giovimimi', 'giovanni.minghetti@gmail.com', '1', '1', 80),
(7497, 'ghiondo', 'ghiondini', 'pietro_biondini@yahoo.it', '1', '1', 80),
(7499, 'gino', 'lino', 'a@a.a', '0', '76105beb3a171876223593b3c582ae87', 0),
(7500, 'omino', 'omino', 'matteosaponi@hotmail.com', '0', '5c2f0a5c20ff48a83667f7cb1daf9250', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `assistenza`
--

CREATE TABLE IF NOT EXISTS `assistenza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `urgenza` int(3) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dump dei dati per la tabella `assistenza`
--

INSERT INTO `assistenza` (`id`, `nome`, `cognome`, `mail`, `telefono`, `urgenza`, `tipo`, `descrizione`) VALUES
(34, 'fea', 'fea', 'feafea@feafea.aeaf', '', 1, '', 'qwf'),
(32, 'afe', 'fea', 'francesco.laplaca@outlook.com', 'aaaaaa', 2, '', 'feafea'),
(33, 'pannitone', 'frenkitone', 'frankie@aaaa.coma', '', 1, '', 'feafea'),
(11, 'frenzo', 'kooken', 'stiblom', 'jahaha', 1, '', 'Dnndjs'),
(12, 'aaa', '', 'frinia@afaa.com', '', 1, '', 'affa'),
(13, 'afefeq', '', 'giordania@cis.com', 'franc', 1, '', 'falafelll'),
(14, 'ghg', 'hjj', 'gkku', 'hk', 2, '', 'Gjjg'),
(15, 'afa', '', 'laplaca@studiogiunchediemancuso.it', '', 1, '', 'afa'),
(16, 'a', '', 'a@a.a', '', 1, '', 'a'),
(17, 'frankie', '', 'frank10gm@gmail.com', '', 3, '', '//ESECUZIONE FUNZIONI AL CAMBIAMENTO DI LOCATION\r\n    $rootScope.$on(''$locationChangeSuccess'', function() {\r\n        //questa è una mia funzione\r\n        //qui si può inserire tutto\r\n        $scope.selectAll();\r\n});        \r\n\r\nin sostanza questa funzione garantisce di lanciare funzioni al momento di cambio finestra, equivale al viewDidAppear() di Xcode \r\n'),
(18, 'A', 'a', 'a@a.a', '', 1, '', 'as'),
(19, 'Ss', 'Bb', 'Ajs@ahda.con', 'Ja', 1, '', 'Ndjdj'),
(20, 'a', 'a', 'a@a.a', 'a', 1, '', 'a'),
(21, 'aa', '', 'francesco.laplaca@gmail.com', '', 1, '', 'a'),
(22, 'Tgu', '', 'Francesco.Laplaca@gmail.com', '', 2, '', 'Hhh'),
(23, 'fqefeq', '', 'frank10gm@gmail.com', '', 1, '', 'vd'),
(24, 'andra', 'aa', 'franka@gamma.com', '', 2, '', 'azza'),
(25, 'q', '', 'fqe@fafea.afe', '', 2, '', 'q'),
(26, 'Gag', '', 'Qhaa@auah.ahha', '', 1, '', 'Hahs'),
(27, 'fae', '', 'aeg@aaeg.agea', '', 1, '', 'fea'),
(28, 'afaefea', '', 'feafea@fe.afae', '', 1, '', 'fefe'),
(29, 'fae', '', 'fea', '', 1, '', 'fea'),
(30, 'fae', '', 'fea', '', 1, '', 'fea'),
(31, 'Angelo', 'Marino', 'ilmarino@libero.it', '3408649307', 3, '', 'Ho bisogno di essere hackewebbato!\r\n#hackwebbami.\r\nGrazie');

-- --------------------------------------------------------

--
-- Struttura della tabella `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `utente` varchar(50) NOT NULL DEFAULT '',
  `testo` text NOT NULL,
  `data` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=326 ;

--
-- Dump dei dati per la tabella `chat`
--

INSERT INTO `chat` (`id`, `utente`, `testo`, `data`) VALUES
(136, 'admin', 'verifica ip completata', '15 Aug 09 - 01:06:27'),
(135, 'John', 'C''mon', '14 Aug 09 - 12:36:45'),
(133, 'io', 'sei un grande!', '13 Aug 09 - 17:10:45'),
(132, 'Loco', 'finalmente ce l''hai fatta', '13 Aug 09 - 17:03:47'),
(119, 'kickman', 'lo so...', '13 Aug 09 - 16:35:25'),
(187, 'frankie', 'nuovi aggiornamenti in vista per il sito!', '29 Dec 09 - 18:13:53'),
(189, 'frankie', 'guardate questo video!!!! http://en.tackfilm.se/?id=1262894263901RA92', '08 Jan 10 - 10:58:17'),
(325, 'frankie', 'non sono bravo', '05 Apr 11 - 23:38:43'),
(312, 'frankie', 'Ma la cosa piu bella &egrave; la tua chioma. Calda. Grande. Maestosa.', '05 Apr 11 - 22:11:51'),
(311, 'frankie', 'Sei l''aria al mattino, fresca. Dolce. Profumata.', '05 Apr 11 - 22:07:15'),
(310, 'frankie', 'Sei proprio stupenda. Sei un fiore sbocciato di primavera', '05 Apr 11 - 22:05:51'),
(309, 'frankie', 'Mi manchi tantissimo.. Non so piu come fare senza di te', '05 Apr 11 - 22:05:09'),
(308, 'frankie', 'Ciao', '05 Apr 11 - 22:04:12'),
(307, 'frankie', 'miticooo', '05 Apr 11 - 15:29:39'),
(306, 'frankie', 'fantastic', '05 Apr 11 - 15:27:14'),
(305, 'frankie', 'wooo', '05 Apr 11 - 15:27:10'),
(304, 'frankie', 'prova', '05 Apr 11 - 15:05:40'),
(285, 'MAtti', 'prova', '02 Sep 10 - 01:39:44'),
(281, 'frankie', 'passa', '01 Sep 10 - 20:35:44'),
(282, 'frankie', 'per tutti', '01 Sep 10 - 20:36:02'),
(279, 'frankie', 'il tempo', '01 Sep 10 - 20:35:42'),
(278, 'frankie', 'ciao :)', '01 Sep 10 - 20:35:13');

-- --------------------------------------------------------

--
-- Struttura della tabella `cp_pratiche`
--

CREATE TABLE IF NOT EXISTS `cp_pratiche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rg1num` int(11) NOT NULL,
  `rg1anno` int(11) NOT NULL,
  `nome_proc` text NOT NULL,
  `registrante` text NOT NULL,
  `assistito` text NOT NULL,
  `controparte1` text,
  `organo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dump dei dati per la tabella `cp_pratiche`
--

INSERT INTO `cp_pratiche` (`id`, `rg1num`, `rg1anno`, `nome_proc`, `registrante`, `assistito`, `controparte1`, `organo`) VALUES
(10, 142456, 1564, '', 'giovi', 'Melchiorre', 'frankie', 'rg gip Tribunale dei Piselli'),
(11, 1234, 3481, '', 'frankie', 'Ildebrando di Cortona', 'giovi', 'corte dei peni'),
(14, 6969, 1969, '', 'giovi', 'Fellone', 'frankie', 'gip dott. pene'),
(15, 444, 1315, '', 'frankie', 'sbarabimbidi', 'giovi', 'scoreggia volante'),
(17, 45897987, 1111, '', 'frankie', 'pietro martines', 'giovi', 'tribunale dei coglioni'),
(18, 78789, 4894, '', 'frankie', 'maria carvelli', 'giovi', 'tribunale della meri'),
(19, 3333, 2012, '', 'giovi', 'Laura Pompili', 'frankie', 'tribunale di gatteo'),
(20, 1698, 1083, '', 'frankie', 'giulia taioli', 'ghiondo', 'tribunale del pene');

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(20) NOT NULL,
  `testo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`id`, `data`, `testo`) VALUES
(2, '19/09/12', 'è uscito iOS 6!'),
(9, '23/09/12', 'jailbreak thethered per iOS 6 (per dispositivi A4) già disponibile prima del lancio ufficiale di iOS 6, con cydia installabile via ssh.'),
(10, '01/10/12', 'nonostante molti dicano che activator 1.7.0 funzioni anche su iOS 6, in realtà non è ancora compatibile. bisogna aspettare la prossima versione.'),
(11, '03/10/12', 'cerca "unlock iOS 6 maps" su cydia per abilitare la navigazione 3D delle mappe su iPhone 4 e 3GS'),
(12, '22/12/12', 'è uscito google maps per iphone!'),
(15, '26/09/13', 'è stato annunciato il possibile jailbreak di iOS 7'),
(16, '22/03/14', 'il jb per ios 7.1 non è ancora disponibile'),
(17, '16/06/14', 'iOS 8 is arriving next fall'),
(18, '16/06/14', 'also OSX 10.10 Yosemite is arriving next fall'),
(19, '18/06/14', 'iOS 8 beta 2 is out'),
(22, '18/06/14', 'scramblerducati.com i worked there'),
(23, '18/06/14', 'tumblr can make a SUPER trick for you. if you want more info about it.. write me!'),
(24, '12/07/14', 'guide to Pangu IF you have a evasi0n jb and IF you want to use your backup: 1. reset iphone to 7.1.2 WITHOUT restoring from a backup; 2. install jb from Pangu; 3. restore your backup; (only doing this cydia will remain in your iphone)'),
(26, '18/01/15', 'taig is compatible with all devices. for now'),
(27, '18/01/15', 'ionic + angularjs\r\n\r\n//ESECUZIONE FUNZIONI AL CAMBIAMENTO DI LOCATION\r\n    $rootScope.$on(''$locationChangeSuccess'', function() {\r\n        $scope.selectAll();\r\n    });        \r\n');

-- --------------------------------------------------------

--
-- Struttura della tabella `prova`
--

CREATE TABLE IF NOT EXISTS `prova` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `visite`
--

CREATE TABLE IF NOT EXISTS `visite` (
  `id` int(11) NOT NULL,
  `visite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `visite`
--

INSERT INTO `visite` (`id`, `visite`) VALUES
(0, 74043);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
