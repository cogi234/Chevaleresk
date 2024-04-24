<?php

// PDO
require_once "php/model/recipe.php";

// Add quantity
$add_button = "<button onclick='add_quantity(1)'>Add 1</button>";

// Remove quantity
$remove_button = "<button onclick='add_quantity(-1)'>Remove 1</button>";

// Craft btn
$craft_button = "<button id='craft-btn' onclick='craft()'>Craft</button>";

$craft_html = <<<HTML

HTML;

// Show page
$body_content = <<<HTML
    <div id="parent">
        <div id="items"></div>
        <div id="details-container">
            <!--
            <p id="detail-effect"></p>
            <div id="detail-ingredients"></div>
            $remove_button
            <span id="quantity_label"></span>
            $add_button
            $craft_button -->
        </div>
    </div>
HTML;

// Scripts
isset_default($scripts_view);
$scripts_view .= "<script src='js/local/panoramix/quantity.js'></script>";
$scripts_view .= "<script src='js/local/panoramix/loader.js' defer></script>";
$scripts_view .= "<script src='js/local/panoramix/details.js' defer></script>";

// Styles
isset_default($styles_view);
$styles_view .= "<link rel='stylesheet' href='css/panoramix_styles.css' />";
$styles_view .= "<link rel='stylesheet' href='css/loader_styles.css' />";

require "views/master.php";