-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 12:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quickr`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_quickr`
--

CREATE TABLE IF NOT EXISTS `about_quickr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about_quickr` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `about_quickr`
--

INSERT INTO `about_quickr` (`id`, `about_quickr`) VALUES
(1, '&lt;div class=&quot;container&quot;&gt;\r\n&lt;div class=&quot;row lhwn-contain&quot;&gt;\r\n&lt;div class=&quot;col-lg-12 col-md-12 col-sm-12 col-xs-12&quot;&gt;\r\n&lt;p&gt;QuickR was founded in the United Kingdom by financial entrepreneurs Philip Taylor and Ben Murison to improve access to expert financial information and to help people find a financial expert that is most suited to their needs..&lt;/p&gt;\r\n&lt;h3&gt;Why QuickR?&lt;/h3&gt;\r\n&lt;p&gt;We believe that more information helps you make better decisions. At QuickR, we provide you with detailed information on financial experts and finance issues so that you can make the choices that are right for you.&lt;/p&gt;\r\n&lt;p&gt;Who&#039;s to say the expert &amp;ldquo;down the road&amp;rdquo;, or the one &amp;ldquo;your family has used for years&amp;rdquo; is the best fit for your needs. QuickR knocks down distance and time barriers helping you get the best information as quickly as possible.&lt;/p&gt;\r\n&lt;h3&gt;Financial help when and how you need it&lt;/h3&gt;\r\n&lt;p&gt;Imagine having nearly every licensed financial expert in the United Kingdom at your fingertips, the moment you need help. QuickR helps achieve this, plus detailed profiles, client reviews and the QuickR rating.&lt;/p&gt;\r\n&lt;p&gt;&lt;a class=&quot;btn btn-primary&quot; href=&quot;find-a-financial-expert&quot;&gt;Find your expert&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;Post your question for free, and experienced financial experts will respond within hours. Or, find answers to previously asked questions.&lt;/p&gt;\r\n&lt;p&gt;&lt;a class=&quot;btn btn-primary&quot; href=&quot;ask&quot;&gt;Ask an expert&lt;/a&gt;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(50) NOT NULL,
  `admin_pass` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `permissionid` text NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_pass`, `email`, `permissionid`, `is_active`, `created_at`) VALUES
(1, 'admin', '79c77a41c15222f7e678e0ae208bc99c', 'admin@quickr.com', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19', '1', '2015-07-31 11:47:54'),
(3, 'venkat', 'e10adc3949ba59abbe56e057f20f883e', 'venkat@quadrupleindia.com', '', '1', '2015-08-05 11:43:20'),
(4, 'priyanka', 'e10adc3949ba59abbe56e057f20f883e', 'priya@gmail.com', '', '1', '2015-08-04 12:44:35'),
(7, 'priya', '1df3746a4728276afdc24f828186f73a', 'priyanka.g@quadrupleindia.com', '1,2,7', '1', '2015-08-04 12:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `basic_information`
--

CREATE TABLE IF NOT EXISTS `basic_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(50) NOT NULL,
  `shortlogo` varchar(250) NOT NULL,
  `loginlogo` varchar(250) NOT NULL,
  `adminmail` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `basic_information`
--

INSERT INTO `basic_information` (`id`, `companyname`, `shortlogo`, `loginlogo`, `adminmail`) VALUES
(1, 'QuickR', 'logo-white.png', 'com-logo.png', 'venkat.r@quadrupleindia.com');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `county_id` int(11) NOT NULL,
  `country_id` tinyint(1) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `county_id`, `country_id`, `latitude`, `longitude`, `image`, `description`, `is_active`) VALUES
(1, 'Birmingham', 93, 1, '', '', '', '', 1),
(2, 'eeeee', 3, 3, '6546', '46546', 'images1.jpeg', 'dfghgfdh', 1),
(3, 'Cambridge', 4, 1, '', '', '', '', 1),
(4, 'Coventry', 1, 1, '', '', '', '', 1),
(5, 'Edinburgh', 1, 1, '', '', '', '', 1),
(6, 'Exeter', 1, 1, '', '', '', '', 1),
(7, 'Glasgow', 1, 1, '', '', '', '', 1),
(8, 'Leicester', 1, 1, '', '', '', '', 1),
(9, 'Leeds', 1, 1, '', '', '', '', 1),
(10, 'Liverpool', 1, 1, '', '', '', '', 1),
(11, 'London', 1, 1, '', '', '', '', 1),
(12, 'Manchester', 1, 1, '', '', '', '', 1),
(13, 'Newcastle on Tyne', 1, 1, '', '', '', '', 1),
(14, 'Nottingham', 1, 1, '', '', '', '', 1),
(15, 'Plymouth', 1, 1, '', '', '', '', 1),
(16, 'Portsmouth', 1, 1, '', '', '', '', 1),
(17, 'Sheffield', 1, 1, '43.454', '43.665', '', 'asif filme', 1),
(18, 'Wakefield', 1, 1, '97.433', '88.233', '', 'asif filme', 0),
(22, 'dfsg', 3, 1, '4', '4', '4.jpg', 'gfdfs', 1),
(23, 'city', 88, 4, '6.6', '4', 'Jellyfish.jpg', 'ffv', 1),
(25, 'ttt', 88, 4, '12.1', '54', 'Chrysanthemum1.jpg', '444', 1),
(26, 'fhd', 99, 8, '0', '556', 'images3.jpeg', '56546', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_questions`
--

CREATE TABLE IF NOT EXISTS `client_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `subject` text NOT NULL,
  `detail` text NOT NULL,
  `topic` mediumtext NOT NULL,
  `location` text NOT NULL,
  `add_info` text NOT NULL,
  `category` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `open_for_answer` int(11) NOT NULL,
  `ipaddress` varchar(50) NOT NULL,
  `submitted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `client_questions`
--

INSERT INTO `client_questions` (`id`, `client_id`, `subject`, `detail`, `topic`, `location`, `add_info`, `category`, `status`, `open_for_answer`, `ipaddress`, `submitted_date`) VALUES
(1, 2, 'test dfsdfsdf sdfsdfsdf', 'test test test test', '1', 'Los Angels, CA', '', '10,11', 1, 0, '', '0000-00-00 00:00:00'),
(2, 2, 'test', 'test', '1,3,2', 'Los Angels, CA', 'test test', '13,16', 0, 0, '', '2015-07-07 00:01:47'),
(5, 2, 'sdfsdfsdfsdf dfjhksjdfj sdjfhjk sdjfhj sdjfhsd djfhsjdf kjdsfhsjdf sdjfhsdjf sdjfhsdjfh sdjfhsjdfh sdjfhsd sdhfj sdjfh sdjfh sdj dfsgs dfsgsdfgfd fdsg dfsgdfgdsf dsgdfsg gs gdfsgs gdf dfgdfsg dfsgds dsfgdfg fdgd dgdfgdfsg gh ssfdgsdfgfdsgds dfsgdfsgdfsgdsfg ', 'jdfhjksdhfkj dsjfhsjdfhjsdhf sdjfhsdjfhsdfh dsjfhsjdhfjshdf sdjfhsjdfhjsdhf sdfjhsjdhfsdhf dsjfhsjdhfjshd sdjfhsjdhfjshd sdjfhsjdhfjs sdjfhsjdhfjsd sdjfhsjdhfjsdf sdjfhsjdhfjsdh dsjfhsjdhfjsh sdjfhsjdhfsjdf sdjfhsjdhfjhsd sdjfhsjdhfjshd sdjfhsjdfhsjd sdjfhsjdfhjsdf sdjfsdjhfjsd sdjfhsjdhfhsdf sdjfhsjdhfjsdf djfhsdjfh djfhsjdfhsdhf sdjfhsjdhfjsd sdjhfjsh dsjdfhsjdhf sdjfh sjdfhj jsfhjfsjdhfsd fjdhfjhsdjf sfjsdfhjsdhfjs jsdfhjsdhfjsdfjshdjfhsdj sjdfhsdjfhsjdkf sdjfhsjdhfsjdhfjsd sdjfhsjdhfjsdhf dsfsdfsdf', '1,2', 'fgdfgdfgdfg', '', '13', 1, 0, '', '2015-07-08 00:57:43'),
(7, 2, 'sdfsdnfksdf,s, sdmfsdmflsdmf sdnfksdfksd sdjfhsjdf dsjfhsjdhf sdjfh sdjfhsjdf sdjfhsjdfh sdjfhsdjfhj sdjfhsdjfh sdjfhsdjhf sdjfh', 'jfhjsdhfjsdhfj sjdfhsjdhfjsdhfj sdjfhsjdhfj djfhjdhf djfhsdjf dsjfhj djfhj djfhjsdhf sdjfhj sdjhfj dsjfhjsd jdhfsjdf sjhfj sdjhfjksd sdjf sdhfjsdhfjsd sdjfhjsdfh sdjfhsdfj sjshf dfjhsdjh fsjd sdj dsj jsdhfj jdfhdjs djfhj hdfjsdhfjsd jfhjsfh jsdhf sdjfhsdjhfjsd jsdfhjsdhfjshd fjhs sjdfhsdjf jsdfhjsdhfjhdjfh sjdf sfjhdsj hfjsd sdjhf sdjfh jsdfjhfjdhfjdshfjdsfhdj djfhjdshfjsdhf djfhjdhfjsdhfj djfhjdshfjd jdhfjhsdfjsdhjfsdjfh sdjfhsdjfhsdjhfsdjhfj djfhjsdhfjhsdjfhjsdhf djfhjdshfjhsdfj djfhjsdhfjsdhfj djfhjhsdfjhsdjf jdhfjsdhfjhsdjf sdjfhjdshfjhsdjfhsdj', '3', 'dfsdfsdfsdfsdf', '', '15,16', 0, 0, '', '2015-07-08 01:45:55'),
(8, 2, 'dfgdfgdf', 'gdfgdfgdfg', '1', 'dfgdfgdfg', '', '9,12', 1, 0, '', '2015-07-08 02:18:03'),
(9, 2, 'dfgsdfsdf', 'sdfsdf', '10,11', 'dsfsdfsdf', 'dsfsdfsdfsdfsdf', '', 0, 0, '', '2015-07-08 02:19:46'),
(19, 3, 'sdfsdfsdfsdf', 'sdfsdf', '1,3', 'sdfsdfsdf', '', '17', 0, 0, '', '2015-07-06 18:07:27'),
(20, 2, 'dfsdf', 'dfsdff', '1,2', 'dfsdf', '', '12,13', 1, 0, '', '2015-07-14 05:05:56'),
(21, 3, 'sdfsdfs', 'dfsdfsdf', '1,2', 'sdfsdfsdf', '', '9,10', 1, 0, '', '2015-07-15 01:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `client_reviews`
--

CREATE TABLE IF NOT EXISTS `client_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `overall_rating` tinyint(1) NOT NULL,
  `trustworthy` tinyint(1) DEFAULT NULL,
  `responsive` tinyint(1) DEFAULT NULL,
  `knowledgeable` tinyint(1) DEFAULT NULL,
  `kept_informed` tinyint(1) DEFAULT NULL,
  `has_recommend` tinyint(1) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `can_show_name` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reviewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `client_reviews`
--

INSERT INTO `client_reviews` (`id`, `fa_id`, `user_id`, `title`, `review`, `overall_rating`, `trustworthy`, `responsive`, `knowledgeable`, `kept_informed`, `has_recommend`, `firstname`, `can_show_name`, `email`, `reviewed_at`, `status`) VALUES
(1, 1, NULL, 'test1', 'test1', 1, NULL, NULL, NULL, NULL, 1, NULL, 1, 'venkat@quadrupleindia.com', '2015-07-29 06:48:57', 0),
(4, 1, 10, 'Test review', 'Test review', 5, NULL, NULL, NULL, NULL, 0, 'priyanka', 0, 'priyanka.g@quadrupleindia.com', '2015-08-03 04:51:49', 1),
(5, 1, 10, 'Test review2', 'Test review2', 1, NULL, NULL, NULL, NULL, 1, 'priyanka', 1, 'priyanka.g@quadrupleindia.com', '2015-08-03 04:52:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `common_questions`
--

CREATE TABLE IF NOT EXISTS `common_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `topics_tagged` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `common_questions`
--

INSERT INTO `common_questions` (`id`, `quest_id`, `topics_tagged`) VALUES
(3, 19, '13'),
(6, 21, '27'),
(8, 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `constituent_countries`
--

CREATE TABLE IF NOT EXISTS `constituent_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `constituent_countries`
--

INSERT INTO `constituent_countries` (`id`, `country`, `is_active`) VALUES
(1, 'England', 1),
(2, 'Scotland', 1),
(3, 'Wales', 1),
(4, 'Northern Ireland', 1),
(8, 'country', 1),
(9, 'abcd ggggg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE IF NOT EXISTS `counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` tinyint(1) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`id`, `name`, `country`, `latitude`, `longitude`, `image`, `description`, `is_active`) VALUES
(1, 'Bedfordshire', 1, '', '', '', '', 1),
(2, '', 3, '2221', '222', 'images1.jpeg', '333333', 0),
(3, 'Buckinghamshire', 1, '', '', '', '', 1),
(4, 'Cambridgeshire', 1, '', '', '', '', 1),
(5, 'Cheshire', 1, '', '', '', '', 1),
(6, 'Cornwall', 1, '', '', '', '', 1),
(7, 'Cumberland', 1, '', '', '', '', 1),
(8, 'Derbyshire', 1, '', '', '', '', 1),
(9, 'Devon', 1, '', '', '', '', 1),
(10, 'Dorset', 1, '', '', '', '', 1),
(11, 'Durham', 1, '', '', '', '', 1),
(12, 'Essex', 1, '', '', '', '', 1),
(13, 'Gloucestershire', 1, '', '', '', '', 1),
(14, 'Hampshire', 1, '', '', '', '', 1),
(15, 'Herefordshire', 1, '', '', '', '', 1),
(16, 'Hertfordshire', 1, '', '', '', '', 1),
(17, 'Huntingdonshire', 1, '', '', '', '', 1),
(18, 'Kent', 1, '', '', '', '', 1),
(19, 'Lancashire', 1, '', '', '', '', 1),
(20, 'Leicestershire', 1, '', '', '', '', 1),
(21, 'Lincolnshire', 1, '', '', '', '', 1),
(22, 'Middlesex', 1, '', '', '', '', 1),
(23, 'Norfolk', 1, '', '', '', '', 1),
(24, 'Northamptonshire', 1, '', '', '', '', 1),
(25, 'Northumberland', 1, '', '', '', '', 1),
(26, 'Nottinghamshire', 1, '', '', '', '', 1),
(27, 'Oxfordshire', 1, '', '', '', '', 1),
(28, 'Rutland', 1, '', '', '', '', 1),
(29, 'Shropshire', 1, '', '', '', '', 1),
(30, 'Somerset', 1, '', '', '', '', 1),
(31, 'Staffordshire', 1, '', '', '', '', 1),
(32, 'Suffolk', 1, '', '', '', '', 1),
(33, 'Surrey', 1, '', '', '', '', 1),
(34, 'Sussex', 1, '', '', '', '', 1),
(35, 'Warwickshire', 1, '', '', '', '', 1),
(36, 'Westmorland', 1, '', '', '', '', 1),
(37, 'Wiltshire', 1, '', '', '', '', 1),
(38, 'Worcestershire', 1, '', '', '', '', 1),
(39, 'Yorkshire', 1, '', '', '', '', 1),
(40, 'Aberdeenshire', 2, '', '', '', '', 1),
(41, 'Angus', 2, '', '', '', '', 1),
(42, 'Argyllshire', 2, '', '', '', '', 1),
(43, 'Ayrshire', 2, '', '', '', '', 1),
(44, 'Banffshire', 2, '', '', '', '', 1),
(45, 'Berwickshire', 2, '', '', '', '', 1),
(46, 'Buteshire', 2, '', '', '', '', 1),
(47, 'Caithness', 2, '', '', '', '', 1),
(48, 'Clackmannanshire', 2, '', '', '', '', 1),
(49, 'Cromartyshire', 2, '', '', '', '', 1),
(50, 'Dumfriesshire', 2, '', '', '', '', 1),
(51, 'Dunbartonshire', 2, '', '', '', '', 1),
(52, 'East Lothian', 2, '', '', '', '', 1),
(53, 'Fife', 2, '', '', '', '', 1),
(54, 'Inverness-shire', 2, '', '', '', '', 1),
(55, 'Kincardineshire', 2, '', '', '', '', 1),
(56, 'Kinross-shire', 2, '', '', '', '', 1),
(57, 'Kirkcudbrightshire', 2, '', '', '', '', 1),
(58, 'Lanarkshire', 2, '', '', '', '', 1),
(59, 'Midlothian', 2, '', '', '', '', 1),
(60, 'Morayshire', 2, '', '', '', '', 1),
(61, 'Nairnshire', 2, '', '', '', '', 1),
(62, 'Orkney', 2, '', '', '', '', 1),
(63, 'Peeblesshire', 2, '', '', '', '', 1),
(64, 'Perthshire', 2, '', '', '', '', 1),
(65, 'Renfrewshire', 2, '', '', '', '', 1),
(66, 'Ross-shire', 2, '', '', '', '', 1),
(67, 'Roxburghshire', 2, '', '', '', '', 1),
(68, 'Selkirkshire', 2, '', '', '', '', 1),
(69, 'Shetland', 2, '', '', '', '', 1),
(70, 'Stirlingshire', 2, '', '', '', '', 1),
(71, 'Sutherland', 2, '', '', '', '', 1),
(72, 'West Lothian', 2, '', '', '', '', 1),
(73, 'Sussex', 2, '', '', '', '', 1),
(74, 'Anglesey', 3, '', '', '', '', 1),
(75, 'Brecknockshire', 3, '', '', '', '', 1),
(76, 'Caernarfonshire', 3, '', '', '', '', 1),
(77, 'Carmarthenshire', 3, '', '', '', '', 1),
(78, 'Cardiganshire', 3, '', '', '', '', 1),
(79, 'Denbighshire', 3, '', '', '', '', 1),
(80, 'Flintshire', 3, '', '', '', '', 1),
(81, 'Glamorgan', 3, '', '', '', '', 1),
(82, 'Merioneth', 3, '', '', '', '', 1),
(83, 'Monmouthshire', 3, '', '', '', '', 1),
(84, 'Montgomeryshire', 3, '', '', '', '', 1),
(85, 'Pembrokeshire', 3, '', '', '', '', 1),
(86, 'Radnorshire', 3, '', '', '', '', 1),
(87, 'County Antrim', 4, '', '', '', '', 1),
(88, 'County Armagh', 4, '', '', '', '', 1),
(89, 'County Down', 4, '', '', '', '', 1),
(90, 'County Fermanagh', 4, '', '', '', '', 1),
(91, 'County Londonderry', 4, '', '', '', '', 1),
(92, 'County Tyrone', 4, '', '', '', '', 1),
(93, 'West Midlands', 1, '', '', '', '', 1),
(94, 'venkat', 27, '24324.34', '234.34', 'venkat1.jpg', 'asdfasdfa', 1),
(95, 'dfgsdfs', 28, '3454.345', '3534.43', 'images4.jpeg', 'fdsgdfs', 1),
(98, 'ttttttt   sssssssssssssss', 3, '6', '6', '4.jpg', 'gfdhdfgh', 1),
(99, 'county', 8, '24524', '54', 'Penguins.jpg', 'descr', 0),
(101, 'tttttt', 9, '12.12', '3', 'Chrysanthemum.jpg', 'hhg          ', 0),
(102, 'N.I', 4, '445', '4', 'Penguins1.jpg', 'des', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fa_awards`
--

CREATE TABLE IF NOT EXISTS `fa_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `grantor` varchar(255) DEFAULT NULL,
  `date_granted` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_educations`
--

CREATE TABLE IF NOT EXISTS `fa_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `university` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_languages_spoken`
--

CREATE TABLE IF NOT EXISTS `fa_languages_spoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_licenses`
--

CREATE TABLE IF NOT EXISTS `fa_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `controlled_function` varchar(255) NOT NULL,
  `firm_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_master`
--

CREATE TABLE IF NOT EXISTS `fa_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `about_company` text NOT NULL,
  `phone_no_office` varchar(255) NOT NULL,
  `phone_no_direct` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `address1` varchar(1024) NOT NULL,
  `address2` varchar(1024) DEFAULT NULL,
  `address3` varchar(1024) DEFAULT NULL,
  `FCA_company_no` varchar(255) DEFAULT NULL,
  `free_consultation` tinyint(1) NOT NULL,
  `independent_or_restricted` tinyint(1) NOT NULL,
  `disciplinary_history` tinyint(1) NOT NULL,
  `assets_under_advisory` tinyint(1) NOT NULL,
  `advisory_discretionary` tinyint(1) NOT NULL,
  `city` varchar(255) NOT NULL,
  `county` int(11) NOT NULL,
  `postcode` varchar(25) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `fa_master`
--

INSERT INTO `fa_master` (`id`, `firstname`, `middlename`, `lastname`, `email`, `company_name`, `about_company`, `phone_no_office`, `phone_no_direct`, `website`, `address1`, `address2`, `address3`, `FCA_company_no`, `free_consultation`, `independent_or_restricted`, `disciplinary_history`, `assets_under_advisory`, `advisory_discretionary`, `city`, `county`, `postcode`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'e1', 'e2', 'e3', 'venkat.r@quadrupleindia.com', 'e4', 'e9', '23', '34', 'http://local.quickr.com/admin/addlawyer', 'e5', 'e6', 'e7', '45', 0, 0, 0, 0, 0, 'e8', 40, '12', 1, '2015-07-04 03:18:02', '2015-07-04 07:57:29'),
(4, 'w1', 'w2', 'w3', 'venkatesh.sengai@gmail.com', 'w5', 'w10', '23', '34', 'http://local.quickr.com/admin/addlawyer', 'w6', 'w7', 'w8', '45', 1, 1, 1, 1, 1, 'w9', 40, '12', 0, '2015-07-04 07:18:33', '2015-07-06 10:39:57'),
(5, 'dsfg', 'dfsg', 'dfgs', 'dasgas@gdsg.com', 'dgfs', '34234234', '324343', '34234', 'http://local.quickr.com/admin/addlawyer', 'asfaf', '', '', '543534dfh', 1, 1, 1, 1, 1, 'sdafasd', 45, '234234', 1, '2015-07-06 11:21:00', '2015-07-06 04:20:11'),
(6, 'priya', '', 'g', 'priyanka.g@quadrupleindia.com', 'comp', 'gfx', '5', '5', '', 'hj', '', '', 'cvhdgf', 1, 1, 1, 0, 0, 'cdtsa', 98, '43', 1, '2015-08-01 12:23:44', '2015-08-03 03:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `fa_photos`
--

CREATE TABLE IF NOT EXISTS `fa_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `actual_file` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_practice_areas`
--

CREATE TABLE IF NOT EXISTS `fa_practice_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_registered_users`
--

CREATE TABLE IF NOT EXISTS `fa_registered_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address1` varchar(1024) NOT NULL,
  `address2` varchar(1024) DEFAULT NULL,
  `address3` varchar(1024) DEFAULT NULL,
  `disciplinary_history` tinyint(1) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` int(11) NOT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fa_registered_users`
--

INSERT INTO `fa_registered_users` (`id`, `user_id`, `address1`, `address2`, `address3`, `disciplinary_history`, `city`, `county`, `postcode`, `phone_number`, `created_at`, `updated_at`) VALUES
(4, 2, 'chennai', NULL, NULL, 1, NULL, 1, NULL, '32432', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fa_registered_user_licenses`
--

CREATE TABLE IF NOT EXISTS `fa_registered_user_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fa_registered_id` int(11) NOT NULL,
  `controlled_function` smallint(3) NOT NULL,
  `firm_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fa_registered_user_licenses`
--

INSERT INTO `fa_registered_user_licenses` (`id`, `user_id`, `fa_registered_id`, `controlled_function`, `firm_name`, `start_date`, `end_date`, `created_at`) VALUES
(1, 2, 1, 54, 'venkat', '2015-07-08 00:00:00', '2015-07-16 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fa_user`
--

CREATE TABLE IF NOT EXISTS `fa_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `about_company` text NOT NULL,
  `phone_no_office` varchar(255) NOT NULL,
  `phone_no_direct` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `company_address1` varchar(1024) NOT NULL,
  `company_address2` varchar(1024) DEFAULT NULL,
  `company_address3` varchar(1024) DEFAULT NULL,
  `FCA_company_no` varchar(255) DEFAULT NULL,
  `free_consultation` tinyint(1) NOT NULL,
  `independent_or_restricted` tinyint(1) NOT NULL,
  `disciplinary_history` tinyint(1) NOT NULL,
  `assets_under_advisory` tinyint(1) NOT NULL,
  `advisory_discretionary` tinyint(1) NOT NULL,
  `city` int(11) NOT NULL,
  `county` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fa_work_experiences`
--

CREATE TABLE IF NOT EXISTS `fa_work_experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fa_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `from` int(4) NOT NULL,
  `to` int(4) DEFAULT NULL,
  `present` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE IF NOT EXISTS `fee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `type`, `status`) VALUES
(1, 'ffffff', 1),
(3, 'rtyuu', 0),
(4, 'cfj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `status`) VALUES
(1, 'Afrikaans', 1),
(2, 'Creole', 1),
(3, 'Khmer', 1),
(4, 'Serbo-Croatian', 1),
(5, 'Akan', 1),
(6, 'Croatian', 1),
(7, 'Korean', 1),
(8, 'Sindhi', 1),
(9, 'Albanian', 1),
(10, 'Czech', 1),
(11, 'Lao', 1),
(12, 'Slovak', 1),
(13, 'American Sign Language', 1),
(14, 'Danish', 1),
(15, 'Latvian', 1),
(16, 'Somali', 1),
(17, 'Amharic', 1),
(18, 'Dutch', 1),
(19, 'Lithuanian', 1),
(20, 'Spanish', 1),
(21, 'Arabic', 1),
(22, 'Esperanto', 1),
(23, 'Maithili', 1),
(24, 'Swahili', 1),
(25, 'Armenian', 1),
(26, 'Farsi', 1),
(27, 'Malay', 1),
(28, 'Swedish', 1),
(29, 'Azerbaijani', 1),
(30, 'Filipino', 1),
(31, 'Malayalam', 1),
(32, 'Tagalog', 1),
(33, 'Belarusian', 1),
(34, 'Finnish', 1),
(35, 'Maltese', 1),
(36, 'Taiwanese', 1),
(37, 'Bengali', 1),
(38, 'French', 1),
(39, 'Mandarin', 1),
(40, 'Tamil', 1),
(41, 'Bhojpuri', 1),
(42, 'German', 1),
(43, 'Marathi', 1),
(44, 'Telugu', 1),
(45, 'Bosnian', 1),
(46, 'Greek', 1),
(47, 'Navajo', 1),
(48, 'Thai', 1),
(49, 'Bulgarian', 1),
(50, 'Gujarati', 1),
(51, 'Nepali', 1),
(52, 'Tibetan', 1),
(53, 'Burmese', 1),
(54, 'Hausa', 1),
(55, 'Norwegian', 1),
(56, 'Tigringa', 1),
(57, 'Cambodian', 1),
(58, 'Hebrew', 1),
(59, 'Oriya', 1),
(60, 'Turkish', 1),
(61, 'Cantonese', 1),
(62, 'Hindi', 1),
(63, 'Persian', 1),
(64, 'Ukrainian', 1),
(65, 'Catalan', 1),
(66, 'Hmong', 1),
(67, 'Polish', 1),
(68, 'Urdu', 1),
(69, 'Chinese, Gan', 1),
(70, 'Hungarian', 1),
(71, 'Portuguese', 1),
(72, 'Vietnamese', 1),
(73, 'Chinese, Hakka', 1),
(74, 'Igbo', 1),
(75, 'Punjabi', 1),
(76, 'Yiddish', 1),
(77, 'Chinese, Jinyu', 1),
(78, 'Indonesian', 1),
(79, 'Quechua', 1),
(80, 'Yoruba', 1),
(81, 'Chinese, Min Nan', 1),
(82, 'Italian', 1),
(83, 'Romanian', 1),
(84, 'Chinese, Wu', 1),
(85, 'Japanese', 1),
(86, 'Russian', 1),
(87, 'Chinese, Xiang', 1),
(88, 'Kannada', 1),
(89, 'Serbian', 1),
(92, 'dsfa', 1),
(93, 'dsaf', 1),
(94, '4444', 0),
(95, '@$#$%%', 1),
(96, '@$%^', 0),
(97, 'dfsg', 1),
(98, 'DSF', 1),
(99, 'fg', 1),
(100, 'fh', 1),
(101, 'ghf', 1),
(102, 'FDSGS', 1),
(103, 'DSSDF34', 1),
(104, 'dgdfs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `legal_answers`
--

CREATE TABLE IF NOT EXISTS `legal_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `answered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `legal_answers`
--

INSERT INTO `legal_answers` (`id`, `quest_id`, `adviser_id`, `answer`, `status`, `answered_date`) VALUES
(1, 19, 2, 'Testing testing testing testinfgdfhgklshgk jfghjhfjghf jfdghjfhg jfghjsf gjhgaweiotui bnv dfjaheroiokfnadmbv sdjfhuwhsdnfjdfjiwerfnkdnbvgrtmn sdhffnmd eojdmfsdbfek nhsr eefbsdhbf eruj', 0, '2015-07-10 02:01:02'),
(2, 19, 4, 'dfbsdf ksfishdfisd djfhjsdhfjsdhf sdjfhsjdhfj ieuriowuer dfhjksdhfjshdf sdhfsjdhfw4ur mxcbnxzbcncxbbvajshi djfhjsdhf jdfhjsdhfj jfhsdjhfsjf sdjfhjsdhfjsdhf sdjfhsjdfhj dfjhsdjfh sdjfhsjdhf sdfhjsdhf sdhfsdhf ', 0, '2015-07-10 04:31:49'),
(3, 19, 4, 'dfsdfsdfsdfsdf', 0, '2015-07-10 06:29:50'),
(4, 20, 4, 'test', 1, '2015-07-14 05:31:57'),
(5, 21, 4, 'ffgdfgdfgfgfgdfgdfgfgg', 0, '2015-07-17 03:42:22'),
(10, 19, 2, 'dfghdgfhdf', 0, '2015-07-20 13:30:12'),
(11, 21, 2, 'fhfgdjdgfhg', 0, '2015-07-20 13:38:22'),
(12, 21, 2, 'asdfdasf sdafsdf dasfsdfdas sdafsd ', 0, '2015-07-20 13:48:33'),
(13, 21, 2, 'abver', 0, '2015-08-01 11:11:52'),
(14, 21, 2, '', 1, '2015-08-01 11:58:30'),
(15, 21, 2, '', 1, '2015-08-01 11:58:48'),
(16, 21, 2, '', 1, '2015-08-01 11:59:40'),
(17, 21, 2, 'fg', 1, '2015-08-03 11:16:05'),
(18, 9, 2, 'ans', 1, '2015-08-04 13:23:14'),
(19, 9, 2, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 1, '2015-08-04 13:25:12'),
(20, 21, 2, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 1, '2015-08-05 09:19:39'),
(21, 21, 2, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 1, '2015-08-05 09:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `manage_emails`
--

CREATE TABLE IF NOT EXISTS `manage_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` text NOT NULL,
  `subject` text NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `manage_emails`
--

INSERT INTO `manage_emails` (`id`, `template`, `subject`, `content`) VALUES
(1, 'Layer Registration Mail', 'Quickr registration', '<p>dasgfsdafdasf</p>'),
(2, 'Forgot Password', 'Forgot Password Mail', '&lt;p&gt;Test by venkatesh&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE IF NOT EXISTS `payment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `type`, `status`) VALUES
(1, 'Cash', 1),
(2, 'Check', 1),
(3, 'Credit Card', 1),
(4, 'Debit Card', 1),
(5, 'Bank Transfer', 0),
(9, 'sddf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'Basic Information'),
(2, 'Manage Country'),
(3, 'Manage Counties'),
(4, 'Manage Cities'),
(5, 'Manage Languages'),
(6, 'Manage Fee Types'),
(7, 'Manage Emails'),
(8, 'Manage Practice Area'),
(9, 'Manage Topics'),
(10, 'Add Financial Adviser'),
(11, 'Master Financial Adviser'),
(12, 'Manage Registered Users'),
(13, 'Manage Users'),
(14, 'Manage Reviews'),
(15, 'Manage Questions'),
(16, 'Manage Answers'),
(17, 'Manage Tips'),
(18, 'Admin Users'),
(19, 'Manage Payment Type');

-- --------------------------------------------------------

--
-- Table structure for table `postcodes`
--

CREATE TABLE IF NOT EXISTS `postcodes` (
  `id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `practice_areas`
--

CREATE TABLE IF NOT EXISTS `practice_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `practice_areas`
--

INSERT INTO `practice_areas` (`id`, `area`, `description`, `is_active`) VALUES
(1, 'Business', '', '1'),
(2, '', '', '0'),
(3, 'Group critical illness', '', '1'),
(5, 'Group life insurance', '', '1'),
(6, 'Group pensions', '', '1'),
(7, 'Group private medical insurance', '', '1'),
(8, 'Financial planning', '', '1'),
(9, 'Wealth management', '', '1'),
(10, 'Insurance', 'dffdsfds', '1'),
(11, 'Buildings and contents', '', '1'),
(12, 'Commercial motor', '', '1'),
(13, 'Home and leisure', '', '1'),
(14, 'Large business', '', '1'),
(15, 'Small business', '', '1'),
(16, 'Travel', '', '1'),
(17, 'Investments', '', '1'),
(18, 'Ethical investments', '', '1'),
(19, 'Investing for income', '', '1'),
(20, 'Investment trusts', '', '1'),
(21, 'ISAs', '', '1'),
(22, 'OEICs', '', '1'),
(23, 'Offshore investments', '', '1'),
(24, 'Socially responsible investments', '', '1'),
(25, 'Unit trusts', '', '1'),
(26, 'Mortgages', '', '1'),
(27, 'Buy to let', '', '1'),
(28, 'Equity release', '', '1'),
(29, 'First time buyers', '', '1'),
(30, 'Flexible', '', '1'),
(31, 'High loan to value', '', '1'),
(32, 'Remortgage', '', '1'),
(33, 'Residential', '', '1'),
(34, 'Self employed', '', '1'),
(35, 'Pensions', '', '1'),
(36, 'Pension consolidation', '', '1'),
(37, 'Pension drawdown', '', '1'),
(38, 'Pensions & divorce', '', '1'),
(39, 'Pensions & retirement planning', '', '1'),
(40, 'Pensions transfer', '', '1'),
(41, 'Protection', '', '1'),
(42, 'Critical illness', '', '1'),
(43, 'Healthcare', '', '1'),
(44, 'Income protection insurance', '', '1'),
(45, 'Life insurance', '', '1'),
(46, 'Savings', '', '1'),
(47, 'Lump sum', '', '1'),
(48, 'Regular savings', '', '1'),
(49, 'School fees planning', '', '1'),
(55, 'test', 'fd', '0');

-- --------------------------------------------------------

--
-- Table structure for table `question_flag`
--

CREATE TABLE IF NOT EXISTS `question_flag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flagged_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `question_flag`
--

INSERT INTO `question_flag` (`id`, `flagged_time`, `quest_id`, `user_id`, `flag`) VALUES
(1, '2015-07-16 14:03:31', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quset_additional_process`
--

CREATE TABLE IF NOT EXISTS `quset_additional_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quest_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `helpful_mark` int(11) NOT NULL,
  `best_mark` int(11) NOT NULL,
  `agree` int(11) NOT NULL,
  `comment` text,
  `flag` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `input_by` int(11) NOT NULL,
  `submitted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `quset_additional_process`
--

INSERT INTO `quset_additional_process` (`id`, `quest_id`, `answer_id`, `helpful_mark`, `best_mark`, `agree`, `comment`, `flag`, `status`, `input_by`, `submitted_date`) VALUES
(1, 19, 3, 1, 0, 0, NULL, 0, 1, 2, '2015-07-13 01:59:43'),
(7, 19, 2, 0, 0, 0, 'dfsdfsdf', 0, 1, 4, '2015-07-13 04:47:45'),
(8, 19, 1, 0, 0, 0, 'fnbdfj dfjgkdfhgj jdfhg dfjh jdfghdjfhg fjghjdfhgj fjghdjfgh fjhgjdfhgj fdjghdjfhg fjghdjfh jfhgj fjg dfjgh', 0, 1, 4, '2015-07-13 05:19:25'),
(9, 19, 1, 0, 0, 0, 'kghjfkjhfkjhkf kjfhfjh kjghkfjhkfjhkf gkjhkfhfjh  kgjhkfjgh fghjk', 0, 1, 4, '2015-07-13 05:41:06'),
(10, 19, 2, 0, 0, 0, 'ghghghg hhjghgg hhghgjhg jgjhghghghghg hghghghghghhg hghghgh', 0, 1, 4, '2015-07-13 05:41:49'),
(11, 19, 2, 0, 0, 0, 'fjgdhgkdhfjgh jfhgjdhfjgh jhfg jdfhgj djfh gdfjhgj jfhgj jfhgjdfhgd fjghdjfhgdf dfjghdjfhgjdh jdfhgjdfhg jfhgj jfgj dfhg fjdghd ', 0, 1, 4, '2015-07-13 06:20:29'),
(12, 19, 2, 0, 0, 0, 'testing testing testing testing testing testing testing testing testing testing', 0, 1, 4, '2015-07-13 06:23:01'),
(13, 19, 2, 0, 0, 0, 'dfjsdhf ksjdkfjs skdjfksd fkdjfksdjf dkjfksjd fsdjfksdjf sdkfjskd fksjdfks dfkdjfkjsdkfj', 0, 1, 4, '2015-07-13 06:24:33'),
(14, 19, 2, 0, 0, 0, 'xcvdfsdfsdf', 0, 1, 4, '2015-07-13 07:10:09'),
(16, 19, 1, 0, 0, 0, 'dfsdfsdfsfsdfsf', 0, 1, 4, '2015-07-13 07:10:20'),
(23, 19, 3, 0, 0, 0, NULL, 1, 1, 4, '2015-07-14 00:11:33'),
(24, 19, 1, 0, 0, 0, NULL, 1, 1, 4, '2015-07-14 00:11:49'),
(25, 19, 3, 0, 0, 1, NULL, 0, 1, 4, '2015-07-14 01:49:19'),
(27, 19, 1, 1, 0, 0, NULL, 0, 1, 2, '2015-07-14 04:03:57'),
(41, 20, 4, 0, 0, 1, NULL, 0, 1, 4, '2015-07-16 03:40:08'),
(42, 21, 5, 1, 0, 0, NULL, 0, 1, 2, '2015-07-17 03:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE IF NOT EXISTS `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` mediumtext NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `template_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `rating` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `posted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `topic`, `title`, `description`, `template_type`, `user_id`, `video_url`, `rating`, `status`, `posted_date`) VALUES
(2, '15', 'dasf', 'dsf', 1, 2, '', '4.00', 0, '2015-07-22 09:11:53'),
(3, '15', 'gdfh', 'gfdh', 2, 2, '', '1.00', 0, '2015-07-22 12:34:37'),
(4, '18', 'test', 'test', 2, 2, 'http://dotnet-concept.com/Tip/2015/3/5798824/Cross-Origin-Request-Blocked-The-Same-Origin-Policy-disallows-reading-the-remote-resource-This-can-be-fixed-by-moving-the-resource-to-the-same-domain-or-enabling-CORS-', '1.00', 1, '2015-07-28 12:27:21'),
(6, '22', 'titlena', 'fs', 1, 2, '', '1.00', 1, '2015-08-03 05:31:42'),
(8, '13', 'ds', 'sdt', 1, 2, '', '5.00', 1, '2015-08-04 12:18:49'),
(9, '27', 'tad', 'fcy', 1, 2, '', '5.00', 0, '2015-08-04 12:19:10'),
(10, '13', 'asddsaf', '&lt;p&gt;dfsfs dfsf dsfs ddsf d s&#039;dsfdsfsd&quot;fsdf &quot;dfsdf&lt;/p&gt;', 2, 2, 'ftp://www.google.co.in/', '4.00', 1, '2015-08-05 05:15:06'),
(11, '13', 'test by venkat', '&lt;p&gt;Hi this test by &quot;venkatesh&quot;&lt;/p&gt;', 1, 2, '', '4.00', 1, '2015-08-05 10:46:58'),
(12, '18', 'try', '&lt;p&gt;rtyrt rty rtyery&lt;/p&gt;', 1, 2, '', '2.00', 1, '2015-08-05 12:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `tips_vote`
--

CREATE TABLE IF NOT EXISTS `tips_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tips_id` int(11) NOT NULL,
  `vote` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tips_vote`
--

INSERT INTO `tips_vote` (`id`, `tips_id`, `vote`, `user_id`, `voted_date`) VALUES
(5, 1, 0, 4, '2015-07-21 11:58:50'),
(6, 1, 1, 4, '2015-07-21 11:58:50'),
(7, 1, 1, 4, '2015-07-21 11:59:11'),
(8, 1, 0, 4, '2015-07-21 11:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT '1',
  `relatedtopic` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`, `is_parent`, `relatedtopic`, `is_active`) VALUES
(18, 'gdfghdfhd', '&lt;p&gt;dfgdfgdfg&lt;/p&gt;', 0, '', 1),
(15, 'jjjjjjjjjjj', '<p>jjjjjjjjjjj</p>', 0, '', 0),
(13, 'test2', '&lt;p&gt;test2&lt;/p&gt;', 0, '', 1),
(14, 'rrrrrrr', '&lt;p&gt;rrrrrrrrr&lt;/p&gt;', 1, '', 1),
(12, 'test1', '&lt;p&gt;test1&lt;/p&gt;', 1, '', 1),
(26, 'dsfg', '&lt;p&gt;dsfgsdf&lt;strong&gt;g &quot;sdfg &quot;dsfg&quot;dfs&lt;/strong&gt;gdsgf dsfG&quot; dfs&lt;/p&gt;', 1, '', 1),
(27, 'name', '', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topics_mapping`
--

CREATE TABLE IF NOT EXISTS `topics_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `topics_mapping`
--

INSERT INTO `topics_mapping` (`id`, `parent`, `child`) VALUES
(5, 13, 0),
(6, 15, 12),
(7, 18, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `displayname` varchar(255) DEFAULT NULL,
  `has_google_link` tinyint(1) NOT NULL DEFAULT '0',
  `has_facebook_link` tinyint(1) NOT NULL DEFAULT '0',
  `has_twitter_link` tinyint(1) NOT NULL DEFAULT '0',
  `has_linkedin_link` tinyint(1) NOT NULL DEFAULT '0',
  `is_fa` tinyint(1) NOT NULL COMMENT '''1''=>adviser,''0''=>enduser,''2''=>adminuser',
  `adminuser` int(11) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `middlename`, `displayname`, `has_google_link`, `has_facebook_link`, `has_twitter_link`, `has_linkedin_link`, `is_fa`, `adminuser`, `is_verified`, `is_blocked`, `created_at`) VALUES
(2, 'admin@quickr.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'Rathinam', NULL, 'admin', 0, 0, 0, 0, 2, 1, 1, 1, '2015-07-06 12:05:55'),
(3, 'venkat@quadrupleindia.com', NULL, 'venkatesh', 'rathinam', NULL, 'venkatesh', 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'venkat@quadrupleindia.com', NULL, 'venkatesh', NULL, NULL, 'venkatesh', 0, 0, 0, 0, 1, 0, 1, 1, '0000-00-00 00:00:00'),
(9, 'venkat@quadrupleindia.com', 'e10adc3949ba59abbe56e057f20f883e', 'venkat', NULL, NULL, 'venkat', 0, 0, 0, 0, 2, 3, 0, 0, '0000-00-00 00:00:00'),
(10, 'priyanka.g@quadrupleindia.com', 'e10adc3949ba59abbe56e057f20f883e', 'priyanka', NULL, NULL, 'priyanka', 0, 0, 0, 0, 0, 0, 1, 1, '2015-08-03 08:21:08'),
(11, 'rajeshkumar.s@quadrupleindia.com', 'e10adc3949ba59abbe56e057f20f883e', 'rajeshkumar', NULL, NULL, 'rajeshkumar', 0, 0, 0, 0, 1, 0, 0, 0, '2015-08-03 03:12:15'),
(12, 'priya@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'priyanka', NULL, NULL, 'priyanka', 0, 0, 0, 0, 2, 4, 0, 0, '0000-00-00 00:00:00'),
(15, 'priyanka.g@quadrupleindia.com', '1df3746a4728276afdc24f828186f73a', 'priya', NULL, NULL, 'priya', 0, 0, 0, 0, 2, 7, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_notification_setting`
--

CREATE TABLE IF NOT EXISTS `users_notification_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_mail` int(11) DEFAULT NULL,
  `announcement` int(11) DEFAULT NULL,
  `feedback` int(11) DEFAULT NULL,
  `survival` text,
  `answer_nofitication` int(11) DEFAULT NULL,
  `comment_replies` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
