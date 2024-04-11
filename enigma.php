<?php
require_once "php/php_utilities.php";

isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/enigma_styles">';

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

    <div id="quest-container"></div>
HTML;

require "views/master.php";