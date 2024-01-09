-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Agu 2023 pada 14.06
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idbookstore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `reader_cover` text DEFAULT NULL,
  `note_cover` text DEFAULT NULL,
  `note_admin` text DEFAULT NULL,
  `paket_harga_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `language_id` int(5) UNSIGNED DEFAULT NULL,
  `book_size_id` int(3) UNSIGNED DEFAULT NULL,
  `book_paper_id` int(3) UNSIGNED DEFAULT NULL,
  `ref_provinsi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ref_kota_id` bigint(20) UNSIGNED DEFAULT NULL,
  `num_page` int(11) DEFAULT NULL,
  `sum_rating` float NOT NULL DEFAULT 0,
  `is_cover` enum('1','0') NOT NULL,
  `is_kdt` enum('1','0') NOT NULL,
  `cover` text NOT NULL,
  `naskah` text NOT NULL,
  `alamat_kirim` text NOT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `is_fullbook` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `uuid`, `title`, `description`, `reader_cover`, `note_cover`, `note_admin`, `paket_harga_id`, `category_id`, `language_id`, `book_size_id`, `book_paper_id`, `ref_provinsi_id`, `ref_kota_id`, `num_page`, `sum_rating`, `is_cover`, `is_kdt`, `cover`, `naskah`, `alamat_kirim`, `isbn`, `is_fullbook`, `created_at`, `update_at`) VALUES
(1, '11', 'Buku 1', 'Sinopsis 1 Sinopsis 1 Sinopsis 1 Sinopsis 1 Sinopsis 1 Sinopsis 1 ', 'semua kalangan', 'okeee', '', 1, 2, 1, 3, 2, NULL, NULL, 111, 0, '1', '1', '/public/uploads/cover/cover_upload_230212031552.png', '', '', '123', '1', '2023-02-12 14:55:43', '2023-03-15 03:18:51'),
(2, '22', 'Buku 3', 'Sinopsis buku 3 Sinopsis buku 3 Sinopsis buku 3 Sinopsis buku 3 Sinopsis buku 3 Sinopsis buku 3 ', '', '', '', 1, 2, 1, 16, 1, NULL, NULL, 111, 2, '0', '1', '', '', '', '123', '1', '2023-02-12 15:15:52', '2023-03-17 00:48:29'),
(3, '33', 'Buku ', 'Sinopsis buku 2 Sinopsis buku 2 Sinopsis buku 2 Sinopsis buku 2 ', '', '', NULL, 6, NULL, NULL, 3, 2, NULL, NULL, NULL, 0, '0', '1', '/public/uploads/cover/cover_upload_230215054814.png', '/public/uploads/berkas/berkas_upload_230317125133.pdf', '', NULL, '1', '2023-02-15 17:48:14', '2023-03-17 00:51:33'),
(4, '44', 'Judul 4', 'Sinopsis 4 Sinopsis 4 Sinopsis 4 Sinopsis 4 Sinopsis 4 Sinopsis 4 Sinopsis 4 ', 'oke', 'sasas', NULL, 3, NULL, NULL, 3, 1, NULL, NULL, NULL, 0, '1', '1', '/public/uploads/cover/cover_upload_230212031552.png', '/public/uploads/berkas/berkas_upload_230221074619.pdf', '', NULL, '1', '2023-02-21 07:46:19', '2023-03-07 05:00:37'),
(5, '55', 'Capeek', 'Pengen turu Pengen turu Pengen turu Pengen turu Pengen turu Pengen turu Pengen turu Pengen turu Pengen turu ', '', '', '', 10, 3, 1, 10, 2, 32, 3202, 11, 0, '0', '1', '/public/uploads/cover/cover_upload_230222064524.jpg', '/public/uploads/berkas/berkas_upload_230317123210.docx', 'Malang', '', '1', '2023-02-22 06:45:24', '2023-03-17 00:32:10'),
(6, '37cc5873-c47b-11ed-aaa5-f469d5ccb232', 'Akhirnya tinggal testing', 'Akhirnya tinggal testing Akhirnya tinggal testingAkhirnya tinggal testingAkhirnya tinggal testingAkhirnya tinggal testingAkhirnya tinggal testing', 'semua kalangan', 'ngikut aja bang', NULL, 9, NULL, NULL, 10, 1, 35, 3512, NULL, 0, '1', '1', '', '/public/uploads/berkas/berkas_upload_230317042141.pdf', 'jalan buntu', NULL, '1', '2023-03-17 04:21:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `desc` text DEFAULT NULL,
  `icon` varchar(50) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `book_category`
--

INSERT INTO `book_category` (`id`, `title`, `desc`, `icon`, `img`) VALUES
(1, 'Pendidikan', '', 'fas fa-graduation-cap', NULL),
(2, 'Sosial Budaya', '', 'fas fa-users', NULL),
(3, 'Bahasa', '', 'fas fa-language', NULL),
(4, 'Teknologi', '', 'fas fa-cogs', NULL),
(5, 'Ekonomi', '', 'fas fa-search-dollar', NULL),
(6, 'Sejarah & Geografi', '', 'fas fa-globe-asia', NULL),
(7, 'Psikologi', '', 'fas fa-brain', NULL),
(8, 'Fisika Biologi', '', 'fas fa-flask', NULL),
(9, 'Olahraga', '', 'fas fa-running', NULL),
(10, 'Kesehatan', '', 'fas fa-medkit', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_contributors`
--

CREATE TABLE `book_contributors` (
  `id` bigint(20) NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contributor_role_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_contributors`
--

INSERT INTO `book_contributors` (`id`, `book_id`, `user_id`, `contributor_role_id`, `added_at`) VALUES
(11, 3, 1, 4, '2023-02-23 06:08:56'),
(12, 3, 1, 4, '2023-02-23 06:08:56'),
(13, 3, 1, 1, '2023-02-23 06:08:56'),
(14, 3, 1, 3, '2023-02-23 06:08:56'),
(15, 3, 1, 2, '2023-02-23 06:08:56'),
(16, 4, 36, 5, '2023-02-23 06:08:56'),
(17, 4, 32, 4, '2023-02-23 06:08:56'),
(18, 4, 32, 1, '2023-02-23 06:08:56'),
(19, 4, 32, 3, '2023-02-23 06:08:56'),
(20, 4, 32, 2, '2023-02-23 06:08:56'),
(69, 1, 36, 5, '2023-02-23 06:25:20'),
(70, 1, 32, 4, '2023-02-23 06:25:20'),
(71, 1, 3, 4, '2023-02-23 06:25:20'),
(72, 1, 4, 4, '2023-02-23 06:25:20'),
(73, 1, 4, 4, '2023-02-23 06:25:20'),
(74, 1, 2, 4, '2023-03-03 03:14:09'),
(91, 5, 36, 2, '2023-02-24 00:14:16'),
(92, 5, 36, 5, '2023-02-24 00:14:16'),
(93, 5, 32, 4, '2023-02-24 00:14:16'),
(94, 5, 32, 5, '2023-02-24 00:14:16'),
(95, 5, 32, 5, '2023-02-24 00:14:16'),
(96, 2, 1, 5, '2023-02-24 00:20:09'),
(97, 2, 32, 4, '2023-02-24 00:20:09'),
(98, 2, 32, 1, '2023-02-24 00:20:09'),
(99, 2, 32, 3, '2023-02-24 00:20:09'),
(100, 2, 32, 2, '2023-02-24 00:20:09'),
(101, 6, 36, 5, '2023-03-17 04:21:41'),
(102, 6, 47, 4, '2023-03-17 04:21:41'),
(103, 6, 36, 4, '2023-03-17 04:21:41'),
(104, 6, 47, 1, '2023-03-17 04:21:41'),
(105, 6, 32, 1, '2023-03-17 04:21:41'),
(106, 6, 47, 3, '2023-03-17 04:21:41'),
(107, 6, 47, 2, '2023-03-17 04:21:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_contributors_role`
--

CREATE TABLE `book_contributors_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL DEFAULT '0',
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_contributors_role`
--

INSERT INTO `book_contributors_role` (`id`, `role_name`, `is_active`) VALUES
(1, 'Editor', '1'),
(2, 'Desain Cover', '1'),
(3, 'Tata Letak', '1'),
(4, 'Penulis', '1'),
(5, 'PJ', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_language`
--

CREATE TABLE `book_language` (
  `id` int(5) UNSIGNED NOT NULL,
  `language` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_language`
--

INSERT INTO `book_language` (`id`, `language`) VALUES
(1, 'Indonesia'),
(2, 'Melayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_papers`
--

CREATE TABLE `book_papers` (
  `id` int(11) UNSIGNED NOT NULL,
  `paper_name` varchar(50) NOT NULL,
  `desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_papers`
--

INSERT INTO `book_papers` (`id`, `paper_name`, `desc`) VALUES
(1, 'HVS', NULL),
(2, 'Paper Book', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_purchase`
--

CREATE TABLE `book_purchase` (
  `order_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_code` int(11) DEFAULT NULL,
  `gross_amount` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_purchase`
--

INSERT INTO `book_purchase` (`order_id`, `user_id`, `status_code`, `gross_amount`, `created_at`, `update_at`) VALUES
(121, 47, 201, 24000, '2023-03-16 07:55:46', '2023-03-16 07:56:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_purchase_item`
--

CREATE TABLE `book_purchase_item` (
  `id` int(11) NOT NULL,
  `bp_order_id` int(11) NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_purchase_item`
--

INSERT INTO `book_purchase_item` (`id`, `bp_order_id`, `book_id`) VALUES
(1, 121, 1),
(2, 121, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_rating`
--

CREATE TABLE `book_rating` (
  `id` int(11) NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `rating` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_rating`
--

INSERT INTO `book_rating` (`id`, `uuid`, `user_id`, `book_id`, `comment`, `rating`, `created_at`, `update_at`) VALUES
(1, '102938', 42, 5, 'lorem ipsum', 2, '2023-03-16 02:03:25', NULL),
(2, '727284ea-c3ce-11ed-a31f-f469d5ccb232', 47, 2, 'lorem epsum', 2, '2023-03-16 07:44:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_sell`
--

CREATE TABLE `book_sell` (
  `id` int(11) NOT NULL,
  `uuid` varchar(50) NOT NULL DEFAULT '',
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  `publish_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_sell`
--

INSERT INTO `book_sell` (`id`, `uuid`, `book_id`, `publisher_id`, `sell_price`, `publish_at`, `update_at`) VALUES
(15, 'fea9d68f-b3fc-11ed-b26d-f469d5ccb232', 5, 1, 12000, '2023-02-24 04:37:50', NULL),
(16, 'bb06e028-c3b3-11ed-a31f-f469d5ccb232', 2, 1, 24000, '2023-03-16 04:33:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_sell_publisher`
--

CREATE TABLE `book_sell_publisher` (
  `id` int(11) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `icon_publisher` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `book_sell_publisher`
--

INSERT INTO `book_sell_publisher` (`id`, `publisher`, `icon_publisher`) VALUES
(1, 'Idbookstore', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_sizes`
--

CREATE TABLE `book_sizes` (
  `id` int(3) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `book_sizes`
--

INSERT INTO `book_sizes` (`id`, `title`, `desc`, `icon`) VALUES
(3, 'A5', '5.83 x 8.27 in | 148 x 210 mm', 'fas fa-sticky-note'),
(10, 'A4', '7.5 x 7.5 in | 190 x 190 mm', 'fas fa-sticky-note'),
(16, 'B5', '-', '-'),
(17, 'UNESCO', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `default_value`
--

CREATE TABLE `default_value` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `Column 5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `default_value`
--

INSERT INTO `default_value` (`id`, `key`, `value`, `desc`, `Column 5`) VALUES
(1, 'point', '0', 'penambahan point per register', NULL),
(2, 'komisi', '0', 'komisi penjualan per buku', NULL),
(3, 'no_hp', '6285171670522', 'nomor telepon cs', NULL),
(4, 'email', 'penuliscerdas.cs@gmail.com ', 'email default (nanti diganti email PCI)', NULL),
(5, 'email_pass', 'kpqmqbhdlrgepbsc', 'password email default', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `designcover`
--

CREATE TABLE `designcover` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `buku_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `designcover`
--

INSERT INTO `designcover` (`id`, `nama`, `buku_id`) VALUES
(1, 'Zahid Zufar At Thaariq', 1),
(2, 'Daffa Farras Shidiq', 2),
(3, 'Daffa Farras Shidiq', 3),
(4, 'Anindya Hapsari', 4),
(5, 'Tika Dwi Tama', 5),
(6, 'Daffa Farras Shidiq', 6),
(7, 'Daffa Farras Shidiq', 7),
(8, 'Daffa Farras Shidiq', 8),
(9, 'Daffa Farras Shidiq', 9),
(10, 'Daffa Farras Shidiq', 10),
(11, 'Daffa Farras Shidiq', 11),
(12, 'Daffa Farras Shidiq', 12),
(13, 'Daffa Farras Shidiq', 13),
(14, 'Apriliyanto Rhamadhan', 14),
(15, 'Apriliyanto Rhamadhan, S.Pd.', 15),
(16, 'Jibril Maulana', 16),
(17, 'Apriliyanto Rhamadhan', 18),
(18, 'Apriliyanto Rhamadhan, S.Pd.', 19),
(19, 'Apriliyanto Rhamadhan, S.Pd', 20),
(20, 'Sapti Wahyuningsih', 21),
(21, 'Apriliyanto Rhamadhan, S.Pd', 22),
(22, 'Apriliyanto Rhamadhan, S.Pd', 23),
(23, 'Apriliyanto Rhamadhan, S.Pd.', 24),
(24, 'Apriliyanto Rhamadhan, S.Pd.', 26),
(25, 'Apriliyanto Rhamadhan, S.Pd', 27),
(26, 'Apriliyanto Rhamadhan, S.Pd', 33),
(27, 'Azizah, S.Pd., M.Si', 34),
(28, 'Apriliyanto Rhamadhan, S.Pd', 35),
(29, 'Apriliyanto Rhamadhan, S.Pd', 36),
(30, 'Apriliyanto Rhamadhan, S.Pd', 37),
(31, 'Azizah, S.Pd., M.Si', 38),
(32, 'Apriliyanto Rhamadhan, S.Pd', 39);

-- --------------------------------------------------------

--
-- Struktur dari tabel `editor`
--

CREATE TABLE `editor` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `buku_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `editor`
--

INSERT INTO `editor` (`id`, `nama`, `buku_id`) VALUES
(1, 'Zahid Zufar At Thaariq', 1),
(2, 'Diajeng Ragil Pangestuti', 2),
(3, 'Diajeng Ragil Pangestuti', 3),
(4, 'Diajeng Ragil Pangestuti', 4),
(5, 'Hartati Eko Wardani', 5),
(6, 'Diajeng Ragil Pangestuti', 5),
(7, 'Qorinah Estiningtyas Sakilah Adnani, M.Keb, PhD', 6),
(8, 'Diajeng Ragil Pangestuti', 6),
(9, 'Diajeng Ragil Pangestuti', 7),
(10, 'Diajeng Ragil Pangestuti', 8),
(11, 'Diajeng Ragil Pangestuti', 9),
(12, 'Diajeng Ragil Pangestuti, S.S.', 10),
(13, 'Diajeng Ragil Pangestuti, S.S.', 11),
(14, 'Dr. Yohanes Subasno, M.Th', 12),
(15, 'Diajeng Ragil Pangestuti, S.S.', 13),
(16, 'Diajeng Ragil Pangestuti', 14),
(17, 'Rr. Poppy Puspitasari S.Pd., M.T., Ph.D.', 15),
(18, 'Prof. Dr. Heru Suryanto, M.T., Prof. Sukarni, M.T.', 16),
(19, 'Rr. Poppy Puspitasari S.Pd., M.T., Ph.D', 16),
(20, 'Dian Purnama', 18),
(21, 'Dian Purnama, S.Pd.', 19),
(22, 'Dr. Imam Agus Basuki, M.Pd', 20),
(23, 'Sapti Wahyuningsih', 21),
(24, 'Dr. Imam Agus Basuki, M.Pd', 22),
(25, 'Dian Purnama, S.Pd', 23),
(26, 'Ari Indra Susanti, SST, M.Keb', 24),
(27, 'Dian Purnama, S.Pd.', 24),
(28, 'Lani Gumilang, SST, MM', 26),
(29, 'Dian Purnama, S.Pd.', 26),
(30, 'Dwi Utami Anjarwati', 27),
(31, 'Dewi Purbaningsih', 27),
(32, 'Sayyidah Auliany Aminy', 27),
(33, 'Almarissa Ajeng Prameshwara', 27),
(34, 'Vidyadhari Puspa Prawarni', 27),
(35, 'Kumala', 27),
(36, 'Dian Purnama, S.Pd', 33),
(37, 'Azizah, S.Pd., M.Si', 34),
(38, 'Dewi Susanti, SST, M.Keb', 35),
(39, 'Dian Purnama, S.Pd', 35),
(40, 'Dewi Susanti, SST, M.Keb', 36),
(41, 'Dian Purnama, S.Pd', 36),
(42, 'Dian Purnama, S.Pd', 36),
(43, 'Renza Agastha Merdeka', 37),
(44, 'Muhammad Nico Setiawan', 37),
(45, 'Azizah, S.Pd., M.Si', 38),
(46, 'Azizah, S.Pd., M.Si', 38),
(47, 'Azizah, S.Pd., M.Si', 38),
(48, 'Prof Dr.Bambang Widagdo.,M.M', 39),
(49, 'Dr.Mursidi.,M.M', 39),
(50, 'Dra.Erna Retna R.,M.M.', 39),
(51, 'Dra.Dewi Nurjannah.,M.M.', 39),
(52, 'Novita Ratna Satiti.,SE.,M.M.', 39),
(53, 'Fika Fitriasari.,SE.,M.M', 39),
(54, 'Widhiyo Sudiyono.,ST.,M.B.A', 39),
(55, 'Dr.M.Jihadi.,M.M.', 39);

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_type_id` int(10) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `desc` text DEFAULT NULL,
  `img` text NOT NULL,
  `link` text DEFAULT NULL,
  `start_regist` date DEFAULT NULL,
  `end_regist` date DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 = Tidak Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`id`, `event_type_id`, `event_name`, `desc`, `img`, `link`, `start_regist`, `end_regist`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Workshop PCI', 'Lorem ipsum', '/public/uploads/event/event_upload_230228034619.png', 'https://docs.google.com/document/d/1EOeGFrUEkUOTHfF4H46mgMtj6fufQnA-6hl4lB8bstA/edit?usp=share_link', '2023-02-28', '2023-03-04', '1', '2023-02-28 03:46:19', NULL),
(2, 3, 'Pelatihan begadang 3 hari non-stop', 'Ini deskripsi Pelatihan begadang 3 hari non-stop okeeee ee eeeeee', '/public/uploads/event/event_upload_230228052837.png', 'https://docs.google.com/document/d/1EOeGFrUEkUOTHfF4H46mgMtj6fufQnA-6hl4lB8bstA/edit?usp=share_link', '2023-02-28', '2023-03-03', '1', '2023-02-28 05:28:37', '2023-02-28 05:50:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_type`
--

CREATE TABLE `event_type` (
  `id` int(11) NOT NULL,
  `name_type` varchar(50) NOT NULL,
  `inisial` varchar(50) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `event_type`
--

INSERT INTO `event_type` (`id`, `name_type`, `inisial`, `desc`, `create_at`, `update_at`) VALUES
(1, 'Pelatihan', 'pelatihan', 'lorem ipsum lorem ipsum', '2023-02-08 08:16:12', '2023-02-28 05:49:22'),
(2, 'Seminar', 'seminar', 'lorem ipsum lorem ipsum 2', '2023-02-08 08:16:23', '2023-02-28 05:49:25'),
(3, 'Bootcamp', 'bootcamp', 'lorem ipsum lorem ipsum 3', '2023-02-08 08:16:31', '2023-02-28 05:49:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalogbuku`
--

CREATE TABLE `katalogbuku` (
  `id` bigint(20) NOT NULL,
  `judul` varchar(256) DEFAULT NULL,
  `flipbook` varchar(255) DEFAULT NULL,
  `halaman` varchar(256) DEFAULT NULL,
  `tanggal_terbit` varchar(64) DEFAULT NULL,
  `bahasa` varchar(256) DEFAULT NULL,
  `penerbit` varchar(256) DEFAULT NULL,
  `isbn` varchar(256) DEFAULT NULL,
  `berat` varchar(256) DEFAULT NULL,
  `lebar` varchar(256) DEFAULT NULL,
  `panjang` varchar(256) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `fotobuku` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `katalogbuku`
--

INSERT INTO `katalogbuku` (`id`, `judul`, `flipbook`, `halaman`, `tanggal_terbit`, `bahasa`, `penerbit`, `isbn`, `berat`, `lebar`, `panjang`, `deskripsi`, `fotobuku`) VALUES
(1, 'RIWAYAT HIDUP  H. IBRAHIM, M.Sc', NULL, '71', '2021-04-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-94656-9-8', '300', '21', '29.7', 'Hidup dan Matinya manusia adalah Sesuai dengan takdir Allah SWT. Apa yang akan terjadi bagi manusia tidak ada yang tahu. Manusia hidup hanya mengikuti Qadha dan Qadhar dari Allah SWT. Demikian pula dengan kehidupan &quot;Eyang&quot;, hanya mengikuti Qadha dan Qadhar yang telah ditentukan Allah SWT. Eyang hanya bisa menceritakan kehidupan yang berdasarkan apa yang dialami dan diingat serta apa yang diceritakan orang.', '1__Cover_Depan_(1)1.png'),
(2, 'EVIDENCE BASED IN MIDWIFERY', NULL, '138', '2021-08-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-97648-1-4', '300', '21', '29.7', 'Modul Evidence Based in Midwifery (EBM) ini merupakan suatu pedoman bagi mahasiswa kebidanan dalam mempelajari dasar-dasar evidence based practice. Modul terdiri atas 4 bab, yang disusun secara sistematis guna memberikan pemahaman yang komprehensif tentang EBM, meliputi:\r\n1. Berfikir kritis dalam kebidanan\r\n2. Langkah-langkah mempraktikkan evidence based practice in midwifery\r\n3. Mempraktikkan langkah-langkah evidence based practice dalam asuhan kebidanan\r\n4. Evidence based practice dalam asuhan pra natal, intra natal,\r\npost natal, bayi, balita sehat, kontrasepsi dan perimenopause. Mahasiswa juga dipandu oleh penulis dalam mempraktikkan langkah-langkah EBM melalui lembar kerja pada setiap bab. Pada akhir pembelajaran, disertakan evaluasi belajar guna mengukur kemampuan mahasiswa dalam memahami dasar teori yang telah dijelaskan. Dengan mempelajari dan mempraktikkan materi di modul ini, mahasiswa diharapkan dapat menerapkan praktik kebidanan berbasis bukti.', 'Depan_1.jpg'),
(3, 'MODUL SANITASI HIGIENE MAKANAN DAN MINUMAN SEHAT', NULL, '13', '2021-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-03-07', '300', '21', '29.7', '(Tidak Ada)', 'Front1.png'),
(4, 'PEMANTAUAN WILAYAH SETEMPAT KESEHATAN IBU DAN ANAK', NULL, '79', '2021-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-02-0', '300', '21', '29.7', '(Tidak Ada)', 'Cover-012.png'),
(5, 'Kader Posyandu Lansia Mandiri : Penyakit Tidak Menular', NULL, '35', '2021-08-15', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-00-6', '300', '21', '29.7', '(Tidak Ada)', 'Kader_Posyandu_Lansia_Mandiri_Revisi-011.png'),
(6, 'Asuhan Kebidanan Pada Masa Pandemi COVID-19', NULL, '277', '2021-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-04-4', '300', '21', '29.7', '(Tidak Ada)', 'Master Revisi 2-03.png'),
(7, 'Media Pembelajaran Berbasis Flypaper', NULL, '25', '2021-12-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-06-8', '300', '21', '29.7', '(Tidak Ada)', 'Front_Cover1.jpg'),
(8, 'COVID-19', NULL, '35', '2021-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-09-9', '300', '21', '29.7', '(Tidak Ada)', 'Front_Cover1.png'),
(9, 'Mitigasi Bencana Gunung Api', NULL, '36', '2021-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-08-2', '300', '21', '29.7', '(Tidak Ada)', 'Front_Cover_(1)2.jpg'),
(10, 'BUKU SAKU KESEHATAN REPRODUKSI CALON PENGANTIN', NULL, '37', '2022-01-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-13-6', '300', '21', '29.7', '(Tidak Ada)', 'Revisi_3-021.png'),
(11, 'PENDIDIKAN KARAKTER BAGI MAHASISISWA KEBIDANAN', NULL, '81', '2022-01-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-12-9', '300', '21', '29.7', '(Tidak Ada)', 'Revisi_3-031.png'),
(12, 'Asesmen Persepsi Visual Berupa Buku Digital Interaktif Untuk Anak Tunagrahita', NULL, '38', '2022-07-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-11-2', '300', '21', '29.7', '(Tidak Ada)', 'Front_Cover_Revisi_(2)2.png'),
(13, 'Mengenal Investasi dan Analisis Single Indeks Model', NULL, '53', '2021-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-14-3', '300', '21', '29.7', '(Tidak Ada)', 'Mengenal_Investasi-031.png'),
(14, 'Sejarah Pemikiran Ekonomi Islam', NULL, '165', '2022-07-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-16-7', '300', '21', '29.7', 'Sejatinya sebelum Islam masuk di tengah-tengah masyarakat Arab, bangsa Arab hidup dalam kejahiliyahan.Mereka larut dalam kegelapan kejahatan dan tahayul serta bodoh dalam etika. Di samping itu, mereka telah mengenal kehidupan sosial, ekonomi, bahasa dan seni, meskipun masih sederhana. Menurut pendapat para ulama ahli ilmu bumi, bumi ini terdiri atas tiga benua, yaitu Asia, Afrika, dan Eropa. Kemudian ditambah dua benua, yaitu Amerika yang ditemukan pada abad ke-15 M dan Australia yang ditemukan pada abad ke-17 M. Jadi, di muka bumi ini terdapat lima benua. Proses pertumbuhan ekonomi diberbagai benua saling keterkaitan dengan agama islam yang dirangkum dalam modul ajar ini.', 'Front3.png'),
(15, 'BIOMATERIAL LIMBAH CANGKANG KERANG SIMPING', 'https://online.fliphtml5.com/ffcle/ieaa/', '75', '2022-08-08', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-26-6', '300', '21', '29.7', 'Monograf ini mendeskripsikan tentang hasil penelitian limbah cangkang kerang simping yang merupakan biomaterial dan memiliki banyak kegunaan dalam kehidupan sehari-hari. Melalui monograf ini, pembaca diharapkan dapat memahami bagaimana sintesis cangkang kerang simping menjadi kalsium karbonat dan karakterisasi apa saja yang digunakan untuk mengidentifikasi sifat-sifat fisik dari cangkang kerang simping.', 'Front_cover_(1)_(1)_(1)1.jpg'),
(16, 'BIODEGRADABLE FOAM PATI SINGKONG', NULL, '72', '2022-05-06', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-20-4', '300', '21', '29.7', 'Dampak negatif yang ditimbulkan dari sterofoam menyebabkan perlunya dikembangkan produk biofoam yang diharapkan mampu menggantikan styrofoam saat ini. Biofoam memiliki keunggulan yang jauh lebih mudah untuk terdegradasi karena berasal dari bahan alami yang berasal dari pati tumbuhan. Karena berasal dari bahan alami maka tidak sulit untuk menemukan bahan baku biofoam sehingga menyebabkan harga dari biofoam ini lebih ekonomis.', 'Front-Cover1.png'),
(17, 'Tumbuhan Bajakah Kalimantan', NULL, '21', '2022-10-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-21-1', '300', '21', '29.7', '(Tidak Ada)', '1_(1)1.png'),
(18, 'Aplikasi Machine Learning di Bidang Manajemen Konstruksi', 'https://online.fliphtml5.com/ffcle/kxex/', '120', '2021-07-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-22-8', '300', '21', '29.7', 'Model manajemen proyek sebagai salah satu pendekatan yang paling sering digunakan untuk mengevaluasi progress fisik proyek konstruksi memiliki keterbatasan kapabilitas dan akurasi saat digunakan pada proyek konstruksi yang sangat kompleks dan memiliki unsur variabilitas dan ketidakpastian yang tinggi. Oleh sebab itu, model manajemen proyek perlu dikombinasikan dengan algoritma lain agar performansi forecasting yang dihasilkan dapat optimal.\r\n\r\nPerkembangan modifikasi model manajemen proyek untuk mengatasi kelemahan manajemen proyek saat ini masih terbatas pada mengaplikasikan model statistika dan matematika ke dalam model manajemen proyek. Literatur yang membahas integrasi machine learning algorithm ke dalam model manajemen proyek masih sangat terbatas meskipun telah banyak literature yang meneliti keunggulan machine learning algorithm untuk memecahkan masalah yang kompleks dengan memanfaatkan teknologi komputasi yang berkembang pesat saat ini. Machine learning algorithm memiliki keunggulan dari sisi speed, akurasi dan kemampuan mengatasi variabilitas data untuk memecahkan masalah forecasting. Oleh sebab itu, penelitian yang diusulkan akan fokus pada integrasi ANN, SVM, dan Regression model ke dalam model manajemen proyek (CPM, PERT dan EVM) serta menentukan level parameter yang optimal pada setiap model.', 'front-cover_(1)1.png'),
(19, 'Etnobotani Dan Sosial Ekonomi Suku Dayak Kenyah Desa Budaya Pampang  Kalimantan Timur', 'https://online.fliphtml5.com/ffcle/kdxg/', '55', '2021-10-10', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-39-6', '300', '21', '29.7', 'Indonesia dikenal sebagi negara megabiodiversity sebab tingginya tingkatan keanekaragaman hayatinya. Hal ini dikarenakan Indonesia terletak di daerah tropis dengan posisi geografis tepat di garis khatulistiwa dan posisi geologisnya merupakan pertemuan\r\nlempeng tektonik, sehingga menghasilkan mineral yang melimpah. Dengan kondisi tersebut,\r\nIndonesia dapat menciptakan alterasi genetik flora, fauna. dan mikroorganisme yang, sangat\r\nmelimpah.Terdapat kurang lebih 17.000 pulau di Indonesia dengan keanekaragam flora lebih\r\ndari 40.000 tipe tanaman, dimana 30. 000 antara lain hidup di Kepulauan Indonesia, yang bisa\r\ndimanfaatkan selaku tumbuhan industri, tumbuhan buah-buahan, tumbuhan rempah serta\r\ntumbuhan obat. Di antara 30.000 tumbuhan, setidaknya 9.600 tumbuhan dikehal mempunyai\r\nmanfaat obat, serta industri obat tradisional memakai kurang lebih 300 tumbuhan untuk\r\nkomponen obat tradisional dan pulau kalimantan merupakan\'salah satu pulau yang memiliki\r\nkeanekaragam hayati terbesar di Indonesia. Penduduk Indonesia terdiri dari berbagai suku\r\nbangsa yang tersebar di seluruh nusantara. Salah satu sukuryang ada di Indonesia adalah suku\r\nDayak. Suku Dayak terdiri dari ratusan sub-suku yang terbagi menjadi 6 kelompok utama yaitu:\r\nKenyah, Kayan dan Bahau yang mendiami Kalimantan Timur, Ot-Danum yang umumnya\r\nmendiami Kalimantan Tengah, Kelematan yang mendiami Kalimantan Barat, Hebah yang\r\nmendiami Malaysia, Sabah bagian timur dan utara bagian dari Kalimantan Timur\'dan Punan,\r\nserta suku-suku yang bermigrasi di pedalaman Kalimantan\r\n\r\nBuku Etnobotani Dan Sosial Ekonomi Suku Dayak Kenyah Desa Budaya Pampang\r\nKalimantan Timur ini menyajikan tentang kondisi masyarakat desa pampang kearifan”lokal,\r\nsosial budaya ekonomi masyarakat serta tanaman dan pengobatan ‘tradisional ‘Suku dayak\r\nkenyah masyarakat desa pampang.\r\n\r\nKehadiran buku ini diharapkan dapat memperkaya wawasan dan péngetahuan\r\ntentang Etnobotani Dan Sosial Ekonomi Suku Dayak Kenyah Desa Budaya,Pampang Kalimantan\r\nTimur, Indonesia, selain itu, semoga buku ini mampu memberikan informasi yang komprehensif\r\nkepada masyarakat dan kalangan akademis yang membutuhkan.', 'front-cover_(2)1.png'),
(20, 'MENCATAT YANG BENAR', NULL, '77', '2022-05-02', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-30-3', '300', '21', '29.7', 'Catatan adalah jejak perkuliahan yang berupa rekaman tertulis baik saat perkuliahan berlangsung, catatan hasil membaca sumber (buku dll.), catatan diskusi, catatan pertanyaan-pertanyaan, respons mahasiswa dan dosen atas pertanyaan, maupun catatan inspirasi yang diperoleh ketika atau setelah mempelajari suatu topik tertentu. Buku  MENCATAT YANG BENAR: Cara Baru Membuat Catatan Perkuliahan agar Kreatif dan Produktif dalam Belajar di PT ini selain dapat digunakan mencatat secara sistematis enam hal tersebut juga berisi motivasi dan kiat-kiat yang diperlukan mahasiswa untuk belajar secara benar. Proses belajar yang benar sangat penting mengingat proses itu akan mengondisikan mahasiswa dapat menggali, mengolah, memikirkan, dan menuangkan hasil pemikiran mengenai suatu topik ke dalam tulisan atau karya ilmiah yang bermutu. Kondisi ini penting mengingat puncak pemahaman seorang mahasiswa tentang suatu topik secara komprehensif, mendalam, dan lengkap tampak pada wujud tulisan yang dihasilkan. Buku ini menjadi wadah bagi mahasiswa untuk merekam gagasan-gagasannya sebagai buah dari proses berpikir kritis, kreatif, dan produktif sebelum dituangkan menjadi tulisan.', 'front5.png'),
(21, 'MAXIMUM FLOW DAN PENERAPANNYA', NULL, '74', '2022-01-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-24-2', '300', '21', '29.7', '(Tidak Ada)', 'Cover_E_book_page-00011.jpg'),
(22, 'MENULIS SKRIPSI BERMUTU DALAM 30 HARI, TANPA PLAGIASI, BISA!', NULL, '150', '2022-10-10', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-29-7', '300', '21', '29.7', 'Skripsi adalah matakuliah berbasis pemikiran, riset dan\r\npengembangan yang wajib ditempuh dan lulus bagi\r\nmahasiswa program sarjana. Bila dilihat dari proses dan\r\nwujud akhirnya, skripsi dapat disebut sebagai matakuliah khusus.\r\nKekhususan itu tercermin dari adanya proses panjang\r\nmulai dari penyusunan proposal, pelaksanaan riset,\r\nanalisis data, sampai penulisan laporan dan bahkan\r\nperlu adanya publikasi yang wajib dihasilkan oleh\r\nmahasiswa yang sedang menempuh matakuliah skripsi.\r\nKarena adanya proses yang cukup panjang untuk\r\nmenghasilkan skripsi inilah, mahasiswa sering mengalami\r\nhambatan, kesulitan, dan bahkan banyak yang gagal dalam\r\npenyelesaian studinya. Buku Menulis Skripsi Bermutu dalam\r\n30 Hari Tanpa Plagiasi, Bisa! dihadirkan untuk membantu\r\nmahasiswa sejak dini memikirkan rencana dan berproses\r\nmenghasilkan skripsi yang bermutu dan terhindar dari plagiasi.\r\nSkripsi bermutu tanpa plagiasi wajib diperjuangkan oleh setiap\r\nmahasiswa agar karya ilmiahnya berkontribusi untuk\r\npengembangan keilmuan dan berguna bagi masyarakat\r\nserta penulisnya bermartabat.', 'front7.png'),
(23, 'Hakikat Penelitian dan Kajian Pustaka Seri : Metodologi Penelitian Pendidikan  Kimia', 'https://online.fliphtml5.com/ffcle/apvi/', '55', '2022-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-31-0', '300', '21', '29.7', 'Buku yang ini adalah Seri pertama dari beberapa seri metodologi penelitian pendidikan\r\nKimia yang dapat digunakan sebagai salah satu referensi dalam perkuliahan metodologi\r\npenelitian pendidikan kimia ataupun perkuliahan metodologi penelitian pendidikan secara\r\numum. Pada seri ini, fokus pembahasan adalah tentang hakikat penelitian dan kajian pustaka.', 'Front9.png'),
(24, 'PENCEGAHAN PERILAKU SEKS PRANIKAH PADA REMAJA MINANGKABAU MELALUI PERAN  ORANG TUA', 'https://online.fliphtml5.com/ffcle/wumc/', '91', '2022-07-14', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-40-2', '300', '21', '29.7', 'Buku ini berisikan modul Kesehatan Reproduksi “Pencegahan Perilaku Seksual\r\nPranikah Pada Remaja” sebagai bahan pembelajaran yang dapat dipelajari oleh\r\norang tua dengan tujuan memberikan edukasi dan mencegah perilaku seks pranikah\r\npada remaja. Buku ini sangat lengkap dalam membahas materi tersebut.\r\nTidak saja dijelaskan pengertian dan definisinya, namun juga disertai tahap-tahapan\r\ndalam menggunakan modul dan contoh soal lengkap dengan metode pre-test dan\r\npost-test dalam mengevaluasi peserta. Strategi pembelajaran pada pelatihan ini,\r\nmenggunakan pendekatan partisipatoris yaitu pendekatan belajar yang mensyaratkan\r\npartisipasi aktif dari peserta. Materi yang tersaji dalam buku ini merupakan perpaduan\r\nmateri dari berbagai sumber relevan. Adapun tujuan penempatan fasilitator, yaitu\r\nmelakukan fasilitasi dan pendampingan dalam mengaplikasikan modul kepada peserta.\r\nDi setiap materi ada tujuan yang mesti dicapai oleh fasilitator dalam menjalankan\r\nmodul. Pertama, peserta mampu melakukan pencegahan perilaku pranikah seksual.\r\nKedua, peserta mampu memahami faktor penyebab perilaku seksual pranikah pada\r\nremaja Minangkabau. Ketiga, peserta mampu memahami peran orang tua dalam\r\npencegahan perilaku seksual pranikah pada remaja Minangkabau', 'Front-Cover3.png'),
(26, 'PEMBERDAYAAN MASYARAKAT DALAM PENCEGAHAN KEJADIAN UNMET NEED KB', 'https://online.fliphtml5.com/ffcle/wemj/', '106', '2022-07-14', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-33-4', '300', '21', '29.7', 'Di Indonesia, data persentase akseptor KB mencatat bahwa pada\r\nahun 2017 jumlah persentase mengalami penurunan yaitu 63,22%\r\nsedangkan tahun 2016 tercatat 74,80%. Kota padang berupaya untuk\r\nmenurunkan angka kejadian unmet need dengan berbagai program\r\ndari pemerintah salah satunya adalah program kampung KB. Untuk\r\nkeberhasilan kampung KB pemberdayaan masyarakat sangat diperlukan\r\nmelalui penyadaran, pengkapasitasan dan pendayaan. Buku ini hadir\r\nsebagai pegangan bagi masyarakat yang ikut berperan serta dalam\r\nmemberikan edukasi kesehatan secara langsung kepada pasangan\r\nusia subur mengenai unmet need dalam ber-KB dan meningkatkan\r\npengetahuan pasangan usia subur mengenai unmet need dalam ber-KB.\r\nMeskipun banyak ditemukan buku yang bertema sama dengan buku ini\r\nnamun isi buku ini tidak hanya menjelaskan materi tapi juga berisikan\r\nmodul pembelajaran yang dapat digunakan sebagai bahan ajar antara\r\npeserta dan pendidik yang berisikan tujuan kegiatan pembelajaran,\r\nlangkah-langkah, evaluasi dan umpan balik (pre-test dan post-test)\r\ndi setiap masing-masing materi. Modul ini dapat digunakan langsung\r\noleh Tokoh Masyarakat, tokoh agama, kader, dan pasangan usia subur.\r\nNamun tidak dapat digunakan secara langsung oleh remaja.', 'Front-Cover7.png'),
(27, 'ULKUS DIABETIKUM : Resistensi Antibiotik &amp; Bakteri Pembentuk Biofilm', 'https://online.fliphtml5.com/ffcle/qubt/', '147', '2023-02-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-52-5', '300', '21', '29.7', 'Indonesia merupakan negara yang memiliki jumlah penderita diabetes mellitus\r\nterbanyak ke-5 di dunia yang hampir mencapai 19.5 juta orang, berdasarkan data\r\nInternational Diabetes Federation (IDF) di tahun 2021. Oleh sebab itu, penulis ini meneliti penyakit\r\nyang cukup banyak dialami oleh penduduk Indonesia. Mengingat terbatasnya pengetahuan penulis,\r\npenulis membatasi penelitian ini dengan berfokus pada bakteri.\r\n\r\nAdapun empat tujuan penelitian ini, yaitu: 1) Menjelaskan tentang karakteristik mikroorganisme\r\nyang berpotensi membentuk biofilm polimikrobial dan proses terjadinya interaksi pada ulkus\r\ndiabetes kronis. 2) Menjelaskan tentang manifestasi klinis infeksi biofilm polimikrobial pada ulkus\r\ndiabetes kronis. 3) Menjelaskan tentang diagnosis klinis dan laboratoris pada infeksi biofilm\r\npolimikrobial pada ulkus diabetes kronis. 4) Menjelaskan tentang tatalaksana dan pencegahan\r\ninfeksi biofilm polimikrobial pada ulkus diabetes kronis. Hasil dari empat tujuan penelitian tersebut\r\ndapat dibaca secara detail di buku ini.\r\n\r\nPenulis Buku ini membagi pembahasan menjadi dua bagian. Bagian Pertama, berjudul Pembentukan\r\nBiofilm pada Infeksi oleh Bakteri Multi-Drugs Resistant berisi tujuh bab. Pada Bagian Kedua,\r\nberjudul Biofilm Polimikrobial pada Ulkus Diabetes Kronis berisi enam bab.', 'front-cover9.png'),
(28, 'Pembelajaran Eksploratif Konsep dan Proses Fisika di Danau Tondano', 'https://online.fliphtml5.com/ffcle/mmdl/', '49', '2022-10-20', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-48-8', '300', '21', '29.7', 'Pembelajaran eksploratif tentang konsep dan proses fisika di Danau Tondano merupakan\r\ncontoh proses belajar fisika dengan memanfaatkan alam sekitar sebagai objek pembelajaran.\r\nTujuan dari penelitian ini untuk mengetahui efektivitas pembelajaran eksploratif konsep dan\r\nproses fisika di Danau Tondano. Metode yang digunakan dalam penelitian ini adalah penelitian\r\npre-eksperimen dengan one group pretest-posttest design. Penelitian ini dilakukan melalui tiga\r\ntahapan. Tahap pertama adalah memberikan pretest untuk mengukur kemampuan awal\r\nmahasiswa. Tahap kedua yaitu memberi perlakukan (treatment) melalui pembelajaran\r\neksploratif dan tahap ketiga adalah memberikan posttest sebagai evaluasi pembelajaran.\r\nSubjek penelitiannya adalah mahasiswa semester Ill Program Studi Pendidikan Fisika\r\nUniversitas Negeri Manado 2021/2022. Setelah diperoleh data hasil penelitian diolah secara\r\nstatistik dengan bantuan SPSS 22.0 for windows. Rata-rata hasil pretest 51,00 dan hasil\r\nposttest 90,62. Perolehan nilai N-Gain dari masing-masing mahasiswa, terdapat sebanyak 13\r\nmahasiswa (keseluruhan) pada kategori N-Gain tinggi dengan presentase 100%. Hasil\r\npenelitian ini menunjukkan bahwa pembelajaran eksploratif tentang konsep dan proses fisika\r\npada permukaan air Danau Tondano efektif diterapkan dalam proses belajar fisika.', 'Front-Cover11.png'),
(33, 'PEDOMAN PENGAMBILAN SAMPEL DAN UJI BIOFILM PADA SAMPEL  KLINIS', 'https://online.fliphtml5.com/ffcle/iicc/', '80', '2023-01-12', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-45-7', '300', '21', '29.7', '(Tidak Ada)', 'front-cover21.png'),
(34, 'BUKU APLIKASI ASESMEN BERBASIS GAMIFIKASI DALAM PEMBEJALARAN  MATEMATIKA SMP', NULL, '57', '2022-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-44-0', '300', '21', '29.7', '(Tidak Ada)', 'cvr1.png'),
(35, 'ADA APA DENGAN ANEMIA ?', 'https://online.fliphtml5.com/ffcle/njmw/', '77', '2022-02-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-38-9', '300', '21', '29.7', 'Anemia merupakan suatu kondisi dimana jumlah sel darah merah atau hemoglobin\r\nkurang dari normal, penyakit ini penyebab kecacatan kedua tertinggi di dunia dimana\r\nsekitar 25% orang di dunia ini terkena anemia, khususnya penderita anemia yang terkena\r\nAnemia Defisiensi Besi (ADB) yang disebabkan kebutuhan yang meningkat, asupan zat\r\nbesi yang kurang, infeksi, dan perdarahan saluran cerna dan juga terdapat faktor-faktor\r\nlainnya. Penyakit ini dapat menyerang wanita, ibu hamil, anak balita-remaja, dan\r\nmasyarakat yang mengalami faktor sosio-ekonomi yang rendah. Oleh karena itu, penting\r\nuntuk memberikan wawasan yang bermanfaat bagi tenaga kesehatan tentang anemia\r\ndalam mengenali dan melakukan tatalaksana yang tepat terkait penyakit ADB.\r\nBuku “Ada Apa Dengan Anemia” merupakan bentuk kepedulian penulis dalam masalah\r\nkesehatan masyarakat yang sering dijumpai di dunia. Buku ini berisikan modul sebagai\r\nbahan pembelajaran yang dapat dipelajari oleh tenaga kesehatan yang menjelaskan secara\r\nkhusus mulai dari konsep darah, pengertian anemia, bahan pangan pencegahan anemia,\r\ndan faktor lingkungan terhadap kejadian anemia', 'front-cover23.png'),
(36, 'STRATEGI MENINGKATKAN KEPERCAYAAN DIRI DAN KOMPETENSI BIDAN DAN CALON  BIDAN', 'https://online.fliphtml5.com/ffcle/grwj/', '79', '2023-01-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-36-5', '300', '21', '29.7', 'Buku ini diperuntukkan untuk institusi Pendidikan bidan dan mahasiswa bidan di Indonesia.\r\nKehadiran buku ini sebagai upaya mempermudah tenaga kesehatan khususnya pada\r\npeningkatan kepercayaan diri dan kompetensi bidan dan calon bidan. Secara umum isi\r\nbuku ini mencakup hal-hal yang berkaitan dengan kepercayaan diri dan kompetensi bidan\r\nyaitu; konsep kepercayaan diri, kompetensi bidan, upaya peningkatan kepercayaan diri dan\r\nkompetensi bidan, instrument INOSCO (Inovasi Instrumen Self-Assessed Confidence)\r\nsebagai alat ukur kepercayaan diri. Melalui buku ini pembaca diajak untuk ikut serta\r\nmengukur tingkat kepercayaan diri dan kompetensi sebagai bidan, sehingga calon bidan\r\nmaupun institusi Pendidikan bidan dapat melakukan pengukuran terhadap dirinya sendiri\r\nmemalui instrument INOSCO. Buku ini layak dan patut untuk dibaca oleh mereka yang\r\nberperan dalam kebidanan, karena seorang bidan diharuskan mem kompetensi dan\r\nbidang pengetahuan, keterampilan, dan perilaku dalam melaksanakan praktik kebidanan\r\nsecara aman dan bertanggungjawab dalam berbagai tatanan pelayanan kesehatan.\r\nDengan disusun secara apik dan mudah dipahami, buku ini bacaan yang penting untuk\r\ncalon bidan yang ingin meningkatkan kepercayaan diri dan kompetensi dalam\r\nmemberikan asuhan kebidanan.', 'front-cover25.png'),
(37, 'MENUJU ADMINISTRASI DIGITAL DENGAN SISTEM INFORMASI  DESA', 'https://online.fliphtml5.com/ffcle/lott/', '131', '2022-11-04', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-42-6', '300', '21', '29.7', 'Kecanggihan teknologi saat ini tidak dapat terhindarkan dalam\r\nkehidupan sehari-hari yang tentunya membuat berbagai aktivitas manusia\r\nmenjadi lebih terbantu. Perkembangan teknologi yang ada juga mendorong\r\ntransformasi dunia pemerintahan untuk mengubah cara kerja dari\r\nkonvensional menjadi digital, tidak terlepas pemerintahan desa. Digitalisasi\r\npemerintahan menciptakan e-government, sehingga pelayanan pemerintah\r\nkepada masyarakat akan menjadi terintegrasi, efektif, efisien dan akuntabel.\r\nPenduduk desa yang ingin mengurus surat menyurat tidak perlu datang ke\r\nkantor desa, namun cukup diakses di rumah melalui fitur layanan mandiri dari\r\naplikasi berbasis website Sistem Informasi Desa. Buku ini ada untuk\r\nmemudahkan Pemerintah Desa Talok Kecamatan Turen Kabupaten Malang\r\ndalam mengoptimalkan sistem yang ada dalam menciptakan tertib\r\nadministrasi desa.', 'front-cover27.png'),
(38, 'MENJADI AJUN AKTUARIS PROFESIONAL', NULL, '51', '2022-11-01', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-47-1', '300', '21', '29.7', '(Tidak Ada)', 'cover_buku1.PNG'),
(39, 'ANALISIS DALAM MANAJEMEN KEUANGAN', NULL, '177', '2022-11-04', 'Indonesia', 'CV. Penulis Cerdas Indonesia', '978-623-5877-50-1', '300', '21', '29.7', 'Keuangan dalam sebuah perusahaan menjadi pondasi yang\r\nkuat terbangunnya sebuah perusahaan. Keuangan juga bersifat\r\nsangat riskan. Jika tidak dikelola dengan baik akan menjadi kacau\r\ndan tentunya akan menghentikan jalannya sebuah perusahaan.\r\nDalam sebuah perusahaan dibutuhkan bidang sendiri yang mengurus\r\nbagian keuangan atau bisa juga disebut manajemen keuangan.\r\nManajemen keuangan adalah kegiatan perencanaan, pengelolaan,\r\npenyimpanan, serta pengendalian dana dan aset yang dimiliki\r\nsuatu perusahaan. Pengelolaan keuangan harus direncanakan\r\ndengan matang agar tidak timbul masalah di kemudian hari.\r\nBuku ini ditulis untuk lebih diarahkan pembahasan pada\r\nanalisis-analisis yang ada di dalam bidang keuangan.\r\nAnalisis keuangan perlu dilakukan terutama untuk\r\nperusahaan-perusahaan dengan skala besar seller\r\n keuangan perusahaan bisa tertata dengan baik.', 'front-cover29.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layout`
--

CREATE TABLE `layout` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `buku_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layout`
--

INSERT INTO `layout` (`id`, `nama`, `buku_id`) VALUES
(1, 'Agustya Nur Prayuda, S.Sn', 1),
(2, 'Rachmat Fitriadi Caesar', 2),
(3, 'Rachmat Fitriadi Caesar', 3),
(4, 'Rany Ekawati', 4),
(5, 'Rachmat Fitriadi Caesar', 4),
(6, 'Rachmat Fitriadi Caesar', 5),
(7, 'Rachmat Fitriadi Caesar', 6),
(8, 'Rachmat Fitriadi Caesar', 0),
(9, 'Rachmat Fitriadi Caesar', 8),
(10, 'Rachmat Fitriadi Caesar', 9),
(11, 'Rachmat Fitriadi Caesar', 10),
(12, 'Rachmat Fitriadi Caesar', 11),
(13, 'Rachmat Fitriadi Caesar', 12),
(14, 'Rachmat Fitriadi Caesar', 13),
(15, 'Lila Andana Fitri', 14),
(16, 'Lila Andana Fitri, S.T.', 15),
(17, 'Lila Andana Fitri, S.T.', 16),
(18, 'Lila Andana Fitri', 18),
(19, 'Lila Andana Fitri, S.T.', 19),
(20, 'Lila Andana Fitri, S.T', 20),
(21, 'Lila Andana Fitri, S.T', 22),
(22, 'Lila Andana Fitri, S.T', 23),
(23, 'Lila Andana Fitri, S.T.', 24),
(24, 'Lila Andana Fitri, S.T.', 26),
(25, 'Lila Andana Fitri, S.T.', 27),
(26, 'Lila Andana Fitri, S.T', 33),
(27, 'Lila Andana Fitri, S.T.', 35),
(28, 'Lila Andana Fitri, S.T.', 36),
(29, 'Lila Andana Fitri, S.T.', 37),
(30, 'Lila Andana Fitri, S.T.', 39);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_submenu` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `id_role` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_submenu`, `title`, `icon`, `url`, `is_active`, `id_role`) VALUES
(1, 'Dashboard', 'fa-shop', 'dashboard', '1', 1),
(2, 'Dashboard', 'fa-shop', 'dashboard', '1', 2),
(3, 'Progress Buku', 'fa-book', 'progress', '1', 1),
(4, 'Progress Buku', 'fa-book', 'progress', '1', 2),
(5, 'Paket', 'fa-layer-group', 'paket', '1', 1),
(6, 'Event', 'fa-calendar-days', 'event', '1', 1),
(7, 'Jual Buku', 'fa-sack-dollar', 'sell', '1', 1),
(8, 'Penjualan Buku', 'fa-sack-dollar', 'purchase', '1', 1),
(9, 'Penjualan Buku', 'fa-sack-dollar', 'purchase', '1', 2),
(10, 'Siap ISBN', 'fa-book', 'dashboard/linkisbn', '1', 1),
(11, 'Daftar Katalog Buku', 'fa-credit-card', 'daftarbuku', '1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` varchar(15) NOT NULL,
  `progress_id` int(11) NOT NULL DEFAULT 1,
  `gross_amount` bigint(20) NOT NULL DEFAULT 0,
  `jenis` enum('Manual','Midtrans') DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `bukti` longtext DEFAULT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `status_progres` int(11) NOT NULL DEFAULT 0 COMMENT '0 = berhenti, 1 = proses, 2 = sukses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `progress_id`, `gross_amount`, `jenis`, `create_at`, `update_at`, `bukti`, `book_id`, `status_progres`) VALUES
('1676213749', 4, 0, 'Manual', '2023-02-12 14:55:43', '2023-02-23 03:18:39', NULL, 1, 0),
('1676214956', 6, 0, 'Manual', '2023-02-12 15:15:52', '2023-02-14 03:53:30', NULL, 2, 2),
('1676483301', 1, 1000000, 'Manual', '2023-02-15 17:48:14', NULL, NULL, 3, 0),
('1676965583', 1, 3000000, 'Manual', '2023-02-21 07:46:19', NULL, NULL, 4, 0),
('1677048331', 6, 10000, 'Manual', '2023-02-22 06:45:24', '2023-02-24 04:12:53', NULL, 5, 2),
('1679026905', 1, 20000, 'Manual', '2023-03-17 04:21:41', NULL, NULL, 6, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_progress`
--

CREATE TABLE `order_progress` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `order_progress`
--

INSERT INTO `order_progress` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DP', '2023-01-24 07:07:50', NULL),
(2, 'Cover', '2023-01-24 07:08:48', NULL),
(3, 'Editing', '2023-01-24 07:09:02', NULL),
(4, 'Layout', '2023-01-24 07:09:14', NULL),
(5, 'ISBN', '2023-01-24 07:09:22', NULL),
(6, 'Publish', '2023-02-03 02:08:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint(20) NOT NULL,
  `paket_name` varchar(255) NOT NULL,
  `service` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`service`)),
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pakets`
--

INSERT INTO `pakets` (`id`, `paket_name`, `service`, `is_active`, `create_at`, `update_at`) VALUES
(1, 'Lorem ipsum 1', '[{\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"Lorem ipsum dolor\"}]', '1', '2023-02-01 04:30:33', '2023-02-09 04:03:34'),
(2, 'Lorem ipsum 2', '[{\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"Lorem ipsum dolor\"}]', '0', '2023-02-01 04:30:33', '2023-02-22 03:20:15'),
(5, 'Paket 2', '[{\"fasilitas\": \"Lorem ipsum dolor\"}, {\"fasilitas\": \"lorem\"}, {\"fasilitas\": \"ipsum\"}]', '1', '2023-03-01 04:46:57', '2023-03-14 04:13:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_harga`
--

CREATE TABLE `paket_harga` (
  `id` int(11) UNSIGNED NOT NULL,
  `paket_id` bigint(20) NOT NULL,
  `harga` bigint(20) NOT NULL DEFAULT 0,
  `copy_num` int(11) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `paket_harga`
--

INSERT INTO `paket_harga` (`id`, `paket_id`, `harga`, `copy_num`, `create_at`, `update_at`) VALUES
(1, 1, 20000, 0, '2023-02-01 06:44:20', '2023-02-22 00:23:01'),
(3, 2, 3000000, 0, '2023-02-01 06:44:20', NULL),
(4, 2, 2000000, 0, '2023-02-01 06:44:20', NULL),
(6, 1, 30000000, 30, '2023-02-06 04:29:09', '2023-02-22 00:25:55'),
(9, 1, 20000, 15, '2023-02-16 00:25:49', '2023-02-22 00:22:06'),
(10, 1, 10000, 11, '2023-02-16 00:28:20', '2023-02-22 00:22:16'),
(11, 5, 5000000, 21, '2023-03-14 04:12:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(50) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `create_at`, `update_at`) VALUES
(1, 32, '8782a43D', '2023-03-06 04:08:04', '2023-03-07 02:57:58'),
(2, 36, '562LZ2eh', '2023-03-06 04:25:15', '2023-03-10 03:56:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `buku_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id`, `nama`, `buku_id`) VALUES
(1, 'Ibrahim', 1),
(2, 'Walrini', 1),
(3, 'Zahid Zufar At Thaariq', 1),
(4, 'Gita Kostania, S.ST.,M.Kes', 2),
(5, 'Prof. Dr. Bambang Setiaji, M.Si', 3),
(6, 'Dr. Hasyrul Hamzah, S.Farm., M.Sc', 3),
(7, 'Faldi, S.Kom., M.TI', 3),
(8, 'Rahman Anshari, S.E., M.A', 3),
(9, 'Rizky Kurniawan Syamat, S.E', 3),
(10, 'Jati Pratiwi', 3),
(11, 'Widya Rahmah', 3),
(12, 'Erika Nandini', 3),
(13, 'Rara Warih Gayatri', 4),
(14, 'Rany Ekawati', 4),
(15, 'Anindya Hapsari', 4),
(16, 'Rara Warih Gayatri', 5),
(17, 'Hartati Eko Wardani', 5),
(18, 'Tika Dwi Tama', 5),
(19, 'Brivian Florentis Yustanta., SST., M.Kes', 6),
(20, 'Gita Kostania, S.ST.,M.Kes', 6),
(21, 'Niken Bayu Argaheni, S.ST., M.Keb', 6),
(22, 'Wahyu Wijayati, SSiT, M.Keb', 6),
(23, 'Siska Ningtyas Prabasari, SST, M.Sc Ns-Mid', 6),
(24, 'Feling Polwandari, SST., M.Keb', 6),
(25, 'Aprilina, SST, M.Keb', 6),
(26, 'Leni Suhartini, SST.M.Kes', 6),
(27, 'Melly Damayanti, SST, M.Keb', 6),
(28, 'Yunri Merida, S.Si.T., M.Keb', 6),
(29, 'Murfi Hidamansyah, S.ST', 6),
(30, 'Naili Rahmawati, SST, M.Keb;', 6),
(31, 'Aida Fitriani, SST., M.Keb', 6),
(32, 'Dewi Sartika Siagian, SST, M. Keb', 6),
(33, 'Arum Meiranny, S.SiT., M.Keb', 6),
(34, 'Wahyu Nuraisya, SSiT, M.Keb', 6),
(35, 'Dewi Andariya Ningsih', 6),
(36, 'Neni Wahyuningtyas, M.Pd', 7),
(37, 'Neni Wahyuningtyas, M.Pd', 8),
(38, 'Alifian Nabila', 8),
(39, 'Neni Wahyuningtyas, M.Pd', 9),
(40, 'Nurul Ratnawati', 9),
(41, 'Febty Andini D.R', 9),
(42, 'Dewi Susanti, SST, M.Keb.', 10),
(43, 'Qorinah Estiningtyas Sakilah Adnani, SST, M.Keb, Ph.D', 10),
(44, 'Qorinah Estiningtyas Sakilah Adnani, SST, M.Keb, Ph.D', 11),
(45, 'Dewi Susanti, SST,M.Keb.', 11),
(46, 'Neny Yuniarti, S.Pd', 12),
(47, 'Dr. Ahsan Romadlon Junaidi, M.Pd', 12),
(48, 'Novi Puji Lestari, SE., M.M.', 13),
(49, 'Venus Kusumawardhana, SE., M.M.', 13),
(50, 'Adetto Ramadinata, S.M.', 13),
(51, 'Dr. Bustami, SE., M.Si', 14),
(52, 'Romi Suradi, S.EI., M.E.', 14),
(53, 'Diki Dwi Pramono, S.T.', 15),
(54, 'Jibril Maulana S.T.', 16),
(55, 'Dr. Hasyrul Hamzah, M.Sc', 17),
(56, 'Dr.Sylvia Tunjung Pratiwi, M.Si', 17),
(57, 'Dr.apt.Asriullah Jabbar, MPH', 17),
(58, 'Aldo Pratama', 17),
(59, 'Renita Mahardhika Putri', 17),
(60, 'Apif M. Hajji', 18),
(61, 'Aisyah Larasati', 18),
(62, 'Abdul Muid', 18),
(63, 'Deni Prastyo', 18),
(64, 'Rima Lusiana', 18),
(65, 'Hasyrul Hamzah', 19),
(66, 'Lutfi Chabib', 19),
(67, 'Roni Setiawan', 19),
(68, 'Bambang Setiaji', 19),
(69, 'Chaerul Fadly Mochtar Lutfhi M', 19),
(70, 'Badrani Abbas Al-Fajri', 19),
(71, 'Prof. Dr. Suyono, M.Pd', 20),
(72, 'Sapti Wahyuningsih', 21),
(73, 'Lucky Tri Oktoviana', 21),
(74, 'Prof. Dr. Suyono, M.Pd', 22),
(75, 'Habiddin', 23),
(76, 'Ratna Kumala Dewi', 23),
(77, 'Saninah Widad', 23),
(78, 'Pinky Kusuma Ningtyas', 23),
(79, 'Dewi Susanti, SST, M.Keb', 24),
(80, 'Erwani, SKM, M.Kes', 24),
(81, 'Aprizal Ponda, SKM, M.Kes', 24),
(82, 'Qorinah Estiningtyas Sakilah Adnani, SST, M. Keb, Ph.D', 24),
(83, 'Erwani, SKM. M.Kes', 26),
(84, 'Elda Yusefni, S.ST, M.Keb', 26),
(85, 'Dewi Susanti, S.ST, M.Keb', 26),
(86, 'Qorinah Estiningtyas Sakilah Adnani, SST., M.Keb, Ph.D', 26),
(87, 'Maria Silvia Merry', 27),
(88, 'Siti Nurhayati Kholidah', 27),
(89, 'Gusnaniar', 27),
(90, 'Rizka Humardewayanti Asdie', 27),
(91, 'Mustofa', 27),
(92, 'Triana Hertiani', 27),
(93, 'Titik Nuryastuti', 27),
(94, 'Titik Nuryastuti', 33),
(95, 'Triana Hertiani', 33),
(96, 'Dwi Utami Anjarwati', 33),
(97, 'Dewi Purbaningsih', 33),
(98, 'Siti Nurhayati Kholidah', 33),
(99, 'Sayyidah Auliany Aminy', 33),
(100, 'Almarissa Ajeng Prameshwara', 33),
(101, 'Vidyadhari Puspa Prawarni', 33),
(102, 'Vidyadhari Puspa Prawarni', 33),
(103, 'Kumala', 33),
(104, 'Azizah, S.Pd., M.Si', 34),
(105, 'Dra. Sapti Wahyuningsih, M.Si', 34),
(106, 'Asmianto, S.Si., M.Si', 34),
(107, 'Dr. Abd Qohar, M.T', 34),
(108, 'Assoc. Prof. Dr. Noor Azean binti Atan', 34),
(109, 'Qorinah Estiningtyas Sakilah Adnani, SST., M.Keb., Ph.D', 35),
(110, 'Dr.Sc. Dina Oktavia, S.Hut., M.Si', 35),
(111, 'Lani Gumilang, SST., MM', 35),
(112, 'Meylani Zakaria, S.Keb.,Bd', 35),
(113, 'Ade Zayu Cempaka Sari, SST', 35),
(114, 'Ira Nufus Khaerani, S.Tr. Keb, Bdn', 35),
(115, 'Dr. Evi Novianti', 35),
(116, 'Prof. Sunardi, Ph.D', 35),
(117, 'Qorinah Estiningtyas Sakilah Adnani, SST., M.Keb., Ph.D', 36),
(118, 'Giyawati Yulilania Okinarum, SST., M.Keb', 36),
(119, 'Lani Gumilang, SST., MM', 36),
(120, 'Ari Indra Susanti, SST., M.Keb', 36),
(121, 'Neneng Martini, SST., M.Keb', 36),
(122, 'Ade Zayu Cempaka Sari, SST', 36),
(123, 'Ira Nufus Khaerani, S.Tr. Keb, Bdn', 36),
(124, 'Andi Basuki, S.Pd., M.Pd', 37),
(125, 'Vera Eka Rahmawati', 37),
(126, 'Azizah, S.Pd, M.Si', 38),
(127, 'Alfi Nabila Lathifah', 38),
(128, 'Alfi Nabila Lathifah', 38),
(129, 'Sarah Permatasari Aritonang', 38),
(130, 'Sarah Permatasari Aritonang', 38),
(131, 'Gloria Indah Permata', 38),
(132, 'Gloria Indah Permata', 38),
(133, 'Siti Nuradilla', 38),
(134, 'Siti Nuradilla', 38),
(135, 'Novi Puji Lestari.,SE.,M.M', 39),
(136, 'Chalimatuz Sa’diyah.,SE.,M.M', 39),
(137, 'Drs.Warsono.,M.M', 39);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kabupaten_kota`
--

CREATE TABLE `ref_kabupaten_kota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_provinsi_id` bigint(20) UNSIGNED NOT NULL,
  `kode_kabupaten_kota` varchar(4) NOT NULL,
  `nama_kabupaten_kota` varchar(100) NOT NULL,
  `nama_kabupaten_kota_alias` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 = Tidak Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `ref_kabupaten_kota`
--

INSERT INTO `ref_kabupaten_kota` (`id`, `ref_provinsi_id`, `kode_kabupaten_kota`, `nama_kabupaten_kota`, `nama_kabupaten_kota_alias`, `status`, `created_at`, `updated_at`) VALUES
(1101, 11, '1101', 'KABUPATEN SIMEULUE', 'KABUPATEN SIMEULUE', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1102, 11, '1102', 'KABUPATEN ACEH SINGKIL', 'KABUPATEN ACEH SINGKIL', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1103, 11, '1103', 'KABUPATEN ACEH SELATAN', 'KABUPATEN ACEH SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1104, 11, '1104', 'KABUPATEN ACEH TENGGARA', 'KABUPATEN ACEH TENGGARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1105, 11, '1105', 'KABUPATEN ACEH TIMUR', 'KABUPATEN ACEH TIMUR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1106, 11, '1106', 'KABUPATEN ACEH TENGAH', 'KABUPATEN ACEH TENGAH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1107, 11, '1107', 'KABUPATEN ACEH BARAT', 'KABUPATEN ACEH BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1108, 11, '1108', 'KABUPATEN ACEH BESAR', 'KABUPATEN ACEH BESAR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1109, 11, '1109', 'KABUPATEN PIDIE', 'KABUPATEN PIDIE', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1110, 11, '1110', 'KABUPATEN BIREUEN', 'KABUPATEN BIREUEN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1111, 11, '1111', 'KABUPATEN ACEH UTARA', 'KABUPATEN ACEH UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1112, 11, '1112', 'KABUPATEN ACEH BARAT DAYA', 'KABUPATEN ACEH BARAT DAYA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1113, 11, '1113', 'KABUPATEN GAYO LUES', 'KABUPATEN GAYO LUES', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1114, 11, '1114', 'KABUPATEN ACEH TAMIANG', 'KABUPATEN ACEH TAMIANG', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1115, 11, '1115', 'KABUPATEN NAGAN RAYA', 'KABUPATEN NAGAN RAYA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1116, 11, '1116', 'KABUPATEN ACEH JAYA', 'KABUPATEN ACEH JAYA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1117, 11, '1117', 'KABUPATEN BENER MERIAH', 'KABUPATEN BENER MERIAH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1118, 11, '1118', 'KABUPATEN PIDIE JAYA', 'KABUPATEN PIDIE JAYA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1171, 11, '1171', 'KOTA BANDA ACEH', 'KOTA BANDA ACEH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1172, 11, '1172', 'KOTA SABANG', 'KOTA SABANG', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1173, 11, '1173', 'KOTA LANGSA', 'KOTA LANGSA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1174, 11, '1174', 'KOTA LHOKSEUMAWE', 'KOTA LHOKSEUMAWE', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1175, 11, '1175', 'KOTA SUBULUSSALAM', 'KOTA SUBULUSSALAM', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1201, 12, '1201', 'KABUPATEN NIAS', 'KABUPATEN NIAS', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1202, 12, '1202', 'KABUPATEN MANDAILING NATAL', 'KABUPATEN MANDAILING NATAL', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1203, 12, '1203', 'KABUPATEN TAPANULI SELATAN', 'KABUPATEN TAPANULI SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1204, 12, '1204', 'KABUPATEN TAPANULI TENGAH', 'KABUPATEN TAPANULI TENGAH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1205, 12, '1205', 'KABUPATEN TAPANULI UTARA', 'KABUPATEN TAPANULI UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1206, 12, '1206', 'KABUPATEN TOBA SAMOSIR', 'KABUPATEN TOBA SAMOSIR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1207, 12, '1207', 'KABUPATEN LABUHAN BATU', 'KABUPATEN LABUHAN BATU', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1208, 12, '1208', 'KABUPATEN ASAHAN', 'KABUPATEN ASAHAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1209, 12, '1209', 'KABUPATEN SIMALUNGUN', 'KABUPATEN SIMALUNGUN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1210, 12, '1210', 'KABUPATEN DAIRI', 'KABUPATEN DAIRI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1211, 12, '1211', 'KABUPATEN KARO', 'KABUPATEN KARO', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1212, 12, '1212', 'KABUPATEN DELI SERDANG', 'KABUPATEN DELI SERDANG', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1213, 12, '1213', 'KABUPATEN LANGKAT', 'KABUPATEN LANGKAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1214, 12, '1214', 'KABUPATEN NIAS SELATAN', 'KABUPATEN NIAS SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1215, 12, '1215', 'KABUPATEN HUMBANG HASUNDUTAN', 'KABUPATEN HUMBANG HASUNDUTAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1216, 12, '1216', 'KABUPATEN PAKPAK BHARAT', 'KABUPATEN PAKPAK BHARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1217, 12, '1217', 'KABUPATEN SAMOSIR', 'KABUPATEN SAMOSIR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1218, 12, '1218', 'KABUPATEN SERDANG BEDAGAI', 'KABUPATEN SERDANG BEDAGAI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1219, 12, '1219', 'KABUPATEN BATU BARA', 'KABUPATEN BATU BARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1220, 12, '1220', 'KABUPATEN PADANG LAWAS UTARA', 'KABUPATEN PADANG LAWAS UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1221, 12, '1221', 'KABUPATEN PADANG LAWAS', 'KABUPATEN PADANG LAWAS', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1222, 12, '1222', 'KABUPATEN LABUHAN BATU SELATAN', 'KABUPATEN LABUHAN BATU SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1223, 12, '1223', 'KABUPATEN LABUHAN BATU UTARA', 'KABUPATEN LABUHAN BATU UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1224, 12, '1224', 'KABUPATEN NIAS UTARA', 'KABUPATEN NIAS UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1225, 12, '1225', 'KABUPATEN NIAS BARAT', 'KABUPATEN NIAS BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1271, 12, '1271', 'KOTA SIBOLGA', 'KOTA SIBOLGA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1272, 12, '1272', 'KOTA TANJUNG BALAI', 'KOTA TANJUNG BALAI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1273, 12, '1273', 'KOTA PEMATANG SIANTAR', 'KOTA PEMATANG SIANTAR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1274, 12, '1274', 'KOTA TEBING TINGGI', 'KOTA TEBING TINGGI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1275, 12, '1275', 'KOTA MEDAN', 'KOTA MEDAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1276, 12, '1276', 'KOTA BINJAI', 'KOTA BINJAI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1277, 12, '1277', 'KOTA PADANGSIDIMPUAN', 'KOTA PADANGSIDIMPUAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1278, 12, '1278', 'KOTA GUNUNGSITOLI', 'KOTA GUNUNGSITOLI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(1301, 13, '1301', 'KABUPATEN KEPULAUAN MENTAWAI', 'KABUPATEN KEPULAUAN MENTAWAI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1302, 13, '1302', 'KABUPATEN PESISIR SELATAN', 'KABUPATEN PESISIR SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1303, 13, '1303', 'KABUPATEN SOLOK', 'KABUPATEN SOLOK', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1304, 13, '1304', 'KABUPATEN SIJUNJUNG', 'KABUPATEN SIJUNJUNG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1305, 13, '1305', 'KABUPATEN TANAH DATAR', 'KABUPATEN TANAH DATAR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1306, 13, '1306', 'KABUPATEN PADANG PARIAMAN', 'KABUPATEN PADANG PARIAMAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1307, 13, '1307', 'KABUPATEN AGAM', 'KABUPATEN AGAM', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1308, 13, '1308', 'KABUPATEN LIMA PULUH KOTA', 'KABUPATEN LIMA PULUH KOTA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1309, 13, '1309', 'KABUPATEN PASAMAN', 'KABUPATEN PASAMAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1310, 13, '1310', 'KABUPATEN SOLOK SELATAN', 'KABUPATEN SOLOK SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1311, 13, '1311', 'KABUPATEN DHARMASRAYA', 'KABUPATEN DHARMASRAYA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1312, 13, '1312', 'KABUPATEN PASAMAN BARAT', 'KABUPATEN PASAMAN BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1371, 13, '1371', 'KOTA PADANG', 'KOTA PADANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1372, 13, '1372', 'KOTA SOLOK', 'KOTA SOLOK', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1373, 13, '1373', 'KOTA SAWAH LUNTO', 'KOTA SAWAH LUNTO', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1374, 13, '1374', 'KOTA PADANG PANJANG', 'KOTA PADANG PANJANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1375, 13, '1375', 'KOTA BUKITTINGGI', 'KOTA BUKITTINGGI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1376, 13, '1376', 'KOTA PAYAKUMBUH', 'KOTA PAYAKUMBUH', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1377, 13, '1377', 'KOTA PARIAMAN', 'KOTA PARIAMAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1401, 14, '1401', 'KABUPATEN KUANTAN SINGINGI', 'KABUPATEN KUANTAN SINGINGI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1402, 14, '1402', 'KABUPATEN INDRAGIRI HULU', 'KABUPATEN INDRAGIRI HULU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1403, 14, '1403', 'KABUPATEN INDRAGIRI HILIR', 'KABUPATEN INDRAGIRI HILIR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1404, 14, '1404', 'KABUPATEN PELALAWAN', 'KABUPATEN PELALAWAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1405, 14, '1405', 'KABUPATEN S I A K', 'KABUPATEN S I A K', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1406, 14, '1406', 'KABUPATEN KAMPAR', 'KABUPATEN KAMPAR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1407, 14, '1407', 'KABUPATEN ROKAN HULU', 'KABUPATEN ROKAN HULU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1408, 14, '1408', 'KABUPATEN BENGKALIS', 'KABUPATEN BENGKALIS', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1409, 14, '1409', 'KABUPATEN ROKAN HILIR', 'KABUPATEN ROKAN HILIR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1410, 14, '1410', 'KABUPATEN KEPULAUAN MERANTI', 'KABUPATEN KEPULAUAN MERANTI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1471, 14, '1471', 'KOTA PEKANBARU', 'KOTA PEKANBARU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1473, 14, '1473', 'KOTA D U M A I', 'KOTA D U M A I', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1501, 15, '1501', 'KABUPATEN KERINCI', 'KABUPATEN KERINCI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1502, 15, '1502', 'KABUPATEN MERANGIN', 'KABUPATEN MERANGIN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1503, 15, '1503', 'KABUPATEN SAROLANGUN', 'KABUPATEN SAROLANGUN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1504, 15, '1504', 'KABUPATEN BATANG HARI', 'KABUPATEN BATANG HARI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1505, 15, '1505', 'KABUPATEN MUARO JAMBI', 'KABUPATEN MUARO JAMBI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1506, 15, '1506', 'KABUPATEN TANJUNG JABUNG TIMUR', 'KABUPATEN TANJUNG JABUNG TIMUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1507, 15, '1507', 'KABUPATEN TANJUNG JABUNG BARAT', 'KABUPATEN TANJUNG JABUNG BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1508, 15, '1508', 'KABUPATEN TEBO', 'KABUPATEN TEBO', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1509, 15, '1509', 'KABUPATEN BUNGO', 'KABUPATEN BUNGO', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1571, 15, '1571', 'KOTA JAMBI', 'KOTA JAMBI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1572, 15, '1572', 'KOTA SUNGAI PENUH', 'KOTA SUNGAI PENUH', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1601, 16, '1601', 'KABUPATEN OGAN KOMERING ULU', 'KABUPATEN OGAN KOMERING ULU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1602, 16, '1602', 'KABUPATEN OGAN KOMERING ILIR', 'KABUPATEN OGAN KOMERING ILIR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1603, 16, '1603', 'KABUPATEN MUARA ENIM', 'KABUPATEN MUARA ENIM', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1604, 16, '1604', 'KABUPATEN LAHAT', 'KABUPATEN LAHAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1605, 16, '1605', 'KABUPATEN MUSI RAWAS', 'KABUPATEN MUSI RAWAS', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1606, 16, '1606', 'KABUPATEN MUSI BANYUASIN', 'KABUPATEN MUSI BANYUASIN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1607, 16, '1607', 'KABUPATEN BANYU ASIN', 'KABUPATEN BANYU ASIN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1608, 16, '1608', 'KABUPATEN OGAN KOMERING ULU SELATAN', 'KABUPATEN OGAN KOMERING ULU SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1609, 16, '1609', 'KABUPATEN OGAN KOMERING ULU TIMUR', 'KABUPATEN OGAN KOMERING ULU TIMUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1610, 16, '1610', 'KABUPATEN OGAN ILIR', 'KABUPATEN OGAN ILIR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1611, 16, '1611', 'KABUPATEN EMPAT LAWANG', 'KABUPATEN EMPAT LAWANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1612, 16, '1612', 'KABUPATEN PENUKAL ABAB LEMATANG ILIR', 'KABUPATEN PENUKAL ABAB LEMATANG ILIR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1613, 16, '1613', 'KABUPATEN MUSI RAWAS UTARA', 'KABUPATEN MUSI RAWAS UTARA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1671, 16, '1671', 'KOTA PALEMBANG', 'KOTA PALEMBANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1672, 16, '1672', 'KOTA PRABUMULIH', 'KOTA PRABUMULIH', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1673, 16, '1673', 'KOTA PAGAR ALAM', 'KOTA PAGAR ALAM', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1674, 16, '1674', 'KOTA LUBUKLINGGAU', 'KOTA LUBUKLINGGAU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1701, 17, '1701', 'KABUPATEN BENGKULU SELATAN', 'KABUPATEN BENGKULU SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1702, 17, '1702', 'KABUPATEN REJANG LEBONG', 'KABUPATEN REJANG LEBONG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1703, 17, '1703', 'KABUPATEN BENGKULU UTARA', 'KABUPATEN BENGKULU UTARA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1704, 17, '1704', 'KABUPATEN KAUR', 'KABUPATEN KAUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1705, 17, '1705', 'KABUPATEN SELUMA', 'KABUPATEN SELUMA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1706, 17, '1706', 'KABUPATEN MUKOMUKO', 'KABUPATEN MUKOMUKO', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1707, 17, '1707', 'KABUPATEN LEBONG', 'KABUPATEN LEBONG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1708, 17, '1708', 'KABUPATEN KEPAHIANG', 'KABUPATEN KEPAHIANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1709, 17, '1709', 'KABUPATEN BENGKULU TENGAH', 'KABUPATEN BENGKULU TENGAH', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1771, 17, '1771', 'KOTA BENGKULU', 'KOTA BENGKULU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1801, 18, '1801', 'KABUPATEN LAMPUNG BARAT', 'KABUPATEN LAMPUNG BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1802, 18, '1802', 'KABUPATEN TANGGAMUS', 'KABUPATEN TANGGAMUS', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1803, 18, '1803', 'KABUPATEN LAMPUNG SELATAN', 'KABUPATEN LAMPUNG SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1804, 18, '1804', 'KABUPATEN LAMPUNG TIMUR', 'KABUPATEN LAMPUNG TIMUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1805, 18, '1805', 'KABUPATEN LAMPUNG TENGAH', 'KABUPATEN LAMPUNG TENGAH', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1806, 18, '1806', 'KABUPATEN LAMPUNG UTARA', 'KABUPATEN LAMPUNG UTARA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1807, 18, '1807', 'KABUPATEN WAY KANAN', 'KABUPATEN WAY KANAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1808, 18, '1808', 'KABUPATEN TULANGBAWANG', 'KABUPATEN TULANGBAWANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1809, 18, '1809', 'KABUPATEN PESAWARAN', 'KABUPATEN PESAWARAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1810, 18, '1810', 'KABUPATEN PRINGSEWU', 'KABUPATEN PRINGSEWU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1811, 18, '1811', 'KABUPATEN MESUJI', 'KABUPATEN MESUJI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1812, 18, '1812', 'KABUPATEN TULANG BAWANG BARAT', 'KABUPATEN TULANG BAWANG BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1813, 18, '1813', 'KABUPATEN PESISIR BARAT', 'KABUPATEN PESISIR BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1871, 18, '1871', 'KOTA BANDAR LAMPUNG', 'KOTA BANDAR LAMPUNG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1872, 18, '1872', 'KOTA METRO', 'KOTA METRO', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1901, 19, '1901', 'KABUPATEN BANGKA', 'KABUPATEN BANGKA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1902, 19, '1902', 'KABUPATEN BELITUNG', 'KABUPATEN BELITUNG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1903, 19, '1903', 'KABUPATEN BANGKA BARAT', 'KABUPATEN BANGKA BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1904, 19, '1904', 'KABUPATEN BANGKA TENGAH', 'KABUPATEN BANGKA TENGAH', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1905, 19, '1905', 'KABUPATEN BANGKA SELATAN', 'KABUPATEN BANGKA SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1906, 19, '1906', 'KABUPATEN BELITUNG TIMUR', 'KABUPATEN BELITUNG TIMUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(1971, 19, '1971', 'KOTA PANGKAL PINANG', 'KOTA PANGKAL PINANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2101, 21, '2101', 'KABUPATEN KARIMUN', 'KABUPATEN KARIMUN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2102, 21, '2102', 'KABUPATEN BINTAN', 'KABUPATEN BINTAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2103, 21, '2103', 'KABUPATEN NATUNA', 'KABUPATEN NATUNA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2104, 21, '2104', 'KABUPATEN LINGGA', 'KABUPATEN LINGGA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2105, 21, '2105', 'KABUPATEN KEPULAUAN ANAMBAS', 'KABUPATEN KEPULAUAN ANAMBAS', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2171, 21, '2171', 'KOTA B A T A M', 'KOTA B A T A M', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(2172, 21, '2172', 'KOTA TANJUNG PINANG', 'KOTA TANJUNG PINANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3101, 31, '3101', 'KABUPATEN KEPULAUAN SERIBU', 'KABUPATEN KEPULAUAN SERIBU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3171, 31, '3171', 'KOTA JAKARTA SELATAN', 'KOTA JAKARTA SELATAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3172, 31, '3172', 'KOTA JAKARTA TIMUR', 'KOTA JAKARTA TIMUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3173, 31, '3173', 'KOTA JAKARTA PUSAT', 'KOTA JAKARTA PUSAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3174, 31, '3174', 'KOTA JAKARTA BARAT', 'KOTA JAKARTA BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3175, 31, '3175', 'KOTA JAKARTA UTARA', 'KOTA JAKARTA UTARA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3201, 32, '3201', 'KABUPATEN BOGOR', 'KABUPATEN BOGOR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3202, 32, '3202', 'KABUPATEN SUKABUMI', 'KABUPATEN SUKABUMI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3203, 32, '3203', 'KABUPATEN CIANJUR', 'KABUPATEN CIANJUR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3204, 32, '3204', 'KABUPATEN BANDUNG', 'KABUPATEN BANDUNG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3205, 32, '3205', 'KABUPATEN GARUT', 'KABUPATEN GARUT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3206, 32, '3206', 'KABUPATEN TASIKMALAYA', 'KABUPATEN TASIKMALAYA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3207, 32, '3207', 'KABUPATEN CIAMIS', 'KABUPATEN CIAMIS', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3208, 32, '3208', 'KABUPATEN KUNINGAN', 'KABUPATEN KUNINGAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3209, 32, '3209', 'KABUPATEN CIREBON', 'KABUPATEN CIREBON', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3210, 32, '3210', 'KABUPATEN MAJALENGKA', 'KABUPATEN MAJALENGKA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3211, 32, '3211', 'KABUPATEN SUMEDANG', 'KABUPATEN SUMEDANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3212, 32, '3212', 'KABUPATEN INDRAMAYU', 'KABUPATEN INDRAMAYU', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3213, 32, '3213', 'KABUPATEN SUBANG', 'KABUPATEN SUBANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3214, 32, '3214', 'KABUPATEN PURWAKARTA', 'KABUPATEN PURWAKARTA', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3215, 32, '3215', 'KABUPATEN KARAWANG', 'KABUPATEN KARAWANG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3216, 32, '3216', 'KABUPATEN BEKASI', 'KABUPATEN BEKASI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3217, 32, '3217', 'KABUPATEN BANDUNG BARAT', 'KABUPATEN BANDUNG BARAT', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3218, 32, '3218', 'KABUPATEN PANGANDARAN', 'KABUPATEN PANGANDARAN', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3271, 32, '3271', 'KOTA BOGOR', 'KOTA BOGOR', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3272, 32, '3272', 'KOTA SUKABUMI', 'KOTA SUKABUMI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3273, 32, '3273', 'KOTA BANDUNG', 'KOTA BANDUNG', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3274, 32, '3274', 'KOTA CIREBON', 'KOTA CIREBON', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3275, 32, '3275', 'KOTA BEKASI', 'KOTA BEKASI', '1', '2022-12-20 10:23:48', '2022-12-20 10:23:48'),
(3276, 32, '3276', 'KOTA DEPOK', 'KOTA DEPOK', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3277, 32, '3277', 'KOTA CIMAHI', 'KOTA CIMAHI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3278, 32, '3278', 'KOTA TASIKMALAYA', 'KOTA TASIKMALAYA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3279, 32, '3279', 'KOTA BANJAR', 'KOTA BANJAR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3301, 33, '3301', 'KABUPATEN CILACAP', 'KABUPATEN CILACAP', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3302, 33, '3302', 'KABUPATEN BANYUMAS', 'KABUPATEN BANYUMAS', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3303, 33, '3303', 'KABUPATEN PURBALINGGA', 'KABUPATEN PURBALINGGA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3304, 33, '3304', 'KABUPATEN BANJARNEGARA', 'KABUPATEN BANJARNEGARA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3305, 33, '3305', 'KABUPATEN KEBUMEN', 'KABUPATEN KEBUMEN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3306, 33, '3306', 'KABUPATEN PURWOREJO', 'KABUPATEN PURWOREJO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3307, 33, '3307', 'KABUPATEN WONOSOBO', 'KABUPATEN WONOSOBO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3308, 33, '3308', 'KABUPATEN MAGELANG', 'KABUPATEN MAGELANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3309, 33, '3309', 'KABUPATEN BOYOLALI', 'KABUPATEN BOYOLALI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3310, 33, '3310', 'KABUPATEN KLATEN', 'KABUPATEN KLATEN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3311, 33, '3311', 'KABUPATEN SUKOHARJO', 'KABUPATEN SUKOHARJO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3312, 33, '3312', 'KABUPATEN WONOGIRI', 'KABUPATEN WONOGIRI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3313, 33, '3313', 'KABUPATEN KARANGANYAR', 'KABUPATEN KARANGANYAR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3314, 33, '3314', 'KABUPATEN SRAGEN', 'KABUPATEN SRAGEN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3315, 33, '3315', 'KABUPATEN GROBOGAN', 'KABUPATEN GROBOGAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3316, 33, '3316', 'KABUPATEN BLORA', 'KABUPATEN BLORA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3317, 33, '3317', 'KABUPATEN REMBANG', 'KABUPATEN REMBANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3318, 33, '3318', 'KABUPATEN PATI', 'KABUPATEN PATI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3319, 33, '3319', 'KABUPATEN KUDUS', 'KABUPATEN KUDUS', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3320, 33, '3320', 'KABUPATEN JEPARA', 'KABUPATEN JEPARA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3321, 33, '3321', 'KABUPATEN DEMAK', 'KABUPATEN DEMAK', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3322, 33, '3322', 'KABUPATEN SEMARANG', 'KABUPATEN SEMARANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3323, 33, '3323', 'KABUPATEN TEMANGGUNG', 'KABUPATEN TEMANGGUNG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3324, 33, '3324', 'KABUPATEN KENDAL', 'KABUPATEN KENDAL', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3325, 33, '3325', 'KABUPATEN BATANG', 'KABUPATEN BATANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3326, 33, '3326', 'KABUPATEN PEKALONGAN', 'KABUPATEN PEKALONGAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3327, 33, '3327', 'KABUPATEN PEMALANG', 'KABUPATEN PEMALANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3328, 33, '3328', 'KABUPATEN TEGAL', 'KABUPATEN TEGAL', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3329, 33, '3329', 'KABUPATEN BREBES', 'KABUPATEN BREBES', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3371, 33, '3371', 'KOTA MAGELANG', 'KOTA MAGELANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3372, 33, '3372', 'KOTA SURAKARTA', 'KOTA SURAKARTA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3373, 33, '3373', 'KOTA SALATIGA', 'KOTA SALATIGA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3374, 33, '3374', 'KOTA SEMARANG', 'KOTA SEMARANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3375, 33, '3375', 'KOTA PEKALONGAN', 'KOTA PEKALONGAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3376, 33, '3376', 'KOTA TEGAL', 'KOTA TEGAL', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3401, 34, '3401', 'KABUPATEN KULON PROGO', 'KABUPATEN KULON PROGO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3402, 34, '3402', 'KABUPATEN BANTUL', 'KABUPATEN BANTUL', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3403, 34, '3403', 'KABUPATEN GUNUNG KIDUL', 'KABUPATEN GUNUNG KIDUL', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3404, 34, '3404', 'KABUPATEN SLEMAN', 'KABUPATEN SLEMAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3471, 34, '3471', 'KOTA YOGYAKARTA', 'KOTA YOGYAKARTA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3501, 35, '3501', 'KABUPATEN PACITAN', 'KABUPATEN PACITAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3502, 35, '3502', 'KABUPATEN PONOROGO', 'KABUPATEN PONOROGO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3503, 35, '3503', 'KABUPATEN TRENGGALEK', 'KABUPATEN TRENGGALEK', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3504, 35, '3504', 'KABUPATEN TULUNGAGUNG', 'KABUPATEN TULUNGAGUNG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3505, 35, '3505', 'KABUPATEN BLITAR', 'KABUPATEN BLITAR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3506, 35, '3506', 'KABUPATEN KEDIRI', 'KABUPATEN KEDIRI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3507, 35, '3507', 'KABUPATEN MALANG', 'KABUPATEN MALANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3508, 35, '3508', 'KABUPATEN LUMAJANG', 'KABUPATEN LUMAJANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3509, 35, '3509', 'KABUPATEN JEMBER', 'KABUPATEN JEMBER', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3510, 35, '3510', 'KABUPATEN BANYUWANGI', 'KABUPATEN BANYUWANGI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3511, 35, '3511', 'KABUPATEN BONDOWOSO', 'KABUPATEN BONDOWOSO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3512, 35, '3512', 'KABUPATEN SITUBONDO', 'KABUPATEN SITUBONDO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3513, 35, '3513', 'KABUPATEN PROBOLINGGO', 'KABUPATEN PROBOLINGGO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3514, 35, '3514', 'KABUPATEN PASURUAN', 'KABUPATEN PASURUAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3515, 35, '3515', 'KABUPATEN SIDOARJO', 'KABUPATEN SIDOARJO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3516, 35, '3516', 'KABUPATEN MOJOKERTO', 'KABUPATEN MOJOKERTO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3517, 35, '3517', 'KABUPATEN JOMBANG', 'KABUPATEN JOMBANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3518, 35, '3518', 'KABUPATEN NGANJUK', 'KABUPATEN NGANJUK', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3519, 35, '3519', 'KABUPATEN MADIUN', 'KABUPATEN MADIUN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3520, 35, '3520', 'KABUPATEN MAGETAN', 'KABUPATEN MAGETAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3521, 35, '3521', 'KABUPATEN NGAWI', 'KABUPATEN NGAWI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3522, 35, '3522', 'KABUPATEN BOJONEGORO', 'KABUPATEN BOJONEGORO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3523, 35, '3523', 'KABUPATEN TUBAN', 'KABUPATEN TUBAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3524, 35, '3524', 'KABUPATEN LAMONGAN', 'KABUPATEN LAMONGAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3525, 35, '3525', 'KABUPATEN GRESIK', 'KABUPATEN GRESIK', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3526, 35, '3526', 'KABUPATEN BANGKALAN', 'KABUPATEN BANGKALAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3527, 35, '3527', 'KABUPATEN SAMPANG', 'KABUPATEN SAMPANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3528, 35, '3528', 'KABUPATEN PAMEKASAN', 'KABUPATEN PAMEKASAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3529, 35, '3529', 'KABUPATEN SUMENEP', 'KABUPATEN SUMENEP', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3571, 35, '3571', 'KOTA KEDIRI', 'KOTA KEDIRI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3572, 35, '3572', 'KOTA BLITAR', 'KOTA BLITAR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3573, 35, '3573', 'KOTA MALANG', 'KOTA MALANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3574, 35, '3574', 'KOTA PROBOLINGGO', 'KOTA PROBOLINGGO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3575, 35, '3575', 'KOTA PASURUAN', 'KOTA PASURUAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3576, 35, '3576', 'KOTA MOJOKERTO', 'KOTA MOJOKERTO', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3577, 35, '3577', 'KOTA MADIUN', 'KOTA MADIUN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3578, 35, '3578', 'KOTA SURABAYA', 'KOTA SURABAYA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3579, 35, '3579', 'KOTA BATU', 'KOTA BATU', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3601, 36, '3601', 'KABUPATEN PANDEGLANG', 'KABUPATEN PANDEGLANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3602, 36, '3602', 'KABUPATEN LEBAK', 'KABUPATEN LEBAK', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3603, 36, '3603', 'KABUPATEN TANGERANG', 'KABUPATEN TANGERANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3604, 36, '3604', 'KABUPATEN SERANG', 'KABUPATEN SERANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3671, 36, '3671', 'KOTA TANGERANG', 'KOTA TANGERANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3672, 36, '3672', 'KOTA CILEGON', 'KOTA CILEGON', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3673, 36, '3673', 'KOTA SERANG', 'KOTA SERANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(3674, 36, '3674', 'KOTA TANGERANG SELATAN', 'KOTA TANGERANG SELATAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5101, 51, '5101', 'KABUPATEN JEMBRANA', 'KABUPATEN JEMBRANA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5102, 51, '5102', 'KABUPATEN TABANAN', 'KABUPATEN TABANAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5103, 51, '5103', 'KABUPATEN BADUNG', 'KABUPATEN BADUNG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5104, 51, '5104', 'KABUPATEN GIANYAR', 'KABUPATEN GIANYAR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5105, 51, '5105', 'KABUPATEN KLUNGKUNG', 'KABUPATEN KLUNGKUNG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5106, 51, '5106', 'KABUPATEN BANGLI', 'KABUPATEN BANGLI', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5107, 51, '5107', 'KABUPATEN KARANG ASEM', 'KABUPATEN KARANG ASEM', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5108, 51, '5108', 'KABUPATEN BULELENG', 'KABUPATEN BULELENG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5171, 51, '5171', 'KOTA DENPASAR', 'KOTA DENPASAR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5201, 52, '5201', 'KABUPATEN LOMBOK BARAT', 'KABUPATEN LOMBOK BARAT', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5202, 52, '5202', 'KABUPATEN LOMBOK TENGAH', 'KABUPATEN LOMBOK TENGAH', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5203, 52, '5203', 'KABUPATEN LOMBOK TIMUR', 'KABUPATEN LOMBOK TIMUR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5204, 52, '5204', 'KABUPATEN SUMBAWA', 'KABUPATEN SUMBAWA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5205, 52, '5205', 'KABUPATEN DOMPU', 'KABUPATEN DOMPU', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5206, 52, '5206', 'KABUPATEN BIMA', 'KABUPATEN BIMA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5207, 52, '5207', 'KABUPATEN SUMBAWA BARAT', 'KABUPATEN SUMBAWA BARAT', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5208, 52, '5208', 'KABUPATEN LOMBOK UTARA', 'KABUPATEN LOMBOK UTARA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5271, 52, '5271', 'KOTA MATARAM', 'KOTA MATARAM', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5272, 52, '5272', 'KOTA BIMA', 'KOTA BIMA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5301, 53, '5301', 'KABUPATEN SUMBA BARAT', 'KABUPATEN SUMBA BARAT', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5302, 53, '5302', 'KABUPATEN SUMBA TIMUR', 'KABUPATEN SUMBA TIMUR', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5303, 53, '5303', 'KABUPATEN KUPANG', 'KABUPATEN KUPANG', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5304, 53, '5304', 'KABUPATEN TIMOR TENGAH SELATAN', 'KABUPATEN TIMOR TENGAH SELATAN', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5305, 53, '5305', 'KABUPATEN TIMOR TENGAH UTARA', 'KABUPATEN TIMOR TENGAH UTARA', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5306, 53, '5306', 'KABUPATEN BELU', 'KABUPATEN BELU', '1', '2022-12-20 10:23:49', '2022-12-20 10:23:49'),
(5307, 53, '5307', 'KABUPATEN ALOR', 'KABUPATEN ALOR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5308, 53, '5308', 'KABUPATEN LEMBATA', 'KABUPATEN LEMBATA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5309, 53, '5309', 'KABUPATEN FLORES TIMUR', 'KABUPATEN FLORES TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5310, 53, '5310', 'KABUPATEN SIKKA', 'KABUPATEN SIKKA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5311, 53, '5311', 'KABUPATEN ENDE', 'KABUPATEN ENDE', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5312, 53, '5312', 'KABUPATEN NGADA', 'KABUPATEN NGADA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5313, 53, '5313', 'KABUPATEN MANGGARAI', 'KABUPATEN MANGGARAI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5314, 53, '5314', 'KABUPATEN ROTE NDAO', 'KABUPATEN ROTE NDAO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5315, 53, '5315', 'KABUPATEN MANGGARAI BARAT', 'KABUPATEN MANGGARAI BARAT', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5316, 53, '5316', 'KABUPATEN SUMBA TENGAH', 'KABUPATEN SUMBA TENGAH', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5317, 53, '5317', 'KABUPATEN SUMBA BARAT DAYA', 'KABUPATEN SUMBA BARAT DAYA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5318, 53, '5318', 'KABUPATEN NAGEKEO', 'KABUPATEN NAGEKEO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5319, 53, '5319', 'KABUPATEN MANGGARAI TIMUR', 'KABUPATEN MANGGARAI TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5320, 53, '5320', 'KABUPATEN SABU RAIJUA', 'KABUPATEN SABU RAIJUA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5321, 53, '5321', 'KABUPATEN MALAKA', 'KABUPATEN MALAKA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(5371, 53, '5371', 'KOTA KUPANG', 'KOTA KUPANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6101, 61, '6101', 'KABUPATEN SAMBAS', 'KABUPATEN SAMBAS', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6102, 61, '6102', 'KABUPATEN BENGKAYANG', 'KABUPATEN BENGKAYANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6103, 61, '6103', 'KABUPATEN LANDAK', 'KABUPATEN LANDAK', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6104, 61, '6104', 'KABUPATEN MEMPAWAH', 'KABUPATEN MEMPAWAH', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6105, 61, '6105', 'KABUPATEN SANGGAU', 'KABUPATEN SANGGAU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6106, 61, '6106', 'KABUPATEN KETAPANG', 'KABUPATEN KETAPANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6107, 61, '6107', 'KABUPATEN SINTANG', 'KABUPATEN SINTANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6108, 61, '6108', 'KABUPATEN KAPUAS HULU', 'KABUPATEN KAPUAS HULU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6109, 61, '6109', 'KABUPATEN SEKADAU', 'KABUPATEN SEKADAU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6110, 61, '6110', 'KABUPATEN MELAWI', 'KABUPATEN MELAWI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6111, 61, '6111', 'KABUPATEN KAYONG UTARA', 'KABUPATEN KAYONG UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6112, 61, '6112', 'KABUPATEN KUBU RAYA', 'KABUPATEN KUBU RAYA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6171, 61, '6171', 'KOTA PONTIANAK', 'KOTA PONTIANAK', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6172, 61, '6172', 'KOTA SINGKAWANG', 'KOTA SINGKAWANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6201, 62, '6201', 'KABUPATEN KOTAWARINGIN BARAT', 'KABUPATEN KOTAWARINGIN BARAT', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6202, 62, '6202', 'KABUPATEN KOTAWARINGIN TIMUR', 'KABUPATEN KOTAWARINGIN TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6203, 62, '6203', 'KABUPATEN KAPUAS', 'KABUPATEN KAPUAS', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6204, 62, '6204', 'KABUPATEN BARITO SELATAN', 'KABUPATEN BARITO SELATAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6205, 62, '6205', 'KABUPATEN BARITO UTARA', 'KABUPATEN BARITO UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6206, 62, '6206', 'KABUPATEN SUKAMARA', 'KABUPATEN SUKAMARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6207, 62, '6207', 'KABUPATEN LAMANDAU', 'KABUPATEN LAMANDAU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6208, 62, '6208', 'KABUPATEN SERUYAN', 'KABUPATEN SERUYAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6209, 62, '6209', 'KABUPATEN KATINGAN', 'KABUPATEN KATINGAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6210, 62, '6210', 'KABUPATEN PULANG PISAU', 'KABUPATEN PULANG PISAU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6211, 62, '6211', 'KABUPATEN GUNUNG MAS', 'KABUPATEN GUNUNG MAS', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6212, 62, '6212', 'KABUPATEN BARITO TIMUR', 'KABUPATEN BARITO TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6213, 62, '6213', 'KABUPATEN MURUNG RAYA', 'KABUPATEN MURUNG RAYA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6271, 62, '6271', 'KOTA PALANGKA RAYA', 'KOTA PALANGKA RAYA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6301, 63, '6301', 'KABUPATEN TANAH LAUT', 'KABUPATEN TANAH LAUT', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6302, 63, '6302', 'KABUPATEN KOTA BARU', 'KABUPATEN KOTA BARU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6303, 63, '6303', 'KABUPATEN BANJAR', 'KABUPATEN BANJAR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6304, 63, '6304', 'KABUPATEN BARITO KUALA', 'KABUPATEN BARITO KUALA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6305, 63, '6305', 'KABUPATEN TAPIN', 'KABUPATEN TAPIN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6306, 63, '6306', 'KABUPATEN HULU SUNGAI SELATAN', 'KABUPATEN HULU SUNGAI SELATAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6307, 63, '6307', 'KABUPATEN HULU SUNGAI TENGAH', 'KABUPATEN HULU SUNGAI TENGAH', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6308, 63, '6308', 'KABUPATEN HULU SUNGAI UTARA', 'KABUPATEN HULU SUNGAI UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6309, 63, '6309', 'KABUPATEN TABALONG', 'KABUPATEN TABALONG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6310, 63, '6310', 'KABUPATEN TANAH BUMBU', 'KABUPATEN TANAH BUMBU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6311, 63, '6311', 'KABUPATEN BALANGAN', 'KABUPATEN BALANGAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6371, 63, '6371', 'KOTA BANJARMASIN', 'KOTA BANJARMASIN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6372, 63, '6372', 'KOTA BANJAR BARU', 'KOTA BANJAR BARU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6401, 64, '6401', 'KABUPATEN PASER', 'KABUPATEN PASER', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6402, 64, '6402', 'KABUPATEN KUTAI BARAT', 'KABUPATEN KUTAI BARAT', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6403, 64, '6403', 'KABUPATEN KUTAI KARTANEGARA', 'KABUPATEN KUTAI KARTANEGARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6404, 64, '6404', 'KABUPATEN KUTAI TIMUR', 'KABUPATEN KUTAI TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6405, 64, '6405', 'KABUPATEN BERAU', 'KABUPATEN BERAU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6409, 64, '6409', 'KABUPATEN PENAJAM PASER UTARA', 'KABUPATEN PENAJAM PASER UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6411, 64, '6411', 'KABUPATEN MAHAKAM HULU', 'KABUPATEN MAHAKAM HULU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6471, 64, '6471', 'KOTA BALIKPAPAN', 'KOTA BALIKPAPAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6472, 64, '6472', 'KOTA SAMARINDA', 'KOTA SAMARINDA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6474, 64, '6474', 'KOTA BONTANG', 'KOTA BONTANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6501, 65, '6501', 'KABUPATEN MALINAU', 'KABUPATEN MALINAU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6502, 65, '6502', 'KABUPATEN BULUNGAN', 'KABUPATEN BULUNGAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6503, 65, '6503', 'KABUPATEN TANA TIDUNG', 'KABUPATEN TANA TIDUNG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6504, 65, '6504', 'KABUPATEN NUNUKAN', 'KABUPATEN NUNUKAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(6571, 65, '6571', 'KOTA TARAKAN', 'KOTA TARAKAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7101, 71, '7101', 'KABUPATEN BOLAANG MONGONDOW', 'KABUPATEN BOLAANG MONGONDOW', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7102, 71, '7102', 'KABUPATEN MINAHASA', 'KABUPATEN MINAHASA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7103, 71, '7103', 'KABUPATEN KEPULAUAN SANGIHE', 'KABUPATEN KEPULAUAN SANGIHE', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7104, 71, '7104', 'KABUPATEN KEPULAUAN TALAUD', 'KABUPATEN KEPULAUAN TALAUD', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7105, 71, '7105', 'KABUPATEN MINAHASA SELATAN', 'KABUPATEN MINAHASA SELATAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7106, 71, '7106', 'KABUPATEN MINAHASA UTARA', 'KABUPATEN MINAHASA UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7107, 71, '7107', 'KABUPATEN BOLAANG MONGONDOW UTARA', 'KABUPATEN BOLAANG MONGONDOW UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7108, 71, '7108', 'KABUPATEN SIAU TAGULANDANG BIARO', 'KABUPATEN SIAU TAGULANDANG BIARO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7109, 71, '7109', 'KABUPATEN MINAHASA TENGGARA', 'KABUPATEN MINAHASA TENGGARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7110, 71, '7110', 'KABUPATEN BOLAANG MONGONDOW SELATAN', 'KABUPATEN BOLAANG MONGONDOW SELATAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7111, 71, '7111', 'KABUPATEN BOLAANG MONGONDOW TIMUR', 'KABUPATEN BOLAANG MONGONDOW TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7171, 71, '7171', 'KOTA MANADO', 'KOTA MANADO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7172, 71, '7172', 'KOTA BITUNG', 'KOTA BITUNG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7173, 71, '7173', 'KOTA TOMOHON', 'KOTA TOMOHON', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7174, 71, '7174', 'KOTA KOTAMOBAGU', 'KOTA KOTAMOBAGU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7201, 72, '7201', 'KABUPATEN BANGGAI KEPULAUAN', 'KABUPATEN BANGGAI KEPULAUAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7202, 72, '7202', 'KABUPATEN BANGGAI', 'KABUPATEN BANGGAI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7203, 72, '7203', 'KABUPATEN MOROWALI', 'KABUPATEN MOROWALI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7204, 72, '7204', 'KABUPATEN POSO', 'KABUPATEN POSO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7205, 72, '7205', 'KABUPATEN DONGGALA', 'KABUPATEN DONGGALA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7206, 72, '7206', 'KABUPATEN TOLI-TOLI', 'KABUPATEN TOLI-TOLI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7207, 72, '7207', 'KABUPATEN BUOL', 'KABUPATEN BUOL', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7208, 72, '7208', 'KABUPATEN PARIGI MOUTONG', 'KABUPATEN PARIGI MOUTONG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7209, 72, '7209', 'KABUPATEN TOJO UNA-UNA', 'KABUPATEN TOJO UNA-UNA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7210, 72, '7210', 'KABUPATEN SIGI', 'KABUPATEN SIGI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7211, 72, '7211', 'KABUPATEN BANGGAI LAUT', 'KABUPATEN BANGGAI LAUT', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7212, 72, '7212', 'KABUPATEN MOROWALI UTARA', 'KABUPATEN MOROWALI UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7271, 72, '7271', 'KOTA PALU', 'KOTA PALU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7301, 73, '7301', 'KABUPATEN KEPULAUAN SELAYAR', 'KABUPATEN KEPULAUAN SELAYAR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7302, 73, '7302', 'KABUPATEN BULUKUMBA', 'KABUPATEN BULUKUMBA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7303, 73, '7303', 'KABUPATEN BANTAENG', 'KABUPATEN BANTAENG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7304, 73, '7304', 'KABUPATEN JENEPONTO', 'KABUPATEN JENEPONTO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7305, 73, '7305', 'KABUPATEN TAKALAR', 'KABUPATEN TAKALAR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7306, 73, '7306', 'KABUPATEN GOWA', 'KABUPATEN GOWA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7307, 73, '7307', 'KABUPATEN SINJAI', 'KABUPATEN SINJAI', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7308, 73, '7308', 'KABUPATEN MAROS', 'KABUPATEN MAROS', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7309, 73, '7309', 'KABUPATEN PANGKAJENE DAN KEPULAUAN', 'KABUPATEN PANGKAJENE DAN KEPULAUAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7310, 73, '7310', 'KABUPATEN BARRU', 'KABUPATEN BARRU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7311, 73, '7311', 'KABUPATEN BONE', 'KABUPATEN BONE', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7312, 73, '7312', 'KABUPATEN SOPPENG', 'KABUPATEN SOPPENG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7313, 73, '7313', 'KABUPATEN WAJO', 'KABUPATEN WAJO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7314, 73, '7314', 'KABUPATEN SIDENRENG RAPPANG', 'KABUPATEN SIDENRENG RAPPANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7315, 73, '7315', 'KABUPATEN PINRANG', 'KABUPATEN PINRANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7316, 73, '7316', 'KABUPATEN ENREKANG', 'KABUPATEN ENREKANG', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7317, 73, '7317', 'KABUPATEN LUWU', 'KABUPATEN LUWU', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7318, 73, '7318', 'KABUPATEN TANA TORAJA', 'KABUPATEN TANA TORAJA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7322, 73, '7322', 'KABUPATEN LUWU UTARA', 'KABUPATEN LUWU UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7325, 73, '7325', 'KABUPATEN LUWU TIMUR', 'KABUPATEN LUWU TIMUR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7326, 73, '7326', 'KABUPATEN TORAJA UTARA', 'KABUPATEN TORAJA UTARA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7371, 73, '7371', 'KOTA MAKASSAR', 'KOTA MAKASSAR', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7372, 73, '7372', 'KOTA PAREPARE', 'KOTA PAREPARE', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7373, 73, '7373', 'KOTA PALOPO', 'KOTA PALOPO', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7401, 74, '7401', 'KABUPATEN BUTON', 'KABUPATEN BUTON', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7402, 74, '7402', 'KABUPATEN MUNA', 'KABUPATEN MUNA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7403, 74, '7403', 'KABUPATEN KONAWE', 'KABUPATEN KONAWE', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7404, 74, '7404', 'KABUPATEN KOLAKA', 'KABUPATEN KOLAKA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7405, 74, '7405', 'KABUPATEN KONAWE SELATAN', 'KABUPATEN KONAWE SELATAN', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7406, 74, '7406', 'KABUPATEN BOMBANA', 'KABUPATEN BOMBANA', '1', '2022-12-20 10:23:50', '2022-12-20 10:23:50'),
(7407, 74, '7407', 'KABUPATEN WAKATOBI', 'KABUPATEN WAKATOBI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7408, 74, '7408', 'KABUPATEN KOLAKA UTARA', 'KABUPATEN KOLAKA UTARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7409, 74, '7409', 'KABUPATEN BUTON UTARA', 'KABUPATEN BUTON UTARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7410, 74, '7410', 'KABUPATEN KONAWE UTARA', 'KABUPATEN KONAWE UTARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7411, 74, '7411', 'KABUPATEN KOLAKA TIMUR', 'KABUPATEN KOLAKA TIMUR', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7412, 74, '7412', 'KABUPATEN KONAWE KEPULAUAN', 'KABUPATEN KONAWE KEPULAUAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51');
INSERT INTO `ref_kabupaten_kota` (`id`, `ref_provinsi_id`, `kode_kabupaten_kota`, `nama_kabupaten_kota`, `nama_kabupaten_kota_alias`, `status`, `created_at`, `updated_at`) VALUES
(7413, 74, '7413', 'KABUPATEN MUNA BARAT', 'KABUPATEN MUNA BARAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7414, 74, '7414', 'KABUPATEN BUTON TENGAH', 'KABUPATEN BUTON TENGAH', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7415, 74, '7415', 'KABUPATEN BUTON SELATAN', 'KABUPATEN BUTON SELATAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7471, 74, '7471', 'KOTA KENDARI', 'KOTA KENDARI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7472, 74, '7472', 'KOTA BAUBAU', 'KOTA BAUBAU', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7501, 75, '7501', 'KABUPATEN BOALEMO', 'KABUPATEN BOALEMO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7502, 75, '7502', 'KABUPATEN GORONTALO', 'KABUPATEN GORONTALO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7503, 75, '7503', 'KABUPATEN POHUWATO', 'KABUPATEN POHUWATO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7504, 75, '7504', 'KABUPATEN BONE BOLANGO', 'KABUPATEN BONE BOLANGO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7505, 75, '7505', 'KABUPATEN GORONTALO UTARA', 'KABUPATEN GORONTALO UTARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7571, 75, '7571', 'KOTA GORONTALO', 'KOTA GORONTALO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7601, 76, '7601', 'KABUPATEN MAJENE', 'KABUPATEN MAJENE', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7602, 76, '7602', 'KABUPATEN POLEWALI MANDAR', 'KABUPATEN POLEWALI MANDAR', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7603, 76, '7603', 'KABUPATEN MAMASA', 'KABUPATEN MAMASA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7604, 76, '7604', 'KABUPATEN MAMUJU', 'KABUPATEN MAMUJU', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7605, 76, '7605', 'KABUPATEN MAMUJU UTARA', 'KABUPATEN MAMUJU UTARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(7606, 76, '7606', 'KABUPATEN MAMUJU TENGAH', 'KABUPATEN MAMUJU TENGAH', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8101, 81, '8101', 'KABUPATEN MALUKU TENGGARA BARAT', 'KABUPATEN MALUKU TENGGARA BARAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8102, 81, '8102', 'KABUPATEN MALUKU TENGGARA', 'KABUPATEN MALUKU TENGGARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8103, 81, '8103', 'KABUPATEN MALUKU TENGAH', 'KABUPATEN MALUKU TENGAH', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8104, 81, '8104', 'KABUPATEN BURU', 'KABUPATEN BURU', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8105, 81, '8105', 'KABUPATEN KEPULAUAN ARU', 'KABUPATEN KEPULAUAN ARU', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8106, 81, '8106', 'KABUPATEN SERAM BAGIAN BARAT', 'KABUPATEN SERAM BAGIAN BARAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8107, 81, '8107', 'KABUPATEN SERAM BAGIAN TIMUR', 'KABUPATEN SERAM BAGIAN TIMUR', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8108, 81, '8108', 'KABUPATEN MALUKU BARAT DAYA', 'KABUPATEN MALUKU BARAT DAYA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8109, 81, '8109', 'KABUPATEN BURU SELATAN', 'KABUPATEN BURU SELATAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8171, 81, '8171', 'KOTA AMBON', 'KOTA AMBON', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8172, 81, '8172', 'KOTA TUAL', 'KOTA TUAL', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8201, 82, '8201', 'KABUPATEN HALMAHERA BARAT', 'KABUPATEN HALMAHERA BARAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8202, 82, '8202', 'KABUPATEN HALMAHERA TENGAH', 'KABUPATEN HALMAHERA TENGAH', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8203, 82, '8203', 'KABUPATEN KEPULAUAN SULA', 'KABUPATEN KEPULAUAN SULA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8204, 82, '8204', 'KABUPATEN HALMAHERA SELATAN', 'KABUPATEN HALMAHERA SELATAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8205, 82, '8205', 'KABUPATEN HALMAHERA UTARA', 'KABUPATEN HALMAHERA UTARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8206, 82, '8206', 'KABUPATEN HALMAHERA TIMUR', 'KABUPATEN HALMAHERA TIMUR', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8207, 82, '8207', 'KABUPATEN PULAU MOROTAI', 'KABUPATEN PULAU MOROTAI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8208, 82, '8208', 'KABUPATEN PULAU TALIABU', 'KABUPATEN PULAU TALIABU', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8271, 82, '8271', 'KOTA TERNATE', 'KOTA TERNATE', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(8272, 82, '8272', 'KOTA TIDORE KEPULAUAN', 'KOTA TIDORE KEPULAUAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9101, 91, '9101', 'KABUPATEN FAKFAK', 'KABUPATEN FAKFAK', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9102, 91, '9102', 'KABUPATEN KAIMANA', 'KABUPATEN KAIMANA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9103, 91, '9103', 'KABUPATEN TELUK WONDAMA', 'KABUPATEN TELUK WONDAMA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9104, 91, '9104', 'KABUPATEN TELUK BINTUNI', 'KABUPATEN TELUK BINTUNI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9105, 91, '9105', 'KABUPATEN MANOKWARI', 'KABUPATEN MANOKWARI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9106, 91, '9106', 'KABUPATEN SORONG SELATAN', 'KABUPATEN SORONG SELATAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9107, 91, '9107', 'KABUPATEN SORONG', 'KABUPATEN SORONG', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9108, 91, '9108', 'KABUPATEN RAJA AMPAT', 'KABUPATEN RAJA AMPAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9109, 91, '9109', 'KABUPATEN TAMBRAUW', 'KABUPATEN TAMBRAUW', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9110, 91, '9110', 'KABUPATEN MAYBRAT', 'KABUPATEN MAYBRAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9111, 91, '9111', 'KABUPATEN MANOKWARI SELATAN', 'KABUPATEN MANOKWARI SELATAN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9112, 91, '9112', 'KABUPATEN PEGUNUNGAN ARFAK', 'KABUPATEN PEGUNUNGAN ARFAK', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9171, 91, '9171', 'KOTA SORONG', 'KOTA SORONG', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9401, 94, '9401', 'KABUPATEN MERAUKE', 'KABUPATEN MERAUKE', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9402, 94, '9402', 'KABUPATEN JAYAWIJAYA', 'KABUPATEN JAYAWIJAYA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9403, 94, '9403', 'KABUPATEN JAYAPURA', 'KABUPATEN JAYAPURA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9404, 94, '9404', 'KABUPATEN NABIRE', 'KABUPATEN NABIRE', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9408, 94, '9408', 'KABUPATEN KEPULAUAN YAPEN', 'KABUPATEN KEPULAUAN YAPEN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9409, 94, '9409', 'KABUPATEN BIAK NUMFOR', 'KABUPATEN BIAK NUMFOR', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9410, 94, '9410', 'KABUPATEN PANIAI', 'KABUPATEN PANIAI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9411, 94, '9411', 'KABUPATEN PUNCAK JAYA', 'KABUPATEN PUNCAK JAYA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9412, 94, '9412', 'KABUPATEN MIMIKA', 'KABUPATEN MIMIKA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9413, 94, '9413', 'KABUPATEN BOVEN DIGOEL', 'KABUPATEN BOVEN DIGOEL', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9414, 94, '9414', 'KABUPATEN MAPPI', 'KABUPATEN MAPPI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9415, 94, '9415', 'KABUPATEN ASMAT', 'KABUPATEN ASMAT', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9416, 94, '9416', 'KABUPATEN YAHUKIMO', 'KABUPATEN YAHUKIMO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9417, 94, '9417', 'KABUPATEN PEGUNUNGAN BINTANG', 'KABUPATEN PEGUNUNGAN BINTANG', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9418, 94, '9418', 'KABUPATEN TOLIKARA', 'KABUPATEN TOLIKARA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9419, 94, '9419', 'KABUPATEN SARMI', 'KABUPATEN SARMI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9420, 94, '9420', 'KABUPATEN KEEROM', 'KABUPATEN KEEROM', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9426, 94, '9426', 'KABUPATEN WAROPEN', 'KABUPATEN WAROPEN', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9427, 94, '9427', 'KABUPATEN SUPIORI', 'KABUPATEN SUPIORI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9428, 94, '9428', 'KABUPATEN MAMBERAMO RAYA', 'KABUPATEN MAMBERAMO RAYA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9429, 94, '9429', 'KABUPATEN NDUGA', 'KABUPATEN NDUGA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9430, 94, '9430', 'KABUPATEN LANNY JAYA', 'KABUPATEN LANNY JAYA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9431, 94, '9431', 'KABUPATEN MAMBERAMO TENGAH', 'KABUPATEN MAMBERAMO TENGAH', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9432, 94, '9432', 'KABUPATEN YALIMO', 'KABUPATEN YALIMO', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9433, 94, '9433', 'KABUPATEN PUNCAK', 'KABUPATEN PUNCAK', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9434, 94, '9434', 'KABUPATEN DOGIYAI', 'KABUPATEN DOGIYAI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9435, 94, '9435', 'KABUPATEN INTAN JAYA', 'KABUPATEN INTAN JAYA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9436, 94, '9436', 'KABUPATEN DEIYAI', 'KABUPATEN DEIYAI', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51'),
(9471, 94, '9471', 'KOTA JAYAPURA', 'KOTA JAYAPURA', '1', '2022-12-20 10:23:51', '2022-12-20 10:23:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_provinsi`
--

CREATE TABLE `ref_provinsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_provinsi` varchar(2) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `nama_provinsi_alias` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 = Tidak Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `ref_provinsi`
--

INSERT INTO `ref_provinsi` (`id`, `kode_provinsi`, `nama_provinsi`, `nama_provinsi_alias`, `status`, `created_at`, `updated_at`) VALUES
(11, '11', 'ACEH', 'ACEH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(12, '12', 'SUMATERA UTARA', 'SUMATERA UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(13, '13', 'SUMATERA BARAT', 'SUMATERA BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(14, '14', 'RIAU', 'RIAU', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(15, '15', 'JAMBI', 'JAMBI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(16, '16', 'SUMATERA SELATAN', 'SUMATERA SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(17, '17', 'BENGKULU', 'BENGKULU', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(18, '18', 'LAMPUNG', 'LAMPUNG', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(19, '19', 'KEPULAUAN BANGKA BELITUNG', 'KEPULAUAN BANGKA BELITUNG', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(21, '21', 'KEPULAUAN RIAU', 'KEPULAUAN RIAU', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(31, '31', 'DKI JAKARTA', 'DKI JAKARTA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(32, '32', 'JAWA BARAT', 'JAWA BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(33, '33', 'JAWA TENGAH', 'JAWA TENGAH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(34, '34', 'DI YOGYAKARTA', 'DI YOGYAKARTA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(35, '35', 'JAWA TIMUR', 'JAWA TIMUR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(36, '36', 'BANTEN', 'BANTEN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(51, '51', 'BALI', 'BALI', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(52, '52', 'NUSA TENGGARA BARAT', 'NUSA TENGGARA BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(53, '53', 'NUSA TENGGARA TIMUR', 'NUSA TENGGARA TIMUR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(61, '61', 'KALIMANTAN BARAT', 'KALIMANTAN BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(62, '62', 'KALIMANTAN TENGAH', 'KALIMANTAN TENGAH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(63, '63', 'KALIMANTAN SELATAN', 'KALIMANTAN SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(64, '64', 'KALIMANTAN TIMUR', 'KALIMANTAN TIMUR', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(65, '65', 'KALIMANTAN UTARA', 'KALIMANTAN UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(71, '71', 'SULAWESI UTARA', 'SULAWESI UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(72, '72', 'SULAWESI TENGAH', 'SULAWESI TENGAH', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(73, '73', 'SULAWESI SELATAN', 'SULAWESI SELATAN', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(74, '74', 'SULAWESI TENGGARA', 'SULAWESI TENGGARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(75, '75', 'GORONTALO', 'GORONTALO', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(76, '76', 'SULAWESI BARAT', 'SULAWESI BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(81, '81', 'MALUKU', 'MALUKU', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(82, '82', 'MALUKU UTARA', 'MALUKU UTARA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(91, '91', 'PAPUA BARAT', 'PAPUA BARAT', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47'),
(94, '94', 'PAPUA', 'PAPUA', '1', '2022-12-20 10:23:47', '2022-12-20 10:23:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `img_profile` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `verify_code` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `referral_code` varchar(15) NOT NULL,
  `point` bigint(20) NOT NULL DEFAULT 0,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `description`, `img_profile`, `email`, `verify_code`, `email_verified_at`, `password`, `phone`, `update_at`, `created_at`, `is_active`, `referral_code`, `point`, `role_id`) VALUES
(1, '12', 'Ananda Nino', 'Lorem ipsum dolor amet.', NULL, 'ananda@mail.com', '1', '2023-01-11 13:28:50', '$2y$10$cpjKFMEV196s/Qu9F4blAO3MgRAmY1ZdHvu5pEgR5iwRU/O0nVAPK', '12345', '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'a', 0, 2),
(2, '23', 'Bambang Saputra', 'Penulis, Dosen, Programmer', NULL, 'bambang@mail.com', '2', NULL, '$2y$10$9ilBY0NLsLE6mgDaftCCzeqTW7zT8YsvpXQrWeD6pnT6iq0BTyUem', '+62 828-1723-2313', '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'b', 0, 2),
(3, '34', 'Cantika Sari', NULL, NULL, 'cantika@mail.com', '3', NULL, '$2y$10$TyAR7Lc7TOSm5XiBM69Mp.piakCXcvZ8zZ7l9pWt1SXYm6z/v0mlS', '123456', '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'c', 0, 2),
(4, '45', 'Dono Manulo', NULL, NULL, 'dono@mail.com', '4', NULL, '$2y$10$Z9UgI0SzKt.bXxevHgpX5e79FyoJv6BuAFzAbSUFZ0uz2.OO7MqUO', '123457', '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'd', 0, 2),
(32, '56', 'Arif', NULL, NULL, 'aywibisono02c@gmail.com', '5', '2023-01-13 14:08:07', '$2y$10$Bds7vWcEWm8Uy1FJZ0uOv.rZittJbQZPBEleffry5eCvQJ/3aMcT.', '6289683253026', '2023-03-14 16:01:52', '2023-02-11 00:13:24', '0', 'e', 0, 2),
(36, '67', 'Arif Yudha Wibisono', 'Lorem ipsum dolor amet. Lorem ipsum dolor amet. Lorem ipsum dolor amet.1 Lorem ipsum dolor amet. Lorem ipsum dolor amet. Lorem ipsum dolor amet.1 Lorem ipsum dolor amet. Lorem ipsum dolor amet. Lorem ipsum dolor amet.1', '/public/uploads/profile/profile_upload_230212023647.png', 'arifyudhawibisono@gmail.com', '6', '2023-03-06 01:35:20', '$2y$10$2QIiroDt0slNiauCymzHM.I/Ad0UfmUQS.MbyJTqxgPC/IcnCeSXe', '62683253023', '2023-03-14 04:11:02', '2023-02-11 00:13:24', '1', 'AriUX', 0, 1),
(37, '78', 'Arif Yudha Wibisono', NULL, NULL, 'aywibisono023@gmail.com', '7', NULL, '$2y$10$9ZjWzzivHK8Imlyf32YVIeaitDQ.nxHhAZexXhMhtP7ZuaCK..eEy', NULL, '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'AriUH', 0, 2),
(38, '89', 'Arif Yudha Wibisono', NULL, NULL, 'aywibisono0234@gmail.com', '8', NULL, '$2y$10$kzq5j6nd8rVbngnhQ/OqCuzc6CndIN8olBBAnmADtV9m86EaQoGM.', NULL, '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'AriUS', 0, 2),
(39, '90', 'Arif Yudha Wibisono', NULL, NULL, 'aywibisono02345@gmail.com', '9', NULL, '$2y$10$BS05bXGqzhnWfxpugdEx7uU426jYbh7jLBml.Ba2xoHHTzl83dija', NULL, '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'AriMC', 0, 2),
(42, '01', 'Wibisono', NULL, NULL, 'aywibisono022@gmail.com', '10', NULL, '$2y$10$g9KSpLOxDoNCzAJqPflIc.N9sLYgvfevXR.GAF2Yn6G5N6mRAzOc2', NULL, '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'WibJPB6', 0, 2),
(43, '11', 'Yudha', NULL, NULL, 'aywibisono0222@gmail.com', '11', NULL, '$2y$10$4nQ77qv7yY65lsPOVePIi.ZiLtbjOTlZLdkWC8DloLh2rqL.2VAMq', NULL, '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'Yud66EV', 0, 2),
(44, '22', 'Yudha', NULL, NULL, 'aywibisono0322@gmail.com', '12', NULL, '$2y$10$VvT/S8AU3sSfYAeeXN6ZMusiGy5FWMb47s8JKJuXaWOj0Y6WCzT1q', NULL, '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'YudT8QV', 0, 2),
(45, '33', 'Arif Yudha Wibisono', NULL, NULL, 'aywibisono222202@gmail.com', '13', NULL, '$2y$10$nqD3pgr6zIZuwEPeUGlVMOzsoQ41dk0bzhNkgZEAm3Bqg70tkvNCW', '622222222222', '2023-03-05 18:00:56', '2023-02-11 00:13:24', '0', 'AriR2W4', 0, 2),
(46, '44', 'Arif', NULL, NULL, 'aywibisono012122@gmail.com', '14', NULL, '$2y$10$uOT/uCng1UN33ph/NHGoseEfCW6C3NK5Mr7ccPd0NTeDMkbHZr1pa', '6289683253024', '2023-03-05 18:00:56', '2023-02-12 17:34:50', '0', 'AriU9DY', 0, 2),
(47, '8cd690f1-c281-11ed-b3cb-f469d5ccb232', 'Pengguna API', NULL, NULL, 'aywibisono02@gmail.com', '1678809718dcomewR3Cul4ayw', NULL, '$2y$10$tYYNOX4StfXxYaT3fDb/Gere7OeotMH0C0Skxxj3ThlE58gpsBba.', '6289683253025', '2023-03-16 07:42:06', '2023-03-14 16:01:58', '1', 'PenDU5R', 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 = Tidak Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user_groups`
--

INSERT INTO `user_groups` (`id`, `group`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', '1', NULL, NULL),
(2, 'User', 'User', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_referral`
--

CREATE TABLE `user_referral` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `referral_from` bigint(20) UNSIGNED DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `user_referral`
--

INSERT INTO `user_referral` (`id`, `user_id`, `referral_from`, `create_at`, `update_at`) VALUES
(1, 36, 1, '2023-02-09 00:24:36', NULL),
(2, 37, NULL, '2023-02-09 00:24:36', NULL),
(3, 38, NULL, '2023-02-09 00:24:36', NULL),
(4, 39, 38, '2023-02-09 00:24:36', NULL),
(5, 42, 38, '2023-02-09 00:32:10', NULL),
(6, 43, NULL, '2023-02-09 00:35:44', NULL),
(7, 44, NULL, '2023-02-09 00:38:08', NULL),
(8, 45, NULL, '2023-02-10 04:03:54', NULL),
(9, 46, 36, '2023-02-12 17:34:50', NULL),
(10, 47, NULL, '2023-03-14 16:01:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `FK_books_book_sizes` (`paket_harga_id`) USING BTREE,
  ADD KEY `FK_books_book_category` (`category_id`),
  ADD KEY `FK_books_book_language` (`language_id`),
  ADD KEY `FK_books_book_sizes1` (`book_size_id`),
  ADD KEY `FK_books_book_papers` (`book_paper_id`),
  ADD KEY `FK_books_ref_provinsi` (`ref_provinsi_id`),
  ADD KEY `FK_books_ref_kabupaten_kota` (`ref_kota_id`);

--
-- Indeks untuk tabel `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `book_contributors`
--
ALTER TABLE `book_contributors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_book_contributors_book_contributors_role` (`contributor_role_id`),
  ADD KEY `FK_book_contributors_books` (`book_id`),
  ADD KEY `FK_book_contributors_users` (`user_id`);

--
-- Indeks untuk tabel `book_contributors_role`
--
ALTER TABLE `book_contributors_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `book_language`
--
ALTER TABLE `book_language`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `book_papers`
--
ALTER TABLE `book_papers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `book_purchase`
--
ALTER TABLE `book_purchase`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `FK_book_purchase_users` (`user_id`);

--
-- Indeks untuk tabel `book_purchase_item`
--
ALTER TABLE `book_purchase_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_book_purchase_item_books` (`book_id`),
  ADD KEY `FK_book_purchase_item_book_purchase` (`bp_order_id`);

--
-- Indeks untuk tabel `book_rating`
--
ALTER TABLE `book_rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `FK_book_rating_users` (`user_id`),
  ADD KEY `FK_book_rating_books` (`book_id`);

--
-- Indeks untuk tabel `book_sell`
--
ALTER TABLE `book_sell`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `FK_book_sell_book_sell_publisher` (`publisher_id`),
  ADD KEY `FK_book_sell_books` (`book_id`);

--
-- Indeks untuk tabel `book_sell_publisher`
--
ALTER TABLE `book_sell_publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `book_sizes`
--
ALTER TABLE `book_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `default_value`
--
ALTER TABLE `default_value`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `designcover`
--
ALTER TABLE `designcover`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_events_event_type` (`event_type_id`);

--
-- Indeks untuk tabel `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inisial` (`inisial`);

--
-- Indeks untuk tabel `katalogbuku`
--
ALTER TABLE `katalogbuku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `judul` (`judul`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indeks untuk tabel `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `FK_menu_user_groups` (`id_role`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD KEY `FK_order_books` (`book_id`),
  ADD KEY `FK_order_order_status` (`progress_id`) USING BTREE;

--
-- Indeks untuk tabel `order_progress`
--
ALTER TABLE `order_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket_harga`
--
ALTER TABLE `paket_harga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_paket_harga_pakets` (`paket_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `FK_password_resets_users` (`user_id`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_kabupaten_kota`
--
ALTER TABLE `ref_kabupaten_kota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_kabupaten_kota` (`kode_kabupaten_kota`),
  ADD KEY `FK_ref_kabupaten_kota_ref_provinsi` (`ref_provinsi_id`);

--
-- Indeks untuk tabel `ref_provinsi`
--
ALTER TABLE `ref_provinsi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_provinsi` (`kode_provinsi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `referral_code` (`referral_code`),
  ADD UNIQUE KEY `verify_code` (`verify_code`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `FK_users_user_groups` (`role_id`);

--
-- Indeks untuk tabel `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_referral`
--
ALTER TABLE `user_referral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_referral_users` (`referral_from`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `book_contributors`
--
ALTER TABLE `book_contributors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `book_contributors_role`
--
ALTER TABLE `book_contributors_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `book_language`
--
ALTER TABLE `book_language`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `book_papers`
--
ALTER TABLE `book_papers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `book_purchase_item`
--
ALTER TABLE `book_purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `book_rating`
--
ALTER TABLE `book_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `book_sell`
--
ALTER TABLE `book_sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `book_sell_publisher`
--
ALTER TABLE `book_sell_publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `book_sizes`
--
ALTER TABLE `book_sizes`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `default_value`
--
ALTER TABLE `default_value`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `designcover`
--
ALTER TABLE `designcover`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `editor`
--
ALTER TABLE `editor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `katalogbuku`
--
ALTER TABLE `katalogbuku`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `layout`
--
ALTER TABLE `layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `order_progress`
--
ALTER TABLE `order_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `paket_harga`
--
ALTER TABLE `paket_harga`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `ref_kabupaten_kota`
--
ALTER TABLE `ref_kabupaten_kota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9472;

--
-- AUTO_INCREMENT untuk tabel `ref_provinsi`
--
ALTER TABLE `ref_provinsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_referral`
--
ALTER TABLE `user_referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `FK_books_book_category` FOREIGN KEY (`category_id`) REFERENCES `book_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_books_book_language` FOREIGN KEY (`language_id`) REFERENCES `book_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_books_book_papers` FOREIGN KEY (`book_paper_id`) REFERENCES `book_papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_books_book_sizes1` FOREIGN KEY (`book_size_id`) REFERENCES `book_sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_books_paket_harga` FOREIGN KEY (`paket_harga_id`) REFERENCES `paket_harga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_books_ref_kabupaten_kota` FOREIGN KEY (`ref_kota_id`) REFERENCES `ref_kabupaten_kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_books_ref_provinsi` FOREIGN KEY (`ref_provinsi_id`) REFERENCES `ref_provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_contributors`
--
ALTER TABLE `book_contributors`
  ADD CONSTRAINT `FK_book_contributors_book_contributors_role` FOREIGN KEY (`contributor_role_id`) REFERENCES `book_contributors_role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_book_contributors_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_book_contributors_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_purchase`
--
ALTER TABLE `book_purchase`
  ADD CONSTRAINT `FK_book_purchase_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_purchase_item`
--
ALTER TABLE `book_purchase_item`
  ADD CONSTRAINT `FK_book_purchase_item_book_purchase` FOREIGN KEY (`bp_order_id`) REFERENCES `book_purchase` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_book_purchase_item_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_rating`
--
ALTER TABLE `book_rating`
  ADD CONSTRAINT `FK_book_rating_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_book_rating_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `book_sell`
--
ALTER TABLE `book_sell`
  ADD CONSTRAINT `FK_book_sell_book_sell_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `book_sell_publisher` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_book_sell_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_events_event_type` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_menu_user_groups` FOREIGN KEY (`id_role`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_order_progress` FOREIGN KEY (`progress_id`) REFERENCES `order_progress` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `paket_harga`
--
ALTER TABLE `paket_harga`
  ADD CONSTRAINT `FK_paket_harga_pakets` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `FK_password_resets_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ref_kabupaten_kota`
--
ALTER TABLE `ref_kabupaten_kota`
  ADD CONSTRAINT `FK_ref_kabupaten_kota_ref_provinsi` FOREIGN KEY (`ref_provinsi_id`) REFERENCES `ref_provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_user_groups` FOREIGN KEY (`role_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_referral`
--
ALTER TABLE `user_referral`
  ADD CONSTRAINT `FK_user_referral_users` FOREIGN KEY (`referral_from`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
