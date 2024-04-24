<?php

const DEFAULT_PAGE_NAME = "Chevaleresk";
const BUNDLE_PATH_STYLES = "bundles/stylesBundle.html";
const BUNDLE_PATH_SCRIPTS = "bundles/scriptsBundle.html";

require_once "php/php_utilities.php";

// Name of the page
$page_name = DEFAULT_PAGE_NAME;

if (isset($page_title))
    $page_name .= " - " . $page_title;

include_once "views/header.php";
include_once "views/footer.php";

// Header
isset_default($header_content);

// Body
isset_default($body_content);

// Footer
isset_default($footer_content);

// Bundles
$styles_bundle = getContentOrDefault(BUNDLE_PATH_STYLES);
$scripts_bundle = getContentOrDefault(BUNDLE_PATH_SCRIPTS);

// Views
isset_default($styles_view);
isset_default($scripts_view);

// Print
echo <<<HTML
    <!DOCTYPE html>
    <html>
        <header>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$page_name</title>
            
            $styles_bundle
            $styles_view
        </header>

        <body>
            <div id="main">
                <div id="header">$header_content</div>
                <div id="body">$body_content</div>
                <div id="body-fade"></div>
            </div>
            
            $scripts_bundle
            $scripts_view
        </body>
    </html>
HTML;