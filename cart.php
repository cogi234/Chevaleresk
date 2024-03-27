<?php
require_once("php/pdo/pdo.php");
require_once("php/model/cart_item.php");
require_once("php/html/cartHTML.php");
require_once("php/php_utilities.php");
require_once("php/model/player.php");

require_once("php/session_manager.php");
userAccess();

// Title
$page_title = "Panier";

$styles_view = '<link rel="stylesheet" href="css/cart_styles">';

$player = Player::getLocalPlayer();
$currentPlayerId = $player->Id;
$nbCoins = $player->Balance;
isset_default($total, 0);
isset_default($isEmpty, false);
isset_default($hasEnoughCoins, true);
isset_default($outOfStock, false);

$items = CartItem::selectAll(
    [
        CartItem::IDPLAYER,
        Item::ID,
        Item::NAME,
        Item::PRICE,
        CartItem::QUANTITY,
        Item::IMAGE,
        Item::QUANTITY
    ],
    "idJoueur= $currentPlayerId"
);


//Check if there's something in the cart
isset_default($cartItemList);
if($items != null && count($items)>0){
    //if true show them
    foreach($items as $item){
        $cartItemList .= cartItem(
            $item->Item->getImage(),
            $item->Item->Name,
            $item->Quantity,
            $item->Item->Quantity,
            $item->Item->Id
        );
        if($item->Item->Quantity < 1)
            $outOfStock = true;
    }
    //if false show a message
}else{
    $isEmpty = true;
    $cartItemList .=<<<HTML
        <p class="cart-empty-msg">Aucun item dans le panier...</p>
    HTML;
}

//show recept preview
//add the name and price of all the cart in the preview
isset_default($cartRecept);
foreach($items as $item){
    $name = $item->Item->Name;
    $price = $item->Item->Price;
    $cartRecept .= <<<HTML
    <p>$name : $item->Quantity x $price</p>
    HTML;
    $total += $price * $item->Quantity;
}
//show total cost
//submit to buy everything in the cart
//A button to remove all items from cart
$cartRecept .= <<<HTML
    <p>Total: $total Écus</p>
HTML;

isset_default($cartSubmitRemoveBtn);
$hasEnoughCoins = $nbCoins > $total;
if($isEmpty || !$hasEnoughCoins || $outOfStock){
    $cartSubmitRemoveBtn .=<<<HTML
        <button disabled type="submit" class='cart-submit-button'>Acheter</button>
    HTML;
}else{
    $cartSubmitRemoveBtn .=<<<HTML
        <button type="submit" class='cart-submit-button'>Acheter</button>
    HTML;
}
$cartSubmitRemoveBtn .=<<<HTML
    <button type="button" class='cart-remove-all-button' onclick="location.href='cartRemoveAll.php'">Tout retirer</button>
HTML;

///////
$body_content = <<<HTML
<form class="cart-main" action="cartBuy.php">
    <div class="cart-itemList-scroll-container">
        $cartItemList
    </div>
    <div class="cart-recept-preview-container">
        <div class="cart-recept-text">
            $cartRecept
        </div>
        $cartSubmitRemoveBtn
    </div>
</form>
HTML;
/////

require "views/master.php";