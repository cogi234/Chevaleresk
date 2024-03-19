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
CALL ajouterPotion("Potion d'écaille de dragon", "Une bouteille remplie d'un liquide rouge brulant.", 150, 15, TRUE, "default_potion.png", "defense", "Rend résistant à la chaleur", 120);
CALL ajouterPotion("Potion d'intelligence", "Une bouteille remplie d'un liquide presque invisible.", 300, 0, FALSE, "default_potion.png", "defense", "Rend plus intelligent", 600);

-- Ingrédients
CALL ajouterIngredient("Algues magiques", "Des algues venant d'eau infusée de magie.", 15, 100, TRUE, "default_ingredient.png", "plante", 4, 2);
CALL ajouterIngredient("Ail", "De l'ail normal.", 3, 200, TRUE, "default_ingredient.png", "plante", 1, 1);
CALL ajouterIngredient("Sang de sangsue", "Du sang pris d'une sangsue juste après qu'elle l'aie mangée.", 10, 100, TRUE, "default_ingredient.png", "sang", 2, 2);
CALL ajouterIngredient("Ongles de goblins", "Les ongles d'un goblin.", 5, 150, TRUE, "default_ingredient.png", "ongle", 2, 3);
CALL ajouterIngredient("Écaille de dragon", "Une écaille prise d'un dragon. Dure comme l'acier et invincible à la chaleur.", 75, 50, TRUE, "default_ingredient.png", "écaille", 9, 10);

-- Joueur
CALL inscription("admin", "admin", TRUE);
