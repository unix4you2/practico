-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.46-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema dynapps
--

CREATE DATABASE IF NOT EXISTS dynapps;
USE dynapps;

--
-- Definition of table `dynapps`.`App_clientes`
--

DROP TABLE IF EXISTS `dynapps`.`App_clientes`;
CREATE TABLE  `dynapps`.`App_clientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `documento` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`App_clientes`
--

/*!40000 ALTER TABLE `App_clientes` DISABLE KEYS */;
LOCK TABLES `App_clientes` WRITE;
INSERT INTO `dynapps`.`App_clientes` VALUES  (1,'71782341','john','arroyave',32,'0000-00-00','2011-06-10 10:15:08'),
 (2,'505719','rafa','arroyo',50,'0000-00-00','2011-06-10 10:18:00'),
 (3,'','','',0,'0000-00-00','2011-06-10 10:20:22'),
 (4,'71782341','John','Arroyito',32,'0000-00-00','2011-06-10 10:31:51'),
 (5,'dfgdfg','dfgdfg','dfgdfg',345,'0000-00-00','2011-06-10 10:52:18'),
 (6,'234','2342','234234',234234,'0000-00-00','2011-06-10 10:53:01'),
 (7,'345345','345345','345345',435345,'0000-00-00','2011-06-10 10:54:50'),
 (8,'111','111','111',111,'2011-02-09','2011-06-10 10:56:11'),
 (9,'123','123','123',123,'0000-00-00','2011-06-23 09:53:54'),
 (10,'456456','456456','456456',456456,'0000-00-00','2011-06-23 11:18:23');
UNLOCK TABLES;
/*!40000 ALTER TABLE `App_clientes` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_auditoria`
--

DROP TABLE IF EXISTS `dynapps`.`Core_auditoria`;
CREATE TABLE  `dynapps`.`Core_auditoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario_login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `accion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_auditoria`
--

/*!40000 ALTER TABLE `Core_auditoria` DISABLE KEYS */;
LOCK TABLES `Core_auditoria` WRITE;
INSERT INTO `dynapps`.`Core_auditoria` VALUES  (1,'','Libera puesto de trabajo desde  al cerrar sesion','2011-05-13','09:04:49'),
 (2,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:06:24'),
 (3,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:09:23'),
 (4,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:13:14'),
 (5,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:13:15'),
 (6,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:15:37'),
 (7,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:15:38'),
 (8,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:21:16'),
 (9,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:21:23'),
 (10,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:23:28'),
 (11,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:23:29'),
 (12,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:28:45'),
 (13,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:28:49'),
 (14,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:47:05'),
 (15,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:47:07'),
 (16,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:51:09'),
 (17,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:57:12'),
 (18,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:57:13'),
 (19,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','09:57:27'),
 (20,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','09:57:29'),
 (21,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','10:46:09'),
 (22,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-13','11:13:13'),
 (23,'admin','Cierra sesion desde 127.0.0.1','2011-05-13','12:00:47'),
 (24,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-16','07:41:01'),
 (25,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-18','11:20:19'),
 (26,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-18','12:08:41'),
 (27,'admin','Cierra sesion desde 127.0.0.1','2011-05-18','12:18:08'),
 (28,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-23','06:55:47'),
 (29,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','08:35:24'),
 (30,'','Ingresa al sistema desde 127.0.0.1','2011-05-23','08:35:32'),
 (31,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','08:38:31'),
 (32,'','Ingresa al sistema desde 127.0.0.1','2011-05-23','08:38:36'),
 (33,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','08:40:29'),
 (34,'','Ingresa al sistema desde 127.0.0.1','2011-05-23','08:40:33'),
 (35,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','08:42:13'),
 (36,'','Ingresa al sistema desde 127.0.0.1','2011-05-23','08:42:18'),
 (37,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','08:44:49'),
 (38,'','Ingresa al sistema desde 127.0.0.1','2011-05-23','08:44:54'),
 (39,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','08:48:04'),
 (40,'','Ingresa al sistema desde 127.0.0.1','2011-05-23','08:48:08'),
 (41,'admin','Cierra sesion desde 127.0.0.1','2011-05-23','12:11:51'),
 (42,'','Ingresa al sistema desde 127.0.0.1','2011-05-24','08:34:18'),
 (43,'admin','Cierra sesion desde 127.0.0.1','2011-05-24','11:36:03'),
 (44,'','Ingresa al sistema desde 127.0.0.1','2011-05-24','11:36:09'),
 (45,'admin','Cierra sesion desde 127.0.0.1','2011-05-24','11:43:05'),
 (46,'','Ingresa al sistema desde 127.0.0.1','2011-05-27','07:00:19'),
 (47,'admin','Cierra sesion desde 127.0.0.1','2011-05-27','07:49:18'),
 (48,'','Ingresa al sistema desde 127.0.0.1','2011-05-27','07:49:47'),
 (49,'admin','Cierra sesion desde 127.0.0.1','2011-05-27','09:13:21'),
 (50,'','Ingresa al sistema desde 127.0.0.1','2011-05-27','09:13:38'),
 (51,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-27','10:46:09'),
 (52,'admin','Ingresa al sistema desde 127.0.0.1','2011-05-27','10:56:37'),
 (53,'admin','Cierra sesion desde 127.0.0.1','2011-05-27','11:11:13'),
 (54,'','Ingresa al sistema desde 127.0.0.1','2011-05-27','11:53:41'),
 (55,'admin','Cierra sesion desde 127.0.0.1','2011-05-27','12:01:08'),
 (56,'','Ingresa al sistema desde 127.0.0.1','2011-05-30','07:04:24'),
 (57,'','Ingresa al sistema desde 127.0.0.1','2011-05-30','07:23:54'),
 (58,'admin','Cierra sesion desde 127.0.0.1','2011-05-30','11:20:42'),
 (59,'','Ingresa al sistema desde 127.0.0.1','2011-05-30','11:22:58'),
 (60,'admin','Cierra sesion desde 127.0.0.1','2011-05-30','12:08:24'),
 (61,'','Ingresa al sistema desde 127.0.0.1','2011-05-31','08:09:17'),
 (62,'admin','Cierra sesion desde 127.0.0.1','2011-05-31','09:27:31'),
 (63,'','Ingresa al sistema desde 127.0.0.1','2011-05-31','09:28:14'),
 (64,'admin','Cierra sesion desde 127.0.0.1','2011-05-31','09:43:23'),
 (65,'','Ingresa al sistema desde 127.0.0.1','2011-05-31','09:45:29'),
 (66,'admin','Cierra sesion desde 127.0.0.1','2011-05-31','09:46:03'),
 (67,'','Ingresa al sistema desde 127.0.0.1','2011-05-31','09:46:24'),
 (68,'admin','Cierra sesion desde 127.0.0.1','2011-05-31','12:05:30'),
 (69,'','Ingresa al sistema desde 127.0.0.1','2011-06-02','08:00:21'),
 (70,'','Ingresa al sistema desde 127.0.0.1','2011-06-02','11:12:23'),
 (71,'','Ingresa al sistema desde 127.0.0.1','2011-06-03','09:02:14'),
 (72,'','Ingresa al sistema desde 127.0.0.1','2011-06-03','09:26:15'),
 (73,'admin','Cierra sesion desde 127.0.0.1','2011-06-03','09:26:52'),
 (74,'','Ingresa al sistema desde 127.0.0.1','2011-06-03','11:23:25'),
 (75,'admin','Cierra sesion desde 127.0.0.1','2011-06-03','12:06:10'),
 (76,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','08:50:36'),
 (77,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-07','08:54:59'),
 (78,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-07','08:56:50'),
 (79,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','09:01:30'),
 (80,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:02:27'),
 (81,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','09:02:28'),
 (82,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:02:57'),
 (83,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','09:02:59'),
 (84,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:07:48'),
 (85,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','09:07:50'),
 (86,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:08:37'),
 (87,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','09:10:52'),
 (88,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:11:09'),
 (89,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','09:13:33'),
 (90,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:29:36'),
 (91,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:29:56'),
 (92,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:30:45'),
 (93,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-07','09:34:05'),
 (94,'','Ingresa al sistema desde 127.0.0.1','2011-06-07','10:08:41'),
 (95,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-07','10:10:08'),
 (96,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-07','10:11:22'),
 (97,'admin','Cierra sesion desde 127.0.0.1','2011-06-07','12:00:30'),
 (98,'','Ingresa al sistema desde 127.0.0.1','2011-06-09','10:50:55'),
 (99,'','Ingresa al sistema desde 127.0.0.1','2011-06-10','08:13:43'),
 (100,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-10','08:40:53'),
 (101,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-10','08:42:36'),
 (102,'admin','Cierra sesion desde 127.0.0.1','2011-06-10','11:25:18'),
 (103,'','Ingresa al sistema desde 127.0.0.1','2011-06-10','11:44:16'),
 (104,'','Ingresa al sistema desde 127.0.0.1','2011-06-13','09:27:38'),
 (105,'admin','Cierra sesion desde 127.0.0.1','2011-06-13','09:27:52'),
 (106,'','Ingresa al sistema desde 127.0.0.1','2011-06-17','07:32:40'),
 (107,'','Ingresa al sistema desde 127.0.0.1','2011-06-17','07:45:43'),
 (108,'admin','Agrega usuario john.arroyave para John Fredy Arroyave G.','2011-06-17','10:56:05'),
 (109,'admin','Cambia estado del usuario  y actualiza ultimo acceso a 20110617','2011-06-17','11:02:02'),
 (110,'admin','Cambia estado del usuario  y actualiza ultimo acceso a 20110617','2011-06-17','11:02:08'),
 (111,'admin','Cambia estado del usuario asd y actualiza ultimo acceso a 20110617','2011-06-17','11:03:35'),
 (112,'admin','Cambia estado del usuario asd y actualiza ultimo acceso a 20110617','2011-06-17','11:03:40'),
 (113,'admin','Elimina el usuario asd','2011-06-17','11:03:47'),
 (114,'admin','Elimina el usuario dfgdfg','2011-06-17','11:04:04'),
 (115,'','Cierra sesion desde 127.0.0.1','2011-06-23','08:31:06'),
 (116,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-23','08:33:27'),
 (117,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:11:20'),
 (118,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:11:22'),
 (119,'','Cambia estado del campo visible en formulario 2','2011-06-23','09:11:26'),
 (120,'','Cambia estado del campo visible en formulario 2','2011-06-23','09:11:27'),
 (121,'','Cambia estado del campo visible en formulario 2','2011-06-23','09:11:28'),
 (122,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:11:32'),
 (123,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:15:36'),
 (124,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:15:40'),
 (125,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:15:42'),
 (126,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:15:59'),
 (127,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:01'),
 (128,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:03'),
 (129,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:04'),
 (130,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:05'),
 (131,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:06'),
 (132,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:07'),
 (133,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:08'),
 (134,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:16:09'),
 (135,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','09:17:00'),
 (136,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:17:02'),
 (137,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:17:03'),
 (138,'','Cambia estado del campo columna en formulario 2','2011-06-23','09:17:07'),
 (139,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:26:54'),
 (140,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:26:55'),
 (141,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-23','09:37:29'),
 (142,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:37:38'),
 (143,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:39:57'),
 (144,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:40:00'),
 (145,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:40:02'),
 (146,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:41:37'),
 (147,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:41:38'),
 (148,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:41:41'),
 (149,'','Cambia estado del campo peso en formulario 2','2011-06-23','09:41:43'),
 (150,'','Crea campo  para formulario 2','2011-06-23','10:07:50'),
 (151,'','Crea formulario  para App_clientes','2011-06-23','10:09:37'),
 (152,'','Crea formulario  para App_clientes','2011-06-23','10:10:14'),
 (153,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-23','10:47:45'),
 (154,'','Crea formulario 21 para App_clientes','2011-06-23','11:01:52'),
 (155,'','Crea formulario 22 para App_clientes','2011-06-23','11:02:13'),
 (156,'','Crea formulario 23 para App_clientes','2011-06-23','11:02:24'),
 (157,'','Crea formulario 24 para App_clientes','2011-06-23','11:04:19'),
 (158,'','Cambia estado del campo visible en formulario 24','2011-06-23','11:04:27'),
 (159,'','Cambia estado del campo visible en formulario 24','2011-06-23','11:04:40'),
 (160,'','Crea boton  para formulario 2','2011-06-23','11:10:23'),
 (161,'','Elimina accion del formulario 2','2011-06-23','11:17:32'),
 (162,'','Inserta registro en App_clientes','2011-06-23','11:17:43'),
 (163,'','Elimina campo del formulario 2','2011-06-23','11:18:12'),
 (164,'','Inserta registro en App_clientes','2011-06-23','11:18:23'),
 (165,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','11:41:25'),
 (166,'','Cambia estado del campo obligatorio en formulario 2','2011-06-23','11:41:27'),
 (167,'','Cambia estado del campo peso en formulario 2','2011-06-23','11:42:53'),
 (168,'admin','Cierra sesion desde 127.0.0.1','2011-06-23','12:01:35'),
 (169,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-28','07:07:08'),
 (170,'','Crea campo  para formulario 2','2011-06-28','07:22:02'),
 (171,'','Elimina campo del formulario 2','2011-06-28','07:22:10'),
 (172,'','Crea campo  para formulario 2','2011-06-28','07:46:41'),
 (173,'','Crea campo  para formulario 2','2011-06-28','07:48:06'),
 (174,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-28','07:54:43'),
 (175,'','Crea campo  para formulario 2','2011-06-28','08:07:02'),
 (176,'','Crea campo  para formulario 2','2011-06-28','08:13:45'),
 (177,'','Elimina campo del formulario 2','2011-06-28','08:14:08'),
 (178,'','Elimina campo del formulario 2','2011-06-28','08:14:12'),
 (179,'','Elimina campo del formulario 2','2011-06-28','08:14:15'),
 (180,'','Elimina campo del formulario 2','2011-06-28','08:14:35'),
 (181,'admin','Ingresa al sistema desde 127.0.0.1','2011-06-28','10:10:42'),
 (182,'','Crea campo  para formulario 2','2011-06-28','10:15:10'),
 (183,'','Elimina campo del formulario 2','2011-06-28','10:15:22'),
 (184,'','Crea campo  para formulario 2','2011-06-28','11:09:28'),
 (185,'','Crea campo  para formulario 2','2011-06-28','11:10:13'),
 (186,'','Cambia estado del campo visible en formulario 2','2011-06-28','11:32:09'),
 (187,'','Crea campo  para formulario 2','2011-06-28','12:05:34'),
 (188,'','Elimina campo del formulario 2','2011-06-28','12:05:44'),
 (189,'','Elimina campo del formulario 2','2011-06-28','12:05:48');
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_auditoria` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_data`
--

DROP TABLE IF EXISTS `dynapps`.`Core_data`;
CREATE TABLE  `dynapps`.`Core_data` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_data`
--

/*!40000 ALTER TABLE `Core_data` DISABLE KEYS */;
LOCK TABLES `Core_data` WRITE;
INSERT INTO `dynapps`.`Core_data` VALUES  (1,'roberto','aleman');
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_data` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_formulario`
--

DROP TABLE IF EXISTS `dynapps`.`Core_formulario`;
CREATE TABLE  `dynapps`.`Core_formulario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `ayuda_titulo` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `ayuda_texto` text COLLATE utf8_unicode_ci,
  `ayuda_imagen` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `tabla_datos` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `columnas` int(10) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_formulario`
--

/*!40000 ALTER TABLE `Core_formulario` DISABLE KEYS */;
LOCK TABLES `Core_formulario` WRITE;
INSERT INTO `dynapps`.`Core_formulario` VALUES  (2,'Clientes','Formato para adicion de clientes','Por medio de este formato puede usted agregar la informacio correspondiente a clientes corporativos','','App_clientes',2);
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_formulario` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_formulario_boton`
--

DROP TABLE IF EXISTS `dynapps`.`Core_formulario_boton`;
CREATE TABLE  `dynapps`.`Core_formulario_boton` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `estilo` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `formulario` int(10) DEFAULT NULL,
  `tipo_accion` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `accion_usuario` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `visible` int(1) DEFAULT '1',
  `peso` int(10) DEFAULT NULL,
  `retorno_titulo` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `retorno_texto` text COLLATE utf8_unicode_ci,
  `confirmacion_texto` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_formulario_boton`
--

/*!40000 ALTER TABLE `Core_formulario_boton` DISABLE KEYS */;
LOCK TABLES `Core_formulario_boton` WRITE;
INSERT INTO `dynapps`.`Core_formulario_boton` VALUES  (6,'Guardar','BotonesEstado',2,'interna_guardar','',1,1,'','',''),
 (3,'Cancelar','BotonesEstadoCuidado',2,'interna_escritorio','',1,1,'','',''),
 (4,'Limpiar','BotonesEstado',2,'interna_limpiar','',1,1,'','','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_formulario_boton` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_formulario_campo`
--

DROP TABLE IF EXISTS `dynapps`.`Core_formulario_campo`;
CREATE TABLE  `dynapps`.`Core_formulario_campo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `campo` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `ayuda_titulo` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `ayuda_texto` text COLLATE utf8_unicode_ci,
  `formulario` int(10) DEFAULT NULL,
  `peso` int(10) DEFAULT NULL,
  `columna` int(1) DEFAULT '1',
  `obligatorio` int(1) DEFAULT '0',
  `visible` int(1) DEFAULT '1',
  `valor_predeterminado` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `validacion_datos` varchar(20) COLLATE utf8_unicode_ci DEFAULT '',
  `etiqueta_busqueda` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `ajax_busqueda` int(1) DEFAULT NULL,
  `valor_unico` int(1) DEFAULT '0',
  `solo_lectura` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `teclado_virtual` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_formulario_campo`
--

/*!40000 ALTER TABLE `Core_formulario_campo` DISABLE KEYS */;
LOCK TABLES `Core_formulario_campo` WRITE;
INSERT INTO `dynapps`.`Core_formulario_campo` VALUES  (1,'Id','id','','',2,0,1,1,0,'','','',NULL,0,'',0),
 (3,'Documento','documento','Ayuda de campo','Ingrese aqui el documento de identificacion del cliente sin guiones, puntos, espacios o caracteres especiales.',2,1,1,0,1,'','','Buscar',0,1,'',0),
 (4,'Nombre','nombre','','',2,1,2,1,1,'','','',NULL,0,'READONLY',0),
 (5,'Apellido','apellido','','',2,3,1,1,1,'','','',NULL,0,'READONLY',1),
 (22,'Fecha de nacimiento','fecha_nacimiento','','',2,1,1,1,1,'','fecha','',NULL,0,'',0),
 (17,'Edad','edad','','',2,2,2,1,1,'','numerico','',NULL,0,'',0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_formulario_campo` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_menu`
--

DROP TABLE IF EXISTS `dynapps`.`Core_menu`;
CREATE TABLE  `dynapps`.`Core_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `codigo` int(10) DEFAULT NULL,
  `texto` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `padre` int(10) DEFAULT '0',
  `peso` int(3) DEFAULT '0',
  `url` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `posible_clic` int(1) DEFAULT '1',
  `tipo_comando` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Interno',
  `comando` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `nivel_usuario` int(10) DEFAULT '0',
  `columna` int(1) DEFAULT '1',
  `posible_arriba` int(1) DEFAULT '0',
  `posible_centro` int(1) DEFAULT '1',
  `posible_escritorio` int(1) DEFAULT '0',
  `imagen` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_menu`
--

/*!40000 ALTER TABLE `Core_menu` DISABLE KEYS */;
LOCK TABLES `Core_menu` WRITE;
INSERT INTO `dynapps`.`Core_menu` VALUES  (5,1,'Menus',0,0,'',1,'Interno','administrar_menu',5,2,1,1,1,'icono_menus.png'),
 (6,2,'Usuarios',0,0,'',1,'Interno','listar_usuarios',5,1,1,1,1,'icono_usuarios.png'),
 (7,3,'Tablas de datos',0,0,'',1,'Interno','administrar_tablas',5,3,1,1,1,'icono_tabla.png'),
 (8,3,'Formularios',0,0,'',1,'Interno','administrar_formularios',5,3,1,1,1,'icono_form.png');
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_menu` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_parametros`
--

DROP TABLE IF EXISTS `dynapps`.`Core_parametros`;
CREATE TABLE  `dynapps`.`Core_parametros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_empresa_largo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_empresa_corto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_aplicacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_lanzamiento` date DEFAULT NULL,
  `licencia` text COLLATE utf8_unicode_ci,
  `creditos` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_parametros`
--

/*!40000 ALTER TABLE `Core_parametros` DISABLE KEYS */;
LOCK TABLES `Core_parametros` WRITE;
INSERT INTO `dynapps`.`Core_parametros` VALUES  (1,'Colmédicos S.A.','Colm&eacute;dicos S.','Sofia Express','11.05','2011-05-11','blablabla','john arroyave');
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_parametros` ENABLE KEYS */;


--
-- Definition of table `dynapps`.`Core_usuario`
--

DROP TABLE IF EXISTS `dynapps`.`Core_usuario`;
CREATE TABLE  `dynapps`.`Core_usuario` (
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `clave` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'd41d8cd98fd41d8cd98fd41d8cd98fd41d8cd98f',
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `estado` int(1) NOT NULL DEFAULT '1',
  `nivel` int(10) NOT NULL DEFAULT '0',
  `correo` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ultimo_acceso` date NOT NULL DEFAULT '2000-01-01',
  `llave_paso` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'd41d8cd98f00b204e9800998ecf8427e',
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dynapps`.`Core_usuario`
--

/*!40000 ALTER TABLE `Core_usuario` DISABLE KEYS */;
LOCK TABLES `Core_usuario` WRITE;
INSERT INTO `dynapps`.`Core_usuario` VALUES  ('admin','21232f297a57a5a743894a0e4a801fc3','John Arroyave','Administrador del sistema',1,5,'unix4you2@gmail.com','2011-06-28','d41d8cd98f00b204e9800998ecf8427e'),
 ('john.arroyave','4297f44b13955235245b2497399d7a93','John Fredy Arroyave G.','ing. sys',1,2,'unix4','2011-06-17','d41d8cd98f00b204e9800998ecf8427e');
UNLOCK TABLES;
/*!40000 ALTER TABLE `Core_usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
