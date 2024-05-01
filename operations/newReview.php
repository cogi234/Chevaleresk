<?php

require_once "../php/model/player.php";
require_once "../php/model/review.php";
require_once "../php/session_manager.php";

userAccess();

if (!isset($_POST["item_id"]) || !isset($_POST["stars"]) || !isset($_POST["comment"])){
    echo <<<HTML
    <p style="color:red">ERREUR</p>
HTML;
    exit();
}

$player_id = Player::getLocalPlayer()->Id;
$item_id = $_POST["item_id"];
$stars = $_POST["stars"];
$comment_text = $_POST["comment"];

Review::createReview($item_id, $stars, $comment_text);

echo <<<HTML
    <p>Votre evaluation a ete envoyer</p>
HTML;