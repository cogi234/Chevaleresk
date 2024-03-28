<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/item.php";

class Ingredient extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "ingredients";
    #endregion

    #region Properties
    public const ID = "idItem";
    #[PDO_Object_Id(Ingredient::ID)]
    public int $Id = -1;
    
    public const TYPE = "type";
    #[PDO_Object_Id(Ingredient::TYPE)]
    public string $Type = "";
    
    public const RARITY = "rarete";
    #[PDO_Object_Id(Ingredient::RARITY)]
    public int $Rarity = -1;
    
    public const DANGER = "danger";
    #[PDO_Object_Id(Ingredient::DANGER)]
    public int $Danger = -1;
    #endregion
}