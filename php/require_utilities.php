<?php

// 
// Every file that is related to an AJAX request needs to use require like this:
// require_once dirname(__FILE__, X) . "/require_utilities.php";
// require_path("php/...");
//
// The X is the number of level the file is from the folder php

function require_path(string $path): void
{
    require_once dirname(__FILE__, 2) . "/" . $path;
}