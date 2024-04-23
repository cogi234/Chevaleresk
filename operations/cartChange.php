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
$alchemyLevel = Player::getLocalPlayer()->AlchemyLevel;
$idItem = $_GET['id'];
isset_default($_POST['quantity'], 1);
$quantity = intval($_POST['quantity']);
$operation = $_GET['operation'];
$itemType = Item::select([Item::TYPE], equals(Item::ID, $idItem))->Type;


if ($operation == "remove") {
    $result = CartItem::remove_from_cart($idPlayer, $idItem, $quantity);
    if ($result = false)
        throw new Exception("Error Processing Request", 1);
} else if ($operation == "add") {
    if ($itemType == "ingredient" && $alchemy_level == 0) {
        exit();
    }
    $result = CartItem::add_to_cart($idPlayer, $idItem, $quantity);
    if ($result = false)
        throw new Exception("Error Processing Request", 1);
} else if ($operation == "set") {
    if ($itemType == "ingredient" && $alchemyLevel == 0) {
        exit();
    }
    $result = CartItem::modify_cart($idPlayer, $idItem, $quantity);
    if ($result = false)
        throw new Exception("Error Processing Request", 1);
}

const ACTIONS = [
    "cart-item" => 'onCartItem',
    "details-counter" => 'onDetailsCounter'
];

isset_default($_GET["action"], null);
$action = $_GET["action"];

if (!array_key_exists($action, ACTIONS))
    return;

echo call_user_func_array(ACTIONS[$action], array($idPlayer, $idItem));