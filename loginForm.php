<?php
require_once 'php/sessionManager.php';
require_once 'php/pdo.php';
require_once "php/joueurs.php";

anonymousAccess();

if (isset ($_POST['alias'])) {
    $body_content = <<<HTML

    <div class="">
        <br>
        <form method='post' action=''>
        <fieldset>
                <legend>Identifiant de connexion</legend>
                <input  type="text" 
                        class="form-control" 
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
                <legend>Mot de passe</legend>
                <input  type="password" 
                        class="form-control" 
                        name="Password" 
                        id="Password"
                        value= ""
                        placeholder="Mot de passe" 
                        RequireMessage = 'Veuillez entrer un mot de passe'
                        />
            <input type='submit' name='submit' id='saveUser' value="Enregistrer" class="form-control btn-primary">
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary" style="text-align:center" href="index.php">
                Annuler
            </a>
        </div>
        
    </div>
    HTML;

    if (isset ($_SESSION['error']) && $_SESSION['error'] == true) {
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
                <legend>Identifiant de connexion</legend>
                <input  type="text" 
                        class="form-control" 
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
                <legend>Mot de passe</legend>
                <input  type="password" 
                        class="form-control" 
                        name="Password" 
                        id="Password"
                        value= ""
                        placeholder="Mot de passe" 
                        RequireMessage = 'Veuillez entrer un mot de passe'
                        />
            <input type='submit' name='submit' id='saveUser' value="Enregistrer" class="form-control btn-primary">
        </form>
        <div class="cancel">
            <a class="form-control btn-secondary" style="text-align:center" href="index.php">
                Annuler
            </a>
        </div>
        
    </div>
    HTML;
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bool = false;
    $connectionName = $_POST['alias'];
    $connectionPword = $_POST['Password'];

    $bool = intval(callFunction('connect', $connectionName, $connectionPword)[0][0]);

    if ($bool != 0) {
        updateJoueur($connectionName);
        $_SESSION['connected'] = true;


        redirect('index.php');
    }



    $_SESSION['error'] = true;


}
require "views/master.php";