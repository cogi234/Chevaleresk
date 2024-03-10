<?php

$cart_amount = 3;
$money_amount = 33;

$header_content = <<<HTML
     <!-- LEFT   -->
     <div class="header-section">
        <!-- LOGO  -->
        <div id="header_logo">
            <img src="images/logo.png" />
        </div>
        
        <!-- OPTIONS  -->
        <div id="header_options">
            OPTIONS
        </div>
    </div>

    <!-- MIDDLE -->
    <div class="header-section" style="width: 100%"></div> 

     <!-- RIGHT  -->
     <div class="header-section">
        <!-- MONEY -->
        <a id="header_money" class="header-icon fa-solid fa-money-bill" href="" target="blank">
            <div>
                <span>
                    $money_amount
                </span>
            </div>
        </a>

        <!-- CART -->
        <a id="header_cart" class="header-icon fa-solid fa-cart-shopping" href="" target="blank">
            <span>$cart_amount</span>
        </a>
        
        <!-- PROFILE -->
        <a id="header_profile" class="header-icon fa-solid fa-user" href="" target="blank"></a>
     </div>
    
    <!-- <div class="header_section" id="header_left">
        <div id="header_logo" style="background-image: url('images/logo.png')">
            
        </div>
        
        <div id="header_options">
            <span>OPTIONS</span>
        </div>
    </div>
    <div class="header_section" id="header_right">
        <div><span>MONEY</span></div>
        <div><span>CART</span></div>
        <div><span>PROFILE</span></div>
    </div> -->
    <!-- <div style='background-image: url("images/logo.png")'> -->
    <!-- <img src="images/logo.png" alt="Image of the logo"/> -->
HTML;