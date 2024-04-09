<?php

// PDO
require_once "../php/model/item.php";
require_once "../php/model/player.php";
require_once "../php/model/cart_item.php";

// HTML
require_once "../php/html/cartHTML.php";

// Utilities
require_once "../php/php_utilities.php";
require_once "../php/pdo/pdo_utilities.php";

// Session
require_once "../php/session_manager.php";

userAccess();

// Get informations
$idPlayer = Player::getLocalPlayer()->Id;
$idItem = $_GET['id'];
isset_default($_GET['quantity'], 1);
$quantity = intval($_GET['quantity']);

// Add to cart
CartItem::add_to_cart($idPlayer, $idItem, $quantity);

const ACTIONS = [
    "cart-item" => 'onCartItem',
    "details-counter" => 'onDetailsCounter'
];

isset_default($_GET["action"], null);
$action = $_GET["action"];

if (!array_key_exists($action, ACTIONS))
    return;

echo call_user_func_array(ACTIONS[$action], array($idPlayer, $idItem));