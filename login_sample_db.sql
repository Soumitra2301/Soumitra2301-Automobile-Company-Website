-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 09:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `password`, `user_id`) VALUES
('dipan', '1234', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `carid` bigint(20) NOT NULL,
  `image` varchar(30) DEFAULT NULL,
  `company` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`carid`, `image`, `company`, `model`, `type`, `price`, `status`) VALUES
(1, 'car.jpg', 'Bentley', 'A65', 'Hybrid', 30000, 2),
(2, 'Ford.jpg', 'Ford', 'A66', 'Hybrid', 10000, 1),
(3, 'mustang.webp', 'Ford', 'Mustang', 'petrol', 10000, 1),
(4, 'maybach.png', 'Marcedes', 'Maybach', 'Diesel Engine', 50000, 1),
(5, 'marcedes.jpg', 'Marcedes', 'S5', 'Hybrid', 2000, 1),
(6, 'Maserati.jpg', 'Maserati', 'A44', 'Hybrid', 60000, 0),
(7, 'niss.jpeg', 'Nissan', 'GTR', 'Electric', 40000, 1),
(8, 'porsche 911 GT3 RS.jpeg', 'Porsche', '911 GT3 RS', 'Electric', 185000, 1),
(9, 'car2.jpg', 'Vintage', 'V12', 'Hybrid', 10000, 1),
(10, 'Bugati.jpg', 'Bugatti', 'Chiron', 'Hybrid', 500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `id` bigint(20) DEFAULT NULL,
  `carid` bigint(20) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirm` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `id`, `carid`, `order_date`, `confirm`) VALUES
(28, 1, 8, '2023-09-18 09:34:35', 1),
(29, 1, 10, '2023-09-18 09:40:01', 3),
(31, 5, 6, '2023-09-18 09:56:25', 3),
(32, 1, 1, '2023-09-18 18:03:46', 2),
(33, 1, 4, '2023-09-18 18:03:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` bigint(20) NOT NULL,
  `orderid` int(11) NOT NULL,
  `Cus_id` bigint(20) NOT NULL,
  `carid` bigint(20) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `orderid`, `Cus_id`, `carid`, `Date`) VALUES
(7, 29, 1, 10, '2023-09-18 09:40:01'),
(8, 31, 5, 6, '2023-09-18 09:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_location` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `user_email`, `user_location`, `password`, `date`, `active`) VALUES
(1, 187800985358056, 'Soumitra Dev', 'soumitradev532@gmail.com', 'Dhaka', '1234', '2023-09-18 07:56:07', 0),
(2, 968134049553285, 'Moumita', 'mou123@gmail.com', 'Chittagong', 'abcd', '2023-08-11 20:00:56', 0),
(3, 132325117506576275, 'Robin', 'Robin321@gmail.com', 'khulna', 'efgh', '2023-08-12 18:22:14', 0),
(4, 366397157589640333, 'Apurba', 'apurba@gmail.com', 'Dhaka', 'efgh', '2023-09-13 18:58:03', 0),
(5, 1015169, 'Tainur', 'tainur@gmail.com', 'Chittagong', '4321', '2023-09-14 15:02:52', 0),
(6, 50222513539777277, 'Akibul Islam', 'Akib@gmail.com', 'Dhaka', 'efgh', '2023-09-13 07:31:36', 0),
(9, 6468756, 'Md Nur', 'Nur69@gmail.com', 'Sitakunda', '6251', '2023-09-13 15:32:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `id` (`id`),
  ADD KEY `carid` (`carid`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `Cus_id` (`Cus_id`),
  ADD KEY `carid` (`carid`),
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_location` (`user_location`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `carid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sell_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`carid`) REFERENCES `cars` (`carid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
