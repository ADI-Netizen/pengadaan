-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2021 at 04:13 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengadaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `email`, `alamat`, `password`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Adi', 'adi@hotmail.com', 'Karawang', 'eyJpdiI6IllZYnlUeG9GRUI5RXprQmpkTGNFZkE9PSIsInZhbHVlIjoiV1wveThKR0lXSkM4SStwSnZ1dFhvdGc9PSIsIm1hYyI6IjdjZTg3YzgyZjAwMTJhMDMxNDNjMzUwZDNhY2U4MmMyNmEzZjhhNzliN2YyMzdmNjQxMzY5MzhkNGNmNDllODUifQ==', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hZG1pbiI6MX0.mYpEYXCRwvLJmMtR2spMfaHcudkuw3gP0JLTqMdN9hU', '2021-08-01 22:29:50', '2021-08-19 20:54:30'),
(2, 'Molly Guppy', 'mg@hammy.com', 'Earth', 'eyJpdiI6IlFWeGJYbUUxR1d2dzk2TFZPdUJad2c9PSIsInZhbHVlIjoianV4WGVZcTZPZWVrTVcrWk5nTkFxZz09IiwibWFjIjoiOWVlN2MxOGM4MjM0NWIzMDBjZTE2OTE3ZGEwZWNmOWU5ZTc4YTVlMjFiZGY2ZmU1MTM5YjhkZGU0ZTZjZmFhMiJ9', 1, 'keluar', '2021-08-03 00:26:15', '2021-08-05 03:04:00'),
(3, 'John Doe', 'jd@mail.co', 'Unknown', 'eyJpdiI6IkR4dEliK0hrMTNXWWVCQTBsNU1HakE9PSIsInZhbHVlIjoiTUt6VjF0RGVEWjBYZ25CZUU3ZXd3UT09IiwibWFjIjoiMDZjY2EwYWQyZGI0ZDQ4ZWUxODZmNTZlZjJjMGM3YTMwMTIyMWVkNDBhZjI4MmVhNGI0YjBlYjBmMDhlNjBiYyJ9', 1, 'keluar', '2021-08-03 00:27:48', '2021-08-05 03:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `laporan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `id_pengajuan`, `id_supplier`, `laporan`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 'public/laporan/hXkij0PSROP0VIR2H0AD87hbyU5o8SPt4fUgnZCD.pdf', '2021-08-19 00:24:01', '2021-08-19 00:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengadaan`
--

CREATE TABLE `tb_pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `nama_pengadaan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `anggaran` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengadaan`
--

INSERT INTO `tb_pengadaan` (`id_pengadaan`, `nama_pengadaan`, `deskripsi`, `gambar`, `anggaran`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Laptop ROG', 'https://rog.asus.com/id', 'public/gambar/lBdhXQJVaBoNUHT2HMwI1fnJ20WHzPjsO32GWjKj.jpg', 23000000, 1, '2021-08-08 21:07:09', '2021-08-08 21:36:21'),
(8, 'Testing', 'https://rog.asus.com/id', 'public/gambar/bIkdOOqBhRBizz6NorpzkpIywVLMErBmuwawcpvX.png', 100000000000, 1, '2021-08-15 22:00:08', '2021-08-15 22:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_pengadaan` int(11) NOT NULL,
  `anggaran` double NOT NULL,
  `proposal` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `id_supplier`, `id_pengadaan`, `anggaran`, `proposal`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 46000000, 'public/proposal/Ln3AKAm2Y6L23LTGXrDXGbq4fWPnHi7FLtfLdE1z.pdf', 2, '2021-08-15 23:08:17', '2021-08-15 23:09:22'),
(4, 1, 8, 100000000000, 'public/proposal/EwyjiiKO4oWkiimd59G6lcVjipVfHKVKTpXMYsDP.pdf', 2, '2021-08-15 23:08:32', '2021-08-15 23:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_badan` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama_badan`, `email`, `alamat`, `npwp`, `password`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'CV Black Panther', 'bp@rocketmail.com', 'Wakanda', '123451234123121', 'eyJpdiI6IkVsRUtaUmlaN1wvSzZrRHVxSlp0UmpBPT0iLCJ2YWx1ZSI6IjNYUmdWMlJRamxEYzVyTzIrdk01RlE9PSIsIm1hYyI6ImUzYmE4YzE5NmY3NzU0OGM1YTU5Y2I3NDMyMzgxMjFkYTcwODJkOWFmMmVmOGM0YWZhOGJhMmRkYmUzNDZmZjgifQ==', 1, 'keluar', '2021-08-20 02:52:25', '2021-08-19 19:52:25'),
(2, 'Kusmara Trans', 'cs@ktrans.com', 'Karawang', '13243546', 'eyJpdiI6ImlnU3g1QTh2RmYyOXplMXFkTkQ3QWc9PSIsInZhbHVlIjoiK0d3XC9XXC9XOUd4UjFESENnbFA5TWFRbzMrZ29aMmJrY2E1d1JGaEdvanpjPSIsIm1hYyI6IjEwNjExN2JmYjFjZjNiNjNlZjMzMDE0MmJjZWM0Nzc2ZTYwMDlkZWFmZDNiMmZhNzNiZGNmMmM1NzJhM2E2N2UifQ==', 1, 'keluar', '2021-08-18 06:29:02', '2021-08-17 23:27:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_pengadaan`
--
ALTER TABLE `tb_pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pengadaan`
--
ALTER TABLE `tb_pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
