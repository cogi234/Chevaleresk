<?php
require_once("php/cart_items.php");

require_once("php/sessionManager.php");
userAccess();

$idItem = $_GET['id'];

//remove item

redirect("cart.php");