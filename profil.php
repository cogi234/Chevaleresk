<?php

// Utilities
require_once "php/php_utilities.php";
require_once "php/pdo/pdo_utilities.php";

// PDO
require_once "php/model/player.php";

// HTML
require_once "php/html/inventoryHTML.php";

// Session
require_once "php/session_manager.php";
userAccess();

$page_title = "Profil";

$idPlayer = Player::getLocalPlayer()->Id;
$player = Player::selectComplete(equals(Player::ID, $idPlayer));

$player_alias = $player->Alias;
$player_lastName = $player->LastName;
$player_firstName = $player->FirstName;
$player_avatar = $player->getAvatar();
$player_balance = $player->Balance;
$player_alchemy = $player->AlchemyLevel;
$player_questSuccess = $player->QuestSuccessNumber;
$player_questFailed = $player->QuestFailureNumber;
$player_alchemyQuest = $player->AlchemyQuestNumber;
$player_potion = $player->PotionMadeNumber;
$player_EcuGain = $player->EcuObtainedNumber;
$player_EcuSpent = $player->EcuSpentNumber;



$body_content = <<<HTML

    <div>
    $player_alias
    $player_lastName
    $player_firstName 
    <img id="profilePic"  src='$player_avatar' title="C'est vous!"/>
    $player_balance 
    $player_alchemy 
    $player_questSuccess 
    $player_questFailed 
    $player_alchemyQuest
    $player_potion 
    $player_EcuGain 
    $player_EcuSpent 
    </div>

HTML;







require "views/master.php";