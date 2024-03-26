<?php
require_once("php/pdo.php");

if(!(isset($_GET['item']))){
    //throw forbidden
}

$idJoueur = 1;

$Item = (int)$_GET['item'];
callProcedure("ajouterPanier", $idJoueur, $Item, 1);

header('Location: cart.php', true, 303);
die();