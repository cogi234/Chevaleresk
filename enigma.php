<?php
require_once "php/php_utilities.php";

$page_title = "Enigma";

isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/enigma_styles.css">';
$styles_view .= '<link rel="stylesheet" href="css/loader_styles.css">';

$body_content = <<<HTML
    <div class="receive-quest-buttons">
        <button class="receive-quest-button"
            hx-post="operations/getQuest.php"
            hx-trigger="click"
            hx-target="#quest-container"
            hx-swap="innerHTML">
            Recevoir une quête aléatoire
        </button>
        <button class="receive-quest-button"
            hx-post="operations/getQuest.php?diff=1"
            hx-trigger="click"
            hx-target="#quest-container"
            hx-swap="innerHTML">
            Recevoir une quête facile
        </button>
        <button class="receive-quest-button"
            hx-post="operations/getQuest.php?diff=2"
            hx-trigger="click"
            hx-target="#quest-container"
            hx-swap="innerHTML">
            Recevoir une quête intermédiaire
        </button>
        <button class="receive-quest-button"
            hx-post="operations/getQuest.php?diff=3"
            hx-trigger="click"
            hx-target="#quest-container"
            hx-swap="innerHTML">
            Recevoir une quête difficile
        </button>
    </div>

    <div id="quest-container">
        <h2 class="result-msg">Bienvenue à Enigma</h2>
        <p class="result-msg">Appuyez sur un des 4 boutons pour recevoir une quête!</p>
    </div>
HTML;

// View Scripts
isset_default($scripts_view);
$scripts_view .= "<script src='js/local/enigma-loader.js' defer></script>";

require "views/master.php";