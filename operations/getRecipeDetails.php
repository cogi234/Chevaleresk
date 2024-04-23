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

$item = $recipe->getProduct();
$potion = Potion::selectComplete(equals(Potion::ID, $item->Id));
$temp = $recipe->getIngredients();
$ingredients = [];
foreach($temp as $t){
    $product = Item::selectComplete(equals(Item::ID, $t->IdProduct));
    array_push($ingredients, [
        "image" => $product->getImage(),
        "name" => $product->Name,
        "quantity" => $t->Quantity,
    ]);
}
$qtInventory = count(InventoryItem::selectAll([
    InventoryItem::ID_PLAYER
], equals(InventoryItem::ID_PLAYER, $player->Id)
));

$result = [
    "id" => $id,
    "difficuty" => $recipe->getDifficulty(),
    "difficulty_class" => $difficulty_class,
    "name" => $item->Name,
    "image" => $item->getImage(),
    "quantityInventory" => $qtInventory,
    "effect" => $potion->Effect,
    "ingredients" => $ingredients,
    "player_level" => $player->AlchemyLevel,
];

echo json_encode($result);