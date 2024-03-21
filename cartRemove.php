<?php
require_once("php/cartItem.php");
require("php/pdo.php");

$idJoueur = 1;

//$Item = $_GET['item'];
//callProcedure("viderPanier", $idJoueur);

header('Location: cart.php', true, 303);
die();