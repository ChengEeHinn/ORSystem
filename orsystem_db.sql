-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2026 at 10:14 AM
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
-- Database: `orsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `lp_problems`
--

CREATE TABLE `lp_problems` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `objective_type` enum('Maximize','Minimize') NOT NULL,
  `profit_x` double NOT NULL,
  `profit_y` double NOT NULL,
  `c1_x` double NOT NULL,
  `c1_y` double NOT NULL,
  `c1_rhs` double NOT NULL,
  `c2_x` double NOT NULL,
  `c2_y` double NOT NULL,
  `c2_rhs` double NOT NULL,
  `c3_x` double NOT NULL,
  `c3_y` double NOT NULL,
  `c3_rhs` double NOT NULL,
  `optimal_x` double DEFAULT NULL,
  `optimal_y` double DEFAULT NULL,
  `objective_value` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lp_problems`
--

INSERT INTO `lp_problems` (`id`, `user_id`, `project_title`, `objective_type`, `profit_x`, `profit_y`, `c1_x`, `c1_y`, `c1_rhs`, `c2_x`, `c2_y`, `c2_rhs`, `c3_x`, `c3_y`, `c3_rhs`, `optimal_x`, `optimal_y`, `objective_value`, `created_at`) VALUES
(2, 2, 'Campus Event Budget Allocation Demo', 'Maximize', 50, 38, 100, 80, 1000, 2, 3, 38, 1, 1, 20, 10, 0, 500, '2026-06-05 07:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(2, 'Lim Xin Yi', 'limxinyi04@gmail.com', '$2y$10$RxoH7Z09i.j28amrPn1mcuzL7CeOOUN1jATDH/rm1OuzCdUwlmGEe', '2026-06-05 07:48:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lp_problems`
--
ALTER TABLE `lp_problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

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
-- AUTO_INCREMENT for table `lp_problems`
--
ALTER TABLE `lp_problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lp_problems`
--
ALTER TABLE `lp_problems`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
