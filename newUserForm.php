<?php
require_once 'php/pdo/pdo.php';
require_once "php/model/player.php";
require_once "php/pdo/pdo_utilities.php";

require_once 'php/session_manager.php';

anonymousAccess();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = false;
    $inscription = $_POST['alias'];
    $_SESSION['exists'] = false;
    $playerList = Player::selectAll(
        [Player::ALIAS],
        equals(Player::ALIAS, $inscription)
    );

    foreach ($playerList as $player) {
        if (isset($_POST['alias']) && $_POST["alias"] == $player->Alias && isset($_POST['Password'])) {
            $_SESSION['exists'] = true;
            $bool = true;
        }
        
        
    }
    if(isset($_POST['Password']) && isset($_POST['matchedPassword']) && $_POST['Password'] != $_POST['matchedPassword'])
    {
        $_SESSION['samePword'] = true;
        $bool = true;
    }
    else
    {
        $_SESSION['samePword'] = false;
    }
    if(isset($_POST['Password']) && isset($_POST['matchedPassword']) && strlen($_POST['Password']) < 6)
    {
        $_SESSION['lengthPword'] = true;
        $bool = true;
    }
    else
    {
        $_SESSION['lengthPword'] = false;
    }
    if ($bool == false && isset($_POST['Password']) && isset($_POST['alias']) && $_POST["alias"] != $player) {
        callProcedure("inscription", $_POST['alias'], $_POST['Password'], false);
        redirect('index.php');
    }
}







// Title
$page_title = "Inscription";

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
                        value= "{$_POST['alias']}"
                        placeholder="Identifiant" 
                        required 
                        RequireMessage = 'Veuillez entrer votre Identifiant'
                        InvalidMessage = 'Identifiant invalide'
                        CustomErrorMessage ="Cet identifiant est déjà utilisé"/>
            </fieldset>
    HTML;
    if (isset($_SESSION['exists']) &&$_SESSION['exists'] == true) {
        $body_content .= <<<HTML
        <div class="error-message">
            <span >Un joueur avec ce nom existe déjà</span>
        </div>
        HTML;
    }
    $body_content .= <<<HTML
    <fieldset>
                
                <input  type="password" 
                        class="form-control password" 
                        name="Password" 
                        id="Password"
                        value= ""
                        placeholder="Mot de passe" 
                        required 
                        RequireMessage = 'Veuillez entrer un mot de passe'
                        InvalidMessage = 'Mot de passe trop court'/>
    
                <input  class="form-control MatchedInput verification" 
                        type="password" 
                        matchedInputId="Password"
                        name="matchedPassword" 
                        id="matchedPassword" 
                        placeholder="Vérification" 
                        InvalidMessage="Ne correspond pas au mot de passe" />
    

    HTML;

    if (isset($_SESSION['samePword']) &&$_SESSION['samePword'] == true) {
        $body_content .= <<<HTML
        <div class="error-message">
            <span >Les mots de passes ne sont pas pareil</span>
        </div>
        HTML;
    }
    if (isset($_SESSION['lengthPword']) &&$_SESSION['lengthPword'] == true) {
        $body_content .= <<<HTML
        <div class="error-message">
            <span >Le mot de passe n'est pas assez long, <br> il doit être de 6 caractères ou plus</span>
        </div>
        HTML;
    }
    $body_content .= <<<HTML
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
                        InvalidMessage = 'Mot de passe trop court'/>

                <input  class="form-control MatchedInput verification" 
                        type="password" 
                        matchedInputId="Password"
                        name="matchedPassword" 
                        id="matchedPassword" 
                        placeholder="Vérification" 
                        InvalidMessage="Ne correspond pas au mot de passe" />

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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = false;
    $inscription = $_POST['alias'];
    $_SESSION['exists'] = false;
    $playerList = Player::selectAll(
        [Player::ALIAS],
        equals(Player::ALIAS, $inscription)
    );

    foreach ($playerList as $player) {
        if (isset($_POST['alias']) && $_POST["alias"] == $player->Alias && isset($_POST['Password'])) {
            $_SESSION['exists'] = true;
            $bool = true;
        }
        
        
    }
    if(isset($_POST['Password']) && isset($_POST['matchedPassword']) && $_POST['Password'] != $_POST['matchedPassword'])
    {
        $_SESSION['samePword'] = true;
        $bool = true;
    }
    else
    {
        $_SESSION['samePword'] = false;
    }
    if(isset($_POST['Password']) && isset($_POST['matchedPassword']) && strlen($_POST['Password']) < 6)
    {
        $_SESSION['lengthPword'] = true;
        $bool = true;
    }
    else
    {
        $_SESSION['lengthPword'] = false;
    }
    if ($bool == false && isset($_POST['Password']) && isset($_POST['alias']) && $_POST["alias"] != $player) {
        callProcedure("inscription", $_POST['alias'], $_POST['Password'], false);
        redirect('index.php');
    }
}

$viewScript = <<<HTML
    <script src='js/validation.js'></script>
    <script defer>
        initFormValidation();
        addConflictValidation('testConflict.php', 'Email', 'saveUser' );
    </script>
HTML;


isset_default($styles_view);
$styles_view .= "<link rel='stylesheet' href='css/form_styles.css'>";
require "views/master.php";