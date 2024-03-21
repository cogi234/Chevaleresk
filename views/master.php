<?php

const DEFAULT_PAGE_NAME = "Chevaleresk";
const BUNDLE_PATH_STYLES = "bundles/stylesBundle.html";
const BUNDLE_PATH_SCRIPTS = "bundles/scriptsBundle.html";

include_once "views/header.php";
require_once "php/phpUtilities.php";

// Name of the page
isset_default($page_title, DEFAULT_PAGE_NAME);

// Header
isset_default($header_content);

// Body
isset_default($body_content);

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
            <title>$page_title</title>
            
            $styles_bundle
            $styles_view
        </header>

        <body>
            <div id="main">
                <div id="header">$header_content</div>
                <div id="body">$body_content</div>
            </div>
            
            $scripts_bundle
            $scripts_view
        </body>
    </html>
HTML;