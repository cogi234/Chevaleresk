<?php
require_once dirname(__FILE__, 2) . "/php/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");
require_path("php/pdo/pdo_utilities.php");

// Model
require_path("php/model/recipe.php");
require_path("php/model/player.php");
require_path("php/model/item.php");
require_path("php/model/potion.php");
require_path("php/model/recipeIngredient.php");
require_path("php/model/inventory_item.php");

isset_default($_GET["id"], -1);
$id = $_GET["id"];

$player = Player::getLocalPlayer();

// Get recipe
$recipe = Recipe::selectComplete(equals(Recipe::ID, $id));

$difficulty_class = "";
switch ($recipe->AlchemyLevel) {
    case 1:
        $difficulty_class = "easy";
        break;
    case 2:
        $difficulty_class = "medium";
        break;
    case 3:
        $difficulty_class = "hard";
        break;
    default:
        $difficulty_class = "unknown";
        break;
}

$playerLevel = "";
switch ($player->AlchemyLevel) {
    case 1:
        $playerLevel = "Apprenti";
        break;
    case 2:
        $playerLevel = "Expert";
        break;
    case 3:
        $playerLevel = "Maitre";
        break;
    default:
        $playerLevel = "Pas un alchimiste";
        break;
}

$item = $recipe->getProduct();
$potion = Potion::select(
    [Potion::EFFECT],
    equals(Potion::ID, $item->Id)
);

// Ingredients
$ingredients = $recipe->getIngredients();
$result_ingredients = [];

foreach($ingredients as $ingredient){
    $product = Item::select(
        [
            Item::NAME,
            Item::IMAGE
        ],
        equals(Item::ID, $ingredient->IdIngredient)
    );

    if (is_bool($product))
        continue;

    array_push($result_ingredients, [
        "image" => $product->getImage(),
        "name" => $product->Name,
        "quantity" => $ingredient->Quantity,
    ]);
}
$qtInventory = count(InventoryItem::selectAll(
    [InventoryItem::ID_PLAYER], 
    equals(InventoryItem::ID_PLAYER, $player->Id)
));

// Pass informations
echo json_encode([
    "id" => $id,
    "name" => $item->Name,
    "image" => $item->getImage(),
    "quantityInventory" => $qtInventory,
    "effect" => $potion->Effect,
    "player_level" => $playerLevel,
    "difficulty" => $recipe->getDifficulty(),
    "difficulty_class" => $difficulty_class,
    "ingredients" => $ingredients,
]);