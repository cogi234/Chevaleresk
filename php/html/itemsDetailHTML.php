<?php

$image_url = "TEMP";
$icon_url = "TEMP";

$name = "TEMP";
$description = "TEMP";
$price = "TEMP";

$type_html = "TEMP HTML";
$stock_html = "TEMP HTML";
$quantity_html = "TEMP HTML";
$buy_html = "TEMP HTML";

$details_content = <<<HTML
    <div>
        <!-- IMAGE -->
        <div>
            <img src="$image_url" >
        </div>

        <!-- DETAILS -->
        <div>
            <!-- TITLE -->
            <div>
                <img src="$icon_url">
                <p>$name</p>
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
    <div>
        $description
    </div>

    <!-- REVIEWS -->
    <div></div>

    <!-- PANIER -->
    <div>
        $price
        $stock_html
        $quantity_html
        $buy_html
    </div>
HTML;