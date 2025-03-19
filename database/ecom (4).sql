-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 06:47 PM
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
(10, '#B4A8AD', 'Silver Chalice', 0, 1);

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
(1, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 100, 'success', 1, 0, 0, 0, 0, '314ff66f286acb1d4209', '', 0, 0, '', '2025-03-19 06:34:52', 0, '', 0),
(2, 1, '32/A BALA JABBAR NI WADI TALAJA Talaja (M)', 'Bhavnagar', 364140, 'COD', 17495, 'success', 1, 0, 0, 0, 0, '9c30e9d5944349ffa1b4', '', 0, 0, '', '2025-03-19 08:15:27', 0, '', 0);

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
(1, 1, 1, 1, 1, '2025-03-20', '2025-03-22', 1, 100),
(2, 2, 1, 1, 1, '2025-03-20', '2025-03-26', 5, 3499);

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
(11, 2, 5, 'Maroon Suit', '919348137_the_maroon1.jpeg', 'A maroon suit paired with a matching maroon tie, creating a coordinated and sophisticated look.', 'A maroon suit paired with a matching maroon tie, creating a coordinated and sophisticated look.', 0, 'Wah-Men-\r\n Maroon Suit', 'Wah-Men-\r\nMaroon Suit', 'Wah-Men-\r\n Maroon Suit', 1, 2),
(12, 2, 6, 'Kora', '813610964_kora1.jpg', 'A sleek Black Velvet Blazer featuring intricate sequin detailing on the lapel, paired effortlessly with smart trousers for a sophisticated and stylish look.', 'A sleek Black Velvet Blazer featuring intricate sequin detailing on the lapel, paired effortlessly with smart trousers for a sophisticated and stylish look.', 1, 'Wah-Men-kora', 'Wah-Men-kora', 'Wah-Men-kora', 1, 2),
(13, 2, 6, 'Marooned', '633363106_Marooned1.jpeg', 'A lilac blazer accessorized with a brooch, adding a touch of elegance and style to your ensemble.', 'A lilac blazer accessorized with a brooch, adding a touch of elegance and style to your ensemble.', 0, 'Wah-Men-Marooned', 'Wah-Men-Marooned', 'Wah-Men-Marooned', 1, 2),
(14, 2, 6, 'M-Suit', '652954161_Wah-Men-Marooned-gray.jpeg', 'A solid grey blazer, perfect for adding a touch of sophistication to any outfit.', 'A solid grey blazer, perfect for adding a touch of sophistication to any outfit.', 1, 'Wah-Men-M-Suit', 'Wah-Men-M-Suit', 'Wah-Men-M-Suit', 1, 2);

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
(21, 10, 1, 7, 3499, 3499, 6),
(22, 10, 2, 7, 3499, 3499, 5),
(23, 11, 1, 8, 2999, 2999, 5),
(24, 11, 2, 8, 2999, 2299, 5),
(25, 12, 1, 6, 2999, 2999, 5),
(26, 12, 2, 6, 3999, 3999, 4),
(27, 13, 2, 9, 1999, 1999, 6),
(28, 14, 1, 10, 2999, 2999, 5);

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
(41, 14, '828720639_Wah-Men-Marooned-gray3.jpeg');

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
(1, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjU4NTg5NTMsInNvdXJjZSI6InNyLWF1dGgtaW50IiwiZXhwIjoxNzQzMjQ4NDA3LCJqdGkiOiJzMWJ3a25ocG1reHNwVmpKIiwiaWF0IjoxNzQyMzg0NDA3LCJpc3MiOiJodHRwczovL3NyLWF1dGguc2hpcHJvY2tldC5pbi9hdXRob3JpemUvdXNlciIsIm5iZiI6MTc0MjM4NDQwNywiY2lkIjo1NjQ4NTM1LCJ0YyI6MzYwLCJ2ZXJib3NlIjpmYWxzZSwidmVuZG9yX2lkIjowLCJ2ZW5kb3JfY29kZSI6IiJ9.P_QzCcVD_IxChRqenhhLhI6x2q34yAxcKzVRcAX9qXQ', '2025-03-18 23:40:06');

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
(1, 'DODIYA', 'Hardik@123', 'hardikdodiya2410@gmail.com', '7285008403', '2025-03-19 06:12:03');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
