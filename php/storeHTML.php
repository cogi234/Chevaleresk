<?php

require_once "php/phpUtilities.php";

const PATH_IMAGES = "images/items/images/";
const PATH_ICONS = "images/items/icons/";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/store_styles.css">';

/**
 * Creates the visual for an item in the store
 * @author @WarperSan
 * Date of creation    : 2024/03/12
 * Date of modification: 2024/03/14
 */
function store_item(
    int $id,
    string $name,
    int $price,
    int $quantity,
    string $image,
    string $icon
): string {

    $image = PATH_IMAGES . $image;
    $icon = PATH_ICONS . $icon;

    $url = "";

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
                    <p class="store-item-price">$ $price</p>
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