-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: driedFruitsOfTurkey
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB-6

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
-- Table structure for table `availableGoods`
--

DROP TABLE IF EXISTS `availableGoods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `availableGoods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `weight` float DEFAULT '0',
  `pricePerKilo` float DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`(20))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `availableGoods`
--

LOCK TABLES `availableGoods` WRITE;
/*!40000 ALTER TABLE `availableGoods` DISABLE KEYS */;
INSERT INTO `availableGoods` VALUES (1,'Apricots(organic)',40,2),(2,'Apricots(sulphured)',27,4),(3,'Raisins(organic)',94,3);
/*!40000 ALTER TABLE `availableGoods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balance`
--

DROP TABLE IF EXISTS `balance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balance` (
  `id` int(10) unsigned NOT NULL,
  `balanceUSD` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balance`
--

LOCK TABLES `balance` WRITE;
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` VALUES (8,0),(12,0),(18,0),(25,0),(35,0),(50,0),(90,0),(91,0),(92,1104),(93,0),(94,357),(95,21.197),(96,0),(97,0),(98,186),(99,93),(100,0),(101,0),(102,10),(103,0),(104,0),(105,0),(106,0),(107,0),(108,0),(109,23),(110,0),(111,0),(112,37),(113,0),(114,61);
/*!40000 ALTER TABLE `balance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balanceFilling`
--

DROP TABLE IF EXISTS `balanceFilling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balanceFilling` (
  `id` int(10) unsigned DEFAULT NULL,
  `cardNumber` int(10) unsigned DEFAULT NULL,
  `sum` float DEFAULT '0',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balanceFilling`
--

LOCK TABLES `balanceFilling` WRITE;
/*!40000 ALTER TABLE `balanceFilling` DISABLE KEYS */;
INSERT INTO `balanceFilling` VALUES (94,2525,100,'2017-10-26 21:44:37'),(94,2525,100,'2017-10-26 21:46:44'),(95,2525,100,'2017-10-27 00:04:28'),(95,2525,100,'2017-10-27 00:26:33'),(95,2525,50,'2017-10-27 21:30:11'),(95,2525,50,'2017-10-27 21:30:56'),(95,2525,241,'2017-10-27 21:31:44'),(96,2525,6,'2017-10-27 21:43:05'),(96,2525,1000,'2017-10-27 21:50:35'),(95,2525,800,'2017-10-28 21:23:03'),(95,2525,1000,'2017-10-29 21:30:17'),(99,2525,100,'2017-11-01 20:02:18'),(98,2525,200,'2017-11-01 20:03:00'),(95,2525,505,'2017-11-03 17:30:35'),(102,2525,100,'2017-11-04 15:34:02'),(109,2525,100,'2017-11-12 00:33:51'),(109,2525,10,'2017-11-14 01:27:38'),(109,2525,10,'2017-11-14 01:33:16'),(109,2525,1,'2017-11-14 01:33:44'),(112,2525,100,'2017-11-27 23:42:11'),(114,2525,100,'2017-12-27 12:01:41');
/*!40000 ALTER TABLE `balanceFilling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `number` char(16) NOT NULL,
  `balanceUSD` float DEFAULT '0',
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES ('2525',3475);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dataChange`
--

DROP TABLE IF EXISTS `dataChange`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dataChange` (
  `id` int(10) unsigned DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `surname` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dataChange`
--

LOCK TABLES `dataChange` WRITE;
/*!40000 ALTER TABLE `dataChange` DISABLE KEYS */;
INSERT INTO `dataChange` VALUES (95,'b','b','b','b','female','5bb3a8b1bc146abd584ba888b23522d0','2017-10-26 22:11:03'),(95,'b','b','b','b','male','5bb3a8b1bc146abd584ba888b23522d0','2017-10-26 22:11:23'),(95,'ball','b','b','b','female','5bb3a8b1bc146abd584ba888b23522d0','2017-10-26 22:11:33'),(96,'f','f','f','f','male','daff683ec23cedb8db13b4f4ec18b03f','2017-10-27 21:42:30'),(96,'for','f','f','f','male','daff683ec23cedb8db13b4f4ec18b03f','2017-10-27 21:42:45'),(97,'bn','bn','bn','bn','female','b8a8ebc08922b56965c5ad91253371e7','2017-10-27 23:26:08'),(95,'ball','b','b','b','male','5bb3a8b1bc146abd584ba888b23522d0','2017-11-03 22:49:15'),(102,'Sulaymon','Hursanov','sul@.ru','+7799898','male','2112223b783b863554cd2549165c1aee','2017-11-04 15:33:10'),(109,'fhl','fjl','h@.h','+2332365526','male','517662722c14a87e588082777bd4dc0a','2017-11-11 23:02:53'),(109,'fhl','f5','h@.h','+2332365526','male','517662722c14a87e588082777bd4dc0a','2017-11-11 23:03:22'),(109,'Ason','f5','h@.h','+2332365526','male','517662722c14a87e588082777bd4dc0a','2017-11-11 23:05:51'),(112,'sko','sko','sko@sko.sko','+222222222','female','cc32bb3fdd469181f05c78e895c8550b','2017-11-27 21:51:56'),(112,'skobeltsyn','sko','sko@sko.sko','+222222222','male','cc32bb3fdd469181f05c78e895c8550b','2017-11-27 22:03:45'),(114,'hhh','hhh','1@mail.ru','+11111311313','male','c6dc8bd6fd5a707e960020beb8636512','2017-12-27 12:00:33');
/*!40000 ALTER TABLE `dataChange` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goodOwners`
--

DROP TABLE IF EXISTS `goodOwners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goodOwners` (
  `userID` int(10) unsigned DEFAULT NULL,
  `goodID` int(10) unsigned DEFAULT NULL,
  `weight` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goodOwners`
--

LOCK TABLES `goodOwners` WRITE;
/*!40000 ALTER TABLE `goodOwners` DISABLE KEYS */;
INSERT INTO `goodOwners` VALUES (92,1,1254),(92,2,365),(66,1,1013),(66,2,11),(94,1,141),(94,2,137),(95,3,500),(95,2,745.601),(95,1,22),(96,2,2),(96,1,250),(99,1,1),(99,2,1),(98,1,2),(98,2,2),(102,1,10),(102,2,20),(109,2,7),(109,1,7),(112,2,15),(112,1,2),(112,3,1),(114,1,10),(114,2,1),(114,3,5);
/*!40000 ALTER TABLE `goodOwners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `surname` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_2` (`email`),
  KEY `name` (`name`(20)),
  KEY `surname` (`surname`(20)),
  KEY `email` (`email`(20)),
  KEY `name_2` (`name`(20)),
  KEY `tel` (`tel`),
  KEY `gender` (`gender`(1))
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (101,'as','as','as','as','female','1de7dbafc3b6041699aa46802696506a','2017-11-03 22:49:36'),(94,'Doll','Jerry','a','85555','female','34ee7797f66b9571520ca733d9d5fbc3','2017-10-26 01:59:09'),(63,'Dried fruits',NULL,NULL,NULL,NULL,NULL,NULL),(100,'admin','admin','administrator@gmail.','admin','male','37eed544094160deadb5b641f3332679','2017-11-03 22:37:00'),(96,'for one','f','f','f','male','daff683ec23cedb8db13b4f4ec18b03f','2017-10-27 21:42:03'),(97,'sd','bn','bn','bn','male','b8a8ebc08922b56965c5ad91253371e7','2017-10-27 23:24:11'),(98,'a1','a2','a1','a1','male','7266adb9d0578140b2b9719e1c926479','2017-11-01 20:01:18'),(99,'b1','b2','b1','b1','female','a9627c13d5cc94ccb2d6464ee2ca2e33','2017-11-01 20:01:52'),(114,'hhh','ddd','1@mail.ru','+11111311313','male','c6dc8bd6fd5a707e960020beb8636512','2017-12-27 11:59:13'),(113,'Sdk','Sdk','sdk@sdk.sdk','+33333333333','male','4727502619f3d9d5be11108a4611dfdc','2017-11-27 22:14:38'),(112,'skobeltsyn','skol','sko@sko.sko','+222222222','male','cc32bb3fdd469181f05c78e895c8550b','2017-11-27 01:33:11'),(111,'git','git','git@git.git','+111111111','male','7aca412ca7e0bbac71811a52befce8bd','2017-11-27 01:24:22'),(110,'root','root','root@root.root','+666666666','female','1c12c97f5386d7b2d956250046a09a30','2017-11-15 20:33:05'),(109,'Ason','f5','h@.h','+2332365526','male','517662722c14a87e588082777bd4dc0a','2017-11-11 22:48:32'),(108,'asdasf','asfasd','as.@ds','+65665','male','9ebdf75cb5b7fe9fe7554bdd4778d47a','2017-11-10 00:04:12'),(107,'aaaa','aaaa','aaa.@','+222','male','c014e4ccbd517f96dac7d4956f31c463','2017-11-10 00:01:02'),(106,'lkl\'','adsad\'asda','kasal','656565','female','bdadb50dc1b5624ef02fa6d0f08152a1','2017-11-09 23:03:14'),(105,'sd','sd','fd.@asfaf','+46545212154','male','abadc8c4acab71a26c2817da91b06b4f','2017-11-08 22:40:35'),(104,'d','df','ds@.r','+54513516565','male','cceb235736ce6429bde05f7ad3c4b5ad','2017-11-08 22:27:34'),(103,'a','a','s.@','+998565659','male','6629dcf415cd08b6ef7fbca00bbf8001','2017-11-08 22:22:41'),(102,'Sulaymon','H','sul@.ru','+7799898','male','2112223b783b863554cd2549165c1aee','2017-11-04 15:29:08'),(95,'hall','b','b','b','male','5bb3a8b1bc146abd584ba888b23522d0','2017-10-26 02:05:46');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `userID` int(10) unsigned DEFAULT NULL,
  `goodID` int(10) unsigned DEFAULT NULL,
  `weight` float DEFAULT '0',
  `priceUSD` float DEFAULT '0',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (94,2,2,3,'2017-10-26 21:23:44'),(94,2,2,3,'2017-10-26 21:23:48'),(94,2,2,3,'2017-10-26 21:23:57'),(94,2,2,3,'2017-10-26 21:24:00'),(94,2,2,3,'2017-10-26 21:24:04'),(94,2,1,3,'2017-10-26 21:24:24'),(94,2,1,3,'2017-10-26 21:24:29'),(94,2,1,3,'2017-10-26 21:24:32'),(94,2,1,3,'2017-10-26 21:24:34'),(94,1,1,4,'2017-10-26 21:26:23'),(94,1,1,4,'2017-10-26 21:26:29'),(94,2,1,3,'2017-10-26 21:26:37'),(94,2,1,3,'2017-10-26 21:27:05'),(94,2,1,3,'2017-10-26 21:27:09'),(94,2,1,3,'2017-10-26 21:27:12'),(94,2,1,3,'2017-10-26 21:27:15'),(94,2,1,3,'2017-10-26 21:27:24'),(94,1,1,4,'2017-10-26 21:28:33'),(94,1,1,4,'2017-10-26 21:28:39'),(94,1,1,4,'2017-10-26 21:28:41'),(94,1,1,4,'2017-10-26 21:30:32'),(94,1,1,4,'2017-10-26 21:30:49'),(94,1,2,4,'2017-10-26 21:30:59'),(95,3,2,1,'2017-10-27 00:26:55'),(95,2,7,3,'2017-10-27 00:27:03'),(95,1,5,4,'2017-10-27 00:27:19'),(95,3,157,1,'2017-10-27 17:10:38'),(95,3,50,1,'2017-10-27 21:31:21'),(95,3,291,1,'2017-10-27 21:31:53'),(96,2,2,3,'2017-10-27 21:43:12'),(96,1,250,4,'2017-10-27 21:50:42'),(95,2,200,3,'2017-10-28 21:23:17'),(95,2,50,3,'2017-10-28 21:23:24'),(95,1,10,4,'2017-10-28 21:23:39'),(95,2,300,3,'2017-10-29 21:30:27'),(95,2,30,3,'2017-10-29 21:30:38'),(95,2,5,3,'2017-10-29 21:30:55'),(95,2,1.2,3,'2017-10-29 21:31:09'),(95,2,0.4,3,'2017-10-29 21:31:21'),(95,2,0.001,3,'2017-10-29 21:31:35'),(99,1,1,4,'2017-11-01 20:02:27'),(99,2,1,3,'2017-11-01 20:02:32'),(98,1,2,4,'2017-11-01 20:03:08'),(98,2,2,3,'2017-11-01 20:03:12'),(95,2,150,3,'2017-11-03 17:30:48'),(95,2,2,3,'2017-11-03 17:33:34'),(95,1,5,4,'2017-11-03 17:33:53'),(95,1,2,4,'2017-11-03 17:35:35'),(102,1,10,1,'2017-11-04 15:34:14'),(102,2,20,4,'2017-11-04 15:34:29'),(109,2,1,4,'2017-11-12 01:35:56'),(109,2,1,4,'2017-11-12 01:49:03'),(109,1,1,10,'2017-11-12 01:49:14'),(109,1,1,10,'2017-11-14 01:27:11'),(109,1,1,10,'2017-11-14 03:40:23'),(109,1,1,10,'2017-11-14 03:55:25'),(109,1,1,10,'2017-11-14 03:57:20'),(109,2,5,4,'2017-11-14 03:57:40'),(109,1,1,10,'2017-11-15 03:25:25'),(109,1,1,10,'2017-11-15 16:33:23'),(112,2,5,4,'2017-11-27 23:42:17'),(112,2,10,4,'2017-11-27 23:42:25'),(112,1,1,1,'2017-11-27 23:42:36'),(112,1,1,1,'2017-11-27 23:50:44'),(112,3,1,1,'2017-11-28 13:16:19'),(114,1,10,2,'2017-12-27 12:01:50'),(114,2,0,4,'2017-12-27 12:02:34'),(114,2,1,4,'2017-12-27 12:03:08'),(114,3,5,3,'2017-12-27 12:03:17');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-30  1:57:39
