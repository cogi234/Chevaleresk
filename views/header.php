<?php

require_once "php/htmlUtilities.php";

// Values
$cart_amount = 3;
$money_amount = 33;

// Links
$icon_money_url = "";
$icon_cart_url = "";
$icon_profile_url = "newUser.php";

// Dropdown
$dropdown = dropdown("", [
    dropdown_item("Lorem Upon 1", "#"),
    dropdown_item("Lorem Upon 2", "#"),
], "fa-solid fa-angle-down header_dropdown");

// Content
$header_content = <<<HTML
     <!-- LEFT -->
     <div id="header-section-left" class="header-section">
        <!-- LOGO  -->
        <div id="header_logo">
            <img src="images/header/logo.png" />
        </div>
        
        <!-- OPTIONS  -->
        <div id="header_options">
            $dropdown
        </div>
    </div>

    <!-- MIDDLE -->
    <div id="header-section-middle" class="header-section" style="width: 100%"></div> 

     <!-- RIGHT  -->
     <div id="header-section-right" class="header-section">
        <!-- MONEY -->
        <a id="header_money" class="header-icon fa-solid fa-money-bill" href="$icon_money_url" target="blank">
            <div>
                <span>$money_amount</span>
            </div>
        </a>

        <!-- CART -->
        <a id="header_cart" class="header-icon fa-solid fa-cart-shopping" href="$icon_cart_url" target="blank">
            <span>$cart_amount</span>
        </a>
        
        <!-- PROFILE -->
        <a id="header_profile" class="header-icon fa-solid fa-user" href="$icon_profile_url" target="blank"></a>
     </div>
HTML;