<?php

require_once "php/phpUtilities.php";
require_once "php/pdo_object.php";

class Item extends PDO_Object
{
    protected const TABLE = "items";

    public const ID = "idItem";
    #[PDO_Object_Id(Item::ID)]
    public int $Id = -1;

    public const NAME = "nom";
    #[PDO_Object_Id(Item::NAME)]
    public string $Nom = "";

    public const DESCRIPTION = "description";
    #[PDO_Object_Id(Item::DESCRIPTION)]
    public string $Description = "";

    public const PRICE = "prix";
    #[PDO_Object_Id(Item::PRICE)]
    public int $Prix = 0;

    public const QUANTITY = "quantiteStock";
    #[PDO_Object_Id(Item::QUANTITY)]
    public int $Quantite = -1;

    public const TYPE = "type";
    #[PDO_Object_Id(Item::TYPE)]
    public string $Type = "";

    public const SELLABLE = "vendable";
    #[PDO_Object_Id(Item::SELLABLE)]
    public bool $Vendable = false;

    public const IMAGE = "image";
    #[PDO_Object_Id(Item::IMAGE)]
    public string $Image = "";

    public function getIcon(): string
    {
        switch ($this->Type) {
            case "armure":
                return "shield.svg";
            case "potion":
                return "potion.svg";
            case "ingredient":
                return "plant.svg";
            case "arme":
            default:
                return "nuh uh.svg";
        }
    }
}