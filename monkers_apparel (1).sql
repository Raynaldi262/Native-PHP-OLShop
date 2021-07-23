-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 06:52 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monkers_apparel`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `status`, `privilege`) VALUES
(1, 'Owner', 1),
(2, 'Manager', 2),
(3, 'Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `address_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `cust_address` varchar(255) NOT NULL,
  `cust_province` varchar(255) NOT NULL,
  `cust_city` varchar(255) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `cust_phone` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `cust_id`, `cust_name`, `cust_address`, `cust_province`, `cust_city`, `cust_email`, `cust_phone`, `create_date`, `status`) VALUES
(3, 3, 'dinda', 'asdasdads', '123123', 'Jabodetabek', 'wahyuhaw@gmail.com', '02155468265', '2021-05-13', 'IN-ACTIVE'),
(4, 3, 'ddddd', 'Jl. Scientia Boulevard, Curug Sangereng duar duar', 'Banten', 'Jabodetabek', 'asd@asd.com', '087889577799', '2021-05-15', 'ACTIVE'),
(5, 5, 'aaa', 'asdasdads', 'Banten', 'Tangerang', 'asd@asd.com', '21123', '2021-05-15', 'ACTIVE'),
(6, 5, 'dinda', 'asdasdads', 'Jawa', 'Semarang', 'wahyuhaw@gmail.com', '1231', '2021-05-15', 'ACTIVE'),
(7, 5, 'dinda', 'dasasd', 'Banten', 'Tangerang', 'wahyuhaw@gmail.com', '12232', '2021-05-15', 'IN-ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username_adm` varchar(50) NOT NULL,
  `password_adm` varchar(50) NOT NULL,
  `admin_birth` date NOT NULL,
  `admin_phone` varchar(20) NOT NULL,
  `admin_status` varchar(10) NOT NULL,
  `role_id` int(11) NOT NULL,
  `admin_img` varchar(255) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `username_adm`, `password_adm`, `admin_birth`, `admin_phone`, `admin_status`, `role_id`, `admin_img`, `create_date`) VALUES
(1, 'Mark Zuckenbukkkkk', 'admin', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '2021-01-01', '11222331', 'active', 1, 'gbr2.png', '0000-00-00'),
(4, 'test', 'test', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '2021-03-28', '', 'active', 2, 'default.jpg', '2021-04-05'),
(9, 'budiiiiiiiiiiii', 'budi', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '2021-04-25', '12221122', 'active', 3, 'default.jpg', '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `prov_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`area_id`, `area_name`, `prov_id`) VALUES
(4, 'Jabodetabek', 2),
(6, 'Tangerang', 2),
(10, 'Semarang', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `banner_id` int(11) NOT NULL,
  `banner_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`banner_id`, `banner_img`) VALUES
(2, 'gmbr5.jpg'),
(3, 'gbr1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `check_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`color_id`, `color_name`) VALUES
(1, 'biru'),
(2, 'hitam'),
(3, 'kuning');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(30) NOT NULL,
  `cust_birth` date NOT NULL,
  `cust_address` varchar(255) NOT NULL,
  `cust_province` varchar(255) NOT NULL,
  `cust_city` varchar(255) NOT NULL,
  `cust_email` varchar(30) NOT NULL,
  `cust_pass` varchar(50) NOT NULL,
  `cust_phone` varchar(20) NOT NULL,
  `cust_total_order` int(11) NOT NULL,
  `cust_total_price` int(11) NOT NULL,
  `cust_img` varchar(255) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cust_id`, `cust_name`, `cust_birth`, `cust_address`, `cust_province`, `cust_city`, `cust_email`, `cust_pass`, `cust_phone`, `cust_total_order`, `cust_total_price`, `cust_img`, `create_date`) VALUES
(3, 'asd', '2021-04-17', 'Jl. Scientia Boulevard, Curug Sangereng', 'banten', 'Tangerang', 'asd@asd.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '087889577799', 4, 74400, 'default.jpeg', '2021-04-17'),
(4, 'Raynaldi Ginantara', '2021-04-22', 'Jl. Scientia Boulevard, Curug Sangereng', 'banten', 'Tangerang', 'admin@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '087889577799', 0, 0, 'default.jpeg', '2021-04-22'),
(5, 'asd', '2021-04-26', 'asdasdads', 'Banten', 'Tangerang', 'anjay@anjay.com', '*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799', '1313', 0, 0, 'IMG-20210510-WA0013.jpg', '2021-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detailorder`
--

CREATE TABLE `tbl_detailorder` (
  `detail_id` int(11) NOT NULL,
  `date_id` varchar(100) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detailorder`
--

INSERT INTO `tbl_detailorder` (`detail_id`, `date_id`, `item_id`, `cust_id`, `size`, `qty`, `create_date`) VALUES
(71, '07420120210515', 24, 3, 'XL', 1, '2021-05-15'),
(72, '07420120210515', 24, 3, 'L', 2, '2021-05-15'),
(73, '07483520210515', 26, 3, 'XL', 1, '2021-05-15'),
(74, '08152420210515', 26, 3, 'XL', 1, '2021-05-15'),
(75, '05223220210522', 25, 3, 'S', 1, '2021-05-22'),
(76, '07494520210524', 24, 3, 'XL', 1, '2021-05-24'),
(77, '08411320210524', 24, 3, 'XL', 1, '2021-05-24'),
(78, '09271320210608', 25, 3, 'S', 1, '2021-06-08'),
(79, '11293320210723', 25, 3, 'S', 1, '2021-07-23'),
(80, '11310220210723', 26, 3, 'XL', 1, '2021-07-23'),
(81, '11315420210723', 26, 3, 'XL', 1, '2021-07-23'),
(82, '11315420210723', 25, 3, 'S', 1, '2021-07-23'),
(83, '11361420210723', 26, 3, 'XL', 1, '2021-07-23'),
(84, '11361420210723', 25, 3, 'S', 1, '2021-07-23'),
(85, '11394720210723', 26, 3, 'XL', 1, '2021-07-23'),
(86, '11451020210723', 26, 3, 'XL', 1, '2021-07-23'),
(87, '11451020210723', 25, 3, 'S', 1, '2021-07-23'),
(88, '11512920210723', 25, 3, 'S', 3, '2021-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_img`
--

CREATE TABLE `tbl_img` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_img`
--

INSERT INTO `tbl_img` (`img_id`, `img_name`, `item_id`, `create_date`) VALUES
(9, '07364020210515MCJ-02-LONG-SHIRT-BLACK_1-1024x1024.jpg', 24, '0000-00-00 00:00:00'),
(10, '07365720210515Apprel-for-web-17-819x1024.jpg', 24, '2021-05-15 19:36:57'),
(11, '07375320210515MCJ-03-JACKET-BLACK_1-1024x1024.jpg', 25, '0000-00-00 00:00:00'),
(12, '07382020210515Apprel-for-web-03-819x1024.jpg', 26, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `item_weight` int(11) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `item_price` int(11) NOT NULL,
  `item_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `type_id`, `color_id`, `item_weight`, `item_desc`, `create_date`, `item_price`, `item_status`) VALUES
(24, 'test1', 1, 2, 200, 'test', '2021-05-15', 12000, 'ACTIVE'),
(25, 'test2', 4, 2, 100, 'testtttt', '2021-05-15', 20000, 'ACTIVE'),
(26, 'test1', 1, 1, 50, 'test', '2021-05-15', 12000, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_detail`
--

CREATE TABLE `tbl_item_detail` (
  `detail_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `detail_qty` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_detail`
--

INSERT INTO `tbl_item_detail` (`detail_id`, `size_id`, `detail_qty`, `status`, `item_id`) VALUES
(12, 1, 0, 'ACTIVE', 24),
(13, 9, 0, 'ACTIVE', 24),
(14, 1, 1, 'ACTIVE', 26),
(15, 12, 230, 'ACTIVE', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_type`
--

CREATE TABLE `tbl_item_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_type`
--

INSERT INTO `tbl_item_type` (`type_id`, `type_name`) VALUES
(1, 'Kaos'),
(2, 'Kaos Lengan Panjang'),
(3, 'Sweater'),
(4, 'Jaket bomber'),
(5, 'Topi'),
(6, 'Tas Totebag');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ongkir`
--

CREATE TABLE `tbl_ongkir` (
  `ongkir_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `ongkir_type` varchar(255) NOT NULL,
  `ongkir_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ongkir`
--

INSERT INTO `tbl_ongkir` (`ongkir_id`, `area_id`, `ongkir_type`, `ongkir_price`, `status`) VALUES
(5, 6, 'Jne', 1200, 'active'),
(6, 4, 'Jne', 3000, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `order_invoice` varchar(255) NOT NULL,
  `order_resi` varchar(255) NOT NULL,
  `order_total` int(11) NOT NULL COMMENT 'total qty pembelian',
  `order_shipping` varchar(255) NOT NULL,
  `order_shipping_price` int(11) NOT NULL,
  `order_totprice` int(11) NOT NULL,
  `order_transfer` varchar(255) NOT NULL COMMENT 'buat gambar',
  `order_status` varchar(50) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `date_id` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_invoice`, `order_resi`, `order_total`, `order_shipping`, `order_shipping_price`, `order_totprice`, `order_transfer`, `order_status`, `cust_id`, `address_id`, `date_id`, `create_date`) VALUES
(25, 'MA/INV/15-05-21/00001', '14045', 3, 'Jne', 1200, 36000, '07420120210515Apprel-for-web-2-17-819x1024.jpg', 'Pesanan dikirim', 3, 0, '07420120210515', '2021-05-15 19:42:36'),
(26, 'MA/INV/15-05-21/00002', '1212', 1, 'Jne', 1200, 12000, '07483520210515Apprel-for-web-2-17-819x1024.jpg', 'Pesanan dikirim', 3, 0, '07483520210515', '2021-05-15 19:58:32'),
(27, 'MA/INV/15-05-21/ 00003', '21', 1, 'Jne', 1200, 12000, '08152420210515Apprel-for-web-2-17-819x1024.jpg', 'Pesanan dikirim', 3, 4, '08152420210515', '2021-05-15 20:16:58'),
(28, 'MA/INV/05-06-21/00004', '', 1, 'Jne', 3000, 12000, '08411320210524Apprel-for-web-03-819x1024.jpg', 'Proses Pengemasan', 3, 4, '08411320210524', '2021-06-05 12:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proses`
--

CREATE TABLE `tbl_proses` (
  `proses_id` int(11) NOT NULL,
  `date_id` varchar(100) DEFAULT NULL,
  `cust_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(100) DEFAULT NULL,
  `ongkir` int(11) NOT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `img_bayar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_proses`
--

INSERT INTO `tbl_proses` (`proses_id`, `date_id`, `cust_id`, `address_id`, `name`, `price`, `ongkir`, `kurir`, `status`, `create_date`, `img_bayar`) VALUES
(44, '07420120210515', 3, 0, 'asd', 36000, 1200, 'Jne', 'Pesanan dikirim', '2021-05-15', '07420120210515Apprel-for-web-2-17-819x1024.jpg'),
(45, '07483520210515', 3, 0, 'asd', 12000, 1200, 'Jne', 'Pesanan dikirim', '2021-05-15', '07483520210515Apprel-for-web-2-17-819x1024.jpg'),
(46, '08152420210515', 3, 4, 'ddddd', 12000, 1200, 'Jne', 'Pesanan dikirim', '2021-05-15', '08152420210515Apprel-for-web-2-17-819x1024.jpg'),
(47, '05223220210522', 3, 0, 'asd', 20000, 1200, 'Jne', 'Menunggu Konfrimasi', '2021-05-22', '05223220210522Apprel-for-web-03-819x1024.jpg'),
(48, '07494520210524', 3, 4, 'ddddd', 12000, 3000, 'Jne', 'Menunggu Konfrimasi', '2021-05-24', '07494520210524Apprel-for-web-03-819x1024.jpg'),
(49, '08411320210524', 3, 4, 'ddddd', 12000, 3000, 'Jne', 'Proses Pengemasan', '2021-05-24', '08411320210524Apprel-for-web-03-819x1024.jpg'),
(50, '09271320210608', 3, 0, 'asd', 20000, 1200, 'Jne', 'Menunggu Konfrimasi', '2021-06-08', '09271320210608gbr1.png'),
(55, '11394720210723', 3, 0, 'asd', 12000, 1200, 'Jne', 'Menunggu Konfrimasi', '2021-07-23', '11394720210723S__16015497.jpg'),
(56, '11451020210723', 3, 0, 'asd', 32000, 1200, 'Jne', 'Menunggu Konfrimasi', '2021-07-23', '11451020210723S__16015497.jpg'),
(57, '11512920210723', 3, 0, 'asd', 60000, 1200, 'Jne', 'Menunggu Konfrimasi', '2021-07-23', '11512920210723S__16015497.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_provinsi`
--

CREATE TABLE `tbl_provinsi` (
  `prov_id` int(11) NOT NULL,
  `prov_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`prov_id`, `prov_name`) VALUES
(2, 'Banten'),
(3, 'Jawa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`size_id`, `size_name`) VALUES
(1, 'XL'),
(9, 'L'),
(11, 'M'),
(12, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stockinout`
--

CREATE TABLE `tbl_stockinout` (
  `stok_id` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `stok_qty` int(11) NOT NULL,
  `stok_desc` varchar(200) NOT NULL,
  `stok_price` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stockinout`
--

INSERT INTO `tbl_stockinout` (`stok_id`, `detail_id`, `stok_qty`, `stok_desc`, `stok_price`, `total_qty`, `create_date`) VALUES
(105, 12, 0, 'STOCK IN', 0, 100, '2021-05-15 19:37:13'),
(106, 13, 0, 'STOCK IN', 0, 50, '2021-05-15 19:37:24'),
(107, 14, 0, 'STOCK IN', 0, 120, '2021-05-15 19:38:37'),
(108, 14, 20, 'STOCK IN', 0, 140, '2021-05-15 19:38:43'),
(109, 12, 1, 'STOCK OUT', 12000, 99, '2021-05-15 19:42:36'),
(110, 13, 2, 'STOCK OUT', 24000, 48, '2021-05-15 19:42:36'),
(112, 14, 60, 'STOCK OUT', 0, 80, '2021-05-15 19:55:27'),
(113, 14, 1, 'STOCK OUT', 12000, 79, '2021-05-15 19:58:32'),
(114, 14, 1, 'STOCK OUT', 12000, 78, '2021-05-15 20:16:58'),
(115, 15, 0, 'STOCK IN', 0, 230, '2021-05-16 19:01:01'),
(116, 12, 1, 'STOCK OUT', 12000, 98, '2021-06-05 12:04:40'),
(117, 14, 78, 'STOCK OUT', 0, 0, '2021-06-28 21:26:28'),
(118, 14, 1, 'STOCK IN', 0, 1, '2021-06-28 21:27:11'),
(119, 12, 98, 'STOCK OUT', 0, 0, '2021-06-28 21:28:01'),
(120, 13, 48, 'STOCK OUT', 0, 0, '2021-06-28 21:28:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `tbl_detailorder`
--
ALTER TABLE `tbl_detailorder`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tbl_img`
--
ALTER TABLE `tbl_img`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tbl_item_detail`
--
ALTER TABLE `tbl_item_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tbl_item_type`
--
ALTER TABLE `tbl_item_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  ADD PRIMARY KEY (`ongkir_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`,`order_invoice`),
  ADD KEY `item_id` (`date_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `tbl_proses`
--
ALTER TABLE `tbl_proses`
  ADD PRIMARY KEY (`proses_id`);

--
-- Indexes for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  ADD PRIMARY KEY (`prov_id`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tbl_stockinout`
--
ALTER TABLE `tbl_stockinout`
  ADD PRIMARY KEY (`stok_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_detailorder`
--
ALTER TABLE `tbl_detailorder`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tbl_img`
--
ALTER TABLE `tbl_img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_item_detail`
--
ALTER TABLE `tbl_item_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_item_type`
--
ALTER TABLE `tbl_item_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  MODIFY `ongkir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_proses`
--
ALTER TABLE `tbl_proses`
  MODIFY `proses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_stockinout`
--
ALTER TABLE `tbl_stockinout`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `color_id` FOREIGN KEY (`color_id`) REFERENCES `tbl_color` (`color_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `tbl_item_type` (`type_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  ADD CONSTRAINT `area_id` FOREIGN KEY (`area_id`) REFERENCES `tbl_area` (`area_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `cust_id` FOREIGN KEY (`cust_id`) REFERENCES `tbl_customer` (`cust_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
