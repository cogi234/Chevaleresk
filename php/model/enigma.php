<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/answer.php";

class Enigma extends PDO_Object
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
    #[PDO_Object_Id(Enigma::ID)]
    public int $Id = -1;
    
    public const TITLE = "titre";
    #[PDO_Object_Id(Enigma::MATERIAL)]
    public string $Title = "";
    
    public const QUESTION = "question";
    #[PDO_Object_Id(Enigma::SIZE)]
    public string $Question = "";

    public const ALCHEMY = "alchimie";
    #[PDO_Object_Id(Enigma::ALCHEMY)]
    public bool $Alchemy = false;

    public array $Answers = [];
    #endregion
}