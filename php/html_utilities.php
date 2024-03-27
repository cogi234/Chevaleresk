<?php

require_once "php/phpUtilities.php";
include_once "php/guid.php";

const DROPDOWN_TAG_URL = "url";
const DROPDOWN_TAG_TEXT = "text";

/**
 * Creates a dropdown with the given name and the given items
 * @author @WarperSan
 * Date of creation    : 2024/03/11
 * Date of modification: 2024/03/12
 */
function dropdown(string $name, array $items = [], string $buttonClass = ""): string
{
    $itemsHTML = "";
    $guid = function_exists("GUIDv4") ? GUIDv4() : com_create_guid();

    foreach ($items as $key => $value) {
        isset_default($value[DROPDOWN_TAG_URL], "#");
        isset_default($value[DROPDOWN_TAG_TEXT], "");

        $url = $value[DROPDOWN_TAG_URL];
        $text = $value[DROPDOWN_TAG_TEXT];

        $itemsHTML .= <<<HTML
            <a href="$url">$text</a>
        HTML;
    }

    return <<<HTML
        <div class="dropdown">
            <button onclick="dropdownClicked('$guid')" class="dropdown-button $buttonClass">$name</button>
            <div id="$guid" class="dropdown-content">
                $itemsHTML
            </div>
        </div>
    HTML;
}

/**
 * Creates a single item for a dropdown
 * @author @WarperSan
 * Date of creation    : 2024/03/11
 * Date of modification: 2024/03/11
 */
function dropdown_item(string $text, string $url = null): array
{
    return [
        DROPDOWN_TAG_URL => $url,
        DROPDOWN_TAG_TEXT => $text
    ];
}

const FaviconGoogleServiceURL = "http://www.google.com/s2/favicons?sz=64&domain=";
function SiteFavicon($url)
{
    $faviconUrl = self::FaviconGoogleServiceURL . $url;
    return "<img class='favicon' src='$faviconUrl'>";
}