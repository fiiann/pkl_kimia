-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2017 at 02:12 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_wali` varchar(20) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `judul` varchar(80) NOT NULL,
  `idlab` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`nim`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`, `id_wali`, `angkatan`, `judul`, `idlab`) VALUES
('24010314120001', 'coba', '252920f0c02dd1ceb738513db41f32e6', 'coba', 'coba', 'coba@gmail.com', '028308', '001', '2014', '', '5'),
('24010314120002', 'kimia', '7c0b068d9f57da77ef2834b30b2f9dff', 'FSM undip', 'Semarang', 'kimia@undip.ac.id', '010101', '002', '2014', '', '3'),
('24010314120003', 'Garfianto', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang', 'Semarang', 'fiann@gmail.com', '085645991500', '001', '2015', '', '1'),
('24010314120004', 'four', 'c61d91bb216302dfa7569cebb651bbd9', 'england', 'london', 'four@gmail.com', '1001', '002', '2015', '', ''),
('24010314120005', 'five', '7aea65fd27db0ab28cf360949799dbee', 'germany', 'berlin', 'five@gmail.com', '233', '001', '2016', '', ''),
('24010314120014', 'Wiladhiyanti', 'd1610aa2317f20fef05766813a58d1c1', 'Semarang', 'Semarang', 'wila@gmail.com', '085645991500', '001', '2014', '', ''),
('24010314120044', 'Kevin Sanjaya', '95efd42bee092ba891b8a94efeda249f', 'jakarta', 'Jakarta', 'kevin@gmail.com', '394', '002', '2016', '', '3'),
('24010314120045', 'Muhammad Ahsan', '252920f0c02dd1ceb738513db41f32e6', 'kalimanah', 'purbalingga', 'garfiantoc@if.undip.ac.id', '111', '002', '2013', '', ''),
('24010314120054', 'Aditia Prasetio', 'a5a75bb2deaf0c0bfa7d9deb5f2b56d5', 'Jl. TanjungSari VIII, Banyumanik', 'Semarang', 'aditia.prasetio12@gmail.com', '085645991577', '002', '2015', '', '1'),
('24010314120057', 'Rizal Muhammad', 'b77d7d2c9241775b5d3eed6016278199', 'Gondang Barat 1', 'Purbalingga', 'rizal.muhammad@gmail.com', '085641282142', '002', '2014', '', '1'),
('24010314170001', 'Yasmin', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang Bawah', 'Semarang', 'yasmin9658@gmail.com', '085645991576', '001', '2014', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int(11) NOT NULL,
  `nim` varchar(14) NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`id_bimbingan`, `nim`, `nip`) VALUES
(2, '24010314120002', '240103141200022221'),
(3, '24010314120003', '240103141200022222');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_pkt`
--

CREATE TABLE `daftar_pkt` (
  `pilihan1` varchar(50) NOT NULL,
  `pilihan2` varchar(50) NOT NULL,
  `pilihan3` varchar(50) NOT NULL,
  `ttd` varchar(1) DEFAULT NULL,
  `nim` varchar(30) NOT NULL,
  `no_pkt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_pkt`
--

INSERT INTO `daftar_pkt` (`pilihan1`, `pilihan2`, `pilihan3`, `ttd`, `nim`, `no_pkt`) VALUES
('BIOKIMIA', 'BIOKIMIA', 'K.ORGANIK', NULL, '24010314120001', 1),
('K.ORGANIK', 'K.FISIK', 'K.ANALITIK', NULL, '24010314120002', 2),
('K.ORGANIK', 'K.FISIK', 'K.ANORGANIK', NULL, '24010314120044', 3),
('BIOKIMIA', 'K.ANALITIK', 'K.FISIK', NULL, '24010314120003', 4),
('BIOKIMIA', 'K.ANALITIK', 'K.ORGANIK', NULL, '24010314120057', 5);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_tr1`
--

CREATE TABLE `daftar_tr1` (
  `id_tr1` int(11) NOT NULL,
  `nim` varchar(14) NOT NULL,
  `komulatif` int(10) NOT NULL,
  `sks` int(10) NOT NULL,
  `krs` date NOT NULL,
  `daftar` date NOT NULL,
  `fisik` varchar(10) NOT NULL,
  `analitik` int(10) NOT NULL,
  `organik` int(10) NOT NULL,
  `anorganik` int(10) NOT NULL,
  `biokimia` int(10) NOT NULL,
  `nilai_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_tr1`
--

INSERT INTO `daftar_tr1` (`id_tr1`, `nim`, `komulatif`, `sks`, `krs`, `daftar`, `fisik`, `analitik`, `organik`, `anorganik`, `biokimia`, `nilai_akhir`) VALUES
(7, '24010314120054', 3, 30, '2017-01-01', '2017-01-25', '1', 2, 3, 4, 5, 0),
(8, '24010314120004', 4, 110, '2017-02-13', '0000-00-00', '5', 4, 3, 2, 1, 0),
(9, '24010314120005', 2, 34, '2017-01-01', '2017-01-01', '1', 2, 3, 4, 5, 0),
(10, '24010314120001', 4, 101, '2017-01-01', '2017-01-05', '1', 2, 5, 3, 4, 56),
(11, '24010314120002', 4, 70, '2017-01-01', '2017-03-15', '5', 4, 3, 2, 1, 75),
(12, '24010314120003', 4, 144, '2017-01-01', '2017-01-05', '2', 1, 3, 4, 5, 77),
(13, '24010314120044', 4, 144, '2017-12-09', '2017-11-10', '1', 2, 3, 4, 5, 0);

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
  `idlab` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `alamat`, `no_telp`, `topik`, `password`, `email`, `id_wali`, `idlab`) VALUES
('240103141200022221', 'dosen2', 'banyumanik', '111111', 'bio-energi', 'b77d7d2c9241775b5d3eed6016278199', 'dosen2@gmail.com', '001', '1'),
('240103141200022222', 'dosen1', 'ngaliyan', '0000000', 'organik', 'dosen1', 'dosen1', '002', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `agenda` varchar(50) NOT NULL,
  `waktu` date NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kategori`, `agenda`, `waktu`, `keterangan`) VALUES
(3, 'PKT', 'Pendaftaran PKT', '2018-01-17', 'pendaftaran pkt.'),
(4, 'PKT', 'Pendaftaran PKT', '2017-01-17', 'pendaftaran pkt'),
(5, 'TR1', 'jadwal outline', '2017-01-18', 'ini adalah jadwal outline'),
(6, 'TR2', 'sidang tr2', '2019-01-19', 'cek'),
(7, 'PKT', 'Cek', '2018-01-17', 'coba');

-- --------------------------------------------------------

--
-- Table structure for table `judul`
--

CREATE TABLE `judul` (
  `nim` varchar(14) NOT NULL,
  `judul_pkt` varchar(200) NOT NULL,
  `judul_tr1` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judul`
--

INSERT INTO `judul` (`nim`, `judul_pkt`, `judul_tr1`) VALUES
('24010314120001', 'Deep Learning is Fun', ''),
('24010314120003', 'Text Mining', ''),
('24010314120002', 'Backpro', ''),
('24010314120044', 'Convolutional Neural Network for Analysis Cybersecurity on Attack based on XSS (Cross Site Script) and prevention on the future attact case in B Laboratory Informacs', '');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id_lab` varchar(15) NOT NULL,
  `nama_lab` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `idlab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id_lab`, `nama_lab`, `password`, `email`, `idlab`) VALUES
('BIOKIMIA', 'BIOKIMIA', 'b77d7d2c9241775b5d3eed6016278199', 'biokimia@gmail.com', '1'),
('K.ANALITIK', 'KIMIA ANALITIK', 'b77d7d2c9241775b5d3eed6016278199', 'analitik@gmail.com', '2'),
('K.ANORGANIK', 'KIMIA ANORGANIK', 'b77d7d2c9241775b5d3eed6016278199', '', '3'),
('K.FISIK', 'KIMIA FISIK', 'b77d7d2c9241775b5d3eed6016278199', '', '4'),
('K.ORGANIK', 'KIMIA ORGANIK', 'b77d7d2c9241775b5d3eed6016278199', '', '5');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_outline`
--

CREATE TABLE `nilai_outline` (
  `nim` varchar(14) NOT NULL,
  `identifikasi` int(11) NOT NULL,
  `rumusan` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `metodologi` int(11) NOT NULL,
  `hipotesis` int(11) NOT NULL,
  `analisis` int(11) NOT NULL,
  `kontrak` int(11) NOT NULL,
  `nilai_total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_outline`
--

INSERT INTO `nilai_outline` (`nim`, `identifikasi`, `rumusan`, `tujuan`, `metodologi`, `hipotesis`, `analisis`, `kontrak`, `nilai_total`, `tanggal`) VALUES
('24010314120001', 50, 50, 50, 50, 50, 50, 50, 50, '2017-02-07'),
('24010314120002', 70, 60, 70, 60, 70, 80, 70, 70, '2017-02-01'),
('24010314120003', 80, 80, 80, 80, 80, 80, 80, 80, '2017-02-09'),
('24010314120004', 80, 80, 80, 80, 58, 58, 58, 71, '2017-02-07'),
('24010314120044', 90, 90, 90, 90, 90, 90, 90, 90, '2017-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pkt`
--

CREATE TABLE `nilai_pkt` (
  `nim` varchar(14) NOT NULL,
  `nilai_pkt` int(20) NOT NULL,
  `nilai_praktikum` int(100) NOT NULL,
  `nilai_laporan` int(11) NOT NULL,
  `nilai_presentasi` int(11) NOT NULL,
  `nilai_huruf` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_pkt`
--

INSERT INTO `nilai_pkt` (`nim`, `nilai_pkt`, `nilai_praktikum`, `nilai_laporan`, `nilai_presentasi`, `nilai_huruf`) VALUES
('24010314120002', 52, 60, 30, 70, 'C'),
('24010314120003', 100, 100, 100, 100, 'A'),
('24010314120044', 77, 75, 80, 80, 'B'),
('24010314120057', 70, 70, 70, 70, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_progress`
--

CREATE TABLE `nilai_progress` (
  `nim` varchar(14) NOT NULL,
  `bahasa` int(11) NOT NULL,
  `substansi` int(11) NOT NULL,
  `penyajian` int(11) NOT NULL,
  `penguasaan_materi` int(11) NOT NULL,
  `analisis` int(11) NOT NULL,
  `penguasaan_pengetahuan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_progress`
--

INSERT INTO `nilai_progress` (`nim`, `bahasa`, `substansi`, `penyajian`, `penguasaan_materi`, `analisis`, `penguasaan_pengetahuan`, `tanggal`, `jumlah_total`) VALUES
('24010314120054', 20, 20, 20, 20, 20, 20, '2017-02-07', 20),
('24010314120002', 70, 80, 70, 80, 70, 80, '2017-02-07', 77),
('24010314120003', 50, 50, 50, 50, 50, 50, '2017-02-07', 50),
('24010314120001', 50, 50, 50, 50, 50, 50, '2017-02-01', 50),
('24010314120044', 90, 90, 90, 90, 90, 90, '2017-01-02', 90),
('24010314120004', 80, 80, 80, 80, 80, 80, '2017-02-07', 80);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tr1`
--

CREATE TABLE `nilai_tr1` (
  `nim` varchar(14) NOT NULL,
  `outline` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `laporan` int(11) NOT NULL,
  `kinerja` int(11) NOT NULL,
  `huruf` varchar(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_tr1`
--

INSERT INTO `nilai_tr1` (`nim`, `outline`, `progress`, `laporan`, `kinerja`, `huruf`, `nilai_akhir`) VALUES
('24010314120001', 50, 50, 70, 70, 'D', 56),
('24010314120002', 70, 77, 75, 70, 'B', 75),
('24010314120003', 80, 50, 80, 80, 'B', 77),
('24010314120004', 71, 80, 0, 0, '', 0),
('24010314120044', 90, 90, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `id_lab` varchar(15) NOT NULL,
  `nim` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`id_lab`, `nim`) VALUES
('5', '24010314120001'),
('3', '24010314120002'),
('4', '24010314120003'),
('3', '24010314120044'),
('1', '24010314120054'),
('1', '24010314120057');

-- --------------------------------------------------------

--
-- Table structure for table `perwalian`
--

CREATE TABLE `perwalian` (
  `id_wali` varchar(20) NOT NULL,
  `nip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perwalian`
--

INSERT INTO `perwalian` (`id_wali`, `nip`) VALUES
('001', '240103141200022221'),
('002', '240103141200022222');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idpetugas` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `email`, `password`) VALUES
(1, 'Garfianto Dwi', 'garfianto@if.undip.ac.id', 'b77d7d2c9241775b5d3eed6016278199'),
(2, 'Yasmin', 'yasmin9658@gmail.com', 'b77d7d2c9241775b5d3eed6016278199'),
(3, 'GarfiantoDwi', 'fian10@gmail.com', '19fe0f42e8391ff2a6665dcb24669bbc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indexes for table `daftar_pkt`
--
ALTER TABLE `daftar_pkt`
  ADD PRIMARY KEY (`no_pkt`);

--
-- Indexes for table `daftar_tr1`
--
ALTER TABLE `daftar_tr1`
  ADD PRIMARY KEY (`id_tr1`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id_lab`);

--
-- Indexes for table `nilai_outline`
--
ALTER TABLE `nilai_outline`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `nilai_pkt`
--
ALTER TABLE `nilai_pkt`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `nilai_tr1`
--
ALTER TABLE `nilai_tr1`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `penempatan`
--
ALTER TABLE `penempatan`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `perwalian`
--
ALTER TABLE `perwalian`
  ADD PRIMARY KEY (`id_wali`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`),
  ADD UNIQUE KEY `idpetugas` (`idpetugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `daftar_pkt`
--
ALTER TABLE `daftar_pkt`
  MODIFY `no_pkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `daftar_tr1`
--
ALTER TABLE `daftar_tr1`
  MODIFY `id_tr1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
