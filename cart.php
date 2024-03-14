<?php

$styles_view = '<link rel="stylesheet" href="css/cart_styles">';

$total = 0;

$body_content = <<<HTML
<form class="cart-main" action="">
    <div class="cart-itemList-scroll-container">
HTML;
for($i = 0; $i < 10; $i++){
    $body_content .= <<<HTML
        <div class="cart-item">
            <div class="cart-item-image"><img src="images/items/images/Placeholder.png"/></div>
                <div class="cart-item-info">
                    <p class="name-item">Nom</p>
                    <div class="number-item"><p>x</p><input value="1" type="number"/></div>
                </div>
                <div class="cart-item-remove-error">
                    <p hidden class="item-errorMessage" color="red">ErrorMessage</p>
                <a class="remove-item" href="#"><img src="images/icons/remove-icon"></a>
            </div>
        </div>
    HTML;
}
$body_content .= <<<HTML
    </div>
    <div class="cart-recept-preview-container">
        <div class="cart-recept-text">
HTML;
for($i = 0; $i < 10; $i++){
    $body_content .= <<<HTML
    <p>Item $i : 1.00$</p>
    HTML;
    //<p>$item.name : $item.price</p>
    //$total += $item.price
}
$total = 1*10;
$body_content .= <<<HTML
            <p>Total: $total$</p>
            </div>
            <button type="submit" class='cart-submit-button'>Submit</button>
            <button type="button" class='cart-remove-all-button' onclick="location.href='cartRemoveAll.php'">Tout retirer</button>
        </div>
    </div>
</form>
HTML;

require "views/master.php";