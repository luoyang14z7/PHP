-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: coffee
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adminusers`
--

DROP TABLE IF EXISTS `adminusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminusers` (
  `username` varchar(20) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminusers`
--

LOCK TABLES `adminusers` WRITE;
/*!40000 ALTER TABLE `adminusers` DISABLE KEYS */;
INSERT INTO `adminusers` VALUES ('admin',123456);
/*!40000 ALTER TABLE `adminusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartdetail`
--

DROP TABLE IF EXISTS `cartdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartdetail` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `cartid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartdetail`
--

LOCK TABLES `cartdetail` WRITE;
/*!40000 ALTER TABLE `cartdetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetail` (
  `opid` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`opid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetail`
--

LOCK TABLES `orderdetail` WRITE;
/*!40000 ALTER TABLE `orderdetail` DISABLE KEYS */;
INSERT INTO `orderdetail` VALUES (7,4,3,1),(8,4,2,1),(9,5,1,1),(10,5,2,1),(11,6,1,1),(12,6,2,1),(13,7,1,1),(14,7,2,1),(15,8,2,2),(16,9,2,2),(17,10,2,2);
/*!40000 ALTER TABLE `orderdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderlist`
--

DROP TABLE IF EXISTS `orderlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderlist` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `oname` varchar(32) DEFAULT NULL,
  `ophone` varchar(64) DEFAULT NULL,
  `oaddress` varchar(64) DEFAULT NULL,
  `opay` varchar(32) DEFAULT NULL,
  `oprice` int(11) DEFAULT NULL,
  `otime` bigint(20) DEFAULT NULL,
  `ostate` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderlist`
--

LOCK TABLES `orderlist` WRITE;
/*!40000 ALTER TABLE `orderlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(32) DEFAULT NULL,
  `ptitle` varchar(64) DEFAULT NULL,
  `pinfo` varchar(128) DEFAULT NULL,
  `pOrigin` varchar(16) DEFAULT NULL,
  `pwork` varchar(16) DEFAULT NULL,
  `ptasty` varchar(64) DEFAULT NULL,
  `pacidity` varchar(16) DEFAULT NULL,
  `palcohol` varchar(16) DEFAULT NULL,
  `pmfood` varchar(64) DEFAULT NULL,
  `plike` varchar(32) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  `bmimg` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'凤舞祥云综合','均衡的风味带有草本和可可粉的香味','这款与众不同的综合咖啡是首款采用中国云南保山地区的咖啡豆和其他来自亚洲、太平洋地区的咖啡混合制成的综合咖啡豆。','亚洲/太平洋','水洗法/半水洗法','温和清爽的酸度，中等醇度，均衡的风味并带有草本和可可粉的香味','较低','中等','奶油芝士类食品，太妃、枫糖和坚果类食品','低因祥龙综合咖啡®',299,'images/p13.jpg','images/lp13.jpg'),(2,'哥伦比亚','果仁味，可可味','醇度适中，口感顺滑平和，喝下去满口丰盈，并留下清脆而带有坚果的回味。','拉丁美洲','水洗法','果仁味，可可味','中等','中等','胡桃，山核桃，焦糖','首选咖啡、危地马拉安提瓜咖啡',399,'images/p2.jpg','images/lp2.jpg'),(3,'综合咖啡豆','清爽，且极为平和','首选咖啡是一款中等醇度的拉丁美洲综合咖啡，其特点是具有活泼的酸度，以及清爽且极为平和的风味。','拉丁美洲','水洗法','清爽，且极为平和','中等','中等','果仁，苹果，蓝莓','危地马拉安提瓜咖啡',399,'images/p6.jpg','images/lp6.jpg'),(4,'派克市场®烘焙','可可味，烘烤果仁味','中等醇度并伴随着可可和烤果仁的微妙风味，呈现出一杯令人愉悦而口感平衡的咖啡。','拉丁美洲','水洗法','可可味，烘烤果仁味','中等','中等','巧克力，肉桂，果仁','首选咖啡、危地马拉安提瓜咖啡',399,'images/p10.jpg','images/lp10.jpg'),(5,'肯亚','葡萄柚味，浆果味','肯亚咖啡拥有多层次复杂的风味，包含果汁般的酸度、明显的葡萄柚味和葡萄酒的醇香，醇度中等。','非洲/阿拉伯','水洗法','葡萄柚味，浆果味','较高','中等','葡萄柚，浆果，无核葡萄干，葡萄干','埃塞俄比亚斯丹摩咖啡',399,'images/p8.jpg','images/lp8.jpg'),(6,'危地马拉安提瓜','可可味，香料味','这是一款典雅、丰富并具有深度的咖啡，其精致的酸度与微妙的可可粉质感以及柔和的香料风味完美地平衡在了一起。','拉丁美洲','水洗法','可可味，香料味','中等','中等','可可，苹果，焦糖，果仁','首选咖啡',399,'images/p5.jpg','images/lp5.jpg'),(7,'早餐综合','明亮，香气扑鼻','这款醇度清淡的综合咖啡活泼而清爽，唤醒你的味蕾，带给你明快的第一印象，让你焕然一新，开始新的一天。','拉丁美洲','水洗法','明亮，香气扑鼻','较高','清淡','果仁，苹果，蓝莓，柠檬','首选咖啡，危地马拉安提瓜咖啡',399,'images/p1.jpg','images/lp1.jpg'),(8,'埃塞俄比亚','柑橘，可可味','这款醇度清淡的综合咖啡活泼而清爽，唤醒你的味蕾，带给你明快的第一印象，让你焕然一新，开始新的一天。','拉丁美洲','水洗法','明亮，香气扑鼻','较高','清淡','果仁，苹果，蓝莓，柠檬','首选咖啡，危地马拉安提瓜咖啡',399,'images/p4.jpg','images/lp4.jpg'),(9,'意式烘焙','烘烤甜味，淡淡的烟熏味','这是一款醇度浓郁的多区域综合咖啡，经过比浓缩烘焙咖啡更深度的烘焙，它浓烈而香甜，并带有淡淡的烟熏风味。','多区域','水洗法','烘烤甜味，淡淡的烟熏味','较低','中等','巧克力，焦糖，香料','浓缩烘焙咖啡，佛罗娜咖啡®',399,'images/p7.jpg','images/lp7.jpg'),(10,'浓缩烘焙','焦糖味，烘焙味','这款综合咖啡是我们所有浓缩咖啡饮料的核心，其特点是浓郁的香味以及柔和的酸度，且与浓厚的焦糖香甜味平衡搭配。','多区域','水洗法','焦糖味，烘焙味','较低','厚重','焦糖，香料，巧克力，果仁','佛罗娜咖啡®，危地马拉安提瓜咖啡',399,'images/p3.jpg','images/lp3.jpg'),(11,'佛罗娜®咖啡','烘烤甜味','这是一款来自拉丁美洲咖啡和亚洲／太平洋地区咖啡的综合咖啡，醇度厚重，并带有意式烘焙咖啡的香甜味。','多区域','水洗法，半水洗法','烘烤甜味','中等','厚重','牛奶和黑巧克力、焦糖','浓缩烘焙咖啡',399,'images/p12.jpg','images/lp12.jpg'),(12,'低因祥龙综合','泥土芳香，草药味，香料味','具有浓郁的草药味、香料味和泥土芳香；这款浓郁而平和的亚洲/太平洋地区综合咖啡展现出厚重的醇度以及令人惊奇的酸度之间的良好平衡。','亚洲/太平洋','水洗法，半水洗法','泥土芳香，草药味，香料味','较低','厚重','肉桂，燕麦片，枫糖，黄油面包','苏门答腊咖啡',399,'images/p9.jpg','images/lp9.jpg'),(13,'苏门答腊','草药味，泥土芳香','带有强烈的泥土芳香，风味异常集中；醇度厚重而浓郁，苏门答腊咖啡是我们非常畅销的其中一款单品咖啡。','亚洲/太平洋','半水洗法','草药味,泥土芳香','较低','厚重','肉桂，燕麦片，枫糖，黄油，太妃糖','低因祥龙综合咖啡®',399,' images/p11.jpg',' images/lp11.jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopcart`
--

DROP TABLE IF EXISTS `shopcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopcart` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopcart`
--

LOCK TABLES `shopcart` WRITE;
/*!40000 ALTER TABLE `shopcart` DISABLE KEYS */;
INSERT INTO `shopcart` VALUES (2,'3');
/*!40000 ALTER TABLE `shopcart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uphone` varchar(24) DEFAULT NULL,
  `upwd` varchar(12) DEFAULT NULL,
  `ucid` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'13270753218','159951','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-02 14:00:34
