-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 03:35 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'jane', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'jane@gmail.com'),
(2, 'johnny', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'jd@gmail.com'),
(3, 'jason', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'jason@gmail.com'),
(4, 'micky', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'micky@gmail.com'),
(5, 'tommy', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'tomcat@yahoo.co.uk'),
(6, 'poppy', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'poppeye@example.com'),
(7, 'pepsi', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'pepsiburna@gmail.com'),
(8, 'chippy', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'chipmunks@yahoo.com'),
(9, 'buddy', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'bigcoolbuddy@gmail.com'),
(10, 'pricky', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'pricklyheat@example.net'),
(11, 'cactus', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'cactyspines@mail.ru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
