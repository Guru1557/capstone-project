CREATE DATABASE carrental;
USE carrental;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 05:18 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `carinventory`
--

CREATE TABLE `carinventory` (
  `id` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `priceperday` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carinventory`
--

INSERT INTO `carinventory` (`id`, `make`, `model`, `year`, `transmission`, `priceperday`, `image`) VALUES
(1, 'Honda', 'Civic', 2020, 'Automatic', 50, 'civic.jpg'),
(2, 'Chevrolet', 'Camaro', 2021, 'Automatic', 70, 'camaro.jpg'),
(3, 'Dodge', 'Challenger', 2018, 'Automatic', 75, 'challenger.jpg'),
(4, 'Ford', 'Mustang', 2019, 'Manual', 65, 'mustang.jpg'),
(5, 'Toyota', 'Camry', 2021, 'Automatic', 55, 'camry.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carinventoryorder`
--

CREATE TABLE `carinventoryorder` (
  `id` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `finalprice` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'ajaydhir', 'ajaydhir@gmail.com', 'a08ee45ef214dc905e59bfcc4c263565'),
(2, 'rahulverma', 'rahul@gmail.com', '7b7f71bff78951c020e9c647a32bb839'),
(3, 'admin', 'admin@gmail.com', '0e7517141fb53f21ee439b355b5a1d0a'),
(7, 'aa', 'aa@gmail.com', 'fe9989d5012230c4c8dd97bd7d209def'),
(8, 'gurpreet', 'gurpreet@gmail.com', 'b8809bd217e2c0ac9c2c046135e1c674');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carinventory`
--
ALTER TABLE `carinventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carinventoryorder`
--
ALTER TABLE `carinventoryorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carinventory`
--
ALTER TABLE `carinventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carinventoryorder`
--
ALTER TABLE `carinventoryorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
