<?php
// PDO
require_once "../php/model/quest.php";
require_once "../php/model/answer.php";
require_once "../php/html/questHTML.php";
require_once "../php/pdo/pdo_utilities.php";

// Session
require_once "../php/session_manager.php";
userAccess();

isset_default($condition);
if (isset($_GET["diff"])){
    $condition .= equals(Quest::DIFFICULTY, $_GET["diff"]);
}

$quest = Quest::selectComplete($condition, "ORDER BY RAND() LIMIT 1");

echo quest($quest);