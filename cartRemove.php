<?php
require_once("php/cartItem.php");

$idItem = $_GET['id'];

//remove item

header('Location: cart.php', true, 303);
die();