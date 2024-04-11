<?php

require_once "php/php_utilities.php";

// Get recipes
isset_default($recipes, []);
isset_default($recipes_list_html);

foreach ($recipes as $key => $value) {
    $id = $value->Id;
    $product = $value->getProduct();

    // Skip if product is invalid
    if ($product == false)
        continue;

    $name = $product->Name;

    $recipes_list_html .= "<button data-id='$id' onclick='set_recipe($id)'>$name</button>";
}