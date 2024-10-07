-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2024 at 05:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `versori_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Consultation`
--

CREATE TABLE `Consultation` (
  `Consultation_ID` varchar(255) NOT NULL,
  `Consultation_Date` varchar(255) NOT NULL,
  `Full_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone_no` varchar(255) NOT NULL,
  `Company_name` varchar(255) DEFAULT NULL,
  `Company_website_URL` varchar(255) DEFAULT NULL,
  `Company_scale` varchar(255) DEFAULT NULL,
  `Brand_overview` varchar(255) NOT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `Customer_ID` varchar(255) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Consultation`
--

INSERT INTO `Consultation` (`Consultation_ID`, `Consultation_Date`, `Full_name`, `Email`, `Phone_no`, `Company_name`, `Company_website_URL`, `Company_scale`, `Brand_overview`, `Other`, `Customer_ID`, `Status`) VALUES
('CONSULT_0001', '2024-10-07 18:54:57', 'Hiruni', 'hiruni.ekanayake@example.com', '0747654321', 'Nexus', 'http://name/example.com', '40 people', 'Brand', 'Other', 'C1017', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `Customer_account`
--

CREATE TABLE `Customer_account` (
  `Customer_ID` varchar(255) NOT NULL,
  `First_name` varchar(255) DEFAULT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone_no` varchar(255) DEFAULT NULL,
  `Dob` date DEFAULT NULL,
  `Date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customer_account`
--

INSERT INTO `Customer_account` (`Customer_ID`, `First_name`, `Last_name`, `Email`, `Password`, `Address`, `Phone_no`, `Dob`, `Date_created`) VALUES
('C1000', 'Kusal', 'Perera', 'kusal.perera@example.com', 'password123', '123 Galle Road, Colombo', '0771234567', '1990-05-12', '2024-10-02'),
('C1001', 'Nimal', 'Fernando', 'nimal.fernando@example.com', 'password123', '456 Main Street, Kandy', '0768765432', '1988-03-15', '2024-10-02'),
('C1002', 'Samantha', 'De Silva', 'samantha.desilva@example.com', 'password123', '789 High Street, Galle', '0712345678', '1992-11-23', '2024-10-02'),
('C1003', 'Harsha', 'Wijeratne', 'harsha.wijeratne@example.com', 'password123', '23 Temple Road, Kurunegala', '0778765432', '1985-07-08', '2024-10-02'),
('C1004', 'Lakmini', 'Rathnayake', 'lakmini.rathnayake@example.com', 'password123', '34 Park Avenue, Negombo', '0759876543', '1994-09-14', '2024-10-02'),
('C1005', 'Kasun', 'Jayasinghe', 'kasun.jayasinghe@example.com', 'password123', '56 Station Road, Matara', '0774567890', '1987-01-27', '2024-10-02'),
('C1006', 'Mihiri', 'Perera', 'mihiri.perera@example.com', 'password123', '78 New Town, Nuwara Eliya', '0781234567', '1991-04-11', '2024-10-02'),
('C1007', 'Ranil', 'Kumara', 'ranil.kumara@example.com', 'password123', '12 Hill Street, Badulla', '0729876543', '1995-02-19', '2024-10-02'),
('C1008', 'Nuwan', 'Senanayake', 'nuwan.senanayake@example.com', 'password123', '34 Market Lane, Ratnapura', '0711234567', '1989-08-30', '2024-10-02'),
('C1009', 'Shanika', 'Dias', 'shanika.dias@example.com', 'password123', '67 Beach Road, Beruwala', '0745678901', '1993-06-05', '2024-10-02'),
('C1010', 'Chathura', 'Samarasinghe', 'chathura.samarasinghe@example.com', 'password123', '89 Circular Road, Panadura', '0776543210', '1986-12-09', '2024-10-02'),
('C1011', 'Sanduni', 'Peiris', 'sanduni.peiris@example.com', 'password123', '45 Railway Road, Hambantota', '0723456789', '1991-10-22', '2024-10-02'),
('C1012', 'Thilina', 'Rajapaksha', 'thilina.rajapaksha@example.com', 'password123', '21 Main Road, Jaffna', '0754321098', '1990-01-14', '2024-10-02'),
('C1013', 'Ayesha', 'Gunarathna', 'ayesha.gunarathna@example.com', 'password123', '98 Lake Road, Anuradhapura', '0787654321', '1988-11-29', '2024-10-02'),
('C1014', 'Janith', 'Seneviratne', 'janith.seneviratne@example.com', 'password123', '15 Flower Lane, Batticaloa', '0716543210', '1992-07-18', '2024-10-02'),
('C1015', 'Iresha', 'Balasuriya', 'iresha.balasuriya@example.com', 'password123', '73 Queens Road, Polonnaruwa', '0765432109', '1990-09-26', '2024-10-02'),
('C1016', 'Dilan', 'Ratnayake', 'dilan.ratnayake@example.com', 'password123', '90 College Road, Puttalam', '0721234567', '1987-03-12', '2024-10-02'),
('C1017', 'Hiruni', 'Ekanayake', 'hiruni.ekanayake@example.com', 'password123', '22 Riverside, Kalutara', '0747654321', '1991-12-18', '2024-10-02'),
('C1018', 'Pradeep', 'Gunasekara', 'pradeep.gunasekara@example.com', 'password123', '36 Park Road, Trincomalee', '0710987654', '1989-06-03', '2024-10-02'),
('C1019', 'Dilini', 'Wijesinghe', 'dilini.wijesinghe@example.com', 'password123', '56 Temple Lane, Vavuniya', '0775432109', '1993-04-22', '2024-10-02'),
('C1020', 'Ruwan', 'Liyanage', 'ruwan.liyanage@example.com', 'password123', '78 Green Street, Kegalle', '0754321098', '1990-02-11', '2024-10-02'),
('C1021', 'Kumudu', 'Senarath', 'kumudu.senarath@example.com', 'password123', '23 Beach Road, Kalmunai', '0776543210', '1994-10-17', '2024-10-02'),
('C1022', 'Viraj', 'Weerasinghe', 'viraj.weerasinghe@example.com', 'password123', '45 Hilltop Road, Kilinochchi', '0763210987', '1988-08-25', '2024-10-02'),
('C1023', 'Rashmi', 'Abeysekera', 'rashmi.abeysekera@example.com', 'password123', '67 Galle Road, Dehiwala', '0714567890', '1992-11-08', '2024-10-02'),
('C1024', 'Chamika', 'Karunaratne', 'chamika.karunaratne@example.com', 'password123', '89 New Town, Battaramulla', '0743210987', '1991-05-13', '2024-10-02'),
('C1025', 'Shashika', 'Herath', 'shashika.herath@example.com', 'password123', '12 Temple Road, Gampaha', '0773210987', '1987-07-16', '2024-10-02'),
('C1026', 'Mahesha', 'Bandara', 'mahesha.bandara@example.com', 'password123', '56 Park Avenue, Wattala', '0726543210', '1990-10-24', '2024-10-02'),
('C1027', 'Lakshan', 'Dharmapala', 'lakshan.dharmapala@example.com', 'password123', '23 Circular Road, Katunayake', '0761234567', '1993-02-02', '2024-10-02'),
('C1028', 'Ishara', 'Ranasinghe', 'ishara.ranasinghe@example.com', 'password123', '78 Riverside, Peliyagoda', '0786543210', '1989-01-10', '2024-10-02'),
('C1029', 'Tharindu', 'Hettiarachchi', 'tharindu.hettiarachchi@example.com', 'password123', '90 Lake Road, Kotte', '0713210987', '1992-08-06', '2024-10-02'),
('C1030', 'Dilshan', 'Maduranga', 'dilshan.maduranga@example.com', 'password123', '12 Temple Road, Moratuwa', '0753210987', '1990-06-14', '2024-10-02'),
('C1031', 'Amali', 'Wijeratne', 'amali.wijeratne@example.com', 'password123', '34 Market Lane, Nugegoda', '0746543210', '1987-03-19', '2024-10-02'),
('C1032', 'Hashan', 'Dias', 'hashan.dias@example.com', 'password123', '56 High Street, Kaduwela', '0771234567', '1993-11-30', '2024-10-02'),
('C1033', 'Dilshan', 'Dias', 'dilshan.dias@example.com', 'password123', '80 High Street, Galle', '0771234567', '1987-05-06', '2024-10-07'),
('C1034', 'Thilini', 'Hettiarachchi', 'thilini.hettiarachchi@example.com', 'password123', '84 High Street, Colombo', '0772345678', '2005-06-16', '2024-10-07'),
('C1035', 'Supun', 'Silva', 'supun.silva@example.com', 'abc123', '54 High Street, Kandy', '0773456789', '1986-06-15', '2024-10-07'),
('C1036', 'Vindya', 'Senanayake', 'vindya.senanayake@example.com', 'letmein', '63 High Street, Colombo', '0774567890', '1994-04-21', '2024-10-07'),
('C1037', 'Janaka', 'Rathnayake', 'janaka.rathnayake@example.com', 'qwerty', '3 High Street, Kaduwela', '0775678901', '2003-03-11', '2024-10-07'),
('C1038', 'Tharindu', 'Mendis', 'tharindu.mendis@example.com', 'qwerty', '77 High Street, Matara', '0776789012', '2002-10-21', '2024-10-07'),
('C1039', 'Supun', 'Jayasinghe', 'supun.jayasinghe@example.com', 'abc123', '88 High Street, Kandy', '0777890123', '1999-05-17', '2024-10-07'),
('C1040', 'Ruwanthi', 'Hettiarachchi', 'ruwanthi.hettiarachchi@example.com', 'abc123', '81 High Street, Kandy', '0778901234', '1998-05-29', '2024-10-07'),
('C1041', 'Thisara', 'Weerasinghe', 'thisara.weerasinghe@example.com', 'qwerty', '68 High Street, Galle', '0779012345', '1999-05-12', '2024-10-07'),
('C1042', 'Shalini', 'Rathnayake', 'shalini.rathnayake@example.com', 'qwerty', '6 High Street, Colombo', '0770123456', '1985-01-15', '2024-10-07'),
('C1043', 'Nilanka', 'Dissanayake', 'nilanka.dissanayake@example.com', '123456', '11 High Street, Colombo', '0772345678', '1993-04-20', '2024-10-07'),
('C1044', 'Kasun', 'Dias', 'kasun.dias@example.com', 'abc123', '25 High Street, Kandy', '0773456789', '1990-12-13', '2024-10-07'),
('C1045', 'Rukshan', 'Bandara', 'rukshan.bandara@example.com', 'letmein', '14 High Street, Matara', '0774567890', '1995-07-01', '2024-10-07'),
('C1046', 'Harsha', 'Senanayake', 'harsha.senanayake@example.com', 'qwerty', '98 High Street, Colombo', '0775678901', '1994-08-30', '2024-10-07'),
('C1047', 'Amaya', 'Gunawardena', 'amaya.gunawardena@example.com', 'letmein', '40 High Street, Galle', '0776789012', '1997-10-25', '2024-10-07'),
('C1048', 'Sajith', 'Rajapaksha', 'sajith.rajapaksha@example.com', '123456', '30 High Street, Kaduwela', '0777890123', '1998-05-19', '2024-10-07'),
('C1049', 'Hasini', 'Ekanayake', 'hasini.ekanayake@example.com', 'abc123', '56 High Street, Kandy', '0778901234', '1991-11-21', '2024-10-07'),
('C1050', 'Nadeesha', 'Weerasinghe', 'nadeesha.weerasinghe@example.com', 'password123', '48 High Street, Galle', '0779012345', '1989-03-18', '2024-10-07'),
('C1051', 'Shiran', 'Fernando', 'shiran.fernando@example.com', 'qwerty', '17 High Street, Matara', '0770123456', '1990-12-30', '2024-10-07'),
('C1052', 'Sanduni', 'Perera', 'sanduni.perera@example.com', '123456', '60 High Street, Kandy', '0772345678', '1995-04-25', '2024-10-07'),
('C1053', 'Udara', 'Jayasinghe', 'udara.jayasinghe@example.com', 'letmein', '11 High Street, Kaduwela', '0773456789', '1997-09-11', '2024-10-07'),
('C1054', 'Nimali', 'Dias', 'nimali.dias@example.com', 'abc123', '45 High Street, Colombo', '0774567890', '1994-06-03', '2024-10-07'),
('C1055', 'Rangana', 'Bandara', 'rangana.bandara@example.com', 'password123', '22 High Street, Galle', '0775678901', '1986-11-07', '2024-10-07'),
('C1056', 'Lakmal', 'Rajapaksha', 'lakmal.rajapaksha@example.com', 'letmein', '10 High Street, Kandy', '0776789012', '1988-04-02', '2024-10-07'),
('C1057', 'Saman', 'Ekanayake', 'saman.ekanayake@example.com', 'qwerty', '66 High Street, Matara', '0777890123', '1999-10-19', '2024-10-07'),
('C1058', 'Chathurika', 'Fernando', 'chathurika.fernando@example.com', 'abc123', '19 High Street, Colombo', '0778901234', '1987-08-15', '2024-10-07'),
('C1059', 'Pubudu', 'Gunawardena', 'pubudu.gunawardena@example.com', 'password123', '72 High Street, Kaduwela', '0779012345', '1990-03-23', '2024-10-07'),
('C1060', 'Manjula', 'Senanayake', 'manjula.senanayake@example.com', 'letmein', '15 High Street, Kandy', '0770123456', '1985-12-05', '2024-10-07'),
('C1061', 'Lakmini', 'Bandara', 'lakmini.bandara@example.com', 'password123', '9 High Street, Galle', '0772345678', '1993-09-25', '2024-10-07'),
('C1062', 'Kasun', 'Perera', 'kasun.perera@example.com', 'qwerty', '7 High Street, Matara', '0773456789', '1989-07-16', '2024-10-07'),
('C1063', 'Sithara', 'Dias', 'sithara.dias@example.com', 'letmein', '21 High Street, Colombo', '0774567890', '1996-04-12', '2024-10-07'),
('C1064', 'Harsha', 'Rathnayake', 'harsha.rathnayake@example.com', 'qwerty', '33 High Street, Kaduwela', '0775678901', '1998-01-07', '2024-10-07'),
('C1065', 'Kalpani', 'Ekanayake', 'kalpani.ekanayake@example.com', 'password123', '39 High Street, Kandy', '0776789012', '2002-11-13', '2024-10-07'),
('C1066', 'Mahesh', 'Gunawardena', 'mahesh.gunawardena@example.com', '123456', '90 High Street, Galle', '0777890123', '1997-07-08', '2024-10-07'),
('C1067', 'Menaka', 'Fernando', 'menaka.fernando@example.com', 'abc123', '62 High Street, Matara', '0778901234', '2001-05-03', '2024-10-07'),
('C1068', 'Sudeera', 'Rajapaksha', 'sudeera.rajapaksha@example.com', 'letmein', '75 High Street, Colombo', '0779012345', '1992-08-29', '2024-10-07'),
('C1069', 'Dinusha', 'Jayasinghe', 'dinusha.jayasinghe@example.com', 'qwerty', '49 High Street, Galle', '0770123456', '1999-02-24', '2024-10-07'),
('C1070', 'Hiruni', 'Rathnayake', 'hiruni.rathnayake@example.com', 'letmein', '78 High Street, Matara', '0772345678', '1996-03-18', '2024-10-07'),
('C1071', 'Anjana', 'Weerasinghe', 'anjana.weerasinghe@example.com', 'abc123', '18 High Street, Kandy', '0773456789', '1994-01-02', '2024-10-07'),
('C1072', 'Nuwan', 'Bandara', 'nuwan.bandara@example.com', 'password123', '97 High Street, Kaduwela', '0774567890', '1985-06-27', '2024-10-07'),
('C1073', 'Dilini', 'Perera', 'dilini.perera@example.com', 'letmein', '50 High Street, Colombo', '0775678901', '1992-07-15', '2024-10-07'),
('C1074', 'Gayan', 'Dias', 'gayan.dias@example.com', 'qwerty', '61 High Street, Kandy', '0776789012', '1990-03-11', '2024-10-07'),
('C1075', 'Uditha', 'Senanayake', 'uditha.senanayake@example.com', '123456', '93 High Street, Galle', '0777890123', '1991-05-20', '2024-10-07'),
('C1076', 'Janith', 'Jayasinghe', 'janith.jayasinghe@example.com', 'letmein', '55 High Street, Colombo', '0778901234', '2000-09-30', '2024-10-07'),
('C1077', 'Iresha', 'Gunawardena', 'iresha.gunawardena@example.com', 'password123', '8 High Street, Kaduwela', '0779012345', '1997-02-11', '2024-10-07'),
('C1078', 'Tharaka', 'Fernando', 'tharaka.fernando@example.com', 'qwerty', '32 High Street, Galle', '0770123456', '1995-12-14', '2024-10-07'),
('C1079', 'Ayesh', 'Dias', 'ayesh.dias@example.com', 'letmein', '82 High Street, Kandy', '0772345678', '2003-11-26', '2024-10-07'),
('C1080', 'Nimali', 'Rajapaksha', 'nimali.rajapaksha@example.com', '123456', '16 High Street, Matara', '0773456789', '1988-01-19', '2024-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `Help`
--

CREATE TABLE `Help` (
  `Help_ID` varchar(255) NOT NULL,
  `Customer_ID` varchar(255) DEFAULT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` varchar(1000) NOT NULL,
  `Date_created` date DEFAULT curdate(),
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Inquiries`
--

CREATE TABLE `Inquiries` (
  `Inquiry_ID` varchar(50) NOT NULL,
  `Inquiry_Date` datetime NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone_no` varchar(20) NOT NULL,
  `Topic` varchar(255) NOT NULL,
  `Other` varchar(1000) DEFAULT NULL,
  `Customer_ID` varchar(255) DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE `Inventory` (
  `Product_ID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Colour` varchar(255) NOT NULL,
  `Size` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Inventory`
--

INSERT INTO `Inventory` (`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`, `Price`) VALUES
('VR-H-001', 'Hoodie', 'Yellow', 'Large', 'Cotton', '10000', 1500.00),
('VR-H-002', 'Hoodie', 'Yellow', 'Medium', 'Cotton', '10000', 1500.00),
('VR-H-003', 'Hoodie', 'Yellow', 'Small', 'Cotton', '10000', 1500.00),
('VR-H-004', 'Hoodie', 'Black', 'Large', 'Cotton', '10000', 1500.00),
('VR-H-005', 'Hoodie', 'Black', 'Medium', 'Cotton', '512', 1500.00),
('VR-H-006', 'Hoodie', 'Black', 'Small', 'Cotton', '500', 1500.00),
('VR-H-007', 'Hoodie', 'Red', 'Large', 'Cotton', '210', 1500.00),
('VR-H-008', 'Hoodie', 'Red', 'Medium', 'Cotton', '830', 1500.00),
('VR-H-009', 'Hoodie', 'Red', 'Small', 'Cotton', '578', 1500.00),
('VR-H-010', 'Hoodie', 'White', 'Large', 'Cotton', '345', 1500.00),
('VR-H-011', 'Hoodie', 'White', 'Medium', 'Cotton', '199', 1500.00),
('VR-H-012', 'Hoodie', 'White', 'Small', 'Cotton', '612', 1500.00),
('VR-J-001', 'Joggers', 'Yellow', 'Large', 'Polyester', '295', 900.00),
('VR-J-002', 'Joggers', 'Yellow', 'Medium', 'Polyester', '552', 900.00),
('VR-J-003', 'Joggers', 'Blue', 'Large', 'Polyester', '498', 900.00),
('VR-J-004', 'Joggers', 'Blue', 'Medium', 'Polyester', '693', 900.00),
('VR-J-005', 'Joggers', 'Red', 'Large', 'Polyester', '487', 900.00),
('VR-J-006', 'Joggers', 'Red', 'Medium', 'Polyester', '612', 900.00),
('VR-J-007', 'Joggers', 'White', 'Large', 'Polyester', '724', 900.00),
('VR-J-008', 'Joggers', 'White', 'Medium', 'Polyester', '309', 900.00),
('VR-LT-001', 'Long Sleeve T', 'Blue', 'Large', 'Cotton', '234', 1000.00),
('VR-LT-002', 'Long Sleeve T', 'Blue', 'Medium', 'Cotton', '436', 1000.00),
('VR-LT-003', 'Long Sleeve T', 'Blue', 'Small', 'Cotton', '312', 1000.00),
('VR-LT-004', 'Long Sleeve T', 'White', 'Large', 'Cotton', '642', 1000.00),
('VR-LT-005', 'Long Sleeve T', 'White', 'Medium', 'Cotton', '720', 1000.00),
('VR-LT-006', 'Long Sleeve T', 'White', 'Small', 'Cotton', '550', 1000.00),
('VR-TS-001', 'T-Shirt', 'Yellow', 'Extra-Large', 'Cotton', '482', 800.00),
('VR-TS-002', 'T-Shirt', 'Yellow', 'Large', 'Cotton', '329', 800.00),
('VR-TS-003', 'T-Shirt', 'Yellow', 'Medium', 'Cotton', '754', 800.00),
('VR-TS-004', 'T-Shirt', 'Yellow', 'Small', 'Cotton', '216', 800.00),
('VR-TS-005', 'T-Shirt', 'Blue', 'Extra-Large', 'Cotton', '508', 800.00),
('VR-TS-006', 'T-Shirt', 'Blue', 'Large', 'Cotton', '244', 800.00),
('VR-TS-007', 'T-Shirt', 'Blue', 'Medium', 'Cotton', '670', 800.00),
('VR-TS-008', 'T-Shirt', 'Blue', 'Small', 'Cotton', '448', 800.00),
('VR-TS-009', 'T-Shirt', 'Red', 'Extra-Large', 'Cotton', '539', 800.00),
('VR-TS-010', 'T-Shirt', 'Red', 'Large', 'Cotton', '330', 800.00),
('VR-TS-011', 'T-Shirt', 'Red', 'Medium', 'Cotton', '759', 800.00),
('VR-TS-012', 'T-Shirt', 'Red', 'Small', 'Cotton', '482', 800.00),
('VR-TS-013', 'T-Shirt', 'White', 'Extra-Large', 'Cotton', '378', 800.00),
('VR-TS-014', 'T-Shirt', 'White', 'Large', 'Cotton', '610', 800.00),
('VR-TS-015', 'T-Shirt', 'White', 'Medium', 'Cotton', '482', 800.00),
('VR-TS-016', 'T-Shirt', 'White', 'Small', 'Cotton', '599', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `Order_ID` varchar(255) NOT NULL,
  `Customer_ID` varchar(255) DEFAULT NULL,
  `Product_ID` varchar(255) DEFAULT NULL,
  `Order_Date` date NOT NULL,
  `Delivery_Date` date DEFAULT NULL,
  `Order_type` varchar(255) DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  `Payment_ID` varchar(255) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`Order_ID`, `Customer_ID`, `Product_ID`, `Order_Date`, `Delivery_Date`, `Order_type`, `Status`, `Payment_ID`, `Quantity`) VALUES
('O1017', 'C1000', 'VR-H-006', '2024-10-06', '2024-10-13', 'Wholesale', 'In-Progress', 'PAY-007', 50),
('O1018', 'C1000', 'VR-H-006', '2024-10-06', '2024-10-13', 'Wholesale', 'In-Progress', 'PAY-008', 65),
('O1019', 'C1000', 'VR-J-002', '2024-10-06', '2024-10-13', 'Wholesale', 'In-Progress', 'PAY-009', 60),
('O1020', 'C1000', 'VR-J-004', '2024-10-06', '2024-10-13', 'Wholesale', 'In-Progress', 'PAY-010', 60),
('O1021', 'C1000', 'VR-LT-002', '2024-10-06', '2024-10-13', 'Wholesale', 'In-Progress', 'PAY-011', 51),
('O1022', 'C1000', 'VR-TS-005', '2024-10-06', '2024-10-13', 'Wholesale', 'In-Progress', 'PAY-012', 52),
('O1023', 'C1000', 'VR-TS-005', '2024-10-07', '2024-10-14', 'Wholesale', 'Shipped', 'PAY-013', 50),
('O1024', 'C1000', 'VR-TS-006', '2024-10-07', '2024-10-14', 'Wholesale', 'In-Progress', 'PAY-014', 50),
('O1025', 'C1007', 'VR-H-006', '2024-10-07', '2024-10-14', 'Wholesale', 'In-Progress', 'PAY-015', 50),
('O1026', 'C1017', 'VR-H-006', '2024-10-07', '2024-10-14', 'Wholesale', 'In-Progress', 'PAY-016', 50);

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `Payment_ID` varchar(255) NOT NULL,
  `Payment_date` datetime DEFAULT current_timestamp(),
  `Payment_amount` decimal(10,2) NOT NULL,
  `Payment_method` varchar(255) NOT NULL,
  `Transaction_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Payments`
--

INSERT INTO `Payments` (`Payment_ID`, `Payment_date`, `Payment_amount`, `Payment_method`, `Transaction_id`) VALUES
('PAY-001', '2024-10-06 03:49:58', 68750.00, 'credit_card', 'TX1469'),
('PAY-002', '2024-10-06 05:21:03', 97625.00, 'other', 'TX2058'),
('PAY-003', '2024-10-06 05:28:42', 82500.00, 'other', 'TX9358'),
('PAY-004', '2024-10-06 05:32:59', 137500.00, 'other', 'TX5619'),
('PAY-005', '2024-10-06 17:13:23', 100375.00, 'credit_card', 'TX1970'),
('PAY-006', '2024-10-06 17:13:52', 100375.00, 'credit_card', 'TX7198'),
('PAY-007', '2024-10-06 17:15:59', 68750.00, 'other', 'TX8762'),
('PAY-008', '2024-10-06 17:17:37', 89375.00, 'credit_card', 'TX7809'),
('PAY-009', '2024-10-06 18:21:54', 50100.00, 'credit_card', 'TX9512'),
('PAY-010', '2024-10-06 18:26:57', 50100.00, 'other', 'TX3325'),
('PAY-011', '2024-10-06 18:33:07', 47175.00, 'credit_card', 'TX3802'),
('PAY-012', '2024-10-06 18:40:29', 38740.00, 'other', 'TX8165'),
('PAY-013', '2024-10-07 04:09:30', 37250.00, 'credit_card', 'TX1350'),
('PAY-014', '2024-10-07 13:54:21', 37250.00, 'credit_card', 'TX4927'),
('PAY-015', '2024-10-07 13:56:44', 68750.00, 'credit_card', 'TX8869'),
('PAY-016', '2024-10-07 15:18:40', 68750.00, 'credit_card', 'TX9285');

-- --------------------------------------------------------

--
-- Table structure for table `sales_target`
--

CREATE TABLE `sales_target` (
  `id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `achieved_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_target`
--

INSERT INTO `sales_target` (`id`, `month`, `target_amount`, `achieved_amount`) VALUES
(1, 'October', 3000000.00, 1074615.00);

-- --------------------------------------------------------

--
-- Table structure for table `Shipping_details`
--

CREATE TABLE `Shipping_details` (
  `Shipping_ID` int(11) NOT NULL,
  `Customer_ID` varchar(255) NOT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Full_name` varchar(255) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Apartment` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `Zip` varchar(50) DEFAULT NULL,
  `Payment_method` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Shipping_details`
--

INSERT INTO `Shipping_details` (`Shipping_ID`, `Customer_ID`, `Country`, `Full_name`, `Mobile`, `Address`, `Apartment`, `City`, `Province`, `Zip`, `Payment_method`) VALUES
(1, 'C1000', 'USA', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'province2', '71500', 'credit_card'),
(2, 'C1000', 'USA', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'province2', '71500', 'other'),
(3, 'C1000', 'USA', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'province1', '71500', 'other'),
(4, 'C1000', 'USA', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'province1', '71500', 'other'),
(7, 'C1000', 'AF', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'other'),
(8, 'C1000', 'BD', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card'),
(9, 'C1000', 'BD', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card'),
(10, 'C1000', 'IN', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'other'),
(11, 'C1000', 'AF', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card'),
(12, 'C1000', 'BD', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'other'),
(13, 'C1000', 'BD', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card'),
(14, 'C1000', 'AF', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card'),
(15, 'C1007', 'BD', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card'),
(16, 'C1017', 'BD', 'Yoosuf Ahamed', '0763073009', 'No:63, Hemmathagama Road, Mawanella', 'Apt', 'Mawanella', 'Central', '71500', 'credit_card');

-- --------------------------------------------------------

--
-- Table structure for table `Staff_account`
--

CREATE TABLE `Staff_account` (
  `Staff_ID` varchar(255) NOT NULL,
  `Full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `staff_role` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Staff_account`
--

INSERT INTO `Staff_account` (`Staff_ID`, `Full_name`, `username`, `staff_role`, `Email`, `Password`, `Date_created`) VALUES
('STF0004', 'Dilshan Perera', 'dilshan_perera', 'Admin', 'dilshan.perera@example.com', 'pass123', '2024-10-07'),
('STF0005', 'Thilini Jayasinghe', 'thilini_jayasinghe', 'Inventory', 'thilini.jayasinghe@example.com', 'pass123', '2024-10-07'),
('STF0006', 'Supun Fernando', 'supun_fernando', 'Support', 'supun.fernando@example.com', 'pass123', '2024-10-07'),
('STF0007', 'Rukshan Mendis', 'rukshan_mendis', 'Admin', 'rukshan.mendis@example.com', 'pass123', '2024-10-07'),
('STF0008', 'Lakshmi Dias', 'lakshmi_dias', 'Inventory', 'lakshmi.dias@example.com', 'pass123', '2024-10-07'),
('STF0009', 'Hiruni Senanayake', 'hiruni_senanayake', 'Support', 'hiruni.senanayake@example.com', 'pass123', '2024-10-07'),
('STF0010', 'Chathura Gunawardena', 'chathura_gunawardena', 'Admin', 'chathura.gunawardena@example.com', 'pass123', '2024-10-07'),
('STF0011', 'Nimali Rajapaksha', 'nimali_rajapaksha', 'Inventory', 'nimali.rajapaksha@example.com', 'pass123', '2024-10-07'),
('STF0012', 'Pubudu Ekanayake', 'pubudu_ekanayake', 'Support', 'pubudu.ekanayake@example.com', 'pass123', '2024-10-07'),
('STF0013', 'Amaya Hettiarachchi', 'amaya_hettiarachchi', 'Admin', 'amaya.hettiarachchi@example.com', 'pass123', '2024-10-07'),
('STF0014', 'Anjana Weerasinghe', 'anjana_weerasinghe', 'Inventory', 'anjana.weerasinghe@example.com', 'pass123', '2024-10-07'),
('STF0015', 'Dilini Rajapaksha', 'dilini_rajapaksha', 'Support', 'dilini.rajapaksha@example.com', 'pass123', '2024-10-07'),
('STF0016', 'Shiran Dias', 'shiran_dias', 'Admin', 'shiran.dias@example.com', 'pass123', '2024-10-07'),
('STF0017', 'Kasun Mendis', 'kasun_mendis', 'Inventory', 'kasun.mendis@example.com', 'pass123', '2024-10-07'),
('STF0018', 'Iresha Gunawardena', 'iresha_gunawardena', 'Support', 'iresha.gunawardena@example.com', 'pass123', '2024-10-07'),
('STF0019', 'Saman Fernando', 'saman_fernando', 'Admin', 'saman.fernando@example.com', 'pass123', '2024-10-07'),
('STF0020', 'Gayan Perera', 'gayan_perera', 'Inventory', 'gayan.perera@example.com', 'pass123', '2024-10-07'),
('STF0021', 'Tharindu Jayasinghe', 'tharindu_jayasinghe', 'Support', 'tharindu.jayasinghe@example.com', 'pass123', '2024-10-07'),
('STF0022', 'Admin', 'admin', 'Admin', 'a@gmail.com', '123', '2024-10-07'),
('STF0023', 'Inventory', 'inventory', 'Inventory', 'i@gmail.com', '123', '2024-10-07'),
('STF0024', 'Customer Support', 'customer', 'Support', 'c@gmail.com', '123', '2024-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `Supplier`
--

CREATE TABLE `Supplier` (
  `Supplier_ID` varchar(255) NOT NULL,
  `Supplier_name` varchar(255) NOT NULL,
  `Company_name` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone_number` varchar(255) NOT NULL,
  `Supply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Supplier`
--

INSERT INTO `Supplier` (`Supplier_ID`, `Supplier_name`, `Company_name`, `Category`, `Email`, `Phone_number`, `Supply`) VALUES
('S001', 'Textile Solutionsx', 'Textile Co.', 'Fabrics', 'info@textilesolutions.com', '101-234-5678', 'Cotton Fabric'),
('S002', 'Fashion Threads', 'Threads Inc.', 'Threads', 'contact@fashionthreads.com', '102-345-6789', 'Polyester Thread'),
('S003', 'Dye Works', 'Color Masters', 'Dyes', 'support@dyeworks.com', '103-456-7890', 'Natural Dyes'),
('S004', 'Button Bazaar', 'Button Emporium', 'Notions', 'sales@buttonbazaar.com', '104-567-8901', 'Buttons & Fasteners'),
('S005', 'Sewing Supplies', 'Sewing World', 'Sewing Tools', 'hello@sewingsupplies.com', '105-678-9012', 'Sewing Machines'),
('S006', 'Fabric Warehouse', 'Warehouse Fabrics', 'Fabrics', 'sales@fabricwarehouse.com', '106-789-0123', 'Silk Fabric'),
('S007', 'Garment Accessories', 'Accessory Hub', 'Accessories', 'info@garmentaccessories.com', '107-890-1234', 'Zippers'),
('S008', 'Pattern Pros', 'Pattern Makers', 'Patterns', 'contact@patternpros.com', '108-901-2345', 'Sewing Patterns'),
('S009', 'Material Masters', 'Material Supply Co.', 'Fabrics', 'support@materialmasters.com', '109-012-3457', 'Linen Fabric'),
('S010', 'Cutting Edge', 'Cutting Supplies', 'Tools', 'info@cuttingedge.com', '110-123-4567', 'Cutting Tools'),
('S012', 'James', 'FLetpp', 'Loom', 'Juniorj@gamil.com', '093131313', 'Asooan'),
('S013', 'James', 'FLetpp', 'sasa', 'ASA@apple.com', '109-012-3457', 'Asooan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Consultation`
--
ALTER TABLE `Consultation`
  ADD PRIMARY KEY (`Consultation_ID`),
  ADD KEY `fk_consultation_customer` (`Customer_ID`);

--
-- Indexes for table `Customer_account`
--
ALTER TABLE `Customer_account`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `Help`
--
ALTER TABLE `Help`
  ADD PRIMARY KEY (`Help_ID`),
  ADD KEY `fk_help_customer` (`Customer_ID`);

--
-- Indexes for table `Inquiries`
--
ALTER TABLE `Inquiries`
  ADD PRIMARY KEY (`Inquiry_ID`),
  ADD KEY `fk_customer` (`Customer_ID`);

--
-- Indexes for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD KEY `Orders_FK1` (`Customer_ID`),
  ADD KEY `Orders_FK2` (`Product_ID`),
  ADD KEY `Orders_FK3` (`Payment_ID`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD UNIQUE KEY `Transaction_id` (`Transaction_id`);

--
-- Indexes for table `sales_target`
--
ALTER TABLE `sales_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Shipping_details`
--
ALTER TABLE `Shipping_details`
  ADD PRIMARY KEY (`Shipping_ID`),
  ADD KEY `Shipping_details_FK1` (`Customer_ID`);

--
-- Indexes for table `Staff_account`
--
ALTER TABLE `Staff_account`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Indexes for table `Supplier`
--
ALTER TABLE `Supplier`
  ADD PRIMARY KEY (`Supplier_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_target`
--
ALTER TABLE `sales_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Shipping_details`
--
ALTER TABLE `Shipping_details`
  MODIFY `Shipping_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Consultation`
--
ALTER TABLE `Consultation`
  ADD CONSTRAINT `fk_consultation_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer_account` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Help`
--
ALTER TABLE `Help`
  ADD CONSTRAINT `fk_help_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer_account` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Inquiries`
--
ALTER TABLE `Inquiries`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer_account` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_FK1` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer_account` (`Customer_ID`),
  ADD CONSTRAINT `Orders_FK2` FOREIGN KEY (`Product_ID`) REFERENCES `Inventory` (`Product_ID`),
  ADD CONSTRAINT `Orders_FK3` FOREIGN KEY (`Payment_ID`) REFERENCES `Payments` (`Payment_ID`);

--
-- Constraints for table `Shipping_details`
--
ALTER TABLE `Shipping_details`
  ADD CONSTRAINT `Shipping_details_FK1` FOREIGN KEY (`Customer_ID`) REFERENCES `Customer_account` (`Customer_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
