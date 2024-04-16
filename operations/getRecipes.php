<?php

require_once dirname(__FILE__, 2) . "/php/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");
require_path("php/model/recipe.php");

isset_default($_GET["index"], 0);
$index = $_GET["index"];

// Get recipes
$recipes = Recipe::selectAllComplete(
    "",
    limit(5, $index),
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

    $name = $product->Name;
    $image = $product->getImage();

    $recipes_items .= <<<HTML
        <div class="item" id="item-$id" style="background-image: url('$image')">
            
        </div>
    HTML;
}

echo $recipes_items;