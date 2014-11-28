

DROP TABLE IF EXISTS `userAccount`;
CREATE TABLE IF NOT EXISTS `userAccount` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `IsOwner` tinyint(1) NOT NULL,
  `CanEditStructure` tinyint(1) NOT NULL,
  `CanAddTransactions` tinyint(1) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_UserAccountsUserId_ToUsersId` (`UserId`),
  KEY `FK_UserAccountsAccountId_ToAccountId` (`AccountId`),
  KEY `FK_UserAccountsCreatedBy_ToUsersId` (`CreatedBy`),
  KEY `FK_UserAccountsModifiedBy_ToUsersId` (`ModifiedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
