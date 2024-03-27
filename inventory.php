<?php
require_once "php/phpUtilities.php";
require_once "php/inventoryHTML.php";
require_once "php/inventory_items.php";
require_once "php/joueurs.php";

require_once ("php/sessionManager.php");
userAccess();

$page_title = "Inventaire";

$idJoueur = unserialize($_SESSION['joueur'])->Id;
$items = InventoryItem::selectAll(
    [
        InventoryItem::IDPLAYER,
        Item::ID,
        Item::NAME,
        Item::IMAGE,
        Item::TYPE,
        InventoryItem::QUANTITY,
    ],
    InventoryItem::IDPLAYER . " = $idJoueur"
);

// Items
isset_default($items_html);

for ($i = 0; $i < count($items); $i++) {
    $item = $items[$i];

    // Parameters
    $item_idJoueur = $item->IdJoueur;
    $item_idItem = $item->Item->Id;
    $item_name = $item->Item->Nom;
    $item_image = $item->Item->getImage();
    $item_icon = $item->Item->getIcon();
    $item_quantity = $item->Quantite;

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