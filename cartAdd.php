<?php
require_once("php/cartItem.php");
require_once("php/phpUtilities");

$idJoueur = unserialize($_SESSION['joueur'])->Id;
$idItem = $_GET['id'];
$quantite = $_GET['quantity'];
isset_default($quantite, 1);

callProcedure("ajouterPanier", $idJoueur, $idItem, $quantite);

header('Location: cart.php', true, 303);
die();