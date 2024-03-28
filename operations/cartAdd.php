<?php
require_once ("../php/php_utilities.php");
require_once ("../php/model/cart_item.php");
require_once ("../php/model/player.php");

require_once ("../php/session_manager.php");
userAccess();

$idPlayer = Player::getLocalPlayer()->Id;
$idItem = $_GET['id'];
$quantity = $_GET['quantity'];
isset_default($quantity, 1);

callProcedure("ajouterPanier", $idPlayer, $idItem, $quantity);

redirect("cart.php");