<?php

const FETCH_SIZE = 5;

require_once dirname(__FILE__, 2) . "/php/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");
require_path("php/pdo/pdo_utilities.php");

// Model
require_path("php/model/recipe.php");
require_path("php/model/player.php");
require_path("php/model/inventory_item.php");

$player = Player::getLocalPlayer();

if (is_bool($player))
    return;

isset_default($_GET["index"], 0);
$index = $_GET["index"];

// Get recipes
$recipes = Recipe::selectAllComplete(
    "",
    combine(
        orderByAll([Recipe::ALCHEMY_LEVEL], [Recipe::ID_PRODUCT]),
        limit(FETCH_SIZE, $index * FETCH_SIZE),
    )
);

if (count($recipes) == 0)
    return;

$recipes_items = "";

foreach ($recipes as $key => $value) {
    $id = $value->Id;
    $product = $value->getProduct();

    // Skip if product is invalid
    if ($product == false)
        continue;

    $difficulty = $value->getDifficulty();
    $difficulty_class = "";

    switch ($value->AlchemyLevel) {
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

    $name = $product->Name;
    $image = $product->getImage();
    $qtInventory = count(InventoryItem::selectAll([
            InventoryItem::ID_PLAYER
        ], equals(InventoryItem::ID_PLAYER, $player->Id)
    ));

    $recipes_items .= <<<HTML
        <div class="item" id="item-$id" style="background-image: url('$image')" data-id="$id" title="$name">
            <span class="item-level $difficulty_class" title="Potion de difficulté: $difficulty">$difficulty</span>
            <span class="item-inventory-quantity" title="Vous en possédez $qtInventory">$qtInventory</span>
        </div>
    HTML;
}

echo $recipes_items;