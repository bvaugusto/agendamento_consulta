/*
SQLyog Professional v10.0 
MySQL - 5.6.17 : Database - agendamento
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`agendamento` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `agendamento`;

/*Table structure for table `tbagendamento` */

DROP TABLE IF EXISTS `tbagendamento`;

CREATE TABLE `tbagendamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_hora` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `hora_agendamento` time NOT NULL,
  `status` enum('A','C') NOT NULL DEFAULT 'A' COMMENT 'A - Agendado C - Cancelado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `tbagendamento` */

/*Table structure for table `tbhoraagenda` */

DROP TABLE IF EXISTS `tbhoraagenda`;

CREATE TABLE `tbhoraagenda` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hora` int(2) NOT NULL,
  `descricao` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `tbhoraagenda` */

insert  into `tbhoraagenda`(`id`,`hora`,`descricao`) values (1,0,'00:00'),(2,1,'01:00'),(3,2,'02:00'),(4,3,'03:00'),(5,4,'04:00'),(6,5,'05:00'),(7,6,'06:00'),(8,7,'07:00'),(9,8,'08:00'),(10,9,'09:00'),(11,10,'10:00'),(12,11,'11:00'),(13,12,'12:00'),(14,13,'13:00'),(15,14,'14:00'),(16,15,'15:00'),(17,16,'16:00'),(18,17,'17:00'),(19,18,'18:00'),(20,19,'19:00'),(21,20,'20:00'),(22,21,'21:00'),(23,22,'22:00'),(24,23,'23:00');

/*Table structure for table `tbpaciente` */

DROP TABLE IF EXISTS `tbpaciente`;

CREATE TABLE `tbpaciente` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_agendamento` int(11) unsigned DEFAULT '1',
  `nome_medico` varchar(50) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` int(11) DEFAULT NULL,
  `num_telefone` varchar(15) NOT NULL,
  `cep` int(8) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero_logradouro` int(11) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbpaciente_idFK` (`id_agendamento`),
  CONSTRAINT `tbpaciente_idFK` FOREIGN KEY (`id_agendamento`) REFERENCES `tbagendamento` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `tbpaciente` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
