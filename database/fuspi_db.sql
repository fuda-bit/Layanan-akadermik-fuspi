-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2026 at 12:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuspi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas_mahasiswa`
--

CREATE TABLE `berkas_mahasiswa` (
  `id` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `kategori_berkas` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('Pending','Disetujui','Ditolak') DEFAULT 'Pending',
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2026_09_27_002528_create_pengajuan_surats_table', 1),
(3, '2026_09_28_000000_add_observasi_fields_to_pengajuan_surats_table', 2),
(4, '2026_09_28_120000_add_surat_disahkan_to_pengajuan_surats_table', 3),
(5, '2026_09_28_180000_add_validasi_berkas_to_pengajuan_surats_table', 4),
(6, '2026_09_28_220000_add_data_surat_to_pengajuan_surats_table', 5),
(7, '2026_09_29_010000_add_identitas_mahasiswa_to_pengajuan_surats_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surats`
--

CREATE TABLE `pengajuan_surats` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_pengajuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8mb4_unicode_ci,
  `tujuan_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_skripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_penelitian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ukt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_sk_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `tanggal_pengajuan` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dosen_pembimbing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mata_kuliah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_disahkan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi_ukt` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi_sk_ortu` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_surat` json DEFAULT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `semester` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_surats`
--

INSERT INTO `pengajuan_surats` (`id`, `nomor_pengajuan`, `nama_mahasiswa`, `nim`, `email`, `prodi`, `jenis_layanan`, `keperluan`, `tujuan_surat`, `judul_skripsi`, `tempat_penelitian`, `file_ukt`, `file_sk_ortu`, `file_pendukung`, `status`, `tanggal_pengajuan`, `created_at`, `updated_at`, `dosen_pembimbing`, `mata_kuliah`, `surat_disahkan`, `validasi_ukt`, `validasi_sk_ortu`, `data_surat`, `tempat_lahir`, `tanggal_lahir`, `semester`) VALUES
(4, 'FUSPI/2026/0001', 'REZA', '23130087', 'reza34@gmail.com', 'Aqidah dan Filsafat Islam', 'aktif_kuliah_tunjangan_ortu', 'Persyaratan Tunjangan Anak', NULL, NULL, NULL, 'dokumen/ukt/UKT_1790603928_ChAfG0BGRR.pdf', 'dokumen/sk_ortu/SK_ORTU_1790603928_d9eD4awx3A.pdf', NULL, 'diajukan', '2026-09-28 13:58:48', '2026-09-28 06:58:48', '2026-09-28 18:14:44', NULL, NULL, NULL, 'valid', 'valid', '{\"nomor_surat\": \"004/Un.17/F.III/PP.00.9/09/2026\", \"nip_orang_tua\": \"19740205200003000100\", \"tanggal_surat\": \"2026-09-29\", \"nama_orang_tua\": \"Fahrezi, S.Pd\", \"tahun_akademik\": \"2026/2027\", \"pangkat_orang_tua\": \"Pembina IV/a\", \"semester_akademik\": \"Ganjil\", \"instansi_orang_tua\": \"Kanwil Kementerian Agama Provinsi Banten\"}', 'Serang', '2004-07-14', '5(Lima)'),
(5, 'FUSPI/2026/0002', 'Fahrul', '23130087', 'fahrul23@gmail.com', 'Ilmu Hadis', 'magang', 'Magang di KUA Kecamatan Serang dari tanggal 14 April 2026 s.d 14 Mei 2026', 'Kepala KUA Kecamatan Serang', NULL, NULL, 'dokumen/ukt/UKT_1790609331_ZQLv5VVrIr.pdf', NULL, NULL, 'selesai', '2026-09-28 15:28:51', '2026-09-28 08:28:51', '2026-09-28 18:39:29', 'Repa Hudan, M.A.', NULL, 'surat-disahkan/EaiTAVAULe4MFKOPMCBSLHlxzyJWKFVglpT7WAZY.pdf', 'valid', NULL, '{\"nomor_surat\": \"001/Un.17/F.III/PP.00.9/09/2026\", \"tanggal_mulai\": \"2026-04-14\", \"tanggal_surat\": \"2026-09-22\", \"tanggal_selesai\": \"2026-05-14\"}', 'Serang', '2007-02-05', '5(Lima)'),
(6, 'FUSPI/2026/0003', 'ghufron', '20130078', 'gufron562@gmail.com', 'Ilmu Al-Qur\'an dan Tafsir', 'magang', 'Magang sebagai wahana menempa jati diri menuju pengalaman yang berharga', 'Kepala KUA Kecamatan Serang', NULL, NULL, 'dokumen/ukt/UKT_1790634747_zsKTrcIDsD.pdf', NULL, NULL, 'diajukan', '2026-09-28 22:32:27', '2026-09-28 15:32:27', '2026-09-28 15:41:02', 'Repa Hudan, M.A.', NULL, NULL, 'valid', NULL, '{\"nomor_surat\": \"003/Un.17/F.III/PP.00.9/09/2026\", \"tanggal_mulai\": \"2026-10-05\", \"tanggal_surat\": \"2026-09-29\", \"tanggal_selesai\": \"2026-11-10\"}', 'Serang', '2005-07-28', '5(Lima)'),
(7, 'FUSPI/2026/0004', 'Agus Indana', '25130007', 'indana56@gmail.com', 'Ilmu Al-Qur\'an dan Tafsir', 'penelitian', NULL, 'Direktur pascasarjana UIN SGD Bandung', 'Pengaruh Game Legend untuk meningkatkan kecerdasan Anak', 'Lab Komputer Pascasarjana UIN SGD Bandung', 'dokumen/ukt/UKT_1790647612_dGOdlhBYca.pdf', NULL, NULL, 'diajukan', '2026-09-29 02:06:52', '2026-09-28 19:06:52', '2026-09-28 19:08:00', NULL, NULL, NULL, 'valid', NULL, '{\"nomor_surat\": \"005/Un.17/F.III/PP.00.9/09/2026\", \"tanggal_surat\": \"2026-09-29\"}', 'Subang', '2006-01-11', '5(Lima)'),
(8, 'FUSPI/2026/0005', 'AZKA AULIA', '25130009', '45k4tea@gmail.com', 'Ilmu Al-Qur\'an dan Tafsir', 'rekomendasi', 'Menerima Beasiswa Cerdas Berprestasi', 'Ketua Baznas Provinsi Banten', NULL, NULL, 'dokumen/ukt/UKT_1790655037_r8gNjPB99X.pdf', NULL, NULL, 'selesai', '2026-09-29 04:10:37', '2026-09-28 21:10:37', '2026-09-29 01:47:10', NULL, NULL, 'surat-disahkan/HmLUQmb4JCUFKOwIqvwJx7qDmgUCTqEhXHAAlpGZ.pdf', 'valid', NULL, '{\"nomor_surat\": \"006/Un.17/F.III/PP.00.9/09/2026\", \"tanggal_surat\": \"2026-09-29\"}', 'Serang', '2006-08-13', '3(Tiga)');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_surat`
--

CREATE TABLE `permohonan_surat` (
  `id` int NOT NULL,
  `nomor_permohonan` varchar(30) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `jenis_surat` enum('aktif_kuliah','magang','observasi','penelitian','rekomendasi') NOT NULL,
  `keperluan` text NOT NULL,
  `bukti_ukt` varchar(255) DEFAULT NULL,
  `sk_ortu` varchar(255) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `judul_skripsi` text,
  `tempat_penelitian` varchar(255) DEFAULT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `nip_orang_tua` varchar(50) DEFAULT NULL,
  `pangkat_orang_tua` varchar(100) DEFAULT NULL,
  `instansi_orang_tua` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permohonan_surat`
--

INSERT INTO `permohonan_surat` (`id`, `nomor_permohonan`, `nim`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `semester`, `email`, `program_studi`, `jenis_surat`, `keperluan`, `bukti_ukt`, `sk_ortu`, `status`, `created_at`, `judul_skripsi`, `tempat_penelitian`, `nama_orang_tua`, `nip_orang_tua`, `pangkat_orang_tua`, `instansi_orang_tua`) VALUES
(10, 'REG-20260923-563', '25200156', 'ANDRE', 'Serang', '2005-06-14', '3', 'andre23@gmail.com', 'Aqidah dan Filsafat Islam', 'aktif_kuliah', 'Persyaratan Perpanjang BPJS', '20260923_142455_UKT_25200156_da2d691b.pdf', '', 'disetujui', '2026-09-23 14:24:55', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','mahasiswa') DEFAULT 'mahasiswa',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$12$VG6Fp5cb1e4wL9CI2K3LbOOI1mrJ4j8zGl3Qe5Ev9ULqYShcqHg0a', 'Administrator FUSPI', 'admin', '2026-09-20 04:50:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas_mahasiswa`
--
ALTER TABLE `berkas_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_surats`
--
ALTER TABLE `pengajuan_surats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengajuan_surats_nomor_pengajuan_unique` (`nomor_pengajuan`);

--
-- Indexes for table `permohonan_surat`
--
ALTER TABLE `permohonan_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_permohonan` (`nomor_permohonan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas_mahasiswa`
--
ALTER TABLE `berkas_mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengajuan_surats`
--
ALTER TABLE `pengajuan_surats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permohonan_surat`
--
ALTER TABLE `permohonan_surat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
