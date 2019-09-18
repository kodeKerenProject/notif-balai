-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2019 at 11:46 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.22-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `balaikeramik`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_sampling_plan`
--

CREATE TABLE `audit_sampling_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doc_maker` bigint(20) UNSIGNED DEFAULT NULL,
  `audit_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sampling_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bid_price`
--

CREATE TABLE `bid_price` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doc_maker` bigint(20) UNSIGNED DEFAULT NULL,
  `bid_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dok_importir`
--

CREATE TABLE `dok_importir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lengkap` int(11) DEFAULT NULL,
  `surat_permohonan_importer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_isian_dan_kuesioner_importer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_iui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_akte_notaris_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_tdp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_sert_patent_merek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penunjukkan_distributor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ilustrasi_pembubuhan_tanda_sni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel_daftar_tipe_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_dan_spesifikasi_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sert_smm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_pengawasan_iso_9001_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_dok_importir_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dok_manufaktur`
--

CREATE TABLE `dok_manufaktur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lengkap` int(11) DEFAULT NULL,
  `surat_permohonan_dari_manufaktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_isian_dan_kuesioner_manufaktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `izin_usaha_manufaktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sert_iso_9001` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_pengawasan_iso_9001_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagram_alir_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panduan_mutu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_induk_dok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_penunjukkan_wakil_manajemen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_letak_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_rute_pabrik_dari_bandara_terdekat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_dok_manufaktur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doc_maker` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_biling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_audit`
--

CREATE TABLE `jadwal_audit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apprv` int(11) DEFAULT NULL,
  `doc_maker` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_audit`
--

CREATE TABLE `laporan_audit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `auditor` bigint(20) UNSIGNED DEFAULT NULL,
  `dok_importir_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dok_manufaktur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tinjauan_pp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jadwal_audit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_hasil_sert`
--

CREATE TABLE `laporan_hasil_sert` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bapc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closed_ncr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_maker` bigint(20) UNSIGNED DEFAULT NULL,
  `laporan_hasil_sert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dok_lapSert` json DEFAULT NULL,
  `input_tt` json DEFAULT NULL,
  `input_evaluasi_tt` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(67, '2014_10_12_000000_create_users_table', 1),
(68, '2014_10_12_100000_create_password_resets_table', 1),
(69, '2019_06_12_061440_create_role_table', 1),
(70, '2019_06_12_070031_create_persyaratan_dok_dalam_negeri_table', 1),
(71, '2019_06_13_040948_create_persyaratan_dok_luar_negeri_table', 1),
(72, '2019_06_13_041148_create_notif_log_table', 1),
(73, '2019_06_13_041321_create_dok_importir_table', 1),
(74, '2019_06_13_044052_create_tinjauan_pp_table', 1),
(75, '2019_06_13_044237_create_laporan_audit_table', 1),
(76, '2019_06_13_045118_create_dok_manufaktur_table', 1),
(77, '2019_06_13_054608_create_audit_sampling_plan_table', 1),
(78, '2019_06_13_061923_create_produk_table', 1),
(79, '2019_06_13_062410_create_sert_table', 1),
(80, '2019_06_13_062535_create_mou_table', 1),
(81, '2019_06_13_063455_create_bid_price_table', 1),
(82, '2019_06_13_064538_create_invoice_table', 1),
(83, '2019_06_13_064851_create_laporan_hasil_sert_table', 1),
(84, '2019_06_13_083729_create_trigger', 1),
(85, '2019_06_21_080746_create_jadwal_audit_table', 1),
(86, '2019_06_28_024905_create_review_dok_importir_table', 1),
(87, '2019_06_28_024951_create_review_dok_manufaktur_table', 1),
(88, '2019_06_28_025010_create_review_tinjauan_pp_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mou`
--

CREATE TABLE `mou` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doc_maker` bigint(20) UNSIGNED DEFAULT NULL,
  `mou` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notif_log`
--

CREATE TABLE `notif_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `notif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_dok_dalam_negeri`
--

CREATE TABLE `persyaratan_dok_dalam_negeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_permohonan_sertifikat_sni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_isian_kuesioner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_iui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_akte_notaris_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_tdp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_sert_patent_merek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_sert_iso_9001` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_audit_sistem_mutu_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panduan_mutu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_induk_dok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagram_alir_proses_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_pertunjukkan_wakil_manajemen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ilustrasi_pembubuhan_tanda_sni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel_daftar_tipe_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_dan_spesifikasi_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_letak_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_rute_pabrik_dari_bandara_terdekat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_dok_luar_negeri`
--

CREATE TABLE `persyaratan_dok_luar_negeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dok_importir_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dok_manufaktur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sert_id` bigint(20) UNSIGNED DEFAULT NULL,
  `draft_sert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_sert_jadi` int(11) DEFAULT NULL,
  `request_sert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_request_sert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resi_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `user_id`, `produk`, `sert_id`, `draft_sert`, `status_sert_jadi`, `request_sert`, `tgl_request_sert`, `resi_pengiriman`, `created_at`, `updated_at`) VALUES
(8, 2, 'produk22', NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-17 21:43:17', '2019-09-17 21:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `review_dok_importir`
--

CREATE TABLE `review_dok_importir` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `surat_permohonan_importer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_isian_dan_kuesioner_importer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_iui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_akte_notaris_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_tdp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copy_sert_patent_merek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penunjukkan_distributor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ilustrasi_pembubuhan_tanda_sni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel_daftar_tipe_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_dan_spesifikasi_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sert_smm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_pengawasan_iso_9001_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_dok_manufaktur`
--

CREATE TABLE `review_dok_manufaktur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `surat_permohonan_dari_manufaktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_isian_dan_kuesioner_manufaktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `izin_usaha_manufaktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sert_iso_9001` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_pengawasan_iso_9001_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagram_alir_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panduan_mutu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_induk_dok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_penunjukkan_wakil_manajemen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_letak_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_rute_pabrik_dari_bandara_terdekat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_tinjauan_pp`
--

CREATE TABLE `review_tinjauan_pp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagram_alir_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_peralatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesifikasi_peralatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_letak_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_letak_pabrik_dari_bandara_terdekat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'client'),
(2, 'pemasaran'),
(3, 'kerjasama'),
(4, 'kabidpjt'),
(5, 'keuangan'),
(6, 'sertifikasi'),
(7, 'auditor'),
(8, 'kabidpaskal'),
(9, 'tim_teknis'),
(10, 'komite_timTeknis'),
(11, 'subag_umum');

-- --------------------------------------------------------

--
-- Table structure for table `sert`
--

CREATE TABLE `sert` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sert_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahap_sert`
--

CREATE TABLE `tahap_sert` (
  `id` bigint(20) NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `apply_sa` tinyint(1) NOT NULL DEFAULT '0',
  `mou` tinyint(1) NOT NULL DEFAULT '0',
  `sign_mou` tinyint(1) NOT NULL DEFAULT '0',
  `bid_price` tinyint(1) NOT NULL DEFAULT '0',
  `form_pembayaran` tinyint(1) NOT NULL DEFAULT '0',
  `invoice` tinyint(1) NOT NULL DEFAULT '0',
  `bukti_bayar` tinyint(1) NOT NULL DEFAULT '0',
  `jadwal_audit` tinyint(1) NOT NULL DEFAULT '0',
  `dokSert` tinyint(1) NOT NULL DEFAULT '0',
  `sampling_plan` tinyint(1) NOT NULL DEFAULT '0',
  `lapSert` tinyint(1) NOT NULL DEFAULT '0',
  `draftSert` tinyint(1) NOT NULL DEFAULT '0',
  `cetakSert` tinyint(1) NOT NULL DEFAULT '0',
  `jadwalSert` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tinjauan_pp`
--

CREATE TABLE `tinjauan_pp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lengkap` int(11) DEFAULT NULL,
  `struktur_organisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagram_alir_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daftar_peralatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesifikasi_peralatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tata_letak_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peta_letak_pabrik_dari_bandara_terdekat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_tinjauan_pp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `negeri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pimpinan_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_perusahaan` text COLLATE utf8mb4_unicode_ci,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pabrik` text COLLATE utf8mb4_unicode_ci,
  `telp_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_pabrik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_pegawai_tetap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_pegawai_tidak_tetap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jml_line_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `negeri`, `nama_perusahaan`, `pimpinan_perusahaan`, `alamat_perusahaan`, `kota`, `provinsi`, `kode_pos`, `no_telp`, `no_fax`, `email_pengguna`, `alamat_pabrik`, `telp_pabrik`, `fax_pabrik`, `email_perusahaan`, `jml_pegawai_tetap`, `jml_pegawai_tidak_tetap`, `jml_line_produksi`, `contact_person`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user1', 'bebas1@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 1, '1', 'PT.ADA1', 'Pimpinan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 20:04:34', '2019-07-17 20:04:34'),
(2, 'user2', 'bebas2@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 1, '2', 'PT.ADA2', 'Pimpinan2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 20:04:34', '2019-07-17 20:04:34'),
(3, 'pemasaran', 'bebas_pemasaran@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-17 20:04:34', '2019-07-17 20:04:34'),
(4, 'kerjasama', 'bebas_kerjasama@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(5, 'kabidPjt', 'bebas_kabidpjt@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(6, 'keuangan', 'bebas_keuangan@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(7, 'sertifikasi', 'bebas_sertifikasi@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(8, 'auditor', 'bebas_auditor@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(9, 'kabidpaskal', 'bebas_kabidpaskal@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(10, 'tim_teknis', 'bebas_tim_teknis@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(11, 'komite_timTeknis', 'bebas_komite_timTeknis@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27'),
(12, 'subag_umum', 'bebas_subag@gmail.com', '2019-07-15 20:32:20', '$2y$10$HIeJ/qm4aUI0E7GxTM/SWu0rnJT1IwjycTY/FIMJcv.aM.RUvdVo.', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-13 23:51:27', '2019-08-13 23:51:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_sampling_plan`
--
ALTER TABLE `audit_sampling_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_sampling_plan_produk_id_foreign` (`produk_id`),
  ADD KEY `audit_sampling_plan_doc_maker_foreign` (`doc_maker`);

--
-- Indexes for table `bid_price`
--
ALTER TABLE `bid_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bid_price_produk_id_foreign` (`produk_id`),
  ADD KEY `bid_price_doc_maker_foreign` (`doc_maker`),
  ADD KEY `bid_price_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `dok_importir`
--
ALTER TABLE `dok_importir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dok_importir_review_dok_importir_id_foreign` (`review_dok_importir_id`);

--
-- Indexes for table `dok_manufaktur`
--
ALTER TABLE `dok_manufaktur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dok_manufaktur_review_dok_manufaktur_id_foreign` (`review_dok_manufaktur_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_user_id_foreign` (`doc_maker`);

--
-- Indexes for table `jadwal_audit`
--
ALTER TABLE `jadwal_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_audit_user_id_foreign` (`doc_maker`);

--
-- Indexes for table `laporan_audit`
--
ALTER TABLE `laporan_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_audit_produk_id_foreign` (`produk_id`),
  ADD KEY `laporan_audit_auditor_foreign` (`auditor`),
  ADD KEY `laporan_audit_jadwal_audit_id_foreign` (`jadwal_audit_id`),
  ADD KEY `laporan_audit_dok_importir_id_foreign` (`dok_importir_id`),
  ADD KEY `laporan_audit_dok_manufaktur_id_foreign` (`dok_manufaktur_id`),
  ADD KEY `laporan_audit_tinjauan_pp_id_foreign` (`tinjauan_pp_id`);

--
-- Indexes for table `laporan_hasil_sert`
--
ALTER TABLE `laporan_hasil_sert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_hasil_sert_produk_id_foreign` (`produk_id`),
  ADD KEY `laporan_hasil_sert_doc_maker_foreign` (`doc_maker`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mou`
--
ALTER TABLE `mou`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mou_produk_id_foreign` (`produk_id`),
  ADD KEY `mou_doc_maker_foreign` (`doc_maker`);

--
-- Indexes for table `notif_log`
--
ALTER TABLE `notif_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notif_log_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `persyaratan_dok_dalam_negeri`
--
ALTER TABLE `persyaratan_dok_dalam_negeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persyaratan_dok_dalam_negeri_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `persyaratan_dok_luar_negeri`
--
ALTER TABLE `persyaratan_dok_luar_negeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persyaratan_dok_luar_negeri_produk_id_foreign` (`produk_id`),
  ADD KEY `persyaratan_dok_luar_negeri_dok_importir_id_foreign` (`dok_importir_id`),
  ADD KEY `persyaratan_dok_luar_negeri_dok_manufaktur_id_foreign` (`dok_manufaktur_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_user_id_foreign` (`user_id`),
  ADD KEY `produk_sert_id_foreign` (`sert_id`);

--
-- Indexes for table `review_dok_importir`
--
ALTER TABLE `review_dok_importir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_dok_manufaktur`
--
ALTER TABLE `review_dok_manufaktur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_tinjauan_pp`
--
ALTER TABLE `review_tinjauan_pp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sert`
--
ALTER TABLE `sert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahap_sert`
--
ALTER TABLE `tahap_sert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id_foreign` (`produk_id`) USING BTREE;

--
-- Indexes for table `tinjauan_pp`
--
ALTER TABLE `tinjauan_pp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tinjauan_pp_review_tinjauan_pp_id_foreign` (`review_tinjauan_pp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_sampling_plan`
--
ALTER TABLE `audit_sampling_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bid_price`
--
ALTER TABLE `bid_price`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dok_importir`
--
ALTER TABLE `dok_importir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dok_manufaktur`
--
ALTER TABLE `dok_manufaktur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal_audit`
--
ALTER TABLE `jadwal_audit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan_audit`
--
ALTER TABLE `laporan_audit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan_hasil_sert`
--
ALTER TABLE `laporan_hasil_sert`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `mou`
--
ALTER TABLE `mou`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notif_log`
--
ALTER TABLE `notif_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persyaratan_dok_dalam_negeri`
--
ALTER TABLE `persyaratan_dok_dalam_negeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `persyaratan_dok_luar_negeri`
--
ALTER TABLE `persyaratan_dok_luar_negeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review_dok_importir`
--
ALTER TABLE `review_dok_importir`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review_dok_manufaktur`
--
ALTER TABLE `review_dok_manufaktur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review_tinjauan_pp`
--
ALTER TABLE `review_tinjauan_pp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sert`
--
ALTER TABLE `sert`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahap_sert`
--
ALTER TABLE `tahap_sert`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tinjauan_pp`
--
ALTER TABLE `tinjauan_pp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_sampling_plan`
--
ALTER TABLE `audit_sampling_plan`
  ADD CONSTRAINT `audit_sampling_plan_doc_maker_foreign` FOREIGN KEY (`doc_maker`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audit_sampling_plan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bid_price`
--
ALTER TABLE `bid_price`
  ADD CONSTRAINT `bid_price_doc_maker_foreign` FOREIGN KEY (`doc_maker`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_price_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_price_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dok_importir`
--
ALTER TABLE `dok_importir`
  ADD CONSTRAINT `dok_importir_review_dok_importir_id_foreign` FOREIGN KEY (`review_dok_importir_id`) REFERENCES `review_dok_importir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dok_manufaktur`
--
ALTER TABLE `dok_manufaktur`
  ADD CONSTRAINT `dok_manufaktur_review_dok_manufaktur_id_foreign` FOREIGN KEY (`review_dok_manufaktur_id`) REFERENCES `review_dok_manufaktur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_user_id_foreign` FOREIGN KEY (`doc_maker`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_audit`
--
ALTER TABLE `jadwal_audit`
  ADD CONSTRAINT `jadwal_audit_user_id_foreign` FOREIGN KEY (`doc_maker`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_audit`
--
ALTER TABLE `laporan_audit`
  ADD CONSTRAINT `laporan_audit_auditor_foreign` FOREIGN KEY (`auditor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_audit_dok_importir_id_foreign` FOREIGN KEY (`dok_importir_id`) REFERENCES `dok_importir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_audit_dok_manufaktur_id_foreign` FOREIGN KEY (`dok_manufaktur_id`) REFERENCES `dok_manufaktur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_audit_jadwal_audit_id_foreign` FOREIGN KEY (`jadwal_audit_id`) REFERENCES `jadwal_audit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_audit_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_audit_tinjauan_pp_id_foreign` FOREIGN KEY (`tinjauan_pp_id`) REFERENCES `tinjauan_pp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_hasil_sert`
--
ALTER TABLE `laporan_hasil_sert`
  ADD CONSTRAINT `laporan_hasil_sert_doc_maker_foreign` FOREIGN KEY (`doc_maker`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_hasil_sert_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mou`
--
ALTER TABLE `mou`
  ADD CONSTRAINT `mou_doc_maker_foreign` FOREIGN KEY (`doc_maker`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mou_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notif_log`
--
ALTER TABLE `notif_log`
  ADD CONSTRAINT `notif_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persyaratan_dok_dalam_negeri`
--
ALTER TABLE `persyaratan_dok_dalam_negeri`
  ADD CONSTRAINT `persyaratan_dok_dalam_negeri_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persyaratan_dok_luar_negeri`
--
ALTER TABLE `persyaratan_dok_luar_negeri`
  ADD CONSTRAINT `persyaratan_dok_luar_negeri_dok_importir_id_foreign` FOREIGN KEY (`dok_importir_id`) REFERENCES `dok_importir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persyaratan_dok_luar_negeri_dok_manufaktur_id_foreign` FOREIGN KEY (`dok_manufaktur_id`) REFERENCES `dok_manufaktur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persyaratan_dok_luar_negeri_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_sert_id_foreign` FOREIGN KEY (`sert_id`) REFERENCES `sert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tahap_sert`
--
ALTER TABLE `tahap_sert`
  ADD CONSTRAINT `produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `tinjauan_pp`
--
ALTER TABLE `tinjauan_pp`
  ADD CONSTRAINT `tinjauan_pp_review_tinjauan_pp_id_foreign` FOREIGN KEY (`review_tinjauan_pp_id`) REFERENCES `review_tinjauan_pp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
