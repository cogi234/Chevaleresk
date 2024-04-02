<?php

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/details_items_styles.css">';

$image_url = "images/items/images/default_armor.png";
$icon_url = "images/items/icons/gun.svg";

$name = "Ail";
$description = "Une épée courte pour les aventuriers débutants.";
$price = "3";

$type_html = "TEMP HTML";
$stock_html = "TEMP HTML";
$quantity_html = "TEMP HTML";
$buy_html = "TEMP HTML";

$details_content = <<<HTML
    <div id="details-container">
        <div id="details">
            <!-- IMAGE -->
            <div>
                <img id="details-image" src="$image_url" >
            </div>

            <!-- DETAILS -->
            <div id="details-details">
                <!-- TITLE -->
                <div id="details-title">
                    <i id="details-type-icon" style="mask-image: url('$icon_url');"></i>
                    <p id="details-name">$name</p>
                </div>

                <!-- EVALUTION -->
                <div></div>
                
                <!-- TYPE DETAILS -->
                <div>
                    $type_html
                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div id="details-description">
            $description
        </div>

        <!-- REVIEWS -->
        <div></div>
    </div>

    <!-- PANIER -->
    <div id="details-cart">
        $ $price
        $stock_html
        $quantity_html
        $buy_html
    </div>
HTML;