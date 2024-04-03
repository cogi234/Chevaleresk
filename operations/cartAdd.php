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

callProcedure("ajouterPanier", $idPlayer, $idItem, $quantity);

isset_default($_GET["action"]);
if ($_GET["action"] == "cart-item") {
    $count = select("COUNT(idItem) num", "vPanier", "idJoueur = $idPlayer AND idItem = $idItem")["num"];
    if ($count > 0) {
        $item = CartItem::selectComplete(_and(equals(Player::ID, $idPlayer), equals(Item::ID, $idItem)));
        echo cartItem(
            $item->Item->getImage(),
            $item->Item->Name,
            $item->Quantity,
            $item->Item->Quantity,
            $item->Item->Id
        );
    }
} else if ($_GET["action"] == "details-counter") {
    $count = select("COUNT(idItem) num", "vPanier", "idJoueur = $idPlayer AND idItem = $idItem")["num"];
    if ($count > 0) {
        $item = CartItem::selectComplete(_and(equals(Player::ID, $idPlayer), equals(Item::ID, $idItem)));
        $cart_quantity = $item->Quantity;
        $stock = $item->Item->Quantity;
        if ($cart_quantity < $stock) {
            echo <<<HTML
            <div class="fa fa-minus cart-quantity-modifier"
                hx-post="operations/cartRemove.php?id=$idItem&action=details-counter"
                hx-trigger="click"
                hx-target="#details-buy"
                hx-swap="innerHTML"></div>
            <p class="details-cart-text">$cart_quantity</p>
            <div class="fa fa-plus cart-quantity-modifier"
                hx-post="operations/cartAdd.php?id=$idItem&action=details-counter"
                hx-trigger="click"
                hx-target="#details-buy"
                hx-swap="innerHTML"></div>
HTML;
        } else {
            echo <<<HTML
            <div class="fa fa-minus cart-quantity-modifier"
                hx-post="operations/cartRemove.php?id=$idItem&action=details-counter"
                hx-trigger="click"
                hx-target="#details-buy"
                hx-swap="innerHTML"></div>
            <p class="details-cart-text">$cart_quantity</p>
HTML;
        }
    } else {
        echo <<<HTML
        <button id="add-to-cart"
            hx-post="operations/cartAdd.php?id=$idItem&action=details-counter"
            hx-trigger="click"
            hx-target="#details-buy"
            hx-swap="innerHTML">Ajouter au panier</button>
HTML;
    }
} else {
    redirect("../cart.php");
}