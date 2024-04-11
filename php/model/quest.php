<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/php_utilities.php");
require_path("php/pdo/pdo_utilities.php");
require_path("php/model/pdo_object.php");
require_path("php/model/answer.php");

class Quest extends PDO_Object
{
    protected function on_create_self(array $data): void
    {
        $this->Answers = Answer::selectAllComplete(equals(Answer::IDENIGMA, $this->Id));
    }

    #region PDO_Object
    protected const TABLE = "enigmes";
    #endregion

    #region Properties
    public const ID = "idEnigme";
    #[PDO_Object_Id(Quest::ID)]
    public int $Id = -1;
    
    public const TITLE = "titre";
    #[PDO_Object_Id(Quest::TITLE)]
    public string $Title = "";
    
    public const QUESTION = "question";
    #[PDO_Object_Id(Quest::QUESTION)]
    public string $Question = "";

    public const ALCHEMY = "alchimie";
    #[PDO_Object_Id(Quest::ALCHEMY)]
    public bool $Alchemy = false;

    public array $Answers = [];
    #endregion
}