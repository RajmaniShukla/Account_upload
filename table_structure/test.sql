-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 05:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_param`
--

CREATE TABLE `m_param` (
  `typ` varchar(20) NOT NULL,
  `cd` varchar(20) NOT NULL,
  `shde` varchar(30) NOT NULL,
  `des` varchar(50) NOT NULL,
  `stat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `m_param`
--

INSERT INTO `m_param` (`typ`, `cd`, `shde`, `des`, `stat`) VALUES
('ANX-E', 'MRL-Dispute', 'MRL-Dispute', 'MRL-Dispute', '0\r'),
('ANX-E', 'MRL-Statutory', 'MRL-Statutory Dues', 'MRL-Statutory Dues', '0\r'),
('ANX-E', 'MRL-Benami', 'MRL-Benami', 'MRL-Benami', '0\r'),
('ANX-E', 'Phy-Veri-Asset', 'Physical Vefi- FAR', 'Physical Vefi- FAR', '0\r'),
('ANX-E', 'Phy-Veri-Inv', 'Physical Vefi- INV', 'Physical Vefi- INV', '0\r'),
('ANX-C', 'FD', 'Fixed Deposit', 'Fixed Deposit', '0\r'),
('ANX-C', 'Bank-Balance', 'Bank-Balance', 'Bank-Balance', '0\r'),
('ftyp', 'FAR-FIN', 'Fixed Asset register', 'Fixed Asset register', '0\r'),
('ftyp', 'FAR-IT', 'FAR FOR TAX AUDIT', 'FAR FOR TAX AUDIT', '0\r'),
('ftyp', 'ANX-A', 'Annex A Document', 'Annex A Document', '0\r'),
('ftyp', 'ANX-B', 'Annex B Schedule III', 'Annex B Schedule III', '0\r'),
('ftyp', 'ANX-D', 'Annex D CARO', 'Annex D CARO', '0\r'),
('ftyp', 'ANX-F', 'Annex F Ext. Cnfrmtn', 'Annex F Ext. Cnfrmtn', '0\r'),
('ftyp', 'ANX-G', 'Annex G CWIP Reg', 'Annex G CWIP Reg', '0\r'),
('ftyp', 'CR-AGE', 'Creditor Ageing', 'Creditor Ageing', '0\r'),
('ftyp', 'DEB-AGE', 'Debtor Ageing', 'Debtor Ageing', '0\r'),
('ftyp', 'TAX-AUDIT', 'Tax Audit Data', 'Tax Audit Data', '0\r'),
('ftyp', 'INTER-RECO', 'Inter Fy Reco', 'Inter Fy Reco', '0\r'),
('ftyp', 'P-L', 'Profit&amp;Loss', 'Profit&amp;Loss', '0\r'),
('ftyp', 'T-B', 'Trial Balance', 'Trial Balance', '0\r'),
('ftyp', 'INV-BOOK', 'Inventory Book', 'Inventory Book', '0\r'),
('ftyp', 'ANX-C', 'Annex C Bank Reco', 'Annex C Bank Reco', '1\r'),
('ftyp', 'ANX-E', 'Annex E Docs CARO', 'Annex E Docs CARO', '1\r'),
('ftyp', 'MON-RECO', 'Monthly Reco sheets', 'Monthly Reco sheets', '1\r'),
('IT-TCS', '206CE', '206CE-SCRAP SALE', '206CE-SCRAP SALE', '0\r'),
('IT-TCS', '206CIH', '206CIH-Customer', '206CIH-Customer', '0\r'),
('IT-TDS', '192B', '192B-Salary', '192B-Salary', '0\r'),
('IT-TDS', '194C', '194C-Contractor', '194C-Contractor', '0\r'),
('IT-TDS', '194J', '194J-Professional', '194J-Professional', '0\r'),
('IT-TDS', '194H', '194H-MSTC', '194H-MSTC', '0\r'),
('IT-TDS', '194Q', '194Q-Supplier', '194Q-Supplier', '0\r'),
('IT-TDS', '194A', '194A-Arbitration Int', '194A-Arbitration Int', '0\r'),
('IT-TDS', '194I', '194I-Rent', '194I-Rent', '0\r'),
('MON-RECO', 'CGEGIS', 'CGEGIS', 'CGEGIS', '0\r'),
('MON-RECO', 'GPF', 'GPF', 'GPF', '0\r'),
('MON-RECO', 'GST', 'GST', 'GST', '0\r'),
('MON-RECO', 'NPS', 'NPS', 'NPS', '0\r'),
('MON-RECO', 'P-TAX', 'P-TAX', 'P-TAX', '0\r'),
('MON-RECO', 'TDS-GST', 'TDS-GST', 'TDS-GST', '0\r'),
('MON-RECO', 'P-TAX', 'PROFESSIONAL-TAX', 'PROFESSIONAL-TAX', '0\r'),
('MON-RECO', 'IT-TDS', 'IT-TDS', 'IT-TDS', '1\r'),
('MON-RECO', 'IT-TCS', 'IT-TCS', 'IT-TCS', '1');

-- --------------------------------------------------------

--
-- Table structure for table `m_upload`
--

CREATE TABLE `m_upload` (
  `id` int(11) NOT NULL,
  `fin_yr` varchar(10) NOT NULL,
  `mnth` varchar(10) NOT NULL,
  `typ` varchar(20) NOT NULL,
  `cd` varchar(50) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `org_f_name` varchar(100) NOT NULL,
  `stat_cd` varchar(1) NOT NULL,
  `upload_user` varchar(10) NOT NULL,
  `upload_dt_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_per` varchar(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `user_unit` varchar(10) NOT NULL,
  `user_passwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_per`, `user_name`, `user_role`, `user_unit`, `user_passwd`) VALUES
('914175', 'SHIVAM_RAI', 'DBA', 'OFPKR', '38e69f2c125d0b58ed4f441d1af28cd3'),
('944036', 'BHUPENDRA KUMAR SINGH', 'ADMIN', 'OFPKR', 'e8b95ec01cd23a6baa6aa3eb2f915c26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
