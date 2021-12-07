-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 12:27 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ps7`
--

-- --------------------------------------------------------

--
-- Table structure for table `stockportfolio`
--

CREATE TABLE `stockportfolio` (
  `userid` varchar(50) NOT NULL,
  `stocks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockportfolio`
--

INSERT INTO `stockportfolio` (`userid`, `stocks`) VALUES
('1', 'INFY'),
('1', 'HINDUNILVR'),
('3', 'RELIANCE'),
('3', 'TCS'),
('3', 'HDFCBANK'),
('3', 'HDFC'),
('3', 'ICICIBANK'),
('3', 'KOTAKBANK'),
('3', 'SBIN'),
('3', 'BAJFINANCE'),
('3', 'BHARTIARTL'),
('3', 'ITC'),
('3', 'HCLTECH'),
('3', 'ASIANPAINT'),
('3', 'WIPRO'),
('3', 'AXISBANK'),
('3', 'MARUTI'),
('3', 'LT'),
('3', 'ULTRACEMCO'),
('3', 'DMART'),
('3', 'ADANIGREEN'),
('3', 'BAJAJFINSV'),
('3', 'SUNPHARMA'),
('3', 'ADANIPORTS'),
('3', 'HDFCLIFE'),
('3', 'TITAN'),
('3', 'ONGC'),
('3', 'HINDZINC'),
('3', 'ADANIENT');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phoneno` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `phoneno`, `email`, `password`) VALUES
(1, 'viraj', 1234568790, '123@gmail.com', '123'),
(2, 'vriaj', 1234567890, 'hjabj@gkafjh.com', '123'),
(3, 'viraj', 1234647890, '123@mail.com', '123'),
(4, 'da', 1123131231, '12332@23132.vocm', 'sdkl'),
(5, 'Viraj Ptal', 2147483647, 'vjp264@hotmail.comcxvvz', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
