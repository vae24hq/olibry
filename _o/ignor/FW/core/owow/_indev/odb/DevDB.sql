/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP TABLE IF EXISTS `logao`;
CREATE TABLE IF NOT EXISTS `logao` (
  `auid` bigint(20) NOT NULL AUTO_INCREMENT,
  `euid` char(40) NOT NULL,
  `suid` char(70) NOT NULL,
  `puid` char(20) NOT NULL,
  `logid` char(90) DEFAULT 'oNONE',
  `author` varchar(80) DEFAULT 'oSYS',
  `entry` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `report` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `platform` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `ref` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`auid`),
  UNIQUE KEY `euid` (`euid`),
  UNIQUE KEY `suid` (`suid`),
  KEY `puid` (`puid`),
  KEY `logid` (`logid`),
  KEY `author` (`author`),
  KEY `entry` (`entry`),
  KEY `status` (`status`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*!40000 ALTER TABLE `logao` DISABLE KEYS */;
/*!40000 ALTER TABLE `logao` ENABLE KEYS */;

DROP TABLE IF EXISTS `userao`;
CREATE TABLE IF NOT EXISTS `userao` (
  `auid` bigint(20) NOT NULL AUTO_INCREMENT,
  `euid` char(40) NOT NULL,
  `suid` char(70) NOT NULL,
  `puid` char(20) NOT NULL,
  `logid` char(90) DEFAULT 'oNONE',
  `author` varchar(80) DEFAULT 'oSYS',
  `entry` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `okey` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `oplatform` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `step` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `othername` varchar(100) DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `interest` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dp` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`auid`),
  UNIQUE KEY `euid` (`euid`),
  UNIQUE KEY `suid` (`suid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  KEY `puid` (`puid`),
  KEY `logid` (`logid`),
  KEY `author` (`author`),
  KEY `entry` (`entry`),
  KEY `status` (`status`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*!40000 ALTER TABLE `userao` DISABLE KEYS */;
/*!40000 ALTER TABLE `userao` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
