-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: shop_200292
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `Cat_ID` varchar(10) NOT NULL,
  `Cat_Name` varchar(30) NOT NULL,
  `Cat_Des` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES ('C001','PS5','PS5 Product'),('C002','PS4','PS4 Product'),('C003','XBOX','XBOX Pproduct');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `CustName` varchar(30) NOT NULL,
  `gender` int NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `CusDate` int NOT NULL,
  `CusMonth` int NOT NULL,
  `CusYear` int NOT NULL,
  `SSN` varchar(10) DEFAULT NULL,
  `ActiveCode` varchar(100) NOT NULL,
  `state` int NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('admin','202cb962ac59075b964b07152d234b70','admin',0,'VietNam','0823456788','admin@store.com',12,12,1990,NULL,'111',1),('Finn','e10adc3949ba59abbe56e057f20f883e','Finn Doe',0,'Can Tho','0903100550','finn.doe@gmail.com',31,8,1980,'','',1),('gluan','202cb962ac59075b964b07152d234b70','luonggialuan',0,'can tho','1234567890','luanlggcc200292@fpt.edu.vn',18,12,2002,NULL,'123',1),('Luan','202cb962ac59075b964b07152d234b70','luonggialuan',0,'can tho','123','luan@gmail.com',18,11,1987,NULL,'123',1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `Product_ID` varchar(10) NOT NULL,
  `Product_Name` varchar(200) NOT NULL,
  `Price` bigint NOT NULL,
  `oldPrice` decimal(12,2) DEFAULT NULL,
  `SmallDesc` varchar(1000) DEFAULT NULL,
  `DetailDesc` text NOT NULL,
  `ProDate` date NOT NULL,
  `Pro_qty` int NOT NULL,
  `Pro_image` varchar(200) NOT NULL,
  `Cat_ID` varchar(10) NOT NULL,
  PRIMARY KEY (`Product_ID`),
  KEY `Cat_ID` (`Cat_ID`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('P001','Sony Consoles Playstation 5 - PS5',725,0.00,'','New generation of Play Station in 2020','2021-07-09',25,'PS5-1.jpg','C001'),('P002','PS5 Console 825GB White + Ratchet & Clank: Rift Apart',899,0.00,'','New generation of Play Station in 2020','2021-07-09',20,'PS5-2.jpg','C001'),('P003','Sony PlayStation 5 - PS5 - Digital Edition',644,NULL,NULL,'New generation of Play Station in 2020','2021-07-09',20,'PS5-3.jpg','C001'),('P004','Playstation 4 1TB Slim PS4 Gaming Console',629,NULL,'','Play Station 4','2018-03-04',40,'PS4-1.jpg','C002'),('P005','RPlay Play-Station 4 PS4 1TB Slim Edition - Jet Black',649,NULL,'','Play Station 4','2018-03-04',40,'PS4-1.jpg','C002'),('P006','Consoles Xbox Series X MICROSOFT',599,NULL,'','Xbox','2018-03-04',30,'XBOX-1.jpg','C003'),('P007','XBOX One Console s series 512GB',283,NULL,NULL,'Xbox','2018-03-04',30,'XBOX-2.jpg','C003'),('P008','XBOX serie X Console 1 TB Halo Infinite Limited Edition',849,NULL,'','Xbox','2018-03-04',10,'XBOX-3.jpg','C003'),('P009','Charging station Dual sense for the PlayStation 5',34,NULL,'','PS5 Accessories','2022-05-07',50,'PS5-A1.jpg','C001');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `p_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `p_qty` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`record_id`),
  KEY `user_fk` (`username`),
  KEY `p_fk` (`p_id`),
  CONSTRAINT `p_fk` FOREIGN KEY (`p_id`) REFERENCES `product` (`Product_ID`),
  CONSTRAINT `user_fk` FOREIGN KEY (`username`) REFERENCES `customer` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

-- LOCK TABLES `cart` WRITE;
-- /*!40000 ALTER TABLE `cart` DISABLE KEYS */;
-- INSERT INTO `cart` VALUES (61,'gluan','P002',2,'2022-05-12');
-- /*!40000 ALTER TABLE `cart` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `OrderID` int NOT NULL AUTO_INCREMENT,
  `OrderDate` date NOT NULL,
  `DeliveryDate` date DEFAULT NULL,
  `Address` varchar(200) NOT NULL,
  `Payment` int NOT NULL DEFAULT '0',
  `status` varchar(10) DEFAULT 'packing',
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `username` (`username`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

-- LOCK TABLES `orders` WRITE;
-- /*!40000 ALTER TABLE `orders` DISABLE KEYS */;
-- INSERT INTO `orders` VALUES (1,'2022-05-11','2022-05-12','Can Tho City ',678,'Delivered','Luan'),(2,'2022-05-12','2022-05-12','Can Tho City ',793,'Delivered','Finn'),(3,'2022-05-12',NULL,'Can Tho City ',849,'Packing','Luan'),(4,'2022-05-12',NULL,'can tho',1624,'packing','Luan'),(5,'2022-05-12',NULL,'can tho',1132,'packing','Luan'),(9,'2022-05-12',NULL,'VietNam',899,'packing','admin');
-- /*!40000 ALTER TABLE `orders` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `orders_detail`
--

DROP TABLE IF EXISTS `orders_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_detail` (
  `OrderDetail_ID` int NOT NULL AUTO_INCREMENT,
  `Order_ID` int NOT NULL,
  `Product_ID` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `Pro_Qty` int NOT NULL,
  `Price` double NOT NULL,
  `Total` double NOT NULL,
  PRIMARY KEY (`OrderDetail_ID`),
  KEY `order_fk` (`Order_ID`,`Product_ID`,`OrderDetail_ID`) /*!80000 INVISIBLE */,
  KEY `product_fk__idx` (`Product_ID`),
  CONSTRAINT `order_fk_` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE,
  CONSTRAINT `product_fk_` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_detail`
--

-- LOCK TABLES `orders_detail` WRITE;
-- /*!40000 ALTER TABLE `orders_detail` DISABLE KEYS */;
-- INSERT INTO `orders_detail` VALUES (1,2,'P001',1,725,725),(2,2,'P009',2,34,68),(3,3,'P008',1,849,849),(4,4,'P001',1,725,725),(5,4,'P002',1,899,899),(6,5,'P008',1,849,849),(7,5,'P007',1,283,283),(10,9,'P002',1,899,899);
-- /*!40000 ALTER TABLE `orders_detail` ENABLE KEYS */;
-- UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-12 21:03:52
