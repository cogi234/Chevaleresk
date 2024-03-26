<?php
require_once("php/pdo.php");

require_once ("php/sessionManager.php");
userAccess();


if(!(isset($_GET['item']) && isset($_GET['quantite']))){
    //throw forbidden
}

$idJoueur = 1;

$Item = (int)$_GET['item'];
$Quantite = (int)$_GET['quantite'];
callProcedure("enleverPanier", $idJoueur, $Item, $Quantite);

redirect("cart.php");