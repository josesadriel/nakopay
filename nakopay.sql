-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2020 pada 13.39
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id12074195_nakopay`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_bisnis`
--

CREATE TABLE `akun_bisnis` (
  `id_user` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `noHp` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `nama_usaha` text COLLATE utf8_unicode_ci NOT NULL,
  `api_key` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `akun_bisnis`
--

INSERT INTO `akun_bisnis` (`id_user`, `noHp`, `nama_usaha`, `api_key`) VALUES
('09081219483348', '081219483348', 'VapeSmoke', '67cff63ec836ef25a39f82b80e5cb38a'),
('09089625769346', '089625769346', 'Daily Star', '01b7b21382626d84b2ccccc2d1cd9378');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `kode` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `item` text COLLATE utf8_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `pemilik` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('lunas','belum') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'belum',
  `dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `username` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`kode`, `item`, `nominal`, `pemilik`, `status`, `dibuat`, `username`) VALUES
('0122569874154', 'Memories - Maroon 5;', 15000, '09089625769346', 'lunas', '2020-01-06 16:26:20', 'el85'),
('0122569874303', 'Memories - Maroon 5;Be The Light - ONE OK ROCK;', 65000, '09089625769346', 'belum', '2020-01-11 08:09:46', 'el85'),
('0178780071391', 'Memories - Maroon 5;Be The Light - ONE OK ROCK;On My Way - Alan Walker;Without Me - Halsey;', 105000, '09089625769346', 'belum', '2020-01-19 13:24:53', 'excaliburyuu'),
('0178861403491', 'Memories - Maroon 5;', 15000, '09089625769346', 'belum', '2020-01-05 17:18:36', 'josesadriel'),
('0178861403571', 'Memories - Maroon 5;', 15000, '09089625769346', 'lunas', '2020-01-05 16:30:51', 'josesadriel'),
('0196257693090', 'Be The Light - ONE OK ROCK;', 50000, '09089625769346', 'belum', '2020-01-09 10:33:31', 'admin'),
('0196257693554', 'Be The Light - ONE OK ROCK;', 50000, '09089625769346', 'lunas', '2020-01-19 10:33:52', 'admin'),
('0196257693666', 'Memories - Maroon 5;', 15000, '09089625769346', 'belum', '2020-01-06 15:55:43', 'josesadriel'),
('0196257693699', 'Be the Light - ONE OK ROCK;', 15000, '09089625769346', 'lunas', '2020-01-06 15:39:17', 'josesadriel'),
('0197851312906', 'Be The Light - ONE OK ROCK;', 50000, '09089625769346', 'lunas', '2020-01-05 15:10:00', 'excaliburyuu'),
('12511836241', 'HEXOHM 3.0 30AMP 180W BOX MOD;', 3200000, '09081219483348', 'belum', '2020-01-18 15:32:55', 'admin'),
('12524308287', 'CONTOH 2;', 422222, '09081219483348', 'lunas', '2020-01-16 15:35:21', 'admin'),
('12592189518', 'VB;TEST 1;', 420000, '09089625769346', 'belum', '2020-01-15 16:21:06', 'admin'),
('12948569648', 'TEST 1;', 50000, '09081219483348', 'belum', '2020-01-15 16:38:38', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(15) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `target_user` varchar(15) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `nominal` int(11) NOT NULL DEFAULT 0,
  `kategori` enum('debit','credit') NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `target_user`, `tanggal`, `nominal`, `kategori`, `deskripsi`) VALUES
('01612016391750', '09089625769346', '12524308287', '2020-01-16 16:39:17', 422222, 'credit', 'Transfer via Virtual Account Rp. 422222 ke 12524308287'),
('01912011115038', '09089691843591', '0196257693554', '2020-01-19 11:11:50', 50000, 'credit', 'Transfer via Virtual Account Rp. 50000 ke 0196257693554'),
('0512014533835', '09081282200921', '0197851312572', '2020-01-05 14:53:38', 50000, 'credit', 'Transfer via Virtual Account Rp. 50000 ke 0197851312572'),
('0512015111953', '09081282200921', '0197851312906', '2020-01-05 15:11:19', 50000, 'credit', 'Transfer via Virtual Account Rp. 50000 ke 0197851312906'),
('0512016370236', '09081282200921', '0178861403571', '2020-01-05 16:37:02', 15000, 'credit', 'Transfer via Virtual Account Rp. 15000 ke 0178861403571'),
('0612015400744', '09089691843591', '0196257693699', '2020-01-06 15:40:07', 15000, 'credit', 'Transfer via Virtual Account Rp. 15000 ke 0196257693699'),
('0612016521144', '09082266359215', '0122569874154', '2020-01-06 16:52:11', 15000, 'credit', 'Transfer via Virtual Account Rp. 15000 ke 0122569874154'),
('11612016391750', '09081219483348', '09089625769346', '2020-01-16 16:39:17', 422222, 'debit', 'Menerima uang melalui Virtual Account Rp. 422222 dari 09089625769346'),
('11912011115038', '09089625769346', '09089691843591', '2020-01-19 11:11:50', 50000, 'debit', 'Menerima uang melalui Virtual Account Rp. 50000 dari 09089691843591'),
('1512014533835', '09089625769346', '09081282200921', '2020-01-05 14:53:38', 50000, 'debit', 'Menerima uang melalui Virtual Account Rp. 50000 dari 09081282200921'),
('1512015111953', '09089625769346', '09081282200921', '2020-01-05 15:11:19', 50000, 'debit', 'Menerima uang melalui Virtual Account Rp. 50000 dari 09081282200921'),
('1512016370236', '09089625769346', '09081282200921', '2020-01-05 16:37:02', 15000, 'debit', 'Menerima uang melalui Virtual Account Rp. 15000 dari 09081282200921'),
('1612015400744', '09089625769346', '09089691843591', '2020-01-06 15:40:07', 15000, 'debit', 'Menerima uang melalui Virtual Account Rp. 15000 dari 09089691843591'),
('1612016521144', '09089625769346', '09082266359215', '2020-01-06 16:52:11', 15000, 'debit', 'Menerima uang melalui Virtual Account Rp. 15000 dari 09082266359215');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(15) NOT NULL,
  `nama` text NOT NULL,
  `pin` varchar(6) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL,
  `tgl_Lahir` date NOT NULL,
  `profile_img` varchar(15) NOT NULL DEFAULT 'default.png',
  `saldo` int(7) NOT NULL DEFAULT 1000000,
  `lastLogin` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('user','bisnis') NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `pin`, `no_hp`, `alamat`, `email`, `tgl_Lahir`, `profile_img`, `saldo`, `lastLogin`, `status`) VALUES
('09089625769346', 'Joses Adriel', '123456', '089625769346', 'Jl. Labu dalam', 'joses.8c22@gmail.com', '1999-09-09', 'default.png', 772778, '2020-01-19', 'bisnis'),
('09089691843591', 'zakuya', '291199', '089691843591', 'pgp', 'irawanandy11@gmail.com', '1998-02-11', 'default.png', 935000, '2020-01-03', 'user'),
('09081282200921', 'Jeffry Andiyanto', '123456', '081282200921', 'Sunter Agung Permai 12 Block C11 Number 26', 'jandiyanto@yahoo.com', '1999-11-27', 'default.png', 885000, '2020-01-05', 'user'),
('09082266359215', 'Delviana', '082266', '082266359215', 'Bogor', 'del@gmail.com', '1998-09-07', 'default.png', 985000, '2020-01-06', 'user'),
('09081219483348', 'Erland', '123456', '081219483348', '-', 'b812lan@gmail.com', '1999-12-10', 'default.png', 1422222, '2020-01-16', 'bisnis');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_bisnis`
--
ALTER TABLE `akun_bisnis`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
