-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2019 年 2 朁E28 日 14:06
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_f02_db31`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `php02_table`
--

CREATE TABLE IF NOT EXISTS `php02_table` (
`id` int(12) NOT NULL,
  `task` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `php02_table`
--

INSERT INTO `php02_table` (`id`, `task`, `deadline`, `comment`, `indate`) VALUES
(1, 'test2', '2019-02-14', 'test12', '2019-02-14 12:44:21'),
(2, 'test', '2019-12-31', 'tee', '2019-02-16 14:47:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `php02_table`
--
ALTER TABLE `php02_table`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `php02_table`
--
ALTER TABLE `php02_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
