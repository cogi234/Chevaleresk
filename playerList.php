<?php
// Utilities
require_once "php/php_utilities.php";
require_once "php/pdo/pdo_utilities.php";
require_once "php/html/playerListHTML.php";

// PDO
require_once "php/model/player.php";

// Session
require_once "php/session_manager.php";

// Title
$page_title = "Liste des joueurs";

if (is_connected()) {
    $id_player = Player::getLocalPlayer()->Id;
} else {
    $id_player = -1;
}

// Players
$players = Player::selectAll([Player::ID, Player::ALIAS, Player::FIRST_NAME, Player::LAST_NAME, Player::AVATAR, Player::IS_ADMIN],
    unequals(Player::ID, $id_player),
    orderBy(Player::ALIAS));

isset_default($players_html);

if (is_connected()) {
    $local_player = Player::getLocalPlayer();
    
    $full_name = $local_player->getFullname();
    if ($full_name == $local_player->Alias){
        $full_name = "";
    }

    $players_html .= player_entry(
        $local_player->Id,
        $local_player->Alias,
        $full_name,
        $local_player->getAvatar(),
        true
    );
}

foreach ($players as $player) {
    $full_name = $player->getFullname();
    if ($full_name == $player->Alias){
        $full_name = "";
    }

    $players_html .= player_entry(
        $player->Id,
        $player->Alias,
        $full_name,
        $player->getAvatar()
    );
}

$body_content = <<<HTML
        <div class="players-list-holder">
            $players_html
        </div>
HTML;

require "views/master.php";