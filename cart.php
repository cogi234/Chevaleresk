<?php
require_once("php/pdo.php");
require_once("php/items.php");
require_once("php/cart_items.php");
require_once("php/joueurs.php");

require_once ("php/sessionManager.php");
userAccess();

$styles_view = '<link rel="stylesheet" href="css/cart_styles">';

$currentPlayerId = unserialize($_SESSION["joueur"])->Id;

$items = CartItem::selectAll(
    [
        CartItem::IDJOUEUR,
        CartItem::QUANTITY,
        Item::ID,
        Item::NAME,
        Item::IMAGE,
        Item::TYPE,
        Item::SELLABLE,
        Item::QUANTITY,
        Item::PRICE
    ],
    "idJoueur = $currentPlayerId"
);

$total = 0;

$body_content = <<<HTML
<form class="cart-main" action="">
    <div class="cart-itemList-scroll-container">
HTML;

foreach ($items as $item) {
    $idItem = $item->Item->Id;
    $name = $item->Item->Nom;
    $image = $item->Item->getImage();
    //check if the item is still in stock
    if ($item->Item->Quantite > 0) {
        //if true show a message
        $body_content .= <<<HTML
            <div class="cart-item">
                <div class="cart-item-image"><img src="$image"/></div>
                    <div class="cart-item-info">
                        <p class="name-item">$name</p>
                        <div class="number-item"><p>x</p><input value="$item->Quantite" type="number"/></div>
                    </div>
                    <div class="cart-item-remove-error">
                    <a class="remove-item" href="cartRemove.php?id=$idItem"><img src="images/icons/remove-icon"></a>
            HTML;
    } else {
        $body_content .= <<<HTML
                <div class="cart-item-outofstock">
                <div class="cart-item-image"><img src="$image"/></div>
                    <div class="cart-item-info">
                        <p class="name-item">$item->Item->Nom</p>
                        <div class="number-item"><p>x</p><input value="$item->Quantite" type="number"/></div>
                    </div>
                    <div class="cart-item-remove-error">
                    <a class="remove-item" href="cartRemove.php?id=$idItem"><img src="images/icons/remove-icon"></a>
                    <p class="item-errorMessage" color="red">Hors Stock...</p>
            HTML;
    }
    $body_content .= <<<HTML
                </div>
            </div>
        HTML;
}
//if there's nothing in the cart
if ($items == null || count($items) > 0) {
    $body_content .= <<<HTML
        <p class="cart-empty-msg">Aucun item dans le panier...</p>
    HTML;
}
//show recept preview
$body_content .= <<<HTML
    </div>
    <div class="cart-recept-preview-container">
        <div class="cart-recept-text">
HTML;
//add the name and price of all the cart in the preview
foreach ($items as $item) {
    $name = $item->Item->Nom;
    $price = $item->Item->Prix;
    $body_content .= <<<HTML
    <p>$name : $price</p>
    HTML;
    $total += $price;
}
//show total cost
//submit to buy everything in the cart
//A button to remove all items from cart
$body_content .= <<<HTML
            <p>Total: $total Écus</p>
            </div>
            <button type="submit" class='cart-submit-button'>Submit</button>
            <button type="button" class='cart-remove-all-button' onclick="location.href='cartRemoveAll.php'">Tout retirer</button>
        </div>
    </div>
</form>
HTML;

require "views/master.php";