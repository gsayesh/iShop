-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2020 at 10:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_history`
--

CREATE TABLE `bill_history` (
  `bill_no` varchar(8) NOT NULL,
  `branch` enum('Branch_1','Branch_2') NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `cashier_id` varchar(8) NOT NULL,
  `type` enum('cash','credit') NOT NULL,
  `bill_date` date NOT NULL,
  `amount` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_history`
--

INSERT INTO `bill_history` (`bill_no`, `branch`, `customer_id`, `cashier_id`, `type`, `bill_date`, `amount`) VALUES
('B1000001', 'Branch_1', '947787452v', 'IOTCA01', 'cash', '2020-01-01', '22500.00'),
('B2000001', 'Branch_2', '986578451v', 'IOTCA01', 'credit', '2020-01-03', '16000.00');

-- --------------------------------------------------------

--
-- Table structure for table `bill_item`
--

CREATE TABLE `bill_item` (
  `bill_no` varchar(8) NOT NULL,
  `item_code` char(9) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_item`
--

INSERT INTO `bill_item` (`bill_no`, `item_code`, `quantity`) VALUES
('B1000001', 'PRSP001', 2),
('B2000001', 'PRSP002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(3) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `address` varchar(225) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `mac` char(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `address`, `contact_no`, `mac`) VALUES
(1, 'Walasmulla', 'Walasmulla, Matara', 414578954, 'f0:03:8c:34:f5:9b'),
(2, 'Matara', 'No45, Matara', 414587965, 'a0:3b:56:g6:4h:5k');

-- --------------------------------------------------------

--
-- Stand-in structure for view `branch1_sales_history`
-- (See below for the actual view)
--
CREATE TABLE `branch1_sales_history` (
`bill_no` varchar(8)
,`customer_id` varchar(11)
,`cashier_id` varchar(8)
,`type` enum('cash','credit')
,`bill_date` date
,`amount` decimal(9,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `branch2_sales_history`
-- (See below for the actual view)
--
CREATE TABLE `branch2_sales_history` (
`bill_no` varchar(8)
,`customer_id` varchar(11)
,`cashier_id` varchar(8)
,`type` enum('cash','credit')
,`bill_date` date
,`amount` decimal(9,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `branch_1_store`
-- (See below for the actual view)
--
CREATE TABLE `branch_1_store` (
`item_code` varchar(9)
,`item_name` varchar(50)
,`item_description` varchar(225)
,`whole_sale_price` decimal(8,2)
,`retail_price` decimal(8,2)
,`branch_1` int(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `branch_2_store`
-- (See below for the actual view)
--
CREATE TABLE `branch_2_store` (
`item_code` varchar(9)
,`item_name` varchar(50)
,`item_description` varchar(225)
,`whole_sale_price` decimal(8,2)
,`retail_price` decimal(8,2)
,`branch_2` int(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `nic` varchar(11) NOT NULL,
  `title` enum('Mr','Mrs','Miss','Ms') NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `nick_name` varchar(50) DEFAULT NULL,
  `address` varchar(240) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `contact_no` int(10) NOT NULL,
  `contact_no_2` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`nic`, `title`, `full_name`, `nick_name`, `address`, `dob`, `gender`, `contact_no`, `contact_no_2`) VALUES
('947787452v', 'Mr', 'Vidath Hasantha', 'Vidath', 'No45,Jaffna.', '1994-04-01', 'male', 714587895, 774587895),
('986578451v', 'Mrs', 'Kavindya Hingurage', 'Kavi', 'Kadawatha, Colombo.', '1996-11-27', 'female', 779872145, 714568541);

-- --------------------------------------------------------

--
-- Table structure for table `debitor`
--

CREATE TABLE `debitor` (
  `bil_no` varchar(8) NOT NULL,
  `customer_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debitor`
--

INSERT INTO `debitor` (`bil_no`, `customer_id`) VALUES
('B1000001', '947787452v'),
('B2000001', '986578451v');

-- --------------------------------------------------------

--
-- Table structure for table `debitor_history`
--

CREATE TABLE `debitor_history` (
  `bill_no` varchar(8) NOT NULL,
  `customer_id` varchar(11) NOT NULL,
  `billed_date` date NOT NULL,
  `settled_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debitor_history`
--

INSERT INTO `debitor_history` (`bill_no`, `customer_id`, `billed_date`, `settled_date`) VALUES
('B1000001', '947787452v', '2020-01-01', '2020-01-03'),
('B2000001', '986578451v', '2020-01-03', '2020-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_code` varchar(9) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_description` varchar(225) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `whole_sale_price` decimal(8,2) NOT NULL,
  `retail_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_code`, `item_name`, `item_description`, `cost`, `whole_sale_price`, `retail_price`) VALUES
('PRSP001', 'Huawei Nova 2i', 'Storage 64gb, Ram 4gb', '28000.00', '29000.00', '32000.00'),
('PRSP002', 'Samsung S4', 'Storage 32gb, Ram 3gb', '16000.00', '18000.00', '22000.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `main_store`
-- (See below for the actual view)
--
CREATE TABLE `main_store` (
`item_code` varchar(9)
,`item_name` varchar(50)
,`item_description` varchar(225)
,`whole_sale_price` decimal(8,2)
,`retail_price` decimal(8,2)
,`main` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `return_sale`
--

CREATE TABLE `return_sale` (
  `bill_no` varchar(8) NOT NULL,
  `reason` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_sale`
--

INSERT INTO `return_sale` (`bill_no`, `reason`) VALUES
('B1000001', 'Damage'),
('B2000001', 'Screen damage');

-- --------------------------------------------------------

--
-- Table structure for table `return_sale_item`
--

CREATE TABLE `return_sale_item` (
  `bill_no` varchar(8) NOT NULL,
  `item_code` char(9) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_sale_item`
--

INSERT INTO `return_sale_item` (`bill_no`, `item_code`, `quantity`) VALUES
('B1000001', 'PRSP001', 2),
('B2000001', 'PRSP002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `item_code` char(9) NOT NULL,
  `main` int(5) NOT NULL,
  `branch_1` int(4) NOT NULL,
  `branch_2` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`item_code`, `main`, `branch_1`, `branch_2`) VALUES
('PRSP001', 20, 10, 10),
('PRSP002', 5, 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` char(7) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `nic` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `position` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `nic`, `address`, `gender`, `email`, `contact_no`, `password`, `position`) VALUES
('IOTAD01', 'Kavindu', 'Praneeth', '963323409v', 'Walasmulla,Matara.', 'male', 'kavindupraneeth@gmail.com', 711834260, 'admin123', 'Owner'),
('IOTCA01', 'Bhathiya', 'Prakash', '963323408v', 'Walasmulla, Matara', 'male', 'bathiyaprakash96@gmail.com', 778975462, 'cashier1', 'cashier');

-- --------------------------------------------------------

--
-- Structure for view `branch1_sales_history`
--
DROP TABLE IF EXISTS `branch1_sales_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `branch1_sales_history`  AS  select `bh`.`bill_no` AS `bill_no`,`bh`.`customer_id` AS `customer_id`,`bh`.`cashier_id` AS `cashier_id`,`bh`.`type` AS `type`,`bh`.`bill_date` AS `bill_date`,`bh`.`amount` AS `amount` from (`bill_history` `bh` join `return_sale` `rs`) where `bh`.`bill_no` <> `rs`.`bill_no` and `bh`.`branch` = 'Branch_1' ;

-- --------------------------------------------------------

--
-- Structure for view `branch2_sales_history`
--
DROP TABLE IF EXISTS `branch2_sales_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `branch2_sales_history`  AS  select `bh`.`bill_no` AS `bill_no`,`bh`.`customer_id` AS `customer_id`,`bh`.`cashier_id` AS `cashier_id`,`bh`.`type` AS `type`,`bh`.`bill_date` AS `bill_date`,`bh`.`amount` AS `amount` from (`bill_history` `bh` join `return_sale` `rs`) where `bh`.`bill_no` <> `rs`.`bill_no` and `bh`.`branch` = 'Branch_2' ;

-- --------------------------------------------------------

--
-- Structure for view `branch_1_store`
--
DROP TABLE IF EXISTS `branch_1_store`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `branch_1_store`  AS  select `it`.`item_code` AS `item_code`,`it`.`item_name` AS `item_name`,`it`.`item_description` AS `item_description`,`it`.`whole_sale_price` AS `whole_sale_price`,`it`.`retail_price` AS `retail_price`,`st`.`branch_1` AS `branch_1` from (`item` `it` join `stock` `st`) where `it`.`item_code` = `st`.`item_code` and `st`.`branch_1` > 0 ;

-- --------------------------------------------------------

--
-- Structure for view `branch_2_store`
--
DROP TABLE IF EXISTS `branch_2_store`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `branch_2_store`  AS  select `it`.`item_code` AS `item_code`,`it`.`item_name` AS `item_name`,`it`.`item_description` AS `item_description`,`it`.`whole_sale_price` AS `whole_sale_price`,`it`.`retail_price` AS `retail_price`,`st`.`branch_2` AS `branch_2` from (`item` `it` join `stock` `st`) where `it`.`item_code` = `st`.`item_code` and `st`.`branch_2` > 0 ;

-- --------------------------------------------------------

--
-- Structure for view `main_store`
--
DROP TABLE IF EXISTS `main_store`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `main_store`  AS  select `it`.`item_code` AS `item_code`,`it`.`item_name` AS `item_name`,`it`.`item_description` AS `item_description`,`it`.`whole_sale_price` AS `whole_sale_price`,`it`.`retail_price` AS `retail_price`,`st`.`main` AS `main` from (`item` `it` join `stock` `st`) where `it`.`item_code` = `st`.`item_code` and `st`.`main` > 0 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_history`
--
ALTER TABLE `bill_history`
  ADD PRIMARY KEY (`bill_no`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`nic`);

--
-- Indexes for table `debitor`
--
ALTER TABLE `debitor`
  ADD PRIMARY KEY (`bil_no`);

--
-- Indexes for table `debitor_history`
--
ALTER TABLE `debitor_history`
  ADD PRIMARY KEY (`bill_no`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_code`);

--
-- Indexes for table `return_sale`
--
ALTER TABLE `return_sale`
  ADD PRIMARY KEY (`bill_no`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`item_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `nic` (`nic`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
