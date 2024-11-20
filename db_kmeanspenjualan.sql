-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2022 pada 04.01
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
-- Database: `db_kmeanspenjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `centroid`
--

CREATE TABLE `centroid` (
  `id_centroid` int(5) NOT NULL,
  `nm_data` varchar(200) NOT NULL,
  `data_centroid` varchar(255) NOT NULL,
  `iterasi` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `centroid`
--

INSERT INTO `centroid` (`id_centroid`, `nm_data`, `data_centroid`, `iterasi`, `ket`) VALUES
(1, 'Tani makmur', ',22,2200,45', '', 'data'),
(2, 'Lebah', ',25,2500,50', '', 'data'),
(3, 'Renon', ',20,2285,43', '', 'data'),
(123, '', ',22.555555555556,2283.7222222222,41.666666666667', '4', 'uji'),
(122, '', ',23.666666666667,2577.5,48.333333333333', '4', 'uji'),
(121, '', ',19.92,1775.64,32.68', '4', 'uji'),
(118, '', ',19.92,1775.64,32.68', '3', 'uji'),
(119, '', ',23.666666666667,2577.5,48.333333333333', '3', 'uji'),
(120, '', ',22.555555555556,2283.7222222222,41.666666666667', '3', 'uji'),
(117, '', ',22.529411764706,2297.1764705882,42.529411764706', '2', 'uji'),
(116, '', ',23.666666666667,2577.5,48.333333333333', '2', 'uji'),
(115, '', ',20.038461538462,1786.3846153846,32.461538461538', '2', 'uji'),
(113, '', ',23.6,2506.5,47.7', '1', 'uji'),
(114, '', ',22.625,2308.375,40.5', '1', 'uji'),
(112, '', ',20.290322580645,1852.6129032258,34.064516129032', '1', 'uji');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagram`
--

CREATE TABLE `diagram` (
  `id_diagram` int(5) NOT NULL,
  `x` text NOT NULL,
  `y` text NOT NULL,
  `cluster` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diagram`
--

INSERT INTO `diagram` (`id_diagram`, `x`, `y`, `cluster`) VALUES
(1, '22,', '', '1'),
(2, '', '1750,', '1'),
(3, '22,', '', '1'),
(4, '', '1800,', '1'),
(5, '22,', '', '1'),
(6, '', '1850,', '1'),
(7, '15,', '', '1'),
(8, '', '1550,', '1'),
(9, '23,', '', '1'),
(10, '', '1755,', '1'),
(11, '22,', '', '1'),
(12, '', '1853,', '1'),
(13, '20,', '', '1'),
(14, '', '2000,', '1'),
(15, '22,', '', '1'),
(16, '', '1750,', '1'),
(17, '20,', '', '1'),
(18, '', '1550,', '1'),
(19, '15,', '', '1'),
(20, '', '2000,', '1'),
(21, '20,', '', '1'),
(22, '', '1845,', '1'),
(23, '17,', '', '1'),
(24, '', '1700,', '1'),
(25, '16,', '', '1'),
(26, '', '1600,', '1'),
(27, '23,', '', '1'),
(28, '', '1850,', '1'),
(29, '20,', '', '1'),
(30, '', '1550,', '1'),
(31, '17,', '', '1'),
(32, '', '2000,', '1'),
(33, '23,', '', '1'),
(34, '', '1850,', '1'),
(35, '20,', '', '1'),
(36, '', '1745,', '1'),
(37, '15,', '', '1'),
(38, '', '1500,', '1'),
(39, '23,', '', '1'),
(40, '', '1745,', '1'),
(41, '20,', '', '1'),
(42, '', '1600,', '1'),
(43, '20,', '', '1'),
(44, '', '1775,', '1'),
(45, '20,', '', '1'),
(46, '', '2000,', '1'),
(47, '17,', '', '1'),
(48, '', '1750,', '1'),
(49, '24,', '', '1'),
(50, '', '2023,', '1'),
(51, '25,', '', '2'),
(52, '', '2500,', '2'),
(53, '23,', '', '2'),
(54, '', '2530,', '2'),
(55, '25,', '', '2'),
(56, '', '2500,', '2'),
(57, '23,', '', '2'),
(58, '', '2550,', '2'),
(59, '22,', '', '2'),
(60, '', '2735,', '2'),
(61, '24,', '', '2'),
(62, '', '2650,', '2'),
(63, '23,', '', '3'),
(64, '', '2300,', '3'),
(65, '20,', '', '3'),
(66, '', '2250,', '3'),
(67, '22,', '', '3'),
(68, '', '2200,', '3'),
(69, '20,', '', '3'),
(70, '', '2200,', '3'),
(71, '23,', '', '3'),
(72, '', '2355,', '3'),
(73, '24,', '', '3'),
(74, '', '2400,', '3'),
(75, '22,', '', '3'),
(76, '', '2200,', '3'),
(77, '20,', '', '3'),
(78, '', '2285,', '3'),
(79, '25,', '', '3'),
(80, '', '2375,', '3'),
(81, '24,', '', '3'),
(82, '', '2400,', '3'),
(83, '24,', '', '3'),
(84, '', '2400,', '3'),
(85, '22,', '', '3'),
(86, '', '2400,', '3'),
(87, '21,', '', '3'),
(88, '', '2235,', '3'),
(89, '23,', '', '3'),
(90, '', '2055,', '3'),
(91, '26,', '', '3'),
(92, '', '2300,', '3'),
(93, '23,', '', '3'),
(94, '', '2150,', '3'),
(95, '21,', '', '3'),
(96, '', '2302,', '3'),
(97, '23,', '', '3'),
(98, '', '2300,', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagram_centroid`
--

CREATE TABLE `diagram_centroid` (
  `id_diagram_centroid` int(5) NOT NULL,
  `x` varchar(255) NOT NULL,
  `y` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `objek`
--

CREATE TABLE `objek` (
  `id_objek` int(5) NOT NULL,
  `nama_objek` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `cluster` varchar(100) NOT NULL,
  `iterasi` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `objek`
--

INSERT INTO `objek` (`id_objek`, `nama_objek`, `data`, `cluster`, `iterasi`, `ket`) VALUES
(1, 'Mekar wangi', ',23,2300,44', '', '', 'data'),
(2, 'Mekar sari', ',22,1750,25', '', '', 'data'),
(3, 'Sari ayu', ',20,2250,45', '', '', 'data'),
(4, 'Mekar wangi II', ',22,1800,30', '', '', 'data'),
(5, 'Tani makmur', ',22,2200,45', '', '', 'data'),
(6, 'Tunas wangi', ',22,1850,27', '', '', 'data'),
(7, 'Sari galih', ',15,1550,40', '', '', 'data'),
(8, 'Merta nadi', ',20,2200,47', '', '', 'data'),
(9, 'Tebo', ',23,1755,23', '', '', 'data'),
(10, 'Lebah', ',25,2500,50', '', '', 'data'),
(11, 'Mekar kencana', ',22,1853,27', '', '', 'data'),
(12, 'Margaya', ',20,2000,55', '', '', 'data'),
(13, 'Semila', ',23,2355,50', '', '', 'data'),
(14, 'Banyu kuning', ',22,1750,23', '', '', 'data'),
(15, 'Tunas jaya', ',24,2400,50', '', '', 'data'),
(16, 'Mekar ayu', ',20,1550,18', '', '', 'data'),
(17, 'Sumerta', ',15,2000,55', '', '', 'data'),
(18, 'Penatih', ',23,2530,50', '', '', 'data'),
(19, 'Taman manis', ',22,2200,45', '', '', 'data'),
(20, 'Umalayu', ',20,1845,30', '', '', 'data'),
(21, 'Sesetan', ',17,1700,40', '', '', 'data'),
(22, 'Renon', ',20,2285,43', '', '', 'data'),
(23, 'Sari ayu', ',16,1600,40', '', '', 'data'),
(24, 'Sari maju', ',23,1850,25', '', '', 'data'),
(25, 'Merta jaya', ',25,2375,27', '', '', 'data'),
(26, 'Merta sari', ',24,2400,45', '', '', 'data'),
(27, 'Tolisu', ',20,1550,35', '', '', 'data'),
(28, 'Sri nadi', ',17,2000,40', '', '', 'data'),
(29, 'Sari wangi', ',23,1850,23', '', '', 'data'),
(30, 'Pandan wangi', ',24,2400,40', '', '', 'data'),
(31, 'Eko wangi', ',20,1745,30', '', '', 'data'),
(32, 'Merta wangi', ',25,2500,40', '', '', 'data'),
(33, 'Sari jaya', ',23,2550,50', '', '', 'data'),
(34, 'Sri wangi', ',22,2400,52', '', '', 'data'),
(35, 'Mulia jaya', ',22,2735,55', '', '', 'data'),
(36, 'Karya makmur', ',15,1500,45', '', '', 'data'),
(37, 'Makmur jaya', ',23,1745,27', '', '', 'data'),
(38, 'Merta makmur', ',20,1600,26', '', '', 'data'),
(39, 'Makmur wangi', ',21,2235,47', '', '', 'data'),
(40, 'Sari makmur', ',20,1775,25', '', '', 'data'),
(41, 'Mekar jaya', ',23,2055,27', '', '', 'data'),
(42, 'Tani amerta', ',24,2650,45', '', '', 'data'),
(43, 'Tani jaya', ',26,2300,25', '', '', 'data'),
(44, 'Tani hijau', ',23,2150,28', '', '', 'data'),
(45, 'Tunas makmur', ',20,2000,40', '', '', 'data'),
(46, 'Tani mekar', ',17,1750,42', '', '', 'data'),
(47, 'Mekar abadi', ',21,2302,50', '', '', 'data'),
(48, 'Sari wangi', ',23,2300,40', '', '', 'data'),
(49, 'Anugrah tani ', ',24,2023,26', '', '', 'data'),
(2005, 'Tunas makmur', ',20,2000,40', '1', '4', 'uji'),
(2006, 'Tani mekar', ',17,1750,42', '1', '4', 'uji'),
(2004, 'Tani hijau', ',23,2150,28', '3', '4', 'uji'),
(2003, 'Tani jaya', ',26,2300,25', '3', '4', 'uji'),
(2002, 'Tani amerta', ',24,2650,45', '2', '4', 'uji'),
(2001, 'Mekar jaya', ',23,2055,27', '3', '4', 'uji'),
(2000, 'Sari makmur', ',20,1775,25', '1', '4', 'uji'),
(1999, 'Makmur wangi', ',21,2235,47', '3', '4', 'uji'),
(1998, 'Merta makmur', ',20,1600,26', '1', '4', 'uji'),
(1997, 'Makmur jaya', ',23,1745,27', '1', '4', 'uji'),
(1996, 'Karya makmur', ',15,1500,45', '1', '4', 'uji'),
(1995, 'Mulia jaya', ',22,2735,55', '2', '4', 'uji'),
(1994, 'Sri wangi', ',22,2400,52', '3', '4', 'uji'),
(1993, 'Sari jaya', ',23,2550,50', '2', '4', 'uji'),
(1992, 'Merta wangi', ',25,2500,40', '2', '4', 'uji'),
(1991, 'Eko wangi', ',20,1745,30', '1', '4', 'uji'),
(1990, 'Pandan wangi', ',24,2400,40', '3', '4', 'uji'),
(1989, 'Sari wangi', ',23,1850,23', '1', '4', 'uji'),
(1988, 'Sri nadi', ',17,2000,40', '1', '4', 'uji'),
(1987, 'Tolisu', ',20,1550,35', '1', '4', 'uji'),
(1986, 'Merta sari', ',24,2400,45', '3', '4', 'uji'),
(1985, 'Merta jaya', ',25,2375,27', '3', '4', 'uji'),
(1984, 'Sari maju', ',23,1850,25', '1', '4', 'uji'),
(1983, 'Sari ayu', ',16,1600,40', '1', '4', 'uji'),
(1982, 'Renon', ',20,2285,43', '3', '4', 'uji'),
(1981, 'Sesetan', ',17,1700,40', '1', '4', 'uji'),
(1980, 'Umalayu', ',20,1845,30', '1', '4', 'uji'),
(1979, 'Taman manis', ',22,2200,45', '3', '4', 'uji'),
(1978, 'Penatih', ',23,2530,50', '2', '4', 'uji'),
(1976, 'Mekar ayu', ',20,1550,18', '1', '4', 'uji'),
(1977, 'Sumerta', ',15,2000,55', '1', '4', 'uji'),
(1975, 'Tunas jaya', ',24,2400,50', '3', '4', 'uji'),
(1974, 'Banyu kuning', ',22,1750,23', '1', '4', 'uji'),
(1973, 'Semila', ',23,2355,50', '3', '4', 'uji'),
(1972, 'Margaya', ',20,2000,55', '1', '4', 'uji'),
(1971, 'Mekar kencana', ',22,1853,27', '1', '4', 'uji'),
(1970, 'Lebah', ',25,2500,50', '2', '4', 'uji'),
(1969, 'Tebo', ',23,1755,23', '1', '4', 'uji'),
(1968, 'Merta nadi', ',20,2200,47', '3', '4', 'uji'),
(1967, 'Sari galih', ',15,1550,40', '1', '4', 'uji'),
(1966, 'Tunas wangi', ',22,1850,27', '1', '4', 'uji'),
(1965, 'Tani makmur', ',22,2200,45', '3', '4', 'uji'),
(1964, 'Mekar wangi II', ',22,1800,30', '1', '4', 'uji'),
(1963, 'Sari ayu', ',20,2250,45', '3', '4', 'uji'),
(1962, 'Mekar sari', ',22,1750,25', '1', '4', 'uji'),
(1961, 'Mekar wangi', ',23,2300,44', '3', '4', 'uji'),
(1960, 'Anugrah tani ', ',24,2023,26', '1', '3', 'uji'),
(1959, 'Sari wangi', ',23,2300,40', '3', '3', 'uji'),
(1958, 'Mekar abadi', ',21,2302,50', '3', '3', 'uji'),
(1957, 'Tani mekar', ',17,1750,42', '1', '3', 'uji'),
(1956, 'Tunas makmur', ',20,2000,40', '1', '3', 'uji'),
(1955, 'Tani hijau', ',23,2150,28', '3', '3', 'uji'),
(1954, 'Tani jaya', ',26,2300,25', '3', '3', 'uji'),
(1953, 'Tani amerta', ',24,2650,45', '2', '3', 'uji'),
(1952, 'Mekar jaya', ',23,2055,27', '3', '3', 'uji'),
(1951, 'Sari makmur', ',20,1775,25', '1', '3', 'uji'),
(1950, 'Makmur wangi', ',21,2235,47', '3', '3', 'uji'),
(1949, 'Merta makmur', ',20,1600,26', '1', '3', 'uji'),
(1948, 'Makmur jaya', ',23,1745,27', '1', '3', 'uji'),
(1947, 'Karya makmur', ',15,1500,45', '1', '3', 'uji'),
(1946, 'Mulia jaya', ',22,2735,55', '2', '3', 'uji'),
(1945, 'Sri wangi', ',22,2400,52', '3', '3', 'uji'),
(1944, 'Sari jaya', ',23,2550,50', '2', '3', 'uji'),
(1943, 'Merta wangi', ',25,2500,40', '2', '3', 'uji'),
(1942, 'Eko wangi', ',20,1745,30', '1', '3', 'uji'),
(1941, 'Pandan wangi', ',24,2400,40', '3', '3', 'uji'),
(1940, 'Sari wangi', ',23,1850,23', '1', '3', 'uji'),
(1939, 'Sri nadi', ',17,2000,40', '1', '3', 'uji'),
(1938, 'Tolisu', ',20,1550,35', '1', '3', 'uji'),
(1937, 'Merta sari', ',24,2400,45', '3', '3', 'uji'),
(1936, 'Merta jaya', ',25,2375,27', '3', '3', 'uji'),
(1935, 'Sari maju', ',23,1850,25', '1', '3', 'uji'),
(1934, 'Sari ayu', ',16,1600,40', '1', '3', 'uji'),
(1933, 'Renon', ',20,2285,43', '3', '3', 'uji'),
(1932, 'Sesetan', ',17,1700,40', '1', '3', 'uji'),
(1931, 'Umalayu', ',20,1845,30', '1', '3', 'uji'),
(1930, 'Taman manis', ',22,2200,45', '3', '3', 'uji'),
(1929, 'Penatih', ',23,2530,50', '2', '3', 'uji'),
(1928, 'Sumerta', ',15,2000,55', '1', '3', 'uji'),
(1927, 'Mekar ayu', ',20,1550,18', '1', '3', 'uji'),
(1925, 'Banyu kuning', ',22,1750,23', '1', '3', 'uji'),
(1926, 'Tunas jaya', ',24,2400,50', '3', '3', 'uji'),
(1924, 'Semila', ',23,2355,50', '3', '3', 'uji'),
(1923, 'Margaya', ',20,2000,55', '1', '3', 'uji'),
(1922, 'Mekar kencana', ',22,1853,27', '1', '3', 'uji'),
(1920, 'Tebo', ',23,1755,23', '1', '3', 'uji'),
(1921, 'Lebah', ',25,2500,50', '2', '3', 'uji'),
(1919, 'Merta nadi', ',20,2200,47', '3', '3', 'uji'),
(1918, 'Sari galih', ',15,1550,40', '1', '3', 'uji'),
(1917, 'Tunas wangi', ',22,1850,27', '1', '3', 'uji'),
(1916, 'Tani makmur', ',22,2200,45', '3', '3', 'uji'),
(1914, 'Sari ayu', ',20,2250,45', '3', '3', 'uji'),
(1915, 'Mekar wangi II', ',22,1800,30', '1', '3', 'uji'),
(1913, 'Mekar sari', ',22,1750,25', '1', '3', 'uji'),
(1912, 'Mekar wangi', ',23,2300,44', '3', '3', 'uji'),
(1911, 'Anugrah tani ', ',24,2023,26', '1', '2', 'uji'),
(1910, 'Sari wangi', ',23,2300,40', '3', '2', 'uji'),
(1909, 'Mekar abadi', ',21,2302,50', '3', '2', 'uji'),
(1908, 'Tani mekar', ',17,1750,42', '1', '2', 'uji'),
(1907, 'Tunas makmur', ',20,2000,40', '1', '2', 'uji'),
(1906, 'Tani hijau', ',23,2150,28', '3', '2', 'uji'),
(1905, 'Tani jaya', ',26,2300,25', '3', '2', 'uji'),
(1904, 'Tani amerta', ',24,2650,45', '2', '2', 'uji'),
(1903, 'Mekar jaya', ',23,2055,27', '1', '2', 'uji'),
(1902, 'Sari makmur', ',20,1775,25', '1', '2', 'uji'),
(1901, 'Makmur wangi', ',21,2235,47', '3', '2', 'uji'),
(1900, 'Merta makmur', ',20,1600,26', '1', '2', 'uji'),
(1899, 'Makmur jaya', ',23,1745,27', '1', '2', 'uji'),
(1898, 'Karya makmur', ',15,1500,45', '1', '2', 'uji'),
(1897, 'Mulia jaya', ',22,2735,55', '2', '2', 'uji'),
(1896, 'Sri wangi', ',22,2400,52', '3', '2', 'uji'),
(1895, 'Sari jaya', ',23,2550,50', '2', '2', 'uji'),
(1894, 'Merta wangi', ',25,2500,40', '2', '2', 'uji'),
(1893, 'Eko wangi', ',20,1745,30', '1', '2', 'uji'),
(1892, 'Pandan wangi', ',24,2400,40', '3', '2', 'uji'),
(1891, 'Sari wangi', ',23,1850,23', '1', '2', 'uji'),
(1890, 'Sri nadi', ',17,2000,40', '1', '2', 'uji'),
(1889, 'Tolisu', ',20,1550,35', '1', '2', 'uji'),
(1888, 'Merta sari', ',24,2400,45', '3', '2', 'uji'),
(1887, 'Merta jaya', ',25,2375,27', '3', '2', 'uji'),
(1886, 'Sari maju', ',23,1850,25', '1', '2', 'uji'),
(1884, 'Renon', ',20,2285,43', '3', '2', 'uji'),
(1885, 'Sari ayu', ',16,1600,40', '1', '2', 'uji'),
(1883, 'Sesetan', ',17,1700,40', '1', '2', 'uji'),
(1882, 'Umalayu', ',20,1845,30', '1', '2', 'uji'),
(1881, 'Taman manis', ',22,2200,45', '3', '2', 'uji'),
(1880, 'Penatih', ',23,2530,50', '2', '2', 'uji'),
(1879, 'Sumerta', ',15,2000,55', '1', '2', 'uji'),
(1878, 'Mekar ayu', ',20,1550,18', '1', '2', 'uji'),
(1877, 'Tunas jaya', ',24,2400,50', '3', '2', 'uji'),
(1876, 'Banyu kuning', ',22,1750,23', '1', '2', 'uji'),
(1875, 'Semila', ',23,2355,50', '3', '2', 'uji'),
(1874, 'Margaya', ',20,2000,55', '1', '2', 'uji'),
(1873, 'Mekar kencana', ',22,1853,27', '1', '2', 'uji'),
(1872, 'Lebah', ',25,2500,50', '2', '2', 'uji'),
(1871, 'Tebo', ',23,1755,23', '1', '2', 'uji'),
(1870, 'Merta nadi', ',20,2200,47', '3', '2', 'uji'),
(1869, 'Sari galih', ',15,1550,40', '1', '2', 'uji'),
(1868, 'Tunas wangi', ',22,1850,27', '1', '2', 'uji'),
(1867, 'Tani makmur', ',22,2200,45', '3', '2', 'uji'),
(1866, 'Mekar wangi II', ',22,1800,30', '1', '2', 'uji'),
(1863, 'Mekar wangi', ',23,2300,44', '3', '2', 'uji'),
(1865, 'Sari ayu', ',20,2250,45', '3', '2', 'uji'),
(1864, 'Mekar sari', ',22,1750,25', '1', '2', 'uji'),
(1861, 'Sari wangi', ',23,2300,40', '3', '1', 'uji'),
(1862, 'Anugrah tani ', ',24,2023,26', '1', '1', 'uji'),
(1860, 'Mekar abadi', ',21,2302,50', '3', '1', 'uji'),
(1856, 'Tani jaya', ',26,2300,25', '3', '1', 'uji'),
(1857, 'Tani hijau', ',23,2150,28', '1', '1', 'uji'),
(1858, 'Tunas makmur', ',20,2000,40', '1', '1', 'uji'),
(1859, 'Tani mekar', ',17,1750,42', '1', '1', 'uji'),
(1855, 'Tani amerta', ',24,2650,45', '2', '1', 'uji'),
(1854, 'Mekar jaya', ',23,2055,27', '1', '1', 'uji'),
(1853, 'Sari makmur', ',20,1775,25', '1', '1', 'uji'),
(1852, 'Makmur wangi', ',21,2235,47', '1', '1', 'uji'),
(1851, 'Merta makmur', ',20,1600,26', '1', '1', 'uji'),
(1850, 'Makmur jaya', ',23,1745,27', '1', '1', 'uji'),
(1849, 'Karya makmur', ',15,1500,45', '1', '1', 'uji'),
(1848, 'Mulia jaya', ',22,2735,55', '2', '1', 'uji'),
(1847, 'Sri wangi', ',22,2400,52', '2', '1', 'uji'),
(1846, 'Sari jaya', ',23,2550,50', '2', '1', 'uji'),
(1845, 'Merta wangi', ',25,2500,40', '2', '1', 'uji'),
(1844, 'Eko wangi', ',20,1745,30', '1', '1', 'uji'),
(1843, 'Pandan wangi', ',24,2400,40', '2', '1', 'uji'),
(1842, 'Sari wangi', ',23,1850,23', '1', '1', 'uji'),
(1841, 'Sri nadi', ',17,2000,40', '1', '1', 'uji'),
(1840, 'Tolisu', ',20,1550,35', '1', '1', 'uji'),
(1839, 'Merta sari', ',24,2400,45', '2', '1', 'uji'),
(1838, 'Merta jaya', ',25,2375,27', '3', '1', 'uji'),
(1837, 'Sari maju', ',23,1850,25', '1', '1', 'uji'),
(1836, 'Sari ayu', ',16,1600,40', '1', '1', 'uji'),
(1835, 'Renon', ',20,2285,43', '3', '1', 'uji'),
(1834, 'Sesetan', ',17,1700,40', '1', '1', 'uji'),
(1833, 'Umalayu', ',20,1845,30', '1', '1', 'uji'),
(1832, 'Taman manis', ',22,2200,45', '1', '1', 'uji'),
(1830, 'Sumerta', ',15,2000,55', '1', '1', 'uji'),
(1831, 'Penatih', ',23,2530,50', '2', '1', 'uji'),
(1829, 'Mekar ayu', ',20,1550,18', '1', '1', 'uji'),
(1828, 'Tunas jaya', ',24,2400,50', '2', '1', 'uji'),
(1827, 'Banyu kuning', ',22,1750,23', '1', '1', 'uji'),
(1826, 'Semila', ',23,2355,50', '3', '1', 'uji'),
(1825, 'Margaya', ',20,2000,55', '1', '1', 'uji'),
(1824, 'Mekar kencana', ',22,1853,27', '1', '1', 'uji'),
(1823, 'Lebah', ',25,2500,50', '2', '1', 'uji'),
(1822, 'Tebo', ',23,1755,23', '1', '1', 'uji'),
(1821, 'Merta nadi', ',20,2200,47', '1', '1', 'uji'),
(1820, 'Sari galih', ',15,1550,40', '1', '1', 'uji'),
(1819, 'Tunas wangi', ',22,1850,27', '1', '1', 'uji'),
(1818, 'Tani makmur', ',22,2200,45', '1', '1', 'uji'),
(1817, 'Mekar wangi II', ',22,1800,30', '1', '1', 'uji'),
(1816, 'Sari ayu', ',20,2250,45', '3', '1', 'uji'),
(1815, 'Mekar sari', ',22,1750,25', '1', '1', 'uji'),
(1814, 'Mekar wangi', ',23,2300,44', '3', '1', 'uji'),
(2007, 'Mekar abadi', ',21,2302,50', '3', '4', 'uji'),
(2008, 'Sari wangi', ',23,2300,40', '3', '4', 'uji'),
(2009, 'Anugrah tani ', ',24,2023,26', '1', '4', 'uji');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satukan`
--

CREATE TABLE `satukan` (
  `id` int(5) NOT NULL,
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satukan`
--

INSERT INTO `satukan` (`id`, `data`) VALUES
(1, '22,22,22,15,23,22,20,22,20,15,20,17,16,23,20,17,23,20,15,23,20,20,20,17,24,'),
(2, '1750,1800,1850,1550,1755,1853,2000,1750,1550,2000,1845,1700,1600,1850,1550,2000,1850,1745,1500,1745,1600,1775,2000,1750,2023,'),
(3, '25,23,25,23,22,24,'),
(4, '2500,2530,2500,2550,2735,2650,'),
(5, '23,20,22,20,23,24,22,20,25,24,24,22,21,23,26,23,21,23,'),
(6, '2300,2250,2200,2200,2355,2400,2200,2285,2375,2400,2400,2400,2235,2055,2300,2150,2302,2300,');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_atribut`
--

CREATE TABLE `tb_atribut` (
  `id_atribut` int(5) NOT NULL,
  `nm_atribut` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_atribut`
--

INSERT INTO `tb_atribut` (`id_atribut`, `nm_atribut`) VALUES
(1, 'Luas'),
(2, 'Jumlah Pupuk'),
(3, 'Hasil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `jam` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul`, `isi_berita`, `hari`, `tanggal`, `jam`, `dibaca`) VALUES
(122, 'ALGORITMA YANG DIGUNAKAN', '<p align=\"justify\">Algoritma yang digunakan pada penelitian ini yaitu algoritma K-Means.</p>\r\n<p align=\"justify\">Metode K-Means berusaha mengelompokan data yang ada di dalam beberapa kelompok,dimana data dalam satu kelompk mempunyai karakteristik yang sama satu sama lainnya,dan mempunyai karakteristik yang berbeda dengan data yang ada di dalam kelompok yang laindan menghasilkan output C1,C2,C3 yaitu penjualan Tertinggi,penjualan Terendah,penjualan Tetap.\r\n</p>', 'Selasa', 'Senin, 2 September 2019', '16:27:32', 1),
(121, 'ATRIBUT', '<p align=\"justify\">Variabel yang akan dikelola antaranya,Kode Item,Jumlah Penjualan,Jumlah Stok).</p>', 'Selasa', 'Senin, 2 September 2019', '15:24:24', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_halaman`
--

CREATE TABLE `tb_halaman` (
  `id_halaman` int(5) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `halaman` varchar(20) NOT NULL,
  `detail` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_halaman`
--

INSERT INTO `tb_halaman` (`id_halaman`, `judul`, `halaman`, `detail`) VALUES
(1, 'SELAMAT DATANG..!!!!', 'home', '<p align=\"justify\">\r\n\r\ntulisan ini bisa diganti di menu Admin -> Halaman Web (menu samping)\r\n\r\n<p align=\"justify\">');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hubungi`
--

CREATE TABLE `tb_hubungi` (
  `id_hubungi` int(5) NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_hubungi`
--

INSERT INTO `tb_hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`) VALUES
(102, 'Anwar Ibrahim', 'anwaribrahim520@gmail.com', '082348174247', '', '2018-03-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'members'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`username`, `password`, `nama_lengkap`, `jenis_kelamin`, `alamat`, `level`) VALUES
('admin', 'admin', 'Admin', 'L', 'Indonesia', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `centroid`
--
ALTER TABLE `centroid`
  ADD PRIMARY KEY (`id_centroid`);

--
-- Indeks untuk tabel `diagram`
--
ALTER TABLE `diagram`
  ADD PRIMARY KEY (`id_diagram`);

--
-- Indeks untuk tabel `diagram_centroid`
--
ALTER TABLE `diagram_centroid`
  ADD PRIMARY KEY (`id_diagram_centroid`);

--
-- Indeks untuk tabel `objek`
--
ALTER TABLE `objek`
  ADD PRIMARY KEY (`id_objek`);

--
-- Indeks untuk tabel `satukan`
--
ALTER TABLE `satukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_atribut`
--
ALTER TABLE `tb_atribut`
  ADD PRIMARY KEY (`id_atribut`);

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tb_halaman`
--
ALTER TABLE `tb_halaman`
  ADD PRIMARY KEY (`id_halaman`);

--
-- Indeks untuk tabel `tb_hubungi`
--
ALTER TABLE `tb_hubungi`
  ADD PRIMARY KEY (`id_hubungi`);

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `centroid`
--
ALTER TABLE `centroid`
  MODIFY `id_centroid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT untuk tabel `diagram`
--
ALTER TABLE `diagram`
  MODIFY `id_diagram` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `diagram_centroid`
--
ALTER TABLE `diagram_centroid`
  MODIFY `id_diagram_centroid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `objek`
--
ALTER TABLE `objek`
  MODIFY `id_objek` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2010;

--
-- AUTO_INCREMENT untuk tabel `satukan`
--
ALTER TABLE `satukan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_atribut`
--
ALTER TABLE `tb_atribut`
  MODIFY `id_atribut` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `tb_halaman`
--
ALTER TABLE `tb_halaman`
  MODIFY `id_halaman` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_hubungi`
--
ALTER TABLE `tb_hubungi`
  MODIFY `id_hubungi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
