SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `custom-orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `Container`
--

CREATE TABLE IF NOT EXISTS `Container` (
  `ContainerID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Shape` varchar(20) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `Weight` double(10,5) NOT NULL,
  `Desc` varchar(50) NOT NULL,
  `Price` double(10,5) NOT NULL,
  `OrderID` mediumint(9) NOT NULL,
  `Quantity` int(3) NOT NULL,
  PRIMARY KEY (`ContainerID`),
  KEY `OrderID` (`OrderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `Container`
--

INSERT INTO `Container` (`ContainerID`, `Shape`, `Color`, `Weight`, `Desc`, `Price`, `OrderID`, `Quantity`) VALUES
(3, 'Basket', 'AliceBlue', 17.50000, 'blah', 12.00000, 2, 1),
(7, 'Basket', 'Coral', 1.00000, 'Wonderful', 100.00000, 2, 10),
(8, 'Round', 'Wire', 15.25000, 'Blah', 35.00000, 5, 3),
(9, 'Round', 'Wire', 15.25000, 'Blah', 35.00000, 6, 3),
(10, 'Round', 'Wire', 15.25000, 'Blah', 37.00000, 7, 3),
(11, 'Round', 'Green', 1.00000, 'Strawberry pots', 1.00000, 8, 56),
(12, 'Basket', 'Gold', 1005.00000, 'A very large golden basket containing blue winter ', 1000.00000, 9, 1),
(13, 'Hanging Basket', 'Red', 902.00000, 'blah', 89.00000, 10, 2),
(14, 'Basket', 'Purple', 67.00000, 'Blah', 30.00000, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ContainerPlant`
--

CREATE TABLE IF NOT EXISTS `ContainerPlant` (
  `ContainerID` mediumint(9) NOT NULL,
  `PlantID` mediumint(9) NOT NULL,
  `Quantity` int(3) NOT NULL,
  PRIMARY KEY (`ContainerID`,`PlantID`),
  KEY `PlantID` (`PlantID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ContainerPlant`
--

INSERT INTO `ContainerPlant` (`ContainerID`, `PlantID`, `Quantity`) VALUES
(3, 1, 3),
(3, 7, 1),
(3, 2, 1),
(3, 4, 1),
(8, 9, 7),
(9, 9, 7),
(10, 9, 7),
(11, 11, 56),
(12, 12, 1),
(13, 13, 1),
(14, 1, 3),
(14, 10, 1),
(14, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE IF NOT EXISTS `Customer` (
  `CustomerID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`CustomerID`, `Name`, `Address`, `Phone`, `Email`) VALUES
(1, 'Kyle Nichols', '1740 NW 14 St. Corvallis, OR 9', '5037797354', 'nichokyl@onid.oregonstate.edu'),
(2, 'Cody Hoeft', 'blah', 'blah', 'blah@blah.com'),
(7, 'Jon Snow', 'nd', '89325', 'sdafd@gand.com'),
(5, 'Dany Targaryen', 'B', 'C', 'D@a'),
(6, 'Judy Corey', 'adg', '5461854164', 'blah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Order`
--

CREATE TABLE IF NOT EXISTS `Order` (
  `OrderID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `DateOrdered` date NOT NULL,
  `QuotedPrice` double(10,5) NOT NULL,
  `TotalPaid` double(10,5) NOT NULL,
  `CustomerID` mediumint(9) NOT NULL,
  `Complete` tinyint(1) NOT NULL,
  `PickedUp` tinyint(1) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Order`
--

INSERT INTO `Order` (`OrderID`, `DateOrdered`, `QuotedPrice`, `TotalPaid`, `CustomerID`, `Complete`, `PickedUp`) VALUES
(4, '2014-12-18', 20.00000, 10.00000, 1, 1, 1),
(2, '2014-01-27', 0.00000, 0.00000, 1, 1, 1),
(3, '2014-06-06', 15.00000, 10.00000, 1, 1, 0),
(5, '2011-01-08', 105.00000, 105.00000, 6, 1, 1),
(6, '2013-01-08', 105.00000, 105.00000, 6, 1, 1),
(7, '2014-01-08', 111.00000, 111.00000, 6, 1, 0),
(8, '2014-12-08', 56.00000, 26.00000, 2, 0, 0),
(9, '2014-11-02', 1000.00000, 1000.00000, 5, 1, 0),
(10, '0000-00-00', 0.00000, 0.00000, 7, 0, 0),
(11, '0000-00-00', 0.00000, 0.00000, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Plant`
--

CREATE TABLE IF NOT EXISTS `Plant` (
  `PlantID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `ScientificName` varchar(30) NOT NULL,
  `Color` varchar(15) NOT NULL,
  `Picture` varchar(30) DEFAULT NULL,
  `CommonName` varchar(30) NOT NULL,
  PRIMARY KEY (`PlantID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Plant`
--

INSERT INTO `Plant` (`PlantID`, `ScientificName`, `Color`, `Picture`, `CommonName`) VALUES
(1, 'blah', 'SeaGreen', NULL, 'Petunia'),
(2, 'blah', 'White', 'example2.jpg', 'Petunia'),
(4, 'blah2', 'Red', NULL, 'Petunia'),
(7, 'bla', 'Blue', 'example3.jpg', 'Lily'),
(8, 'Red', 'Red', NULL, 'Petunia'),
(9, 'dknfa', 'Bordeaux', NULL, 'Supas'),
(10, 'blah', 'Purple', NULL, 'Verbena'),
(11, 'Fragaria ananassa', 'Red', NULL, 'Strawberries'),
(12, 'Blah', 'Blue', 'example.jpg', 'Blue Winter Rose'),
(13, 'Rosa', 'Red', NULL, 'Rose');
