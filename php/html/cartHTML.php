<?php

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
    int $idItem
): string {
    isset_default($content);

    $url = "details.php?type=item&id=$idItem";
    $elementId = "cart-item-$idItem";

    //check if the item is still in stock
    if ($quantityStock >= $quantity) {
        $content .= <<<HTML
            <div class="cart-item" id="$elementId">
                <a href="$url" class="cart-item-image"><img src="$image"/></a>
                <div class="cart-item-info">
                    <p class="name-item">$name</p>
                    <div class="number-item">
                        <input type="number" min="0" max="$quantityStock" class="cart-quantity" name="quantity" value="$quantity"
                            hx-post="operations/cartChange.php?operation=set&id=$idItem&action=cart-item"
                            hx-trigger="change"
                            hx-target="#$elementId"
                            hx-swap="outerHTML">
                    </div>
                </div>
                <div class="cart-item-remove-error">
                    <p hidden class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartChange.php?operation=remove&id=$idItem&quantity=$quantity"></a>
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
                        <input type="number" min="0" max="$quantityStock" class="cart-quantity" name="quantity" value="$quantity"
                            hx-post="operations/cartChange.php?operation=set&id=$idItem&action=cart-item"
                            hx-trigger="change"
                            hx-target="#$elementId"
                            hx-swap="outerHTML">
                    </div>
                </div>
                <div class="cart-item-remove-error">
                    <p class="item-errorMessage" color="red">Hors Stock...</p>
                    <a class="remove-item fa fa-xmark" href="operations/cartChange.php?operation=remove&id=$idItem&quantity=$quantity"></a>
                </div>
            </div>
            HTML;
    }

    return $content;
}

/**
 * @author @WarperSan, @FelixCrevierBechard
 * Date of creation    : 2024/04/09
 * Date of modification: 2024/04/09
 */
function onCartItem(int $idPlayer, int $idItem): string
{
    $count = select("COUNT(idItem) num", "vPanier", "idJoueur = $idPlayer AND idItem = $idItem")["num"];

    if ($count <= 0)
        return "";

    $item = CartItem::selectComplete(
        _and(
            equals(Player::ID, $idPlayer),
            equals(Item::ID, $idItem)
        )
    );

    return cartItem(
        $item->Item->getImage(),
        $item->Item->Name,
        $item->Quantity,
        $item->Item->Quantity,
        $item->Item->Id
    );
}

/**
 * @author @WarperSan, @FelixCrevierBechard
 * Date of creation    : 2024/04/09
 * Date of modification: 2024/04/09
 */
function onDetailsCounter(int $idPlayer, int $idItem): string
{
    $count = intval(select("COUNT(idItem) num", "vPanier", "idJoueur = $idPlayer AND idItem = $idItem")["num"]);

    if ($count <= 0) {
        return <<<HTML
            <button id="add-to-cart"
                hx-post="operations/cartChange.php?operation=add&id=$idItem&action=details-counter"
                hx-trigger="click"
                hx-target="#details-buy"
                hx-swap="innerHTML">
                Ajouter au panier
            </button>
        HTML;
    }

    $item = CartItem::selectComplete(
        _and(
            equals(Player::ID, $idPlayer),
            equals(Item::ID, $idItem)
        )
    );

    $cart_quantity = intval($item->Quantity);
    $stock = intval($item->Item->Quantity);

    // HTML

    return <<<HTML
        <input type="number" min="0" max="$stock" class="details-cart-text" name="quantity" value="$cart_quantity"
            hx-post="operations/cartChange.php?operation=set&id=$idItem&action=details-counter"
            hx-trigger="change"
            hx-target="#details-buy"
            hx-swap="innerHTML">
    HTML;
}