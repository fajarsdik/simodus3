# Host: localhost  (Version 5.5.5-10.1.25-MariaDB)
# Date: 2018-03-26 21:14:41
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tbl_seri_meter"
#

DROP TABLE IF EXISTS `tbl_seri_meter`;
CREATE TABLE `tbl_seri_meter` (
  `Id` varchar(11) NOT NULL DEFAULT '0',
  `merk` varchar(15) NOT NULL DEFAULT '',
  `tipe` varchar(15) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `panjang` varchar(11) NOT NULL DEFAULT '',
  `seri12` varchar(2) DEFAULT NULL,
  `seri34` varchar(2) DEFAULT NULL,
  `jenis` varchar(15) DEFAULT NULL,
  `fasa` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tbl_seri_meter"
#

INSERT INTO `tbl_seri_meter` VALUES ('0100','Hexing',NULL,NULL,'11','01',NULL,'Pra Bayar','1'),('1400','Hexing',NULL,NULL,'11','14',NULL,'Pra Bayar','1'),('1600','Hexing','HXE320',NULL,'8','16',NULL,'Paska Bayar','3'),('1611','Smart','SMI-200S',2016,'11','16',NULL,'Paska Bayar','1'),('1711','Smart','SMI-200S',2017,'11','17',NULL,'Paska Bayar','1'),('1712','Wasion','i meter 310',2017,'12','17',NULL,'Paska Bayar','3'),('2124','Edmi','MK6N',2012,'9','21','24','Paska Bayar','3'),('2133','Edmi','MK6N',2013,'9','21','33','Paska Bayar','3'),('2135','Edmi','MK10',2013,'9','21','35','Paska Bayar','3'),('2152','Edmi','MK10E',2015,'9','21','52','Paska Bayar','3'),('2154','Edmi','MK10',2015,'9','21','54','Paska Bayar','3'),('2161','Edmi','MK10E',2016,'9','21','61','Paska Bayar','3'),('2163','Edmi','MK10E',2016,'9','21','63','Paska Bayar','3'),('2165','Edmi','MK10E',2016,'9','21','65','Paska Bayar','3'),('2200','Star',NULL,NULL,'11','22',NULL,'Pra Bayar','1'),('3200','Itron',NULL,NULL,'11','32',NULL,'Pra Bayar','1'),('3400','Glomet',NULL,NULL,'11','34',NULL,'Pra Bayar','1'),('3700','Actaris','SL7000',NULL,'8','37',NULL,'Paska Bayar','3'),('4500','Sanxing',NULL,NULL,'11','45',NULL,'Pra Bayar','1'),('5000','Cannet',NULL,NULL,'11','50',NULL,'Pra Bayar','1'),('5200','Itron','Nias 3',2017,'10','52',NULL,'Paska Bayar','3'),('6000','FDE',NULL,NULL,'11','60',NULL,'Pra Bayar','1'),('8600','Smart',NULL,NULL,'11','86',NULL,'Pra Bayar','1');
