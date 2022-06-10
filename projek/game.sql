-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 09:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password_hash` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `email`, `nama`, `password_hash`) VALUES
(1, '202410103025@mail.unej.ac.id', 'Muhammad Rosyid Iqbal Haqiqi', '$2y$10$sY6GU7Avjiwhr9w7IxU3GeQQklTctJ/T8dX7f5Lkgyw4zTHNbX/02'),
(2, '202410103039@mail.unej.ac.id', 'Ilham Pandu Prasetyo', '$2y$10$sY6GU7Avjiwhr9w7IxU3GeQQklTctJ/T8dX7f5Lkgyw4zTHNbX/02'),
(3, '202410103064@mail.unej.ac.id', 'Arvito Caesario Arifianto Putra', '$2y$10$sY6GU7Avjiwhr9w7IxU3GeQQklTctJ/T8dX7f5Lkgyw4zTHNbX/02'),
(4, 'customer@gmail.com', 'customer', '$2y$10$NGCMdpFa3M.Ze9H3u7yWrO1/xXwOiIVIYfPtW/HLoJf.Awr3cYQKG');

-- --------------------------------------------------------

--
-- Table structure for table `genre_game`
--

CREATE TABLE `genre_game` (
  `id_genre_game` int(11) NOT NULL,
  `genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre_game`
--

INSERT INTO `genre_game` (`id_genre_game`, `genre`) VALUES
(1, 'Action'),
(2, 'Fighting'),
(3, 'First Person Shooter (FPS)'),
(4, 'Third Person Shooter (TPS)'),
(5, 'Real Time Strategy (RTS)'),
(6, 'Role Playing Game (RPG)'),
(7, 'Adventure'),
(8, 'Simulation'),
(9, 'Sport'),
(10, 'Racing'),
(11, 'Multiplayer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `genre_game`
--
ALTER TABLE `genre_game`
  ADD PRIMARY KEY (`id_genre_game`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
