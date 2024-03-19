<?php
require_once("php/pdo.php");
require_once("php/items.php");

$styles_view = '<link rel="stylesheet" href="css/cart_styles">';

$currentPlayerId = 1;

$items = Item::selectAll(
    [
        Item::NAME,
        Item::PRICE,
        Item::IMAGE,
        Item::QUANTITY
    ]
);

$total = 0;

$body_content = <<<HTML
<form class="cart-main" action="">
    <div class="cart-itemList-scroll-container">
HTML;
foreach($items as $item){
    $body_content .= <<<HTML
        <div class="cart-item">
            <div class="cart-item-image"><img src="$item->Image"/></div>
                <div class="cart-item-info">
                    <p class="name-item">$item->Nom</p>
                    <div class="number-item"><p>x</p><input value="1" type="number"/></div>
                </div>
                <div class="cart-item-remove-error">
                <a class="remove-item" href="#"><img src="images/icons/remove-icon"></a>
    HTML;
    if($item->Quantite < 1){
        $body_content .= <<<HTML
                <p class="item-errorMessage" color="red">Hors Stock...</p>
        HTML;
    }
    $body_content .= <<<HTML
            </div>
        </div>
    HTML;
}
$body_content .= <<<HTML
    </div>
    <div class="cart-recept-preview-container">
        <div class="cart-recept-text">
HTML;
foreach($items as $item){
    $body_content .= <<<HTML
    <p>$item->Nom : $item->Prix</p>
    HTML;
    $total += $item->Prix;
}
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