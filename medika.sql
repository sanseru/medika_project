-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2018 at 08:41 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medika`
--

-- --------------------------------------------------------

--
-- Table structure for table `hse_sasaran_mutu`
--

CREATE TABLE `hse_sasaran_mutu` (
  `id` int(11) NOT NULL,
  `periode` varchar(45) NOT NULL,
  `created_date` varchar(80) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modify_date` varchar(30) NOT NULL,
  `modify_by` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `due_date` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hse_sasaran_mutu`
--

INSERT INTO `hse_sasaran_mutu` (`id`, `periode`, `created_date`, `created_by`, `modify_date`, `modify_by`, `keterangan`, `due_date`) VALUES
(1, 'June 2018', '18-06-06 13:18:53', 'Haris Lukman Hakim', '', '', 'Periode Juni', '30-June-2018'),
(2, 'June 2018', '18-06-07 09:18:14', 'Haris Lukman Hakim', '', '', 'sadsad', '28-June-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hse_sasaran_mutu_detail`
--

CREATE TABLE `hse_sasaran_mutu_detail` (
  `id` int(11) NOT NULL,
  `id_samut` int(12) NOT NULL,
  `departmen` varchar(45) NOT NULL,
  `pic` varchar(45) NOT NULL,
  `due_date` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `goals` varchar(30) NOT NULL,
  `audit` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hse_sasaran_mutu_detail`
--

INSERT INTO `hse_sasaran_mutu_detail` (`id`, `id_samut`, `departmen`, `pic`, `due_date`, `status`, `goals`, `audit`, `keterangan`) VALUES
(1, 2, 'dsfsdf', 'sfsdf', '21-June-2018', 'sdfsdf', 'sfsf', 'sdfsf', 'sdfsf');

-- --------------------------------------------------------

--
-- Table structure for table `m_division_hse`
--

CREATE TABLE `m_division_hse` (
  `id` int(11) NOT NULL,
  `nm_divisi` varchar(125) DEFAULT NULL,
  `pic` varchar(125) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modify_date` varchar(45) DEFAULT NULL,
  `modify_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_division_hse`
--

INSERT INTO `m_division_hse` (`id`, `nm_divisi`, `pic`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'ICT Department', 'Miko Hidayat', '18-06-05 11:50:13', 'Haris Lukman Hakim', '18-06-05 12:04:04', 'Haris Lukman Hakim');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `id_client` int(11) NOT NULL,
  `client_name` varchar(65) DEFAULT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  `client_bank_account` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modify_date` varchar(45) DEFAULT NULL,
  `modify_by` varchar(45) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`id_client`, `client_name`, `bank_name`, `account_name`, `client_bank_account`, `telephone`, `email`, `created_date`, `created_by`, `modify_date`, `modify_by`, `saldo`) VALUES
(2, 'Medikaplaza', 'MANDIRI', 'MEDIKAPLAZA', '123456789', '0217871662', 'medikaplaza@medikapalza.com', '18-05-22 13:34:11', 'Haris Lukman Hakim', NULL, NULL, 56475231);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(21, 2, 1),
(24, 1, 9),
(28, 2, 3),
(29, 2, 2),
(30, 1, 2),
(31, 1, 10),
(32, 1, 11),
(33, 1, 12),
(34, 1, 13),
(35, 3, 11),
(36, 3, 12),
(37, 3, 13),
(38, 3, 10),
(39, 1, 14),
(40, 4, 14),
(41, 1, 15),
(42, 1, 16),
(43, 1, 17),
(45, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_it`
--

CREATE TABLE `tbl_log_it` (
  `id` int(11) NOT NULL,
  `kodekasus` varchar(255) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `client` varchar(45) DEFAULT NULL,
  `nik_user` varchar(45) DEFAULT NULL,
  `permasalahan` longtext,
  `resolusi` longtext,
  `waktu` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `status` enum('s','p') DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modify_date` varchar(45) DEFAULT NULL,
  `modify_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_log_it`
--

INSERT INTO `tbl_log_it` (`id`, `kodekasus`, `user`, `id_user`, `client`, `nik_user`, `permasalahan`, `resolusi`, `waktu`, `created_date`, `status`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'ICT-001', 'Haris Lukman Hakim', 7, 'asdasd', 'asdad', '<p>asdad  fgfgf<b>dfgfdgdfgdfgdfg</b><br></p><br>', 'asdadadad', '01:50:18 16/05/2018', '18-05-16 13:10:34', 's', 'Haris Lukman Hakim', '18-05-16 13:50:26', 'Haris Lukman Hakim'),
(2, 'ICT-002', 'Haris Lukman Hakim', 7, 'terte', 'ertert', 'sadsadasdsad', 'ertretertertretert', '01:45:34 16/05/2018', '18-05-16 13:40:35', '', 'Haris Lukman Hakim', '18-05-16 13:45:39', 'Haris Lukman Hakim'),
(3, 'ICT-003', 'Haris Lukman Hakim', 7, 'asdasd', 'asdad', '<p>asdasdad<br></p>', 'asdadad', '10:43:35 23/05/2018', '18-05-23 10:43:42', 'p', 'Haris Lukman Hakim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'Client', 'Client', 'fa fa-address-card', 11, 'y'),
(11, 'FINANCE', 'Menu_finance', 'fa fa-server', 0, 'y'),
(12, 'Topup', 'Topup', 'fa fa-server', 11, 'y'),
(13, 'TRANSAKSI FINANCE', 'Transaksi_finance', 'fa fa-address-card', 11, 'y'),
(14, 'LOG ICT', 'Log_ict', 'fa fa-server', 0, 'y'),
(15, 'MASTER DIVISI', 'M_division_hse', 'fa fa-server', 16, 'y'),
(16, 'HSE', 'Menu_hse', 'fa fa-server', 0, 'y'),
(17, 'SASARAN MUTU', 'sasaran_mutu', 'fa fa-server', 16, 'y'),
(18, 'SASARAN MUTU DETAIL', 'Hse_sasaran_mutu_detail', 'fa fa-server', 16, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topup`
--

CREATE TABLE `tbl_topup` (
  `id` int(11) NOT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `keterangan` longtext,
  `rekening` varchar(45) DEFAULT NULL,
  `id_client` varchar(45) DEFAULT NULL,
  `client` varchar(45) DEFAULT NULL,
  `jml_topup` varchar(45) DEFAULT NULL,
  `saldo` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `update_by` varchar(45) DEFAULT NULL,
  `update_date` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_topup`
--

INSERT INTO `tbl_topup` (`id`, `no_bukti`, `keterangan`, `rekening`, `id_client`, `client`, `jml_topup`, `saldo`, `created_date`, `created_by`, `update_by`, `update_date`) VALUES
(8, '019283121', 'sadasd', '123456789', '2', 'Medikaplaza', '40000', '56475231', '18-05-23 11:53:05', 'Haris Lukman Hakim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_finance`
--

CREATE TABLE `tbl_transaksi_finance` (
  `id` int(11) NOT NULL,
  `client` varchar(45) DEFAULT NULL,
  `id_client` varchar(45) DEFAULT NULL,
  `nama_rekening` varchar(45) DEFAULT NULL,
  `rekening` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL,
  `saldo` varchar(255) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `upload` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_finance`
--

INSERT INTO `tbl_transaksi_finance` (`id`, `client`, `id_client`, `nama_rekening`, `rekening`, `keterangan`, `no_bukti`, `jumlah`, `saldo`, `created_by`, `created_date`, `upload`) VALUES
(1, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'sad', 'asd', '90000', NULL, 'Haris Lukman Hakim', '18-05-23 10:11:57', ''),
(2, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'Hanya menco saja', 'oaksoaksoa', '12321321', NULL, 'Haris Lukman Hakim', '18-05-23 10:13:26', ''),
(3, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'Hanya menco saja', 'oaksoaksoa', '12321321', NULL, 'Haris Lukman Hakim', '18-05-23 10:14:19', ''),
(4, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'sada', 'asdasd', '90000', NULL, 'Haris Lukman Hakim', '18-05-23 10:14:46', ''),
(5, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'sada', 'asdasd', '90000', NULL, 'Haris Lukman Hakim', '18-05-23 10:15:28', ''),
(6, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'asdad', 'asdasd', '900000', NULL, 'Haris Lukman Hakim', '18-05-23 10:17:23', ''),
(7, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'sdsad', 'asdasd', '9000', NULL, 'Haris Lukman Hakim', '18-05-23 10:43:27', ''),
(8, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'owas/0193/owasa', 'dasdasd', '900000', '57335231', 'Haris Lukman Hakim', '18-05-23 11:49:21', ''),
(9, 'Medikaplaza', '2', 'MANDIRI', '123456789', 'owas/0193/owasa', 'dasdasd', '900000', '56435231', 'Haris Lukman Hakim', '18-05-23 11:49:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'Nuris Akbar M.Kom', 'nuris.akbar@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(3, 'Muhammad hafidz Muzaki', 'hafid@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', '7.png', 2, 'y'),
(7, 'Haris Lukman Hakim', 'lukmanhakim1805@gmail.com', '$2y$04$ADEwcpB9ZovZJ0t/SieGJ.372sIjLdQ/YZ/QjQs5gfK1o1apwxzUS', 'atomix_user311.png', 1, 'y'),
(8, 'Siti Masyitoh', 'siti.masyitoh@medikaplaza.com', '$2y$04$V45RcS3G3.vGszXp1fVntuTqQkuWcGp6uZT.koVkIca8o./7L.RLS', 'atomix_user3112.png', 3, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'finance'),
(4, 'IT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hse_sasaran_mutu`
--
ALTER TABLE `hse_sasaran_mutu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hse_sasaran_mutu_detail`
--
ALTER TABLE `hse_sasaran_mutu_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_division_hse`
--
ALTER TABLE `m_division_hse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log_it`
--
ALTER TABLE `tbl_log_it`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_topup`
--
ALTER TABLE `tbl_topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi_finance`
--
ALTER TABLE `tbl_transaksi_finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hse_sasaran_mutu`
--
ALTER TABLE `hse_sasaran_mutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hse_sasaran_mutu_detail`
--
ALTER TABLE `hse_sasaran_mutu_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_division_hse`
--
ALTER TABLE `m_division_hse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_log_it`
--
ALTER TABLE `tbl_log_it`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_topup`
--
ALTER TABLE `tbl_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_transaksi_finance`
--
ALTER TABLE `tbl_transaksi_finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
