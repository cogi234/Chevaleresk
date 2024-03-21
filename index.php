<?php

require_once "php/phpUtilities.php";
require_once "php/storeHTML.php";

require_once "php/pdo.php";
require_once "php/items.php";

$page_title = "Magasin";

$items = Item::selectAll(
    [
        Item::ID,
        Item::NAME,
        Item::PRICE,
        Item::QUANTITY,
        Item::IMAGE,
        Item::TYPE
    ],
    Item::SELLABLE . ' = 1'
);

// Items
isset_default($items_html);

for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];

    // Parameters
    $item_id = $item->Id;
    $item_name = $item->Nom;
    $item_price = $item->Prix;
    $item_quantity = $item->Quantite;
    $item_image = $item->Image;
    $item_icon = $item->getIcon();

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