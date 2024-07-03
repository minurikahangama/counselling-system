-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 04:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counselling`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `Admin_ID` int(100) NOT NULL,
  `Full_Name` varchar(150) NOT NULL,
  `Phone` bigint(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `DOB` date NOT NULL,
  `NIC` varchar(100) NOT NULL,
  `Maritual_Status` varchar(100) NOT NULL,
  `Qualifications` varchar(550) NOT NULL,
  `Bio` varchar(500) NOT NULL,
  `Photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`Admin_ID`, `Full_Name`, `Phone`, `Gender`, `Email`, `DOB`, `NIC`, `Maritual_Status`, `Qualifications`, `Bio`, `Photo`) VALUES
(3, 'Admin_Admin', 711410094, 'Male', 'Admin@gmail.com', '0000-00-00', '200112101360', 'Married', 'Student', 'DATE : 06.06.2022. TO : DIPLOMA/CERTIFICATE PROGRAMME STUDENTS (PEARSON ASSURED/ LOCAL). FROM : REGISTRAR. THROUGH : MANAGEMENT OF SAEGIS', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_ID` int(100) NOT NULL,
  `Counsellor_ID` varchar(10) NOT NULL,
  `Timeslot_ID` int(11) NOT NULL,
  `User_ID` int(100) NOT NULL,
  `Accepted_Status` int(11) NOT NULL DEFAULT 0,
  `Notes` varchar(500) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `Notification_message` varchar(500) NOT NULL,
  `Notification_Status` varchar(10) NOT NULL DEFAULT 'Unread',
  `Notification_Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment_ID`, `Counsellor_ID`, `Timeslot_ID`, `User_ID`, `Accepted_Status`, `Notes`, `Status`, `Notification_message`, `Notification_Status`, `Notification_Time`) VALUES
(1, 'C0041', 23, 11, 0, 'ok', 1, '', 'Unread', '2023-08-12 11:42:47'),
(2, 'C0001', 25, 19, 1, '', 1, 'Your appointment has been accepted.', 'unread', '2023-08-12 15:51:14'),
(3, 'C0001', 29, 14, 1, '', 1, 'Your appointment has been accepted.', 'read', '2023-08-12 12:52:11'),
(4, 'C0001', 30, 15, 1, '', 0, 'Your appointment has been accepted.', 'unread', '2023-08-12 16:07:24'),
(5, 'C0001', 31, 7, 1, '', 1, 'Your appointment has been accepted.', 'unread', '2023-08-13 14:34:06'),
(6, 'C0001', 32, 3, 1, '', 1, 'Your appointment has been accepted.', 'unread', '2023-08-13 14:34:09'),
(7, 'C0002', 34, 4, 0, '', 0, '', 'Unread', '2023-08-12 11:42:47'),
(8, 'C0002', 35, 1, 0, '', 1, '', 'Unread', '2023-08-12 11:42:47'),
(9, 'C0001', 32, 3, 1, '', 1, 'Your appointment has been accepted.', 'unread', '2023-08-13 14:34:13'),
(10, 'C0001', 37, 1, 1, '', 1, 'Your appointment has been accepted.', 'unread', '2023-08-13 14:34:15'),
(11, 'C0001', 38, 4, 1, '', 0, 'Your appointment has been accepted.', 'unread', '2023-08-13 14:34:18'),
(12, 'C0001', 40, 5, 0, '', 1, '', 'Unread', '2023-08-12 11:42:47'),
(13, 'C0001', 40, 13, 1, 'Notice', 1, 'Your appointment has been accepted.', 'read', '2023-08-12 12:46:25'),
(14, 'C0001', 41, 17, 0, '', 0, '', 'Unread', '2023-08-12 11:42:47'),
(15, 'C0001', 42, 18, 0, '', 0, '', 'Unread', '2023-08-12 11:42:47'),
(24, 'C1', 0, 26, 0, '', 0, '', 'read', '2023-08-12 15:07:38'),
(25, 'C1', 0, 26, 0, '', 0, '', 'read', '2023-08-12 15:24:56'),
(26, 'C0041', 16, 26, 0, '', 0, '', 'read', '2023-08-12 16:34:21'),
(27, 'C0041', 16, 26, 0, '', 1, '', 'read', '2023-08-19 07:19:16'),
(28, 'C0041', 16, 26, 0, '', 0, '', 'read', '2023-08-19 07:29:01'),
(29, 'C0041', 16, 26, 0, '', 0, '', 'read', '2023-08-19 08:10:49'),
(30, 'C0041', 16, 26, 0, '', 0, '', 'read', '2023-08-19 08:13:01'),
(31, 'C0041', 17, 26, 0, '', 0, '', 'read', '2023-08-19 16:19:12'),
(36, 'C0041', 16, 27, 1, 'completed 222', 0, 'Your appointment has been accepted.', 'read', '2023-08-22 05:03:52'),
(37, 'C0041', 16, 27, 1, '', 0, 'Your appointment has been accepted.', 'read', '2023-08-22 05:10:09'),
(38, 'C0041', 16, 26, 0, '', 0, '', 'read', '2023-08-23 11:32:33'),
(40, 'C0041', 16, 32, 0, '', 0, '', 'read', '2023-09-23 15:31:31'),
(41, 'C0041', 16, 32, 0, '', 0, '', 'read', '2023-09-23 18:22:33'),
(42, 'C0041', 17, 32, 0, '', 0, '', 'read', '2023-09-23 18:22:41'),
(43, 'C0041', 16, 32, 0, '', 0, '', 'read', '2023-09-23 18:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `counsellor`
--

CREATE TABLE `counsellor` (
  `Counsellor_ID` varchar(10) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Contact` varchar(15) NOT NULL,
  `Addres` varchar(500) NOT NULL,
  `DOB` date NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Education` varchar(500) NOT NULL,
  `Specification` varchar(500) NOT NULL,
  `Experinece` varchar(200) NOT NULL,
  `Bio` text NOT NULL,
  `Photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counsellor`
--

INSERT INTO `counsellor` (`Counsellor_ID`, `First_name`, `Last_name`, `Email`, `Contact`, `Addres`, `DOB`, `NIC`, `Gender`, `Education`, `Specification`, `Experinece`, `Bio`, `Photo`) VALUES
('000', 'Abanayak', 'dilshan', 'ab@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '2024-02-06', '147852369v', 'Female', 'bv bnm ', 'full-time', 'bvbnm ', 'fbfddrfg', ''),
('C0001', 'Alex', 'colombo', 'alexcolombo@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '200112101360', 'male', 'Higer study', 'Senior counsellor', '2 years experience', 'fbfddrfg', ''),
('C0002', 'Sandaru', 'dilshan', 'mannyyash@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '200112101360', 'female', 'Masers', 'Spesification', '4 years experience', 'fbfddrfg', ''),
('C0003', 'Sandaru', 'dilshan', 'kavidu@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0005', 'Sandaru', 'dilshan', 'counsellor@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '2522-02-06', '201554232652', 'Female', 'counsellor education', 'full-time', 'counsellor experience', 'fbfddrfg', 0x53637265656e73686f74202836292e706e67),
('C0006', 'Sandaru', 'dilshan', 'janidu@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0007', 'Sandaru', 'dilshan', 'Achini@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0008', 'Sandaru', 'dilshan', 'Arun@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0009', 'Sandaru', 'dilshan', '', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0010', 'Sandaru', 'dilshan', 'sami@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0011', 'Sandaru', 'dilshan', 'dolly@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0012', 'Sandaru', 'dilshan', 'sasindhu@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0013', 'Sanduni', 'dilshan', 'Sandhuni@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0014', 'Sandaru', 'dilshan', 'Keesha@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0015', 'Sandaru', 'dilshan', 'lakshitha@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0016', 'Sandaru', 'dilshan', 'bhagya@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C0017', 'Sandaru', 'dilshan', 'kewin@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '0000-00-00', '', '', '', '', '', 'fbfddrfg', ''),
('C004', 'Pabasi', 'dilshan', 'pabasi@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '2005-05-28', '200510234v', 'Female', '12', 'full-time', 'no', 'fbfddrfg', 0x53637265656e73686f74202837292e706e67),
('C0041', 'gayani', 'nilusha', 'gayani@gamil.com', '0761234567', 'balangoda', '1779-12-06', '754213652v', 'Female', 'AL', 'full-time', 'no', 'i am a counsellor', 0x53637265656e73686f74202831292e706e67),
('C1', 'Minuri', 'dahara', 'minuridahara@gmail.com', '0761234567', 'No:05, Vithaarampanguwe , Erathna', '2001-02-06', '200165403697', 'female', 'under graduate', 'full-time', '1 year', 'fbfddrfg', 0x53637265656e73686f74202836292e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `counselor_timeslots`
--

CREATE TABLE `counselor_timeslots` (
  `Timeslot_ID` int(11) NOT NULL,
  `Counsellor_ID` varchar(10) DEFAULT NULL,
  `Date` date NOT NULL,
  `Start_Time` time DEFAULT NULL,
  `End_Time` time DEFAULT NULL,
  `Availability_Status` varchar(20) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counselor_timeslots`
--

INSERT INTO `counselor_timeslots` (`Timeslot_ID`, `Counsellor_ID`, `Date`, `Start_Time`, `End_Time`, `Availability_Status`) VALUES
(0, 'C1', '0000-00-00', '00:00:12', '00:00:01', ''),
(12, '000', '0000-00-00', '00:00:12', '00:00:01', ''),
(13, 'C004', '2023-05-10', '00:00:04', '00:00:06', ''),
(14, 'C1', '2023-02-19', '00:00:01', '00:00:03', 'booked'),
(15, 'C1', '2023-02-05', '00:00:04', '00:00:06', 'available'),
(16, 'C0041', '0000-00-00', '00:00:00', '00:00:00', 'booked'),
(17, 'C0041', '0000-00-00', '00:00:00', '00:00:00', ''),
(18, 'C1', '0000-00-00', '00:00:12', '00:00:12', ''),
(19, 'C0005', '0000-00-00', '00:00:12', '00:00:12', ''),
(21, 'C1', '0000-00-00', '00:00:02', '00:00:01', ''),
(22, 'C0041', '2023-08-16', '20:40:00', '20:40:00', ''),
(23, 'C0041', '2023-08-24', '23:50:00', '23:50:00', ''),
(24, 'C0001', '0000-00-00', '00:00:12', '00:00:01', 'available'),
(25, 'C0001', '0000-00-00', '00:00:12', '00:00:12', 'available'),
(26, 'C0002', '0000-00-00', '00:00:08', '00:00:03', 'available'),
(27, 'C0002', '0000-00-00', '00:00:07', '00:00:05', 'available'),
(28, 'C0041', '0000-00-00', '00:00:05', '00:00:08', 'available'),
(29, 'C0001', '0000-00-00', '00:00:01', '00:00:03', 'available'),
(30, 'C0001', '0000-00-00', '00:00:08', '00:00:08', 'booked'),
(31, 'C0001', '0000-00-00', '00:00:01', '00:00:03', 'booked'),
(32, 'C0001', '0000-00-00', '00:00:01', '00:00:08', 'booked'),
(33, 'C0002', '0000-00-00', '00:00:01', '00:00:08', 'available'),
(34, 'C0002', '0000-00-00', '00:00:05', '00:00:06', 'available'),
(35, 'C0002', '0000-00-00', '00:00:08', '00:00:09', 'available'),
(36, 'C0002', '0000-00-00', '00:00:08', '00:00:10', 'available'),
(37, 'C0001', '0000-00-00', '00:00:08', '00:00:11', 'booked'),
(38, 'C0001', '0000-00-00', '00:00:12', '00:00:01', 'booked'),
(39, 'C0001', '0000-00-00', '00:00:09', '00:00:12', 'available'),
(40, 'C0001', '0000-00-00', '00:00:08', '00:00:12', 'available'),
(41, 'C0001', '0000-00-00', '00:00:08', '00:00:08', 'available'),
(42, 'C0001', '0000-00-00', '00:00:01', '00:00:02', 'available'),
(43, 'C0001', '2023-08-11', '13:22:00', '00:22:00', 'available'),
(44, 'C0001', '2023-08-12', '12:56:00', '13:56:00', 'available'),
(45, 'C0001', '2023-08-05', '12:58:00', '00:00:00', 'available'),
(46, 'C0001', '2023-08-11', '23:15:00', '23:14:00', 'available'),
(47, 'C0001', '2023-08-11', '14:21:00', '14:21:00', 'available'),
(48, 'C0001', '2023-08-14', '01:38:00', '11:40:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `Session_ID` varchar(10) NOT NULL,
  `Counsellor_ID` varchar(10) NOT NULL,
  `User_ID` varchar(10) NOT NULL,
  `Patient_ID` varchar(10) NOT NULL,
  `Start time` datetime NOT NULL,
  `End time` datetime NOT NULL,
  `Feedback` varchar(150) NOT NULL,
  `Notes` varchar(500) NOT NULL,
  `Medium_of_counselling` varchar(50) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sign_up`
--

CREATE TABLE `sign_up` (
  `Email` varchar(200) NOT NULL,
  `First_Name` varchar(150) NOT NULL,
  `Last_Name` varchar(150) NOT NULL,
  `Pass` varchar(300) NOT NULL,
  `ConfirmPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sign_up`
--

INSERT INTO `sign_up` (`Email`, `First_Name`, `Last_Name`, `Pass`, `ConfirmPassword`) VALUES
('', '', '', '', ''),
('abhimani@gmail.com', 'abhimani', 'kahangama', '12356', '12356'),
('achinthadilshan@gmail.com', 'achintha', 'dilshan', '1996', '1996'),
('admin@gmail.com', 'Admin ', 'Admin', '123', '123'),
('Alexcolombo@gmail.com', 'Alex', 'colombo', '123', '123'),
('amma@gmail.com', 'amma', '', '456', '456'),
('champika@gmail.com', 'Champika', 'sarojani', '123', '123'),
('chandana@gmail.com', 'chandana', 'nalin', '12345', '12345'),
('codegenius@gmail.com', 'Code', 'genius', '12345', '12345'),
('counsellor@gmail.com', 'Counsellor 1', 'Counsellor 2', '123456789', '123456789'),
('daahar@gmail.com', 'dahara', '', '1452', '1452'),
('deshani@gmail.com', 'deshani', 'supun', '123', '123'),
('dilshan@gmail.com', 'dilshan', '', '$2y$10$YI75GvWlYMndhfX8X9zkN.4WsTdXlBcL6jQERzgOpf3MB8yLxW31K', '12356'),
('dilshanchandrasiri0@gmail.com', 'Sandaru', 'Sandaru', '123', '123'),
('disna@gmail.com', 'disna', 'silva', '177', '177'),
('dulshan@gmail.com', 'dulshan', 'lalithya', '123', '123'),
('fisrtuser@gmail.com', 'first', 'user', '147', '147'),
('gayani@gamil.com', 'gayani', '', '12345', '12345'),
('gihan@gmail.com', 'gihan', 'matheesha', '123', '123'),
('jsandarudilshan@gmail.com', 'Sandaru', 'dilshan', '123', '123'),
('kahangama@gmail.com', 'kahangama', '', '$2y$10$aFgoeqXe.gmwFegeBCqzjuGN0FOMDN6DceY7soPP54TsvPgYL2c9a', '123456'),
('kalpa@gmail.com', 'Kalpa', 'kalhara', '123', '123'),
('keesha@gmail.com', 'keesha', 'kaushalya', '1029', '1029'),
('Malith@gmail.com', 'Malith', 'Madhuranga', '123', '123'),
('mannyyash@gmail.com', 'Manny', 'yash', '123', '123'),
('minu@gmail.com', 'mi', 'nu', '123', '123'),
('Minuri@gmail.com', 'minuri', '', '123', '123'),
('minuridahara709@gmail.com', 'minuri dahara', '', '020601', '020601'),
('minuridahara@gmail.com', 'Minuri', 'Dahara', '123', '123'),
('minuusanduu@gmail.com', 'Minuu', 'Sandu', '123', '123'),
('new@gmail.com', 'new user', 'new', '14785', '14785'),
('newuser@gmail.com', 'New', 'User', '123', '123'),
('pabasi@gmail.com', 'pabasi', '', 'pabasi', 'pabasi'),
('sachintha@gmail.com', 'Sachintha', 'dilshan', '123', '123'),
('Sachitha@gmail.com', 'Sachitha', 'sewmini', '123', '123'),
('sandaru@gmail.com', 'minuri', '', '123', '123'),
('sandarudilshan@gmail.com', 'sandaru', '', '7896', '7896'),
('sandaruminuri123@gmail.com', 'sandaruM', 'minuri', '123', '123'),
('sandaruminuri@gmail.com', 'sandaru', 'minuri', '147852', '147852'),
('sandil@gmail.com', 'Sandil', 'nethmika', '123', '123'),
('sasidu@gmail.com', 'sasidu', 'risith', '1928', '1928'),
('smile@gmail.com', 'Smile', 'counselling', '12345', '12345'),
('teshan@gmail.com', 'teshan', '', '147852369', '147852369'),
('teshankaveen@gmail.com', 'teshan', 'kaveen', '156', '156');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(100) NOT NULL,
  `First_Name` varchar(150) NOT NULL,
  `Last_Name` varchar(150) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Addres` varchar(250) NOT NULL,
  `Contact` bigint(10) NOT NULL,
  `NIC` varchar(20) NOT NULL,
  `Occupation` varchar(150) NOT NULL,
  `Maritual_Status` varchar(100) NOT NULL,
  `Pregnancy` varchar(50) NOT NULL,
  `Children_Status` varchar(50) NOT NULL,
  `Previous_Counselling` varchar(100) NOT NULL,
  `Bio` varchar(500) NOT NULL,
  `DOB` date NOT NULL,
  `Photo` blob NOT NULL,
  `Score` int(100) NOT NULL,
  `Mental_Status` varchar(200) NOT NULL,
  `Mental_Catergory` varchar(200) NOT NULL,
  `Matter` varchar(500) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `First_Name`, `Last_Name`, `Gender`, `Email`, `Addres`, `Contact`, `NIC`, `Occupation`, `Maritual_Status`, `Pregnancy`, `Children_Status`, `Previous_Counselling`, `Bio`, `DOB`, `Photo`, `Score`, `Mental_Status`, `Mental_Catergory`, `Matter`, `Status`) VALUES
(1, 'Geeth', 'hansaka', 'male', 'minuridahara@gmail.com', 'nugegoda', 761634517, '20016503697', 'student', 'single', 'on', 'on', 'on', 'my name is minuri', '2001-02-06', 0x53637265656e73686f74202834292e706e67, 17, 'Miled mood', 'Family', 'Personal', 1),
(3, 'teshan', 'kaveen', 'male', 'teshankaveen@gmail.com', 'karawketiya road balangoda', 761634517, '201026561v', 'student', 'single', 'on', 'on', 'on', 'minuri', '2010-10-30', '', 8, 'normal', 'relationship', 'love', 0),
(4, 'achintha', 'dilshan', 'male', 'achinthadilshan@gmail.com', 'kawauketiya ', 767195938, '199635421v', 'office', 'single', 'on', 'on', 'on', 'i am achintha', '1996-12-08', '', 25, 'Moderate depression', 'Borderline', 'School problem', 1),
(5, 'Navidu', 'dulneth', 'male', 'sandaruminuri1234@gmail.com', 'nugegoda', 761634517, '25631421342', 'student', 'single', 'on', 'on', 'on', 'minuri sandaru', '2001-02-10', '', 25, 'modarete depression', 'icconomical', 'matter', 1),
(6, 'saduni', 'nisansala', 'female', 'sanduni@gmail.com', 'sanduni/colombo/05', 71410049, '12123342354', 'occupation', 'Married', 'on', 'on', 'on', 'hkjhgjbn', '2002-02-23', '', 31, 'severe', 'Economic', 'matter', 0),
(7, 'abhimani', 'imesha', 'female', 'abhimaniimesha@gmail.com', 'karawketiya', 768712490, '214596321v', 'qat', 'married', 'no', 'no', 'no', 'hi', '1996-12-08', '', 21, 'boarder line', 'family', 'Matter', 0),
(11, 'Kavidu', 'dilshan', 'male', 'minuridahara709@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'dsvsd', 'married', 'on', 'on', 'on', 'sadvfb lblksknm ;mlekbndfl knlfbabk[', '0000-00-00', '', 20, 'Severe', 'othre', 'matter', 0),
(13, 'supun', 'dilshan', 'male', 'jsandarudilshan@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'dsvsd', 'married', 'on', 'on', 'on', 'sadvfb lblksknm ;mlekbndfl knlfbabk[', '1998-02-02', '', 30, 'Severe', 'relationship', 'matter', 0),
(14, 'Sandaru', 'dilshan', 'male', 'dilshanchandrasiri0@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'dsvsd', 'married', 'on', 'on', 'on', 'sadvfb lblksknm ;mlekbndfl knlfbabk[', '2001-04-30', '', 21, 'Moderate depression', 'Education', 'Eny problrm', 0),
(15, 'Sandil', 'nethmika', 'male', 'sandil@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'no', 'single', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '2008-08-28', '', 21, 'moderate', 'education', 'matte\r\n', 0),
(17, 'Sithara', 'sanduni', 'female', 'sithara@gmailcom', 'thalavathugoda/nugegoda', 711410094, '12123342354', 'Teacher', 'Married', 'on', 'on', 'on', 'Bio', '1999-01-01', '', 42, 'Extream depression', 'Other', 'matter', 0),
(18, 'Hashin', 'dulanga', 'female', 'newuser@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'Study', 'married', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 20, 'boader line', 'other', 'matter', 0),
(19, 'Minuri', 'Dahara', 'male', 'minu@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'dsvsd', 'married', 'on', 'on', 'on', 'sadvfb lblksknm ;mlekbndfl knlfbabk[', '2001-02-01', '', 26, 'Moderate depression', 'Other', 'Personal problem', 0),
(20, 'Bashara', 'Chamidu', 'nale', 'Bashara@gmail.com', 'collombo/07', 711410094, '200112101360', 'Student', 'Singale', '0', '0', '0', 'Bio', '1999-01-01', '', 21, 'Moderate', 'Family', 'matter', 0),
(21, 'Supipi', 'Thasmila', 'female', 'supipi@gmail.com', 'supipi/colombo9', 411410094, '20012101360', 'Student', 'single', '0', '0', '0', 'bio', '2001-01-01', '', 21, 'Moderate', 'Education', 'matter', 0),
(22, 'Pathum', 'Pathum', 'male', 'pathum@gmail.com', 'pathum/05', 711410094, '200112101360', 'student', 'single', '0', '0', '0', 'bio', '2002-02-23', '', 21, 'Moderate', 'Family', 'matter', 0),
(23, 'ayeshma', 'amarasinghe', 'female', 'ayeshma@gmail.com', 'ayeshma/8', 711410094, '200112101360', 'Student', 'single', '0', '0', '0', 'Bio', '1999-01-01', '', 21, 'Moderate', 'Economic', 'Matter', 0),
(24, 'Rashmi', 'madusanka', 'male', 'sanka@gmail.com', 'sanka/05/erathna', 711410094, '200112101360', 'Driving', 'Married', '0', '0', '0', 'Bio', '1998-01-01', '', 23, 'Moderate', 'Economic', 'Matter', 0),
(25, 'Sampath', 'dhanushka', 'male', 'sampath@gmail.com', 'samath/niwasa/6', 711410094, '200112101360', 'Engineer', 'married', '0', '0', '0', 'Bio', '1992-02-02', '', 21, 'Moderate', 'Economic', 'Matter', 0),
(26, 'smile', 'counselling', 'male', 'smile@gmail.com', '35/2, Nugegoda', 761234567, '200112101360', 'Organization', 'married', 'on', 'on', 'on', 'Empathetic counselor dedicated to guiding clients through challenges. Creates a safe, non-judgmental space. Offers practical insights and empowering strategies for personal growth. Committed to continuous learning.', '0000-00-00', 0x53637265656e73686f7420283433292e706e67, 2, 'Normal', 'Education', 'Education problem', 0),
(27, 'Malith', 'Madhuranga', 'male', 'Malith@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 761234567, '200112101360', 'Mecdical colage', 'single', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 29, 'Moderate depression', 'Education', 'bla blaa blaa', 0),
(28, 'deshani', 'supun', 'male', 'deshani@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'dsvsd', 'single', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 31, 'Severe depression', '', '', 0),
(29, 'Sachitha', 'sewmini', 'male', 'Sachitha@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 761234567, '200112101360', 'Organization', 'single', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 0, '', '', '', 0),
(30, 'dulshan', 'chamika', 'male', 'dulshan@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'Organization', 'married', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 0, '', '', '', 0),
(31, 'Kalpa', 'kalhara', 'male', 'kalpa@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 761234567, '200112101360', 'no', 'single', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 0, '', '', '', 0),
(32, 'Champika', 'Sarojani', 'male', 'champika@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'Organization', 'single', 'on', 'on', 'on', 'BIO 2024, the BIO International Convention, will take place 4-8 June 2024 in San Diego, CA, USA.', '0000-00-00', '', 0, '', '', '', 0),
(34, 'gihan', 'matheesha', 'male', 'gihan@gmail.com', 'No:05, Vithaarampanguwe , Erathna', 711410094, '200112101360', 'Organization', 'single', 'on', 'on', 'on', 'Smile bio', '0000-00-00', '', 0, '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `Counsellor_ID fk` (`Counsellor_ID`),
  ADD KEY `Timeslot_ID` (`Timeslot_ID`),
  ADD KEY `User_IDfk` (`User_ID`);

--
-- Indexes for table `counsellor`
--
ALTER TABLE `counsellor`
  ADD PRIMARY KEY (`Counsellor_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `counselor_timeslots`
--
ALTER TABLE `counselor_timeslots`
  ADD PRIMARY KEY (`Timeslot_ID`),
  ADD KEY `Counsellor_ID` (`Counsellor_ID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`Session_ID`),
  ADD KEY `Counsellor_ID fk` (`Counsellor_ID`),
  ADD KEY `User_ID fk` (`User_ID`),
  ADD KEY `Patient_ID fk` (`Patient_ID`);

--
-- Indexes for table `sign_up`
--
ALTER TABLE `sign_up`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `Admin_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Appointment_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `counselor_timeslots`
--
ALTER TABLE `counselor_timeslots`
  MODIFY `Timeslot_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Counsellor_ID`) REFERENCES `counsellor` (`Counsellor_ID`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Timeslot_ID`) REFERENCES `counselor_timeslots` (`Timeslot_ID`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `counselor_timeslots`
--
ALTER TABLE `counselor_timeslots`
  ADD CONSTRAINT `counselor_timeslots_ibfk_1` FOREIGN KEY (`Counsellor_ID`) REFERENCES `counsellor` (`Counsellor_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
