
DROP TABLE IF EXISTS `envelope`;
CREATE TABLE IF NOT EXISTS `envelope` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `AccountId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Color` varchar(100) NOT NULL DEFAULT 'Black',
  `CalculationType` varchar(3) NOT NULL,
  `CalculationAmount` bigint(20) NOT NULL DEFAULT '0',
  `IsClosed` tinyint(1) NOT NULL DEFAULT '0',
  `CreatedOn` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `FK_EnvelopesAccountId_ToAccountId` (`AccountId`),
  KEY `FK_EnvelopesCreatedBy_ToUsersId` (`CreatedBy`),
  KEY `FK_EnvelopesModifiedBy_ToUsersId` (`ModifiedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
