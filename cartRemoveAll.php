<?php
require_once("php/pdo.php");

require_once ("php/sessionManager.php");
userAccess();

$idJoueur = 1;

callProcedure("viderPanier", $idJoueur);

redirect("cart.php");