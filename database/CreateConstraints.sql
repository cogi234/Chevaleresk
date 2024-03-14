CREATE SCHEMA IF NOT EXISTS dbchevalersk9 DEFAULT CHARACTER SET utf8 ;
USE dbchevalersk9 ;

-- Joueurs
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_solde CHECK (solde >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_soldeParAdmin CHECK (soldeParAdmin <= 600 AND soldeParAdmin >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_niveauAlchimie CHECK (niveauAlchimie >= 0 AND niveauAlchimie <= 3);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_admin CHECK (estAdmin IN(0,1));
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_nbQueteAlchimie CHECK (nbQueteAlchimie >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_nbQueteReussie CHECK (nbQueteReussie >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_nbQueteEchoue CHECK (nbQueteEchoue >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_nbPotionCree CHECK (nbPotionCree >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_nbEcuGagne CHECK (nbEcuGagne >= 0);
ALTER TABLE joueurs ADD CONSTRAINT c_joueurs_nbEcuDepense CHECK (nbEcuDepense >= 0);

-- Items
ALTER TABLE items ADD CONSTRAINT c_items_prix CHECK (prix >= 0);
ALTER TABLE items ADD CONSTRAINT c_items_quantiteStock CHECK (quantiteStock >= 0);
ALTER TABLE items ADD CONSTRAINT c_items_vendable CHECK (vendable IN(0,1));

-- Potions
ALTER TABLE potions ADD CONSTRAINT c_potions_duree CHECK (duree >= 0);

-- Ingredients
ALTER TABLE ingredients ADD CONSTRAINT c_ingredients_rarete CHECK (rarete >= 1 AND rarete <= 10);
ALTER TABLE ingredients ADD CONSTRAINT c_ingredients_danger CHECK (danger >= 1 AND danger <= 10);

-- Inventaire
ALTER TABLE inventaire ADD CONSTRAINT c_inventaire_quantite CHECK (quantite >= 0);

-- Panier
ALTER TABLE panier ADD CONSTRAINT c_panier_quantite CHECK (quantite >= 0);

-- Recettes
ALTER TABLE recettes ADD CONSTRAINT c_recettes_niveauAlchimie CHECK (niveauAlchimie >= 0 AND niveauAlchimie <= 3);

-- IngredientRecette
ALTER TABLE ingredientRecette ADD CONSTRAINT c_ingredientRecette_quantite CHECK (quantite >= 0);

-- Enigmes
ALTER TABLE enigmes ADD CONSTRAINT c_enigmes_difficulte CHECK (difficulte IN(1, 2, 3));
ALTER TABLE enigmes ADD CONSTRAINT c_enigmes_alchimie CHECK (alchimie IN(0,1));

-- Reponses
ALTER TABLE reponses ADD CONSTRAINT c_reponses_correct CHECK (correct IN(0,1));