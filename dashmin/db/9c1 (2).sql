-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 08:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `9c1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catId` int(11) NOT NULL,
  `catName` varchar(20) NOT NULL,
  `catImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catName`, `catImage`) VALUES
(3, 'skin care', 'Daily-skincare-for-teenagers.webp'),
(4, 'abbayas', '19_ec5d7003-9bcc-46e6-a56c-7097df0bdfd3.webp'),
(5, 'shoes', '6_ad59d255-a4ec-4b7e-bde5-f3abab93952a_2048x.webp');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoiceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `productsName` varchar(30) NOT NULL,
  `itemCount` int(11) NOT NULL,
  `productQuantities` int(11) NOT NULL,
  `totalAmount` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `confirmationCode` varchar(20) NOT NULL,
  `deliveryStatus` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoiceId`, `userId`, `userEmail`, `productsName`, `itemCount`, `productQuantities`, `totalAmount`, `date`, `time`, `confirmationCode`, `deliveryStatus`) VALUES
(1, 11, 'fareehajabeen62@gmail.com', 'abaya,facial kit', 14, 3, 16500, '2024-10-29', '12:18:02', '#OD296287', 'pending'),
(2, 11, 'fareehajabeen62@gmail.com', 'arabic abayas,arabic abayas', 2, 3, 19500, '2024-10-29', '12:36:26', '#OD311494', 'pending'),
(3, 11, 'fareehajabeen62@gmail.com', 'facial kit', 1, 2, 13000, '2024-10-30', '22:38:46', '#OD931091', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(20) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPhone` varchar(15) NOT NULL,
  `userAddress` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `confirmationCode` varchar(20) NOT NULL,
  `productImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `productId`, `productName`, `productPrice`, `productQuantity`, `userId`, `userName`, `userEmail`, `userPhone`, `userAddress`, `date`, `time`, `confirmationCode`, `productImage`) VALUES
(1, 8, 'abaya', 5000, 2, 11, 'fariha', 'fareehajabeen62@gmail.com', '03322114455', 'bgdfgjhhiogthyo', '2024-10-29', '12:18:02', '#OD296287', 'SOHAI-MAXI-STYLE-ABAYA-13-7.webp'),
(2, 6, 'facial kit', 6500, 1, 11, 'fariha', 'fareehajabeen62@gmail.com', '03322114455', 'bgdfgjhhiogthyo', '2024-10-29', '12:18:02', '#OD296287', 'Skincare1400.jpg.webp'),
(3, 3, 'arabic abayas', 6500, 2, 11, 'fariha', 'fareehajabeen62@gmail.com', '03322114455', 'fgjhkfdhg slkhgfddshglk', '2024-10-29', '12:36:26', '#OD311494', 'logo.png'),
(4, 7, 'arabic abayas', 6500, 1, 11, 'fariha', 'fareehajabeen62@gmail.com', '03322114455', 'fgjhkfdhg slkhgfddshglk', '2024-10-29', '12:36:26', '#OD311494', '19_ec5d7003-9bcc-46e6-a56c-7097df0bdfd3.webp'),
(5, 6, 'facial kit', 6500, 2, 11, 'fariha', 'fareehajabeen62@gmail.com', '035025466', '.,nkhhdewhdie', '2024-10-30', '22:38:46', '#OD931091', 'Skincare1400.jpg.webp');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(20) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productCatId` int(11) NOT NULL,
  `productDescription` varchar(100) NOT NULL,
  `productImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `productPrice`, `productQuantity`, `productCatId`, `productDescription`, `productImage`) VALUES
(3, 'arabic abayas', 6500, 9, 4, 'sjadjkfkj', 'logo.png'),
(4, 'arabic abayas', 6500, 9, 4, 'sjadjkfkj', 'logo.png'),
(5, 'jessica mask', 5000, 35, 3, '', 'Glowgetters_Blog3_821edefb-7e9d-4a34-a95e-02cc7830bacd.webp'),
(6, 'facial kit', 6500, 54, 3, 'jmgjm', 'Skincare1400.jpg.webp'),
(7, 'arabic abayas', 6500, 35, 4, 'frewgth', '19_ec5d7003-9bcc-46e6-a56c-7097df0bdfd3.webp'),
(8, 'abaya', 5000, 35, 4, 'efrgth', 'SOHAI-MAXI-STYLE-ABAYA-13-7.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `userNumber` varchar(13) NOT NULL,
  `userRole` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userNumber`, `userRole`) VALUES
(1, 'Admin', 'admin@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', '52563576', 'admin'),
(2, 'fariha', 'fari@gmail.com', '123', '03436746728', 'user'),
(3, 'kinza', 'kinza@gmail.com', '40bd001563085fc35165', '276257527', 'user'),
(4, 'ali', 'ali@gmail.com', '40bd001563085fc35165', '6257615276', 'user'),
(5, 'fariha', 'fari11@gmail.com', '945903c4303d77457072', '03436746728', 'user'),
(6, 'moiz', 'moiz@gmail.com', '40bd001563085fc35165', '03436746728', 'user'),
(7, 'sana', 'sana@gmail.com', '40bd001563085fc35165', '276378', 'user'),
(8, 'saba', 'saba@gmail.com', '40bd001563085fc35165', '6477657587', 'user'),
(9, 'sahhg', 'z@gmail.com', '40bd001563085fc35165', '63547265', 'user'),
(10, 'asad', 'asad@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '03436746728', 'user'),
(11, 'fariha', 'fareehajabeen62@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0345664376', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoiceId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `productCatId` (`productCatId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`productCatId`) REFERENCES `categories` (`catId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
