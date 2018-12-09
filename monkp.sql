-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2018 at 07:56 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `corporations`
--

CREATE TABLE `corporations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `corporations`
--

INSERT INTO `corporations` (`id`, `name`, `address`, `city`, `post_code`, `telp`, `fax`, `business_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ITS', 'Keputih', 'Surabaya', '60111', '088123456789', '088123456789', 'pengusaha', 'usaha bebas', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `saved_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_progres`
--

CREATE TABLE `file_progres` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(500) DEFAULT NULL,
  `progres_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_progres`
--

INSERT INTO `file_progres` (`id`, `nama_file`, `progres_id`, `created_at`, `updated_at`) VALUES
(6, '1544290133.JPG', 9, '2018-12-08 10:28:53', '2018-12-08 10:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `lecturer_grade` int(11) NOT NULL,
  `mentor_grade` int(11) NOT NULL,
  `bukti_nilai` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discipline_grade` int(11) NOT NULL,
  `report_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tanggal_ujian` date DEFAULT NULL,
  `masukan` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `member_id`, `lecturer_grade`, `mentor_grade`, `bukti_nilai`, `discipline_grade`, `report_status`, `created_at`, `updated_at`, `tanggal_ujian`, `masukan`) VALUES
(1, 4, 100, 100, NULL, 100, 100, '2018-12-05 23:20:02', '2018-12-05 23:20:26', NULL, NULL),
(2, 6, 0, 0, NULL, 0, 0, '2018-12-07 23:49:40', '2018-12-07 23:49:40', NULL, NULL),
(3, 7, 90, 90, '1544269768.JPG', 100, 100, '2018-12-08 03:24:10', '2018-12-08 07:46:33', '2018-12-14', '-------'),
(4, 8, 90, 0, NULL, 0, 0, '2018-12-08 03:24:10', '2018-12-08 06:57:57', '2018-12-14', '-------'),
(5, 10, 0, 0, NULL, 0, 0, '2018-12-08 09:17:09', '2018-12-08 09:17:09', NULL, NULL),
(6, 11, 0, 0, NULL, 0, 0, '2018-12-08 09:17:09', '2018-12-08 09:17:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `corporation_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_buku` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Belum',
  `nama_file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `corporation_id`, `start_date`, `end_date`, `status`, `lecturer_id`, `semester_id`, `created_at`, `updated_at`, `comment`, `status_buku`, `nama_file`) VALUES
(5, 1, '2018-12-19', '2018-12-22', 1, 0, 2, '2018-12-04 04:14:48', '2018-12-08 07:51:38', '', 'Belum', NULL),
(6, 1, '2018-12-04', '2018-12-31', 2, 23, 2, '2018-12-04 07:41:08', '2018-12-08 11:40:10', '', 'Sudah', NULL),
(8, 1, '2018-12-01', '2018-12-31', 2, 71, 2, '2018-12-06 04:16:44', '2018-12-07 23:49:40', '', 'Belum', NULL),
(9, 1, '2018-12-01', '2019-01-01', 2, 73, 2, '2018-12-08 03:18:25', '2018-12-08 03:24:10', '', 'Belum', NULL),
(11, 1, '2018-12-01', '2019-01-05', 2, 36, 2, '2018-12-08 09:14:30', '2018-12-08 21:29:11', '', 'Belum', NULL),
(12, 1, '2018-12-12', '2019-01-04', 1, 73, 2, '2018-12-08 22:27:45', '2018-12-08 22:28:10', '', 'Belum', '12.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `group_requests`
--

CREATE TABLE `group_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_requests`
--

INSERT INTO `group_requests` (`id`, `group_id`, `status`) VALUES
(3, 5, 0),
(4, 6, 0),
(5, 8, 0),
(6, 9, 1),
(8, 11, 1),
(9, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `initial` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `nip`, `name`, `full_name`, `initial`) VALUES
(1, '0', 'KOOR KP', 'KOORDINATOR KERJA PRAKTIK', 'ADM'),
(2, '1', 'TATA USAHA', 'TATA USAHA', 'TAT'),
(3, '051100003', 'ARIF BRAMANTORO', 'ARIF BRAMANTORO, S.Kom.', 'AB'),
(4, '051100008', 'NUNUT PRIYO J. ', 'NUNUT PRIYO JATMIKO, S.Kom.', 'NP'),
(5, '051100012', 'MEDIANA ARYUNI', 'MEDIANA ARYUNI, S.Kom.,M.Kom', 'MA'),
(6, '198407082010122004', 'HENNING T.C', 'HENNING TITI CIPTANINGTYAS, S.Kom., M.Kom.', 'HC'),
(7, '051100114', 'ABDUL MUNIF', 'ABDUL MUNIF, S.Kom., M.Sc.', 'MN'),
(8, '198603122012122004', 'WIJAYANTI NURUL', 'WIJAYANTI NURUL K.,S.Kom., M.Sc.', 'WN'),
(9, '051100116', 'BAGUS JATI S', 'BAGUS JATI SANTOSO, S.Kom.', 'BJ'),
(10, '051100117', 'ERINA LETIVINA A', 'ERINA LETIVINA ANGGRAINI, S.Kom.M.Kom.', 'EL'),
(11, '198410162008121002', 'RADITYO ANGGORO', 'Dr.Eng. RADITYO ANGGORO, S.Kom., M.Sc.', 'RA'),
(12, '198409042010121002', 'ARYA YUDHI WIJAYA', 'ARYA YUDHI WIJAYA, S.Kom., M.Kom.', 'AW'),
(13, '051100120', 'RATIH NUR ESTI', 'RATIH NUR ESTI A.,S.Kom., M.Sc.', 'RN'),
(14, '051100121', 'DINI ADNI', 'DINI ADNI NAVASTARA, S.Kom., M.Sc.', 'DA'),
(15, '198701032014041001', 'RIZKY JANUAR A', 'RIZKY JANUAR AKBAR, S.Kom., M.Eng.', 'RJ'),
(16, '051100123', 'RIDHO RAHMAN', 'RIDHO RAHMAN H., S.Kom., M.Sc.', 'RR'),
(17, '051100124', 'NURUL FAJRIN', 'NURUL FAJRIN A.,S.Kom., M.Sc.', 'NF'),
(18, '051100125', 'HADZIQ FABROYIR', 'HADZIQ FABROYIR, S.Kom.', 'HF'),
(19, '052100001', 'FAIZAL JOHAN A', 'FAIZAL JOHAN A, S.Kom.', 'FJ'),
(20, '194806191973011001', 'SUPENO DJANALI', 'Prof. Ir. SUPENO DJANALI, M.Sc, Ph.D.', 'SD'),
(21, '194908231976032001', 'HANDAYANI TJANDRASA', 'Prof. Ir. HANDAYANI TJANDRASA, M.Sc., Ph.D.', 'HT'),
(22, '130816212', 'ESTHER HANAYA', 'Ir. ESTHER HANAYA, M.Sc.', 'EH'),
(23, '195701011983031004', 'F.X. ARUNANTO', 'Ir. F.X. ARUNANTO, M.Sc.', 'AR'),
(24, '196002211984031001', 'MUCHAMMAD HUSNI', 'Ir. MUCHAMMAD HUSNI, M.Kom.', 'MH'),
(25, '195908031986011001', 'RIYANARTO SARNO', 'Prof. Drs.Ec. Ir. RIYANARTO SARNO, M.Sc., Ph.D. ', 'RS'),
(26, '131633403', 'ARIF DJUNAIDY', 'Prof. Dr. Ir. ARIF DJUNAIDY, M.Sc.', 'AD'),
(27, '131846108', 'KHAKIM GHOZALI', 'Ir. KHAKIM GHOZALI, M.M.T. ', 'KG'),
(28, '131933299', 'ARIS TJAHYANTO', 'Ir. ARIS TJAHYANTO, M.T.', 'AT'),
(29, '196505181992031003', 'HARI GINARDI', 'Dr.tech. Ir. R.V.HARI GINARDI, M.Sc.', 'HG'),
(30, '131996150', 'ACHMAD HOLIL NOOR ALI', 'Ir. ACHMAD HOLIL NOOR ALI, M.Kom.', 'AH'),
(31, '196707271992031002', 'JOKO LIANTO B.', 'Prof. Dr .Ir. JOKO LIANTO BULIALI, M.Sc..', 'JL'),
(32, '196907281993031001', 'SUHADI LILI', 'Ir. SUHADI LILI', 'SL'),
(33, '197002131994021001', 'RULLY SOELAIMAN', 'RULLY SOELAIMAN, S.Kom., M.Kom.', 'RL'),
(34, '196810021994032001', 'SITI ROCHIMAH', 'Dr. Ir. SITI ROCHIMAH, M.T.', 'ST'),
(35, '196912281994121001', 'VICTOR HARIADI', 'VICTOR HARIADI, S.Si., M.Kom.', 'VH'),
(36, '197104281994122001', 'NANIK SUCIATI', 'Dr. Eng. NANIK SUCIATI, S.Kom., M.Kom.', 'NS'),
(37, '197208091995121001', 'AGUS ZAINAL ARIFIN', 'Dr. AGUS ZAINAL ARIFIN, S.Kom., M.Kom.', 'AZ'),
(38, '197205281997021001', 'DWI SUNARYONO', 'DWI SUNARYONO, S.Kom., M.Kom.', 'DS'),
(39, '197007141997031002', 'YUDHI PURWANANTO', 'YUDHI PURWANANTO, S.Kom., M.Kom.', 'YP'),
(40, '132206858', 'FEBRILIYAN SAMOPA', 'Dr. FEBRILIYAN SAMOPA, S.Kom., M.Kom. ', 'FS'),
(41, '197404031999031002', 'FAJAR BASKORO', 'FAJAR BASKORO, S.Kom., M.T.', 'FB'),
(42, '197410222000031001', 'WASKITHO WIBISONO', 'WASKITHO WIBISONO, S.Kom., M.Eng., Ph.D.', 'WW'),
(43, '197509142001122002', 'BILQIS AMALIAH', 'BILQIS AMALIAH, S.Kom., M.Kom.', 'BA'),
(44, '197608092001122001', 'SARWOSRI', 'SARWOSRI, S.Kom., M.T.', 'SR'),
(45, '197512202001122002', 'CHASTINE FATICHAH', 'Dr.Eng. CHASTINE FATICHAH, S.Kom., M.Kom.', 'CF'),
(46, '197402092002121001', 'IRFAN SUBAKTI', 'M.M. IRFAN SUBAKTI, S.Kom., M.Eng.Sc.', 'IS'),
(47, '197110302002121001', 'WAHYU SUADI', 'WAHYU SUADI, S.Kom., M.M., M.Kom.', 'WS'),
(48, '132304276', 'MUDJAHIDIN', 'MUDJAHIDIN, S.Kom., M.T.', 'MJ'),
(49, '197505252003121002', 'TOHARI AHMAD', 'TOHARI AHMAD, S.Kom., MIT., Ph.D.', 'TA'),
(50, '197712172003121001', 'DARLIS HERUMURTI', 'DARLIS HERUMURTI, S.Kom., M.Kom.', 'DH'),
(51, '197612152003121001', 'IMAM KUSWARDAYAN', 'IMAM KUSWARDAYAN, S.Kom, M.T.', 'IM'),
(52, '197804102003122001', 'DIANA PURWITASARI', 'DIANA PURWITASARI, S.Kom., M.Sc.', 'DP'),
(53, '198106222005012002', 'ANNY YUNIARTI', 'ANNY YUNIARTI, S.Kom., M.Comp.Sc.', 'AY'),
(54, '197906262005012002', 'UMI LAILI YUHANA', 'UMI LAILI YUHANA, S.Kom., M.Sc.', 'UY'),
(55, '198106202005011003', 'ARY MAZHARUDDIN S', 'ARY MAZHARUDDIN S., S.Kom., M.Comp.Sc.', 'AM'),
(56, '197411232006041001', 'DANIEL O. SIAHAAN', 'DANIEL ORANOVA S., S.Kom., M.Sc., P.D.Eng.', 'DO'),
(57, '197107182006041001', 'AHMAD SAIKHU', 'AHMAD SAIKHU, S.Si., M.T.', 'AS'),
(58, '197804122006042001', 'ISYE ARIESHANTI', 'ISYE ARIESHANTI, S.Kom, M.Phil.', 'IA'),
(59, '198211152006041003', 'AHMAD HOIRUL BASORI', 'AHMAD HOIRUL BASORI, S.Kom.', 'HB'),
(60, '197708242006041001', 'ROYYANA MUSLIM I', 'ROYYANA MUSLIM IJTIHADIE, S.Kom., M.Kom., PhD.', 'RM'),
(61, '197212071997022001', 'DWI ENDAH KUSRINI', 'DWI ENDAH KUSRINI, S.Si., M.Si.', 'DE'),
(62, '198112292005011002', 'RULLY AGUS HENDRAWAN', 'RULLY AGUS HENDRAWAN, S.Kom., M.Eng.', 'RH'),
(63, '19840203201021003', 'RADITYO P. WIBOWO, S.Kom., M.Kom.', 'RADITYO P. WIBOWO, S.Kom., M.Kom.', 'RP'),
(64, '510000001', 'ADHATUS SOLICHAH AHMADIYAH', 'ADHATUS SOLICHAH AHMADIYAH, S.Kom., M.Sc.', 'AL'),
(65, '198705112012121003', 'HUDAN STUDIAWAN', 'HUDAN STUDIAWAN, S.Kom., M.Kom. ', 'HS'),
(66, '510000003', 'BASKORO ADI PRATOMO', 'BASKORO ADI PRATOMO, S.Kom, M.Kom. ', 'BS'),
(67, '510000004', 'SHINTAMI CHUSNUL HIDAYATI', 'SHINTAMI CHUSNUL HIDAYATI, S.Kom. ', 'SC'),
(68, '510100020', 'ARIF WIBISONO', 'ARIF WIBISONO, S.Kom., M.Sc.', 'AO'),
(70, 'tian', 'TIAN', 'TIAN AJA', 'TA'),
(71, '12345678', 'Dosen Coba', 'Dosen Coba', 'DC'),
(73, '87654321', 'Paijo', 'Paijo Paijo', 'PP'),
(74, '1234567890', 'RBTC', 'RBTC', 'RB');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `student_id`, `group_id`, `created_at`, `updated_at`) VALUES
(3, 5, 5, NULL, NULL),
(4, 6, 6, NULL, NULL),
(6, 7, 8, NULL, NULL),
(7, 8, 9, NULL, NULL),
(8, 9, 9, NULL, NULL),
(10, 10, 11, NULL, NULL),
(11, 11, 11, NULL, NULL),
(12, 12, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mentors`
--

CREATE TABLE `mentors` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mentors`
--

INSERT INTO `mentors` (`id`, `group_id`, `name`) VALUES
(1, 4, 'ashds'),
(2, 9, 'Paijo Lapangan HH');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_05_07_061627_create_users_table', 1),
('2015_05_07_061759_create_members_table', 1),
('2015_05_07_061834_create_grades_table', 1),
('2015_05_07_061930_create_groups_table', 1),
('2015_05_07_062037_create_mentors_table', 1),
('2015_05_07_062120_create_corporations_table', 1),
('2015_06_08_101107_create_posts_table', 1),
('2015_06_08_101125_create_students_table', 1),
('2015_06_08_101143_create_lecturers_table', 1),
('2015_06_19_091245_create_notifications_table', 1),
('2015_06_19_091252_create_group_requests_table', 1),
('2015_06_28_122839_create_semesters_table', 1),
('2015_07_09_103055_create_files_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `notifiable_id` int(11) NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `notifiable_id`, `notifiable_type`, `is_read`, `created_at`, `updated_at`) VALUES
(2, 72, 3, 'group request', 0, '2018-12-04 04:14:48', '2018-12-04 04:14:48'),
(3, 72, 4, 'group request', 0, '2018-12-04 07:41:09', '2018-12-04 07:41:09'),
(4, 72, 5, 'group request', 0, '2018-12-06 04:16:44', '2018-12-06 04:16:44'),
(5, 79, 6, 'group request', 1, '2018-12-08 03:18:25', '2018-12-08 03:20:04'),
(7, 81, 8, 'group request', 1, '2018-12-08 09:14:30', '2018-12-08 09:14:54'),
(8, 85, 9, 'group request', 0, '2018-12-08 22:27:45', '2018-12-08 22:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progres`
--

CREATE TABLE `progres` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `jumlah_progres` int(11) NOT NULL DEFAULT '4',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progres`
--

INSERT INTO `progres` (`id`, `group_id`, `jumlah_progres`, `created_at`, `updated_at`) VALUES
(9, 9, 6, '2018-12-09 04:45:13', '2018-12-08 21:45:13'),
(11, 11, 3, '2018-12-08 17:09:12', '2018-12-08 09:57:17'),
(12, 12, 4, '2018-12-08 22:27:45', '2018-12-08 22:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(10) UNSIGNED NOT NULL,
  `odd` tinyint(1) NOT NULL,
  `year` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `odd`, `year`, `start_date`, `end_date`, `user_due_date`) VALUES
(1, 5, 2018, '2018-12-15', '2019-02-09', '2019-02-01'),
(2, 1, 2018, '2018-11-30', '2018-12-31', '2018-12-29'),
(3, 1, 2020, '2018-12-01', '2018-12-31', '2018-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `nrp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nrp`, `name`) VALUES
(3, '5116100171', 'Hidayatul Munawaroh'),
(4, '5116100172', 'Hidayatul Munawarohytryt'),
(5, '5115100004', 'Nuzul Ayu Safitri'),
(6, '5115100029', 'Andrean Januar Priatmojo'),
(7, '5115100002', 'akun 1'),
(8, '5115100054', 'Hidayatul Munawaroh'),
(9, '5115100701', 'Rozana Firdausi'),
(10, '5115100001', 'Damai Marisa B'),
(11, '5116100001', 'Daniel Kurniawan'),
(12, '5116100002', 'Fandy'),
(13, '5116100003', 'Alfian');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `personable_id` int(11) NOT NULL,
  `personable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nohp` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `personable_id`, `personable_type`, `remember_token`, `created_at`, `updated_at`, `nohp`) VALUES
(1, 'koorkp', '$2y$10$hzb09Ywpv//YNwiJuDgqVuRAANF4t30dHF8VruRiwAtIFnjRBznmC', 1, 'lecturer', 'itzsKdE8Bf1yC8FNXEZSJ2f5rTr9TaH8eMRJUNUnrSe1DUTWcxaLcnba8l5j', '2018-11-30 02:55:40', '2018-11-30 02:55:40', '088123456789'),
(2, 'tu', '$2y$10$2/M8MUiMq7HS0X3KVA8bA.qHhd3g9p2STKCAyWONw.JZvz0WkgUN.', 2, 'lecturer', 'nzaEvXVME6mRfglCMOkHpFLLCl7yZqJiIfEGRqPmYu0pQrcxO0F4q7jnjeNg', '2016-03-01 14:08:49', '2016-03-01 14:08:49', NULL),
(3, '051100003', '$2y$10$OTQu4TpvXb0wyG3WuNlVUuF5Afuj7qsr2y4H63rz84zCCIcAXHVOm', 3, 'lecturer', NULL, '2016-03-01 14:08:49', '2016-03-01 14:08:49', NULL),
(4, '051100008', '$2y$10$3WXMUCgCIn7y4ublNyEF0OUJiijTMOh7l7Nlo5vSWzDGo01KggZg.', 4, 'lecturer', NULL, '2016-03-01 14:08:49', '2016-03-01 14:08:49', NULL),
(5, '051100012', '$2y$10$W8SahOENlVfjiJdI4x7zGe2li9rEKh1naqYvuuxLGY/rZRggSK6je', 5, 'lecturer', NULL, '2016-03-01 14:08:50', '2016-03-01 14:08:50', NULL),
(6, '198407082010122004', '$2y$10$j/t6KFJNPQ5qqnnlHPxiWuQNXKz.IyTenlBWy66pmwWm09NBNPrqm', 6, 'lecturer', NULL, '2016-03-01 14:08:50', '2016-03-01 14:08:50', NULL),
(7, '051100114', '$2y$10$igRiX7Ym9h3LUxO24XZMOu0naR6PXDauxJuA5JbmSLMDs7fcLiZnS', 7, 'lecturer', NULL, '2016-03-01 14:08:50', '2016-03-01 14:08:50', NULL),
(8, '198603122012122004', '$2y$10$LFlayyWtA2GUo2bbgYr4vOPPavw7etKBno7Rw9AvsWtmeSNSGJZkK', 8, 'lecturer', NULL, '2016-03-01 14:08:51', '2016-03-01 14:08:51', NULL),
(9, '051100116', '$2y$10$jK4ctweNq4JtN1va.fs5hejzmIpli4jfRVVxy3xlr/XvSpEn8eoIK', 9, 'lecturer', NULL, '2016-03-01 14:08:51', '2016-03-01 14:08:51', NULL),
(10, '051100117', '$2y$10$HxBGpCi.WiwPHa4ashgzcuTDpcX4OL0fnljhoEJxQQSEkJFxp8Bha', 10, 'lecturer', NULL, '2016-03-01 14:08:51', '2016-03-01 14:08:51', NULL),
(11, '198410162008121002', '$2y$10$5pSIUCAnEe6dQUngpP5riOaMGOF7dCQnukUBg9dbxywWLscBtXJsi', 11, 'lecturer', NULL, '2016-03-01 14:08:52', '2016-03-01 14:08:52', NULL),
(12, '198409042010121002', '$2y$10$8TtpptWWj5LgughStMI69uHhKoxzm9eq3A3Zjlvsi/WH0TWk08ppC', 12, 'lecturer', NULL, '2016-03-01 14:08:52', '2016-03-01 14:08:52', NULL),
(13, '051100120', '$2y$10$1cDwlTjo1NdAyTcB5AA42O7Gy9YCqqvpBOIhwqJp6FMNeH448Znv6', 13, 'lecturer', NULL, '2016-03-01 14:08:52', '2016-03-01 14:08:52', NULL),
(14, '051100121', '$2y$10$gJzgTiIs2Q3MYB1o8FQvVOYcwbi8SgqV2NUxbITIQre08P/KW5riq', 14, 'lecturer', NULL, '2016-03-01 14:08:53', '2016-03-01 14:08:53', NULL),
(15, '198701032014041001', '$2y$10$/4Sepd71Z16AiTEZqoZG9ORTVEH1e94n/Z3ZpOiRe92CUjY10ZyIe', 15, 'lecturer', NULL, '2016-03-01 14:08:53', '2016-03-01 14:08:53', NULL),
(16, '051100123', '$2y$10$7ODXkB8DAlebcvD2z1G01.QNHM70mK/eR09xPVKCQWFz0TuUpvYLW', 16, 'lecturer', NULL, '2016-03-01 14:08:53', '2016-03-01 14:08:53', NULL),
(17, '051100124', '$2y$10$MhvoTkGEdNSZcCdiwXw.YuiSomaaF38kTBgmXGB/acSwLVlOHo5Hu', 17, 'lecturer', NULL, '2016-03-01 14:08:54', '2016-03-01 14:08:54', NULL),
(18, '051100125', '$2y$10$Jdcpa9sXYcJQ9gkHpnpVoO02p8byEFgmNWmQ4xuGYdOYTw2/tz/wC', 18, 'lecturer', NULL, '2016-03-01 14:08:54', '2016-03-01 14:08:54', NULL),
(19, '052100001', '$2y$10$lxUfqhGPEWgYTTHECNDvI.6VBCIPqKJNnS5Ezoyy2meURJCQu.mhS', 19, 'lecturer', NULL, '2016-03-01 14:08:54', '2016-03-01 14:08:54', NULL),
(20, '194806191973011001', '$2y$10$zsHRKkuJurnSlEhhoy2GZOb3YZOP3P.Vxv184FAw17h1FgrL5H4ia', 20, 'lecturer', NULL, '2016-03-01 14:08:55', '2016-03-01 14:08:55', NULL),
(21, '194908231976032001', '$2y$10$/gQTe45TjUZ.LdOpqzd83uF4/lr4BKFOo4PVZXkJRRbHx1kLbunxq', 21, 'lecturer', NULL, '2016-03-01 14:08:55', '2016-03-01 14:08:55', NULL),
(22, '130816212', '$2y$10$7exwtkBanOfdINy2hO63N.cGAD0EZ7xKYcvsNPktnuXxiDm5tpGL6', 22, 'lecturer', NULL, '2016-03-01 14:08:55', '2016-03-01 14:08:55', NULL),
(23, '195701011983031004', '$2y$10$tpXERz5I0h8mCqfwpjM3cOQ5jywlD4TMQvN0p0myIPy7yJoGohOaW', 23, 'lecturer', NULL, '2016-03-01 14:08:55', '2016-03-01 14:08:55', NULL),
(24, '196002211984031001', '$2y$10$J/szcHji.LuhEW/j/Hy4A.mDTQwUpXVVxYuUPqmYIPobDcN1nP216', 24, 'lecturer', NULL, '2016-03-01 14:08:56', '2016-03-01 14:08:56', NULL),
(25, '195908031986011001', '$2y$10$B0GXjFzo44MCjFnDoLuq4OSEjEMpbSC3nTM/jjX8vwr9W6SEKf74W', 25, 'lecturer', NULL, '2016-03-01 14:08:56', '2016-03-01 14:08:56', NULL),
(26, '131633403', '$2y$10$dCm8kwiZhB3.99Ay0apw5OHrlwBzNmzgKpO65Kkp5gZgooaHRpsom', 26, 'lecturer', NULL, '2016-03-01 14:08:56', '2016-03-01 14:08:56', NULL),
(27, '131846108', '$2y$10$.U5GLarv07REAQB8.4md1ewtmhAy3y1no2O2MGXhfCtk8UgUYXKEK', 27, 'lecturer', NULL, '2016-03-01 14:08:57', '2016-03-01 14:08:57', NULL),
(28, '131933299', '$2y$10$Of4Uu.83t15GYec4ehCSyeeup18VcNcEf36mCcoJ1L8Ppr4ibLSZG', 28, 'lecturer', NULL, '2016-03-01 14:08:57', '2016-03-01 14:08:57', NULL),
(29, '196505181992031003', '$2y$10$tcWTq1908i9mM/q8JwepV.WOJj3TnxyiTzorhwaqpa1gj6rRKFvL2', 29, 'lecturer', NULL, '2016-03-01 14:08:57', '2016-03-01 14:08:57', NULL),
(30, '131996150', '$2y$10$KO5gt.kF3zFpDoQfRI2uF.kP2g9NmU7YHUOJHH8Xs3Ju4Wo/O5fAW', 30, 'lecturer', NULL, '2016-03-01 14:08:58', '2016-03-01 14:08:58', NULL),
(31, '196707271992031002', '$2y$10$if1e1qrsvDYfKe5qWPS4KewUYpUFZkG9igjrPAlgndeEa7By2BB32', 31, 'lecturer', NULL, '2016-03-01 14:08:58', '2016-03-01 14:08:58', NULL),
(32, '196907281993031001', '$2y$10$u85d0QGyLdTI1GXYS6zvy.W7yGXjvEG9cnYQyZR.v1EoS/jCr7NTG', 32, 'lecturer', NULL, '2016-03-01 14:08:58', '2016-03-01 14:08:58', NULL),
(33, '197002131994021001', '$2y$10$8YTkGmwQHnpf0QILLSsDEukMbhKCkgMowhlYN3fzHnvHetFMfIIyu', 33, 'lecturer', NULL, '2016-03-01 14:08:59', '2016-03-01 14:08:59', NULL),
(34, '196810021994032001', '$2y$10$lXCRE7EFqpE1jOoDorNqveGHMMN/Xr/LNhtdZDkRM/G422CqDTqFy', 34, 'lecturer', NULL, '2016-03-01 14:08:59', '2016-03-01 14:08:59', NULL),
(35, '196912281994121001', '$2y$10$rpV/4gTiy7Omd8dSYAWxJ.JvfihMEYeJ5oWNdBzwlizUIr9TbPdxi', 35, 'lecturer', NULL, '2016-03-01 14:08:59', '2016-03-01 14:08:59', NULL),
(36, '197104281994122001', '$2y$10$VQw5A6LioetaLiorkUkWluznCcKA3OwZ3Dw6At24Ioffuf04Yupia', 36, 'lecturer', NULL, '2016-03-01 14:09:00', '2016-03-01 14:09:00', NULL),
(37, '197208091995121001', '$2y$10$V7e6kNbWgrHaq4CtnxS7M.2uycWFRuUwOBPoCcpsJK/5W1UB5UyhK', 37, 'lecturer', NULL, '2016-03-01 14:09:00', '2016-03-01 14:09:00', NULL),
(38, '197205281997021001', '$2y$10$3CJP25xRp694cagrHh9oXu45UDvU5QdEkbMO770ZqP/AQzXx8aR2e', 38, 'lecturer', NULL, '2016-03-01 14:09:00', '2016-03-01 14:09:00', NULL),
(39, '197007141997031002', '$2y$10$G6VZAxrNYR4rsLUxSykqmOH107zOPPomHRZtuRewbyjK/RHJBHvka', 39, 'lecturer', NULL, '2016-03-01 14:09:01', '2016-03-01 14:09:01', NULL),
(40, '132206858', '$2y$10$Ok0LnONxWNzc6fSjcbR2tOdKyy2DzjAOci7B85jbVuCy1tn5btuPS', 40, 'lecturer', NULL, '2016-03-01 14:09:01', '2016-03-01 14:09:01', NULL),
(41, '197404031999031002', '$2y$10$fanv5cZ3sa6pYwmKec.Hg.VcpnWPjpbjkQLF4C33ThgkAEYkkDCQS', 41, 'lecturer', NULL, '2016-03-01 14:09:01', '2016-03-01 14:09:01', NULL),
(42, '197410222000031001', '$2y$10$RMU8hkYrEA83EjHr1L1f3.Ptsjp.jA2hktZxYKf46bOccbITmDHEe', 42, 'lecturer', NULL, '2016-03-01 14:09:02', '2016-03-01 14:09:02', NULL),
(43, '197509142001122002', '$2y$10$I2OFRG3XkmfsybCeVjZcf.dMOwJVelbCzvnryyD9.E5qZQTWNMPx6', 43, 'lecturer', NULL, '2016-03-01 14:09:02', '2016-03-01 14:09:02', NULL),
(44, '197608092001122001', '$2y$10$8C0pfiD80z0mAzI2I88T9.EezzSk/uOAruiEYxpOAMHor1NfF21Im', 44, 'lecturer', NULL, '2016-03-01 14:09:02', '2016-03-01 14:09:02', NULL),
(45, '197512202001122002', '$2y$10$cpCfiQj9.V.zUEmTagfyzOlDqJcYrEBbItmsbMw2LncAGC2X2zLQi', 45, 'lecturer', NULL, '2016-03-01 14:09:03', '2016-03-01 14:09:03', NULL),
(46, '197402092002121001', '$2y$10$7s3DiApEBnyQs83d0PdIm.ZYQPgKf3Mr/C4EvUUaA706VFjTLEoX2', 46, 'lecturer', NULL, '2016-03-01 14:09:03', '2016-03-01 14:09:03', NULL),
(47, '197110302002121001', '$2y$10$at0KlBwby1JyNtCK221ecOcrzfS1NTze6Q2Kv5/dAwRCFOCi/heVG', 47, 'lecturer', NULL, '2016-03-01 14:09:04', '2016-03-01 14:09:04', NULL),
(48, '132304276', '$2y$10$xddQyTcKDgjYIMHDvq61hOyKMF4mkS2mg7d594u6Mqdm9j4jssdiu', 48, 'lecturer', NULL, '2016-03-01 14:09:04', '2016-03-01 14:09:04', NULL),
(49, '197505252003121002', '$2y$10$Ask.hU6Nz8e4qyweuG3cXObYJqmERbKOyZ97WBeGpb5EscALEO5za', 49, 'lecturer', NULL, '2016-03-01 14:09:04', '2016-03-01 14:09:04', NULL),
(50, '197712172003121001', '$2y$10$mklTo//6.Sz7IaOvk33weem5tI/91IrdrgFOBjYZ4Qz6AlaUQaWeS', 50, 'lecturer', NULL, '2016-03-01 14:09:05', '2016-03-01 14:09:05', NULL),
(51, '197612152003121001', '$2y$10$E1NEDsVIrMBJKu9i3Inn7Oh8fii56xV0Q.amblf0YUtDcfmGn5P0e', 51, 'lecturer', NULL, '2016-03-01 14:09:05', '2016-03-01 14:09:05', NULL),
(52, '197804102003122001', '$2y$10$ZU7HDFtNg.VYBH58lCDU5uPFoCJ44da.pc2qLRi5Nc6aylmymItMS', 52, 'lecturer', NULL, '2016-03-01 14:09:05', '2016-03-01 14:09:05', NULL),
(53, '198106222005012002', '$2y$10$VtdRTI0Jza3ZGDrgOmLfbengFmMfqoGRNNOVA0i/4ll9qL8capHtC', 53, 'lecturer', NULL, '2016-03-01 14:09:06', '2016-03-01 14:09:06', NULL),
(54, '197906262005012002', '$2y$10$Yci./zo.QuqqffJROYKEDOKrP5gpBp03GzUOxPgoTteFYUnHsXB9S', 54, 'lecturer', NULL, '2016-03-01 14:09:06', '2016-03-01 14:09:06', NULL),
(55, '198106202005011003', '$2y$10$qRNoSeTE3sq6HpF5eQujWOLgTEliKSRlbBhSho8t6Ikxpu3apJa16', 55, 'lecturer', NULL, '2016-03-01 14:09:06', '2016-03-01 14:09:06', NULL),
(56, '197411232006041001', '$2y$10$lR8LDa2V55XqDJuvgqeLmuVAjksznDpYWae67nOUb2cjq62wfvEhG', 56, 'lecturer', NULL, '2016-03-01 14:09:07', '2016-03-01 14:09:07', NULL),
(57, '197107182006041001', '$2y$10$efTIqRguDs.Slq98p62nqOFvl.yV2x62utVZO9vhL11n69giIM.uG', 57, 'lecturer', NULL, '2016-03-01 14:09:07', '2016-03-01 14:09:07', NULL),
(58, '197804122006042001', '$2y$10$TV/j19k1Il3wrp8PM/YGN.6nswd09gdS.XirvbShEMEN/cXdD9OF6', 58, 'lecturer', NULL, '2016-03-01 14:09:07', '2016-03-01 14:09:07', NULL),
(59, '198211152006041003', '$2y$10$FyQmdOv/dfm5.pjB51OAKuvBJYoupW3whNNjqjFNDU1vUD.EGFGIO', 59, 'lecturer', NULL, '2016-03-01 14:09:08', '2016-03-01 14:09:08', NULL),
(60, '197708242006041001', '$2y$10$g6Ayx6QeosuPKSYlvZrjhOY7XXT6T1/abEw.n1gXDOJ/CYPFjdjYe', 60, 'lecturer', NULL, '2016-03-01 14:09:08', '2016-03-01 14:09:08', NULL),
(61, '197212071997022001', '$2y$10$7zmpGLqZEFPwjC1esWd5YeCW5tx/MIujfNWR84IPPTClLfWaQy0wK', 61, 'lecturer', NULL, '2016-03-01 14:09:08', '2016-03-01 14:09:08', NULL),
(62, '198112292005011002', '$2y$10$tocjAfmG0rk3bLJl0ur15uvL/1Lf6Fyww7dBE9Dt.Lohu5E9/ySdO', 62, 'lecturer', NULL, '2016-03-01 14:09:09', '2016-03-01 14:09:09', NULL),
(63, '19840203201021003', '$2y$10$hh8QNjhVGnS11VfPDg7maurxOFaAVmlpQ1pkBxX/guRgZrNART2we', 63, 'lecturer', NULL, '2016-03-01 14:09:09', '2016-03-01 14:09:09', NULL),
(64, '510000001', '$2y$10$9TMvFwvRDuNWXJ.GSVw2peHS28x9qfh60wq3sfQ5dTcDOCu8DKhFO', 64, 'lecturer', NULL, '2016-03-01 14:09:09', '2016-03-01 14:09:09', NULL),
(65, '198705112012121003', '$2y$10$TkhfCNu.rzeOW2Sf4PePquc47xyY5Mdm2K/812kNWjCGioUO2coh.', 65, 'lecturer', NULL, '2016-03-01 14:09:10', '2016-03-01 14:09:10', NULL),
(66, '510000003', '$2y$10$OxtJFBg3G2MmQ1YdgKBodeo144dCcbb9EbioUx9yS/8Qt0lbFrVG6', 66, 'lecturer', NULL, '2016-03-01 14:09:10', '2016-03-01 14:09:10', NULL),
(67, '510000004', '$2y$10$p1snE7DuQpK5Mqv1njPk6uQcTUW/WI6vPcUXaTSrZH4lOgh.LCGVS', 67, 'lecturer', NULL, '2016-03-01 14:09:10', '2016-03-01 14:09:10', NULL),
(68, '510100020', '$2y$10$NhSdbxj1a58eBmDPkBYM1efKBC0lNSnIif7aBdvV9T86BsMjQPHBi', 68, 'lecturer', NULL, '2016-03-01 14:09:11', '2016-03-01 14:09:11', NULL),
(71, 'tian', '$2y$12$DkZeHxR8dlKWT0PzrOyNL.qZJSdgmVC9rFrntn9EDZCXtecAhdvn2', 70, 'lecturer', 'NMEzzuAAA7RnXpkPELzuG3Sb9XeA5nXjnwSOz8TQX4a1lYP2Gw7GSKepNFgo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(72, '5116100171', '$2y$10$RkNcLnb77eyIwqMWrOIDT.aKlzPXMj64Xgaf3c2KCsgjpDbwKn/Gu', 4, 'student', NULL, '2018-11-29 22:39:35', '2018-11-29 22:39:35', '088123456789'),
(73, '5115100004', '$2y$10$3kTJewSK.kzSLRaQZMPbgu.Q6Cgqma0ShhFUrAgjv.X1fKUI/N3Ri', 5, 'student', NULL, '2018-12-04 04:10:24', '2018-12-04 04:10:24', '088123456789'),
(74, '5115100029', '$2y$10$JiRyIAdN8/z50aV/sUYz1OCIBlLUr8/4M5GIceuM9Wqjcuat21hIa', 6, 'student', '6uxe7dBdhbcztbnhuywNEfNVizXPR30DU3n43nOGNzlJ2tdf9EIjBhOdcI3o', '2018-12-04 07:36:54', '2018-12-04 07:36:54', '1234567890'),
(75, '5115100002', '$2y$10$nowCi7rSLmYIBnuN.5HWoeCoP/BofCQkGhi5itwIGHUNGd5hJG4z6', 7, 'student', 'SxziTJPsIpOiDhouu8OlY1IvLCOb5yei3TqLAp5WTmTroIhj8LJjiPpMr863', '2018-12-06 04:07:05', '2018-12-06 04:07:05', '081333004764'),
(76, 'dosen', '$2y$10$JiRyIAdN8/z50aV/sUYz1OCIBlLUr8/4M5GIceuM9Wqjcuat21hIa', 71, 'lecturer', 'zcJAYqSRx7rGTh6roKeaLKLyUlAZCLYce3tsgX9MaTiNS3XzFpTJExgOm0y5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0123456789'),
(77, '5115100054', '$2y$10$cPxxnW7.94lNgKby1nypAe7wXri4NJEeARleZ6Z9dtEQGvLVa6GdG', 8, 'student', 'UU6r4ykmmfASYiTVgQOuHQlev0fxrqVcYcvhVjwyk5DtLR0bbBPznQB6v1mi', '2018-12-08 03:14:20', '2018-12-08 03:14:20', '088123456789'),
(78, '87654321', '$2y$10$CJXtLSMrynJRc070e6hvB.qF1v3KnL4y.IbRQvqf3VVGah6v0sQ42', 73, 'lecturer', 'vZDfmSnln50x9ODHSPOly8YNzk2NtXV2sxkbscT3aTEf9piCCYfkqPHz5DI9', '2018-12-08 03:16:19', '2018-12-08 03:16:19', NULL),
(79, '5115100701', '$2y$10$.DUQZQcQKiFMnfPB8Oyvue5CClKKJUi0eugyWOJcQ2qt1gwOFqX8i', 9, 'student', 'hX4mmYsd9I0OAGfMh4Kz1Ut54SQnYgTWECLQlYsvbi11aVHYwjm4PnGF8gqG', '2018-12-08 03:18:02', '2018-12-08 03:20:11', '088123456789'),
(80, '5115100001', '$2y$10$.Pl9q7ryy71pdbMWLEkOXOWzNFeYG2I3N9HwdUuxvsU3/vTYNLHZa', 10, 'student', 'nI8Mph7DmrLONbdFqQaF1AHJpZerrWUb1XVqprKqZxhDAmfwaAzCq5DWLijF', '2018-12-08 09:10:49', '2018-12-08 09:10:49', '088123456789'),
(81, '5116100001', '$2y$10$2/M8MUiMq7HS0X3KVA8bA.qHhd3g9p2STKCAyWONw.JZvz0WkgUN.', 11, 'student', 'If8knZWE3I8ZTrMySLlHv3Ri7Lb2G6KMyZqO2hACE4BdNRv0DNByoCZjnLRt', '2018-12-08 09:12:58', '2018-12-08 09:12:58', '088123456789'),
(83, '1234567890', '$2y$10$0h/Fo3Xp6MM435U2VCvOw.z5cp9KXQGe8zYEFVNSf16BIdH.2Jq.2', 74, 'lecturer', 'a1BRT5lwmm7iFBWGhQUQKrDRhmq2OUYRneR6GlliACMFFI07cxKrAYeiZcFu', '2018-12-08 11:05:08', '2018-12-08 11:05:08', NULL),
(84, '5116100002', '$2y$10$mubgdrfcNoE7ZVFfyLiqVOnn7o/DhIDyj3cWy2nyaeaiXqzCZyVyC', 12, 'student', 'DXFe5PFDyhuDyWEY5hsPkUpQo149tb6SSsTMZiCQ36NyfGDJZfpD6wgiFmDY', '2018-12-08 22:27:02', '2018-12-08 22:27:51', '088123456789'),
(85, '5116100003', '$2y$10$SULwhMpO1ob9UTtMJSkS.O2IMHFCX/cNUX1Q5/lMWuPgdtd1Tpp7q', 13, 'student', NULL, '2018-12-08 22:27:13', '2018-12-08 22:27:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corporations`
--
ALTER TABLE `corporations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_progres`
--
ALTER TABLE `file_progres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_requests`
--
ALTER TABLE `group_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lecturers_nip_unique` (`nip`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corporations`
--
ALTER TABLE `corporations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_progres`
--
ALTER TABLE `file_progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `group_requests`
--
ALTER TABLE `group_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progres`
--
ALTER TABLE `progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
