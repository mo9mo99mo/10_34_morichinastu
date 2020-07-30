-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 30 日 16:41
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_d06_34`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tag_table`
--

CREATE TABLE `tag_table` (
  `id` int(12) NOT NULL,
  `tag_id` int(128) NOT NULL,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `tag_table`
--

INSERT INTO `tag_table` (`id`, `tag_id`, `tag_name`, `created_at`, `updated_at`) VALUES
(1, 1, '植物', '2020-07-30 20:16:51', '2020-07-30 20:16:51'),
(2, 2, 'アート', '2020-07-30 20:19:07', '2020-07-30 20:19:07'),
(3, 3, '工芸', '2020-07-30 20:23:38', '2020-07-30 20:23:38'),
(4, 4, 'デザイン', '2020-07-30 21:03:41', '2020-07-30 21:03:41'),
(5, 5, 'その他', '2020-07-30 21:03:41', '2020-07-30 21:03:41');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `tag_table`
--
ALTER TABLE `tag_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `tag_table`
--
ALTER TABLE `tag_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
