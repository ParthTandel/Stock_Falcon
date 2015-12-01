-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2015 at 02:38 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stockfalcon`
--

-- --------------------------------------------------------

--
-- Table structure for table `1_portfolio`
--

CREATE TABLE IF NOT EXISTS `1_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT '0',
  `threshold_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `1_watchlist`
--

CREATE TABLE IF NOT EXISTS `1_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `19c1c5e85f3526a169ee3b1fe86308_portfolio`
--

CREATE TABLE IF NOT EXISTS `19c1c5e85f3526a169ee3b1fe86308_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `cost_price` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `19c1c5e85f3526a169ee3b1fe86308_watchlist`
--

CREATE TABLE IF NOT EXISTS `19c1c5e85f3526a169ee3b1fe86308_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` int(11) NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `332ba953520a8576f1c4d85b8734a1_portfolio`
--

CREATE TABLE IF NOT EXISTS `332ba953520a8576f1c4d85b8734a1_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `cost_price` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `332ba953520a8576f1c4d85b8734a1_portfolio`
--

INSERT INTO `332ba953520a8576f1c4d85b8734a1_portfolio` (`stock_ticker`, `quantity`, `cost_price`, `stock_name`) VALUES
('BHEL', 10, 1000, 'Bharat Heavy Electricals Ltd.');

-- --------------------------------------------------------

--
-- Table structure for table `332ba953520a8576f1c4d85b8734a1_watchlist`
--

CREATE TABLE IF NOT EXISTS `332ba953520a8576f1c4d85b8734a1_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` int(11) NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admins_info`
--

CREATE TABLE IF NOT EXISTS `admins_info` (
  `admin_id` int(100) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b02afc9599498ac918ebb8d803110d_portfolio`
--

CREATE TABLE IF NOT EXISTS `b02afc9599498ac918ebb8d803110d_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `cost_price` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b02afc9599498ac918ebb8d803110d_portfolio`
--

INSERT INTO `b02afc9599498ac918ebb8d803110d_portfolio` (`stock_ticker`, `quantity`, `cost_price`, `stock_name`) VALUES
('AMBUJACEM', 10, 120, 'Ambuja Cements Ltd.'),
('ACC', 10, 1000, 'ACC Limited');

-- --------------------------------------------------------

--
-- Table structure for table `b02afc9599498ac918ebb8d803110d_watchlist`
--

CREATE TABLE IF NOT EXISTS `b02afc9599498ac918ebb8d803110d_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` int(11) NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b02afc9599498ac918ebb8d803110d_watchlist`
--

INSERT INTO `b02afc9599498ac918ebb8d803110d_watchlist` (`stock_ticker`, `hit_value`, `stock_name`) VALUES
('ACC', 0, 'ACC Limited'),
('AMBUJACEM', 0, 'Ambuja Cements Ltd.');

-- --------------------------------------------------------

--
-- Table structure for table `b3907229056c747d26138ed90862f6_portfolio`
--

CREATE TABLE IF NOT EXISTS `b3907229056c747d26138ed90862f6_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `cost_price` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b3907229056c747d26138ed90862f6_portfolio`
--

INSERT INTO `b3907229056c747d26138ed90862f6_portfolio` (`stock_ticker`, `quantity`, `cost_price`, `stock_name`) VALUES
('ASIANPAINT\n', 45, 45, 'Asian Paints Ltd.\n'),
('BANKBARODA\n', 5, 151, 'Bank of Baroda\n'),
('AXISBANK\n', 25, 50, 'Axis Bank Ltd.\n'),
('ACC\n', 42, 20, 'ACC Ltd.\n');

-- --------------------------------------------------------

--
-- Table structure for table `b3907229056c747d26138ed90862f6_watchlist`
--

CREATE TABLE IF NOT EXISTS `b3907229056c747d26138ed90862f6_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b3907229056c747d26138ed90862f6_watchlist`
--

INSERT INTO `b3907229056c747d26138ed90862f6_watchlist` (`stock_ticker`, `hit_value`, `stock_name`) VALUES
('HINDALCO\n', 788.6, 'Hindalco Industries Ltd.\n'),
('BPCL\n', 897.63, 'Bharat Petroleum Corporation Ltd.\n'),
('AXISBANK\n', 785.6, 'Axis Bank Ltd.\n');

-- --------------------------------------------------------

--
-- Table structure for table `cc1fa7bc5957188bc3da672819d339_portfolio`
--

CREATE TABLE IF NOT EXISTS `cc1fa7bc5957188bc3da672819d339_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `cost_price` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc1fa7bc5957188bc3da672819d339_watchlist`
--

CREATE TABLE IF NOT EXISTS `cc1fa7bc5957188bc3da672819d339_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d7d2730e13f99a4452fd6bf3d362c2_portfolio`
--

CREATE TABLE IF NOT EXISTS `d7d2730e13f99a4452fd6bf3d362c2_portfolio` (
  `stock_ticker` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '0',
  `cost_price` double NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d7d2730e13f99a4452fd6bf3d362c2_portfolio`
--

INSERT INTO `d7d2730e13f99a4452fd6bf3d362c2_portfolio` (`stock_ticker`, `quantity`, `cost_price`, `stock_name`) VALUES
('GRASIM', 5, 100, 'Grasim Industries Ltd.');

-- --------------------------------------------------------

--
-- Table structure for table `d7d2730e13f99a4452fd6bf3d362c2_watchlist`
--

CREATE TABLE IF NOT EXISTS `d7d2730e13f99a4452fd6bf3d362c2_watchlist` (
  `stock_ticker` varchar(20) NOT NULL,
  `hit_value` int(11) NOT NULL,
  `stock_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d7d2730e13f99a4452fd6bf3d362c2_watchlist`
--

INSERT INTO `d7d2730e13f99a4452fd6bf3d362c2_watchlist` (`stock_ticker`, `hit_value`, `stock_name`) VALUES
('GRASIM', 0, 'Grasim Industries Ltd.');

-- --------------------------------------------------------

--
-- Table structure for table `last`
--

CREATE TABLE IF NOT EXISTS `last` (
  `stock_ticker` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last`
--

INSERT INTO `last` (`stock_ticker`, `id`, `counter`) VALUES
('GRASIM', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE IF NOT EXISTS `personal_info` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `timestamp` text NOT NULL,
  `auth_key` varchar(300) NOT NULL,
  `auth_status` varchar(10) NOT NULL DEFAULT 'FALSE',
  `cookie` varchar(30) NOT NULL,
`user_id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`first_name`, `last_name`, `password`, `birthdate`, `email`, `gender`, `timestamp`, `auth_key`, `auth_status`, `cookie`, `user_id`, `type`) VALUES
('Parth', 'Tandel', '99e5cb0fc1b13cb3b5c2f606b8a9edd3f24297c9038e2a8615ed2353de1f5d650405e10403c92bb014f771bf2c004c89c08ba649e0e405246295685e87cd83f2', '1994-10-05', 'parthtandel0594@gmail.com', 'MALE', '1429030729', '7d4d93b4fb2f0e9306e208d5a4259284a2d2eea8', 'TRUE', 'b3907229056c747d26138ed90862f6', 20, 'ADMIN'),
('Pal', 'Doshi', '9f58b1de55381388467438227111d2b623cdb589e058a08b87457d5ece0ec68a9080279169d1581b2acb28c8b63adb11b818321779acf2d4441495de84779847', '1994-04-26', 'pal2694@gmail.com', 'FEMALE', '1428416610', '84201547bd0596036c7b34d63b4c9abb6208a1d3', 'TRUE', 'cc1fa7bc5957188bc3da672819d339', 21, 'USER'),
('Parth', 'Tandel', 'a6cbc16eb598fe85b7478a4da323e020acb922d67c33477b3bc7670df21b937cb8355ac3a87863cd816ed3f5156decfd675b83d872dfb1693eb2bc03bb66f8c6', '1994-10-05', '201201116@daiict.ac.in', 'MALE', '1429030373', '5ccc84188472fa3193729a9b6f972aa21fc736f5', 'TRUE', 'b02afc9599498ac918ebb8d803110d', 24, 'USER'),
('Kuntesh', 'Udhas', '93df4fc810a4bf0cd05b3ee0923675aaaec84ae25fb97bb7622b8c86e4b0bb35d38bc44f1a8ebfa028dc173d0c203c332d19374b4ce363e35ac2e46fcb3a7079', '1995-05-03', 'kunteshudhas@gmail.com', 'MALE', '1429010570', '70151a9dcae0d328c02d1b72c16ddfde9e1f9357', 'FALSE', '82a1828ca600c208800c5dcb0a004e', 26, 'USER'),
('IRS', 'CIT', '6718add461a88d1b799dbcb509bd3e4393f7691146bf051c78e279af365af20402d04d40e2803e49b35f97d45e8e763f4a34ce860c98d68f5d49d9c31925c808', '1995-03-09', '201201115@daiict.ac.in', 'MALE', '1429036639', '1ef5ac5f675a14407e37d9b75de8eb692e96e810', 'TRUE', 'd7d2730e13f99a4452fd6bf3d362c2', 27, 'USER'),
('Bansari', 'Rao', '514aabda269e199c2e227a530a5857a9dc4a3e5dac48c380aac578e3ef4d2e715448f29dbbf142bd5fa0222cedf45f1961f3d66c678f8ca1c5c909c6a65cac32', '1994-08-29', '201201098@daiict.ac.in', 'FEMALE', '1429101156', '4b5320a34f8e84b9c1d9515dbba8d0ec3aaf58b2', 'TRUE', '332ba953520a8576f1c4d85b8734a1', 28, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `prediction`
--

CREATE TABLE IF NOT EXISTS `prediction` (
  `stock_ticker` varchar(200) NOT NULL,
  `stock_name` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `predicted_value` double NOT NULL,
  `confidence_value` double NOT NULL,
  `sell_poll` int(11) NOT NULL,
  `buy_poll` int(11) NOT NULL,
  `hold_poll` int(11) NOT NULL,
  `difference` double NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prediction`
--

INSERT INTO `prediction` (`stock_ticker`, `stock_name`, `timestamp`, `predicted_value`, `confidence_value`, `sell_poll`, `buy_poll`, `hold_poll`, `difference`, `counter`) VALUES
('ACC', 'ACC Limited', '2015-04-10 15:10:04', 1648.2275, 40.625, 0, 0, 1, 52.02752957011148, 1),
('AMBUJACEM', 'Ambuja Cements Ltd.', '2015-04-09 13:18:56', 259.4743, 53.125, 0, 0, 0, 1.8742844626377746, 1),
('AXISBANK', 'Axis Bank Ltd.', '2015-04-09 13:18:56', 575.5661, 53.125, 0, 0, 0, 9.566054334379373, 0),
('BHEL', 'Bharat Heavy Electricals Ltd.', '2015-04-09 13:20:37', 232.0087, 53.125, 0, 0, 0, -10.641268819117784, 1),
('BPCL', 'Bharat Petroleum Corporation Ltd.', '2015-04-09 13:20:37', 822.6981, 46.875, 0, 0, 0, 4.298076922198447, 0),
('CAIRN', 'Cairn India Ltd.', '2015-04-09 13:20:37', 224.1128, 43.75, 0, 0, 0, -3.5371957989062537, 0),
('CIPLA', 'Cipla Ltd.', '2015-04-09 13:20:37', 693.9788, 46.875, 0, 0, 0, -18.42121004599892, 0),
('COALINDIA', 'Coal India Ltd.', '2015-04-09 13:20:37', 386.2364, 43.75, 0, 0, 0, -6.113586749976889, 0),
('DRREDDY', 'Dr. Reddy''s Laboratories Ltd.', '2015-04-09 13:20:37', 3773.6904, 40.625, 0, 0, 0, -21.659617701956904, 0),
('GAIL', 'GAIL (India) Ltd.', '2015-04-09 13:20:37', 396.7737, 40.625, 0, 0, 0, 1.5237050176742173, 0),
('GRASIM', 'Grasim Industries Ltd.', '2015-04-09 13:20:37', 3836.2619, 56.25, 0, 0, 0, 55.76192230609195, 1),
('HCLTECH', 'HCL Technologies Ltd.', '2015-04-09 13:20:37', 10, 0, 0, 0, 0, 0, 0),
('HDFC', 'Housing Development Finance Corporation Limited', '2015-04-10 18:49:26', 0, 0, 0, 0, 0, 0, 0),
('HDFCBANK', 'HDFC Bank Ltd.', '2015-04-09 13:20:37', 10, 0, 0, 0, 0, 0, 0),
('HINDALCO', 'Hindalco Industries Ltd.', '2015-04-09 13:20:37', 10, 0, 0, 0, 0, 0, 0),
('ICICIBANK', 'ICICI Bank Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('IDEA', 'Idea Cellular Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('IDFC', 'IDFC Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('INFY', 'Infosys Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('ITC', 'I T C Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('KOTAKBANK', 'Kotak Mahindra Bank Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('LT', 'Larsen & Toubro Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('LUPIN', 'Lupin Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('M&M', 'Mahindra & Mahindra Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('MARUTI', 'Maruti Suzuki India Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('NMDC', 'NMDC Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('NTPC', 'NTPC Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('ONGC', 'Oil & Natural Gas Corporation Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('PNB', 'Punjab National Bank', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('POWERGRID', 'Power Grid Corporation of India Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('RELIANCE', 'Reliance Industries Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('SBIN', 'State Bank of India', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('SSLT', 'Sesa Sterlite Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('SUNPHARMA', 'Sun Pharmaceutical Industries Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('TATAPOWER', 'Tata Power Co. Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('TATASTEEL', 'Tata Steel Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('TCS', 'Tata Consultancy Services Limited', '2015-04-10 16:14:59', 0, 0, 0, 0, 0, 0, 0),
('TECHM', 'Tech Mahindra Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('WIPRO', 'Wipro Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('YESBANK', 'Yes Bank Ltd.', '2015-04-09 13:20:38', 10, 0, 0, 0, 0, 0, 0),
('ZEEL', 'Zee Entertainment Enterprises Ltd.', '2015-04-10 15:43:53', 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `timers`
--

CREATE TABLE IF NOT EXISTS `timers` (
  `prediction_timer` int(11) NOT NULL,
  `update_timer` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timers`
--

INSERT INTO `timers` (`prediction_timer`, `update_timer`, `id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `user_id` int(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `button_clicked` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_acc`
--

CREATE TABLE IF NOT EXISTS `vote_acc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vote_acc`
--

INSERT INTO `vote_acc` (`cookie`) VALUES
('332ba953520a8576f1c4d85b8734a1');

-- --------------------------------------------------------

--
-- Table structure for table `vote_ambujacem`
--

CREATE TABLE IF NOT EXISTS `vote_ambujacem` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_axisbank`
--

CREATE TABLE IF NOT EXISTS `vote_axisbank` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_bhel`
--

CREATE TABLE IF NOT EXISTS `vote_bhel` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_bpcl`
--

CREATE TABLE IF NOT EXISTS `vote_bpcl` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_cairn`
--

CREATE TABLE IF NOT EXISTS `vote_cairn` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_cipla`
--

CREATE TABLE IF NOT EXISTS `vote_cipla` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_coalindia`
--

CREATE TABLE IF NOT EXISTS `vote_coalindia` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_drreddy`
--

CREATE TABLE IF NOT EXISTS `vote_drreddy` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_gail`
--

CREATE TABLE IF NOT EXISTS `vote_gail` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_grasim`
--

CREATE TABLE IF NOT EXISTS `vote_grasim` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_hcltech`
--

CREATE TABLE IF NOT EXISTS `vote_hcltech` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_hdfc`
--

CREATE TABLE IF NOT EXISTS `vote_hdfc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_hdfcbank`
--

CREATE TABLE IF NOT EXISTS `vote_hdfcbank` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_hindalco`
--

CREATE TABLE IF NOT EXISTS `vote_hindalco` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_icicibank`
--

CREATE TABLE IF NOT EXISTS `vote_icicibank` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_idea`
--

CREATE TABLE IF NOT EXISTS `vote_idea` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_idfc`
--

CREATE TABLE IF NOT EXISTS `vote_idfc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_infy`
--

CREATE TABLE IF NOT EXISTS `vote_infy` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_itc`
--

CREATE TABLE IF NOT EXISTS `vote_itc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_kotakbank`
--

CREATE TABLE IF NOT EXISTS `vote_kotakbank` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_lt`
--

CREATE TABLE IF NOT EXISTS `vote_lt` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_lupin`
--

CREATE TABLE IF NOT EXISTS `vote_lupin` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_m&m`
--

CREATE TABLE IF NOT EXISTS `vote_m&m` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_maruti`
--

CREATE TABLE IF NOT EXISTS `vote_maruti` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_nmdc`
--

CREATE TABLE IF NOT EXISTS `vote_nmdc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_ntpc`
--

CREATE TABLE IF NOT EXISTS `vote_ntpc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_ongc`
--

CREATE TABLE IF NOT EXISTS `vote_ongc` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_pnb`
--

CREATE TABLE IF NOT EXISTS `vote_pnb` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_powergrid`
--

CREATE TABLE IF NOT EXISTS `vote_powergrid` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_reliance`
--

CREATE TABLE IF NOT EXISTS `vote_reliance` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_sbin`
--

CREATE TABLE IF NOT EXISTS `vote_sbin` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_sslt`
--

CREATE TABLE IF NOT EXISTS `vote_sslt` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_sunpharma`
--

CREATE TABLE IF NOT EXISTS `vote_sunpharma` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_tatapower`
--

CREATE TABLE IF NOT EXISTS `vote_tatapower` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_tatasteel`
--

CREATE TABLE IF NOT EXISTS `vote_tatasteel` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_tcs`
--

CREATE TABLE IF NOT EXISTS `vote_tcs` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_techm`
--

CREATE TABLE IF NOT EXISTS `vote_techm` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_wipro`
--

CREATE TABLE IF NOT EXISTS `vote_wipro` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_yesbank`
--

CREATE TABLE IF NOT EXISTS `vote_yesbank` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vote_zeel`
--

CREATE TABLE IF NOT EXISTS `vote_zeel` (
  `cookie` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `19c1c5e85f3526a169ee3b1fe86308_portfolio`
--
ALTER TABLE `19c1c5e85f3526a169ee3b1fe86308_portfolio`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `19c1c5e85f3526a169ee3b1fe86308_watchlist`
--
ALTER TABLE `19c1c5e85f3526a169ee3b1fe86308_watchlist`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `332ba953520a8576f1c4d85b8734a1_portfolio`
--
ALTER TABLE `332ba953520a8576f1c4d85b8734a1_portfolio`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `332ba953520a8576f1c4d85b8734a1_watchlist`
--
ALTER TABLE `332ba953520a8576f1c4d85b8734a1_watchlist`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `admins_info`
--
ALTER TABLE `admins_info`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `b02afc9599498ac918ebb8d803110d_portfolio`
--
ALTER TABLE `b02afc9599498ac918ebb8d803110d_portfolio`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `b02afc9599498ac918ebb8d803110d_watchlist`
--
ALTER TABLE `b02afc9599498ac918ebb8d803110d_watchlist`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `cc1fa7bc5957188bc3da672819d339_portfolio`
--
ALTER TABLE `cc1fa7bc5957188bc3da672819d339_portfolio`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `cc1fa7bc5957188bc3da672819d339_watchlist`
--
ALTER TABLE `cc1fa7bc5957188bc3da672819d339_watchlist`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `d7d2730e13f99a4452fd6bf3d362c2_portfolio`
--
ALTER TABLE `d7d2730e13f99a4452fd6bf3d362c2_portfolio`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `d7d2730e13f99a4452fd6bf3d362c2_watchlist`
--
ALTER TABLE `d7d2730e13f99a4452fd6bf3d362c2_watchlist`
 ADD KEY `stock_ticker` (`stock_ticker`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `prediction`
--
ALTER TABLE `prediction`
 ADD PRIMARY KEY (`stock_ticker`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `19c1c5e85f3526a169ee3b1fe86308_portfolio`
--
ALTER TABLE `19c1c5e85f3526a169ee3b1fe86308_portfolio`
ADD CONSTRAINT `19c1c5e85f3526a169ee3b1fe86308_portfolio_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `19c1c5e85f3526a169ee3b1fe86308_watchlist`
--
ALTER TABLE `19c1c5e85f3526a169ee3b1fe86308_watchlist`
ADD CONSTRAINT `19c1c5e85f3526a169ee3b1fe86308_watchlist_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `332ba953520a8576f1c4d85b8734a1_portfolio`
--
ALTER TABLE `332ba953520a8576f1c4d85b8734a1_portfolio`
ADD CONSTRAINT `332ba953520a8576f1c4d85b8734a1_portfolio_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `332ba953520a8576f1c4d85b8734a1_watchlist`
--
ALTER TABLE `332ba953520a8576f1c4d85b8734a1_watchlist`
ADD CONSTRAINT `332ba953520a8576f1c4d85b8734a1_watchlist_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `b02afc9599498ac918ebb8d803110d_portfolio`
--
ALTER TABLE `b02afc9599498ac918ebb8d803110d_portfolio`
ADD CONSTRAINT `b02afc9599498ac918ebb8d803110d_portfolio_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `b02afc9599498ac918ebb8d803110d_watchlist`
--
ALTER TABLE `b02afc9599498ac918ebb8d803110d_watchlist`
ADD CONSTRAINT `b02afc9599498ac918ebb8d803110d_watchlist_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `cc1fa7bc5957188bc3da672819d339_portfolio`
--
ALTER TABLE `cc1fa7bc5957188bc3da672819d339_portfolio`
ADD CONSTRAINT `cc1fa7bc5957188bc3da672819d339_portfolio_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `cc1fa7bc5957188bc3da672819d339_watchlist`
--
ALTER TABLE `cc1fa7bc5957188bc3da672819d339_watchlist`
ADD CONSTRAINT `cc1fa7bc5957188bc3da672819d339_watchlist_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `d7d2730e13f99a4452fd6bf3d362c2_portfolio`
--
ALTER TABLE `d7d2730e13f99a4452fd6bf3d362c2_portfolio`
ADD CONSTRAINT `d7d2730e13f99a4452fd6bf3d362c2_portfolio_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

--
-- Constraints for table `d7d2730e13f99a4452fd6bf3d362c2_watchlist`
--
ALTER TABLE `d7d2730e13f99a4452fd6bf3d362c2_watchlist`
ADD CONSTRAINT `d7d2730e13f99a4452fd6bf3d362c2_watchlist_ibfk_1` FOREIGN KEY (`stock_ticker`) REFERENCES `prediction` (`stock_ticker`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
