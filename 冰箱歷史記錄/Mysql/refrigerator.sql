-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-07-20 08:31:41
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `refrigerator`
--

-- --------------------------------------------------------

--
-- 資料表結構 `expired`
--

CREATE TABLE `expired` (
  `ID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Freeze` enum('冷藏','冷凍') COLLATE utf8_unicode_ci NOT NULL DEFAULT '冷藏',
  `Class` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Input_Date` date NOT NULL,
  `Vali_Date` date NOT NULL,
  `Delete_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `food_info`
--

CREATE TABLE `food_info` (
  `ID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Freeze` enum('冷藏','冷凍') COLLATE utf8_unicode_ci NOT NULL DEFAULT '冷藏',
  `Class` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Input_Date` date NOT NULL,
  `Vali_Date` date NOT NULL,
  `Img_Path` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `expired`
--
ALTER TABLE `expired`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `food_info`
--
ALTER TABLE `food_info`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food_info`
--
ALTER TABLE `food_info`
  MODIFY `ID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
