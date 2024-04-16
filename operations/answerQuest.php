<?php

require_once "../php/php_utilities.php";
require_once "../php/model/answer.php";
require_once "../php/model/player.php";
require_once "../php/pdo/pdo_utilities.php";
require_once "../php/html/questHTML.php";

isset_default($id);

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $answer = Answer::selectComplete(equals(Answer::ID, $id));
    $quest = Quest::selectComplete(equals(Quest::ID, $answer->IdEnigma));

    $alchemy_level = Player::getLocalPlayer()->AlchemyLevel;
    $becameAlchemist = false;
    $result = $answer->Respond();
    Player::refreshLocalPlayer();
    if ($alchemy_level == 0 && Player::getLocalPlayer()->AlchemyLevel > 0){
        $becameAlchemist = true;
    }

    echo Result($result, $quest, $becameAlchemist);
} else {
    echo <<<HTML
        <p class="result-msg">Désolé! Il y a eu une erreur!...</p>
    HTML;
}