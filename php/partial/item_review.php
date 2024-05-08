<?php

const MAX_STARS = 5;

// Model
require_once "../model/review.php";
require_once "../model/player.php";

// Utilities
require_once "../pdo/pdo_utilities.php";

// HTML
require_once "../html/itemsReviewHTML.php";

$evaluations = Review::selectAllComplete(equals(Review::ITEMID, $_SESSION["CHECKED_ID"]));
$html = "";
foreach ($evaluations as $key => $value)
    $html .= show_review($value);

echo $html;