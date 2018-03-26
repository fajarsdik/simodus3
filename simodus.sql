# Host: localhost  (Version 5.5.5-10.1.25-MariaDB)
# Date: 2018-03-24 16:04:56
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tbl_aktivasi"
#

DROP TABLE IF EXISTS `tbl_aktivasi`;
CREATE TABLE `tbl_aktivasi` (
  `id_meter` int(11) NOT NULL AUTO_INCREMENT,
  `no_dummy` varchar(50) DEFAULT NULL,
  `no_meter_rusak` varchar(50) DEFAULT NULL,
  `merk_meter_rusak` varchar(50) DEFAULT NULL,
  `no_meter_baru` varchar(50) DEFAULT NULL,
  `merk_meter_baru` varchar(50) DEFAULT NULL,
  `id_pelanggan` varchar(50) DEFAULT NULL,
  `tgl_aktivasi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(50) DEFAULT NULL,
  `id_user` tinyint(2) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_meter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tbl_aktivasi"
#


#
# Structure for table "tbl_dummy_total"
#

DROP TABLE IF EXISTS `tbl_dummy_total`;
CREATE TABLE `tbl_dummy_total` (
  `id_meter` int(11) NOT NULL AUTO_INCREMENT,
  `no_dummy` varchar(50) NOT NULL DEFAULT '',
  `no_meter_rusak` varchar(50) NOT NULL DEFAULT '',
  `merk_meter_rusak` varchar(15) DEFAULT NULL,
  `tipe_meter_rusak` varchar(25) DEFAULT NULL,
  `tahun_meter_rusak` varchar(25) DEFAULT NULL,
  `alasan_rusak` varchar(10) DEFAULT NULL,
  `tgl_pakai` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ptgs_pasang` varchar(50) NOT NULL DEFAULT '',
  `sisa_pulsa` float(10,2) NOT NULL DEFAULT '0.00',
  `no_hp_plg` varchar(50) NOT NULL DEFAULT '',
  `std_dummy` float(10,2) NOT NULL DEFAULT '0.00',
  `aktivasi` varchar(25) DEFAULT NULL,
  `kembali` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_user` tinyint(2) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_meter`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tbl_dummy_total"
#

INSERT INTO `tbl_dummy_total` VALUES (14,'1','321','32',NULL,NULL,'1','2018-03-19 19:53:00','321',321.00,'321',321.00,'non aktif','belum','Super Admin',1,'18'),(15,'1','32','32',NULL,NULL,'1','2018-03-24 05:36:16','1',1.00,'1',1.00,'non aktif','belum','Super Admin',1,'18'),(16,'2','3','3',NULL,NULL,'1','2018-03-24 05:39:05','4',3.00,'3',3.00,'non aktif','belum','Super Admin',1,'18'),(18,'3','8','8',NULL,NULL,'1','2018-03-24 05:51:11','sayid',8.00,'8',8.00,'non aktif','belum','Super Admin',1,'18'),(19,'5','88','88',NULL,NULL,'2','2018-03-24 05:54:02','888',88.00,'88',88.00,'non aktif','belum','Super Admin',1,'18'),(20,'6','12','sayid',NULL,NULL,'2','2018-03-24 06:37:46','12',12.00,'12',12.00,'non aktif','belum','Super Admin',1,'18'),(21,'7','1111','',NULL,NULL,'2','2018-03-24 06:54:09','111',11.00,'111',111.00,'non aktif','belum','Super Admin',1,'18'),(22,'7','12','',NULL,NULL,'2','2018-03-24 06:54:58','12',1.00,'1',1.00,'non aktif','belum','Super Admin',1,'18'),(23,'10','111','',NULL,NULL,'1','2018-03-24 06:56:24','111',11.00,'11',11.00,'non aktif','belum','Super Admin',1,'18'),(24,'6','16','',NULL,NULL,'1','2018-03-24 06:59:42','16',16.00,'16',16.00,'non aktif','belum','Super Admin',1,'18'),(25,'7','11','pot1',NULL,NULL,'1','2018-03-24 07:01:06','11',11.00,'11',11.00,'non aktif','belum','Super Admin',1,'18'),(26,'8','111','1',NULL,NULL,'1','2018-03-24 07:01:42','11',11.00,'11',11.00,'non aktif','belum','Super Admin',1,'18'),(27,'9','11','Smart',NULL,NULL,'1','2018-03-24 07:03:15','11',11.00,'11',11.00,'non aktif','belum','Super Admin',1,'18'),(28,'10','60','FDE',NULL,NULL,'2','2018-03-24 07:33:20','0000',0.00,'00',0.00,'non aktif','belum','Super Admin',1,'18'),(29,'3','17','Wasion',NULL,NULL,'1','2018-03-24 07:34:30','11212',123.00,'2232',2323.00,'non aktif','belum','Super Admin',1,'18'),(30,'6','2134','Edmi','MK10E',NULL,'2','2018-03-24 09:28:32','21',21.00,'21',21.00,'non aktif','belum','Super Admin',1,'18'),(31,'5','212422222','','',NULL,'2','2018-03-24 09:56:26','88',88.00,'88',88.00,'non aktif','belum','Super Admin',1,'18'),(32,'5','212233445','Edmi','MK6N',NULL,'1','2018-03-24 09:58:36','iiu',90.00,'909',9.00,'non aktif','belum','Super Admin',1,'18'),(33,'3','212422222','Edmi','MK6N','2012','1','2018-03-24 10:00:29','0909',909.00,'090',909.00,'non aktif','belum','Super Admin',1,'18'),(34,'6','213555555','Edmi','MK10','2013','10','2018-03-24 10:02:11','55',55.00,'55',55.00,'non aktif','belum','Super Admin',1,'18');

#
# Structure for table "tbl_instansi"
#

DROP TABLE IF EXISTS `tbl_instansi`;
CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tbl_instansi"
#

INSERT INTO `tbl_instansi` VALUES (1,'PT. PLN','PT. PLN (Persero) Area Tanjungpinang','Smart, Excellent and The Winner!!','http://www.pln.co.id','fajar.sidik2@pln.co.id','logo.jpg',1);

#
# Structure for table "tbl_metdum"
#

DROP TABLE IF EXISTS `tbl_metdum`;
CREATE TABLE `tbl_metdum` (
  `id_rec` int(11) NOT NULL AUTO_INCREMENT,
  `no_dummy` varchar(15) DEFAULT NULL,
  `merk_meter_rusak` varchar(15) DEFAULT NULL,
  `no_meter_rusak` varchar(25) DEFAULT NULL,
  `alasan_rusak` varchar(200) DEFAULT NULL,
  `tgl_pakai` datetime DEFAULT NULL,
  `ptgs_pasang` varchar(50) DEFAULT NULL,
  `sisa_pulsa` float(10,2) DEFAULT NULL,
  `no_hp_plg` varchar(25) DEFAULT NULL,
  `stand_pakai` float(10,2) DEFAULT NULL,
  `no_meter_baru` varchar(25) DEFAULT NULL,
  `idpel` varchar(25) DEFAULT NULL,
  `tgl_aktivasi` datetime DEFAULT NULL,
  `lokasi_posko` varchar(50) DEFAULT NULL,
  `nama_cc` varchar(50) DEFAULT NULL,
  `stand_kembali` float(10,2) DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `status_aktivasi` varchar(25) DEFAULT NULL,
  `status_kembali` varchar(25) DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `id_user` tinyint(2) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_rec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tbl_metdum"
#


#
# Structure for table "tbl_metdum_jml"
#

DROP TABLE IF EXISTS `tbl_metdum_jml`;
CREATE TABLE `tbl_metdum_jml` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_metdum_jml"
#

INSERT INTO `tbl_metdum_jml` VALUES (1,'18301',50),(2,'18',10);

#
# Structure for table "tbl_metdum_kbl"
#

DROP TABLE IF EXISTS `tbl_metdum_kbl`;
CREATE TABLE `tbl_metdum_kbl` (
  `id_meter` int(11) NOT NULL AUTO_INCREMENT,
  `no_dummy` varchar(50) NOT NULL DEFAULT '',
  `lokasi_posko` varchar(50) NOT NULL DEFAULT '',
  `nama_cc` varchar(50) NOT NULL DEFAULT '',
  `stand` float(10,2) NOT NULL DEFAULT '0.00',
  `tgl_kembali` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `id_user` tinyint(2) NOT NULL DEFAULT '0',
  `unit` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_meter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tbl_metdum_kbl"
#


#
# Structure for table "tbl_metdum_pakai"
#

DROP TABLE IF EXISTS `tbl_metdum_pakai`;
CREATE TABLE `tbl_metdum_pakai` (
  `id_meter` int(11) NOT NULL AUTO_INCREMENT,
  `no_dummy` varchar(50) NOT NULL DEFAULT '',
  `no_meter_rusak` varchar(50) NOT NULL DEFAULT '',
  `merk_meter_rusak` varchar(15) DEFAULT NULL,
  `alasan_rusak` varchar(10) DEFAULT NULL,
  `tgl_pakai` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ptgs_pasang` varchar(50) NOT NULL DEFAULT '',
  `sisa_pulsa` float(10,2) NOT NULL DEFAULT '0.00',
  `no_hp_plg` varchar(50) NOT NULL DEFAULT '',
  `std_dummy` float(10,2) NOT NULL DEFAULT '0.00',
  `aktivasi` varchar(25) DEFAULT NULL,
  `kembali` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_user` tinyint(2) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_meter`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_metdum_pakai"
#

INSERT INTO `tbl_metdum_pakai` VALUES (14,'1','321','32','1','2018-03-19 19:53:00','321',321.00,'321',321.00,'non aktif','belum','Super Admin',1,'18'),(15,'1','32','32','1','2018-03-24 05:36:16','1',1.00,'1',1.00,'non aktif','belum','Super Admin',1,'18'),(16,'2','3','3','1','2018-03-24 05:39:05','4',3.00,'3',3.00,'non aktif','belum','Super Admin',1,'18'),(25,'7','11','11','1','2018-03-24 07:01:06','11',11.00,'11',11.00,'non aktif','belum','Super Admin',1,'18'),(26,'8','111','11','1','2018-03-24 07:01:42','11',11.00,'11',11.00,'non aktif','belum','Super Admin',1,'18'),(32,'5','212233445','21','1','2018-03-24 09:58:36','iiu',90.00,'909',9.00,'non aktif','belum','Super Admin',1,'18'),(33,'3','212422222','21','1','2018-03-24 10:00:29','0909',909.00,'090',909.00,'non aktif','belum','Super Admin',1,'18'),(34,'6','213555555','21','10','2018-03-24 10:02:11','55',55.00,'55',55.00,'non aktif','belum','Super Admin',1,'18');

#
# Structure for table "tbl_metdum_stok"
#

DROP TABLE IF EXISTS `tbl_metdum_stok`;
CREATE TABLE `tbl_metdum_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_dummy` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) DEFAULT NULL,
  `tgl_pakai` datetime DEFAULT NULL,
  `tgl_aktivasi` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `no_meter_rusak` varchar(25) DEFAULT NULL,
  `posko` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_metdum_stok"
#

INSERT INTO `tbl_metdum_stok` VALUES (1,1,'18301','2018-03-24 05:36:16',NULL,NULL,'ready','32',''),(2,2,'18301','2018-03-24 05:39:05',NULL,NULL,'','3',''),(3,3,'18301','2018-03-24 10:00:29',NULL,NULL,'','212422222',''),(4,4,'18301','2018-03-24 05:46:45',NULL,NULL,'','7',''),(5,5,'18301','2018-03-24 09:58:36',NULL,NULL,'','212233445',''),(6,6,'18301','2018-03-24 10:02:11',NULL,NULL,'','213555555',''),(7,7,'18301','2018-03-24 07:01:06',NULL,NULL,'','11',''),(8,8,'18301','2018-03-24 07:01:42',NULL,NULL,'','111',''),(9,9,'18301',NULL,NULL,NULL,'ready','',''),(10,10,'18301',NULL,NULL,NULL,'ready','',''),(11,11,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(12,12,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(13,13,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(14,14,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(15,15,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(16,16,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(17,17,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(18,18,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(19,19,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(20,20,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(21,21,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(22,22,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(23,23,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(24,24,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(25,25,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(26,26,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(27,27,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(28,28,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(29,29,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(30,30,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(31,31,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(32,32,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(33,33,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(34,34,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(35,35,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(36,36,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(37,37,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(38,38,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(39,39,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(40,40,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(41,41,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(42,42,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(43,43,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(44,44,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(45,45,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(46,46,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(47,47,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(48,48,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(49,49,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(50,50,'18301',NULL,NULL,NULL,'ready',NULL,NULL),(51,1,'18','2018-03-24 05:36:16',NULL,NULL,'','32',''),(52,2,'18','2018-03-24 05:39:05',NULL,NULL,'','3',''),(53,3,'18','2018-03-24 10:00:29',NULL,NULL,'','212422222',''),(54,4,'18','2018-03-24 05:46:45',NULL,NULL,'','7',''),(55,5,'18','2018-03-24 09:58:36',NULL,NULL,'','212233445',''),(56,6,'18','2018-03-24 10:02:11',NULL,NULL,'','213555555',''),(57,7,'18','2018-03-24 07:01:06',NULL,NULL,'','11',''),(58,8,'18','2018-03-24 07:01:42',NULL,NULL,'','111',''),(59,9,'18',NULL,NULL,NULL,'ready','',''),(60,10,'18',NULL,NULL,NULL,'ready','','');

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

#
# Structure for table "tbl_sett"
#

DROP TABLE IF EXISTS `tbl_sett`;
CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `metdum_kbl` tinyint(2) NOT NULL DEFAULT '0',
  `metdum_pakai` tinyint(2) NOT NULL DEFAULT '0',
  `aktivasi` tinyint(2) DEFAULT NULL,
  `dft_aktivasi` tinyint(2) DEFAULT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tbl_sett"
#

INSERT INTO `tbl_sett` VALUES (1,10,5,10,10,1);

#
# Structure for table "tbl_user"
#

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` varchar(25) NOT NULL,
  `unit` varchar(25) NOT NULL DEFAULT '',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "tbl_user"
#

INSERT INTO `tbl_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','Super Admin','-','18',1),(5,'admin_area','e10adc3949ba59abbe56e057f20f883e','Admin Area','123456','183',2),(6,'admin_rayon','e10adc3949ba59abbe56e057f20f883e','Admin Rayon','123456','18301',3),(7,'aktivasi','e10adc3949ba59abbe56e057f20f883e','Admin Aktivasi','123456','18301',4),(8,'posko','e10adc3949ba59abbe56e057f20f883e','Admin Posko','123456321','18301',5);
