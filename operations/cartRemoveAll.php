<?php
require_once("php/model/cart_item.php");
require_once("php/php_utilities.php");
require_once("php/model/player.php");

require_once ("php/session_manager.php");
userAccess();

$idPlayer = Player::getLocalPlayer()->Id;

callProcedure("viderPanier", $idPlayer);

redirect("cart.php");