<?php

// If the id isn't set
if (!isset($item_id))
    return;

require_once "php/php_utilities.php";

// Types
require_once "php/model/weapon.php";
require_once "php/model/armor.php";
require_once "php/model/ingredient.php";
require_once "php/model/potion.php";

isset_default($type, null);

// If the type is not in the valid list
if (!in_array($type, Item::TYPES))
    return;

// Weapon
if ($type == Item::TYPES[0]) {
    $weapon = Weapon::selectComplete(equals(Weapon::ID, $item_id));

    $weapon_type = ucfirst($weapon->Type);
    $efficacy = $weapon->Efficacy;

    $type_html = <<<HTML
        <p><i class="fa-solid fa-circle-info fa-fw" title="Type de l'arme"></i> $weapon_type</p>
        <p><i class="fa-solid fa-wrench fa-fw" title="Niveau d'efficacité de l'arme"></i> Niveau $efficacy</p>
HTML;
    return;
}

// Armor
if ($type == Item::TYPES[1]) {
    $armor = Armor::selectComplete(equals(Weapon::ID, $item_id));

    $material = ucfirst($armor->Material);
    $size = ucfirst($armor->Size);

    $type_html = <<<HTML
        <p><i class="fa-solid fa-circle-info fa-fw" title="Matériel de l'armure"></i> $material</p>
        <p><i class="fa-solid fa-weight-hanging fa-fw" title="Taille de l'armure"></i> $size</p>
HTML;
    return;
}

// Ingredient
if ($type == Item::TYPES[2]) {
    $ingredient = Ingredient::selectComplete(equals(Weapon::ID, $item_id));

    $ingredient_type = ucfirst($ingredient->Type);
    $rarity = $ingredient->Rarity;
    $danger = $ingredient->Danger;

    $type_html = <<<HTML
        <p><i class="fa-solid fa-circle-info fa-fw" title="Type de l'ingrédient"></i> $ingredient_type</p>
        <p><i class="fa-regular fa-star fa-fw" title="Rareté de l'ingrédient"></i> Niveau $rarity</p>
        <p><i class="fa-solid fa-skull-crossbones fa-fw" title="Niveau de danger de l'ingrédient"></i> Niveau $danger</p>
HTML;
    return;
}

// Potion
$potion = Potion::selectComplete(equals(Weapon::ID, $item_id));

$potion_type = ucfirst($potion->Type);
$effect = $potion->Effect;
$duration = $potion->Duration;

$type_html = <<<HTML
    <p><i class="fa-solid fa-circle-info fa-fw" title="Type de la potion"></i> $potion_type</p>
    <p><i class="fa-solid fa-wand-sparkles fa-fw" title="Effet de la potion"></i> $effect</p>
    <p><i class="fa-regular fa-clock fa-fw" title="Durée de la potion"></i> $duration secondes</p>
HTML;