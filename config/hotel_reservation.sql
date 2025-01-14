-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 04:05 PM
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
-- Database: `hotel_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `Id` int(11) NOT NULL,
  `Comment` varchar(500) NOT NULL,
  `Filename` varchar(100) NOT NULL,
  `UploadDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`Id`, `Comment`, `Filename`, `UploadDate`) VALUES
(3, 'What a nice mouse', 'mouse.png', '2025-01-14 13:52:00'),
(4, 'Cats eat mice', 'katze.png', '2025-01-14 13:52:50'),
(5, 'Tree', 'baum.png', '2025-01-14 13:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Arrival` date NOT NULL,
  `Departure` date NOT NULL,
  `Breakfast` tinyint(1) NOT NULL,
  `Parking` tinyint(1) NOT NULL,
  `Cat` tinyint(1) NOT NULL,
  `Status` varchar(9) NOT NULL DEFAULT 'neu',
  `Price` int(11) NOT NULL,
  `BookingDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Id`, `UserId`, `Arrival`, `Departure`, `Breakfast`, `Parking`, `Cat`, `Status`, `Price`, `BookingDate`) VALUES
(11, 6, '2025-01-14', '2025-01-16', 1, 0, 1, 'bestätigt', 330, '2025-01-13 19:20:19'),
(12, 6, '2025-01-17', '2025-01-18', 0, 1, 1, 'storniert', 405, '2025-01-13 19:47:00'),
(13, 6, '2025-01-19', '2025-01-20', 1, 0, 0, 'neu', 325, '2025-01-13 19:47:59'),
(14, 6, '2025-01-21', '2025-01-22', 1, 0, 1, 'neu', 330, '2025-01-14 14:32:38'),
(15, 6, '2025-01-23', '2025-01-24', 0, 1, 0, 'neu', 400, '2025-01-14 14:35:47'),
(16, 6, '2025-01-25', '2025-01-26', 0, 1, 0, 'neu', 400, '2025-01-14 14:38:30'),
(17, 6, '2025-01-28', '2025-01-29', 0, 0, 0, 'neu', 300, '2025-01-14 14:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Title` varchar(6) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Title`, `FirstName`, `LastName`, `Email`, `UserName`, `Password`, `IsAdmin`, `IsActive`) VALUES
(6, 'Herr', 'Frank', 'Franky', 'franky@mail.com', 'Franky5', '$2y$10$FAgNvXHI3CSGOYpmAXhkJO6fOTqGb7bbfRv6IkLPxEGOQjiIT9y9C', 1, 1),
(11, 'Divers', 'Admin', 'Admin', 'admin@mail.com', 'Admin', '$2y$10$CS4ItEJfkfSlxB7Z8hAkPe1ayWwmsxnx1kD1Id55/J0aVkvi/yGo.', 1, 1),
(12, 'Herr', 'User1', 'User1', 'user1@mail.com', 'User1', '$2y$10$7Nd.Epn9a9EuxJ6ST0.CSO3wmiJIX7pXSfw7YA.Yup.ABish2f8Nm', 0, 1),
(13, 'Frau', 'User2', 'User2', 'user2@mail.com', 'User2', '$2y$10$SvgIapL01F./z/aGTgUEKukg3ByS9CDxCgP0d5OtGvEwW32YlNNfW', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `filename_unique` (`Filename`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId_Index` (`UserId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `UserId_ForeignKey` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
