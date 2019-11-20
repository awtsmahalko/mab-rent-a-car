-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2019 at 11:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$bIOxk2vg50kPeP839/VOF.HkJi1OZN2C73zA9DDcaZ0WPlanY3Tna');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `plate_number` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `description`, `plate_number`, `price`, `photo`) VALUES
(1, 'Sample Dat', '3', 3, ''),
(2, 'Sample Data 2', '34534', 343, ''),
(3, 'SAmple Data 3', '676', 534, ''),
(4, 'Sample Data 4', '465', 343, ''),
(5, 'Sample Data 5', '4564', 675, ''),
(6, 'Sample Data 6', '786', 786, ''),
(7, 'Sample Data 7', '657', 675, ''),
(8, 'Sample Data 8', '675', 342, ''),
(9, 'Sample Data 9', '787', 6786, ''),
(10, 'Sample Data 10', '4543', 676, ''),
(11, 'Sample Data 11', '454', 65, ''),
(12, 'Sample Data 12', '678', 786, ''),
(13, 'test', 'sadsa', 56, ''),
(14, 'testwew', 'wewew', 45, ''),
(15, 'aa', 'aa', 45, ''),
(16, 'sda', 'asda', 45, ''),
(17, 'sda', 'asda', 45, ''),
(18, 'asda', 'asd', 45, ''),
(19, 'test alert', 'sdada', 65, ''),
(20, 'test alert2', 'ereer', 70, ''),
(21, 'last alert1', 'sdsds1', 441, ''),
(22, 'sadadad', 'asdada', 87, ''),
(23, 'test', 'dada', 67, ''),
(24, 'testwew', 'a', 45, ''),
(25, 'ada', 'asda', 45, '');

-- --------------------------------------------------------

--
-- Table structure for table `car_reservation_dates`
--

CREATE TABLE `car_reservation_dates` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_reservation_dates`
--

INSERT INTO `car_reservation_dates` (`id`, `rental_id`, `date`) VALUES
(64, 15, '2019-10-17'),
(65, 15, '2019-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `rental_id`, `date`, `payment`) VALUES
(3, 15, '2019-10-10', 1000),
(4, 15, '2019-10-10', 500);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `car_id` int(11) NOT NULL,
  `with_driver` int(1) NOT NULL COMMENT '0-no, 1-yes',
  `additional_payment` float NOT NULL,
  `total_pay` float NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `place_from` varchar(150) NOT NULL,
  `place_to` varchar(150) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0-pending, 1-approved, 2-completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `firstname`, `lastname`, `address`, `contact_no`, `car_id`, `with_driver`, `additional_payment`, `total_pay`, `start_date`, `end_date`, `place_from`, `place_to`, `status`) VALUES
(15, 'Neovic', 'Devierte', 'Silay City, Negros Occidental', '09385844906', 2, 1, 1000, 4959, '2019-10-17', '2019-10-18', 'Silay', 'Bacolod', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_reservation_dates`
--
ALTER TABLE `car_reservation_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `car_reservation_dates`
--
ALTER TABLE `car_reservation_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
