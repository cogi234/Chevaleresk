<?php
require_once("php/pdo.php");
require_once("php/cartItem.php");
require_once("php/cartHTML.php");

$styles_view = '<link rel="stylesheet" href="css/cart_styles">';

$currentPlayerId = 1;

//check there's is a current player and throw forbiddenPage if true
if(isset($currentPlayerId)){
    //redirect to forbidden
}

$items = CartItem::selectAll(
    [
        CartItem::PLAYER,
        CartItem::ITEM,
        CartItem::NAME,
        CartItem::PRICE,
        CartItem::QUANTITY,
        CartItem::IMAGE,
        CartItem::QUANTITY_STOCK
    ],
    "idJoueur= $currentPlayerId"
);

$total = 0;

$body_content = <<<HTML
<form class="cart-main" action="#">
    <div class="cart-itemList-scroll-container">
HTML;
//Check if there's something in the cart
if($items != null && count($items)>0){
    //if true show them
    foreach($items as $item){
        $body_content .= cartItem(
            $item->image,
            $item->nom,
            $item->Quantite,
            $item->QuantiteStock,
            $item->idItem
        );
    }
    //if false show a message
}else{
    $body_content .=<<<HTML
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
foreach($items as $item){
    $body_content .= <<<HTML
    <p>$item->nom : $item->prix x $item->Quantite</p>
    HTML;
    $total += $item->prix * $item->Quantite;
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