<?php
// PDO
require_once "../php/model/player.php";

// Session
require_once "../php/session_manager.php";
userAccess();

Player::getLocalPlayer()->empty_cart();

redirect("../cart.php");