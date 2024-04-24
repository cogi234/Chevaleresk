<?php

// PDO
require_once "php/model/recipe.php";

// Title
$page_title = "Panoramix";

// Show page
$body_content = <<<HTML
    <div id="parent">
        <div id="items"></div>
        <div id="details-container"></div>
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