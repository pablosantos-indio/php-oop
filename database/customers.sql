-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2020 at 11:25 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblCustomer`
--

CREATE TABLE `tblCustomer` (
  `customerID` int(10) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblCustomer`
--
ALTER TABLE `tblCustomer`
  ADD PRIMARY KEY (`customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblCustomer`
--
ALTER TABLE `tblCustomer`
  MODIFY `customerID` int(10) NOT NULL AUTO_INCREMENT;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- actual password is admin
INSERT INTO users (email, password) VALUES ('ryan.mclaren@nscc.ca', '$2y$10$jhKa9SybNTKojMJQpptXe.0/33I3fiZ4SKkiso79vzjxsUTQHjVOW');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `tblCustomer` (`customerID`, `lastName`, `firstName`, `address`) VALUES
(1, 'Morrow', 'Sean', '171 Portland Street'),
(2, 'Smith', 'Joe', '133 Pine Street'),
(3, 'Aikens', 'Nancy', '723 Argyle Street'),
(4, 'Johnson', 'Michael', '42 Oak Street'),
(5, 'Brown', 'Jennifer', '99 Elm Street'),
(6, 'Taylor', 'Robert', '12 Pine Street'),
(7, 'Martin', 'Kimberly', '567 Maple Street'),
(8, 'Baker', 'Christopher', '876 Birch Street'),
(9, 'Garcia', 'Emily', '234 Cedar Street'),
(10, 'Lee', 'Jonathan', '789 Elmwood Street'),
(11, 'Harris', 'Amanda', '456 Oakwood Street'),
(12, 'Jackson', 'Charles', '123 Pine Avenue'),
(13, 'Moore', 'Melissa', '789 Maple Lane'),
(14, 'Anderson', 'Brian', '345 Cedar Court'),
(15, 'Walker', 'Michelle', '901 Birch Drive'),
(16, 'Perez', 'John', '567 Pine Road'),
(17, 'Cooper', 'Laura', '234 Oak Street'),
(18, 'Hill', 'Daniel', '876 Elm Street'),
(19, 'Barnes', 'Sarah', '12 Maple Street'),
(20, 'White', 'Kevin', '901 Cedar Street'),
(21, 'Cook', 'Jessica', '456 Elmwood Avenue'),
(22, 'Sanders', 'William', '789 Oakwood Lane'),
(23, 'Ross', 'Katherine', '345 Pine Court'),
(24, 'Ward', 'Gary', '123 Birch Street'),
(25, 'Fisher', 'Linda', '789 Maple Drive'),
(26, 'Stewart', 'Matthew', '567 Cedar Road'),
(27, 'Turner', 'Emily', '901 Elm Road'),
(28, 'Baker', 'George', '234 Pine Drive'),
(29, 'Cruz', 'Susan', '876 Oak Lane'),
(30, 'Evans', 'Richard', '12 Elm Street'),
(31, 'Mitchell', 'Patricia', '567 Maple Avenue'),
(32, 'Cooper', 'Eric', '901 Cedar Drive'),
(33, 'Garcia', 'Hannah', '456 Elmwood Road'),
(34, 'King', 'Thomas', '789 Oakwood Lane'),
(35, 'Barnes', 'Nicole', '345 Pine Court'),
(36, 'Bell', 'Dennis', '123 Birch Street'),
(37, 'Fisher', 'Catherine', '789 Maple Drive'),
(38, 'Gomez', 'Christopher', '567 Cedar Road'),
(39, 'Turner', 'Victoria', '901 Elm Road'),
(40, 'Hill', 'Steven', '234 Pine Drive'),
(41, 'Ross', 'Maria', '876 Oak Lane'),
(42, 'Ward', 'Jonathan', '12 Elm Street'),
(43, 'Sanders', 'Michelle', '567 Maple Avenue'),
(44, 'Cook', 'Daniel', '901 Cedar Drive'),
(45, 'Johnson', 'Holly', '456 Elmwood Road'),
(46, 'Taylor', 'Austin', '789 Oakwood Lane'),
(47, 'Martin', 'Olivia', '345 Pine Court'),
(48, 'Walker', 'Benjamin', '123 Birch Street'),
(49, 'Perez', 'Laura', '789 Maple Drive'),
(50, 'Garcia', 'David', '567 Cedar Road');

