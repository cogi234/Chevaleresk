<?php
require_once 'php/pdo/pdo.php';
require_once "php/model/player.php";

require_once 'php/session_manager.php';
anonymousAccess();

isset_default($styles_view);
$styles_view .= "<link rel='stylesheet' href='css/form_styles.css'>";

// Title
$page_title = "Connexion";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = false;
    $connectionName = $_POST['alias'];
    $connectionPword = $_POST['Password'];

    $bool = intval(callFunction('connect', $connectionName, $connectionPword)[0][0]);

    if ($bool != 0) {
        Player::refreshLocalPlayer($connectionName);
        $_SESSION['connected'] = true;

        redirect('index.php');
    }

    $_SESSION['error'] = true;
}

if (isset($_POST['alias'])) {
    $body_content = <<<HTML
    <div class="">
        <br>
        <form method='post' action=''>
        <fieldset>
                
                <input  type="text" 
                        class="form-control identifier" 
                        name="alias" 
                        id="alias"
                        value= '{$_POST["alias"]}'
                        placeholder="Identifiant" 
                        required 
                        RequireMessage = 'Veuillez entrer votre Identifiant'
                        InvalidMessage = 'Identifiant invalide'
                        CustomErrorMessage ="Cet identifiant est déjà utilisé"/>
            </fieldset>
            <fieldset>
                
                <input  type="password" 
                        class="form-control password" 
                        name="Password" 
                        id="Password"
                        value= ""
                        placeholder="Mot de passe" 
                        RequireMessage = 'Veuillez entrer un mot de passe'
                        />
                <button type='submit' name='submit' id='saveUser' class="form-control btn-primary confirm-btn"><p>Enregistrer</p></button>
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary cancel-btn" href="index.php">
                <p>
                    Annuler
                </p>
            </a>
        </div>
        
    </div>
    HTML;

    if (isset($_SESSION['error']) && $_SESSION['error'] == true) {
        $body_content .= <<<HTML
        <div class="error-message">
            <span >Erreur dans la connexion</span>
        </div>
        HTML;
    }
} else {
    $body_content = <<<HTML
    <div class="">
        <br>
        <form method='post' action=''>
        <fieldset>
                
                <input  type="text" 
                        class="form-control identifier" 
                        name="alias" 
                        id="alias"
                        value= ""
                        placeholder="Identifiant" 
                        required 
                        RequireMessage = 'Veuillez entrer votre Identifiant'
                        InvalidMessage = 'Identifiant invalide'
                        CustomErrorMessage ="Cet identifiant est déjà utilisé"/>
            </fieldset>
            <fieldset>
                
                <input  type="password" 
                        class="form-control password" 
                        name="Password" 
                        id="Password"
                        value= ""
                        placeholder="Mot de passe" 
                        RequireMessage = 'Veuillez entrer un mot de passe'
                        />
                <button type='submit' name='submit' id='saveUser' class="form-control btn-primary confirm-btn"><p>Enregistrer</p></button>
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary cancel-btn" href="index.php">
                <p>
                    Annuler
                </p>
            </a>
        </div>
        
    </div>
    HTML;
}



require "views/master.php";