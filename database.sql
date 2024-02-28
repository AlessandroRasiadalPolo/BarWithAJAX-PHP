CREATE DATABASE IF NOT EXISTS Bar;
USE Bar;

CREATE TABLE IF NOT EXISTS prodotto(
    IDProdotto INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(255),
    Prezzo DECIMAL(5,2)
);

CREATE TABLE IF NOT EXISTS cameriere(
    IDCameriere INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS ordinazione(
    IDOrdinazione INT AUTO_INCREMENT PRIMARY KEY,
    IDProdotto INT,
    IDCameriere INT,
    Quantita INT,
    Stato ENUM('in attesa', 'servito'),
    DataOra DATETIME,
    FOREIGN KEY (IDProdotto) REFERENCES prodotto(IDProdotto),
    FOREIGN KEY (IDCameriere) REFERENCES cameriere(IDCameriere)
);



INSERT INTO cameriere(Nome) VALUES ("Luciano");
INSERT INTO cameriere(Nome) VALUES ("Giovanni");
INSERT INTO cameriere(Nome) VALUES ("Elisa");

INSERT INTO prodotto(Nome, Prezzo) VALUES ("Formaggio", 4.5);
INSERT INTO prodotto(Nome, Prezzo) VALUES ("Salame", 5.5);
INSERT INTO prodotto(Nome, Prezzo) VALUES ("Carbonara", 12.3);

