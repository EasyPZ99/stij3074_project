-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2022 at 07:54 PM
-- Server version: 10.3.32-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crimsonw_271843_myshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_regdate` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `user_otp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user_id`, `user_name`, `user_email`, `user_password`, `user_regdate`, `user_otp`) VALUES
(2, 'EasyAdmin', 'izzsy1999@gmail.com', '245b4a0dead319a66bc8c13ef93027aae9dde86a', '2022-02-09 16:18:14.177648', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `user_email` varchar(50) NOT NULL,
  `item_id` varchar(10) NOT NULL,
  `cart_qty` int(5) NOT NULL,
  `cart_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_receiptid` varchar(10) NOT NULL,
  `order_itemid` varchar(5) NOT NULL,
  `order_qty` varchar(5) NOT NULL,
  `order_custid` varchar(50) NOT NULL,
  `order_paid` varchar(10) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_receiptid`, `order_itemid`, `order_qty`, `order_custid`, `order_paid`, `order_status`, `order_date`) VALUES
('30lqk4ry', '29', '2', 'ostvswestfast@gmail.com', '40', 'Processing', '2022-02-09 05:16:10.221659'),
('a8hoz6zy', '29', '1', 'ostvswestfast@gmail.com', '20', 'Processing', '2022-02-09 19:19:13.526807');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(5) NOT NULL,
  `payment_receipt` varchar(10) NOT NULL,
  `payment_email` varchar(50) NOT NULL,
  `payment_paid` varchar(10) NOT NULL,
  `payment_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `payment_receipt`, `payment_email`, `payment_paid`, `payment_date`) VALUES
(7, '30lqk4ry', 'ostvswestfast@gmail.com', '40', '2022-02-09 05:16:10.223255'),
(8, 'a8hoz6zy', 'ostvswestfast@gmail.com', '20', '2022-02-09 19:19:13.528401');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `item_id` int(5) NOT NULL,
  `item_title` varchar(200) NOT NULL,
  `item_isbn` varchar(15) NOT NULL,
  `item_price` float NOT NULL,
  `item_description` varchar(500) NOT NULL,
  `item_qty` int(5) NOT NULL,
  `item_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`item_id`, `item_title`, `item_isbn`, `item_price`, `item_description`, `item_qty`, `item_date`) VALUES
(29, 'Aura Mandian ', '1', 20, 'Aura Mandian Afira', 3, '2022-01-25 22:39:54.327550'),
(30, 'Scrub Muka', '12', 25, 'Scrub muka Afira, untuk kegunaan luaran sahaja.', 5, '2022-01-25 22:41:13.022444'),
(31, 'Tungku Herba 7 Aura', '31', 70, 'Tungku digunakan untuk mengurangkan rasa kesakitan tulang.', 5, '2022-01-25 22:43:46.557688'),
(32, 'Minyak Afira Large', '23', 30, 'Minyak Afira Large, diperkaya dengan rempah ratus kini dengan saiz lebih besar.', 5, '2022-01-25 22:45:17.541113'),
(33, 'Minyak Afira', '43', 10, 'Minyak Herba Afira, kaya dengan rempah ratus untuk kegunaan harian.', 5, '2022-01-25 22:54:35.300360'),
(34, 'Eesha', '44', 20, 'Losyen Herba Eesha digunakan untuk luaran', 5, '2022-01-26 17:54:40.967466'),
(35, 'Garam Seri Annur (Bundle) x2', '20', 18, 'Garam Herba Seri Annur x2, jimat lebih murah.', 5, '2022-01-26 17:56:37.015046'),
(37, 'Gelang Batu SCWAROVSKI', '50', 130, 'Gelang buatan sendiri, berbagai pilihan.', 2, '2022-01-26 18:02:05.389743'),
(38, 'Gelang Batu SCWAROVSKI', '51', 130, 'Batu Schwarovski buatan sendiri.', 2, '2022-01-26 18:03:09.031131'),
(39, 'Aura Herba Afira (Package)', '33', 40, 'Aura Herba Afira termasuk package Garam Seri Annur', 5, '2022-01-26 18:04:23.239105'),
(40, 'Minyak Herba Afira x2', '11', 50, 'Minyak Herba Afira package x2 jimat RM10', 5, '2022-01-26 18:05:41.291921'),
(43, 'Garam', '3', 15, 'test', 2, '2022-02-09 16:56:37.852112');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_regdate` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `user_otp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_regdate`, `user_otp`) VALUES
(3, 'Ali', 'mycryptowalletproject@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2022-02-08 17:00:29.745086', '1'),
(4, 'Easy', 'ostvswestfast@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2022-02-09 03:56:47.683920', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `payment_receipt` (`payment_receipt`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
