<?php

require_once "php/php_utilities.php";
require_once "php/session_manager.php";

const TAG_TYPE = "type";
const TAG_ID = "id";

const PAGES_FOR_TYPE = [
    "item" => "php/html/itemsDetailHTML.php",
    null => null
];

// Detail Type
isset_default($_GET[TAG_TYPE], null);
if (!array_key_exists($_GET[TAG_TYPE], PAGES_FOR_TYPE))
    $_GET[TAG_TYPE] = null;

// Id
isset_default($_GET[TAG_ID], -1);

// Content
isset_default($details_content, null);
$page = PAGES_FOR_TYPE[$_GET[TAG_TYPE]];

if ($page == null)
    redirect("forbidden.php");

include $page;

$body_content = <<<HTML
    $details_content
HTML;

require "views/master.php";