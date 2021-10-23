-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 08:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chess_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` char(30) NOT NULL,
  `email` char(60) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`) VALUES
(3, 'hassan', 'hassan@gmail.com', 'Helo there'),
(5, 'somebody', 'somemail@mail.com', 'bla bla bla');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `matrial_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `player_id`, `matrial_id`) VALUES
(34, 9, 8),
(36, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `matrials`
--

CREATE TABLE `matrials` (
  `id` int(11) NOT NULL,
  `title` char(30) NOT NULL,
  `description` char(150) NOT NULL,
  `image` char(100) NOT NULL,
  `url` varchar(500) NOT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matrials`
--

INSERT INTO `matrials` (`id`, `title`, `description`, `image`, `url`, `added_by`) VALUES
(5, 'Chess Opening', 'London System !', '401634895572.jpeg', 'https://www.arabchessacademy.com/courses/take/london-system/lessons/19597475-7-dutch-defence', 6),
(6, 'Tartakwer system', 'chess opening tartakwer !', '41634895715.jpeg', 'https://www.arabchessacademy.com/courses/take/tartakower-opening/lessons/9149350', 6),
(7, 'Middle game', 'Middle game strategies .', '71634895960.jpeg', 'https://www.arabchessacademy.com/courses/take/aos/lessons/14408610-1', 6),
(8, 'exchange art', 'course about exchange peaces.', '471634897935.jpeg', 'https://www.arabchessacademy.com/courses/take/fc001/lessons/7870737-part-2', 1),
(9, 'Sacrifice Art', 'chess middle game tactics.', '131634901974.jpeg', 'https://www.arabchessacademy.com/courses/take/aos/lessons/14408610-1', 8),
(10, 'Carlsen', 'About the world champion carlsen style!', '81634909007.jpeg', 'https://www.arabchessacademy.com/courses/take/fc001/lessons/7870752-part-1', 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'trainer'),
(3, 'player');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` char(30) NOT NULL,
  `email` char(60) NOT NULL,
  `password` char(32) NOT NULL,
  `nationality` char(20) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `nationality`, `role_id`) VALUES
(1, 'ahmed', 'ahmed@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'egypt', 1),
(3, 'aly', 'aly@example.com', '57b7fa6522a60d4864bdaeb9291e3915', 'uae', 3),
(4, 'khaled', 'khaled@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'egypt', 3),
(5, 'islam', 'islam@mail.com', 'e10adc3949ba59abbe56e057f20f883e', 'egypt', 3),
(6, 'ghonaime', 'ghonaime@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'egypt', 1),
(7, 'mohammed', 'mohammed_hero@email.com', 'e10adc3949ba59abbe56e057f20f883e', 'egypt', 2),
(8, 'sayed', 'sayed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'uae', 2),
(9, 'omar', 'omar11@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'ksa', 3),
(17, 'Essam', 'essam@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'iraq', 3),
(18, 'someone', 'someone@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'egypt', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `matrial_id` (`matrial_id`);

--
-- Indexes for table `matrials`
--
ALTER TABLE `matrials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tainer_id` (`added_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `matrials`
--
ALTER TABLE `matrials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `matrialcourse_relation` FOREIGN KEY (`matrial_id`) REFERENCES `matrials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `player_users_relation` FOREIGN KEY (`player_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matrials`
--
ALTER TABLE `matrials`
  ADD CONSTRAINT `matial_tainer_id` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_user_relation` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
