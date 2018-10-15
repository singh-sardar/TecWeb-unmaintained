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
    `Categoria` ENUM('Arte Contemporanea','Arte Moderna','Astrattismo') NOT NULL, -- altro?
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