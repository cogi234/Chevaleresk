<?php

use LDAP\Result;

require_once "../php/php_utilities.php";
require_once "../php/model/answer.php";
require_once "../php/pdo/pdo_utilities.php";
require_once "../php/html/questHTML.php";

isset_default($id);

if($_POST["id"]){
    $id = $_POST["id"];
    isset_default($condition);
    $condition .= equals(Answer::ID, $id);
    $answer = Answer::select([Answer::CORRECT], $condition);
    echo Result($answer->Respond()[0][0] == 1);
}

