<?php
require_once "php/php_utilities.php";

// Styles
isset_default($styles_view);
$styles_view .= '<link rel="stylesheet" href="css/player_list_styles.css">';

/**
 * Creates the visual for an item in the inventory
 * @author Colin Bougie
 * Date of creation    : 2024/03/19
 * Date of modification: 2024/03/19
 */
function player_entry(
    int $player_id,
    string $alias,
    string $full_name,
    string $avatar,
    bool $highlighted = false
): string {
    $url = "details.php?type=player&id=$player_id";

    $display_name = $alias;
    if (strlen($full_name) > 0){
        $display_name .= " | $full_name";
    }

    isset_default($highlight_class);
    if ($highlighted){
        $highlight_class = "highlighted";
    }

    return <<<HTML
        <a class="list-player-item $highlight_class" href="$url" title="Voir les détails de $alias">
            <!-- IMAGE -->
            <img class="player-avatar" src='$avatar' title="$alias">
            <!-- NAME -->
            <div class="player-name">
                $display_name
            </div>
        </a>
    HTML;
}