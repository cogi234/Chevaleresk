<?php

require_once "../php/model/player.php";
require_once "../php/model/review.php";
require_once "../php/html/itemsReviewHTML.php";
require_once "../php/session_manager.php";
require_once "../php/pdo/pdo_utilities.php";

userAccess();

if (!isset($_GET["item"]) || !isset($_GET["player"])) {
    exit();
}


$local_player_id = Player::getLocalPlayer()->Id;
$player_id = $_GET["player"];
$item_id = $_GET["item"];

$is_admin = Player::getLocalPlayer()->IsAdmin;

//Si on enleve pas une de nos propres evaluations, on doit etre administrateur
if ($player_id == $local_player_id || $is_admin){
    $result = Review::removeReview($player_id, $item_id);
}

redirect("../details.php?type=item&id=$item_id");