/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id_message` varchar(10) NOT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message`
(id_message, message)
VALUES
('MSG1', 'Próximamente atentos al Desafío Laboral Kutxa edición Copa del Rey 2014! Mas información en el perfil de Facebook de Laboral Kutxa.');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `season`
--

DROP TABLE IF EXISTS `season`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `season` (
  `id_season` smallint(1) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `current` smallint(1) DEFAULT 1,
  `open` smallint(1) DEFAULT 1,
  `id_first_place_winner` varchar(10) DEFAULT NULL,
  `id_second_place_winner` varchar(10) DEFAULT NULL,
  `id_raffle_winner` varchar(10) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_season`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season`
--

LOCK TABLES `season` WRITE;
/*!40000 ALTER TABLE `season` DISABLE KEYS */;
INSERT INTO `season`
(id_season, name, current, open, id_first_place_winner, id_second_place_winner, id_raffle_winner)
VALUES
(1, 'Jornada 1', 1, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `fbid` varchar(300) DEFAULT NULL,
  `username` varchar(500) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ranking`
--

DROP TABLE IF EXISTS `ranking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ranking` (
  `id_ranking` varchar(10) NOT NULL,
  `id_season` smallint(1) DEFAULT 1,
  `id_user` varchar(150) DEFAULT NULL,
  `forecast_team_score` smallint(6) DEFAULT 0,
  `forecast_player_score` smallint(6) DEFAULT 0,
  `quiz_score` smallint(6) DEFAULT 0,
  `facebook_points` smallint(6) DEFAULT 0,
  `total_score` smallint(6) DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ranking`),
  KEY `ranking_user_idx` (`id_user`),
  CONSTRAINT `fk_ranking_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id_question` varchar(10) NOT NULL,
  `question` varchar(500) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` 
(id_question, question)
VALUES
('QUE1', '¿Quién ganó la Copa del Rey en 2007?'),
('QUE2', 'La Copa del Rey de 2013 se jugó en...'),
('QUE3', '¿Qué estadio malagueño acoge la Copa del Rey de 2014?'),
('QUE4', 'En 2012, la Copa del Rey se celebró en la ciudad de...'),
('QUE5', '¿Cuántas veces se ha jugado la final de la Copa del Rey en Bilbao?'),
('QUE6', '¿Qué sede ha albergado en más ocasiones la final de la Copa del Rey (hasta el 2013)?'),
('QUE7', 'Los dos lugares en los que se ha celebrado la Copa del Rey en más ocasiones (hasta el 2013) son...'),
('QUE8', '¿Cuándo se disputó la primera Copa del Rey?'),
('QUE9', '¿Qué edición de la Copa del Rey conserva hasta la fecha el récord histórico de asistencia de espectadores?'),
('QUE10', '¿Cuál de los siguientes entrenadores ha ganado más Copas del Rey?'),
('QUE11', 'El entrenador que ha participado más veces en la Copa del Rey es...'),
('QUE12', '¿Qué equipo tiene hasta la fecha la puntuación máxima en una final de la Copa del Rey?'),
('QUE13', 'El jugador con la máxima anotación de Tiros Libres en una Copa del Rey hasta la fecha es...'),
('QUE14', '¿Quién fue el primer MVP de la Copa del Rey?'),
('QUE15', '........................... es el único jugador que ha repetido el galardón de MVP de la Copa del Rey (hasta el 2013).'),
('QUE16', '¿Cuál de los siguientes estaba dentro del ‘Mejor Quinteto’ de la Copa del Rey de 2013?'),
('QUE17', '¿En cuántas ocasiones ha albergado la ciudad de Málaga la Copa del Rey sin tener en cuenta la edición de 2014?'),
('QUE18', '¿De qué equipo es sede el estadio que acoge la Copa del Rey de 2014?'),
('QUE19', '¿En qué año fue Málaga sede de la Copa del Rey por primera vez?'),
('QUE20', '¿Quién es el jugador más joven en ganar la Copa del Rey hasta la fecha (2013)?');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer` (
  `id_answer` varchar(10) NOT NULL,
  `id_question` varchar(10) DEFAULT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `correct` smallint(1) DEFAULT 1,
  `letter` varchar(1) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_answer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` 
(id_answer, id_question, answer, correct, letter)
VALUES
('ANS1', 'QUE1', 'Winterthur Barcelona.', 1, 'a'),
('ANS2', 'QUE1', 'Real Madrid.', 0, 'b'),
('ANS3', 'QUE1', 'DKV Joventut.', 0, 'c'),
('ANS4', 'QUE1', 'TAU Cerámica.', 0, 'd'),

('ANS5', 'QUE2', 'Madrid.', 0, 'a'),
('ANS6', 'QUE2', 'Zaragoza.', 0, 'b'),
('ANS7', 'QUE2', 'Vitoria.', 1, 'c'),
('ANS8', 'QUE2', 'Málaga.', 0, 'd'),

('ANS9', 'QUE3', 'Pabellón de Deportes Ciudad Jardín.', 0, 'a'),
('ANS10', 'QUE3', 'Palacio de Deportes José María Martín Carpena.', 1, 'b'),
('ANS11', 'QUE3', 'Palacio La Milagrosa.', 0, 'c'),
('ANS12', 'QUE3', 'Pabellón Rafael Alberti.', 0, 'd'),

('ANS13', 'QUE4', 'Barcelona.', 1, 'a'),
('ANS14', 'QUE4', 'Valencia.', 0, 'b'),
('ANS15', 'QUE4', 'Bilbao.', 0, 'c'),
('ANS16', 'QUE4', 'Sevilla.', 0, 'd'),

('ANS17', 'QUE5', 'Una.', 0, 'a'),
('ANS18', 'QUE5', 'Dos.', 1, 'b'),
('ANS19', 'QUE5', 'Tres.', 0, 'c'),
('ANS20', 'QUE5', 'Cuatro.', 0, 'd'),

('ANS21', 'QUE6', 'Granada.', 0, 'a'),
('ANS22', 'QUE6', 'Barcelona.', 1, 'b'),
('ANS23', 'QUE6', 'Zaragoza.', 0, 'c'),
('ANS24', 'QUE6', 'La Coruña.', 0, 'd'),

('ANS25', 'QUE7', 'Madrid y La Coruña.', 0, 'a'),
('ANS26', 'QUE7', 'Madrid y Zaragoza.', 0, 'b'),
('ANS27', 'QUE7', 'Madrid y Barcelona.', 1, 'c'),
('ANS28', 'QUE7', 'Barcelona y Zaragoza.', 0, 'd'),

('ANS29', 'QUE8', '1933.', 1, 'a'),
('ANS30', 'QUE8', '1940.', 0, 'b'),
('ANS31', 'QUE8', '1945.', 0, 'c'),
('ANS32', 'QUE8', '1950.', 0, 'd'),

('ANS33', 'QUE9', 'Barcelona 2012.', 0, 'a'),
('ANS34', 'QUE9', 'Madrid 2011.', 0, 'b'),
('ANS35', 'QUE9', 'Vitoria 2013.', 1, 'c'),
('ANS36', 'QUE9', 'Bilbao 2010.', 0, 'd'),

('ANS37', 'QUE10', 'Lolo Sainz.', 0, 'a'),
('ANS38', 'QUE10', 'Dusko Ivanovic.', 0, 'b'),
('ANS39', 'QUE10', 'Sergio Scariolo.', 0, 'c'),
('ANS40', 'QUE10', 'Aíto G. Reneses.', 1, 'd'),

('ANS41', 'QUE11', 'Pepu Hernández.', 0, 'a'),
('ANS42', 'QUE11', 'Alfred Julbe.', 1, 'b'),
('ANS43', 'QUE11', 'Manel Comas.', 0, 'c'),
('ANS44', 'QUE11', 'Salva Maldonado.', 0, 'd'),

('ANS45', 'QUE12', 'R.Negrita Joventut.', 0, 'a'),
('ANS46', 'QUE12', 'Cai Zaragoza.', 0, 'b'),
('ANS47', 'QUE12', 'Real Madrid Teka.', 0, 'c'),
('ANS48', 'QUE12', 'F.C. Barcelona.', 1, 'd'),

('ANS49', 'QUE13', 'Ismael Fabián Santos.', 0, 'a'),
('ANS50', 'QUE13', 'Vule Avdalovic.', 0, 'b'),
('ANS51', 'QUE13', 'Drazen Petrovic.', 1, 'c'),
('ANS52', 'QUE13', 'Erik Joal Meek.', 0, 'd'),

('ANS53', 'QUE14', 'Mark Davis.', 1, 'a'),
('ANS54', 'QUE14', 'J. Antonio Orenga.', 0, 'b'),
('ANS55', 'QUE14', 'John Pinone.', 0, 'c'),
('ANS56', 'QUE14', 'Pablo Laso.', 0, 'd'),

('ANS57', 'QUE15', 'Alfonso Reyes.', 0, 'a'),
('ANS58', 'QUE15', 'Fran Vázquez.', 0, 'b'),
('ANS59', 'QUE15', 'Pau Gasol.', 0, 'c'),
('ANS60', 'QUE15', 'Rudy Fernández.', 1, 'd'),

('ANS61', 'QUE16', 'Andrés Nocioni.', 0, 'a'),
('ANS62', 'QUE16', 'Serhiy Lishchuk.', 0, 'b'),
('ANS63', 'QUE16', 'Juan Carlos Navarro.', 0, 'c'),
('ANS64', 'QUE16', 'Xavi Rey.', 1, 'd'),

('ANS65', 'QUE17', 'Ninguna.', 0, 'a'),
('ANS66', 'QUE17', 'Una.', 0, 'b'),
('ANS67', 'QUE17', 'Dos.', 1, 'c'),
('ANS68', 'QUE17', 'Tres.', 0, 'd'),

('ANS69', 'QUE18', 'Cajasol.', 0, 'a'),
('ANS70', 'QUE18', 'CajaSur.', 0, 'b'),
('ANS71', 'QUE18', 'Caja Granada.', 0, 'c'),
('ANS72', 'QUE18', 'Unicaja.', 1, 'd'),

('ANS73', 'QUE19', '1995.', 0, 'a'),
('ANS74', 'QUE19', '2001.', 1, 'b'),
('ANS75', 'QUE19', '2008.', 0, 'c'),
('ANS76', 'QUE19', '2011.', 0, 'd'),

('ANS77', 'QUE20', 'Ricky Rubio.', 1, 'a'),
('ANS78', 'QUE20', 'Fernando Romay.', 0, 'b'),
('ANS79', 'QUE20', 'Juanma López Iturriaga.', 0, 'c'),
('ANS80', 'QUE20', 'Juan Antonio Corbalán.', 0, 'd');


/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `id_quiz` varchar(10) NOT NULL,
  `id_season` smallint(1) DEFAULT 1,
  `id_user` varchar(10) DEFAULT NULL,
  `id_question` varchar(10) DEFAULT NULL,
  `id_answer` varchar(10) DEFAULT NULL,
  `score` smallint(4) DEFAULT 0,
  `state` varchar(10) DEFAULT NULL,
  `position` smallint(1) DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_quiz`),
  KEY `quiz_user_idx` (`id_user`),
  KEY `quiz_question_idx` (`id_question`),
  KEY `quiz_answer_idx` (`id_answer`),
  CONSTRAINT `fk_quiz_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_quiz_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_quiz_answer` FOREIGN KEY (`id_answer`) REFERENCES `answer` (`id_answer`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id_team` varchar(10) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `short_name` varchar(500) DEFAULT NULL,
  `position` smallint(3) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_team`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` 
(id_team, name, short_name, position)
VALUES 
('TM1', 'FC Barcelona', 'FCV', 1),
('TM2', 'Gipuzkoa Basket', 'GBC', 8),
('TM3', 'Herbalife Gran Canaria', 'HGC', 6),
('TM4', 'Iberostar Tenerife', 'IBT', 2),
('TM5', 'Laboral Kutxa', 'LBO', 4),
('TM6', 'Real Madrid', 'RM', 5),
('TM7', 'Unicaja', 'UNI', 7),
('TM8', 'Valencia Basket', 'VBC', 3);

/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id_game` varchar(10) NOT NULL,
  `id_season` smallint(1) DEFAULT 1,
  `id_team_1` varchar(10) DEFAULT NULL,
  `id_team_2` varchar(10) DEFAULT NULL,
  `id_winner` varchar(10) DEFAULT NULL,
  `phase` varchar(200) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_game`),
  KEY `game_team_1_idx` (`id_team_1`),
  KEY `game_team_2_idx` (`id_team_2`),
  CONSTRAINT `fk_quiz_team_1` FOREIGN KEY (`id_team_1`) REFERENCES `team` (`id_team`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_quiz_team_2` FOREIGN KEY (`id_team_2`) REFERENCES `team` (`id_team`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `forecast_team`
--

DROP TABLE IF EXISTS `forecast_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast_team` (
  `id_forecast_team` varchar(10) NOT NULL,
  `id_season` smallint(1) DEFAULT 1,
  `id_user` varchar(10) DEFAULT NULL,
  `id_team` varchar(10) DEFAULT NULL,
  `phase` varchar(100) DEFAULT NULL,
  `position` smallint(1) DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_forecast_team`),
  KEY `forecast_team_user_idx` (`id_user`),
  KEY `forecast_team_team_idx` (`id_team`),
  CONSTRAINT `fk_forecast_team_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_forecast_team_team` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id_player` varchar(10) NOT NULL,
  `id_team` varchar(10) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_player`),
  KEY `player_team_idx` (`id_team`),
  CONSTRAINT `fk_player_team` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` 
(id_player, id_team, name)
VALUES
('PLY1', 'TM1','Dorsey, Joey'),
('PLY2', 'TM1','Huertas, Marcelinho'),
('PLY3', 'TM1','Lampe, Maciej'),
('PLY4', 'TM1','Lorbek, Erazem'),
('PLY5', 'TM1','Nachbar, Bostjan'),
('PLY6', 'TM1','Navarro, Juan Carlos'),
('PLY7', 'TM1','Oleson, Brad'),
('PLY8', 'TM1','Papanikolaou, Kostas'),
('PLY9', 'TM1','Pullen, Jacob'),
('PLY10', 'TM1','Sada, Víctor'),
('PLY11', 'TM1','Todorovic, M.'),
('PLY12', 'TM1','Tomic, Ante'),
('PLY13', 'TM2','Cortaberría, Jon'),
('PLY14', 'TM2','Doblas, David'),
('PLY15', 'TM2','Hanley, Will'),
('PLY16', 'TM2','Huskic, Goran'),
('PLY17', 'TM2','Motos, Mikel'),
('PLY18', 'TM2','Neto, Raulzinho'),
('PLY19', 'TM2','Olaizola, Julen'),
('PLY20', 'TM2','Ramsdell, Charles'),
('PLY21', 'TM2','Robinson, Jason'),
('PLY22', 'TM2','Salgado, Javier'),
('PLY23', 'TM2','Winchester, Anthony'),
('PLY24', 'TM3','Alvarado, Óscar'),
('PLY25', 'TM3','Báez, Eulis'),
('PLY26', 'TM3','Beirán, Javier'),
('PLY27', 'TM3','Bellas, Tomás'),
('PLY28', 'TM3','Borovnjak, Sasa'),
('PLY29', 'TM3','Cruz, Añaterve'),
('PLY30', 'TM3','Hansbrough, Ben'),
('PLY31', 'TM3','Martín, Nacho'),
('PLY32', 'TM3','Newley, Brad'),
('PLY33', 'TM3','O’Leary, Ian'),
('PLY34', 'TM3','Oliver, Albert'),
('PLY35', 'TM3','Rey, Xavi'),
('PLY36', 'TM4','Blanco, Saúl'),
('PLY37', 'TM4','Bivià, Carles'),
('PLY38', 'TM4','Chagoyen, Jesús'),
('PLY39', 'TM4','Fajardo, Diego'),
('PLY40', 'TM4','Gutiérrez, Juan P.'),
('PLY41', 'TM4','Heras, Jaime'),
('PLY42', 'TM4','Lampropoulos, Fotios'),
('PLY43', 'TM4','Richotti, Nicolás'),
('PLY44', 'TM4','Rost, Levi'),
('PLY45', 'TM4','Sekulic, Blagota'),
('PLY46', 'TM4','Sikma, Luke'),
('PLY47', 'TM4','Úriz, Ricardo'),
('PLY48', 'TM5','Causeur, Fabien'),
('PLY49', 'TM5','Hamilton, Lamont'),
('PLY50', 'TM5','Hanga, Adam'),
('PLY51', 'TM5','Heurtel, Thomas'),
('PLY52', 'TM5','Hodge, Walter'),
('PLY53', 'TM5','Jelínek, David'),
('PLY54', 'TM5','Mainoldi, Leo'),
('PLY55', 'TM5','Nocioni, Andrés'),
('PLY56', 'TM5','Pleiss, Tibor'),
('PLY57', 'TM5','San Emeterio, F.'),
('PLY58', 'TM5','Van Oostrum, Devon'),
('PLY59', 'TM6','Bourousis, Ioannis'),
('PLY60', 'TM6','Carroll, Jaycee'),
('PLY61', 'TM6','Darden, Tremmell'),
('PLY62', 'TM6','Díez, Daniel'),
('PLY63', 'TM6','Draper, Dontaye'),
('PLY64', 'TM6','Fernández, Rudy'),
('PLY65', 'TM6','Mejri, Salah'),
('PLY66', 'TM6','Mirotic, Nikola'),
('PLY67', 'TM6','Reyes, Felipe'),
('PLY68', 'TM6','Rodríguez, Sergio'),
('PLY69', 'TM6','Slaughter, Marcus'),
('PLY70', 'TM6','SLlull, Sergio'),
('PLY71', 'TM7','Calloway, Earl'),
('PLY72', 'TM7','Caner-Medley, Nik'),
('PLY73', 'TM7','Dragic, Zoran'),
('PLY74', 'TM7','Hettsheimeir, R.'),
('PLY75', 'TM7','Kuzminskas, M.'),
('PLY76', 'TM7','Urtasun, Txemi'),
('PLY77', 'TM7','LGranger, Jayson'),
('PLY78', 'TM7','Stimac, Vladimir'),
('PLY79', 'TM7','Suárez, Carlos'),
('PLY80', 'TM7','Toolson, Ryan'),
('PLY81', 'TM7','Vázquez, Fran'),
('PLY82', 'TM7','Vidal, Sergi'),
('PLY83', 'TM8','Aguilar, Pablo'),
('PLY84', 'TM8','Barton, Lubos'),
('PLY85', 'TM8','Doellman, Justin'),
('PLY86', 'TM8','Dubljevic, Bojan'),
('PLY87', 'TM8','Lafayette, Oliver'),
('PLY88', 'TM8','Lishchuk, Serhiy'),
('PLY89', 'TM8','Martínez, Rafa'),
('PLY90', 'TM8','Ribas, Pau'),
('PLY91', 'TM8','Sato, Romain'),
('PLY92', 'TM8','Triguero, Juan José'),
('PLY93', 'TM8','Van Rossom, Sam');



/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `award`
--

DROP TABLE IF EXISTS `award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `award` (
  `id_award` varchar(10) NOT NULL,
  `id_season` smallint(1) DEFAULT 1,
  `id_player` varchar(10) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_award`),
  KEY `award_player_idx` (`id_player`),
  CONSTRAINT `fk_award_player` FOREIGN KEY (`id_player`) REFERENCES `player` (`id_player`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `forecast_player`
--

DROP TABLE IF EXISTS `forecast_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast_player` (
  `id_forecast_player` varchar(10) NOT NULL,
  `id_season` smallint(1) DEFAULT 1,
  `id_user` varchar(10) DEFAULT NULL,
  `id_player` varchar(10) DEFAULT NULL,
  `award` varchar(100) DEFAULT NULL,
  `position` smallint(1) DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_forecast_player`),
  KEY `forecast_player_user_idx` (`id_user`),
  KEY `forecast_player_player_idx` (`id_player`),
  CONSTRAINT `fk_forecast_player_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_forecast_player_player` FOREIGN KEY (`id_player`) REFERENCES `player` (`id_player`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;