-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: cardonline
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

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
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card` (
  `id` varchar(30) NOT NULL,
  `userName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phoneNumber` char(30) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `theme` int DEFAULT '1',
  `descr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_img` varchar(255) DEFAULT NULL,
  `avatar_img` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES ('_nambodoi','Đoàn Quốc Nam',NULL,NULL,'0987654','1618248625','1618419835',1,'meobeo from anvui !!! :))','Hà Nội','https://scontent-hkg4-1.xx.fbcdn.net/v/t1.6435-9/p720x720/70266044_2433214133592091_2452042811206270976_n.jpg?_nc_cat=106&ccb=1-3&_nc_sid=e3f864&_nc_ohc=ohH1ONtfNLgAX8zV95E&_nc_ht=scontent-hkg4-1.xx&tp=6&oh=12704eaa6ba3f10a77c70c14c14a1327&oe=609ADFE8','https://scontent-hkg4-1.xx.fbcdn.net/v/t1.6435-9/119846793_2759195557660612_3092987857039832214_n.jpg?_nc_cat=101&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=soReGe1uA1IAX-5ulJE&_nc_ht=scontent-hkg4-1.xx&oh=3e222c6a41907fd1040cfe9e326caeb5&oe=609AE6B7',NULL),('_nambodoia','nam doan quoc','namdqa.1998@gmail.com','$2y$10$gJ7CvchTdwCq5/w/z2MyceneM2igRvl7y7qSzL.HQ6aarw5xICmsO',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('_namdz','namdz','namdz@gmail.com','$2y$10$v0RdNtz4v4Lo/6YU2XWHMeo/R/V3.uQvfB9fgybd2tfgWV/x4pa2G',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('110798','Đoàn Quốc Nam','namdoanquoc.1998@gmail.com','','0386055556',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('123','namdq','namdq@gmail.com','$2y$10$Q8eIsEcye2HjIfvehNGUTeeEwu4KptfK.wOaZFqud.08LGP.a2g6S',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('nam1998','namdzzzz',NULL,NULL,'0987654','2021-04-12 16:00:05','1618248587',1,NULL,NULL,NULL,NULL,NULL),('namdq','namdq','namdq.1998@gmail.com','$2y$10$D2Wps28Irym4XQPNwQLu9ecEBOZ8Q4RnYKxCiy5VV5I02AsvkLKTy',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,'cuxp35F1eYFWBYy7TQwzLX7cPoTPPvsJEqcTURz8bbrnCBCxVmdd5yNsNTVx'),('namdq_1998','nam',NULL,NULL,NULL,'1618243582','1618243582',1,NULL,NULL,NULL,NULL,NULL),('namdq1','nam doan quoc','namdq1998@gmail.com','$2y$10$N1QeXi50e0D6BFX/5jXEFuyGaa2bOrk74QxZO5gir4YiQhZrbKfIm',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),('namdz','namdq',NULL,NULL,'0386055556','2021-04-12 15:49:08','2021-04-12 15:49:08',1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card_links`
--

DROP TABLE IF EXISTS `card_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_links` (
  `link_id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `link` varchar(120) DEFAULT NULL,
  `card_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`link_id`),
  KEY `card_id` (`card_id`),
  CONSTRAINT `card_links_ibfk_1` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_links`
--

LOCK TABLES `card_links` WRITE;
/*!40000 ALTER TABLE `card_links` DISABLE KEYS */;
INSERT INTO `card_links` VALUES (1,'facebook','https://www.facebook.com/quocnam117/','_nambodoi'),(2,'tiktok','https://www.tiktok.com/vi-VN/','_nambodoi'),(3,'instargram','https://www.instagram.com/','_nambodoi'),(4,'youtube','https://www.youtube.com/','_nambodoi'),(5,'phone','0386055556','_nambodoi'),(6,'gmail','namdoanquoc.1998@gmail.com','_nambodoi');
/*!40000 ALTER TABLE `card_links` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-19 13:24:04
