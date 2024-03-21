<?php

// PDO
require_once "php/pdo.php";
require_once "php/items.php";

// UTILITIES
require_once "php/phpUtilities.php";
require_once "php/pdoUtilities.php";

// HTML
require_once "php/storeHTML.php";
require_once "php/filterHTML.php";

$is_admin = false;

// Pagination
$show_count = 18;
$page_count = 0;

// Sort
$sort_types = Item::TYPES;

// Select
$condition = in(Item::TYPE, ...$sort_types);

if (!$is_admin)
    $condition = _and($condition, equals(Item::SELLABLE, 1));

$other = combine(
    orderByAll([Item::PRICE], [Item::NAME]),
    limit($show_count, $page_count * $show_count)
);

$items = Item::selectAll(
    [
        Item::ID,
        Item::NAME,
        Item::PRICE,
        Item::QUANTITY,
        Item::IMAGE,
        Item::TYPE
    ],
    $condition,
    $other
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
    $item_image = $item->getImage();
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

for ($i = 0; $i < $show_count - count($items); $i++)
    $items_html .= "<i></i>";

// Filters
$filter_html = filter_render(<<<HTML
    <p>Filtres</p>
    <hr>
HTML);

$body_content = <<<HTML
    $filter_html

    <div style="display: flex;">
        <!-- ITEMS -->
        <div id="store-item-parent">
            <div class="store-item-holder">
                $items_html
            </div>

            <!-- PAGES -->
            <div></div>
        </div>
    </div>
HTML;

require "views/master.php";