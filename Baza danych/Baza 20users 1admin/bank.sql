-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Sty 2018, 18:19
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
('12345678', 'Jan', 'Kowalski', 'ul.Rejtana 14 55-555 Rzeszów'),
('12345679', 'Janina', 'Kowalska', 'ul.Rejtana 14 55-555 Rzeszów'),
('12345680', 'Adam', 'Kowalski', 'ul.Rejtana 14 55-555 Rzeszów'),
('12345681', 'Marek', 'Kowalski', 'ul. Rejtana 14 55-555 Rzeszów'),
('12345682', 'Anna', 'Kowalska', 'ul. Rejtana 14 55-555 Rzeszów'),
('12345683', 'Aleksandra', 'Kowalska', 'ul. Rejtana 14 55-555 Rzeszów'),
('12345684', 'Tomasz', 'Kowalski', 'ul. Rejtana 14 55-555 Rzeszów'),
('12345685', 'Damian', 'Kowalski', 'ul. Rejtana 14 55-555 Rzeszów'),
('12345686', 'Jan', 'Nowak', 'ul. Lwowska 17 22-222 Warszawa'),
('12345687', 'Janina', 'Nowak', 'ul. Lwowska 17 22-222 Warszawa'),
('12345688', 'Anna', 'Nowak', 'ul. Lwowska 17 22-222 Warszawa'),
('12345689', 'Aleksandra', 'Nowak', 'ul. Lwowska 17 22-222 Warszawa'),
('12345690', 'Damian', 'Nowak', 'ul. Lwowska 17 22-222 Warszawa');

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
('12345678', '26000119960000111122223333', 50),
('12345679', '26000119960000111122223334', 0),
('12345680', '26000119960000111122223335', 0),
('12345681', '26000119960000111122223336', 0),
('12345682', '26000119960000111122223337', 0),
('12345683', '26000119960000111122223338', 0),
('12345684', '26000119960000111122223339', 0),
('12345685', '26000119960000111122223340', 66.67),
('12345686', '26000119960000111122223341', 0),
('12345687', '26000119960000111122223342', 0),
('12345688', '26000119960000111122223343', 0),
('12345689', '26000119960000111122223344', 0),
('12345690', '26000119960000111122223345', 533.33);

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
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:27:15', '::1', 1),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:36:28', '::1', 1),
('', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:36:37', '::1', 0),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:36:40', '::1', 1),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '01/01/2018 20:50:28', '::1', 1),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '03/01/2018 14:51:03', '::1', 1),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '03/01/2018 15:16:27', '::1', 1),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '03/01/2018 15:23:33', '::1', 0),
('1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36', '03/01/2018 15:23:36', '::1', 1);

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

--
-- Zrzut danych tabeli `przelewy`
--

INSERT INTO `przelewy` (`login`, `data`, `dane`, `numer_konta`, `tytul`, `kwota`, `id`) VALUES
('12345678', '01/01/2018', 'UNIVERSE BANK ul. Rejtana 14', '26000119960000111122223333', 'Wpłata', 50, 1),
('12345685', '01/01/2018', 'UNIVERSE BANK ul. Rejtana 14', '26000119960000111122223340', 'Wpłata', 100, 2),
('12345690', '01/01/2018', 'UNIVERSE BANK ul. Rejtana 14', '26000119960000111122223345', 'Wpłata', 500, 3),
('12345685', '01/01/2018', 'Damian Nowak', '26000119960000111122223345', 'Za czynsz.', -50.55, 4),
('12345690', '01/01/2018', 'Damian Kowalski ul. Rejtana 14 55-555 Rzeszów', '26000119960000111122223340', 'Za czynsz.', 50.55, 5),
('12345685', '01/01/2018', 'Damian Nowak', '26000119960000111122223345', 'Za czynsz.', -33.33, 6),
('12345690', '01/01/2018', 'Damian Kowalski ul. Rejtana 14 55-555 Rzeszów', '26000119960000111122223340', 'Za czynsz.', 33.33, 7);

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
(1, '12345678', '1a7fcdd5a9fd433523268883cfded9d0', 'admin@admin.pl', '21/12/2017 12:34:27', '03/01/2018 15:18:55', '::1', 2, 1),
(47, '12345685', '1a7fcdd5a9fd433523268883cfded9d0', 'damian@kowalski.pl', '01/01/2018 20:41:48', '01/01/2018 20:47:43', '::1', 2, 1),
(45, '12345683', '1a7fcdd5a9fd433523268883cfded9d0', 'aleksandra@kowalska.pl', '01/01/2018 20:39:14', '01/01/2018 20:39:14', '::1', 0, 0),
(44, '12345682', '1a7fcdd5a9fd433523268883cfded9d0', 'anna@kowalska.pl', '01/01/2018 20:38:55', '01/01/2018 20:38:55', '::1', 0, 0),
(46, '12345684', '1a7fcdd5a9fd433523268883cfded9d0', 'tomasz@kowalski.pl', '01/01/2018 20:40:25', '01/01/2018 20:40:25', '::1', 0, 0),
(43, '12345681', '1a7fcdd5a9fd433523268883cfded9d0', 'marek@kowalski.pl', '01/01/2018 20:38:38', '01/01/2018 20:38:38', '::1', 0, 0),
(42, '12345680', '1a7fcdd5a9fd433523268883cfded9d0', 'adam@kowalski.pl', '01/01/2018 20:36:03', '01/01/2018 20:36:03', '::1', 0, 1),
(41, '12345679', '1a7fcdd5a9fd433523268883cfded9d0', 'janina@kowalska.pl', '01/01/2018 20:33:56', '01/01/2018 20:33:56', '::1', 0, 1),
(48, '12345686', '1a7fcdd5a9fd433523268883cfded9d0', 'jan@nowak.pl', '01/01/2018 20:42:42', '01/01/2018 20:42:42', '::1', 0, 0),
(49, '12345687', '1a7fcdd5a9fd433523268883cfded9d0', 'janina@nowak.pl', '01/01/2018 20:43:09', '01/01/2018 20:43:09', '::1', 0, 0),
(50, '12345688', '1a7fcdd5a9fd433523268883cfded9d0', 'anna@nowak.pl', '01/01/2018 20:43:57', '01/01/2018 20:43:57', '::1', 0, 1),
(51, '12345689', '1a7fcdd5a9fd433523268883cfded9d0', 'aleksandra@nowak.pl', '01/01/2018 20:44:17', '01/01/2018 20:44:17', '::1', 0, 1),
(52, '12345690', '1a7fcdd5a9fd433523268883cfded9d0', 'damian@nowak.pl', '01/01/2018 20:44:42', '01/01/2018 20:50:52', '::1', 0, 1);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
