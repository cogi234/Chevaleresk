<?php

require_once dirname(__FILE__, 2) . "/php/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");

// Model
require_path("php/model/player.php");

userAccess();


const TAG_MULTIPLIER = "multiplier";
const TAG_ID = "id";

// Get multiplier
isset_default($_GET[TAG_MULTIPLIER], 0);
$multiplier = intval($_GET[TAG_MULTIPLIER]);

// Get id
isset_default($_GET[TAG_ID], -1);
$id = intval($_GET[TAG_ID]);

Player::getLocalPlayer()->craft_potion($id,$multiplier);

redirect("../panoramix.php");