<?php
require_once "../php/php_utilities.php";
require_once "../php/pdo/pdo_utilities.php";

if(isset($_POST["alias"])&&isset($_POST["Password"])&&isset($_POST["id"])){
    $user = Player::getLocalPlayer();
    $nom = $user->LastName;
    $prenom = $user->FirstName;
    $avatar = $user->Avatar;
    $isAdmin = $user->IsAdmin;

    if(isset($_POST["nom"]))
        $nom = $_POST["nom"];
    if(isset($_POST["prenom"]))
        $prenom = $_POST["prenom"];
    if(isset($_POST["avatar"]))
        copy($_POST['avatar'], "../images/pfp/$user->Id.png");
        $avatar = "../images/pfp/$user->Id.png";
    $alias = $_POST["alias"];
    $password = $_POST["password"];
    $id = $_POST["id"];

    callProcedure("PROC_NAME", "ARGS");

    redirect("../details.php?type=player&id=$id");
}