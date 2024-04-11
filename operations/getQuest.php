<?php
// PDO
require_once "../php/model/quest.php";
require_once "../php/model/answer.php";

// Session
require_once "../php/session_manager.php";
userAccess();

$quest = Quest::selectComplete("", "ORDER BY RAND() LIMIT 1");

var_dump($quest);