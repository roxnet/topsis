-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Des 2017 pada 16.43
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
('B-0003', 'Pelayan'),
('B-0004', 'Kuli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_penilaian`
--

CREATE TABLE `bobot_penilaian` (
  `id_bobot` int(11) NOT NULL,
  `id_kriteria` char(8) DEFAULT NULL,
  `id_bagian` char(8) DEFAULT NULL,
  `jabatan` enum('manager','HRD','koordinator','karyawan') DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_penilaian`
--

INSERT INTO `bobot_penilaian` (`id_bobot`, `id_kriteria`, `id_bagian`, `jabatan`, `bobot`) VALUES
(6, 'K-0001', 'B-0001', 'karyawan', 1),
(7, 'K-0002', 'B-0001', 'karyawan', 2),
(8, 'K-0003', 'B-0001', 'karyawan', 3),
(9, 'K-0004', 'B-0001', 'karyawan', 4),
(10, 'K-0005', 'B-0001', 'karyawan', 5);

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
(1, 'P-0001', 26, 'B-0001', 'koordinator', b'1', '2017-11-27'),
(2, 'P-0002', 26, 'B-0001', 'manager', b'1', '2017-12-02');

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
('K-0002', 'Tanggung Jawab', 'K'),
('K-0003', 'Kejujuran', 'K'),
('K-0004', 'Alpa/Absen', 'B'),
('K-0005', 'Kebersihan', 'K');

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
('P-0001', 'Anas', 'Bima', '2011-04-01', 'L', 'Islam', 'Belum kawin', '082137677011', 'Jl. cerita lama no 90 yogyakarta 55571', '2017-08-01'),
('P-0002', 'Joko', 'Bantul', '2012-09-01', 'L', 'Islam', 'Kawin', '08123456000', 'jl. kenangan indah no 100 bantul', '2017-07-01'),
('P-0003', 'Malingi', 'Bantul', '2011-09-02', 'P', 'Islam', 'Kawin', '081234560888', 'jl. pahit bangat no 23 sleman', '2017-07-01'),
('P-0004', 'Khairullah', 'Bima', '2013-09-01', 'L', 'Islam', 'Belum kawin', '08123456444', 'Jl. berliku liku no.97 bima', '2017-08-04'),
('P-0005', 'Wawa', 'Bantul', '2017-09-04', 'P', 'Islam', 'Kawin', '082137677011', 'Jln penuh misteri No.80 bantul', '2017-09-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_nilai` int(11) NOT NULL,
  `id_bobot` int(11) DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `tgl_penilaian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_nilai`, `id_bobot`, `id_jabatan`, `nilai`, `tgl_penilaian`) VALUES
(1, 6, 1, '42.00', '2017-12-03'),
(2, 7, 1, '23.00', '2017-12-03'),
(3, 8, 1, '41.00', '2017-12-03'),
(4, 9, 1, '52.00', '2017-12-03'),
(5, 10, 1, '70.00', '2017-12-03');

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
(26, 'Pamella 1', 'Jalan Pamella 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_name` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `hak_akses` varchar(20) DEFAULT NULL,
  `id_pegawai` char(8) DEFAULT NULL
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
  ADD KEY `FK_bobot_penilaian_kriteria` (`id_kriteria`),
  ADD KEY `FK_bobot_penilaian_bagian` (`id_bagian`);

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
  ADD KEY `FK_penilaian_bobot_penilaian` (`id_bobot`),
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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  ADD CONSTRAINT `FK_bobot_penilaian_bagian` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bobot_penilaian_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_penilaian_bobot_penilaian` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_penilaian` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE,
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
