-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Sep 2019 um 12:39
-- Server-Version: 10.4.6-MariaDB
-- PHP-Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `conieshomies_users`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbldate2user`
--

CREATE TABLE `tbldate2user` (
  `dID` int(11) NOT NULL,
  `dDate` varchar(10) COLLATE utf16_german2_ci NOT NULL,
  `uID` int(11) NOT NULL,
  `d2uSet` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `d2uCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `dTime` varchar(10) COLLATE utf16_german2_ci NOT NULL,
  `uComment` varchar(100) COLLATE utf16_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblmap`
--

CREATE TABLE `tblmap` (
  `mID` int(11) NOT NULL,
  `mName` varchar(12) COLLATE utf16_german2_ci NOT NULL,
  `mIMGURL` varchar(100) COLLATE utf16_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblmap2voting`
--

CREATE TABLE `tblmap2voting` (
  `mID` int(11) NOT NULL,
  `vID` int(11) NOT NULL,
  `mStatus` enum('BANNED','AVAILABLE') COLLATE utf16_german2_ci NOT NULL DEFAULT 'AVAILABLE',
  `mBannedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbluser`
--

CREATE TABLE `tbluser` (
  `uID` int(11) NOT NULL,
  `uName` varchar(30) COLLATE utf16_german2_ci NOT NULL,
  `uPassword` varchar(200) COLLATE utf16_german2_ci NOT NULL,
  `uLoggedIn` int(11) NOT NULL,
  `uChangePassword` int(11) NOT NULL,
  `uLevel` int(11) NOT NULL,
  `uRegistered` timestamp NOT NULL DEFAULT current_timestamp(),
  `uLastLogin` timestamp NULL DEFAULT current_timestamp(),
  `uLastAddress` varchar(16) COLLATE utf16_german2_ci DEFAULT NULL,
  `uTSID` varchar(200) COLLATE utf16_german2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblvoting`
--

CREATE TABLE `tblvoting` (
  `vID` int(11) NOT NULL,
  `vDateCreated` varchar(25) COLLATE utf16_german2_ci NOT NULL,
  `vLocked` int(11) NOT NULL,
  `vUTurnID` int(11) DEFAULT NULL,
  `vCreator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblvoting2user`
--

CREATE TABLE `tblvoting2user` (
  `vID` int(11) NOT NULL,
  `uID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_german2_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbldate2user`
--
ALTER TABLE `tbldate2user`
  ADD PRIMARY KEY (`dDate`,`uID`),
  ADD UNIQUE KEY `dID` (`dID`);

--
-- Indizes für die Tabelle `tblmap`
--
ALTER TABLE `tblmap`
  ADD PRIMARY KEY (`mID`);

--
-- Indizes für die Tabelle `tblmap2voting`
--
ALTER TABLE `tblmap2voting`
  ADD PRIMARY KEY (`mID`,`vID`);

--
-- Indizes für die Tabelle `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`uID`),
  ADD UNIQUE KEY `USERNAME` (`uName`),
  ADD UNIQUE KEY `uTSID` (`uTSID`);

--
-- Indizes für die Tabelle `tblvoting`
--
ALTER TABLE `tblvoting`
  ADD PRIMARY KEY (`vID`);

--
-- Indizes für die Tabelle `tblvoting2user`
--
ALTER TABLE `tblvoting2user`
  ADD PRIMARY KEY (`vID`,`uID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbldate2user`
--
ALTER TABLE `tbldate2user`
  MODIFY `dID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tblmap`
--
ALTER TABLE `tblmap`
  MODIFY `mID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `uID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tblvoting`
--
ALTER TABLE `tblvoting`
  MODIFY `vID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
