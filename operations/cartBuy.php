<?php
// PDO
require_once "../php/model/player.php";

// Session
require_once "../php/session_manager.php";
userAccess();

Player::getLocalPlayer()->buy_cart();

Player::refreshLocalPlayer();

redirect("../inventory.php");