<?php
require_once "php/htmlUtilities.php";
require_once "php/pdo.php";
require_once "php/joueurs.php";
require_once 'php/sessionManager.php';

// Links
$icon_money_url = "";
$icon_cart_url = "cart.php";
$icon_profile_url = "";
$icon_inventory_irl = "inventory.php";
$icon_inscription_url = "newUserForm.php";
$icon_connection_url = "loginForm.php";
$icon_disconnect_url = "disconnect.php";

//Display only when connected
$money_section = "";
$cart_section = "";
$profile_section = "";
$dropdown = "";
if (isset ($_SESSION["connected"]) && $_SESSION["connected"] == true) {
    // Dropdown
    $dropdown = dropdown("", [
        dropdown_item("Enigma", "#"),
        dropdown_item("Panoramix", "#"),
    ], "fa-solid fa-angle-down header_dropdown");

    //Money amount
    $money_amount = $_SESSION['joueur']->solde;
    $money_section = <<<HTML
    <a id="header_money" class="header-icon fa-solid fa-money-bill" href="$icon_money_url">
        <div>
            <span>$money_amount</span>
        </div>
    </a>
    HTML;

    //Cart amount
    $cart_amount = select("count(*)", "panier", "idJoueur = " . $_SESSION['joueur']->Id)["count(*)"];
    $cart_section = <<<HTML
    <a id="header_cart" class="header-icon fa-solid fa-cart-shopping" href="$icon_cart_url" title="Panier">
        <span>$cart_amount</span>
    </a>
    HTML;

    //Profile
    $profile_section = <<<HTML
    <a id="header_profile" class="header-icon fa-solid fa-briefcase" href="$icon_inventory_irl" title="Inventaire"></a>
    <a id="header_profile" class="header-icon fa-solid fa-user" href="$icon_profile_url" title="Profile"></a>
    <a id="header_profile" class="header-icon fa-solid fa-arrow-right-from-bracket" href="$icon_disconnect_url" title="Déconnexion"></a>
    HTML;
    
} else { //Display when disconnected
    //Profile
    $profile_section = <<<HTML
    <a id="header_profile" class="header-icon fa-solid fa-user-plus" href="$icon_inscription_url" title="Inscription"></a>
    <a id="header_profile" class="header-icon fa-solid fa-user" href="$icon_connection_url" title="Connexion"></a>
    HTML;
}


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
        <!-- MONEY -->
        $money_section
        <!-- CART -->
        $cart_section
        <!-- PROFILE -->
        $profile_section
     </div>
HTML;