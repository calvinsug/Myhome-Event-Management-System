-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2015 at 11:14 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `BranchID` char(7) NOT NULL,
  `BranchLongitude` float NOT NULL,
  `BranchLatitude` float NOT NULL,
  `BranchAddress` varchar(100) NOT NULL,
  `Region` varchar(20) NOT NULL,
  `StaffID` char(7) NOT NULL,
  PRIMARY KEY (`BranchID`,`StaffID`),
  KEY `StaffID` (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchID`, `BranchLongitude`, `BranchLatitude`, `BranchAddress`, `Region`, `StaffID`) VALUES
('BRA0001', 0, 0, 'qweqeqqwe', 'publicfacilities', 'STA0001'),
('BRA0002', 100, 150, 'Jl. Jalan-jalan', 'office', 'STA0001'),
('BRA0003', 106.784, -6.1964, 'Rawa Belong, Kota Jakarta Barat, DKI Jakarta, Indonesia', 'school', 'STA0001'),
('BRA0004', 106.804, -6.1764, '15 Jalan Rawa Pandan, Kota Jakarta Barat, DKI Jakarta', 'home', 'STA0002'),
('BRA0005', 106.749, -6.17436, 'Jalan Puri Kembangan, Kota Jakarta Barat, DKI Jakarta, Indonesia', 'home', 'STA0003');

-- --------------------------------------------------------

--
-- Table structure for table `budgetevent`
--

CREATE TABLE IF NOT EXISTS `budgetevent` (
  `DivisionID` char(7) NOT NULL,
  `EventID` char(7) NOT NULL,
  `BudgetDescription` text NOT NULL,
  `BudgetExpected` float NOT NULL,
  `BudgetActual` float NOT NULL,
  PRIMARY KEY (`DivisionID`,`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detailmemberevent`
--

CREATE TABLE IF NOT EXISTS `detailmemberevent` (
  `EventID` char(7) NOT NULL,
  `DivisionID` char(7) NOT NULL,
  `MemberID` char(7) NOT NULL,
  PRIMARY KEY (`EventID`,`DivisionID`,`MemberID`),
  KEY `EventID` (`EventID`),
  KEY `DivisionID` (`DivisionID`),
  KEY `MemberID` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE IF NOT EXISTS `division` (
  `DivisionID` char(7) NOT NULL,
  `DivisionName` varchar(20) NOT NULL,
  PRIMARY KEY (`DivisionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`DivisionID`, `DivisionName`) VALUES
('DIV0001', 'transportasi'),
('DIV0002', 'konsumsi');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `EventID` char(7) NOT NULL,
  `EventTitle` varchar(50) NOT NULL,
  `EventType` varchar(20) NOT NULL,
  `EventDesc` text NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `PaymentType` varchar(20) NOT NULL,
  `RegistrationFee` float DEFAULT NULL,
  `EventPhoto` varchar(100) NOT NULL,
  `Capacity` int(11) NOT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventTitle`, `EventType`, `EventDesc`, `StartDate`, `EndDate`, `PaymentType`, `RegistrationFee`, `EventPhoto`, `Capacity`) VALUES
('EVE0001', 'Excellence Seminar', 'Seminar', '<p>Seminar yang dapat membuat <strong><span style="text-decoration: underline;">anda:</span></strong></p><ol><li>SIAP menjadi Agen PERUBAHAN</li><li>Membangun Fighting SPirit</li><li>Meningkatkan KINERJAdan PRODUKTIVITAS</li><li>lebih FOkus dan kreatif</li></ol>', '2015-01-21', '2015-01-23', 'paid', 450000, 'photon registration.JPG', 450),
('EVE0002', 'Dota 2 Championship', 'Tournament ', '<p>yg menang Imba&nbsp;</p>', '2015-01-20', '2015-01-24', 'paid', 200000, 'download.jpg', 64),
('EVE0003', 'Event 3', 'type 3', '<p>testing</p>', '2015-01-21', '2015-01-21', 'free', 0, '', 200);

-- --------------------------------------------------------

--
-- Table structure for table `galleryevent`
--

CREATE TABLE IF NOT EXISTS `galleryevent` (
  `GalleryID` char(7) NOT NULL,
  `Source` text NOT NULL,
  `Type` varchar(20) NOT NULL,
  `EventID` char(7) NOT NULL,
  PRIMARY KEY (`GalleryID`,`EventID`),
  KEY `EventID` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `LocationID` char(7) NOT NULL,
  `LocationName` varchar(50) NOT NULL,
  `LocationAddress` varchar(100) NOT NULL,
  `LocationLongitude` float NOT NULL,
  `LocationLatitude` float NOT NULL,
  PRIMARY KEY (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `LocationName`, `LocationAddress`, `LocationLongitude`, `LocationLatitude`) VALUES
('LOC0001', 'kemanggisan', 'Rawa Belong, Kota Jakarta Barat, DKI Jakarta, Indonesia', -6.1964, 106.784),
('LOC0002', 'rumah Andreas', 'Rawa Kepa 4, Tomang, DKI Jakarta, Indonesia', -6.17114, 106.802);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `MemberID` char(7) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `MemberName` varchar(50) NOT NULL,
  `MemberAddress` varchar(50) NOT NULL,
  `MemberEmail` varchar(50) NOT NULL,
  `MemberPhone` varchar(20) NOT NULL,
  `MemberPhoto` varchar(100) NOT NULL,
  `BranchID` char(7) NOT NULL,
  PRIMARY KEY (`MemberID`,`BranchID`),
  KEY `BranchID` (`BranchID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Username`, `Password`, `MemberName`, `MemberAddress`, `MemberEmail`, `MemberPhone`, `MemberPhoto`, `BranchID`) VALUES
('MEM0001', 'cal', '62911ad86d6181442022683afb480067', 'Calvin S', 'rawa pandan', 'calvinsug@gmail.com', '082260719300', 'calvin.jpg', 'BRA0001'),
('MEM0002', 'calvin', 'e6e66b8981c1030d5650da159e79539a', 'calvin sugianto', 'Jl. Jalan-jalan', 'calvinsug@gmail.com', '018313131', 'WIN_20141201_163130.JPG', 'BRA0002'),
('MEM0003', 'ram', '4641999a7679fcaef2df0e26d11e3c72', 'rama aditya', 'qweqeqqwe', 'ram@dit.com', '1323231', 'rama.jpg', 'BRA0001');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `NewsID` char(7) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `CreateDate` datetime NOT NULL,
  `Photo` varchar(100) NOT NULL,
  `StaffID` char(7) NOT NULL,
  PRIMARY KEY (`NewsID`,`StaffID`),
  KEY `StaffID` (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `Title`, `Description`, `CreateDate`, `Photo`, `StaffID`) VALUES
('NEW0001', 'title 1', '<p style="text-align: center;">Testinggggg<span style="text-decoration: underline;">eqeqeqeqeq<em>qeqeqeqadadada</em></span></p>', '2015-01-02 08:30:28', 'dosen.JPG', 'STA0001'),
('NEW0002', 'testing 2', '<p style="text-align: right;">qwjqwojqwiojqjwewqeqeqeqeqeqeq</p><p style="text-align: center;">qeqqeqeqeqeqeqeqe</p>', '2015-01-02 08:44:40', 'progress JJA.jpg', 'STA0001'),
('NEW0003', 'news 3', '<p style="text-align: center;"><strong>desc 3</strong></p><p style="text-align: center;"><strong>desc&nbsp;</strong></p>', '2015-01-11 14:48:52', 'photon registration.JPG', 'STA0001');

-- --------------------------------------------------------

--
-- Table structure for table `phonemember`
--

CREATE TABLE IF NOT EXISTS `phonemember` (
  `MemberPhoneID` char(7) NOT NULL,
  `PhoneNumber` char(7) NOT NULL,
  `MemberID` varchar(20) NOT NULL,
  PRIMARY KEY (`MemberPhoneID`,`MemberID`),
  KEY `MemberID` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `phonestaff`
--

CREATE TABLE IF NOT EXISTS `phonestaff` (
  `StaffPhoneID` char(7) NOT NULL,
  `StaffID` char(7) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  PRIMARY KEY (`StaffPhoneID`,`StaffID`),
  KEY `StaffID` (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prayerrequest`
--

CREATE TABLE IF NOT EXISTS `prayerrequest` (
  `RequestID` char(7) NOT NULL,
  `SendDate` datetime NOT NULL,
  `PrayerDesc` text NOT NULL,
  `Status` varchar(20) NOT NULL,
  `AcceptDate` datetime DEFAULT NULL,
  `MemberID` char(7) NOT NULL,
  PRIMARY KEY (`RequestID`,`MemberID`),
  KEY `MemberID` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prayerrequest`
--

INSERT INTO `prayerrequest` (`RequestID`, `SendDate`, `PrayerDesc`, `Status`, `AcceptDate`, `MemberID`) VALUES
('REQ0001', '2015-01-05 00:00:00', 'biar sukses titip absen matkul Kapsel', 'done', '2015-01-02 00:00:00', 'MEM0002'),
('REQ0002', '2015-02-17 00:00:00', 'biar sukses Sidangnya', 'pending', '2015-01-02 00:00:00', 'MEM0001'),
('REQ0003', '2015-01-09 00:00:00', 'testing', 'pending', '2015-01-09 00:00:00', 'MEM0001');

-- --------------------------------------------------------

--
-- Table structure for table `registrationevent`
--

CREATE TABLE IF NOT EXISTS `registrationevent` (
  `EventID` char(7) NOT NULL,
  `MemberID` char(7) NOT NULL,
  `ParticipantID` varchar(20) NOT NULL,
  `PaymentStatus` varchar(20) DEFAULT NULL,
  `BankAccountFrom` varchar(50) DEFAULT NULL,
  `BankAccountTo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`EventID`,`MemberID`),
  KEY `MemberID` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rundownevent`
--

CREATE TABLE IF NOT EXISTS `rundownevent` (
  `EventID` char(7) NOT NULL,
  `LocationID` char(7) NOT NULL,
  `DayRunDown` varchar(20) NOT NULL,
  `StartTime` varchar(20) NOT NULL,
  `EndTime` varchar(20) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `RundownID` int(11) NOT NULL,
  PRIMARY KEY (`EventID`,`LocationID`,`RundownID`),
  KEY `EventID` (`EventID`),
  KEY `LocationID` (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `StaffID` char(7) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `StaffName` varchar(50) NOT NULL,
  `StaffRole` varchar(20) NOT NULL,
  `StaffAddress` varchar(50) NOT NULL,
  `StaffEmail` varchar(50) NOT NULL,
  `StaffPhone` varchar(20) NOT NULL,
  `StaffPhoto` varchar(100) NOT NULL,
  `StaffSalary` float NOT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Username`, `Password`, `StaffName`, `StaffRole`, `StaffAddress`, `StaffEmail`, `StaffPhone`, `StaffPhoto`, `StaffSalary`) VALUES
('STA0001', 'dummy', '275876e34cf609db118f3d84b799a790', 'dummy Name', 'admin', 'rarwrarwrwr', 'qjrqjqojrq', '031312312312', 'photo.jpg', 200000),
('STA0002', 'calvin', 'e6e66b8981c1030d5650da159e79539a', 'Calvin Sugianto', 'Admin', 'Jl.Rawa Rawa', 'calvinsug@myhome.com', '081231231', 'calvinganteng.jpg', 1e17),
('STA0003', 'rama', '486b6c6b267bc61677367eb6b6458764', 'Rama Aditya', 'admin', 'Puri', 'rama@rama.com', '131313131', 'rama.jpg', 131131000);

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE IF NOT EXISTS `testimony` (
  `TestimonyID` char(7) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Status` varchar(20) NOT NULL,
  `MemberID` char(7) NOT NULL,
  PRIMARY KEY (`TestimonyID`,`MemberID`),
  KEY `MemberID` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `budgetevent`
--
ALTER TABLE `budgetevent`
  ADD CONSTRAINT `budgetevent_ibfk_1` FOREIGN KEY (`DivisionID`) REFERENCES `division` (`DivisionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailmemberevent`
--
ALTER TABLE `detailmemberevent`
  ADD CONSTRAINT `detailmemberevent_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailmemberevent_ibfk_2` FOREIGN KEY (`DivisionID`) REFERENCES `division` (`DivisionID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
