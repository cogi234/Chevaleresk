<?php
require_once "../php/php_utilities.php";
require_once "../php/pdo/pdo_utilities.php";
require_once "../php/model/player.php";
require_once "../php/session_manager.php";

userAccess();

isset_default($_POST["id"], -1);
$userId = intval($_POST["id"]);

if(!Player::getLocalPlayer()->IsAdmin && $userId != Player::getLocalPlayer()->Id)
    redirect("forbidden");

$user = Player::selectComplete(equals(Player::ID, $userId));

if (is_bool($user))
    redirect("../modifyProfilForm.php");

if (isset($_POST["nom"]))
    $user->LastName = $_POST["nom"];

if (isset($_POST["prenom"]))
    $user->FirstName = $_POST["prenom"];

if (isset($_FILES["avatar"]) && str_contains($_FILES["avatar"]["type"], "image"))
    $user->setAvatar($_FILES["avatar"]["tmp_name"], "../");

if (isset($_POST["alias"]))
    $user->Alias = $_POST["alias"];

if (isset($_POST["password"]) && !ctype_space($_POST["password"]))
    $user->Password = $_POST["password"];

$user->update();

$id = $user->Id;
redirect("../details.php?type=player&id=$id");
