<?php

require_once "php/model/player.php";
require_once "php/model/item.php";
require_once "php/model/inventory_item.php";
require_once "php/pdo/pdo_utilities.php";
require_once "php/session_manager.php";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/details_items_styles.css">';

// Title
$page_title = "Détails";

$item_id = $_GET[TAG_ID];

$item = Item::selectComplete(equals(Item::ID, $item_id));

if ($item == false)
    redirect("forbidden.php");

$image_url = $item->getImage();
$icon_url = $item->getIcon();

$name = $item->Name;
$description = $item->Description;
$price = $item->Price;
$stock = $item->Quantity;

// Types
$type = $item->Type;
$type_html = "";
include_once "php/html/itemsDetailsTypeHTML.php";

$stock_html = <<<HTML
    <div>$stock</div>
HTML;

if (is_connected()) {
    $player_id = Player::getLocalPlayer()->Id;
    $quantity_to_buy_html = <<<HTML
    <div>TEMP</div>
HTML;
    $buy_html = <<<HTML
    <div>TEMP</div>
HTML;
}
isset_default($quantity_to_buy_html);
isset_default($buy_html);

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
                <!-- <div></div> -->
                
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
        <!-- <div></div> -->
    </div>

    <!-- PANIER -->
    <div id="details-cart">
        $ $price
        $stock_html
        $quantity_to_buy_html
        $buy_html
    </div>
HTML;