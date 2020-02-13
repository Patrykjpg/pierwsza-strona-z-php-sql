-- phpMyAdmin SQL Dump
    -- version 4.4.14
    -- http://www.phpmyadmin.net
    --

    -- Host: 127.0.0.1
    -- Czas generowania: 30 Lis 2017, 13:24
    -- Wersja serwera: 5.6.26
    -- Wersja PHP: 5.6.12
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
    time_zone = "+00:00";
    /*!40101
SET
    @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
    /*!40101
SET
    @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
    /*!40101
SET
    @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
    /*!40101
SET NAMES
    utf8 */;
    --

    -- Baza danych: `newproject`
    --

    -- --------------------------------------------------------
    --

    -- Struktura tabeli dla tabeli `admins`
    --

CREATE TABLE IF NOT EXISTS `admins`(
    `id` INT(11) NOT NULL,
    `login` TEXT COLLATE utf8_polish_ci NOT NULL,
    `password` TEXT COLLATE utf8_polish_ci NOT NULL
) ENGINE = MyISAM AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8 COLLATE = utf8_polish_ci;
--

-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins`(`id`, `login`, `password`)
VALUES(
    1,
    'adam',
    '$2y$10$4sZdn0EaurMzGCAla1Up7OJ8vDmhJjKdsyCtQIAIuJ3AuxQ0m0Tly'
);
-- --------------------------------------------------------
--

-- Struktura tabeli dla tabeli `consumer`
--

CREATE TABLE IF NOT EXISTS `consumer`(
    `id` INT(11) NOT NULL,
    `email` TEXT COLLATE utf8_polish_ci NOT NULL
) ENGINE = MyISAM AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8 COLLATE = utf8_polish_ci;
--

-- Zrzut danych tabeli `consumer`
--

INSERT INTO `consumer`(`id`, `email`)
VALUES(1, 'adam@gmail.com');
--

-- Indeksy dla zrzutów tabel
--

--

-- Indexes for table `admins`
--

ALTER TABLE
    `admins` ADD PRIMARY KEY(`id`);
    --

    -- Indexes for table `consumer`
    --

ALTER TABLE
    `consumer` ADD PRIMARY KEY(`id`);
    --

    -- AUTO_INCREMENT for dumped tables
    --

    --

    -- AUTO_INCREMENT dla tabeli `admins`
    --

ALTER TABLE
    `admins` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;
    --

    -- AUTO_INCREMENT dla tabeli `consumer`
    --

ALTER TABLE
    `consumer` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;
    /*!40101
SET
    CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
    /*!40101
SET
    CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
    /*!40101
SET
    COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;