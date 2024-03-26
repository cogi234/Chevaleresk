<?php
require_once("php/cartItem.php");
require_once("php/phpUtilities.php");
require_once("php/joueurs.php");
require_once ("php/sessionManager.php");
userAccess();

$idJoueur = unserialize($_SESSION['joueur'])->Id;

callProcedure("viderPanier", $idJoueur);

redirect("cart.php");