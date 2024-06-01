-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jun 01, 2024 at 10:52 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `univerzita`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakulta`
--

CREATE TABLE `fakulta` (
  `id` int NOT NULL,
  `dekan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fakulta`
--

INSERT INTO `fakulta` (`id`, `dekan`) VALUES
(1, 'Michal Varady');

-- --------------------------------------------------------

--
-- Table structure for table `katedra`
--

CREATE TABLE `katedra` (
  `id` int NOT NULL,
  `fakulta_id` int DEFAULT NULL,
  `zkratka_katedry` text NOT NULL,
  `webove_stranky` varchar(255) DEFAULT 'https://www.ujep.cz/cs/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `katedra`
--

INSERT INTO `katedra` (`id`, `fakulta_id`, `zkratka_katedry`, `webove_stranky`) VALUES
(1, 1, 'KI', 'https://www.ujep.cz/cs/');

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `id` int NOT NULL,
  `katedra_id` int DEFAULT NULL,
  `zkratka` text NOT NULL,
  `typ` enum('přednáška','seminář','cvičení','kombinované') DEFAULT 'kombinované',
  `nazev` text NOT NULL,
  `popis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`id`, `katedra_id`, `zkratka`, `typ`, `nazev`, `popis`) VALUES
(1, 1, 'APR1', 'kombinované', 'Programovani 1', 'Jak se má programovat pt.1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `jmeno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prijmeni` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stid` int NOT NULL,
  `email` text,
  `fakulta_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`jmeno`, `prijmeni`, `stid`, `email`, `fakulta_id`) VALUES
('Pavel', 'Kuzma', 22127, 'kuzmapav@gmail', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vedouci`
--

CREATE TABLE `vedouci` (
  `id` int NOT NULL,
  `katedra_id` int DEFAULT NULL,
  `jmeno` text NOT NULL,
  `telefon` text,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vedouci`
--

INSERT INTO `vedouci` (`id`, `katedra_id`, `jmeno`, `telefon`, `email`) VALUES
(1, 1, 'Jiří Škvor', '420 475 286 711', 'Jiri.Skvor@ujep.cz');

-- --------------------------------------------------------

--
-- Table structure for table `zamestnanec`
--

CREATE TABLE `zamestnanec` (
  `id` int NOT NULL,
  `katedra_id` int DEFAULT NULL,
  `jmeno` text NOT NULL,
  `telefon` text,
  `email` text,
  `pozice` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zamestnanec`
--

INSERT INTO `zamestnanec` (`id`, `katedra_id`, `jmeno`, `telefon`, `email`, `pozice`) VALUES
(1, 1, 'Pavel Beránek', '420 475 286 723', 'Pavel.Beranek@ujep.cz', 'odbotrný_assistent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakulta`
--
ALTER TABLE `fakulta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `katedra`
--
ALTER TABLE `katedra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakulta_id` (`fakulta_id`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katedra_id` (`katedra_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stid`),
  ADD KEY `fakulta_id` (`fakulta_id`);

--
-- Indexes for table `vedouci`
--
ALTER TABLE `vedouci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katedra_id` (`katedra_id`);

--
-- Indexes for table `zamestnanec`
--
ALTER TABLE `zamestnanec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katedra_id` (`katedra_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakulta`
--
ALTER TABLE `fakulta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `katedra`
--
ALTER TABLE `katedra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vedouci`
--
ALTER TABLE `vedouci`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zamestnanec`
--
ALTER TABLE `zamestnanec`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `katedra`
--
ALTER TABLE `katedra`
  ADD CONSTRAINT `katedra_ibfk_1` FOREIGN KEY (`fakulta_id`) REFERENCES `fakulta` (`id`);

--
-- Constraints for table `predmet`
--
ALTER TABLE `predmet`
  ADD CONSTRAINT `predmet_ibfk_1` FOREIGN KEY (`katedra_id`) REFERENCES `katedra` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fakulta_id` FOREIGN KEY (`fakulta_id`) REFERENCES `fakulta` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vedouci`
--
ALTER TABLE `vedouci`
  ADD CONSTRAINT `vedouci_ibfk_1` FOREIGN KEY (`katedra_id`) REFERENCES `katedra` (`id`);

--
-- Constraints for table `zamestnanec`
--
ALTER TABLE `zamestnanec`
  ADD CONSTRAINT `zamestnanec_ibfk_1` FOREIGN KEY (`katedra_id`) REFERENCES `katedra` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
