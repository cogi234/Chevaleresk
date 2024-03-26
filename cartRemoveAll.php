<?php
require_once("php/pdo.php");

$idJoueur = 1;

callProcedure("viderPanier", $idJoueur);

header("location: cart.php", true, 303);
die();