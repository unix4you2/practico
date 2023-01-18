CREATE TABLE `app_rshync_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SHYNC_CommandLine` varchar(255) DEFAULT NULL,
  `SHYNC_CommandOutput` text,
  `SHYNC_SystemUUID` varchar(255) DEFAULT NULL,
  `SHYNC_Date` date DEFAULT NULL,
  `SHYNC_Time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE app_rshync_hosts (
  id int(11) NOT NULL AUTO_INCREMENT,
  SHYNC_ScriptVersion varchar(250) NOT NULL DEFAULT '',
  SHYNC_OperativeSystem varchar(250) NOT NULL DEFAULT '',
  SHYNC_KernelName varchar(250) NOT NULL DEFAULT '',
  SHYNC_KernelRelease varchar(250) NOT NULL DEFAULT '',
  SHYNC_KernelVersion varchar(250) NOT NULL DEFAULT '',
  SHYNC_Machine varchar(250) NOT NULL DEFAULT '',
  SHYNC_Processor varchar(250) NOT NULL DEFAULT '',
  SHYNC_HardwarePlatform varchar(250) NOT NULL DEFAULT '',
  SHYNC_NodeName varchar(250) NOT NULL DEFAULT '',
  SHYNC_HostName varchar(250) NOT NULL DEFAULT '',
  SHYNC_CPUsCount varchar(250) NOT NULL DEFAULT '',
  SHYNC_KernelSerial varchar(250) NOT NULL DEFAULT '',
  SHYNC_HardDrivesSUM varchar(250) NOT NULL DEFAULT '',
  SHYNC_BIOSVendor varchar(250) NOT NULL DEFAULT '',
  SHYNC_BIOSVersion varchar(250) NOT NULL DEFAULT '',
  SHYNC_BIOSAddress varchar(250) NOT NULL DEFAULT '',
  SHYNC_SystemVendor varchar(250) NOT NULL DEFAULT '',
  SHYNC_SystemProductName varchar(250) NOT NULL DEFAULT '',
  SHYNC_SystemSerialNumber varchar(250) NOT NULL DEFAULT '',
  SHYNC_SystemUUID varchar(250) NOT NULL DEFAULT '',
  SHYNC_BoardVendor varchar(250) NOT NULL DEFAULT '',
  SHYNC_BoardProductName varchar(250) NOT NULL DEFAULT '',
  SHYNC_BoardSerialNumber varchar(250) NOT NULL DEFAULT '',
  SHYNC_ChassisVendor varchar(250) NOT NULL DEFAULT '',
  SHYNC_ChassisType varchar(250) NOT NULL DEFAULT '',
  SHYNC_ChassisSerialNumber varchar(250) NOT NULL DEFAULT '',
  SHYNC_ProcessorFamily varchar(250) NOT NULL DEFAULT '',
  SHYNC_ProcessorVersion varchar(250) NOT NULL DEFAULT '',
  SHYNC_ProcessorCoreCount varchar(250) NOT NULL DEFAULT '',
  SHYNC_ProcessorID varchar(250) NOT NULL DEFAULT '',
  PHP_REMOTE_ADDR varchar(250) NOT NULL DEFAULT '',
  PHP_HTTP_CLIENT_IP varchar(250) NOT NULL DEFAULT '',
  PHP_HTTP_X_FORWARDED_FOR varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY id (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
  
  

