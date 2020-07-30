-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 30 日 16:40
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
-- テーブルの構造 `posts_table2`
--

CREATE TABLE `posts_table2` (
  `id` int(12) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hizuke` date NOT NULL,
  `img_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `honbun` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `posts_table2`
--

INSERT INTO `posts_table2` (`id`, `title`, `hizuke`, `img_file`, `honbun`, `tag_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, '種まき', '2020-04-19', 'uploads/20200730152333DSCF7953_200419.jpg', '種をまいた', 'Array', 1, '2020-07-30 22:23:33', '2020-07-30 22:23:33'),
(3, '発芽：ベニバナ', '2020-04-29', 'uploads/20200730152715DSCF7971_200429.jpg', 'ベニバナが発芽。藍、ムラサキの中で一番早い', 'Array', 1, '2020-07-30 22:27:15', '2020-07-30 22:27:15'),
(4, '双葉：ベニバナ', '2020-04-30', 'uploads/20200730153339DSCF7978_200430.jpg', 'ベニバナの双葉', 'Array', 1, '2020-07-30 22:33:39', '2020-07-30 22:33:39'),
(5, '発芽：藍（アイ）', '2020-04-30', 'uploads/20200730154240DSCF7982_200430.jpg', '藍（アイ）が発芽した', 'Array', 1, '2020-07-30 22:42:40', '2020-07-30 22:42:40'),
(6, '発芽：藍（2）', '2020-04-30', 'uploads/20200730154444DSCF7984_200430.jpg', '藍が発芽した', 'Array', 1, '2020-07-30 22:44:44', '2020-07-30 22:44:44'),
(7, '発芽（2）：藍', '2020-05-01', 'uploads/20200730154622DSCF7985_200501.jpg', '1日で一気に発芽', 'Array', 1, '2020-07-30 22:46:22', '2020-07-30 22:46:22'),
(8, 'バニバナ', '2020-07-02', 'uploads/20200730160552DSCF7990_200502.jpg', 'ニョキニョキ', 'Array', 1, '2020-07-30 23:05:52', '2020-07-30 23:05:52'),
(9, '藍', '2020-05-02', 'uploads/20200730160741DSCF7992_200502.jpg', 'いっぱい出てきた', 'Array', 1, '2020-07-30 23:07:41', '2020-07-30 23:07:41'),
(10, '型紙作り：1', '2020-07-01', 'uploads/20200730161646IMG_0123.JPG', 'カッターで型紙を作っていく', 'Array', 5, '2020-07-30 23:16:46', '2020-07-30 23:16:46'),
(11, '型紙作り：2', '2020-07-04', 'uploads/20200730161810IMG_0256.JPG', '型紙が完成', 'Array', 5, '2020-07-30 23:18:10', '2020-07-30 23:18:10'),
(12, '型紙作り：3', '2020-07-05', 'uploads/20200730161934IMG_0312.JPG', '型紙を補強するため、紗張りをする', 'Array', 5, '2020-07-30 23:19:34', '2020-07-30 23:19:34'),
(13, '型紙作り：4', '2020-07-06', 'uploads/20200730162122IMG_0314.JPG', '紗をカシューで型紙に接着する', 'Array', 5, '2020-07-30 23:21:22', '2020-07-30 23:21:22'),
(14, '型紙作り：5', '2020-07-07', 'uploads/20200730162239IMG_0318.JPG', '余分なカシューを落とし、乾燥する', 'Array', 5, '2020-07-30 23:22:39', '2020-07-30 23:22:39'),
(15, '染色', '2020-07-08', 'uploads/20200730162454IMG_0334.JPG', '布に型紙を固定し染色する', 'Array', 5, '2020-07-30 23:24:54', '2020-07-30 23:24:54'),
(16, '乾燥', '2020-07-14', 'uploads/20200730162656IMG_0348.JPG', '染料が完全に乾くまでよく乾燥させる', 'Array', 5, '2020-07-30 23:26:56', '2020-07-30 23:26:56'),
(17, '定着', '2020-07-18', 'uploads/20200730162803IMG_0350.JPG', '定着液で染料を定着させる', 'Array', 5, '2020-07-30 23:28:03', '2020-07-30 23:28:03'),
(18, '水洗', '2020-07-19', 'uploads/20200730162855IMG_0352.JPG', '定着液をしっかり洗い落とす', 'Array', 5, '2020-07-30 23:28:55', '2020-07-30 23:28:55'),
(19, '陰干し', '2020-07-20', 'uploads/20200730162945IMG_0358.JPG', '水洗した布を陰干しする', 'Array', 5, '2020-07-30 23:29:45', '2020-07-30 23:29:45');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `posts_table2`
--
ALTER TABLE `posts_table2`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `posts_table2`
--
ALTER TABLE `posts_table2`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
