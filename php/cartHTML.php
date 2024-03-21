<?php

const PATH_IMAGES = "images/items/images/";

/**
 * Creates the visual for an item in the cart
 * @author Akuma
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/20
 */
function cartItem(
    string $image,
    string $nom,
    int $quantite,
    int $quantiteStock,
    int $idItem,
): string{
    $content = "";
    $image = PATH_IMAGES . $image;
        //check if the item is still in stock
        if($quantiteStock > 0){
            $content .= <<<HTML
            <div class="cart-item">
                <a href="#" class="cart-item-image"><img src="$image"/></a>
                    <div class="cart-item-info">
                        <p class="name-item">$nom</p>
                        <div class="number-item">
                            <p>x</p>
                            <p class="cart-quantity">$quantite</p>
                            <a href="cartAddQuantity.php?item=$idItem" class="fa fa-plus cart-quantity-modifier"></a>
                            <a href="cartReduceQuantity?item=$idItem" class="fa fa-minus cart-quantity-modifier"></a>
                        </div>
                    </div>
                    <div class="cart-item-remove-error">
                    <a class="remove-item fa fa-xmark" href="cartRemove.php?item=$idItem&quantite=$quantite"></a>
            HTML;   
        }else{
            //if false show message
            $content .= <<<HTML
                <div class="cart-item-outofstock">
                <div class="cart-item-image"><img src="$image"/></div>
                    <div class="cart-item-info">
                        <p class="name-item">$nom</p>
                        <div class="number-item">
                            <p>x</p>
                            <p class="cart-quantity">$quantite</p>
                            <a href="cartAddQuantity.php?item=$idItem" class="fa fa-plus cart-quantity-modifier"></a>
                            <a href="cartReduceQuantity?item=$idItem" class="fa fa-minus cart-quantity-modifier"></a>
                        </div>
                    </div>
                    <div class="cart-item-remove-error">
                    <a class="remove-item fa fa-xmark" href="cartRemove.php?item=$idItem&quantite=$quantite"></a>
                    <p class="item-errorMessage" color="red">Hors Stock...</p>
            HTML;
        }
        $content .= <<<HTML
                </div>
            </div>
        HTML;
    return $content;
}