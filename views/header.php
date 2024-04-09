<?php
require_once "php/html_utilities.php";

require_once 'php/session_manager.php';

// PDO
require_once "php/model/player.php";
require_once "php/model/cart_item.php";

// Links
$icon_cart_url = "cart.php";
$icon_profile_url = "";
$icon_inventory_url = "inventory.php";
$icon_inscription_url = "newUserForm.php";
$icon_connection_url = "loginForm.php";
$icon_disconnect_url = "operations/disconnect.php";

// Display only when connected
if (is_connected()) {
    Player::refreshLocalPlayer();
    $player = Player::getLocalPlayer();

    // Dropdown
    $dropdown = dropdown("", [
        dropdown_item("Magasin", "index.php"),
        dropdown_item("Enigma", "#"),
        dropdown_item("Panoramix", "#"),
    ], "fa-solid fa-bars header_dropdown");

    // Money amount
    $money_amount = $player->Balance;
    $money_section = <<<HTML
        <!-- MONEY -->
        <i id="header_money" class="header-icon fa-solid fa-money-bill" title="Vous avez $money_amount écus">
            <div><span>$money_amount</span></div>
        </i>
    HTML;

    // Cart amount
    $cart_array = CartItem::selectAll(
        [CartItem::QUANTITY],
        equals(CartItem::ID_PLAYER, $player->Id)
    );

    $cart_amount = 0;
    foreach ($cart_array as $cart_item) {
        $cart_amount += $cart_item->Quantity;
    }

    $cart_section = <<<HTML
        <!-- CART -->
        <a id="header_cart" class="header-icon fa-solid fa-cart-shopping" href="$icon_cart_url" title="Panier" title="Vous avez $cart_amount objets dans votre panier">
            <span>$cart_amount</span>
        </a>
    HTML;

    // Profile
    $name = $player->get_fullname();

    $profile_section = <<<HTML
        <!-- INVENTORY -->
        <a id="header_inventory" class="header-icon fa-solid fa-briefcase" href="$icon_inventory_url" title="Votre inventaire"></a>
        <!-- PROFILE -->
        <a id="header_profile" class="header-icon fa-solid fa-user" href="$icon_profile_url" title="Le profil de $name"></a>
        <!-- DISCONNECT -->
        <a id="header_disconnect" class="header-icon fa-solid fa-arrow-right-from-bracket" href="$icon_disconnect_url" title="Se déconnecter"></a>
    HTML;

}

// Prevent crash
isset_default($money_section);
isset_default($cart_section);
isset_default($dropdown);
isset_default($profile_section, <<<HTML
    <!-- INSCRIPTION -->
    <a id="header_profile" class="header-icon fa-solid fa-user-plus" href="$icon_inscription_url" title="Inscription"></a>
    <!-- CONNECTION -->
    <a id="header_profile" class="header-icon fa-solid fa-user" href="$icon_connection_url" title="Connexion"></a>
HTML);

// Content
$header_content = <<<HTML
     <!-- LEFT -->
     <div id="header-section-left" class="header-section">
        <!-- LOGO  -->
        <a id="header_logo" href="index.php" title="Chevaleresk">
            <img src="images/header/logo.png" />
        </a>
        
        <!-- OPTIONS  -->
        <div id="header_options">
            $dropdown
        </div>
    </div>

    <!-- MIDDLE -->
    <div id="header-section-middle" class="header-section" style="width: 100%">
        <h1 id="header_title">$page_title</h1>
    </div> 

     <!-- RIGHT  -->
     <div id="header-section-right" class="header-section">
        $money_section
        $cart_section
        $profile_section
     </div>
HTML;