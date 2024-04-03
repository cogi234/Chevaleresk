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
    int $price
): string {
    isset_default($content);

    $url = "details.php?type=item&id=$idItem";
    $elementId = "cart-item-$idItem";

    //check if the item is still in stock
    if ($quantityStock > $quantity) {
        $content .= <<<HTML
            <div class="cart-item" id="$elementId">
                <a href="$url" class="cart-item-image"><img src="$image"/></a>
                <div class="cart-item-info">
                    <p class="name-item">$name</p>
                    <div class="number-item">
                        <div class="fa fa-minus cart-quantity-modifier"
                            hx-post="operations/cartRemove.php?id=$idItem&action=cart-item"
                            hx-trigger="click"
                            hx-target="#$elementId"
                            hx-swap="outerHTML"></div>
                        <p class="cart-quantity">$quantity</p>
                        <div class="fa fa-plus cart-quantity-modifier"
                            hx-post="operations/cartAdd.php?id=$idItem&action=cart-item"
                            hx-trigger="click"
                            hx-target="#$elementId"
                            hx-swap="outerHTML"></div>
                    </div>
                </div>
                <div class="cart-item-remove-error">
                    <p hidden class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartRemove.php?id=$idItem&quantity=$quantity"></a>
                </div>
            </div>
            HTML;
    } else if ($quantityStock == $quantity) {
        $content .= <<<HTML
            <div class="cart-item" id="$elementId">
                <a href="$url" class="cart-item-image"><img src="$image"/></a>
                <div class="cart-item-info">
                    <p class="name-item">$name</p>
                    <div class="number-item">
                        <div class="fa fa-minus cart-quantity-modifier"
                            hx-post="operations/cartRemove.php?id=$idItem&action=cart-item"
                            hx-trigger="click"
                            hx-target="#$elementId"
                            hx-swap="outerHTML"></div>
                        <p class="cart-quantity">$quantity</p>
                        <div class="fa fa-plus cart-quantity-modifier"
                            hx-post="operations/cartAdd.php?id=$idItem&action=cart-item"
                            hx-trigger="click"
                            hx-target="#$elementId"
                            hx-swap="outerHTML"></div>
                    </div>
                </div>
                <div class="cart-item-remove-error">
                    <p hidden class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartRemove.php?id=$idItem&quantity=$quantity"></a>
                </div>
            </div>
            HTML;
    } else {
        //if false show message
        $content .= <<<HTML
            <div class="cart-item-outofstock" id="$elementId">
                <a href="$url" class="cart-item-image"><img src="$image"/></a>
                <div class="cart-item-info">
                    <p class="name-item">$name</p>
                    <div class="number-item">
                        <div class="fa fa-minus cart-quantity-modifier"
                            hx-post="operations/cartRemove.php?id=$idItem&action=cart-item"
                            hx-trigger="click"
                            hx-target="#$elementId"
                            hx-swap="outerHTML"></div>
                        <p class="cart-quantity">$quantity</p>
                    </div>
                </div>
                <div class="cart-item-remove-error">
                    <p class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartRemove.php?id=$idItem&quantity=$quantity"></a>
                </div>
            </div>
            HTML;
    }

    return $content;
}