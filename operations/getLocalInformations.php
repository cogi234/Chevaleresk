<?php

// PDO
require_once "../php/model/player.php";

$name = Player::getLocalPlayer()->getFullname();

echo json_encode(<<<HTML
    <a id="header_disconnect" class="header-icon fa-solid fa-arrow-right-from-bracket" href="operations/disconnect.php" title="Se déconnecter"></a>
    <span>Bonjour, $name!</span>
HTML);