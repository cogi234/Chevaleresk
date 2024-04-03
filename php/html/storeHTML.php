<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";

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
    $url = "details?type=item&id=$id";

    // Initialize variables
    isset_default($oos_html);
    isset_default($quantity_html);

    // React depending on the quantity given
    if ($quantity <= 0) {
        $oos_html = <<<HTML
            <div class="store-item-oos-background">
                <p class="store-item-oss-label">HORS STOCK</p>
            </div>
        HTML;
    } else {
        $quantity_html = <<<HTML
            <div class="store-item-quantity">
                <p class="store-item-quantity-label">$quantity</p>
            </div>
        HTML;
    }

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
            $quantity_html

            <!-- OUT OF STOCK -->
            $oos_html
        </a>
    HTML;
}