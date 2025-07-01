-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2025 pada 13.52
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
  `status` varchar(20) NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id_disposisi`, `id_surat_masuk`, `tgl_agenda`, `informasi`, `diteruskan`, `status`, `nip_pegawai`) VALUES
(1, 1, '2025-06-28', '', '1', '', '');

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
(1, '001', 'divisi organisasi', 'divisi yang berhubungan dengan organisasi.'),
(2, '002', 'divisi pelayanan', 'divisi yang berhubungan dengan pelayanan.'),
(3, '003', 'divisi penanggulangan bencana', 'divisi yang berhubungan dengan penanggulangan bencana.'),
(4, '004', 'biro umum', 'divisi yang berhubungan dengan bagian umum.'),
(5, '005', 'biro keuangan', 'divisi yang berhubungan dengan bagian keuangan.'),
(6, '006', 'biro kepegawaian', 'divisi yang berhubungan dengan bagian kepegawaian.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kode_surat`
--

CREATE TABLE `tbl_kode_surat` (
  `id_kode` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kode_surat`
--

INSERT INTO `tbl_kode_surat` (`id_kode`, `no_surat`, `kode_surat`, `judul`, `tanggal`, `keterangan`) VALUES
(1, '0', 'ORG', 'Organisasi', '2025-07-01', 'Surat yang berhubungan dengan pembentukan kepengurusan, pembinaan, pemberdayaan Organisasi PMI dan diseminasi.'),
(2, '0', 'PB', 'Penanganan Bencana', '2025-07-01', 'Surat yang berhubungan penanganan bencana.'),
(3, '1', 'PK', 'Pelayanan SOsial', '2025-07-01', 'Surat yang berhubungan dengan kegiatan pelayanan sosial dan kesehatan.'),
(4, '1', 'RLW', 'Relawan', '2025-07-01', 'Surat yang berhubungan dengan pembinaan dan pemberdayaan PMR,KSR dan TSR PMI .'),
(5, '1', 'PSD-KS', 'Kerjasama', '2025-07-01', 'Surat yang berhubungan dengan penggalangan sumberdaya dan kerjasama internasional atau lembaga yang berkedudukan diluar negeri.'),
(6, '1', 'KEP', 'Kepegawaian', '2025-07-01', 'Surat yang berhubungan dengan kepegawaian.'),
(7, '1', 'KEU', 'Keuangan', '2025-07-01', 'Surat yang berhubungan dengan pengelolaan keuangan.'),
(8, '1', 'UM', 'Kesekretariatan', '2025-07-01', 'Surat yang berhubungan dengan kesekratariatan, inventaris/logistik, kantor/markas, rumah tangga kantor/markas dan surat yang berhubungan dengan pengadaan barang.'),
(9, '1', 'HUM', 'Humas', '2025-07-01', 'Surat yang berhubungan dengan kehumasan.'),
(10, '1', 'HK-REN', 'Legisiasi', '2025-07-01', 'Surat yang berhubungan dengan legisiasi dan perencanaan.'),
(11, '1', 'DIKLAT', 'Pelatihan', '2025-07-01', 'Surat yang berhubungan dengan kegiatan pendidikan dan pelatihan kepalangmerahan.'),
(12, '1', 'IT', 'Teknologi', '2025-07-01', 'Surat yang berhubungan dengan teknologi sistem informasi.'),
(13, '1', 'POLI', 'Poliklinik', '2025-07-01', 'Surat yang berhubungan dengan poliklinik,kesehatan dan pengobatan pengurus/pegawai .'),
(14, '1', 'SKAI', 'Audit', '2025-07-01', 'Surat yang berhubungan dengan pelaksanaan internal audit.'),
(15, '1', 'UDD', 'Donor Darah', '2025-07-01', 'Surat yang berhubungan dengan unit donor darah.'),
(16, '1', 'RS', 'Operasional RS', '2025-07-01', 'Surat yang berhubungan dengan kegiatan operasional RS PMI.'),
(17, '1', 'USH', 'Unit Usaha', '2025-07-01', 'Surat yang berhubungan dengan unit usaha.');

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
  `kode_unor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama`, `nik`, `jk`, `alamat`, `tempat_lahir`, `tgl_lahir`, `pendidikan`, `no_hp`, `email`, `status`, `no_sk`, `tmk`, `tbk`, `jabatan`, `kode_unor`) VALUES
(3, '001', 'budi', '12345', 'Laki-laki', 'tangerang', 'tangerang', '2025-07-01', 'DI/DII/DII', '08312345', 'budi@gmail.com', 'Pegawai Tetap', '13', '2025-07-01', '2025-07-09', 'kepala admin', '001'),
(4, '002', 'bahlil', '123456', 'Laki-laki', 'tangerang', 'tangerang', '2025-07-01', 'DI/DII/DII', '08312345', 'bahlil@gmail.com', 'Pegawai Tetap', '123', '2025-07-01', '2025-07-04', 'kepala admin', '003'),
(5, '003', 'Erick Thohir', '123456', 'Laki-laki', 'tangerang', 'tangerang', '2025-07-01', 'DI/DII/DII', '08312345', 'erick@gmail.com', 'Pegawai Tetap', '14', '2025-07-01', '2025-07-11', 'admin operator', 'admin'),
(6, '004', 'luhut', '', 'Laki-laki', 'tangerang', 'tangerang', '2025-07-01', 'S2', '08312345', 'luhut', 'Kontrak', '13', '2025-07-02', '2025-07-02', 'pimpinan', 'pimpinan');

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
  `status` varchar(20) NOT NULL,
  `nip_pegawai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_surat_keluar`
--

INSERT INTO `tbl_surat_keluar` (`id_surat_keluar`, `tgl_surat_keluar`, `id_kode`, `bulan`, `tahun`, `lampiran`, `perihal`, `kepada`, `isi_surat`, `status`, `nip_pegawai`) VALUES
(1, '2025-06-24', 1, '1', '1', '1', '1', '1', '1', '', '1');

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
(1, 'Rahasia', '2025-07-10', '001', 'testing surat masuk', '001/sm/vii/2025', '2025-07-01', 'Dari BPBD', '738b12eae4e4a0818334a23647f2ada8.pdf', '001'),
(2, 'Rahasia', '2025-07-10', '001', 'testing surat masuk', '001/sm/vii/2025', '2025-07-01', 'Dari BPBD', '738b12eae4e4a0818334a23647f2ada8.pdf', '002');

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
(1, 'budi', 'budi@gmail.com', '001', 'admin divisi', 'd27eef1d9182024f2d25cfcf4617f0a7.png', '3', 'budi', 'eea2c1e5e921bba51478fb8ff99fa077'),
(2, 'bahlil', 'bahlil@gmail.com', '002', 'kepala admin', 'c1aa59030b53281d2990021c4dd77f25.png', '3', 'bahlil', '5e3c6abd6c9a90dbd00c53ea3c5f043f'),
(3, 'Erick Thohir', 'erick@gmail.com', '003', 'admin operator', '652efd40e1b4887c27baa5b8a94fe8c7.png', '2', 'erick', '7488e331b8b64e5794da3fa4eb10ad5d'),
(4, 'luhut', 'luhut@gmail.com', '004', 'pimpinan', '11abecfe884e19206129a8a02144970a.png', '1', 'luhut', '9f253f5b155f1832170f6e8ee8c6fa5c');

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
-- Indeks untuk tabel `tbl_kode_surat`
--
ALTER TABLE `tbl_kode_surat`
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
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_kode_surat`
--
ALTER TABLE `tbl_kode_surat`
  MODIFY `id_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
