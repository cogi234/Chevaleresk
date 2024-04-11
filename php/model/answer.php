<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/php_utilities.php");
require_path("php/model/pdo_object.php");

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
}