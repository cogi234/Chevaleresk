<?php
require_once("php/pdo.php");
require_once("php/items.php");
require_once("php/cartItem.php");

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
<form class="cart-main" action="">
    <div class="cart-itemList-scroll-container">
HTML;
//Check if there's something in the cart
if($items != null && count($items)>0){
    //if true show them
    foreach($items as $item){
        //check if the item is still in stock
        if($item->quantiteStock > 0){
            //if true show a message
            $body_content .= <<<HTML
            <div class="cart-item">
                <div class="cart-item-image"><img src="$item->Image"/></div>
                    <div class="cart-item-info">
                        <p class="name-item">$item->Nom</p>
                        <div class="number-item"><p>x</p><input value="$item->Quantite" type="number"/></div>
                    </div>
                    <div class="cart-item-remove-error">
                    <a class="remove-item" href="#"><img src="images/icons/remove-icon"></a>
            HTML;   
        }else{
            $body_content .= <<<HTML
                <div class="cart-item-outofstock">
                <div class="cart-item-image"><img src="$item->Image"/></div>
                    <div class="cart-item-info">
                        <p class="name-item">$item->Nom</p>
                        <div class="number-item"><p>x</p><input value="$item->Quantite" type="number"/></div>
                    </div>
                    <div class="cart-item-remove-error">
                    <a class="remove-item" href="cartRemove.php?id=$item->idItem"><img src="images/icons/remove-icon"></a>
                    <p class="item-errorMessage" color="red">Hors Stock...</p>
            HTML;
        }
        $body_content .= <<<HTML
                </div>
            </div>
        HTML;
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
    <p>$item->Nom : $item->Prix</p>
    HTML;
    $total += $item->Prix;
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