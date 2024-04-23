<?php
require_once "../model/cart_item.php";
require_once "../model/player.php";

if (isset($_GET['forceRefresh']) && $_GET['forceRefresh'] == true)
    Player::refreshLocalPlayer();

$player = Player::getLocalPlayer();

if (is_bool($player))
    exit();

$money_amount = $player->Balance;

echo "<div><span>$money_amount</span></div>";