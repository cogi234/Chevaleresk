<?php

// PDO
require_once "php/pdo.php";
require_once "php/items.php";

// UTILITIES
require_once "php/phpUtilities.php";
require_once "php/pdoUtilities.php";

// HTML
require_once "php/storeHTML.php";
require_once "php/filterHTML.php";

isset_default($scripts_view);
$scripts_view .= <<<HTML
<script defer>
    var c = 0;

    function fetch_items(isAdmin = false, pageIndex = 0) {
        c++;
        
        htmx.ajax('GET', 'php/store_items?isAdmin=' + isAdmin + "&page=" + pageIndex, '.store-item-holder');
    }

    const parent = $(".store-item-holder")[0];

    // Clear current items
    parent.innerHTML = '';

    // Add loader
    const loader = document.createElement("div");
    loader.classList.add("loader");

    parent.append(loader);

    // Fetch new items
    fetch_items();
</script>
HTML;

$is_admin = true;
$page_title = "Magasin";

// Filters
$filter_html = filter_render(<<<HTML
    <p>Filtres</p>
    <hr>
    <button onclick="fetch_items('<?php $is_admin ?>', c)">
        Click Me!
    </button>
HTML);

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

require "views/master.php";