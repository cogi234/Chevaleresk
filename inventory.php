<?php
require_once "php/php_utilities.php";
require_once "php/html/inventoryHTML.php";
require_once "php/model/inventory_item.php";
require_once "php/model/player.php";

require_once ("php/session_manager.php");
userAccess();

$page_title = "Inventaire";

$idPlayer = Player::getLocalPlayer()->Id;
$items = InventoryItem::selectAll(
    [
        InventoryItem::IDPLAYER,
        Item::ID,
        Item::NAME,
        Item::IMAGE,
        Item::TYPE,
        InventoryItem::QUANTITY,
    ],
    InventoryItem::IDPLAYER . " = $idPlayer"
);

// Items
isset_default($items_html);

for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];

    // Parameters
    $item_idJoueur = $item->$IdPlayer;
    $item_idItem = $item->Item->Id;
    $item_name = $item->Item->Name;
    $item_image = $item->Item->getImage();
    $item_icon = $item->Item->getIcon();
    $item_quantity = $item->Quantity;

    // Render
    $items_html .= inventory_item(
        $item_idJoueur,
        $item_idItem,
        $item_name,
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