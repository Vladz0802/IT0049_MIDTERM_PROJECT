
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
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'jcruz','Juan Dela Cruz','$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi',NULL,'2026-10-09 09:19:54'),
(2,'msantos','Maria Santos','$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi',NULL,'2026-10-09 09:19:54'),
(3,'preyes','Pedro Reyes','$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi',NULL,'2026-10-09 09:19:54'),
(4,'alim','Ana Lim','$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi',NULL,'2026-10-09 09:19:54'),
(5,'cbautista','Carlo Bautista','$2y$10$zFzvWpag.EZru0xBu6eU4OIoVUShZlgEv1wgfrETcB4OovuxjmDMi',NULL,'2026-10-09 09:19:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES
(1,'Juan Dela Cruz','juan.delacruz@example.com','0917-111-2222','2026-10-09 09:19:54'),
(2,'Maria Santos','maria.santos@example.com','0917-222-3333','2026-10-09 09:19:54'),
(3,'Pedro Reyes','pedro.reyes@example.com','0917-333-4444','2026-10-09 09:19:54'),
(4,'Ana Lim','ana.lim@example.com','0917-444-5555','2026-10-09 09:19:54'),
(5,'Carlo Bautista','carlo.bautista@example.com','0917-555-6666','2026-10-09 09:19:54');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,'Instant Noodles (Cup)',18.00,60,NULL,'2026-10-09 09:19:54'),
(2,'Canned Sardines 155g',24.50,40,NULL,'2026-10-09 09:19:54'),
(3,'3-in-1 Coffee Sachet',7.00,120,NULL,'2026-10-09 09:19:54'),
(4,'Bottled Water 500ml',15.00,48,NULL,'2026-10-09 09:19:54'),
(5,'Cola 1.5L',68.00,24,NULL,'2026-10-09 09:19:54'),
(6,'White Sugar 1kg',82.00,15,NULL,'2026-10-09 09:19:54'),
(7,'Laundry Soap Bar',22.00,30,NULL,'2026-10-09 09:19:54'),
(8,'Egg (per piece)',9.50,5,NULL,'2026-10-09 09:19:54');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sold_by` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_product_id_foreign` (`product_id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_sold_by_foreign` (`sold_by`),
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `sales_sold_by_foreign` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

