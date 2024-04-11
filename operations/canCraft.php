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
$recipe = Recipe::select(
    [
        Recipe::ID
    ],
    equals(Recipe::ID, $id)
);

if ($recipe != false) {
    // TODO: Check if the player has enough items
    if ($id == 2 && $multiplier >= 3)
        $can_craft = false;
} else
    $can_craft = false;

echo json_encode($can_craft);