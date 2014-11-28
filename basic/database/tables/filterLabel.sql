

DROP TABLE IF EXISTS `filterLabel`;
CREATE TABLE IF NOT EXISTS `filterLabel` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FilterId` int(11) NOT NULL,
  `Label` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_FilterLabelsFilterId_ToFiltersId` (`FilterId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
