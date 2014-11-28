

DROP TABLE IF EXISTS `filterEnvelope`;
CREATE TABLE IF NOT EXISTS `filterEnvelope` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FilterId` int(11) NOT NULL,
  `EnvelopeId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_FiltersFilterId_ToFiltersId` (`FilterId`),
  KEY `FK_FiltersEnvelopeId_ToEnvelopesId` (`EnvelopeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
