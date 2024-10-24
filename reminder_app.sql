-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2024 at 06:25 AM
-- Server version: 8.0.39
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reminder_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date_time` datetime NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reminder_sent` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `title`, `description`, `date_time`, `email`, `reminder_sent`) VALUES
(1, 2, 'TUGAS BASIS DATA', 'BUAT STRUKTUR DATABASE', '2024-10-19 07:00:00', NULL, 0),
(2, 2, 'TUGAS ALJABAR', 'BESOK DI KUMPULL', '2024-10-21 07:30:00', NULL, 0),
(3, 2, 'tes 2', '12345', '2024-10-17 19:52:00', NULL, 0),
(4, 2, 'tugass', 'kerjakann woouuuii', '2024-10-17 19:56:00', NULL, 0),
(8, 2, 'tugas ', '234567', '2024-10-18 13:47:00', NULL, 0),
(9, 3, 'tugas rpl', 'buat website', '2024-10-20 07:30:00', NULL, 0),
(10, 2, 'TUGAS RPL', 'PROJEK KECIL', '2024-10-21 13:30:00', NULL, 0),
(18, 2, 'tugas', '12345', '2024-10-21 12:40:00', NULL, 0),
(19, 4, 'TUGAS RPL', 'jam 4 sore', '2024-10-21 15:16:00', NULL, 0),
(20, 4, 'TUGAS BASIS DATA', 'HALO', '2024-10-21 15:20:00', NULL, 0),
(22, 4, 'TUGAS BIOLOGI', 'KERJAKANN BRO TUGAS BIOLOGI MU', '2024-10-21 21:02:00', NULL, 0),
(24, 4, 'TUGAS DONE', 'ALHAMDULILLAH', '2024-10-21 21:06:00', NULL, 0),
(25, 4, 'TUGAS DONE', 'ALHAMDULILLAH', '2024-10-21 21:06:00', NULL, 0),
(26, 4, 'TUGAS FISIKA', 'JANGAN LUPA ACC DULU', '2024-10-21 21:20:00', NULL, 0),
(27, 5, 'Tugas OAK', 'Selesaikan tugasnya 7 tugas!!', '2024-10-22 11:50:00', NULL, 0),
(28, 5, 'Tugas Kompleksitas Algoritma', 'Presentasi buat modul', '2024-10-22 11:49:00', NULL, 0),
(29, 5, 'Tugas SO', 'Buat Diamond di ubuntu', '2024-10-22 11:52:00', NULL, 0),
(30, 5, 'Presentasi RPL', 'sore', '2024-10-22 15:48:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `verified`) VALUES
(1, 'Izhar', 'muhizhar123@gmail.com', '$2y$10$QojewlEesTRgm9ESm4zOnueiqEWWmu3XgwcRjo.yZ8lHAQuq3TLfC', 0),
(2, 'Izhar', 'muhizhar23@gmail.com', '$2y$10$KAI.lwuZ2zB0R.qhRA7RaeRl6AVxLcwiPnffOjmmGXGN62gFI5.mu', 1),
(3, 'doni', 'doni123@gmail.com', '$2y$10$IxXU6ehk36qzXzI4VVyIWO1xFyoaRibVXllezKu7iVsXnHxpYIrda', 1),
(4, 'Muhammad Izhar', 'muhizhar47@gmail.com', '$2y$10$I//blSlnBatU0IdA8fA6/u6QU0Z8sTba2M08Sfnao29lUDGHyb2Ra', 1),
(5, 'Muhammad Izhar', 'muhizhar43@gmail.com', '$2y$10$/UE5HXPmXGD17QOLBefD.OVfY1SOf3fn837xKp.fhCZ7LZ4lefNEu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
