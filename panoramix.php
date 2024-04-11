<?php

// PDO
require_once "php/model/recipe.php";

// Get recipes
$recipes = Recipe::selectAllComplete();

// Show recipes
$recipes_list_html = "";
include_once "php/html/recipesListHTML.php";

// Add quantity
$add_button = "<button onclick='add_quantity(1)'>Add 1</button>";

// Remove quantity
$remove_button = "<button onclick='add_quantity(-1)'>Remove 1</button>";

// Craft btn
$craft_button = "<button id='craft-btn' onclick='craft()'>Craft</button>";

// Show page
$body_content = <<<HTML
    $recipes_list_html
    $remove_button
    <span id="quantity_label"></span>
    $add_button
    $craft_button
HTML;

// Scripts
isset_default($scripts_view);
$scripts_view .= "<script src='js/local/panoramix_quantity.js'></script>";

require "views/master.php";