<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/php_utilities.php");
require_path("php/model/pdo_object.php");
require_path("php/model/player.php");

class Answer extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "reponses";
    #endregion

    #region Properties
    public const ID = "idReponse";
    #[PDO_Object_Id(Answer::ID)]
    public int $Id = -1;
    
    public const TEXT = "texte";
    #[PDO_Object_Id(Answer::TEXT)]
    public string $Text = "";

    public const CORRECT = "correct";
    #[PDO_Object_Id(Answer::CORRECT)]
    public bool $Correct = false;
    
    public const IDENIGMA = "idEnigme";
    #[PDO_Object_Id(Answer::IDENIGMA)]
    public int $IdEnigma = -1;
    #endregion

    #region Functions
    /**
     * Respond to a question of an answer, give money to the player and returns a boolean if its correct or not
     * @author @Akuma
     * Date of creation    : 2024/04/12
     * Date of modification: 2024/04/12
     */
    public function Respond(){
        return callFunction("respond", $this->Id, Player::getLocalPlayer()->Id);
    }
    #endregion
}