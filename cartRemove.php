<?php
require_once("php/cartItem.php");
require_once("php/phpUtilities.php");
require_once("php/joueurs.php");

require_once ("php/sessionManager.php");
userAccess();

$idJoueur = unserialize($_SESSION['joueur'])->Id;
$idItem = $_GET['id'];
$quantite = $_GET['quantity'];
isset_default($quantite, 1);

callProcedure("enleverPanier", $idJoueur, $idItem, $quantite);

redirect("cart.php");