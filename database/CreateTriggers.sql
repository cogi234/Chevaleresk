CREATE SCHEMA IF NOT EXISTS dbchevalersk9 DEFAULT CHARACTER SET utf8 ;
USE dbchevalersk9 ;

-- Ingredients
DROP TRIGGER CTRLInsertionIngredient;
DELIMITER |
CREATE TRIGGER CTRLInsertionIngredient
	BEFORE INSERT ON items FOR EACH ROW
BEGIN
	DECLARE minPrixPotions INT;
    IF (new.type = "ingredient") THEN
		SELECT MIN(prix) INTO minPrixPotions FROM items WHERE type = "potion";
        IF (new.prix >= minPrixPotions) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le prix dépasse celui des potions";
		END IF;
	END IF;
END |
DELIMITER ;

DROP TRIGGER CTRLUpdateIngredient;
DELIMITER |
CREATE TRIGGER CTRLUpdateIngredient
	BEFORE UPDATE ON items FOR EACH ROW
BEGIN
	DECLARE minPrixPotions INT;
    IF (new.type = "ingredient") THEN
		SELECT MIN(prix) INTO minPrixPotions FROM items WHERE type = "potion";
        IF (new.prix >= minPrixPotions) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le prix dépasse celui des potions";
		END IF;
	END IF;
END |
DELIMITER ;


-- Potions
DROP TRIGGER CTRLInsertionPotion; 
DELIMITER |
CREATE TRIGGER CTRLInsertionPotion
	BEFORE INSERT ON items FOR EACH ROW
BEGIN
	DECLARE maxPrixIngredients INT;
    IF (new.type = "potion") THEN
		SELECT MAX(prix) INTO maxPrixIngredients FROM items WHERE type = "ingredient";
        IF (new.prix <= maxPrixIngredients) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le prix est plus bas que celui des ingrédients";
		END IF;
	END IF;
END |
DELIMITER ;

DROP TRIGGER CTRLUpdatePotion; 
DELIMITER |
CREATE TRIGGER CTRLUpdatePotion
	BEFORE UPDATE ON items FOR EACH ROW
BEGIN
	DECLARE maxPrixIngredients INT;
    IF (new.type = "potion") THEN
		SELECT MAX(prix) INTO maxPrixIngredients FROM items WHERE type = "ingredient";
        IF (new.prix <= maxPrixIngredients) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le prix est plus bas que celui des ingrédients";
		END IF;
	END IF;
END |
DELIMITER ;


-- Recettes
DROP TRIGGER CTRLInsertionRecette; 
DELIMITER |
CREATE TRIGGER CTRLInsertionRecette
	BEFORE INSERT ON ingredientRecette FOR EACH ROW
BEGIN
	DECLARE prixIngredients INT;
    DECLARE prixIngredient INT;
    DECLARE prixPotion INT;
    SELECT prix INTO prixPotion FROM (items i INNER JOIN recettes r ON i.idItem = r.idProduit) WHERE r.idRecette = new.idRecette;
    SELECT SUM(prix * quantite) INTO prixIngredients FROM (ingredientRecette r INNER JOIN items i ON r.idIngredient = i.idItem)  WHERE r.idRecette = new.idRecette;
    SELECT prix * quantite INTO prixIngredient FROM (new n INNER JOIN items i ON n.idIngredient = i.idItem);
    IF (prixPotion <= (prixIngredients + prixIngredient)) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le prix du résultat de la recette est plus bas que celui de ses ingrédients";
    END IF;
END |
DELIMITER ;

DROP TRIGGER CTRLUpdateRecette; 
DELIMITER |
CREATE TRIGGER CTRLUpdateRecette
	BEFORE UPDATE ON ingredientRecette FOR EACH ROW
BEGIN
	DECLARE prixIngredients INT;
    DECLARE prixIngredient INT;
    DECLARE prixPotion INT;
    SELECT prix INTO prixPotion FROM (items i INNER JOIN recettes r ON i.idItem = r.idProduit) WHERE r.idRecette = new.idRecette;
    SELECT SUM(prix * quantite) INTO prixIngredients FROM (ingredientRecette r INNER JOIN items i ON r.idIngredient = i.idItem)  WHERE r.idRecette = new.idRecette AND r.idIngredient != new.idIngredient;
    SELECT prix * quantite INTO prixIngredient FROM (new n INNER JOIN items i ON n.idIngredient = i.idItem);
    IF (prixPotion <= (prixIngredients + prixIngredient)) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Le prix du résultat de la recette est plus bas que celui de ses ingrédients";
    END IF;
END |
DELIMITER ;