-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 06:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb_manu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `rekomendasi` varchar(255) DEFAULT NULL,
  `jalur_pendaftaran` varchar(100) DEFAULT NULL,
  `pilihan_program` varchar(100) DEFAULT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp_siswa` varchar(20) DEFAULT NULL,
  `tempat_tanggal_lahir` varchar(255) DEFAULT NULL,
  `tinggal` varchar(100) DEFAULT NULL,
  `tinggal_lainnya` varchar(255) DEFAULT NULL,
  `dukuh` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `rt` varchar(10) DEFAULT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `pendidikan_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `no_hp_ayah` varchar(20) DEFAULT NULL,
  `pendidikan_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `no_hp_ibu` varchar(20) DEFAULT NULL,
  `alamat_ortu` text DEFAULT NULL,
  `saudara_sekolah` varchar(50) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `hubungan_wali` varchar(100) DEFAULT NULL,
  `pendidikan_wali` varchar(100) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `no_hp_wali` varchar(20) DEFAULT NULL,
  `alamat_wali` text DEFAULT NULL,
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `alamat_sekolah` varchar(255) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `piagam` varchar(50) DEFAULT NULL,
  `motivasi` text DEFAULT NULL,
  `tanggal_pendaftaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_daftar` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'baru',
  `no_pendaftaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `rekomendasi`, `jalur_pendaftaran`, `pilihan_program`, `nama_siswa`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `no_hp_siswa`, `tempat_tanggal_lahir`, `tinggal`, `tinggal_lainnya`, `dukuh`, `desa`, `rt`, `rw`, `kecamatan`, `kabupaten`, `provinsi`, `alamat_lengkap`, `nama_ayah`, `nama_ibu`, `pendidikan_ayah`, `pekerjaan_ayah`, `no_hp_ayah`, `pendidikan_ibu`, `pekerjaan_ibu`, `no_hp_ibu`, `alamat_ortu`, `saudara_sekolah`, `nama_wali`, `hubungan_wali`, `pendidikan_wali`, `pekerjaan_wali`, `no_hp_wali`, `alamat_wali`, `nama_sekolah`, `alamat_sekolah`, `nisn`, `piagam`, `motivasi`, `tanggal_pendaftaran`, `tanggal_daftar`, `status`, `no_pendaftaran`) VALUES
(5, 'zakia Rahmawati 10.8', 'reguler_prestasi', 'agm', 'EKA DEWI LESTARI', 'laki-laki', 'Batang', '2003-03-04', '085747110787', 'Batang, 04 Mar 2003', 'bersama_ortu', '', 'Jatirejo ', 'Luwung ', '003', '004', 'Banyuputih ', 'Batang', 'Jawa Tengah', 'Jatirejo , Desa Luwung , RT 003/RW 004, Kec. Banyuputih , Kab. Batang, Prov. Jawa Tengah', 'Nasrudin ', 'ibuku', 's3', 'buruh', '085747110787', 's1', 'IRT', '085747110787', 'Dukuh Adiloko Desa Rowosari', 'tidak_punya', 'FAHRUTORI', 'sdsdsd', '', 'BURUH', '085747110787', 'Dukuh Adiloko Desa Rowosari', 'SMP N 02 LIMPUNG', 'Limoung', '', 'tidak_punya', 'Ingin belajar ilmu pengetahuan sosial dan ekonomi untuk melanjutkan ke jenjang lebih tinggi ', '2025-04-27 04:40:20', '2025-04-27 06:40:20', 'baru', 'A-2627/001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
