<?php

const ITEMS_PER_PAGE = 100; // 18;

require_once dirname(__FILE__, 2) . "/require_utilities.php";

// PDO
require_path("php/model/item.php");

// UTILITIES
require_path("php/pdo/pdo_utilities.php");

// HTML
require_path("php/html/storeHTML.php");

// Is Admin
$is_admin = true;

// Page #
isset_default($_GET["page"], 0);
$page_count = intval($_GET["page"]);

// Out of stock
isset_default($_GET["oos"], "off");
$oos = $_GET["oos"] == "on";

// Types
isset_default($_GET["types"], []);
$sort_types = $_GET["types"];

// Select
$condition = in(Item::TYPE, ...$sort_types);

if (!$oos)
    $condition = _and($condition, ITEM::QUANTITY . ">" . 0);

if (!$is_admin)
    $condition = _and($condition, equals(Item::SELLABLE, 1));

$other = combine(
    orderByAll([Item::TYPE], [Item::PRICE], [Item::NAME]),
    limit(ITEMS_PER_PAGE, $page_count * ITEMS_PER_PAGE)
);

$items = Item::selectAllComplete(
    $condition,
    $other
);

// Items
isset_default($items_html);

for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];

    // Parameters
    $item_id = $item->Id;
    $item_name = $item->Name;
    $item_price = $item->Price;
    $item_quantity = $item->Quantity;
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

if (count($items) > 0) {
    for ($i = 0; $i < ITEMS_PER_PAGE - count($items); $i++)
        $items_html .= "<i></i>";
} else {
    $items_html = "<p style='color: var(--light);'>Aucun item trouvé ...</p>";
}


echo $items_html;