<?php

// Scripts
isset_default($scripts_view);
$scripts_view .= "<script src='js/toggle_sort.js'></script>";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/filter_styles.css">';

function filter_render(string $content): string
{
    if (strlen(trim($content)) == 0)
        return "";

    return <<<HTML
        <!-- FILTERS -->
        <div id="filter">
            <button id="filter-button"></button>
            <div>
                $content
            </div>
        </div>
    HTML;
}