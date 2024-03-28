<?php
require_once ("php/pdo/pdo.php");
require_once ("php/model/cart_item.php");
require_once ("php/html/cartHTML.php");
require_once ("php/php_utilities.php");
require_once ("php/model/player.php");
require_once ("php/pdo/pdo_utilities.php");

require_once ("php/session_manager.php");
userAccess();

// Title
$page_title = "Panier";

// Styles view
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/cart_styles">';

// Get player data
$player = Player::getLocalPlayer();
$nbCoins = $player->Balance;

$items = CartItem::selectAllComplete(
    equals(Player::ID, $player->Id)
);


//Check if there's something in the cart
isset_default($cartItemList);
$has_invalid_item = false;

// If there are items
if (count($items) > 0) {
    foreach ($items as $item) {
        $cartItemList .= cartItem(
            $item->Item->getImage(),
            $item->Item->Name,
            $item->Quantity,
            $item->Item->Quantity,
            $item->Item->Id
        );

        if ($item->Item->Quantity < 1)
            $has_invalid_item = true;
    }
} else {
    $has_invalid_item = true;
    $cartItemList .= <<<HTML
        <p class="cart-empty-msg">Aucun item dans le panier...</p>
    HTML;
}

// Show recept preview
// Add the name and price of all the cart in the preview
$cartRecept = "";
$total = 0;

foreach ($items as $item) {
    $name = $item->Item->Name;
    $price = $item->Item->Price;
    $cartRecept .= <<<HTML
        <p>$name : $item->Quantity x $price</p>
    HTML;
    $total += $price * $item->Quantity;
}

// Show total cost
// Submit to buy everything in the cart
// A button to remove all items from cart
$cartSubmitState = "";
if ($has_invalid_item || $nbCoins < $total) {
    $cartSubmitState = "disabled";
}

///////
$body_content = <<<HTML
<form class="cart-main" action="cartBuy.php">
    <div class="cart-itemList-scroll-container">
        $cartItemList
    </div>
    <div class="cart-recept-preview-container">
        <!-- RECEPT -->
        <div class="cart-recept-text">
            $cartRecept

            <p>Total: $total Écus</p>
        </div>

        <button type="submit" class='cart-submit-button' $cartSubmitState>Acheter</button>
        <button type="button" class='cart-remove-all-button' onclick="location.href='cartRemoveAll.php'">Tout retirer</button>
    </div>
</form>
HTML;
/////

require "views/master.php";