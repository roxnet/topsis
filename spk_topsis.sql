-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Des 2017 pada 11.45
-- Versi server: 5.7.19
-- Versi PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_topsis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` char(8) NOT NULL,
  `bagian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `bagian`) VALUES
('B-0001', 'Kasir'),
('B-0002', 'Gudang'),
('B-0003', 'Pelayan Kosmetik'),
('B-0004', 'Pelayan Pakaian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_penilaian`
--

CREATE TABLE `bobot_penilaian` (
  `id_bobot` int(11) NOT NULL,
  `id_bagian` char(8) DEFAULT NULL,
  `jabatan` enum('manager','HRD','koordinator','karyawan') DEFAULT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_penilaian`
--

INSERT INTO `bobot_penilaian` (`id_bobot`, `id_bagian`, `jabatan`, `status`) VALUES
(3, 'B-0001', 'karyawan', b'0'),
(5, 'B-0001', 'karyawan', b'1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_bobot`
--

CREATE TABLE `detail_bobot` (
  `id_detailbobot` int(11) NOT NULL,
  `id_bobot` int(11) DEFAULT NULL,
  `id_kriteria` char(50) DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL,
  `akumulasi` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_bobot`
--

INSERT INTO `detail_bobot` (`id_detailbobot`, `id_bobot`, `id_kriteria`, `bobot`, `akumulasi`) VALUES
(25, 3, 'K-0001', 90, '21.33'),
(26, 3, 'K-0002', 80, '18.96'),
(27, 3, 'K-0003', 75, '17.77'),
(28, 3, 'K-0004', 2, '0.47'),
(29, 3, 'K-0005', 90, '21.33'),
(30, 3, 'K-0006', 85, '20.14'),
(37, 5, 'K-0001', 90, '22.67'),
(38, 5, 'K-0002', 80, '20.15'),
(39, 5, 'K-0003', 95, '23.93'),
(40, 5, 'K-0004', 2, '0.50'),
(41, 5, 'K-0005', 70, '17.63'),
(42, 5, 'K-0006', 60, '15.11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id_detailnilai` int(11) NOT NULL,
  `id_nilai` int(11) DEFAULT NULL,
  `id_detailbobot` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penilaian`
--

INSERT INTO `detail_penilaian` (`id_detailnilai`, `id_nilai`, `id_detailbobot`, `nilai`) VALUES
(7, 4, 37, 80),
(8, 4, 38, 90),
(9, 4, 39, 90),
(10, 4, 40, 2),
(11, 4, 41, 80),
(12, 4, 42, 70),
(13, 5, 38, 80),
(14, 5, 39, 78),
(15, 5, 40, 3),
(16, 5, 41, 78),
(17, 5, 42, 50),
(18, 5, 37, 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` char(7) NOT NULL,
  `judul` varchar(40) NOT NULL,
  `tanggal` datetime NOT NULL,
  `informasi` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `judul`, `tanggal`, `informasi`) VALUES
('I-001', 'Latar Belakang Masalah', '2017-10-09 04:57:25', 'Pamella Supermarket merupakan salah satu supermarket terbesar di Yogyakarta. Pamella Supermarket dikenal memiliki produk lengkap, serta harga yang kompetitif. Delapan cabang yang kini berdiri di daerah Yogyakarta menjadi salah satu bukti eksistensi Pamella Supermarket dalam persaingan bisnis ritel yang semakin merajalela dewasa ini, khususnya di kota â€“ kota besar. Dengan banyaknya persaingan tersebut maka Pamella Supermarket memiliki cara tersendiri dalam memanajemen usahanya, salah satunya memberikan pelayanan terbaik kepada pelanggan.\r\nSalah satu misi dari Pamella Supermarket adalah berupaya meningkatkan kualitas SDM Pamella Supermarket sedemikian, sehingga memiliki pola hidup dan sikap yang islami. Untuk merealisasikan misi tersebut maka Pamella Supermarket mempekerjakan pegawai yang memenuhi kriteria demi tercapainya misi perusahaan. \r\nUntuk meningkatkan dan mempertahankan misi tersebut, maka Pamella Supermarket Yogyakarta memberikan penilaian terhadap kinerja setiap pegawai. Dari hasil penilaian tersebut nantinya akan digunakan untuk pengambilan keputusan pemilihan pegawai terbaik dengan menggunakan beberapa kriteria yang telah ada. \r\n \r\nDi Pamella Supermarket Yogyakarta dalam melakukan penilaian pegawai dan pengambilan keputusan pemilihan pegawai terbaik masih menggunakan catatan manual dan perhitungan manual dengan bantuan kalkulator. Dengan hal tersebut, maka memungkinkan tidak konsisten dalam proses perhitungan dan pengunaan bobot serta kriteria yang sudah ada. \r\n'),
('I-002', 'Tujuan Penelitian', '2017-10-10 04:58:06', 'Tujuan yang ingin dicapai dalam penelitian ini adalah membuat sistem pendukung keputusan pemilihan pegawai terbaik dengan metode TOPSIS untuk membantu pengambilan keputusan pemilihan pegawai terbaik di Pamella Supermarket Yogyakarta.\r\n'),
('I-003', 'Halaman Pernyataan', '2017-10-11 04:59:54', 'Dengan ini saya menyatakan bahwa Laporan Skripsi ini tidak terdapat karya yang pernah diajukan untuk memperoleh gelar Ahli Madya/Kesarjanaan di suatu Perguruan Tinggi, dan sepanjang pengetahuan saya juga tidak terdapat karya atau pendapat yang pernah ditulus atau diterbitkan oleh orang lain, kecuali yang secara tertulis diacu dalam naskah ini dan disebutkan dalam daftar pustaka.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_pegawai`
--

CREATE TABLE `jabatan_pegawai` (
  `id_jabatan` int(11) NOT NULL,
  `id_pegawai` char(8) NOT NULL DEFAULT '0',
  `id_toko` int(11) NOT NULL DEFAULT '0',
  `id_bagian` char(8) NOT NULL DEFAULT '0',
  `jabatan` enum('manager','HRD','koordinator','karyawan') NOT NULL,
  `Status` bit(1) NOT NULL,
  `tgl_jabat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan_pegawai`
--

INSERT INTO `jabatan_pegawai` (`id_jabatan`, `id_pegawai`, `id_toko`, `id_bagian`, `jabatan`, `Status`, `tgl_jabat`) VALUES
(1, 'P-0001', 27, 'B-0001', 'karyawan', b'1', '2017-12-06'),
(2, 'P-0003', 27, 'B-0001', 'karyawan', b'1', '2017-06-13'),
(3, 'P-0002', 27, 'B-0001', 'karyawan', b'1', '2017-12-06'),
(4, 'P-0004', 27, 'B-0001', 'karyawan', b'1', '2017-12-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(8) NOT NULL,
  `nama_kriteria` varchar(25) NOT NULL,
  `atribut` enum('K','B') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `atribut`) VALUES
('K-0001', 'Kedisiplinan', 'K'),
('K-0002', 'Tanggung jawab', 'K'),
('K-0003', 'Kejujuran', 'K'),
('K-0004', 'Alfa/Absen', 'B'),
('K-0005', 'Kebersihan', 'K'),
('K-0006', 'Budaya', 'K');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `no_pegawai` char(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jekel` enum('L','P') NOT NULL,
  `agama` varchar(10) NOT NULL,
  `status_perkawinan` varchar(15) NOT NULL,
  `no_telp` char(13) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`no_pegawai`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jekel`, `agama`, `status_perkawinan`, `no_telp`, `alamat`, `tgl_masuk`) VALUES
('P-0001', 'Arifah', 'Bantul', '1996-02-03', 'L', 'Islam', 'Belum kawin', '085643132000', 'Jalan Raya Bantul', '2012-01-20'),
('P-0002', 'Kiki', 'Yogyakarta', '1990-12-05', 'L', 'Islam', 'Belum kawin', '082241403727', 'Bantul', '2016-01-04'),
('P-0003', 'Niswa', 'Bantul', '1991-01-01', 'L', 'Islam', 'Belum kawin', '086543210000', 'Jalan Imogiri', '2013-02-05'),
('P-0004', 'Brian', 'Sleman', '1990-10-03', 'L', 'Islam', 'Kawin', '089765432100', 'Jalan Kusumanegara', '2013-01-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_nilai` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_nilai`, `id_jabatan`, `tgl_penilaian`, `status`) VALUES
(4, 1, '2017-12-25', b'0'),
(5, 1, '2017-12-25', b'1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`) VALUES
(27, 'Pamella 1', 'Jl. Kusumanegara 135-141 Yogyakarta'),
(28, 'Pamella 2', '	Jl. Pandean 16 Yogyakarta'),
(29, 'Pamella 3', '	Jl. Wonocatur No. 377 Banguntapan Yogyakarta'),
(30, 'Pamella 4', '	Jl. Pramuka No.84 Yogyakarta'),
(31, 'Pamella 6', 'Jl. Raya Candigebang CC. Yogyakarta'),
(32, 'Pamella 7', 'Ds. Bromonillan, Purwomartani, Kalasan,Sleman, Yogyakarta'),
(33, 'Pamella 8', 'Jl. Lowanu 88 Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_name` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `hak_akses` int(1) DEFAULT NULL,
  `id_pegawai` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_name`, `password`, `hak_akses`, `id_pegawai`) VALUES
('admin', 'admin', 0, NULL),
('arifah', 'arifah', 1, 'P-0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usulan`
--

CREATE TABLE `usulan` (
  `id_usulan` int(11) NOT NULL,
  `no_pegawai` char(8) NOT NULL,
  `nama_pegawai` char(50) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `nilai` decimal(10,8) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `periode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `FK_bobot_penilaian_bagian` (`id_bagian`);

--
-- Indeks untuk tabel `detail_bobot`
--
ALTER TABLE `detail_bobot`
  ADD PRIMARY KEY (`id_detailbobot`),
  ADD KEY `FK_detail_bobot_bobot_penilaian` (`id_bobot`),
  ADD KEY `FK_detail_bobot_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id_detailnilai`),
  ADD KEY `FK_detail_penilaian_penilaian` (`id_nilai`),
  ADD KEY `FK_detail_penilaian_detail_bobot` (`id_detailbobot`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `FK_jabatan_pegawai_pegawai` (`id_pegawai`),
  ADD KEY `FK_jabatan_pegawai_toko` (`id_toko`),
  ADD KEY `FK_jabatan_pegawai_bagian` (`id_bagian`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no_pegawai`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `FK_penilaian_jabatan_pegawai` (`id_jabatan`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `FK_user_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id_usulan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detail_bobot`
--
ALTER TABLE `detail_bobot`
  MODIFY `id_detailbobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id_detailnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  ADD CONSTRAINT `FK_bobot_penilaian_bagian` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_bobot`
--
ALTER TABLE `detail_bobot`
  ADD CONSTRAINT `FK_detail_bobot_bobot_penilaian` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_penilaian` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detail_bobot_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `FK_detail_penilaian_detail_bobot` FOREIGN KEY (`id_detailbobot`) REFERENCES `detail_bobot` (`id_detailbobot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detail_penilaian_penilaian` FOREIGN KEY (`id_nilai`) REFERENCES `penilaian` (`id_nilai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  ADD CONSTRAINT `FK_jabatan_pegawai_bagian` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_jabatan_pegawai_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`no_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_jabatan_pegawai_toko` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `FK_penilaian_jabatan_pegawai` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan_pegawai` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`no_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
