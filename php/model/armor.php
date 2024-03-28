<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/item.php";

class Armor extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "armures";
    #endregion

    #region Constants
    public const SIZES = [
        "petit",
        "moyen",
        "grand",
    ];
    #endregion

    #region Properties
    public const ID = "idItem";
    #[PDO_Object_Id(Armor::ID)]
    public int $Id = -1;
    
    public const MATERIAL = "materiel";
    #[PDO_Object_Id(Armor::MATERIAL)]
    public string $Material = "";
    
    public const SIZE = "taille";
    #[PDO_Object_Id(Armor::SIZE)]
    public string $Size = "";
    #endregion
}