<?php

require_once dirname(__FILE__, 2) . "/php/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");
require_path("php/pdo/pdo_utilities.php");

// PDO
require_path("php/model/recipe.php");

const TAG_MULTIPLIER = "multiplier";
const TAG_ID = "id";

// Get multiplier
isset_default($_GET[TAG_MULTIPLIER], 0);
$multiplier = intval($_GET[TAG_MULTIPLIER]);

$can_craft = true;

if ($multiplier == 0)
    $can_craft = false;

// Get id
isset_default($_GET[TAG_ID], -1);
$id = intval($_GET[TAG_ID]);

// Check if exists
$recipe = Recipe::selectComplete(equals(Recipe::ID, $id));

if ($recipe != false) {
    
    $ingredients = $recipe->getIngredients();
    foreach( $ingredients as $ingredient)
    {
        $quantity = InventoryItem::select([InventoryItem::QUANTITY], equals(Item::ID, $ingredient->IdIngredient));
        if ($quantity == false || $quantity->Quantity < $ingredient->Quantity*$multiplier)
        {
            $can_craft = false;
        }
    }
    
} else
    $can_craft = false;

echo json_encode($can_craft);