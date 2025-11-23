-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 01:01 PM
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
-- Database: `eventmusik_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventmusik`
--

CREATE TABLE `eventmusik` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(150) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `contact_panitia` varchar(50) NOT NULL,
  `id_artis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventmusik`
--

INSERT INTO `eventmusik` (`id_event`, `nama_event`, `lokasi`, `waktu_mulai`, `waktu_selesai`, `contact_panitia`, `id_artis`, `created_at`) VALUES
(4, 'Konser Musik Bahagia', 'Lapang Prawatasi Cianjur', '2025-11-23 08:40:00', '2025-11-25 12:40:00', '085771080987', '-OeiYB4ome7m2uP5_sDY', '2025-11-23 04:42:15'),
(5, 'HUT Kota Bogor', 'Kebun Raya Bogor', '2025-08-29 13:51:00', '2025-08-31 13:51:00', '08577108998', '-Oej-33QGDTRtx457m13', '2025-11-23 04:52:13'),
(6, 'Forevenge', 'Lapangan Merdeka Sukabumi', '2025-10-03 08:32:00', '2025-10-04 12:31:00', '098765799087', '-OekX8465On_GlmO6FQQ', '2025-11-23 05:32:19'),
(7, 'Aloha Fest', 'Lapangan Raider, Cianjur', '2025-11-01 08:52:00', '2025-11-02 18:52:00', '086587658907', '-Oej6UTf4R-IBD9i111a', '2025-11-23 11:53:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventmusik`
--
ALTER TABLE `eventmusik`
  ADD PRIMARY KEY (`id_event`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventmusik`
--
ALTER TABLE `eventmusik`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
