
-- UPDATE PUID, EUID & SUID
SET FOREIGN_KEY_CHECKS = 0;
ALTER TABLE `parisho`
	CHANGE COLUMN `author` `author` VARCHAR(80) NULL DEFAULT NULL AFTER `stamp`,
	ADD COLUMN `puid` CHAR(20) NULL DEFAULT NULL AFTER `author`,
	CHANGE COLUMN `euid` `euid` CHAR(40) NULL DEFAULT NULL AFTER `puid`,
	CHANGE COLUMN `suid` `suid` CHAR(70) NULL DEFAULT NULL AFTER `euid`,
	ADD INDEX `puid` (`puid`);
SET FOREIGN_KEY_CHECKS = 1;



-- TRUNCATE TABLE
USE `aodb`;
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE `_sample`;
SET FOREIGN_KEY_CHECKS = 1;


-- RESET & RENUMBER PRIMARY KEY
SET FOREIGN_KEY_CHECKS = 0;
SET @NewID = 0;
UPDATE `parisho` SET `auid`=(@NewID := @NewID +1) ORDER BY `auid`;
SELECT MAX(`auid`) AS `IDMax` FROM `parisho`;
ALTER TABLE `parisho` AUTO_INCREMENT = 1;
SET FOREIGN_KEY_CHECKS = 1;