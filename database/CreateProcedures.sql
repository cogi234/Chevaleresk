CREATE SCHEMA IF NOT EXISTS dbchevalersk9 DEFAULT CHARACTER SET utf8 ;
USE dbchevalersk9 ;

-- Ajouts d'items
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

-- Inscription et connection
DROP PROCEDURE IF EXISTS inscription;
DELIMITER |
CREATE PROCEDURE inscription(
	in pAlias VARCHAR(40),
    in pMotDePasse TEXT,
    in pEstAdmin BOOLEAN)
BEGIN
	DECLARE pMotDePasseEncrypte TEXT;
    START TRANSACTION;
		SET pMotDePasseEncrypte = sha2(pMotDePasse, 512);
		INSERT INTO joueurs(alias, motDePasse, estAdmin, avatar) VALUES(pAlias, pMotDePasseEncrypte, pEstAdmin, "default.png");
    COMMIT;
END |
DELIMITER ;

DROP FUNCTION IF EXISTS connect;
DELIMITER |
CREATE FUNCTION connect(pAlias VARCHAR(40), pMotDePasse TEXT) RETURNS BOOLEAN
BEGIN
	DECLARE pMotDePasseEncrypte TEXT;
    DECLARE pCount INT;
	SET pMotDePasseEncrypte = sha2(pMotDePasse, 512);
	SELECT COUNT(idJoueur) INTO pCount FROM joueurs WHERE alias = pAlias AND motDePasse = pMotDePasseEncrypte;
    IF (pCount = 1) THEN
		RETURN TRUE;
	ELSE
		RETURN FALSE;
	END IF;
END |
DELIMITER ;
