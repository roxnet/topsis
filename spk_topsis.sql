-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 Okt 2017 pada 11.51
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
('B-0002', 'Pelayanan Kosmetik'),
('B-0003', 'Gudang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` char(8) NOT NULL,
  `tgl_penilaian` date NOT NULL,
  `total_penilaian` int(11) DEFAULT NULL,
  `no_pegawai` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `tgl_penilaian`, `total_penilaian`, `no_pegawai`) VALUES
('N-0001', '2017-10-30', 0, 'P-0004'),
('N-0002', '2017-10-30', 0, 'P-0005');

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
('I-003', 'Halaman Pernyataan', '2017-10-11 04:59:54', 'Dengan ini saya menyatakan bahwa Laporan Skripsi ini tidak terdapat karya yang pernah diajukan untuk memperoleh gelar Ahli Madya/Kesarjanaan di suatu Perguruan Tinggi, dan sepanjang pengetahuan saya juga tidak terdapat karya atau pendapat yang pernah ditulus atau diterbitkan oleh orang lain, kecuali yang secara tertulis diacu dalam naskah ini dan disebutkan dalam daftar pustaka.'),
('I-004', 'qwerty', '2017-10-21 08:12:52', 'dcfdsvfdvfdsvsd');

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
('K-0005', 'Kebersihan', 'K'),
('K-0006', 'Kerjasama', 'K');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_bagian`
--

CREATE TABLE `kriteria_bagian` (
  `id_kriteria` char(8) NOT NULL,
  `id_bagian` char(8) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_bagian`
--

INSERT INTO `kriteria_bagian` (`id_kriteria`, `id_bagian`, `bobot`) VALUES
('K-0001', 'B-0001', 4),
('K-0002', 'B-0001', 4),
('K-0003', 'B-0001', 4),
('K-0004', 'B-0001', 5),
('K-0005', 'B-0001', 3),
('K-0006', 'B-0001', 3);

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
  `pamella` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`no_pegawai`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jekel`, `agama`, `status_perkawinan`, `no_telp`, `alamat`, `pamella`, `tgl_masuk`) VALUES
('P-0001', 'Anas', 'Bima', '2011-04-01', 'L', 'Islam', 'Belum kawin', '082137677011', 'Jl. cerita lama no 90 yogyakarta 55571', 'Pamella 1', '2017-08-01'),
('P-0002', 'Joko', 'Bantul', '2012-09-01', 'L', 'Islam', 'Kawin', '08123456000', 'jl. kenangan indah no 100 bantul', 'Pamella 1', '2017-07-01'),
('P-0003', 'Malingi', 'Bantul', '2011-09-02', 'P', 'Islam', 'Kawin', '081234560888', 'jl. pahit bangat no 23 sleman', 'Pamella 1', '2017-07-01'),
('P-0004', 'Khairullah', 'Bima', '2013-09-01', 'L', 'Islam', 'Belum kawin', '08123456444', 'Jl. berliku liku no.97 bima', 'Pamella 1', '2017-08-04'),
('P-0005', 'Wawa', 'Bantul', '2017-09-04', 'P', 'Islam', 'Kawin', '082137677011', 'Jln penuh misteri No.80 bantul', 'Pamella 2', '2017-09-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_hasil` char(8) NOT NULL,
  `id_kriteria` char(8) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_hasil`, `id_kriteria`, `nilai`) VALUES
('N-0001', 'K-0001', 75),
('N-0001', 'K-0002', 80),
('N-0001', 'K-0003', 75),
('N-0001', 'K-0004', 2),
('N-0001', 'K-0005', 80),
('N-0001', 'K-0006', 60),
('N-0002', 'K-0001', 60),
('N-0002', 'K-0002', 70),
('N-0002', 'K-0003', 75),
('N-0002', 'K-0004', 2),
('N-0002', 'K-0005', 85),
('N-0002', 'K-0006', 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pegawai`
--

CREATE TABLE `riwayat_pegawai` (
  `no_pegawai` char(8) NOT NULL,
  `id_bagian` char(8) NOT NULL,
  `tmt` date NOT NULL,
  `status` enum('Koordinator','Pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat_pegawai`
--

INSERT INTO `riwayat_pegawai` (`no_pegawai`, `id_bagian`, `tmt`, `status`) VALUES
('P-0001', 'B-0001', '2017-08-01', 'Koordinator'),
('P-0002', 'B-0001', '2017-08-02', 'Pegawai'),
('P-0003', 'B-0001', '2017-08-08', 'Pegawai'),
('P-0004', 'B-0001', '2017-09-20', 'Pegawai'),
('P-0005', 'B-0001', '2017-08-01', 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_name` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `hak_akses` varchar(20) DEFAULT NULL,
  `no_pegawai` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `no_pegawai` (`no_pegawai`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_bagian`
--
ALTER TABLE `kriteria_bagian`
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no_pegawai`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD KEY `id_hasil` (`id_hasil`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `riwayat_pegawai`
--
ALTER TABLE `riwayat_pegawai`
  ADD KEY `no_pegawai` (`no_pegawai`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_name`),
  ADD KEY `no_pegawai` (`no_pegawai`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`no_pegawai`) REFERENCES `riwayat_pegawai` (`no_pegawai`);

--
-- Ketidakleluasaan untuk tabel `kriteria_bagian`
--
ALTER TABLE `kriteria_bagian`
  ADD CONSTRAINT `kriteria_bagian_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `kriteria_bagian_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_hasil`) REFERENCES `hasil` (`id_hasil`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel `riwayat_pegawai`
--
ALTER TABLE `riwayat_pegawai`
  ADD CONSTRAINT `riwayat_pegawai_ibfk_1` FOREIGN KEY (`no_pegawai`) REFERENCES `pegawai` (`no_pegawai`),
  ADD CONSTRAINT `riwayat_pegawai_ibfk_2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`no_pegawai`) REFERENCES `pegawai` (`no_pegawai`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
