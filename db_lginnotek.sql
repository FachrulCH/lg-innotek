-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2016 at 09:55 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_lginnotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `lg_customer`
--

DROP TABLE IF EXISTS `lg_customer`;
CREATE TABLE IF NOT EXISTS `lg_customer` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lg_customer`
--

INSERT INTO `lg_customer` (`id`, `name`, `address`, `email`, `telp`, `contact_person`, `password`) VALUES
('CUS1606', 'Maman', 'jl akjfsjflsjl', 'alul.cholil@yahoo.com', '908080', 'kajflajl', '4504f64ca186c8b5cc1d3fa0af1e160c'),
('CUS1608', 'LGEIN', 'jl lg eim', 'lgein@gmail.com', NULL, 'maman', '74ee55083a714aa3791f8d594fea00c9');

-- --------------------------------------------------------

--
-- Table structure for table `lg_employee`
--

DROP TABLE IF EXISTS `lg_employee`;
CREATE TABLE IF NOT EXISTS `lg_employee` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `group` varchar(3) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lg_employee`
--

INSERT INTO `lg_employee` (`id`, `name`, `email`, `password`, `group`, `telp`) VALUES
('admin', 'admin', 'isnaini592@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '0', '123131'),
('EMP16028', 'Tsubasa Ozora', 'aklfjalkj@kalfjal', NULL, 'INS', '1093103'),
('EMP16030', 'Sukoco', 'isnaini592@gmail.com', NULL, 'OQA', '1212121212'),
('EMP16031', 'Bang Jack', 'email@asep.com', NULL, 'OQA', '98080'),
('EMP16033', 'Inspector Gadget', 'email@asep.com', NULL, 'INS', '232323'),
('EMP16034', 'Asep Gumasep', 'email@asep.com', 'd41d8cd98f00b204e9800998ecf8427e', 'INS', '1212121'),
('EMP16036', 'Joko', 'isnaini592@gmail.com', '4504f64ca186c8b5cc1d3fa0af1e160c', 'OQA', '123131'),
('EMP16037', 'Denti', 'isnaini592@gmail.com', '74ee55083a714aa3791f8d594fea00c9', 'INC', '1212121212');

-- --------------------------------------------------------

--
-- Table structure for table `master_group`
--

DROP TABLE IF EXISTS `master_group`;
CREATE TABLE IF NOT EXISTS `master_group` (
  `group_code` varchar(3) DEFAULT NULL,
  `group_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_group`
--

INSERT INTO `master_group` (`group_code`, `group_name`) VALUES
('SQA', 'Staff OQA'),
('INC', 'Staff Incoming'),
('OQA', 'Operator OQA'),
('INS', 'Inspector');

-- --------------------------------------------------------

--
-- Table structure for table `master_product`
--

DROP TABLE IF EXISTS `master_product`;
CREATE TABLE IF NOT EXISTS `master_product` (
  `part_no` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  PRIMARY KEY (`part_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_product`
--

INSERT INTO `master_product` (`part_no`, `model`) VALUES
('WF1', 'TWFM-B003D'),
('WF2', 'TWFM-L302D'),
('WF3', 'TWFM-L302D');

-- --------------------------------------------------------

--
-- Table structure for table `ng_detail`
--

DROP TABLE IF EXISTS `ng_detail`;
CREATE TABLE IF NOT EXISTS `ng_detail` (
  `id` varchar(10) NOT NULL,
  `ng_item_id` varchar(10) NOT NULL,
  `ng_sub_date` date DEFAULT NULL,
  `ng_result` text,
  `ng_file_name` varchar(50) DEFAULT NULL,
  `ca_description` text,
  `ca_sub_date` date DEFAULT NULL,
  `ca_file_name` varchar(50) DEFAULT NULL,
  `car_sub_date` date DEFAULT NULL,
  `car_file_name` varchar(50) DEFAULT NULL,
  `car_description` text,
  `sp_sub_date` date DEFAULT NULL,
  `sp_employee_id` varchar(10) DEFAULT NULL,
  `sp_inspector_id` varchar(10) DEFAULT NULL,
  `sp_file_name` varchar(50) DEFAULT NULL,
  `in_sub_date` date DEFAULT NULL,
  `in_cipl` varchar(10) DEFAULT NULL,
  `in_staff` varchar(10) DEFAULT NULL,
  `out_sub_date` date DEFAULT NULL,
  `out_file_name` varchar(50) DEFAULT NULL,
  `out_description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ng_detail`
--

INSERT INTO `ng_detail` (`id`, `ng_item_id`, `ng_sub_date`, `ng_result`, `ng_file_name`, `ca_description`, `ca_sub_date`, `ca_file_name`, `car_sub_date`, `car_file_name`, `car_description`, `sp_sub_date`, `sp_employee_id`, `sp_inspector_id`, `sp_file_name`, `in_sub_date`, `in_cipl`, `in_staff`, `out_sub_date`, `out_file_name`, `out_description`) VALUES
('DTL1601', 'NGI1605', '2016-06-07', 'done progress1', '01_detail_kedatangan_ngi1605.xls', 'done dua', '2016-06-07', '02_cipl_cust_ngi1605.pdf', '2016-06-07', '03_car_ngi1605.ppt', 'done progress 2', '2016-06-07', 'EMP16030', 'EMP16028', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DTL1602', 'NGI1606', '2016-06-02', 'oke', 'asoy.pdf', 'ini udah d', '2016-06-07', 'cipl_cust_ngi1606.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ng_incoming`
--

DROP TABLE IF EXISTS `ng_incoming`;
CREATE TABLE IF NOT EXISTS `ng_incoming` (
  `id` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `cust_id` varchar(10) DEFAULT NULL,
  `empl_id` varchar(10) DEFAULT NULL,
  `part_no` varchar(11) DEFAULT NULL,
  `no_cipl` varchar(10) DEFAULT NULL,
  `no_awb` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ng_incoming`
--

INSERT INTO `ng_incoming` (`id`, `date`, `cust_id`, `empl_id`, `part_no`, `no_cipl`, `no_awb`) VALUES
('INC1601', '2016-06-04', 'CUS1606', 'EMP16036', NULL, '111111', '222222'),
('INC1602', '2016-06-04', 'CUS1608', 'EMP16036', 'WF3', '212121', '33333'),
('INC1603', '2016-06-04', 'CUS1606', 'EMP16036', 'WF1', '12121211', '454545454'),
('INC1604', '2016-06-04', 'CUS1606', 'EMP16036', 'WF2', 'sdasdasd32', 'aasdfsfhgf');

-- --------------------------------------------------------

--
-- Table structure for table `ng_items`
--

DROP TABLE IF EXISTS `ng_items`;
CREATE TABLE IF NOT EXISTS `ng_items` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `cust_id` varchar(10) DEFAULT NULL,
  `req_date` date DEFAULT NULL,
  `part_no` varchar(5) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `awb` varchar(50) DEFAULT NULL,
  `remark` text,
  `empl_id` varchar(10) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ng_items`
--

INSERT INTO `ng_items` (`id`, `cust_id`, `req_date`, `part_no`, `quantity`, `awb`, `remark`, `empl_id`, `status`) VALUES
('EMP16036', 'CUS1606', '2016-05-29', 'WF1', 12, 'kahitna', 'kahitna sing', NULL, 0),
('NGI1601', 'CUS1606', '2016-05-29', 'WF2', 1, 'masdkaldjsaljdla', 'kahitna euy', NULL, 1),
('NGI1602', 'CUS1606', '2016-05-29', 'WF3', 12, 'kajflkjflajl', 'lkjlakjflafla\r\n', NULL, 2),
('NGI1603', 'CUS1606', '2016-05-29', 'WF1', 23, 'ssda,sdmakl', 'jlkalkfalflak', NULL, 3),
('NGI1604', 'CUS1606', '2016-06-02', 'WF2', 3, 'ini no AWB logkslfjlksjflksjflsjlkfslkfjslkjflskjf', 'oke', NULL, 0),
('NGI1605', 'CUS1606', '2016-06-02', 'WF1', 12, 'KLMN02309', 'Ini error mas bro', NULL, 3),
('NGI1606', 'CUS1606', '2016-06-02', 'WF3', 3, 'LJFALKJFL-AKSFJL', 'Lapar eiy', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sequences`
--

DROP TABLE IF EXISTS `sequences`;
CREATE TABLE IF NOT EXISTS `sequences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seq_name` varchar(10) NOT NULL,
  `prefix` varchar(3) NOT NULL,
  `year` year(4) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seq_name` (`seq_name`,`year`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `sequences`
--

INSERT INTO `sequences` (`id`, `seq_name`, `prefix`, `year`, `value`) VALUES
(27, 'sqemployee', 'EMP', 2016, 37),
(28, 'sqcustomer', 'CUS', 2016, 8),
(29, 'sqngitem', 'NGI', 2016, 6),
(30, 'sqngdetail', 'DTL', 2016, 2),
(31, 'sqincoming', 'INC', 2016, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
