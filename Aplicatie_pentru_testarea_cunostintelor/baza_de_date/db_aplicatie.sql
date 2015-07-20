-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Sep 2014 la 02:04
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_aplicatie`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `intrebare`
--

CREATE TABLE IF NOT EXISTS `intrebare` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_test_id` int(11) NOT NULL,
  `i_test_testgrup_id` int(11) DEFAULT NULL,
  `i_text` text NOT NULL,
  `i_tip` varchar(255) DEFAULT NULL,
  `i_creat_de` int(11) DEFAULT NULL,
  `i_data_creare` datetime DEFAULT NULL,
  `i_arata` tinyint(4) NOT NULL DEFAULT '0',
  `i_puncte` int(11) DEFAULT NULL,
  PRIMARY KEY (`i_id`),
  KEY `question_master_FK_1` (`i_test_id`),
  KEY `q_create_by` (`i_creat_de`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `intrebare`
--

INSERT INTO `intrebare` (`i_id`, `i_test_id`, `i_test_testgrup_id`, `i_text`, `i_tip`, `i_creat_de`, `i_data_creare`, `i_arata`, `i_puncte`) VALUES
(1, 2, 0, 'Fie secventa Java:\r\n\r\nint x=1, y, x=3, t;\r\nx += y = z += t = 5; Atunci:\r\n\r\nAlege raspunsul corect', 'Un singur raspuns corect - text -', 2, '2014-08-26 13:27:58', 1, 10),
(2, 2, 0, 'Executia programului Java\r\n\r\nclass T1 {\r\n\r\npublic static void main (String[] a) {\r\nint x=5;\r\nint y=(x=4)*x; System.put.println(y);\r\n}\r\n}\r\nva afisa', 'Un singur raspuns corect - text -', 2, '2014-08-26 13:30:03', 1, 10),
(3, 2, 0, 'In Java, numarul nivelurilor de acces la membrii unei clase este', 'Un singur raspuns corect - text -', 2, '2014-08-26 13:31:16', 1, 10),
(4, 2, 0, 'O dat&#259; de tip Char ocup&#259;', 'Un singur raspuns corect - text -', 2, '2014-08-26 13:34:37', 1, 10);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `student_examen`
--

CREATE TABLE IF NOT EXISTS `student_examen` (
  `se_id` int(11) NOT NULL,
  `se_u_id` int(11) NOT NULL,
  `se_t_id` int(11) NOT NULL,
  `se_data_creare` datetime DEFAULT NULL,
  `se_rezultat` int(11) DEFAULT NULL,
  PRIMARY KEY (`se_id`),
  KEY `s_user_examen_FK_1` (`se_u_id`),
  KEY `s_user_examen_FK_2` (`se_t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `student_examen_intrebare`
--

CREATE TABLE IF NOT EXISTS `student_examen_intrebare` (
  `sei_id` int(11) NOT NULL,
  `sei_se_id` int(11) NOT NULL,
  `sei_i_id` int(11) NOT NULL,
  `sei_vr_selectat` tinyint(4) NOT NULL DEFAULT '0',
  `sei_text` text,
  PRIMARY KEY (`sei_id`),
  KEY `s_user_examen_details_FK_1` (`sei_se_id`),
  KEY `s_user_examen_details_FK_2` (`sei_i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `sugestie`
--

CREATE TABLE IF NOT EXISTS `sugestie` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_data` datetime NOT NULL,
  `s_subiect` varchar(255) NOT NULL,
  `s_continut` text NOT NULL,
  `s_u_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  KEY `s_feedback_FK_1` (`s_u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_tg_id` int(11) NOT NULL,
  `t_titlu` varchar(255) NOT NULL,
  `t_descriere` varchar(1000) DEFAULT NULL,
  `t_creat_de` int(11) DEFAULT NULL,
  `t_arata` tinyint(4) NOT NULL DEFAULT '0',
  `t_timp` int(11) DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `em_ec_id_FK_1` (`t_tg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `test`
--

INSERT INTO `test` (`t_id`, `t_tg_id`, `t_titlu`, `t_descriere`, `t_creat_de`, `t_arata`, `t_timp`) VALUES
(2, 2, 'Introducere in Java', 'Aspecte esentiale ale limbajului de programare Java', 2, 1, 10),
(3, 2, 'Introducere in Java 2', 'Java 2', 2, 1, 10);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `test_grup`
--

CREATE TABLE IF NOT EXISTS `test_grup` (
  `tg_id` int(11) NOT NULL AUTO_INCREMENT,
  `tg_titlu` varchar(255) NOT NULL,
  `tg_descriere` varchar(1000) DEFAULT NULL,
  `tg_creat_de` int(11) DEFAULT NULL,
  `tg_arata` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `test_grup`
--

INSERT INTO `test_grup` (`tg_id`, `tg_titlu`, `tg_descriere`, `tg_creat_de`, `tg_arata`) VALUES
(2, 'Java', 'Introducere in Java', 2, 1),
(3, 'C++', 'Introducere in C++', 2, 1),
(4, 'PHP', 'Introducere in PHP', 2, 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `utilizator`
--

CREATE TABLE IF NOT EXISTS `utilizator` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_nume` varchar(100) NOT NULL,
  `u_parola` varchar(100) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_tip` enum('Student','Profesor','Administrator') DEFAULT 'Student',
  `u_data_creare` datetime DEFAULT NULL,
  `u_data_activare` datetime DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Salvarea datelor din tabel `utilizator`
--

INSERT INTO `utilizator` (`u_id`, `u_nume`, `u_parola`, `u_email`, `u_tip`, `u_data_creare`, `u_data_activare`) VALUES
(1, 'admin', 'admin', 'valentin@badita.com', 'Administrator', '2014-08-24 04:03:41', NULL),
(2, 'profesor', 'profesor', 'valentinbad@yahoo.com', 'Profesor', '2014-08-26 13:17:25', '2014-09-01 01:45:46'),
(3, 'student', 'student', 'valentin.badita@mindcti.com', 'Student', '2014-08-26 13:35:34', '2014-09-09 23:20:11');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `varianta_raspuns`
--

CREATE TABLE IF NOT EXISTS `varianta_raspuns` (
  `vr_id` int(11) NOT NULL AUTO_INCREMENT,
  `vr_i_id` int(11) NOT NULL,
  `vr_text` text,
  `vr_locatie_imagine` varchar(1000) DEFAULT NULL,
  `vr_corect` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vr_id`),
  KEY `question_option_FK_1` (`vr_i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Salvarea datelor din tabel `varianta_raspuns`
--

INSERT INTO `varianta_raspuns` (`vr_id`, `vr_i_id`, `vr_text`, `vr_locatie_imagine`, `vr_corect`) VALUES
(17, 4, '7 biti', '', 0),
(18, 4, '16 biti', '', 1),
(19, 4, '8 biti', '', 0),
(20, 4, '4 biti', '', 0),
(21, 1, 'x=9, y=5, z=5, t=8', '', 0),
(22, 1, 'x=9, y=8, z=8, t=5', '', 1),
(23, 1, 'x=8, y=9, z=9, t=5', '', 0),
(24, 1, 'x=5, y=0, z=9, t=8', '', 0),
(25, 2, '4', '', 0),
(26, 2, '5', '', 0),
(27, 2, '16', '', 1),
(28, 2, '20', '', 0),
(29, 3, '4', '', 0),
(30, 3, '1', '', 1),
(31, 3, '3', '', 0),
(32, 3, '2', '', 0);

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `intrebare`
--
ALTER TABLE `intrebare`
  ADD CONSTRAINT `intrebare_ibfk_1` FOREIGN KEY (`i_creat_de`) REFERENCES `utilizator` (`u_id`),
  ADD CONSTRAINT `question_master_FK_1` FOREIGN KEY (`i_test_id`) REFERENCES `test` (`t_id`);

--
-- Restrictii pentru tabele `student_examen`
--
ALTER TABLE `student_examen`
  ADD CONSTRAINT `s_user_examen_FK_1` FOREIGN KEY (`se_u_id`) REFERENCES `utilizator` (`u_id`),
  ADD CONSTRAINT `s_user_examen_FK_2` FOREIGN KEY (`se_t_id`) REFERENCES `test` (`t_id`);

--
-- Restrictii pentru tabele `student_examen_intrebare`
--
ALTER TABLE `student_examen_intrebare`
  ADD CONSTRAINT `s_user_examen_details_FK_1` FOREIGN KEY (`sei_se_id`) REFERENCES `student_examen` (`se_id`),
  ADD CONSTRAINT `s_user_examen_details_FK_2` FOREIGN KEY (`sei_i_id`) REFERENCES `intrebare` (`i_id`);

--
-- Restrictii pentru tabele `sugestie`
--
ALTER TABLE `sugestie`
  ADD CONSTRAINT `s_feedback_FK_1` FOREIGN KEY (`s_u_id`) REFERENCES `utilizator` (`u_id`);

--
-- Restrictii pentru tabele `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `em_ec_id_FK_1` FOREIGN KEY (`t_tg_id`) REFERENCES `test_grup` (`tg_id`);

--
-- Restrictii pentru tabele `varianta_raspuns`
--
ALTER TABLE `varianta_raspuns`
  ADD CONSTRAINT `question_option_FK_1` FOREIGN KEY (`vr_i_id`) REFERENCES `intrebare` (`i_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
