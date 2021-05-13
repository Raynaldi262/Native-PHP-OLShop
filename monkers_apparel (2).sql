-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 10:20 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

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
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `cust_id`, `cust_name`, `cust_address`, `cust_province`, `cust_city`, `cust_email`, `cust_phone`, `create_date`) VALUES
(2, 3, 'aaa', 'asdasdads', '123123', 'Jabodetabek', 'wahyuhaw@gmail.com', '131231', '2021-05-13'),
(3, 3, 'wahyu', '23adsdas ', 'asdasdas', 'Jabodetabek', 'wahyuhaw@gmail.comm', '12312332', '2021-05-13');

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

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `item_id`, `cust_id`, `size`, `qty`, `create_date`) VALUES
(42, 23, 3, 'XL', 2, '2021-05-12'),
(43, 22, 3, 'S', 1, '2021-05-13'),
(44, 23, 3, 'L', 1, '2021-05-13');

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

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`check_id`, `cust_id`, `item_id`, `size`, `qty`, `date`) VALUES
(53, 3, 23, 'XL', 4, 2147483647),
(54, 3, 22, 'S', 2, 2147483647),
(55, 3, 23, 'L', 4, 2147483647),
(56, 3, 23, 'XL', 2, 2147483647),
(57, 3, 22, 'S', 1, 2147483647),
(58, 3, 23, 'L', 1, 2147483647);

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
(3, 'asd', '2021-04-17', 'Jl. Scientia Boulevard, Curug Sangereng', 'banten', 'Tangerang', 'asd@asd.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '087889577799', 13, 1080440, 'default.jpeg', '2021-04-17'),
(4, 'Raynaldi Ginantara', '2021-04-22', 'Jl. Scientia Boulevard, Curug Sangereng', 'banten', 'Tangerang', 'admin@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '087889577799', 0, 0, 'default.jpeg', '2021-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detailorder`
--

CREATE TABLE `tbl_detailorder` (
  `detail_id` int(11) NOT NULL,
  `date_id` varchar(100) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_img`
--

CREATE TABLE `tbl_img` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_img`
--

INSERT INTO `tbl_img` (`img_id`, `img_name`, `item_id`) VALUES
(2, '04171720210509gmbr5.jpg', 22),
(4, '07050720210509ntr3.jpg', 22),
(5, '07053220210509gbr2.png', 22),
(6, '08232420210509gbr3.png', 23),
(7, '08234220210509gbr1.png', 23);

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
(22, 'test1', 2, 2, 200, 'xl', '2021-05-09', 12000, 'ACTIVE'),
(23, 'test2', 1, 2, 200, 'asd', '2021-05-09', 12000, 'ACTIVE');

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
(1, 1, 10, 'IN-ACTIVE', 22),
(2, 9, 20, 'IN-ACTIVE', 22),
(3, 1, 1, 'IN-ACTIVE', 22),
(4, 1, 2, 'IN-ACTIVE', 22),
(5, 1, 200, 'ACTIVE', 22),
(6, 9, 50, 'ACTIVE', 22),
(7, 1, 40, 'ACTIVE', 23),
(8, 9, 70, 'ACTIVE', 23),
(9, 12, 1, 'ACTIVE', 22),
(10, 11, 50, 'ACTIVE', 22);

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
  `item_id` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_invoice`, `order_resi`, `order_total`, `order_shipping`, `order_shipping_price`, `order_totprice`, `order_transfer`, `order_status`, `cust_id`, `item_id`, `create_date`) VALUES
(9, 'MA/INV/17-04-21/00001', 'sadad122121', 5, 'Jne', 1200, 50000, 'gmbr5.jpg', 'Pesanan dikirim', 3, '01060020210417', '2021-04-17 23:20:22'),
(10, 'MA/INV/17-04-21/00002', 'asdasd', 3, 'Jne', 1200, 3000, 'ntr2.jpg', 'Pesanan dikirim', 3, '10213320210417', '2021-04-17 23:21:28'),
(11, 'MA/INV/18-04-21/00003', '13123', 3, 'Jne', 1200, 30000, '10392420210418gbr4.png', 'Pesanan dikirim', 3, '10392420210418', '2021-04-18 10:40:07'),
(12, 'MA/INV/18-04-21/00004', '', 1, 'Jne', 1200, 1000, '10442820210418ntr3.jpg', 'Proses Pengemasan', 3, '10442820210418', '2021-04-18 10:48:59'),
(13, 'MA/INV/18-04-21/00005', '', 1, 'Jne', 1200, 1000, '10505620210418gmbr5.jpg', 'Proses Pengemasan', 3, '10505620210418', '2021-04-18 10:51:28'),
(14, 'MA/INV/18-04-21/00006', '1212', 2, 'Jne', 1200, 11000, '11570520210418ntr3.jpg', 'Pesanan dikirim', 3, '11570520210418', '2021-04-18 11:57:19'),
(15, 'MA/INV/18-04-21/00007', '1212', 3, 'Jne', 1200, 21000, '12015620210418gbr2.png', 'Pesanan dikirim', 3, '12015620210418', '2021-04-18 12:06:17'),
(16, 'MA/INV/22-04-21/00008', '', 6, 'Jne', 4800, 61200, '07464320210422ntr3.jpg', 'Proses Pengemasan', 3, '07464320210422', '2021-04-22 19:47:26'),
(17, 'MA/INV/23-04-21/00009', 'asdasd', 6, 'Jne', 9600, 720000, '12052120210423ntr3.jpg', 'Pesanan dikirim', 3, '12052120210423', '2021-04-23 12:06:55'),
(18, 'MA/INV/23-04-21/00010', '', 12, 'Jne', 1200, 120240, '09101420210423ntr3.jpg', 'Proses Pengemasan', 3, '09101420210423', '2021-04-23 21:10:27'),
(19, 'MA/INV/24-04-21/00011', '', 1, 'Jne', 1200, 10200, '03572520210422ntr3.jpg', 'Proses Pengemasan', 3, '03572520210422', '2021-04-25 00:17:34'),
(20, 'MA/INV/25-04-21/00012', '', 2, 'Jne', 1200, 30200, '10485020210425ntr3.jpg', 'Proses Pengemasan', 3, '10485020210425', '2021-04-25 11:27:13'),
(21, 'MA/INV/04-05-21/00013', '', 2, 'Jne', 2400, 20400, '10014020210504alur.JPG', 'Proses Pengemasan', 3, '10014020210504', '2021-05-04 22:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proses`
--

CREATE TABLE `tbl_proses` (
  `proses_id` int(11) NOT NULL,
  `date_id` varchar(100) DEFAULT NULL,
  `cust_id` int(11) NOT NULL,
  `price` int(100) DEFAULT NULL,
  `ongkir` int(11) NOT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `img_bayar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(70, 5, 0, 'STOCK IN', 0, 20, '2021-05-10 20:24:14'),
(71, 5, 10, 'STOCK IN', 0, 30, '2021-05-10 20:30:22'),
(73, 5, 20, 'STOCK OUT', 0, 10, '2021-05-10 20:34:05'),
(75, 5, 30, 'STOCK IN', 0, 40, '2021-05-10 20:36:14'),
(78, 5, 10, 'STOCK IN', 0, 50, '2021-05-10 20:37:13'),
(79, 6, 0, 'STOCK IN', 0, 20, '2021-05-10 20:38:11'),
(80, 6, 30, 'STOCK IN', 0, 50, '2021-05-10 20:39:51'),
(82, 5, 60, 'STOCK IN', 0, 110, '2021-05-10 20:40:41'),
(83, 5, 10, 'STOCK OUT', 0, 100, '2021-05-10 20:41:02'),
(85, 5, 20, 'STOCK IN', 0, 120, '2021-05-10 20:41:15'),
(87, 5, 30, 'STOCK IN', 0, 150, '2021-05-10 20:44:26'),
(89, 5, 50, 'STOCK IN', 0, 200, '2021-05-10 20:45:14'),
(91, 5, 10, 'STOCK IN', 0, 210, '2021-05-10 20:47:06'),
(92, 5, 200, 'STOCK IN', 0, 410, '2021-05-10 20:47:40'),
(93, 5, 210, 'STOCK OUT', 0, 200, '2021-05-10 20:47:46'),
(94, 7, 0, 'STOCK IN', 0, 40, '2021-05-10 20:48:15'),
(95, 8, 0, 'STOCK IN', 0, 20, '2021-05-10 20:48:22'),
(96, 8, 50, 'STOCK IN', 0, 70, '2021-05-10 20:48:29'),
(97, 9, 0, 'STOCK IN', 0, 1, '2021-05-12 19:19:27'),
(98, 10, 0, 'STOCK IN', 0, 50, '2021-05-12 19:19:36');

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
  ADD KEY `item_id` (`item_id`),
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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_detailorder`
--
ALTER TABLE `tbl_detailorder`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_img`
--
ALTER TABLE `tbl_img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_item_detail`
--
ALTER TABLE `tbl_item_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_item_type`
--
ALTER TABLE `tbl_item_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  MODIFY `ongkir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_proses`
--
ALTER TABLE `tbl_proses`
  MODIFY `proses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_stockinout`
--
ALTER TABLE `tbl_stockinout`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
