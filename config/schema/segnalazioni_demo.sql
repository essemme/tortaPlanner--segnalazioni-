/*
SQLyog Professional v9.20 
MySQL - 5.1.53-community-log : Database - segnalazioni
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`segnalazioni` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `segnalazioni`;

/*Table structure for table `appuntamenti` */

DROP TABLE IF EXISTS `appuntamenti`;

CREATE TABLE `appuntamenti` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evento_id` bigint(20) NOT NULL,
  `cosa` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_inizio` date NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `appuntamenti` */

insert  into `appuntamenti`(`id`,`evento_id`,`cosa`,`data_inizio`,`ora_inizio`) values (1,1,NULL,'2012-04-27',NULL),(2,1,'Replica','2012-05-11',NULL),(3,2,NULL,'2012-04-20',NULL),(4,2,'secondo ciclo','2012-05-17',NULL),(5,2,'terzo ciclo','2012-06-07',NULL),(6,3,NULL,'2012-04-12',NULL),(7,4,NULL,'2012-04-21',NULL);

/*Table structure for table `categorie` */

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `colore` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ha_edizioni` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categorie` */

insert  into `categorie`(`id`,`categoria`,`colore`,`ha_edizioni`) values (2,'Sito e newsletter','0E7BB1',1),(3,'Gazzettella Locale','FF3D3E',1),(4,'Trasm. Radio Città','19C60C',1),(14,'Cultura','E5E1C2',0),(15,'Ambiente','DFFFBA',0),(16,'Salute','D1D1C6',0),(17,'Formazione','FBE2E3',0);

/*Table structure for table `categorie_eventi` */

DROP TABLE IF EXISTS `categorie_eventi`;

CREATE TABLE `categorie_eventi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) DEFAULT NULL,
  `evento_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categorie_eventi` */

insert  into `categorie_eventi`(`id`,`categoria_id`,`evento_id`) values (1,2,1),(2,3,1),(3,4,1),(4,14,1),(5,2,2),(6,4,2),(7,17,2),(8,2,3),(9,3,3),(10,16,3),(11,2,4),(12,3,4),(13,4,4);

/*Table structure for table `edizioni` */

DROP TABLE IF EXISTS `edizioni`;

CREATE TABLE `edizioni` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_uscita` date NOT NULL,
  `categorieeventi_id` int(11) DEFAULT NULL,
  `in_evidenza` tinyint(1) unsigned DEFAULT '0',
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `edizioni` */

insert  into `edizioni`(`id`,`data_uscita`,`categorieeventi_id`,`in_evidenza`,`note`) values (1,'2012-04-12',1,1,''),(2,'2012-04-19',1,1,''),(3,'2012-04-26',1,1,''),(4,'2012-05-10',1,0,''),(5,'2012-04-25',3,1,''),(6,'2012-04-25',2,1,''),(7,'2012-04-05',5,1,''),(8,'2012-04-12',5,1,''),(9,'2012-04-19',5,1,''),(11,'2012-04-18',5,1,''),(12,'2012-04-05',11,1,''),(13,'2012-04-12',11,1,''),(14,'2012-04-19',11,1,''),(16,'2012-04-05',1,1,''),(17,'2012-05-31',5,1,''),(18,'2012-06-06',6,1,''),(19,'2012-04-05',8,1,''),(20,'2012-04-12',8,0,''),(21,'2012-04-12',9,0,'');

/*Table structure for table `eventi` */

DROP TABLE IF EXISTS `eventi`;

CREATE TABLE `eventi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `che_cosa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `segnalato_da` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `eventi` */

insert  into `eventi`(`id`,`che_cosa`,`note`,`segnalato_da`,`data_inizio`,`data_fine`,`created`,`modified`) values (1,'Presentazione del libro \"Come fare presentazioni di libri\"','','','0000-00-00','0000-00-00','2012-03-14 11:20:42','2012-03-14 11:20:42'),(2,'Corso di Formazione \"Come Organizzare Corsi di Formazione\"','','','0000-00-00','0000-00-00','2012-03-14 11:29:10','2012-03-14 11:29:10'),(3,'Report su convegno \"Bellissimo Convegno\" da pubblicare','','','0000-00-00','0000-00-00','2012-03-14 12:07:35','2012-03-14 12:07:35'),(4,'Incontro per specialisti - Associazione del Melo','','','0000-00-00','0000-00-00','2012-03-14 12:17:52','2012-03-14 12:17:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
