CREATE DATABASE TecWeb;
USE TecWeb;

CREATE TABLE Artisti (
    `Username` varchar(30) NOT NULL,
    `Password` varchar(256) NOT NULL,
    `Nome` varchar(100) NOT NULL,
    `Cognome` varchar(100) NOT NULL,
    PRIMARY KEY(`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE Opere (
    `Nome` varchar(30) NOT NULL,
    `Descrizione` varchar(200),
    `Data_upload` DATETIME NOT NULL,
    `Artista` varchar(30) NOT NULL,
    `Categoria` ENUM('Landscape','Fantasy','Abstract','Cartoon','Portrait','Nature','Others') NOT NULL, -- altro?
    PRIMARY KEY(`Nome`, `Artista`),
    FOREIGN KEY(`Artista`) REFERENCES `Artisti` (`Username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE Likes (
    `Opera` varchar(30) NOT NULL,
    `Utente` varchar(30) NOT NULL,
    `Creatore` varchar(30) NOT NULL,
    PRIMARY KEY(`Opera`, `Creatore`, `Utente`),
    FOREIGN KEY(`Opera`, `Creatore`) REFERENCES `Opere` (`Nome`, `Artista`) ON UPDATE CASCADE,
    FOREIGN KEY(`Utente`) REFERENCES `Artisti` (`Username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE Commenti (
    `ID` int(8) NOT NULL AUTO_INCREMENT,
    `Opera` varchar(30) NOT NULL,
    `Utente` varchar(30) NOT NULL,
    `Creatore` varchar(30) NOT NULL,
    `Commento` varchar(200) NOT NULL,
    PRIMARY KEY(`ID`),
    FOREIGN KEY(`Opera`, `Creatore`) REFERENCES `Opere` (`Nome`, `Artista`) ON UPDATE CASCADE,
    FOREIGN KEY(`Utente`) REFERENCES `Artisti` (`Username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;  

INSERT INTO Artisti (`Username`, `Password`, `Nome`, `Cognome`) VALUES ('daniele.bianchin','f69613c60164b7c802db39fd256d626ead320e107ae7fd4f043f56e3d27148ef', 'Daniele', 'Bianchin');
INSERT INTO Opere (`Nome`, `Descrizione`, `Data_upload`, `Artista`, `Categoria`) VALUES ('Carpe Noctem', 'Unkown', '2017-05-06 22:51:59','daniele.bianchin' ,'Fantasy');
INSERT INTO Opere (`Nome`, `Descrizione`, `Data_upload`, `Artista`, `Categoria`) VALUES ('High Altitude Vegetation', 'Unkown', '2017-02-11 13:20:11','daniele.bianchin' ,'Fantasy');
INSERT INTO Opere (`Nome`, `Descrizione`, `Data_upload`, `Artista`, `Categoria`) VALUES ('Super Orbit', 'Unkown', '2018-01-21 17:21:11','daniele.bianchin' ,'Fantasy');
INSERT INTO Opere (`Nome`, `Descrizione`, `Data_upload`, `Artista`, `Categoria`) VALUES ('Water on Planet X', 'Unkown', '2018-07-22 17:34:11','daniele.bianchin' ,'Fantasy');
INSERT INTO Opere (`Nome`, `Descrizione`, `Data_upload`, `Artista`, `Categoria`) VALUES ('Wild-fi', 'Unkown', '2018-07-22 17:34:11','daniele.bianchin' ,'Fantasy');

INSERT INTO Commenti (`ID`, `Opera`, `Utente`, `Creatore`, `Commento`) VALUES (0, 'Carpe Noctem', 'daniele.bianchin', 'daniele.bianchin', 'Auto-commento');
INSERT INTO Likes (`Opera`,`Utente`, `Creatore`) VALUES ('Carpe Noctem', 'daniele.bianchin', 'daniele.bianchin');
