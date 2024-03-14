<?php
try 
{
    $mybd = new PDO('mysql:host=167.114.152.54;dbname=dbchevaleresk9;charset=utf8', 'chevalier9',
    's748jcs2');
}
catch (PDOException $e)
{
    echo("Erreur de connexion". $e->getMessage());
}
