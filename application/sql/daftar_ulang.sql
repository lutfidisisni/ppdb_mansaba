-- Add status_daftar_ulang column to pendaftaran table
ALTER TABLE `pendaftaran` ADD COLUMN `status_daftar_ulang` varchar(20) DEFAULT 'belum' AFTER `status`;

-- Table structure for table `daftar_ulang`
CREATE TABLE `daftar_ulang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pendaftaran_id` int(11) NOT NULL,
  `no_daftar_ulang` varchar(20) NOT NULL,
  `kk_asli` tinyint(1) DEFAULT 0,
  `skl` tinyint(1) DEFAULT 0,
  `piagam` tinyint(1) DEFAULT 0,
  `sktm` tinyint(1) DEFAULT 0,
  `bayar_daftar_ulang` tinyint(1) DEFAULT 0,
  `nominal_daftar_ulang` decimal(10,2) DEFAULT 0,
  `ukuran_seragam` varchar(10) DEFAULT NULL,
  `seragam_osis` tinyint(1) DEFAULT 0,
  `seragam_pramuka` tinyint(1) DEFAULT 0,
  `seragam_batik` tinyint(1) DEFAULT 0,
  `seragam_olahraga` tinyint(1) DEFAULT 0,
  `tanggal_daftar_ulang` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `pendaftaran_id` (`pendaftaran_id`),
  CONSTRAINT `daftar_ulang_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 