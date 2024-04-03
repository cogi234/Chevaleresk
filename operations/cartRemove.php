<?php
require_once ("../php/php_utilities.php");
require_once ("../php/model/cart_item.php");
require_once ("../php/model/player.php");
require_once ("../php/pdo/pdo_utilities.php");
require_once ("../php/html/cartHTML.php");

require_once ("../php/session_manager.php");
userAccess();

$idPlayer = Player::getLocalPlayer()->Id;
$idItem = $_GET['id'];
isset_default($_GET['quantity'], 1);
$quantity = $_GET['quantity'];

callProcedure("enleverPanier", $idPlayer, $idItem, $quantity);

if(isset($_GET["partial"])){
    $count = select("COUNT(idItem) num", "vPanier", "idJoueur = $idPlayer AND idItem = $idItem")["num"];
    if ($count > 0){
        $item = CartItem::selectComplete(_and(equals(Player::ID, $idPlayer), equals(Item::ID, $idItem)));
        echo cartItem(
            $item->Item->getImage(),
            $item->Item->Name,
            $item->Quantity,
            $item->Item->Quantity,
            $item->Item->Id,
            $item->Item->Price);
    }
} else {
    redirect("../cart.php");
}