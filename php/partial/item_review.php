<?php

// Model
require_once "../model/review.php";
require_once "../model/player.php";

// Utilities
require_once "../pdo/pdo_utilities.php";

// HTML
require_once "../html/itemsReviewHTML.php";

$local_player_id = 0;
$is_admin = false;
if (is_connected()){
    $local_player_id = Player::getLocalPlayer()->Id;
    $is_admin = Player::getLocalPlayer()->IsAdmin;
}

$evaluations = Review::selectAllComplete(
    _and(
        equals(Review::ITEMID, $_SESSION["CHECKED_ID"]),
        unequals(Review::PLAYERID, $local_player_id)
    ),
    orderBy(Review::DATE, false)
);
$html = "";


foreach ($evaluations as $key => $value)
    $html .= show_review($value, $is_admin);

echo $html;