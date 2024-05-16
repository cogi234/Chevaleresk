<?php
require_once 'php/pdo/pdo.php';
require_once "php/model/player.php";
require_once "php/pdo/pdo_utilities.php";

require_once 'php/session_manager.php';


// Title
$page_title = "Inscription";
isset_default($styles_view);
$styles_view .= "<link rel='stylesheet' href='css/form_styles.css'>";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = false;
    $inscription = $_POST['alias'];
    $_SESSION['exists'] = false;
    $_SESSION['different'] = false;
    $_SESSION['long'] = false;
    isset_default($_POST['Password']);
    $pword = $_POST['Password'];
    
    
    $playerList = Player::selectAll(
        [Player::ALIAS],
        equals(Player::ALIAS, $inscription)
    );

    foreach ($playerList as $player) {
        if (isset($_POST['alias']) && $_POST["alias"] == $player->Alias ) {
            $_SESSION['exists'] = true;
            $bool = true;
        }
        
    }
    if (isset($_POST['matchedPassword']) && $pword != $_POST["matchedPassword"])
    {
        $_SESSION['different'] = true;
        $bool = true;
    }
    if(strlen($pword) < 6)
    {
        $_SESSION['long'] = true;
        $bool = true;
    }
    if ($bool == false && isset($_POST['Password']) && isset($_POST['alias'])) {
        callProcedure("inscription", $_POST['alias'], $_POST['Password'], 0);
        redirect('index.php');
    }
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
                        value= "{$_POST['alias']}"
                        placeholder="Identifiant" 
                        required 
                        RequireMessage = 'Veuillez entrer votre Identifiant'
                        InvalidMessage = 'Identifiant invalide'
                        CustomErrorMessage ="Cet identifiant est déjà utilisé"/>
            </fieldset>
HTML;
    if ( isset($_SESSION['exists']) && $_SESSION['exists'] == true) {
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

        if (isset($_SESSION['different']) && $_SESSION['different'] == true) {
            $body_content .= <<<HTML
            <div class="error-message">
                <span >Mot de passe de vérification différent</span>
            </div>
HTML;
        }
        if (isset($_SESSION['long']) && $_SESSION['long'] == true) {
            $body_content .= <<<HTML
            <div class="error-message">
                <span >Mot de passe trop court <br> Il doit être au moins 6 caractère de long</span>
            </div>
HTML;
        }
    $body_content .= <<<HTML
            <input type='submit' name='submit' id='saveUser' value="Enregistrer" class="form-control btn-primary confirm-btn">
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary cancel-btn" style="text-align:center" href="index.php">
                Annuler
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

            <input type='submit' name='submit' id='saveUser' value="Enregistrer" class="form-control btn-primary confirm-btn">
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary cancel-btn" style="text-align:center" href="index.php">
                Annuler
            </a>
        </div>
    </div>
HTML;
}

$viewScript = <<<HTML
    <script src='js/validation.js'></script>
    <script defer>
        initFormValidation();
        addConflictValidation('testConflict.php', 'Email', 'saveUser' );
    </script>
HTML;

require "views/master.php";