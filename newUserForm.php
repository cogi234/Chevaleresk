<?php
require_once 'php/pdo/pdo.php';
require_once "php/model/player.php";
require_once "php/pdo/pdo_utilities.php";

require_once 'php/session_manager.php';
anonymousAccess();

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
    
            <input type='submit' name='submit' id='saveUser' value="Enregistrer" class="form-control btn-primary confirm-btn">
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary cancel-btn" style="text-align:center" href="index.php">
                Annuler
            </a>
        </div>
        
    </div>
    HTML;
    if ($_SESSION['exists'] == true) {
        $body_content .= <<<HTML
        <div class="error-message">
            <span >Un joueur avec ce nom existe déjà</span>
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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = false;
    $inscription = $_POST['alias'];

    $playerList = Player::selectAll(
        [Player::ALIAS],
        equals(Player::ALIAS, $inscription)
    );

    foreach ($playerList as $player) {
        if (isset($_POST['alias']) && $_POST["alias"] == $player->alias && isset($_POST['Password'])) {
            $_SESSION['exists'] = true;
            $bool = true;
        }
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