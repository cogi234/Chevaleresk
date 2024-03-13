CREATE SCHEMA IF NOT EXISTS dbchevalersk9 DEFAULT CHARACTER SET utf8 ;
USE dbchevalersk9 ;

DROP PROCEDURE IF EXISTS ajouterArme;
DELIMITER |
CREATE PROCEDURE ajouterArme(
	in pNom VARCHAR(100),
    in pDescription TEXT,
    in pPrix INT,
    in pQuantiteStock INT,
    in pVendable TINYINT,
    in pImage TEXT,
    in pEfficacite INT,
    in pTypeArme VARCHAR(40))
BEGIN
	DECLARE pIdItem INT;
    START TRANSACTION;
		INSERT INTO items(nom, description, prix, quantiteStock, type, vendable, image)
			VALUES(pNom, pDescription, pPrix, pQuantiteStock, "arme", pVendable, pImage);
		SELECT LAST_INSERT_ID() INTO pIdItem;
        INSERT INTO armes(idItem, efficacite, type)
			VALUES(pIdItem, pEfficacite, pTypeArme);
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS ajouterArmure;
DELIMITER |
CREATE PROCEDURE ajouterArmure(
	in pNom VARCHAR(100),
    in pDescription TEXT,
    in pPrix INT,
    in pQuantiteStock INT,
    in pVendable TINYINT,
    in pImage TEXT,
    in pMateriel VARCHAR(40),
    in pTaille ENUM("petit", "moyen", "grand"))
BEGIN
	DECLARE pIdItem INT;
    START TRANSACTION;
		INSERT INTO items(nom, description, prix, quantiteStock, type, vendable, image)
			VALUES(pNom, pDescription, pPrix, pQuantiteStock, "armure", pVendable, pImage);
		SELECT LAST_INSERT_ID() INTO pIdItem;
        INSERT INTO armures(idItem, materiel, taille)
			VALUES(pIdItem, pMateriel, pTaille);
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS ajouterPotion;
DELIMITER |
CREATE PROCEDURE ajouterPotion(
	in pNom VARCHAR(100),
    in pDescription TEXT,
    in pPrix INT,
    in pQuantiteStock INT,
    in pVendable TINYINT,
    in pImage TEXT,
    in pTypePotion ENUM("offense", "defense"),
    in pEffet VARCHAR(40),
    in pDuree INT)
BEGIN
	DECLARE pIdItem INT;
    START TRANSACTION;
		INSERT INTO items(nom, description, prix, quantiteStock, type, vendable, image)
			VALUES(pNom, pDescription, pPrix, pQuantiteStock, "potion", pVendable, pImage);
		SELECT LAST_INSERT_ID() INTO pIdItem;
        INSERT INTO potions(idItem, type, effet, duree)
			VALUES(pIdItem, pTypePotion, pEffet, pDuree);
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS ajouterIngredient;
DELIMITER |
CREATE PROCEDURE ajouterIngredient(
	in pNom VARCHAR(100),
    in pDescription TEXT,
    in pPrix INT,
    in pQuantiteStock INT,
    in pVendable TINYINT,
    in pImage TEXT,
    in pTypeIngredient VARCHAR(40),
    in pRarete INT,
    in pDanger INT)
BEGIN
	DECLARE pIdItem INT;
    START TRANSACTION;
		INSERT INTO items(nom, description, prix, quantiteStock, type, vendable, image)
			VALUES(pNom, pDescription, pPrix, pQuantiteStock, "ingredient", pVendable, pImage);
		SELECT LAST_INSERT_ID() INTO pIdItem;
        INSERT INTO ingredients(idItem, type, rarete, danger)
			VALUES(pIdItem, pTypeIngredient, pRarete, pDanger);
    COMMIT;
END |
DELIMITER ;