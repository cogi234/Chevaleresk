<?php

require_once dirname(__FILE__, 2) . "/php/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");
require_path("php/session_manager.php");
require_path("php/pdo/pdo_utilities.php");

// PDO
require_path("php/model/recipe.php");
require_path("php/model/player.php");
require_path("php/model/inventory_item.php");

const TAG_MULTIPLIER = "multiplier";
const TAG_ID = "id";

if (!is_connected()){
    echo json_encode(false);
    exit();
}

// Get multiplier
isset_default($_GET[TAG_MULTIPLIER], 0);
$multiplier = intval($_GET[TAG_MULTIPLIER]);

$can_craft = true;

if ($multiplier <= 0)
    $can_craft = false;

// Get id
isset_default($_GET[TAG_ID], -1);
$id = intval($_GET[TAG_ID]);

// Check if exists
$recipe = Recipe::select(
    [Recipe::ID],
    equals(Recipe::ID, $id)
);

if ($recipe != false && $can_craft) {
    
    $ingredients = $recipe->getIngredients();
    foreach($ingredients as $ingredient)
    {
        $quantity = InventoryItem::select(
            [InventoryItem::QUANTITY], 
            _and( equals(Item::ID, $ingredient->IdIngredient), equals(InventoryItem::ID_PLAYER, Player::getLocalPlayer()->Id))
        );

        if ($quantity == false || $quantity->Quantity < $ingredient->Quantity * $multiplier)
        {
            $can_craft = false;
            break;
        }
    }
    
} else
    $can_craft = false;

echo json_encode($can_craft);