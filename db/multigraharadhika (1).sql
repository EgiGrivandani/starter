-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 08:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multigraharadhika`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_code`
--

CREATE TABLE `account_code` (
  `id_code` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `code` smallint(5) UNSIGNED NOT NULL,
  `name_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_code`
--

INSERT INTO `account_code` (`id_code`, `id_kategori`, `code`, `name_code`) VALUES
(1, 1, 401, 'Pendapatan Penjualan Produk'),
(2, 1, 402, 'Pendapatan Jasa'),
(3, 1, 403, 'Pendapatan Langganan (Subscription)'),
(4, 1, 404, 'Pendapatan Servis'),
(5, 1, 405, 'Pendapatan Penjualan Produk Tambahan'),
(6, 1, 411, 'Pendapatan Sewa Gedung'),
(7, 1, 412, 'Pendapatan Sewa Peralatan'),
(8, 1, 413, 'Pendapatan Komisi'),
(9, 1, 414, 'Pendapatan Denda Pelanggan'),
(10, 1, 415, 'Pendapatan Royalti'),
(11, 1, 416, 'Pendapatan Investasi'),
(12, 1, 421, 'Keuntungan Penjualan Aset Tetap'),
(13, 1, 422, 'Pendapatan Hibah/Donasi'),
(14, 1, 423, 'Pendapatan dari Selisih Kurs Mata Uang'),
(15, 1, 424, 'Pendapatan Lain yang Tidak Terduga'),
(16, 1, 431, 'Pelunasan Piutang Jasa'),
(17, 1, 432, 'Pelunasan Piutang Penjualan'),
(18, 2, 501, 'Biaya Produksi Bahan Baku'),
(19, 2, 502, 'Biaya Produksi Tenaga Kerja'),
(20, 2, 503, 'Biaya Overhead Produksi'),
(21, 2, 504, 'Biaya Packing dan Pengiriman'),
(22, 2, 511, 'Biaya Gaji dan Tunjangan'),
(23, 2, 512, 'Biaya Listrik dan Air'),
(24, 2, 513, 'Biaya Internet dan Telepon'),
(25, 2, 514, 'Biaya Sewa Gedung'),
(26, 2, 515, 'Biaya Transportasi dan Perjalanan Dinas'),
(27, 2, 516, 'Biaya Marketing dan Iklan'),
(28, 2, 517, 'Biaya Pemeliharaan dan Perbaikan'),
(29, 2, 518, 'Biaya ATK (Alat Tulis Kantor)'),
(30, 2, 521, 'Biaya Bunga Pinjaman'),
(31, 2, 522, 'Biaya Penyusutan Aset Tetap'),
(32, 2, 523, 'Biaya Pajak dan Retribusi'),
(33, 2, 524, 'Biaya Hukum dan Konsultan'),
(34, 2, 525, 'Biaya Lain yang Tidak Terduga'),
(35, 2, 531, 'Biaya Denda'),
(36, 2, 532, 'Biaya Keanggotaan/Subscription'),
(37, 2, 533, 'Biaya CSR (Corporate Social Responsibility)'),
(38, 3, 101, 'Kas dan Bank'),
(39, 3, 102, 'Piutang Usaha'),
(40, 3, 103, 'Persediaan Barang'),
(41, 3, 104, 'Aset Tetap - Bangunan'),
(42, 3, 105, 'Aset Tetap - Kendaraan'),
(43, 3, 106, 'Aset Tetap - Peralatan'),
(44, 3, 107, 'Investasi Jangka Panjang'),
(45, 4, 201, 'Hutang Usaha'),
(46, 4, 202, 'Hutang Bank'),
(47, 4, 203, 'Hutang Pajak'),
(48, 4, 204, 'Hutang Gaji'),
(49, 4, 205, 'Uang Muka dari Pelanggan'),
(50, 4, 206, 'Hutang Jangka Panjang'),
(51, 5, 301, 'Modal Disetor'),
(52, 5, 302, 'Laba Ditahan'),
(53, 5, 303, 'Laba Tahun Berjalan'),
(54, 5, 304, 'Dividen'),
(55, 5, 305, 'Tambahan Modal'),
(56, 5, 306, 'Penarikan Pribadi (Prive)');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `name_kategori` varchar(100) NOT NULL,
  `type_kategori` enum('I','E','A','L') NOT NULL COMMENT '''I = Income, E = Expense, A = Asset, L = Liability'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `name_kategori`, `type_kategori`) VALUES
(1, 'Income', 'I'),
(2, 'Expenses', 'E'),
(3, 'Assets', 'A'),
(4, 'Liabilities', 'L'),
(5, 'Equity', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `finance_records`
--

CREATE TABLE `finance_records` (
  `id_record` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `record_date` datetime NOT NULL DEFAULT current_timestamp(),
  `type_record` enum('I','O') NOT NULL,
  `product_id` smallint(5) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `id_code` int(10) UNSIGNED NOT NULL COMMENT 'ID Kode Akun',
  `description` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_code`
--
ALTER TABLE `account_code`
  ADD PRIMARY KEY (`id_code`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `finance_records`
--
ALTER TABLE `finance_records`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_code`
--
ALTER TABLE `account_code`
  MODIFY `id_code` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finance_records`
--
ALTER TABLE `finance_records`
  MODIFY `id_record` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
