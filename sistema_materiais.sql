-- MariaDB dump 10.17  Distrib 10.5.5-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sistema_materiais
-- ------------------------------------------------------
-- Server version	10.5.5-MariaDB-1:10.5.5+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `deposito`
--

DROP TABLE IF EXISTS `deposito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposito`
--

LOCK TABLES `deposito` WRITE;
/*!40000 ALTER TABLE `deposito` DISABLE KEYS */;
INSERT INTO `deposito` VALUES (1,'AquiTem'),(2,'Justino'),(3,'Sao Francisco');
/*!40000 ALTER TABLE `deposito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque`
--

DROP TABLE IF EXISTS `estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estoque` (
  `codEstoque` int(11) NOT NULL AUTO_INCREMENT,
  `codDeposito` int(11) NOT NULL,
  `codMaterial` int(11) NOT NULL,
  `preco` float DEFAULT NULL,
  PRIMARY KEY (`codEstoque`),
  KEY `FK_Deposito` (`codDeposito`),
  KEY `FK_Material` (`codMaterial`),
  CONSTRAINT `FK_Deposito` FOREIGN KEY (`codDeposito`) REFERENCES `deposito` (`id`),
  CONSTRAINT `FK_Material` FOREIGN KEY (`codMaterial`) REFERENCES `material` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque`
--

LOCK TABLES `estoque` WRITE;
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` VALUES (1,1,1,1.45),(2,1,2,99),(3,1,3,11),(4,1,4,18),(5,1,5,0.49),(6,1,6,0.35),(7,1,7,4.11),(8,1,8,0.93),(9,1,9,1),(10,1,10,0.1),(11,1,11,0.22),(12,1,12,2.5),(13,1,13,12),(14,2,3,10.9),(15,2,14,13),(16,2,13,11.9),(17,2,10,0.11),(18,2,2,99),(19,2,1,1.71),(20,2,9,1),(21,2,4,17.6),(22,2,5,2.1),(23,2,7,4),(24,2,6,0.99),(25,2,12,2.1),(26,2,8,0.55),(27,2,11,0.22),(28,3,3,11.2),(29,3,13,11.5),(30,3,10,0.08),(31,3,1,1.6),(32,3,9,1.3),(33,3,7,4),(34,3,6,0.1),(35,3,12,2.5),(36,3,8,0.99),(37,3,11,0.22);
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'Caixa de 4x2'),(2,'Cabo Sil 3,5 amarelo'),(3,'Arame recozido'),(4,'Fita isolante 3M'),(5,'Joelhos 90°'),(6,'Luva 3/4 '),(7,'Joelhos azul 3/4 p 1/2 '),(8,'Te 3/4 '),(9,'Cimento'),(10,'Bainão'),(11,'Tijolos maciços'),(12,'Parafuso 10mm'),(13,'Areia media'),(14,'Areia grossa');
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-07 11:41:01
