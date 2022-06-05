-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bdgestioncitas
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_cita` varchar(45) DEFAULT NULL,
  `fecha_cita` date DEFAULT NULL,
  `hora_cita` time DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado_idestado` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `paciente_idpaciente` int(11) NOT NULL,
  PRIMARY KEY (`idcita`),
  KEY `fk_cita_estado` (`estado_idestado`),
  KEY `fk_cita_paciente1` (`paciente_idpaciente`),
  KEY `fk_cita_usuario1` (`usuario_idusuario`),
  CONSTRAINT `fk_cita_estado` FOREIGN KEY (`estado_idestado`) REFERENCES `estado` (`idestado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_paciente1` FOREIGN KEY (`paciente_idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (1,'consulta psicologica','2022-06-01','14:00:00','tengo ganas de suicidarme pero quiero ayuda',2,7,6),(2,'consulta psicologica','2022-06-02','15:00:00','ayuda',2,7,1),(9,'Control de terapia','2022-06-01','15:00:00','escribe el asunto de la cita',2,7,1),(13,'consulta Psicologica','2022-06-01','16:00:00','escribe el asunto de la cita',2,7,1),(14,'consulta Psicologica','2022-06-02','10:00:00','escribe el asunto de la cita',2,6,1),(19,'Control de terapia','2022-06-10','14:00:00','escribe el asunto de la cita',4,7,1),(20,'Control de terapia','2022-06-10','14:00:00','escribe el asunto de la cita',4,7,10),(30,'Control de terapia','2022-06-15','15:00:00','escribe el asunto de la cita',3,6,13);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'POR ATENDER'),(2,'ATENDIDA'),(3,'CANCELADA POR PACIENTE'),(4,'CANCELADA POR PRACTICANTE');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_horario`
--

DROP TABLE IF EXISTS `estado_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_horario` (
  `id_estado` int(11) NOT NULL,
  `estado_horariocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_horario`
--

LOCK TABLES `estado_horario` WRITE;
/*!40000 ALTER TABLE `estado_horario` DISABLE KEYS */;
INSERT INTO `estado_horario` VALUES (1,'DISPONIBLE'),(2,'OCUPADO');
/*!40000 ALTER TABLE `estado_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fecha_horario`
--

DROP TABLE IF EXISTS `fecha_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fecha_horario` (
  `id_fecha` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id_fecha`),
  KEY `fk_fecha_horario_usuario1` (`usuario_idusuario`),
  CONSTRAINT `fk_fecha_horario_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fecha_horario`
--

LOCK TABLES `fecha_horario` WRITE;
/*!40000 ALTER TABLE `fecha_horario` DISABLE KEYS */;
INSERT INTO `fecha_horario` VALUES (1,'2022-06-01',7),(2,'2022-06-01',6),(3,'2022-06-02',7),(7,'2022-06-02',6),(8,'2022-06-03',7),(9,'2022-06-03',6),(10,'2022-06-04',6),(13,'2022-06-15',6),(14,'2022-06-10',7);
/*!40000 ALTER TABLE `fecha_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `idhorarios` int(11) NOT NULL,
  `horario` time DEFAULT NULL,
  `turno_idturno` int(11) NOT NULL,
  PRIMARY KEY (`idhorarios`),
  KEY `fk_horarios_turno1` (`turno_idturno`),
  CONSTRAINT `fk_horarios_turno1` FOREIGN KEY (`turno_idturno`) REFERENCES `turno` (`idturno`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'08:00:00',1),(2,'09:00:00',1),(3,'10:00:00',1),(4,'14:00:00',2),(5,'15:00:00',2),(6,'16:00:00',2),(7,'08:00:00',3),(8,'09:00:00',3),(9,'10:00:00',3),(10,'14:00:00',3),(11,'15:00:00',3),(12,'16:00:00',3);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(45) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `cedula_paciente` varchar(45) DEFAULT NULL,
  `usuario_paciente` varchar(45) DEFAULT NULL,
  `contraseña_paciente` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fecha_de_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (1,'andres felipe brieva pinedo','m','1997-06-19','pipebrieva@gmail.com','1083040640','brieva','123','3004992478','2022-05-23 19:41:27'),(6,'adolfo pinedo','M','2022-05-28','adolfo@gmail.com','32424000','adolfo','1234','3004992456','2022-05-29 16:48:29'),(9,'carlos sanchez','M','2022-05-03','carlos@gmail.com','1235','carlos','12345','12345','2022-05-29 17:33:10'),(10,'ronaldo torres','M','1998-04-15','ronaldo@gmail.com','1083040640','ronaldo','12345','3004992478','2022-05-29 19:19:01'),(13,'ana maria maestre rincon','F','1991-08-30','pipebrieva@gmail.com','124341415151','anamaria','ana','3004992456','2022-06-04 23:24:41');
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte` (
  `idreporte` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `cita_idcita` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idreporte`),
  KEY `fk_reporte_cita1` (`cita_idcita`),
  KEY `fk_reporte_usuario1` (`usuario_idusuario`),
  CONSTRAINT `fk_reporte_cita1` FOREIGN KEY (`cita_idcita`) REFERENCES `cita` (`idcita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reporte_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reseña`
--

DROP TABLE IF EXISTS `reseña`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reseña` (
  `idreseña` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text DEFAULT NULL,
  `cita_idcita` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `paciente_idpaciente` int(11) NOT NULL,
  PRIMARY KEY (`idreseña`),
  KEY `fk_reseña_cita1` (`cita_idcita`),
  KEY `fk_reseña_paciente1` (`paciente_idpaciente`),
  KEY `fk_reseña_usuario1` (`usuario_idusuario`),
  CONSTRAINT `fk_reseña_cita1` FOREIGN KEY (`cita_idcita`) REFERENCES `cita` (`idcita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reseña_paciente1` FOREIGN KEY (`paciente_idpaciente`) REFERENCES `paciente` (`idpaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reseña_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reseña`
--

LOCK TABLES `reseña` WRITE;
/*!40000 ALTER TABLE `reseña` DISABLE KEYS */;
/*!40000 ALTER TABLE `reseña` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (1,'mañana','turno de 3h'),(2,'tarde','turno de 3 horas'),(3,'completo','turno de 6h');
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `Tipo_Usuario` varchar(45) DEFAULT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `fecha_de_creacion` timestamp NULL DEFAULT current_timestamp(),
  `telefono` varchar(45) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `turno_idturno` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_usuario_turno1` (`turno_idturno`),
  CONSTRAINT `fk_usuario_turno1` FOREIGN KEY (`turno_idturno`) REFERENCES `turno` (`idturno`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'andres','123','ADMINISTRADOR','andres felipe brieva pinedo','pipebrieva@gmail.com','2022-05-23 16:47:02','3004992478','m',1),(6,'jose','123','PRACTICANTE','jose alejandro martinez','andresbrievafp@unimagdalena.edu.co','2022-05-29 12:35:31','3004992478','m',3),(7,'daniel','12345','PRACTICANTE','daniel vega','pipebrieva@gmail.com','2022-05-29 20:49:50','3004992478','M',2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_horario`
--

DROP TABLE IF EXISTS `usuario_has_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_horario` (
  `horarios_idhorarios` int(11) NOT NULL,
  `fecha_horario_id_fecha` int(11) NOT NULL,
  `estado_horario_id_estado` int(11) NOT NULL,
  PRIMARY KEY (`horarios_idhorarios`,`fecha_horario_id_fecha`),
  KEY `fk_usuario_has_horario_estado_horario1` (`estado_horario_id_estado`),
  KEY `fk_usuario_has_horario_fecha_horario1` (`fecha_horario_id_fecha`),
  CONSTRAINT `fk_table1_horarios1` FOREIGN KEY (`horarios_idhorarios`) REFERENCES `horarios` (`idhorarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_horario_estado_horario1` FOREIGN KEY (`estado_horario_id_estado`) REFERENCES `estado_horario` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_horario_fecha_horario1` FOREIGN KEY (`fecha_horario_id_fecha`) REFERENCES `fecha_horario` (`id_fecha`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_horario`
--

LOCK TABLES `usuario_has_horario` WRITE;
/*!40000 ALTER TABLE `usuario_has_horario` DISABLE KEYS */;
INSERT INTO `usuario_has_horario` VALUES (4,3,1),(4,8,1),(4,14,1),(5,8,1),(5,14,1),(6,3,1),(6,8,1),(6,14,1),(7,2,1),(7,7,1),(7,9,1),(7,13,1),(8,2,1),(8,7,1),(8,9,1),(8,10,1),(8,13,1),(9,2,1),(9,9,1),(9,10,1),(9,13,1),(10,2,1),(10,7,1),(10,9,1),(10,10,1),(10,13,1),(11,2,1),(11,7,1),(11,9,1),(11,10,1),(11,13,1),(12,2,1),(12,7,1),(12,9,1),(12,10,1),(12,13,1),(4,1,2),(5,1,2),(5,3,2),(6,1,2),(7,10,2),(9,7,2);
/*!40000 ALTER TABLE `usuario_has_horario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-04 22:19:28
