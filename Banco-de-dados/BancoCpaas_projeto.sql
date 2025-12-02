-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: cpaas_projeto
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(80) DEFAULT NULL,
  `cpf_cliente` varchar(15) DEFAULT NULL,
  `nomematerno_cliente` varchar(80) DEFAULT NULL,
  `sexo_cliente` varchar(9) DEFAULT NULL,
  `datanasc_cliente` date DEFAULT NULL,
  `email_cliente` varchar(50) DEFAULT NULL,
  `celular_cliente` varchar(20) DEFAULT NULL,
  `fixo_cliente` varchar(20) DEFAULT NULL,
  `cep_cliente` varchar(10) DEFAULT NULL,
  `rua_cliente` varchar(80) DEFAULT NULL,
  `numero_cliente` varchar(10) DEFAULT NULL,
  `bairro_cliente` varchar(20) DEFAULT NULL,
  `complemento_cliente` varchar(50) DEFAULT NULL,
  `cidade_cliente` varchar(30) DEFAULT NULL,
  `estado_cliente` varchar(2) DEFAULT NULL,
  `login_cliente` varchar(6) DEFAULT NULL,
  `senha_cliente` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (61,'Hugo Daniel Medeiros','123.449.597-01','Daniela Garrido Silva','masculino','2001-02-21','meuemail@gmail.com','(+55) 21 99943-9272','(+55) 21 3407-0446','23097-075','Rua Luiz José da Cunha','70','Campo Grande','casa','Rio de Janeiro','RJ','hyurii','12345678');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprar`
--

DROP TABLE IF EXISTS `comprar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comprar` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `forma_pagamento` varchar(20) DEFAULT NULL,
  `hora_compra` varchar(20) DEFAULT NULL,
  `id_servico` int DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `id_servico` (`id_servico`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `comprar_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `serviços` (`id_servico`),
  CONSTRAINT `comprar_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprar`
--

LOCK TABLES `comprar` WRITE;
/*!40000 ALTER TABLE `comprar` DISABLE KEYS */;
INSERT INTO `comprar` VALUES (8,NULL,'2024-06-20 20:17:41',NULL,NULL),(9,NULL,'2024-06-20 20:19:01',NULL,NULL),(10,NULL,'2024-06-20 20:24:53',NULL,NULL),(11,NULL,'2024-06-20 20:26:59',NULL,NULL),(12,NULL,'2024-06-20 20:28:16',NULL,NULL),(13,NULL,'2024-06-20 20:31:13',NULL,NULL),(14,NULL,'2024-06-20 20:36:00',NULL,NULL),(15,NULL,'2024-06-20 20:37:22',NULL,NULL),(16,NULL,'2024-06-20 20:38:52',NULL,NULL),(17,NULL,'2024-06-20 20:41:05',NULL,NULL),(18,NULL,'2024-06-20 20:42:57',NULL,NULL),(19,NULL,'2024-06-20 20:46:00',NULL,NULL),(20,NULL,'2024-06-20 20:47:44',NULL,NULL),(21,NULL,'2024-06-20 20:50:31',NULL,NULL),(22,NULL,'2024-06-20 20:50:51',NULL,NULL),(23,NULL,'2024-06-20 20:54:25',NULL,NULL),(24,NULL,'2024-06-20 20:54:58',NULL,NULL),(25,NULL,'2024-06-20 20:55:13',NULL,NULL),(26,NULL,'2024-06-22 18:11:02',NULL,NULL),(27,NULL,'2024-06-24 20:23:21',NULL,NULL),(28,NULL,'2024-06-24 20:24:24',NULL,NULL),(29,NULL,'2024-06-24 20:25:31',NULL,NULL),(30,NULL,'2024-06-24 20:28:45',NULL,NULL),(31,NULL,'2024-06-24 20:29:44',NULL,NULL),(32,NULL,'2024-06-24 20:35:40',NULL,NULL),(33,NULL,'2024-06-24 20:37:09',NULL,NULL),(34,NULL,'2024-06-24 20:42:34',NULL,NULL),(35,NULL,'2024-06-24 20:43:53',NULL,NULL),(36,NULL,'2024-06-24 20:44:22',NULL,NULL),(37,NULL,'2024-06-24 20:49:06',NULL,NULL),(38,NULL,'2024-06-24 20:49:59',NULL,NULL),(39,NULL,'2024-06-24 20:50:12',NULL,NULL),(40,'pix','2024-06-24 20:53:28',NULL,NULL),(41,'pix','2024-06-24 20:55:11',NULL,NULL),(42,'pix','2024-06-24 20:56:22',NULL,NULL),(44,'pix','2024-06-24 20:58:47',NULL,NULL),(45,'pix','2024-06-24 20:59:36',NULL,NULL),(46,'pix','2024-06-24 20:59:36',NULL,NULL),(47,'pix','2024-06-24 21:00:35',NULL,NULL),(48,'pix','2024-06-24 21:01:41',NULL,NULL),(49,'pix','2024-06-24 21:02:20',NULL,NULL),(50,'pix','2024-06-24 21:02:24',NULL,NULL),(51,'pix','2024-06-24 21:02:47',NULL,NULL),(52,'pix','2024-06-25 18:30:08',NULL,NULL),(53,'pix','2024-06-25 18:31:09',NULL,NULL),(56,'pix','2024-06-25 18:37:32',NULL,NULL),(58,'pix','2024-06-25 18:41:51',NULL,NULL),(59,'pix','2024-06-25 18:42:32',NULL,NULL),(62,'pix','2024-06-25 18:43:33',NULL,NULL),(63,'pix','2024-06-25 18:48:17',NULL,NULL),(64,'pix','2024-06-25 18:53:45',NULL,NULL),(65,'pix','2024-06-25 18:53:54',NULL,NULL),(66,'pix','2024-06-25 18:55:46',NULL,NULL),(67,'pix','2024-06-25 18:58:41',NULL,NULL),(68,'pix','2024-06-25 19:02:11',NULL,NULL),(69,'pix','2024-06-25 19:04:38',NULL,NULL),(70,'pix','2024-06-25 19:05:48',NULL,NULL),(71,'pix','2024-06-25 19:06:13',NULL,NULL),(72,'pix','2024-06-25 19:07:01',NULL,NULL),(73,'pix','2024-06-25 19:17:19',NULL,NULL),(74,'pix','2024-06-25 19:22:27',NULL,NULL),(75,'pix','2024-06-25 20:50:46',NULL,NULL);
/*!40000 ALTER TABLE `comprar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `data_log` date NOT NULL,
  `hora` time NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `cpf_cliente` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES ('2024-06-24','19:41:33','Pablo Henrique Joarez','151.086.067-37'),('2024-06-24','19:46:41','Pablo Henrique Joarez','151.086.067-37'),('2024-06-24','19:53:59','Yasmin Sofia Mendes','12.345.678-90'),('2024-06-24','20:11:40','Yasmin Sofia Mendes','12.345.678-90'),('2024-06-24','20:52:34','Pablo Henrique Joarez','151.086.067-37'),('2024-06-25','20:50:25','Hugo Daniel Medeiros','123.449.597-01');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serviços`
--

DROP TABLE IF EXISTS `serviços`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serviços` (
  `id_servico` int NOT NULL AUTO_INCREMENT,
  `nome_servico` varchar(20) DEFAULT NULL,
  `valor_servico` decimal(10,2) DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `serviços_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serviços`
--

LOCK TABLES `serviços` WRITE;
/*!40000 ALTER TABLE `serviços` DISABLE KEYS */;
/*!40000 ALTER TABLE `serviços` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cpaas_projeto'
--

--
-- Dumping routines for database 'cpaas_projeto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-25 22:12:28
