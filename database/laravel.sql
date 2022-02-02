-- MySQL dump 10.13  Distrib 5.7.36, for osx10.15 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `has_order` tinyint(1) DEFAULT '0',
  `total` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_FK` (`users_id`),
  KEY `cart_FK_1` (`product_id`),
  CONSTRAINT `cart_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  CONSTRAINT `cart_FK_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (23,1,4,2,'2022-01-13 05:01:01','2022-01-13 04:59:43',1,3800000,1900000),(24,1,2,1,'2022-01-13 05:05:04','2022-01-13 05:04:00',1,2000000,2000000),(25,1,3,1,'2022-01-13 05:44:29','2022-01-13 05:44:22',1,2500000,2500000),(27,1,3,1,'2022-01-13 07:54:35','2022-01-13 07:42:05',1,2500000,2500000),(28,1,5,1,'2022-01-13 07:56:08','2022-01-13 07:55:53',1,2800000,2800000),(29,1,7,1,'2022-01-13 07:56:08','2022-01-13 07:56:00',1,800000,800000),(33,1,8,1,'2022-01-25 04:08:32','2022-01-25 02:47:04',1,7300000,7300000),(34,1,5,1,'2022-01-25 04:11:09','2022-01-25 04:10:58',1,2800000,2800000),(41,1,3,1,'2022-01-25 07:55:50','2022-01-25 07:50:29',1,2500000,2500000),(42,1,2,1,'2022-01-25 07:58:04','2022-01-25 07:58:00',1,2000000,2000000),(52,1,7,1,'2022-02-02 03:26:42','2022-01-26 02:29:45',1,800000,800000),(53,1,3,1,'2022-02-02 03:26:42','2022-01-26 02:35:14',1,2500000,2500000);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2014_10_12_000000_create_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `recipients_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `prov` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delivery_amount` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `orders_FK` (`users_id`),
  CONSTRAINT `orders_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (4,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-13 05:01:01','2022-01-13 05:01:31',20000,3800000,3820000,1),(5,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-13 05:05:04','2022-01-13 05:10:37',20000,2000000,2020000,1),(6,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-13 05:44:29','2022-01-25 04:10:25',20000,2500000,2520000,1),(7,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-13 07:54:35','2022-01-25 04:11:59',20000,2500000,2520000,1),(8,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-13 07:56:08','2022-01-13 07:56:25',20000,3600000,3620000,1),(10,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-25 04:08:32','2022-01-25 04:09:47',20000,7300000,7320000,1),(11,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-25 04:11:09','2022-01-25 04:11:22',20000,2800000,2820000,1),(12,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-25 07:55:50','2022-01-25 07:55:50',20000,2500000,2520000,0),(13,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-25 07:58:04','2022-01-25 07:58:04',20000,2000000,2020000,0),(14,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-02-02 03:26:42','2022-02-02 03:26:42',20000,3300000,3320000,0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_detail`
--

DROP TABLE IF EXISTS `orders_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `users_id` bigint(20) unsigned DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_title` varchar(250) DEFAULT NULL,
  `product_description` text,
  `product_price` double DEFAULT NULL,
  `product_thumbnail` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_detail_FK` (`orders_id`),
  KEY `orders_detail_FK_1` (`product_id`),
  KEY `orders_detail_FK_2` (`users_id`),
  CONSTRAINT `orders_detail_FK` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `orders_detail_FK_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `orders_detail_FK_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_detail`
--

LOCK TABLES `orders_detail` WRITE;
/*!40000 ALTER TABLE `orders_detail` DISABLE KEYS */;
INSERT INTO `orders_detail` VALUES (6,4,4,1,2,'Sweater Wanita','Sweater Wanita','<p>NAMA PRODUK : ATASAN WANITA SWEATER ZOLAQU BABYTERRY VNOI-3173\n\n\nTYPE : REGULER\n\nDETAIL :\n\nDETAIL PRODUK : * Bahan Babyterry * Ukuran XXL * Lingkar Dada 108-112Cm * Panjang Sweater 63Cm * Panjang Lengan 54Cm\n\nDETAIL UKURAN\nDetail - Ukuran - LD - Pjg Baju\nUkuran 1: XXL - 112 - 63\nBerat per pcs: 330 gram\nBahan: BABY TERRY\nkeunggulan: Tekstur kain halus dan lembut, Ringan dan nyaman digunakan, Daya serap keringat sangat baik, Hangat dan tidak bikin gerah.</p><img src=\"https://cartzilla.createx.studio/img/shop/single/prod-img2.jpg\" alt=\"Product description\">\n                            <p>NOTE :\n\n* MUNGKIN TERJADI SEDIKIT PERBEDAAN WARNA, KARENA PENCAHAYAAN SAAT FOTO\n\n* HARAP PERHATIKAN DETAIL UKURAN SEBELUM MEMBELI\n\n* JIKA ADA ITEM YANG TIDAK BISA DIPILIH, ARTINYA SUDAH SOLD OUT\n\n\nHAPPY SHOPPING !!.</p>',1900000,'22.jpeg','2022-01-13 05:01:01','2022-01-13 05:01:01'),(7,5,2,1,1,'Sepatu Boots Sneakers','Sepatu Boots Sneakers','<p>Spesifikasi :\n- Sepatu Original 100% Import\n- Model Boot Retro, Cocok untuk kasual, kerja, racing ataupun adventure\n- Desain kekinian\n- Selain tampilan ,kenyaman saat di pakai menjadi hal yg utama\n- Gambar display adalah foto real produk\n- Paduan material Canvas with Leather yang bersirkulasi udara dan cage di bagian midfoot untuk ekstra topangan\n- Menggunakan outsole Rubber yg membuat sneakes ini tidak hanya ringan tapi juga lembut . bantalan yg baik ,dan memiliki ketahanan yg tinggi sehingga awet di gunakan dan layak kamu miliki\n- Konstruksi Flyknit memberikan fleksibilitas dan kemudahan bernapas untuk mencegah bau kaki\n- Sepatu ini memberi cushioning yang lembut dan responsif\n- Dengan lighweight foamcollar pada ankle agar lembut dalam menyentuh kulit\n- Rubber outsole\n- Tali depan\n- Nyaman Di Pakai Untuk Santay, Fashion, Dll.</p><img src=\"https://cartzilla.createx.studio/img/shop/single/prod-img2.jpg\" alt=\"Product description\">\n                            <p>Size 40-43 Perincian Size\nUkuran 40 = 25 cm\nUkuran 41 = 25.5 cm\nUkuran 42 = 26 cm\nUkuran 43 = 26.5 cm.</p>',2000000,'18.jpeg','2022-01-13 05:05:04','2022-01-13 05:05:04'),(8,6,3,1,1,'Celana Panjang Soft Jeans Streach','Celana Panjang Soft Jeans Streach','<p>celana panjang soft jeans streach\nsize:31-36\nwarna dari kiri:biru bleach,biru dongker,biru stone,coklat tua,biru BRL,hitam.</p><img src=\"https://cartzilla.createx.studio/img/shop/single/prod-img2.jpg\" alt=\"Product description\">\n                            <p>apabila barang kebesaran atau kekecilan atau cacat boleh tukar ingat tukar bukan retur yaa... syarat penukaran adalah harus memberikan minimal bintang 4 dan hangtag jangan di lepas dan di pack pakai plastik jika tidak pakai plastik tidak akan kami tukar setelah itu pembeli kirim barang nya kembali kepada kami terlebih dahulu sampai barang di tangan kami(ongkir di tanggung pembeli) baru kami kirim barang barunya kepada pembeli (ongkir di tanggung pembeli) selama proses penukaran hanya melayani whatsapp:(082138066567) dan penukaran tidak melalui tokopedia dan harus memakai kurir yang ongkirnya min 10rb seperti jnt\n\ndengan membeli kami menganggap setuju.</p>',2500000,'14.jpeg','2022-01-13 05:44:29','2022-01-13 05:44:29'),(9,7,3,1,1,'Celana Panjang Soft Jeans Streach','Celana Panjang Soft Jeans Streach','<p>celana panjang soft jeans streach\nsize:31-36\nwarna dari kiri:biru bleach,biru dongker,biru stone,coklat tua,biru BRL,hitam.</p>\n                            <p>apabila barang kebesaran atau kekecilan atau cacat boleh tukar ingat tukar bukan retur yaa... syarat penukaran adalah harus memberikan minimal bintang 4 dan hangtag jangan di lepas dan di pack pakai plastik jika tidak pakai plastik tidak akan kami tukar setelah itu pembeli kirim barang nya kembali kepada kami terlebih dahulu sampai barang di tangan kami(ongkir di tanggung pembeli) baru kami kirim barang barunya kepada pembeli (ongkir di tanggung pembeli) selama proses penukaran hanya melayani whatsapp:(082138066567) dan penukaran tidak melalui tokopedia dan harus memakai kurir yang ongkirnya min 10rb seperti jnt\n\ndengan membeli kami menganggap setuju.</p>',2500000,'14.jpeg','2022-01-13 07:54:35','2022-01-13 07:54:35'),(10,8,5,1,1,'Smart TV LED 49’’ Ultra HD','Smart TV LED 49’’ Ultra HD','<p>TV UHD 4K yang sesungguhnya\nRasakan gambar yang hidup dan realistis yang memberi Anda kenikmatan menonton terbaik.\nRincian lebih besar dalam Resolusi UHD\nRasakan detail yang jelas dengan resolusi 4X Full HD TV (1080p). Semua yang Anda lihat akan terlihat lebih baik berkat warna dan kecerahan yang benar-benar tajam.\nRendam dalam Warna Jelas & Tepat\nSelami hiburan TV Anda dan lihat semua warna alam dengan detail yang akurat dengan Purcolour.\nTingkatkan pengalaman hiburan Anda dengan HDR Pro\nDengan HDR Pro, mengalami kontras yang kuat yang akan melepaskan detail tersembunyi sebelumnya untuk gambar yang lebih realistis\nPeredupan UHD\nPeredupan UHD membagi layar menjadi beberapa blok untuk mengoptimalkan warna, ketajaman, dan tingkat hitam dalam dan putih murni untuk kontras yang sempurna.</p>\n                            <p>Sleek & Slim\nDipoles dan disempurnakan, ini membawa tampilan bersih dan rasakan dimanapun Anda menempatkannya dengan gaya minimalis.\nLebih pintar dari sebelumnya\nSekarang Anda benar-benar bisa duduk santai dan menikmati.\nSatu remote control\nDapatkan kendali tertinggi di telapak tangan Anda. Kontrol semua perangkat yang terhubung1 hanya dengan satu remote control. Dengan Kontrol Suara, Anda tidak perlu membolak-balik saluran lagi.\nTampilan Pintar\nHubungkan ponsel Anda ke layar lebar dan nikmati semua konten Anda. Dan dengan aplikasi Smart View, Anda dapat mengatur segala hal dari ponsel Anda dengan mulus.\nSmart Hub\nMudah mengakses semua konten favorit Anda dari satu tempat. Jelajahi pratinjau thumbnail pada Smart Hub cerdas Samsung 2017 sebelum masuk.\nDeteksi otomatis\nTemukan dan kenali semua perangkat yang terhubung dengan lebih cepat.</p>',2800000,'60.jpeg','2022-01-13 07:56:08','2022-01-13 07:56:08'),(11,8,7,1,1,'Wireless Bluetooth Headphones','Wireless Bluetooth Headphones','<p>Sennheiser HD 400S\n\nHD 400S memiliki fitur smart remote yaitu satu tombol yang terletak di kabel, yang memungkinkan Anda mengontrol musik dan menerima panggilan dengan mudah, dan desain lipat yang kokoh membuat headphone ini tahan lama dan cukup ringkas untuk dibawa ke mana saja. Driver dinamis Sennheiser menghadirkan respons suara yang diperluas dengan bass dinamis.\n\n\nFitur\n- Kualitas suara Sennheiser yang terkenal untuk pengalaman mendengarkan yang unik.\n- Mikrofon internal dan remote untuk kontrol panggilan dan musik.\n- Headphone di sekitar telinga yang tertutup mengurangi kebisingan latar belakang yang tidak diinginkan demi kenyamanan Anda.\n- Headphone yang ringan dan dapat dilipat untuk memudahkan penyimpanan saat bepergian.</p>\n                            <p>What\'s in the box?\nHD 400S around-ear headphones\nRCS 400 detachable single-sided cable with 1-button remote and 3.5 mm angled plug\nTraveling pouch\n\nTechnical Data\nColor : Black\nTechnology Connectivity : Wired\nImpedance : 18 Ω\nFrequency response (Microphone) : 100 – 10,000 Hz (-10 dB)\nFrequency response (Headphones) : 18–20,000 Hz (-10 dB)\nSound pressure level (SPL) : 120dB (1kHz/1Vrms)\nTHD, total harmonic distortion : <0.5% (1kHz/100dB)\nEar coupling : Over-Ear\nJack plug : 3.5mm angled\nCable length : 1.4m\nTransducer principle : Dynamic\nWeight : 217g\nPick-up pattern : Omni directional\nMicrophone sensitivity : -44dbV/Pa\nAcoustics : Closed\nSensitivity : 120 dB SPL @ 1 kHz, 1V RMS\n\nGaransi 2 Tahun.</p>',800000,'58.jpeg','2022-01-13 07:56:08','2022-01-13 07:56:08'),(13,10,8,1,1,'Popular Smartphone 128GB','Popular Smartphone 128GB','<p>POCO F3 5G NFC menggunakan prosesor Qualcomm SM8250-AC Snapdragon 870 5G (7 nm) dengan fitur layar AMOLED, 120Hz, HDR10+, 1300 nits (peak) 6,67 inci dan memiliki kamera selfie 20MP bersama dengan kamera triple 48MP.</p>\n                            <p>Spesifikasi:\n\nNetwork :GSM / HSPA / LTE / 5G\nDimensions :163.7 x 76.4 x 7.8 mm (6.44 x 3.01 x 0.31 in)\nWeight :196 g (6.91 oz)\nBuild :Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), plastic frame\nSIM :Dual SIM (Nano-SIM, dual stand-by)\nDisplay :AMOLED, 120Hz, HDR10+, 1300 nits (peak)\nSize :6.67 inches, 107.4 cm2 (~85.9% screen-to-body ratio)\nResolution :1080 x 2400 pixels, 20:9 ratio (~395 ppi density)\nProtection :Corning Gorilla Glass 5\nOS :Android 11, MIUI 12 for POCO\nChipset :Qualcomm SM8250-AC Snapdragon 870 5G (7 nm)\nCPU :Octa-core (1x3.2 GHz Kryo 585 & 3x2.42 GHz Kryo 585 & 4x1.80 GHz Kryo 585)\nGPU :Adreno 650\nCard slot :No\nMain Camera :Triple 48MP + 8MP + 5MP\nSelfie Camera :20MP\nLoudspeaker :Yes, with stereo speakers\n3.5mm jack :No 24-bit/192kHz audio\nWLAN :Wi-Fi 802.11 a/b/g/n/ac/6, dual-band, Wi-Fi Direct, hotspot\nBluetooth :5.1, A2DP, LE\nGPS :Yes, with dual-band A-GPS, GLONASS, BDS, GALILEO, QZSS, NavIC\nNFC :Yes\nInfrared port :Yes\nRadio :No\nUSB :USB Type-C 2.0, USB On-The-Go\nSensors :Fingerprint (side-mounted), accelerometer, gyro, proximity, compass, color spectrum\nBattery :Li-Po 4520 mAh, non-removable\nCharging :Fast charging 33W, 100% in 52 min (advertised).</p>',7300000,'63.jpeg','2022-01-25 04:08:32','2022-01-25 04:08:32'),(14,11,5,1,1,'Smart TV LED 49’’ Ultra HD','Smart TV LED 49’’ Ultra HD','<p>TV UHD 4K yang sesungguhnya\nRasakan gambar yang hidup dan realistis yang memberi Anda kenikmatan menonton terbaik.\nRincian lebih besar dalam Resolusi UHD\nRasakan detail yang jelas dengan resolusi 4X Full HD TV (1080p). Semua yang Anda lihat akan terlihat lebih baik berkat warna dan kecerahan yang benar-benar tajam.\nRendam dalam Warna Jelas & Tepat\nSelami hiburan TV Anda dan lihat semua warna alam dengan detail yang akurat dengan Purcolour.\nTingkatkan pengalaman hiburan Anda dengan HDR Pro\nDengan HDR Pro, mengalami kontras yang kuat yang akan melepaskan detail tersembunyi sebelumnya untuk gambar yang lebih realistis\nPeredupan UHD\nPeredupan UHD membagi layar menjadi beberapa blok untuk mengoptimalkan warna, ketajaman, dan tingkat hitam dalam dan putih murni untuk kontras yang sempurna.</p>\n                            <p>Sleek & Slim\nDipoles dan disempurnakan, ini membawa tampilan bersih dan rasakan dimanapun Anda menempatkannya dengan gaya minimalis.\nLebih pintar dari sebelumnya\nSekarang Anda benar-benar bisa duduk santai dan menikmati.\nSatu remote control\nDapatkan kendali tertinggi di telapak tangan Anda. Kontrol semua perangkat yang terhubung1 hanya dengan satu remote control. Dengan Kontrol Suara, Anda tidak perlu membolak-balik saluran lagi.\nTampilan Pintar\nHubungkan ponsel Anda ke layar lebar dan nikmati semua konten Anda. Dan dengan aplikasi Smart View, Anda dapat mengatur segala hal dari ponsel Anda dengan mulus.\nSmart Hub\nMudah mengakses semua konten favorit Anda dari satu tempat. Jelajahi pratinjau thumbnail pada Smart Hub cerdas Samsung 2017 sebelum masuk.\nDeteksi otomatis\nTemukan dan kenali semua perangkat yang terhubung dengan lebih cepat.</p>',2800000,'60.jpeg','2022-01-25 04:11:09','2022-01-25 04:11:09'),(15,12,3,1,1,'Celana Panjang Soft Jeans Streach','Celana Panjang Soft Jeans Streach','<p>celana panjang soft jeans streach\nsize:31-36\nwarna dari kiri:biru bleach,biru dongker,biru stone,coklat tua,biru BRL,hitam.</p>\n                            <p>apabila barang kebesaran atau kekecilan atau cacat boleh tukar ingat tukar bukan retur yaa... syarat penukaran adalah harus memberikan minimal bintang 4 dan hangtag jangan di lepas dan di pack pakai plastik jika tidak pakai plastik tidak akan kami tukar setelah itu pembeli kirim barang nya kembali kepada kami terlebih dahulu sampai barang di tangan kami(ongkir di tanggung pembeli) baru kami kirim barang barunya kepada pembeli (ongkir di tanggung pembeli) selama proses penukaran hanya melayani whatsapp:(082138066567) dan penukaran tidak melalui tokopedia dan harus memakai kurir yang ongkirnya min 10rb seperti jnt\n\ndengan membeli kami menganggap setuju.</p>',2500000,'14.jpeg','2022-01-25 07:55:50','2022-01-25 07:55:50'),(16,13,2,1,1,'Sepatu Boots Sneakers','Sepatu Boots Sneakers','<p>Spesifikasi :\n- Sepatu Original 100% Import\n- Model Boot Retro, Cocok untuk kasual, kerja, racing ataupun adventure\n- Desain kekinian\n- Selain tampilan ,kenyaman saat di pakai menjadi hal yg utama\n- Gambar display adalah foto real produk\n- Paduan material Canvas with Leather yang bersirkulasi udara dan cage di bagian midfoot untuk ekstra topangan\n- Menggunakan outsole Rubber yg membuat sneakes ini tidak hanya ringan tapi juga lembut . bantalan yg baik ,dan memiliki ketahanan yg tinggi sehingga awet di gunakan dan layak kamu miliki\n- Konstruksi Flyknit memberikan fleksibilitas dan kemudahan bernapas untuk mencegah bau kaki\n- Sepatu ini memberi cushioning yang lembut dan responsif\n- Dengan lighweight foamcollar pada ankle agar lembut dalam menyentuh kulit\n- Rubber outsole\n- Tali depan\n- Nyaman Di Pakai Untuk Santay, Fashion, Dll.</p>\n                            <p>Size 40-43 Perincian Size\nUkuran 40 = 25 cm\nUkuran 41 = 25.5 cm\nUkuran 42 = 26 cm\nUkuran 43 = 26.5 cm.</p>',2000000,'18.jpeg','2022-01-25 07:58:04','2022-01-25 07:58:04'),(17,14,7,1,1,'Wireless Bluetooth Headphones','Wireless Bluetooth Headphones','<p>Sennheiser HD 400S\n\nHD 400S memiliki fitur smart remote yaitu satu tombol yang terletak di kabel, yang memungkinkan Anda mengontrol musik dan menerima panggilan dengan mudah, dan desain lipat yang kokoh membuat headphone ini tahan lama dan cukup ringkas untuk dibawa ke mana saja. Driver dinamis Sennheiser menghadirkan respons suara yang diperluas dengan bass dinamis.\n\n\nFitur\n- Kualitas suara Sennheiser yang terkenal untuk pengalaman mendengarkan yang unik.\n- Mikrofon internal dan remote untuk kontrol panggilan dan musik.\n- Headphone di sekitar telinga yang tertutup mengurangi kebisingan latar belakang yang tidak diinginkan demi kenyamanan Anda.\n- Headphone yang ringan dan dapat dilipat untuk memudahkan penyimpanan saat bepergian.</p>\n                            <p>What\'s in the box?\nHD 400S around-ear headphones\nRCS 400 detachable single-sided cable with 1-button remote and 3.5 mm angled plug\nTraveling pouch\n\nTechnical Data\nColor : Black\nTechnology Connectivity : Wired\nImpedance : 18 Ω\nFrequency response (Microphone) : 100 – 10,000 Hz (-10 dB)\nFrequency response (Headphones) : 18–20,000 Hz (-10 dB)\nSound pressure level (SPL) : 120dB (1kHz/1Vrms)\nTHD, total harmonic distortion : <0.5% (1kHz/100dB)\nEar coupling : Over-Ear\nJack plug : 3.5mm angled\nCable length : 1.4m\nTransducer principle : Dynamic\nWeight : 217g\nPick-up pattern : Omni directional\nMicrophone sensitivity : -44dbV/Pa\nAcoustics : Closed\nSensitivity : 120 dB SPL @ 1 kHz, 1V RMS\n\nGaransi 2 Tahun.</p>',800000,'58.jpeg','2022-02-02 03:26:42','2022-02-02 03:26:42'),(18,14,3,1,1,'Celana Panjang Soft Jeans Streach','Celana Panjang Soft Jeans Streach','<p>celana panjang soft jeans streach\nsize:31-36\nwarna dari kiri:biru bleach,biru dongker,biru stone,coklat tua,biru BRL,hitam.</p>\n                            <p>apabila barang kebesaran atau kekecilan atau cacat boleh tukar ingat tukar bukan retur yaa... syarat penukaran adalah harus memberikan minimal bintang 4 dan hangtag jangan di lepas dan di pack pakai plastik jika tidak pakai plastik tidak akan kami tukar setelah itu pembeli kirim barang nya kembali kepada kami terlebih dahulu sampai barang di tangan kami(ongkir di tanggung pembeli) baru kami kirim barang barunya kepada pembeli (ongkir di tanggung pembeli) selama proses penukaran hanya melayani whatsapp:(082138066567) dan penukaran tidak melalui tokopedia dan harus memakai kurir yang ongkirnya min 10rb seperti jnt\n\ndengan membeli kami menganggap setuju.</p>',2500000,'14.jpeg','2022-02-02 03:26:42','2022-02-02 03:26:42');
/*!40000 ALTER TABLE `orders_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Speaker Aktif Proel V 10A','<p>Speaker Aktif Proel V 10A Original Active Proel V10A 10 inch\nBISA HUB WA KAMI *852-522-13-566\nThe V Series powered loudspeakers deliver absolute value in terms of performance, engineering and design. These ultra-portable speakers combine, in carefully engineered and light-weight cabinets, the clearest and most accurate PROEL sound with Class D amplifier technology and Switch Mode Power Supply, offering an unbeatable PA solution at its price point. All the three models feature an extremely efficient amplifier module capable of delivering 600 W of robust power to the transducers. Thanks to the use of SMPS technology, this power comes in an ultra-lightweight package, making the V models the most portable PROEL speakers ever. The power module is hosted in a fully sealed aluminum box, which provides protection, perfect insulation of the cabinet from the outside and extremely efficient cooling. Thanks to the carefully selected speakers and to the sophisticated active electronics, including dual CLIP LIMITERS for an undistorted sound even at the loudest level, the sound of the V Series has been precisely tuned in every details, in order to provide unheard performance in this price range. The V series cabinets, expression of the most advanced Italian design, include a super-comfortable luggage-style top handle for an effortless portability. The slanted shape allows the V speakers to be laid on their side and used also as stage monitors..</p>\n                            <p>10 long-excursion woofer with 2 voice coil\n600 W total peak power amplifier hosted in a fully sealed aluminum box\n50 W continuous class AB amplifier for the high frequencies\n250 W continuous class D amplifier for the low frequencies\nSwitch Mode Power Supply (SMPS)\nSelectable MIC /LINE input with 2-band EQ\nIntegrated active processor with dual CLIP LIMITER for maximum control and protection\nFRONT LED with ON or SIGNAL/CLIP selection\nSPL MAX 123 dB\nFrequency response 70 Hz - 20 kHz\nLightweight polypropylene cabinet with.</p>',2900000,'61.jpeg','Speaker Aktif Proel V 10A',0),(2,'Sepatu Boots Sneakers','<p>Spesifikasi :\n- Sepatu Original 100% Import\n- Model Boot Retro, Cocok untuk kasual, kerja, racing ataupun adventure\n- Desain kekinian\n- Selain tampilan ,kenyaman saat di pakai menjadi hal yg utama\n- Gambar display adalah foto real produk\n- Paduan material Canvas with Leather yang bersirkulasi udara dan cage di bagian midfoot untuk ekstra topangan\n- Menggunakan outsole Rubber yg membuat sneakes ini tidak hanya ringan tapi juga lembut . bantalan yg baik ,dan memiliki ketahanan yg tinggi sehingga awet di gunakan dan layak kamu miliki\n- Konstruksi Flyknit memberikan fleksibilitas dan kemudahan bernapas untuk mencegah bau kaki\n- Sepatu ini memberi cushioning yang lembut dan responsif\n- Dengan lighweight foamcollar pada ankle agar lembut dalam menyentuh kulit\n- Rubber outsole\n- Tali depan\n- Nyaman Di Pakai Untuk Santay, Fashion, Dll.</p>\n                            <p>Size 40-43 Perincian Size\nUkuran 40 = 25 cm\nUkuran 41 = 25.5 cm\nUkuran 42 = 26 cm\nUkuran 43 = 26.5 cm.</p>',2000000,'18.jpeg','Sepatu Boots Sneakers',1),(3,'Celana Panjang Soft Jeans Streach','<p>celana panjang soft jeans streach\nsize:31-36\nwarna dari kiri:biru bleach,biru dongker,biru stone,coklat tua,biru BRL,hitam.</p>\n                            <p>apabila barang kebesaran atau kekecilan atau cacat boleh tukar ingat tukar bukan retur yaa... syarat penukaran adalah harus memberikan minimal bintang 4 dan hangtag jangan di lepas dan di pack pakai plastik jika tidak pakai plastik tidak akan kami tukar setelah itu pembeli kirim barang nya kembali kepada kami terlebih dahulu sampai barang di tangan kami(ongkir di tanggung pembeli) baru kami kirim barang barunya kepada pembeli (ongkir di tanggung pembeli) selama proses penukaran hanya melayani whatsapp:(082138066567) dan penukaran tidak melalui tokopedia dan harus memakai kurir yang ongkirnya min 10rb seperti jnt\n\ndengan membeli kami menganggap setuju.</p>',2500000,'14.jpeg','Celana Panjang Soft Jeans Streach',1),(4,'Sweater Wanita','<p>NAMA PRODUK : ATASAN WANITA SWEATER ZOLAQU BABYTERRY VNOI-3173\n\n\nTYPE : REGULER\n\nDETAIL :\n\nDETAIL PRODUK : * Bahan Babyterry * Ukuran XXL * Lingkar Dada 108-112Cm * Panjang Sweater 63Cm * Panjang Lengan 54Cm\n\nDETAIL UKURAN\nDetail - Ukuran - LD - Pjg Baju\nUkuran 1: XXL - 112 - 63\nBerat per pcs: 330 gram\nBahan: BABY TERRY\nkeunggulan: Tekstur kain halus dan lembut, Ringan dan nyaman digunakan, Daya serap keringat sangat baik, Hangat dan tidak bikin gerah.</p>\n                            <p>NOTE :\n\n* MUNGKIN TERJADI SEDIKIT PERBEDAAN WARNA, KARENA PENCAHAYAAN SAAT FOTO\n\n* HARAP PERHATIKAN DETAIL UKURAN SEBELUM MEMBELI\n\n* JIKA ADA ITEM YANG TIDAK BISA DIPILIH, ARTINYA SUDAH SOLD OUT\n\n\nHAPPY SHOPPING !!.</p>',1900000,'22.jpeg','Sweater Wanita',1),(5,'Smart TV LED 49’’ Ultra HD','<p>TV UHD 4K yang sesungguhnya\nRasakan gambar yang hidup dan realistis yang memberi Anda kenikmatan menonton terbaik.\nRincian lebih besar dalam Resolusi UHD\nRasakan detail yang jelas dengan resolusi 4X Full HD TV (1080p). Semua yang Anda lihat akan terlihat lebih baik berkat warna dan kecerahan yang benar-benar tajam.\nRendam dalam Warna Jelas & Tepat\nSelami hiburan TV Anda dan lihat semua warna alam dengan detail yang akurat dengan Purcolour.\nTingkatkan pengalaman hiburan Anda dengan HDR Pro\nDengan HDR Pro, mengalami kontras yang kuat yang akan melepaskan detail tersembunyi sebelumnya untuk gambar yang lebih realistis\nPeredupan UHD\nPeredupan UHD membagi layar menjadi beberapa blok untuk mengoptimalkan warna, ketajaman, dan tingkat hitam dalam dan putih murni untuk kontras yang sempurna.</p>\n                            <p>Sleek & Slim\nDipoles dan disempurnakan, ini membawa tampilan bersih dan rasakan dimanapun Anda menempatkannya dengan gaya minimalis.\nLebih pintar dari sebelumnya\nSekarang Anda benar-benar bisa duduk santai dan menikmati.\nSatu remote control\nDapatkan kendali tertinggi di telapak tangan Anda. Kontrol semua perangkat yang terhubung1 hanya dengan satu remote control. Dengan Kontrol Suara, Anda tidak perlu membolak-balik saluran lagi.\nTampilan Pintar\nHubungkan ponsel Anda ke layar lebar dan nikmati semua konten Anda. Dan dengan aplikasi Smart View, Anda dapat mengatur segala hal dari ponsel Anda dengan mulus.\nSmart Hub\nMudah mengakses semua konten favorit Anda dari satu tempat. Jelajahi pratinjau thumbnail pada Smart Hub cerdas Samsung 2017 sebelum masuk.\nDeteksi otomatis\nTemukan dan kenali semua perangkat yang terhubung dengan lebih cepat.</p>',2800000,'60.jpeg','Smart TV LED 49’’ Ultra HD',1),(6,'AirPort Extreme Base Station','<p>A1521 AirPort Extreme Base Station / Without AC Power Cable Cord\n\n\nMohon Chat/Noted Untuk Warna Dan Type Yang Tersedia **.</p>\n                            <p>Condition:Used / Clean /Without AC Power Cable Cord100% TEST AND WORK!!friendly tipsx item will be shipped within 24 business hours (except national holidaysx Please check pictures & If your device is not working or is incompatible with our items No Buy.x please make sure that your shipping information is confirmed in Alix Normally it will take 7-15days to arrive USA.UKCanadaAustraliaJapan20-30days to other country.x please cotact us if you still have not receive your package within 30days.</p>',3200000,'59.jpeg','AirPort Extreme Base Station',1),(7,'Wireless Bluetooth Headphones','<p>Sennheiser HD 400S\n\nHD 400S memiliki fitur smart remote yaitu satu tombol yang terletak di kabel, yang memungkinkan Anda mengontrol musik dan menerima panggilan dengan mudah, dan desain lipat yang kokoh membuat headphone ini tahan lama dan cukup ringkas untuk dibawa ke mana saja. Driver dinamis Sennheiser menghadirkan respons suara yang diperluas dengan bass dinamis.\n\n\nFitur\n- Kualitas suara Sennheiser yang terkenal untuk pengalaman mendengarkan yang unik.\n- Mikrofon internal dan remote untuk kontrol panggilan dan musik.\n- Headphone di sekitar telinga yang tertutup mengurangi kebisingan latar belakang yang tidak diinginkan demi kenyamanan Anda.\n- Headphone yang ringan dan dapat dilipat untuk memudahkan penyimpanan saat bepergian.</p>\n                            <p>What\'s in the box?\nHD 400S around-ear headphones\nRCS 400 detachable single-sided cable with 1-button remote and 3.5 mm angled plug\nTraveling pouch\n\nTechnical Data\nColor : Black\nTechnology Connectivity : Wired\nImpedance : 18 Ω\nFrequency response (Microphone) : 100 – 10,000 Hz (-10 dB)\nFrequency response (Headphones) : 18–20,000 Hz (-10 dB)\nSound pressure level (SPL) : 120dB (1kHz/1Vrms)\nTHD, total harmonic distortion : <0.5% (1kHz/100dB)\nEar coupling : Over-Ear\nJack plug : 3.5mm angled\nCable length : 1.4m\nTransducer principle : Dynamic\nWeight : 217g\nPick-up pattern : Omni directional\nMicrophone sensitivity : -44dbV/Pa\nAcoustics : Closed\nSensitivity : 120 dB SPL @ 1 kHz, 1V RMS\n\nGaransi 2 Tahun.</p>',800000,'58.jpeg','Wireless Bluetooth Headphones',1),(8,'Popular Smartphone 128GB','<p>POCO F3 5G NFC menggunakan prosesor Qualcomm SM8250-AC Snapdragon 870 5G (7 nm) dengan fitur layar AMOLED, 120Hz, HDR10+, 1300 nits (peak) 6,67 inci dan memiliki kamera selfie 20MP bersama dengan kamera triple 48MP.</p>\n                            <p>Spesifikasi:\n\nNetwork :GSM / HSPA / LTE / 5G\nDimensions :163.7 x 76.4 x 7.8 mm (6.44 x 3.01 x 0.31 in)\nWeight :196 g (6.91 oz)\nBuild :Glass front (Gorilla Glass 5), glass back (Gorilla Glass 5), plastic frame\nSIM :Dual SIM (Nano-SIM, dual stand-by)\nDisplay :AMOLED, 120Hz, HDR10+, 1300 nits (peak)\nSize :6.67 inches, 107.4 cm2 (~85.9% screen-to-body ratio)\nResolution :1080 x 2400 pixels, 20:9 ratio (~395 ppi density)\nProtection :Corning Gorilla Glass 5\nOS :Android 11, MIUI 12 for POCO\nChipset :Qualcomm SM8250-AC Snapdragon 870 5G (7 nm)\nCPU :Octa-core (1x3.2 GHz Kryo 585 & 3x2.42 GHz Kryo 585 & 4x1.80 GHz Kryo 585)\nGPU :Adreno 650\nCard slot :No\nMain Camera :Triple 48MP + 8MP + 5MP\nSelfie Camera :20MP\nLoudspeaker :Yes, with stereo speakers\n3.5mm jack :No 24-bit/192kHz audio\nWLAN :Wi-Fi 802.11 a/b/g/n/ac/6, dual-band, Wi-Fi Direct, hotspot\nBluetooth :5.1, A2DP, LE\nGPS :Yes, with dual-band A-GPS, GLONASS, BDS, GALILEO, QZSS, NavIC\nNFC :Yes\nInfrared port :Yes\nRadio :No\nUSB :USB Type-C 2.0, USB On-The-Go\nSensors :Fingerprint (side-mounted), accelerometer, gyro, proximity, compass, color spectrum\nBattery :Li-Po 4520 mAh, non-removable\nCharging :Fast charging 33W, 100% in 52 min (advertised).</p>',7300000,'63.jpeg','Popular Smartphone 128GB',1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_FK` (`product_id`),
  CONSTRAINT `product_images_FK` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'daftar-hp-samsung-terbaru-2020-banner-c8fb5.jpeg'),(2,1,'vivo-banner-aad20.jpeg'),(3,3,'jeans-2.jpeg'),(4,3,'jeans-2.jpeg'),(5,4,'jaket-2.jpeg'),(6,4,'jaket-2.jpeg'),(7,2,'sneaker-1.jpeg'),(8,2,'sneaker-1.jpeg'),(9,5,'tv-1.jpeg'),(10,5,'tv-1.jpeg'),(11,6,'station-2.jpeg'),(12,6,'station-2.jpeg'),(13,7,'headset-3.jpeg'),(14,7,'headset-3.jpeg'),(15,8,'hp-2.jpeg'),(16,8,'hp-2.jpeg'),(17,6,'station-2.jpeg'),(18,6,'station-2.jpeg'),(19,8,'hp-2.jpeg'),(20,8,'hp-2.jpeg'),(21,1,'daftar-hp-samsung-terbaru-2020-banner-c8fb5.jpeg'),(22,1,'vivo-banner-aad20.jpeg'),(23,5,'tv-1.jpeg'),(24,5,'tv-1.jpeg'),(25,3,'jeans-2.jpeg'),(26,3,'jeans-2.jpeg'),(27,2,'sneaker-1.jpeg'),(28,2,'sneaker-1.jpeg'),(29,4,'jaket-2.jpeg'),(30,4,'jaket-2.jpeg'),(31,7,'headset-3.jpeg'),(32,7,'headset-3.jpeg');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Erfin Gustaman','gopin.ipin@gmail.com',NULL,'$2y$10$raSyCW4LBkorEYER4b8rfOPiisKNymVYSRHOzexBxqPLS3dQASqKa','FTpkbdoeLQH55CErJ6q5yDYwDQisrgE8WemHOVk4mHukO1OU1jaeWeF1oftb','2022-01-12 21:59:31','2022-01-12 21:59:31',0),(2,'Admin','admin@mail.com',NULL,'$2y$10$PbJiK4wVtFOOLU2bc6T5T.0i8Ae9NZ3iGrt4hZiwipIeaJvop3qvW','nmDA4p3hIZ5PKj553T09kz9mQRP1HoltSS4qmFgbEkxNezykRbXnFp6Gh6MC','2022-01-12 22:02:21','2022-01-12 22:02:21',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_address`
--

DROP TABLE IF EXISTS `users_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `recipients_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` text,
  `prov` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_address_FK` (`users_id`),
  CONSTRAINT `users_address_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_address`
--

LOCK TABLES `users_address` WRITE;
/*!40000 ALTER TABLE `users_address` DISABLE KEYS */;
INSERT INTO `users_address` VALUES (2,1,'Erfin Gustaman','081394420001','perum bumi mutiara blok je 19 no 6, gunung putri, bojong kulur, kab bogor. 16969',32,'2022-01-13 05:01:01','2022-01-13 05:01:01');
/*!40000 ALTER TABLE `users_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_payment`
--

DROP TABLE IF EXISTS `users_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_payment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` bigint(20) unsigned NOT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `senders_account` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_payment_FK` (`users_id`),
  KEY `users_payment_FK_1` (`orders_id`),
  CONSTRAINT `users_payment_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  CONSTRAINT `users_payment_FK_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_payment`
--

LOCK TABLES `users_payment` WRITE;
/*!40000 ALTER TABLE `users_payment` DISABLE KEYS */;
INSERT INTO `users_payment` VALUES (3,4,1,3820000,'bca','Erfin Gustaman','2022-01-13 05:01:31','2022-01-13 05:01:31'),(4,5,1,2020000,'Bca','Erfin Gustaman','2022-01-13 05:10:37','2022-01-13 05:10:37'),(5,8,1,3620000,'Bca','Erfin Gustaman','2022-01-13 07:56:25','2022-01-13 07:56:25'),(7,10,1,7320000,'BCA','Erfin Gustaman','2022-01-25 04:09:47','2022-01-25 04:09:47'),(8,6,1,2520000,'BCA','Erfin Gustaman','2022-01-25 04:10:25','2022-01-25 04:10:25'),(9,11,1,2820000,'BCA','Erfin Gustaman','2022-01-25 04:11:22','2022-01-25 04:11:22'),(10,7,1,2520000,'BCA','Erfin Gustaman','2022-01-25 04:11:59','2022-01-25 04:11:59');
/*!40000 ALTER TABLE `users_payment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-02 10:37:02
