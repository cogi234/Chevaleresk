<?php
require_once "php/php_utilities.php";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/store_styles.css">';

/**
 * Creates the visual for an item in the inventory
 * @author Colin Bougie
 * Date of creation    : 2024/03/19
 * Date of modification: 2024/03/19
 */
function inventory_item(
    int $idPlayer,
    int $idItem,
    string $name,
    int $quantity,
    string $image,
    string $icon
): string {

    $url = "item.php?id=$idItem";

    return <<<HTML
        <a class="store-item" href="$url" title="Voir les détails de $name">
            <!-- IMAGE -->
            <img class="store-item-image" src="$image">

            <!-- INFO -->
            <div class="store-item-info"> 
                <i class="store-item-icon" style="mask-image: url('$icon');">
                    <div class="store-item-icon-background"></div>
                </i>
                <div class="store-item-labels">
                    <p class="store-item-name">$name</p>
                </div>
            </div>

            <!-- BORDER -->
            <i class="store-item-border"></i>

            <!-- QUANTITY -->
            <div class="store-item-quantity">
                <p class="store-item-quantity-label">$quantity</p>
            </div>
        </a>
    HTML;
}