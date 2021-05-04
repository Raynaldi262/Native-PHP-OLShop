-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 01:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

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
(5, 'Bali', 2),
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
  `qty` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`check_id`, `cust_id`, `item_id`, `qty`, `date`) VALUES
(33, 4, 13, 1, 2147483647),
(48, 3, 13, 1, 2147483647);

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
  `cust_address` varchar(50) NOT NULL,
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
(3, 'asd', '2021-04-17', 'Jl. Scientia Boulevard, Curug Sangereng', 'banten', 'Tangerang', 'asd@asd.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '087889577799', 12, 1060040, 'default.jpeg', '2021-04-17'),
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

--
-- Dumping data for table `tbl_detailorder`
--

INSERT INTO `tbl_detailorder` (`detail_id`, `date_id`, `item_id`, `cust_id`, `qty`, `create_date`) VALUES
(14, '01060020210417', 10, 3, 5, '2021-04-17'),
(15, '01133720210417', 11, 3, 1, '2021-04-17'),
(16, '01133720210417', 10, 3, 1, '2021-04-17'),
(17, '10213320210417', 11, 3, 3, '2021-04-17'),
(18, '10392420210418', 10, 3, 3, '2021-04-18'),
(19, '10442820210418', 11, 3, 1, '2021-04-18'),
(20, '10505620210418', 11, 3, 1, '2021-04-18'),
(21, '11570520210418', 10, 3, 1, '2021-04-18'),
(22, '11570520210418', 11, 3, 1, '2021-04-18'),
(23, '12015620210418', 10, 3, 2, '2021-04-18'),
(24, '12015620210418', 11, 3, 1, '2021-04-18'),
(25, '03572520210422', 13, 3, 1, '2021-04-22'),
(26, '07270320210422', 13, 3, 6, '2021-04-22'),
(27, '07324220210422', 12, 3, 6, '2021-04-22'),
(28, '07324220210422', 11, 3, 1, '2021-04-22'),
(29, '07350820210422', 13, 3, 8, '2021-04-22'),
(30, '07390520210422', 13, 3, 5, '2021-04-22'),
(31, '07464320210422', 13, 3, 6, '2021-04-22'),
(32, '12052120210423', 14, 3, 6, '2021-04-23'),
(33, '09101420210423', 12, 3, 12, '2021-04-23'),
(34, '09174620210423', 14, 3, 10, '2021-04-23'),
(35, '10485020210425', 13, 3, 1, '2021-04-25'),
(36, '10485020210425', 16, 3, 1, '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `item_size` varchar(255) NOT NULL,
  `item_weight` int(11) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `item_img` varchar(255) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`item_id`, `item_name`, `type_id`, `color_id`, `item_size`, `item_weight`, `item_desc`, `item_qty`, `create_date`, `item_img`, `item_price`, `item_status`) VALUES
(10, 'test1', 2, 2, 'xl', 100, 'asd', 9, '2021-04-17', 'gbr1.png', 10000, 'IN-ACTIVE'),
(11, 'test2', 2, 2, 'xl', 100, 'as', 15, '2021-04-17', 'gmbr5.jpg', 1000, 'ACTIVE'),
(12, 'test3', 1, 2, 'xl', 13, 'asd', 0, '2021-04-20', 'ntr2.jpg', 10020, 'ACTIVE'),
(13, 'test4', 2, 3, 'xl', 500, 'tes', 4, '2021-04-22', 'ntr1.jpg', 10200, 'ACTIVE'),
(14, 'test5', 2, 2, 'xl', 1222, 'asd', 6, '2021-04-22', 'gbr2.png', 120000, 'ACTIVE'),
(15, 'test6', 1, 3, 'xl', 120, 'asd', 12, '2021-04-22', 'ntr1.jpg', 1222, 'ACTIVE'),
(16, 'test10', 5, 2, 'xxx', 12, 'asd', 11, '2021-04-22', 'ntr3.jpg', 20000, 'ACTIVE');

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
(20, 'MA/INV/25-04-21/00012', '', 2, 'Jne', 1200, 30200, '10485020210425ntr3.jpg', 'Proses Pengemasan', 3, '10485020210425', '2021-04-25 11:27:13');

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

--
-- Dumping data for table `tbl_proses`
--

INSERT INTO `tbl_proses` (`proses_id`, `date_id`, `cust_id`, `price`, `ongkir`, `kurir`, `status`, `create_date`, `img_bayar`) VALUES
(12, '01060020210417', 3, 50000, 1200, 'Jne', 'Pesanan dikirim', '2021-04-17', 'gmbr5.jpg'),
(13, '01133720210417', 3, 12000, 1200, 'Jne', 'Pesanan dibatalkan', '2021-04-17', 'ntr3.jpg'),
(14, '10213320210417', 3, 3000, 1200, 'Jne', 'Pesanan dikirim', '2021-04-17', 'ntr2.jpg'),
(15, '10392420210418', 3, 30000, 1200, 'Jne', 'Pesanan dikirim', '2021-04-18', '10392420210418gbr4.png'),
(16, '10442820210418', 3, 1000, 1200, 'Jne', 'Proses Pengemasan', '2021-04-18', '10442820210418ntr3.jpg'),
(17, '10505620210418', 3, 1000, 1200, 'Jne', 'Proses Pengemasan', '2021-04-18', '10505620210418gmbr5.jpg'),
(18, '11570520210418', 3, 11000, 1200, 'Jne', 'Pesanan dikirim', '2021-04-18', '11570520210418ntr3.jpg'),
(19, '12015620210418', 3, 21000, 1200, 'Jne', 'Pesanan dikirim', '2021-04-18', '12015620210418gbr2.png'),
(20, '03572520210422', 3, 10200, 1200, 'Jne', 'Proses Pengemasan', '2021-04-22', '03572520210422ntr3.jpg'),
(21, '07270320210422', 3, 61200, 4800, 'Jne', 'Pesanan dibatalkan', '2021-04-22', '07270320210422ntr3.jpg'),
(22, '07324220210422', 3, 61120, 1200, 'Jne', 'Pesanan dibatalkan', '2021-04-22', '07324220210422ntr3.jpg'),
(23, '07350820210422', 3, 81600, 6000, 'Jne', 'Pesanan dibatalkan', '2021-04-22', '07350820210422gbr3.png'),
(24, '07390520210422', 3, 51000, 3600, 'Jne', 'Pesanan dibatalkan', '2021-04-22', '07390520210422gmbr5.jpg'),
(25, '07464320210422', 3, 61200, 4800, 'Jne', 'Proses Pengemasan', '2021-04-22', '07464320210422ntr3.jpg'),
(26, '12052120210423', 3, 720000, 9600, 'Jne', 'Pesanan dikirim', '2021-04-23', '12052120210423ntr3.jpg'),
(27, '09101420210423', 3, 120240, 1200, 'Jne', 'Proses Pengemasan', '2021-04-23', '09101420210423ntr3.jpg'),
(28, '09174620210423', 3, 1200000, 15600, 'Jne', 'Menunggu Konfrimasi', '2021-04-23', '09174620210423ntr3.jpg'),
(29, '10485020210425', 3, 30200, 1200, 'Jne', 'Proses Pengemasan', '2021-04-25', '10485020210425ntr3.jpg');

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
-- Table structure for table `tbl_stockinout`
--

CREATE TABLE `tbl_stockinout` (
  `stok_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `stok_qty` int(11) NOT NULL,
  `stok_desc` varchar(200) NOT NULL,
  `stok_price` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stockinout`
--

INSERT INTO `tbl_stockinout` (`stok_id`, `item_id`, `item_name`, `stok_qty`, `stok_desc`, `stok_price`, `total_qty`, `create_date`) VALUES
(44, 10, 'test1', 0, 'STOCK IN', 0, 12, '2021-04-17 00:19:28'),
(45, 11, 'test2', 0, 'STOCK IN', 0, 12, '2021-04-17 13:12:51'),
(46, 10, 'test1', 8, 'STOCK IN', 0, 20, '2021-04-17 19:20:21'),
(48, 10, 'test1', 5, 'STOCK OUT', 50000, 15, '2021-04-17 23:20:22'),
(49, 11, 'test2', 3, 'STOCK OUT', 3000, 9, '2021-04-17 23:21:28'),
(50, 10, 'test1', 3, 'STOCK OUT', 30000, 12, '2021-04-18 10:40:07'),
(51, 11, 'test2', 1, 'STOCK OUT', 1000, 8, '2021-04-18 10:48:59'),
(52, 11, 'test2', 1, 'STOCK OUT', 1000, 7, '2021-04-18 10:51:28'),
(53, 10, 'test1', 1, 'STOCK OUT', 10000, 11, '2021-04-18 11:57:19'),
(54, 11, 'test2', 1, 'STOCK OUT', 1000, 6, '2021-04-18 11:57:19'),
(55, 10, 'test1', 2, 'STOCK OUT', 20000, 9, '2021-04-18 12:06:17'),
(56, 11, 'test2', 1, 'STOCK OUT', 1000, 5, '2021-04-18 12:06:17'),
(57, 12, 'test3', 0, 'STOCK IN', 0, 12, '2021-04-20 23:19:37'),
(58, 11, 'test2', 10, 'STOCK IN', 0, 15, '2021-04-21 22:44:00'),
(59, 13, 'test4', 0, 'STOCK IN', 0, 12, '2021-04-22 14:19:17'),
(60, 13, 'test4', 6, 'STOCK OUT', 61200, 6, '2021-04-22 19:47:26'),
(61, 14, 'test5', 0, 'STOCK IN', 0, 12, '2021-04-22 21:14:16'),
(62, 15, 'test6', 0, 'STOCK IN', 0, 12, '2021-04-22 21:14:44'),
(63, 16, 'test10', 0, 'STOCK IN', 0, 12, '2021-04-22 23:45:19'),
(64, 14, 'test5', 6, 'STOCK OUT', 720000, 6, '2021-04-23 12:06:55'),
(65, 12, 'test3', 12, 'STOCK OUT', 120240, 0, '2021-04-23 21:10:27'),
(66, 13, 'test4', 1, 'STOCK OUT', 10200, 5, '2021-04-25 00:17:34'),
(67, 13, 'test4', 1, 'STOCK OUT', 10200, 4, '2021-04-25 11:27:13'),
(68, 16, 'test10', 1, 'STOCK OUT', 20000, 11, '2021-04-25 11:27:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

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
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `type_id` (`type_id`);

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
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_detailorder`
--
ALTER TABLE `tbl_detailorder`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_proses`
--
ALTER TABLE `tbl_proses`
  MODIFY `proses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_stockinout`
--
ALTER TABLE `tbl_stockinout`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
