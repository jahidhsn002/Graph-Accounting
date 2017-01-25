-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 08:20 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anexbd_gp02`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ac` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `ac`) VALUES
(3, 'Anex Petty Cash', 'Cash In Hand'),
(4, 'Anex Electric & Engineering Company', 'Brac Bank');

-- --------------------------------------------------------

--
-- Table structure for table `assetaccounts`
--

CREATE TABLE `assetaccounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assetaccounts`
--

INSERT INTO `assetaccounts` (`id`, `name`) VALUES
(1, 'Computer'),
(2, 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `assetaccount_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `assetaccount_id`, `date`, `type`, `note`, `amount`) VALUES
(2, '1', '2017/01/04', 'Debit', 'Purchase Computer For Office', 30000.00),
(3, '2', '2017/01/04', 'Debit', 'Purchase Furniture for office', 20000.00),
(4, '1', '2016/12/27', 'Debit', 'n/a', 4500.00);

-- --------------------------------------------------------

--
-- Table structure for table `capitals`
--

CREATE TABLE `capitals` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chalans`
--

CREATE TABLE `chalans` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `traking` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_cost` double(13,2) NOT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perchase_date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `perchase_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `perchase_id` int(11) DEFAULT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `estimate_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `invoice_id`, `perchase_id`, `offer_id`, `sale_id`, `service_id`, `estimate_id`, `description`, `value`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, 'Dis', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `company`, `billing`, `shipping`, `phone`) VALUES
(4, 'Palmal Group of Industries', '', 'Confidence Center, Shajadpur,\nDhaka', 'Confidence Center, Shajadpur,\nDhaka', ''),
(5, 'M&J Group (Colombia Garments Ltd.)', '', '13th Floor Red Cresent concord Tower, 17\nMohakhali, C/A,\nDhaka- 1212.', '13th Floor Red Cresent concord Tower, 17\nMohakhali, C/A,\nDhaka- 1212.', ''),
(6, 'Epic Garments Manufacturing Company Ltd.', '', 'Plot No: 11-12, 26-34,\n Adamjee EPZ,\n Adamjee,Narayanganj.', '', ''),
(7, 'M. A. Power', '', 'Nawabpur,\nDhaka.', '', ''),
(8, 'Youngone Hi-Tech Sportswear Ind. Ltd.', '', 'Dkaha Export Processing Zone (DEPZ),\nSavar, Dhaka', '', ''),
(9, 'Partex Rotor Spinning Mills Ltd.', '', 'Dhaka-1213.\nChallan No #:\nHouse#2, Road No 9, Block-G, Banani', '', ''),
(10, 'Nothern Fashion Ltd', '', 'Factory: Plot # 16-18, Dakhin Panishail,\nEPZ-Kaliakoir Road, Kashimpur\nGazipur.', '', ''),
(11, 'M. M. Fashoin', '', 'Board Bazar,\nGazipur.', '', ''),
(12, 'Safa Electric', '', 'Ibrahim Electric Market 124,\n BCC Road, Shop # 2\nNawabpur,\nDhaka-1100.', '', ''),
(13, 'Super Protective Shoes (Pvt.) Ltd', '', 'Plot#167-171, Adamjee EPZ, \nSiddirgong,Narayangonj,\nDhaka.\n', '', ''),
(14, 'Navana Real Estate Ltd', '', 'House # 35, Road # 9/A(New),\n Dhanmondi R/A,\nDhaka.', '', ''),
(15, 'Healthcare Pharmaceuticals Ltd.', '', 'Nasir Trade Centre (Level-9 & 14), \n89 Bir Uttam C.R, Datta Sarak,\nDhaka-1205.', '', ''),
(16, 'Givensee Group Of Industries Ltd.', '', 'House # 06, Road # 13, Sector # 3, Uttara\nModel Town,\nDhaka.', '', ''),
(17, 'Bismillah Electric', '', 'City Market, Nawabpur\nDhaka.', '', ''),
(18, 'Asian Powertec Co. Ltd.', '', 'Roots Inizio Hosneara, \nHouse No# 149 (4th Floor-A4),\n Ranavola Avenue,Sector-10,\n Uttara Model Town,Dhaka-1230.', '', ''),
(19, 'ACI Ltd.', '', 'ACI Centre, 245, Tejgaon, Industrial Area\nDhaka-1208.', '', ''),
(20, 'Anex Engineering & Electric Company', '', 'Block#G, PC Road, Halishar\nChittagong-4100', '', ''),
(21, 'Jean''s Plus Ltd', '', 'Sreepur Bus Stand,\n Ganak Bari, Savar,\nDhaka.', '', ''),
(22, 'Snowtex Outware Ltd.', '', 'Dhulivita, Dhamrai,\nDhaka.', '', ''),
(23, 'Union Accessories Ltd.', '', 'Pukurpar, Zirabo, Asulia, Savar,\nDhaka.', '', ''),
(24, 'Beacon Pharmaceutical Ltd.', '', 'Orion House, 153-154, Tejgaon Industrial Area,\nDhaka-1208.', '', ''),
(25, 'Taxmate Engineering', '', 'House No. 1/6-B (G.F), \nTolarbagh, Mirpur-1,\nDhaka-1216.', '', ''),
(26, 'Bata Shoe Company Bangladesh Ltd.', '', 'Dhamrai,Dhaka.', '', ''),
(27, 'Anwar Landmark Ltd.', '', 'Baitul Hossain Building, (13th Floor),\n 27 Dilkusha C/A,\nDhaka.', '', ''),
(28, 'S.F. Washing Ltd.', '', '225, Tejgaon I/A, 2nd Floor,\nDhaka-1208.', '', ''),
(29, 'Louietex Manufacturing Ltd.', '', 'Shorifpur, Malekerbari,\n National University\nGazipur.', '', ''),
(30, 'Falcon International Knit Composite', '', 'Plot No. 2/1, Road No. 7, Block-A, Nobodoy,\nHousing Society, Mohammadpur,\nDhaka-1207.', '', ''),
(31, 'Anwara Mannan Textile Mills Ltd', '', '2 No. Ishaka Avenue, Sector#6, Uttara,\nDhaka-1230.', '', ''),
(32, 'Ayesha Clothing Co. Ltd', '', 'Confidence Center, \n9/Kha Shajadpur, \nGulshan,Dhaka.', '', ''),
(33, 'Norp Knit Industries Ltd, Unit-2', '', '93 Islampur, Kodda Nandun,\nGazipur.', '', ''),
(34, 'Matrix Sweater', '', 'Gazipur,\nDhaka', '', ''),
(35, 'Dhaka Shanghai Ceramics Ltd.', '', 'Karwan Bazar\nDhaka-1215.', '', ''),
(36, 'Karim Textiles Ltd', '', 'Richmond Concord (5th & 6th Floor),\n68, Gulshan Avenue, Gulshan-1,\nDhaka-1212.', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbwages`
--

CREATE TABLE `dbwages` (
  `id` int(10) UNSIGNED NOT NULL,
  `wage_id` int(11) DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `basic` double(13,2) NOT NULL,
  `absent` int(11) NOT NULL,
  `late` int(11) NOT NULL,
  `charge` double(13,2) NOT NULL,
  `tada` double(13,2) NOT NULL,
  `bonus` double(13,2) NOT NULL,
  `advance` double(13,2) NOT NULL,
  `paid` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drawings`
--

CREATE TABLE `drawings` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `joining` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary` double(13,2) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`id`, `name`, `empid`, `joining`, `designation`, `salary`, `phone`, `address`, `note`) VALUES
(1, 'Sk.Md.Islam Shipu', '01', '01/01/2017', ' Accounts & Admin ', 16000.00, 'N/A', 'N/A', ''),
(2, 'Md.Mehadi Hasan Milton', '02', '16/10/2016', ' Accounts & Admin ', 20000.00, '01785566857', 'N/A', ''),
(3, 'Chandan Kumar Raha', '03', '01/01/2017', ' Sr. Officer (Marketing) ', 12000.00, '01750-030493	', 'N/A', ''),
(4, 'Engr. Kamal Hossen', '04', '01/01/2017', ' Sales Engineer ', 10000.00, '01799-618781	', 'N/A', ''),
(5, 'Engr.Borhanul Islam ', '05', '01/01/2017', ' Sales Engineer ', 12000.00, '01799-618783	', 'N/A', ''),
(6, 'Engr.Sohel Rana', '06', '01/01/2017', ' Sales Engineer ', 15000.00, '01750-030490	', 'N/A', ''),
(7, 'Engr.Swapan Biswas', '07', '01/01/2017', ' Sales Engineer ', 16000.00, '01799-618786	', 'N/A', ''),
(8, 'Engr.Md. Saidur Rahman', '08', '01/01/2017', ' Sales Engineer ', 7000.00, '01799-618789	', '', ''),
(9, 'Engr.Alamin Automation', '09', '01/01/2017', ' Automation Engr ', 18000.00, '01775-994254	', 'N/A', ''),
(10, 'Hedayet Sheikh', '10', '01/01/2017', ' Sales Asst. ', 11000.00, '01750-030452	', 'N/A', ''),
(11, 'Irin Akter', '11', '01/01/2017', ' Corporate Marketing ', 7000.00, '01799-618780	', 'N/A', ''),
(12, 'Shabnam Sharif', '12', '01/01/2017', ' Office Designer ', 8500.00, '01799-618787	', 'N/A', ''),
(13, 'Iqbal Hossain Sharif', '13', '01/01/2017', ' Purchase Asst. ', 6000.00, '01799-618791	', 'N/A', ''),
(14, 'Shaheen Sharif', '14', '01/01/2017', ' Office Designer ', 6000.00, 'N/A', 'N/A', ''),
(15, 'Imran Hossain', '15', '01/01/2017', ' Purchase Asst. ', 6500.00, '01799-618788	', 'N/A', ''),
(16, 'Md.Munnah', '16', '01/01/2017', ' Elictrical For Man ', 20000.00, '01750-030494	', 'N/A', ''),
(17, 'Md.Shaddam', '17', '01/01/2017', ' In-Charge ', 12000.00, '01740-283654	', 'N/A', ''),
(18, 'Alamin Talukdar', '18', '01/01/2017', ' Technician ', 12500.00, '01760-051003	', 'N/A', ''),
(19, 'Nazimuddin', '19', '01/01/2017', ' Technician ', 8000.00, '01790-305665	', 'N/A', ''),
(20, 'Rohisur', '20', '01/01/2017', ' Helper ', 6000.00, '01771-767901	', 'N/A', ''),
(21, 'Mossarof', '21', '01/01/2017', ' Technician ', 11000.00, 'N/A', 'N/A', ''),
(22, 'Nani gopal Barai', '22', '01/01/2017', ' Technician ', 6500.00, '01738-767478	', 'N/A', ''),
(23, 'Md.Ujjal', '23', '01/01/2017', ' Macanical Forman ', 17500.00, '01719-810246	', 'N/A', ''),
(24, 'Mehadi Hasan Shovon', '24', '01/01/2017', ' Technician ', 11000.00, 'N/A', 'N/A', '');

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estimate_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jobno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vat` double(13,2) NOT NULL,
  `reg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `milage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` double(13,2) NOT NULL,
  `total` double(13,2) NOT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estimate` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenseaccounts`
--

CREATE TABLE `expenseaccounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenseaccounts`
--

INSERT INTO `expenseaccounts` (`id`, `name`) VALUES
(1, 'Salary Allowance'),
(2, 'Wages'),
(3, 'Office Rent'),
(4, 'Factory Rent'),
(5, 'Telephone Bill'),
(6, 'Mobile Bill'),
(7, 'Conveyance'),
(8, 'Stationary purchase'),
(9, 'Entertainment'),
(10, 'Bonous'),
(11, 'Internet Bill'),
(12, 'Carriage Inward'),
(13, 'Carriage Outward'),
(14, 'Business Development Ex (Factory)'),
(15, 'Repair & Maintanance (Factory)'),
(16, 'Gift & Donation'),
(17, 'Repair and Maintenance Office'),
(18, 'Water Bill'),
(19, 'Indian Product Transport Cost'),
(20, 'Discount');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `expenseaccount_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expenseaccount_id`, `date`, `type`, `note`, `amount`) VALUES
(2, '1', '2017/01/04', 'Debit', 'N/A', 80000.00),
(3, '3', '2017/01/04', 'Debit', 'N/A', 15000.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `chalan_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `perchase_date` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perchase_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` double(13,2) NOT NULL,
  `traking` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` double(13,2) NOT NULL,
  `total` double(13,2) NOT NULL,
  `shipping_cost` double(13,2) NOT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `chalan_id`, `customer_id`, `user_id`, `perchase_date`, `perchase_no`, `date`, `vat`, `traking`, `subtotal`, `total`, `shipping_cost`, `comments`, `note`, `terms`) VALUES
(4, 0, 4, 1, '2017/01/17', '', '2017/01/17', 0.00, '', 1869.00, 1869.00, 0.00, '', '', ''),
(5, 0, 4, 0, '2017/01/17', '', '2017/01/17', 0.00, '', 890.00, 890.00, 0.00, '', '', ''),
(6, 0, 5, 0, '2017/01/25', '', '2017/01/25', 0.00, '', 370.00, 370.00, 0.00, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `chalan_id` int(10) UNSIGNED NOT NULL,
  `return_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL,
  `perchase_id` int(10) UNSIGNED NOT NULL,
  `brand` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `qty` double(13,2) NOT NULL,
  `buy` double(13,2) NOT NULL,
  `sell` double(13,2) NOT NULL,
  `unit` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` double(13,2) NOT NULL,
  `estimate_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `chalan_id`, `return_id`, `product_id`, `invoice_id`, `service_id`, `sale_id`, `offer_id`, `perchase_id`, `brand`, `description`, `qty`, `buy`, `sell`, `unit`, `discount`, `estimate_id`) VALUES
(8, 0, 0, 3, 0, 0, 0, 0, 2, 'Schneider Electric ', '2A, 10/15KA, SP, MCB', 5.00, 100.00, 0.00, 'Pcs', 0.00, 0),
(9, 0, 0, 3, 4, 0, 0, 0, 0, 'Schneider Electric ', '2A, 10/15KA, SP, MCB', 3.00, 0.00, 890.00, 'Pcs', 30.00, 0),
(10, 0, 0, 3, 5, 0, 0, 0, 0, 'Schneider Electric ', '2A, 10/15KA, SP, MCB', 1.00, 0.00, 890.00, 'Pcs', 0.00, 0),
(11, 0, 0, 5, 6, 0, 0, 0, 0, 'Schneider Electric', '10A, 10/15KA, SP, MCB', 1.00, 0.00, 370.00, 'Pcs', 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` double(13,2) NOT NULL,
  `estimate_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loanaccounts`
--

CREATE TABLE `loanaccounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `loanaccount_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_11_29_160329_create_sales_table', 1),
('2016_12_06_081437_Accounting', 1),
('2016_12_06_164958_Hrm', 1),
('2016_12_06_215306_Service', 1),
('2016_12_29_032710_Authentication', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `vat` double(13,2) NOT NULL,
  `traking` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` double(13,2) NOT NULL,
  `total` double(13,2) NOT NULL,
  `shipping_cost` double(13,2) NOT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `name`, `address`) VALUES
(1, 'Emdad Hossain(CEO)', '32,Sultan Ahamed Plaza,Purana Paltan,Dhaka'),
(2, 'M.A Jaman(D.G.M)', '32.Sultan Ahamed Plaza,Purana Paltan,Dhaka.');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL,
  `summery` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `account_id`, `date`, `type`, `amount`, `summery`) VALUES
(2, 1, '2017/01/04', 'Debit', 25000.00, 'Due Collection'),
(3, 1, '2017/01/04', 'Debit', 20250.00, 'Due Collection'),
(10, 1, '2017/01/04', 'Credit', 125000.00, 'Due Payment'),
(11, 2, '2017/01/04', 'Debit', 150000.00, 'Sales'),
(13, 1, '2017/01/04', 'Credit', 30000.00, 'Asset | Computer'),
(14, 1, '2017/01/04', 'Credit', 20000.00, 'Asset | Furniture'),
(18, 1, '2017/01/04', 'Credit', 80000.00, 'Expense | Salary Allowance'),
(19, 1, '2017/01/04', 'Credit', 15000.00, 'Expense | Office Rent'),
(20, 1, '2017/01/05', 'Debit', 50000.00, 'Due Collection'),
(22, 3, '2017/01/17', 'Debit', 1869.00, 'Due Collection'),
(23, 3, '2017/01/17', 'Credit', 500.00, 'Due Payment'),
(24, 3, '2016/12/27', 'Credit', 4500.00, 'Asset | Computer');

-- --------------------------------------------------------

--
-- Table structure for table `perchases`
--

CREATE TABLE `perchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tax` double(13,2) NOT NULL,
  `memo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `traking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` double(13,2) NOT NULL,
  `total` double(13,2) NOT NULL,
  `shipping_cost` double(13,2) NOT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perchases`
--

INSERT INTO `perchases` (`id`, `supplier_id`, `user_id`, `date`, `tax`, `memo`, `traking`, `subtotal`, `total`, `shipping_cost`, `comments`, `note`, `terms`) VALUES
(2, 2, 1, '2017/01/17', 0.00, '', NULL, 500.00, 500.00, 0.00, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `iban` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buy` double(13,2) NOT NULL,
  `sell` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `iban`, `stock_id`, `description`, `brand`, `unit`, `buy`, `sell`) VALUES
(3, 'C60H (24971)', 3, '2A, 10/15KA, SP, MCB', 'Schneider Electric ', 'Pcs', 100.00, 890.00),
(4, 'C60H (24972)', 4, '6A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 370.00),
(5, 'C60H (24973)', 5, '10A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 370.00),
(6, 'C60H (24974)', 6, '16A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 370.00),
(7, 'C60H (24975)', 7, '20A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 370.00),
(8, 'C60H (24976)', 8, '25A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 370.00),
(9, 'C60H (24977)', 9, '32A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 370.00),
(10, 'C60H (2478)', 10, '40A, 10/15KA,SP,  MCB', 'Schneider Electric', 'Pcs', 0.00, 890.00),
(11, 'C60H (24979)', 11, '50A, 10/15KA, SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 890.00),
(12, 'C60H (24980)', 12, '63A,10/15KA,SP, MCB', 'Schneider Electric', 'Pcs', 0.00, 890.00),
(13, 'C60H (24985)', 13, '6A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1000.00),
(14, 'C60H (24986)', 14, '10A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1000.00),
(15, 'C60H (24987)', 15, '16A, 10/15KA,DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1000.00),
(16, 'C60H (24988)', 16, '20A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1000.00),
(17, 'C60H (24989)', 17, '25A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1000.00),
(18, 'C60H (24990)', 18, '32A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1000.00),
(19, 'C60H (24991)', 19, '40A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 2000.00),
(20, 'C60H (24992)', 20, '50A, 10/15KA, DP, MCB', 'Schneider Electric ', 'Pcs', 0.00, 2000.00),
(21, 'C60H (24993)', 21, '63A, 10/15KA, DP, MCB', 'Schneider Electric', 'Pcs', 0.00, 2000.00),
(22, 'C60H (24998)', 22, '6A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1780.00),
(23, 'C60H (24999)', 23, '10A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1780.00),
(24, 'C60H (25000)', 24, '16A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1780.00),
(25, 'C60H (25001)', 25, '20A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1780.00),
(26, 'C60H (25002)', 26, '25A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1780.00),
(27, 'C60H (25003)', 27, '32A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 1780.00),
(28, 'C60H (25004) ', 28, '40A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 2110.00),
(29, 'C60H (25005)', 29, '50A, 10/15KA, TP, MCB', 'Schneider Electric', 'Pcs', 0.00, 2110.00),
(30, 'C60H (25006)', 30, '63A, 10/15KA, TP,  MCB', 'Schneider Electric', 'Pcs', 0.00, 2110.00),
(31, 'C60H (25011)', 31, '6A, 10/15KA, 4P, MCB ', 'Schneider Electric', 'Pcs', 0.00, 2487.00),
(32, 'C60H (25012)', 32, '10A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2487.00),
(33, 'C60H (25013)', 33, '16A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2487.00),
(34, 'C60H (25014)', 34, '20A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2487.00),
(35, 'C60h (25015)', 35, '25A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2487.00),
(36, 'C60H (25016)', 36, '32A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2487.00),
(37, 'C60H (20517)', 37, '40A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2894.00),
(38, 'C60H (25018)', 38, '50A, 10/15KA, 4P, MCB', 'Schneider Electric', 'Pcs', 0.00, 2894.00),
(39, 'C60H (25019)', 39, '63A, 10/15KA, 4P, MCB ', 'Schneider Electric', 'Pcs', 0.00, 2894.00),
(41, '', 41, '15A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(42, '', 42, '20A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(43, '', 43, '25A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(44, '', 44, '30A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(45, '', 45, ' 40A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(46, '', 46, '50A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(47, '', 47, '60A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(48, '', 48, '75A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(49, '', 49, '80A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(50, '', 50, '100A, TP, 15KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 5490.00),
(51, '', 51, '125A, TP, 25KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 8480.00),
(52, '', 52, '150A, TP, 25KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9480.00),
(53, '', 53, '160A, TP, 25KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9480.00),
(54, '', 54, '175A, TP, 25KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 12470.00),
(55, '', 55, '200A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 12470.00),
(56, '', 56, '225A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 12470.00),
(57, '', 57, '250A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 12470.00),
(58, '', 58, '300A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 26170.00),
(59, '', 59, '320A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 26170.00),
(60, '', 60, '350A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 26170.00),
(61, '', 61, '400A, TP, 36KA, MCCB (Fixed type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 26170.00),
(62, '', 62, '16A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9700.00),
(63, '', 63, '25A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9700.00),
(64, '', 64, '32A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9700.00),
(65, '', 65, '40A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9700.00),
(66, '', 66, '50A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9700.00),
(67, '', 67, '63A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 9700.00),
(68, '', 68, '80A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 10700.00),
(69, '', 69, '100A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 10700.00),
(70, '', 70, '125A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 19400.00),
(71, '', 71, '160A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 19400.00),
(72, '', 72, '200A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 28600.00),
(73, '', 73, '250A, TP, 36KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 28600.00),
(74, '', 74, '400A, TP, 50KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 48200.00),
(75, '', 75, '630A, TP, 50KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 63300.00),
(76, '', 76, '800A, TP, 50KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 98900.00),
(77, '', 77, '1000A, TP, 50KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 113000.00),
(78, '', 78, '1250A, TP, 50KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 116500.00),
(79, '', 79, '1600A, TP, 50KA, MCCB (Adjustable type Trip Unit)', 'Schneider Electric', 'Pcs', 0.00, 123600.00),
(80, 'NW10H13F2', 80, '1000A, TP, 42KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 226100.00),
(81, 'NW12H13F2', 81, '1250A, TP, 42KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 242200.00),
(82, 'NW16H13F2', 82, '1600A, TP, 65KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 285600.00),
(83, 'NW20H13F2', 83, '2000A, TP, 65KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 300200.00),
(84, 'NW25H13F2', 84, '2500A, TP, 65KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 324100.00),
(85, 'NW32H13F2', 85, '3200A, TP, 65KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 395700.00),
(86, 'NW40H13F2', 86, '4000A, TP, 65KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 640400.00),
(87, 'NW50H13F2', 87, '5000A, TP, 100KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 1026900.00),
(88, 'NW63H13F2', 88, '6300A, TP, 100KA, Air Circuit Breaker (Fixed Chessis)', 'Schneider Electric', 'Pcs', 0.00, 1679900.00),
(89, 'GV2 ME 04', 89, '0.4-0.63A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 4540.00),
(90, 'GV2 ME 05', 90, '0.63-1A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 4540.00),
(91, 'GV2 ME 06', 91, '1.0-1.6A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 4540.00),
(92, 'GV2 ME 07', 92, '1.6-2.5A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 4540.00),
(93, 'GV2 ME 08', 93, '2.5-4A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 4540.00),
(94, 'GV2 ME 10', 94, '4-6.3A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 4540.00),
(95, 'GV2 ME 14', 95, '6-10A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 5410.00),
(96, 'GV2 ME 16', 96, '9-14A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 5410.00),
(97, 'GV2 ME 20', 97, '13-18A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 5410.00),
(98, 'GV2 ME 21', 98, '17-23A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 5410.00),
(99, 'GV2 ME 22', 99, '20-25A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 5410.00),
(100, 'GV2 ME 32', 100, '24-32A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 5410.00),
(101, 'GV3 P 32', 101, '23…32A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 18680.00),
(102, 'GV3 P 40', 102, '30…40A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 18680.00),
(103, 'GV3 P 50', 103, '37…50A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 18680.00),
(104, 'GV3 P 65', 104, '48…65A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 18680.00),
(105, 'GV3 ME 80', 105, '56…80A, TP, Motor Protection Circuit Breaker (MPCB)', 'Schneider Electric', 'Pcs', 0.00, 18680.00),
(106, 'GVAE 11', 106, '1NO+1NC, Auxiliary Contact Block', 'Schneider Electric', 'Pcs', 0.00, 980.00),
(107, 'LC1D09•7', 107, '9A (AC3), TP, Ith 25A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 1670.00),
(108, 'LC1D12•7', 108, '12A (AC3), TP, Ith 25A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 1990.00),
(109, 'LC1D18•7', 109, '18A (AC3), TP, Ith 32A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 2550.00),
(110, 'LC1D25•7', 110, '25A (AC3), TP, Ith 40A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 2780.00),
(111, 'LC1D32•7', 111, '32A (AC3), TP, Ith 50A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 5930.00),
(112, 'LC1D38•7', 112, '38A (AC3), TP, Ith 50A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 8870.00),
(113, 'LC1D40•7', 113, '40A (AC3), TP, Ith 60A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 10410.00),
(114, 'LC1D50•7', 114, '50A (AC3), TP, Ith 80A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 10870.00),
(115, 'LC1D65•7', 115, '65A (AC3), TP, Ith 80A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 14560.00),
(116, 'LC1D80•7', 116, '80A (AC3), TP, Ith 125A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 18200.00),
(117, 'LC1D95•7', 117, '95A (AC3), TP, Ith 125A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 21250.00),
(118, 'LC1D115•7', 118, '115A (AC3), TP, Ith 200A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 27070.00),
(119, 'LC1D150•7', 119, '150A (AC3), TP, Ith 200A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 34290.00),
(121, 'LC1F150•7', 121, '150A (AC3), TP, Ith 250A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 42870.00),
(122, 'LC1F185•7', 122, '185A (AC3), TP, Ith 275A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 46390.00),
(123, 'LC1F225•7', 123, '225A (AC3), TP, Ith 315 (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 57750.00),
(124, 'LC1F265•7', 124, '265A (AC3), TP, Ith 350A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 65080.00),
(125, 'LC1F330•7', 125, '330A (AC3), TP, Ith 400A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 76960.00),
(126, 'LC1F400•7', 126, '400A (AC3), TP, Ith 500A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 94070.00),
(127, 'LC1F500•7', 127, '500A (AC3), TP, Ith 700A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 115440.00),
(128, 'LC1F630•7', 128, '630A (AC3), TP, Ith 1000A (AC1), Magnetic Contactor, coil:220/415/110/V AC', 'Schneider Electric', 'Pcs', 0.00, 147510.00),
(131, 'LADN10', 131, 'Auxiliary Contact Block (1NO)', 'Schneider Electric', 'Pcs', 0.00, 696.00),
(132, 'LADN01', 132, 'Auxiliary Contact Block (1NC)', 'Schneider Electric', 'Pcs', 0.00, 696.00),
(133, 'LADN11', 133, 'Auxiliary Contact Block (1NO+1NC)', 'Schneider Electric', 'Pcs', 0.00, 783.00),
(134, 'LADN20', 134, 'Auxiliary Contact Block (2NO)', 'Schneider Electric', 'Pcs', 0.00, 783.00),
(135, 'LADN02', 135, 'Auxiliary Contact Block (2NC)', 'Schneider Electric', 'Pcs', 0.00, 783.00),
(136, 'LADN22', 136, 'Auxiliary Contact Block (2NO+2NC)', 'Schneider Electric', 'Pcs', 0.00, 1599.00),
(137, 'LADN31', 137, 'Auxiliary Contact Block (3NO+1NC)', 'Schneider Electric', 'Pcs', 0.00, 1599.00),
(138, 'LADN13', 138, 'Auxiliary Contact Block (1NO+3NC)', 'Schneider Electric', 'Pcs', 0.00, 1599.00),
(139, 'LADN40', 139, 'Auxiliary Contact Block (4NO)', 'Schneider Electric', 'Pcs', 0.00, 1599.00),
(140, 'LADN04', 140, 'Auxiliary Contact Block (4NC)', 'Schneider Electric', 'Pcs', 0.00, 1599.00),
(141, 'LAD8N11', 141, 'Auxiliary Contact Block (1NO+1NC) Side', 'Schneider Electric', 'Pcs', 0.00, 1350.00),
(142, 'LAD8N20', 142, 'Auxiliary Contact Block (2NO) Side', 'Schneider Electric', 'Pcs', 0.00, 1350.00),
(143, 'LADT2', 143, '0.1-30 s On delay timer, Neumatic', 'Schneider Electric', 'Pcs', 0.00, 2850.00),
(144, 'LADT4', 144, '10-180 s On delay timer, Neumatic', 'Schneider Electric', 'Pcs', 0.00, 3120.00),
(145, 'LADR2', 145, '0.1-30 s Off delay timer, Neumatic', 'Schneider Electric', 'Pcs', 0.00, 2850.00),
(146, 'LADR4', 146, '10-180 s Off delay timer, Neumatic', 'Schneider Electric', 'Pcs', 0.00, 3120.00),
(147, 'LRD 01', 147, '0.10...0.16A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(148, 'LRD 02', 148, '0.16…0.25A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(149, 'LRD 03', 149, '0.25…0.40A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(150, 'LRD 04', 150, '0.40…0.63A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(151, 'LRD 05', 151, '0.63…1A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(152, 'LRD 06', 152, '1…1.7A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(153, 'LRD 07', 153, '1.6…2.5A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(154, 'LRD 08', 154, '2.5…4A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(155, 'LRD 10', 155, '4…6A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(156, 'LRD 12', 156, '5.5…8A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(157, 'LRD 14', 157, '7…10A for D09…D38', 'Schneider Electric', 'Pcs', 0.00, 2510.00),
(158, 'LRD 16', 158, '9…13A for D12…D38', 'Schneider Electric', 'Pcs', 0.00, 2680.00),
(159, 'LRD 21', 159, '12…18A for D18…D38', 'Schneider Electric', 'Pcs', 0.00, 2850.00),
(160, 'LRD 22', 160, '16…24A for D25…D38', 'Schneider Electric', 'Pcs', 0.00, 3180.00),
(161, 'LRD 32', 161, '23…32A for D25…D38', 'Schneider Electric', 'Pcs', 0.00, 4380.00),
(162, 'LRD 35', 162, '30…38A for D25…D38', 'Schneider Electric', 'Pcs', 0.00, 4380.00),
(163, 'LRD 325', 163, '16…25A for D40…D65A', 'Schneider Electric', 'Pcs', 0.00, 5430.00),
(164, 'LRD 332', 164, '23…32A for D40…D65A', 'Schneider Electric', 'Pcs', 0.00, 5430.00),
(165, 'LRD 340', 165, '25…40A for D40…D65A', 'Schneider Electric', 'Pcs', 0.00, 5430.00),
(166, 'LRD 350', 166, '37…50A for D40…D65A', 'Schneider Electric', 'Pcs', 0.00, 6740.00),
(167, 'LRD 365', 167, '48…65A for D40…D65A', 'Schneider Electric', 'Pcs', 0.00, 7390.00),
(168, 'LRD 3361', 168, '55…70A for D50…D95', 'Schneider Electric', 'Pcs', 0.00, 8280.00),
(169, 'LRD 3363', 169, '63…80A for D65…D95', 'Schneider Electric', 'Pcs', 0.00, 8770.00),
(170, 'LRD 3365', 170, '80…104A for D80 and D95', 'Schneider Electric', 'Pcs', 0.00, 12740.00),
(171, 'LRD 4365', 171, '80…104A for D115 and D150', 'Schneider Electric', 'Pcs', 0.00, 15900.00),
(172, 'LRD 4367', 172, '95…120A for D115 and D150', 'Schneider Electric', 'Pcs', 0.00, 17160.00),
(173, 'LRD 4369', 173, '110…140A for D150', 'Schneider Electric', 'Pcs', 0.00, 18230.00),
(174, 'LR9F 5357', 174, '30-50A for F115…F185', 'Schneider Electric', 'Pcs', 0.00, 18430.00),
(175, 'LR9F 5363', 175, '48-80A for F115…F185', 'Schneider Electric', 'Pcs', 0.00, 18430.00),
(176, 'LR9F 5367', 176, '60-100A for F115…F185', 'Schneider Electric', 'Pcs', 0.00, 18430.00),
(177, 'LR9F 5369', 177, '90-150A for F115…F185', 'Schneider Electric', 'Pcs', 0.00, 18800.00),
(178, 'LR9F 5371', 178, '132-220A for F185…F400', 'Schneider Electric', 'Pcs', 0.00, 27450.00),
(179, 'LR9F 7375', 179, '200-330A for F225…F500', 'Schneider Electric', 'Pcs', 0.00, 27450.00),
(180, 'LR9F 7379', 180, '300-500A for F225…F500', 'Schneider Electric', 'Pcs', 0.00, 36780.00),
(181, 'LR9F 7381', 181, '380-630A for F400…F630 and F800', 'Schneider Electric', 'Pcs', 0.00, 38990.00),
(182, 'LE1M35Q705', 182, '0.25KW, TP, Direct Online Starter (D.O.L) Starter (0.54-0.8A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(183, 'LE1M35Q706', 183, '0.37KW, TP, Direct Online Starter (D.O.L) Starter (0.8-1.2A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(184, 'LE1M35Q707', 184, '0.55KW, TP, Direct Online Starter (D.O.L) Starter (1.2-1.8A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(185, 'LE1M35Q708', 185, '0.75KW, TP, Direct Online Starter (D.O.L) Starter (1.8-2.6A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(186, 'LE1M35Q710', 186, '1.5KW, TP, Direct Online Starter (D.O.L) Starter (2.6-3.7A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(187, 'LE1M35Q712', 187, '2.2KW, TP, Direct Online Starter (D.O.L) Starter (3.7-5.5A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(188, 'LE1M35Q714', 188, '3KW, TP, Direct Online Starter (D.O.L) Starter (5.5-8A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(189, 'LE1M35Q716', 189, '4KW, TP, Direct Online Starter (D.O.L) Starter (8-11.5A)', 'Schneider Electric', 'Pcs', 0.00, 7250.00),
(190, 'LE1M35Q721', 190, '5KW, TP, Direct Online Starter (D.O.L) Starter (10-14A)', 'Schneider Electric', 'Pcs', 0.00, 7530.00),
(191, 'LE1M35Q722', 191, '7.5KW, TP, Direct Online Starter (D.O.L) Starter (12-16A)', 'Schneider Electric', 'Pcs', 0.00, 8220.00),
(192, 'ATV12H018M2', 192, '0.18KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 16310.00),
(193, 'ATV12H037M2', 193, '0.37KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 18640.00),
(194, 'ATV12H055M2', 194, '0.55KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 20960.00),
(195, 'ATV12H075M2', 195, '0.75KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 23310.00),
(196, 'ATV12HU15M2', 196, '1.5KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 27960.00),
(197, 'ATV12HU22M2', 197, '2.2KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 30280.00),
(198, 'ATV12H018M3', 198, '0.18KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 17480.00),
(199, 'ATV12H037M3', 199, '0.18KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 19230.00),
(200, 'ATV12H075M3', 200, '0.75KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 24470.00),
(201, 'ATV12HU15M3', 201, '1.5KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 28530.00),
(202, 'ATV12HU22M3', 202, '2.2KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 30870.00),
(203, 'ATV12HU40M3', 203, '4.0KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 33200.00),
(204, 'ATV312H018M2', 204, '0.18KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 18640.00),
(205, 'ATV312H037M2', 205, '0.37KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 20390.00),
(206, 'ATV312H055M2', 206, '0.55KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 22720.00),
(207, 'ATV312H075M2', 207, '0.75KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 26790.00),
(208, 'ATV312HU11M2', 208, '1.1KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 30870.00),
(209, 'ATV312HU15M2', 209, '1.5KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 31440.00),
(210, 'ATV312HU22M2', 210, '2.2KW Single phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 34360.00),
(211, 'ATV312H018M3', 211, '0.18KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 20390.00),
(212, 'ATV312H037M3', 212, '0.37KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 21550.00),
(213, 'ATV312H055M3', 213, '0.55KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 23880.00),
(214, 'ATV312H075M3', 214, '0.75KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 29710.00),
(215, 'ATV312HU11M3', 215, '1.1KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 32610.00),
(216, 'ATV312HU15M3', 216, '1.5KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 33770.00),
(217, 'ATV312HU22M3', 217, '2.2KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 34950.00),
(218, 'ATV312HU40M3', 218, '4.0KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 39600.00),
(219, 'ATV312HU55M3', 219, '5.5KW Three phase supply 200-240V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 67530.00),
(220, 'ATV312H037N4', 220, '0.37KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 26200.00),
(221, 'ATV312H055N4', 221, '0.55KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 27960.00),
(222, 'ATV312H075N4', 222, '0.75KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 29120.00),
(223, 'ATV312HU11N4', 223, '1.1KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 30870.00),
(224, 'ATV312HU15N4', 224, '1.5KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 33200.00),
(225, 'ATV312HU22N4', 225, '2.2KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 37850.00),
(226, 'ATV312HU30N4', 226, '3.0KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 39600.00),
(227, 'ATV312HU40N4', 227, '4.0KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 40760.00),
(228, 'ATV312HU55N4', 228, '5.5KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 69870.00),
(229, 'ATV312HU75N4', 229, '7.5KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 75690.00),
(230, 'ATV312HD11N4', 230, '11KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 130620.00),
(231, 'ATV312HD15N4', 231, '15KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 114100.00),
(232, 'ATV61HD22N4', 232, '22KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 175000.00),
(233, 'ATV61HD30N4', 233, '30KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 216000.00),
(234, 'ATV61HD37N4', 234, '37KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 253000.00),
(235, 'ATV61HD45N4', 235, '45KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 292000.00),
(236, 'ATV61HD55N4', 236, '55KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 332000.00),
(237, 'ATV61HD75N4', 237, '75KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 435000.00),
(238, 'ATV61HD90N4', 238, '90KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 601078.00),
(239, 'ATV61HC11N4', 239, '110KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 644633.00),
(240, 'ATV61HC13N4', 240, '130KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 810146.00),
(241, 'ATV61HC16N4', 241, '160KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 975660.00),
(242, 'ATV61HC22N4', 242, '220KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 1109813.00),
(243, 'ATV61HC25N4', 243, '250KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 1507046.00),
(244, 'ATV61HC31N4', 244, '310KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 1759673.00),
(245, 'ATV61HC40N4', 245, '400KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 1997664.00),
(246, 'ATV61HC50N4', 246, '500KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 2639509.00),
(247, 'ATV61HC63N4', 247, '630KW Three phase supply 380-500V 50/60Hz', 'Schneider Electric', 'Pcs', 0.00, 3136050.00),
(248, 'BLRCS030A036B44', 248, 'Capacitor can SDY 3 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 2800.00),
(249, 'BLRCS050A060B44', 249, 'Capacitor can SDY 5 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 3700.00),
(250, 'BLRCS075A090B44', 250, 'Capacitor can SDY 7.5 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 4700.00),
(251, 'BLRCS104A125B44', 251, 'Capacitor can SDY 10.4 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 5700.00),
(252, 'BLRCS125A150B44', 252, 'Capacitor can SDY 12.5 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 7800.00),
(253, 'BLRCS150A180B44', 253, 'Capacitor can SDY 15 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 8000.00),
(254, 'BLRCS200A240B44', 254, 'Capacitor can SDY 20 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 9900.00),
(255, 'BLRCS250A300B44', 255, 'Capacitor can SDY 25 Kvar 400V', 'Schneider Electric', 'Pcs', 0.00, 10500.00),
(256, 'SH 201-C06', 256, '6A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(257, 'SH 201-C16', 257, '16A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(258, 'SH 201-C16', 258, '16A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(259, 'SH 201-C20', 259, '20A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(260, 'SH 201-C25', 260, '25A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(261, 'SH 201-C32', 261, '32A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(262, 'SH 201-C40', 262, '40A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 520.00),
(263, 'S 201-C50', 263, '50A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1250.00),
(264, 'S 201-C63', 264, '63A, 6KA, SP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1250.00),
(265, 'SH 202-C06', 265, '6A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(266, 'SH 202-C10', 266, '10A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(267, 'SH 202-C16', 267, '16A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(268, 'SH 202-C20', 268, '20A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(269, 'SH 202-C25', 269, '25A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(270, 'SH 202-C32', 270, '32A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(271, 'SH 202-C40', 271, '40A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 1320.00),
(272, 'S 202-C50', 272, '50A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2950.00),
(273, 'S 202-C63', 273, '63A, 6KA, DP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2950.00),
(274, 'SH 203-C06', 274, '6A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(275, 'SH 203-C10', 275, '10A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(276, 'SH 203-C16', 276, '16A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(277, 'SH 203-C20', 277, '20A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(278, 'SH 203-C25', 278, '25A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(279, 'SH 203-C32', 279, '32A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(280, 'SH 203-C40', 280, '40A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 2800.00),
(281, 'S 203-C50', 281, '50A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 4500.00),
(282, 'S 203-C63', 282, '63A, 6KA, TP, MCB', 'ABB of Germany', 'Pcs', 0.00, 4500.00),
(291, 'Xtmax XT1C 160 FF R16', 291, '16A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(292, 'Xtmax XT1C 160 FF R25', 292, '25A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(293, 'Xtmax XT1C 160 FF R32', 293, '32A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(294, 'Xtmax XT1C 160 FF R40', 294, '40A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(295, 'Xtmax XT1C 160 FF R50', 295, '50A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(296, 'Xtmax XT1C 160 FF R63', 296, '63A, 25KA, TP, MCCB', 'ABB of Italy ', 'Pcs', 0.00, 8200.00),
(297, 'Xtmax XT1C 160 FF R80', 297, '80A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(298, 'Xtmax XT1C 160 FF R100', 298, '100A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 8200.00),
(299, 'Xtmax XT1C 160 FF R125', 299, '125A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 9600.00),
(300, 'Xtmax XT1C 160 FF R160', 300, '160A, 25KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 12500.00),
(301, 'Xtmax XT3N 250 FF R200', 301, '200A, 36KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 20500.00),
(302, 'Xtmax XT3N 250 FF R250', 302, '250A, 36KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 24500.00),
(303, 'Tmax T5N 400 FF R320', 303, '320A, 36KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 45000.00),
(304, 'Tmax T5N 400 FF R400', 304, '400A, 36KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 45000.00),
(305, 'Tmax T5N 630 FF R500', 305, '500A, 36KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 50000.00),
(306, 'Tmax T5N 630 FF R630', 306, '630A, 36KA TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 57500.00),
(307, 'Tmax T6S 800 FF R800', 307, '800A, 50KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 72000.00),
(308, 'Tmax T7S 1600 FF R 1000', 308, '1000A, 50KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 112000.00),
(309, 'Tmax T7S 1600 FF R1250', 309, '1250A, 50KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 140000.00),
(310, 'Tmax T7H 1600 FF R1600', 310, '1600A, 50KA, TP, MCCB', 'ABB of Italy', 'Pcs', 0.00, 215000.00),
(311, 'XT1-XT4', 311, 'Shunt Opening Release', 'ABB of Italy', 'Pcs', 0.00, 4500.00),
(312, 'T4-T5-T6', 312, 'Shunt Opening Release', 'ABB of Italy', 'Pcs', 0.00, 5000.00),
(313, 'T7-T7M-X1', 313, 'Shunt Opening Release', 'ABB of Italy', 'Pcs', 0.00, 9500.00),
(314, 'XT1-XT4', 314, 'Under Voltage Release', 'ABB of Italy', 'Pcs', 0.00, 6500.00),
(315, 'T4-T5-T6', 315, 'Under Voltage Release', 'ABB of Italy', 'Pcs', 0.00, 7000.00),
(316, 'T4-T5-T6', 316, 'Under Voltage Release', 'ABB of Italy', 'Pcs', 0.00, 10500.00),
(317, 'XT1-XT4', 317, 'Auxiliary Contacts', 'ABB of Italy', 'Pcs', 0.00, 3500.00),
(318, 'T4-T5-T6', 318, 'Auxiliary Contacts', 'ABB of Italy', 'Pcs', 0.00, 3500.00),
(319, 'T4-T5-T6', 319, 'Auxiliary Contacts', 'ABB of Italy', 'Pcs', 0.00, 6500.00),
(320, 'E1N 800 PR121/P-LI In-800A 3p F HR', 320, '800A, 50KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 205000.00),
(321, 'E2N 1000 PR121/P-LI In-1000A 3p F HR', 321, '1000A, 65KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 240000.00),
(322, 'E2N 1250 PR121/P-LI In-1250A 3p F HR', 322, '1250A, 65KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 250000.00),
(323, 'E2N 1600 PR121/P-LI In-1600A 3p F HR', 323, '1600A, 65KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 255000.00),
(324, 'E2N 2000 PR121/P LI In-2000A 3p F HR', 324, '2000A, 65KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 280000.00),
(325, 'E2N 2500 PR121/P-LI In-2500A 3p F HR', 325, '2500A, 65KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 300000.00),
(326, 'E2N 3200 PR121/P-LI In-3200A 3p F HR', 326, '3200A, 65KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 380000.00),
(327, 'E2N 4000 PR121/P-LI In-4000A 3p F HR', 327, '4000A, 100KA, TP, ACB', 'ABB of Italy ', 'Pcs', 0.00, 545000.00),
(328, 'E6N 5000 PR121/P-LI In-5000A 3p F HR', 328, '5000A, 100KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 955000.00),
(329, 'E6N 6300 PR121/P-LI In-6300A 3p F HR', 329, '6300A, 100KA, TP, ACB', 'ABB of Italy', 'Pcs', 0.00, 1330000.00),
(330, '', 330, 'Shunt Opening 220-240 for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 13000.00),
(331, '', 331, 'Shunt Opening 220-240 for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 13000.00),
(332, '', 332, 'Undervoltage Release for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 14000.00),
(333, '', 333, 'Aux Contact (5 No + 5NC) for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 13000.00),
(334, '', 334, 'Gear Motor for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 45000.00),
(335, '', 335, 'Electric Timer Delay for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 13000.00),
(336, '', 336, 'Mechanical Interlock (1 Set) for air circuit breaker', 'ABB of Italy', 'Pcs', 0.00, 80000.00),
(337, 'AX09-30-10-80', 337, '9A (AC-3), TP, Ith 22A (AC-1) Magnetic Contactor, Coil:220/415/110/V AC', 'ABB', 'Pcs', 0.00, 2000.00),
(338, 'AX 12-30-10-80', 338, '12A (AC-3), TP, Ith 25A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 3600.00),
(339, 'AX 18-30-10-80', 339, '18A (AC-3), TP, Ith 27A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 3600.00),
(340, 'AX 25-30-10-80', 340, '25A (AC-3), TP, Ith 32A (AC-1) Magnetic Contactor,              Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 3600.00),
(341, 'AX 32-30-10-80', 341, '32A (AC-3), TP, Ith 55A (AC-1) Magnetic Contactor,     Coil: 22o/415/110/V AC', 'ABB', 'Pcs', 0.00, 6500.00),
(342, 'AX 40-30-10-80', 342, '40A (AC-3), TP, Ith 60A (AC-1) Magnetic Contactor,    Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 10000.00),
(343, 'AX 50-30-10-80', 343, '50A (AC-3), TP, Ith 100A (AC-1) Magnetic Contactor,    Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 11500.00),
(344, 'AX 65-30-10-80', 344, '65A (AC-3), TP, Ith 115A (AC-1) Magnetic Contactor,   Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 15300.00),
(345, 'AX 80-30-10-80', 345, '80A (AC-3), TP, Ith 125A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 19100.00),
(346, 'AF96-30-11-13', 346, '96A (AC-3), TP, Ith 130A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 21000.00),
(347, 'AF116-30-11-13', 347, '116A (AC-3), TP, Ith 160A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 26300.00),
(348, 'AF140-30-11-13', 348, '140A (AC-3), TP, Ith 200A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 33300.00),
(349, 'AF190-30-11-13', 349, '190A (AC-3), TP, Ith 250A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 45000.00),
(350, 'AF205-30-11-13', 350, '205A (AC-3), TP, Ith 350A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 56000.00),
(351, 'AF265-30-11-13', 351, '305A (AC-3), TP, Ith 400A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 63000.00),
(352, 'AF305-30-11-13', 352, '305A (AC-3), TP, Ith 500A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB ', 'Pcs', 0.00, 75000.00),
(353, 'AF370-30-11-13', 353, '370A (AC-3), TP, Ith 600A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 92000.00),
(354, 'AF460-30-11-13', 354, '460A (AC-3), TP, Ith 700A (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 114000.00),
(355, 'AF580-30-11-13', 355, '580A (AC-3), TP, Ith 800 (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 149000.00),
(356, 'AF750-30-11-13', 356, '750A (AC-3), TP, Ith 1050 (AC-1) Magnetic Contactor, Coil: 220/415/110/V AC', 'ABB', 'Pcs', 0.00, 279000.00),
(357, 'MS 116-0.63', 357, '0.04-0.63A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 5000.00),
(358, 'MS 116-1.0', 358, '0.63-1.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 5000.00),
(359, 'MS 116-1.6', 359, '1.00-1.60A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 5000.00),
(360, 'MS 116-2.5', 360, '1.60-2.50A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 5000.00),
(361, 'MS 116-4', 361, '2.50-4.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 5000.00),
(362, 'MS 116-6.3', 362, '4.00-6.30A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 5000.00),
(363, 'MS 116-10', 363, '6.30-10.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 6000.00),
(364, 'MS 116-16', 364, '8.00A-12.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 6000.00),
(365, 'MS 116-16', 365, '10.00-16.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 6000.00),
(366, 'MS 325-20', 366, '16.00-20.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 6000.00),
(367, 'MS 325-25', 367, '20.00-25.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 6000.00),
(368, 'MS 450-32', 368, '22.00-32.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 6000.00),
(369, 'MS 450-40', 369, '28.00-40.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 25000.00),
(370, 'MS 450-45', 370, '36.00-45.00A Motor Starting Solution', 'ABB', 'Pcs', 0.00, 27100.00),
(371, 'MS 450-50', 371, '40.00-50.00 Motor Starting Solution', 'ABB', 'Pcs', 0.00, 27500.00),
(372, 'MS 495-63', 372, '45.00-63.00 Motor Starting Solution', 'ABB', 'Pcs', 0.00, 31000.00),
(373, 'MS 495-75', 373, '57.00-75.00 Motor Starting Solution', 'ABB', 'Pcs', 0.00, 34100.00);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `total` double(13,2) NOT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `vat` double(13,2) NOT NULL,
  `subtotal` double(13,2) NOT NULL,
  `total` double(13,2) NOT NULL,
  `comments` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jobno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vat` double(13,2) NOT NULL,
  `reg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `milage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtotal` double(13,2) NOT NULL,
  `total` double(13,2) NOT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estimate` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` double(13,2) NOT NULL,
  `wast` double(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `qty`, `wast`) VALUES
(3, 0, 1.00, 0.00),
(4, 0, 0.00, 0.00),
(5, 0, -1.00, 0.00),
(6, 0, 0.00, 0.00),
(7, 0, 0.00, 0.00),
(8, 0, 0.00, 0.00),
(9, 0, 0.00, 0.00),
(10, 0, 0.00, 0.00),
(11, 0, 0.00, 0.00),
(12, 0, 0.00, 0.00),
(13, 0, 0.00, 0.00),
(14, 0, 0.00, 0.00),
(15, 0, 0.00, 0.00),
(16, 0, 0.00, 0.00),
(17, 0, 0.00, 0.00),
(18, 0, 0.00, 0.00),
(19, 0, 0.00, 0.00),
(20, 0, 0.00, 0.00),
(21, 0, 0.00, 0.00),
(22, 0, 0.00, 0.00),
(23, 0, 0.00, 0.00),
(24, 0, 0.00, 0.00),
(25, 0, 0.00, 0.00),
(26, 0, 0.00, 0.00),
(27, 0, 0.00, 0.00),
(28, 0, 0.00, 0.00),
(29, 0, 0.00, 0.00),
(30, 0, 0.00, 0.00),
(31, 0, 0.00, 0.00),
(32, 0, 0.00, 0.00),
(33, 0, 0.00, 0.00),
(34, 0, 0.00, 0.00),
(35, 0, 0.00, 0.00),
(36, 0, 0.00, 0.00),
(37, 0, 0.00, 0.00),
(38, 0, 0.00, 0.00),
(39, 0, 0.00, 0.00),
(41, 0, 0.00, 0.00),
(42, 0, 0.00, 0.00),
(43, 0, 0.00, 0.00),
(44, 0, 0.00, 0.00),
(45, 0, 0.00, 0.00),
(46, 0, 0.00, 0.00),
(47, 0, 0.00, 0.00),
(48, 0, 0.00, 0.00),
(49, 0, 0.00, 0.00),
(50, 0, 0.00, 0.00),
(51, 0, 0.00, 0.00),
(52, 0, 0.00, 0.00),
(53, 0, 0.00, 0.00),
(54, 0, 0.00, 0.00),
(55, 0, 0.00, 0.00),
(56, 0, 0.00, 0.00),
(57, 0, 0.00, 0.00),
(58, 0, 0.00, 0.00),
(59, 0, 0.00, 0.00),
(60, 0, 0.00, 0.00),
(61, 0, 0.00, 0.00),
(62, 0, 0.00, 0.00),
(63, 0, 0.00, 0.00),
(64, 0, 0.00, 0.00),
(65, 0, 0.00, 0.00),
(66, 0, 0.00, 0.00),
(67, 0, 0.00, 0.00),
(68, 0, 0.00, 0.00),
(69, 0, 0.00, 0.00),
(70, 0, 0.00, 0.00),
(71, 0, 0.00, 0.00),
(72, 0, 0.00, 0.00),
(73, 0, 0.00, 0.00),
(74, 0, 0.00, 0.00),
(75, 0, 0.00, 0.00),
(76, 0, 0.00, 0.00),
(77, 0, 0.00, 0.00),
(78, 0, 0.00, 0.00),
(79, 0, 0.00, 0.00),
(80, 0, 0.00, 0.00),
(81, 0, 0.00, 0.00),
(82, 0, 0.00, 0.00),
(83, 0, 0.00, 0.00),
(84, 0, 0.00, 0.00),
(85, 0, 0.00, 0.00),
(86, 0, 0.00, 0.00),
(87, 0, 0.00, 0.00),
(88, 0, 0.00, 0.00),
(89, 0, 0.00, 0.00),
(90, 0, 0.00, 0.00),
(91, 0, 0.00, 0.00),
(92, 0, 0.00, 0.00),
(93, 0, 0.00, 0.00),
(94, 0, 0.00, 0.00),
(95, 0, 0.00, 0.00),
(96, 0, 0.00, 0.00),
(97, 0, 0.00, 0.00),
(98, 0, 0.00, 0.00),
(99, 0, 0.00, 0.00),
(100, 0, 0.00, 0.00),
(101, 0, 0.00, 0.00),
(102, 0, 0.00, 0.00),
(103, 0, 0.00, 0.00),
(104, 0, 0.00, 0.00),
(105, 0, 0.00, 0.00),
(106, 0, 0.00, 0.00),
(107, 0, 0.00, 0.00),
(108, 0, 0.00, 0.00),
(109, 0, 0.00, 0.00),
(110, 0, 0.00, 0.00),
(111, 0, 0.00, 0.00),
(112, 0, 0.00, 0.00),
(113, 0, 0.00, 0.00),
(114, 0, 0.00, 0.00),
(115, 0, 0.00, 0.00),
(116, 0, 0.00, 0.00),
(117, 0, 0.00, 0.00),
(118, 0, 0.00, 0.00),
(119, 0, 0.00, 0.00),
(121, 0, 0.00, 0.00),
(122, 0, 0.00, 0.00),
(123, 0, 0.00, 0.00),
(124, 0, 0.00, 0.00),
(125, 0, 0.00, 0.00),
(126, 0, 0.00, 0.00),
(127, 0, 0.00, 0.00),
(128, 0, 0.00, 0.00),
(131, 0, 0.00, 0.00),
(132, 0, 0.00, 0.00),
(133, 0, 0.00, 0.00),
(134, 0, 0.00, 0.00),
(135, 0, 0.00, 0.00),
(136, 0, 0.00, 0.00),
(137, 0, 0.00, 0.00),
(138, 0, 0.00, 0.00),
(139, 0, 0.00, 0.00),
(140, 0, 0.00, 0.00),
(141, 0, 0.00, 0.00),
(142, 0, 0.00, 0.00),
(143, 0, 0.00, 0.00),
(144, 0, 0.00, 0.00),
(145, 0, 0.00, 0.00),
(146, 0, 0.00, 0.00),
(147, 0, 0.00, 0.00),
(148, 0, 0.00, 0.00),
(149, 0, 0.00, 0.00),
(150, 0, 0.00, 0.00),
(151, 0, 0.00, 0.00),
(152, 0, 0.00, 0.00),
(153, 0, 0.00, 0.00),
(154, 0, 0.00, 0.00),
(155, 0, 0.00, 0.00),
(156, 0, 0.00, 0.00),
(157, 0, 0.00, 0.00),
(158, 0, 0.00, 0.00),
(159, 0, 0.00, 0.00),
(160, 0, 0.00, 0.00),
(161, 0, 0.00, 0.00),
(162, 0, 0.00, 0.00),
(163, 0, 0.00, 0.00),
(164, 0, 0.00, 0.00),
(165, 0, 0.00, 0.00),
(166, 0, 0.00, 0.00),
(167, 0, 0.00, 0.00),
(168, 0, 0.00, 0.00),
(169, 0, 0.00, 0.00),
(170, 0, 0.00, 0.00),
(171, 0, 0.00, 0.00),
(172, 0, 0.00, 0.00),
(173, 0, 0.00, 0.00),
(174, 0, 0.00, 0.00),
(175, 0, 0.00, 0.00),
(176, 0, 0.00, 0.00),
(177, 0, 0.00, 0.00),
(178, 0, 0.00, 0.00),
(179, 0, 0.00, 0.00),
(180, 0, 0.00, 0.00),
(181, 0, 0.00, 0.00),
(182, 0, 0.00, 0.00),
(183, 0, 0.00, 0.00),
(184, 0, 0.00, 0.00),
(185, 0, 0.00, 0.00),
(186, 0, 0.00, 0.00),
(187, 0, 0.00, 0.00),
(188, 0, 0.00, 0.00),
(189, 0, 0.00, 0.00),
(190, 0, 0.00, 0.00),
(191, 0, 0.00, 0.00),
(192, 0, 0.00, 0.00),
(193, 0, 0.00, 0.00),
(194, 0, 0.00, 0.00),
(195, 0, 0.00, 0.00),
(196, 0, 0.00, 0.00),
(197, 0, 0.00, 0.00),
(198, 0, 0.00, 0.00),
(199, 0, 0.00, 0.00),
(200, 0, 0.00, 0.00),
(201, 0, 0.00, 0.00),
(202, 0, 0.00, 0.00),
(203, 0, 0.00, 0.00),
(204, 0, 0.00, 0.00),
(205, 0, 0.00, 0.00),
(206, 0, 0.00, 0.00),
(207, 0, 0.00, 0.00),
(208, 0, 0.00, 0.00),
(209, 0, 0.00, 0.00),
(210, 0, 0.00, 0.00),
(211, 0, 0.00, 0.00),
(212, 0, 0.00, 0.00),
(213, 0, 0.00, 0.00),
(214, 0, 0.00, 0.00),
(215, 0, 0.00, 0.00),
(216, 0, 0.00, 0.00),
(217, 0, 0.00, 0.00),
(218, 0, 0.00, 0.00),
(219, 0, 0.00, 0.00),
(220, 0, 0.00, 0.00),
(221, 0, 0.00, 0.00),
(222, 0, 0.00, 0.00),
(223, 0, 0.00, 0.00),
(224, 0, 0.00, 0.00),
(225, 0, 0.00, 0.00),
(226, 0, 0.00, 0.00),
(227, 0, 0.00, 0.00),
(228, 0, 0.00, 0.00),
(229, 0, 0.00, 0.00),
(230, 0, 0.00, 0.00),
(231, 0, 0.00, 0.00),
(232, 0, 0.00, 0.00),
(233, 0, 0.00, 0.00),
(234, 0, 0.00, 0.00),
(235, 0, 0.00, 0.00),
(236, 0, 0.00, 0.00),
(237, 0, 0.00, 0.00),
(238, 0, 0.00, 0.00),
(239, 0, 0.00, 0.00),
(240, 0, 0.00, 0.00),
(241, 0, 0.00, 0.00),
(242, 0, 0.00, 0.00),
(243, 0, 0.00, 0.00),
(244, 0, 0.00, 0.00),
(245, 0, 0.00, 0.00),
(246, 0, 0.00, 0.00),
(247, 0, 0.00, 0.00),
(248, 0, 0.00, 0.00),
(249, 0, 0.00, 0.00),
(250, 0, 0.00, 0.00),
(251, 0, 0.00, 0.00),
(252, 0, 0.00, 0.00),
(253, 0, 0.00, 0.00),
(254, 0, 0.00, 0.00),
(255, 0, 0.00, 0.00),
(256, 0, 0.00, 0.00),
(257, 0, 0.00, 0.00),
(258, 0, 0.00, 0.00),
(259, 0, 0.00, 0.00),
(260, 0, 0.00, 0.00),
(261, 0, 0.00, 0.00),
(262, 0, 0.00, 0.00),
(263, 0, 0.00, 0.00),
(264, 0, 0.00, 0.00),
(265, 0, 0.00, 0.00),
(266, 0, 0.00, 0.00),
(267, 0, 0.00, 0.00),
(268, 0, 0.00, 0.00),
(269, 0, 0.00, 0.00),
(270, 0, 0.00, 0.00),
(271, 0, 0.00, 0.00),
(272, 0, 0.00, 0.00),
(273, 0, 0.00, 0.00),
(274, 0, 0.00, 0.00),
(275, 0, 0.00, 0.00),
(276, 0, 0.00, 0.00),
(277, 0, 0.00, 0.00),
(278, 0, 0.00, 0.00),
(279, 0, 0.00, 0.00),
(280, 0, 0.00, 0.00),
(281, 0, 0.00, 0.00),
(282, 0, 0.00, 0.00),
(291, 0, 0.00, 0.00),
(292, 0, 0.00, 0.00),
(293, 0, 0.00, 0.00),
(294, 0, 0.00, 0.00),
(295, 0, 0.00, 0.00),
(296, 0, 0.00, 0.00),
(297, 0, 0.00, 0.00),
(298, 0, 0.00, 0.00),
(299, 0, 0.00, 0.00),
(300, 0, 0.00, 0.00),
(301, 0, 0.00, 0.00),
(302, 0, 0.00, 0.00),
(303, 0, 0.00, 0.00),
(304, 0, 0.00, 0.00),
(305, 0, 0.00, 0.00),
(306, 0, 0.00, 0.00),
(307, 0, 0.00, 0.00),
(308, 0, 0.00, 0.00),
(309, 0, 0.00, 0.00),
(310, 0, 0.00, 0.00),
(311, 0, 0.00, 0.00),
(312, 0, 0.00, 0.00),
(313, 0, 0.00, 0.00),
(314, 0, 0.00, 0.00),
(315, 0, 0.00, 0.00),
(316, 0, 0.00, 0.00),
(317, 0, 0.00, 0.00),
(318, 0, 0.00, 0.00),
(319, 0, 0.00, 0.00),
(320, 0, 0.00, 0.00),
(321, 0, 0.00, 0.00),
(322, 0, 0.00, 0.00),
(323, 0, 0.00, 0.00),
(324, 0, 0.00, 0.00),
(325, 0, 0.00, 0.00),
(326, 0, 0.00, 0.00),
(327, 0, 0.00, 0.00),
(328, 0, 0.00, 0.00),
(329, 0, 0.00, 0.00),
(330, 0, 0.00, 0.00),
(331, 0, 0.00, 0.00),
(332, 0, 0.00, 0.00),
(333, 0, 0.00, 0.00),
(334, 0, 0.00, 0.00),
(335, 0, 0.00, 0.00),
(336, 0, 0.00, 0.00),
(337, 0, 0.00, 0.00),
(338, 0, 0.00, 0.00),
(339, 0, 0.00, 0.00),
(340, 0, 0.00, 0.00),
(341, 0, 0.00, 0.00),
(342, 0, 0.00, 0.00),
(343, 0, 0.00, 0.00),
(344, 0, 0.00, 0.00),
(345, 0, 0.00, 0.00),
(346, 0, 0.00, 0.00),
(347, 0, 0.00, 0.00),
(348, 0, 0.00, 0.00),
(349, 0, 0.00, 0.00),
(350, 0, 0.00, 0.00),
(351, 0, 0.00, 0.00),
(352, 0, 0.00, 0.00),
(353, 0, 0.00, 0.00),
(354, 0, 0.00, 0.00),
(355, 0, 0.00, 0.00),
(356, 0, 0.00, 0.00),
(357, 0, 0.00, 0.00),
(358, 0, 0.00, 0.00),
(359, 0, 0.00, 0.00),
(360, 0, 0.00, 0.00),
(361, 0, 0.00, 0.00),
(362, 0, 0.00, 0.00),
(363, 0, 0.00, 0.00),
(364, 0, 0.00, 0.00),
(365, 0, 0.00, 0.00),
(366, 0, 0.00, 0.00),
(367, 0, 0.00, 0.00),
(368, 0, 0.00, 0.00),
(369, 0, 0.00, 0.00),
(370, 0, 0.00, 0.00),
(371, 0, 0.00, 0.00),
(372, 0, 0.00, 0.00),
(373, 0, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company`, `address`, `phone`) VALUES
(2, 'New prova Electric', 'New prova Electric', 'NawabPur,Dhaka. ', '01711331927'),
(3, 'Safa Electric', 'Safa Electric', 'Nawabpur,Dhaka.', '01765048795, 01711125929'),
(4, 'Alo Bitan', 'Alo Bitan', 'Nawabpur,Dhaka', '02-9512001 ,01555198443, 01511548558'),
(5, 'Saj  Electric', 'Saj  Electric', 'Nwabpur,Dhaka.', '01711244262,01716029948'),
(6, 'Bengla tech', 'Bengla tech', 'Nawabpur,Dhaka.', '02-95866016, 01762-009955'),
(7, 'Rohan Electric', 'Rohan Electric', 'Nawabpur,Dhaka.\n', 'N/A'),
(8, 'Mim Electric', 'Mim Electric', 'Nawabpur,Dhaka.', 'N/A'),
(9, 'Shibu  Light House', 'Shibu  Light House', 'Nwabpur,Dhaka', '01711-630139,02-7114682'),
(10, 'Momo Electric', 'Momo Electric', 'NMawabpur,Dhaka', 'N/A'),
(11, 'M.A Power', 'M.A Power', 'Nawabpur,Dhaka.', '029586020, 01711181147'),
(12, 'Gulistan Electric', 'Gulistan Electric', 'Nawabpur,Dhaka.', '01711952688 ,01732821539'),
(13, 'Orion trading', 'Orion trading', 'Nawabpur,Dhaka', '01715031306, 027116201'),
(14, 'Peramid Trading corporation', 'Peramid Trading corporation', 'Nawabpur,Dhaka.', '01713020792 ,01795328241');

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(13,2) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `wage_id` int(11) DEFAULT NULL,
  `perchase_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `estimate_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`id`, `date`, `type`, `amount`, `customer_id`, `supplier_id`, `invoice_id`, `service_id`, `employe_id`, `wage_id`, `perchase_id`, `sale_id`, `estimate_id`) VALUES
(2, '2017/01/04', 'Credit', 25000.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, '2017/01/04', 'Credit', 20250.00, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, '2017/01/04', 'Debit', 125000.00, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, '2017/01/05', 'Credit', 50000.00, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, '2017/01/17', 'Credit', 500.00, NULL, 2, NULL, NULL, NULL, NULL, 2, NULL, 0),
(10, '2017/01/17', 'Debit', 1869.00, 4, NULL, 4, NULL, NULL, NULL, NULL, NULL, 0),
(11, '2017/01/17', 'Credit', 1869.00, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(12, '2017/01/17', 'Debit', 500.00, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(13, '2017/01/17', 'Debit', 890.00, 4, NULL, 5, NULL, NULL, NULL, NULL, NULL, 0),
(14, '2017/01/25', 'Debit', 370.00, 5, NULL, 6, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roll` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `empid`, `designation`, `address`, `email`, `password`, `salt`, `roll`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sk. Md. Islam Shipu', '008', 'Accounts & Admin', '32,Sultan Ahamed Plaza,Purana Paltan.Dhaka', 'hub@admin.com', '$2y$10$1/hec7PxJrS1w41mNnt9ZOL9dq.dDTkUo0BqwKdz812TvYjI.IG4K', '$2y$10$0ay2.z5hAYxvoasxZTfwBeApROOUlLLo5KquU43sWky.LZNWDlfK.', 'Admin', 'snIen2WHHddcTFOrcP6bkhM25C2ZyZycxBfu3FnYF1eXrG3oUkVpmylRhhxn', '2016-12-28 22:27:29', '2017-01-25 01:14:05'),
(2, 'Md.Mehadi Hasan Milton', '000', 'Accounts & Admin', '32,Sultan Ahamed Plaza,Purana Paltan.Dhaka', 'milton@anexbd.net', '$2y$10$NK8FMOcw6A0YK1RAcdHF/O27Xy778dVa.5RLcV68P5sveeyHrGx.q', '', 'Accountant', 'cxNqaGogQobZ56IzzEZFCC5YYLczrglHv8GBxEWC9Sa2UmK4WY8RKFYvOURa', '2016-12-28 23:24:39', '2017-01-24 16:57:52'),
(3, 'Shabnam Sharif', '017', 'Officer Designer', '32,Sultan ahamed Plaza,Purana Paltan,Dhaka.', 'shabnam@anexbd.net', '$2y$10$7gjJcHc2LxnPBMgm2zCDCOvFDnREdVVtYsEh4LCMfawfy4k9iorXC', '', 'Sales', 'EOnG2BujcILWG9FO9SbXo5PqH8opKVD1UuOpBbz4Uh7Ub1IaEsRj8qDw0Mpu', '2016-12-29 16:49:47', '2017-01-24 10:13:15'),
(4, 'Iqbal Hossain', '0000', 'Purchase Asst.', '32,Sultanahamed Plaza,Paltan Dhaka', 'iqbal@anexbd.net', '$2y$10$QK0qghuicg3AtGAoWD5Faep/lPSav/ZQR28/GRPjkC9OYITZyXxjK', '', 'Purchase', 'e91SCxXDpCwmisfiG1N1QI4eG6rt9kMpTYrs5YNWZyEucbi2SNWbsrcc6j3r', '2017-01-08 15:36:25', '2017-01-17 10:15:47'),
(5, 'Engr. M.A Jaman', '000', 'Deputy General Manager', '32, Sultan Ahmed Plaza, (10th Floor)\nPurana Paltan, Dhaka.', 'jaman@anexbd.net', '$2y$10$aG6pDC2nPA/wsl1yZU3Hb.amgKAmI3rUb44OkaKWFvxESx1b8IsNm', '', 'Admin', NULL, '2017-01-17 10:08:28', '2017-01-17 10:08:28'),
(6, 'Shaheen Sharif', '00000', '', '32, Sultan Ahmed Plaza (10th Floor)\nPurana Paltan Dhaka.', 'shaheen@anexbd.net', '$2y$10$M4BFz1YtoexwfiVIkubP7.1A3AS4cTMJd7eIVCayyqB87hpuDxFi.', '', 'Sales', NULL, '2017-01-17 10:18:15', '2017-01-17 10:18:15'),
(9, 'Md. Mehadi Hasan Milton', '000', 'Accounts & Admin', '32, Sultan Ahmed Plaza (10th Floor), \nPurana Paltan, Dhaka.', 'miltonhrm@anexbd.net', '$2y$10$9HhiYA2GmO1PS3xhTJss0OVPKBs2kYSlv7tMqvEemI2rw5uJ3h7e6', '', 'Owner', 'GHuiP6Z0pePltlBxLgzqxLzMI5Pdw9hOrdkgJlw5ksiyQIDT8BKPcv2aRF4A', '2017-01-17 10:21:36', '2017-01-22 16:01:46'),
(10, 'Shabnam Sharif', '017', 'Officer Designer', '32, Sultan Ahmed Plaza (10th Floor),\nPurana Paltan, Dhaka.', 'shabnamstock@anexbd.net', '$2y$10$n5fsrPTzBVZBI/5Ilp3dKugL/0ZrSpx.T57K5WwKZix7pLY5CLDOq', '', 'Stock', '3g8ZHKBSfBejzWlRIgMnAXa0lf1SAdTenovSpkqvEodO8oIrlxYp6BtFGAx6', '2017-01-17 10:25:50', '2017-01-17 10:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `wages`
--

CREATE TABLE `wages` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` double(13,2) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assetaccounts`
--
ALTER TABLE `assetaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capitals`
--
ALTER TABLE `capitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chalans`
--
ALTER TABLE `chalans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dbwages`
--
ALTER TABLE `dbwages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drawings`
--
ALTER TABLE `drawings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenseaccounts`
--
ALTER TABLE `expenseaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loanaccounts`
--
ALTER TABLE `loanaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perchases`
--
ALTER TABLE `perchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wages`
--
ALTER TABLE `wages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assetaccounts`
--
ALTER TABLE `assetaccounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `capitals`
--
ALTER TABLE `capitals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chalans`
--
ALTER TABLE `chalans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `dbwages`
--
ALTER TABLE `dbwages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drawings`
--
ALTER TABLE `drawings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenseaccounts`
--
ALTER TABLE `expenseaccounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loanaccounts`
--
ALTER TABLE `loanaccounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `perchases`
--
ALTER TABLE `perchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `wages`
--
ALTER TABLE `wages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
