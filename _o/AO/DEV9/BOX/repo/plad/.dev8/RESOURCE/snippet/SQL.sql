-- RESET & RENUMBER PRIMARY KEY
-------------------------------
SET @NewID = 0;
UPDATE `TABLE_NAME` SET `ID_COLUMN`=(@NewID := @NewID +1) ORDER BY `ID_COLUMN`;
SELECT MAX(`ID_COLUMN`) AS `IDMax` FROM `TABLE_NAME`;

ALTER TABLE `TABLE_NAME` AUTO_INCREMENT = [IDMax + 1];

