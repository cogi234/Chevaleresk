<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";

class Quest extends PDO_Object{
    protected const TABLE = "";

    public const ID = "idEnigme";
    #[PDO_Object_Id(Quest::ID)]
    public int $Id = -1;

    public const TITLE = "titre";
    #[PDO_Object_Id(Quest::TITLE)]
    public string $Title = "";

    public const DESCRIPTION = "question";
    #[PDO_Object_Id(Quest::DESCRIPTION)]
    public string $Description = "";

    public const DIFFICULTY = "difficulte";
    #[PDO_Object_Id(Quest::DIFFICULTY)]
    public int $Difficulty = -1;

    public const ALCHEMY = "alchimie";
    #[PDO_Object_Id(Quest::ALCHEMY)]
    public int $Alchemy = -1;
}