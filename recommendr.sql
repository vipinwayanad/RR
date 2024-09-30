-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 05:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recommendr`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_login`
--

CREATE TABLE `account_login` (
  `email` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `account_type` enum('admin','customer','shop') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_login`
--

INSERT INTO `account_login` (`email`, `account_password`, `account_type`) VALUES
('ajakiran1221@gmail.com', '$2y$10$SvWcaT/EVFsvy07HsbzlQOv4/YkUV8JnoaObO/mBtVUhEwExmhl0K', 'customer'),
('ajakiran@gmail.com', '$2y$10$Nhmjdsv6GL0k2xZf0Vxnuu0uVqWC2ZvWhL7CrXU0Oa3mpYtiSKkgi', 'customer'),
('ajakiranww3@gmail.com', '$2y$10$.li12LRsNfRu4cOmmgWXhuEx/frqTgFwRaRIdKv/gSb5pKbWD2iYG', 'customer'),
('ajakiranww@gmail.com', '$2y$10$vMSuP1H2j708qhNuSQZhye1.WHi0H5t9oxqlIU9eJeW8X23gJ37Ja', 'customer'),
('ajayk@gmail.com', '$2y$10$5ziiJ1hcHukedb1W3zZmO.CLUIVFtea3m6bTxOQQlJQ6enCYWH9fa', 'shop'),
('ajaykiran1221@gmail.com', '$2y$10$dhki/GCYuRLYgStVcJOzput/K.vI.np1gwuTTPCYv9a2Mv5b7xhkS', 'customer'),
('aswin@gmail.com', '$2y$10$IBe/des.jgm/z3U6pq7uf.f79OlFqwJwAYoNJ8584dO1RwFf4/Xnm', 'shop'),
('maxi@gmail.com', '$2y$10$zeykD9neFsNdLQrYKM5Jf.MPpu3C4cDkhFdBhS5SXuf.ikgd6vnwy', 'shop'),
('vipin@gmail.com', '$2y$10$0b27dK9v/8wXFi1fXl/hYuFH7hjwsqc1Omqq84YcTMOOCmP/OsMzy', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_detail`
--

INSERT INTO `customer_detail` (`customer_id`, `firstname`, `lastname`, `email`, `phone`, `address`) VALUES
(1005, 'vipin', 'das', 'vipin@gmail.com', '9876543219', 'wayanad');

-- --------------------------------------------------------

--
-- Table structure for table `customer_need`
--

CREATE TABLE `customer_need` (
  `need_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_need`
--

INSERT INTO `customer_need` (`need_id`, `customer_id`, `item`, `quantity`, `description`) VALUES
(1000, 1005, 'panchasara', 1, '10Kg pack'),
(1001, 1005, 'sa', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reply_messages`
--

CREATE TABLE `reply_messages` (
  `reply_id` int(11) NOT NULL,
  `need_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `Status` enum('pending','accept','reject') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply_messages`
--

INSERT INTO `reply_messages` (`reply_id`, `need_id`, `customer_id`, `shop_id`, `description`, `price`, `Status`) VALUES
(1000, 1000, 1005, 1000, 'Yes i have', '23 rs/pack', 'pending'),
(1001, 1000, 1005, 1001, 'i have', '345 rs/pack', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `shop_detail`
--

CREATE TABLE `shop_detail` (
  `shop_id` int(11) NOT NULL,
  `shopname` varchar(255) NOT NULL,
  `ownername` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_detail`
--

INSERT INTO `shop_detail` (`shop_id`, `shopname`, `ownername`, `email`, `phone`, `address`) VALUES
(1000, 'mexi', 'maxi', 'maxi@gmail.com', '9876543210', 'kjsdfnjsdnhku'),
(1001, 'MARQUE', 'aswin', 'aswin@gmail.com', '9876543210', 'sndjdskjfnjbfdsjbfkjdsbgjdbns,jbds,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_login`
--
ALTER TABLE `account_login`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `customer_need`
--
ALTER TABLE `customer_need`
  ADD PRIMARY KEY (`need_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `reply_messages`
--
ALTER TABLE `reply_messages`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `need_id` (`need_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `shop_detail`
--
ALTER TABLE `shop_detail`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `customer_need`
--
ALTER TABLE `customer_need`
  MODIFY `need_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `reply_messages`
--
ALTER TABLE `reply_messages`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `shop_detail`
--
ALTER TABLE `shop_detail`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD CONSTRAINT `customer_detail_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account_login` (`email`);

--
-- Constraints for table `customer_need`
--
ALTER TABLE `customer_need`
  ADD CONSTRAINT `customer_need_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_detail` (`customer_id`);

--
-- Constraints for table `reply_messages`
--
ALTER TABLE `reply_messages`
  ADD CONSTRAINT `reply_messages_ibfk_1` FOREIGN KEY (`need_id`) REFERENCES `customer_need` (`need_id`),
  ADD CONSTRAINT `reply_messages_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer_detail` (`customer_id`),
  ADD CONSTRAINT `reply_messages_ibfk_3` FOREIGN KEY (`shop_id`) REFERENCES `shop_detail` (`shop_id`);

--
-- Constraints for table `shop_detail`
--
ALTER TABLE `shop_detail`
  ADD CONSTRAINT `shop_detail_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account_login` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
