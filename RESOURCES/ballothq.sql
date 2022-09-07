-- MySQL dump 10.13  Distrib 5.6.39, for Linux (x86_64)
--
-- Host: localhost    Database: ballothq
-- ------------------------------------------------------
-- Server version	5.6.39-cll-lve

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
-- Table structure for table `access__admin`
--

DROP TABLE IF EXISTS `access__admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access__admin` (
  `admin_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `admin_fname` text NOT NULL,
  `admin_lname` text NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL,
  `admin_phone` text NOT NULL,
  `admin_level` tinyint(4) NOT NULL,
  `admin_created` bigint(20) NOT NULL,
  `admin_modified` bigint(20) NOT NULL,
  `admin_lastlogin` bigint(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access__admin`
--

LOCK TABLES `access__admin` WRITE;
/*!40000 ALTER TABLE `access__admin` DISABLE KEYS */;
INSERT INTO `access__admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_password`, `admin_phone`, `admin_level`, `admin_created`, `admin_modified`, `admin_lastlogin`) VALUES (1,'Ernest','Darling','ernestdarling@live.com','petenash1','',5,0,0,0);
/*!40000 ALTER TABLE `access__admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `access__agents`
--

DROP TABLE IF EXISTS `access__agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access__agents` (
  `agent_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `agent_fname` text NOT NULL,
  `agent_lname` text NOT NULL,
  `agent_level` tinyint(4) NOT NULL,
  `agent_passcode` text NOT NULL,
  `agent_phone1` text NOT NULL,
  `agent_phone2` text NOT NULL,
  `agent_phone3` text NOT NULL,
  `agent_created` bigint(20) NOT NULL,
  `agent_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access__agents`
--

LOCK TABLES `access__agents` WRITE;
/*!40000 ALTER TABLE `access__agents` DISABLE KEYS */;
INSERT INTO `access__agents` (`agent_id`, `agent_fname`, `agent_lname`, `agent_level`, `agent_passcode`, `agent_phone1`, `agent_phone2`, `agent_phone3`, `agent_created`, `agent_modified`) VALUES (1,'Kwaku','Manu',0,'38056','0244133544','','',1550360737,0),(2,'Kwaku','Manu',0,'17935','0244133544','','',1550360754,0),(3,'Kwaku','Manu',0,'85867','0244133544','','',1550361029,0);
/*!40000 ALTER TABLE `access__agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `access__logs`
--

DROP TABLE IF EXISTS `access__logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access__logs` (
  `log_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_user` mediumint(9) NOT NULL,
  `log_user_type` varchar(5) NOT NULL,
  `log_type` varchar(50) NOT NULL,
  `log_result` tinyint(1) NOT NULL,
  `log_input` text NOT NULL,
  `log_created` bigint(20) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34623 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access__logs`
--

LOCK TABLES `access__logs` WRITE;
/*!40000 ALTER TABLE `access__logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `access__logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__constituencies`
--

DROP TABLE IF EXISTS `data__constituencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__constituencies` (
  `constituency_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `constituency_code` tinyint(4) NOT NULL,
  `constituency_name` text NOT NULL,
  `constituency_voters` mediumint(9) NOT NULL,
  `constituency_ballot_sheet_code_mp` text NOT NULL,
  `constituency_ballot_sheet_code_pr` text NOT NULL,
  `constituency_ballots_issued_mp` mediumint(9) NOT NULL,
  `constituency_ballots_issued_pr` mediumint(9) NOT NULL,
  `constituency_ballots_cast_mp` mediumint(9) NOT NULL,
  `constituency_ballots_cast_pr` mediumint(9) NOT NULL,
  `constituency_ballots_spoiled_mp` mediumint(9) NOT NULL,
  `constituency_ballots_spoiled_pr` mediumint(9) NOT NULL,
  `constituency_ballots_valid_mp` mediumint(9) NOT NULL,
  `constituency_ballots_valid_pr` mediumint(9) NOT NULL,
  `constituency_created` bigint(20) NOT NULL,
  `constituency_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`constituency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__constituencies`
--

LOCK TABLES `data__constituencies` WRITE;
/*!40000 ALTER TABLE `data__constituencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__constituencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__districts`
--

DROP TABLE IF EXISTS `data__districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__districts` (
  `district_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `district_code` tinyint(4) NOT NULL,
  `district_name` text NOT NULL,
  `district_voters` mediumint(9) NOT NULL,
  `district_ballot_sheet_code_mp` text NOT NULL,
  `district_ballot_sheet_code_pr` text NOT NULL,
  `district_ballots_issued_mp` mediumint(9) NOT NULL,
  `district_ballots_issued_pr` mediumint(9) NOT NULL,
  `district_ballots_cast_mp` mediumint(9) NOT NULL,
  `district_ballots_cast_pr` mediumint(9) NOT NULL,
  `district_ballots_spoiled_mp` mediumint(9) NOT NULL,
  `district_ballots_spoiled_pr` mediumint(9) NOT NULL,
  `district_ballots_valid_mp` mediumint(9) NOT NULL,
  `district_ballots_valid_pr` mediumint(9) NOT NULL,
  `district_created` bigint(20) NOT NULL,
  `district_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__districts`
--

LOCK TABLES `data__districts` WRITE;
/*!40000 ALTER TABLE `data__districts` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__electoral`
--

DROP TABLE IF EXISTS `data__electoral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__electoral` (
  `electoral_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `electoral_code` tinyint(4) NOT NULL,
  `electoral_name` text NOT NULL,
  `electoral_voters` mediumint(9) NOT NULL,
  `electoral_ballot_sheet_code_mp` text NOT NULL,
  `electoral_ballot_sheet_code_pr` text NOT NULL,
  `electoral_ballots_issued_mp` mediumint(9) NOT NULL,
  `electoral_ballots_issued_pr` mediumint(9) NOT NULL,
  `electoral_ballots_cast_mp` mediumint(9) NOT NULL,
  `electoral_ballots_cast_pr` mediumint(9) NOT NULL,
  `electoral_ballots_spoiled_mp` mediumint(9) NOT NULL,
  `electoral_ballots_spoiled_pr` mediumint(9) NOT NULL,
  `electoral_ballots_valid_mp` mediumint(9) NOT NULL,
  `electoral_ballots_valid_pr` mediumint(9) NOT NULL,
  `electoral_created` bigint(20) NOT NULL,
  `electoral_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`electoral_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__electoral`
--

LOCK TABLES `data__electoral` WRITE;
/*!40000 ALTER TABLE `data__electoral` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__electoral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__mps`
--

DROP TABLE IF EXISTS `data__mps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__mps` (
  `mp_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `mp_fname` text NOT NULL,
  `mp_mname` text NOT NULL,
  `mp_lname` text NOT NULL,
  `mp_party` varchar(5) NOT NULL,
  `mp_constituency` smallint(6) NOT NULL,
  `mp_added` bigint(20) NOT NULL,
  `mp_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`mp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__mps`
--

LOCK TABLES `data__mps` WRITE;
/*!40000 ALTER TABLE `data__mps` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__mps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__parties`
--

DROP TABLE IF EXISTS `data__parties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__parties` (
  `party_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `party_code` varchar(5) NOT NULL,
  `party_name` text NOT NULL,
  `party_logo` text NOT NULL,
  `party_color` text NOT NULL,
  `party_added` bigint(20) NOT NULL,
  `party_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`party_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__parties`
--

LOCK TABLES `data__parties` WRITE;
/*!40000 ALTER TABLE `data__parties` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__parties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__presidents`
--

DROP TABLE IF EXISTS `data__presidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__presidents` (
  `president_id` int(11) NOT NULL AUTO_INCREMENT,
  `president_fname` text NOT NULL,
  `president_mname` text NOT NULL,
  `president_lname` text NOT NULL,
  `president_party` varchar(5) NOT NULL,
  `president_added` bigint(20) NOT NULL,
  `president_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`president_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__presidents`
--

LOCK TABLES `data__presidents` WRITE;
/*!40000 ALTER TABLE `data__presidents` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__presidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__regions`
--

DROP TABLE IF EXISTS `data__regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__regions` (
  `region_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `region_code` varchar(1) NOT NULL,
  `region_name` text NOT NULL,
  `region_voters` mediumint(9) NOT NULL,
  `region_ballot_sheet_code_mp` text NOT NULL,
  `region_ballot_sheet_code_pr` text NOT NULL,
  `region_ballots_issued_mp` mediumint(9) NOT NULL,
  `region_ballots_issued_pr` mediumint(9) NOT NULL,
  `region_ballots_cast_mp` mediumint(9) NOT NULL,
  `region_ballots_cast_pr` mediumint(9) NOT NULL,
  `region_ballots_spoiled_mp` mediumint(9) NOT NULL,
  `region_ballots_spoiled_pr` mediumint(9) NOT NULL,
  `region_ballots_valid_mp` mediumint(9) NOT NULL,
  `region_ballots_valid_pr` mediumint(9) NOT NULL,
  `region_created` bigint(20) NOT NULL,
  `region_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__regions`
--

LOCK TABLES `data__regions` WRITE;
/*!40000 ALTER TABLE `data__regions` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data__stations`
--

DROP TABLE IF EXISTS `data__stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data__stations` (
  `station_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `station_code` text NOT NULL,
  `station_name` text NOT NULL,
  `station_voters` smallint(6) NOT NULL,
  `station_ballot_sheet_code_mp` text NOT NULL,
  `station_ballot_sheet_code_pr` text NOT NULL,
  `station_ballots_issued_mp` mediumint(9) NOT NULL,
  `station_ballots_issued_pr` mediumint(9) NOT NULL,
  `station_ballots_cast_mp` mediumint(9) NOT NULL,
  `station_ballots_cast_pr` mediumint(9) NOT NULL,
  `station_ballots_spoiled_mp` smallint(6) NOT NULL,
  `station_ballots_spoiled_pr` smallint(6) NOT NULL,
  `station_ballots_valid_mp` mediumint(9) NOT NULL,
  `station_ballots_valid_pr` mediumint(9) NOT NULL,
  `station_created` bigint(20) NOT NULL,
  `station_modified` bigint(20) NOT NULL,
  PRIMARY KEY (`station_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data__stations`
--

LOCK TABLES `data__stations` WRITE;
/*!40000 ALTER TABLE `data__stations` DISABLE KEYS */;
/*!40000 ALTER TABLE `data__stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links__agent_station`
--

DROP TABLE IF EXISTS `links__agent_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links__agent_station` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `agent_id` smallint(6) NOT NULL,
  `station_id` smallint(6) NOT NULL,
  `linked` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links__agent_station`
--

LOCK TABLES `links__agent_station` WRITE;
/*!40000 ALTER TABLE `links__agent_station` DISABLE KEYS */;
/*!40000 ALTER TABLE `links__agent_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links__con_dis`
--

DROP TABLE IF EXISTS `links__con_dis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links__con_dis` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `constituency_id` smallint(6) NOT NULL,
  `district_id` smallint(6) NOT NULL,
  `linked` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links__con_dis`
--

LOCK TABLES `links__con_dis` WRITE;
/*!40000 ALTER TABLE `links__con_dis` DISABLE KEYS */;
/*!40000 ALTER TABLE `links__con_dis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links__dis_reg`
--

DROP TABLE IF EXISTS `links__dis_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links__dis_reg` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `district_id` smallint(6) NOT NULL,
  `region_id` tinyint(4) NOT NULL,
  `linked` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links__dis_reg`
--

LOCK TABLES `links__dis_reg` WRITE;
/*!40000 ALTER TABLE `links__dis_reg` DISABLE KEYS */;
/*!40000 ALTER TABLE `links__dis_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links__ele_con`
--

DROP TABLE IF EXISTS `links__ele_con`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links__ele_con` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `electoral_id` smallint(6) NOT NULL,
  `constituency_id` smallint(6) NOT NULL,
  `linked` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links__ele_con`
--

LOCK TABLES `links__ele_con` WRITE;
/*!40000 ALTER TABLE `links__ele_con` DISABLE KEYS */;
/*!40000 ALTER TABLE `links__ele_con` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links__sta_ele`
--

DROP TABLE IF EXISTS `links__sta_ele`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links__sta_ele` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `station_id` mediumint(9) NOT NULL,
  `electoral_id` smallint(6) NOT NULL,
  `linked` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links__sta_ele`
--

LOCK TABLES `links__sta_ele` WRITE;
/*!40000 ALTER TABLE `links__sta_ele` DISABLE KEYS */;
/*!40000 ALTER TABLE `links__sta_ele` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results__constituency`
--

DROP TABLE IF EXISTS `results__constituency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results__constituency` (
  `result_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `result_type` varchar(2) NOT NULL,
  `result_value` mediumint(9) NOT NULL,
  `result_constituency` smallint(6) NOT NULL,
  `result_district` smallint(6) NOT NULL,
  `result_region` tinyint(4) NOT NULL,
  `result_candidate` smallint(6) NOT NULL,
  `result_added` bigint(20) NOT NULL,
  `result_added_by` smallint(6) NOT NULL,
  `result_modified` bigint(20) NOT NULL,
  `result_modified_by` smallint(6) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results__constituency`
--

LOCK TABLES `results__constituency` WRITE;
/*!40000 ALTER TABLE `results__constituency` DISABLE KEYS */;
/*!40000 ALTER TABLE `results__constituency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results__electoral`
--

DROP TABLE IF EXISTS `results__electoral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results__electoral` (
  `result_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `result_type` varchar(2) NOT NULL,
  `result_value` mediumint(9) NOT NULL,
  `result_constituency` smallint(6) NOT NULL,
  `result_electoral` smallint(6) NOT NULL,
  `result_district` smallint(6) NOT NULL,
  `result_region` tinyint(4) NOT NULL,
  `result_candidate` smallint(6) NOT NULL,
  `result_added` bigint(20) NOT NULL,
  `result_added_by` smallint(6) NOT NULL,
  `result_modified` bigint(20) NOT NULL,
  `result_modified_by` smallint(6) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results__electoral`
--

LOCK TABLES `results__electoral` WRITE;
/*!40000 ALTER TABLE `results__electoral` DISABLE KEYS */;
/*!40000 ALTER TABLE `results__electoral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results__national`
--

DROP TABLE IF EXISTS `results__national`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results__national` (
  `result_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `result_type` varchar(2) NOT NULL,
  `result_value` int(11) NOT NULL,
  `result_candidate` smallint(6) NOT NULL,
  `result_added` bigint(20) NOT NULL,
  `result_added_by` smallint(6) NOT NULL,
  `result_modified` bigint(20) NOT NULL,
  `result_modified_by` smallint(6) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results__national`
--

LOCK TABLES `results__national` WRITE;
/*!40000 ALTER TABLE `results__national` DISABLE KEYS */;
/*!40000 ALTER TABLE `results__national` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results__regional`
--

DROP TABLE IF EXISTS `results__regional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results__regional` (
  `result_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `result_type` varchar(2) NOT NULL,
  `result_value` mediumint(9) NOT NULL,
  `result_region` tinyint(4) NOT NULL,
  `result_candidate` smallint(6) NOT NULL,
  `result_added` bigint(20) NOT NULL,
  `result_added_by` smallint(6) NOT NULL,
  `result_modified` bigint(20) NOT NULL,
  `result_modified_by` smallint(6) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results__regional`
--

LOCK TABLES `results__regional` WRITE;
/*!40000 ALTER TABLE `results__regional` DISABLE KEYS */;
/*!40000 ALTER TABLE `results__regional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results__stations`
--

DROP TABLE IF EXISTS `results__stations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results__stations` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `result_type` varchar(2) NOT NULL,
  `result_value` mediumint(9) NOT NULL,
  `result_station` mediumint(9) NOT NULL,
  `result_constituency` smallint(6) NOT NULL,
  `result_electoral` smallint(6) NOT NULL,
  `result_district` smallint(6) NOT NULL,
  `result_region` tinyint(4) NOT NULL,
  `result_candidate` smallint(6) NOT NULL,
  `result_added` bigint(20) NOT NULL,
  `result_added_by` smallint(6) NOT NULL,
  `result_modified` bigint(20) NOT NULL,
  `result_modified_by` smallint(6) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results__stations`
--

LOCK TABLES `results__stations` WRITE;
/*!40000 ALTER TABLE `results__stations` DISABLE KEYS */;
/*!40000 ALTER TABLE `results__stations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ballothq'
--

--
-- Dumping routines for database 'ballothq'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-16 17:10:24
