<?php

require_once "../php/session_manager.php";
require_once "../php/php_utilities.php";

userAccess();

isset_default($_GET["id"], -1);
$item_id = $_GET["id"];

echo <<<HTML
    <form id="new-review-form" hx-post="operations/newReview.php"
        hx-target="#new-review-container"
        hx-swap="innerHTML">
        <h4>Nouvelle évaluation</h4>
        <input type="hidden" name="item_id" value="$item_id">
        <label for="new-review-stars">Étoiles</label>
        <input id="new-review-stars" type="number" name="stars" value="1" min="1" max="5">
        <label for="new-review-comment">Commentaire</label>
        <textarea id="new-review-comment" name="comment" rows="4" placeholder="Entrez un commentaire"></textarea>
        <input id="new-review-submit" type="submit" value="Envoyer">
    </form>
HTML;