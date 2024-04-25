CREATE SCHEMA IF NOT EXISTS dbchevalersk9 DEFAULT CHARACTER SET utf8 ;
USE dbchevalersk9 ;

-- Armes
CALL ajouterArme("Épée courte en bronze", "Une épée courte pour les aventuriers débutants.", 75, 40, TRUE, "default_weapon.png", 1, "Une main");
CALL ajouterArme("Épée longue en bronze", "Une épée longue pour les aventuriers débutants.", 150, 25, TRUE, "default_weapon.png", 2, "Deux mains");
CALL ajouterArme("Arc simple", "Un arc simple pour les aventuriers débutants.", 100, 35, TRUE, "default_weapon.png", 1, "Deux mains");
CALL ajouterArme("Flèche de bronze", "Une flèche simple en bronze.", 5, 999, TRUE, "default_weapon.png", 1, "Munition");
CALL ajouterArme("Baguette magique de chêne", "Une baguette magique pour l'apprentit sorcier.", 150, 30, TRUE, "default_weapon.png", 1, "Une main");

-- Armures
CALL ajouterArmure("Casque de bronze", "Un casque pour protéger la tête.", 50, 30, TRUE, "default_armor.png", "Bronze", "moyen");
CALL ajouterArmure("Cuirasse de bronze", "Une cuirasse pour protéger le torse.", 100, 20, TRUE, "default_armor.png", "Bronze", "moyen");
CALL ajouterArmure("Bottes de cuir", "Des bottes simples mais fiables.", 50, 40, TRUE, "default_armor.png", "Cuir", "moyen");
CALL ajouterArmure("Robe de magicien", "Une robe magique pour l'apprentit sorcier.", 100, 15, TRUE, "default_armor.png", "Soie", "moyen");
CALL ajouterArmure("Chapeau de magicien", "Un chapeau conique classique pour tout magicien.", 75, 15, TRUE, "default_armor.png", "Soie", "moyen");

-- Potions
CALL ajouterPotion("Potion de peau de pierre", "Une bouteille remplie d'un liquide gris brillant.", 100, 25, TRUE, "default_potion.png", "defense", "Rend la peau dure comme la pierre", 180);
CALL ajouterPotion("Potion de la force de l'ours", "Une bouteille remplie d'un liquide brun.", 100, 25, TRUE, "default_potion.png", "offense", "Rend fort comme un ours", 180);
CALL ajouterPotion("Potion du poisson", "Une bouteille remplie d'un liquide vert. Des algues luisantes sont visible à l'intérieur.", 125, 20, TRUE, "default_potion.png", "defense", "Permet de respirer sous l'eau", 600);
CALL ajouterPotion("Potion d'écaille de dragon", "Une bouteille remplie d'un liquide rouge brulant.", 150, 0, TRUE, "default_potion.png", "defense", "Rend résistant à la chaleur", 120);
CALL ajouterPotion("Potion d'intelligence", "Une bouteille remplie d'un liquide presque invisible.", 300, 0, FALSE, "default_potion.png", "defense", "Rend plus intelligent", 600);

-- Ingrédients
CALL ajouterIngredient("Algues magiques", "Des algues venant d'eau infusée de magie.", 15, 100, TRUE, "default_ingredient.png", "plante", 4, 2);
CALL ajouterIngredient("Ail", "De l'ail normal.", 3, 200, TRUE, "default_ingredient.png", "plante", 1, 1);
CALL ajouterIngredient("Sang de sangsue", "Du sang pris d'une sangsue juste après qu'elle l'aie mangée.", 10, 100, TRUE, "default_ingredient.png", "sang", 2, 2);
CALL ajouterIngredient("Ongles de goblins", "Les ongles d'un goblin.", 5, 150, TRUE, "default_ingredient.png", "ongle", 2, 3);
CALL ajouterIngredient("Écaille de dragon", "Une écaille prise d'un dragon. Dure comme l'acier et invincible à la chaleur.", 75, 50, TRUE, "default_ingredient.png", "écaille", 9, 10);

-- Joueur
-- Pas alchimistes
CALL inscription("admin", "admin", TRUE);
CALL ajouterInventaire(1, 16, 4);
CALL ajouterInventaire(1, 17, 12);
CALL ajouterInventaire(1, 18, 4);
CALL ajouterInventaire(1, 19, 5);
CALL ajouterInventaire(1, 20, 1);
CALL inscription("colin", "123456", FALSE);
CALL ajouterInventaire(2, 16, 4);
CALL ajouterInventaire(2, 17, 12);
CALL ajouterInventaire(2, 18, 4);
CALL ajouterInventaire(2, 19, 5);
CALL ajouterInventaire(2, 20, 1);
CALL inscription("lorick", "123456", FALSE);
CALL ajouterInventaire(3, 16, 4);
CALL ajouterInventaire(3, 17, 12);
CALL ajouterInventaire(3, 18, 4);
CALL ajouterInventaire(3, 19, 5);
CALL ajouterInventaire(3, 20, 1);
CALL inscription("felix", "123456", FALSE);
CALL ajouterInventaire(4, 16, 4);
CALL ajouterInventaire(4, 17, 12);
CALL ajouterInventaire(4, 18, 4);
CALL ajouterInventaire(4, 19, 5);
CALL ajouterInventaire(4, 20, 1);
CALL inscription("samuel", "123456", FALSE);
CALL ajouterInventaire(5, 16, 4);
CALL ajouterInventaire(5, 17, 12);
CALL ajouterInventaire(5, 18, 4);
CALL ajouterInventaire(5, 19, 5);
CALL ajouterInventaire(5, 20, 1);
-- Debutants
CALL inscription("debutant1", "123456", FALSE);
CALL ajouterInventaire(6, 16, 4);
CALL ajouterInventaire(6, 17, 12);
CALL ajouterInventaire(6, 18, 4);
CALL ajouterInventaire(6, 19, 5);
CALL ajouterInventaire(6, 20, 1);
CALL inscription("debutant2", "123456", FALSE);
CALL ajouterInventaire(7, 16, 4);
CALL ajouterInventaire(7, 17, 12);
CALL ajouterInventaire(7, 18, 4);
CALL ajouterInventaire(7, 19, 5);
CALL ajouterInventaire(7, 20, 1);
UPDATE joueurs SET niveauAlchimie = 1, nbQueteAlchimie = 3 WHERE alias IN("debutant1", "debutant2");
-- Intermediaires
CALL inscription("intermediaire1", "123456", FALSE);
CALL ajouterInventaire(8, 16, 4);
CALL ajouterInventaire(8, 17, 12);
CALL ajouterInventaire(8, 18, 4);
CALL ajouterInventaire(8, 19, 5);
CALL ajouterInventaire(8, 20, 1);
CALL inscription("intermediaire2", "123456", FALSE);
CALL ajouterInventaire(9, 16, 4);
CALL ajouterInventaire(9, 17, 12);
CALL ajouterInventaire(9, 18, 4);
CALL ajouterInventaire(9, 19, 5);
CALL ajouterInventaire(9, 20, 1);
UPDATE joueurs SET niveauAlchimie = 2, nbQueteAlchimie = 3, nbPotionCree = 3 WHERE alias IN("intermediaire1", "intermediaire2");
-- Experts
CALL inscription("expert1", "123456", FALSE);
CALL ajouterInventaire(10, 16, 4);
CALL ajouterInventaire(10, 17, 12);
CALL ajouterInventaire(10, 18, 4);
CALL ajouterInventaire(10, 19, 5);
CALL ajouterInventaire(10, 20, 1);
CALL inscription("expert2", "123456", FALSE);
CALL ajouterInventaire(11, 16, 4);
CALL ajouterInventaire(11, 17, 12);
CALL ajouterInventaire(11, 18, 4);
CALL ajouterInventaire(11, 19, 5);
CALL ajouterInventaire(11, 20, 1);
UPDATE joueurs SET niveauAlchimie = 3, nbQueteAlchimie = 3, nbPotionCree = 6 WHERE alias IN("expert1", "expert2");

-- Enigmes
-- Facile
CALL ajouterEnigme("Mathématiques 1", "Quel est le résultat de 1 + 1?", 1, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "2", TRUE);
CALL ajouterReponse(@lastIndex, "11", FALSE);
CALL ajouterReponse(@lastIndex, "1", FALSE);
CALL ajouterReponse(@lastIndex, "10", FALSE);

CALL ajouterEnigme("Géographie 1", "Quelle est la capitale du Québec?", 1, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "Québec", TRUE);
CALL ajouterReponse(@lastIndex, "Montréal", FALSE);
CALL ajouterReponse(@lastIndex, "Val-d'or", FALSE);
CALL ajouterReponse(@lastIndex, "Trois-Rivières", FALSE);

CALL ajouterEnigme("Arbres", "La quelle de ces plantes n'est pas un arbre?", 1, TRUE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "Pissenlit", TRUE);
CALL ajouterReponse(@lastIndex, "Érable", FALSE);
CALL ajouterReponse(@lastIndex, "Chêne", FALSE);
CALL ajouterReponse(@lastIndex, "Pin", FALSE);

CALL ajouterEnigme("Potions", "Laquelle de ces potions demande une écaille de dragon?", 1, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "Potion d'écaille de dragon", TRUE);
CALL ajouterReponse(@lastIndex, "Potion de peau de pierre", FALSE);
CALL ajouterReponse(@lastIndex, "Potion de la force de l'ours", FALSE);
CALL ajouterReponse(@lastIndex, "Potion du poisson", FALSE);
CALL ajouterReponse(@lastIndex, "Potion d'intelligence", FALSE);

CALL ajouterEnigme("Mathématiques 1", "Quel est le résultat de 1 + 1?", 1, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "2", TRUE);
CALL ajouterReponse(@lastIndex, "11", FALSE);
CALL ajouterReponse(@lastIndex, "1", FALSE);

-- Moyen
CALL ajouterEnigme("Mathématiques 2", "Quel est le résultat de 1 + 2 X 3?", 2, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "7", TRUE);
CALL ajouterReponse(@lastIndex, "9", FALSE);
CALL ajouterReponse(@lastIndex, "6", FALSE);
CALL ajouterReponse(@lastIndex, "50", FALSE);

CALL ajouterEnigme("Élément périodique", "Quel est le numéro atomique de l'hélium?", 2, TRUE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "2", TRUE);
CALL ajouterReponse(@lastIndex, "1", FALSE);
CALL ajouterReponse(@lastIndex, "3", FALSE);
CALL ajouterReponse(@lastIndex, "4", FALSE);
CALL ajouterReponse(@lastIndex, "5", FALSE);
CALL ajouterReponse(@lastIndex, "6", FALSE);
CALL ajouterReponse(@lastIndex, "7", FALSE);
CALL ajouterReponse(@lastIndex, "8", FALSE);
CALL ajouterReponse(@lastIndex, "9", FALSE);
CALL ajouterReponse(@lastIndex, "10", FALSE);
CALL ajouterReponse(@lastIndex, "11", FALSE);
CALL ajouterReponse(@lastIndex, "12", FALSE);
CALL ajouterReponse(@lastIndex, "13", FALSE);
CALL ajouterReponse(@lastIndex, "14", FALSE);
CALL ajouterReponse(@lastIndex, "15", FALSE);
CALL ajouterReponse(@lastIndex, "16", FALSE);
CALL ajouterReponse(@lastIndex, "17", FALSE);
CALL ajouterReponse(@lastIndex, "18", FALSE);
CALL ajouterReponse(@lastIndex, "19", FALSE);
CALL ajouterReponse(@lastIndex, "20", FALSE);

CALL ajouterEnigme("Mathématiques 2", "Quel est le résultat de 1 + 2 X 3?", 2, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "7", TRUE);
CALL ajouterReponse(@lastIndex, "9", FALSE);
CALL ajouterReponse(@lastIndex, "6", FALSE);
CALL ajouterReponse(@lastIndex, "50", FALSE);

CALL ajouterEnigme("Mathématiques 2", "Quel est le résultat de 1 + 2 X 3?", 2, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "7", TRUE);
CALL ajouterReponse(@lastIndex, "9", FALSE);
CALL ajouterReponse(@lastIndex, "6", FALSE);
CALL ajouterReponse(@lastIndex, "50", FALSE);

CALL ajouterEnigme("Mathématiques 2", "Quel est le résultat de 1 + 2 X 3?", 2, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "7", TRUE);
CALL ajouterReponse(@lastIndex, "9", FALSE);
CALL ajouterReponse(@lastIndex, "6", FALSE);
CALL ajouterReponse(@lastIndex, "50", FALSE);

-- Difficile
CALL ajouterEnigme("Mathématiques 3", "Quel est la somme de tous les nombres de 1 à 100?", 3, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "5050", TRUE);
CALL ajouterReponse(@lastIndex, "500", FALSE);
CALL ajouterReponse(@lastIndex, "1000", FALSE);
CALL ajouterReponse(@lastIndex, "1100", FALSE);
CALL ajouterReponse(@lastIndex, "2550", FALSE);

CALL ajouterEnigme("Mathématiques 3", "Quel est la somme de tous les nombres de 1 à 100?", 3, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "5050", TRUE);
CALL ajouterReponse(@lastIndex, "500", FALSE);
CALL ajouterReponse(@lastIndex, "1000", FALSE);
CALL ajouterReponse(@lastIndex, "1100", FALSE);
CALL ajouterReponse(@lastIndex, "2550", FALSE);

CALL ajouterEnigme("Mathématiques 3", "Quel est la somme de tous les nombres de 1 à 100?", 3, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "5050", TRUE);
CALL ajouterReponse(@lastIndex, "500", FALSE);
CALL ajouterReponse(@lastIndex, "1000", FALSE);
CALL ajouterReponse(@lastIndex, "1100", FALSE);
CALL ajouterReponse(@lastIndex, "2550", FALSE);

CALL ajouterEnigme("Mathématiques 3", "Quel est la somme de tous les nombres de 1 à 100?", 3, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "5050", TRUE);
CALL ajouterReponse(@lastIndex, "500", FALSE);
CALL ajouterReponse(@lastIndex, "1000", FALSE);
CALL ajouterReponse(@lastIndex, "1100", FALSE);
CALL ajouterReponse(@lastIndex, "2550", FALSE);

CALL ajouterEnigme("Mathématiques 3", "Quel est la somme de tous les nombres de 1 à 100?", 3, FALSE);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterReponse(@lastIndex, "5050", TRUE);
CALL ajouterReponse(@lastIndex, "500", FALSE);
CALL ajouterReponse(@lastIndex, "1000", FALSE);
CALL ajouterReponse(@lastIndex, "1100", FALSE);
CALL ajouterReponse(@lastIndex, "2550", FALSE);

-- Recettes
CALL ajouterRecette(11, 1);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterIngredientRecette(@lastIndex, 17, 10);
CALL ajouterIngredientRecette(@lastIndex, 19, 3);

CALL ajouterRecette(12, 1);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterIngredientRecette(@lastIndex, 17, 2);
CALL ajouterIngredientRecette(@lastIndex, 18, 4);
CALL ajouterIngredientRecette(@lastIndex, 19, 2);

CALL ajouterRecette(13, 2);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterIngredientRecette(@lastIndex, 16, 3);
CALL ajouterIngredientRecette(@lastIndex, 18, 3);

CALL ajouterRecette(14, 3);
SET @lastIndex = LAST_INSERT_ID();
CALL ajouterIngredientRecette(@lastIndex, 16, 1);
CALL ajouterIngredientRecette(@lastIndex, 20, 1);