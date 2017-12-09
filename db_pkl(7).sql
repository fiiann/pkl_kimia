-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2017 at 05:08 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama_dosen` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `topik` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_wali` varchar(10) NOT NULL,
  `idlab` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `alamat`, `no_telp`, `topik`, `password`, `email`, `id_wali`, `idlab`) VALUES
('1111111111', 'Dendi Santoso', 'welahan', '293i', 'kimia murni', '4f5b97bf23c2cb143d7556bb07d2619c', 'dendi@gmail.com', '', '2'),
('23242435999', 'Taufik Hidayat', 'Semarang', '009090909', 'Tanaman Organik', '4f5b97bf23c2cb143d7556bb07d2619c', 'taufik@gmail.com', '', '5'),
('240103141200022221', 'dosen2', 'banyumanik', '111111', 'bio-energi', 'b77d7d2c9241775b5d3eed6016278199', 'dosen2@gmail.com', '001', '1'),
('240103141200022222', 'dosen1', 'ngaliyan', '0000000', 'organik', '8dc659b8abb0ba5efeb19451361d54c4', 'dosen1@gmail.com', '002', '4'),
('3432432', 'Herry Murti', 'Purbalingga', '98900909', 'Bio', '4f5b97bf23c2cb143d7556bb07d2619c', 'hery@gmail.com', '', '3');

-- --------------------------------------------------------

--
-- Table structure for table `final_tr1`
--

CREATE TABLE `final_tr1` (
  `id_final` int(11) NOT NULL,
  `id_tr1` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_tr1`
--

INSERT INTO `final_tr1` (`id_final`, `id_tr1`, `id_kategori`, `nilai`, `tanggal_ujian`) VALUES
(1, 1, 1, 82, '0000-00-00'),
(2, 1, 2, 74, '0000-00-00'),
(5, 3, 1, 74, '2017-12-15'),
(6, 3, 2, 77, '2017-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(10) NOT NULL,
  `persentase_kat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `persentase_kat`) VALUES
(1, 'outline', 50),
(2, 'progress', 50);

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `nama_lab` varchar(20) NOT NULL,
  `idlab` int(50) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`nama_lab`, `idlab`, `admin`, `password`, `nip`) VALUES
('BIOKIMIA', 1, 'biokimia@gmail.com', 'b77d7d2c9241775b5d3eed6016278199', '3432432'),
('KIMIA_ANALITIK', 2, 'analitik@gmail.com', 'b77d7d2c9241775b5d3eed6016278199', '1111111111'),
('KIMIA_ANORGANIK', 3, '', '', '23242435999'),
('KIMIA_FISIK', 4, '', '', '240103141200022221'),
('KIMIA_ORGANIK', 5, '', '', '240103141200022222');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`) VALUES
('24010314120001', 'coba', 'b77d7d2c9241775b5d3eed6016278199', 'coba', 'coba', 'coba@gmail.com', '972'),
('24010314120002', 'kimias', 'b77d7d2c9241775b5d3eed6016278199', 'FSM undip', 'Semarang', 'kimiaa@gmial.com', '010101'),
('24010314120003', 'Garfianto', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang', 'Semarang', 'fiann@gmail.com', '085645991500'),
('24010314120004', 'four', 'c61d91bb216302dfa7569cebb651bbd9', 'england', 'london', 'four@gmail.com', '1001'),
('24010314120005', 'five', '7aea65fd27db0ab28cf360949799dbee', 'germany', 'berlin', 'five@gmail.com', '233'),
('24010314120006', 'enam', '4f5b97bf23c2cb143d7556bb07d2619c', 'kjd', 'kjlk', 's@g', '080'),
('24010314120044', 'Kevin Sanjaya', 'b77d7d2c9241775b5d3eed6016278199', 'jakarta', 'Jakarta', 'kevin@gmail.com', '394'),
('24010314120045', 'Muhammad Ahsan', '252920f0c02dd1ceb738513db41f32e6', 'kalimanah', 'purbalingga', 'garfiantoc@if.undip.ac.id', '111'),
('24010314120054', 'Aditia Prasetio', 'a5a75bb2deaf0c0bfa7d9deb5f2b56d5', 'Jl. TanjungSari VIII, Banyumanik', 'Semarang', 'aditia.prasetio12@gmail.com', '085645991577'),
('24010314120057', 'Rizal Muhammad', 'b77d7d2c9241775b5d3eed6016278199', 'Gondang Barat 1', 'Purbalingga', 'rizal.muhammad@gmail.com', '085641282142'),
('24010314170001', 'Yasmin', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang Bawah', 'Semarang', 'yasmin9658@gmail.com', '085645991576');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_komponen_pkt`
--

CREATE TABLE `nilai_komponen_pkt` (
  `id_komponen` int(5) NOT NULL,
  `komponen` varchar(20) NOT NULL,
  `persentase` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_komponen_pkt`
--

INSERT INTO `nilai_komponen_pkt` (`id_komponen`, `komponen`, `persentase`) VALUES
(1, 'nilai_presentasi', 20),
(2, 'nilai_laporan', 40),
(3, 'nilai_praktikum', 40);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_komponen_tr1`
--

CREATE TABLE `nilai_komponen_tr1` (
  `id_komponen_tr1` int(3) NOT NULL,
  `komponen_tr1` varchar(25) NOT NULL,
  `persentase_tr1` int(3) NOT NULL,
  `kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_komponen_tr1`
--

INSERT INTO `nilai_komponen_tr1` (`id_komponen_tr1`, `komponen_tr1`, `persentase_tr1`, `kategori`) VALUES
(1, 'identifikasi_masalah', 30, '1'),
(2, 'rumusan_masalah', 10, '1'),
(3, 'tujuan', 10, '1'),
(4, 'metodologi', 10, '1'),
(5, 'hipotesis', 10, '1'),
(6, 'analisis', 20, '1'),
(7, 'kontrak_tr1_o', 10, '1'),
(8, 'bhs_format', 10, '2'),
(9, 'substansi', 30, '2'),
(10, 'penyajian', 10, '2'),
(11, 'penguasaan_materi', 30, '2'),
(12, 'penguasaan_analisis', 10, '2'),
(13, 'penguasaan_pengetahuan', 10, '2');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pkt`
--

CREATE TABLE `nilai_pkt` (
  `id_nilai_pkt` int(11) NOT NULL,
  `id_pkt` int(5) NOT NULL,
  `id_komponen` int(5) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_pkt`
--

INSERT INTO `nilai_pkt` (`id_nilai_pkt`, `id_pkt`, `id_komponen`, `nilai`) VALUES
(1, 1, 1, 70),
(2, 1, 2, 60),
(3, 1, 3, 50),
(4, 2, 1, 0),
(5, 2, 2, 0),
(6, 2, 3, 0),
(7, 3, 1, 90),
(8, 3, 2, 80),
(9, 3, 3, 70);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tr1`
--

CREATE TABLE `nilai_tr1` (
  `id_nilai_tr1` int(5) NOT NULL,
  `id_tr1` int(5) NOT NULL,
  `nilai` int(3) DEFAULT NULL,
  `id_komponen_tr1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_tr1`
--

INSERT INTO `nilai_tr1` (`id_nilai_tr1`, `id_tr1`, `nilai`, `id_komponen_tr1`) VALUES
(1, 1, 100, 1),
(2, 1, 100, 2),
(3, 1, 70, 3),
(4, 1, 80, 4),
(5, 1, 70, 5),
(6, 1, 60, 6),
(7, 1, 80, 7),
(8, 1, 100, 8),
(9, 1, 80, 9),
(10, 1, 70, 10),
(11, 1, 60, 11),
(12, 1, 80, 12),
(13, 1, 60, 13),
(26, 2, NULL, 13),
(27, 3, 100, 1),
(28, 3, 90, 2),
(29, 3, 80, 3),
(30, 3, 70, 4),
(31, 3, 60, 5),
(32, 3, 50, 6),
(33, 3, 40, 7),
(34, 3, 100, 8),
(35, 3, 90, 9),
(36, 3, 80, 10),
(37, 3, 70, 11),
(38, 3, 60, 12),
(39, 3, 50, 13);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idpetugas` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tgl_awal` varchar(30) NOT NULL,
  `tgl_akhir` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `email`, `password`, `tgl_awal`, `tgl_akhir`) VALUES
(1, 'Garfianto Dwii', 'garfianto@if.undip.ac.id', 'b77d7d2c9241775b5d3eed6016278199', '2017-09-01', '2018-09-09'),
(2, 'ssatudr', 'fd@ga', 'b77d7d2c9241775b5d3eed6016278199', '', ''),
(3, 'Hello', 'helo@gmail.com', '4f5b97bf23c2cb143d7556bb07d2619c', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pkt`
--

CREATE TABLE `pkt` (
  `id_pkt` int(5) NOT NULL,
  `nim` varchar(14) NOT NULL,
  `nilai` int(3) NOT NULL,
  `judul` varchar(80) DEFAULT NULL,
  `waktu` varchar(10) NOT NULL,
  `pilihan_lab1` varchar(20) NOT NULL,
  `pilihan_lab2` varchar(20) NOT NULL,
  `pilihan_lab3` varchar(20) NOT NULL,
  `flag_lab` varchar(20) DEFAULT NULL,
  `dosen_pembimbing` varchar(18) DEFAULT NULL,
  `nilai_praktikum` int(3) NOT NULL,
  `nilai_laporan` int(3) NOT NULL,
  `nilai_presentasi` int(3) NOT NULL,
  `nilai_huruf` varchar(1) DEFAULT NULL,
  `smt` varchar(20) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `periode` varchar(6) NOT NULL,
  `tgl_lulus` date NOT NULL,
  `periode_lulus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pkt`
--

INSERT INTO `pkt` (`id_pkt`, `nim`, `nilai`, `judul`, `waktu`, `pilihan_lab1`, `pilihan_lab2`, `pilihan_lab3`, `flag_lab`, `dosen_pembimbing`, `nilai_praktikum`, `nilai_laporan`, `nilai_presentasi`, `nilai_huruf`, `smt`, `tgl_daftar`, `periode`, `tgl_lulus`, `periode_lulus`) VALUES
(1, '24010314120001', 58, 'Machine Learning', '', '1', '2', '3', '1', '23242435999', 50, 60, 70, 'C', '1', '2017-11-24 03:47:06', '16/17', '2017-11-07', '16/17'),
(2, '24010314120002', 0, NULL, '', '1', '3', '4', NULL, NULL, 0, 0, 0, NULL, '6', '2017-11-21 06:47:21', '16/17', '0000-00-00', ''),
(3, '24010314120044', 78, NULL, '', '1', '2', '4', '1', '23242435999', 70, 80, 90, 'B', '5', '2017-12-07 03:43:27', '18/19', '2017-12-12', '16/17');

-- --------------------------------------------------------

--
-- Table structure for table `tr1`
--

CREATE TABLE `tr1` (
  `id_tr1` int(5) NOT NULL,
  `nim` varchar(14) NOT NULL,
  `nip1` varchar(18) DEFAULT NULL,
  `nip2` varchar(18) DEFAULT NULL,
  `nip3` varchar(18) DEFAULT NULL,
  `idlab_tr1` varchar(20) DEFAULT NULL,
  `sks` int(3) NOT NULL,
  `ipk` float NOT NULL,
  `tanggal_krs` date NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `nilai_tr1` int(3) DEFAULT NULL,
  `nilai_huruf` varchar(1) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `smt` int(2) NOT NULL,
  `periode_daftar` varchar(10) NOT NULL,
  `tgl_lulus` date NOT NULL,
  `periode_lulus` varchar(10) NOT NULL,
  `nilai_outline` int(3) DEFAULT NULL,
  `nilai_progress` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr1`
--

INSERT INTO `tr1` (`id_tr1`, `nim`, `nip1`, `nip2`, `nip3`, `idlab_tr1`, `sks`, `ipk`, `tanggal_krs`, `tanggal_daftar`, `nilai_tr1`, `nilai_huruf`, `judul`, `smt`, `periode_daftar`, `tgl_lulus`, `periode_lulus`, `nilai_outline`, `nilai_progress`) VALUES
(1, '24010314120001', '23242435999', '1111111111', '240103141200022222', '1', 100, 3, '2017-10-26', '2017-11-09', 78, NULL, 'Machine Learning', 5, '16/17', '0000-00-00', '', 82, 74),
(3, '24010314120044', '23242435999', '1111111111', '240103141200022221', '1', 144, 3.4, '2017-12-22', '2017-12-07', 76, NULL, 'badminton player', 4, '17181', '0000-00-00', '', 74, 77);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `final_tr1`
--
ALTER TABLE `final_tr1`
  ADD PRIMARY KEY (`id_final`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`idlab`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `nilai_komponen_pkt`
--
ALTER TABLE `nilai_komponen_pkt`
  ADD PRIMARY KEY (`id_komponen`);

--
-- Indexes for table `nilai_komponen_tr1`
--
ALTER TABLE `nilai_komponen_tr1`
  ADD PRIMARY KEY (`id_komponen_tr1`);

--
-- Indexes for table `nilai_pkt`
--
ALTER TABLE `nilai_pkt`
  ADD PRIMARY KEY (`id_nilai_pkt`);

--
-- Indexes for table `nilai_tr1`
--
ALTER TABLE `nilai_tr1`
  ADD PRIMARY KEY (`id_nilai_tr1`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`),
  ADD UNIQUE KEY `idpetugas` (`idpetugas`);

--
-- Indexes for table `pkt`
--
ALTER TABLE `pkt`
  ADD PRIMARY KEY (`id_pkt`);

--
-- Indexes for table `tr1`
--
ALTER TABLE `tr1`
  ADD PRIMARY KEY (`id_tr1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_tr1`
--
ALTER TABLE `final_tr1`
  MODIFY `id_final` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `idlab` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nilai_pkt`
--
ALTER TABLE `nilai_pkt`
  MODIFY `id_nilai_pkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `nilai_tr1`
--
ALTER TABLE `nilai_tr1`
  MODIFY `id_nilai_tr1` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pkt`
--
ALTER TABLE `pkt`
  MODIFY `id_pkt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tr1`
--
ALTER TABLE `tr1`
  MODIFY `id_tr1` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
