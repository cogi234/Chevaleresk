<?php

// PDO
require_once "items.php";

// UTILITIES
require_once "pdoUtilities.php";

// HTML
require_once "storeHTML.php";

// Page #
// Criterias

// Is Admin
isset_default($_GET["isAdmin"], false);
$is_admin = $_GET["isAdmin"] == "true";

// Pagination
$show_count = 18;

isset_default($_GET["page"], 0);
$page_count = intval($_GET["page"]);

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

echo $items_html;