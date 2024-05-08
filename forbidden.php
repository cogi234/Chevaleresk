<?php

// Title
$page_title = "Erreur 404";

// Body
$body_content = <<<HTML
    <span style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-size: 2.5em;">
        Ressource non trouvée
    </span>
HTML;

require "views/master.php";