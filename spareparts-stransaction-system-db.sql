-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2021 at 08:36 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spareparts-stransaction-system-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dropdown_menu`
--

CREATE TABLE `dropdown_menu` (
  `id` int(11) NOT NULL,
  `sub_menu_id` int(5) NOT NULL,
  `dropdown_nama` varchar(125) NOT NULL,
  `url` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dropdown_menu`
--

INSERT INTO `dropdown_menu` (`id`, `sub_menu_id`, `dropdown_nama`, `url`) VALUES
(1, 165, 'Tambah Service', 'service/'),
(2, 165, 'Data Mobil', 'service/data_mobil'),
(3, 165, 'Data Pelanggan', 'service/data_pelanggan'),
(6, 10, 'User Access Menu', 'menu/dropdown_access_menu'),
(8, 10, 'User Menu', 'menu/dropdown_userMenu'),
(10, 10, 'Sub Menu', 'menu/dropdown_subMenu'),
(108, 1, 'test', 'test'),
(188, 168, 'ilham', 'ilham'),
(190, 170, 'ilham', 'ilham');

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `id` int(11) NOT NULL,
  `level` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id`, `level`) VALUES
(1, 'Developer'),
(2, 'Admin Service'),
(3, 'Admin Sparepart');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_mobil`
--

CREATE TABLE `tb_data_mobil` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `jenis_mobil` varchar(125) NOT NULL,
  `tipe_mobil` varchar(125) NOT NULL,
  `merek_mobil` varchar(125) NOT NULL,
  `nomor_rangka` varchar(50) NOT NULL,
  `nomor_mesin` varchar(50) NOT NULL,
  `nomor_polisi` varchar(50) NOT NULL,
  `warna_mobil` varchar(50) NOT NULL,
  `tahun_mobil` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_mobil`
--

INSERT INTO `tb_data_mobil` (`id`, `id_pelanggan`, `jenis_mobil`, `tipe_mobil`, `merek_mobil`, `nomor_rangka`, `nomor_mesin`, `nomor_polisi`, `warna_mobil`, `tahun_mobil`) VALUES
(76, 149, 'Mobil SUV', 'Mazda KR2001', 'Honda', 'MHYKZE81SEJ111222', 'MHYKZE81SEJ111221', 'H 6011 JQ', 'Hitam', '2019'),
(77, 150, 'Mobil SUV R7', 'Mazda KR2001', 'Honda', 'MHYKZE81SEJ111221', 'MHYKZE81SEJ1C1221', 'H 6011 JU', 'Merah', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_service`
--

CREATE TABLE `tb_data_service` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `kd_service` varchar(15) NOT NULL,
  `jenis_service` varchar(50) NOT NULL,
  `harga` int(15) NOT NULL,
  `sub_service` varchar(50) NOT NULL,
  `service_lain` text NOT NULL,
  `tgl_service` varchar(15) NOT NULL,
  `info_lain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_service`
--

INSERT INTO `tb_data_service` (`id`, `id_pelanggan`, `kd_service`, `jenis_service`, `harga`, `sub_service`, `service_lain`, `tgl_service`, `info_lain`) VALUES
(109, 149, 'SRV001', 'Service Tune Up', 150000, '', '', '2021-11-28', ''),
(110, 150, 'SRV002', 'Service Berkala', 1500000, 'Service Berkala 1.000 km', '', '2021-12-31', 'Info lain');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_service`
--

CREATE TABLE `tb_jenis_service` (
  `id` int(11) NOT NULL,
  `nama_service` varchar(100) NOT NULL,
  `harga` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis_service`
--

INSERT INTO `tb_jenis_service` (`id`, `nama_service`, `harga`) VALUES
(4, 'Service Berkala', '0'),
(5, 'Service Tune Up', '150000'),
(6, 'Service Lain-lain', '140000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `nama_pelanggan`, `no_tlp`, `nik`, `alamat`) VALUES
(149, 'Ilham Dhiya Ulhaq', '085803135909', '3374131705980005', 'Jl. Karang Jangkang RT 04 / 04'),
(150, 'Frido', '085803135999', '3374131705980004', 'Jl. Majapahit 8');

-- --------------------------------------------------------

--
-- Table structure for table `tb_posisi`
--

CREATE TABLE `tb_posisi` (
  `id` int(11) NOT NULL,
  `nama_posisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_posisi`
--

INSERT INTO `tb_posisi` (`id`, `nama_posisi`) VALUES
(1, 'Developer'),
(2, 'Service Adficer'),
(3, 'Sparepart Service');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spareparts`
--

CREATE TABLE `tb_spareparts` (
  `id` int(11) NOT NULL,
  `kd_spareparts` varchar(15) NOT NULL,
  `nama_spareparts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_spareparts`
--

INSERT INTO `tb_spareparts` (`id`, `kd_spareparts`, `nama_spareparts`) VALUES
(1, 'SPR0001', 'Oli'),
(2, 'SPR0002', 'Filter Udara'),
(3, 'SPR0003', 'Busi Mobil'),
(4, 'SPR0004', 'Aki');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spareparts_service`
--

CREATE TABLE `tb_spareparts_service` (
  `id` int(11) NOT NULL,
  `id_service` int(5) NOT NULL,
  `id_mobil` int(5) NOT NULL,
  `id_spareparts` int(5) NOT NULL,
  `id_sub_spareparts` int(5) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `id_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_spareparts_service`
--

INSERT INTO `tb_spareparts_service` (`id`, `id_service`, `id_mobil`, `id_spareparts`, `id_sub_spareparts`, `id_pelanggan`, `id_status`) VALUES
(220, 109, 76, 1, 1, 149, 2),
(221, 109, 76, 2, 22, 149, 2),
(222, 109, 76, 3, 29, 149, 2),
(223, 109, 76, 4, 41, 149, 2),
(260, 110, 77, 1, 3, 150, 1),
(261, 109, 76, 4, 41, 149, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_service`
--

CREATE TABLE `tb_status_service` (
  `id` int(11) NOT NULL,
  `kd_status` int(1) NOT NULL,
  `status_service` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status_service`
--

INSERT INTO `tb_status_service` (`id`, `kd_status`, `status_service`) VALUES
(1, 0, 'Belum Service'),
(2, 1, 'Sudah Service'),
(3, 2, 'Proses Service');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_jenis_service`
--

CREATE TABLE `tb_sub_jenis_service` (
  `id` int(11) NOT NULL,
  `id_jenis_service` int(5) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `nama_sub_service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sub_jenis_service`
--

INSERT INTO `tb_sub_jenis_service` (`id`, `id_jenis_service`, `harga`, `nama_sub_service`) VALUES
(1, 4, '1500000', 'Service Berkala 1.000 km'),
(2, 4, '250000', 'Service Berkala 5.000 km'),
(3, 4, '400000', 'Service Berkala 10.000 km'),
(4, 4, '550000', 'Service Berkala 15.000 km'),
(5, 4, '600000', 'Service Berkala 20.000 km'),
(6, 4, '900000', 'Service Berkala > 20.000 km');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_spareparts`
--

CREATE TABLE `tb_sub_spareparts` (
  `id` int(11) NOT NULL,
  `id_spareparts` int(5) NOT NULL,
  `nama_spareparts` varchar(50) NOT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sub_spareparts`
--

INSERT INTO `tb_sub_spareparts` (`id`, `id_spareparts`, `nama_spareparts`, `harga`) VALUES
(1, 1, 'PERTAMINA Fastron (1L)', 52000),
(2, 1, 'PERTAMINA Fastron (1L)', 45500),
(3, 1, 'PERTAMINA Mesran prima', 33000),
(4, 1, 'PERTAMINA Prima XP (1L)', 40000),
(5, 1, 'PERTAMINA Prima (1L)', 35000),
(6, 1, 'PETRONAS Mach 20W-50', 37000),
(7, 1, 'PETRONAS Mach 5 SL 20W-50', 30000),
(8, 1, 'PETRONAS Syntium 800 15W-50 SL', 48000),
(9, 1, 'CASTROL Edge 5W-40', 128000),
(10, 1, 'CASTROL Magnatec 10W-40', 51500),
(11, 1, 'REPSOL Competition 5W-40', 148000),
(12, 1, 'REPSOL Elite injection 10W-40', 59000),
(13, 1, 'REPSOL Elite Multivalvulas 10W-40', 72000),
(14, 1, 'SHELL Ultra 5W-40', 149000),
(17, 1, 'SHELL Plus 10W-40', 59000),
(18, 1, 'SHELL Helix HX-7 (10W-40 API SN/CF)', 76000),
(19, 1, 'MOTUL 6100 Synergie 5W-40', 146000),
(20, 1, 'MOTUL Multi Power Plus 10W-40', 70000),
(22, 2, 'Filter 2', 200000),
(23, 2, 'Filter 3', 130000),
(24, 2, 'Filter 4', 250000),
(25, 2, 'Filter 5', 450000),
(26, 2, 'Filter 6', 320000),
(27, 2, 'Filter 7', 250000),
(28, 2, 'Filter 89', 420000),
(29, 3, 'Busi 9', 45000),
(30, 3, 'Busi 1', 200000),
(31, 3, 'Busi 2', 140000),
(32, 3, 'Busi 3', 75000),
(33, 3, 'Busi 4', 65000),
(34, 3, 'Busi 5', 50000),
(35, 3, 'Busi 6', 67000),
(36, 3, 'Busi 7', 78000),
(41, 4, 'Aki 3', 450000),
(42, 4, 'Aki 4', 700000),
(43, 4, 'Aki 5', 450000),
(44, 4, 'Aki 6', 320000),
(52, 4, 'Aki 5', 450000),
(53, 4, 'Aki 5', 450000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_access_menu`
--

CREATE TABLE `tb_user_access_menu` (
  `id` int(11) NOT NULL,
  `level_id` int(1) NOT NULL,
  `menu_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_access_menu`
--

INSERT INTO `tb_user_access_menu` (`id`, `level_id`, `menu_id`) VALUES
(1, 1, 2),
(33, 2, 1),
(61, 2, 60),
(66, 1, 5),
(72, 1, 1),
(74, 1, 64),
(78, 3, 1),
(79, 3, 64),
(80, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_menu`
--

CREATE TABLE `tb_user_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(115) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_menu`
--

INSERT INTO `tb_user_menu` (`id`, `nama_menu`) VALUES
(1, 'Home'),
(2, 'Service'),
(5, 'Setting'),
(64, 'Spareparts');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_sub_menu`
--

CREATE TABLE `tb_user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(1) NOT NULL,
  `sub_menu` varchar(125) NOT NULL,
  `url` varchar(125) NOT NULL,
  `icon` varchar(125) NOT NULL,
  `is_active` int(1) NOT NULL,
  `dropdown` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_sub_menu`
--

INSERT INTO `tb_user_sub_menu` (`id`, `menu_id`, `sub_menu`, `url`, `icon`, `is_active`, `dropdown`) VALUES
(10, 5, 'Menu Management', '#', 'fa fa-th-large', 1, 1),
(165, 2, 'Data Service', 'service/', 'fa fa-tools', 1, 0),
(166, 1, 'Dashboard', 'menu', 'fas fa-tachometer-alt', 1, 0),
(173, 2, 'Data Pelanggan', 'service/data_pelanggan', 'fas fa-users', 1, 0),
(177, 64, 'Jenis Sparepart', 'spareparts/', 'fas fa-cogs', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `id_posisi` int(5) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_pegawai`, `id_posisi`, `gambar`, `username`, `password`, `level_id`, `is_active`, `date_created`) VALUES
(1, 'Ilham Dhiya Ulhaq', 1, 'default.png', 'ilhamdhiya01', '$2y$10$p1t157Ak33H6VuPBCZEeoO1z6vgfxKzFMsgBQy0QkkEzN2QnGMzWu', 1, 1, 1629640402),
(39, 'Annisa Wahyu Hidayah', 2, 'default.png', 'annisawahyu01', '$2y$10$bVRWQZtXYhuB1nAT5bCs9OKh8KwC6Qdyeh4j29EDKWjPLJcrHJPDi', 2, 1, 1637395503),
(40, 'Frido Andre', 3, 'default.png', 'frido01', '$2y$10$3bUkFfut3a98e26bmAhZBuvJ9Vg6GFL.4KwYlu4//h/Q9e0gYrjHC', 3, 1, 1637679900);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dropdown_menu`
--
ALTER TABLE `dropdown_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_mobil`
--
ALTER TABLE `tb_data_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data_service`
--
ALTER TABLE `tb_data_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jenis_service`
--
ALTER TABLE `tb_jenis_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_spareparts`
--
ALTER TABLE `tb_spareparts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_spareparts_service`
--
ALTER TABLE `tb_spareparts_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_status_service`
--
ALTER TABLE `tb_status_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_jenis_service`
--
ALTER TABLE `tb_sub_jenis_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_spareparts`
--
ALTER TABLE `tb_sub_spareparts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_access_menu`
--
ALTER TABLE `tb_user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dropdown_menu`
--
ALTER TABLE `dropdown_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_data_mobil`
--
ALTER TABLE `tb_data_mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tb_data_service`
--
ALTER TABLE `tb_data_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tb_jenis_service`
--
ALTER TABLE `tb_jenis_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_spareparts`
--
ALTER TABLE `tb_spareparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_spareparts_service`
--
ALTER TABLE `tb_spareparts_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `tb_status_service`
--
ALTER TABLE `tb_status_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sub_jenis_service`
--
ALTER TABLE `tb_sub_jenis_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_sub_spareparts`
--
ALTER TABLE `tb_sub_spareparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tb_user_access_menu`
--
ALTER TABLE `tb_user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
