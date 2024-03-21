<?php
require_once("php/pdo.php");

$idJoueur = 1;

$Item = (int)$_GET['item'];
$Quantite = (int)$_GET['quantite'];
callProcedure("enleverPanier", $idJoueur, $Item, $Quantite);

header('Location: cart.php', true, 303);
die();