
CREATE TABLE `app_rshync_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SHYNC_CommandLine` varchar(255) DEFAULT NULL,
  `SHYNC_CommandOutput` text,
  `SHYNC_SystemUUID` varchar(255) DEFAULT NULL,
  `SHYNC_Date` date DEFAULT NULL,
  `SHYNC_Time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

