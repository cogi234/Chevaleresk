<?php

require_once "php/model/player.php";
require_once "php/model/item.php";
require_once "php/model/inventory_item.php";
require_once "php/model/armor.php";
require_once "php/model/ingredient.php";
require_once "php/model/potion.php";
require_once "php/model/ingredient.php";
require_once "php/pdo/pdo_utilities.php";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/details_items_styles.css">';

$item_id = $_GET[TAG_ID];
$item = Item::selectComplete(equals(Item::ID, $item_id));


$image_url = $item->getImage();
$icon_url = $item->getIcon();

$name = $item->Name;
$description = $item->Description;
$price = $item->Price;
$stock = $item->Quantity;
$type = $item->Type;

switch ($type) {
    case Item::TYPES[0]:
        $weapon = Weapon::selectComplete(equals(Weapon::ID, $item_id));
        $efficacy = $weapon->Efficacy;
        $weapon_type = $weapon->Type;
        $type_html = <<<HTML
        <div>TEMP</div>
HTML;
        break;
    case Item::TYPES[1]:
        $armor = Armor::selectComplete(equals(Weapon::ID, $item_id));
        $material = $armor->Material;
        $size = $armor->Size;
        $type_html = <<<HTML
        <div>TEMP</div>
HTML;
        break;
    case Item::TYPES[2]:
        $ingredient = Ingredient::selectComplete(equals(Weapon::ID, $item_id));
        $ingredient_type = $ingredient->Type;
        $rarity = $ingredient->Rarity;
        $danger = $ingredient->Danger;
        $type_html = <<<HTML
        <div>TEMP</div>
HTML;
        break;
    case Item::TYPES[3]:
        $potion = Potion::selectComplete(equals(Weapon::ID, $item_id));
        $potion_type = $potion->Type;
        $effect = $potion->Effect;
        $duration = $potion->Duration;
        $type_html = <<<HTML
        <div>TEMP</div>
HTML;
        break;
}
isset_default($type_html, "<div>Unhandled item type!</div>");

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
        $quantity_to_buy_html
        $buy_html
    </div>
HTML;