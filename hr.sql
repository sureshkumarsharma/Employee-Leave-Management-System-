-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 03:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`) VALUES
(99, 'marketingg'),
(100, 'sales'),
(119, 'talecaller'),
(156, 'suresh sharma1233');

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `id` int(15) NOT NULL,
  `user_id` int(20) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_description` text NOT NULL,
  `leave_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`id`, `user_id`, `leave_id`, `leave_from`, `leave_to`, `leave_description`, `leave_status`) VALUES
(15, 2, 1, '2021-04-15', '2021-04-15', 'test description', 1),
(16, 0, 1, '2021-04-16', '2021-04-08', 'test description', 1),
(17, 0, 9, '2021-04-15', '2021-04-15', 'test description', 1),
(18, 0, 1, '2021-04-22', '2021-04-15', 'urjent', 1),
(19, 0, 1, '2021-04-15', '2021-04-15', 'test description', 1),
(20, 0, 36, '2021-04-14', '2021-04-23', 'test description', 1),
(21, 0, 1, '2021-04-16', '2021-04-30', 'test description', 1),
(22, 0, 36, '2021-04-22', '2021-04-29', 'test description', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_type`) VALUES
(36, 'casual'),
(101, 'Sick'),
(102, 'urjent'),
(107, 'casual12'),
(127, '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(10) UNSIGNED NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`perm_id`, `module_name`, `url`) VALUES
(1, 'Home', 'admin/dashboard'),
(2, 'add user', '/admin/adduser-master'),
(3, 'Department master', 'admin/department-master'),
(4, 'Leave type master', 'admin/leave-type-master'),
(5, 'Alluser master', 'admin/alluser-master'),
(6, 'Userpayslip master', 'admin/userpayslip-master');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE `role_perm` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `perm_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_perm`
--

INSERT INTO `role_perm` (`role_id`, `perm_id`, `user_id`) VALUES
(1, 2, 2),
(1, 5, 2),
(2, 4, 28),
(1, 6, 2),
(2, 1, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `oauth_provider` varchar(15) NOT NULL,
  `oauth_uid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fathers_name` varchar(50) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `moblie_no` varchar(15) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `total_salary` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `Basic_Salary` varchar(255) NOT NULL,
  `Total_Allowance` varchar(100) NOT NULL,
  `Total_Deduction` varchar(100) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `role_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `oauth_provider`, `oauth_uid`, `name`, `fathers_name`, `date_of_birth`, `moblie_no`, `email_address`, `password`, `designation`, `total_salary`, `address`, `Basic_Salary`, `Total_Allowance`, `Total_Deduction`, `user_photo`, `role_id`) VALUES
(27, '', '', '', 'chothmal sharma sharma', '1990-11-22', '', 'suresh@gmail.com', 'ravina', 'hr', '5000000', 'chomu jaipur', '35000', '2000', '2000', '', 2),
(167, '', '', 'sarthak sharma', 'kumar suresh ', '2021-06-22', '968003424', 'sarthak@gmail.com', 'babubabu', 'merketing', '300000', 'hanuman vatika rode', '', '', '', '', 1),
(208, '', '', 'lokesh', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '1000000', 'bhilwara', '', '', '', 'avatar33.png', 0),
(209, '', '', 'aakash', 'chhitar mal ', '2021-07-19', '6788779988', 'monika@gmail.com', '123456', 'sales', '1000000', 'hanuman vatika rode', '', '', '', 'avatar34.png', 0),
(210, '', '', 'subham', 'siyaram', '2021-07-19', '6788779988', 'komal@gmail.com', '1234567', 'merketing', '38500', 'jhgsd\\gd', '', '', '', 'avatar35.png', 0),
(211, '', '', 'sachin sharma ', 'arjun lal sharma ', '2021-07-14', '6788779988', 'sachine@gmail.com', '1234567', 'merketing', '38500', 'hanuman vatika rode', '', '', '', 'avatar36.png', 0),
(212, '', '', 'EightTech', 'EightTech', '2021-07-15', '7788665544', 'Eight@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight.jpeg', 0),
(214, '', '', 'prem medam ji ', 'govind ji ', '2021-07-06', '6788779988', 'premmedamji@gmail.com', 'premsharma', 'merketing', '5000000', 'nagour', '', '', '', 'premmedamji.jpg', 0),
(215, '', '', 'aakash', 'chhitar mal ', '2021-07-14', '6788779988', 'suresh@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'avatar37.png', 0),
(216, '', '', 'sagar sharma ', 'ramawtar ', '2021-07-07', '6788779988', 'sagar@gmail.com', '12345678', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'premmedamji1.jpg', 0),
(217, '', '', 'abhilasha ', 'laduram ji ', '2021-07-20', '6788779988', 'ravina@gmail.com', '12345678', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'avatar38.png', 0),
(218, '', '', 'baby sharma ', 'rambabu sharma ', '2021-07-14', '6788779988', 'sureshkumarsharma1990@gmail.com', '12345678', 'merketing', '38500', 'hanuman vatika rode', '', '', '', 'Eight2.jpeg', 0),
(219, '', '', 'rajesh ji sir ', 'sir ', '2021-07-13', '6788779988', 'monika@gmail.com', '123456', 'merketing', '1000000', 'bhilwara', '', '', '', 'avatar39.png', 0),
(220, '', '', 'rajendra kumaw', 'ganesh ji', '2021-07-21', '6788779988', 'sarthak@gmail.com', '12345678', 'sales', '38500', 'bhilwara', '', '', '', 'avatar310.png', 0),
(221, '', '', 'tttetete', 'chhitar mal ', '2021-07-12', '6788779988', 'sarthak@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight3.jpeg', 0),
(222, '', '', 'tttetete', 'chhitar mal ', '2021-07-12', '6788779988', 'sarthak@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight4.jpeg', 0),
(223, '', '', 'tttetete', 'chhitar mal ', '2021-07-12', '6788779988', 'sarthak@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight5.jpeg', 0),
(224, '', '', 'tttetete', 'chhitar mal ', '2021-07-12', '6788779988', 'sarthak@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight6.jpeg', 0),
(225, '', '', 'tttetete', 'chhitar mal ', '2021-07-12', '6788779988', 'sarthak@gmail.com', '1234567', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight7.jpeg', 0),
(226, '', '', 'tttetete', 'chhitar mal ', '2021-07-12', '6788779988', 'sarthak@gmail.com', '', 'merketing', '1000000', 'hanuman vatika rode', '', '', '', 'Eight8.jpeg', 0),
(227, '', '', 'aakash', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'avatar311.png', 0),
(228, '', '', 'aakash', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'avatar312.png', 0),
(229, '', '', 'aakash', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'avatar313.png', 0),
(230, '', '', 'aakash', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'avatar314.png', 0),
(231, '', '', 'aakash', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'avatar315.png', 0),
(232, '', '', 'aakash', 'suresh  sharma ', '2021-07-13', '6788779988', 'monika@gmail.com', '1234567', 'merketing', '5000000', 'hanuman vatika rode', '', '', '', 'avatar316.png', 0),
(233, '', '', 'ravi bhai ', 'human ji ', '2021-07-14', '6788779988', 'sureshkumarsharma1990@gmail.com', '12345678', 'merketing', '5000000', 'ninder', '', '', '', 'Eight9.jpeg', 0),
(234, '', '', 'ravi bhai ', 'human ji ', '2021-07-14', '6788779988', 'sureshkumarsharma1990@gmail.com', '12345678', 'merketing', '5000000', 'ninder', '', '', '', 'Eight10.jpeg', 0),
(235, '', '', 'Rajesh Joshi', 'sir ', '2021-07-13', '6788779988', 'rajesh@eighttechprojects.com', '123456', 'hr', '1000000', 'Gujrat', '', '', '', 'Eight11.jpeg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD KEY `role_id` (`role_id`),
  ADD KEY `perm_id` (`perm_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `total_Allowance` (`id`,`name`,`fathers_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `perm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD CONSTRAINT `role_perm_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `role_perm_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`perm_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
