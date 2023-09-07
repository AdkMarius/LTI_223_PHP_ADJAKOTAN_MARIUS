CREATE DATABASE IF NOT EXISTS doc_bank;
USE doc_bank;

CREATE TABLE IF NOT EXISTS Users
(
    idUser INTEGER AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (idUser)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Documents
(
    idDoc INTEGER AUTO_INCREMENT,
    idUser INTEGER NOT NULL,
    topicDoc VARCHAR(255) NOT NULL,
    titleDoc VARCHAR(255) NOT NULL,
    summaryDoc TEXT NOT NULL,
    keywords TEXT NOT NULL,
    pathImageDoc VARCHAR(255) NOT NULL,
    pathDoc VARCHAR(255) NOT NULL,
    dateInsertDoc DATETIME,
    PRIMARY KEY (idDoc),
    FOREIGN KEY (idUser) REFERENCES Users(idUser)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Authors
(
    idAuthor INTEGER AUTO_INCREMENT,
    nameAuthor VARCHAR(64) NOT NULL,
    firstName VARCHAR(64),
    PRIMARY KEY (idAuthor)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS DocumentsAuthors
(
    idDocAut INTEGER AUTO_INCREMENT,
    idDoc INTEGER,
    idAuthor INTEGER,
    PRIMARY KEY (idDocAut),
    FOREIGN KEY (idDoc) REFERENCES Documents(idDoc),
    FOREIGN KEY (idAuthor) REFERENCES Authors(idAuthor)
) ENGINE=InnoDB;