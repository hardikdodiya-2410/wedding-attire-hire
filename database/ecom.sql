-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 07:28 AM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `status`) VALUES
(1, 'hardik', 'hardik', 1, 'hardikdodiya2410@gmail.com', '1234567890', 1),
(2, 'admin', 'admin', 0, 'admin@gmaol.com', '2345678910', 1),
(4, 'vinay', 'vinay', 1, 'vinay@gmail.com', '7285008403', 1),
(5, 'keval', 'keval', 1, 'kevaldodiya40@gmail.com', '8200500184', 1),
(7, 'meet', 'dfhfgh', 1, 'hardik@gmail.com', '7285008403', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Women', 1),
(2, 'men', 1);

-- --------------------------------------------------------

--
-- Table structure for table `color_master`
--

CREATE TABLE `color_master` (
  `id` int(11) NOT NULL,
  `color` varchar(200) NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color_master`
--

INSERT INTO `color_master` (`id`, `color`, `color_name`, `order_by`, `status`) VALUES
(1, '#F2D1A0', 'Golden Fleece', 0, 1),
(2, '#F8FAEE', 'Rare White Color', 0, 1),
(3, '#B3D9BE', 'Pretty Light Green Color', 0, 1),
(4, '#FFF8E7', 'Cosmic Latte', 0, 1),
(5, '#BE4F49', 'Deep Chestnut', 0, 1),
(6, '#2A292B', 'Galaxy Black', 0, 1),
(7, '#0C1232', 'Dark Blue', 0, 1),
(8, '#944C58', 'Maroon', 0, 1),
(9, '#DCD0FF', 'Pale Lavender', 0, 1),
(10, '#B4A8AD', 'Silver Chalice', 0, 1),
(11, '#712A2F', 'Puce Red', 0, 1),
(12, '#D9DAD9', 'Light Silver\r\n', 11, 1),
(13, '#8CA293', ' Morning Blue', 12, 1),
(15, '#F1C7D1', 'Orchid Pink', 1, 1),
(16, '#B6000D', 'UE Red', 15, 1),
(17, '#CFE3E9', ' Columbia Blue', 16, 1),
(18, '#E8DBC6 ', 'cream', 17, 1),
(19, '#6A4536', 'Coffee', 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(1, 'HARDIK', 'hardikdodiya2410@gmail.com', '7285008403', 'hi', '24-03-2025 05:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(10) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`) VALUES
(1, 'first%5', 5, 'Percentage', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `length` float NOT NULL,
  `breadth` float NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `mihpayid` varchar(200) NOT NULL,
  `ship_order_id` int(11) NOT NULL,
  `ship_shipment_id` int(11) NOT NULL,
  `payu_status` varchar(10) NOT NULL,
  `added_on` datetime NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `length`, `breadth`, `height`, `weight`, `txnid`, `mihpayid`, `ship_order_id`, `ship_shipment_id`, `payu_status`, `added_on`, `coupon_id`, `coupon_code`, `coupon_value`) VALUES
(1, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 5697, 'success', 1, 0, 0, 0, 0, '13e25ee2aaa882349c74', '', 0, 0, '', '2025-03-24 11:08:39', 1, 'First%5', 300),
(2, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 5997, 'success', 1, 0, 0, 0, 0, 'b403577fcf25b989b1d4', '', 0, 0, '', '2025-03-24 11:08:49', 0, '', 0),
(3, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 8997, 'success', 1, 0, 0, 0, 0, 'b7e503b91647b6ed9144', '', 0, 0, '', '2025-03-24 11:09:55', 0, '', 0),
(4, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 8997, 'success', 1, 0, 0, 0, 0, 'a630bd7efd41f0bd1f60', '', 0, 0, '', '2025-03-24 11:11:29', 0, '', 0),
(5, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 5997, 'success', 1, 0, 0, 0, 0, '2e5054ec60ffb78a2e77', '', 0, 0, '', '2025-03-24 11:12:05', 0, '', 0),
(6, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 5997, 'success', 1, 0, 0, 0, 0, '2d8700f60eead3fff9d2', '', 0, 0, '', '2025-03-24 11:13:16', 0, '', 0),
(7, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 5998, 'success', 1, 0, 0, 0, 0, 'f6a58923881c324016dd', '', 0, 0, '', '2025-03-24 11:13:50', 0, '', 0),
(8, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 5998, 'success', 1, 0, 0, 0, 0, 'b2df0f939bd356dee076', '', 0, 0, '', '2025-03-24 11:15:11', 0, '', 0),
(9, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 8997, 'success', 1, 0, 0, 0, 0, 'a2de9608427d63ed2b46', '', 0, 0, '', '2025-03-24 11:15:41', 0, '', 0),
(10, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 47976, 'pending', 1, 0, 0, 0, 0, '1711999c3465f3fff890', '', 0, 0, '', '2025-03-24 11:18:28', 0, '', 0),
(11, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 47976, 'pending', 1, 0, 0, 0, 0, '6b6e0383f8784c1f9b54', '', 0, 0, '', '2025-03-24 11:18:49', 0, '', 0),
(12, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 8997, 'pending', 1, 0, 0, 0, 0, 'f254185a814fb2d306e7', '', 0, 0, '', '2025-03-24 11:20:14', 0, '', 0),
(13, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'pending', 1, 0, 0, 0, 0, '0a689cdbbc46d8462792', '', 0, 0, '', '2025-03-24 11:23:06', 0, '', 0),
(14, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'pending', 1, 0, 0, 0, 0, '9d2695e2722861f9045a', '', 0, 0, '', '2025-03-24 11:25:20', 0, '', 0),
(15, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 53994, 'pending', 1, 0, 0, 0, 0, 'a23eecdf399434713159', '', 0, 0, '', '2025-03-24 11:26:22', 0, '', 0),
(16, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 0, 'success', 1, 0, 0, 0, 0, '69b7ed06d827c267a6c1', '', 0, 0, '', '2025-03-24 11:26:46', 0, '', 0),
(17, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, '7ebeb71e4528d4966028', '', 0, 0, '', '2025-03-24 11:27:15', 0, '', 0),
(18, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, 'b6fc1e6d520df1d5b1c1', '', 0, 0, '', '2025-03-24 11:29:37', 0, '', 0),
(19, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, 'a9ec87c405cfe3fe3790', '', 0, 0, '', '2025-03-24 11:30:13', 0, '', 0),
(20, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, 'bf796e2833b03b2211df', '', 0, 0, '', '2025-03-24 11:30:31', 0, '', 0),
(21, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, 'a74394caddf26ea805d9', '', 0, 0, '', '2025-03-24 11:31:43', 0, '', 0),
(22, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, '56ba0c830ac9333fc03f', '', 0, 0, '', '2025-03-24 11:32:34', 0, '', 0),
(23, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, '4b4d99e341d262c67c58', '', 0, 0, '', '2025-03-24 11:33:31', 0, '', 0),
(24, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 26997, 'success', 1, 0, 0, 0, 0, '59755f7da62a7b8a5b6c', '', 0, 0, '', '2025-03-24 11:33:46', 0, '', 0),
(25, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 44995, 'success', 1, 0, 0, 0, 0, 'b643a171d10e4e808443', '', 0, 0, '', '2025-03-24 11:34:32', 0, '', 0),
(26, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 44995, 'success', 1, 0, 0, 0, 0, 'bad2f1b28fd9bf32734d', '', 0, 0, '', '2025-03-24 11:34:38', 0, '', 0),
(27, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 107988, 'success', 1, 0, 0, 0, 0, '170f67ad229ba6b70c98', '', 0, 0, '', '2025-03-24 11:35:32', 0, '', 0),
(28, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 215976, 'success', 1, 0, 0, 0, 0, '0683711cc15639c5ec82', '', 0, 0, '', '2025-03-24 11:36:18', 0, '', 0),
(29, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 80991, 'success', 1, 0, 0, 0, 0, '00bc6b8d2c07a53fcf47', '', 0, 0, '', '2025-03-24 11:38:12', 0, '', 0),
(30, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 80991, 'success', 1, 0, 0, 0, 0, 'b666133ba49af3dda8fc', '', 0, 0, '', '2025-03-24 11:38:49', 0, '', 0),
(31, 5, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 80991, 'success', 1, 0, 0, 0, 0, '026e01b463b54199a229', '', 0, 0, '', '2025-03-24 11:40:30', 0, '', 0),
(32, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 107988, 'success', 1, 0, 0, 0, 0, 'ce657978d1125b96ee6c', '', 0, 0, '', '2025-03-24 11:41:29', 0, '', 0),
(33, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 51294, 'success', 1, 0, 0, 0, 0, '50a7d62e93b256731adf', '', 0, 0, '', '2025-03-24 11:42:59', 1, 'First%5', 2700),
(34, 6, 'Bhavnagar-364001', 'Bhavnagar', 364001, 'COD', 51294, 'success', 1, 0, 0, 0, 0, '34b777942f2f39f22e09', '', 0, 0, '', '2025-03-25 10:06:41', 1, 'First%5', 2700);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rent_from` date DEFAULT NULL,
  `rent_to` date DEFAULT NULL,
  `rental_days` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `product_attr_id`, `qty`, `rent_from`, `rent_to`, `rental_days`, `price`) VALUES
(1, 1, 13, 27, 1, '2025-03-25', '2025-03-29', 3, 1999),
(2, 2, 13, 27, 1, '2025-03-25', '2025-03-29', 3, 1999),
(3, 3, 14, 28, 1, '2025-03-25', '2025-03-29', 3, 2999),
(4, 5, 13, 27, 1, '2025-03-25', '2025-03-29', 3, 1999),
(5, 6, 13, 27, 1, '2025-03-25', '2025-03-29', 3, 1999),
(6, 7, 12, 25, 1, '2025-03-25', '2025-03-28', 2, 2999),
(7, 8, 12, 25, 1, '2025-03-25', '2025-03-28', 2, 2999),
(8, 9, 12, 25, 1, '2025-03-25', '2025-03-29', 3, 2999),
(9, 10, 13, 27, 1, '2025-04-01', '2025-04-26', 24, 1999),
(10, 12, 12, 25, 1, '2025-03-25', '2025-03-29', 3, 2999),
(11, 13, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(12, 14, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(13, 15, 17, 33, 1, '2025-03-28', '2025-04-04', 6, 8999),
(14, 17, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(15, 18, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(16, 21, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(17, 22, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(18, 23, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(19, 24, 17, 33, 1, '2025-03-25', '2025-03-29', 3, 8999),
(20, 25, 17, 33, 5, '2025-03-26', '2025-03-28', 1, 8999),
(21, 26, 17, 33, 5, '2025-03-26', '2025-03-28', 1, 8999),
(22, 27, 17, 33, 4, '2025-03-25', '2025-03-29', 3, 8999),
(23, 28, 17, 33, 12, '2025-03-25', '2025-03-28', 2, 8999),
(24, 29, 17, 33, 3, '2025-03-25', '2025-03-29', 3, 8999),
(25, 30, 17, 33, 3, '2025-03-25', '2025-03-29', 3, 8999),
(26, 31, 17, 33, 3, '2025-03-25', '2025-03-29', 3, 8999),
(27, 32, 17, 33, 4, '2025-03-25', '2025-03-29', 3, 8999),
(28, 33, 17, 33, 2, '2025-03-25', '2025-03-29', 3, 8999),
(29, 34, 17, 33, 3, '2025-03-26', '2025-03-29', 2, 8999);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Return Product');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `best_seller` int(11) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `sub_categories_id`, `name`, `image`, `short_desc`, `description`, `best_seller`, `meta_title`, `meta_desc`, `meta_keyword`, `status`, `added_by`) VALUES
(1, 2, 4, 'Chatenya Mittal', '568828499_chatenya1.jpg', 'A classy beige sherwani with beautifully detailed motifs all over, adding a touch of charm and elegance.', 'A classy beige sherwani with beautifully detailed motifs all over, adding a touch of charm and elegance.', 1, 'Wah-Men-Chatenya Mittal', 'Wah-Men-Chatenya Mittal', 'Wah-Men-Chatenya Mittal', 1, 2),
(2, 2, 4, 'LDS', '221758020_LDSm1.jpg', 'A light green sherwani with elegant golden detailing, highlighted by intricate accents on the pocket for a regal touch.', 'A light green sherwani with elegant golden detailing, highlighted by intricate accents on the pocket for a regal touch.', 0, 'Wah-Men-LDS', 'Wah-Men-LDS', 'Wah-Men-LDS', 1, 2),
(3, 2, 4, 'Kosho', '778469552_kosho1.jpg', 'A beige sherwani adorned with intricate golden and red floral embroidery for a regal and elegant look', 'A beige sherwani adorned with intricate golden and red floral embroidery for a regal and elegant look', 1, 'Wah-Men-Kosho', 'Wah-Men-Kosho', 'Wah-Men-Kosho', 1, 2),
(4, 2, 4, 'Sash Bespoke', '393992663_SASHbespoke1.jpg', 'A luxurious white sherwani adorned with an intricate golden floral pattern, creating a refined and elegant look.', 'A luxurious white sherwani adorned with an intricate golden floral pattern, creating a refined and elegant look.', 1, 'Wah-Men-Sash Bespoke', 'Wah-Men-Sash Bespoke', 'Wah-Men-Sash Bespoke', 1, 2),
(5, 2, 4, 'cosette', '302974574_cosette.jpg', 'A coral orange sherwani adorned with delicate beaded embroidery detailing for a refined and elegant look.', 'A coral orange sherwani adorned with delicate beaded embroidery detailing for a refined and elegant look.', 0, 'Wah-Men-cosette', 'Wah-Men-cosette', 'Wah-Men-cosette', 1, 2),
(6, 2, 4, 'Raaya', '187048751_raayas1.jpg', 'Cream sherwani with golden and maroon embroidery styled with maroon velvet peshawari, maroon chudiddar and maroon velvet printed stole.', 'Cream sherwani with golden and maroon embroidery styled with maroon velvet peshawari, maroon chudiddar and maroon velvet printed stole.', 1, 'Wah-Men-Raaya', 'Wah-Men-Raaya', 'Wah-Men-Raaya', 1, 2),
(7, 2, 5, 'Sash Bespoke suit', '143451588_Sash Bespoke1.jpg', 'A refined black patterned suit featuring statement buttons, exuding sophistication with a bold and distinctive touch.', 'A refined black patterned suit featuring statement buttons, exuding sophistication with a bold and distinctive touch.', 0, 'Wah-Men-Sash Bespoke', 'Wah-Men-Sash Bespoke', 'Wah-Men-Sash Bespoke', 1, 2),
(8, 2, 5, 'Nero By Shaifali & Satya', '216645342_neroby1.jpg', 'A sophisticated black Jodhpuri suit featuring a stylish patterned collar for a regal and refined look.', 'A sophisticated black Jodhpuri suit featuring a stylish patterned collar for a regal and refined look.', 1, 'Wah-Men-\r\nNero By Shaifali & Satya', 'Wah-Men-\r\nNero By Shaifali & Satya', 'Wah-Men-\r\nNero By Shaifali & Satya', 1, 2),
(9, 2, 5, 'The Maroon Suit', '346130570_mAROON1.jpg', 'A dual-toned blazer in navy blue and purple, creating a unique and stylish look for formal or semi-formal occasions', 'A dual-toned blazer in navy blue and purple, creating a unique and stylish look for formal or semi-formal occasions', 1, 'Wah-Men-\r\nThe Maroon Suit', 'Wah-Men-\r\nThe Maroon Suit', 'Wah-Men-\r\nThe Maroon Suit', 1, 2),
(10, 2, 5, 'Raaya-Suit', '666788678_raaya1.jpg', 'A Textured Navy Blue Indo-Western Jodhpuri adorned with intricate golden embroidery, perfect for a sophisticated and stylish look.', 'A Textured Navy Blue Indo-Western Jodhpuri adorned with intricate golden embroidery, perfect for a sophisticated and stylish look.', 1, 'Wah-Men-\r\nRaaya-Suit', 'Wah-Men-\r\nRaaya-Suit', 'Wah-Men-\r\nRaaya-Suit', 1, 2),
(11, 2, 5, 'Maroon Suit', '919348137_the_maroon1.jpeg', 'A maroon suit paired with a matching maroon tie, creating a coordinated and sophisticated look.', 'A maroon suit paired with a matching maroon tie, creating a coordinated and sophisticated look.', 1, 'Wah-Men-\r\n Maroon Suit', 'Wah-Men-\r\nMaroon Suit', 'Wah-Men-\r\n Maroon Suit', 1, 2),
(12, 2, 6, 'Kora', '813610964_kora1.jpg', 'A sleek Black Velvet Blazer featuring intricate sequin detailing on the lapel, paired effortlessly with smart trousers for a sophisticated and stylish look.', 'A sleek Black Velvet Blazer featuring intricate sequin detailing on the lapel, paired effortlessly with smart trousers for a sophisticated and stylish look.', 1, 'Wah-Men-kora', 'Wah-Men-kora', 'Wah-Men-kora', 1, 2),
(13, 2, 6, 'Marooned', '633363106_Marooned1.jpeg', 'A lilac blazer accessorized with a brooch, adding a touch of elegance and style to your ensemble.', 'A lilac blazer accessorized with a brooch, adding a touch of elegance and style to your ensemble.', 1, 'Wah-Men-Marooned', 'Wah-Men-Marooned', 'Wah-Men-Marooned', 1, 2),
(14, 2, 6, 'M-Suit', '652954161_Wah-Men-Marooned-gray.jpeg', 'A solid grey blazer, perfect for adding a touch of sophistication to any outfit.', 'A solid grey blazer, perfect for adding a touch of sophistication to any outfit.', 1, 'Wah-Men-M-Suit', 'Wah-Men-M-Suit', 'Wah-Men-M-Suit', 1, 2),
(17, 1, 1, 'Frontier Raas', '753339551_frontier1.jpg', 'A timeless red bridal lehenga adorned with intricate golden embroidery, exuding regal elegance and traditional charm.', 'A timeless red bridal lehenga adorned with intricate golden embroidery, exuding regal elegance and traditional charm.', 1, 'Wah-Women-Frontier Raas', 'Wah-Women-Frontier Raas', 'Wah-Women-Frontier Raas', 1, 2),
(18, 1, 1, 'Sash Bespoke Leigha', '244719121_Sash BespokeWomen-1.jpg', 'A stunning red lehenga adorned with intricate golden embroidery, paired with a matching blouse and dupatta for a regal look.', 'A stunning red lehenga adorned with intricate golden embroidery, paired with a matching blouse and dupatta for a regal look.', 1, 'Wah-Women-Sash Bespoke', 'Wah-Women-Sash Bespoke', 'Wah-Women-Sash Bespoke', 1, 2),
(19, 1, 0, 'LDSW', '269777796_lds1.jpg', 'A regal maroon bridal lehenga adorned with intricate sequin and beaded embroidery, exuding elegance and grandeur.', 'A regal maroon bridal lehenga adorned with intricate sequin and beaded embroidery, exuding elegance and grandeur.', 1, 'Wah-Women-LDS', 'Wah-Women-LDS', 'Wah-Women-LDS', 1, 2),
(20, 1, 1, 'ayushi Bhasin', '873967850_ayshi1.jpeg', 'A nude embellished lehenga paired with a stylish blouse, offering a perfect blend of elegance and modern charm.', 'A nude embellished lehenga paired with a stylish blouse, offering a perfect blend of elegance and modern charm.', 1, 'Wah-Women-ayushi Bhasin', 'Wah-Women-ayushi Bhasin', 'Wah-Women-ayushi Bhasin', 1, 2),
(21, 1, 1, 'Kalki', '765758358_afd7dddcabbdc5d1178f91d0d8613b74.jpg', 'An Olive Green Bridal Lehenga, fully embroidered with intricate detailing, styled with a double dupatta, an embroidered blouse, and a coordinating belt.', 'An Olive Green Bridal Lehenga, fully embroidered with intricate detailing, styled with a double dupatta, an embroidered blouse, and a coordinating belt.', 1, 'Wah-Women- Kalki', 'Wah-Women- Kalki', 'Wah-Women- Kalki', 1, 2),
(22, 1, 1, 'Dolly J', '618265236_85dbec05e46aeb975f947e676178dd78.jpg', 'A breathtaking Pastel Pink hand-embroidered Bridal Lehenga, paired with a designer blouse and a delicate net dupatta, exuding elegance and charm fit for a bride.', 'A breathtaking Pastel Pink hand-embroidered Bridal Lehenga, paired with a designer blouse and a delicate net dupatta, exuding elegance and charm fit for a bride.', 1, 'Wah-Women-Dolly J', 'Wah-Women-Dolly J', 'Wah-Women-Dolly J', 1, 2),
(23, 1, 1, 'Zardozi', '824990930_d96c52e1c0d6a2e4e45dbf0600059638.jpg', 'A stunning Red Bridal Lehenga adorned with heavy embroidery, paired with a net dupatta, exuding timeless elegance and grandeur fit for a bride.', 'A stunning Red Bridal Lehenga adorned with heavy embroidery, paired with a net dupatta, exuding timeless elegance and grandeur fit for a bride.', 1, 'Wah-Women-Zardozi', 'Wah-Women-Zardozi', 'Wah-Women-Zardozi', 1, 2),
(24, 1, 2, 'Raj Gharana', '116348786_5aff7bcbf5ea9cb2c7e18c7c78c64c80.jpg', 'A stunning powder blue lehenga adorned with intricate mirror work, exuding grace and contemporary elegance.', 'A stunning powder blue lehenga adorned with intricate mirror work, exuding grace and contemporary elegance.', 1, 'Wah-Women-Raj Gharana', 'Wah-Women-Raj Gharana', 'Wah-Women-Raj Gharana', 1, 2),
(25, 1, 2, 'Vandana Sethi', '800263949_vadana1.jpg', 'An elegant ivory lehenga adorned with delicate pearls all over, paired with a matching pearl-embellished blouse.', 'An elegant ivory lehenga adorned with delicate pearls all over, paired with a matching pearl-embellished blouse.', 1, 'Wah-Women-Vandana Sethi', 'Wah-Women-Vandana Sethi', 'Wah-Women-Vandana Sethi', 1, 2),
(26, 1, 2, 'azaleass', '114716734_azaleass.jpg', 'A strapless blouse paired with a flared lehenga, intricately adorned with silver sequins and pearl tassels, creating a perfect blend of sophistication, elegance, and opulent charm.', 'A strapless blouse paired with a flared lehenga, intricately adorned with silver sequins and pearl tassels, creating a perfect blend of sophistication, elegance, and opulent charm.', 0, 'Wah-Women-azaleass', 'Wah-Women-azaleass', 'Wah-Women-azaleass', 1, 2),
(27, 1, 2, 'Seema Gujral', '632347034_3aaf0f555100bf577a059c5016adfa82.jpg', 'A Mirror Work Beige Designer Lehenga, fully embroidered, combining traditional craftsmanship with contemporary elegance.', 'A Mirror Work Beige Designer Lehenga, fully embroidered, combining traditional craftsmanship with contemporary elegance.', 0, 'Wah-Women-Seema Gujral', 'Wah-Women-Seema Gujral', 'Wah-Women-Seema Gujral', 1, 2),
(28, 1, 2, 'Feather Emerald', '532524908_a4d0ce3ba573de974f55004458898069.jpg', 'A sea green lehenga with a feather-adorned blouse, paired with a delicate net blouse and dupatta for an elegant look.', 'A sea green lehenga with a feather-adorned blouse, paired with a delicate net blouse and dupatta for an elegant look.', 1, 'Wah-Women-Feather Emerald', 'Wah-Women-Feather Emerald', 'Wah-Women-Feather Emerald', 1, 2),
(29, 1, 3, 'Pallod', '939768604_pallod.jpg', 'Pink heavy gown with intricate embroidery work.', 'Pink heavy gown with intricate embroidery work.', 1, 'Wah-Women-Pallod', 'Wah-Women-Pallod', 'Wah-Women-Pallod', 1, 2),
(30, 1, 3, 'Pearl Elegance', '282867766_da51fa87acb8f64824d0a3472760e2f2.jpg', 'Cream flared gown with scattered pearl work', 'Cream flared gown with scattered pearl work', 1, 'Wah-Women-Pearl Elegance', 'Wah-Women-Pearl Elegance', 'Wah-Women-Pearl Elegance', 1, 2),
(31, 1, 3, 'Aqua Elegance', '155960805_92a166b86dc41e99a9eef0d10a23285b.jpg', 'An Aqua Blue gown featuring heavy embroidery on the top and a voluminous ruffled skirt, exuding glamour and elegance, perfect for a formal event or a special occasion.', 'An Aqua Blue gown featuring heavy embroidery on the top and a voluminous ruffled skirt, exuding glamour and elegance, perfect for a formal event or a special occasion.', 1, 'Wah-Women-Aqua Elegance', 'Wah-Women-Aqua Elegance', 'Wah-Women-Aqua Elegance', 1, 2),
(32, 1, 3, 'Golden Majesty', '367823744_a38098e55dd3782835b69aa341241937.jpg', 'A lavish golden lehenga adorned with intricate heavy beaded embroidery, paired with a matching blouse and a graceful net dupatta for a regal look.', 'A lavish golden lehenga adorned with intricate heavy beaded embroidery, paired with a matching blouse and a graceful net dupatta for a regal look.', 1, 'Wah-Women-Golden Majesty', 'Wah-Women-Golden Majesty', 'Wah-Women-Golden Majesty', 1, 2),
(33, 1, 3, 'Ethereal Cowl', '816799601_9ca5e81b5c97abcc91d03da4b6ae41ef.jpg', 'A white gown featuring a delicate net cover and a graceful cowl net attachment, embodying ethereal beauty and refined sophistication.', 'A white gown featuring a delicate net cover and a graceful cowl net attachment, embodying ethereal beauty and refined sophistication.', 1, 'Wah-Women-Ethereal Cowl', 'Wah-Women-Ethereal Cowl', 'Wah-Women-Ethereal Cowl', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `size_id`, `color_id`, `mrp`, `price`, `qty`) VALUES
(1, 1, 1, 1, 34999, 3499, 8),
(3, 2, 2, 3, 3599, 3599, 5),
(4, 2, 1, 3, 3499, 3499, 5),
(5, 3, 2, 2, 7999, 7999, 5),
(8, 3, 1, 2, 7899, 7899, 5),
(9, 4, 1, 1, 2999, 2999, 5),
(10, 4, 2, 1, 2999, 2999, 3),
(11, 5, 1, 5, 3499, 3499, 5),
(12, 5, 2, 5, 3499, 3499, 2),
(13, 6, 1, 1, 5999, 5999, 5),
(14, 6, 3, 1, 5999, 5999, 6),
(15, 7, 1, 6, 2999, 2999, 5),
(16, 7, 2, 6, 2999, 2999, 6),
(17, 8, 1, 6, 2299, 2299, 5),
(18, 8, 3, 6, 2999, 2999, 4),
(19, 9, 3, 7, 3999, 3999, 5),
(20, 9, 2, 7, 3899, 3899, 4),
(21, 10, 1, 7, 3499, 3499, 4),
(22, 10, 2, 7, 3499, 3499, 5),
(23, 11, 1, 8, 2999, 2999, 5),
(24, 11, 2, 8, 2999, 2299, 5),
(25, 12, 1, 6, 2999, 2999, 1),
(26, 12, 2, 6, 3999, 3999, 4),
(27, 13, 2, 9, 1999, 1999, 0),
(28, 14, 1, 10, 2999, 2999, 0),
(29, 15, 2, 6, 50, 50, 4),
(30, 16, 1, 5, 8999, 8999, 5),
(31, 16, 2, 5, 8888, 8888, 5),
(32, 16, 3, 5, 8999, 8999, 4),
(33, 17, 2, 5, 8999, 8999, 5),
(34, 17, 3, 5, 8888, 8888, 4),
(35, 18, 1, 5, 9999, 9999, 5),
(36, 19, 1, 11, 11111, 11111, 5),
(37, 19, 2, 11, 10000, 10000, 5),
(38, 20, 1, 12, 7999, 7999, 5),
(39, 20, 2, 12, 7889, 7889, 7889),
(40, 21, 1, 13, 17999, 17999, 5),
(41, 21, 2, 13, 17000, 17000, 5),
(42, 22, 2, 15, 17999, 17999, 5),
(43, 23, 1, 16, 7999, 7999, 5),
(44, 23, 3, 16, 7899, 7899, 5),
(45, 24, 1, 17, 4999, 4999, 5),
(46, 24, 2, 17, 4999, 4999, 5),
(47, 25, 1, 18, 11999, 11999, 5),
(48, 25, 2, 18, 11999, 11999, 6),
(49, 26, 1, 18, 3599, 3599, 5),
(50, 26, 2, 18, 3599, 3599, 5),
(51, 27, 1, 19, 4999, 4999, 5),
(52, 27, 2, 19, 4999, 4999, 5),
(53, 28, 1, 13, 4599, 4599, 5),
(54, 28, 2, 13, 4599, 4599, 5),
(55, 29, 1, 15, 17999, 17999, 5),
(56, 29, 2, 15, 17999, 17999, 5),
(57, 30, 1, 18, 3999, 3999, 5),
(58, 30, 2, 18, 3999, 3999, 5),
(59, 31, 1, 17, 4999, 4999, 5),
(60, 31, 2, 17, 4999, 4999, 5),
(61, 32, 1, 18, 6999, 6999, 5),
(62, 32, 2, 18, 6999, 6999, 5),
(63, 33, 1, 2, 3599, 3599, 5),
(64, 33, 2, 2, 3599, 3599, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_images` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_images`) VALUES
(1, 1, '568828499_chatenya1.jpg'),
(2, 1, '227315902_chatenya2.jpg'),
(3, 1, '835196607_chatenya3.jpg'),
(4, 2, '221758020_LDSm1.jpg'),
(5, 2, '823636445_LDSm2.jpg'),
(6, 2, '713413123_LDSm3.jpg'),
(7, 3, '778469552_kosho1.jpg'),
(8, 3, '476686133_kosho2.jpg'),
(9, 3, '345198796_kosho3.jpg'),
(10, 4, '393992663_SASHbespoke1.jpg'),
(11, 4, '680806281_SASHbespoke2.jpg'),
(12, 4, '181924776_SASHbespoke3.jpg'),
(13, 5, '302974574_cosette.jpg'),
(14, 5, '650209330_cosette2.jpg'),
(15, 5, '934792717_cosette3.jpg'),
(16, 6, '187048751_raayas1.jpg'),
(17, 6, '963301921_raayas2.jpg'),
(18, 6, '278136194_raayas3.jpg'),
(19, 7, '143451588_Sash Bespoke1.jpg'),
(20, 7, '129476041_Sash Bespoke2.jpg'),
(21, 7, '924879654_Sash Bespoke3.jpg'),
(22, 8, '216645342_neroby1.jpg'),
(23, 8, '367089176_neroby2.jpg'),
(24, 8, '523342589_neroby3.jpg'),
(25, 9, '346130570_mAROON1.jpg'),
(26, 9, '251482748_mAROON2.jpg'),
(27, 10, '666788678_raaya1.jpg'),
(28, 10, '665418645_raaya2.jpg'),
(29, 10, '400987296_raaya3.jpg'),
(30, 11, '919348137_the_maroon1.jpeg'),
(31, 11, '505748879_the_maroon2.jpeg'),
(32, 11, '628826528_the_maroon3.jpeg'),
(33, 12, '813610964_kora1.jpg'),
(34, 12, '339540210_kora2.jpg'),
(35, 12, '550746692_kora3.jpg'),
(36, 13, '633363106_Marooned1.jpeg'),
(37, 13, '135287112_Marooned2.jpeg'),
(38, 13, '426269864_Marooned3.jpeg'),
(39, 14, '652954161_Wah-Men-Marooned-gray.jpeg'),
(40, 14, '143310315_Wah-Men-Marooned-gray2.jpeg'),
(41, 14, '828720639_Wah-Men-Marooned-gray3.jpeg'),
(42, 15, '633795923_121184725_WhatsApp Image 2024-12-28 at 14.42.57_449eae6d.jpg'),
(43, 16, '627924301_frontier1.jpg'),
(44, 16, '289449733_frontier2.jpg'),
(45, 16, '367267164_frontier3.jpg'),
(46, 17, '753339551_frontier1.jpg'),
(47, 17, '501234827_frontier2.jpg'),
(48, 17, '640019464_frontier3.jpg'),
(49, 18, '244719121_Sash BespokeWomen-1.jpg'),
(50, 18, '207461325_Sash BespokeWomen-3.jpg'),
(51, 18, '183391003_Sash BespokeWomen-2.jpg'),
(52, 19, '269777796_lds1.jpg'),
(53, 19, '238512195_lds2.jpg'),
(54, 19, '464961815_lds3.jpg'),
(55, 20, '873967850_ayshi1.jpeg'),
(56, 20, '544609732_ayshi2.jpeg'),
(57, 20, '450541126_ayshi3.jpeg'),
(58, 21, '765758358_afd7dddcabbdc5d1178f91d0d8613b74.jpg'),
(59, 21, '232370974_2bbd341250d7b012246bee4fba0a76fb.jpg'),
(60, 21, '543326065_2eb4836e99e17b653031885f1a1f361f.jpg'),
(61, 22, '618265236_85dbec05e46aeb975f947e676178dd78.jpg'),
(62, 22, '477217083_1cc1a7ef6e724a29ea752d9b6205bc37.jpg'),
(63, 22, '204637363_7618802ca218037bdad88c69beae03fb.jpg'),
(64, 23, '824990930_d96c52e1c0d6a2e4e45dbf0600059638.jpg'),
(65, 23, '584645450_f0748968438fbf6b76217820e3081cdb.jpg'),
(66, 23, '288923491_fb77c29337b7aba9e79d81c21dcc1396.jpg'),
(67, 24, '116348786_5aff7bcbf5ea9cb2c7e18c7c78c64c80.jpg'),
(68, 24, '182427287_5043d4f66f17cbec7b55b69b6acfca8e.jpg'),
(69, 24, '922889481_342f7568a5e28be8a72f4226494dcb9b.jpg'),
(70, 25, '800263949_vadana1.jpg'),
(71, 25, '737307823_vadna2.jpg'),
(72, 25, '341500885_vadna3.jpg'),
(73, 26, '114716734_azaleass.jpg'),
(74, 26, '451734340_azaleass2.jpg'),
(75, 26, '477077729_azaleass3.jpg'),
(76, 27, '632347034_3aaf0f555100bf577a059c5016adfa82.jpg'),
(77, 27, '339871922_aec4c8135aa543551be528e995f9de0f.jpg'),
(78, 27, '837203912_7e14d71fa3f58573152747b0a5f1ece3.jpg'),
(79, 28, '532524908_a4d0ce3ba573de974f55004458898069.jpg'),
(80, 28, '202010105_21f32cc934c5ebfd8bb34ed03f347104.jpg'),
(81, 28, '568288620_a13f0341f2091f908435b84732f88d12 (1).jpg'),
(82, 29, '939768604_pallod.jpg'),
(83, 29, '797435834_pallod2.jpg'),
(84, 29, '975946493_pallod3.jpg'),
(85, 30, '282867766_da51fa87acb8f64824d0a3472760e2f2.jpg'),
(86, 30, '861123912_952c2260443215aa63dd6955aa2d7ff0 (1).jpg'),
(87, 30, '226127907_1c1967c2e060329100db4c1c257f61fb.jpg'),
(88, 31, '155960805_92a166b86dc41e99a9eef0d10a23285b.jpg'),
(89, 31, '767207898_0901c4848e63536d5506b10fe7c20890.jpg'),
(90, 32, '367823744_a38098e55dd3782835b69aa341241937.jpg'),
(91, 32, '636762573_1194022549918c95860441219832e4a9.jpg'),
(92, 33, '816799601_9ca5e81b5c97abcc91d03da4b6ae41ef.jpg'),
(93, 33, '247508507_876b36e676266dc4637d8e9e9de36dbe.jpg'),
(94, 33, '395595601_86944419115f06840fbd0bae784fa584.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shiprocket_token`
--

CREATE TABLE `shiprocket_token` (
  `id` int(11) NOT NULL,
  `token` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shiprocket_token`
--

INSERT INTO `shiprocket_token` (`id`, `token`, `added_on`) VALUES
(1, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjU4NTg5NTMsInNvdXJjZSI6InNyLWF1dGgtaW50IiwiZXhwIjoxNzQzNDAyNTgzLCJqdGkiOiJuVXU3dEp5QmpSV21jVERjIiwiaWF0IjoxNzQyNTM4NTgzLCJpc3MiOiJodHRwczovL3NyLWF1dGguc2hpcHJvY2tldC5pbi9hdXRob3JpemUvdXNlciIsIm5iZiI6MTc0MjUzODU4MywiY2lkIjo1NjQ4NTM1LCJ0YyI6MzYwLCJ2ZXJib3NlIjpmYWxzZSwidmVuZG9yX2lkIjowLCJ2ZW5kb3JfY29kZSI6IiJ9.gcIwxEaaioykvhyLFGntGaZQ5jP3pR9bZT-RITcetdk', '2025-03-21 06:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `size_master`
--

CREATE TABLE `size_master` (
  `id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size_master`
--

INSERT INTO `size_master` (`id`, `size`, `order_by`, `status`) VALUES
(1, 'S', 1, 1),
(2, 'M', 2, 1),
(3, 'X', 3, 1),
(4, 'Xl', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categories_id`, `sub_categories`, `status`) VALUES
(1, 1, 'Bridal-Leigha', 1),
(2, 1, 'Designer-Leigha', 1),
(3, 1, 'Gown', 1),
(4, 2, 'Sherwani', 1),
(5, 2, 'Suit', 1),
(6, 2, 'Blazer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(7) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(1, 'HARDIK', 'Hardik@123', 'hardikdodiya2410@gmail.com', '7285008403', '2025-03-24 05:17:42'),
(2, 'Jay', 'Jay@2022', 'jay709604@gmail.com', '9537413107', '2025-03-21 11:58:09'),
(6, 'Vinay', 'Vinay@123', 'vinaydodiya22@gmail.com', '9537413104', '2025-03-25 10:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_master`
--
ALTER TABLE `color_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shiprocket_token`
--
ALTER TABLE `shiprocket_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_master`
--
ALTER TABLE `size_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `color_master`
--
ALTER TABLE `color_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shiprocket_token`
--
ALTER TABLE `shiprocket_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size_master`
--
ALTER TABLE `size_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
