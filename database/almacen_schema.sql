-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: almacen
-- ------------------------------------------------------
-- Server version	8.0.28

CREATE DATABASE almacen CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'almacen_user'@'%' IDENTIFIED BY 'almacen';
GRANT SELECT,INSERT,UPDATE,DELETE ON almacen.* TO 'almacen_user'@'%';

USE almacen;

SET FOREIGN_KEY_CHECKS=0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `laptops`
--

DROP TABLE IF EXISTS `laptops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laptops` (
  `id` int unsigned NOT NULL,
  `procesador` enum('AMD','INTEL') NOT NULL,
  `memoria_ram` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_laptops_productos` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laptops`
--

LOCK TABLES `laptops` WRITE;
/*!40000 ALTER TABLE `laptops` DISABLE KEYS */;
/*!40000 ALTER TABLE `laptops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `categoria` enum('laptop','televisor', 'zapatos') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_productos_sku` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `televisores`
--

DROP TABLE IF EXISTS `televisores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `televisores` (
  `id` int unsigned NOT NULL,
  `tipo_pantalla` enum('OLED','LCD','LED') NOT NULL,
  `tamanio_pantalla` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_televisores_productos` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `televisores`
--

LOCK TABLES `televisores` WRITE;
/*!40000 ALTER TABLE `televisores` DISABLE KEYS */;
/*!40000 ALTER TABLE `televisores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zapatos`
--

DROP TABLE IF EXISTS `zapatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zapatos` (
  `id` int unsigned NOT NULL,
  `material` enum('Piel','Plástico') NOT NULL,
  `talle` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_zapatos_productos` FOREIGN KEY (`id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zapatos`
--

LOCK TABLES `zapatos` WRITE;
/*!40000 ALTER TABLE `zapatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `zapatos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-04 13:55:33
