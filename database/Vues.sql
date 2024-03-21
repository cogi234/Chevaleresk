CREATE SCHEMA IF NOT EXISTS dbchevalersk9 DEFAULT CHARACTER SET utf8 ;
USE dbchevalersk9 ;

DROP VIEW IF EXISTS vInventaire;
CREATE VIEW vInventaire AS SELECT idJoueur, iv.idItem, nom, description, prix, quantiteStock, type, vendable, image, quantite
	FROM inventaire iv INNER JOIN items it ON iv.idItem = it.idItem;

DROP VIEW IF EXISTS vPanier;
CREATE VIEW vPanier AS SELECT idJoueur, p.idItem, nom, description, prix, quantiteStock, type, vendable, image, quantite
	FROM panier p INNER JOIN items i ON p.idItem = i.idItem;