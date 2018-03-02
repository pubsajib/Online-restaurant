-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2017 at 07:25 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `BuildName` varchar(50) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `Town` varchar(30) DEFAULT NULL,
  `Postcode` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `BuildName`, `Street`, `Town`, `Postcode`) VALUES
(1, 'BuildName', 'Street', 'Town', 'Postcode'),
(2, '2 EMBANKMENT STATION', 'EMBANKMENT PLACE', 'LONDON', 'WC2N 6NS'),
(3, '1 EMBANKMENT STATION', 'EMBANKMENT PLACE', 'LONDON', 'WC2N 6NS'),
(4, '4 EMBANKMENT STATION', 'EMBANKMENT PLACE', 'LONDON', 'WC2N 6NS'),
(5, '5 EMBANKMENT STATION', 'EMBANKMENT PLACE', 'LONDON', 'WC2N 6NS'),
(6, '3 EMBANKMENT STATION', 'EMBANKMENT PLACE', 'LONDON', 'WC2N 6NS'),
(7, 'EMBANKMENT STATION', 'EMBANKMENT PLACE', 'LONDON', 'WC2N 6NS');

-- --------------------------------------------------------

--
-- Table structure for table `address_long`
--

CREATE TABLE `address_long` (
  `address_long_id` int(11) NOT NULL,
  `Organisa` varchar(60) DEFAULT NULL,
  `Department Name` varchar(60) DEFAULT NULL,
  `PO Box` varchar(255) DEFAULT NULL,
  `BuildName` varchar(50) DEFAULT NULL,
  `SubBName` varchar(30) DEFAULT NULL,
  `Number` varchar(255) DEFAULT NULL,
  `Thoroughfare` varchar(255) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `Double Dependent Locality` varchar(35) DEFAULT NULL,
  `Dependent Locality` varchar(35) DEFAULT NULL,
  `Town` varchar(30) DEFAULT NULL,
  `Postcode` varchar(8) DEFAULT NULL,
  `PostcodeType` varchar(1) DEFAULT NULL,
  `Mailsort SSC` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_text` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_text`) VALUES
(1, 'SURPRISE YOUR PLATE');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(256) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` enum('True','False') NOT NULL COMMENT '''True''=1,''False''=0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `display_order`, `is_active`) VALUES
(1, 'break fast', 1, 'True'),
(2, 'Lunch', 2, 'True'),
(3, 'PIZZA', 1, 'True'),
(4, 'EXTRA', 3, 'True'),
(5, 'Zero value', 0, 'True'),
(6, 'Update Zero', 0, 'True'),
(7, 'bbil 1', 0, 'True'),
(8, 'bbil 2', 4, 'True'),
(9, 'bbil 3', 0, 'True'),
(10, 'bbil 4', 0, 'True'),
(11, 'bbil 5', 5, 'True'),
(12, 'bbil 6', 0, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contract_id` int(11) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `contact_address_street` varchar(256) NOT NULL,
  `contact_address_city` varchar(256) NOT NULL,
  `contact_address_postcode` varchar(128) NOT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contract_id`, `email`, `contact_address_street`, `contact_address_city`, `contact_address_postcode`, `phone`, `company_name`) VALUES
(1, '{\"header_email1\":\"support@atitonline.com\",\"reservation_email1\":\"info@atitonline.com\",\"contact_email1\":\"sales@atitonline.com\",\"contact_email2\":\"sales@atitonline.com\",\"query_email1\":\"support@atitonline.com\"}', '{\"header_street\":\"\",\"reservation_street\":\"\",\"contact_street\":\"4A Grove Road\",\"query_street\":\"\"}', '{\"header_city\":\"\",\"reservation_city\":\"\",\"contact_city\":\"London\",\"query_city\":\"\"}', '{\"header_postcode\":\"\",\"reservation_postcode\":\"\",\"contact_postcode\":\"E3 5AX\",\"query_postcode\":\"\"}', '{\"header_phone1\":\"020 8981 0333\",\"reservation_phone1\":\"020 8981 0333\",\"contact_phone1\":\"020 8981 0333\",\"contact_phone2\":\"020 8981 9771\",\"query_phone1\":\"\"}', 'Charcoal Grill');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `mobile` varchar(64) DEFAULT NULL,
  `flat_house_no` varchar(128) NOT NULL,
  `street` varchar(128) NOT NULL,
  `city_town` varchar(128) NOT NULL,
  `postcode` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `flat_house_no`, `street`, `city_town`, `postcode`, `password`) VALUES
(122, 'Ahmad', 'Hasan', 'fuad007@gmail.com', NULL, '07419685376', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(123, 'Mhgg', 'Bhu', 'romanconcord@gmail.com', NULL, '07837656855 ', '', '', '', '', '54ca99c157e5314a257f1094aa43ecc4'),
(124, 'test', 'account', 'roos@roos.com', NULL, NULL, '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(125, 'masud', 'moni', 'moni@gmail.com', NULL, '123456789', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(126, 'masud', 'moni', 'moni@moni.com', NULL, '12345678', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(127, 'Prince', 'Mahi', 'muhin.tami@gmail.com', '12365487', '0170000000', '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', 'prince Bazar', '1200', 'e10adc3949ba59abbe56e057f20f883e'),
(129, 'mohammad', 'mahbuib', 'mahbub_sam@yahoo.com', '07802720921', '07803720921', '67', 'goodall road', 'london', 'e114er', 'e73ab53ee4c71336dfb82178efbaa6aa'),
(131, 'Mohiuddin', 'Muhin', 'muhin.diu092@gmail.com', NULL, '012547896', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(132, 'sabrina', 'FARAH', 'sabrina.farah12@gmail.com', NULL, '07419685376', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(133, 'Md', 'zitu', 'fuad_81bd@yahoo.com', NULL, '7592793756', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
(134, 'kjhk', 'kljh', 'lkjh@yahoo.com', NULL, '87383738933', '', '', '', '', 'a62fbd6d134d2f7f5dbafd5745baa1e8'),
(135, 'First name', 'Last name', 'user@atitonline.com', NULL, '1234567890', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_time`
--

CREATE TABLE `delivery_time` (
  `delivery_time_id` int(11) NOT NULL,
  `delivery_time` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_time`
--

INSERT INTO `delivery_time` (`delivery_time_id`, `delivery_time`) VALUES
(1, '6:30 PM'),
(2, '6:45 PM'),
(3, '7:00 PM'),
(4, '7:15 PM'),
(5, '7:30 PM'),
(6, '7:45 PM'),
(7, '8:00 PM'),
(8, '8:15 PM'),
(9, '8:30 PM'),
(10, '8:45 PM'),
(11, '9:00 PM'),
(12, '9:15 PM'),
(13, '9:30 PM'),
(14, '9:45 PM'),
(15, '10:00 PM'),
(16, '10:15 PM'),
(17, '10:30 PM');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=both; 2=delivery; 3=collection',
  `min_amount` decimal(10,2) NOT NULL,
  `max_amount` decimal(10,2) NOT NULL,
  `discount_rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_id`, `discount_type`, `min_amount`, `max_amount`, `discount_rate`) VALUES
(1, 2, '12.00', '0.00', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `email_requests`
--

CREATE TABLE `email_requests` (
  `email_requests_id` int(11) NOT NULL,
  `email_sender_name` varchar(128) DEFAULT NULL,
  `email_address` varchar(128) NOT NULL,
  `email_subject` varchar(256) DEFAULT NULL,
  `email_sender_phone` varchar(256) NOT NULL,
  `email_content` text NOT NULL,
  `email_fail_reason` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `food_type_id` int(11) NOT NULL,
  `food_type_name` varchar(256) NOT NULL,
  `is_active` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`food_type_id`, `food_type_name`, `is_active`) VALUES
(1, 'Wrap Only', 'Active'),
(2, 'Meal', 'Active'),
(3, 'Regular', 'Active'),
(4, 'Large', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `offer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `offer_price` decimal(8,2) NOT NULL,
  `is_active` enum('Active','Inactive') NOT NULL COMMENT '''Active''=1,''Inactive''=2',
  `user_id` int(11) NOT NULL,
  `offer_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opening_hours`
--

CREATE TABLE `opening_hours` (
  `opening_hours_id` int(11) NOT NULL,
  `sunday` varchar(1028) DEFAULT NULL,
  `monday` varchar(1028) DEFAULT NULL,
  `tuesday` varchar(1028) DEFAULT NULL,
  `wednesday` varchar(1028) DEFAULT NULL,
  `thursday` varchar(1028) DEFAULT NULL,
  `friday` varchar(1028) DEFAULT NULL,
  `saturday` varchar(1028) DEFAULT NULL,
  `updated_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` enum('Active','inactive') NOT NULL DEFAULT 'Active' COMMENT 'Active=1, inactive=2. Default = Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opening_hours`
--

INSERT INTO `opening_hours` (`opening_hours_id`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `updated_by`, `created_at`, `last_update`, `is_active`) VALUES
(1, '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"11:00 pm\"}]}', '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"11:00 pm\"}]}', '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"11:00 pm\"}]}', '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"11:00 pm\"}]}', '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"11:00 pm\"}]}', '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"1:00 am\"}]}', '{\"is_open\":1,\"times\":[{\"start_time\":\"24 hours\",\"end_time\":\"1:00 am\"}]}', '1', '2017-11-20 07:07:18', '2017-11-19 19:07:18', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `delivery_charge` decimal(5,2) DEFAULT NULL,
  `card_payment_charge` decimal(5,2) NOT NULL,
  `tax` decimal(5,2) DEFAULT NULL,
  `total` decimal(9,2) NOT NULL,
  `order_status` enum('Complete','Pending','Accepted','Rejected') NOT NULL COMMENT '''Complete''=1,''Pending''=2;''Accepted''=3;''Rejected''=4',
  `status_reason` varchar(100) NOT NULL,
  `order_process_type_id` int(11) NOT NULL,
  `order_instruction` text,
  `postcode_id` int(11) NOT NULL,
  `flat_house_no` varchar(128) NOT NULL,
  `street` varchar(256) NOT NULL,
  `city_town` varchar(256) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `order_delivery_time` varchar(16) NOT NULL,
  `printer_delivery_time` varchar(16) NOT NULL,
  `order_delivery_day` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `payment_id`, `subtotal`, `discount`, `delivery_charge`, `card_payment_charge`, `tax`, `total`, `order_status`, `status_reason`, `order_process_type_id`, `order_instruction`, `postcode_id`, `flat_house_no`, `street`, `city_town`, `postcode`, `order_delivery_time`, `printer_delivery_time`, `order_delivery_day`, `created_at`, `updated_at`) VALUES
(1, 135, 0, '31.00', '0.00', NULL, '0.00', NULL, '31.00', 'Complete', '', 2, NULL, 1, '', '', '', '', 'Asap', '', '2017-11-16', '2017-11-16 05:17:11', '0000-00-00 00:00:00'),
(2, 127, 0, '690.00', '0.00', NULL, '0.00', NULL, '690.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 21:22:37', '0000-00-00 00:00:00'),
(3, 127, 0, '850.00', '0.00', NULL, '0.00', NULL, '850.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:11:19', '0000-00-00 00:00:00'),
(4, 127, 0, '250.00', '0.00', NULL, '0.00', NULL, '250.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:41:55', '0000-00-00 00:00:00'),
(5, 127, 0, '200.00', '0.00', NULL, '0.00', NULL, '200.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:45:54', '0000-00-00 00:00:00'),
(6, 127, 0, '200.00', '0.00', NULL, '0.00', NULL, '200.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:49:47', '0000-00-00 00:00:00'),
(7, 127, 0, '200.00', '0.00', NULL, '0.00', NULL, '200.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:50:25', '0000-00-00 00:00:00'),
(8, 127, 0, '200.00', '0.00', NULL, '0.00', NULL, '200.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:52:01', '0000-00-00 00:00:00'),
(9, 127, 0, '200.00', '0.00', NULL, '0.00', NULL, '200.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:52:32', '0000-00-00 00:00:00'),
(10, 127, 0, '970.00', '0.00', NULL, '0.00', NULL, '970.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-16', '2017-11-15 22:54:38', '0000-00-00 00:00:00'),
(11, 127, 0, '1410.00', '0.00', NULL, '0.00', NULL, '1410.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-17', '2017-11-17 03:57:08', '0000-00-00 00:00:00'),
(12, 127, 0, '24.99', '0.00', NULL, '0.00', NULL, '24.99', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-17', '2017-11-17 04:43:46', '0000-00-00 00:00:00'),
(13, 127, 0, '811.00', '0.00', NULL, '0.00', NULL, '811.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-20', '2017-11-19 19:11:21', '0000-00-00 00:00:00'),
(14, 127, 0, '878.00', '0.00', NULL, '0.00', NULL, '878.00', 'Pending', '', 2, NULL, 1, '', 'Shyamoli, Dhaka, Bangladesh, 102, lake circus', '', '', 'Asap', '', '2017-11-20', '2017-11-19 19:37:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_bundle_detail`
--

CREATE TABLE `order_bundle_detail` (
  `order_bundle_detail_id` int(11) NOT NULL,
  `orders_details_id` int(11) NOT NULL,
  `bundle_product_id` varchar(16) NOT NULL,
  `bundle_product_price` int(11) NOT NULL,
  `bundle_product_quantity` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_bundle_detail`
--

INSERT INTO `order_bundle_detail` (`order_bundle_detail_id`, `orders_details_id`, `bundle_product_id`, `bundle_product_price`, `bundle_product_quantity`, `Created_at`) VALUES
(1, 1, '2', 0, 1, '2017-11-16 05:17:10'),
(2, 2, '2', 0, 1, '2017-11-16 09:22:37'),
(3, 2, '8', 0, 1, '2017-11-16 09:22:37'),
(4, 3, '5', 0, 1, '2017-11-16 10:11:19'),
(5, 3, '7', 0, 1, '2017-11-16 10:11:19'),
(6, 3, '5', 0, 1, '2017-11-16 10:11:19'),
(7, 3, '7', 0, 1, '2017-11-16 10:11:19'),
(8, 4, '1', 0, 1, '2017-11-16 10:41:55'),
(9, 4, '3', 0, 1, '2017-11-16 10:41:55'),
(10, 15, '1', 0, 1, '2017-11-16 10:54:38'),
(11, 15, '6', 0, 1, '2017-11-16 10:54:38'),
(12, 15, '7', 0, 1, '2017-11-16 10:54:38'),
(13, 16, '1', 0, 1, '2017-11-16 10:54:38'),
(14, 16, '6', 0, 1, '2017-11-16 10:54:38'),
(15, 16, '7', 0, 1, '2017-11-16 10:54:38'),
(16, 17, '1', 0, 1, '2017-11-16 10:54:38'),
(17, 17, '6', 0, 1, '2017-11-16 10:54:38'),
(18, 17, '7', 0, 1, '2017-11-16 10:54:38'),
(19, 21, '1', 0, 1, '2017-11-17 03:57:08'),
(20, 21, '2', 0, 1, '2017-11-17 03:57:08'),
(21, 21, '5', 0, 1, '2017-11-17 03:57:08'),
(22, 22, '3', 0, 1, '2017-11-17 03:57:08'),
(23, 22, '5', 0, 1, '2017-11-17 03:57:08'),
(24, 22, '8', 0, 1, '2017-11-17 03:57:08'),
(25, 24, '1', 0, 1, '2017-11-17 04:43:46'),
(26, 28, '28', 0, 1, '2017-11-20 07:11:21'),
(27, 28, '29', 0, 1, '2017-11-20 07:11:21'),
(28, 28, '31', 0, 1, '2017-11-20 07:11:21'),
(29, 30, '28', 0, 1, '2017-11-20 07:37:15'),
(30, 30, '31', 0, 1, '2017-11-20 07:37:15'),
(31, 31, '28', 0, 1, '2017-11-20 07:37:15'),
(32, 31, '29', 0, 1, '2017-11-20 07:37:15'),
(33, 31, '31', 0, 1, '2017-11-20 07:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orders_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sub_product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orders_details_id`, `order_id`, `product_id`, `sub_product_id`, `customer_id`, `quantity`, `price`) VALUES
(1, 1, 9, 0, 135, 1, '31.00'),
(2, 2, 2, 0, 127, 1, '120.00'),
(3, 2, 8, 0, 127, 1, '370.00'),
(4, 2, 1, 1, 127, 1, '200.00'),
(5, 3, 2, 0, 127, 1, '120.00'),
(6, 3, 4, 0, 127, 1, '160.00'),
(7, 3, 8, 0, 127, 1, '370.00'),
(8, 3, 1, 1, 127, 1, '200.00'),
(9, 4, 7, 0, 127, 1, '250.00'),
(10, 5, 6, 0, 127, 1, '200.00'),
(11, 6, 6, 0, 127, 1, '200.00'),
(12, 7, 6, 0, 127, 1, '200.00'),
(13, 8, 6, 0, 127, 1, '200.00'),
(14, 9, 6, 0, 127, 1, '200.00'),
(15, 10, 4, 0, 127, 1, '175.00'),
(16, 10, 6, 0, 127, 1, '200.00'),
(17, 10, 8, 0, 127, 1, '395.00'),
(18, 10, 1, 1, 127, 1, '200.00'),
(19, 11, 4, 0, 127, 1, '175.00'),
(20, 11, 6, 0, 127, 1, '200.00'),
(21, 11, 7, 0, 127, 2, '250.00'),
(22, 11, 8, 0, 127, 1, '585.00'),
(23, 11, 1, 1, 127, 1, '200.00'),
(24, 12, 16, 0, 127, 1, '6.00'),
(25, 12, 17, 0, 127, 1, '10.99'),
(26, 12, 15, 4, 127, 1, '8.00'),
(27, 13, 30, 0, 127, 1, '186.00'),
(28, 13, 32, 0, 127, 1, '625.00'),
(29, 14, 19, 0, 127, 1, '1.00'),
(30, 14, 31, 0, 127, 1, '567.00'),
(31, 14, 32, 0, 127, 1, '310.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_extra_detail`
--

CREATE TABLE `order_extra_detail` (
  `order_extra_detail_id` int(11) NOT NULL,
  `orders_details_id` int(11) NOT NULL,
  `quantity_of_extra_product` int(11) NOT NULL,
  `extra_product_price` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_extra_detail`
--

INSERT INTO `order_extra_detail` (`order_extra_detail_id`, `orders_details_id`, `quantity_of_extra_product`, `extra_product_price`, `product_id`) VALUES
(1, 1, 3, 10, 3),
(2, 2, 3, 10, 3),
(3, 2, 3, 25, 5),
(4, 3, 4, 10, 3),
(5, 3, 2, 25, 5),
(6, 3, 3, 10, 3),
(7, 3, 3, 25, 5),
(8, 3, 4, 10, 3),
(9, 3, 2, 25, 5),
(10, 3, 3, 10, 3),
(11, 3, 3, 25, 5),
(12, 15, 3, 10, 3),
(13, 15, 3, 25, 5),
(14, 15, 3, 10, 3),
(15, 15, 4, 25, 5),
(16, 16, 3, 10, 3),
(17, 16, 3, 25, 5),
(18, 16, 3, 10, 3),
(19, 16, 4, 25, 5),
(20, 17, 3, 10, 3),
(21, 17, 3, 25, 5),
(22, 17, 3, 10, 3),
(23, 17, 4, 25, 5),
(24, 19, 8, 10, 3),
(25, 22, 2, 10, 3),
(26, 22, 12, 25, 5),
(27, 24, 1, 1, 14),
(28, 26, 2, 1, 18),
(29, 26, 2, 1, 19),
(30, 27, 3, 12, 28),
(31, 28, 1, 325, 7),
(32, 30, 1, 12, 28),
(33, 30, 1, 325, 7),
(34, 31, 1, 10, 29);

-- --------------------------------------------------------

--
-- Table structure for table `order_offer_detail`
--

CREATE TABLE `order_offer_detail` (
  `order_offer_detail_id` int(11) NOT NULL,
  `orders_details_id` int(11) NOT NULL,
  `quantity_of_accepted_offer` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_offer_detail`
--

INSERT INTO `order_offer_detail` (`order_offer_detail_id`, `orders_details_id`, `quantity_of_accepted_offer`, `product_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 2, 1, 1),
(4, 2, 1, 4),
(5, 3, 1, 1),
(6, 3, 1, 4),
(7, 3, 1, 1),
(8, 3, 1, 4),
(9, 14, 1, 2),
(10, 14, 1, 3),
(11, 15, 1, 2),
(12, 15, 1, 1),
(13, 15, 1, 1),
(14, 15, 1, 3),
(15, 16, 1, 2),
(16, 16, 1, 1),
(17, 16, 1, 1),
(18, 16, 1, 3),
(19, 17, 1, 2),
(20, 17, 1, 1),
(21, 17, 1, 1),
(22, 17, 1, 3),
(23, 20, 1, 1),
(24, 20, 1, 2),
(25, 24, 1, 1),
(26, 26, 1, 18),
(27, 26, 1, 19),
(28, 27, 1, 28),
(29, 27, 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `order_process_type`
--

CREATE TABLE `order_process_type` (
  `order_process_type_id` int(11) NOT NULL,
  `order_process_name` varchar(64) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_process_type`
--

INSERT INTO `order_process_type` (`order_process_type_id`, `order_process_name`, `is_active`) VALUES
(1, 'Delivery', 1),
(2, 'Collection', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_product_variation`
--

CREATE TABLE `order_product_variation` (
  `order_product_variation_id` int(11) NOT NULL,
  `orders_details_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product_variation`
--

INSERT INTO `order_product_variation` (`order_product_variation_id`, `orders_details_id`, `variation_id`, `product_id`) VALUES
(1, 1, 5, 1),
(2, 1, 5, 1),
(3, 1, 1, 2),
(4, 1, 1, 2),
(5, 2, 4, 2),
(6, 2, 5, 8),
(7, 14, 1, 2),
(8, 15, 1, 2),
(9, 16, 1, 2),
(10, 17, 1, 2),
(11, 20, 4, 2),
(12, 21, 1, 2),
(13, 22, 5, 8),
(14, 27, 13, 30),
(15, 28, 15, 31),
(16, 30, 14, 31),
(17, 31, 14, 31);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `content_heading` varchar(256) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `content_heading`, `content`, `created_at`, `last_updated`, `image_name`) VALUES
(1, 'WHO WE ARE and HISTORY', 'Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text Sample Text', '2017-02-04 16:56:29', '2017-02-03 18:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `payment_amount` decimal(8,2) NOT NULL,
  `payment_type` enum('Card','Cash') NOT NULL COMMENT '''Card''=1,''Cash''=2',
  `tranjaction_response` varchar(1024) NOT NULL,
  `total_amount` decimal(9,2) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `order_id`, `payment_amount`, `payment_type`, `tranjaction_response`, `total_amount`, `transaction_id`, `create_date`, `last_update`) VALUES
(1, NULL, 1, '111.51', 'Cash', '[]', '123.90', 0, '2017-09-28 01:18:24', '0000-00-00 00:00:00'),
(2, NULL, 2, '100.00', 'Cash', '[]', '100.00', 0, '2017-11-15 03:32:07', '0000-00-00 00:00:00'),
(3, NULL, 4, '100.00', 'Cash', '[]', '100.00', 0, '2017-11-15 03:35:30', '0000-00-00 00:00:00'),
(4, NULL, 5, '100.00', 'Cash', '[]', '100.00', 0, '2017-11-15 03:36:30', '0000-00-00 00:00:00'),
(5, NULL, 6, '100.00', 'Cash', '[]', '100.00', 0, '2017-11-15 03:41:28', '0000-00-00 00:00:00'),
(6, NULL, 7, '100.00', 'Cash', '[]', '100.00', 0, '2017-11-15 03:43:51', '0000-00-00 00:00:00'),
(7, NULL, 1, '31.00', 'Cash', '[]', '31.00', 0, '2017-11-16 05:17:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type_name` varchar(64) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type_name`, `is_active`) VALUES
(1, 'Card', 1),
(2, 'Cash', 1);

-- --------------------------------------------------------

--
-- Table structure for table `postcodes`
--

CREATE TABLE `postcodes` (
  `postcode_id` int(11) NOT NULL,
  `postcode_no` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postcodes`
--

INSERT INTO `postcodes` (`postcode_id`, `postcode_no`) VALUES
(5, 'RM17'),
(11, 'RM16 2'),
(12, 'RM16 4'),
(13, 'RM10'),
(15, 'E1'),
(16, 'E16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_name` varchar(128) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` enum('True','False','Delete') NOT NULL COMMENT '''True''=1,''False''=0',
  `is_extra` enum('True','False') NOT NULL DEFAULT 'False' COMMENT '''True''=1,''False''=0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_upadte` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `food_type_details` varchar(2048) NOT NULL COMMENT 'Input JSON Data. Key=Food Type ID, Value=Price'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `description`, `price`, `quantity`, `image_name`, `display_order`, `is_active`, `is_extra`, `created_at`, `last_upadte`, `food_type_details`) VALUES
(1, 1, 'Breakfast ', 'Only product', '100.00', 0, '1510744035_vegan-recipes.jpg', 1, 'True', 'True', '2017-12-06 02:16:06', '0000-00-00 00:00:00', ''),
(2, 2, 'Mr. testUser', 'hjkl', '6.90', 0, NULL, 1, 'True', 'True', '2017-12-06 02:37:53', '0000-00-00 00:00:00', ''),
(3, 2, 'Mr. testUser', 'hjkl', '6.90', 0, NULL, 1, 'True', 'True', '2017-12-06 02:37:58', '0000-00-00 00:00:00', ''),
(4, 2, 'Mr. testUser', 'hjkl', '6.90', 0, NULL, 1, 'Delete', 'True', '2017-12-06 08:39:50', '0000-00-00 00:00:00', ''),
(5, 2, 'testUser', NULL, '6.90', 0, NULL, 1, 'True', 'True', '2017-12-06 02:40:33', '0000-00-00 00:00:00', ''),
(6, 1, 'Bundle test', NULL, '1.00', 0, NULL, 1, 'True', 'False', '2017-12-10 22:56:19', '0000-00-00 00:00:00', ''),
(7, 1, 'Bundle test', NULL, '1.00', 0, NULL, 1, 'True', 'False', '2017-12-10 22:56:31', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_bundle`
--

CREATE TABLE `product_bundle` (
  `product_bundle_id` int(11) NOT NULL,
  `product_id` varchar(16) NOT NULL,
  `bundle_product_id` varchar(16) NOT NULL,
  `number_of_each_step` int(11) NOT NULL,
  `order_of_step` int(11) NOT NULL,
  `is_active` enum('Active','Inactive') NOT NULL DEFAULT 'Active' COMMENT '''Active''=1,''Inactive''=2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_bundle`
--

INSERT INTO `product_bundle` (`product_bundle_id`, `product_id`, `bundle_product_id`, `number_of_each_step`, `order_of_step`, `is_active`, `created_at`) VALUES
(3, '6', '5_4', 1, 1, 'Active', '2017-12-11 04:56:19'),
(4, '6', '1_9', 1, 1, 'Active', '2017-12-11 04:56:19'),
(5, '6', '1_12', 1, 1, 'Active', '2017-12-11 04:56:20'),
(6, '6', '2', 1, 1, 'Active', '2017-12-11 04:56:20'),
(7, '6', '3', 1, 1, 'Active', '2017-12-11 04:56:20'),
(8, '7', '5_4', 1, 1, 'Active', '2017-12-11 04:56:31'),
(9, '7', '1_9', 1, 1, 'Active', '2017-12-11 04:56:31'),
(10, '7', '1_12', 1, 1, 'Active', '2017-12-11 04:56:32'),
(11, '7', '2', 1, 1, 'Active', '2017-12-11 04:56:32'),
(12, '7', '3', 1, 1, 'Active', '2017-12-11 04:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_extra`
--

CREATE TABLE `product_extra` (
  `extra_id` int(11) NOT NULL,
  `product_id` varchar(16) NOT NULL,
  `extra_product_id` varchar(16) NOT NULL,
  `is_active` enum('Active','Inactive') NOT NULL DEFAULT 'Active' COMMENT '''Active''=1,''Inactive''=2',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_extra`
--

INSERT INTO `product_extra` (`extra_id`, `product_id`, `extra_product_id`, `is_active`, `updated_at`, `created_at`) VALUES
(1, '1_12', '15_4', 'Active', '2017-11-29 10:07:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_offer`
--

CREATE TABLE `product_offer` (
  `offer_id` int(11) NOT NULL,
  `product_id` varchar(16) NOT NULL,
  `offered_product_id` varchar(16) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_active` enum('Active','Inactive') NOT NULL DEFAULT 'Active' COMMENT '''Active''=1,''Inactive''=2',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_offer`
--

INSERT INTO `product_offer` (`offer_id`, `product_id`, `offered_product_id`, `quantity`, `is_active`, `updated_at`, `created_at`) VALUES
(1, '1', '1', 3, 'Inactive', '2017-12-06 08:16:06', '0000-00-00 00:00:00'),
(2, '1_10', '15_4', 1, 'Active', '2017-11-29 10:00:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `product_variations_id` int(11) NOT NULL,
  `product_id` varchar(16) NOT NULL,
  `variation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`product_variations_id`, `product_id`, `variation_id`) VALUES
(1, '1_9', 13),
(2, '1_9', 14),
(3, '1_10', 9),
(4, '1_11', 13),
(5, '1_11', 14),
(6, '1_12', 14),
(7, '1_12', 15),
(8, '1_13', 15),
(9, '2', 9),
(10, '3', 9),
(11, '4', 9),
(12, '5', 9),
(13, '6', 15),
(14, '7', 15);

-- --------------------------------------------------------

--
-- Table structure for table `settings_configurations`
--

CREATE TABLE `settings_configurations` (
  `settings_id` int(11) NOT NULL,
  `delivery_charge` decimal(5,2) NOT NULL,
  `delivery_minimum` decimal(5,2) NOT NULL,
  `estimated_collection_time` varchar(100) NOT NULL,
  `estimated_delivery_time` varchar(100) NOT NULL,
  `banner` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_configurations`
--

INSERT INTO `settings_configurations` (`settings_id`, `delivery_charge`, `delivery_minimum`, `estimated_collection_time`, `estimated_delivery_time`, `banner`) VALUES
(1, '0.00', '120.00', '15', '45', '{\"home_banner_text\":\"SURPRISE YOUR PALATE\"}');

-- --------------------------------------------------------

--
-- Table structure for table `sub_products`
--

CREATE TABLE `sub_products` (
  `sub_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_extra` enum('True','False') NOT NULL DEFAULT 'False' COMMENT '''True''=1,''False''=0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_products`
--

INSERT INTO `sub_products` (`sub_product_id`, `product_id`, `name`, `price`, `display_order`, `is_extra`, `created_at`, `last_update`) VALUES
(4, 5, '10.5\" Deep Pan', '6.99', 1, 'True', '2017-12-06 02:43:12', '0000-00-00 00:00:00'),
(9, 1, 'Test supb', '1.00', 12, 'False', '2017-11-29 03:56:36', '0000-00-00 00:00:00'),
(12, 1, 'Subproduct Extra', '12.00', 1, 'False', '2017-11-29 04:07:43', '0000-00-00 00:00:00'),
(13, 1, 'bundle', '12.00', 11, 'False', '2017-11-29 04:10:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table 21`
--

CREATE TABLE `table 21` (
  `COL 1` int(1) DEFAULT NULL,
  `COL 2` varchar(18) DEFAULT NULL,
  `COL 3` varchar(12) DEFAULT NULL,
  `COL 4` varchar(8) DEFAULT NULL,
  `COL 5` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table 21`
--

INSERT INTO `table 21` (`COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`) VALUES
(1, 'BuildName', 'Street', 'Town', 'Postcode'),
(2, 'ST. NICHOLAS HOUSE', 'BROAD STREET', 'ABERDEEN', 'AB10 1AA'),
(3, 'MARISCHAL COLLEGE', 'BROAD STREET', 'ABERDEEN', 'AB10 1AB'),
(4, 'ST. NICHOLAS HOUSE', 'BROAD STREET', 'ABERDEEN', 'AB10 1AF'),
(5, 'ST. NICHOLAS HOUSE', 'BROAD STREET', 'ABERDEEN', 'AB10 1AG'),
(6, 'TOWN HOUSE', 'BROAD STREET', 'ABERDEEN', 'AB10 1AH');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `mobile` varchar(64) DEFAULT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `password`) VALUES
(1, 'admin', NULL, 'admin@atitonline.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `variation_id` int(11) NOT NULL,
  `variation_name` varchar(256) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` enum('True','False') NOT NULL COMMENT '''True''=1,''False''=0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`variation_id`, `variation_name`, `display_order`, `is_active`) VALUES
(1, 'Type one', 1, 'False'),
(2, 'Update', 12, 'False'),
(3, 'Type twoo', 3, 'False'),
(4, 'Type 1', 2, 'False'),
(5, 'Type 2', 3, 'False'),
(6, 'Type 3', 4, 'False'),
(7, 'Type five test', 50, 'False'),
(8, 'BBQ base', 1, 'True'),
(9, 'Regular Base', 2, 'True'),
(10, 'Zero Input', 0, 'False'),
(11, 'Zero Value', 0, 'True'),
(12, 'Zero Update', 0, 'True'),
(13, 'bbil type 1', 0, 'True'),
(14, 'bbil type 2', 3, 'True'),
(15, 'bbil type 3', 0, 'True');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `Postcode` (`Postcode`),
  ADD KEY `Postcode_2` (`Postcode`);

--
-- Indexes for table `address_long`
--
ALTER TABLE `address_long`
  ADD PRIMARY KEY (`address_long_id`),
  ADD KEY `Postcode` (`Postcode`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contract_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `first_name` (`first_name`,`last_name`,`email`),
  ADD KEY `first_name_2` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `phone` (`phone`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `postcode` (`postcode`);

--
-- Indexes for table `delivery_time`
--
ALTER TABLE `delivery_time`
  ADD PRIMARY KEY (`delivery_time_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `email_requests`
--
ALTER TABLE `email_requests`
  ADD PRIMARY KEY (`email_requests_id`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`food_type_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD PRIMARY KEY (`opening_hours_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_bundle_detail`
--
ALTER TABLE `order_bundle_detail`
  ADD PRIMARY KEY (`order_bundle_detail_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orders_details_id`);

--
-- Indexes for table `order_extra_detail`
--
ALTER TABLE `order_extra_detail`
  ADD PRIMARY KEY (`order_extra_detail_id`),
  ADD KEY `Product_id` (`product_id`);

--
-- Indexes for table `order_offer_detail`
--
ALTER TABLE `order_offer_detail`
  ADD PRIMARY KEY (`order_offer_detail_id`),
  ADD KEY `Product_id` (`product_id`);

--
-- Indexes for table `order_process_type`
--
ALTER TABLE `order_process_type`
  ADD PRIMARY KEY (`order_process_type_id`);

--
-- Indexes for table `order_product_variation`
--
ALTER TABLE `order_product_variation`
  ADD PRIMARY KEY (`order_product_variation_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `postcodes`
--
ALTER TABLE `postcodes`
  ADD PRIMARY KEY (`postcode_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_bundle`
--
ALTER TABLE `product_bundle`
  ADD PRIMARY KEY (`product_bundle_id`);

--
-- Indexes for table `product_extra`
--
ALTER TABLE `product_extra`
  ADD PRIMARY KEY (`extra_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_offer`
--
ALTER TABLE `product_offer`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`product_variations_id`);

--
-- Indexes for table `settings_configurations`
--
ALTER TABLE `settings_configurations`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `sub_products`
--
ALTER TABLE `sub_products`
  ADD PRIMARY KEY (`sub_product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `first_name` (`first_name`,`last_name`,`email`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`variation_id`),
  ADD UNIQUE KEY `variation_id` (`variation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `address_long`
--
ALTER TABLE `address_long`
  MODIFY `address_long_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `delivery_time`
--
ALTER TABLE `delivery_time`
  MODIFY `delivery_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_requests`
--
ALTER TABLE `email_requests`
  MODIFY `email_requests_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `food_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `opening_hours_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_bundle_detail`
--
ALTER TABLE `order_bundle_detail`
  MODIFY `order_bundle_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orders_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_extra_detail`
--
ALTER TABLE `order_extra_detail`
  MODIFY `order_extra_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_offer_detail`
--
ALTER TABLE `order_offer_detail`
  MODIFY `order_offer_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_process_type`
--
ALTER TABLE `order_process_type`
  MODIFY `order_process_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_product_variation`
--
ALTER TABLE `order_product_variation`
  MODIFY `order_product_variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postcodes`
--
ALTER TABLE `postcodes`
  MODIFY `postcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_bundle`
--
ALTER TABLE `product_bundle`
  MODIFY `product_bundle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_extra`
--
ALTER TABLE `product_extra`
  MODIFY `extra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_offer`
--
ALTER TABLE `product_offer`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `product_variations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings_configurations`
--
ALTER TABLE `settings_configurations`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_products`
--
ALTER TABLE `sub_products`
  MODIFY `sub_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
