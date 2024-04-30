<?php
require_once "php/html_utilities.php";

require_once 'php/session_manager.php';

// PDO
require_once "php/model/player.php";
require_once "php/model/cart_item.php";

// Links
$icon_cart_url = "cart.php";
$icon_inventory_url = "inventory.php";
$icon_inscription_url = "newUserForm.php";
$icon_connection_url = "loginForm.php";
$icon_player_list_url = "playerList.php";

isset_default($scripts_view);

// Display only when connected
if (is_connected()) {
    Player::refreshLocalPlayer();
    $player = Player::getLocalPlayer();

    // Dropdown
    $dropdown = dropdown("", [
        dropdown_item("<i class='fa-solid fa-store'></i> Magasin", "index.php"),
        dropdown_item("<i class='fa-solid fa-clipboard-question'></i> Enigma", "enigma.php"),
        dropdown_item("<i class='fa-solid fa-flask-vial'></i> Panoramix", "panoramix.php"),
    ], "fa-solid fa-bars header_dropdown");

    // Money amount
    $money_amount = $player->Balance;
    $money_section = <<<HTML
        <!-- MONEY -->
        <i id="header_money" class="header-icon fa-solid fa-money-bill" title="Vous avez $money_amount écus"></i>
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
        <a id="header_cart" class="header-icon fa-solid fa-cart-shopping" href="$icon_cart_url" title="Panier" title="Vous avez $cart_amount objets dans votre panier"></a>
HTML;
    
    $scripts_view .= <<<HTML
        <script>
            let headerCartRefresh = new PartialRefresh("php/partial/cart_amount.php", "header_cart", 30);
            let headerMoneyRefresh = new PartialRefresh("php/partial/money_amount.php", "header_money", 30);
        </script>
HTML;


    // Inventory
    $inventory_section = <<<HTML
        <!-- INVENTORY -->
        <a id="header_inventory" class="header-icon fa-solid fa-briefcase" href="$icon_inventory_url" title="Votre inventaire"></a>
HTML;

    // Profile
    $avatar = $player->getAvatar();

    $user_section = <<<HTML
        <!-- PLAYER LIST -->
        <a id="header_player_list" class="header-icon fa-solid fa-users" href="$icon_player_list_url" title="Liste des joueurs"></a>
        
        <i id="header_profile" class="header-icon" style="background: url('$avatar');" title="C'est vous!"></i>
HTML;

    $scripts_view .= <<<HTML
        <script>
            fetch("operations/getLocalInformations.php")
                .then(r => r.ok ? r.json() : [])
                .then(d => create_slider("user_slider", "main", d, $("#header_profile")));
        </script>
HTML;
}

// Prevent crash
isset_default($money_section);
isset_default($cart_section);
isset_default($inventory_section);

isset_default($dropdown);
isset_default($user_section, <<<HTML
    <!-- PLAYER LIST -->
    <a id="header_player_list" class="header-icon fa-solid fa-users" href="$icon_player_list_url" title="Liste des joueurs"></a>

    <!-- INSCRIPTION -->
    <a id="header_inscription" class="header-icon fa-solid fa-user-plus" href="$icon_inscription_url" title="Inscription"></a>

    <!-- CONNECTION -->
    <a id="header_connection" class="header-icon fa-solid fa-right-to-bracket" href="$icon_connection_url" title="Connexion"></a>
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
        $inventory_section
        $user_section
     </div>
HTML;