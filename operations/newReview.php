<?php

require_once "../php/model/player.php";
require_once "../php/model/review.php";
require_once "../php/html/itemsReviewHTML.php";
require_once "../php/session_manager.php";
require_once "../php/pdo/pdo_utilities.php";

userAccess();

if (!isset($_POST["item_id"]) || !isset($_POST["stars"]) || !isset($_POST["comment"])) {
    echo <<<HTML
    <p class="new-review-text" style="color:red">ERREUR: Il manque un des valeurs de formulaire nécessaires!</p>
HTML;
    exit();
}

$player_id = Player::getLocalPlayer()->Id;
$item_id = $_POST["item_id"];
$stars = $_POST["stars"];
$comment_text = $_POST["comment"];

$result = Review::createReview($item_id, $stars, $comment_text);

if ($result) {
    $review = Review::selectComplete(
        _and(
            equals(Review::ITEMID, $item_id),
            equals(Review::PLAYERID, $player_id)
        )
    );
    echo show_review($review);
} else {
    echo <<<HTML
    <p class="new-review-text" style="color:red">ERREUR: Il y a eu une erreur dans la création de l'évaluation!</p>
HTML;
}