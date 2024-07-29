CREATE DATABASE  IF NOT EXISTS `ledenadministratie` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ledenadministratie`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ledenadministratie
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `boekjaar`
--

DROP TABLE IF EXISTS `boekjaar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boekjaar` (
  `jaar` int NOT NULL,
  PRIMARY KEY (`jaar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boekjaar`
--

LOCK TABLES `boekjaar` WRITE;
/*!40000 ALTER TABLE `boekjaar` DISABLE KEYS */;
INSERT INTO `boekjaar` VALUES (2023),(2024);
/*!40000 ALTER TABLE `boekjaar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributie`
--

DROP TABLE IF EXISTS `contributie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contributie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `soort_lid` varchar(255) NOT NULL,
  `bedrag` float(6,0) NOT NULL,
  `boekjaar` int NOT NULL,
  `familielidID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contributie_fk_3_idx` (`familielidID`),
  KEY `contributie_fk_1_idx` (`soort_lid`),
  KEY `contributie_fk_2_idx` (`boekjaar`),
  CONSTRAINT `contributie_fk_1` FOREIGN KEY (`soort_lid`) REFERENCES `soort_lid` (`omschrijving`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contributie_fk_2` FOREIGN KEY (`boekjaar`) REFERENCES `boekjaar` (`jaar`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contributie_fk_3` FOREIGN KEY (`familielidID`) REFERENCES `familielid` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributie`
--

LOCK TABLES `contributie` WRITE;
/*!40000 ALTER TABLE `contributie` DISABLE KEYS */;
INSERT INTO `contributie` VALUES (1,'Oudere',55,2023,1),(2,'Oudere',55,2023,2),(3,'Oudere',55,2024,3),(4,'Oudere',55,2024,4),(5,'Senior',100,2024,5),(6,'Senior',100,2024,6);
/*!40000 ALTER TABLE `contributie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familie`
--

DROP TABLE IF EXISTS `familie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familie` (
  `familieID` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  PRIMARY KEY (`familieID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familie`
--

LOCK TABLES `familie` WRITE;
/*!40000 ALTER TABLE `familie` DISABLE KEYS */;
INSERT INTO `familie` VALUES (1,'de Groot','Langepotenlaan 19 8437 IJsselstein'),(2,'Jongkees','Sonatelaan 103 3438TJ Nieuwegein');
/*!40000 ALTER TABLE `familie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familielid`
--

DROP TABLE IF EXISTS `familielid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familielid` (
  `id` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `geboortedatum` date NOT NULL DEFAULT '1900-01-01',
  `familielidRol` varchar(255) NOT NULL,
  `familieID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `familieID_fk` (`familieID`),
  KEY `familielid_fk_2_idx` (`familielidRol`),
  CONSTRAINT `familielid_fk_2` FOREIGN KEY (`familielidRol`) REFERENCES `familierol` (`Rol`),
  CONSTRAINT `familielid_ibfk_1` FOREIGN KEY (`familieID`) REFERENCES `familie` (`familieID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familielid`
--

LOCK TABLES `familielid` WRITE;
/*!40000 ALTER TABLE `familielid` DISABLE KEYS */;
INSERT INTO `familielid` VALUES (1,'Bert','1945-03-10','Man',1),(2,'Trudy','1948-09-17','Vrouw',1),(3,'Eef','1958-05-30','Vader',2),(4,'Francisca','1962-11-11','Moeder',2),(5,'Jeffrey','1985-02-27','Zoon',2),(6,'Bryant','1992-12-12','Zoon',2);
/*!40000 ALTER TABLE `familielid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familierol`
--

DROP TABLE IF EXISTS `familierol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familierol` (
  `Rol` varchar(255) NOT NULL,
  PRIMARY KEY (`Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familierol`
--

LOCK TABLES `familierol` WRITE;
/*!40000 ALTER TABLE `familierol` DISABLE KEYS */;
INSERT INTO `familierol` VALUES ('Dochter'),('Man'),('Moeder'),('Neef'),('Nicht'),('Oom'),('Tante'),('Vader'),('Vrouw'),('Zoon');
/*!40000 ALTER TABLE `familierol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soort_lid`
--

DROP TABLE IF EXISTS `soort_lid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `soort_lid` (
  `omschrijving` varchar(255) NOT NULL,
  PRIMARY KEY (`omschrijving`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soort_lid`
--

LOCK TABLES `soort_lid` WRITE;
/*!40000 ALTER TABLE `soort_lid` DISABLE KEYS */;
INSERT INTO `soort_lid` VALUES ('Aspirant'),('Jeugd'),('Junior'),('Oudere'),('Senior');
/*!40000 ALTER TABLE `soort_lid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Penningmeester','$2y$10$Who2IaUsVv5bj0zXENCrUezrVpQKOCETkIpugpBzdIwcbTpXEqMFW'),(2,'Secretaris','$2y$10$9a/QR73JvHqw4vsJTsec..WbnBmQ5eJ9lOyR4ckzuphv9OSFs7eUi');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-28 16:27:16
