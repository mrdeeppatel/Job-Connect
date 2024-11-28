-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 04:28 AM
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
-- Database: `jobconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_ids`
--

CREATE TABLE `admin_ids` (
  `admin_id` int(2) NOT NULL,
  `admin_user_name` varchar(15) NOT NULL,
  `admin_pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_ids`
--

INSERT INTO `admin_ids` (`admin_id`, `admin_user_name`, `admin_pass`) VALUES
(1, 'deep_v', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `catName` varchar(20) NOT NULL,
  `catInameLink` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`catName`, `catInameLink`) VALUES
('Chef', 'assets/img/JobTypeIcon/Chef.png'),
('Nanny', 'assets/img/JobTypeIcon/Nanny.png'),
('Driver', 'assets/img/JobTypeIcon/Driver.png'),
('Cleaner', 'assets/img/JobTypeIcon/cleaning-staff.png'),
('Caretaker', 'assets/img/JobTypeIcon/caretaker.png'),
('Security Guard', 'assets/img/JobTypeIcon/guard.png'),
('Gardener', 'assets/img/JobTypeIcon/Gardener.png'),
('Plumber', 'assets/img/JobTypeIcon/Plumber.png'),
('Fast Food Worker', 'assets/img/JobTypeIcon/Fast Food Worker.png'),
('Labor', 'assets/img/JobTypeIcon/labor.png');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `feedback_type` enum('complaint','suggestion','question','praise') NOT NULL,
  `recommend` enum('yes','no') NOT NULL,
  `feedback` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `rating`, `feedback_type`, `recommend`, `feedback`, `submission_date`) VALUES
(20, 'good', 'complaint', 'no', 'aasdas', '2024-08-25 11:37:16'),
(27, 'excellent', 'complaint', 'no', 'xyz', '2024-08-30 06:22:33'),
(35, 'excellent', 'complaint', 'no', '9345', '2024-08-26 05:27:53'),
(39, 'excellent', 'suggestion', 'no', 'asa', '2024-08-25 11:30:01'),
(47, 'excellent', 'suggestion', 'yes', 'zdxvz', '2024-08-31 01:39:49'),
(51, 'excellent', 'suggestion', 'no', 'Bad', '2024-08-28 04:23:56'),
(52, 'average', 'suggestion', 'no', 'make it use full', '2024-08-30 06:16:32'),
(56, 'good', 'complaint', 'yes', 'Good Work', '2024-09-06 04:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `logdata`
--

CREATE TABLE `logdata` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logdata`
--

INSERT INTO `logdata` (`id`, `username`, `Pass`) VALUES
(21, 'rajesh.patel', 'Rajesh@123'),
(22, 'meena.shah', 'Meena@456'),
(23, 'vijay.desai', 'Vijay@789'),
(24, 'sunita.joshi', 'Sunita@321'),
(25, 'rakesh.thakkar', 'Rakesh@654'),
(26, 'ajay.patel', 'Ajay@123'),
(27, 'neha.sharma', 'Neha@456'),
(28, 'ramesh.verma', 'Ramesh@789'),
(29, 'sneha.mehra', 'Sneha@321'),
(30, 'vikas.kumar', 'Vikas@654'),
(31, 'priya.singh', 'Priya@987'),
(32, 'deepak.gupta', 'Deepak@741'),
(33, 'arun.joshi', 'Arun@852'),
(34, 'radhika.nair', 'Radhika@963'),
(35, 'amit.shah', 'Amit@159'),
(36, 'suman.roy', 'Suman@753'),
(37, 'manish.kapoor', 'Manish@258'),
(38, 'kavita.das', 'Kavita@369'),
(39, 'rohit.agarwal', 'Rohit@147'),
(41, 'anil.bose', 'Anil@369'),
(42, 'mohan.yadav', 'Mohan@159'),
(43, 'usha.rana', 'Usha@753'),
(44, 'sachin.malhotra', 'Sachin@852'),
(45, 'geeta.tiwari', 'Geeta@741'),
(46, 'dixu_patel', 'dixudixu'),
(47, 'temp1', 'temptemp'),
(48, 'drashti', '123456'),
(49, 'temp2', 'temptemp'),
(50, 'temp3', 'temptemp'),
(51, 'temp5', 'temptemp'),
(52, 'karan123', 'temptemp'),
(55, 'a', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `classification` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `surname`, `address`, `classification`, `photo`, `created_at`, `email`, `phone_number`) VALUES
(18, 'Deep', 'Vanpariya', '120 Feet Ring Rd, AEC Char Rasta, University Area, Ahmedabad, Gujarat 380009', 'Chef', '18_Deep.jpg', '2024-08-23 19:54:32', 'deep.vanpariya@example.com', '9176543210'),
(19, 'SomeOne', 'Times', 'Somewhere', 'PSW', 'rose-ash-burning-black-wallpaper-preview.jpg', '2024-08-24 17:12:37', 'someone.times@example.com', '9912345678'),
(20, 'Dharmik', 'Mehta', 'Khodapipar', 'Driver', '20_Dharmik.jpg', '2024-08-25 03:51:54', 'dharmik.mehta@example.com', '9876543210'),
(21, 'Rajesh', 'Patel', '123, Ambawadi, Ahmedabad, Gujarat, India', 'Not Active', '21_Rajesh.jpg', '2024-08-25 08:39:08', 'rajesh.patel@example.com', '9823456789'),
(22, 'Meena', 'Shah', '456, Navrangpura, Vadodara, Gujarat, India', 'Nanny', '22_Meena.jpg', '2024-08-25 08:39:08', 'meena.shah@example.com', '9908765432'),
(23, 'Vijay', 'Desai', '789, Paldi, Surat, Gujarat, India', 'Driver', '23_Vijay.jpg', '2024-08-25 08:39:08', 'vijay.desai@example.com', '9976543210'),
(24, 'Sunita', 'Joshi', '321, Maninagar, Rajkot, Gujarat, India', 'Cleaner', '24_Sunita.jpg', '2024-08-25 08:39:00', 'sunita.joshi@example.com', '9945678901'),
(25, 'Simoya', 'Thakkar', '789, Paldi, Surat, Gujarat, India', 'Caretaker', '25_Simoya.jpg', '2024-08-25 08:39:08', 'simoya.thakkar@example.com', '9898765432'),
(26, 'Ajay', 'Patel', '123, Ambawadi, Ahmedabad, Gujarat, India', 'Driver', '26_Ajay.jpg', '2024-08-25 08:46:42', 'ajay.patel@example.com', '9812345678'),
(27, 'Neha', 'Sharma', '456, Navrangpura, Vadodara, Gujarat, India', 'Nanny', '27_Neha.jpg', '2024-08-25 08:46:42', 'neha.sharma@example.com', '9823456789'),
(28, 'Ramesh', 'Verma', '789, Paldi, Surat, Gujarat, India', 'Plumber', 'Image.png', '2024-08-25 08:46:42', 'ramesh.verma@example.com', '9887766555'),
(29, 'Sneha', 'Mehra', '321, Maninagar, Rajkot, Gujarat, India', 'Chef', '29_Sneha.jpg', '2024-08-25 08:46:42', 'sneha.mehra@example.com', '9999888777'),
(30, 'Vikas', 'Kumar', '654, Vastrapur, Bhavnagar, Gujarat, India', 'Labor', 'Image.png', '2024-08-25 08:46:42', 'vikas.kumar@example.com', '9801234567'),
(31, 'Yadav', 'Singh', '456, Navrangpura, Gandhinagar, Gujarat, India', 'Security Guard', '31_Yadav.jpeg', '2024-08-25 08:46:42', 'yadav.singh@example.com', '9812345678'),
(32, 'Pakak', 'Gupta', '123, Ambawadi, Ahmedabad, Gujarat, India', 'Cleaner', '32_Pakak.jpg', '2024-08-25 08:46:42', 'pakak.gupta@example.com', '9823456789'),
(33, 'Anjli', 'Joshi', '789, Paldi, Surat, Gujarat, India', 'Gardener', '33_Anjli.jpg', '2024-08-25 08:46:42', 'anjli.joshi@example.com', '9908765432'),
(34, 'Radhika', 'Nair', '321, Maninagar, Rajkot, Gujarat, India', 'Fast Food Worker', 'Image.png', '2024-08-25 08:46:42', 'radhika.nair@example.com', '9954332211'),
(35, 'Amit', 'Bhat', '321, Maninagar, Rajkot, Gujarat, India', 'Caretaker', '35_Amit.jpg', '2024-08-25 08:46:42', 'amit.bhat@example.com', '9966554433'),
(36, 'Suman', 'Roy', '123, Ambawadi, Ahmedabad, Gujarat, India', 'Nanny', '36_Suman.jpg', '2024-08-25 08:46:42', 'suman.roy@example.com', '9933445566'),
(37, 'Manish', 'Kapoor', '456, Navrangpura, Vadodara, Gujarat, India', 'Chef', '37_Manish.jpg', '2024-08-25 08:46:42', 'manish.kapoor@example.com', '9900112233'),
(38, 'Devraj', 'Das', '789, Paldi, Surat, Gujarat, India', 'Driver', '38_Devraj.jpg', '2024-08-25 08:46:42', 'devraj.das@example.com', '9811223344'),
(39, 'Rohit', 'Agarwal', '321, Maninagar, Rajkot, Gujarat, India', 'Cleaner', '39_Rohit.jpg', '2024-08-25 08:46:42', 'rohit.agarwal@example.com', '9822334455'),
(41, 'Anil', 'Bose', '123, Ambawadi, Ahmedabad, Gujarat, India', 'Security Guard', '41_Anil.png', '2024-08-25 08:46:42', 'anil.bose@example.com', '9900556677'),
(42, 'Mohan', 'Yadav', '456, Navrangpura, Gandhinagar, Gujarat, India', 'Gardener', '42_Mohan.jpg', '2024-08-25 08:46:42', 'mohan.yadav@example.com', '9988776655'),
(43, 'Usha', 'Rana', '789, Paldi, Surat, Gujarat, India', 'Plumber', 'Image.png', '2024-08-25 08:46:42', 'usha.rana@example.com', '9933556677'),
(44, 'Sachin', 'Malhotra', '321, Maninagar, Rajkot, Gujarat, India', 'Fast Food Worker', 'Image.png', '2024-08-25 08:46:42', 'sachin.malhotra@example.com', '9911223344'),
(45, 'Geeta', 'Tiwari', '654, Vastrapur, Bhavnagar, Gujarat, India', 'Caretaker', '45_Geeta.jpg', '2024-08-25 08:46:42', 'geeta.tiwari@example.com', '9900887766'),
(46, 'Dixu', 'Patel', 'giriraj nagar', 'Chef', '46_VANPARIYA.png', '2024-08-26 07:11:09', 'mrvanpariya@gmail.com', '07567770358'),
(47, 'Soham', 'sahh', 'Some Where in the Indai', 'Not Active', '47_Soham.JPG', '2024-08-26 07:15:44', 'temp1@gmail.com', '9095748623'),
(48, 'VANPARIYA', 'DEEP', 'giriraj nagar', 'Labor', '48_VANPARIYA.png', '2024-08-26 11:11:36', 'mrvanpariya@gmail.com', '07567770358'),
(49, 'VANPARIYA', 'DEEP', 'giriraj nagar', 'Not Active', '49_VANPARIYA.png', '2024-08-26 11:15:44', 'mrvanpariya@gmail.com', '07567770358'),
(50, 'VANPARIYA', 'sunil', 'giriraj nagar', 'Security Guard', '50_VANPARIYA.jpg', '2024-08-26 11:18:13', 'mrvanpariya@gmail.com', '000000000'),
(52, 'karan', 'udani', '120 Feet Ring Rd, AEC Char Rasta, University Area, Ahmedabad, Gujarat 380009', 'Nanny', '52_karan.jpg', '2024-08-30 06:18:36', 'karan123@gmail.com', '8488889194');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_ids`
--
ALTER TABLE `admin_ids`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logdata`
--
ALTER TABLE `logdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_ids`
--
ALTER TABLE `admin_ids`
  MODIFY `admin_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logdata`
--
ALTER TABLE `logdata`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
