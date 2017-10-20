-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2017 at 09:09 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ha_distribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `container_id` varchar(10) NOT NULL COMMENT 'that''s a unique ID of a container through its liefespan',
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `container_type`
--

CREATE TABLE `container_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `container_type`
--

INSERT INTO `container_type` (`type_id`, `name`) VALUES
(1, '20GP'),
(2, '40GP'),
(3, '40HC');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `number` int(10) UNSIGNED NOT NULL,
  `type` varchar(3) CHARACTER SET latin1 NOT NULL,
  `name` text NOT NULL,
  `representative` text CHARACTER SET latin1 NOT NULL COMMENT 'user representing the entity in the system',
  `hub` varchar(5) NOT NULL COMMENT 'which HUB it belongs to',
  `rate` tinyint(3) UNSIGNED NOT NULL,
  `payment_due` int(10) UNSIGNED NOT NULL COMMENT 'basically, after how many days the payment will be due after invoice date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`number`, `type`, `name`, `representative`, `hub`, `rate`, `payment_due`) VALUES
(10, '', 'Company 1 EMEA', 'dunno yet', 'EMEA', 2, 30),
(100, '', 'Company 1 JAPAC', '', 'JAPAC', 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `doctype` varchar(2) CHARACTER SET latin1 NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`doctype`, `name`) VALUES
('BI', 'Billing Document'),
('MA', 'Material'),
('PO', 'Purchase Order'),
('SD', 'Shipping Document'),
('SO', 'Sales Order');

-- --------------------------------------------------------

--
-- Table structure for table `hub`
--

CREATE TABLE `hub` (
  `hub_code` varchar(5) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `hub`
--

INSERT INTO `hub` (`hub_code`, `name`) VALUES
('EMEA', 'Europe, the Middle East and Africa'),
('JAPAC', 'Asia Pacific and Japan'),
('LATAM', 'Latin America and the Caribbean'),
('NORAM', 'North-America');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_header`
--

CREATE TABLE `invoice_header` (
  `invoice_number` int(10) UNSIGNED NOT NULL,
  `doc_type` varchar(2) NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `doc_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_lineitem`
--

CREATE TABLE `invoice_lineitem` (
  `invoice_number` int(10) UNSIGNED NOT NULL,
  `line_item` int(10) UNSIGNED NOT NULL,
  `po_number` int(10) UNSIGNED NOT NULL,
  `order_number` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` smallint(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `name`, `price`, `status`) VALUES
(35, 'Vacuum Cleaner', 100, 50),
(36, 'Side-by-side Refrigerator', 500, 50),
(41, 'Red Vacuum Cleaner', 60, 50),
(42, 'Toaster', 15, 50),
(43, 'Simple Refrigerator', 300, 50),
(44, 'Blender', 15, 50),
(45, 'Microwave owen - mid', 25, 50);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `order_number` int(10) UNSIGNED NOT NULL,
  `customer` int(10) UNSIGNED NOT NULL COMMENT 'entity table ',
  `agent` int(11) NOT NULL,
  `req_del_dat` date NOT NULL,
  `conf_del_date` date DEFAULT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `doc_type` varchar(2) CHARACTER SET latin1 NOT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'order for promotion/flyer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_number`, `customer`, `agent`, `req_del_dat`, `conf_del_date`, `status`, `doc_type`, `priority`) VALUES
(2, 100, 14, '2018-01-01', '2018-01-10', 11, 'SO', 0),
(3, 100, 14, '2017-10-20', '2018-01-10', 11, 'SO', 0),
(4, 100, 14, '2018-04-20', '0000-00-00', 10, 'SO', 0),
(5, 100, 14, '2018-03-25', '0000-00-00', 10, 'SO', 0),
(6, 10, 14, '2018-05-05', '0000-00-00', 10, 'SO', 0),
(7, 10, 14, '2019-01-01', '2018-03-05', 11, 'SO', 0),
(8, 10, 14, '2019-01-01', '0000-00-00', 10, 'SO', 1),
(9, 10, 14, '1011-10-10', '2018-03-05', 11, 'SO', 0),
(10, 10, 14, '1011-10-10', '0000-00-00', 10, 'SO', 0),
(11, 10, 14, '2018-01-01', '0000-00-00', 10, 'SO', 0),
(12, 10, 14, '2017-12-10', '0000-00-00', 10, 'SO', 0),
(13, 100, 14, '2017-12-11', '0000-00-00', 10, 'SO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_lineitem`
--

CREATE TABLE `order_lineitem` (
  `order_number` int(10) UNSIGNED NOT NULL,
  `line_item` int(10) UNSIGNED NOT NULL,
  `material` smallint(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_lineitem`
--

INSERT INTO `order_lineitem` (`order_number`, `line_item`, `material`, `quantity`) VALUES
(2, 1, 36, 10),
(2, 2, 35, 11),
(3, 1, 35, 10),
(4, 1, 42, 100),
(4, 2, 43, 200),
(4, 3, 36, 10),
(5, 1, 43, 50),
(5, 2, 42, 10),
(5, 3, 41, 6),
(6, 1, 41, 100),
(7, 1, 42, 1),
(8, 1, 35, 10),
(8, 2, 41, 100),
(9, 1, 35, 1),
(10, 1, 35, 1),
(11, 1, 35, 1),
(12, 1, 42, 1),
(12, 2, 45, 23),
(13, 1, 45, 1),
(13, 2, 44, 2),
(13, 3, 43, 3);

-- --------------------------------------------------------

--
-- Table structure for table `po_header`
--

CREATE TABLE `po_header` (
  `po_number` int(10) UNSIGNED NOT NULL,
  `agent` varchar(8) NOT NULL,
  `doc_type` varchar(2) NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_header`
--

INSERT INTO `po_header` (`po_number`, `agent`, `doc_type`, `status`, `delivery_date`) VALUES
(1, '1', 'PO', 20, '2018-01-10'),
(2, '14', 'PO', 20, '2018-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `po_lineitem`
--

CREATE TABLE `po_lineitem` (
  `po_number` int(10) UNSIGNED NOT NULL,
  `line_item` int(10) NOT NULL,
  `order_number` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_lineitem`
--

INSERT INTO `po_lineitem` (`po_number`, `line_item`, `order_number`) VALUES
(1, 1, 2),
(1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(5) UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`) VALUES
(0, 'Deactivated user'),
(1, 'Logistics Coordinator'),
(2, 'Demand Planner'),
(3, 'Production Planner'),
(4, 'Master Data Admin '),
(5, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_header`
--

CREATE TABLE `shipment_header` (
  `shipment_id` int(10) UNSIGNED NOT NULL,
  `doc_type` varchar(2) CHARACTER SET latin1 NOT NULL,
  `status` int(2) UNSIGNED NOT NULL,
  `shipper_id` int(10) UNSIGNED NOT NULL,
  `delivery_date` date NOT NULL COMMENT 'this is to be filled in order as confirmed delivery date',
  `destination` varchar(5) NOT NULL COMMENT 'which HUB it''s being delivered '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_lineitem`
--

CREATE TABLE `shipment_lineitem` (
  `shipment_id` int(10) UNSIGNED NOT NULL,
  `lineitem` int(11) NOT NULL,
  `container_id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `po_number` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_company`
--

CREATE TABLE `shipping_company` (
  `shipper_id` int(10) UNSIGNED NOT NULL,
  `name` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `ZIP` smallint(5) UNSIGNED NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `VAT_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_company`
--

INSERT INTO `shipping_company` (`shipper_id`, `name`, `country_code`, `ZIP`, `city`, `address`, `VAT_number`) VALUES
(2, 0, 'HU', 1144, 'Bp', 'sds', 'HU121212'),
(4, 0, 'CZ', 0, 'sdd', 'sdsd', 'dsd');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(2) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `doc_type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`, `doc_type`) VALUES
(10, 'Open (sent to LC)', 'SO'),
(11, 'In progress', 'SO'),
(12, 'In delivery', 'SO'),
(13, 'Completed', 'SO'),
(20, 'Open', 'PO'),
(21, 'In progress', 'PO'),
(22, 'Production in progress', 'PO'),
(23, 'Shipping', 'PO'),
(24, 'Shipped ', 'PO'),
(30, 'Issued', 'BI'),
(31, 'Due', 'BI'),
(32, 'Settled', 'BI'),
(40, 'Loading', 'SD'),
(41, 'En Route', 'SD'),
(42, 'Unloading', 'SD'),
(50, 'Live', 'MA'),
(51, 'EOL', 'MA');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `storage_location` int(4) UNSIGNED NOT NULL,
  `material` smallint(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `storage_location`
--

CREATE TABLE `storage_location` (
  `storage_id` int(4) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `adrress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(8) NOT NULL COMMENT '6+2: lastname+fname',
  `first_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `role` int(5) UNSIGNED NOT NULL,
  `rw` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `role`, `rw`, `password`, `salt`, `last_login`, `joined`) VALUES
(1, 'karpatzo', 'Zoltan', 'Karpati', 1, 2, '6e9667f78be3d5cb597481e2646af9721e9607dc1e2d883e27bb729561eefc71', '\ZÞeê\Z\"ïåÑE,ÌlGT´®:—,“B‹‰@`', '2017-10-15 14:03:06', '2017-10-04 17:45:38'),
(3, 'DoeJo', 'John', 'Doe', 4, 1, '8293d673e9bdcc9a97ceaa44d12b923d8d6171af5ab27c78f9edc35aa77e5149', '¦µÉqÈ:¡xvwýÀ+7b)¡§ÂPj£©lƒ0', '2017-10-10 20:02:13', '2017-10-06 20:53:26'),
(14, 'SystemAd', 'System', 'Admin', 5, 2, 'c1c1ad22ef89f820de5520b188c4ba046ef7328a18f71137abf8aa4df06f43a1', '¹½†%JkPÇ‡‚z¢<´z+5ß¿#â±F¼¿	~F', '2017-10-10 16:30:26', '2017-10-10 09:51:50'),
(16, 'GibszJa', 'Jakab', 'Gibsz', 2, 2, '00aa85083eecc6154f08761cb87c68ec532302ce313a1ce13b92691262ffd77c', ']¼Ì8\Z°Î—EªgHGW*2(ªºŽJþgöë\'ñ¦A', '2017-10-13 14:18:37', '2017-10-13 16:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`container_id`),
  ADD UNIQUE KEY `container_id` (`container_id`),
  ADD KEY `cont_type_detail` (`type`);

--
-- Indexes for table `container_type`
--
ALTER TABLE `container_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`number`),
  ADD KEY `hub_detail` (`hub`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`doctype`),
  ADD UNIQUE KEY `doctype` (`doctype`);

--
-- Indexes for table `hub`
--
ALTER TABLE `hub`
  ADD PRIMARY KEY (`hub_code`);

--
-- Indexes for table `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD PRIMARY KEY (`invoice_number`),
  ADD KEY `doc_type` (`doc_type`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `invoice_lineitem`
--
ALTER TABLE `invoice_lineitem`
  ADD PRIMARY KEY (`invoice_number`,`line_item`,`po_number`,`order_number`),
  ADD KEY `po_number` (`po_number`),
  ADD KEY `order_number` (`order_number`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`order_number`),
  ADD KEY `Agent` (`agent`),
  ADD KEY `order_to_status` (`status`),
  ADD KEY `doc_type_detials` (`doc_type`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `order_lineitem`
--
ALTER TABLE `order_lineitem`
  ADD PRIMARY KEY (`order_number`,`line_item`),
  ADD KEY `material` (`material`);

--
-- Indexes for table `po_header`
--
ALTER TABLE `po_header`
  ADD PRIMARY KEY (`po_number`),
  ADD KEY `doc_type_details` (`doc_type`),
  ADD KEY `agent` (`agent`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `po_lineitem`
--
ALTER TABLE `po_lineitem`
  ADD PRIMARY KEY (`po_number`,`line_item`),
  ADD UNIQUE KEY `lineitem` (`line_item`),
  ADD KEY `LineItemNr` (`line_item`),
  ADD KEY `OrderReqNr` (`order_number`),
  ADD KEY `PO number` (`po_number`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `shipment_header`
--
ALTER TABLE `shipment_header`
  ADD PRIMARY KEY (`shipment_id`),
  ADD UNIQUE KEY `shipper_id` (`shipper_id`),
  ADD KEY `destination_to_hub` (`destination`),
  ADD KEY `stauts_details` (`status`),
  ADD KEY `doc_type` (`doc_type`);

--
-- Indexes for table `shipment_lineitem`
--
ALTER TABLE `shipment_lineitem`
  ADD PRIMARY KEY (`shipment_id`,`container_id`,`po_number`),
  ADD KEY `po_details` (`po_number`),
  ADD KEY `container_details` (`container_id`);

--
-- Indexes for table `shipping_company`
--
ALTER TABLE `shipping_company`
  ADD PRIMARY KEY (`shipper_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `doc_type` (`doc_type`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD KEY `storage_loc_details` (`storage_location`),
  ADD KEY `material` (`material`);

--
-- Indexes for table `storage_location`
--
ALTER TABLE `storage_location`
  ADD PRIMARY KEY (`storage_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_name` (`role`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `number` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `po_lineitem`
--
ALTER TABLE `po_lineitem`
  MODIFY `line_item` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shipping_company`
--
ALTER TABLE `shipping_company`
  MODIFY `shipper_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `container`
--
ALTER TABLE `container`
  ADD CONSTRAINT `cont_type_detail` FOREIGN KEY (`type`) REFERENCES `container_type` (`type_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `hub_detail` FOREIGN KEY (`hub`) REFERENCES `hub` (`hub_code`);

--
-- Constraints for table `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD CONSTRAINT `invoice_header_ibfk_2` FOREIGN KEY (`doc_type`) REFERENCES `document_type` (`doctype`),
  ADD CONSTRAINT `invoice_header_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `invoice_lineitem`
--
ALTER TABLE `invoice_lineitem`
  ADD CONSTRAINT `invoice_lineitem_ibfk_1` FOREIGN KEY (`invoice_number`) REFERENCES `invoice_header` (`invoice_number`),
  ADD CONSTRAINT `invoice_lineitem_ibfk_2` FOREIGN KEY (`po_number`) REFERENCES `po_header` (`po_number`),
  ADD CONSTRAINT `invoice_lineitem_ibfk_3` FOREIGN KEY (`order_number`) REFERENCES `order_header` (`order_number`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `status_detail` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `order_header`
--
ALTER TABLE `order_header`
  ADD CONSTRAINT `doc_type_detials` FOREIGN KEY (`doc_type`) REFERENCES `document_type` (`doctype`),
  ADD CONSTRAINT `order_header_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`number`),
  ADD CONSTRAINT `order_to_status` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `order_lineitem`
--
ALTER TABLE `order_lineitem`
  ADD CONSTRAINT `order_lineitem_ibfk_1` FOREIGN KEY (`material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `order_lineitem_ibfk_2` FOREIGN KEY (`order_number`) REFERENCES `order_header` (`order_number`);

--
-- Constraints for table `po_header`
--
ALTER TABLE `po_header`
  ADD CONSTRAINT `po_header_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `po_lineitem`
--
ALTER TABLE `po_lineitem`
  ADD CONSTRAINT `po_lineitem_ibfk_1` FOREIGN KEY (`po_number`) REFERENCES `po_header` (`po_number`);

--
-- Constraints for table `shipment_header`
--
ALTER TABLE `shipment_header`
  ADD CONSTRAINT `destination_to_hub` FOREIGN KEY (`destination`) REFERENCES `hub` (`hub_code`),
  ADD CONSTRAINT `shipment_header_ibfk_1` FOREIGN KEY (`doc_type`) REFERENCES `document_type` (`doctype`),
  ADD CONSTRAINT `shipper` FOREIGN KEY (`shipper_id`) REFERENCES `shipping_company` (`shipper_id`),
  ADD CONSTRAINT `stauts_details` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `shipment_lineitem`
--
ALTER TABLE `shipment_lineitem`
  ADD CONSTRAINT `container_details` FOREIGN KEY (`container_id`) REFERENCES `container` (`container_id`),
  ADD CONSTRAINT `po_details` FOREIGN KEY (`po_number`) REFERENCES `po_header` (`po_number`),
  ADD CONSTRAINT `shipment_header` FOREIGN KEY (`shipment_id`) REFERENCES `shipment_header` (`shipment_id`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`doc_type`) REFERENCES `document_type` (`doctype`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`material`) REFERENCES `material` (`id`),
  ADD CONSTRAINT `storage_loc_details` FOREIGN KEY (`storage_location`) REFERENCES `storage_location` (`storage_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_name` FOREIGN KEY (`role`) REFERENCES `roles` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
