-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Sty 2018, 20:30
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bank`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `control_panel`
--

CREATE TABLE `control_panel` (
  `id` int(11) NOT NULL,
  `login` int(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `control_panel`
--

INSERT INTO `control_panel` (`id`, `login`, `haslo`, `status`) VALUES
(1, 1, '1a7fcdd5a9fd433523268883cfded9d0', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane`
--

CREATE TABLE `dane` (
  `login` varchar(255) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `dane`
--

INSERT INTO `dane` (`login`, `imie`, `nazwisko`, `adres`) VALUES
('12345678', 'Jan', 'Kowalski', 'ul.Rejtana 14 55-555 Rzeszów');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_osobiste`
--

CREATE TABLE `konta_osobiste` (
  `login` varchar(255) NOT NULL,
  `numer_konta` varchar(255) NOT NULL,
  `saldo` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `konta_osobiste`
--

INSERT INTO `konta_osobiste` (`login`, `numer_konta`, `saldo`) VALUES
('12345678', '26000119960000111122223333', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logi_cp`
--

CREATE TABLE `logi_cp` (
  `login` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `udane_logowanie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logi_cp`
--

INSERT INTO `logi_cp` (`login`, `user_agent`, `data`, `ip`, `udane_logowanie`) VALUES
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:27:10', '::1', 0),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:27:15', '::1', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przelewy`
--

CREATE TABLE `przelewy` (
  `login` varchar(255) CHARACTER SET utf8 NOT NULL,
  `data` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dane` varchar(255) CHARACTER SET utf8 NOT NULL,
  `numer_konta` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tytul` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `kwota` double NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rejestracja` varchar(255) NOT NULL,
  `logowanie` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `przelewy` int(255) NOT NULL,
  `aktywacja` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rejestracja`, `logowanie`, `ip`, `przelewy`, `aktywacja`) VALUES
(1, '12345678', '1a7fcdd5a9fd433523268883cfded9d0', 'admin@admin.pl', '21/12/2017 12:34:27', '01/01/2018 19:43:42', '::1', 2, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `control_panel`
--
ALTER TABLE `control_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `przelewy`
--
ALTER TABLE `przelewy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `control_panel`
--
ALTER TABLE `control_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `przelewy`
--
ALTER TABLE `przelewy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
