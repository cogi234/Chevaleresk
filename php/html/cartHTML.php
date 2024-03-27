<?php

const PATH_IMAGES = "images/items/images/";

/**
 * Creates the visual for an item in the cart
 * @author Akuma
 * Date of creation    : 2024/03/20
 * Date of modification: 2024/03/26
 */
function cartItem(
    string $image,
    string $name,
    int $quantity,
    int $quantityStock,
    int $idItem,
): string{
    $content = "";
        //check if the item is still in stock
        if($quantityStock > 0){
            $content .= <<<HTML
            <div class="cart-item">
                <a href="#" class="cart-item-image"><img src="$image"/></a>
                    <div class="cart-item-info">
                        <p class="name-item">$name</p>
                        <div class="number-item">
                            <p>x</p>
                            <p class="cart-quantity">$quantity</p>
                            <a href="operations/cartAdd.php?id=$idItem" class="fa fa-plus cart-quantity-modifier"></a>
                            <a href="operations/cartRemove?id=$idItem" class="fa fa-minus cart-quantity-modifier"></a>
                        </div>
                    </div>
                    <div class="cart-item-remove-error">
                    <p hidden class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartRemove.php?id=$idItem&quantity=$quantity"></a>
            HTML;   
        }else{
            //if false show message
            $content .= <<<HTML
                <div class="cart-item-outofstock">
                <div class="cart-item-image"><img src="$image"/></div>
                    <div class="cart-item-info">
                        <p class="name-item">$name</p>
                        <div class="number-item">
                            <p>x</p>
                            <p class="cart-quantity">$quantity</p>
                            <a href="operations/cartAdd.php?id=$idItem" class="fa fa-plus cart-quantity-modifier"></a>
                            <a href="operations/cartRemove?id=$idItem" class="fa fa-minus cart-quantity-modifier"></a>
                        </div>
                    </div>
                    <div class="cart-item-remove-error">
                    <p class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartRemove.php?id=$idItem&quantity=$quantity"></a>
            HTML;
        }
        $content .= <<<HTML
                </div>
            </div>
        HTML;
    return $content;
}