-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2019-08-26 14:47:17
-- 伺服器版本： 5.5.65-MariaDB
-- PHP 版本： 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `memberbooks`
--

-- --------------------------------------------------------

--
-- 資料表結構 `memberbooks`
--

CREATE TABLE `memberbooks` (
  `sid` tinyint(4) NOT NULL,
  `會員編號` varchar(255) NOT NULL,
  `ISBN碼` bigint(11) NOT NULL,
  `書名` varchar(255) NOT NULL,
  `類別` varchar(255) NOT NULL,
  `作者` varchar(255) NOT NULL,
  `出版社` varchar(255) NOT NULL,
  `版次` tinyint(4) NOT NULL,
  `定價` varchar(255) NOT NULL,
  `保存狀況` varchar(255) NOT NULL,
  `備註` varchar(255) NOT NULL,
  `頁數` varchar(255) NOT NULL,
  `上架日期` date NOT NULL,
  `出版日期` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `memberbooks`
--

INSERT INTO `memberbooks` (`sid`, `會員編號`, `ISBN碼`, `書名`, `類別`, `作者`, `出版社`, `版次`, `定價`, `保存狀況`, `備註`, `頁數`, `上架日期`, `出版日期`) VALUES
(1, 'A123456', 9789861371955, '被討厭的勇氣：自我啟發之父「阿德勒」的教導', ' 西方哲學', '岸見一郎、古賀史健', '究竟出版', 2, '300', '近全新', '近全新', '304頁\r\n', '2019-08-20', '2014-10-30'),
(2, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(3, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(4, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(5, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(6, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(7, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(8, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(9, 'A123456', 9789861336312, '斜槓青年：全球職涯新趨勢，迎接更有價值的多職人生（二手書）', ' 成功學', '岸見一郎、古賀史健', '圓神出版社有限公司', 2, '280', '良好', '無畫線註記', '256頁', '2017-09-01', '2014-10-30'),
(10, 'B123456789 1', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(11, 'B123456789 2', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(12, 'B123456789 3', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(13, 'B123456789 4', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(14, 'B123456789 5', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(15, 'B123456789 6', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(16, 'B123456789 7', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(17, 'B123456789 8', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(18, 'B123456789 9', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(19, 'B123456789 10', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(20, 'B123456789 11', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(21, 'B123456789 12', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(22, 'B123456789 13', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(23, 'B123456789 14', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(24, 'B123456789 15', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(25, 'B123456789 16', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(26, 'B123456789 17', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(27, 'B123456789 18', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(28, 'B123456789 19', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(29, 'B123456789 20', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(30, 'B123456789 21', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(31, 'B123456789 22', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(32, 'B123456789 23', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(33, 'B123456789 24', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(34, 'B123456789 25', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(35, 'B123456789 26', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(36, 'B123456789 27', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(37, 'B123456789 28', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(38, 'B123456789 29', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(39, 'B123456789 30', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(40, 'B123456789 31', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(41, 'B123456789 32', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(42, 'B123456789 33', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(43, 'B123456789 34', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(44, 'B123456789 35', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(45, 'B123456789 36', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(46, 'B123456789 37', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(47, 'B123456789 38', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(48, 'B123456789 39', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(49, 'B123456789 40', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(50, 'B123456789 41', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(51, 'B123456789 42', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(52, 'B123456789 43', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(53, 'B123456789 44', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(54, 'B123456789 45', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(55, 'B123456789 46', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(56, 'B123456789 47', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(57, 'B123456789 48', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(58, 'B123456789 49', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(59, 'B123456789 50', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(60, 'B123456789 51', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(61, 'B123456789 52', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(62, 'B123456789 53', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(63, 'B123456789 54', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(64, 'B123456789 55', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(65, 'B123456789 56', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(66, 'B123456789 57', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(67, 'B123456789 58', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(68, 'B123456789 59', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(69, 'B123456789 60', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(70, 'B123456789 61', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(71, 'B123456789 62', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(72, 'B123456789 63', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(73, 'B123456789 64', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(74, 'B123456789 65', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(75, 'B123456789 66', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(76, 'B123456789 67', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(77, 'B123456789 68', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(78, 'B123456789 69', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(79, 'B123456789 70', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(80, 'B123456789 71', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(81, 'B123456789 72', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(82, 'B123456789 73', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(83, 'B123456789 74', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(84, 'B123456789 75', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(85, 'B123456789 76', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(86, 'B123456789 77', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(87, 'B123456789 78', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(88, 'B123456789 79', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(89, 'B123456789 80', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(90, 'B123456789 81', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(91, 'B123456789 82', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(92, 'B123456789 83', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(93, 'B123456789 84', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(94, 'B123456789 85', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(95, 'B123456789 86', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(96, 'B123456789 87', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(97, 'B123456789 88', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(98, 'B123456789 89', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(99, 'B123456789 90', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(100, 'B123456789 91', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(101, 'B123456789 92', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(102, 'B123456789 93', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(103, 'B123456789 94', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(104, 'B123456789 95', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(105, 'B123456789 96', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(106, 'B123456789 97', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(107, 'B123456789 98', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01'),
(108, 'B123456789 99', 9789861371955, '刻意練習：原創者全面解析，比天賦更關鍵的學習法', '心理勵志', '安德斯‧艾瑞克森（Anders Ericsson）、羅伯特‧普爾（Robert Pool）', '方智出版', 3, 'NT$320', '良好', '無畫線註記', '320頁', '2019-08-24', '2017-06-01');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `memberbooks`
--
ALTER TABLE `memberbooks`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberbooks`
--
ALTER TABLE `memberbooks`
  MODIFY `sid` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
