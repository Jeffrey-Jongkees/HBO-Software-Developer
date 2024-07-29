-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2024 at 02:05 PM
-- Server version: 8.0.36
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ledenadministratie`
--

-- --------------------------------------------------------

--
-- Table structure for table `boekjaar`
--

CREATE TABLE `boekjaar` (
  `jaar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `boekjaar`
--

INSERT INTO `boekjaar` (`jaar`) VALUES
(2023),
(2024);

-- --------------------------------------------------------

--
-- Table structure for table `contributie`
--

CREATE TABLE `contributie` (
  `id` int NOT NULL,
  `soort_lid` varchar(255) NOT NULL,
  `bedrag` float(6,0) NOT NULL,
  `boekjaar` int NOT NULL,
  `familielidID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contributie`
--

INSERT INTO `contributie` (`id`, `soort_lid`, `bedrag`, `boekjaar`, `familielidID`) VALUES
(1, 'Oudere', 55, 2023, 1),
(2, 'Oudere', 55, 2023, 2),
(3, 'Oudere', 55, 2024, 3),
(4, 'Oudere', 55, 2024, 4),
(5, 'Senior', 100, 2024, 5),
(6, 'Senior', 100, 2024, 6);

-- --------------------------------------------------------

--
-- Table structure for table `familie`
--

CREATE TABLE `familie` (
  `familieID` int NOT NULL,
  `naam` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `familie`
--

INSERT INTO `familie` (`familieID`, `naam`, `adres`) VALUES
(1, 'de Groot', 'Langepotenlaan 19 8437 IJsselstein'),
(2, 'Jongkees', 'Sonatelaan 103 3438TJ Nieuwegein');

-- --------------------------------------------------------

--
-- Table structure for table `familielid`
--

CREATE TABLE `familielid` (
  `id` int NOT NULL,
  `naam` varchar(255) NOT NULL,
  `geboortedatum` date NOT NULL DEFAULT '1900-01-01',
  `familielidRol` varchar(255) NOT NULL,
  `familieID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `familielid`
--

INSERT INTO `familielid` (`id`, `naam`, `geboortedatum`, `familielidRol`, `familieID`) VALUES
(1, 'Bert', '1945-03-10', 'Man', 1),
(2, 'Trudy', '1948-09-17', 'Vrouw', 1),
(3, 'Eef', '1958-05-30', 'Vader', 2),
(4, 'Francisca', '1962-11-11', 'Moeder', 2),
(5, 'Jeffrey', '1985-02-27', 'Zoon', 2),
(6, 'Bryant', '1992-12-12', 'Zoon', 2);

-- --------------------------------------------------------

--
-- Table structure for table `familierol`
--

CREATE TABLE `familierol` (
  `Rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `familierol`
--

INSERT INTO `familierol` (`Rol`) VALUES
('Dochter'),
('Man'),
('Moeder'),
('Neef'),
('Nicht'),
('Oom'),
('Tante'),
('Vader'),
('Vrouw'),
('Zoon');

-- --------------------------------------------------------

--
-- Table structure for table `soort_lid`
--

CREATE TABLE `soort_lid` (
  `omschrijving` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soort_lid`
--

INSERT INTO `soort_lid` (`omschrijving`) VALUES
('Aspirant'),
('Jeugd'),
('Junior'),
('Oudere'),
('Senior');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Penningmeester', '1234'),
(2, 'Secretaris', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boekjaar`
--
ALTER TABLE `boekjaar`
  ADD PRIMARY KEY (`jaar`);

--
-- Indexes for table `contributie`
--
ALTER TABLE `contributie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contributie_fk_3_idx` (`familielidID`),
  ADD KEY `contributie_fk_1_idx` (`soort_lid`),
  ADD KEY `contributie_fk_2_idx` (`boekjaar`);

--
-- Indexes for table `familie`
--
ALTER TABLE `familie`
  ADD PRIMARY KEY (`familieID`);

--
-- Indexes for table `familielid`
--
ALTER TABLE `familielid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `familieID_fk` (`familieID`),
  ADD KEY `familielid_fk_2_idx` (`familielidRol`);

--
-- Indexes for table `familierol`
--
ALTER TABLE `familierol`
  ADD PRIMARY KEY (`Rol`);

--
-- Indexes for table `soort_lid`
--
ALTER TABLE `soort_lid`
  ADD PRIMARY KEY (`omschrijving`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contributie`
--
ALTER TABLE `contributie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `familie`
--
ALTER TABLE `familie`
  MODIFY `familieID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `familielid`
--
ALTER TABLE `familielid`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributie`
--
ALTER TABLE `contributie`
  ADD CONSTRAINT `contributie_fk_1` FOREIGN KEY (`soort_lid`) REFERENCES `soort_lid` (`omschrijving`),
  ADD CONSTRAINT `contributie_fk_2` FOREIGN KEY (`boekjaar`) REFERENCES `boekjaar` (`jaar`),
  ADD CONSTRAINT `contributie_fk_3` FOREIGN KEY (`familielidID`) REFERENCES `familielid` (`id`);

--
-- Constraints for table `familielid`
--
ALTER TABLE `familielid`
  ADD CONSTRAINT `familielid_fk_2` FOREIGN KEY (`familielidRol`) REFERENCES `familierol` (`Rol`),
  ADD CONSTRAINT `familielid_ibfk_1` FOREIGN KEY (`familieID`) REFERENCES `familie` (`familieID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
