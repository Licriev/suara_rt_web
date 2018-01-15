-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 Jan 2018 pada 10.48
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srt_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_emergency`
--

CREATE TABLE `srt_emergency` (
  `id_emergency` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `nama_kontak` varchar(100) NOT NULL,
  `telp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_emergency`
--

INSERT INTO `srt_emergency` (`id_emergency`, `id_group`, `nama_kontak`, `telp`) VALUES
(15, 7, 'polisi', '647364384738');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_group`
--

CREATE TABLE `srt_group` (
  `id_group` int(11) NOT NULL,
  `id_housing` int(11) NOT NULL,
  `rt` varchar(20) NOT NULL,
  `rw` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_group`
--

INSERT INTO `srt_group` (`id_group`, `id_housing`, `rt`, `rw`) VALUES
(4, 6, '1', '6'),
(5, 5, '05', '01'),
(6, 7, '06', '09'),
(7, 8, '09', '08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_housing`
--

CREATE TABLE `srt_housing` (
  `id_housing` int(11) NOT NULL,
  `nama_housing` varchar(100) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_housing`
--

INSERT INTO `srt_housing` (`id_housing`, `nama_housing`, `id_kota`, `kelurahan`, `kecamatan`) VALUES
(5, 'Komplek Coegs', 61, 'pondok kelapa', 'duren sawit 2'),
(6, 'abcd', 4, 'asdf', 'daf'),
(7, 'perumahan bintara jaya', 26, 'bintara jaya', 'bekasi barat'),
(8, 'kampung tambun', 103, 'tambun selatan', 'tambun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_icon`
--

CREATE TABLE `srt_icon` (
  `id_icon` int(11) NOT NULL,
  `nama_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_icon`
--

INSERT INTO `srt_icon` (`id_icon`, `nama_icon`) VALUES
(1, 'ic_add_a_photo_black_24dp'),
(2, 'ic_add_alert_black_24dp'),
(3, 'ic_add_black_24dp'),
(4, 'ic_add_to_photos_black_24dp'),
(5, 'ic_announcement_black_24dp'),
(6, 'ic_apps_black_24dp'),
(7, 'ic_assessment_black_24dp'),
(8, 'ic_assignment_black_24dp'),
(9, 'ic_attachment_black_24dp'),
(10, 'ic_backup_black_24dp'),
(11, 'ic_build_black_24dp'),
(12, 'ic_cached_black_24dp'),
(13, 'ic_call_black_24dp'),
(14, 'ic_chat_black_24dp'),
(15, 'ic_chevron_left_black_24dp'),
(16, 'ic_chevron_right_black_24dp'),
(17, 'ic_comment_black_24dp'),
(18, 'ic_create_black_24dp'),
(19, 'ic_crop_original_black_24dp'),
(20, 'ic_date_range_black_24dp'),
(21, 'ic_delete_black_24dp'),
(22, 'ic_equalizer_black_24dp'),
(23, 'ic_favorite_black_24dp'),
(24, 'ic_file_upload_black_24dp'),
(25, 'ic_forum_black_24dp'),
(26, 'ic_history_black_24dp'),
(27, 'ic_home_black_24dp'),
(28, 'ic_insert_emoticon_black_24dp'),
(29, 'ic_insert_invitation_black_24dp'),
(30, 'ic_library_add_black_24dp'),
(31, 'ic_list_black_24dp'),
(32, 'ic_loop_black_24dp'),
(33, 'ic_mail_outline_black_24dp'),
(34, 'ic_more_black_24dp'),
(35, 'ic_new_releases_black_24dp'),
(36, 'ic_notifications_black_24dp'),
(37, 'ic_perm_media_black_24dp'),
(38, 'ic_person_add_black_24dp'),
(39, 'ic_person_black_24dp'),
(40, 'ic_place_black_24dp'),
(41, 'ic_power_settings_new_black_24dp'),
(42, 'ic_question_answer_black_24dp'),
(43, 'ic_record_voice_over_black_24dp'),
(44, 'ic_remove_red_eye_black_24dp'),
(45, 'ic_reply_black_24dp'),
(46, 'ic_save_black_24dp'),
(47, 'ic_send_black_24dp'),
(48, 'ic_settings_black_24dp'),
(49, 'ic_share_black_24dp'),
(50, 'ic_thumb_up_black_24dp'),
(51, 'ic_touch_app_black_24dp'),
(52, 'ic_trending_up_black_24dp'),
(53, 'ic_tune_black_24dp'),
(54, 'ic_watch_later_black_24dp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_kota`
--

CREATE TABLE `srt_kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_kota`
--

INSERT INTO `srt_kota` (`id_kota`, `nama_kota`) VALUES
(1, '-'),
(4, 'Banda Aceh'),
(5, 'Langsa'),
(6, 'Lhokseumawe'),
(7, 'Meulaboh'),
(8, 'Sabang'),
(9, 'Subulussalam'),
(10, 'Denpasar'),
(11, 'Pangkalpinang'),
(12, 'Cilegon'),
(13, 'Serang'),
(14, 'Tanggerang'),
(15, 'Bengkulu'),
(16, 'Gorontalo'),
(17, 'Jakarta Barat'),
(18, 'Jakarta Pusat'),
(19, 'Jakarta Timur'),
(20, 'Jakarta Barat'),
(21, 'Jakarta Selatan'),
(22, 'Jakarta Utara'),
(23, 'Sungai Penuh'),
(24, 'Jambi'),
(25, 'Bandung'),
(26, 'Bekasi'),
(27, 'Bogor'),
(28, 'Cimahi'),
(29, 'Cirebon'),
(30, 'Depok'),
(31, 'Sukabumi'),
(32, 'Tasikmalaya'),
(33, 'Banjar'),
(34, 'Magelang'),
(35, 'Pekalongan'),
(36, 'Purwakerto'),
(37, 'Salatiga'),
(38, 'Semarang'),
(39, 'Surakarta'),
(40, 'Tegal'),
(41, 'Batu'),
(42, 'Blitar'),
(43, 'Kediri'),
(44, 'Madiun'),
(45, 'Malang'),
(46, 'Mojokerto'),
(47, 'Pasuruan'),
(48, 'Probolinggo'),
(49, 'Surabaya'),
(50, 'Pontianak'),
(51, 'Singkawang'),
(52, 'Banjarbaru'),
(53, 'Banjarmasin'),
(54, 'Palangkaraya'),
(55, 'Balikpapan'),
(56, 'Bontang'),
(57, 'Samarinda'),
(58, 'Tarakan'),
(59, 'Batam'),
(60, 'Tanjingpinang'),
(61, 'Bandar Lampung'),
(62, 'Metro'),
(63, 'Ternate'),
(64, 'Tidore'),
(65, 'Ambon'),
(66, 'Tual'),
(67, 'Bima'),
(68, 'Mataram'),
(69, 'Kupang'),
(70, 'Sorong'),
(71, 'Jayapura'),
(72, 'Dumai '),
(73, 'Pekanbaru'),
(74, 'Makassar'),
(75, 'Palopo'),
(76, 'Parepare'),
(77, 'Palu'),
(78, 'Bau-Bau'),
(79, 'Kendari'),
(80, 'Bitung'),
(81, 'Kotamabagu'),
(82, 'Manado'),
(83, 'Tomohon'),
(84, 'Bukittinggi'),
(85, 'Padang'),
(86, 'PadangPanjang'),
(87, 'Pariaman'),
(88, 'Payakumbuh'),
(89, 'Sawahlunto'),
(90, 'Solok'),
(91, 'Lubuklinggau'),
(92, 'Pagaralam'),
(93, 'Palembang'),
(94, 'Prabumulih'),
(95, 'Binjai'),
(96, 'Medan'),
(97, 'PadangSidempuan'),
(98, 'Pamatangsiantar'),
(99, 'Sibolga'),
(100, 'Tanjungbalai'),
(101, 'Tebing Tinggi'),
(102, 'Yogyakarta'),
(103, 'cikarang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_role`
--

CREATE TABLE `srt_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_role`
--

INSERT INTO `srt_role` (`id_role`, `nama_role`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_thread`
--

CREATE TABLE `srt_thread` (
  `id_thread` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal_post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_thread_category`
--

CREATE TABLE `srt_thread_category` (
  `id_category` int(11) NOT NULL,
  `nama_category` varchar(100) NOT NULL,
  `parent_category` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_thread_category`
--

INSERT INTO `srt_thread_category` (`id_category`, `nama_category`, `parent_category`) VALUES
(2, 'Ntaps', 0),
(5, 'Okeh 2', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_thread_content`
--

CREATE TABLE `srt_thread_content` (
  `id_content` int(11) NOT NULL,
  `id_thread` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `tanggal_post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_user`
--

CREATE TABLE `srt_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_user`
--

INSERT INTO `srt_user` (`id_user`, `email`, `password`, `role`, `status`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(2, 'abcdef@abcf.com', '1325e3ed00c720eede2bc28b2bccde8a', 3, 1),
(3, 'asdf@asdf.com', 'e3a8fcc1256cec013091e1f8df2666b8', 3, 1),
(4, 'xzc@adf.com', '49731767b1335bd3da9e41e65f9eff10', 3, 1),
(5, 'bsd@bsd.com', 'e97b90822404d6ee8027ee861a5dd6f6', 2, 1),
(6, 'qwe@qwe.com', '1a0a8f838aeda05690e0f7abd0bcb3c3', 3, 1),
(7, 'asdf@dfd.com', 'e97b90822404d6ee8027ee861a5dd6f6', 3, 1),
(8, 'admin@admin.com', '305d2ce34edb35cf98662111b4f70e7a', 2, 1),
(9, 'admin@admin.com', '305d2ce34edb35cf98662111b4f70e7a', 2, 1),
(10, 'admin@admin.com', '1325e3ed00c720eede2bc28b2bccde8a', 3, 1),
(11, 'admins@admin.com', '1325e3ed00c720eede2bc28b2bccde8a', 1, 1),
(12, 'rt@rt.com', '822050d9ae3c47f54bee71b85fce1487', 3, 1),
(13, 'warga@warga.com', '4e53deae478f358d5fcff9324d4012da', 3, 1),
(14, 'warga@warga.com', '4ab7d9d3a2a915753862aa89e6ff319c', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `srt_warga`
--

CREATE TABLE `srt_warga` (
  `id_warga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` tinyint(4) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `blok` varchar(50) NOT NULL,
  `no` varchar(50) NOT NULL,
  `id_group` int(11) NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `srt_warga`
--

INSERT INTO `srt_warga` (`id_warga`, `id_user`, `nama`, `jk`, `tanggal_lahir`, `blok`, `no`, `id_group`, `type`) VALUES
(1, 1, 'admin', 1, '2001-10-10', '0', '0', 4, 1),
(2, 2, 'abcdef', 0, '2001-10-10', 'E', '2', 4, 0),
(3, 3, 'asdf', 0, '0000-00-00', 'x', '2', 4, 1),
(4, 4, 'zcv', 1, '0000-00-00', 'F', '2', 4, 1),
(5, 5, 'bsdf', 1, '0000-00-00', 'J', '1', 4, 0),
(6, 6, 'qwe', 0, '0000-00-00', 'I', '8', 4, 1),
(7, 7, 'acbder', 0, '2010-10-12', 'K', '8', 4, 0),
(8, 8, 'asdf', 1, '2001-09-10', 'Y', '8', 4, 0),
(9, 9, 'asdf', 1, '2001-09-10', 'Y', '8', 4, 0),
(10, 10, 'sadfasd', 1, '2001-10-10', 'A', '4', 4, 0),
(11, 11, 'bro', 1, '2001-10-10', 'F', '8', 4, 0),
(12, 12, 'Pak RT', 1, '2002-10-10', 'U', 'D', 5, 1),
(13, 13, 'Warga', 1, '2001-10-20', 'I', '1', 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `srt_emergency`
--
ALTER TABLE `srt_emergency`
  ADD PRIMARY KEY (`id_emergency`);

--
-- Indexes for table `srt_group`
--
ALTER TABLE `srt_group`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `srt_housing`
--
ALTER TABLE `srt_housing`
  ADD PRIMARY KEY (`id_housing`);

--
-- Indexes for table `srt_icon`
--
ALTER TABLE `srt_icon`
  ADD PRIMARY KEY (`id_icon`);

--
-- Indexes for table `srt_kota`
--
ALTER TABLE `srt_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `srt_role`
--
ALTER TABLE `srt_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `srt_thread`
--
ALTER TABLE `srt_thread`
  ADD PRIMARY KEY (`id_thread`);

--
-- Indexes for table `srt_thread_category`
--
ALTER TABLE `srt_thread_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `srt_thread_content`
--
ALTER TABLE `srt_thread_content`
  ADD PRIMARY KEY (`id_content`);

--
-- Indexes for table `srt_user`
--
ALTER TABLE `srt_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `srt_warga`
--
ALTER TABLE `srt_warga`
  ADD PRIMARY KEY (`id_warga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `srt_emergency`
--
ALTER TABLE `srt_emergency`
  MODIFY `id_emergency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `srt_group`
--
ALTER TABLE `srt_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `srt_housing`
--
ALTER TABLE `srt_housing`
  MODIFY `id_housing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `srt_icon`
--
ALTER TABLE `srt_icon`
  MODIFY `id_icon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `srt_kota`
--
ALTER TABLE `srt_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `srt_role`
--
ALTER TABLE `srt_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `srt_thread`
--
ALTER TABLE `srt_thread`
  MODIFY `id_thread` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `srt_thread_category`
--
ALTER TABLE `srt_thread_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `srt_thread_content`
--
ALTER TABLE `srt_thread_content`
  MODIFY `id_content` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `srt_user`
--
ALTER TABLE `srt_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `srt_warga`
--
ALTER TABLE `srt_warga`
  MODIFY `id_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
