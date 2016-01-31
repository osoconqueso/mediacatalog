-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: media_catalog
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` bigint(20) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (8,9780756404741,'Patrick Rothfuss',25),(9,9780136035428,'Paul Deitel',26),(12,9780441012688,'Jim Butcher',29);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dvds`
--

DROP TABLE IF EXISTS `dvds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dvds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upc` bigint(20) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `dvds_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dvds`
--

LOCK TABLES `dvds` WRITE;
/*!40000 ALTER TABLE `dvds` DISABLE KEYS */;
INSERT INTO `dvds` VALUES (16,25192014277,23),(17,13132597256,24);
/*!40000 ALTER TABLE `dvds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `img_url` text,
  `item_desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (23,'Inglourious Basterds (Single-Disc Edition)','http://ecx.images-amazon.com/images/I/51TAL%2Bn7AqL._SL160_.jpg','Brad Pitt takes no prisoners in Quentin Tarantinoâ€™s high-octane WWII revenge fantasy Inglourious Basterds. As war rages in Europe, a Nazi-scalping squad of American soldiers, known to their enemy as â€œThe Basterds,â€ is on a daring mission to take down the leaders of the Third Reich. Bursting with â€œaction, hair-trigger suspense and a machine-gun spray of killer dialogueâ€ (Peter Travers, Rolling Stone), Inglourious Basterds is â€œanother Tarantino masterpieceâ€ (Jake Hamilton, CBS-TV)!'),(24,'Django Unchained','http://ecx.images-amazon.com/images/I/51L5VId8rFL._SL160_.jpg','Set in the South two years before the Civil War, DJANGO UNCHAINED stars Academy Award Â®-winner Jamie Foxx as Django, a slave whose brutal history with his former owners lands him face-to-face with a German-born bounty hunter Dr. King Schultz (Academy AwardÂ®-winner Christolph Waltz). Schultz is on the trail of the murderous Brittle brothers, and only Django can lead him to his bounty. The unorthodox Schultz acquires Django with a promise to free him upon the capture of the Brittles â€“ dead or alive.  <br /><br />Success leads Schultz to free Django, though the two men choose not to go their separate ways. Instead, Schultz seeks out the Southâ€™s most wanted criminals with Django by his side. Honing vital hunting skills, Django remains focused on one goal: finding and rescuing Broomhilda (Kerry Washington), the wife he lost to the slave trade long ago.  <br /><br />Django and Schultzâ€™s search ultimately leads them to Calvin Candie (Academy AwardÂ®-nominee Leonardo DiCaprio), the proprietor of â€œCandyland,â€ an infamous plantation. Exploring the compound under false pretenses, Django and Schultz rouse the suspicion of Stephen (Academy AwardÂ®-nominee Samuel L. Jackson), Candieâ€™s trusted house slave. Their moves are marked, and a treacherous organization closes in on them. If Django and Schultz are to escape with Broomhilda, they must choose between independence and solidarity, between sacrifice and survivalâ€¦'),(25,'The Name of the Wind (Kingkiller Chronicle)','http://ecx.images-amazon.com/images/I/514LJcIGpfL._SL160_.jpg',''),(26,'Internet & World Wide Web: How to Program (4th Edition)','http://ecx.images-amazon.com/images/I/61LOuRy31-L._SL160_.jpg','This is the international edition of the widely used Internet & World Wide Web: How to Program (4th Edition) by Deitel and Deitel.\n\nIt is in good condition with no pages missing, no rips/tears, no writing, and minimal highlighting.'),(29,'Furies of Calderon (Codex Alera, Book 1)','http://ecx.images-amazon.com/images/I/51uNHh5MU0L._SL160_.jpg','For a thousand years, the people of Alera have united against the aggressive and threatening races that inhabit the world, using their unique bond with the furies - elementals of earth, air, fire, water, and metal. But now, Gaius Sextus, First Lord of Alera, grows old and lacks an heir. Ambitious High Lords plot and maneuver to place their Houses in positions of power, and a war of succession looms on the horizon.\" \"Far from city politics in the Calderon Valley, the boy Tavi struggles with his lack of furycrafting. At fifteen, he has no wind fury to help him fly, no fire fury to light his lamps. Yet as the Alerans\' most savage enemy - the Marat - return to the Valley, he will discover that his destiny is much greater than he could ever imagine.\" Caught in a storm of deadly wind furies, Tavi saves the life of a runaway slave named Amara. But she is actually a spy for Gaius Sextus, sent to the Valley to gather intelligence on traitors to the Crown, who may be in league with the barbaric Marat horde. And when the Valley erupts in chaos - when rebels war with loyalists and furies clash with furies - Amara will find Tavi\'s courage and resourcefulness to be a power greater than any fury - one that could turn the tides of war.');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-26 17:25:21
