-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 04:28 AM
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
-- Database: `ecommerce_referencedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `order_id` int(11) NOT NULL,
  `date_order` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `customer_add` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `price` varchar(11) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`order_id`, `date_order`, `customer_id`, `product_id`, `customer_name`, `customer_add`, `image`, `item`, `price`, `qty`, `sub_total`, `status`) VALUES
(20, '07/14/2024', 3, 9, 'Isabel Gamasan', 'Pulanglupa Uno Las Pinas City NCR', '668d4d028b266_images (1).jfif', 'Kitchen Spoon', '99', '2', '198.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `date_add` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `date_add`, `encoded_by`) VALUES
(8, 'Shoes', '07/08/24', 'Jeff Admin'),
(9, 'Watch', '07/09/24', 'Jeff Admin'),
(10, 'Accessories', '07/09/24', 'Jeff Admin'),
(11, 'Utensils', '07/09/24', 'Jeff Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `checkout_id` int(11) NOT NULL,
  `date_order` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`checkout_id`, `date_order`, `customer_id`, `customer_name`, `address`, `item`, `qty`, `price`, `sub_total`, `image`, `payment_method`, `status`) VALUES
(1, '07/12/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'Kitchen Spoon', '2', '99', '198.00', '668d4d028b266_images (1).jfif', 'COD', 'Delivered'),
(2, '07/12/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'women shoes', '1', '2500', '2500.00', '668cfdb116273_61V98P7+jiL._AC_UF894,1000_QL80_.jpg', 'COD', 'Pending'),
(3, '07/12/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'Cooking ware', '2', '599', '1198.00', '668d4d6dcebb9_utensils_1.jfif', 'COD', 'Out for Delivery'),
(4, '07/12/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'women watch', '1', '3000', '3000.00', '668cfd9a75009_61YvpxTUyrL._AC_UY300_.jpg', 'COD', 'Out for Delivery'),
(5, '07/12/2024', '3', 'Isabel Gamasan', 'Pulanglupa Uno Las Pinas City NCR', 'Burloloy for men', '1', '1000', '1000.00', '668cfd7fcd4db_accessories-for-guys-for-a-perfect-classic-look.jpeg', 'COD', 'Delivered'),
(6, '07/12/2024', '3', 'Isabel Gamasan', 'Pulanglupa Uno Las Pinas City NCR', 'women watch', '1', '3000', '3000.00', '668cfd9a75009_61YvpxTUyrL._AC_UY300_.jpg', 'COD', 'Cancel Order'),
(7, '07/12/2024', '3', 'Isabel Gamasan', 'Pulanglupa Uno Las Pinas City NCR', 'Rol-X', '1', '1000', '1000.00', '668cfc48278ca_images.jfif', 'COD', 'Shipped Out'),
(8, '07/13/2024', '3', 'Isabel Gamasan', 'Pulanglupa Uno Las Pinas City NCR', 'Cooking ware', '1', '599', '599.00', '668d4d6dcebb9_utensils_1.jfif', 'COD', 'Cancel Order'),
(9, '07/13/2024', '3', 'Isabel Gamasan', 'Pulanglupa Uno Las Pinas City NCR', 'Cooking ware', '1', '599', '599.00', '668d4d6dcebb9_utensils_1.jfif', 'COD', 'Delivered'),
(10, '07/13/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'Kitchen Spoon', '1', '99', '99.00', '668d4d028b266_images (1).jfif', 'COD', 'Pending'),
(11, '07/12/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'Burloloy for men', '2', '1000', '2000.00', '668cfd7fcd4db_accessories-for-guys-for-a-perfect-classic-look.jpeg', 'COD', 'Pending'),
(12, '07/14/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'Cooking ware', '2', '599', '1198.00', '668d4d6dcebb9_utensils_1.jfif', 'COD', 'Shipped Out'),
(13, '07/14/2024', '1', 'Jeff Ronald Gamasan', 'Las Pinas City', 'Kitchen Spoon', '1', '99', '99.00', '668d4d028b266_images (1).jfif', 'COD', 'Shipped Out'),
(14, '07/18/2024', '4', 'Jameia Fei Gamasan', 'Julios Compound Naga Road Pulanglupa Las Piñas City', 'Kitchen Spoon', '2', '99', '198.00', '668d4d028b266_images (1).jfif', 'COD', 'Delivered'),
(15, '07/18/2024', '4', 'Jameia Fei Gamasan', 'Julios Compound Naga Road Pulanglupa Las Piñas City', 'Cooking ware', '6', '599', '3594.00', '668d4d6dcebb9_utensils_1.jfif', 'COD', 'Delivered'),
(16, '07/18/2024', '4', 'Jameia Fei Gamasan', 'Julios Compound Naga Road Pulanglupa Las Piñas City', 'Rol-X', '3', '1000', '3000.00', '668cfc48278ca_images.jfif', 'COD', 'Delivered'),
(17, '07/18/2024', '4', 'Jameia Fei Gamasan', 'Julios Compound Naga Road Pulanglupa Las Piñas City', 'Burloloy', '1', '500', '500.00', '668cfc5e5d44c_nm_famph.jfif', 'COD', 'Delivered'),
(18, '07/18/2024', '4', 'Jameia Fei Gamasan', 'Julios Compound Naga Road Pulanglupa Las Piñas City', 'Kitchen Spoon', '2', '99', '198.00', '668d4d028b266_images (1).jfif', 'COD', 'Delivered'),
(19, '07/18/2024', '4', 'Jameia Fei Gamasan', 'Julios Compound Naga Road Pulanglupa Las Piñas City', 'Cooking ware', '2', '599', '1198.00', '668d4d6dcebb9_utensils_1.jfif', 'COD', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `added_by` varchar(250) DEFAULT NULL,
  `update_by` varchar(250) DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `category`, `price`, `stock`, `image`, `added_by`, `update_by`, `date_added`, `status`) VALUES
(3, 'Snickers', 'Shoes', '2500', '2', '668cfc23cde9f_NMAAHC-8DCB716FAA9A2_4006.jpg', 'Jeff Admin', NULL, '07/09/2024', 'Active'),
(4, 'Rol-X', 'Watch', '1000', '2', '668cfc48278ca_images.jfif', 'Jeff Admin', NULL, '07/09/2024', 'Active'),
(5, 'Burloloy', 'Accessories', '500', '9', '668cfc5e5d44c_nm_famph.jfif', 'Jeff Admin', NULL, '07/09/2024', 'Active'),
(6, 'Burloloy for men', 'Accessories', '1000', '14', '668cfd7fcd4db_accessories-for-guys-for-a-perfect-classic-look.jpeg', 'Jeff Admin', NULL, '07/09/2024', 'Active'),
(7, 'women watch', 'Watch', '3000', '5', '668cfd9a75009_61YvpxTUyrL._AC_UY300_.jpg', 'Jeff Admin', NULL, '07/09/2024', 'Active'),
(8, 'women shoes', 'Shoes', '2500', '4', '668cfdb116273_61V98P7+jiL._AC_UF894,1000_QL80_.jpg', 'Jeff Admin', NULL, '07/09/2024', 'Active'),
(9, 'Kitchen Spoon', 'Utensils', '99', '0', '668d4d028b266_images (1).jfif', 'Jeff Admin', 'Jeff Admin', '07/09/2024', 'Active'),
(10, 'Cooking ware', 'Utensils', '599', '0', '668d4d6dcebb9_utensils_1.jfif', 'Jeff Admin', NULL, '07/09/2024', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `customer_id` varchar(200) DEFAULT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `feedback` varchar(250) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `customer_id`, `customer_name`, `feedback`, `status`) VALUES
(1, '1', 'JG', 'Good Services', 'Verified'),
(2, '1', 'JG', 'Happy Codings', 'Verified'),
(3, '4', 'JG', 'Good Codes', 'Verified'),
(4, '4', 'JG', 'Comment good', 'Verified'),
(5, '3', 'IG', 'Comments good', 'Verified'),
(6, '3', 'IG', 'testing comment', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `middle_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `user_add` varchar(300) DEFAULT NULL,
  `date_register` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `phone_number` varchar(200) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `user_add`, `date_register`, `status`, `phone_number`, `account_type`) VALUES
(1, 'Jeff Ronald', 'Gaston', 'Gamasan', 'jeffgamasan@gmail.com', '$2y$10$6FvUopXTx.CLcJ6yhER2Sei2JCpzmyHJq1NKDltt9.zIRntHo/Pzi', 'Las Pinas City', '07/04/2024', 'Active', '09452869822', 'user'),
(2, 'Jeff', 'Admin', 'Admin', 'admin@admin.com', '$2y$10$6FvUopXTx.CLcJ6yhER2Sei2JCpzmyHJq1NKDltt9.zIRntHo/Pzi', 'Admin', '07/05/2024', 'Active', '01230312310', 'admin'),
(3, 'Isabel', 'V', 'Gamasan', 'isabelgamasan@gmail.com', '$2y$10$6FvUopXTx.CLcJ6yhER2Sei2JCpzmyHJq1NKDltt9.zIRntHo/Pzi', 'Pulanglupa Uno Las Pinas City NCR', '07/05/2024', 'Active', '09255525552', 'user'),
(4, 'Jameia Fei', 'Vedad', 'Gamasan', 'jam@gmail.com', '$2y$10$GAIQeK.iAs5W6k0T5rtDA.jpPVEe9AH3jAuLiRkrJuW3YQR.ZBH..', 'Julios Compound Naga Road Pulanglupa Las Piñas City', '07/18/2024', 'Active', '09452869822', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
