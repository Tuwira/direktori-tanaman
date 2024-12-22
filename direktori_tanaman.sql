-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2024 at 12:18 PM
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
-- Database: `direktori_tanaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `security_question`, `security_answer`) VALUES
('putu', '$2y$10$vi1WDaDTIH8FlBlDFJDbMemYk/nMwSE2MbTTOeipsclISBYcK9lyG', 'Nama sekolah dasar?', 'sdn cireundeu 01'),
('wira', '$2y$10$aMqzzUrVwxqzW4WK1ifMPuqMvISag1.BIMQGeey85N4xBXFM9PwVu', 'Apa hari favorit?', 'sabtu');

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id` int(11) NOT NULL,
  `nama_tanaman` varchar(100) NOT NULL,
  `jenis_tanaman` varchar(50) DEFAULT NULL,
  `manfaat` text DEFAULT NULL,
  `asal_tanaman` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tahun_ditemukan` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`id`, `nama_tanaman`, `jenis_tanaman`, `manfaat`, `asal_tanaman`, `foto`, `tahun_ditemukan`) VALUES
(1, 'Mawar', 'Bunga', 'Dekorasi', 'Asia', 'Screenshot 2024-12-07 164726.png', 1995),
(2, 'Lavender', 'Herbal', 'Mengurangi stres', 'Persia', 'Screenshot 2024-12-07 165056.png', 1753),
(3, 'Aloe Vera', 'Sukulen', 'Mengatasi luka bakar', 'Afrika Utara', 'Screenshot 2024-12-07 164942.png', 2000),
(4, 'Bambu', 'Graminea', 'Penghijauan, dekorasi', 'Asia', 'Screenshot 2024-12-07 164853.png', 1300),
(5, 'Melati', 'Bunga', 'Dekorasi', 'Asia', 'Screenshot 2024-12-07 164805.png', 1987);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
