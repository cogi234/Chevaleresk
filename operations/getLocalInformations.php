<?php

// PDO
require_once "../php/model/player.php";

$name = Player::getLocalPlayer()->getFullname();
$player_id = Player::getLocalPlayer()->Id;

echo json_encode(<<<HTML
    <a id="header_disconnect" class="header-icon fa-solid fa-arrow-right-from-bracket" href="operations/disconnect.php" title="Se déconnecter"></a>
    <a id="header_profile_access" class="header-icon fa-solid fa-user" href="details.php?type=player&id=$player_id" title="profil"></a>
    <span>Bonjour, $name!</span>
HTML);