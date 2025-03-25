-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2024 pada 03.34
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spfc2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `basis_aturan`
--

CREATE TABLE `basis_aturan` (
  `idaturan` int(11) NOT NULL,
  `idkerusakan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `basis_aturan`
--

INSERT INTO `basis_aturan` (`idaturan`, `idkerusakan`) VALUES
(21, 3),
(22, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_basis_aturan`
--

CREATE TABLE `detail_basis_aturan` (
  `idaturan` int(11) DEFAULT NULL,
  `idgejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_basis_aturan`
--

INSERT INTO `detail_basis_aturan` (`idaturan`, `idgejala`) VALUES
(21, 11),
(22, 1),
(21, 9),
(21, 10),
(22, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kerusakan`
--

CREATE TABLE `detail_kerusakan` (
  `idkonsultasi` int(11) DEFAULT NULL,
  `idkerusakan` int(11) DEFAULT NULL,
  `persentase` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_kerusakan`
--

INSERT INTO `detail_kerusakan` (`idkonsultasi`, `idkerusakan`, `persentase`) VALUES
(9, 5, 100),
(9, 6, 100),
(11, 5, 25),
(11, 6, 50),
(12, 5, 25),
(12, 6, 50),
(13, 5, 25),
(13, 6, 50),
(14, 5, 25),
(14, 6, 50),
(15, 5, 50),
(15, 6, 25),
(18, 6, 75),
(19, 6, 75),
(20, 5, 50),
(20, 6, 25),
(22, 6, 25),
(23, 6, 25),
(24, 3, 100),
(25, 3, 67),
(26, 3, 67),
(27, 3, 33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `idkonsultasi` int(11) DEFAULT NULL,
  `idgejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `detail_konsultasi`
--

INSERT INTO `detail_konsultasi` (`idkonsultasi`, `idgejala`) VALUES
(25, 11),
(25, 10),
(26, 11),
(26, 10),
(27, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `kdgejala` varchar(11) DEFAULT NULL,
  `nmgejala` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`idgejala`, `kdgejala`, `nmgejala`) VALUES
(1, 'G01', 'Kinerja melambat'),
(2, 'G02', 'Sering Blue Screen (BOSD) atau black screen'),
(3, 'G03', 'Sistem crash atau freeze'),
(4, 'G04', 'Boot loop atau tidak bisa booting'),
(5, 'G05', 'Masalah konektivitas jaringan'),
(6, 'G06', 'Banyak aplikasi yang tidak bisa diakses'),
(7, 'G07', 'Hardware tidak terdeteksi'),
(8, 'G08', 'Masalah pada konektivitas USB'),
(9, 'G09', 'Baterai cepat habis'),
(10, 'G10', 'Mati pada saat tidak di colok charger'),
(11, 'G11', 'Baterai tidak terdeteksi'),
(12, 'G12', 'Indikator hidup tapi display tidak tampil'),
(13, 'G13', 'Sistem crash atau error'),
(14, 'G14', 'Muncul pesan no bootable devices'),
(15, 'G15', 'Data tiba tiba hilang atau corrupt'),
(16, 'G16', 'Terdengar bunyi aneh dari Hard Disk'),
(18, 'G17', 'Mati total');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerusakan`
--

CREATE TABLE `kerusakan` (
  `idkerusakan` int(11) NOT NULL,
  `kdkerusakan` varchar(11) NOT NULL,
  `nmkerusakan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `solusi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kerusakan`
--

INSERT INTO `kerusakan` (`idkerusakan`, `kdkerusakan`, `nmkerusakan`, `keterangan`, `solusi`) VALUES
(1, 'K01', 'Software OS', 'Kerusakan yang berfokus pada software yaitu sistem operasi dimana sistem mengalami crash.', 'Lakukan pengecekan pada sistem dan registri; lakukan sistem update; lakukan sistem restore; lakukan install ulang sistem bila perlu.'),
(2, 'K02', 'Software Driver', 'Kerusakan pada software yaitu driver sebagai penghubung antara sistem dengan hardware.', 'Lakukan update driver dan atau install ulang driver.'),
(3, 'K03', 'Baterai', 'Kerusakan pada baterai bisa disebabkan karena kurang perawatan maupun faktor usia baterai.', 'Lakukan pengecekan pada baterai; lakukan pergantian dengan baterai baru.'),
(4, 'K04', 'RAM', 'Biasamya jarang terjadi, namun ini mungkin saja terjadi. Biasanya akibat ram kotor atau memang rusak.', 'Bersihkan kuningan ram menggunakan penghapus; lakukan pergantian RAM.'),
(5, 'K05', 'HARDDISK / SSD', 'Kerusakan pada bagian penyimpanan internal.', 'Lakukan pengecekan lebih lanjut dan lakukan penggantian jika perlu. Kerusakan tingkat menengah.'),
(6, 'K06', 'Motherboard / Mesin Utama', 'Kerusakan pada mainboard yaitu mesin utama yang menghubungkan semua hadrware satu sama lain.', 'Kerusakan tingkat tinggi harus ditangani oleh teknisi berpengalaman, sebaiknya serahkan kepada teknisi.'),
(7, 'K07', 'Layar Display', 'Kerusakan pada bagian tampilan berupa layar LCD atau LED.', 'Lakukan penggantian pada layar, kerusakan tingkat sedang harus berhati hati jika beum berpengalaman.'),
(8, 'K08', 'VGA', 'Kerusakan yang sering ditemui di laptop yang memiliki double VGA atau VGA yg terpisah dari SOC.', 'Kerusakan tingkat tinggi harus ditangani oleh teknisi ahli, sebaiknya serahkan kepada teknisi.'),
(9, 'K09', 'Keyboard', 'Sering terjadi akibat laptop tidak pernah dipakai yang akhirnya berjamur dibagian dalam.', 'Bersihkan keyboard; lakukan penggantian keyboard; di beberapa laptop membutuhkan penanganan teknisi berpengalaman.'),
(10, 'K10', 'Touchpad', 'Touchpad berfungsi untuk menggerakan kursor pada laptop.', 'Lakukan pengecekan lebih lanjut; lakukan penggantian; membutuhkan teknisi berpengalaman.'),
(11, 'K11', 'Sistem Pendingin', 'Sistem pendinginan sering di abaikan oleh pengguna, namun sebenarnya ini sangat penting.', 'Lakukan pergantian pasta pendingin; jika fan mati, lakukan penggantian fan;');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tipelaptop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`idkonsultasi`, `username`, `tanggal`, `nama`, `tipelaptop`) VALUES
(25, 'Akbar', '2024-07-05', 'Muhamad Akbar', 'Thinkpad X250'),
(26, 'Akbar', '2024-07-06', 'Muhamad Akbar', 'X250'),
(27, 'Udin', '2024-07-08', 'Udin', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`idusers`, `nama`, `no_hp`, `username`, `pass`, `role`) VALUES
(5, '', '', 'Udin', '62b014dbdfa6e8c4cfc51489c23deef3', 'User'),
(12, 'Akbar Fajri', '0843038', 'Akbar', '202cb962ac59075b964b07152d234b70', 'Admin'),
(19, 'Muhamad Akbar', '085890216240', 'afmtsans', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `basis_aturan`
--
ALTER TABLE `basis_aturan`
  ADD PRIMARY KEY (`idaturan`) USING BTREE;

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`);

--
-- Indeks untuk tabel `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`idkerusakan`) USING BTREE;

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`idkonsultasi`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `basis_aturan`
--
ALTER TABLE `basis_aturan`
  MODIFY `idaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kerusakan`
--
ALTER TABLE `kerusakan`
  MODIFY `idkerusakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `idkonsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
