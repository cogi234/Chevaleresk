<?php
require 'php/sessionManager.php';
$viewTitle = "Création de compte";

anonymousAccess();


$viewContent = <<< HTML

<div class="">
    <br>
    <form method='post' action='newUser.php'>
    <fieldset>
            <legend>Identifiant de connexion</legend>
            <input  type="text" 
                    class="form-control" 
                    name="alias" 
                    id="alias"
                    placeholder="Identifiant" 
                    required 
                    RequireMessage = 'Veuillez entrer votre Identifiant'
                    InvalidMessage = 'Identifiant invalide'
                    CustomErrorMessage ="Cet identifiant est déjà utilisé"/>

            
        </fieldset>
        <fieldset>
            <legend>Mot de passe</legend>
            <input  type="password" 
                    class="form-control" 
                    name="Password" 
                    id="Password"
                    placeholder="Mot de passe" 
                    required 
                    RequireMessage = 'Veuillez entrer un mot de passe'
                    InvalidMessage = 'Mot de passe trop court'/>

            <input  class="form-control MatchedInput" 
                    type="password" 
                    matchedInputId="Password"
                    name="matchedPassword" 
                    id="matchedPassword" 
                    placeholder="Vérification" required
                    InvalidMessage="Ne correspond pas au mot de passe" />

        <input type='submit' name='submit' id='saveUser' value="Enregistrer" class="form-control btn-primary">
    </form>
    <div class="cancel">
        <a href="loginForm.php">
            <button class="form-control btn-secondary">Annuler</button>
        </a>
    </div>

</div>
HTML;
$viewScript = <<<HTML
    <script src='js/validation.js'></script>

    <script defer>
        initFormValidation();
        addConflictValidation('testConflict.php', 'Email', 'saveUser' );
    </script>
HTML;



require "views/master.php";