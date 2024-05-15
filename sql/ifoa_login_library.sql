-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 15, 2024 alle 17:55
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifoa_login_library`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `books`
--

CREATE TABLE `books` (
  `id_book` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year_publication` year(4) NOT NULL,
  `image` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `books`
--

INSERT INTO `books` (`id_book`, `title`, `author`, `year_publication`, `image`) VALUES
(12, 'Il signore delle mosche', 'William Golding', '1954', 'https://www.ibs.it/images/9788804663065_0_536_0_75.jpg'),
(13, 'Il signore degli anelli', 'J.R.R. Tolkien', '1954', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSCX4Dq1p6b7uOCv7r6FA7csiq3_lYm67qM2loGZ_fGCTep9nZW'),
(14, 'Armi Acciaio e Malattie', 'Jared Diamond', '1997', 'https://m.media-amazon.com/images/I/71ytQhvhQWL._AC_UF1000,1000_QL80_.jpg'),
(15, 'Dune', 'Frank Herbert', '1965', 'https://m.media-amazon.com/images/I/A1u+2fY5yTL._AC_UF1000,1000_QL80_.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'PincorPancor', 'pincor@pancor.com', '$2y$10$NbcGz6zzOMBUm4GcyhZPye9tttqfdHDrKtggGSFcn1lYrAjudtEha'),
(2, 'gasss', 'gasss@gmail.com', '$2y$10$N5fLFnBS6dT.5z4DBTiwReRANX8mHxCdQ8A9aR8wZJ3dX9rDCx16q'),
(3, 'prova', 'prova@prova.prova', '$2y$10$Oji2SdIDzpkwcXQA2hxK7.46.83Aw5IgBXjUre/uF6MU6yPbRiA7y');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
