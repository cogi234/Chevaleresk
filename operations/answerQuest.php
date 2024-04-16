<?php

require_once "../php/php_utilities.php";
require_once "../php/model/answer.php";
require_once "../php/pdo/pdo_utilities.php";
require_once "../php/html/questHTML.php";

isset_default($id);

if(isset($_POST["id"])){
    $id = $_POST["id"];
    isset_default($conditionAnswer);
    isset_default($conditionQuest);
    $conditionAnswer .= equals(Answer::ID, $id);
    $answer = Answer::selectComplete($conditionAnswer);
    $conditionQuest .= equals(Quest::ID, $answer->IdEnigma);
    $quest = Quest::selectComplete($conditionQuest);
    echo Result($answer->Respond(), $quest);
}

