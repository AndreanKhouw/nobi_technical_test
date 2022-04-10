-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 05:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nobi_tech_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `amount_available` decimal(10,6) NOT NULL DEFAULT 0.000000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `user_id`, `amount_available`, `created_at`, `updated_at`) VALUES
(1, 1, '-322.993258', '2022-03-07 02:57:13', '2022-04-09 16:29:24'),
(2, 2, '1.000000', '2022-03-07 02:57:13', '2022-03-07 02:57:13'),
(3, 3, '0.000000', '2022-03-07 02:57:13', '2022-03-07 02:57:13'),
(4, 4, '21.000000', '2022-03-07 02:57:13', '2022-03-07 02:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `coin_csv`
--

CREATE TABLE `coin_csv` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ticker` varchar(255) DEFAULT NULL,
  `coin_id` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `exchange` varchar(255) DEFAULT NULL,
  `invalid` int(11) DEFAULT NULL,
  `record_time` int(11) DEFAULT NULL,
  `usd` decimal(10,6) DEFAULT NULL,
  `idr` int(11) DEFAULT NULL,
  `hnst` int(11) DEFAULT NULL,
  `eth` decimal(10,6) DEFAULT NULL,
  `btc` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coin_csv`
--

INSERT INTO `coin_csv` (`id`, `name`, `ticker`, `coin_id`, `code`, `exchange`, `invalid`, `record_time`, `usd`, `idr`, `hnst`, `eth`, `btc`, `created_at`, `updated_at`) VALUES
(1, 'name', 'ticker', 0, 'code', 'exchange', 0, 0, '0.000000', 0, 0, '0.000000', 0, '2022-04-10 09:19:45', '0000-00-00 00:00:00'),
(50348, 'Bitcoin', 'BTC', 5, 'bitcoin', 'gecko', 0, 1502323200, '3367.905387', 44990164, 0, '11.348280', 1, '2022-04-09 09:19:52', '0000-00-00 00:00:00'),
(50349, 'Bitcoin', 'BTC', 5, 'bitcoin', 'gecko', 0, 1502409600, '3562.587663', 47588155, 0, '11.611085', 1, '2022-04-08 09:19:58', '0000-00-00 00:00:00'),
(50350, 'Bitcoin', 'BTC', 5, 'bitcoin', 'gecko', 0, 1502496000, '3800.140625', 50761328, 0, '12.313112', 1, '2022-04-10 09:20:03', '0000-00-00 00:00:00'),
(50351, 'Bitcoin', 'BTC', 5, 'bitcoin', 'gecko', 0, 1502582400, '4023.254522', 53737605, 0, '13.539027', 1, '2022-04-06 09:20:08', '0000-00-00 00:00:00'),
(50352, 'Bitcoin', 'BTC', 5, 'bitcoin', 'gecko', 0, 1502668800, '4175.695291', 55733005, 0, '14.088170', 1, '2022-03-02 09:20:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL DEFAULT '',
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `amount` decimal(10,6) NOT NULL DEFAULT 0.000000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trx_id`, `user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'a', 1, '0.010000', '2022-03-07 02:55:44', '2022-03-07 02:55:44'),
(2, 'B', 1, '0.020000', '2022-03-07 02:55:44', '2022-03-07 02:55:44'),
(4, '2', 1, '323.000000', '2022-04-09 16:03:52', '2022-04-09 16:03:52'),
(8, '2a', 1, '323.000000', '2022-04-09 16:12:51', '2022-04-09 16:12:51'),
(11, '2ab', 1, '323.000000', '2022-04-09 16:28:54', '2022-04-09 16:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_counter_error` int(11) NOT NULL DEFAULT 0,
  `user_is_blocked` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `api_token`, `created_at`, `updated_at`, `user_counter_error`, `user_is_blocked`) VALUES
(1, 'admin@gmail.com', '$2a$12$tjfIyIu33gdV5aBrYw4ineKOlKtjtpQGJcMqr9K.zQXcpGtsu1K4m', '', '2022-04-09 07:33:39', '2022-04-09 07:33:39', 0, 0),
(3, 'andreankhouw@gmail.com', '$2y$10$Ji5DuDkA8JQndP98cFrOQ.6rISHxbT7P/H5Ye8uoFXnflFsiCiGlG', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjozLCJleHAiOjE2NDk1NjU0NjgsImlzcyI6Im5vYmlfdGVzdGVyIiwiaWF0IjoxNjQ5NTYxODY4fQ.4zxLV0nkZsl4hywZ4OxcaA71n4WqOa7KevMrDevbsHw', '2022-04-09 09:20:45', '2022-04-09 16:20:45', 0, 0),
(4, 'andrean@gmail.com', '$2y$10$LF.cMMlOSp3axnf03HjmE.sjSMBO1UdiYTG5GbhHHJpG0r.j1P9IS', NULL, '2022-04-09 09:30:31', '2022-04-09 16:30:31', 0, 0),
(5, 'andreaan@gmail.com', '$2y$10$/B//LYrkJ/GeB7VJOk.XYe01EIxhelN0.5wTxUDe4ndr2kR3OWnpy', NULL, '2022-04-09 20:37:57', '2022-04-10 03:37:57', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coin_csv`
--
ALTER TABLE `coin_csv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coin_csv`
--
ALTER TABLE `coin_csv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50353;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
