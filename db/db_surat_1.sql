-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2025 pada 15.42
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `tgl_agenda` date NOT NULL,
  `informasi` text NOT NULL,
  `diteruskan` varchar(50) NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_divisi`
--

CREATE TABLE `tbl_divisi` (
  `id_divisi` int(11) NOT NULL,
  `kode_unor` varchar(10) NOT NULL,
  `nama_divisi` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_divisi`
--

INSERT INTO `tbl_divisi` (`id_divisi`, `kode_unor`, `nama_divisi`, `keterangan`) VALUES
(1, '001', '1234', 'testing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nomor_surat`
--

CREATE TABLE `tbl_nomor_surat` (
  `id_kode` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_nomor_surat`
--

INSERT INTO `tbl_nomor_surat` (`id_kode`, `no_surat`, `kode_surat`, `judul`, `tanggal`, `keterangan`) VALUES
(2, '3/PKB/VI2025', 'PKB', 'JUDUL  3', '2025-06-21', 'JUDUL 2'),
(3, '4/PKS/VI2025', 'PKS', 'JUDUL 2', '2025-06-23', 'BUAT BARU'),
(4, '1/pka/VI2025', 'pka', '123', '2025-06-23', '123'),
(5, '1/cc/VI/2025', 'cc', '123', '2025-06-23', '13\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pendidikan` varchar(10) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `no_sk` varchar(50) NOT NULL,
  `tmk` varchar(50) NOT NULL,
  `tbk` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `kode_unor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama`, `nik`, `jk`, `alamat`, `tempat_lahir`, `tgl_lahir`, `pendidikan`, `no_hp`, `email`, `status`, `no_sk`, `tmk`, `tbk`, `jabatan`, `kode_unor`) VALUES
(1, '123', 'pegawai 1', '', 'Perempuan', 'tangerang', 'bandung', '2025-06-11', 'DI/DII/DII', '08231', 'tes@gmail.com', 'Pegawai Tetap', '13', '2025-06-05', '2025-07-01', '221', '001'),
(2, '456', 'pegawai 2', '', 'Perempuan', 'tangerang', 'bandung', '2025-06-11', 'DI/DII/DII', '08231', 'tes@gmail.com', 'Pegawai Tetap', '13', '2025-06-05', '2025-07-01', '221', '001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_keluar`
--

CREATE TABLE `tbl_surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `tgl_surat_keluar` date NOT NULL,
  `id_kode` int(11) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `lampiran` text NOT NULL,
  `perihal` text NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `isi_surat` text NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `sifat_surat` varchar(50) NOT NULL,
  `tgl_terima` date NOT NULL,
  `no_agenda` varchar(50) NOT NULL,
  `perihal` text NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat_masuk` date NOT NULL,
  `asal_surat` varchar(50) NOT NULL,
  `file_surat_masuk` text NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat_masuk`, `sifat_surat`, `tgl_terima`, `no_agenda`, `perihal`, `no_surat`, `tgl_surat_masuk`, `asal_surat`, `file_surat_masuk`, `nip_pegawai`) VALUES
(1, '1', '2025-06-04', '1', '1', '1', '2025-06-06', '1', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `ttd` text NOT NULL,
  `user_level` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `nip`, `jabatan`, `ttd`, `user_level`, `username`, `password`) VALUES
(2, '1234', '123@gmail.com', '123', '1', 'a28e4f40afdae632af1456b1d7fe4301.png', '1', 'manager123', '0795151defba7a4b5dfa89170de46277'),
(3, '123', '123@gmail.com', '123', '1', 'c37a4abb3e1733ee5ea58db2aee0d5a7.png', '2', '123', '1234567890'),
(5, 'testing123', 'tes@gmail.com', '1234121', '2', '7f6b6846481ace14a2d9fa0eacc5de72.png', '3', 'manager123', '0795151defba7a4b5dfa89170de46277');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `tbl_nomor_surat`
--
ALTER TABLE `tbl_nomor_surat`
  ADD PRIMARY KEY (`id_kode`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indeks untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_nomor_surat`
--
ALTER TABLE `tbl_nomor_surat`
  MODIFY `id_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
