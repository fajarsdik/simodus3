-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Mar 2018 pada 10.50
-- Versi server: 5.6.38
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simodusc_simodus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aktivasi`
--

CREATE TABLE `tbl_aktivasi` (
  `id_meter` int(11) NOT NULL,
  `no_dummy` varchar(50) DEFAULT NULL,
  `no_meter_rusak` varchar(50) DEFAULT NULL,
  `merk_meter_rusak` varchar(50) DEFAULT NULL,
  `no_meter_baru` varchar(50) DEFAULT NULL,
  `merk_meter_baru` varchar(50) DEFAULT NULL,
  `id_pelanggan` varchar(50) DEFAULT NULL,
  `tgl_aktivasi` datetime DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_user` tinyint(2) DEFAULT NULL,
  `unit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_aktivasi`
--

INSERT INTO `tbl_aktivasi` (`id_meter`, `no_dummy`, `no_meter_rusak`, `merk_meter_rusak`, `no_meter_baru`, `merk_meter_baru`, `id_pelanggan`, `tgl_aktivasi`, `nama`, `id_user`, `unit`) VALUES
(36, '1', '3245678', '32', '321524', '32', '1845000', '2018-03-23 04:33:15', 'Molek Untuk Aktivasi', 19, '1845'),
(54, '1', '14271234567', '14', '32123456789', '32', '183010023456', '2018-03-26 16:25:43', 'demo', 16, 'demo'),
(55, '2', '3453647568678', '34', '6564763534545', '65', '64684563534', '2018-03-26 17:19:33', 'demo', 16, 'demo'),
(56, '3', '758755875875', '75', '89898', '89', '9', '2018-03-26 16:44:45', 'demo', 16, 'demo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_instansi`
--

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `institusi`, `nama`, `alamat`, `website`, `email`, `logo`, `id_user`) VALUES
(1, 'PT. PLN', 'PT. PLN (Persero) Area Tanjungpinang', 'Smart, Excellent and The Winner!!', 'http://www.pln.co.id', 'fajar.sidik2@pln.co.id', 'logo.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_metdum`
--

CREATE TABLE `tbl_metdum` (
  `id_rec` int(11) NOT NULL,
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
  `unit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_metdum_jml`
--

CREATE TABLE `tbl_metdum_jml` (
  `id` int(11) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_metdum_jml`
--

INSERT INTO `tbl_metdum_jml` (`id`, `unit`, `stok`) VALUES
(1, '18301', 50),
(2, '18309', 30),
(3, '1845', 15),
(4, 'demo', 20),
(5, '18303', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_metdum_kbl`
--

CREATE TABLE `tbl_metdum_kbl` (
  `id_meter` int(11) NOT NULL,
  `no_dummy` varchar(50) NOT NULL DEFAULT '',
  `lokasi_posko` varchar(50) NOT NULL DEFAULT '',
  `nama_cc` varchar(50) NOT NULL DEFAULT '',
  `stand` float(10,2) NOT NULL DEFAULT '0.00',
  `tgl_kembali` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `id_user` tinyint(2) NOT NULL DEFAULT '0',
  `unit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_metdum_kbl`
--

INSERT INTO `tbl_metdum_kbl` (`id_meter`, `no_dummy`, `lokasi_posko`, `nama_cc`, `stand`, `tgl_kembali`, `nama`, `id_user`, `unit`) VALUES
(36, '1', 'molek', 'tes', 3265.00, '2018-03-22 21:34:25', 'Posko Molek', 20, '1845'),
(54, '1', 'demo', 'Zero', 10.00, '2018-03-26 16:33:35', 'demo', 16, 'demo'),
(55, '2', 'demo', 'Fajar', 3123.00, '2018-03-26 20:10:52', 'demo', 16, 'demo'),
(56, '3', 'demo', '9898', 8989.00, '2018-03-26 17:23:19', 'demo', 16, 'demo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_metdum_pakai`
--

CREATE TABLE `tbl_metdum_pakai` (
  `id_meter` int(11) NOT NULL,
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
  `unit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_metdum_pakai`
--

INSERT INTO `tbl_metdum_pakai` (`id_meter`, `no_dummy`, `no_meter_rusak`, `merk_meter_rusak`, `alasan_rusak`, `tgl_pakai`, `ptgs_pasang`, `sisa_pulsa`, `no_hp_plg`, `std_dummy`, `aktivasi`, `kembali`, `nama`, `id_user`, `unit`) VALUES
(36, '1', '3245678', '32', '1', '2018-03-22 21:32:27', 'andri', 1234.00, '0812653212', 123.00, 'aktif', 'sudah', 'Posko Molek', 20, '1845'),
(37, '27', '14269723228', '14', '18', '2018-03-23 02:21:37', 'Otra', 10.84, '082173173522', 498.00, 'non aktif', 'belum', 'UP Senggarang', 9, '18301'),
(38, '40', '86020190020', '86', '15', '2018-03-23 06:39:30', 'Novi', 0.00, '085264293144', 76.00, 'non aktif', 'belum', 'UP Senggarang', 9, '18301'),
(40, '34', '32128308817', '32', '13', '2018-03-23 09:00:24', 'HENDRIK DIKA', 0.00, '082382688811', 662.00, 'non aktif', 'belum', 'Bintan', 8, '18301'),
(41, '21', '60015173028', '60', '4', '2018-03-23 23:09:34', 'OKK DAN JERI', 0.00, '081282672366', 1073.00, 'non aktif', 'belum', 'Bintan', 8, '18301'),
(42, '1', '14276403343', '14', '18', '2018-03-24 06:34:09', 'AKBAR / PERMANA', 0.00, '082391899543', 1172.00, 'non aktif', 'belum', 'Bintan', 8, '18301'),
(46, '1', '11', '11', '1', '2018-03-24 14:45:07', '11', 11.00, '11', 11.00, 'non aktif', 'belum', 'Posko Molek', 20, '1845'),
(48, '15', '86040064296', '86', '18', '2018-03-25 05:15:50', 'AKBAR', 7.97, '081268139269', 935.00, 'non aktif', 'belum', 'Bintan', 8, '18301'),
(49, '5', '45021601054', '45', '18', '2018-03-25 09:25:54', 'Novi', 0.13, '081268121664', 740.00, 'non aktif', 'belum', 'UP Senggarang', 9, '18301'),
(50, '2', '56120079605', '56', '4', '2018-03-25 23:42:54', 'HENDRIK DAN JERI', 5.00, '082391985510', 1017.00, 'non aktif', 'belum', 'Bintan', 8, '18301'),
(51, '20', '081372154181', '08', '18', '2018-03-25 23:44:48', 'HENDRIK DAN JERI', 10.00, '081372154181', 1940.00, 'non aktif', 'belum', 'Bintan', 8, '18301'),
(54, '1', '14271234567', '14', '15', '2018-03-26 09:21:08', 'Hero', 20.00, '081234567891', 1.00, 'aktif', 'sudah', 'demo', 16, 'demo'),
(55, '2', '3453647568678', '34', '3', '2018-03-26 09:44:19', 'Fajar', 21.00, '0811700707', 32.00, 'aktif', 'sudah', 'demo', 16, 'demo'),
(56, '3', '758755875875', '75', '1', '2018-03-26 09:44:20', '57575', 7575.00, '7575', 7575.00, 'aktif', 'sudah', 'demo', 16, 'demo'),
(65, '16', '14269703782', '', '18', '2018-03-26 19:33:47', 'FERDINAN', 0.71, '082383757227', 85.50, 'non aktif', 'belum', 'Posko', 26, '18303');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_metdum_stok`
--

CREATE TABLE `tbl_metdum_stok` (
  `id` int(11) NOT NULL,
  `no_dummy` int(11) NOT NULL DEFAULT '0',
  `unit` varchar(10) DEFAULT NULL,
  `tgl_pakai` datetime DEFAULT NULL,
  `tgl_aktivasi` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `no_meter_rusak` varchar(25) DEFAULT NULL,
  `posko` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_metdum_stok`
--

INSERT INTO `tbl_metdum_stok` (`id`, `no_dummy`, `unit`, `tgl_pakai`, `tgl_aktivasi`, `tgl_kembali`, `status`, `no_meter_rusak`, `posko`) VALUES
(1, 1, '18301', '2018-03-24 13:34:09', '2018-03-26 16:25:43', '2018-03-26 16:30:06', 'ready', '', 'xxxx'),
(2, 2, '18301', '2018-03-26 06:42:54', NULL, NULL, '', '56120079605', 'Bintan'),
(3, 3, '18301', NULL, NULL, NULL, 'ready', '', NULL),
(4, 4, '18301', NULL, NULL, NULL, 'ready', '', ''),
(5, 5, '18301', '2018-03-25 16:25:54', NULL, NULL, '', '45021601054', 'UP Senggarang'),
(6, 6, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(7, 7, '18301', NULL, NULL, NULL, 'ready', NULL, ''),
(8, 8, '18301', NULL, NULL, NULL, 'ready', '', ''),
(9, 9, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(10, 10, '18301', NULL, NULL, NULL, 'ready', '', ''),
(11, 11, '18301', NULL, NULL, NULL, 'ready', '', NULL),
(12, 12, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(13, 13, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(14, 14, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(15, 15, '18301', '2018-03-25 12:15:50', NULL, NULL, '', '86040064296', 'Bintan'),
(16, 16, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(17, 17, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(18, 18, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(19, 19, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(20, 20, '18301', '2018-03-26 06:44:48', NULL, NULL, '', '081372154181', 'Bintan'),
(21, 21, '18301', '2018-03-24 06:09:34', NULL, NULL, '', '60015173028', ''),
(22, 22, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(23, 23, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(24, 24, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(25, 25, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(26, 26, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(27, 27, '18301', '2018-03-23 09:21:37', NULL, NULL, '', '14269723228', ''),
(28, 28, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(29, 29, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(30, 30, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(31, 31, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(32, 32, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(33, 33, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(34, 34, '18301', '2018-03-23 16:00:24', NULL, NULL, '', '32128308817', ''),
(35, 35, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(36, 36, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(37, 37, '18301', NULL, NULL, NULL, 'ready', '', ''),
(38, 38, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(39, 39, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(40, 40, '18301', '2018-03-23 13:39:30', NULL, NULL, '', '86020190020', ''),
(41, 41, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(42, 42, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(43, 43, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(44, 44, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(45, 45, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(46, 46, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(47, 47, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(48, 48, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(49, 49, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(50, 50, '18301', NULL, NULL, NULL, 'ready', NULL, NULL),
(51, 1, '18309', NULL, '2018-03-26 16:25:43', '2018-03-26 16:30:06', 'ready', '', 'xxxx'),
(52, 2, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(53, 3, '18309', NULL, '2018-03-26 16:44:45', '2018-03-26 16:45:22', 'ready', '', '9898'),
(54, 4, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(55, 5, '18309', NULL, NULL, NULL, 'ready', NULL, ''),
(56, 6, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(57, 7, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(58, 8, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(59, 9, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(60, 10, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(61, 11, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(62, 12, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(63, 13, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(64, 14, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(65, 15, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(66, 16, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(67, 17, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(68, 18, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(69, 19, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(70, 20, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(71, 21, '18309', NULL, NULL, NULL, 'ready', NULL, ''),
(72, 22, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(73, 23, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(74, 24, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(75, 25, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(76, 26, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(77, 27, '18309', NULL, NULL, NULL, 'ready', NULL, ''),
(78, 28, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(79, 29, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(80, 30, '18309', NULL, NULL, NULL, 'ready', NULL, NULL),
(81, 1, 'demo', NULL, '2018-03-26 16:25:43', '2018-03-26 16:30:06', 'ready', '', 'demo'),
(82, 2, 'demo', '2018-03-26 16:44:19', '2018-03-26 17:19:33', '2018-03-27 03:10:52', 'ready', '', 'demo'),
(83, 3, 'demo', NULL, '2018-03-26 16:44:45', '2018-03-26 16:45:22', 'ready', '', 'demo'),
(84, 4, 'demo', NULL, NULL, NULL, 'ready', '', 'demo'),
(85, 5, 'demo', NULL, NULL, NULL, 'ready', '', 'demo'),
(86, 1, '1845', '2018-03-24 21:45:07', '2018-03-26 16:25:43', '2018-03-26 16:30:06', 'ready', '', 'xxxx'),
(87, 2, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(88, 3, '1845', NULL, '2018-03-26 16:44:45', '2018-03-26 16:45:22', 'ready', '', '9898'),
(89, 5, '1845', NULL, NULL, NULL, 'ready', NULL, ''),
(90, 4, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(91, 6, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(92, 7, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(93, 8, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(94, 9, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(95, 10, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(96, 11, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(97, 12, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(98, 13, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(99, 14, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(100, 15, '1845', NULL, NULL, NULL, 'ready', NULL, NULL),
(101, 6, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(102, 7, 'demo', NULL, NULL, NULL, 'ready', '', 'demo'),
(103, 8, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(104, 9, 'demo', NULL, NULL, NULL, 'ready', '', 'demo'),
(105, 10, 'demo', NULL, NULL, NULL, 'ready', '', 'demo'),
(106, 11, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(107, 12, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(108, 13, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(109, 14, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(110, 15, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(111, 16, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(112, 17, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(113, 18, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(114, 19, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(115, 20, 'demo', NULL, NULL, NULL, 'ready', NULL, ''),
(116, 1, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(117, 2, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(118, 3, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(119, 4, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(120, 5, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(121, 6, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(122, 7, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(123, 8, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(124, 9, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(125, 10, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(126, 11, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(127, 12, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(128, 13, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(129, 14, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(130, 15, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(131, 16, '18303', '2018-03-27 02:33:47', NULL, NULL, '', '14269703782', 'Posko'),
(132, 17, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(133, 18, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(134, 19, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(135, 20, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(136, 21, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(137, 22, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(138, 23, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(139, 24, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(140, 25, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(141, 26, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(142, 27, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(143, 28, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(144, 29, '18303', NULL, NULL, NULL, 'ready', NULL, NULL),
(145, 30, '18303', NULL, NULL, NULL, 'ready', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_seri_meter`
--

CREATE TABLE `tbl_seri_meter` (
  `Id` varchar(11) NOT NULL DEFAULT '0',
  `merk` varchar(15) NOT NULL DEFAULT '',
  `tipe` varchar(15) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `panjang` varchar(11) NOT NULL DEFAULT '',
  `seri12` varchar(2) DEFAULT NULL,
  `seri34` varchar(2) DEFAULT NULL,
  `jenis` varchar(15) DEFAULT NULL,
  `fasa` varchar(15) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_seri_meter`
--

INSERT INTO `tbl_seri_meter` (`Id`, `merk`, `tipe`, `tahun`, `panjang`, `seri12`, `seri34`, `jenis`, `fasa`) VALUES
('0100', 'Hexing', NULL, NULL, '11', '01', NULL, 'Pra Bayar', '1'),
('1400', 'Hexing', NULL, NULL, '11', '14', NULL, 'Pra Bayar', '1'),
('1600', 'Hexing', 'HXE320', NULL, '8', '16', NULL, 'Paska Bayar', '3'),
('1611', 'Smart', 'SMI-200S', 2016, '11', '16', NULL, 'Paska Bayar', '1'),
('1711', 'Smart', 'SMI-200S', 2017, '11', '17', NULL, 'Paska Bayar', '1'),
('1712', 'Wasion', 'i meter 310', 2017, '12', '17', NULL, 'Paska Bayar', '3'),
('2124', 'Edmi', 'MK6N', 2012, '9', '21', '24', 'Paska Bayar', '3'),
('2133', 'Edmi', 'MK6N', 2013, '9', '21', '33', 'Paska Bayar', '3'),
('2135', 'Edmi', 'MK10', 2013, '9', '21', '35', 'Paska Bayar', '3'),
('2152', 'Edmi', 'MK10E', 2015, '9', '21', '52', 'Paska Bayar', '3'),
('2154', 'Edmi', 'MK10', 2015, '9', '21', '54', 'Paska Bayar', '3'),
('2161', 'Edmi', 'MK10E', 2016, '9', '21', '61', 'Paska Bayar', '3'),
('2163', 'Edmi', 'MK10E', 2016, '9', '21', '63', 'Paska Bayar', '3'),
('2165', 'Edmi', 'MK10E', 2016, '9', '21', '65', 'Paska Bayar', '3'),
('2200', 'Star', NULL, NULL, '11', '22', NULL, 'Pra Bayar', '1'),
('3200', 'Itron', NULL, NULL, '11', '32', NULL, 'Pra Bayar', '1'),
('3400', 'Glomet', NULL, NULL, '11', '34', NULL, 'Pra Bayar', '1'),
('3700', 'Actaris', 'SL7000', NULL, '8', '37', NULL, 'Paska Bayar', '3'),
('4500', 'Sanxing', NULL, NULL, '11', '45', NULL, 'Pra Bayar', '1'),
('5000', 'Cannet', NULL, NULL, '11', '50', NULL, 'Pra Bayar', '1'),
('5200', 'Itron', 'Nias 3', 2017, '10', '52', NULL, 'Paska Bayar', '3'),
('6000', 'FDE', NULL, NULL, '11', '60', NULL, 'Pra Bayar', '1'),
('8600', 'Smart', NULL, NULL, '11', '86', NULL, 'Pra Bayar', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sett`
--

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `metdum_kbl` tinyint(2) NOT NULL DEFAULT '0',
  `metdum_pakai` tinyint(2) NOT NULL DEFAULT '0',
  `aktivasi` tinyint(2) DEFAULT NULL,
  `dft_aktivasi` tinyint(2) DEFAULT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tbl_sett`
--

INSERT INTO `tbl_sett` (`id_sett`, `metdum_kbl`, `metdum_pakai`, `aktivasi`, `dft_aktivasi`, `id_user`) VALUES
(1, 10, 10, 50, 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` varchar(25) NOT NULL,
  `unit` varchar(25) NOT NULL DEFAULT '',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `nip`, `unit`, `admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', '-', '18', 1),
(5, '183admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin Area', '123456', '183', 2),
(6, '18301admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin Rayon', '123456', '18301', 3),
(7, '18301aktivasi', 'e10adc3949ba59abbe56e057f20f883e', 'BC Aktivasi', '123456', '18301', 4),
(8, '18301bintan', 'e10adc3949ba59abbe56e057f20f883e', 'Bintan', '123456321', '18301', 5),
(9, '18301senggarang', 'e10adc3949ba59abbe56e057f20f883e', 'UP Senggarang', '123456321', '18301', 5),
(10, '18309admin', 'e10adc3949ba59abbe56e057f20f883e', 'Spv TE Rayon Kota', '', '18309', 3),
(11, '18309aktivasi', 'e10adc3949ba59abbe56e057f20f883e', 'Kota Aktivasi', '123456', '18309', 4),
(12, '18309penyengat', 'e10adc3949ba59abbe56e057f20f883e', 'UP Penyengat', '123456321', '18309', 5),
(13, '18309pangkil', 'e10adc3949ba59abbe56e057f20f883e', 'UP Pangkil', '123456321', '18309', 5),
(14, '18309karas', 'e10adc3949ba59abbe56e057f20f883e', 'UP Karas', '123456321', '18309', 5),
(15, '18309kota', 'e10adc3949ba59abbe56e057f20f883e', 'Kota', '123456321', '18309', 5),
(16, 'demo', 'e10adc3949ba59abbe56e057f20f883e', 'demo', '123456321', 'demo', 1),
(18, '1845admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin Rayon', '123456', '1845', 3),
(19, '1845aktivasi', 'e10adc3949ba59abbe56e057f20f883e', 'Molek Untuk Aktivasi', '123456', '1845', 4),
(20, '1845molek', 'e10adc3949ba59abbe56e057f20f883e', 'Posko Molek', '123456321', '1845', 5),
(21, '1845bolang', 'e10adc3949ba59abbe56e057f20f883e', 'Posko Bolang', '123456321', '1845', 5),
(22, '18303admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin Rayon', '123456', '18303', 3),
(23, '18303aktivasi', 'e10adc3949ba59abbe56e057f20f883e', 'Aktivasi', '123456', '18303', 4),
(26, '18303uban', 'e10adc3949ba59abbe56e057f20f883e', 'Posko', '123456321', '18303', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_aktivasi`
--
ALTER TABLE `tbl_aktivasi`
  ADD PRIMARY KEY (`id_meter`);

--
-- Indeks untuk tabel `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tbl_metdum`
--
ALTER TABLE `tbl_metdum`
  ADD PRIMARY KEY (`id_rec`);

--
-- Indeks untuk tabel `tbl_metdum_jml`
--
ALTER TABLE `tbl_metdum_jml`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_metdum_kbl`
--
ALTER TABLE `tbl_metdum_kbl`
  ADD PRIMARY KEY (`id_meter`);

--
-- Indeks untuk tabel `tbl_metdum_pakai`
--
ALTER TABLE `tbl_metdum_pakai`
  ADD PRIMARY KEY (`id_meter`);

--
-- Indeks untuk tabel `tbl_metdum_stok`
--
ALTER TABLE `tbl_metdum_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_seri_meter`
--
ALTER TABLE `tbl_seri_meter`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `tbl_sett`
--
ALTER TABLE `tbl_sett`
  ADD PRIMARY KEY (`id_sett`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_aktivasi`
--
ALTER TABLE `tbl_aktivasi`
  MODIFY `id_meter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tbl_metdum`
--
ALTER TABLE `tbl_metdum`
  MODIFY `id_rec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_metdum_jml`
--
ALTER TABLE `tbl_metdum_jml`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_metdum_kbl`
--
ALTER TABLE `tbl_metdum_kbl`
  MODIFY `id_meter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tbl_metdum_pakai`
--
ALTER TABLE `tbl_metdum_pakai`
  MODIFY `id_meter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `tbl_metdum_stok`
--
ALTER TABLE `tbl_metdum_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
