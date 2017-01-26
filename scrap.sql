INSERT INTO media_files (app_id, listing_id, fid)
    SELECT mymaster.app_id, mymaster.rlisting_id, mymaster.fid
    from (
     SELECT ch.id AS rlisting_id, cb.* from accounts ch INNER JOIN (
       SELECT ca.group_id, mf.* FROM accounts ca INNER JOIN media_files mf ON mf.listing_id = ca.id WHERE mf.app_id=1085
        ) cb ON ch.group_id = cb.group_id
    ) mymaster

BEGIN;
INSERT INTO users (email, password)
  VALUES('test', 'test');
INSERT INTO profiles (userid, bio, homepage)
  VALUES(LAST_INSERT_ID(),'Hello world!', 'http://www.stackoverflow.com');
COMMIT;

BEGIN;
INSERT INTO users (email, password)
  VALUES('test', 'test');
SELECT LAST_INSERT_ID() INTO @mysql_variable_here;
INSERT INTO profiles (userid, bio, homepage)
  VALUES(@mysql_variable_here,'Hello world!', 'http://www.stackoverflow.com');
COMMIT;

INSERT INTO p_model(`name`,`p_category_id`) SELECT '$model_name', `p_category_id`
   FROM p_category WHERE `category_name`='$category_name';

CREATE DEFINER=`root`@`localhost` PROCEDURE `testProcedure`()
BEGIN
    DECLARE variable1, variable2, length INT;
    SET variable1 = 0;
    SET length = 1134;

    WHILE variable1 < length DO
        INSERT INTO theatre (sid, color, type) VALUES (variable1, '00a9e0', 'PREMIUM');
        SELECT COUNT(*) INTO variable2 FROM theatre;
        SET variable1 = variable1 + 1;
    END WHILE;
END

BEGIN
CREATE TABLE IF NOT EXISTS `grid` (
  `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(64) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `designation` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `showdate` date DEFAULT NULL,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT NULL,
  `modified_by` int(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1131 ;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `testCreateGrid`(IN `tblName` VARCHAR(64) CHARSET utf8mb4)
BEGIN
    SET @tableName = tblName;
    SET @q = CONCAT('
        CREATE TABLE IF NOT EXISTS `' , @tableName, '` (
            `id` int(64) unsigned NOT NULL AUTO_INCREMENT,
            `sid` int(64) unsigned NOT NULL,
            `title` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `price` decimal(10,2) NOT NULL,
            `designation` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `color` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `type` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `assignedate` date DEFAULT NULL,
            `start` date DEFAULT NULL,
            `end` date DEFAULT NULL,
            `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `created` datetime DEFAULT NULL,
            `modified_by` int(64) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `sid` (`sid`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1131
    ');
    PREPARE stmt FROM @q;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `testInsertUpdate`()
BEGIN
    DECLARE variable1, variable2, length INT;
    SET variable1 = 1;
    SET length = 1134;

    WHILE variable1 < length DO
    UPDATE theatre SET sid = variable1 WHERE id = variable1;

    SET variable1 = variable1 + 1;
    END WHILE;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `testProcedure`()
BEGIN
    DECLARE variable1, variable2, length INT;
    SET variable1 = 0;
    SET length = 1134;

    WHILE variable1 < length DO
        INSERT INTO theatre (sid, color, type) VALUES (variable1, '00a9e0', 'PREMIUM');
        SELECT COUNT(*) INTO variable2 FROM theatre;
        SET variable1 = variable1 + 1;
    END WHILE;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `testUpdate`()
BEGIN
UPDATE theatre SET `price`= 75.00;
END
