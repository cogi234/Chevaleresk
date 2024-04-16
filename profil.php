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

isset_default($styles_view);
$styles_view .= "<link rel='stylesheet' href='css/profile_styles.css'>";

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

if ($player_alchemy <1)
{
    $textAlchemist = "Pas alchimiste. Devenez alchimiste en effectuant des quêtes d'alchimie dans Enigma.";
}

switch ($player_alchemy) {
    case 1:
        $textAlchemist = "Alchimiste débutant";
        $statsAlchemist = <<<HTML
        <p>Nombre de quêtes d'alchimie réussies : $player_alchemyQuest</p>
        <p>Nombre de potions créés : $player_potion </p>
        HTML;
        break;
    case 2:
        $textAlchemist = "Alchimiste intermédiaire";
        $statsAlchemist = <<<HTML
        <p>Nombre de quêtes d'alchimie réussies : $player_alchemyQuest</p>
        <p>Nombre de potions créés : $player_potion </p>
        HTML;
        break;
    case 3 :
        $textAlchemist = "Alchimiste avancé";
        $statsAlchemist = <<<HTML
        <p>Nombre de quêtes d'alchimie réussies : $player_alchemyQuest</p>
        <p>Nombre de potions créés : $player_potion </p>
        HTML;
        break;
    
    default:
        $textAlchemist = "Vous n'êtes pas alchimiste. Devenez alchimiste en effectuant des quêtes d'alchimie dans Enigma.";
        $statsAlchemist ='';
        break;
}

$body_content = <<<HTML

    <div class='profile-container'>
        <div>
    <img class="header-icon" id="profile-pic"  src='$player_avatar' title="C'est vous!"/><br>
    <div id='profile-names'> 
        <p>$player_alias<br>
        $player_firstName $player_lastName
        </p>
    </div>
    
    </div>
    <div id='profile-details'>
        <div>
            <p>$player_balance écus</p>
            <p>$textAlchemist </p> 
        </div>
    <div> 
        <p>Nombre de quêtes réussies : $player_questSuccess</p> 
        <p>Nombre de quêtes ratés : $player_questFailed </p>
        $statsAlchemist
        <p>Nombre d'écus accumulés : $player_EcuGain </p>
        <p>Nombre d'écus dépensés :$player_EcuSpent </p>
    </div>
    
    </div>
</div>

HTML;







require "views/master.php";