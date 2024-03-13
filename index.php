<?php

require_once "php/phpUtilities.php";
require_once "php/storeHTML.php";

// Items
isset_default($items_html);

for ($i = 0; $i < 15; $i++) {
    // Parameters
    $item_id = $i;
    $item_name = "TEST";
    $item_price = 10;
    $item_quantity = 10;
    $item_image = "Placeholder.png";
    $item_icon = "shield-halved-solid.svg";

    // Render
    $items_html .= store_item(
        $item_id,
        $item_name,
        $item_price,
        $item_quantity,
        $item_image,
        $item_icon
    );
}

$body_content = <<<HTML
    <div style="width: 100%;">
        <div class="store-item-holder">
            $items_html
        </div>
    </div>
HTML;

require "views/master.php";