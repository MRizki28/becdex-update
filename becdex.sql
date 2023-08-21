-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2022 at 07:23 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `becdex`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`id_answer` int(128) NOT NULL,
  `question_id` int(11) NOT NULL,
  `submission_id` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `value` char(1) COLLATE utf8mb4_bin NOT NULL,
  `valid_value` char(1) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `aspect`
--

CREATE TABLE IF NOT EXISTS `aspect` (
`id_aspect` int(11) NOT NULL,
  `aspect_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aspect`
--

INSERT INTO `aspect` (`id_aspect`, `aspect_name`) VALUES
(1, 'Environmental Aspect'),
(2, 'Social Aspect'),
(3, 'Economic Aspect');

-- --------------------------------------------------------

--
-- Table structure for table `becdex_cat`
--

CREATE TABLE IF NOT EXISTS `becdex_cat` (
`id_becdex_cat` int(11) NOT NULL,
  `max_score` int(11) NOT NULL,
  `becdex_cat_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `becdex_cat_color` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `becdex_cat`
--

INSERT INTO `becdex_cat` (`id_becdex_cat`, `max_score`, `becdex_cat_name`, `becdex_cat_color`) VALUES
(1, 68, 'Not a Blue Economy Company', 'danger'),
(2, 78, 'Standard Blue Economy Company', 'info'),
(3, 88, 'Good Blue Economy Company', 'primary'),
(4, 100, 'Excellent Economy Company', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
`id_certificate` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `company_detail`
--

CREATE TABLE IF NOT EXISTS `company_detail` (
  `user_id` int(11) NOT NULL,
  `company_phone` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `company_country` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `company_field` int(128) NOT NULL,
  `pic_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `pic_position` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `pic_email` text COLLATE utf8mb4_bin NOT NULL,
  `pic_phone` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `becdex_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `company_detail`
--

INSERT INTO `company_detail` (`user_id`, `company_phone`, `company_country`, `company_field`, `pic_name`, `pic_position`, `pic_email`, `pic_phone`, `becdex_category_id`) VALUES
(9, '089525765206', 'ID', 9, 'Jonathan Doe', 'Head of Public', 'admin@admin.com', '0895257652', 2),
(11, '089525765206', 'AE', 2, 'Jonathan Doe', 'Head of Public', 'admin@admin.com', '0895257652', 4);

-- --------------------------------------------------------

--
-- Table structure for table `company_field`
--

CREATE TABLE IF NOT EXISTS `company_field` (
`id_company_field` int(11) NOT NULL,
  `field_name` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_field`
--

INSERT INTO `company_field` (`id_company_field`, `field_name`) VALUES
(1, 'Marine Fisheries and Aquaculture'),
(2, 'Maritime Transport, Shipping, and Ports'),
(3, 'Marine Tourism and Cruise Ships'),
(4, 'Biotechnology and Marine Bioproducts Processing'),
(5, 'Seawater Desalination'),
(6, 'Deep Sea Mining, Oil, and Gas'),
(7, 'Marine Renewable Energy'),
(8, 'Ship and Boat Building'),
(9, 'Ocean Building'),
(10, 'Marine Defense and Security'),
(11, 'Maritime Research and Education');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
`id_country` int(11) NOT NULL,
  `iso` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `nicename` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id_country`, `iso`, `nicename`) VALUES
(1, 'AL', 'Albania '),
(2, 'DZ', 'Algeria'),
(3, 'AO', 'Angola'),
(4, 'AG', 'Antigua and Barbuda'),
(5, 'AR', 'Argentina'),
(6, 'AU', 'Australia'),
(7, 'AZ', 'Azerbaijan'),
(8, 'AZ', 'Bahamas'),
(9, 'BH', 'Bahrain'),
(10, 'BD', 'Bangladesh'),
(11, 'BY', 'Belarus'),
(12, 'BE', 'Belgium'),
(13, 'BZ', 'Belize'),
(14, 'BJ', 'Benin'),
(15, 'BA', 'Bosnia and Herzegovina'),
(16, 'BR', 'Brazil'),
(17, 'BN', 'Brunei Darussalam'),
(18, 'BG', 'Bulgaria'),
(19, 'CV', 'Cabo Verde'),
(20, 'KH', 'Cambodia'),
(21, 'CM', 'Cameroon'),
(22, 'CA', 'Canada'),
(23, 'CL', 'Chile'),
(24, 'CN', 'China'),
(25, 'CO', 'Colombia'),
(26, 'CO', 'Comoros'),
(27, 'KM', 'Congo'),
(28, 'CR', 'Costa Rica'),
(29, 'CI', 'Côte D Ivoire'),
(30, 'HR', 'Croatia'),
(31, 'CU', 'Cuba'),
(32, 'CY', 'Cyprus'),
(33, 'DO', 'DPR Korea'),
(34, 'DO', 'DR Congo'),
(35, 'DK', 'Denmark'),
(36, 'DJ', 'Djibouti'),
(37, 'DM', 'Dominica'),
(38, 'DM', 'Dominican Republic'),
(39, 'EC', 'Ecuador'),
(40, 'EG', 'Egypt'),
(41, 'SV', 'El Salvador'),
(42, 'GQ', 'Equatorial Guinea'),
(43, 'ER', 'Eritrea'),
(44, 'EE', 'Estonia'),
(45, 'FJ', 'Fiji'),
(46, 'FI', 'Finland'),
(47, 'FR', 'France'),
(48, 'GA', 'Gabon'),
(49, 'GA', 'Gambia'),
(50, 'GE', 'Georgia'),
(51, 'DE', 'Germany'),
(52, 'GH', 'Ghana'),
(53, 'GR', 'Greece'),
(54, 'GD', 'Grenada'),
(55, 'GT', 'Guatemala'),
(56, 'GN', 'Guinea'),
(57, 'GN', 'Guinea Bissau'),
(58, 'GY', 'Guyana'),
(59, 'HT', 'Haiti'),
(60, 'HN', 'Honduras'),
(61, 'IS', 'Iceland'),
(62, 'IN', 'India'),
(63, 'ID', 'Indonesia'),
(64, 'IR', 'Iran (Islamic Republic of)'),
(65, 'IQ', 'Iraq'),
(66, 'IE', 'Ireland'),
(67, 'IL', 'Israel'),
(68, 'IT', 'Italy'),
(69, 'JM', 'Jamaica'),
(70, 'JP', 'Japan'),
(71, 'JO', 'Jordan'),
(72, 'KZ', 'Kazakhstan'),
(73, 'KE', 'Kenya'),
(74, 'KI', 'Kiribati'),
(75, 'KW', 'Kuwait'),
(76, 'LV', 'Latvia'),
(77, 'LB', 'Lebanon'),
(78, 'LR', 'Liberia'),
(79, 'LY', 'Libya'),
(80, 'LT', 'Lithuania'),
(81, 'MG', 'Madagascar'),
(82, 'MY', 'Malaysia'),
(83, 'MV', 'Maldives'),
(84, 'MT', 'Malta'),
(85, 'MT', 'Marshall Islands'),
(86, 'MR', 'Mauritania'),
(87, 'MU', 'Mauritius'),
(88, 'MX', 'Mexico'),
(89, 'FM', 'Micronesia (Federated States of)'),
(90, 'MC', 'Monaco '),
(91, 'ME', 'Montenegro'),
(92, 'MA', 'Morocco'),
(93, 'MZ', 'Mozambique'),
(94, 'MM', 'Myanmar'),
(95, 'NA', 'Namibia'),
(96, 'NR', 'Nauru'),
(97, 'NP', 'Netherlands'),
(98, 'NZ', 'New Zealand'),
(99, 'NI', 'Nicaragua'),
(100, 'NG', 'Nigeria'),
(101, 'NO', 'Norway'),
(102, 'OM', 'Oman'),
(103, 'PK', 'Pakistan'),
(104, 'PW', 'Palau'),
(105, 'PA', 'Panama'),
(106, 'PG', 'Papua New Guinea'),
(107, 'PE', 'Peru'),
(108, 'PE', 'Philippines'),
(109, 'PL', 'Poland'),
(110, 'PT', 'Portugal'),
(111, 'QA', 'Qatar'),
(112, 'QA', 'Republic of Korea'),
(113, 'RO', 'Romania'),
(114, 'RO', 'Russian Federation'),
(115, 'KN', 'Saint Kitts and Nevis'),
(116, 'LC', 'Saint Lucia'),
(117, 'VC', 'Saint Vincent and the Grenadines'),
(118, 'WS', 'Samoa'),
(119, 'ST', 'Sao Tome and Principe'),
(120, 'SA', 'Saudi Arabia'),
(121, 'SN', 'Senegal'),
(122, 'SC', 'Seychelles'),
(123, 'SL', 'Sierra Leone'),
(124, 'SG', 'Singapore'),
(125, 'SI', 'Slovenia'),
(126, 'AX', 'Solomon Islands'),
(127, 'SO', 'Somalia'),
(128, 'ZA', 'South Africa'),
(129, 'ES', 'Spain'),
(130, 'LK', 'Sri Lanka'),
(131, 'LK', 'Sudan'),
(132, 'SR', 'Suriname'),
(133, 'SE', 'Sweden'),
(134, 'SY', 'Syrian Arab Republic'),
(135, 'TJ', 'Tanzania'),
(136, 'TH', 'Thailand'),
(137, 'TL', 'Timor-Leste'),
(138, 'TG', 'Togo'),
(139, 'TO', 'Tonga'),
(140, 'TT', 'Trinidad and Tobago'),
(141, 'TN', 'Tunisia'),
(142, 'TR', 'Türkiye'),
(143, 'TM', 'Turkmenistan'),
(144, 'TV', 'Tuvalu'),
(145, 'UA', 'Ukraine'),
(146, 'UA', 'United Arab Emirates'),
(147, 'AE', 'United Kingdom of Great Britain and Northern Ireland'),
(148, 'UM', 'United States of America'),
(149, 'UY', 'Uruguay '),
(150, 'VU', 'Vanuatu'),
(151, 'VE', 'Venezuela, Bolivarian Republic of'),
(152, 'VN', 'Viet Nam'),
(153, 'YE', 'Yemen');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
`id_document` int(11) NOT NULL,
  `submission_id` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `file` text COLLATE utf8mb4_bin NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `indicator`
--

CREATE TABLE IF NOT EXISTS `indicator` (
`id_indicator` int(11) NOT NULL,
  `indicator_name` text NOT NULL,
  `indicator_desc` longtext NOT NULL,
  `principle_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indicator`
--

INSERT INTO `indicator` (`id_indicator`, `indicator_name`, `indicator_desc`, `principle_id`) VALUES
(1, 'Conformity to Marine Special Plans', 'Dokumen dapat berupa izin usaha dan keterangan domisili dari instansi pemerintah terkait yang mensyaratkan kesesuaian usaha pada rencana tata ruang laut\r\n', 1),
(2, 'Marine Ecosystem Restoration/ Protection', 'Dokumen dapat berupa kumpulan foto dan laporan kegiatan rutin perusahaan dalam melakukan upaya restorasi/perlindungan ekosistem laut seperti penanaman mangrove, rehabilitasi terumbu karang, perlindungan biota laut, pembersihan lingkungan pantai & laut dengan sekurang-kurangnya sebulan sekali', 1),
(3, 'Prohibition of Destructive Practices', 'Dokumen dapat berupa dokumen AMDAL dan laporan/ berita acara pekerjaan yang disertai dengan dokumentasi kegiatan', 1),
(4, 'Water-related Ecosystem Restoration/ Protection', 'Dokumen dapat berupa kumpulan foto dan laporan kegiatan rutin perusahaan dalam melakukan upaya restorasi/perlindungan ekosistem perairan seperti penanaman mangrove, vegetasi sungai, perlindungan biota perairan, pembersihan lingkungan sungai, danau atau waduk dengan sekurang-kurangnya sebulan sekali', 2),
(5, 'Clean Water System', 'Dokumen dapat berupa hasil uji AMDAL, deskripsi sistem air bersih yang digunakan, laporan atau hasil uji kualitas air yang memenuhi standar standar bahan air minum untuk non pangan, dan sesuai standar air minum untuk pangan dalam 6 bulan terakhir', 2),
(6, 'Wastewater Management', 'Dokumen dapat menunjukkan pengelolaan manajemen pengolahan air limbah sebelum dilakukan pembuangan, kapasitas IPAL yang sesuai dan memadai untuk operasional, atau hasil pembuangan air limbah sudah sesuai standar bahan air minum yang tidak mencemari lingkungan', 2),
(7, 'Waste Disposal', 'Dokumen dapat berupa dokumentasi atau layout tempat penampungan limbah yang sesuai dengan kapasitas dan under capacity', 2),
(8, 'Waste Management Plan', 'Dokumen dapat berupa dokumentasi atau rencana pengelolaan hasil limbah dengan menerapkan pemilahan sampa berdasarkan organik, non organik, medis, dan elektrik\r\nDokumen juga menyatakan dan dapat membuktikan bahwa limbah tidak menimbulkan bau yang dapat menganggu operasional', 2),
(9, 'Greenhouse Gas Accounting', 'Dokumen dapat berupa hasil perhitungan emisi gas rumah kaca yang digunakan perusahaan atau dapat menuliskan daftar peralatan, konsumsi listrik dan bahan-bahan yang digunakan dalam operasional yang menghasilkan emisi gas', 2),
(10, 'Greenhouse Gas Reduction', 'Dokumen dapat berupa rencana penerapan efektifitas dan efisiensi penggunaan bahan, peralatan dan konsumsi listrik, atau perusahaan telah menerapkan standar pembukaan Ruang Terbuka Hijau sesuai standar dari emisi gas yang dihasilkan', 2),
(11, 'Single-Use Plastic Reduction', 'Dokumen dapat berupa dokumentasi pengurangan penggunaan plastik sekali pakai dalam operasional selain untuk penggunaan kemasan dengan penggunaan plastik yang tidak berlebihan', 2),
(12, 'Water-use Management Plan', 'Dokumentasi dapat berupa perencanaan dan SOP penggunaan air dalam operasional atau dokumen perhitungan dan perencanaan penggunaan air dalam operasional selama 3 bulan terakhir', 3),
(13, 'Energy-use Management', 'Dokumen dapat menunjukkan kemampuan perusahaan dalam mengelola energi yang digunakan dalam bisnisnya, apakah dapat menggunakan secara efektif dan efisien\r\n', 3),
(14, 'Energy-use Reduction', 'Dokumentasi dapat berupa penerapan efektifitas dan efisiensi dalam penggunaan alat-alat, bahan-bahan atau konsumsi nlistrik yang dilakukan selama 3 bulan berturut-turut', 3),
(15, 'Renewable and Clean Energy Utilization', 'Dokumen dapat menunjukkan penggunaan energi terbarukan yang hemat daya, ramah lingkungan, dan mudah penggunaannya untuk menunjang kebutuhan operasional produksi atau layanan', 3),
(16, 'Access to Education', 'Dokumentasi dapat berupa SK kepada minimal satu karyawan untuk melanjutkan pendidikan formal dengan biaya penuh ditanggung perusahaan\r\nAtau dapat berupa dokumentasi pemberian peningkatan skill dan sertifikasi kepada karyawan dengan masing-masing perwakilan setiap departemen', 4),
(17, 'Access to Residence and Sanitary Amenities at Work', 'Dokumentasi dapat berupa dokumentasi fasilitas dan sarana seperti tempat tinggal yang bersih kepada karyawan yang membutuhkan (perantuan)\r\nAtau setidaknya dokumentasi perusahaan memiliki tempat istirahat yang layak dan bersih untuk karyawannya ketika jam istirahat\r\nDan peralatan kebersihan tersedia serta keadaan saniter terjaga, sebagai tempat yang nyaman selama karyawan bekerja atau berada di perusahaan / bisnis ', 4),
(18, 'Access to Safe Food and Drinking Water at Work', 'Dokumentasi dapat berupa makanan dan minuman yang tersedia di perusahaan untuk karyawan atau orang-orang di luar produk yang dijual memiliki kebersihan dan higienis yang standar, tempat makan sesuai dengan standar kebersihan, tidak ada lalat, luas ruang yang memadai dan sarana tempat makan yang sesuai', 4),
(19, 'Access to Medical Care and Insurance at Work', 'Dokumen dapat berupa daftar nama penerima manfaat asuransi kesehatan rawat jalan dan rawat inap.beserta bukti bayar premi manfaat minimal untuk pegawai tetapnya atau karyawan dengan masa kerja minimal 2 tahun\r\nAtau setidaknya dokumentasi fasilitas rawat jalann kepada seluruh karyawan dengan masa kerja minimal 1 bulan dan sudah terikat kontrak atau permanen', 4),
(20, 'Safety Working Conditions', 'Dokumentasi dapat berupa SOP kerja dan lingkungan dengan menjamin keamanan karyawannya dengan tidak membiarkan orang asing yang tidak berkepentingan masuk ke lingkungan kerja,\r\nDokumentasi perusahaan juga menyediakan peralatan kerja dan pekerja menggunakan seragam dan peralatan kerja yang sesuai agar aman dan terhindar dari kecelakaan kerja', 4),
(21, 'Healthy Working Conditions', 'Dokumentasi dapat berupa lingkungan kerja yang sehat yang terjaga kebersihannya\r\nSerta dengan melakukan skrining kepada karyawan sebelum bekerja, jika ada karyawan yang sakit agar diberikan izin khusus agar tidak mengikuti pekerjaan, agar tidak mengganggu pekerjaan dan menularkan kepada karyawan yang lain', 4),
(22, 'Community Consultation', 'Dokumentasi CSR perusahaan dengan terbuka dan/atau memberdayakan dengan komunitas yang berada di lingkungan perusahaan, baik dengan komunitas buruh, komunitas sesuai bidang bisnis, maupun komunitas penunjang bisnis', 5),
(23, 'Local Hiring', 'Dokumen dapat berupa daftar identitas nama pekerja yang setidaknya menunjukkan perusahaan memberdayakan pekerja setempat, setidaknya lebih dari 50% pekerjanya berada dalam kota yang sama', 5),
(24, 'Local Culture and Product Promotion', 'Dokumentasi bahwa perusahaan memberdayakan dan menjungjung budaya setempat yang berada di lingkungan perusahaan, baik yang berkaitan dengan buruh/pekerja ataupun pekerjaan', 5),
(25, 'Access to Natural Resources', 'Dokumen dapat menunjukkan komitmen dengan validasi tokoh setempat dengan tidak mengeksploitasi dan tidak mengganggu lingkungan sekitar, sehingga sumber daya alam, sourcing maupun aktivitas masyarakat sekitar tidak terganggu dan dapat dimanfaatkan masyarakat', 5),
(26, 'Freedom of Association', 'Dokumentasi dapat menunjukkan bahwa perusahaan memberikan kebebasan kepada karyawannya untuk berserikat atau berorganisasi baik di dalam perusahaan maupun di luar perusahaan selama karyawan tersebut tidak anarki dan masih menjaga ketertiban yang bisa dilampirkan dengan fotocopy KTA organisasi karyawan', 6),
(27, 'Non-Discrimination', 'Dokumen berupa SOP atau Aturan dalam perusahaan tidak terikat pada satu jenis golongan tertentu. Peraturan yang diterapkan perusahaan merupakan peraturan yang berlaku untuk umum dan adil kepada karyawan dan perusahaan', 6),
(28, 'Collective Bargaining', 'Dokumen berupa pernyataan bahwa perusahaan terbuaka menerima dari negosiasi buruh/pekerja baik perorangan maupun atas nama perserikatan pekerja di lingkungan perusahaan atau bisnis, perusahaan menerima aspirasi dari karyawan terkait hal-hal tentang pekerja dan mempertimbangkannya dengan adil dan seimbang', 6),
(29, 'Womens Labor Rights', 'Dokumen menunjukan apakah perusahaan dapat memenuhi hak-hak khusus yang dimiliki perempuan seperti hak untuk menutup diri, tidak melakukan pekerjaan berat di luar kemampuan, memberikan hak istimewa untuk hamil dan melahirkan dengan perjanjian yang adil\r\nPerusahaan tidak membatasi perempuan untuk menempati posisi tertentu. Perusahaan menerapkan kesetaraan gender, dengan didukung dokumentasi maupun komitmen tertulis perusahaan', 6),
(30, 'Youth Employment', 'Dokumen berupa bukti bahwa perusahaan memperkejakan, setidaknya lebih dari 50% untuk pekerja pemuda dengan rentang usia 18 - 30\r\ntahun\r\nAtau setidaknya perusahaan memiliki program managemen trainee yang konsisten untuk pemuda yang berkisar 18-25 tahun sebagai calon penerus bisnis yang cakap', 6),
(31, 'Employment of Persons with Disabilities', 'Dokumen menunjukkan data karyawan jika ada penyandang disabilitas', 6),
(32, 'No Forced Labor', 'Dokumen menunjukkan komitmen serta perjanjian kerja yang tertuang bahwa segala bentuk overtime dan pekerjaan yang diluar tanggung jawab tertulis wajib memberikan uang lembur maupun tunjangan kinerja/insentif yang sesuai dan adil', 7),
(33, 'Minimum Age and No Child Labor', 'Dokumen menunjukkan bahwa perusahaan tidak mempekerjakan anak dibawah usia <18 tahun', 7),
(34, 'Equal Remuneration', 'Dokumen Segala bentuk overtime dan pekerjaan yang diluar tanggung jawab tertulis wajib memberikan uang lembur maupun tunjangan kinerja/insentif yang sesuai dan adil', 7),
(35, 'Seasonal and Part-time Workers Employment', 'Dokumen menunjukkan bahwa perusahaan memberikan kesempatan kepada pekerja part time / paruh waktu untuk posisi apapun\r\natau memberikan kesempatan magang baik kepada pelajar maupun lulusan baru setidaknya setiap atau dalam 2 tahun terakhir ini', 7),
(36, 'Fair Contract for Employees', 'Dokumen dapat berupa isi kontrak atau perjanjian kerja yang sesuai Undag-undang Cipta kerja dan berkeadialan', 7),
(37, 'On Time Payment of Wages', 'Dokumen menunjukkan bahwa perusahaan memberikan gaji tepat waktu, tanpa menunggak sama sekali jika tidak ada masalah teknis yang jelas\r\n', 7),
(38, 'Legal Working Hours', '"Dokumen menunjukkan record absensi karyawan atau dokumentasi yang menunjukkan bahwa perusahaan menerapkan aturan jam kerja yang sesuai yaitu setidaknya 7 jam untuk 6 hari kerja dengan 1 harinya selama 4 jam, 8 jam untuk 5 hari kerja. Jika diluar itu maka wajib mengenakan overtime atau tunjangan lainnya.\r\nUntuk pekerjaan dengan sistem shift tidak menerapkan sistem overtime"\r\n', 7),
(39, 'Paid Pregnancy, Parental and Sick Leave', 'Dokumen dapat berupa kontrak kerja atau dokumen Perusahaan memberikan cuti khusus kepada pekerja yang membutuhkan atau dalam situasi kondisional mendesak. Cuti khusus diberikan kepada karyawan setidaknya untuk cuti hamil, cuti melahirkan, cuti rawat inap, cuti menikah, cuti berduka.\r\n', 7),
(40, 'Retirement Benefits', 'Dokumen dapat berupa kontrak kerja dan komitmen perusahaan akan memberikan uang pesangon kepada karyawan tetap yang dihitung prorate setidaknya selama periode karyawan tersebut bekerja, dan memberikan uang kompensasi kepada karyawan tetap\r\n', 7),
(41, 'Minimum Wage', 'Dokumen menunjukkan bahwa pekerja kontrak atau pekerja tetap wajib memenuhi standar penggajian UMR/UMK\r\n', 8),
(42, 'Living Wage', '"Dokumen menunjukkan bahwa tunjangan diberikan menyesuaikan perjanjian telah disepakati pada kontrak kerja\r\nSetidaknya jika ada pekerjaan yang dilakukan diluar tanggung jawab / jobdesk wajib memberikan tunjangan\r\nUntuk operasional yang dilakukan untuk kepentingan pekerjaan wajib memberikan tunjangan operasional dan tidak diperkenankan perusahaan membiarkan karyawan menggunakan uang pribadii untuk kepentingan operasional perusahaan"\r\n', 8),
(43, 'Premiums', 'Dokumen dapat menunjukkan Penyediaan fasilitas BPJS ketenagakerjaan dan kesehatan kepada karyawan tetap/pekerja kontrak (PU) maupun pekerja harian (BPU), yang dipotong sebagian dari karyawan dan sebagiannya dibayarkan perusahaan dengan ketentuan yang berlaku beserta bukti bayar BPJS\r\n', 9),
(44, 'Tax Compliance', 'Dokumen dapat membuktikan bahwa pembayaran pajak massa PPN dan PPH23 atas penggunaan jasa yang digunakan perusahaan/layanan maupun pajak lainnya yang berlaku secara benar dan tepat waktu\r\n', 9),
(45, 'Retribution Payment', 'Dokumentasi menunjukkan bahwa perusahaan membayar retribusi yang berlaku\r\n', 9),
(46, 'Agreement With Trader/ Costumers', '"Dokumen menunjukkan bahwa segala bentuk perjanjian dengan klient, konsumer, atau supplier harus jelas dan terikat kontrak yang nilai transaksinya dilaporkan.\r\nKesepakatan yang jelas antara penggunaan jasa dan produk yang di beli"\r\n', 10),
(47, 'Product Recycling and Reuse', 'Dokumen membuktikan bahwa perusahaan menerapkan sekecil mungkin kemungkinan limbah yang dihasilkan dengan berusaha memanfaatkan prinsip daur ulang, penggunaan kembali yang zero waste yang tidak banyak menghasilkan limbah\r\n', 10),
(48, 'Innovation and Technological Intervention', 'Dokumen menunjukkan bahwa perusahaan senantiasa menerapkan inovasi dan kreatif dengan memanfaatkan teknologi yang terus berkembang sehingga membawa kemajuan untuk perusahaan dan memudahkan operasional \r\n', 10),
(49, 'Local Micro-, Small-, and Medium Sized Enterprises Development', '"Dokumentasi menunjukkan komitmen bahwa perusahaan memberikan kesempatan kepada UMKM untuk melakukan usahanya di lingkungan perusahaan\r\ndan/atau memberdayakan produk UMKM dalam layanan/produksinya yang menggunakan bahan-bahan dari UMKM sekitar dengan dibuktikan dengan dokumentasi yang sudah berjalan"\r\n', 10),
(50, 'Digital Transformation', 'Dokumen menunjukkan bahwa perusahaan melakukan transformasi digital dalam operasional, seperti menggunakan sistem aplikasi proses, pencatatan digital yang terintegerasi, ketertelusuran dan kemudahan dalam membaca dan mencari data, sehingga operasional perusahaan dapat berjalan dengan baik dan mudah agar mudah dalam control/pengawasan\r\n', 10);

-- --------------------------------------------------------

--
-- Table structure for table `outcome`
--

CREATE TABLE IF NOT EXISTS `outcome` (
`id_outcome` int(11) NOT NULL,
  `outcome_name` varchar(100) NOT NULL,
  `aspect_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outcome`
--

INSERT INTO `outcome` (`id_outcome`, `outcome_name`, `aspect_id`) VALUES
(1, 'Food Security and Reduced Ecological Scarcities', 1),
(2, 'Food Security and Reduced Environmental Risk', 1),
(3, 'Improved Human Well Being', 2),
(4, 'Quality Jobs', 2),
(5, 'Poverty Eradication', 3),
(6, 'Economic Growth', 3),
(7, 'Sustainable Production and Consumption', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`id_payment` int(11) NOT NULL,
  `submission_id` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `file` text COLLATE utf8mb4_bin NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE IF NOT EXISTS `payment_status` (
`id_payment_status` int(11) NOT NULL,
  `status_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `status_color` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id_payment_status`, `status_name`, `status_color`) VALUES
(1, 'Pending Approval', 'warning'),
(2, 'Accepted', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `per_indicator_status`
--

CREATE TABLE IF NOT EXISTS `per_indicator_status` (
`id_status_per` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `color` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `per_indicator_status`
--

INSERT INTO `per_indicator_status` (`id_status_per`, `name`, `color`) VALUES
(0, 'Not Uploaded', 'secondary'),
(1, 'Uploaded', 'warning'),
(2, 'Submitted', 'primary'),
(3, 'Verified', 'success'),
(4, 'Declined', 'danger');

-- --------------------------------------------------------

--
-- Table structure for table `principle`
--

CREATE TABLE IF NOT EXISTS `principle` (
`id_principle` int(11) NOT NULL,
  `principle_name` varchar(100) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `outcome_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `principle`
--

INSERT INTO `principle` (`id_principle`, `principle_name`, `outcome_id`) VALUES
(1, 'Biodiversity Conservation', 1),
(2, 'Pollution Control', 2),
(3, 'Energy and Water Management', 2),
(4, 'Safe and Healthy Working Environment', 3),
(5, 'Social Inclusion', 3),
(6, 'Social Equity', 3),
(7, 'Labor Right Protection', 4),
(8, 'Wage Standards Fullfillments', 5),
(9, 'Tax and Insurance Compliances', 6),
(10, 'Competitive and Circular Economy', 7);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`id_question` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id_question`, `indicator_id`, `text`) VALUES
(1, 1, 'Apakah jenis usaha perusahaan berada pada lokasi usaha yang diperuntukkan sesuai dengan Rencana Tata Ruang Laut?'),
(2, 2, 'Apakah perusahaan secara rutin melakukan upaya restorasi/perlindungan ekosistem laut?'),
(3, 3, 'Apakah perusahaan menerapkan aktivitas yang ramah lingkungan / tidak merusak ekosistem?'),
(4, 4, 'Apakah perusahaan secara rutin melakukan upaya restorasi/perlindungan ekosistem perairan?'),
(5, 5, 'Apakah perusahaan menerapkan sistem air bersih?'),
(6, 6, 'Apakah perusahaan telah menerapkan manajemen instalasi pengolahan air limbah (IPAL)?'),
(7, 7, 'Apakah perusahaan memiliki tempat penampungan limbah?'),
(8, 8, 'Apakah perusahaan menerapkan manajemen pengelolaan limbah?'),
(9, 9, 'Apakah perusahaan menghitung jumlah gas rumah kaca yang dihasilkan selama proses bisnis yang dilakukan?'),
(10, 10, 'Apakah perusahaan telah melakukan upaya pengurangan emisi gas rumah kaca selama proses bisnis?'),
(11, 11, 'Apakah perusahaan mengurangi penggunaan plastik sekali pakai dalam proses bisnisnya?'),
(12, 12, 'Apakah perusahaan memiliki perencanaan dalam pengelolaan air?'),
(13, 13, 'Apakah perusahaan memiliki sistem manajemen energi dalam proses bisnisnya?'),
(14, 14, 'Apakah perusahaan telah melakukan upaya penghematan/konservasi energi dalam proses bisnisnya?'),
(15, 15, 'Apakah perusahaan telah menggunakan energi bersih dan terbarukan untuk proses bisnisnya?'),
(16, 16, 'Apakah perusahaan memberikan kesempatan/beasiswa untuk karyawannya melanjutkan pendidikan?'),
(17, 17, 'Apakah perusahaan menyediakan tempat tinggal dan peralatan kebersihan selama bekerja?'),
(18, 18, 'Apakah perusahaan menyediakan akses kepada makanan dan minuman yang layak saat bekerja?'),
(19, 19, 'Apakah perusahaan menyediakan akses dan asuransi kesehatan pekerja?'),
(20, 20, 'Apakah perusahaan menyediakan lingkungan kerja yang aman?'),
(21, 21, 'Apakah perusahaan menyediakan lingkungan kerja yang sehat?'),
(22, 22, 'Apakah perusahaan secara berkala berkonsultasi dengan komunitas yang berada di lingkungan kerja?'),
(23, 23, 'Apakah perusahaan membuka lowongan pekerjaan pada penduduk setempat?'),
(24, 24, 'Apakah perusahaan ikut serta dalam menjaga dan mempromosikan budaya setempat?'),
(25, 25, 'Apakah masyarakat memiliki akses ke sumberdaya alam di sekitar lokasi bisnis perusahaan?'),
(26, 26, 'Apakah perusahaan memberikan kesempatan untuk pekerja berserikat/berorganisasi baik di dalam atau di luar perusahaan?'),
(27, 27, 'Apakah perusahaan menerapkan prinsip kesetaraan serta memiliki aturan yang tidak mendiskriminasi?'),
(28, 28, 'Apakah perusahaan terbuka terhadap negosiasi buruh secara kolektif?'),
(29, 29, 'Apakah hak-hak pekerja perempuan dipenuhi oleh perusahaan?'),
(30, 30, 'Apakah ada pemuda yang bekerja dalam perusahaan?'),
(31, 31, 'Apakah ada penyandang disabilitas yang bekerja dalam perusahaan?'),
(32, 32, 'Apakah tidak ada kerja paksa dalam perusahaan (ada uang lembur kerja)?'),
(33, 33, 'Apakah perusahaan tidak memperkerjakan anak?'),
(34, 34, 'Apakah perusahaan memberikan remunerasi yang setara?'),
(35, 35, 'Apakah perusahaan memberikan kesempatan untuk pekerja musiman dan paruh waktu?'),
(36, 36, 'Apakah perusahaan menerapkan kontrak kerja yang berkeadilan bagi pekerja?'),
(37, 37, 'Apakah perusahaan memberikan gaji tepat waktu?'),
(38, 38, 'Apakah perusahaan menerapkan waktu kerja sesuai peraturan perundang-undangan?'),
(39, 39, 'Apakah perusahaan memberikan cuti hamil, cuti mengasuh anak pasca melahirkan, dan cuti sakit kepada pegawai?'),
(40, 40, 'Apakah perusahaan memberikan pesangon dan keuntungan pensiun lainnya kepada pegawai yang sudah pensiun?'),
(41, 41, 'Apakah perusahaan menggaji karyawannya sesuai standar UMR/UMP/UMK?'),
(42, 42, 'Apakah perusahaan memberikan tunjangan gaji yang layak sesuai ketentuan?'),
(43, 43, 'Apakah perusahaan membayar asuransi / iuran BPJS Ketenagakerjaan untuk pegawai?'),
(44, 44, 'Apakah perusahaan mentaati pembayaran pajak negera sesuai ketentuan yang berlaku?'),
(45, 45, 'Apakah perusahaan membayar retribusi ?'),
(46, 46, 'Apakah perusahaan memiliki kesepakatan yang jelas kepada pelanggan/konsumen maupun pedagang?'),
(47, 47, 'Apakah produk atau jasa yang disediakan perusahaan menerapkan prinsip daur ulang dan penggunaan kembali?'),
(48, 48, 'Apakah perusahaan menerapkan proses inovasi dan penggunaan teknologi dalam usahanya?'),
(49, 49, 'Apakah perusahaan ikut serta berkontribusi dalam pengembangan UMKM lokal?'),
(50, 50, 'Apakah perusahaan menerapkan transformasi digital pada proses bisnisnya?');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE IF NOT EXISTS `submission` (
  `id_submission` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `initial_score` int(11) NOT NULL,
  `date_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valid_score` int(11) NOT NULL,
  `submission_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `submission_per_indicator`
--

CREATE TABLE IF NOT EXISTS `submission_per_indicator` (
  `submission_id` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `submission_status`
--

CREATE TABLE IF NOT EXISTS `submission_status` (
`id_submission_status` int(11) NOT NULL,
  `submission_name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `color` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `submission_status`
--

INSERT INTO `submission_status` (`id_submission_status`, `submission_name`, `color`) VALUES
(1, 'Pending Payment', 'warning'),
(2, 'Document Submission', 'info'),
(3, 'On Verification Process', 'primary'),
(4, 'Document Submission (Second Attempt)', 'warning'),
(5, 'Certified', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
`id_survey` int(11) NOT NULL,
  `submission_id` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `link` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id_survey`, `submission_id`, `datetime`, `link`) VALUES
(1, 'BXSUBMARIT20220721', '2022-07-21 03:42:17', 'asaasas'),
(2, 'BXSUBMARIT20220721', '2022-07-01 12:06:00', '1212');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'Admin', 'admin@admin.com', 'profile1.jpg', '$2y$10$qpA3ekgRaos./ZO10lul/.BIpIAPyzveajozEShz8ji38ZO1kE4Gm', 1, 1, 1552120289),
(9, 'Maritimepreneur', 'user@user.com', 'default.jpg', '$2y$10$n2I6e0JdHwppDx3It4PgLeemIhyVPtpyxy7BGpevirUdRAqB/n8PG', 2, 1, 1656515338),
(11, 'PT Lebak Nusantara', 'lebak@user.com', 'default.jpg', '$2y$10$n2I6e0JdHwppDx3It4PgLeemIhyVPtpyxy7BGpevirUdRAqB/n8PG', 2, 1, 1656515338);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE IF NOT EXISTS `user_access_menu` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(7, 1, 3),
(10, 1, 5),
(11, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE IF NOT EXISTS `user_menu` (
`id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Submission'),
(5, 'Management'),
(6, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE IF NOT EXISTS `user_sub_menu` (
`id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Dashboard', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 6, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 6, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 5, 'User Management', 'management/userManagementIndex', 'fas fa-fw fa-key', 1),
(10, 5, 'Aspect Management', 'management/aspect', 'fas fa-fw fa-key', 1),
(11, 5, 'Outcome Management', 'management/outcome', 'fas fa-fw fa-key', 1),
(12, 5, 'Principle Management', 'management/principle', 'fas fa-fw fa-key', 1),
(13, 5, 'Indicator Management', 'management/indicator', 'fas fa-fw fa-key', 1),
(14, 5, 'Country Management', 'management/country', 'fas fa-fw fa-key', 1),
(15, 5, 'Company Field Management', 'management/company_field', 'fas fa-fw fa-key', 1),
(17, 3, 'Payment Verification', 'management/paymentManagement', 'fas fa-fw fa-key', 1),
(18, 3, 'Submission Management', 'management/submissionManagement', 'fas fa-fw fa-key', 1),
(19, 3, 'Certificate Management', 'management/certificateManagement', 'fas fa-fw fa-key', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE IF NOT EXISTS `user_token` (
`id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'meliaharda@gmail.com', 'ncwXpRZg5CxU17PQ29yIB41e1aHufP3ng9gMC3uNNdo=', 1656515215),
(2, 'meliaharda@gmail.com', 'm/TP5uCsW8uPLR36dbTjfAz9NH40ZzcplVVltqaVWpA=', 1656515282),
(3, 'meliaharda@gmail.com', 'eyst9rOes20PAS2IUZ4b+ofwndUhtEnmZtPEqF5rxdw=', 1656515338);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`id_answer`);

--
-- Indexes for table `aspect`
--
ALTER TABLE `aspect`
 ADD PRIMARY KEY (`id_aspect`);

--
-- Indexes for table `becdex_cat`
--
ALTER TABLE `becdex_cat`
 ADD PRIMARY KEY (`id_becdex_cat`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
 ADD PRIMARY KEY (`id_certificate`);

--
-- Indexes for table `company_detail`
--
ALTER TABLE `company_detail`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `company_field`
--
ALTER TABLE `company_field`
 ADD PRIMARY KEY (`id_company_field`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
 ADD PRIMARY KEY (`id_country`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
 ADD PRIMARY KEY (`id_document`);

--
-- Indexes for table `indicator`
--
ALTER TABLE `indicator`
 ADD PRIMARY KEY (`id_indicator`);

--
-- Indexes for table `outcome`
--
ALTER TABLE `outcome`
 ADD PRIMARY KEY (`id_outcome`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
 ADD PRIMARY KEY (`id_payment_status`);

--
-- Indexes for table `per_indicator_status`
--
ALTER TABLE `per_indicator_status`
 ADD PRIMARY KEY (`id_status_per`);

--
-- Indexes for table `principle`
--
ALTER TABLE `principle`
 ADD PRIMARY KEY (`id_principle`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
 ADD PRIMARY KEY (`id_submission`);

--
-- Indexes for table `submission_status`
--
ALTER TABLE `submission_status`
 ADD PRIMARY KEY (`id_submission_status`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
 ADD PRIMARY KEY (`id_survey`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `id_answer` int(128) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aspect`
--
ALTER TABLE `aspect`
MODIFY `id_aspect` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `becdex_cat`
--
ALTER TABLE `becdex_cat`
MODIFY `id_becdex_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
MODIFY `id_certificate` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_field`
--
ALTER TABLE `company_field`
MODIFY `id_company_field` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `indicator`
--
ALTER TABLE `indicator`
MODIFY `id_indicator` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `outcome`
--
ALTER TABLE `outcome`
MODIFY `id_outcome` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
MODIFY `id_payment_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `per_indicator_status`
--
ALTER TABLE `per_indicator_status`
MODIFY `id_status_per` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `principle`
--
ALTER TABLE `principle`
MODIFY `id_principle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `submission_status`
--
ALTER TABLE `submission_status`
MODIFY `id_submission_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
MODIFY `id_survey` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;