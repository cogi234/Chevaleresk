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

-- Inscription et connexion
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

-- Inventaire
DROP PROCEDURE IF EXISTS ajouterInventaire;
DELIMITER |
CREATE PROCEDURE ajouterInventaire(in pIdJoueur INT, in pIdItem INT, in pQuantite INT)
BEGIN
	DECLARE pExistant INT;
    SELECT COUNT(*) INTO pExistant FROM inventaire WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
    START TRANSACTION;
		IF (pExistant > 0) THEN
			UPDATE inventaire SET quantite = quantite + pQuantite WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
        ELSE
			INSERT INTO inventaire(idJoueur, idItem, quantite) VALUES(pIdJoueur, pIdItem, pQuantite);
        END IF;
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS enleverInventaire;
DELIMITER |
CREATE PROCEDURE enleverInventaire(in pIdJoueur INT, in pIdItem INT, in pQuantite INT)
BEGIN
	DECLARE pExistant INT;
    DECLARE pQuantiteOriginale INT;
    START TRANSACTION;
		SELECT COUNT(*) INTO pExistant FROM inventaire WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
		SELECT quantite INTO pQuantiteOriginale FROM inventaire WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
		IF (pExistant = 0) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "On essaie d'enlever quelque chose qui n'est pas dans l'inventaire!";
        END IF;
        
        if (pQuantite >= pQuantiteOriginale) THEN
			DELETE FROM inventaire WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
        ELSE
			UPDATE inventaire SET quantite = quantite - pQuantite WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
        END IF;
    COMMIT;
END |
DELIMITER ;

-- Panier
DROP PROCEDURE IF EXISTS ajouterPanier;
DELIMITER |
CREATE PROCEDURE ajouterPanier(in pIdJoueur INT, in pIdItem INT, in pQuantite INT)
BEGIN
	DECLARE pExistant INT;
    SELECT COUNT(*) INTO pExistant FROM panier WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
    START TRANSACTION;
		IF (pExistant > 0) THEN
			UPDATE panier SET quantite = quantite + pQuantite WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
        ELSE
			INSERT INTO panier(idJoueur, idItem, quantite) VALUES(pIdJoueur, pIdItem, pQuantite);
        END IF;
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS enleverPanier;
DELIMITER |
CREATE PROCEDURE enleverPanier(in pIdJoueur INT, in pIdItem INT, in pQuantite INT)
BEGIN
	DECLARE pExistant INT;
    SELECT quantite INTO pExistant FROM panier WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
    START TRANSACTION;
		IF (pExistant > pQuantite) THEN
			UPDATE panier SET quantite = quantite - pQuantite WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
		ELSE
			DELETE FROM panier WHERE idJoueur = pIdJoueur AND idItem = pIdItem;
		END IF;
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS viderPanier;
DELIMITER |
CREATE PROCEDURE viderPanier(in pIdJoueur INT)
BEGIN
    START TRANSACTION;
		DELETE FROM panier WHERE idJoueur = pIdJoueur;
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS acheterPanier;
DELIMITER |
CREATE PROCEDURE acheterPanier(in pIdJoueur INT)
BEGIN
	DECLARE pPrixTotal INT;
	DECLARE pSolde INT;
    DECLARE pStockManquant INT;
    DECLARE i INT;
    DECLARE pCountPanier INT;
    DECLARE pIdItem INT;
    DECLARE pQuantite INT;
    START TRANSACTION;
		SELECT SUM(quantite - quantiteStock) INTO pStockManquant FROM vPanier WHERE idJoueur = pIdJoueur;
        SELECT SUM(prix * quantite) INTO pPrixTotal FROM vPanier WHERE idJoueur = pIdJoueur;
        SELECT COUNT(*) INTO pCountPanier FROM vPanier WHERE idJoueur = pIdJoueur;
        SELECT solde INTO pSolde FROM joueurs WHERE idJoueur = pIdJoueur;
        IF (pStockManquant > 0) THEN
			ROLLBACK;
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Il manque du stock pour les achats";
		END IF;
        IF (pPrixTotal > pSolde) THEN
			ROLLBACK;
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Il n'y a pas assez de solde pour les achats";
		END IF;
        
        -- Baisser solde
        UPDATE joueurs SET solde = solde - pPrixTotal WHERE idJoueur = pIdJoueur;
        UPDATE joueurs SET nbEcuDepense = nbEcuDepense + pPrixTotal WHERE idJoueur = pIdJoueur;
        
        -- Ajout a l'inventaire, diminue stock et vide panier
		SET i = 0;
        WHILE i < pCountPanier DO
			SELECT idItem INTO pIdItem FROM vPanier WHERE idJoueur = pIdJoueur LIMIT 1;
			SELECT quantite INTO pQuantite FROM vPanier WHERE idJoueur = pIdJoueur LIMIT 1;
            CALL ajouterInventaire(pIdJoueur, pIdItem, pQuantite);
            UPDATE items SET quantiteStock = quantiteStock - pQuantite;
            CALL enleverPanier(pIdJoueur, pIdItem, pQuantite);
            SET i = i + 1;
        END WHILE;
    COMMIT;
END |
DELIMITER ;

-- Quetes
DROP PROCEDURE IF EXISTS ajouterEnigme;
DELIMITER |
CREATE PROCEDURE ajouterEnigme(in pTitre TEXT, in pQuestion TEXT, in pDifficulte INT, in pAlchimie BOOLEAN)
BEGIN
    START TRANSACTION;
		INSERT INTO enigmes(titre, question, difficulte, alchimie)
			VALUES(pTitre, pQuestion, pDifficulte, pAlchimie);
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS ajouterReponse;
DELIMITER |
CREATE PROCEDURE ajouterReponse(in pIdEnigme INT, in pTexte TEXT, in pCorrect BOOLEAN)
BEGIN
    START TRANSACTION;
		INSERT INTO reponses(texte, correct, idEnigme)
			VALUES(pTexte, pCorrect, pIdEnigme);
    COMMIT;
END |
DELIMITER ;

DROP FUNCTION IF EXISTS respond;
DELIMITER |
CREATE FUNCTION respond(pIdJoueur INT, pIdReponse INT) RETURNS BOOLEAN
BEGIN
	DECLARE pCorrect, pAlchimie BOOLEAN;
    DECLARE pIdEnigme, pNbQueteAlchimie, pNiveauAlchimie, pDifficulte INT;
    
    SELECT correct INTO pCorrect FROM reponses WHERE idReponse = pIdReponse;
    SELECT idEnigme INTO pIdEnigme FROM reponses WHERE idReponse = pIdReponse;
    SELECT difficulte INTO pDifficulte FROM enigmes WHERE idEnigme = pIdEnigme;
    SELECT alchimie INTO pAlchimie FROM enigmes WHERE idEnigme = pIdEnigme;
    
	IF (pCorrect = TRUE) THEN
		IF (pAlchimie = TRUE) THEN
			UPDATE joueurs SET nbQueteAlchimie = nbQueteAlchimie + 1 WHERE idJoueur = pIdJoueur;
			SELECT nbQueteAlchimie INTO pNbQueteAlchimie FROM joueurs WHERE idJoueur = pIdJoueur;
			SELECT niveauAlchimie INTO pNiveauAlchimie FROM joueurs WHERE idJoueur = pIdJoueur;
			IF (pNbQueteAlchimie >= 3 AND pNiveauAlchimie = 0) THEN
				UPDATE joueurs SET niveauAlchimie = 1 WHERE idJoueur = pIdJoueur;
			END IF;
		END IF;
		UPDATE joueurs SET nbQueteReussie = nbQueteReussie + 1 WHERE idJoueur = pIdJoueur;
           
		UPDATE joueurs SET solde = solde + CASE
				WHEN pDifficulte = 1 THEN 50
				WHEN pDifficulte = 2 THEN 100
				WHEN pDifficulte = 3 THEN 200
				ELSE 0
				END
			WHERE idJoueur = pIdJoueur;
		UPDATE joueurs SET nbEcuGagne = nbEcuGagne + CASE
				WHEN pDifficulte = 1 THEN 50
				WHEN pDifficulte = 2 THEN 100
				WHEN pDifficulte = 3 THEN 200
				ELSE 0
				END
			WHERE idJoueur = pIdJoueur;
           
		RETURN TRUE;
	ELSE
		UPDATE joueurs SET nbQueteEchoue = nbQueteEchoue + 1 WHERE idJoueur = pIdJoueur;
		RETURN FALSE;
	END IF;
END |
DELIMITER ;

-- Recettes
DROP PROCEDURE IF EXISTS ajouterRecette;
DELIMITER |
CREATE PROCEDURE ajouterRecette(in pIdProduit INT, in pNiveauAlchimie INT)
BEGIN
    START TRANSACTION;
		INSERT INTO recettes(idProduit, niveauAlchimie)
			VALUES(pIdProduit, pNiveauAlchimie);
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS ajouterIngredientRecette;
DELIMITER |
CREATE PROCEDURE ajouterIngredientRecette(in pIdRecette INT, in pIdIngredient INT, in pQuantite INT)
BEGIN
	DECLARE pExistant INT;
    SELECT COUNT(*) INTO pExistant FROM ingredientRecette WHERE idRecette = pIdRecette AND idIngredient = pIdIngredient;
    START TRANSACTION;
		IF (pExistant > 0) THEN
			UPDATE ingredientRecette SET quantite = pQuantite WHERE idRecette = pIdRecette AND idIngredient = pIdIngredient;
        ELSE
			INSERT INTO ingredientRecette(idRecette, idIngredient, quantite) VALUES(pIdRecette, pIdIngredient, pQuantite);
        END IF;
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS concocterRecette;
DELIMITER |
CREATE PROCEDURE concocterRecette(in pIdRecette INT, in pIdJoueur INT, in pQuantite INT)
BEGIN
	DECLARE pExistant, pIngredientsManquants INT;
    DECLARE pIdIngredient, pQuantiteIngredient, pIdPotion, pNiveauAlchimie, pNbPotionCree INT;
    DECLARE done BOOLEAN DEFAULT FALSE;
    
    DECLARE ingredientCursor CURSOR FOR SELECT idIngredient, quantite FROM ingredientRecette WHERE idRecette = pIdRecette;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    START TRANSACTION;
		SELECT COUNT(*) INTO pExistant FROM recettes WHERE idRecette = pIdRecette;
		SELECT COUNT(*) INTO pIngredientsManquants FROM ingredientRecette r INNER JOIN inventaire i ON i.idItem = r.idIngredient 
			WHERE r.idRecette = pIdRecette AND i.idJoueur = pIdJoueur AND (r.quantite * pQuantite) > i.quantite;
		
        IF (pExistant = 0) THEN
			ROLLBACK;
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "La recette n'existe pas!";
		END IF;
        IF (pIngredientsManquants > 0) THEN
			ROLLBACK;
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "On manque d'ingredients!";
		END IF;
        
        ingredient_loop: LOOP
			FETCH ingredientCursor INTO pIdIngredient, pQuantiteIngredient;
            IF done THEN
				LEAVE ingredient_loop;
            END IF;
            
            SET pQuantiteIngredient = pQuantiteIngredient * pQuantite;
			CALL enleverInventaire(pIdJoueur, pIdIngredient, pQuantiteIngredient);
        END LOOP;
        
		SELECT idProduit INTO pIdPotion FROM recettes WHERE idRecette = pIdRecette;
        CALL ajouterInventaire(pIdJoueur, pIdPotion, pQuantite);
        
		SELECT niveauAlchimie INTO pNiveauAlchimie FROM joueurs WHERE idJoueur = pIdJoueur;
		UPDATE joueurs SET nbPotionCree = nbPotionCree + pQuantite WHERE idJoueur = pIdJoueur;
		SELECT nbPotionCree INTO pNbPotionCree FROM joueurs WHERE idJoueur = pIdJoueur;
        IF (pNiveauAlchimie = 1 AND pNbPotionCree >= 3) THEN
			UPDATE joueurs SET niveauAlchimie = 2 WHERE idJoueur = pIdJoueur;
        END IF;
        IF (pNiveauAlchimie = 2 AND pNbPotionCree >= 6) THEN
			UPDATE joueurs SET niveauAlchimie = 3 WHERE idJoueur = pIdJoueur;
        END IF;
    COMMIT;
END |
DELIMITER ;