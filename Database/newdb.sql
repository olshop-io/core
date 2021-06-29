-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2021 at 09:41 AM
-- Server version: 5.5.60-0+deb8u1
-- PHP Version: 5.6.40-0+deb8u8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `waboot`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`id` int(11) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','2','3') NOT NULL COMMENT '1 = SUPERADMIN 2 = ADMIN 3= CS'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `level`) VALUES
(1, 'administrator', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `autoreply`
--

CREATE TABLE IF NOT EXISTS `autoreply` (
`id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `case_sensitive` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autoreply`
--

INSERT INTO `autoreply` (`id`, `keyword`, `response`, `case_sensitive`) VALUES
(4, 'ddddd', 'ddddd', '0');

-- --------------------------------------------------------

--
-- Table structure for table `blast`
--

CREATE TABLE IF NOT EXISTS `blast` (
`id` int(11) NOT NULL,
  `nomor` text NOT NULL,
  `pesan` text NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `jadwal` datetime NOT NULL,
  `make_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 'https://wa.starseller.com/', 1, '2021-06-15 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `google_form`
--

CREATE TABLE IF NOT EXISTS `google_form` (
`id` int(11) NOT NULL,
  `form_id` varchar(255) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `google_form_pesan`
--

CREATE TABLE IF NOT EXISTS `google_form_pesan` (
`id` int(11) NOT NULL,
  `id_pesan` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE IF NOT EXISTS `link` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `domain_id` int(11) unsigned NOT NULL,
  `chat_content` text NOT NULL,
  `status` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `pixel_id` varchar(200) NOT NULL,
  `pixel_event_id` int(11) unsigned NOT NULL,
  `pixel_event_data` text NOT NULL,
  `gtm_id` varchar(250) NOT NULL,
  `loading` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `user_id`, `title`, `slug`, `domain_id`, `chat_content`, `status`, `clicks`, `pixel_id`, `pixel_event_id`, `pixel_event_data`, `gtm_id`, `loading`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 1, 'cccccccccc', 'cccccccccc', 21, 'xxxxxxx', 1, 0, 'ccccc', 1, '', 'ccc', 3, '2021-06-26 07:16:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `link_detail`
--

CREATE TABLE IF NOT EXISTS `link_detail` (
`id` int(11) unsigned NOT NULL,
  `link_id` int(11) unsigned NOT NULL,
  `operator_id` int(11) unsigned NOT NULL,
  `op_qty` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_detail`
--

INSERT INTO `link_detail` (`id`, `link_id`, `operator_id`, `op_qty`) VALUES
(47, 21, 61, 1),
(48, 21, 60, 4);

-- --------------------------------------------------------

--
-- Table structure for table `nomor`
--

CREATE TABLE IF NOT EXISTS `nomor` (
`id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `make_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomor`
--

INSERT INTO `nomor` (`id`, `nama`, `nomor`, `pesan`, `make_by`) VALUES
(5, 'ttttttttttt', '989898989', 'xxxxxxxxxxxx', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE IF NOT EXISTS `operator` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(256) NOT NULL,
  `number` varchar(50) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `user_id`, `name`, `number`, `clicks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(60, 1, 'rizal faozi', '089545545554', 0, NULL, NULL, NULL),
(61, 1, 'mamat', '7657567567', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
`id` int(11) NOT NULL,
  `chunk` int(11) NOT NULL,
  `wa_gateway_url` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL DEFAULT '310ea2abbaafe1844ac63f57ff20860b78e77c40',
  `callback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `chunk`, `wa_gateway_url`, `nomor`, `api_key`, `callback`) VALUES
(1, 100, 'http://localhost:3000/', '085726242220', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
`id` int(11) NOT NULL,
  `id_blast` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `status` enum('MENUNGGU JADWAL','GAGAL','TERKIRIM') NOT NULL DEFAULT 'MENUNGGU JADWAL',
  `jadwal` datetime NOT NULL,
  `tiap_bulan` enum('0','1') NOT NULL DEFAULT '0',
  `last_month` varchar(255) DEFAULT NULL,
  `make_by` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pixel_event`
--

CREATE TABLE IF NOT EXISTS `pixel_event` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pixel_event`
--

INSERT INTO `pixel_event` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ViewContent', '2021-06-25 23:51:44', NULL, NULL),
(2, 'AddToCart', '2021-06-25 23:51:44', NULL, NULL),
(3, 'AddToWishlist', '2021-06-25 23:51:44', NULL, NULL),
(4, 'InitiateCheckout', '2021-06-25 23:51:44', NULL, NULL),
(5, 'AddPaymentInfo', '2021-06-25 23:51:44', NULL, NULL),
(6, 'Purchase', '2021-06-25 23:51:44', NULL, NULL),
(7, 'Lead', '2021-06-25 23:51:44', NULL, NULL),
(8, 'CompleteRegistration', '2021-06-25 23:51:44', NULL, NULL),
(9, 'Custom', '2021-06-25 23:51:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receive_chat`
--

CREATE TABLE IF NOT EXISTS `receive_chat` (
`id` int(11) NOT NULL,
  `id_pesan` varchar(200) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `from_me` enum('0','1') NOT NULL DEFAULT '0',
  `nomor_saya` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receive_chat`
--

INSERT INTO `receive_chat` (`id`, `id_pesan`, `nomor`, `pesan`, `from_me`, `nomor_saya`, `tanggal`) VALUES
(1, '9061', '6282298859671', 'Index.js arahkan ke server xampp semua', '0', '089522811620', '2021-06-20 17:30:29'),
(2, '9061', '6282298859671', 'Iya btul', '0', '089522811620', '2021-06-20 17:31:53'),
(3, '9061', '6282298859671', 'Ss ya kalau sudh', '0', '089522811620', '2021-06-20 17:31:56'),
(4, '', '6282298859671', 'oya mas ', '1', '089522811620', '2021-06-20 17:32:26'),
(5, '2194', '6282220090060', 'Oke', '0', '089522811620', '2021-06-23 21:03:15'),
(6, '2194', '6282220090060', 'Vxndn', '0', '089522811620', '2021-06-23 21:03:21'),
(7, '2194', '6282220090060', 'Bdndnd', '0', '089522811620', '2021-06-23 21:03:22'),
(8, '2194', '6282220090060', 'Bfncndnd', '0', '089522811620', '2021-06-23 21:03:23'),
(9, '2194', '6282220090060', 'Bxnd', '0', '089522811620', '2021-06-23 21:03:24'),
(10, '2194', '6282220090060', 'Bfjdnd', '0', '089522811620', '2021-06-23 21:03:25'),
(11, '2194', '6282220090060', 'Hfjdnhfhdhd', '0', '089522811620', '2021-06-23 21:03:30'),
(12, '', '6282220090060', 'sdasdasd', '1', '089522811620', '2021-06-23 21:03:34'),
(13, '', '6282220090060', '', '1', '089522811620', '2021-06-23 21:03:34'),
(14, '2194', '6282220090060', 'Ok', '0', '089522811620', '2021-06-23 21:26:27'),
(15, '2194', '6282220090060', 'Bdjdg', '0', '089522811620', '2021-06-23 21:26:36'),
(16, '2194', '6282220090060', 'Gdhdh', '0', '089522811620', '2021-06-23 21:26:41'),
(17, '2194', '6282220090060', 'Hfur7fbd', '0', '089522811620', '2021-06-23 21:26:43'),
(18, '1684', '628112551105', 'Udah jam setengah 10', '0', '089522811620', '2021-06-23 21:29:47'),
(19, '1684', '628112551105', 'Tp blm sampe rumah', '0', '089522811620', '2021-06-23 21:29:50'),
(20, '1684', '628112551105', 'Bohong yaa', '0', '089522811620', '2021-06-23 21:29:56'),
(21, '7919', '6289672111226', 'Aq wes wa ema', '0', '089522811620', '2021-06-26 11:33:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoreply`
--
ALTER TABLE `autoreply`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blast`
--
ALTER TABLE `blast`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `google_form`
--
ALTER TABLE `google_form`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_form_pesan`
--
ALTER TABLE `google_form_pesan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`domain_id`), ADD KEY `pixel_event_id` (`pixel_event_id`);

--
-- Indexes for table `link_detail`
--
ALTER TABLE `link_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `link_id` (`link_id`,`operator_id`), ADD KEY `operator_id` (`operator_id`);

--
-- Indexes for table `nomor`
--
ALTER TABLE `nomor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pixel_event`
--
ALTER TABLE `pixel_event`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_chat`
--
ALTER TABLE `receive_chat`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `autoreply`
--
ALTER TABLE `autoreply`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blast`
--
ALTER TABLE `blast`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `google_form`
--
ALTER TABLE `google_form`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `google_form_pesan`
--
ALTER TABLE `google_form_pesan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `link_detail`
--
ALTER TABLE `link_detail`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `nomor`
--
ALTER TABLE `nomor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pixel_event`
--
ALTER TABLE `pixel_event`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `receive_chat`
--
ALTER TABLE `receive_chat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `domain`
--
ALTER TABLE `domain`
ADD CONSTRAINT `domain_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link`
--
ALTER TABLE `link`
ADD CONSTRAINT `link_pixel_event_id_foreign` FOREIGN KEY (`pixel_event_id`) REFERENCES `pixel_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `link_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `link_detail`
--
ALTER TABLE `link_detail`
ADD CONSTRAINT ` link_detail_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT ` link_detail_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
ADD CONSTRAINT `operator_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
