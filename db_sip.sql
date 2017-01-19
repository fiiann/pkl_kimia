-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2017 at 10:12 AM
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
  `angkatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`nim`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`, `id_wali`, `angkatan`) VALUES
('24010314120001', 'coba', '252920f0c02dd1ceb738513db41f32e6', 'coba', 'coba', 'coba@gmail.com', '028308', '001', '2014'),
('24010314120002', 'kimia', '7c0b068d9f57da77ef2834b30b2f9dff', 'FSM undip', 'Semarang', 'kimia@undip.ac.id', '010101', '002', '2014'),
('24010314120003', 'Garfianto', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang', 'Semarang', 'fiann@gmail.com', '085645991500', '001', '2015'),
('24010314120014', 'Wiladhiyanti', 'd1610aa2317f20fef05766813a58d1c1', 'Semarang', 'Semarang', 'wila@gmail.com', '085645991500', '001', '2014'),
('24010314120045', 'anggota', '252920f0c02dd1ceb738513db41f32e6', 'kalimanah', 'purbalingga', 'garfianto@if.undip.ac.id', '111', '002', '2013'),
('24010314120054', 'Aditia Prasetio', 'a5a75bb2deaf0c0bfa7d9deb5f2b56d5', 'Jl. TanjungSari VIII, Banyumanik', 'Semarang', 'aditia.prasetio12@gmail.com', '085645991577', '002', '2015'),
('24010314120057', 'Rizal Muhammad', 'b77d7d2c9241775b5d3eed6016278199', 'Gondang Barat 1', 'Purbalingga', 'rizal.muhammad@gmail.com', '085641282142', '002', '2014'),
('24010314170001', 'Yasmin', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang Bawah', 'Semarang', 'yasmin9658@gmail.com', '085645991576', '001', '2014');

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
(3, '24010314120003', '240103141200022221');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_pkt`
--

CREATE TABLE `daftar_pkt` (
  `id_pkt` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `pilihan1` varchar(15) NOT NULL,
  `pilihan2` varchar(15) NOT NULL,
  `pilihan3` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_pkt`
--

INSERT INTO `daftar_pkt` (`id_pkt`, `nim`, `pilihan1`, `pilihan2`, `pilihan3`) VALUES
(7, '24010314120001', 'E', 'D', 'C'),
(8, '24010314120002', 'A', 'B', 'C'),
(9, '24010314120003', 'A', 'D', 'E'),
(10, '24010314120054', 'A', 'B', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_tr1`
--

CREATE TABLE `daftar_tr1` (
  `id_tr1` int(11) NOT NULL,
  `nim` varchar(14) NOT NULL,
  `topik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_tr1`
--

INSERT INTO `daftar_tr1` (`id_tr1`, `nim`, `topik`) VALUES
(2, '24010314120001', 'machine learning'),
(3, '24010314120002', 'AI'),
(4, '24010314120003', 'pwi');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama_dosen` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `id_lab` varchar(11) NOT NULL,
  `topik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `alamat`, `no_telp`, `id_lab`, `topik`) VALUES
('240103141200022221', 'dosen2', 'banyumanik', '111111', 'A', 'bio-energi'),
('240103141200022222', 'dosen1', 'ngaliyan', '0000000', 'B', 'organik');

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
(6, 'TR2', 'sidang tr2', '2019-01-19', 'cek');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id_lab` varchar(3) NOT NULL,
  `nama_lab` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id_lab`, `nama_lab`) VALUES
('A', 'Laboratorium A'),
('B', 'Laboratorium B'),
('C', 'Laboratorium C'),
('D', 'Laboratorium D'),
('E', 'Laboratorium E');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pkt`
--

CREATE TABLE `nilai_pkt` (
  `nim` varchar(14) NOT NULL,
  `nilai_pkt` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_pkt`
--

INSERT INTO `nilai_pkt` (`nim`, `nilai_pkt`) VALUES
('24010314120002', 78),
('24010314120054', 80);

-- --------------------------------------------------------

--
-- Table structure for table `penempatan`
--

CREATE TABLE `penempatan` (
  `id_lab` varchar(3) NOT NULL,
  `nim` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penempatan`
--

INSERT INTO `penempatan` (`id_lab`, `nim`) VALUES
('B', '24010314120001'),
('A', '24010314120002'),
('E', '24010314120003');

-- --------------------------------------------------------

--
-- Table structure for table `perwalian`
--

CREATE TABLE `perwalian` (
  `id_wali` varchar(20) NOT NULL,
  `nama_wali` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perwalian`
--

INSERT INTO `perwalian` (`id_wali`, `nama_wali`) VALUES
('001', 'wali1'),
('002', 'wali2');

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
(1, 'Aditia Prasetio', 'aditia@if.undip.ac.id', 'b77d7d2c9241775b5d3eed6016278199'),
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
  ADD PRIMARY KEY (`id_pkt`);

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
-- Indexes for table `nilai_pkt`
--
ALTER TABLE `nilai_pkt`
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
  MODIFY `id_pkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `daftar_tr1`
--
ALTER TABLE `daftar_tr1`
  MODIFY `id_tr1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
