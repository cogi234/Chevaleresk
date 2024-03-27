<?php

// PDO
require_once "php/pdo/pdo.php";
require_once "php/model/item.php";

// UTILITIES
require_once "php/php_utilities.php";
require_once "php/pdo/pdo_utilities.php";

// HTML
require_once "php/html/storeHTML.php";
require_once "php/html/filterHTML.php";

// Title
$page_title = "Magasin";

$page_index = 0;

// Filters
$types_html = "";

foreach (Item::TYPES as $key => $value) {
    $displayName = ucfirst($value);

    $types_html .= <<<HTML
        <input type="checkbox" id="$value" name="types[]" checked value="$value">
        <label for="$value"> $displayName</label><br>
    HTML;
}

$filter_html = filter_render(<<<HTML
<form 
    id="store-filter"
    hx-get='php/partial/store_items.php' 
    hx-target=".store-item-holder" 
    hx-swap="innerHTML" 
    hx-trigger="submit, load, change">

    <p>Filtres</p>
    <hr>

    <!-- TYPES -->
    $types_html

    <!-- SHOW OOS -->
    <!-- <input type="checkbox" id="oos" name="oos" checked>
    <label for="oos"> Montrer les items sans stock</label><br> -->
    <!-- <br>
    <input type="submit" value="Filtrer"> -->
</form>
HTML);

// Body
$body_content = <<<HTML
    $filter_html

    <div style="display: flex;">
        <!-- ITEMS -->
        <div id="store-item-parent">
            <div class="store-item-holder">
            </div>

            <!-- PAGES -->
            <div></div>
        </div>
    </div>
HTML;

// View Scripts
isset_default($scripts_view);
$scripts_view .= <<<HTML
    <script>
        function filterSubmit(event) {
            add_loader();
        }

        const form = document.getElementById("store-filter");
        form.addEventListener("htmx:beforeSend", filterSubmit);

        function add_loader() {
            const parent = $(".store-item-holder")[0];

            // Clear current items
            parent.innerHTML = '';

            // Add loader
            const loader = document.createElement("div");
            loader.classList.add("loader");

            parent.append(loader);
        }

        add_loader();
    </script>
HTML;

require "views/master.php";