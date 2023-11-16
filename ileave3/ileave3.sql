-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2016 at 01:58 PM
-- Server version: 5.5.42
-- PHP Version: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ileave3`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbconfig`
--

CREATE TABLE `tbconfig` (
  `id` int(11) NOT NULL,
  `sendemail` tinyint(4) DEFAULT '0' COMMENT '0=ไม่่ส่งเมลล์,1=ส่งเมลล์',
  `email` varchar(50) DEFAULT NULL,
  `email_password` varchar(50) DEFAULT NULL,
  `email2` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbconfig`
--

INSERT INTO `tbconfig` (`id`, `sendemail`, `email`, `email_password`, `email2`) VALUES
(1, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbdepart`
--

CREATE TABLE `tbdepart` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbdepart`
--

INSERT INTO `tbdepart` (`id`, `team_id`, `code`, `name`) VALUES
(1, 23, '', 'ธุรการ'),
(2, 22, '', 'บัญชี'),
(3, 25, '', 'การเงิน'),
(5, 26, '', 'ธุรการ');

-- --------------------------------------------------------

--
-- Table structure for table `tbleavemanage`
--

CREATE TABLE `tbleavemanage` (
  `id` int(11) NOT NULL,
  `depart_id` int(5) NOT NULL COMMENT 'การลาในแผนก',
  `person_id` int(5) NOT NULL COMMENT 'รหัสผู้ตรวจสอบ',
  `boss_id` int(5) DEFAULT NULL COMMENT 'รหัสผู้อนุมัติ',
  `user_id` int(5) NOT NULL COMMENT 'ผู้ลา',
  `leave_type_id` int(5) NOT NULL COMMENT 'ประเภทการลา',
  `writing` varchar(255) NOT NULL COMMENT 'เขียนที่',
  `title` varchar(255) NOT NULL COMMENT 'เรื่อง',
  `president` varchar(255) NOT NULL COMMENT 'เรียนถึง',
  `datefrom` date NOT NULL COMMENT 'ลาตั้งแต่วันที่',
  `dateto` date NOT NULL COMMENT 'ลาถึงวันที่',
  `timerang` varchar(20) NOT NULL COMMENT 'ช่วงเวลาการลา',
  `amountdate` int(11) NOT NULL COMMENT 'จำนวนวันลา',
  `comment` text NOT NULL COMMENT 'เพราะอะไรถึงลา',
  `address` text NOT NULL COMMENT 'ที่อยู่ติดต่อระหว่างลา',
  `status` varchar(20) NOT NULL COMMENT 'สถานะการลา มี 5 สถานะ',
  `status_detail` text COMMENT 'เหตุผลถ้าไม่อนุมัติ',
  `comment_detail` text COMMENT 'หมายเหตุ กรณีที่ไม่อนุมัติ',
  `ordain_status` int(5) DEFAULT NULL COMMENT '0 = ไม่เคยอุปสมบท , 1 = เคยอุปสมบทแล้ว',
  `measure_address` text COMMENT 'ที่อยู่วัด',
  `dateofordination` date DEFAULT NULL COMMENT 'วันที่บวช',
  `temple_address` text COMMENT 'ที่จำพรรษา',
  `newbihelp` varchar(255) DEFAULT NULL COMMENT 'ชื่อภริยากรณีลาเพื่อช่วยเหลือภริยาคลอดบุตร',
  `date_newbihelp` date DEFAULT NULL,
  `dateregist` varchar(50) NOT NULL COMMENT 'วันที่ทำการลา',
  `approval_date` datetime DEFAULT NULL COMMENT 'วันที่อนุญาติ',
  `OKapproval_date` datetime DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbleavemanage`
--

INSERT INTO `tbleavemanage` (`id`, `depart_id`, `person_id`, `boss_id`, `user_id`, `leave_type_id`, `writing`, `title`, `president`, `datefrom`, `dateto`, `timerang`, `amountdate`, `comment`, `address`, `status`, `status_detail`, `comment_detail`, `ordain_status`, `measure_address`, `dateofordination`, `temple_address`, `newbihelp`, `date_newbihelp`, `dateregist`, `approval_date`, `OKapproval_date`, `ip`) VALUES
(120, 1, 17, 20, 7, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'ผู้อำนวยการศูนย์', '2016-11-04', '2016-11-05', '00:00:00', 1, 'ไม่สบาย ปวดหัว', 'บ้าน', 'yes', '', '', 0, '', '0000-00-00', '', '', '0000-00-00', '2016-11-12 07:43:57', '2016-11-12 23:47:11', '2016-11-13 02:27:11', '::1'),
(121, 1, 17, 20, 7, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'ผู้อำนวยการ', '2016-11-04', '2016-11-04', '00:00:00', 1, 'ปวดหัว', '09890988776', 'yes', '', '', 0, '', '0000-00-00', '', '', '0000-00-00', '2016-11-12 07:47:39', '2016-11-12 23:48:11', '2016-11-13 02:36:11', '::1'),
(122, 1, 17, 0, 7, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'ผู้อำนวยการกองกลาง', '2016-11-05', '2016-11-05', '08:30-12:00', 1, 'ปวดขี้', 'ภภภ', 'no', '5555', '', 0, '', '0000-00-00', '', '', '0000-00-00', '2016-11-12 08:30:42', '2016-11-13 00:48:11', NULL, '::1'),
(123, 1, 0, 0, 7, 2, 'อีสานเดฟ มหาสารคาม', 'ขอลากิจส่วนตัว', 'หัวหน้าฝ่าย', '2016-11-04', '2016-11-04', '08:30-16:30', 1, 'ไปธุระต่างจังหวัด', '0989898887', 'disapproval', '', '', 0, '', '0000-00-00', '', '', '0000-00-00', '2016-11-12 08:55:49', '0000-00-00 00:00:00', NULL, '::1'),
(124, 1, 0, 20, 7, 5, 'test', 'ขอลาไปช่วยเหลือภริยาที่คลอดบุตร', 'tet', '2016-11-03', '2016-11-30', '08:30-16:30', 1, 'tet', 'ss', 'no', '', 'test', NULL, NULL, '0000-00-00', NULL, 'sss', '0000-04-06', '2016-11-12 09:50:41', '0000-00-00 00:00:00', '2016-11-13 02:40:11', '::1'),
(125, 1, 17, 20, 7, 5, 'อีสานเดฟ มหาสารคาม', 'ขอลาไปช่วยเหลือภริยาที่คลอดบุตร', 'หัวหน้าฝ่าย ธุรการ', '2016-12-01', '2016-12-30', '08:30-16:30', 1, 'ดูแลบุตรที่คลอด', 'เบอร์โทร', 'yes', '', '', NULL, NULL, '0000-00-00', NULL, 'อุษ', '2016-10-03', '2016-11-12 09:52:56', '0000-00-00 00:00:00', '2016-11-13 02:40:11', '::1'),
(126, 1, 17, 0, 7, 5, 'อีสานเดฟ มหาสารคาม', 'ขอลาไปช่วยเหลือภริยาที่คลอดบุตร', 'หัวหน้า', '2016-11-12', '2016-11-18', '08:30-16:30', 7, 'คลอดบุตร', 'กกก', 'approve', '', '', NULL, NULL, '0000-00-00', NULL, 'กก', '2016-09-06', '2016-11-12 09:55:01', '0000-00-00 00:00:00', NULL, '::1'),
(127, 1, 0, 0, 7, 6, 'อีสานเดฟ มหาสารคาม', 'ขอการลาอุปสมบท', 'หัวหน้า', '2016-11-03', '2016-11-23', '08:30-16:30', 21, 'ก', 'ก', 'cancel', '', '', 1, NULL, '0000-00-00', 'ก', NULL, NULL, '2016-11-12 10:14:22', '0000-00-00 00:00:00', NULL, '::1'),
(128, 1, 0, 0, 7, 6, 'อีสานเดฟ มหาสารคาม', 'ขอการลาอุปสมบท', 'พพพ', '2016-11-11', '2016-11-25', '08:30-16:30', 15, 'พพพ', 'พพ', 'cancel', '', '', 1, NULL, '2016-11-26', 'พพ', NULL, NULL, '2016-11-12 10:16:19', '0000-00-00 00:00:00', NULL, '::1'),
(129, 3, 18, NULL, 8, 1, 'มหาวิทยาลัยราชภัฏมหาสารคาม', 'ขอลาป่วย', 'ผู้อำนวยการกองกลาง', '2016-11-17', '2016-11-17', '08:30-16:30', 1, 'ไม่สบาย เป็นไข้ ตัวร้อน', 'เบอร์โทร', 'no', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 02:45:14', '2016-11-13 20:34:11', NULL, '::1'),
(130, 3, 18, NULL, 8, 2, 'อีสานเดฟ มหาสารคาม', 'ขอลากิจส่วนตัว', 'หัวหน้าแผนก', '2016-11-18', '2016-11-20', '08:30-16:30', 3, 'ไปธุระต่างจังหวัด', '0810917526', 'approve', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 17:51:28', '2016-05-10 20:34:11', NULL, '::1'),
(131, 3, 18, NULL, 8, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'หัวหน้าแผนก', '2016-11-12', '2016-11-12', '08:30-16:30', 1, 'ไม่สบายอีกแล้ว', 'เบอร์โทร', 'approve', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 17:55:36', '2016-11-13 20:41:11', NULL, '::1'),
(132, 3, 0, NULL, 8, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'หัวหน้าแผนก', '2016-11-14', '2016-11-14', '08:30-16:30', 1, 'ปวดท้อง', 'เบอร์โทร', 'wait', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 17:57:45', NULL, NULL, '::1'),
(133, 3, 0, NULL, 8, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'มหาวิทยาลัยราชภัฏมหาสารคาม', '2016-11-23', '2016-11-23', '08:30-16:30', 1, 'เป็นไข้', '0810917526', 'wait', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 17:59:53', NULL, NULL, '::1'),
(134, 3, 18, NULL, 8, 2, 'อีสานเดฟ มหาสารคาม', 'ขอลากิจส่วนตัว', 'หัวหน้าแผนก', '2016-11-25', '2016-11-26', '08:30-16:30', 2, 'มีธุระต่างจังหวัด', 'หห', 'approve', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 18:00:26', '2016-11-13 20:41:11', NULL, '::1'),
(135, 3, 18, NULL, 8, 3, 'อีสานเดฟ มหาสารคาม', 'ขอลาคลอดบุตร', 'ปปป', '2016-11-30', '2016-12-02', '08:30-16:30', 3, 'ปปป', 'ปปป', 'approve', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 18:03:14', '2016-11-13 20:41:11', NULL, '::1'),
(136, 3, 0, NULL, 8, 4, 'อีสานเดฟ มหาสารคาม', 'ขอลาพักผ่อน', 'ดกดก', '2016-11-25', '2016-11-30', '08:30-16:30', 6, 'กดกด', 'ดกด', 'wait', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 18:05:21', NULL, NULL, '::1'),
(137, 3, 0, NULL, 8, 5, 'อีสานเดฟ มหาสารคาม', 'ขอลาไปช่วยเหลือภริยาที่คลอดบุตร', 'fd', '2016-11-16', '2016-11-29', '08:30-16:30', 14, '555', '555', 'wait', NULL, NULL, NULL, NULL, NULL, NULL, '555', '2016-11-01', '2016-11-13 18:18:17', NULL, NULL, '::1'),
(138, 3, 0, NULL, 8, 6, 'อีสานเดฟ มหาสารคาม', 'ขอการลาอุปสมบท', 'dfdf', '2016-11-14', '2016-11-22', '08:30-16:30', 9, 'dfdf', 'dfdfd', 'wait', NULL, NULL, 0, '888', '2016-11-17', 'dfdfd', NULL, NULL, '2016-11-13 18:24:38', NULL, NULL, '::1'),
(139, 1, 0, NULL, 7, 1, 'อีสานเดฟ มหาสารคาม', 'ขอลาป่วย', 'dd', '2016-11-24', '2016-11-25', '08:30-16:30', 2, 'dd', 'dfd', 'wait', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-13 20:59:40', NULL, NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbleave_type`
--

CREATE TABLE `tbleave_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `totall` int(2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbleave_type`
--

INSERT INTO `tbleave_type` (`id`, `name`, `url`, `description`, `totall`) VALUES
(1, 'ลาป่วย', 'sick', '- ข้าราชการซึ่งประสงค์จะลาป่วยเพื่อรักษาตัว ให้เสนอหรือจัดส่งใบลาต่อผู้บังคับบัญชา ตามลําดับจนถึงผู้มีอํานาจอนุญาตก่อนหรือในวันที่ลา เว้นแต่ในกรณีจําเป็น จะเสนอหรือจัดส่งใบลา ในวันแรกที่มาปฏิบัติราชการก็ได้ <hr/>\n  ในกรณีที่ข้าราชการผู้ขอลามีอาการป่วยจนไม่สามารถจะลงชื่อในใบลาได้ จะให้ผู้อื่นลาแทนก็ได้ แต่เมื่อสามารถลงชื่อได้แล้ว ให้เสนอหรือจัดส่งใบลาโดยเร็ว \n<hr/>\nการลาป่วยตั้งแต่ ๓๐ วันขึ้นไป ต้องมีใบรับรองของแพทย์ซึ่งเป็นผู้ที่ได้ขึ้นทะเบียนและ รับใบอนุญาตเป็นผู้ประกอบวิชาชีพเวชกรรมแนบไปกับใบลาด้วย ในกรณีจําเป็นหรือเห็นสมควร ผู้มีอํานาจอนุญาตจะสั่งให้ใช้ใบรับรองของแพทย์อื่นซึ่งผู้มีอํานาจอนุญาตเห็นชอบแทนก็ได้ \n<hr/>\nการลาป่วยไม่ถึง ๓๐ วัน ไมว่ ่าจะเป็นการลาครั้งเดียวหรือหลายครั้งติดต่อกัน ถ้าผู้มีอํานาจอนุญาตเห็นสมควร จะสั่งให้มีใบรับรองของแพทย์ตามวรรคสามประกอบใบลา หรือสั่งให้ผู้ลาไปรับ การตรวจจากแพทย์ของทางราชการเพื่อประกอบการพิจารณาอนุญาตก็ได้ \n\n', 0),
(2, 'ลากิจส่วนตัว', 'carer', '&nbsp;&nbsp;&nbsp;&nbsp;ข้าราชการซึ่งประสงค์จะลากิจส่วนตัว ให้เสนอหรือจัดส่งใบลาต่อผู้บังคับบัญชาตามลําดับจนถึงผู้มีอํานาจอนุญาต และเมื่อได้รับอนุญาตแล้วจึงจะหยุดราชการได้ เว้นแต่มีเหตุจําเป็นไม่สามารถรอรับอนุญาตได้ทัน จะเสนอหรือจัดส่งใบลาพร้อมระบุเหตุจําเป็นไว้ แล้วหยุดราชการไปก่อนก็ได้ แตจะต ่ ้องชี้แจงเหตุผลให้ผู้มีอํานาจอนุญาตทราบโดยเร็ว \n<hr/>\n&nbsp;&nbsp;&nbsp;&nbsp;ในกรณีมีเหตุพิเศษที่ไม่อาจเสนอหรือจัดส่งใบลาก่อนตามวรรคหนึ่งได้ ให้เสนอหรือจัดส่งใบลาพร้อมทั้งเหตุผลความจําเป็นต่อผู้บังคับบัญชาตามลําดับจนถึงผู้มีอํานาจอนุญาตทันทีในวันแรก ที่มาปฏิบัติราชการ\n<hr/>\n&nbsp;&nbsp;ข้าราชการที่ลาคลอดบุตรตามข้อ ๑๙ แล้ว หากประสงค์จะลากิจส่วนตัวเพื่อเลี้ยงดูบุตร ให้มีสิทธิลาต่อเนื่องจากการลาคลอดบุตรได้ไม่เกิน ๑๕๐ วันทําการ \n', 0),
(3, 'ลาคลอดบุตร', 'Maternity', 'ข้าราชการซึ่งประสงค์จะลาคลอดบุตร ให้เสนอหรือจัดส่งใบลาต่อผู้บังคับบัญชา\r\nตามลําดับจนถึงผู้มีอํานาจอนุญาตก่อนหรือในวันที่ลา เว้นแต่ไม่สามารถจะลงชื่อในใบลาได้ จะให้ผู้อื่นลาแทนก็ได้ แต่เมื่อสามารถลงชื่อได้แล้ว ให้เสนอหรือจัดส่งใบลาโดยเร็ว โดยไม่ต้องมีใบรับรอง ของแพทย์ \r\n<hr>\r\nการลาคลอดบุตรจะลาในวันที่คลอด ก่อน หรือหลังวันที่คลอดบุตรก็ได้ แต่เมื่อรวมวันลาแล้วต้องไม่เกิน ๙๐ วัน \r\n<hr>\r\nข้าราชการที่ได้รับอนุญาตให้ลาคลอดบุตรและได้หยุดราชการไปแล้ว แต่ไม่ได้คลอดบุตร ตามกําหนด หากประสงค์จะขอยกเลิกวันลาคลอดบุตรที่หยุดไป ให้ผู้มีอํานาจอนุญาตอนุญาตให้ยกเลิกวันลาคลอดบุตรได้ โดยให้ถือว่าวันที่ได้หยุดราชการไปแล้วเป็นวันลากิจส่วนตัว \r\n<hr>\r\nการลาคลอดบุตรคาบเกี่ยวกับการลาประเภทใดซึ่งยังไม่ครบกําหนดวันลาของการลาประเภทนั้น ให้ถือว่าการลาประเภทนั้นสิ้นสุดลง และให้นับเป็นการลาคลอดบุตรตั้งแต่วันเริ่มวันลาคลอดบุตร \r\n\r\n\r\n', 7),
(4, 'ลาพักผ่อน', 'rest', 'ข้าราชการมีสิทธิลาพักผ่อนประจําปีในปีงบประมาณหนึ่งได้ ๑๐ วันทําการ เว้นแต่\nข้าราชการดังต่อไปนี้ไม่มีสิทธิลาพักผ่อนประจําปีในปีที่ได้รับบรรจุเข้ารับราชการยังไม่ถึง ๖ เดือน \n(๑) ผู้ซึ่งได้รับบรรจุเข้ารับราชการเป็นข้าราชการครั้งแรก \n(๒) ผู้ซึ่งลาออกจากราชการเพราะเหตุส่วนตัว แล้วต่อมาได้รับบรรจุเข้ารับราชการอีก \n(๓) ผู้ซึ่งลาออกจากราชการเพ่อดื ํารงตําแหน่งทางการเมืองหรือเพื่อสมัครรับเลือกตั้งแล้วต่อมาได้รับบรรจุเข้ารับราชการอีกหลัง ๖ เดือน นับแต่วันออกจากราชการ \n(๔) ผู้ซึ่งถูกสั่งให้ออกจากราชการในกรณีอื่น นอกจากกรณีไปรับราชการทหารตามกฎหมาย ว่าด้วยการรับราชการทหาร และกรณีไปปฏิบัติงานใด ๆ ตามความประสงค์ของทางราชการ แล้วต่อมาได้รับบรรจุเข้ารับราชการอีก\n<hr/>\nถ้าในปีใดข้าราชการผู้ใดมิไดลาพ ้ ักผ่อนประจําปี หรือลาพักผ่อนประจําปีแล้วแต่ไม่ครบ ๑๐ วันทําการ ให้สะสมวันที่ยังมิได้ลาในปีนั้นรวมเข้ากับปีต่อ ๆ ไปได้ แต่วันลาพักผ่อนสะสมรวมกับวันลาพักผ่อนในปีปัจจุบันจะต้องไม่เกิน ๒๐ วันทําการ \n<hr/>\nสําหรับผู้ที่ได้รับราชการติดต่อกันมาแล้วไม่น้อยกว่า ๑๐ ปี ให้มีสิทธินําวันลาพักผ่อนสะสมรวมกับวันลาพักผ่อนในปีปัจจุบันได้ไม่เกิน ๓๐ วันทําการ \n<hr/>\nให้ข้าราชการที่ประจําการในต่างประเทศในเมืองที่กําลังพัฒนาซึ่งตั้งอยู่ในภูมิภาค\nแอฟริกา ลาตินอเมริกา และอเมริกากลาง หรือเมืองที่มีความเป็นอยู่ยากลําบาก เมืองที่มีภาวะ ความเป็นอยู่ไม่ปกติ และเมืองที่มีสถานการณ์พิเศษ มีสิทธิลาพักผ่อนประจําปีในปีหนึ่งได้เพิ่มขึ้นอีก ๑๐ วันทําการ สําหรับวันลาตามข้อนี้มิให้นําวันที่ยังมิได้ลาในปีนั้นรวมเข้ากับปีต่อไป \n<hr/>\nการกําหนดรายชื่อเมืองตามวรรคหนึ่ง ให้เป็นไปตามที่ปลัดสํานักนายกรัฐมนตรีประกาศกําหนดอย่างน้อยปีละหนึ่งครั้ง\n<hr/>\nข้าราชการซึ่งประสงค์จะลาพักผ่อน ให้เสนอหรือจัดส่งใบลาต่อผู้บังคับบัญชา\nตามลําดับจนถึงผู้มีอํานาจอนุญาต และเมื่อได้รับอนุญาตแล้วจึงจะหยุดราชการได\n<hr/>\nการอนุญาตให้ลาพักผ่อน ผู้มีอํานาจอนุญาตจะอนุญาตให้ลาครั้งเดียวหรือหลายครั้งก็ได้ โดยมิให้เสียหายแก่ราชการ \n <hr/>\nข้าราชการประเภทใดที่ปฏิบัติงานในสถานศึกษาและมีวันหยุดภาคการศึกษา หากได้หยุดราชการตามวันหยุดภาคการศึกษาเกินกว่าวันลาพักผ่อนตามระเบียบนี้ ไม่มีสิทธิลาพักผ่อนตามที่กําหนดไว้ในส่วนนี้ \n\n\n\n', 0),
(5, 'ลาไปช่วยเหลือภริยาที่คลอดบุตร', 'help-his-wife', 'ข้าราชการซึ่งประสงค์จะลาไปช่วยเหลือภริยาโดยชอบด้วยกฎหมายที่คลอดบุตร \r\nให้เสนอหรือจัดส่งใบลาต่อผู้บังคับบัญชาตามลําดับจนถึงผู้มีอํานาจอนุญาตก่อนหรือในวันที่ลาภายใน ๙๐ วัน นับแต่วันที่คลอดบุตร และให้มีสิทธิลาไปช่วยเหลือภริยาท่ีคลอดบุตรครั้งหนึ่งติดต่อกันได้ ไม่เกิน ๑๕ วันทําการ\r\n<hr>\r\nผู้มีอํานาจอนุญาตตามวรรคหนึ่งอาจให้แสดงหลักฐานประกอบการพิจารณาอนุญาตด้วยก็ได้', 0),
(6, 'การลาอุปสมบท', 'ordain', 'ข้าราชการซึ่งประสงค์จะลาอุปสมบทในพระพุทธศาสนา หรือข้าราชการที่นับถือ\nศาสนาอิสลามซึ่งประสงค์จะลาไปประกอบพิธีฮัจย์ ณ เมืองเมกกะ ประเทศซาอุดีอาระเบีย ให้เสนอหรือจัดส่งใบลาต่อผู้บังคับบัญชาตามลําดับจนถึงผู้มีอํานาจพิจารณาหรืออนุญาตก่อนวันอุปสมบท หรือก่อนวันเดินทางไปประกอบพิธีฮัจย์ไม่น้อยกว่า ๖๐ วัน\n<hr/>\nในกรณีมีเหตุพิเศษไม่อาจเสนอหรือจัดส่งใบลาก่อนตามวรรคหนึ่ง ให้ชี้แจงเหตุผลความจําเป็นประกอบการลา และให้อยู่ในดุลพินิจของผู้มีอํานาจพิจารณาหรืออนุญาตที่จะพิจารณาให้ลาหรือไม่ก็ได้ \n<hr/>\nข้าราชการที่ได้รับพระราชทานพระบรมราชานุญาตให้ลาอุปสมบทหรือได้รับอนุญาต\nให้ลาไปประกอบพิธีฮัจย์ตามข้อ ๒๙ แล้ว จะตองอ้ ุปสมบทหรือออกเดินทางไปประกอบพิธีฮัจย์ภายใน ๑๐ วันนับแต่วันเริ่มลา และจะต้องกลับมารายงานตัวเข้าปฏิบัติราชการภายใน ๕ วันนับแต่วันที่ลาสิกขาหรือวันที่เดินทางกลับถึงประเทศไทยหลังจากการเดินทางไปประกอบพิธีฮัจย์ ทั้งนี้ จะต้องนับรวมอยู่ภายในระยะเวลาที่ได้รับอนุญาตการลา\n\n', 0),
(7, 'การลาเข้ารับการตรวจเลือกหรือเข้ารับการเตรียมพล ', 'Select', '-', 0),
(8, 'การลาไปศึกษา ฝึกอบรม ปฏิบัติการวิจัย หรือดูงาน ', 'education-training-research-work', '-', 0),
(9, 'การลาไปปฏิบัติงานในองค์การระหว่างประเทศ ', 'work-in-international-organizations', '-', 0),
(10, 'การลาติดตามคู่สมรส ', 'Leave-a-spouse', '-', 0),
(11, 'การลาไปฟื้นฟูสมรรถภาพด้านอาชีพ', 'to-the-Vocational-Rehabilitation', 'to the Vocational Rehabilitation', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbperson`
--

CREATE TABLE `tbperson` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `card_id` varchar(13) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `name` varchar(200) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text,
  `mobile` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0=รอการอนุมัติ,1=ใช้งาน,2=ระงับการใช้งาน',
  `role_id` tinyint(4) DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `birthday` date NOT NULL COMMENT 'วันเกิด',
  `created` date NOT NULL COMMENT 'วันที่เข้าทำการ,รับราชการ'
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbperson`
--

INSERT INTO `tbperson` (`id`, `picture`, `card_id`, `name`, `position`, `username`, `password`, `mobile`, `tel`, `depart_id`, `status`, `role_id`, `email`, `birthday`, `created`) VALUES
(13, '', '2909899987899', 'นครินทร์ ม่วงอ่อน', 'นักวิชาการคอมพิวเตอร์', 'admin', '3sctGbAHqArDiWjJXhmSrRQuhaVEGkRpZUKHkRS56C4N7cABxpqeIkFVcNFegeaGQ7Yxwu6WIjDundutFHtuNg==', '0810917526', '8907', 2, 1, 1, 'm.nakharin@gmail.com', '0000-00-00', '2016-11-11'),
(15, '', '1229099899876', 'คณาทรัพย์ ประสาร', 'นักวิชาการคอมพิวเตอร์', 'user', 'xSlrhTk5YIywvBm7nt9zaAooXeqZt6yHWwuBVTyH+qvyb/cSe5J+Rgz6BBo0jTAB8BwrV02o42tOA2KJuM4uSg==', '444', '44', 3, 1, 1, 'nakharin.mua@msu.ac.th', '0000-00-00', '2016-11-11'),
(16, '', ' 144990019899', 'อุษณีย์ วิริยะ', 'นักวิชาการคอมพิวเตอร์', 'miw', 'pIDj60vj1lPrqLx+DbARtMukZuXfsMkUnHd9u2NFVSPfa0s7AcmkidKNQeOpzMtQLZ0scdes00F2aLOiaSI2Aw==', '0640056793', '', 2, 1, 2, 'm.nakharin@gmail.com', '0000-00-00', '2016-11-13'),
(17, '', '1223432425', 'เจษฎา นามเชียงใต้', 'นักวิชาการคอมพิวเตอร์', 'pom', 'vj23d3Ql6qWA01tYPSwZIo7F7PpOAYSf6I7u+hAsBLIdgybEdSbrK6QHj1PzbvOnMfHXB54o2lHWqPaRdcB0Iw==', '0640056793', '-', 1, 1, 2, 'm.nakharin@gmail.com', '0000-00-00', '2016-11-12'),
(18, '', '9999999999999', 'สุรชัย นามโยธา', 'นักวิชาการคอมพิวเตอร์', 'root', '1c1w37YJ3Qnp9PU8EK1HohtehOSNsoggy0x+yodRvmCbn4/Qh6mNB3Xmt78nfeDMEBaRV4OuikPytcex/0TxgA==', '0640056793', '-', 3, 1, 2, 'm.nakharin@gmail.com', '0000-00-00', '2016-11-12'),
(19, '', '21234543212', 'มาดี ไปดี', 'นักวิชาการคอมพิวเตอร์', 'user1', '/R/1RhXFUhe0vChzP9yIP+Zdlg4tnW0LlEXCnxqkRyE+3OIfpM596DS1xukLigtMv2VtmGEX96c54zAf+DWRtA==', '0640056793', '-', 2, 1, 3, 'leksoft@hotmail.com', '0000-00-00', '2016-11-13'),
(20, '', '3239809890987', 'มารวย ดีมาก', 'นักวิชาการคอมพิวเตอร์', 'user2', 'Koc3EYgV/4H7L2yCLR8k1t1SR0m2YTL3IGyTEwVw2YN8RwzaD5BvITJGb6uspzEENMJwzIK/yfDl94xLiTjeHw==', '0640056793', '-', 1, 1, 3, 'nakharin.mua@msu.ac.th', '0000-00-00', '2016-11-13'),
(21, '', '3244566543322', 'สุดใจ ใจดี', 'นักวิชาการคอมพิวเตอร์', 'user3', 'HH82VPPllEuUQqrMF9gYeQJ4zp98eDAtJMN8MA4UizHCxg9pn+mR02UTRwOPINMJ3rmtXRVpnul8Bz6Owf7mWg==', '0640056793', '-', 3, 1, 3, 'm.nakharin@gmail.com', '0000-00-00', '2016-11-13'),
(22, '', '9999999999999', 'Administrator', 'ผู้ดูแลระบบสูงสุด', 'administrator', '9GR2KyBvgt9PYfheEUBm9c6Db2B7WVdZhTKXS1g8TDK5WSu7rd0R6yZYA3glNMVx+nE/Wdf2hu/apimLHH2TOA==', '0810917656', '6102', 1, 1, 1, 'm.nakharin@gmail.com', '0000-00-00', '2016-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbrole`
--

CREATE TABLE `tbrole` (
  `role_id` int(3) NOT NULL,
  `role_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbrole`
--

INSERT INTO `tbrole` (`role_id`, `role_name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'ผู้ตรวจสอบ'),
(3, 'ผู้อนุมัติ'),
(4, 'ผู้ลา');

-- --------------------------------------------------------

--
-- Table structure for table `tbsessions`
--

CREATE TABLE `tbsessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsessions`
--

INSERT INTO `tbsessions` (`id`, `ip_address`, `timestamp`, `data`, `create`) VALUES
('8345e0e9a5f9f8482d584acec8248d5bedfb7bcb', '::1', 1479179054, '__ci_last_regenerate|i:1479177258;', '2016-11-15 03:04:14'),
('f92fe6e4ef7ba819082d417795fd863649381670', '::1', 1479183451, '__ci_last_regenerate|i:1479183450;', '2016-11-15 04:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbteam`
--

CREATE TABLE `tbteam` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbteam`
--

INSERT INTO `tbteam` (`id`, `code`, `name`) VALUES
(25, '004', 'คณะเทคโนโลยีสารสนเทศ'),
(26, NULL, 'คณะวิทยาศาสตร์และเทคโนโลยี'),
(22, '001', 'บริษัท อีสานเดฟ จำกัด'),
(23, '002', 'สำนักอธิการบดี มรม.'),
(27, NULL, 'คณะวิทยาการจัดการ');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id` int(11) NOT NULL,
  `person_id` int(5) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `card_id` varchar(13) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `name` varchar(200) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text,
  `mobile` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0=รอการอนุมัติ,1=ใช้งาน,2=ระงับการใช้งาน',
  `role_id` tinyint(4) DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `birthday` date NOT NULL COMMENT 'วันเกิด',
  `date_serve` date NOT NULL COMMENT 'วันที่เข้าทำการ,รับราชการ',
  `created` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id`, `person_id`, `picture`, `card_id`, `name`, `position`, `username`, `password`, `mobile`, `tel`, `depart_id`, `status`, `role_id`, `email`, `birthday`, `date_serve`, `created`) VALUES
(7, 0, '', '2330900098782', 'นครินทร์ ม่วงอ่อน', 'นักวิชาการคอมพิวเตอร์', 'demo1', 'HYMuUp6pkgGfCFk6net4GWtlfga4O2wF3+MX1jmqpTbSVitSNCdFgBBg2SQGifUMjcO6Sgk7VB81+b40Iblllg==', '0810989889', '66', 1, 1, 4, 'm.nakharin@gmail.com', '9999-00-00', '0000-00-00', '2016-11-11 22:33:11'),
(8, 21, '', '12309890984', 'นายวีระ จันทรา', '44', '44@gmail.com', 'v9UKC+8Hrt0c3Kli8S5RcDLVWVQwY/5M6clYZdYlaR52ynXZ6dEpqvTmhwpQWA55OoyDhDeeSQNcisjVNkJSdw==', '444', '44', 3, 1, 4, '44@gmail.com', '4444-00-00', '0000-00-00', '2016-11-13 16:35:11'),
(10, 0, '', '1234567654234', 'Computer', NULL, 'cc', 'ZK87jF7t0j8PiUumHEqn+E+BNuEljf9VtwqZua5hMkNvKEK6NOfbD46z+l8JOl9MCkcKWwKNymAFqRHYbbDE8Q==', NULL, NULL, 3, 1, 4, 'cc@gmail.com', '0000-00-00', '0000-00-00', '2016-11-14 09:10:11'),
(11, 19, '', '222', 'xxxx', '22', '22', '6Ey9EDY4u6jrvV3aPj1O9y9XjITV/GS47blowXsAFkO1QKkwIccEI4xPQe27pkmoWl0R+spHcbFU0tjCmCIXzQ==', '22', '22', 2, 1, 4, '22@gmail.com', '0000-00-00', '0000-00-00', '2016-11-14 09:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbyear`
--

CREATE TABLE `tbyear` (
  `id` int(5) NOT NULL,
  `name` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbyear`
--

INSERT INTO `tbyear` (`id`, `name`) VALUES
(1, '2556'),
(2, '2557'),
(3, '2558'),
(4, '2559');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbconfig`
--
ALTER TABLE `tbconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbdepart`
--
ALTER TABLE `tbdepart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbleavemanage`
--
ALTER TABLE `tbleavemanage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbleave_type`
--
ALTER TABLE `tbleave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbperson`
--
ALTER TABLE `tbperson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbrole`
--
ALTER TABLE `tbrole`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbsessions`
--
ALTER TABLE `tbsessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `tbteam`
--
ALTER TABLE `tbteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbyear`
--
ALTER TABLE `tbyear`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbconfig`
--
ALTER TABLE `tbconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbdepart`
--
ALTER TABLE `tbdepart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbleavemanage`
--
ALTER TABLE `tbleavemanage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `tbleave_type`
--
ALTER TABLE `tbleave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbperson`
--
ALTER TABLE `tbperson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbrole`
--
ALTER TABLE `tbrole`
  MODIFY `role_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbteam`
--
ALTER TABLE `tbteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbyear`
--
ALTER TABLE `tbyear`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
