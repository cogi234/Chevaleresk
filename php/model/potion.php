<?php
require_once dirname(__FILE__, 2) . "/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");

// PDO
require_path("php/model/pdo_object.php");
require_path("php/model/item.php");

class Potion extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "potions";
    #endregion

    #region Constants
    public const TYPES = [
        "offense",
        "defense",
    ];
    #endregion

    #region Properties
    public const ID = "idItem";
    #[PDO_Object_Id(Potion::ID)]
    public int $Id = -1;

    public const TYPE = "type";
    #[PDO_Object_Id(Potion::TYPE)]
    public string $Type = "";

    public const EFFECT = "effet";
    #[PDO_Object_Id(Potion::EFFECT)]
    public string $Effect = "";

    public const DURATION = "duree";
    #[PDO_Object_Id(Potion::DURATION)]
    public int $Duration = -1;
    #endregion
}