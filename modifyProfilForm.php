<?php

require_once 'php/pdo/pdo.php';
require_once "php/model/player.php";
require_once "php/pdo/pdo_utilities.php";

require_once 'php/session_manager.php';


// Title
$page_title = "Modification";
isset_default($styles_view);
$styles_view .= "<link rel='stylesheet' href='css/form_styles.css'>";

isset_default($_POST["id"], -1);
$id = intval($_POST["id"]);

if(!Player::getLocalPlayer()->IsAdmin && $id != Player::getLocalPlayer()->Id)
        redirect("forbidden");

$user = Player::selectComplete(equals(Player::ID, $id));

$body_content = <<<HTML
        <div class="">
        <br>
        <form method='post' action='operations/updateUser.php' enctype="multipart/form-data">
        <fieldset>
        <input  type="text" 
                class="form-control identifier" 
                name="alias" 
                id="alias"
                value= "$user->Alias"
                placeholder="Identifiant"  
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
        name="password" 
        id="password"
        value= ""
        placeholder="Mot de passe" 
        InvalidMessage = 'Mot de passe trop court'/>

<input  class="form-control MatchedInput verification" 
        type="password" 
        matchedInputId="password"
        name="matchedPassword" 
        id="matchedPassword" 
        placeholder="Vérification" 
        InvalidMessage="Ne correspond pas au mot de passe" />
<label class="label-avatar" for="avatar">Choisir votre avatar</label>
<input  type="file" 
        class="form-control avatar" 
        name="avatar" 
        id="avatar"
        value= ""
        placeholder="Choisir votre avatar"
        title="Choisir votre avatar"
        accept="image/png, image/jpeg" />
<input  type="text" 
        class="form-control identifier" 
        name="prenom" 
        id="prenom"
        value= "$user->FirstName"
        placeholder="Prenom"/>
<input  type="text" 
        class="form-control identifier" 
        name="nom" 
        id="nom"
        value= "$user->LastName"
        placeholder="Nom"/>
<input type="hidden" name="id" value="$id"/>
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
HTML;


$viewScript = <<<HTML
    <script src='js/validation.js'></script>
    <script defer>
        initFormValidation();
        //addConflictValidation('testConflict.php', 'Email', 'saveUser' );
    </script>
HTML;

require "views/master.php";