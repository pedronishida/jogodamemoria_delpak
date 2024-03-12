CREATE DATABASE  IF NOT EXISTS `jogo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jogo`;
-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: jogo
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cartas`
--

DROP TABLE IF EXISTS `cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cartas` (
  `idcarta` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) NOT NULL,
  `idtema` int(11) NOT NULL,
  PRIMARY KEY (`idcarta`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartas`
--

LOCK TABLES `cartas` WRITE;
/*!40000 ALTER TABLE `cartas` DISABLE KEYS */;
INSERT INTO `cartas` VALUES (2,'a2.jpg',1),(3,'a3.jpg',1),(4,'a4.jpg',1),(5,'a5.jpg',1),(6,'a6.jpg',1),(7,'a7.jpg',1),(8,'a8.jpg',1),(9,'a9.jpg',1),(10,'a10.jpg',1),(11,'a11.jpg',1),(12,'a12.jpg',1),(13,'capa1.jpg',1),(14,'h1.jpg',2),(15,'h2.jpg',2),(16,'h3.jpg',2),(17,'h4.jpg',2),(18,'h5.jpg',2),(19,'h6.jpg',2),(20,'h7.jpg',2),(21,'h8.jpg',2),(22,'h9.jpg',2),(23,'h10.jpg',2),(24,'h11.jpg',2),(25,'h12.jpg',2),(26,'capa2.jpg',2),(27,'s1.jpg',3),(28,'s2.jpg',3),(29,'s3.jpg',3),(30,'s4.jpg',3),(31,'s5.jpg',3),(32,'s6.jpg',3),(33,'s7.jpg',3),(34,'s8.jpg',3),(35,'s9.jpg',3),(36,'s10.jpg',3),(37,'s11.jpg',3),(38,'s12.jpg',3),(39,'capa3.jpg',3);
/*!40000 ALTER TABLE `cartas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temas`
--

DROP TABLE IF EXISTS `temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temas` (
  `idtema` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) NOT NULL,
  PRIMARY KEY (`idtema`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temas`
--

LOCK TABLES `temas` WRITE;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
INSERT INTO `temas` VALUES (1,'anime'),(2,'harrypotter'),(3,'starwars');
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `dinheiro` double NOT NULL DEFAULT '0',
  `idtema` int(11) NOT NULL DEFAULT '1',
  `bonusexcluir` int(11) NOT NULL DEFAULT '0',
  `bonusrevelar` int(11) NOT NULL DEFAULT '0',
  `rec_iniciante` int(11) NOT NULL DEFAULT '0',
  `rec_moderado` int(11) NOT NULL DEFAULT '0',
  `rec_intermediario` int(11) NOT NULL DEFAULT '0',
  `rec_avancado` int(11) NOT NULL DEFAULT '0',
  `rec_mestre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `nome` (`nome`),
  UNIQUE KEY `senha` (`senha`),
  UNIQUE KEY `senha_2` (`senha`),
  KEY `idtema` (`idtema`),
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idtema`) REFERENCES `temas` (`idtema`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'igor','202cb962ac59075b964b07152d234b70',0,2,6,3,720,3333,4535,533,700),(2,'ester','81dc9bdb52d04dc20036dbd8313ed055',0,2,0,0,199,0,0,0,0),(3,'admin','21232f297a57a5a743894a0e4a801fc3',0,1,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-24 20:01:08
