<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/item.php";

class Weapon extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "armes";
    #endregion

    #region Properties
    public const ID = "idItem";
    #[PDO_Object_Id(Weapon::ID)]
    public int $Id = -1;
    
    public const EFFICACY = "efficacite";
    #[PDO_Object_Id(Weapon::EFFICACY)]
    public int $Efficacy = -1;
    
    public const TYPE = "type";
    #[PDO_Object_Id(Weapon::TYPE)]
    public string $Type = "";
    #endregion
}