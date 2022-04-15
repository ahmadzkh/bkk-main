-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2022 at 08:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkksatu`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_newalumni` (IN `id_alumni` CHAR(8), IN `jurusan` CHAR(8), IN `angkatan` CHAR(8), IN `user_id` CHAR(8), IN `nama` VARCHAR(200), IN `nis` CHAR(10), IN `nisn` CHAR(11), IN `password` TEXT, IN `created_at` TIMESTAMP, IN `updated_at` TIMESTAMP)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING ROLLBACK;
    START TRANSACTION;

INSERT INTO users(id, level_id, username, PASSWORD, created_at, updated_at)
VALUES(user_id, 'LVL00002', nis, password, created_at, updated_at) ;

INSERT INTO alumni(id_alumni, jurusan_id, angkatan_id, user_id, nama, nis, nisn, is_active, created_at, updated_at)
VALUES(alumni_id, jurusan, angkatan, user_id, nama, nis, nisn, 0, created_at, updated_at) ;

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_newmitra` (`id_mitra` CHAR(8), `user_id` CHAR(8), `id_kantor` CHAR(8), `kantor_pusat` TEXT, `jenis` VARCHAR(50), `nama` VARCHAR(200), `kategori` VARCHAR(200), `wilayah` VARCHAR(100), `no_telp` CHAR(15), `website` VARCHAR(100), `email` VARCHAR(100), `password` TEXT, `created_at` TIMESTAMP, `updated_at` TIMESTAMP)  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING ROLLBACK;
    START TRANSACTION;

    INSERT INTO mitra VALUES(id_mitra, user_id, kantor_pusat, jenis, nama, NULL, NULL, kategori, wilayah, no_telp, website, NULL, NULL, created_at, updated_at);
    
    INSERT INTO kantor VALUES(id_kantor, id_mitra, kantor_pusat, wilayah, no_telp);

    INSERT INTO users VALUES(user_id, 'LVL00003', NULL, email, NULL, password, created_at, updated_at);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_alumni` (IN `alumni_id` CHAR(8), IN `jurusan` CHAR(8), IN `angkatan` CHAR(8), IN `USER` CHAR(8), IN `nama` VARCHAR(200), IN `nis` CHAR(10), IN `nisn` CHAR(11), IN `user_password` TEXT, IN `created_at` TIMESTAMP, IN `updated_at` TIMESTAMP)  BEGIN
INSERT INTO users(id, level_id, username, PASSWORD, created_at, updated_at)
VALUES(
    USER,
    'LVL00002',
    nis,
    user_password,
    created_at,
    updated_at
) ;
INSERT INTO alumni(
        id_alumni,
        jurusan_id,
        angkatan_id,
        user_id,
        nama,
        nis,
        nisn,
        is_active,
    created_at,
    updated_at
    )
VALUES(
    alumni_id,
    jurusan,
    angkatan,
    USER,
    nama,
    nis,
    nisn,
    0,
    created_at,
    updated_at
) ;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `newidalumni` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
DECLARE kode_lama char(8) DEFAULT 'ALN00000';
DECLARE ambil_angka char(5) DEFAULT '00000';
DECLARE kode_baru varchar(8) DEFAULT 'ALN00000';
SELECT MAX(id_alumni) INTO kode_lama FROM alumni;
IF( kode_lama IS NULL ) THEN
    SET kode_lama = 'ALN00000';
ELSE
    SET kode_lama = kode_lama;
END IF;
SET ambil_angka = SUBSTR(kode_lama, 4, 5);
SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
SET kode_baru = CONCAT('ALN', ambil_angka);
RETURN kode_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidangkatan` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'ANG00000';
    DECLARE ambil_angka CHAR(5) DEFAULT '00000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'ANG00000';

    SELECT MAX(id_angkatan) INTO kode_lama FROM angkatan;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'ANG00000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 4, 5) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
    SET kode_baru = CONCAT('ANG', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidinformasi` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'INF00000';
    DECLARE ambil_angka CHAR(5) DEFAULT '00000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'INF00000';

    SELECT MAX(id_informasi) INTO kode_lama FROM informasi;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'INF00000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 4, 5) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
    SET kode_baru = CONCAT('INF', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidjurusan` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'JRSN0000';
    DECLARE ambil_angka CHAR(5) DEFAULT '0000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'JRSN0000';

    SELECT MAX(id_jurusan) INTO kode_lama FROM jurusan;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'JRSN0000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 5, 6) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 4, 0);
    SET kode_baru = CONCAT('JRSN', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidkantor` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'KTR00000';
    DECLARE ambil_angka CHAR(5) DEFAULT '00000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'KTR00000';

    SELECT MAX(id_kantor) INTO kode_lama FROM kantor;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'KTR00000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 4, 5) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
    SET kode_baru = CONCAT('KTR', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidloker` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'LKR00000';
    DECLARE ambil_angka CHAR(5) DEFAULT '00000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'LKR00000';

    SELECT MAX(id_lowongankerja) INTO kode_lama FROM lowongankerja;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'LKR00000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 4, 5) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
    SET kode_baru = CONCAT('LKR', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidmitra` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'MRA00000';
    DECLARE ambil_angka CHAR(5) DEFAULT '00000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'MRA00000';

    SELECT MAX(id_mitra) INTO kode_lama FROM mitra;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'MRA00000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 4, 5) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
    SET kode_baru = CONCAT('MRA', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidpelamar` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
    DECLARE kode_lama CHAR(8) DEFAULT 'PLM00000';
    DECLARE ambil_angka CHAR(5) DEFAULT '00000';
    DECLARE kode_baru VARCHAR(8) DEFAULT 'PLM00000';

    SELECT MAX(id_pelamar) INTO kode_lama FROM pelamar;

    IF(kode_lama IS NULL) THEN
        SET kode_lama = 'PLM00000'; 
    ELSE
        SET kode_lama = kode_lama ;
    END IF;

    SET ambil_angka = SUBSTR(kode_lama, 4, 5) ;
    SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
    SET kode_baru = CONCAT('PLM', ambil_angka); 

    RETURN kode_baru ;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newidtahap` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
DECLARE kode_lama char(8) DEFAULT 'THP00000';
DECLARE ambil_angka char(5) DEFAULT '00000';
DECLARE kode_baru varchar(8) DEFAULT 'THP00000';
SELECT MAX(id_tahap) INTO kode_lama FROM tahap;
IF( kode_lama IS NULL ) THEN
    SET kode_lama = 'THP00000';
ELSE
    SET kode_lama = kode_lama;
END IF;
SET ambil_angka = SUBSTR(kode_lama, 4, 5);
SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
SET kode_baru = CONCAT('THP', ambil_angka);
RETURN kode_baru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `newiduser` () RETURNS CHAR(8) CHARSET utf8mb4 BEGIN
DECLARE kode_lama char(8) DEFAULT 'USR00000';
DECLARE ambil_angka char(5) DEFAULT '00000';
DECLARE kode_baru varchar(8) DEFAULT 'USR00000';
SELECT MAX(id) INTO kode_lama FROM users;
IF( kode_lama IS NULL ) THEN
    SET kode_lama = 'USR00000';
ELSE
    SET kode_lama = kode_lama;
END IF;
SET ambil_angka = SUBSTR(kode_lama, 4, 5);
SET ambil_angka = LPAD(ambil_angka + 1, 5, 0);
SET kode_baru = CONCAT('USR', ambil_angka);
RETURN kode_baru;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(8) NOT NULL,
  `user_id` char(8) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `bio` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `user_id`, `nama`, `no_telp`, `bio`, `foto`) VALUES
('ADMIN001', 'USR00001', 'BOT ADMIN', '082121212121', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id_alumni` char(8) NOT NULL,
  `jurusan_id` char(8) NOT NULL,
  `angkatan_id` char(8) NOT NULL,
  `user_id` char(8) NOT NULL,
  `kerja_active` int(11) DEFAULT NULL,
  `kuliah_active` int(11) DEFAULT NULL,
  `usaha_active` int(11) DEFAULT NULL,
  `nama` varchar(200) NOT NULL,
  `nis` char(11) NOT NULL,
  `nisn` char(12) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` char(15) DEFAULT NULL,
  `berat_badan` int(4) DEFAULT NULL,
  `tinggi_badan` int(4) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id_alumni`, `jurusan_id`, `angkatan_id`, `user_id`, `kerja_active`, `kuliah_active`, `usaha_active`, `nama`, `nis`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `gender`, `agama`, `alamat`, `no_telp`, `berat_badan`, `tinggi_badan`, `bio`, `foto`, `is_active`, `created_at`, `updated_at`) VALUES
('ALN00001', 'JRSN0004', 'ANG00008', 'USR00002', NULL, NULL, NULL, 'AKBARNAMA TANGGUH DIPANTARA', '192010381', '0009878998', 'Bekasi', '2004-08-22', 'L', 'Islam', 'Bekasi Sentral Disrtrict', '082122121212', 56, 160, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, '1', '2022-03-30 12:04:54', '2022-03-30 12:05:16'),
('ALN00002', 'JRSN0002', 'ANG00008', 'USR00004', NULL, NULL, NULL, 'AHMAD ZAKY HUMAMI', '192010380', '0049717936', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 02:44:03', '2022-04-02 02:44:03'),
('ALN00003', 'JRSN0003', 'ANG00008', 'USR00005', NULL, NULL, NULL, 'FAHRU RAHMAN', '192010390', '0049717933', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 02:44:38', '2022-04-02 02:44:38'),
('ALN00004', 'JRSN0001', 'ANG00008', 'USR00006', NULL, NULL, NULL, 'AKWAN CAKRA TAJIMALELA', '192010382', '0049717932', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 02:45:17', '2022-04-02 02:45:17'),
('ALN00005', 'JRSN0005', 'ANG00008', 'USR00007', NULL, NULL, NULL, 'ABRAHAM PUTRA BERMAN SIMBOLON', '192010379', '0049717935', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-12 07:20:09', '2022-04-12 07:20:09'),
('ALN00006', 'JRSN0007', 'ANG00008', 'USR00008', NULL, NULL, NULL, 'ALIF IBNU MUMTAZ', '192010383', '0049717925', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 22:31:23', '2022-04-02 22:31:23'),
('ALN00007', 'JRSN0001', 'ANG00008', 'USR00009', NULL, NULL, NULL, 'ARIO PANDEGA PRATAMA', '192010384', '0049717989', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 22:33:59', '2022-04-02 22:33:59'),
('ALN00008', 'JRSN0002', 'ANG00008', 'USR00010', NULL, NULL, NULL, 'AZIZ MUTHOLIB', '192010385', '0049717230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 22:35:13', '2022-04-02 22:35:13'),
('ALN00009', 'JRSN0003', 'ANG00008', 'USR00011', NULL, NULL, NULL, 'AZZAHRA', '192010386', '0049717923', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 22:35:57', '2022-04-02 22:35:57'),
('ALN00010', 'JRSN0003', 'ANG00008', 'USR00012', NULL, NULL, NULL, 'EKA DWI SAPUTRA', '192010387', '0049717908', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2022-04-02 23:35:20', '2022-04-02 23:35:20'),
('ALN00011', 'JRSN0004', 'ANG00008', 'USR00016', NULL, NULL, NULL, 'FAHMI DAHLAN', '192010389', '0049717200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2022-04-12 14:21:49', '2022-04-12 07:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_direkomendasikan`
--

CREATE TABLE `alumni_direkomendasikan` (
  `alumni_id` char(8) NOT NULL,
  `rekomendasi_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumni_direkomendasikan`
--

INSERT INTO `alumni_direkomendasikan` (`alumni_id`, `rekomendasi_id`) VALUES
('ALN00002', 'REK00001'),
('ALN00004', 'REK00002');

-- --------------------------------------------------------

--
-- Table structure for table `alumni_mendaftar_pelamar`
--

CREATE TABLE `alumni_mendaftar_pelamar` (
  `alumni_id` char(8) NOT NULL,
  `pelamar_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id_angkatan` char(8) NOT NULL,
  `angkatan` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id_angkatan`, `angkatan`) VALUES
('ANG00001', '2014/2015'),
('ANG00002', '2015/2016'),
('ANG00003', '2016/2017'),
('ANG00004', '2017/2018'),
('ANG00005', '2018/2019'),
('ANG00006', '2019/2020'),
('ANG00007', '2020/2021'),
('ANG00008', '2021/2022');

-- --------------------------------------------------------

--
-- Stand-in structure for view `applicant_details`
-- (See below for the actual view)
--
CREATE TABLE `applicant_details` (
`id_alumni` char(8)
,`nama` varchar(200)
,`jurusan` varchar(100)
,`id_pelamar` char(8)
,`id_lowongankerja` char(8)
,`title_loker` varchar(255)
,`tanggal_kirim` date
);

-- --------------------------------------------------------

--
-- Table structure for table `data_nilai`
--

CREATE TABLE `data_nilai` (
  `id` int(11) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `semester_satu` int(3) NOT NULL,
  `semester_dua` int(3) NOT NULL,
  `semester_tiga` int(3) NOT NULL,
  `semester_empat` int(3) NOT NULL,
  `semester_lima` int(3) NOT NULL,
  `semester_enam` int(3) NOT NULL,
  `nilai_sekolah` int(3) NOT NULL,
  `nilai_praktek` int(3) NOT NULL,
  `nilai_ujian` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_nilai`
--

INSERT INTO `data_nilai` (`id`, `alumni_id`, `nama`, `semester_satu`, `semester_dua`, `semester_tiga`, `semester_empat`, `semester_lima`, `semester_enam`, `nilai_sekolah`, `nilai_praktek`, `nilai_ujian`) VALUES
(1, 'ALN00001', 'Matematika', 100, 97, 87, 78, 90, 80, 89, 88, 98),
(2, 'ALN00001', 'Bahasa Indonesia', 90, 99, 98, 78, 89, 88, 86, 98, 89),
(3, 'ALN00001', 'Bahasa Inggris', 87, 98, 78, 89, 86, 89, 96, 79, 93);

-- --------------------------------------------------------

--
-- Table structure for table `data_pekerjaan`
--

CREATE TABLE `data_pekerjaan` (
  `id` int(11) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `perusahaan` varchar(200) NOT NULL,
  `bidang` varchar(200) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `tahun_mulai` date NOT NULL,
  `tahun_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pekerjaan`
--

INSERT INTO `data_pekerjaan` (`id`, `alumni_id`, `perusahaan`, `bidang`, `jabatan`, `tahun_mulai`, `tahun_selesai`) VALUES
(1, 'ALN00001', 'PT. Production Tersakiti', 'Perfilman', 'Human Resource Department', '2012-03-01', '2014-03-01'),
(2, 'ALN00001', 'PT. Perasaan Terhalang', 'Emotional Damage', 'Sesuka', '2010-03-01', '2014-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `data_pendidikan`
--

CREATE TABLE `data_pendidikan` (
  `id` int(11) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `lembaga` varchar(200) NOT NULL,
  `jenis` varchar(150) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `gelar` varchar(100) NOT NULL,
  `tahun_lulus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pendidikan`
--

INSERT INTO `data_pendidikan` (`id`, `alumni_id`, `lembaga`, `jenis`, `fakultas`, `prodi`, `gelar`, `tahun_lulus`) VALUES
(1, 'ALN00001', 'Universitas Padjadjaran', 'Negri', 'Ilmu Komputer', 'Sistem Informasi', 'S.Ikom', '2014-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `data_prestasi`
--

CREATE TABLE `data_prestasi` (
  `id` int(11) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `peringkat` varchar(100) NOT NULL,
  `tingkat` varchar(150) NOT NULL,
  `penyelenggara` varchar(200) NOT NULL,
  `text` varchar(150) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_prestasi`
--

INSERT INTO `data_prestasi` (`id`, `alumni_id`, `nama`, `peringkat`, `tingkat`, `penyelenggara`, `text`, `foto`) VALUES
(1, 'ALN00001', 'Digital Siswa', '1', 'Kota', 'Wali Kota Bekasi', 'Lomba Bidang Rekayasa Perangkat Lunak Framework Codeigniter 3', 'sample-prestasi.png');

-- --------------------------------------------------------

--
-- Table structure for table `data_wirausaha`
--

CREATE TABLE `data_wirausaha` (
  `id` int(11) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` char(8) NOT NULL,
  `lowongankerja_id` char(8) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` char(8) NOT NULL,
  `admin_id` char(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `image_satu` varchar(255) DEFAULT NULL,
  `image_dua` varchar(255) DEFAULT NULL,
  `image_tiga` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `admin_id`, `title`, `slug`, `content`, `banner`, `image_satu`, `image_dua`, `image_tiga`, `created_at`, `updated_at`) VALUES
('INF00001', 'ADMIN001', 'Perekrutan PT Denso', 'perekrutan-pt-denso', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'simple.jpg', 'simple.jpg', 'simple.jpg', '2022-04-13 06:38:33', '2022-04-13 06:38:33'),
('INF00002', 'ADMIN001', 'Pengumuman Hasil Seleksi', 'pengumuman-hasil-seleksi', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 'simple.jpg', 'simple.jpg', 'simple.jpg', '2022-04-13 06:38:33', '2022-04-13 06:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mitra`
--

CREATE TABLE `jenis_mitra` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_mitra`
--

INSERT INTO `jenis_mitra` (`id`, `nama`, `value`) VALUES
(1, 'Perseroan Terbatas', 'PT.'),
(2, 'Perseroan Terbatas, Terbuka', 'P.T. Tbk.'),
(3, 'Perusahaan Perseroan', 'Persero'),
(4, 'Koperasi', 'Co-operati'),
(5, 'Perusahaan Umum', 'PERUM');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` char(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `akronim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama`, `akronim`) VALUES
('JRSN0001', 'TEKNIK PERMESINAN', 'TP'),
('JRSN0002', 'TEKNIK PENGELASAN', 'TPL'),
('JRSN0003', 'TEKNIK KENDARAAN RINGAN OTOMOTIF', 'TKR'),
('JRSN0004', 'REKAYASA PERANGKAT LUNAK', 'RPL'),
('JRSN0005', 'MULTIMEDIA', 'MM'),
('JRSN0006', 'TEKNIK KOMPUTER DAN JARINGAN', 'TKJ'),
('JRSN0007', 'AKUNTANSI', 'AK'),
('JRSN0008', 'TATA BUSANA', 'TB');

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id_kantor` char(8) NOT NULL,
  `mitra_id` char(8) NOT NULL,
  `alamat` text NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `no_telp` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id_kantor`, `mitra_id`, `alamat`, `wilayah`, `no_telp`) VALUES
('KTR00001', 'MRA00001', 'Jl.H Wibowo Mukti no.32', 'Jakarta', '021 34853423'),
('KTR00002', 'MRA00001', 'Jl. Ki. H Dewangga no.12 Jawa Barat', 'Bekasi', '021 8374242');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` char(8) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama`, `keterangan`) VALUES
('LVL00001', 'Administrator', ''),
('LVL00002', 'Alumni', ''),
('LVL00003', 'Mitra', '');

-- --------------------------------------------------------

--
-- Table structure for table `log_lowongankerja`
--

CREATE TABLE `log_lowongankerja` (
  `id_lowongankerja` char(8) NOT NULL,
  `id_mitra` char(8) NOT NULL,
  `tanggal` date NOT NULL,
  `aksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_lowongankerja`
--

INSERT INTO `log_lowongankerja` (`id_lowongankerja`, `id_mitra`, `tanggal`, `aksi`) VALUES
('LKR00001', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00002', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00003', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00004', 'MRA00002', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00001', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00002', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00003', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00004', 'MRA00002', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00001', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00001', 'MRA00001', '2022-04-14', 'Lowongan berhasil diperbarui'),
('LKR00002', 'MRA00001', '2022-04-15', 'Lowongan berhasil diperbarui');

-- --------------------------------------------------------

--
-- Table structure for table `lowongankerja`
--

CREATE TABLE `lowongankerja` (
  `id_lowongankerja` char(8) NOT NULL,
  `mitra_id` char(8) NOT NULL,
  `jurusan_id` char(8) NOT NULL,
  `kantor_id` char(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `posisi` varchar(200) NOT NULL,
  `kuota` int(6) NOT NULL,
  `gaji` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis_pekerjaan` varchar(200) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `kedaluwarsa` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lowongankerja`
--

INSERT INTO `lowongankerja` (`id_lowongankerja`, `mitra_id`, `jurusan_id`, `kantor_id`, `title`, `slug`, `posisi`, `kuota`, `gaji`, `deskripsi`, `jenis_pekerjaan`, `kategori`, `banner`, `status`, `kedaluwarsa`, `created_at`, `updated_at`) VALUES
('LKR00001', 'MRA00001', 'JRSN0001', 'KTR00001', 'Dicari part time kerja ngoding', 'dicari-part-time-kerja-ngoding', 'IT Support', 50, 8000000, '<p>Kami sedang mencari karyawan baru untuk perushaan kami.</p><p>Yang akan dilakukan</p><ul><li>Membantu membuat projek</li><li>Membantu mendesain projek</li></ul><p>Jika berminat, maka daftarkan diri anda sekarang.</p>', 'Part-Time', 'Information and Technologies', 'Aqsa Japanese-1648482497.jpg', '1', '2022-04-10', '2022-03-27 17:00:00', NULL),
('LKR00002', 'MRA00001', 'JRSN0001', 'KTR00001', 'Ngoprek Pisang Goreng', 'ngoprek-pisang-goreng', 'Tukang Sayur', 50, 2000000, '<p>&nbsp;</p>', 'Full-Time', 'Automotive', 'Free fire-1648485190.jpeg', '0', '2022-04-30', '2022-03-27 17:00:00', NULL),
('LKR00003', 'MRA00001', 'JRSN0001', 'KTR00001', 'Pawang hujan dicari segera', 'pawang-hujan-dicari-segera', 'Pawang Hujan Maintenance', 5, 20000000, '<p>Dicari segera pawang hujan</p><p>Dengan tidak punya keahlian gapapa kok.</p><p><strong>Langsung JOIN!!!!</strong></p>', 'Full-Time', 'Software Engineering', 'aqsa-1648525276.jpg', '0', '2022-09-23', '2022-03-28 17:00:00', NULL),
('LKR00004', 'MRA00002', 'JRSN0001', 'KTR00001', 'Dicari polisi', 'dicari-polisi', 'AKBP', 32, 5000000, '<p>&nbsp;</p>', 'Part-Time', 'Software Engineering', 'cepe-1648827613.jpg', '1', '2022-04-13', '2022-03-31 17:00:00', NULL);

--
-- Triggers `lowongankerja`
--
DELIMITER $$
CREATE TRIGGER `log_del_lowongankerja` BEFORE DELETE ON `lowongankerja` FOR EACH ROW BEGIN
INSERT INTO log_lowongankerja VALUES(OLD.id_lowongankerja, OLD.mitra_id, NOW(), 'Lowongan berhasil dihapus');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_ins_lowongankerja` AFTER INSERT ON `lowongankerja` FOR EACH ROW BEGIN
INSERT INTO log_lowongankerja VALUES(NEW.id_lowongankerja, NEW.mitra_id, NOW(), 'Lowongan berhasil ditambahkan');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_upd_lowongankerja` AFTER UPDATE ON `lowongankerja` FOR EACH ROW BEGIN
INSERT INTO log_lowongankerja VALUES(NEW.id_lowongankerja, NEW.mitra_id, NOW(), 'Lowongan berhasil diperbarui');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` char(8) NOT NULL,
  `user_id` char(8) NOT NULL,
  `kantor_pusat` text NOT NULL,
  `jenis` enum('PT','CV') NOT NULL,
  `nama` varchar(200) NOT NULL,
  `visi` varchar(255) DEFAULT NULL,
  `misi` varchar(255) DEFAULT NULL,
  `kategori` varchar(200) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `website` varchar(100) NOT NULL,
  `overview` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `user_id`, `kantor_pusat`, `jenis`, `nama`, `visi`, `misi`, `kategori`, `wilayah`, `no_telp`, `website`, `overview`, `foto`, `created_at`, `updated_at`) VALUES
('MRA00001', 'USR00003', 'Jl.H Wibowo Mukti no.32', 'PT', 'BOT MITRA', NULL, NULL, 'Fashion', 'Jakarta', '02106542312', 'www.optic.com', '<p>Halo Semua!!!</p>', 'default-company.png', '2022-04-03 07:43:20', '2022-04-03 07:43:23'),
('MRA00002', 'USR00013', '', 'PT', 'TOYOTA INDONESIA', NULL, NULL, 'Industri atau Manufaktur', 'Jakarta', '02121084677', 'https://www.twitch.tv', '<p>Halo Semua!!!</p>', 'default-company.png', '2022-04-03 07:33:47', '2022-04-03 07:33:47'),
('MRA00003', 'USR00014', '', 'PT', 'OPTIC GAMING', NULL, NULL, 'Industri atau Manufaktur', 'Jakarta', '02134853444', 'https://www.opticgaming.tv/', '<p>Halo Semua!!!</p>', 'default-company.png', '2022-04-03 08:23:50', '2022-04-03 08:23:50'),
('MRA00004', 'USR00015', '', 'PT', 'DENSO INDONESIA', NULL, NULL, 'Industri atau Manufaktur', 'Jakarta', '(021) 54564894', 'http://www.denso.co.id/hrdenso/', '<p>Halo Semua!!!</p>', 'default-company.png', '2022-04-03 08:28:31', '2022-04-03 08:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` char(8) NOT NULL,
  `lowongankerja_id` char(8) NOT NULL,
  `tanggal_kirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan`
--

CREATE TABLE `persyaratan` (
  `id_persyaratan` int(11) NOT NULL,
  `lowongankerja_id` char(8) NOT NULL,
  `text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persyaratan`
--

INSERT INTO `persyaratan` (`id_persyaratan`, `lowongankerja_id`, `text`) VALUES
(1, 'LKR00001', 'Dapat mengoperasikan ms office'),
(2, 'LKR00001', 'Dapat mengoperasikan ms office'),
(3, 'LKR00001', 'Dapat mengoperasikan ms office'),
(4, 'LKR00002', 'Bisa Ngopi'),
(5, 'LKR00002', 'Bisa makan'),
(6, 'LKR00002', 'Bisa minum'),
(7, 'LKR00003', 'Bisa manggil hujan'),
(8, 'LKR00003', 'Bisa matiin hujan'),
(9, 'LKR00003', 'Bisa manggil awans'),
(10, 'LKR00003', 'Bisa ganti G4S'),
(16, 'LKR00004', 'Dapat mengoperasikan ms office'),
(17, 'LKR00004', 'bisa ngoding'),
(18, 'LKR00004', 'Bisa manggil awans');

-- --------------------------------------------------------

--
-- Stand-in structure for view `recommendations`
-- (See below for the actual view)
--
CREATE TABLE `recommendations` (
);

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_rekomendasi` char(8) NOT NULL,
  `lowongankerja_id` char(8) NOT NULL,
  `judul` varchar(80) NOT NULL,
  `text` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id_rekomendasi`, `lowongankerja_id`, `judul`, `text`, `status`, `created_at`, `updated_at`) VALUES
('REK00001', 'LKR00004', 'Rekomendasi untuk anda', 'Ini adalah lowongan pekerjaan yang cocok untuk anda!!!', '1', '2022-04-10 17:00:00', '2022-04-11 09:05:19'),
('REK00002', 'LKR00003', 'Rekomendasi untuk anda', 'Selamat Melia Chandya!!!', '0', '2022-04-10 17:00:00', '2022-04-11 09:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `seleksi_pelamar`
--

CREATE TABLE `seleksi_pelamar` (
  `pelamar_id` char(8) NOT NULL,
  `tahap_id` char(8) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `nilai` int(3) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_lamaran_kerja`
--

CREATE TABLE `surat_lamaran_kerja` (
  `id_slp` char(8) NOT NULL,
  `alumni_id` char(8) NOT NULL,
  `lowongankerja_id` char(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahap`
--

CREATE TABLE `tahap` (
  `id_tahap` char(8) NOT NULL,
  `lowongankerja_id` char(8) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tahap_ke` char(50) NOT NULL,
  `tanggal_seleksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahap`
--

INSERT INTO `tahap` (`id_tahap`, `lowongankerja_id`, `nama`, `tahap_ke`, `tanggal_seleksi`, `keterangan`, `status`) VALUES
('THP00001', 'LKR00001', 'Tes Fisik', '1', '2022-04-01', 'Ini adalah tahapan ke 1 yang akan dilakukan pada 2022-04-01', '0'),
('THP00002', 'LKR00001', 'Tes Psikiater', '2', '2022-04-07', 'Ini adalah tahapan ke 2 yang akan dilakukan pada 2022-04-07', '0'),
('THP00003', 'LKR00002', 'Tes Pemukulan', '1', '2022-05-10', 'Ini adalah tahapan ke 1 yang akan dilakukan pada 2022-05-10', '0'),
('THP00004', 'LKR00002', 'Tes Lari 1000km', '2', '2022-05-31', 'Ini adalah tahapan ke 2 yang akan dilakukan pada 2022-05-31', '0'),
('THP00005', 'LKR00003', 'Tes Manggil Awans', '1', '2022-12-04', 'Ini adalah tahapan ke 1 yang akan dilakukan pada 2022-12-04', '0'),
('THP00006', 'LKR00003', 'Tes Manggil Hujan', '2', '2022-12-31', 'Ini adalah tahapan ke 2 yang akan dilakukan pada 2022-12-31', '0'),
('THP00007', 'LKR00003', 'Tes Psikiater', '3', '2023-01-26', 'Ini adalah tahapan ke 3 yang akan dilakukan pada 2023-01-26', '0'),
('THP00008', 'LKR00004', 'Tes Manggil Hujanssadasd', '1', '2022-05-07', 'Ini adalah tahapan ke 1 yang akan dilakukan pada 2022-05-07', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(8) NOT NULL,
  `level_id` char(8) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_verified_at` date DEFAULT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level_id`, `username`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
('USR00001', 'LVL00001', 'admin', 'admin@gmail.com', NULL, '$2a$12$zz7F2UhjZtWafzM30Q.ipuB/ZaNZvG.aF4knccVje1fdnENrm099e', NULL, NULL),
('USR00002', 'LVL00002', '192010381', 'akbartangguh@gmail.com', NULL, '$2y$10$zZB6XReJBB4cu4ekIhDPpOphY6HwqwgXhd6Xu/9en7VLWg3/9CyQ6', NULL, '2022-03-30 00:36:30'),
('USR00003', 'LVL00003', NULL, 'botmitra@mitra.com', NULL, '$2a$12$5XY4fuzPW9E32FbJ0TZpbOWM21Vfg27eKKrMCucQeJn1fmvHXwrz.', NULL, NULL),
('USR00004', 'LVL00002', '192010380', NULL, NULL, '$2y$10$Y9iWyPLuvishBKnbVb2Nx.4xaa6.GR/OnC1Lwnuv3ckhV/vSSfIZW', '2022-04-02 02:44:03', '2022-04-02 02:44:03'),
('USR00005', 'LVL00002', '192010390', NULL, NULL, '$2y$10$2Q0G0zZc16KmuUa9et.nL.FMK3ym89Uug0mWGtybync.wdYCFl8iG', '2022-04-02 02:44:38', '2022-04-02 02:44:38'),
('USR00006', 'LVL00002', '192010382', NULL, NULL, '$2y$10$ZWKecgntPklqU9QGRq5WAONfNmQv9wKkd4i.9mUgTzPp09SwseAda', '2022-04-02 02:45:17', '2022-04-02 02:45:17'),
('USR00007', 'LVL00002', '192010379', NULL, NULL, '$2y$10$HA5CNnHtiqljoiZQ3z/vZ.H4qSsBf1ohL1cRG1JPvXazl7pJS/cJ.', '2022-04-02 22:27:12', '2022-04-12 07:20:09'),
('USR00008', 'LVL00002', '192010383', NULL, NULL, '$2y$10$EqBjs.U7drIE64turwhgge3Gr8weHZ1uvv0vmdOCKl9j1yTKoKQZe', '2022-04-02 22:31:23', '2022-04-02 22:31:23'),
('USR00009', 'LVL00002', '192010385', NULL, NULL, '$2y$10$mmJlcgf/q6wzSCc09yvjdeAq7xmvtccZJfYeu6qbal6jTokw0fMma', '2022-04-02 22:33:59', '2022-04-02 22:33:59'),
('USR00010', 'LVL00002', '192010385', NULL, NULL, '$2y$10$yW0Mp5Oa70nwY63DCw648u.//hSDuyCJNSrG7XqUOv23e1qgeLkbq', '2022-04-02 22:35:13', '2022-04-02 22:35:13'),
('USR00011', 'LVL00002', '192010386', NULL, NULL, '$2y$10$u7HFUAcNmF5xp8dQyRFr.eO/piBRsniNZlIbzTtLrGQFBonDIvyga', '2022-04-02 22:35:57', '2022-04-02 22:35:57'),
('USR00012', 'LVL00002', '192010387', NULL, NULL, '$2y$10$AvgGZeS.z33gYeBE0TvbG.0Zu8BWN8RnV8qEjCo6791EMc9et4s2e', '2022-04-02 23:35:20', '2022-04-02 23:35:20'),
('USR00013', 'LVL00003', NULL, 'toyotaindo@toyota.com', NULL, '$2a$12$zz7F2UhjZtWafzM30Q.ipuB/ZaNZvG.aF4knccVje1fdnENrm099e', '2022-04-03 07:33:47', '2022-04-03 07:33:47'),
('USR00014', 'LVL00003', NULL, 'opticgaming@gaming.com', NULL, '$2y$10$52iJGAbpXk94tV2pk6QEMOe9ndqcjc8MRXdRw4aChkQT6woYPOYXq', '2022-04-03 08:23:50', '2022-04-03 08:23:50'),
('USR00015', 'LVL00003', NULL, 'denso@denso.co.id', NULL, '$2y$10$/UGvkrxRk6mPrxDlpmdDd.VCoZtc7AIVvWT8eU7Q3kiMch9MPsr8W', '2022-04-03 08:28:31', '2022-04-03 08:28:31'),
('USR00016', 'LVL00002', '192010389', NULL, NULL, '$2y$10$xYciLOtKY8kYOrh8C4Bmruq0j0Vh4Dl/FQ94rr3nc3XNs.AHdME5q', '2022-04-12 14:21:49', '2022-04-12 07:23:06');

-- --------------------------------------------------------

--
-- Structure for view `applicant_details`
--
DROP TABLE IF EXISTS `applicant_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `applicant_details`  AS SELECT `alumni`.`id_alumni` AS `id_alumni`, `alumni`.`nama` AS `nama`, `jurusan`.`akronim` AS `jurusan`, `pelamar`.`id_pelamar` AS `id_pelamar`, `lowongankerja`.`id_lowongankerja` AS `id_lowongankerja`, `lowongankerja`.`title` AS `title_loker`, `pelamar`.`tanggal_kirim` AS `tanggal_kirim` FROM ((((`jurusan` join `alumni` on(`jurusan`.`id_jurusan` = `alumni`.`jurusan_id`)) join `alumni_mendaftar_pelamar` on(`alumni_mendaftar_pelamar`.`alumni_id` = `alumni`.`id_alumni`)) join `pelamar` on(`alumni_mendaftar_pelamar`.`pelamar_id` = `pelamar`.`id_pelamar`)) join `lowongankerja` on(`pelamar`.`lowongankerja_id` = `lowongankerja`.`id_lowongankerja`)) ;

-- --------------------------------------------------------

--
-- Structure for view `recommendations`
--
DROP TABLE IF EXISTS `recommendations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recommendations`  AS SELECT `rekomendasi`.`id_rekomendasi` AS `id_rekomendasi`, `alumni`.`id_alumni` AS `id_alumni`, `alumni`.`nama` AS `alumni`, `mitra`.`id_mitra` AS `id_mitra`, `mitra`.`nama` AS `perusahaan`, `lowongankerja`.`id_lowongankerja` AS `id_lowongankerja`, `lowongankerja`.`title` AS `title_loker`, `rekomendasi`.`title` AS `title_rekomendasi`, `rekomendasi`.`text` AS `text`, `lowongankerja`.`kedaluwarsa` AS `kedaluwarsa` FROM ((((`alumni_direkomendasikan` join `rekomendasi` on(`alumni_direkomendasikan`.`rekomendasi_id` = `rekomendasi`.`id_rekomendasi`)) join `alumni` on(`alumni_direkomendasikan`.`alumni_id` = `alumni`.`id_alumni`)) join `lowongankerja` on(`rekomendasi`.`lowongankerja_id` = `lowongankerja`.`id_lowongankerja`)) join `mitra` on(`mitra`.`id_mitra` = `lowongankerja`.`mitra_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id_alumni`),
  ADD KEY `id_akun` (`user_id`),
  ADD KEY `id_jurusan` (`jurusan_id`),
  ADD KEY `id_angkatan` (`angkatan_id`);

--
-- Indexes for table `alumni_direkomendasikan`
--
ALTER TABLE `alumni_direkomendasikan`
  ADD KEY `id_alumni` (`alumni_id`),
  ADD KEY `id_rekomendasi` (`rekomendasi_id`);

--
-- Indexes for table `alumni_mendaftar_pelamar`
--
ALTER TABLE `alumni_mendaftar_pelamar`
  ADD KEY `id_alumni` (`alumni_id`),
  ADD KEY `id_pelamar` (`pelamar_id`);

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `data_nilai`
--
ALTER TABLE `data_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumni` (`alumni_id`);

--
-- Indexes for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumni` (`alumni_id`);

--
-- Indexes for table `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumni` (`alumni_id`);

--
-- Indexes for table `data_prestasi`
--
ALTER TABLE `data_prestasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumni` (`alumni_id`);

--
-- Indexes for table `data_wirausaha`
--
ALTER TABLE `data_wirausaha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumni_id` (`alumni_id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `id_lowongan_kerja` (`lowongankerja_id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`),
  ADD KEY `id_admin` (`admin_id`);

--
-- Indexes for table `jenis_mitra`
--
ALTER TABLE `jenis_mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id_kantor`),
  ADD KEY `id_mitra` (`mitra_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `lowongankerja`
--
ALTER TABLE `lowongankerja`
  ADD PRIMARY KEY (`id_lowongankerja`),
  ADD KEY `id_jurusan` (`jurusan_id`),
  ADD KEY `id_mitra` (`mitra_id`),
  ADD KEY `kantor_id` (`kantor_id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`),
  ADD KEY `lowongankerja_id` (`lowongankerja_id`);

--
-- Indexes for table `persyaratan`
--
ALTER TABLE `persyaratan`
  ADD PRIMARY KEY (`id_persyaratan`),
  ADD KEY `id_lowongan_kerja` (`lowongankerja_id`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_lowongan_kerja` (`lowongankerja_id`);

--
-- Indexes for table `seleksi_pelamar`
--
ALTER TABLE `seleksi_pelamar`
  ADD KEY `id_pelamar` (`pelamar_id`),
  ADD KEY `id_tahap` (`tahap_id`),
  ADD KEY `id_alumni` (`alumni_id`);

--
-- Indexes for table `surat_lamaran_kerja`
--
ALTER TABLE `surat_lamaran_kerja`
  ADD PRIMARY KEY (`id_slp`),
  ADD KEY `id_alumni` (`alumni_id`),
  ADD KEY `id_lowongan_kerja` (`lowongankerja_id`);

--
-- Indexes for table `tahap`
--
ALTER TABLE `tahap`
  ADD PRIMARY KEY (`id_tahap`),
  ADD KEY `id_lowongan_kerja` (`lowongankerja_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_nilai`
--
ALTER TABLE `data_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_prestasi`
--
ALTER TABLE `data_prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_wirausaha`
--
ALTER TABLE `data_wirausaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_mitra`
--
ALTER TABLE `jenis_mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `persyaratan`
--
ALTER TABLE `persyaratan`
  MODIFY `id_persyaratan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`angkatan_id`) REFERENCES `angkatan` (`id_angkatan`),
  ADD CONSTRAINT `alumni_ibfk_2` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `alumni_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `alumni_direkomendasikan`
--
ALTER TABLE `alumni_direkomendasikan`
  ADD CONSTRAINT `alumni_direkomendasikan_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`),
  ADD CONSTRAINT `alumni_direkomendasikan_ibfk_2` FOREIGN KEY (`rekomendasi_id`) REFERENCES `rekomendasi` (`id_rekomendasi`);

--
-- Constraints for table `alumni_mendaftar_pelamar`
--
ALTER TABLE `alumni_mendaftar_pelamar`
  ADD CONSTRAINT `alumni_mendaftar_pelamar_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`),
  ADD CONSTRAINT `alumni_mendaftar_pelamar_ibfk_2` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`id_pelamar`);

--
-- Constraints for table `data_nilai`
--
ALTER TABLE `data_nilai`
  ADD CONSTRAINT `data_nilai_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`);

--
-- Constraints for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  ADD CONSTRAINT `data_pekerjaan_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`);

--
-- Constraints for table `data_pendidikan`
--
ALTER TABLE `data_pendidikan`
  ADD CONSTRAINT `data_pendidikan_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`);

--
-- Constraints for table `data_prestasi`
--
ALTER TABLE `data_prestasi`
  ADD CONSTRAINT `data_prestasi_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`);

--
-- Constraints for table `data_wirausaha`
--
ALTER TABLE `data_wirausaha`
  ADD CONSTRAINT `data_wirausaha_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`);

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_ibfk_1` FOREIGN KEY (`lowongankerja_id`) REFERENCES `lowongankerja` (`id_lowongankerja`);

--
-- Constraints for table `informasi`
--
ALTER TABLE `informasi`
  ADD CONSTRAINT `informasi_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `kantor`
--
ALTER TABLE `kantor`
  ADD CONSTRAINT `kantor_ibfk_1` FOREIGN KEY (`mitra_id`) REFERENCES `mitra` (`id_mitra`);

--
-- Constraints for table `lowongankerja`
--
ALTER TABLE `lowongankerja`
  ADD CONSTRAINT `lowongankerja_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `lowongankerja_ibfk_2` FOREIGN KEY (`mitra_id`) REFERENCES `mitra` (`id_mitra`);

--
-- Constraints for table `mitra`
--
ALTER TABLE `mitra`
  ADD CONSTRAINT `mitra_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`lowongankerja_id`) REFERENCES `lowongankerja` (`id_lowongankerja`);

--
-- Constraints for table `persyaratan`
--
ALTER TABLE `persyaratan`
  ADD CONSTRAINT `persyaratan_ibfk_1` FOREIGN KEY (`lowongankerja_id`) REFERENCES `lowongankerja` (`id_lowongankerja`);

--
-- Constraints for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD CONSTRAINT `rekomendasi_ibfk_2` FOREIGN KEY (`lowongankerja_id`) REFERENCES `lowongankerja` (`id_lowongankerja`);

--
-- Constraints for table `seleksi_pelamar`
--
ALTER TABLE `seleksi_pelamar`
  ADD CONSTRAINT `seleksi_pelamar_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`),
  ADD CONSTRAINT `seleksi_pelamar_ibfk_2` FOREIGN KEY (`pelamar_id`) REFERENCES `pelamar` (`id_pelamar`),
  ADD CONSTRAINT `seleksi_pelamar_ibfk_3` FOREIGN KEY (`tahap_id`) REFERENCES `tahap` (`id_tahap`);

--
-- Constraints for table `surat_lamaran_kerja`
--
ALTER TABLE `surat_lamaran_kerja`
  ADD CONSTRAINT `surat_lamaran_kerja_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id_alumni`),
  ADD CONSTRAINT `surat_lamaran_kerja_ibfk_2` FOREIGN KEY (`lowongankerja_id`) REFERENCES `lowongankerja` (`id_lowongankerja`);

--
-- Constraints for table `tahap`
--
ALTER TABLE `tahap`
  ADD CONSTRAINT `tahap_ibfk_2` FOREIGN KEY (`lowongankerja_id`) REFERENCES `lowongankerja` (`id_lowongankerja`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
