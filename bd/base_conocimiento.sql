CREATE DATABASE  IF NOT EXISTS `base_conocimiento` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `base_conocimiento`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: base_conocimiento
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autor` (
  `id` int NOT NULL,
  `autor` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (1,'autor1'),(2,'autor2'),(3,'autor3'),(4,'autor4');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coleccion`
--

DROP TABLE IF EXISTS `coleccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coleccion` (
  `id` int NOT NULL,
  `coleccion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coleccion`
--

LOCK TABLES `coleccion` WRITE;
/*!40000 ALTER TABLE `coleccion` DISABLE KEYS */;
INSERT INTO `coleccion` VALUES (1,'GENERAL'),(2,'RESERVA'),(3,'CONSULTA'),(4,'REFERENCIA');
/*!40000 ALTER TABLE `coleccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `correo`
--

DROP TABLE IF EXISTS `correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `correo` (
  `id` int NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_correo_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_correo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correo`
--

LOCK TABLES `correo` WRITE;
/*!40000 ALTER TABLE `correo` DISABLE KEYS */;
INSERT INTO `correo` VALUES (1,'usuario1@correo.com','1000000000'),(2,'usuario2@correo.com','2000000000'),(3,'usuario5@correo.com','5000000000');
/*!40000 ALTER TABLE `correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editorial`
--

DROP TABLE IF EXISTS `editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editorial` (
  `id` int NOT NULL,
  `editorial` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editorial`
--

LOCK TABLES `editorial` WRITE;
/*!40000 ALTER TABLE `editorial` DISABLE KEYS */;
INSERT INTO `editorial` VALUES (1,'PLANETA'),(2,'NORMA'),(3,'SANTILLANA'),(4,'MCGRAW-GILL');
/*!40000 ALTER TABLE `editorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lib_autor`
--

DROP TABLE IF EXISTS `lib_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lib_autor` (
  `id` int NOT NULL,
  `libro_id` varchar(10) NOT NULL,
  `autor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lib_autor_libro1_idx` (`libro_id`),
  KEY `fk_lib_autor_autor1_idx` (`autor_id`),
  CONSTRAINT `fk_lib_autor_autor1` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`),
  CONSTRAINT `fk_lib_autor_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_autor`
--

LOCK TABLES `lib_autor` WRITE;
/*!40000 ALTER TABLE `lib_autor` DISABLE KEYS */;
INSERT INTO `lib_autor` VALUES (1,'1',1),(2,'1',2),(3,'2',3),(4,'3',4),(7,'4',4),(8,'5',4),(9,'6',2),(10,'7',1),(11,'8',4),(12,'9',1),(13,'10',1);
/*!40000 ALTER TABLE `lib_autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lib_estado`
--

DROP TABLE IF EXISTS `lib_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lib_estado` (
  `id` int NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_estado`
--

LOCK TABLES `lib_estado` WRITE;
/*!40000 ALTER TABLE `lib_estado` DISABLE KEYS */;
INSERT INTO `lib_estado` VALUES (1,'DISPONIBLE'),(2,'PRESTADO'),(3,'RESERVADO'),(4,'EN_REPARACION');
/*!40000 ALTER TABLE `lib_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro` (
  `id` varchar(10) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `editorial_id` int NOT NULL,
  `lib_estado_id` int NOT NULL,
  `coleccion_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_libro_editorial1_idx` (`editorial_id`),
  KEY `fk_libro_lib_estado1_idx` (`lib_estado_id`),
  KEY `fk_libro_coleccion1_idx` (`coleccion_id`),
  CONSTRAINT `fk_libro_coleccion1` FOREIGN KEY (`coleccion_id`) REFERENCES `coleccion` (`id`),
  CONSTRAINT `fk_libro_editorial1` FOREIGN KEY (`editorial_id`) REFERENCES `editorial` (`id`),
  CONSTRAINT `fk_libro_lib_estado1` FOREIGN KEY (`lib_estado_id`) REFERENCES `lib_estado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES ('1','LIBRO 1 MATEMATICAS',1,1,1),('10','LIBRO 10 ALGEBRA',4,1,1),('2','LIRBO 2 LENGUAJE',2,2,2),('3','LIBRO 3 BIOLOGIA',3,2,2),('4','LIBRO 4 FISICA',3,4,4),('5','LIBRO 5 QUIMICA',2,1,3),('6','LIBRO 6 MATEMATICAS 2',1,2,2),('7','LIBRO 7 MATEMATICAS 3',1,1,3),('8','LIBRO 8 FISICA II',4,1,1),('9','LIBRO 9 PROGRAMACION',4,3,1);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_regla`
--

DROP TABLE IF EXISTS `obj_regla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_regla` (
  `id` int NOT NULL,
  `objeto_id` int NOT NULL,
  `regla_id` int NOT NULL,
  `obj_tipo_id` int NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_obj_regla_regla_idx` (`regla_id`),
  KEY `fk_obj_regla_objeto1_idx` (`objeto_id`),
  KEY `fk_obj_regla_obj_tipo1_idx` (`obj_tipo_id`),
  CONSTRAINT `fk_obj_regla_obj_tipo1` FOREIGN KEY (`obj_tipo_id`) REFERENCES `obj_tipo` (`id`),
  CONSTRAINT `fk_obj_regla_objeto1` FOREIGN KEY (`objeto_id`) REFERENCES `objeto` (`id`),
  CONSTRAINT `fk_obj_regla_regla` FOREIGN KEY (`regla_id`) REFERENCES `regla` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_regla`
--

LOCK TABLES `obj_regla` WRITE;
/*!40000 ALTER TABLE `obj_regla` DISABLE KEYS */;
INSERT INTO `obj_regla` VALUES (1,2,1,0,'exitosa'),(2,3,1,0,'apto'),(3,7,1,0,'autorizado'),(4,1,1,1,'aprobado'),(5,2,2,0,'no_exitosa'),(6,1,2,1,'no_aprobado'),(7,3,3,0,'no_apto'),(8,1,3,1,'no_aprobado'),(9,7,4,0,'no_autorizado'),(10,1,4,1,'no_aprobado'),(11,4,5,0,'valido'),(12,5,5,0,'disponible'),(13,6,5,0,'externa'),(14,3,5,1,'apto'),(15,8,6,0,'registrado'),(16,9,6,0,'no_excede'),(17,10,6,0,'no_vigente'),(18,7,6,1,'autorizado'),(19,4,7,0,'no_valido'),(20,3,7,1,'no_apto'),(21,5,8,0,'no_disponible'),(22,3,8,1,'no_apto'),(23,6,9,0,'en_sala'),(24,3,9,1,'no_apto'),(25,8,10,0,'no_registrado'),(26,7,10,1,'no_autorizado'),(27,9,11,0,'excede'),(28,7,11,1,'no_autorizado'),(29,10,12,0,'vigente'),(30,7,12,1,'no_autorizado');
/*!40000 ALTER TABLE `obj_regla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_tipo`
--

DROP TABLE IF EXISTS `obj_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_tipo` (
  `id` int NOT NULL,
  `des` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_tipo`
--

LOCK TABLES `obj_tipo` WRITE;
/*!40000 ALTER TABLE `obj_tipo` DISABLE KEYS */;
INSERT INTO `obj_tipo` VALUES (0,'PREMISA'),(1,'CONCLUSION');
/*!40000 ALTER TABLE `obj_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objeto`
--

DROP TABLE IF EXISTS `objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objeto` (
  `id` int NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objeto`
--

LOCK TABLES `objeto` WRITE;
/*!40000 ALTER TABLE `objeto` DISABLE KEYS */;
INSERT INTO `objeto` VALUES (1,'PRESTAMO'),(2,'BUSQUEDA'),(3,'LIBRO'),(4,'CODIGO'),(5,'ESTADO'),(6,'CONSULTA'),(7,'USUARIO'),(8,'ID'),(9,'PRES_PEN'),(10,'SANCION');
/*!40000 ALTER TABLE `objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pres_estado`
--

DROP TABLE IF EXISTS `pres_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pres_estado` (
  `id` int NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pres_estado`
--

LOCK TABLES `pres_estado` WRITE;
/*!40000 ALTER TABLE `pres_estado` DISABLE KEYS */;
INSERT INTO `pres_estado` VALUES (0,'PENDIENTE'),(1,'FINALIZADO'),(2,'VENCIDO');
/*!40000 ALTER TABLE `pres_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestamo` (
  `id` int NOT NULL,
  `p_fecha` date NOT NULL,
  `libro_id` varchar(10) NOT NULL,
  `usuario_id` varchar(10) NOT NULL,
  `lim_fecha` date NOT NULL,
  `dev_fecha` date DEFAULT NULL,
  `pres_estado_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prestamo_pres_estado1_idx` (`pres_estado_id`),
  KEY `fk_prestamo_usuario1_idx` (`usuario_id`),
  KEY `fk_prestamo_libro1_idx` (`libro_id`),
  CONSTRAINT `fk_prestamo_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`),
  CONSTRAINT `fk_prestamo_pres_estado1` FOREIGN KEY (`pres_estado_id`) REFERENCES `pres_estado` (`id`),
  CONSTRAINT `fk_prestamo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES `prestamo` WRITE;
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` VALUES (1,'2021-09-13','1','1000000000','2021-09-20','2021-09-20',1),(2,'2021-09-14','2','2000000000','2021-09-21','2021-09-17',1),(3,'2021-09-15','3','3000000000','2021-09-22','2021-09-23',2),(4,'2021-09-20','1','1000000000','2021-09-27','2021-09-27',1),(5,'2021-09-21','2','1000000000','2021-09-28','2021-09-27',1),(6,'2021-09-23','3','4000000000','2021-09-30','2021-10-01',2),(7,'2021-09-27','1','2000000000','2021-10-04','2021-10-05',2),(8,'2021-09-27','2','2000000000','2021-10-04','2021-10-06',2),(9,'2021-09-28','6','2000000000','2021-10-05','2021-10-07',2),(10,'2021-10-01','3','5000000000','2021-10-08','2021-10-02',1),(11,'2021-10-06','2','5000000000','2021-10-13','2021-10-07',1),(12,'2021-10-06','6','5000000000','2021-10-13','2021-10-07',1),(13,'2021-10-08','6','1000000000','2021-10-15',NULL,0),(14,'2021-10-08','3','1000000000','2021-10-15',NULL,0),(15,'2021-10-08','2','1000000000','2021-10-15',NULL,0);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regla`
--

DROP TABLE IF EXISTS `regla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regla` (
  `id` int NOT NULL,
  `des` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regla`
--

LOCK TABLES `regla` WRITE;
/*!40000 ALTER TABLE `regla` DISABLE KEYS */;
INSERT INTO `regla` VALUES (1,'R1'),(2,'R2'),(3,'R3'),(4,'R4'),(5,'R5'),(6,'R6'),(7,'R7'),(8,'R8'),(9,'R9'),(10,'R10'),(11,'R11'),(12,'R12');
/*!40000 ALTER TABLE `regla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `san_estado`
--

DROP TABLE IF EXISTS `san_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `san_estado` (
  `id` int NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `san_estado`
--

LOCK TABLES `san_estado` WRITE;
/*!40000 ALTER TABLE `san_estado` DISABLE KEYS */;
INSERT INTO `san_estado` VALUES (0,'PENDIENTE'),(1,'PAGADO'),(2,'CUMPLIDO');
/*!40000 ALTER TABLE `san_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `san_tipo`
--

DROP TABLE IF EXISTS `san_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `san_tipo` (
  `id` int NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `san_tipo`
--

LOCK TABLES `san_tipo` WRITE;
/*!40000 ALTER TABLE `san_tipo` DISABLE KEYS */;
INSERT INTO `san_tipo` VALUES (0,'leve'),(1,'grave');
/*!40000 ALTER TABLE `san_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sancion`
--

DROP TABLE IF EXISTS `sancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sancion` (
  `id` int NOT NULL,
  `s_fecha` date NOT NULL,
  `prestamo_id` int NOT NULL,
  `san_tipo_id` int NOT NULL,
  `des` varchar(100) NOT NULL,
  `valor` float DEFAULT NULL,
  `pago_fecha` date DEFAULT NULL,
  `lev_fecha` date NOT NULL,
  `san_estado_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sancion_san_estado1_idx` (`san_estado_id`),
  KEY `fk_sancion_prestamo1_idx` (`prestamo_id`),
  KEY `fk_sancion_san_tipo1_idx` (`san_tipo_id`),
  CONSTRAINT `fk_sancion_prestamo1` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamo` (`id`),
  CONSTRAINT `fk_sancion_san_estado1` FOREIGN KEY (`san_estado_id`) REFERENCES `san_estado` (`id`),
  CONSTRAINT `fk_sancion_san_tipo1` FOREIGN KEY (`san_tipo_id`) REFERENCES `san_tipo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sancion`
--

LOCK TABLES `sancion` WRITE;
/*!40000 ALTER TABLE `sancion` DISABLE KEYS */;
INSERT INTO `sancion` VALUES (1,'2021-09-23',3,0,'retraso en devolución 1 dia',500,'2021-09-23','2021-09-25',2),(2,'2021-10-01',6,0,'retraso en devolución 1 dia',500,NULL,'2021-11-19',0),(3,'2021-10-05',7,0,'retraso en devolución 1 dia',500,'2021-10-07','2021-11-19',2),(4,'2021-10-06',8,0,'retraso en devolución 2 dias',1000,'2021-10-07','2021-11-19',2),(5,'2021-10-07',9,0,'retraso en devolución 2 dias',1000,'2021-10-07','2021-11-19',2),(6,'2021-10-07',7,1,'registro e 3 sanciones ref sancion 3 - 4 -5, prestamo 7-8-9',2500,NULL,'2021-11-19',0);
/*!40000 ALTER TABLE `sancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `direccion` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('1000000000','nombre1','apellido1','1990-01-01','1111111111','direccion1'),('2000000000','nombre2','apellido2','1994-01-02','2222222222','direccion2'),('3000000000','nombre3','apellido3','1998-01-03','3333333333','direccion3'),('4000000000','nombre4','apellido4','2001-01-04','4444444444','direccion4'),('5000000000','nombre5','apellido5','2003-01-05','5555555555','direccion5');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-10 21:11:28
