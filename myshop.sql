-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 15, 2017 at 01:18 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'sonu.mittal144@gmail.com', 'danzer');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(10) NOT NULL AUTO_INCREMENT,
  `brand_title` text NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'hp'),
(2, 'Dell'),
(3, 'Nokia'),
(4, 'Samsung'),
(7, 'apple');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `p_id` int(11) NOT NULL,
  `ip_add` varchar(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price_qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`, `total_price_qty`) VALUES
(6, '127.0.0.1', 1, 28000),
(7, '127.0.0.1', 1, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_title` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Laptop'),
(2, 'Computers'),
(3, 'Cameras'),
(4, 'Mobiles'),
(10, 'Mi');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(30) NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(30) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) VALUES
(9, 'sonu mittal', 'sonu.mittal144@gmail.com', 'danzer', 'India', 'bari', ' +918233281890', 'sarafa market', 'Untitled-1.png', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

DROP TABLE IF EXISTS `customer_orders`;
CREATE TABLE IF NOT EXISTS `customer_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `total_products` int(100) NOT NULL,
  `order_date` timestamp NOT NULL,
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES
(17, 9, 28000, 1031407803, 1, '2017-09-08 13:05:37', 'pending'),
(16, 9, 0, 522281016, 0, '2017-09-08 13:04:13', 'pending'),
(15, 9, 0, 199078307, 0, '2017-09-08 13:01:47', 'pending'),
(14, 9, 0, 1556421803, 0, '2017-09-08 12:59:16', 'pending'),
(13, 9, 30000, 1040450381, 1, '2017-09-08 12:58:24', 'pending'),
(12, 9, 75000, 1900859651, 1, '2017-09-06 12:40:17', 'complete'),
(11, 9, 30000, 1591862192, 1, '2017-09-06 12:37:43', 'complete'),
(18, 9, 200000, 1857838321, 3, '2017-09-15 13:17:20', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(10) NOT NULL,
  `code` int(10) NOT NULL,
  `payment_date` text NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `invoice_no`, `amount`, `payment_mode`, `ref_no`, `code`, `payment_date`) VALUES
(1, 2060919081, 30000, 'Bank Transfer', 1234, 1234, '21/03/18'),
(2, 927097063, 30000, 'Easypaisa/UBL Omni', 12131, 2321, '21/2/18'),
(3, 78933209, 120000, 'Bank Transfer', 1234, 91, '21/2/25'),
(4, 78933209, 120000, 'Bank Transfer', 1234, 91, '21/2/25'),
(5, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(6, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(7, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(8, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(9, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(10, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(11, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(12, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(13, 763737011, 0, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(14, 149231787, 40000, 'Easypaisa/UBL Omni', 1234, 91, '21/8/22'),
(15, 646095540, 30000, 'Western Union', 1234, 92357, '21/03/18'),
(16, 2060919081, 120000, 'Easypaisa/UBL Omni', 1234, 91, '21/03/18'),
(17, 1376460186, 120000, 'Bank Transfer', 1234, 91, '21/2/18'),
(18, 1288008425, 30000, 'Bank Transfer', 1234, 91, '21/03/18'),
(19, 1591862192, 30000, 'Bank Transfer', 1234, 91, '21/03/18'),
(20, 1900859651, 75000, 'Bank Transfer', 1234, 91, '21/03/18');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_payments`
--

DROP TABLE IF EXISTS `paypal_payments`;
CREATE TABLE IF NOT EXISTS `paypal_payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `transaction_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `currency` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pending_orders`
--

DROP TABLE IF EXISTS `pending_orders`;
CREATE TABLE IF NOT EXISTS `pending_orders` (
  `order_id` int(100) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `order_status` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_orders`
--

INSERT INTO `pending_orders` (`order_id`, `customer_id`, `invoice_no`, `product_id`, `qty`, `order_status`) VALUES
(25, 9, 1031407803, 6, 1, 'pending'),
(24, 9, 1040450381, 5, 1, 'pending'),
(23, 9, 1900859651, 4, 1, 'complete'),
(11, 9, 1591862192, 5, 1, 'pending'),
(26, 9, 1857838321, 7, 2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) NOT NULL,
  `brand_id` int(10) NOT NULL,
  `date` timestamp NOT NULL,
  `product_title` text NOT NULL,
  `product_img1` text NOT NULL,
  `product_img2` text NOT NULL,
  `product_img3` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_desc` text NOT NULL,
  `product_keywords` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `brand_id`, `date`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `product_keywords`, `status`) VALUES
(4, 4, 7, '2017-08-26 22:39:31', 'i-phone 7', 'i-phone.png', 'i-phone-back.jpg', 'bgr-iphone-7-2.jpg', 75000, 'this is phone that is created by apple and it has ios OS. ', 'mobiles,mobile,i phone,apple,i phone 7', 'on'),
(5, 1, 1, '2017-08-26 22:41:17', 'HP Pro book Laptop', 'hp-laptop.png', 'hp-laptop3.png', 'hp-laptop2.jpg', 30000, 'this laptop is created by HP.', 'laptop,laptops,hp,hp laptop', 'on'),
(6, 1, 2, '2017-08-26 22:42:17', 'Dell Laptop', 'dell-laptop.jpg', 'dell-laptop2.jpg', 'dell-laptop-back.jpg', 28000, 'this laptop is created by Dell.', 'laptop,laptops,dell,dell laptop', 'on'),
(7, 3, 5, '2017-08-27 22:56:59', 'Sony Camera', 'cannen_camera.jpg', 'canon_camera2.jpg', 'canon_camera3.jpg', 40000, 'This is the best camera in this price.', 'camera,camera,sony camera,sony', 'on'),
(8, 5, 4, '2017-08-27 23:19:09', ' New samsung tablet', 'samsung_tablet3.png', 'samsung_tablet2.jpg', 'samsung_tablet.png', 30000, 'This is the new latest new featre tablet by samsung.', 'tablets,tablet,samsung tablet', 'on');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
