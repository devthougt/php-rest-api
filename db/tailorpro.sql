-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 02:22 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailorpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `free_lancer`
--

CREATE TABLE `free_lancer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `free_lancer`
--

INSERT INTO `free_lancer` (`id`, `name`, `email`, `location`, `category`, `phone`) VALUES
(7, 'agiri', 'hmmm', 'check', 'both', '23344'),
(8, 'someone', 'akujobicuevas@gmail.com', 'new', 'both', '456789');

-- --------------------------------------------------------

--
-- Table structure for table `free_lancer_upload`
--

CREATE TABLE `free_lancer_upload` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `free_lancer_upload`
--

INSERT INTO `free_lancer_upload` (`id`, `email`, `category`, `upload`) VALUES
(1, 'email', 'category', 'uploads'),
(2, 'agiriabrahamjunior@gmail.com', 'bhbbuu', 'uploads/images (5).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `free_lancer`
--
ALTER TABLE `free_lancer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_lancer_upload`
--
ALTER TABLE `free_lancer_upload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `free_lancer`
--
ALTER TABLE `free_lancer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `free_lancer_upload`
--
ALTER TABLE `free_lancer_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
