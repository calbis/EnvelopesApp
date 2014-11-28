

DROP TABLE IF EXISTS `userFilter`;
CREATE TABLE IF NOT EXISTS `userFilter` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `TransactionName` varchar(255) DEFAULT NULL,
  `PostedDateGreater` date DEFAULT NULL,
  `PostedDateLess` date DEFAULT NULL,
  `Amount` decimal(19,2) DEFAULT NULL,
  `AmountOperator` varchar(2) DEFAULT NULL,
  `Pending` decimal(19,2) DEFAULT NULL,
  `PendingOperator` varchar(2) DEFAULT NULL,
  `UseInStats` tinyint(1) DEFAULT NULL,
  `IsRefund` tinyint(1) DEFAULT NULL,
  `UserId` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `IsActive` tinyint(1) NOT NULL DEFAULT '0',
  `IsFavorite` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `FK_FiltersCreatedBy_ToUsersId` (`UserId`),
  KEY `FK_FiltersModifiedBy_ToUsersId` (`ModifiedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
