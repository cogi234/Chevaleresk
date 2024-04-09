<?php
require_once "php/php_utilities.php";

isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/enigma_styles">';

$body_content = <<<HTML
<div class="main-container">
    <div class="quest-container">
        <h2 class="quest-title">Titre</h2>
        <div class="quest-description">djisfewirwdqidjqojedqodoijdoiqjwddsdwhueiyrbihfduhfgfoapnupuioebub ifohdiofhi</div>
        <div class="answer-container">
            <div>
                <input type="radio" id="answer1" name="answer-choices" value="Réponse1"/>
                <label for="answer1">Réponse1</label>
            </div>
            <div>
                <input type="radio" id="answer2" name="answer-choices" value="Réponse2"/>
                <label for="answer2">Réponse2</label>
            </div>
            <div>
                <input type="radio" id="answer3" name="answer-choices" value="Réponse3"/>
                <label for="answer3">Réponse3</label>
            </div>
            <div>
                <input type="radio" id="answer4" name="answer-choices" value="Réponse4"/>
                <label for="answer4">Réponse4</label>
            </div>
        </div>
        <button class="submit-answer">Envoyer la réponse</button>
    </div>
    <button class="receive-quest-button">Recevoir une quête</button>
</div>
HTML;

require "views/master.php";