<?php

// PDO
require_once "php/model/player.php";
require_once "php/model/item.php";
require_once "php/model/inventory_item.php";
require_once "php/model/cart_item.php";
require_once "php/model/review.php";

// Utilities
require_once "php/pdo/pdo_utilities.php";
require_once "php/html/cartHTML.php";

// Session
require_once "php/session_manager.php";

// Scripts
isset_default($scripts_view);
$scripts_view .= "<script defer src='js/local/toggle_details_cart.js'></script>";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/details_items_styles.css">';

// Title
$page_title = "Détails";

$item_id = $_GET[TAG_ID];

// Get item
$item = Item::selectComplete(equals(Item::ID, $item_id));

// If item not found
if ($item == false)
    redirect("forbidden.php");

// Get informations
$image_url = $item->getImage();
$icon_url = $item->getIcon();

$name = $item->Name;
$description = $item->Description;
$price = $item->Price;
$stock = $item->Quantity;
$type = $item->Type;

// Get the HTML for the type
$type_html = "";
include_once "php/html/itemsDetailsTypeHTML.php";

$price_html = <<<HTML
    <p class="details-cart-text">$price écus</p>
HTML;

$stock_html = <<<HTML
    <p class="details-cart-text">$stock en stock</p>
HTML;

$inventory_html = "";
$quantity_to_buy_html = "";
$buy_html = "";

if (is_connected()) {
    $player_id = Player::getLocalPlayer()->Id;
    $alchemy_level = Player::getLocalPlayer()->AlchemyLevel;

    // Fetch amount of this item in the inventory
    $inventory_item = InventoryItem::select(
        [
            InventoryItem::QUANTITY
        ],
        _and(
            equals(InventoryItem::ID_PLAYER, $player_id),
            equals(Item::ID, $item_id)
        )
    );

    $inventory = 0;
    if ($inventory_item != false)
        $inventory = $inventory_item->Quantity;

    if ($inventory > 0) {
        $inventory_html = <<<HTML
            <p class="details-cart-text">$inventory en inventaire</p>
        HTML;
        
        $review = Review::selectComplete(_and(equals(Review::PLAYERID, $player_id), equals(Review::ITEMID, $item_id)));
        if ($review == false) {
            // Si on n'a pas deja une evaluation, on mets le bouton
            $review_html = <<<HTML
            <div class="new-review-div">
                <button class="new-review-button"
                    hx-post="operations/getReviewForm.php?id=$item_id"
                    hx-trigger="click"
                    hx-target="#new-review-container"
                    hx-swap="innerHTML">
                    Évaluer l'item
                </button>
            </div>
HTML;
        }
    }

    // Fetch amount of this item in the cart
    $cart_item = CartItem::select(
        [
            CartItem::QUANTITY
        ],
        _and(
            equals(CartItem::ID_PLAYER, $player_id),
            equals(Item::ID, $item_id)
        )
    );

    $count = 0;
    if ($cart_item != false)
        $count = $cart_item->Quantity;

    $buy_html = onDetailsCounter($player_id, $item_id);

    if ($type == "ingredient" && $alchemy_level == 0) {
        $buy_html = "";
    }
}

isset_default($review_html);

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

    </div>

    <!-- PANIER -->
    <div id="details-cart">
        <i id="details-cart-collapse" class="fa-solid fa-minus"></i>
        $price_html
        $stock_html
        $inventory_html
        <div id="details-buy">
            $buy_html
        </div>
    </div>
    
    <!-- REVIEWS -->
    <div id="details-reviews">
        <div id="new-review-container">
            $review_html
        </div>
        <div id="reviews-container"></div>
    </div>
    HTML;

isset_default($scripts_view);
$scripts_view .= <<<HTML
    <script>
        htmx.on("htmx:after-request", function(evt){ headerCartRefresh.refresh(true) });
    </script>
HTML;