/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 50733 (5.7.33)
 Source Host           : localhost:3306
 Source Schema         : datastore_db

 Target Server Type    : MySQL
 Target Server Version : 50733 (5.7.33)
 File Encoding         : 65001

 Date: 08/09/2023 15:01:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for apps
-- ----------------------------
DROP TABLE IF EXISTS `apps`;
CREATE TABLE `apps`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LOGO` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `LOGO_BIG` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `BG` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of apps
-- ----------------------------
INSERT INTO `apps` VALUES (1, 'P2EP Data Store', 'logo_20230723202535.png', 'logo_big_20230827213859.png', 'bg_20230825142724.png');

-- ----------------------------
-- Table structure for apps_db
-- ----------------------------
DROP TABLE IF EXISTS `apps_db`;
CREATE TABLE `apps_db`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DB` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_BY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of apps_db
-- ----------------------------

-- ----------------------------
-- Table structure for apps_ver
-- ----------------------------
DROP TABLE IF EXISTS `apps_ver`;
CREATE TABLE `apps_ver`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIPE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MAJOR` int(11) NOT NULL,
  `FITUR` int(11) NOT NULL,
  `MINOR` int(11) NOT NULL,
  `DETAIL` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CHANGED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CHANGED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of apps_ver
-- ----------------------------
INSERT INTO `apps_ver` VALUES (1, 'v1.0.0', 'MAJOR', 1, 0, 0, '<ul>\r\n<li>INIT ALL MODULES</li>\r\n</ul>', 'Miftahu Choirul Burhan', '2023-08-25 19:02:13', 'Miftahu Choirul Burhan', '2023-08-25 19:02:13');

-- ----------------------------
-- Table structure for bio_master
-- ----------------------------
DROP TABLE IF EXISTS `bio_master`;
CREATE TABLE `bio_master`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIPE` int(1) NOT NULL,
  `TIPE_TEXT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIPE_COLOR` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUS` int(1) NOT NULL,
  `CREATED_BY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bio_master
-- ----------------------------
INSERT INTO `bio_master` VALUES (1, 1, 'PEMBANGKIT', 'primary', 'BIO_MASTER_PEMBANGKIT_01.xlsx', 0, 'Miftahu Choirul Burhan', '2023-09-05 15:20:34');
INSERT INTO `bio_master` VALUES (2, 2, 'KONTRAK', 'info', 'BIO_MASTER_KONTRAK_01.xlsx', 0, 'Miftahu Choirul Burhan', '2023-09-05 15:42:58');
INSERT INTO `bio_master` VALUES (3, 2, 'KONTRAK', 'info', 'BIO_MASTER_KONTRAK_02.xlsx', 0, 'Miftahu Choirul Burhan', '2023-09-05 15:43:38');
INSERT INTO `bio_master` VALUES (4, 3, 'AMANDEMEN', 'warning', 'BIO_MASTER_AMANDEMEN_01.xlsx', 0, 'Miftahu Choirul Burhan', '2023-09-05 16:00:49');

-- ----------------------------
-- Table structure for bio_trans
-- ----------------------------
DROP TABLE IF EXISTS `bio_trans`;
CREATE TABLE `bio_trans`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BULAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BLN` int(11) NOT NULL,
  `TAHUN` int(11) NOT NULL,
  `FILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUS` int(1) NOT NULL,
  `CREATED_BY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bio_trans
-- ----------------------------
INSERT INTO `bio_trans` VALUES (1, 'Agustus', 8, 2023, 'BIO_TRANS_8_2023_01.xlsx', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:45:45');
INSERT INTO `bio_trans` VALUES (2, 'Agustus', 8, 2023, 'BIO_TRANS_8_2023_02.xlsx', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:47:20');

-- ----------------------------
-- Table structure for org
-- ----------------------------
DROP TABLE IF EXISTS `org`;
CREATE TABLE `org`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SHORT_ORG` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LONG_ORG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PARENT_ID` int(11) NULL DEFAULT NULL,
  `LEVEL` int(1) NOT NULL,
  `IS_ACTIVE` int(1) NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CHANGED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CHANGED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 165 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of org
-- ----------------------------
INSERT INTO `org` VALUES (1, 'PLN EPI', 'PLN ENERGI PRIMER INDONESIA', NULL, 1, 1, 'Miftahu Choirul Burhan', '2023-06-26 07:17:00', 'Miftahu Choirul Burhan', '2023-06-26 14:17:27');
INSERT INTO `org` VALUES (2, 'DIT HCA', 'DIREKTORAT HUMAN CAPITAL & ADMINISTRASI', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-06-26 07:18:06', 'Miftahu Choirul Burhan', '2023-06-26 14:19:50');
INSERT INTO `org` VALUES (3, 'BID TIG', 'BIDANG TEKNOLOGI INFORMASI & DIGITAL', 2, 3, 1, 'Miftahu Choirul Burhan', '2023-06-26 07:20:21', 'Miftahu Choirul Burhan', '2023-06-26 14:20:49');
INSERT INTO `org` VALUES (4, 'SUB BID OP TI', 'SUB BIDANG OPERASIONAL TEKNOLOGI INFORMASI', 3, 4, 1, 'Miftahu Choirul Burhan', '2023-06-26 07:21:06', 'Miftahu Choirul Burhan', '2023-06-26 14:21:50');
INSERT INTO `org` VALUES (5, 'BAG SDSS', 'BAGIAN SERVICE DESK & SHARED SERVICES', 4, 5, 1, 'Miftahu Choirul Burhan', '2023-06-26 07:23:51', 'Miftahu Choirul Burhan', '2023-06-26 14:24:15');
INSERT INTO `org` VALUES (7, 'BAG IT SEC', 'BAGIAN IT SECURITY', 4, 5, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:44:58', 'Miftahu Choirul Burhan', '2023-07-02 20:44:58');
INSERT INTO `org` VALUES (8, 'BAG TAS', 'BAGIAN SOLUTION TRANSITION & APPPLICATION SUPPORT', 4, 5, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:45:35', 'Miftahu Choirul Burhan', '2023-07-02 20:45:35');
INSERT INTO `org` VALUES (9, 'SUB BID RTI EPI', 'SUB BIDANG PERENCANAAN DAN PENGEMBANGAN TI EPI', 3, 4, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:46:33', 'Miftahu Choirul Burhan', '2023-07-02 20:46:33');
INSERT INTO `org` VALUES (10, 'BAG IT PMO', 'BAGIAN IT EVALUATION, CHANGE MANAGEMENT & PMO', 9, 10, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:47:07', 'Miftahu Choirul Burhan', '2023-07-02 20:47:07');
INSERT INTO `org` VALUES (11, 'BAG IATECH', 'BAGIAN ENTERPRISE IT ARCHITECTURE & SOLUTION TECHNOLOGY', 9, 10, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:47:39', 'Miftahu Choirul Burhan', '2023-07-02 20:47:39');
INSERT INTO `org` VALUES (12, 'BAG DMA', 'BAGIAN DATA MANAGEMENT & ANALYTICS', 9, 10, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:48:06', 'Miftahu Choirul Burhan', '2023-07-02 20:48:06');
INSERT INTO `org` VALUES (13, 'BID MHC', 'BIDANG MANAJEMEN HUMAN CAPITAL', 2, 3, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:50:27', 'Miftahu Choirul Burhan', '2023-07-02 20:50:27');
INSERT INTO `org` VALUES (14, 'SUB BID PBK SDM', 'SUB BIDANG STRATEGI, PROSES BISNIS & KEBIJAKAN HUMAN CAPITAL', 13, 14, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:51:24', 'Miftahu Choirul Burhan', '2023-07-02 20:51:24');
INSERT INTO `org` VALUES (15, 'SUB BID TLN HC', 'SUB BIDANG PENGEMBANGAN TALENTA & PELAYANAN HUMAN CAPITAL', 13, 14, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:52:49', 'Miftahu Choirul Burhan', '2023-07-02 20:52:49');
INSERT INTO `org` VALUES (16, 'DIV RKM', 'DIVISI PERENCANAAN KORPORAT & MANAJEMEN PORTOFOLIO EPI', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:56:45', 'Miftahu Choirul Burhan', '2023-07-02 20:56:45');
INSERT INTO `org` VALUES (17, 'BID REN EPI', 'BIDANG PERENCANAAN MANAJEMEN ENERGI PRIMER', 16, 17, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:57:33', 'Miftahu Choirul Burhan', '2023-07-02 20:57:33');
INSERT INTO `org` VALUES (18, 'SUB BID PBR EPI', 'SUB BIDANG PENELITIAN, PENGEMBANGAN & REKAYASA ENERGI PRIMER', 17, 18, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:58:01', 'Miftahu Choirul Burhan', '2023-07-02 20:58:01');
INSERT INTO `org` VALUES (19, 'SUB BID REN EPI', 'SUB BIDANG PERENCANAAN STRATEGI ENERGI PRIMER', 17, 18, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:58:20', 'Miftahu Choirul Burhan', '2023-07-02 20:58:20');
INSERT INTO `org` VALUES (20, 'SUB BID P2 EPI', 'SUB BIDANG PUSAT PENGATUR ENERGI PRIMER', 17, 18, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:58:38', 'Miftahu Choirul Burhan', '2023-07-02 20:58:38');
INSERT INTO `org` VALUES (21, 'BID DK SMT', 'BIDANG PENGENDALIAN KINERJA KORPORAT & SISTEM MANAJEMEN TERINTEGRASI', 16, 17, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:59:11', 'Miftahu Choirul Burhan', '2023-07-02 20:59:11');
INSERT INTO `org` VALUES (22, 'BAG MANKIN', 'BAGIAN MANAJEMEN KINERJA', 21, 22, 1, 'Miftahu Choirul Burhan', '2023-07-02 20:59:37', 'Miftahu Choirul Burhan', '2023-07-02 20:59:37');
INSERT INTO `org` VALUES (23, 'BAG SMT', 'BAGIAN SISTEM MANAJEMEN TERINTEGRASI', 21, 22, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:04:27', 'Miftahu Choirul Burhan', '2023-07-02 21:04:27');
INSERT INTO `org` VALUES (24, 'SUB BID MBKP', 'SUB BIDANG MANAJEMEN PENGEMBANGAN KORPORAT DAN PORTOFOLIO', 16, 17, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:05:14', 'Miftahu Choirul Burhan', '2023-07-02 21:05:14');
INSERT INTO `org` VALUES (25, 'BAG MBK', 'BAGIAN PENGEMBANGAN KORPORAT', 24, 25, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:05:32', 'Miftahu Choirul Burhan', '2023-07-02 21:05:32');
INSERT INTO `org` VALUES (26, 'BAG BP', 'BAGIAN PENGEMBANGAN PORTOFOLIO EPI', 24, 25, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:06:22', 'Miftahu Choirul Burhan', '2023-07-02 21:06:22');
INSERT INTO `org` VALUES (27, 'SETPER', 'SEKRETARIAT PERUSAHAAN', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:06:44', 'Miftahu Choirul Burhan', '2023-07-02 21:06:44');
INSERT INTO `org` VALUES (28, 'SUB BID SEKPRO', 'SUB BIDANG TATA KELOLA PERUSAHAAN, KESEKRETARIATAN & PROTOKOLER', 27, 28, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:07:16', 'Miftahu Choirul Burhan', '2023-07-02 21:07:16');
INSERT INTO `org` VALUES (29, 'BAG GCG LP', 'BAGIAN GOOD CORPORATE GOVERNANCE & LAPORAN PERUSAHAAN', 28, 29, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:07:38', 'Miftahu Choirul Burhan', '2023-07-02 21:07:38');
INSERT INTO `org` VALUES (30, 'BAG SEKPRO', 'BAGIAN KESEKRETARIATAN DAN PROTOKOLER', 28, 29, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:07:54', 'Miftahu Choirul Burhan', '2023-07-02 21:07:54');
INSERT INTO `org` VALUES (31, 'SUB BID KOM TJSL', 'SUB BIDANG KOMUNIKASI KORPORAT & TANGGUNG JAWAB SOSIAL LINGKUNGAN', 27, 28, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:08:14', 'Miftahu Choirul Burhan', '2023-07-02 21:08:14');
INSERT INTO `org` VALUES (32, 'BAG KOM', 'BAGIAN KOMUNIKASI KORPORAT', 31, 32, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:08:32', 'Miftahu Choirul Burhan', '2023-07-02 21:08:32');
INSERT INTO `org` VALUES (33, 'BAG TJSL', 'BAGIAN TANGGUNG JAWAB SOSIAL LINGKUNGAN', 31, 32, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:08:47', 'Miftahu Choirul Burhan', '2023-07-02 21:08:47');
INSERT INTO `org` VALUES (34, 'SPI', 'SATUAN PENGAWASAN INTERNAL', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:09:27', 'Miftahu Choirul Burhan', '2023-07-02 21:09:27');
INSERT INTO `org` VALUES (35, 'SUB BID LK AUDIT', 'SUB BIDANG PELAKSANAAN AUDIT', 34, 35, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:09:48', 'Miftahu Choirul Burhan', '2023-07-02 21:09:48');
INSERT INTO `org` VALUES (36, 'BAG AUDIT INT', 'BAGIAN PELAKSANAAN AUDIT INTERNAL', 35, 36, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:10:05', 'Miftahu Choirul Burhan', '2023-07-02 21:10:05');
INSERT INTO `org` VALUES (37, 'BAG AUDIT AP', 'BAGIAN PELAKSANAAN AUDIT ANAK PERUSAHAAN', 35, 36, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:10:27', 'Miftahu Choirul Burhan', '2023-07-02 21:10:27');
INSERT INTO `org` VALUES (38, 'SUB BID RD AUDIT', 'SUB BIDANG PERENCANAAN DAN PENGENDALIAN AUDIT', 34, 35, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:10:43', 'Miftahu Choirul Burhan', '2023-07-02 21:10:43');
INSERT INTO `org` VALUES (39, 'DIV LMR', 'DIVISI LEGAL, MANAJEMEN RISIKO DAN KEPATUHAN', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:11:34', 'Miftahu Choirul Burhan', '2023-07-02 21:11:34');
INSERT INTO `org` VALUES (40, 'SUB BID LKK', 'SUB BIDANG LEGAL KORPORAT DAN KONTRAK', 39, 40, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:12:17', 'Miftahu Choirul Burhan', '2023-07-02 21:12:17');
INSERT INTO `org` VALUES (41, 'BAG EPI BB', 'BAGIAN KONTRAK ENERGI PRIMER BATUBARA', 40, 41, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:12:37', 'Miftahu Choirul Burhan', '2023-07-02 21:12:37');
INSERT INTO `org` VALUES (42, 'BAG EPI GBM', 'BAGIAN KONTRAK ENERGI PRIMER GAS, BBM DAN BIOMASSA', 40, 41, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:12:57', 'Miftahu Choirul Burhan', '2023-07-02 21:12:57');
INSERT INTO `org` VALUES (43, 'BAG KK KSA', 'BAGIAN KORPORASI DAN KONTRAK KEUANGAN, SDM DAN ADMINISTRASI', 40, 41, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:13:15', 'Miftahu Choirul Burhan', '2023-07-02 21:13:15');
INSERT INTO `org` VALUES (44, 'SUB BID RLP', 'SUB BIDANG REGULASI, LITIGASI DAN PERIZINAN', 39, 40, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:13:37', 'Miftahu Choirul Burhan', '2023-07-02 21:13:37');
INSERT INTO `org` VALUES (45, 'BAG LIT', 'BAGIAN LITIGASI', 44, 45, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:13:53', 'Miftahu Choirul Burhan', '2023-07-02 21:13:53');
INSERT INTO `org` VALUES (46, 'BAG PDR', 'BAGIAN PERIJINAN DAN REGULASI', 44, 45, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:14:16', 'Miftahu Choirul Burhan', '2023-07-02 21:14:16');
INSERT INTO `org` VALUES (47, 'SUB BID MRK', 'SUB BIDANG MANAJEMEN RISIKO DAN KEPATUHAN', 39, 40, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:14:31', 'Miftahu Choirul Burhan', '2023-07-02 21:14:31');
INSERT INTO `org` VALUES (48, 'BAG KPTH', 'BAGIAN KEPATUHAN', 47, 48, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:14:48', 'Miftahu Choirul Burhan', '2023-07-02 21:14:48');
INSERT INTO `org` VALUES (49, 'BAG MARISK', 'BAGIAN MANAJEMEN RISIKO', 47, 48, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:15:02', 'Miftahu Choirul Burhan', '2023-07-02 21:15:02');
INSERT INTO `org` VALUES (50, 'DIT BAT', 'DIREKTORAT BATUBARA', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:15:28', 'Miftahu Choirul Burhan', '2023-07-02 21:15:28');
INSERT INTO `org` VALUES (51, 'DIV BANG BB', 'DIVISI PENGEMBANGAN USAHA BATUBARA', 50, 51, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:15:55', 'Miftahu Choirul Burhan', '2023-07-02 21:15:55');
INSERT INTO `org` VALUES (52, 'SUB BID BAN ST', 'SUB BIDANG PENGEMBANGAN STRATEGI DAN TEKONOLOGI BATUBARA', 51, 52, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:16:20', 'Miftahu Choirul Burhan', '2023-07-02 21:16:20');
INSERT INTO `org` VALUES (53, 'BAG BST', 'BAGIAN PENGEMBANGAN STRATEGI', 52, 53, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:19:00', 'Miftahu Choirul Burhan', '2023-07-02 21:19:00');
INSERT INTO `org` VALUES (54, 'BAG INFRA', 'BAGIAN PENGEMBANGAN INFRASTRUKTUR', 52, 53, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:19:18', 'Miftahu Choirul Burhan', '2023-07-02 21:19:18');
INSERT INTO `org` VALUES (55, 'BID BANG BB', 'BIDANG PENGEMBANGAN USAHA', 51, 52, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:19:35', 'Miftahu Choirul Burhan', '2023-07-02 21:19:35');
INSERT INTO `org` VALUES (56, 'SUB BID BANG MT', 'SUB BIDANG PENGEMBANGAN MULUT TAMBANG', 55, 56, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:19:55', 'Miftahu Choirul Burhan', '2023-07-02 21:19:55');
INSERT INTO `org` VALUES (57, 'SUB BID SAR BB', 'SUB BIDANG PEMASARAN BATUBARA', 55, 56, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:20:19', 'Miftahu Choirul Burhan', '2023-07-02 21:20:19');
INSERT INTO `org` VALUES (58, 'DIV REND BB', 'DIVISI PERENCANAAN DAN PELAKSANAAN PENGADAAN BATUBARA', 50, 51, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:21:28', 'Miftahu Choirul Burhan', '2023-07-02 21:21:28');
INSERT INTO `org` VALUES (59, 'SUB BID REND BB', 'SUB BIDANG PERENCANAAN PENGADAAN BATUBARA', 58, 59, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:21:46', 'Miftahu Choirul Burhan', '2023-07-02 21:21:46');
INSERT INTO `org` VALUES (60, 'BAG RD BB', 'BAGIAN PERENCANAAN PENGADAAN BATUBARA', 59, 60, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:22:05', 'Miftahu Choirul Burhan', '2023-07-02 21:22:05');
INSERT INTO `org` VALUES (61, 'BAG EV BAT', 'BAGIAN EVALUASI PENGADAAN BATUBARA', 59, 60, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:22:48', 'Miftahu Choirul Burhan', '2023-07-02 21:22:48');
INSERT INTO `org` VALUES (62, 'BID LD BB', 'BIDANG PELAKSANAAN PENGADAAN BATUBARA', 58, 59, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:23:05', 'Miftahu Choirul Burhan', '2023-07-02 21:23:05');
INSERT INTO `org` VALUES (63, 'SUB BID LD BB REGSUM', 'SUB BIDANG PELAKSANA PENGADAAN BATUBARA REG SUMATERA', 62, 63, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:24:23', 'Miftahu Choirul Burhan', '2023-07-02 21:24:23');
INSERT INTO `org` VALUES (64, 'SUB BID LD BB REGKAL', 'SUB BIDANG PELAKSANA PENGADAAN BATUBARA REG KALIMANTAN', 62, 63, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:24:56', 'Miftahu Choirul Burhan', '2023-07-02 21:24:56');
INSERT INTO `org` VALUES (65, 'DIV SBB', 'DIVISI PELAYANAN BISNIS DAN SERVICE MITRA TAMBANG BATUBARA', 50, 51, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:25:29', 'Miftahu Choirul Burhan', '2023-07-02 21:25:29');
INSERT INTO `org` VALUES (66, 'BID YANPLTU', 'BIDANG PELAYANAN PEMBANGKIT LISTRIK TENAGA UAP', 65, 66, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:28:12', 'Miftahu Choirul Burhan', '2023-07-02 21:28:12');
INSERT INTO `org` VALUES (67, 'SUB BID YAN PLTU PLN GROUP', 'SUB BIDANG PELAYANAN PLTU PLN GROUP', 66, 67, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:29:14', 'Miftahu Choirul Burhan', '2023-07-02 21:29:14');
INSERT INTO `org` VALUES (68, 'BAG YAN PLTU PNP', 'BAGIAN PELAYANAN PLTU PNP', 67, 68, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:29:42', 'Miftahu Choirul Burhan', '2023-07-02 21:29:42');
INSERT INTO `org` VALUES (69, 'BAG YAN PLTU PIP', 'BAGIAN PELAYANAN PLTU PIP', 67, 68, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:30:04', 'Miftahu Choirul Burhan', '2023-07-02 21:30:04');
INSERT INTO `org` VALUES (70, 'SUB BID YAN PLTU IPP', 'SUB BIDANG PELAYANAN PLTU IPP', 66, 67, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:30:41', 'Miftahu Choirul Burhan', '2023-07-02 21:30:41');
INSERT INTO `org` VALUES (71, 'BAG YAN PLTU IPP JB', 'BAGIAN PELAYANAN PLTU IPP JAWA BALI', 70, 71, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:31:04', 'Miftahu Choirul Burhan', '2023-07-02 21:31:04');
INSERT INTO `org` VALUES (72, 'BAG YAN PLTU IPP LJB', 'BAGIAN PELAYANAN PLTU IPP LUAR JAWA BALI', 70, 71, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:31:24', 'Miftahu Choirul Burhan', '2023-07-02 21:31:24');
INSERT INTO `org` VALUES (73, 'SUB BID MITBB', 'SUB BIDANG SERVICES MITRA TAMBANG BATUBARA', 65, 66, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:31:54', 'Miftahu Choirul Burhan', '2023-07-02 21:31:54');
INSERT INTO `org` VALUES (74, 'BAG SETTLE', 'BAGIAN SETTLEMENT', 73, 74, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:32:13', 'Miftahu Choirul Burhan', '2023-07-02 21:32:13');
INSERT INTO `org` VALUES (75, 'BAG KMT', 'BAGIAN HUBUNGAN KEMITRAAN', 73, 74, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:32:35', 'Miftahu Choirul Burhan', '2023-07-02 21:32:35');
INSERT INTO `org` VALUES (76, 'DIV LOG BAT', 'DIVISI PENGENDALIAN KONTRAK DAN LOGISTIK BATUBARA', 50, 51, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:33:11', 'Miftahu Choirul Burhan', '2023-07-02 21:33:11');
INSERT INTO `org` VALUES (77, 'BID OP BAT', 'BIDANG PENGENDALIAN OPERASIONAL BATUBARA', 76, 77, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:40:07', 'Miftahu Choirul Burhan', '2023-07-02 21:40:07');
INSERT INTO `org` VALUES (78, 'SUB BID DKA BB', 'SUB BIDANG PENGENDALIAN KONTRAK DAN ADMINISTRASI BATUBARA', 76, 77, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:40:29', 'Miftahu Choirul Burhan', '2023-07-02 21:40:29');
INSERT INTO `org` VALUES (79, 'SUB BID PMT BB', 'SUB BIDANG PENGAWASAN MITRA TAMBANG', 76, 77, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:41:02', 'Miftahu Choirul Burhan', '2023-07-02 21:41:02');
INSERT INTO `org` VALUES (80, 'SUB BID DL JB', 'SUB BIDANG DELIVERY & LOGISTIK JAWA DAN BALI', 77, 78, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:41:26', 'Miftahu Choirul Burhan', '2023-07-02 21:41:26');
INSERT INTO `org` VALUES (81, 'SUB BID DL SULMAPANA', 'SUB BIDANG DELIVERY & LOGISTIK SULAWESI, MALUKU, PAPUA & NUSA TENGGARA', 77, 78, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:41:56', 'Miftahu Choirul Burhan', '2023-07-02 21:41:56');
INSERT INTO `org` VALUES (82, 'SUB BID DL SUMKAL', 'SUB BIDANG DELIVERY & LOGISTIK SUMATERA DAN KALIMANTAN', 77, 78, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:42:15', 'Miftahu Choirul Burhan', '2023-07-02 21:42:15');
INSERT INTO `org` VALUES (83, 'BAG DK IPP', 'BAGIAN PENGENDALIAN KONTRAK IPP', 78, 79, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:42:36', 'Miftahu Choirul Burhan', '2023-07-02 21:42:36');
INSERT INTO `org` VALUES (84, 'BAG DK PLN', 'BAGIAN PENGENDALIAN KONTRAK PLN', 78, 79, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:42:52', 'Miftahu Choirul Burhan', '2023-07-02 21:42:52');
INSERT INTO `org` VALUES (85, 'BAG MT SUM', 'BAGIAN PENGAWASAN MITRA TAMBANG SUMATERA', 79, 80, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:43:11', 'Miftahu Choirul Burhan', '2023-07-02 21:43:11');
INSERT INTO `org` VALUES (86, 'BAG MT KAL', 'BAGIAN PENGAWASAN MITRA TAMBANG KALIMANTAN', 79, 80, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:43:29', 'Miftahu Choirul Burhan', '2023-07-02 21:43:29');
INSERT INTO `org` VALUES (87, 'DIT GBM', 'DIREKTORAT GAS DAN BBM', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:44:06', 'Miftahu Choirul Burhan', '2023-07-02 21:44:06');
INSERT INTO `org` VALUES (88, 'DIT BIO', 'DIREKTORAT BIOMASSA', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:44:27', 'Miftahu Choirul Burhan', '2023-07-02 21:44:27');
INSERT INTO `org` VALUES (89, 'DIT KEU', 'DIREKTORAT KEUANGAN', 1, 2, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:44:39', 'Miftahu Choirul Burhan', '2023-07-02 21:44:39');
INSERT INTO `org` VALUES (90, 'DIV PBR LNG', 'DIVISI PENGEMBANGAN BISNIS, PEMASARAN & PERENCANAAN PENGADAAN LNG', 87, 88, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:48:53', 'Miftahu Choirul Burhan', '2023-07-02 21:48:53');
INSERT INTO `org` VALUES (91, 'BID PBR LNG', 'BIDANG PENGEMBANGAN BISNIS DAN PEMASARAN LNG', 90, 91, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:51:02', 'Miftahu Choirul Burhan', '2023-07-02 21:51:02');
INSERT INTO `org` VALUES (92, 'SUB BID RD LNG', 'SUB BIDANG PERENCANAAN PENGADAAN LNG', 90, 91, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:51:25', 'Miftahu Choirul Burhan', '2023-07-02 21:51:25');
INSERT INTO `org` VALUES (93, 'SUB BID PB LNG', 'SUB BIDANG PENGEMBANGAN BISNIS LNG', 91, 92, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:51:46', 'Miftahu Choirul Burhan', '2023-07-02 21:51:46');
INSERT INTO `org` VALUES (94, 'SUB BID SAR LNG', 'SUB BIDANG PEMASARAN LNG', 91, 92, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:52:16', 'Miftahu Choirul Burhan', '2023-07-02 21:52:16');
INSERT INTO `org` VALUES (95, 'BAG REG IB', 'BAGIAN PEMASARAN LNG REGION INDONESIA BARAT', 94, 95, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:52:45', 'Miftahu Choirul Burhan', '2023-07-02 21:52:45');
INSERT INTO `org` VALUES (96, 'BAG REG IT', 'BAGIAN PEMASARAN LNG REGION INDONESIA TIMUR', 94, 95, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:53:04', 'Miftahu Choirul Burhan', '2023-07-02 21:53:04');
INSERT INTO `org` VALUES (97, 'BAG RK LNG', 'BAGIAN PERENCANAAN KONTRAK LNG', 92, 93, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:53:21', 'Miftahu Choirul Burhan', '2023-07-02 21:53:21');
INSERT INTO `org` VALUES (98, 'BAG EV LNG', 'BAGIAN EVALUASI KONTRAK LNG', 92, 93, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:53:43', 'Miftahu Choirul Burhan', '2023-07-02 21:53:43');
INSERT INTO `org` VALUES (99, 'DIV PBR GPB', 'DIVISI PENGEMBANGAN BISNIS, PEMASARAN & PERENCANAAN GAS PIPA DAN BBM', 87, 88, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:54:21', 'Miftahu Choirul Burhan', '2023-07-02 21:54:21');
INSERT INTO `org` VALUES (100, 'BID PBR GPB', 'BIDANG PENGEMBANGAN BISNIS DAN PEMASARAN GAS PIPA DAN BBM', 99, 100, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:55:09', 'Miftahu Choirul Burhan', '2023-07-02 21:55:09');
INSERT INTO `org` VALUES (101, 'SUB BID RD GPB', 'SUB BIDANG PERENCANAAN PENGAADAN GAS PIPA DAN BBM', 99, 100, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:55:30', 'Miftahu Choirul Burhan', '2023-07-02 21:55:30');
INSERT INTO `org` VALUES (102, 'SUB BID PB GPB', 'SUB BIDANG PENGEMBANGAN BISNIS GAS PIPA & BBM', 100, 101, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:55:56', 'Miftahu Choirul Burhan', '2023-07-02 21:55:56');
INSERT INTO `org` VALUES (103, 'SUB BID SAR GPB', 'SUB BIDANG PEMASARAN BISNIS GAS PIPA & BBM', 100, 101, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:56:25', 'Miftahu Choirul Burhan', '2023-07-02 21:56:25');
INSERT INTO `org` VALUES (104, 'BAG SAR GP', 'BAGIAN PEMASARAN BISNIS GAS PIPA', 103, 104, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:56:45', 'Miftahu Choirul Burhan', '2023-07-02 21:56:45');
INSERT INTO `org` VALUES (105, 'BAG SAR BBM', 'BAGIAN PEMASARAN BISNIS BBM', 103, 104, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:57:07', 'Miftahu Choirul Burhan', '2023-07-02 21:57:07');
INSERT INTO `org` VALUES (106, 'BAG RK GPB', 'BAGIAN PERENCANAAN KONTRAK GAS PIPA & BBM', 101, 102, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:57:29', 'Miftahu Choirul Burhan', '2023-07-02 21:57:29');
INSERT INTO `org` VALUES (107, 'BAG EV GPB', 'BAGIAN EVALUASI KONTRAK GAS PIPA & BBM', 101, 102, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:57:44', 'Miftahu Choirul Burhan', '2023-07-02 21:57:44');
INSERT INTO `org` VALUES (108, 'DIV DAN LNG', 'DIVISI PELAKSANAAN PENGADAAN, PENGENDALIAN KONTRAK & LOGISTIK LNG', 87, 88, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:58:56', 'Miftahu Choirul Burhan', '2023-07-02 21:58:56');
INSERT INTO `org` VALUES (109, 'BID DAN LNG', 'BIDANG PELAKSANAAN PENGADAAN, PENGENDALIAN KONTRAK & ADMINISTRASI LNG', 108, 109, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:59:23', 'Miftahu Choirul Burhan', '2023-07-02 21:59:23');
INSERT INTO `org` VALUES (110, 'SUB BID LI LNG', 'SUB BIDANG DELIVERY DAN INFRASTRUKTUR LNG', 108, 109, 1, 'Miftahu Choirul Burhan', '2023-07-02 21:59:54', 'Miftahu Choirul Burhan', '2023-07-02 21:59:54');
INSERT INTO `org` VALUES (111, 'SUB BID DK LNG', 'SUB BIDANG PELAKSANAAN PENGADAAN KONTRAK LNG', 109, 110, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:00:10', 'Miftahu Choirul Burhan', '2023-07-02 22:00:10');
INSERT INTO `org` VALUES (112, 'SUB BID DI LNG', 'SUB BIDANG PENGENDALIAN IMPLEMENTASI KONTRAK LNG', 109, 110, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:00:28', 'Miftahu Choirul Burhan', '2023-07-02 22:00:28');
INSERT INTO `org` VALUES (113, 'DIV DPA GPB', 'DIVISI PELAKSANAAN PENGADAAN, PENGENDALIAN KONTRAK & INFRASTRUKTUR GAS PIPA DAN LOGISTIK BBM', 87, 88, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:01:12', 'Miftahu Choirul Burhan', '2023-07-02 22:01:12');
INSERT INTO `org` VALUES (114, 'BID DPA GPB', 'BIDANG PELAKSANAAN PENGADAAN, PENGENDALIAN KONTRAK & ADMINISTRASI GAS PIPA DAN BBM', 113, 114, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:02:04', 'Miftahu Choirul Burhan', '2023-07-02 22:02:04');
INSERT INTO `org` VALUES (115, 'SUB BID DI GPB', 'SUB BIDANG DELIVERY DAN INFRASTRUKTUR GAS PIPA DAN BBM', 113, 114, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:02:22', 'Miftahu Choirul Burhan', '2023-07-02 22:02:22');
INSERT INTO `org` VALUES (116, 'SUB BID DPA GPB', 'SUB BIDANG PELAKSANAAN PENGADAAN KONTRAK GAS PIPA & BBM', 114, 115, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:02:45', 'Miftahu Choirul Burhan', '2023-07-02 22:02:45');
INSERT INTO `org` VALUES (117, 'BAG PDK GP', 'BAGIAN PELAKSANA PENGADAAN KONTRAK GAS PIPA', 116, 117, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:03:09', 'Miftahu Choirul Burhan', '2023-07-02 22:03:09');
INSERT INTO `org` VALUES (118, 'BAG PK BBM', 'BAGIAN PELAKSANA PENGADAAN KONTRAK BBM', 116, 117, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:03:28', 'Miftahu Choirul Burhan', '2023-07-02 22:03:28');
INSERT INTO `org` VALUES (119, 'SUB BID IK GPB', 'SUB BIDANG PENGENDALIAN IMPLEMENTASI KONTRAK GAS PIPA & BBM', 114, 115, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:03:52', 'Miftahu Choirul Burhan', '2023-07-02 22:03:52');
INSERT INTO `org` VALUES (120, 'BAG IK GPB', 'BAGIAN PENGENDALIAN IMPLEMENTASI KONTRAK GAS PIPA', 119, 120, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:04:19', 'Miftahu Choirul Burhan', '2023-07-02 22:04:19');
INSERT INTO `org` VALUES (121, 'BAG IK BBM', 'BAGIAN PENGENDALIAN IMPLEMENTASI KONTRAK BBM', 119, 120, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:04:39', 'Miftahu Choirul Burhan', '2023-07-02 22:04:39');
INSERT INTO `org` VALUES (122, 'BID PBSR BIO', 'BIDANG PENGEMBANGAN BISNIS, PEMASARAN & PERENCANAAN BIOMASSA', 88, 89, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:05:32', 'Miftahu Choirul Burhan', '2023-07-02 22:05:32');
INSERT INTO `org` VALUES (123, 'BID LDK BIO', 'BIDANG PELAKSANAAN PENGADAAN, PENGENDALIAN KONTRAK & LOGISTIK BIOMASSA', 88, 89, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:05:55', 'Miftahu Choirul Burhan', '2023-07-02 22:05:55');
INSERT INTO `org` VALUES (124, 'SUB BID PBSR BIO', 'SUB BIDANG PENGEMBANGAN BISNIS, PEMASARAN & PERENCANAAN BIOMASSA', 122, 123, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:06:19', 'Miftahu Choirul Burhan', '2023-07-02 22:06:19');
INSERT INTO `org` VALUES (125, 'SUB BID RT BIO', 'SUB BIDANG PERENCANAAN DAN PEMETAAN BIOMASSA', 122, 123, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:06:36', 'Miftahu Choirul Burhan', '2023-07-02 22:06:36');
INSERT INTO `org` VALUES (126, 'SUB BID LD BIO', 'SUB BIDANG PELAKSANAAN PENGADAAN BIOMASSA', 123, 124, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:07:01', 'Miftahu Choirul Burhan', '2023-07-02 22:07:01');
INSERT INTO `org` VALUES (127, 'SUB BID PAL BIO', 'SUB BIDANG PENGENDALIAN KONTRAK, ADMINISTRASI, DELIVERY & LOGISTIK BIOMASSA', 123, 124, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:07:21', 'Miftahu Choirul Burhan', '2023-07-02 22:07:21');
INSERT INTO `org` VALUES (128, 'SUB BID KWSM', 'SUB BIDANG KOORDINATOR WILAYAH & STAKEHOLDER MANAGEMENT BIOMASSA', 123, 124, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:07:40', 'Miftahu Choirul Burhan', '2023-07-02 22:07:40');
INSERT INTO `org` VALUES (129, 'BID KEU KORP', 'BIDANG KEUANGAN KORPORAT', 89, 90, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:10:30', 'Miftahu Choirul Burhan', '2023-07-02 22:10:30');
INSERT INTO `org` VALUES (130, 'SUB BID ANG', 'SUB BIDANG ANGGARAN', 129, 130, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:11:00', 'Miftahu Choirul Burhan', '2023-07-02 22:11:00');
INSERT INTO `org` VALUES (131, 'BAG ANG OP', 'BAGIAN PERENCANAAN DAN PENGENDALIAN ANGGARAN OPERASIONAL', 130, 131, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:11:21', 'Miftahu Choirul Burhan', '2023-07-02 22:11:21');
INSERT INTO `org` VALUES (132, 'BAG ANG INV', 'BAGIAN PERENCANAAN DAN PENGENDALIAN ANGGARAN INVESTASI', 130, 130, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:11:38', 'Miftahu Choirul Burhan', '2023-07-02 22:11:38');
INSERT INTO `org` VALUES (133, 'SUB BID DANA', 'SUB BIDANG PENDANAAN', 129, 130, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:12:09', 'Miftahu Choirul Burhan', '2023-07-02 22:12:09');
INSERT INTO `org` VALUES (134, 'BID PBH & PAJAK', 'BIDANG PERBENDAHARAAN DAN PAJAK', 89, 90, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:14:29', 'Miftahu Choirul Burhan', '2023-07-02 22:14:29');
INSERT INTO `org` VALUES (135, 'SUB BID PBH', 'SUB BIDANG PERBENDAHARAAN', 134, 135, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:16:05', 'Miftahu Choirul Burhan', '2023-07-02 22:16:05');
INSERT INTO `org` VALUES (136, 'BAG PBH BB', 'BAGIAN PERBENDAHARAAN BATUBARA', 135, 136, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:16:59', 'Miftahu Choirul Burhan', '2023-07-02 22:16:59');
INSERT INTO `org` VALUES (137, 'BAG PBH GBM OP', 'BAGIAN PERBENDAHARAAN GAS, BBM , BIOMASSA & OPERASIONAL', 135, 136, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:17:31', 'Miftahu Choirul Burhan', '2023-07-02 22:17:31');
INSERT INTO `org` VALUES (138, 'SUB BID PAJAK', 'SUB BIDANG PAJAK', 134, 135, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:17:52', 'Miftahu Choirul Burhan', '2023-07-02 22:17:52');
INSERT INTO `org` VALUES (139, 'BAG PPH', 'BAGIAN PENGELOLAAN PPH', 138, 139, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:18:08', 'Miftahu Choirul Burhan', '2023-07-02 22:18:08');
INSERT INTO `org` VALUES (140, 'BAG PPN', 'BAGIAN PENGELOLAAN PPN', 138, 139, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:18:24', 'Miftahu Choirul Burhan', '2023-07-02 22:18:24');
INSERT INTO `org` VALUES (141, 'BID PETA', 'BIDANG PENAGIHAN DAN PENDAPATAN', 89, 90, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:19:51', 'Miftahu Choirul Burhan', '2023-07-02 22:19:51');
INSERT INTO `org` VALUES (142, 'SUB BID PETA BB', 'SUB BIDANG PENAGIHAN DAN PENDAPATAN BATUBARA', 141, 142, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:20:11', 'Miftahu Choirul Burhan', '2023-07-02 22:20:11');
INSERT INTO `org` VALUES (143, 'SUB BID PT LGBM', 'SUB BIDANG PENAGIHAN DAN PENDAPATAN LNG, GAS PIPA & BBM, DAN BIOMASSA', 141, 142, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:20:42', 'Miftahu Choirul Burhan', '2023-07-02 22:20:42');
INSERT INTO `org` VALUES (144, 'BAG BB PNP', 'BAGIAN PENAGIHAN DAN PENDAPATAN BATUBARA PNP', 142, 143, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:21:15', 'Miftahu Choirul Burhan', '2023-07-02 22:21:15');
INSERT INTO `org` VALUES (145, 'BAG BB PIP', 'BAGIAN PENAGIHAN DAN PENDAPATAN BATUBARA PIP', 142, 143, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:21:31', 'Miftahu Choirul Burhan', '2023-07-02 22:21:31');
INSERT INTO `org` VALUES (146, 'BAG PT PNP', 'BAGIAN PENAGIHAN DAN PENDAPATAN EP LNG, GAS PIPA DAN BBM PNP', 143, 144, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:22:14', 'Miftahu Choirul Burhan', '2023-07-02 22:22:14');
INSERT INTO `org` VALUES (147, 'BAG PT PIP', 'BAGIAN PENAGIHAN DAN PENDAPATAN EP LNG, GAS PIPA DAN BBM PIP', 143, 144, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:24:24', 'Miftahu Choirul Burhan', '2023-07-02 22:24:24');
INSERT INTO `org` VALUES (148, 'BAG PT BIO', 'BAGIAN PENAGIHAN DAN PENDAPATAN EP BIOMASSA', 143, 144, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:24:48', 'Miftahu Choirul Burhan', '2023-07-02 22:24:48');
INSERT INTO `org` VALUES (149, 'BID AKT', 'BIDANG AKUNTANSI', 89, 90, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:25:05', 'Miftahu Choirul Burhan', '2023-07-02 22:25:05');
INSERT INTO `org` VALUES (150, 'SUB BID AKT FIN', 'SUB BIDANG AKUNTASI FINANSIAL', 149, 150, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:25:23', 'Miftahu Choirul Burhan', '2023-07-02 22:25:23');
INSERT INTO `org` VALUES (151, 'BAG AKT KORP', 'BAGIAN AKUNTANSI KORPORAT', 150, 151, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:25:47', 'Miftahu Choirul Burhan', '2023-07-02 22:25:47');
INSERT INTO `org` VALUES (152, 'BAG AKT ASET', 'BAGIAN AKUNTANSI ASET', 150, 151, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:26:12', 'Miftahu Choirul Burhan', '2023-07-02 22:26:12');
INSERT INTO `org` VALUES (153, 'SUB BID AKT MAN', 'SUB BIDANG AKUNTANSI MANAJEMEN', 149, 150, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:26:54', 'Miftahu Choirul Burhan', '2023-07-02 22:26:54');
INSERT INTO `org` VALUES (154, 'BID UMUM', 'BIDANG UMUM', 2, 3, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:28:06', 'Miftahu Choirul Burhan', '2023-07-02 22:28:06');
INSERT INTO `org` VALUES (155, 'SUB BID DAN MUM', 'SUB BIDANG PENGADAAN UMUM', 154, 155, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:31:17', 'Miftahu Choirul Burhan', '2023-07-02 22:31:17');
INSERT INTO `org` VALUES (156, 'BAG ADM UMUM', 'BAGIAN ADMINISTRASI UMUM', 154, 155, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:31:44', 'Miftahu Choirul Burhan', '2023-07-02 22:31:44');
INSERT INTO `org` VALUES (157, 'BAG RD MUM', 'BAGIAN PERENCANA PENGADAAN UMUM', 155, 156, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:32:04', 'Miftahu Choirul Burhan', '2023-07-02 22:32:04');
INSERT INTO `org` VALUES (158, 'BAG LD MUM', 'BAGIAN PELAKSANA PENGADAAN UMUM', 155, 156, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:32:21', 'Miftahu Choirul Burhan', '2023-07-02 22:32:21');
INSERT INTO `org` VALUES (159, 'BID K3KL', 'BIDANG KESELAMATAN, KESEHATAN KERJA, KEAMANAN DAN LINGKUNGAN', 2, 3, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:33:09', 'Miftahu Choirul Burhan', '2023-07-02 22:33:09');
INSERT INTO `org` VALUES (160, 'SUB BID K3K', 'SUB BIDANG KESELAMATAN, KESEHATAN KERJA DAN KEAMANAN', 159, 160, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:33:29', 'Miftahu Choirul Burhan', '2023-07-02 22:33:29');
INSERT INTO `org` VALUES (161, 'SUB BID LK', 'SUB BIDANG LINGKUNGAN', 159, 160, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:33:49', 'Miftahu Choirul Burhan', '2023-07-02 22:33:49');
INSERT INTO `org` VALUES (162, 'BAG KIN K3', 'BAGIAN PERENCANAAN DAN KINERJA K3', 160, 161, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:34:07', 'Miftahu Choirul Burhan', '2023-07-02 22:34:07');
INSERT INTO `org` VALUES (163, 'BAG KAM', 'BAGIAN KEAMANAN KORPORAT DAN PENGELOLAAN KEAMANAN', 160, 161, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:34:25', 'Miftahu Choirul Burhan', '2023-07-02 22:34:25');
INSERT INTO `org` VALUES (164, 'BAG K3T', 'BAGIAN K3 TAMBANG (SMKP)', 160, 161, 1, 'Miftahu Choirul Burhan', '2023-07-02 22:34:48', 'Miftahu Choirul Burhan', '2023-07-02 22:34:48');

-- ----------------------------
-- Table structure for rob
-- ----------------------------
DROP TABLE IF EXISTS `rob`;
CREATE TABLE `rob`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BULAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BLN` int(11) NOT NULL,
  `TAHUN` int(11) NOT NULL,
  `FILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIPE` int(1) NOT NULL,
  `STATUS` int(1) NOT NULL,
  `CREATED_BY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rob
-- ----------------------------

-- ----------------------------
-- Table structure for rom
-- ----------------------------
DROP TABLE IF EXISTS `rom`;
CREATE TABLE `rom`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WEEK` int(1) NULL DEFAULT NULL,
  `BULAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BLN` int(11) NOT NULL,
  `TAHUN` int(11) NOT NULL,
  `FILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIPE` int(1) NOT NULL,
  `STATUS` int(1) NOT NULL,
  `CREATED_BY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rom
-- ----------------------------

-- ----------------------------
-- Table structure for rot
-- ----------------------------
DROP TABLE IF EXISTS `rot`;
CREATE TABLE `rot`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TAHUN` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIPE` int(1) NOT NULL,
  `STATUS` int(1) NULL DEFAULT NULL,
  `CREATED_BY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rot
-- ----------------------------

-- ----------------------------
-- Table structure for upload_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `upload_pegawai`;
CREATE TABLE `upload_pegawai`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUS` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of upload_pegawai
-- ----------------------------
INSERT INTO `upload_pegawai` VALUES (1, 'file_pegawai_2023-08-24_16-59-46.xlsx', 'EXE', 'Miftahu Choirul Burhan', '2023-08-24 16:59:46');

-- ----------------------------
-- Table structure for upload_pegawai_log
-- ----------------------------
DROP TABLE IF EXISTS `upload_pegawai_log`;
CREATE TABLE `upload_pegawai_log`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UPLOAD_ID` int(11) NOT NULL,
  `NIP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USERNAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FULLNAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  `SHORT_ORG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LONG_ORG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SHORT_TITLE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LONG_TITLE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TIPE` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of upload_pegawai_log
-- ----------------------------
INSERT INTO `upload_pegawai_log` VALUES (1, 1, '9223009ZEY', 'rika.susanti', 'Rika Susanti', 'rika.susanti@plnepi.co.id', 12, 'BAG DMA', 'BAGIAN DATA MANAGEMENT & ANALYTICS', 'SOF DMA', 'SENIOR OFFICER DATA MANAGEMENT DAN ANALYTICS', 'INSERT');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FULLNAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `PASSWORD` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `IMAGE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COMPANY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `DEPARTMENT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `SHORT_TITLE` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LONG_TITLE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NIP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `EMPLOYEE_NUMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ORG_ID` int(11) NULL DEFAULT NULL,
  `SHORT_ORG` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LONG_ORG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NO_HP` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `TYPE_USER` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CHANGED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CHANGED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'miftahu.burhan', 'Miftahu Choirul Burhan', 'miftahu.burhan@plnepi.co.id', '$2y$10$fa8iofygv7H2x1eQmRKY6em8p.E8D2gaMZqchkpiB.ryax3tmdLVO', 'user_Umhxc2ZDeHlpc1JpYWNIUVdzNG1sZz09_20230825192734.png', NULL, NULL, 'PLT ASMAN SDSS', 'PLT ASSISTANT MANAGER SERVICE DESK & SHARED SERVICES', '91161239ZY', NULL, 5, 'BAG SDSS', 'BAGIAN SERVICE DESK & SHARED SERVICES', '0811910212', 'AD', 1, 'Miftahu Choirul Burhan', '2023-08-22 15:30:23', 'Miftahu Choirul Burhan', '2023-09-06 09:48:42');
INSERT INTO `user` VALUES (3, 'odi.sefriadi', 'Odi Sefriadi', 'odi.sefriadi@plnepi.co.id', '$2y$10$NDieBBQ/sJwqTrn2FPuLiO8ApQ7B1PPJP/OD1RfL6idjV80lgzBeS', 'user_d0FLTjcxR05LaTRUNDlHc0pQMmtPdz09_20230825145256.jpg', NULL, NULL, 'ASMAN DMA', 'ASSISTANT MANAGER DATA MANAGEMENT & ANALYTICS', '8811711Z', NULL, 12, 'BAG DMA', 'BAGIAN DATA MANAGEMENT & ANALYTICS', '081271947272', 'AD', 1, 'Miftahu Choirul Burhan', '2023-08-23 23:52:32', 'Miftahu Choirul Burhan', '2023-08-25 14:52:56');
INSERT INTO `user` VALUES (6, 'wirawan.hidayat', 'Wirawan Hidayat', 'wirawan.hidayat@plnepi.co.id', '$2y$10$YPvhOVeJMeJBK6cdMrHbN.yZTZODcnajGprZBw0MODYPYXgBSgQR2', 'user_eVlJZUtkeWJzc3JtNjVZZzVGenJ0UT09_20230824181717.png', NULL, NULL, 'ASMAN IATECH', 'ASSISTANT MANAGER ENTERPRISE IT ARCHITECTURE & SOLUTION TECHNOLOGY', '8912704ZY', NULL, 11, 'BAG IATECH', 'BAGIAN ENTERPRISE IT ARCHITECTURE & SOLUTION TECHNOLOGY', '08111844430', 'AD', 1, 'Miftahu Choirul Burhan', '2023-08-24 14:03:13', 'Wirawan Hidayat', '2023-08-24 18:17:17');
INSERT INTO `user` VALUES (8, 'rika.susanti', 'Rika Susanti', 'rika.susanti@plnepi.co.id', '$2y$10$Qfl5AwNkl8PuVfKD3T/XUue/h3hRAXxm1Ot193c5EG6GGi2fH7TYm', 'default.png', NULL, NULL, 'SOF DMA', 'SENIOR OFFICER DATA MANAGEMENT DAN ANALYTICS', '9223009ZEY', NULL, 12, 'BAG DMA', 'BAGIAN DATA MANAGEMENT & ANALYTICS', NULL, 'AD', 1, 'SYSTEM', '2023-08-24 17:23:18', 'Rika Susanti', '2023-08-28 08:50:58');
INSERT INTO `user` VALUES (9, 'rachel.panjaitan', 'Rachel Panjaitan', 'rachel.panjaitan@plnepi.co.id', '$2y$10$df9eq90zB1SmP3ZV.F5WderOdRWXNm/v8xFr/ZTRCFqyuv3R.ikTO', 'default.png', NULL, NULL, 'OF MANAJEMEN ENERGI PRIMER', 'OF MANAJEMEN ENERGI PRIMER', '9620044BA', NULL, 20, 'SUB BID P2 EPI', 'SUB BIDANG PUSAT PENGATUR ENERGI PRIMER', '08531761418', 'AD', 1, 'Miftahu Choirul Burhan', '2023-08-28 08:54:13', 'Rachel Panjaitan', '2023-08-28 09:30:00');

-- ----------------------------
-- Table structure for user_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROLE_ID` int(11) NOT NULL,
  `SUB_MENU_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `ROLE_ID`(`ROLE_ID`) USING BTREE,
  INDEX `SUB_MENU_ID`(`SUB_MENU_ID`) USING BTREE,
  CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`ROLE_ID`) REFERENCES `user_role` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`SUB_MENU_ID`) REFERENCES `user_sub_menu` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 260 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_access_menu
-- ----------------------------
INSERT INTO `user_access_menu` VALUES (154, 12, 114);
INSERT INTO `user_access_menu` VALUES (155, 12, 115);
INSERT INTO `user_access_menu` VALUES (156, 12, 116);
INSERT INTO `user_access_menu` VALUES (157, 12, 117);
INSERT INTO `user_access_menu` VALUES (158, 12, 118);
INSERT INTO `user_access_menu` VALUES (159, 12, 119);
INSERT INTO `user_access_menu` VALUES (160, 12, 120);
INSERT INTO `user_access_menu` VALUES (161, 12, 121);
INSERT INTO `user_access_menu` VALUES (162, 12, 122);
INSERT INTO `user_access_menu` VALUES (163, 12, 123);
INSERT INTO `user_access_menu` VALUES (164, 12, 124);
INSERT INTO `user_access_menu` VALUES (165, 12, 125);
INSERT INTO `user_access_menu` VALUES (166, 12, 126);
INSERT INTO `user_access_menu` VALUES (167, 12, 127);
INSERT INTO `user_access_menu` VALUES (168, 12, 128);
INSERT INTO `user_access_menu` VALUES (169, 12, 129);
INSERT INTO `user_access_menu` VALUES (170, 12, 135);
INSERT INTO `user_access_menu` VALUES (171, 12, 130);
INSERT INTO `user_access_menu` VALUES (172, 12, 131);
INSERT INTO `user_access_menu` VALUES (173, 12, 132);
INSERT INTO `user_access_menu` VALUES (174, 12, 133);
INSERT INTO `user_access_menu` VALUES (175, 12, 134);
INSERT INTO `user_access_menu` VALUES (176, 12, 136);
INSERT INTO `user_access_menu` VALUES (177, 12, 137);
INSERT INTO `user_access_menu` VALUES (178, 12, 138);
INSERT INTO `user_access_menu` VALUES (179, 12, 139);
INSERT INTO `user_access_menu` VALUES (180, 12, 140);
INSERT INTO `user_access_menu` VALUES (181, 12, 141);
INSERT INTO `user_access_menu` VALUES (182, 12, 142);
INSERT INTO `user_access_menu` VALUES (183, 12, 143);
INSERT INTO `user_access_menu` VALUES (184, 12, 144);
INSERT INTO `user_access_menu` VALUES (185, 12, 145);
INSERT INTO `user_access_menu` VALUES (186, 12, 146);
INSERT INTO `user_access_menu` VALUES (187, 12, 147);
INSERT INTO `user_access_menu` VALUES (188, 12, 148);
INSERT INTO `user_access_menu` VALUES (189, 11, 149);
INSERT INTO `user_access_menu` VALUES (191, 11, 134);
INSERT INTO `user_access_menu` VALUES (192, 11, 150);
INSERT INTO `user_access_menu` VALUES (193, 13, 151);
INSERT INTO `user_access_menu` VALUES (194, 13, 152);
INSERT INTO `user_access_menu` VALUES (195, 13, 153);
INSERT INTO `user_access_menu` VALUES (196, 13, 154);
INSERT INTO `user_access_menu` VALUES (197, 13, 155);
INSERT INTO `user_access_menu` VALUES (198, 12, 156);
INSERT INTO `user_access_menu` VALUES (199, 12, 157);
INSERT INTO `user_access_menu` VALUES (200, 12, 158);
INSERT INTO `user_access_menu` VALUES (201, 12, 159);
INSERT INTO `user_access_menu` VALUES (202, 12, 160);
INSERT INTO `user_access_menu` VALUES (203, 12, 161);
INSERT INTO `user_access_menu` VALUES (204, 12, 162);
INSERT INTO `user_access_menu` VALUES (205, 12, 163);
INSERT INTO `user_access_menu` VALUES (206, 12, 164);
INSERT INTO `user_access_menu` VALUES (207, 12, 165);
INSERT INTO `user_access_menu` VALUES (208, 12, 166);
INSERT INTO `user_access_menu` VALUES (209, 12, 167);
INSERT INTO `user_access_menu` VALUES (210, 12, 168);
INSERT INTO `user_access_menu` VALUES (211, 12, 169);
INSERT INTO `user_access_menu` VALUES (212, 12, 170);
INSERT INTO `user_access_menu` VALUES (213, 12, 171);
INSERT INTO `user_access_menu` VALUES (214, 12, 172);
INSERT INTO `user_access_menu` VALUES (215, 14, 173);
INSERT INTO `user_access_menu` VALUES (216, 14, 174);
INSERT INTO `user_access_menu` VALUES (217, 14, 175);
INSERT INTO `user_access_menu` VALUES (218, 14, 176);
INSERT INTO `user_access_menu` VALUES (219, 15, 173);
INSERT INTO `user_access_menu` VALUES (220, 15, 174);
INSERT INTO `user_access_menu` VALUES (221, 15, 177);
INSERT INTO `user_access_menu` VALUES (222, 15, 178);
INSERT INTO `user_access_menu` VALUES (223, 14, 177);
INSERT INTO `user_access_menu` VALUES (224, 14, 179);
INSERT INTO `user_access_menu` VALUES (225, 14, 180);
INSERT INTO `user_access_menu` VALUES (226, 14, 181);
INSERT INTO `user_access_menu` VALUES (228, 15, 179);
INSERT INTO `user_access_menu` VALUES (229, 15, 180);
INSERT INTO `user_access_menu` VALUES (235, 14, 189);
INSERT INTO `user_access_menu` VALUES (236, 15, 190);
INSERT INTO `user_access_menu` VALUES (237, 15, 191);
INSERT INTO `user_access_menu` VALUES (238, 14, 190);
INSERT INTO `user_access_menu` VALUES (239, 14, 192);
INSERT INTO `user_access_menu` VALUES (240, 14, 193);
INSERT INTO `user_access_menu` VALUES (241, 14, 194);
INSERT INTO `user_access_menu` VALUES (242, 14, 195);
INSERT INTO `user_access_menu` VALUES (243, 14, 196);
INSERT INTO `user_access_menu` VALUES (244, 15, 192);
INSERT INTO `user_access_menu` VALUES (245, 15, 193);
INSERT INTO `user_access_menu` VALUES (246, 15, 196);
INSERT INTO `user_access_menu` VALUES (247, 15, 197);
INSERT INTO `user_access_menu` VALUES (248, 11, 198);
INSERT INTO `user_access_menu` VALUES (249, 11, 199);
INSERT INTO `user_access_menu` VALUES (250, 15, 200);
INSERT INTO `user_access_menu` VALUES (251, 15, 201);
INSERT INTO `user_access_menu` VALUES (252, 15, 202);
INSERT INTO `user_access_menu` VALUES (253, 15, 203);
INSERT INTO `user_access_menu` VALUES (254, 15, 204);
INSERT INTO `user_access_menu` VALUES (255, 15, 206);
INSERT INTO `user_access_menu` VALUES (256, 15, 207);
INSERT INTO `user_access_menu` VALUES (257, 15, 208);
INSERT INTO `user_access_menu` VALUES (258, 15, 209);
INSERT INTO `user_access_menu` VALUES (259, 15, 210);

-- ----------------------------
-- Table structure for user_activity_log
-- ----------------------------
DROP TABLE IF EXISTS `user_activity_log`;
CREATE TABLE `user_activity_log`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MODUL` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ACTION` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ICON` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `COLOR` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BROWSER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `VER` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PLATFORM` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IP` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `USER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 371 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_activity_log
-- ----------------------------
INSERT INTO `user_activity_log` VALUES (1, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:26:47');
INSERT INTO `user_activity_log` VALUES (2, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:27:08');
INSERT INTO `user_activity_log` VALUES (3, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:41:58');
INSERT INTO `user_activity_log` VALUES (4, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:42:13');
INSERT INTO `user_activity_log` VALUES (5, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #1</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:44:09');
INSERT INTO `user_activity_log` VALUES (6, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:44:16');
INSERT INTO `user_activity_log` VALUES (7, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:44:21');
INSERT INTO `user_activity_log` VALUES (8, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:46:34');
INSERT INTO `user_activity_log` VALUES (9, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:46:37');
INSERT INTO `user_activity_log` VALUES (10, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #127</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 23:49:56');
INSERT INTO `user_activity_log` VALUES (11, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 23:50:28');
INSERT INTO `user_activity_log` VALUES (12, 'User', 'ADD', 'ti-user', 'success', 'Menambah data <strong>User</strong> dengan <strong>ID #3</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 23:52:32');
INSERT INTO `user_activity_log` VALUES (13, 'User', 'ADD', 'ti-user', 'success', 'Menambah data <strong>User</strong> dengan <strong>ID #4</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-23 23:55:54');
INSERT INTO `user_activity_log` VALUES (14, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 00:02:09');
INSERT INTO `user_activity_log` VALUES (15, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>wirawan.hidayat</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 4, 'Wirawan Hidayat', '2023-08-24 00:03:11');
INSERT INTO `user_activity_log` VALUES (16, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>wirawan.hidayat</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 4, 'Wirawan Hidayat', '2023-08-24 00:03:19');
INSERT INTO `user_activity_log` VALUES (17, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 09:51:57');
INSERT INTO `user_activity_log` VALUES (18, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #128</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:04:49');
INSERT INTO `user_activity_log` VALUES (19, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #129</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:19:44');
INSERT INTO `user_activity_log` VALUES (20, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #130</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:20:57');
INSERT INTO `user_activity_log` VALUES (21, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #131</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:21:24');
INSERT INTO `user_activity_log` VALUES (22, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #132</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:22:04');
INSERT INTO `user_activity_log` VALUES (23, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #133</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:22:24');
INSERT INTO `user_activity_log` VALUES (24, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #134</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:22:55');
INSERT INTO `user_activity_log` VALUES (25, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #135</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:23:10');
INSERT INTO `user_activity_log` VALUES (26, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:23:20');
INSERT INTO `user_activity_log` VALUES (27, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:23:21');
INSERT INTO `user_activity_log` VALUES (28, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:23:30');
INSERT INTO `user_activity_log` VALUES (29, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:41:59');
INSERT INTO `user_activity_log` VALUES (30, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 10:48:41');
INSERT INTO `user_activity_log` VALUES (31, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Status User</strong> dengan <strong>ID #3</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 11:03:34');
INSERT INTO `user_activity_log` VALUES (32, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Status User</strong> dengan <strong>ID #3</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 11:03:41');
INSERT INTO `user_activity_log` VALUES (33, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 11:05:53');
INSERT INTO `user_activity_log` VALUES (34, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Foto </strong> dengan <strong>ID #4</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 11:13:36');
INSERT INTO `user_activity_log` VALUES (35, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 13:34:04');
INSERT INTO `user_activity_log` VALUES (38, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #4</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 13:59:38');
INSERT INTO `user_activity_log` VALUES (39, 'User', 'DELETE', 'ti-user', 'danger', 'Menghapus data <strong>User</strong> dengan <strong>ID #2</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 14:00:21');
INSERT INTO `user_activity_log` VALUES (40, 'User', 'DELETE', 'ti-user', 'danger', 'Menghapus data <strong>User</strong> dengan <strong>ID #4</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 14:01:23');
INSERT INTO `user_activity_log` VALUES (41, 'User', 'ADD', 'ti-user', 'success', 'Menambah data <strong>User</strong> dengan <strong>ID #5</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 14:02:31');
INSERT INTO `user_activity_log` VALUES (42, 'User', 'DELETE', 'ti-user', 'danger', 'Menghapus data <strong>User</strong> dengan <strong>ID #5</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 14:02:35');
INSERT INTO `user_activity_log` VALUES (43, 'User', 'ADD', 'ti-user', 'success', 'Menambah data <strong>User</strong> dengan <strong>ID #6</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 14:03:13');
INSERT INTO `user_activity_log` VALUES (44, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:08:17');
INSERT INTO `user_activity_log` VALUES (45, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #136</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:13:56');
INSERT INTO `user_activity_log` VALUES (46, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #137</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:14:14');
INSERT INTO `user_activity_log` VALUES (47, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:14:38');
INSERT INTO `user_activity_log` VALUES (48, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:14:41');
INSERT INTO `user_activity_log` VALUES (49, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #138</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:15:28');
INSERT INTO `user_activity_log` VALUES (50, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #139</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:15:43');
INSERT INTO `user_activity_log` VALUES (51, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #140</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:16:09');
INSERT INTO `user_activity_log` VALUES (52, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #141</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:17:07');
INSERT INTO `user_activity_log` VALUES (53, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #142</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:26:37');
INSERT INTO `user_activity_log` VALUES (54, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #143</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:27:08');
INSERT INTO `user_activity_log` VALUES (55, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:33:56');
INSERT INTO `user_activity_log` VALUES (56, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:34:18');
INSERT INTO `user_activity_log` VALUES (57, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:34:20');
INSERT INTO `user_activity_log` VALUES (58, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:34:22');
INSERT INTO `user_activity_log` VALUES (59, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:34:25');
INSERT INTO `user_activity_log` VALUES (60, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:34:28');
INSERT INTO `user_activity_log` VALUES (61, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #144</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:23:50');
INSERT INTO `user_activity_log` VALUES (62, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:24:02');
INSERT INTO `user_activity_log` VALUES (63, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah <strong>Status</strong> data <strong>Sub Menu</strong> dengan <strong>ID #144</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:25:17');
INSERT INTO `user_activity_log` VALUES (64, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #144</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:25:39');
INSERT INTO `user_activity_log` VALUES (65, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #145</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:31:59');
INSERT INTO `user_activity_log` VALUES (66, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #146</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:32:20');
INSERT INTO `user_activity_log` VALUES (67, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #147</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:32:44');
INSERT INTO `user_activity_log` VALUES (68, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #148</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:33:04');
INSERT INTO `user_activity_log` VALUES (69, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:34:10');
INSERT INTO `user_activity_log` VALUES (70, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:34:15');
INSERT INTO `user_activity_log` VALUES (71, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:34:21');
INSERT INTO `user_activity_log` VALUES (72, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:34:24');
INSERT INTO `user_activity_log` VALUES (73, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:35:35');
INSERT INTO `user_activity_log` VALUES (74, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:41:59');
INSERT INTO `user_activity_log` VALUES (75, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #149</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:43:46');
INSERT INTO `user_activity_log` VALUES (76, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #11</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:43:54');
INSERT INTO `user_activity_log` VALUES (77, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:48:07');
INSERT INTO `user_activity_log` VALUES (78, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>wirawan.hidayat</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 17:48:12');
INSERT INTO `user_activity_log` VALUES (79, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>wirawan.hidayat</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 17:48:44');
INSERT INTO `user_activity_log` VALUES (80, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>wirawan.hidayat</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 17:48:52');
INSERT INTO `user_activity_log` VALUES (81, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:49:18');
INSERT INTO `user_activity_log` VALUES (82, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #11</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:49:34');
INSERT INTO `user_activity_log` VALUES (83, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #11</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 17:50:40');
INSERT INTO `user_activity_log` VALUES (84, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>wirawan.hidayat</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 17:50:58');
INSERT INTO `user_activity_log` VALUES (85, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>wirawan.hidayat</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 17:51:03');
INSERT INTO `user_activity_log` VALUES (87, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #150</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:07:26');
INSERT INTO `user_activity_log` VALUES (95, 'User', 'UPDATE', 'ti-user', 'primary', 'User <strong>wirawan.hidayat</strong> mengubah <strong>Foto</strong> pada Profile', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 18:17:17');
INSERT INTO `user_activity_log` VALUES (96, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>wirawan.hidayat</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-24 18:19:43');
INSERT INTO `user_activity_log` VALUES (97, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:19:50');
INSERT INTO `user_activity_log` VALUES (98, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data Menu dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:22:58');
INSERT INTO `user_activity_log` VALUES (99, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #151</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:23:24');
INSERT INTO `user_activity_log` VALUES (100, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #152</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:23:42');
INSERT INTO `user_activity_log` VALUES (101, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #153</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:23:53');
INSERT INTO `user_activity_log` VALUES (102, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #154</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:24:08');
INSERT INTO `user_activity_log` VALUES (103, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #155</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:24:21');
INSERT INTO `user_activity_log` VALUES (104, 'User', 'ADD', 'ti-user', 'success', 'Menambah data  dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:24:45');
INSERT INTO `user_activity_log` VALUES (105, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:24:51');
INSERT INTO `user_activity_log` VALUES (106, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:24:54');
INSERT INTO `user_activity_log` VALUES (107, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:24:58');
INSERT INTO `user_activity_log` VALUES (108, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:25:03');
INSERT INTO `user_activity_log` VALUES (109, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:25:09');
INSERT INTO `user_activity_log` VALUES (110, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #1</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:25:23');
INSERT INTO `user_activity_log` VALUES (111, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:25:26');
INSERT INTO `user_activity_log` VALUES (112, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:25:31');
INSERT INTO `user_activity_log` VALUES (113, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #151</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:25:53');
INSERT INTO `user_activity_log` VALUES (114, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:32:09');
INSERT INTO `user_activity_log` VALUES (115, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #13</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:34:24');
INSERT INTO `user_activity_log` VALUES (116, 'Master', 'ADD', 'ti-server', 'success', 'Menambah data  dengan <strong>ID #165</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:50:08');
INSERT INTO `user_activity_log` VALUES (117, 'Master', 'DELETE', 'ti-server', 'danger', 'Menghapus data Organisasi dengan <strong>ID #165</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:50:18');
INSERT INTO `user_activity_log` VALUES (118, 'Master', 'ADD', 'ti-server', 'success', 'Menambah data  dengan <strong>ID #166</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:50:41');
INSERT INTO `user_activity_log` VALUES (119, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 10:09:57');
INSERT INTO `user_activity_log` VALUES (120, 'Master', 'UPDATE', 'ti-server', 'primary', 'Mengubah data  dengan <strong>ID #50</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 10:44:55');
INSERT INTO `user_activity_log` VALUES (121, 'Master', 'UPDATE', 'ti-server', 'primary', 'Mengubah data  dengan <strong>ID #50</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 10:45:01');
INSERT INTO `user_activity_log` VALUES (122, 'Master', 'UPDATE', 'ti-server', 'primary', 'Mengubah data <strong>Master Organisasi</strong> dengan <strong>ID #166</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 10:47:48');
INSERT INTO `user_activity_log` VALUES (123, 'Master', 'DELETE', 'ti-server', 'danger', 'Menghapus data <strong>Master Organisasi</strong> dengan <strong>ID #166</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 10:47:55');
INSERT INTO `user_activity_log` VALUES (124, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data Menu dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:01:01');
INSERT INTO `user_activity_log` VALUES (125, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #156</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:02:10');
INSERT INTO `user_activity_log` VALUES (126, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:02:23');
INSERT INTO `user_activity_log` VALUES (127, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #157</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:09:02');
INSERT INTO `user_activity_log` VALUES (128, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:09:18');
INSERT INTO `user_activity_log` VALUES (129, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #158</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:14:46');
INSERT INTO `user_activity_log` VALUES (130, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:14:56');
INSERT INTO `user_activity_log` VALUES (131, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #159</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:26:25');
INSERT INTO `user_activity_log` VALUES (132, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #160</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:29:56');
INSERT INTO `user_activity_log` VALUES (133, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:35:41');
INSERT INTO `user_activity_log` VALUES (134, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:35:45');
INSERT INTO `user_activity_log` VALUES (135, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #159</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:35:57');
INSERT INTO `user_activity_log` VALUES (136, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>NAMA APPS</strong> dari <strong>GOTIG</strong> menjadi <strong>KONTOL</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:50:17');
INSERT INTO `user_activity_log` VALUES (137, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>NAMA APPS</strong> dari <strong>KONTOL</strong> menjadi <strong>P2EP Data Store</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:50:31');
INSERT INTO `user_activity_log` VALUES (138, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:54:40');
INSERT INTO `user_activity_log` VALUES (139, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 12:03:00');
INSERT INTO `user_activity_log` VALUES (140, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>LOGO BIG APPS</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:06:27');
INSERT INTO `user_activity_log` VALUES (141, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>BACKGROUND APPS</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:11:44');
INSERT INTO `user_activity_log` VALUES (142, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>BACKGROUND APPS</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:21:03');
INSERT INTO `user_activity_log` VALUES (143, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #161</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:24:01');
INSERT INTO `user_activity_log` VALUES (144, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:24:08');
INSERT INTO `user_activity_log` VALUES (145, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>BACKGROUND APPS</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:27:26');
INSERT INTO `user_activity_log` VALUES (146, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #162</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:32:44');
INSERT INTO `user_activity_log` VALUES (147, 'User', 'UPDATE', 'ti-user', 'success', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:32:52');
INSERT INTO `user_activity_log` VALUES (148, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #163</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:43:09');
INSERT INTO `user_activity_log` VALUES (149, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #164</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:43:26');
INSERT INTO `user_activity_log` VALUES (150, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #165</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:43:43');
INSERT INTO `user_activity_log` VALUES (151, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #165</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:43:55');
INSERT INTO `user_activity_log` VALUES (152, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #166</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:44:09');
INSERT INTO `user_activity_log` VALUES (153, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:44:20');
INSERT INTO `user_activity_log` VALUES (154, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:44:23');
INSERT INTO `user_activity_log` VALUES (155, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:44:25');
INSERT INTO `user_activity_log` VALUES (156, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:44:27');
INSERT INTO `user_activity_log` VALUES (157, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>BACKUP DB</strong> dengan nama <strong>backup_2023-08-25_14-49-04.zip</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:49:04');
INSERT INTO `user_activity_log` VALUES (158, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>BACKUP DB</strong> dengan nama <strong>backup_2023-08-25_14-50-52.zip</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:50:52');
INSERT INTO `user_activity_log` VALUES (159, 'Tools', 'DOWNLOAD', 'ti-settings', 'secondary', 'Mengunduh <strong>BACKUP DB</strong> dengan nama <strong>backup_2023-08-25_14-50-52.zip</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:51:04');
INSERT INTO `user_activity_log` VALUES (160, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Foto </strong> dengan <strong>ID #3</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:52:56');
INSERT INTO `user_activity_log` VALUES (161, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #3</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:53:15');
INSERT INTO `user_activity_log` VALUES (162, 'Tools', 'DOWNLOAD', 'ti-settings', 'dark', 'Mengunduh <strong>BACKUP DB</strong> dengan nama <strong>backup_2023-08-25_14-50-52.zip</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 15:05:02');
INSERT INTO `user_activity_log` VALUES (163, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #167</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:09:33');
INSERT INTO `user_activity_log` VALUES (164, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #168</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:09:50');
INSERT INTO `user_activity_log` VALUES (165, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #169</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:10:08');
INSERT INTO `user_activity_log` VALUES (166, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #170</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:10:24');
INSERT INTO `user_activity_log` VALUES (167, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #171</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:10:42');
INSERT INTO `user_activity_log` VALUES (168, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #172</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:10:58');
INSERT INTO `user_activity_log` VALUES (169, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:11:09');
INSERT INTO `user_activity_log` VALUES (170, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:11:11');
INSERT INTO `user_activity_log` VALUES (171, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:12:15');
INSERT INTO `user_activity_log` VALUES (172, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:22:16');
INSERT INTO `user_activity_log` VALUES (173, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>Version Apps</strong> menjadi <strong>v1.0.1</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:20:07');
INSERT INTO `user_activity_log` VALUES (174, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>Version Apps</strong> menjadi <strong>v1.1.1</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:20:25');
INSERT INTO `user_activity_log` VALUES (175, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>Version Apps</strong> menjadi <strong>v1.0.0</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:22:50');
INSERT INTO `user_activity_log` VALUES (176, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:23:40');
INSERT INTO `user_activity_log` VALUES (177, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #12</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:23:45');
INSERT INTO `user_activity_log` VALUES (178, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>Version Apps v1.0.0</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:56:09');
INSERT INTO `user_activity_log` VALUES (179, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>Version Apps v1.0.0</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 18:56:14');
INSERT INTO `user_activity_log` VALUES (180, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>Version Apps</strong> menjadi <strong>v2.0.0</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:01:22');
INSERT INTO `user_activity_log` VALUES (181, 'Tools', 'DELETE', 'ti-settings', 'danger', 'Menghapus Version <strong>v2.0.0</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:01:26');
INSERT INTO `user_activity_log` VALUES (182, 'Tools', 'ADD', 'ti-settings', 'success', 'Menambah <strong>Version Apps</strong> menjadi <strong>v1.0.0</strong> pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:02:13');
INSERT INTO `user_activity_log` VALUES (183, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:08:47');
INSERT INTO `user_activity_log` VALUES (184, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:17:00');
INSERT INTO `user_activity_log` VALUES (185, 'User', 'UPDATE', 'ti-user', 'primary', 'User <strong>miftahu.burhan</strong> mengubah <strong>Foto</strong> pada Profile', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:27:34');
INSERT INTO `user_activity_log` VALUES (186, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #173</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:41:00');
INSERT INTO `user_activity_log` VALUES (187, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #174</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:41:28');
INSERT INTO `user_activity_log` VALUES (188, 'User', 'ADD', 'ti-user', 'success', 'Menambah data  dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:42:43');
INSERT INTO `user_activity_log` VALUES (189, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>wirawan.hidayat</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 6, 'Wirawan Hidayat', '2023-08-25 19:59:44');
INSERT INTO `user_activity_log` VALUES (190, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:48:48');
INSERT INTO `user_activity_log` VALUES (191, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah data  dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:49:21');
INSERT INTO `user_activity_log` VALUES (192, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:49:32');
INSERT INTO `user_activity_log` VALUES (193, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:49:33');
INSERT INTO `user_activity_log` VALUES (194, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #1</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:49:48');
INSERT INTO `user_activity_log` VALUES (195, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:49:53');
INSERT INTO `user_activity_log` VALUES (196, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:50:00');
INSERT INTO `user_activity_log` VALUES (197, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #173</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 12:51:05');
INSERT INTO `user_activity_log` VALUES (198, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #175</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 13:00:30');
INSERT INTO `user_activity_log` VALUES (199, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 13:01:06');
INSERT INTO `user_activity_log` VALUES (200, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 13:58:43');
INSERT INTO `user_activity_log` VALUES (201, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:05:36');
INSERT INTO `user_activity_log` VALUES (202, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:06:37');
INSERT INTO `user_activity_log` VALUES (203, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:06:50');
INSERT INTO `user_activity_log` VALUES (204, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:07:01');
INSERT INTO `user_activity_log` VALUES (205, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:07:10');
INSERT INTO `user_activity_log` VALUES (206, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:07:25');
INSERT INTO `user_activity_log` VALUES (207, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:08:35');
INSERT INTO `user_activity_log` VALUES (208, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:28:55');
INSERT INTO `user_activity_log` VALUES (209, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:30:08');
INSERT INTO `user_activity_log` VALUES (210, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:32:30');
INSERT INTO `user_activity_log` VALUES (211, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:32:42');
INSERT INTO `user_activity_log` VALUES (212, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:32:49');
INSERT INTO `user_activity_log` VALUES (213, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:33:31');
INSERT INTO `user_activity_log` VALUES (214, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:33:48');
INSERT INTO `user_activity_log` VALUES (215, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 14:40:22');
INSERT INTO `user_activity_log` VALUES (216, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 15:38:55');
INSERT INTO `user_activity_log` VALUES (217, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 16:44:37');
INSERT INTO `user_activity_log` VALUES (218, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #176</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:25:31');
INSERT INTO `user_activity_log` VALUES (219, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #177</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:26:19');
INSERT INTO `user_activity_log` VALUES (220, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #178</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:26:37');
INSERT INTO `user_activity_log` VALUES (221, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:27:56');
INSERT INTO `user_activity_log` VALUES (222, 'User', 'ADD', 'ti-user', 'success', 'Menambah data  dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:28:16');
INSERT INTO `user_activity_log` VALUES (223, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:28:30');
INSERT INTO `user_activity_log` VALUES (224, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:28:33');
INSERT INTO `user_activity_log` VALUES (225, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:28:36');
INSERT INTO `user_activity_log` VALUES (226, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:28:40');
INSERT INTO `user_activity_log` VALUES (227, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:29:03');
INSERT INTO `user_activity_log` VALUES (228, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #179</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:31:54');
INSERT INTO `user_activity_log` VALUES (229, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:32:06');
INSERT INTO `user_activity_log` VALUES (230, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #180</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:33:00');
INSERT INTO `user_activity_log` VALUES (231, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:33:08');
INSERT INTO `user_activity_log` VALUES (232, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #181</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:40:05');
INSERT INTO `user_activity_log` VALUES (233, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #182</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:40:18');
INSERT INTO `user_activity_log` VALUES (234, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #183</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:40:32');
INSERT INTO `user_activity_log` VALUES (235, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:40:55');
INSERT INTO `user_activity_log` VALUES (236, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Bulanan</strong> Periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 18:46:36');
INSERT INTO `user_activity_log` VALUES (237, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Bulanan</strong> Periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 18:47:43');
INSERT INTO `user_activity_log` VALUES (238, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 18:48:11');
INSERT INTO `user_activity_log` VALUES (239, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Bulanan</strong> Periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 18:53:33');
INSERT INTO `user_activity_log` VALUES (240, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #1</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:04:32');
INSERT INTO `user_activity_log` VALUES (241, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:04:49');
INSERT INTO `user_activity_log` VALUES (242, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:05:36');
INSERT INTO `user_activity_log` VALUES (243, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:06:06');
INSERT INTO `user_activity_log` VALUES (244, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>ROT</strong> tahun  <strong>2024</strong> dengan nama file ROT_S_2024_02.xlsx', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:07:11');
INSERT INTO `user_activity_log` VALUES (245, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:07:31');
INSERT INTO `user_activity_log` VALUES (246, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>ROT</strong> tahun  <strong>2024</strong> dengan nama file ROT_S_2024_02.xlsx', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:07:38');
INSERT INTO `user_activity_log` VALUES (247, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:08:31');
INSERT INTO `user_activity_log` VALUES (248, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>ROT</strong> tahun  <strong>2024</strong> dengan nama file ROT_S_2024_02.xlsx', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:08:54');
INSERT INTO `user_activity_log` VALUES (249, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Tahunan</strong> tahun <strong>#2024</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:10:55');
INSERT INTO `user_activity_log` VALUES (250, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data  Rencana Operasi Tahunan tahun <strong>2024</strong> dengan nama file <strong>ROT_S_2024_02.xlsx</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:10:57');
INSERT INTO `user_activity_log` VALUES (251, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:15:34');
INSERT INTO `user_activity_log` VALUES (252, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:15:35');
INSERT INTO `user_activity_log` VALUES (253, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:15:37');
INSERT INTO `user_activity_log` VALUES (254, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:15:40');
INSERT INTO `user_activity_log` VALUES (255, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong> dengan nama file <strong>ROB_S_8_2023_02.xlsx</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:16:13');
INSERT INTO `user_activity_log` VALUES (256, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:16:57');
INSERT INTO `user_activity_log` VALUES (257, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong> dengan nama file <strong>ROB_F_8_2023_01.xlsx</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:22:14');
INSERT INTO `user_activity_log` VALUES (258, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #184</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:26:22');
INSERT INTO `user_activity_log` VALUES (259, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #185</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:26:48');
INSERT INTO `user_activity_log` VALUES (260, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:27:00');
INSERT INTO `user_activity_log` VALUES (261, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:27:02');
INSERT INTO `user_activity_log` VALUES (262, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong> dengan nama file <strong>ROB_S_8_2023_01.xlsx</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:35:13');
INSERT INTO `user_activity_log` VALUES (263, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #186</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:35:59');
INSERT INTO `user_activity_log` VALUES (264, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #187</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:36:12');
INSERT INTO `user_activity_log` VALUES (265, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #188</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:36:24');
INSERT INTO `user_activity_log` VALUES (266, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:37:34');
INSERT INTO `user_activity_log` VALUES (267, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #189</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:46:12');
INSERT INTO `user_activity_log` VALUES (268, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:46:47');
INSERT INTO `user_activity_log` VALUES (269, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:46:52');
INSERT INTO `user_activity_log` VALUES (270, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:46:54');
INSERT INTO `user_activity_log` VALUES (271, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:46:57');
INSERT INTO `user_activity_log` VALUES (272, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:08');
INSERT INTO `user_activity_log` VALUES (273, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:12');
INSERT INTO `user_activity_log` VALUES (274, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #182</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:25');
INSERT INTO `user_activity_log` VALUES (275, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #183</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:27');
INSERT INTO `user_activity_log` VALUES (276, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #184</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:30');
INSERT INTO `user_activity_log` VALUES (277, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #185</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:32');
INSERT INTO `user_activity_log` VALUES (278, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #186</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:36');
INSERT INTO `user_activity_log` VALUES (279, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #187</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:38');
INSERT INTO `user_activity_log` VALUES (280, 'Menu', 'DELETE', 'ti-menu', 'danger', 'Menghapus data <strong>Sub Menu</strong> dengan <strong>ID #188</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:42');
INSERT INTO `user_activity_log` VALUES (281, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:47:54');
INSERT INTO `user_activity_log` VALUES (282, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #190</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:48:20');
INSERT INTO `user_activity_log` VALUES (283, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #191</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:48:37');
INSERT INTO `user_activity_log` VALUES (284, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #190</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:49:20');
INSERT INTO `user_activity_log` VALUES (285, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #191</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:49:29');
INSERT INTO `user_activity_log` VALUES (286, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:49:42');
INSERT INTO `user_activity_log` VALUES (287, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:49:45');
INSERT INTO `user_activity_log` VALUES (288, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #192</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:50:04');
INSERT INTO `user_activity_log` VALUES (289, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #193</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:50:20');
INSERT INTO `user_activity_log` VALUES (290, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #194</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:50:35');
INSERT INTO `user_activity_log` VALUES (291, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #195</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:50:52');
INSERT INTO `user_activity_log` VALUES (292, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #196</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:04');
INSERT INTO `user_activity_log` VALUES (293, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #197</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:16');
INSERT INTO `user_activity_log` VALUES (294, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:30');
INSERT INTO `user_activity_log` VALUES (295, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:34');
INSERT INTO `user_activity_log` VALUES (296, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:37');
INSERT INTO `user_activity_log` VALUES (297, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:39');
INSERT INTO `user_activity_log` VALUES (298, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:43');
INSERT INTO `user_activity_log` VALUES (299, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:51:46');
INSERT INTO `user_activity_log` VALUES (300, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:52:00');
INSERT INTO `user_activity_log` VALUES (301, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:52:03');
INSERT INTO `user_activity_log` VALUES (302, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:52:06');
INSERT INTO `user_activity_log` VALUES (303, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:52:08');
INSERT INTO `user_activity_log` VALUES (304, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:56:55');
INSERT INTO `user_activity_log` VALUES (305, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Mingguan</strong> periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:59:13');
INSERT INTO `user_activity_log` VALUES (306, 'Rencana Operasi', 'DELETE', 'ti-bolt', 'danger', 'Menghapus data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong> dengan nama file <strong>ROB_S_8_2023_01.xlsx</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:18:39');
INSERT INTO `user_activity_log` VALUES (307, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Bulanan</strong> periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:18:51');
INSERT INTO `user_activity_log` VALUES (308, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #8</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:41:30');
INSERT INTO `user_activity_log` VALUES (309, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #6</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:41:38');
INSERT INTO `user_activity_log` VALUES (310, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #3</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:41:43');
INSERT INTO `user_activity_log` VALUES (311, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #198</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:56:55');
INSERT INTO `user_activity_log` VALUES (312, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #11</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:57:03');
INSERT INTO `user_activity_log` VALUES (313, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #199</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 21:07:24');
INSERT INTO `user_activity_log` VALUES (314, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #11</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 21:07:36');
INSERT INTO `user_activity_log` VALUES (315, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>LOGO BIG APPS</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 21:34:55');
INSERT INTO `user_activity_log` VALUES (316, 'Tools', 'UPDATE', 'ti-settings', 'primary', 'Mengubah <strong>LOGO BIG APPS</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-27 21:38:59');
INSERT INTO `user_activity_log` VALUES (317, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>rika.susanti</strong> login pada sistem', 'Chrome', '116.0.0.0', 'Windows 10', '10.60.103.20', 8, 'Rika Susanti', '2023-08-28 08:50:58');
INSERT INTO `user_activity_log` VALUES (318, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-28 08:52:48');
INSERT INTO `user_activity_log` VALUES (319, 'User', 'ADD', 'ti-user', 'success', 'Menambah data <strong>User</strong> dengan <strong>ID #9</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-28 08:54:13');
INSERT INTO `user_activity_log` VALUES (320, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Role User</strong> dengan <strong>ID #9</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-28 08:54:21');
INSERT INTO `user_activity_log` VALUES (321, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>rachel.panjaitan</strong> login pada sistem', 'Chrome', '116.0.0.0', 'Windows 10', '10.60.101.127', 9, 'Rachel Panjaitan', '2023-08-28 09:30:00');
INSERT INTO `user_activity_log` VALUES (322, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-29 15:28:45');
INSERT INTO `user_activity_log` VALUES (323, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-30 10:19:55');
INSERT INTO `user_activity_log` VALUES (324, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-08-30 13:47:22');
INSERT INTO `user_activity_log` VALUES (325, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-01 13:30:23');
INSERT INTO `user_activity_log` VALUES (326, 'Rencana Operasi', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Rencana Operasi Mingguan</strong> periode <strong>September 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-01 13:40:23');
INSERT INTO `user_activity_log` VALUES (327, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah data  dengan <strong>ID #14</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-01 13:51:59');
INSERT INTO `user_activity_log` VALUES (328, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 09:21:03');
INSERT INTO `user_activity_log` VALUES (329, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong>Menu</strong> dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:28:48');
INSERT INTO `user_activity_log` VALUES (330, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #200</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:29:18');
INSERT INTO `user_activity_log` VALUES (331, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #201</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:29:49');
INSERT INTO `user_activity_log` VALUES (332, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:30:07');
INSERT INTO `user_activity_log` VALUES (333, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:30:12');
INSERT INTO `user_activity_log` VALUES (334, 'User', 'LOGOUT', 'ti-user', 'warning', 'User <strong>miftahu.burhan</strong> logout pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:31:19');
INSERT INTO `user_activity_log` VALUES (335, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:31:26');
INSERT INTO `user_activity_log` VALUES (336, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #202</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:34:52');
INSERT INTO `user_activity_log` VALUES (337, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #203</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:35:21');
INSERT INTO `user_activity_log` VALUES (338, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #204</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:35:46');
INSERT INTO `user_activity_log` VALUES (339, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #205</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:36:06');
INSERT INTO `user_activity_log` VALUES (340, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #200</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:38:45');
INSERT INTO `user_activity_log` VALUES (341, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #201</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:39:04');
INSERT INTO `user_activity_log` VALUES (342, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:39:22');
INSERT INTO `user_activity_log` VALUES (343, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:39:25');
INSERT INTO `user_activity_log` VALUES (344, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Transaksi Biomassa</strong> periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:45:45');
INSERT INTO `user_activity_log` VALUES (345, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Transaksi Biomassa</strong> periode <strong>Agustus 2023</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:47:20');
INSERT INTO `user_activity_log` VALUES (346, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:57:52');
INSERT INTO `user_activity_log` VALUES (347, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #200</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:58:11');
INSERT INTO `user_activity_log` VALUES (348, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #201</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:58:17');
INSERT INTO `user_activity_log` VALUES (349, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #202</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:58:25');
INSERT INTO `user_activity_log` VALUES (350, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #203</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:58:32');
INSERT INTO `user_activity_log` VALUES (351, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #204</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:58:39');
INSERT INTO `user_activity_log` VALUES (352, 'Menu', 'UPDATE', 'ti-menu', 'primary', 'Mengubah data <strong></strong> dengan <strong>ID #205</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:58:50');
INSERT INTO `user_activity_log` VALUES (353, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:12:47');
INSERT INTO `user_activity_log` VALUES (354, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #206</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:30:56');
INSERT INTO `user_activity_log` VALUES (355, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #207</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:31:23');
INSERT INTO `user_activity_log` VALUES (356, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #208</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:31:48');
INSERT INTO `user_activity_log` VALUES (357, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #209</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:32:15');
INSERT INTO `user_activity_log` VALUES (358, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #210</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:32:39');
INSERT INTO `user_activity_log` VALUES (359, 'Menu', 'ADD', 'ti-menu', 'success', 'Menambah data <strong></strong> dengan <strong>ID #211</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:32:56');
INSERT INTO `user_activity_log` VALUES (360, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:33:56');
INSERT INTO `user_activity_log` VALUES (361, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:34:02');
INSERT INTO `user_activity_log` VALUES (362, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:44:18');
INSERT INTO `user_activity_log` VALUES (363, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:44:23');
INSERT INTO `user_activity_log` VALUES (364, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Master Biomassa</strong> data <strong>PEMBANGKIT</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 15:19:01');
INSERT INTO `user_activity_log` VALUES (365, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Master Biomassa</strong> data <strong>PEMBANGKIT</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 15:20:34');
INSERT INTO `user_activity_log` VALUES (366, 'User', 'UPDATE', 'ti-user', 'primary', 'Mengubah <strong>Akses</strong> Role dengan <strong>ID #15</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 15:20:50');
INSERT INTO `user_activity_log` VALUES (367, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Master Biomassa</strong> data <strong>KONTRAK</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 15:42:58');
INSERT INTO `user_activity_log` VALUES (368, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Master Biomassa</strong> data <strong>KONTRAK</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 15:43:38');
INSERT INTO `user_activity_log` VALUES (369, 'Biomassa', 'ADD', 'ti-bolt', 'success', 'Menambah data <strong>Master Biomassa</strong> data <strong>AMANDEMEN</strong>', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-05 16:00:49');
INSERT INTO `user_activity_log` VALUES (370, 'User', 'LOGIN', 'ti-user', 'info', 'User <strong>miftahu.burhan</strong> login pada sistem', 'Chrome', '115.0.0.0', 'Windows 10', '::1', 1, 'Miftahu Choirul Burhan', '2023-09-06 09:48:42');

-- ----------------------------
-- Table structure for user_group_role
-- ----------------------------
DROP TABLE IF EXISTS `user_group_role`;
CREATE TABLE `user_group_role`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `USER_ID`(`USER_ID`) USING BTREE,
  INDEX `ROLE_ID`(`ROLE_ID`) USING BTREE,
  CONSTRAINT `user_group_role_ibfk_2` FOREIGN KEY (`ROLE_ID`) REFERENCES `user_role` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_group_role_ibfk_3` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_group_role
-- ----------------------------
INSERT INTO `user_group_role` VALUES (1, 1, 11);
INSERT INTO `user_group_role` VALUES (4, 1, 12);
INSERT INTO `user_group_role` VALUES (7, 8, 11);
INSERT INTO `user_group_role` VALUES (8, 6, 11);
INSERT INTO `user_group_role` VALUES (9, 1, 13);
INSERT INTO `user_group_role` VALUES (10, 3, 11);
INSERT INTO `user_group_role` VALUES (11, 1, 14);
INSERT INTO `user_group_role` VALUES (12, 1, 15);
INSERT INTO `user_group_role` VALUES (13, 8, 15);
INSERT INTO `user_group_role` VALUES (14, 6, 15);
INSERT INTO `user_group_role` VALUES (15, 3, 15);
INSERT INTO `user_group_role` VALUES (16, 9, 14);

-- ----------------------------
-- Table structure for user_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MENU` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ICON` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SEQUENCE` int(2) NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CHANGED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CHANGED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_menu
-- ----------------------------
INSERT INTO `user_menu` VALUES (9, 'Home', 'ti-home', 1, 'Miftahu Choirul Burhan', '2023-08-21 18:47:54', 'Miftahu Choirul Burhan', '2023-08-21 18:47:54');
INSERT INTO `user_menu` VALUES (10, 'Rencana Operasi', 'ti-bolt', 2, 'Miftahu Choirul Burhan', '2023-08-21 18:52:15', 'Miftahu Choirul Burhan', '2023-08-21 18:52:15');
INSERT INTO `user_menu` VALUES (11, 'User', 'ti-user', 4, 'Miftahu Choirul Burhan', '2023-08-21 18:53:53', 'Miftahu Choirul Burhan', '2023-08-21 18:53:53');
INSERT INTO `user_menu` VALUES (12, 'Menu', 'ti-menu', 5, 'Miftahu Choirul Burhan', '2023-08-21 18:54:33', 'Miftahu Choirul Burhan', '2023-08-21 18:54:33');
INSERT INTO `user_menu` VALUES (13, 'Master', 'ti-server', 6, 'Miftahu Choirul Burhan', '2023-08-24 18:22:58', 'Miftahu Choirul Burhan', '2023-08-24 18:22:58');
INSERT INTO `user_menu` VALUES (14, 'Tools', 'ti-settings', 7, 'Miftahu Choirul Burhan', '2023-08-25 11:01:01', 'Miftahu Choirul Burhan', '2023-08-25 11:01:01');
INSERT INTO `user_menu` VALUES (15, 'Biomassa', 'ti-bolt', 3, 'Miftahu Choirul Burhan', '2023-09-04 15:28:48', 'Miftahu Choirul Burhan', '2023-09-04 15:28:48');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROLE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CHANGED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CHANGED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (11, 'Pegawai', 'Miftahu Choirul Burhan', '2023-08-22 15:58:25', 'Miftahu Choirul Burhan', '2023-08-22 15:58:27');
INSERT INTO `user_role` VALUES (12, 'Superadmin', 'Miftahu Choirul Burhan', '2023-08-22 19:35:25', '', '2023-08-22 19:35:25');
INSERT INTO `user_role` VALUES (13, 'Master', 'Miftahu Choirul Burhan', '2023-08-24 18:24:45', 'Miftahu Choirul Burhan', '2023-08-24 18:24:45');
INSERT INTO `user_role` VALUES (14, 'Data Uploader', 'Miftahu Choirul Burhan', '2023-08-25 19:42:43', 'Miftahu Choirul Burhan', '2023-08-25 19:42:43');
INSERT INTO `user_role` VALUES (15, 'Admin TIG', 'Miftahu Choirul Burhan', '2023-08-27 17:28:16', 'Miftahu Choirul Burhan', '2023-08-27 17:28:16');

-- ----------------------------
-- Table structure for user_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MENU_ID` int(11) NOT NULL,
  `TITLE` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SUB_MENU` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `URL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CLASS_METHOD` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  `CREATED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CREATED_ON` datetime NOT NULL,
  `CHANGED_BY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CHANGED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `MENU_ID`(`MENU_ID`) USING BTREE,
  CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`MENU_ID`) REFERENCES `user_menu` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 212 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_sub_menu
-- ----------------------------
INSERT INTO `user_sub_menu` VALUES (114, 12, 'Menu', 'index', 'menu', 'menu/index', 1, 'Miftahu Choirul Burhan', '2023-08-21 19:55:25', 'Miftahu Choirul Burhan', '2023-08-21 19:55:25');
INSERT INTO `user_sub_menu` VALUES (115, 12, 'Get Data Menu', 'get_data', 'menu/get_data', 'menu/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-22 15:44:45', 'Miftahu Choirul Burhan', '2023-08-22 15:44:45');
INSERT INTO `user_sub_menu` VALUES (116, 12, 'Add Menu', 'add', 'menu/add', 'menu/add', 0, 'Miftahu Choirul Burhan', '2023-08-22 15:46:20', 'Miftahu Choirul Burhan', '2023-08-22 15:46:20');
INSERT INTO `user_sub_menu` VALUES (117, 12, 'Edit Menu', 'edit', 'menu/edit', 'menu/edit', 0, 'Miftahu Choirul Burhan', '2023-08-22 15:47:26', 'Miftahu Choirul Burhan', '2023-08-22 15:47:26');
INSERT INTO `user_sub_menu` VALUES (118, 12, 'Delete Menu', 'delete', 'menu/delete', 'menu/delete', 0, 'Miftahu Choirul Burhan', '2023-08-22 15:47:48', 'Miftahu Choirul Burhan', '2023-08-22 15:47:48');
INSERT INTO `user_sub_menu` VALUES (119, 12, 'Sub Menu', 'submenu', 'submenu', 'submenu/index', 1, 'Miftahu Choirul Burhan', '2023-08-23 10:40:34', 'Miftahu Choirul Burhan', '2023-08-23 10:40:34');
INSERT INTO `user_sub_menu` VALUES (120, 12, 'Get Data Sub Menu', 'get_data', 'submenu/get_data', 'submenu/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-23 10:40:57', 'Miftahu Choirul Burhan', '2023-08-23 10:40:57');
INSERT INTO `user_sub_menu` VALUES (121, 12, 'Add Sub Menu', 'add', 'submenu/add', 'submenu/add', 0, 'Miftahu Choirul Burhan', '2023-08-23 10:42:16', 'Miftahu Choirul Burhan', '2023-08-23 10:42:16');
INSERT INTO `user_sub_menu` VALUES (122, 12, 'Edit Sub Menu', 'edit', 'submenu/edit', 'submenu/edit', 0, 'Miftahu Choirul Burhan', '2023-08-23 10:42:38', 'Miftahu Choirul Burhan', '2023-08-23 10:42:38');
INSERT INTO `user_sub_menu` VALUES (123, 12, 'Change Status Sub Menu', 'change_status', 'submenu/change_status', 'submenu/change_status', 0, 'Miftahu Choirul Burhan', '2023-08-23 10:43:07', 'Miftahu Choirul Burhan', '2023-08-23 10:43:07');
INSERT INTO `user_sub_menu` VALUES (124, 12, 'Delete Sub Menu', 'delete', 'submenu/delete', 'submenu/delete', 0, 'Miftahu Choirul Burhan', '2023-08-23 10:43:25', 'Miftahu Choirul Burhan', '2023-08-23 10:43:25');
INSERT INTO `user_sub_menu` VALUES (125, 11, 'User', 'index', 'user', 'user/index', 1, 'Miftahu Choirul Burhan', '2023-08-23 21:46:04', 'Miftahu Choirul Burhan', '2023-08-23 21:46:04');
INSERT INTO `user_sub_menu` VALUES (126, 11, 'Get Data User', 'get_data', 'user/get_data', 'user/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-23 21:46:23', 'Miftahu Choirul Burhan', '2023-08-23 21:46:23');
INSERT INTO `user_sub_menu` VALUES (127, 11, 'Add User', 'add', 'user/add', 'user/add', 0, 'Miftahu Choirul Burhan', '2023-08-23 23:49:56', 'Miftahu Choirul Burhan', '2023-08-23 23:49:56');
INSERT INTO `user_sub_menu` VALUES (128, 11, 'Edit User', 'edit', 'user/edit', 'user/edit', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:04:49', 'Miftahu Choirul Burhan', '2023-08-24 10:04:49');
INSERT INTO `user_sub_menu` VALUES (129, 11, 'Detail User', 'detail', 'user/detail', 'user/detail', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:19:44', 'Miftahu Choirul Burhan', '2023-08-24 10:19:44');
INSERT INTO `user_sub_menu` VALUES (130, 11, 'Change User Role', 'change_user_role', 'user/change_user_role', 'user/change_user_role', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:20:57', 'Miftahu Choirul Burhan', '2023-08-24 10:20:57');
INSERT INTO `user_sub_menu` VALUES (131, 11, 'Change Status User', 'change_status', 'user/change_status', 'user/change_status', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:21:24', 'Miftahu Choirul Burhan', '2023-08-24 10:21:24');
INSERT INTO `user_sub_menu` VALUES (132, 11, 'Change Photo User', 'change_photo', 'user/change_photo', 'user/change_photo', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:22:04', 'Miftahu Choirul Burhan', '2023-08-24 10:22:04');
INSERT INTO `user_sub_menu` VALUES (133, 11, 'Change Password', 'change_password', 'user/change_password', 'user/change_password', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:22:24', 'Miftahu Choirul Burhan', '2023-08-24 10:22:24');
INSERT INTO `user_sub_menu` VALUES (134, 11, 'Get Data Log User', 'get_data_log', 'user/get_data_log', 'user/get_data_log', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:22:55', 'Miftahu Choirul Burhan', '2023-08-24 10:22:55');
INSERT INTO `user_sub_menu` VALUES (135, 11, 'Delete User', 'delete', 'user/delete', 'user/delete', 0, 'Miftahu Choirul Burhan', '2023-08-24 10:23:10', 'Miftahu Choirul Burhan', '2023-08-24 10:23:10');
INSERT INTO `user_sub_menu` VALUES (136, 11, 'Role', 'index', 'role', 'role/index', 1, 'Miftahu Choirul Burhan', '2023-08-24 15:13:56', 'Miftahu Choirul Burhan', '2023-08-24 15:13:56');
INSERT INTO `user_sub_menu` VALUES (137, 11, 'Get Data Role', 'get_data', 'role/get_data', 'role/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:14:14', 'Miftahu Choirul Burhan', '2023-08-24 15:14:14');
INSERT INTO `user_sub_menu` VALUES (138, 11, 'Add Role', 'add', 'role/add', 'role/add', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:15:28', 'Miftahu Choirul Burhan', '2023-08-24 15:15:28');
INSERT INTO `user_sub_menu` VALUES (139, 11, 'Edit Role', 'edit', 'role/edit', 'role/edit', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:15:43', 'Miftahu Choirul Burhan', '2023-08-24 15:15:43');
INSERT INTO `user_sub_menu` VALUES (140, 11, 'Delete Role', 'delete', 'role/delete', 'role/delete', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:16:09', 'Miftahu Choirul Burhan', '2023-08-24 15:16:09');
INSERT INTO `user_sub_menu` VALUES (141, 11, 'Access Role', 'access', 'role/access', 'role/access', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:17:07', 'Miftahu Choirul Burhan', '2023-08-24 15:17:07');
INSERT INTO `user_sub_menu` VALUES (142, 11, 'Get Data Access Role', 'get_data_access', 'role/get_data_access', 'role/get_data_access', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:26:37', 'Miftahu Choirul Burhan', '2023-08-24 15:26:37');
INSERT INTO `user_sub_menu` VALUES (143, 11, 'Change Access Role', 'change_access', 'role/change_access', 'role/change_access', 0, 'Miftahu Choirul Burhan', '2023-08-24 15:27:08', 'Miftahu Choirul Burhan', '2023-08-24 15:27:08');
INSERT INTO `user_sub_menu` VALUES (144, 11, 'User Upload', 'upload', 'user/upload', 'user/upload', 1, 'Miftahu Choirul Burhan', '2023-08-24 16:23:50', 'Miftahu Choirul Burhan', '2023-08-24 16:23:50');
INSERT INTO `user_sub_menu` VALUES (145, 11, 'Do Upload User', 'do_upload', 'user/do_upload', 'user/do_upload', 0, 'Miftahu Choirul Burhan', '2023-08-24 16:31:59', 'Miftahu Choirul Burhan', '2023-08-24 16:31:59');
INSERT INTO `user_sub_menu` VALUES (146, 11, 'Detail Upload User', 'detail_upload', 'user/detail_upload', 'user/detail_upload', 0, 'Miftahu Choirul Burhan', '2023-08-24 16:32:20', 'Miftahu Choirul Burhan', '2023-08-24 16:32:20');
INSERT INTO `user_sub_menu` VALUES (147, 11, 'Exe Upload User', 'exe_upload', 'user/exe_upload', 'user/exe_upload', 0, 'Miftahu Choirul Burhan', '2023-08-24 16:32:44', 'Miftahu Choirul Burhan', '2023-08-24 16:32:44');
INSERT INTO `user_sub_menu` VALUES (148, 11, 'Download Template User', 'download_template', 'user/download_template', 'user/download_template', 0, 'Miftahu Choirul Burhan', '2023-08-24 16:33:04', 'Miftahu Choirul Burhan', '2023-08-24 16:33:04');
INSERT INTO `user_sub_menu` VALUES (149, 11, 'Profile User', 'myprofile', 'myprofile', 'user/profile', 0, 'Miftahu Choirul Burhan', '2023-08-24 17:43:46', 'Miftahu Choirul Burhan', '2023-08-24 17:43:46');
INSERT INTO `user_sub_menu` VALUES (150, 11, 'Change Photo Profile User', 'change_photo_profile', 'user/change_photo_profile', 'user/change_photo_profile', 0, 'Miftahu Choirul Burhan', '2023-08-24 18:07:26', 'Miftahu Choirul Burhan', '2023-08-24 18:07:26');
INSERT INTO `user_sub_menu` VALUES (151, 13, 'Organisasi', 'index', 'org', 'org/index', 1, 'Miftahu Choirul Burhan', '2023-08-24 18:23:24', 'Miftahu Choirul Burhan', '2023-08-24 18:23:24');
INSERT INTO `user_sub_menu` VALUES (152, 13, 'Get Data Organisasi', 'get_data', 'org/get_data', 'org/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-24 18:23:42', 'Miftahu Choirul Burhan', '2023-08-24 18:23:42');
INSERT INTO `user_sub_menu` VALUES (153, 13, 'Add Organisasi', 'add', 'org/add', 'org/add', 0, 'Miftahu Choirul Burhan', '2023-08-24 18:23:53', 'Miftahu Choirul Burhan', '2023-08-24 18:23:53');
INSERT INTO `user_sub_menu` VALUES (154, 13, 'Edit Organisasi', 'edit', 'org/edit', 'org/edit', 0, 'Miftahu Choirul Burhan', '2023-08-24 18:24:08', 'Miftahu Choirul Burhan', '2023-08-24 18:24:08');
INSERT INTO `user_sub_menu` VALUES (155, 13, 'Delete Organisasi', 'delete', 'org/delete', 'org/delete', 0, 'Miftahu Choirul Burhan', '2023-08-24 18:24:21', 'Miftahu Choirul Burhan', '2023-08-24 18:24:21');
INSERT INTO `user_sub_menu` VALUES (156, 14, 'Apps', 'apps', 'tools/apps', 'tools/apps', 1, 'Miftahu Choirul Burhan', '2023-08-25 11:02:10', 'Miftahu Choirul Burhan', '2023-08-25 11:02:10');
INSERT INTO `user_sub_menu` VALUES (157, 14, 'Change Name Apps', 'change_name_apps', 'tools/change_name_apps', 'tools/change_name_apps', 0, 'Miftahu Choirul Burhan', '2023-08-25 11:09:02', 'Miftahu Choirul Burhan', '2023-08-25 11:09:02');
INSERT INTO `user_sub_menu` VALUES (158, 14, 'Change Logo Apps', 'change_logo_apps', 'tools/change_logo_apps', 'tools/change_logo_apps', 0, 'Miftahu Choirul Burhan', '2023-08-25 11:14:46', 'Miftahu Choirul Burhan', '2023-08-25 11:14:46');
INSERT INTO `user_sub_menu` VALUES (159, 14, 'Change Logo Big Apps', 'change_logobig_apps', 'tools/change_logobig_apps', 'tools/change_logobig_apps', 0, 'Miftahu Choirul Burhan', '2023-08-25 11:26:25', 'Miftahu Choirul Burhan', '2023-08-25 11:26:25');
INSERT INTO `user_sub_menu` VALUES (160, 14, 'Change BG Apps', 'change_bg_apps', 'tools/change_bg_apps', 'tools/change_bg_apps', 0, 'Miftahu Choirul Burhan', '2023-08-25 11:29:56', 'Miftahu Choirul Burhan', '2023-08-25 11:29:56');
INSERT INTO `user_sub_menu` VALUES (161, 14, 'Activity Log', 'activity_log', 'tools/activity_log', 'tools/activity_log', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:24:01', 'Miftahu Choirul Burhan', '2023-08-25 14:24:01');
INSERT INTO `user_sub_menu` VALUES (162, 14, 'Get Data Activity Log', 'get_activity_log', 'tools/get_activity_log', 'tools/get_activity_log', 0, 'Miftahu Choirul Burhan', '2023-08-25 14:32:44', 'Miftahu Choirul Burhan', '2023-08-25 14:32:44');
INSERT INTO `user_sub_menu` VALUES (163, 14, 'Backup DB', 'backup', 'tools/backup', 'tools/backup', 1, 'Miftahu Choirul Burhan', '2023-08-25 14:43:09', 'Miftahu Choirul Burhan', '2023-08-25 14:43:09');
INSERT INTO `user_sub_menu` VALUES (164, 14, 'Get Data Backup DB', 'get_data_backup', 'tools/get_data_backup', 'tools/get_data_backup', 0, 'Miftahu Choirul Burhan', '2023-08-25 14:43:26', 'Miftahu Choirul Burhan', '2023-08-25 14:43:26');
INSERT INTO `user_sub_menu` VALUES (165, 14, 'Add Backup DB', 'add_backup_db', 'tools/add_backup_db', 'tools/add_backup_db', 0, 'Miftahu Choirul Burhan', '2023-08-25 14:43:43', 'Miftahu Choirul Burhan', '2023-08-25 14:43:43');
INSERT INTO `user_sub_menu` VALUES (166, 14, 'Download Backup DB', 'download_backup_db', 'tools/download_backup_db', 'tools/download_backup_db', 0, 'Miftahu Choirul Burhan', '2023-08-25 14:44:09', 'Miftahu Choirul Burhan', '2023-08-25 14:44:09');
INSERT INTO `user_sub_menu` VALUES (167, 14, 'Version', 'ver', 'tools/ver', 'tools/ver', 1, 'Miftahu Choirul Burhan', '2023-08-25 17:09:33', 'Miftahu Choirul Burhan', '2023-08-25 17:09:33');
INSERT INTO `user_sub_menu` VALUES (168, 14, 'Get Data Version', 'get_data_ver', 'tools/get_data_ver', 'tools/get_data_ver', 0, 'Miftahu Choirul Burhan', '2023-08-25 17:09:50', 'Miftahu Choirul Burhan', '2023-08-25 17:09:50');
INSERT INTO `user_sub_menu` VALUES (169, 14, 'Add Version', 'add_ver', 'tools/add_ver', 'tools/add_ver', 0, 'Miftahu Choirul Burhan', '2023-08-25 17:10:08', 'Miftahu Choirul Burhan', '2023-08-25 17:10:08');
INSERT INTO `user_sub_menu` VALUES (170, 14, 'Edit Version', 'edit_ver', 'tools/edit_ver', 'tools/edit_ver', 0, 'Miftahu Choirul Burhan', '2023-08-25 17:10:24', 'Miftahu Choirul Burhan', '2023-08-25 17:10:24');
INSERT INTO `user_sub_menu` VALUES (171, 14, 'Detail Version', 'detail_ver', 'tools/detail_ver', 'tools/detail_ver', 0, 'Miftahu Choirul Burhan', '2023-08-25 17:10:42', 'Miftahu Choirul Burhan', '2023-08-25 17:10:42');
INSERT INTO `user_sub_menu` VALUES (172, 14, 'Delete Version', 'delete_ver', 'tools/delete_ver', 'tools/delete_ver', 0, 'Miftahu Choirul Burhan', '2023-08-25 17:10:58', 'Miftahu Choirul Burhan', '2023-08-25 17:10:58');
INSERT INTO `user_sub_menu` VALUES (173, 10, 'ROT', 'index', 'rot', 'rot/index', 1, 'Miftahu Choirul Burhan', '2023-08-25 19:41:00', 'Miftahu Choirul Burhan', '2023-08-25 19:41:00');
INSERT INTO `user_sub_menu` VALUES (174, 10, 'Get Data ROT', 'get_data', 'rot/get_data', 'rot/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-25 19:41:28', 'Miftahu Choirul Burhan', '2023-08-25 19:41:28');
INSERT INTO `user_sub_menu` VALUES (175, 10, 'Add ROT', 'add', 'rot/add', 'rot/add', 0, 'Miftahu Choirul Burhan', '2023-08-27 13:00:30', 'Miftahu Choirul Burhan', '2023-08-27 13:00:30');
INSERT INTO `user_sub_menu` VALUES (176, 10, 'Do Upload ROT', 'do_upload', 'rot/do_upload', 'rot/do_upload', 0, 'Miftahu Choirul Burhan', '2023-08-27 17:25:31', 'Miftahu Choirul Burhan', '2023-08-27 17:25:31');
INSERT INTO `user_sub_menu` VALUES (177, 10, 'Detail ROT', 'detail', 'rot/detail', 'rot/detail', 0, 'Miftahu Choirul Burhan', '2023-08-27 17:26:19', 'Miftahu Choirul Burhan', '2023-08-27 17:26:19');
INSERT INTO `user_sub_menu` VALUES (178, 10, 'Delete ROT', 'delete', 'rot/delete', 'rot/delete', 0, 'Miftahu Choirul Burhan', '2023-08-27 17:26:37', 'Miftahu Choirul Burhan', '2023-08-27 17:26:37');
INSERT INTO `user_sub_menu` VALUES (179, 10, 'ROB', 'index', 'rob', 'rob/index', 1, 'Miftahu Choirul Burhan', '2023-08-27 17:31:54', 'Miftahu Choirul Burhan', '2023-08-27 17:31:54');
INSERT INTO `user_sub_menu` VALUES (180, 10, 'Get Data ROB', 'get_data', 'rob/get_data', 'rob/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-27 17:33:00', 'Miftahu Choirul Burhan', '2023-08-27 17:33:00');
INSERT INTO `user_sub_menu` VALUES (181, 10, 'Add ROB', 'add', 'rob/add', 'rob/add', 0, 'Miftahu Choirul Burhan', '2023-08-27 17:40:05', 'Miftahu Choirul Burhan', '2023-08-27 17:40:05');
INSERT INTO `user_sub_menu` VALUES (189, 10, 'Do Upload ROB', 'do_upload', 'rob/do_upload', 'rob/do_upload', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:46:12', 'Miftahu Choirul Burhan', '2023-08-27 19:46:12');
INSERT INTO `user_sub_menu` VALUES (190, 10, 'Detail ROB', 'detail', 'rob/detail', 'rob/detail', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:48:20', 'Miftahu Choirul Burhan', '2023-08-27 19:48:20');
INSERT INTO `user_sub_menu` VALUES (191, 10, 'Delete ROB', 'delete', 'rob/delete', 'rob/delete', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:48:37', 'Miftahu Choirul Burhan', '2023-08-27 19:48:37');
INSERT INTO `user_sub_menu` VALUES (192, 10, 'ROM', 'index', 'rom', 'rom/index', 1, 'Miftahu Choirul Burhan', '2023-08-27 19:50:04', 'Miftahu Choirul Burhan', '2023-08-27 19:50:04');
INSERT INTO `user_sub_menu` VALUES (193, 10, 'Get Data ROM', 'get_data', 'rom/get_data', 'rom/get_data', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:50:20', 'Miftahu Choirul Burhan', '2023-08-27 19:50:20');
INSERT INTO `user_sub_menu` VALUES (194, 10, 'Add ROM', 'add', 'rom/add', 'rom/add', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:50:35', 'Miftahu Choirul Burhan', '2023-08-27 19:50:35');
INSERT INTO `user_sub_menu` VALUES (195, 10, 'Do Upload ROM', 'do_upload', 'rom/do_upload', 'rom/do_upload', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:50:52', 'Miftahu Choirul Burhan', '2023-08-27 19:50:52');
INSERT INTO `user_sub_menu` VALUES (196, 10, 'Detail ROM', 'detail', 'rom/detail', 'rom/detail', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:51:04', 'Miftahu Choirul Burhan', '2023-08-27 19:51:04');
INSERT INTO `user_sub_menu` VALUES (197, 10, 'Delete ROM', 'delete', 'rom/delete', 'rom/delete', 0, 'Miftahu Choirul Burhan', '2023-08-27 19:51:16', 'Miftahu Choirul Burhan', '2023-08-27 19:51:16');
INSERT INTO `user_sub_menu` VALUES (198, 9, 'Home', 'index', 'home', 'home/index', 1, 'Miftahu Choirul Burhan', '2023-08-27 20:56:55', 'Miftahu Choirul Burhan', '2023-08-27 20:56:55');
INSERT INTO `user_sub_menu` VALUES (199, 14, 'Changelog', 'changelog', 'tools/changelog', 'tools/changelog', 0, 'Miftahu Choirul Burhan', '2023-08-27 21:07:24', 'Miftahu Choirul Burhan', '2023-08-27 21:07:24');
INSERT INTO `user_sub_menu` VALUES (200, 15, 'Transaksi Bio', 'index', 'bio_trans', 'bio_trans/index', 1, 'Miftahu Choirul Burhan', '2023-09-04 15:29:18', 'Miftahu Choirul Burhan', '2023-09-04 15:29:18');
INSERT INTO `user_sub_menu` VALUES (201, 15, 'Get Data Transaksi Bio', 'get_data', 'bio_trans/get_data', 'bio_trans/get_data', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:29:49', 'Miftahu Choirul Burhan', '2023-09-04 15:29:49');
INSERT INTO `user_sub_menu` VALUES (202, 15, 'Add Transaksi Bio', 'add', 'bio_trans/add', 'bio_trans/add', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:34:52', 'Miftahu Choirul Burhan', '2023-09-04 15:34:52');
INSERT INTO `user_sub_menu` VALUES (203, 15, 'Do Upload Transaksi Bio', 'do_upload', 'bio_trans/do_upload', 'bio_trans/do_upload', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:35:21', 'Miftahu Choirul Burhan', '2023-09-04 15:35:21');
INSERT INTO `user_sub_menu` VALUES (204, 15, 'Detail Transaksi Bio', 'detail', 'bio_trans/detail', 'bio_trans/detail', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:35:46', 'Miftahu Choirul Burhan', '2023-09-04 15:35:46');
INSERT INTO `user_sub_menu` VALUES (205, 15, 'Delete Transasi Bio', 'delete', 'bio_trans/delete', 'bio_trans/delete', 0, 'Miftahu Choirul Burhan', '2023-09-04 15:36:06', 'Miftahu Choirul Burhan', '2023-09-04 15:36:06');
INSERT INTO `user_sub_menu` VALUES (206, 15, 'Master Bio', 'index', 'bio_master', 'bio_master/index', 1, 'Miftahu Choirul Burhan', '2023-09-05 14:30:56', 'Miftahu Choirul Burhan', '2023-09-05 14:30:56');
INSERT INTO `user_sub_menu` VALUES (207, 15, 'Get Data Master Bio', 'get_data', 'bio_master/get_data', 'bio_master/get_data', 0, 'Miftahu Choirul Burhan', '2023-09-05 14:31:23', 'Miftahu Choirul Burhan', '2023-09-05 14:31:23');
INSERT INTO `user_sub_menu` VALUES (208, 15, 'Add Master Bio', 'add', 'bio_master/add', 'bio_master/add', 0, 'Miftahu Choirul Burhan', '2023-09-05 14:31:48', 'Miftahu Choirul Burhan', '2023-09-05 14:31:48');
INSERT INTO `user_sub_menu` VALUES (209, 15, 'Do Upload Master Bio', 'do_upload', 'bio_master/do_upload', 'bio_master/do_upload', 0, 'Miftahu Choirul Burhan', '2023-09-05 14:32:15', 'Miftahu Choirul Burhan', '2023-09-05 14:32:15');
INSERT INTO `user_sub_menu` VALUES (210, 15, 'Detail Master Bio', 'detail', 'bio_master/detail', 'bio_master/detail', 0, 'Miftahu Choirul Burhan', '2023-09-05 14:32:39', 'Miftahu Choirul Burhan', '2023-09-05 14:32:39');
INSERT INTO `user_sub_menu` VALUES (211, 15, 'Delete Master Bio', 'delete', 'bio_master/delete', 'bio_master/delete', 0, 'Miftahu Choirul Burhan', '2023-09-05 14:32:56', 'Miftahu Choirul Burhan', '2023-09-05 14:32:56');

SET FOREIGN_KEY_CHECKS = 1;
