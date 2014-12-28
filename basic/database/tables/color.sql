-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2014 at 05:47 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `basic`
--

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `Id` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  UNIQUE KEY `Id` (`Id`,`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `color`
--

TRUNCATE TABLE `color`;
--
-- Dumping data for table `color`
--

INSERT INTO `color` (`Id`, `Name`) VALUES
('AliceBlue', 'AliceBlue'),
('AntiqueWhite', 'AntiqueWhite'),
('Aqua', 'Aqua'),
('Aquamarine', 'Aquamarine'),
('Azure', 'Azure'),
('Beige', 'Beige'),
('Bisque', 'Bisque'),
('Black', 'Black'),
('BlanchedAlmond', 'BlanchedAlmond'),
('Blue', 'Blue'),
('BlueViolet', 'BlueViolet'),
('Brown', 'Brown'),
('BurlyWood', 'BurlyWood'),
('CadetBlue', 'CadetBlue'),
('Chartreuse', 'Chartreuse'),
('Chocolate', 'Chocolate'),
('Coral', 'Coral'),
('CornflowerBlue', 'CornflowerBlue'),
('Cornsilk', 'Cornsilk'),
('Crimson', 'Crimson'),
('Cyan', 'Cyan'),
('DarkBlue', 'DarkBlue'),
('DarkCyan', 'DarkCyan'),
('DarkGoldenRod', 'DarkGoldenRod'),
('DarkGray', 'DarkGray'),
('DarkGreen', 'DarkGreen'),
('DarkKhaki', 'DarkKhaki'),
('DarkMagenta', 'DarkMagenta'),
('DarkOliveGreen', 'DarkOliveGreen'),
('DarkOrange', 'DarkOrange'),
('DarkOrchid', 'DarkOrchid'),
('DarkRed', 'DarkRed'),
('DarkSalmon', 'DarkSalmon'),
('DarkSeaGreen', 'DarkSeaGreen'),
('DarkSlateBlue', 'DarkSlateBlue'),
('DarkSlateGray', 'DarkSlateGray'),
('DarkTurquoise', 'DarkTurquoise'),
('DarkViolet', 'DarkViolet'),
('DeepPink', 'DeepPink'),
('DeepSkyBlue', 'DeepSkyBlue'),
('DimGray', 'DimGray'),
('DodgerBlue', 'DodgerBlue'),
('FireBrick', 'FireBrick'),
('FloralWhite', 'FloralWhite'),
('ForestGreen', 'ForestGreen'),
('Fuchsia', 'Fuchsia'),
('Gainsboro', 'Gainsboro'),
('GhostWhite', 'GhostWhite'),
('Gold', 'Gold'),
('GoldenRod', 'GoldenRod'),
('Gray', 'Gray'),
('Green', 'Green'),
('GreenYellow', 'GreenYellow'),
('HoneyDew', 'HoneyDew'),
('HotPink', 'HotPink'),
('IndianRed', 'IndianRed'),
('Indigo', 'Indigo'),
('Ivory', 'Ivory'),
('Khaki', 'Khaki'),
('Lavender', 'Lavender'),
('LavenderBlush', 'LavenderBlush'),
('LawnGreen', 'LawnGreen'),
('LemonChiffon', 'LemonChiffon'),
('LightBlue', 'LightBlue'),
('LightCoral', 'LightCoral'),
('LightCyan', 'LightCyan'),
('LightGoldenRodYellow', 'LightGoldenRodYellow'),
('LightGray', 'LightGray'),
('LightGreen', 'LightGreen'),
('LightPink', 'LightPink'),
('LightSalmon', 'LightSalmon'),
('LightSeaGreen', 'LightSeaGreen'),
('LightSkyBlue', 'LightSkyBlue'),
('LightSlateGray', 'LightSlateGray'),
('LightSteelBlue', 'LightSteelBlue'),
('LightYellow', 'LightYellow'),
('Lime', 'Lime'),
('LimeGreen', 'LimeGreen'),
('Linen', 'Linen'),
('Magenta', 'Magenta'),
('Maroon', 'Maroon'),
('MediumAquaMarine', 'MediumAquaMarine'),
('MediumBlue', 'MediumBlue'),
('MediumOrchid', 'MediumOrchid'),
('MediumPurple', 'MediumPurple'),
('MediumSeaGreen', 'MediumSeaGreen'),
('MediumSlateBlue', 'MediumSlateBlue'),
('MediumSpringGreen', 'MediumSpringGreen'),
('MediumTurquoise', 'MediumTurquoise'),
('MediumVioletRed', 'MediumVioletRed'),
('MidnightBlue', 'MidnightBlue'),
('MintCream', 'MintCream'),
('MistyRose', 'MistyRose'),
('Moccasin', 'Moccasin'),
('NavajoWhite', 'NavajoWhite'),
('Navy', 'Navy'),
('OldLace', 'OldLace'),
('Olive', 'Olive'),
('OliveDrab', 'OliveDrab'),
('Orange', 'Orange'),
('OrangeRed', 'OrangeRed'),
('Orchid', 'Orchid'),
('PaleGoldenRod', 'PaleGoldenRod'),
('PaleGreen', 'PaleGreen'),
('PaleTurquoise', 'PaleTurquoise'),
('PaleVioletRed', 'PaleVioletRed'),
('PapayaWhip', 'PapayaWhip'),
('PeachPuff', 'PeachPuff'),
('Peru', 'Peru'),
('Pink', 'Pink'),
('Plum', 'Plum'),
('PowderBlue', 'PowderBlue'),
('Purple', 'Purple'),
('Red', 'Red'),
('RosyBrown', 'RosyBrown'),
('RoyalBlue', 'RoyalBlue'),
('SaddleBrown', 'SaddleBrown'),
('Salmon', 'Salmon'),
('SandyBrown', 'SandyBrown'),
('SeaGreen', 'SeaGreen'),
('SeaShell', 'SeaShell'),
('Sienna', 'Sienna'),
('Silver', 'Silver'),
('SkyBlue', 'SkyBlue'),
('SlateBlue', 'SlateBlue'),
('SlateGray', 'SlateGray'),
('Snow', 'Snow'),
('SpringGreen', 'SpringGreen'),
('SteelBlue', 'SteelBlue'),
('Tan', 'Tan'),
('Teal', 'Teal'),
('Thistle', 'Thistle'),
('Tomato', 'Tomato'),
('Turquoise', 'Turquoise'),
('Violet', 'Violet'),
('Wheat', 'Wheat'),
('White', 'White'),
('WhiteSmoke', 'WhiteSmoke'),
('Yellow', 'Yellow'),
('YellowGreen', 'YellowGreen');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;