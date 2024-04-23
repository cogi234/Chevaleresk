<?php
require_once "../model/cart_item.php";
require_once "../model/player.php";

if (isset($_GET['forceRefresh']) && $_GET['forceRefresh'] == true)
    Player::refreshLocalPlayer();

$player = Player::getLocalPlayer();

if (is_bool($player))
    exit();

$cart_array = CartItem::selectAll(
    [CartItem::QUANTITY],
    equals(CartItem::ID_PLAYER, $player->Id)
);

$cart_amount = 0;
foreach ($cart_array as $cart_item) {
    $cart_amount += $cart_item->Quantity;
}

echo "<span>$cart_amount</span>";