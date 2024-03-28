<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/php_utilities.php");
require_path("php/model/pdo_object.php");

class Item extends PDO_Object
{
    #region PDO_Object

    protected const TABLE = "items";

    #endregion

    #region Constants

    const PATH_IMAGES = "images/items/images/";
    const PATH_ICONS = "images/items/icons/";

    public const TYPES = [
        "arme",
        "armure",
        "ingredient",
        "potion",
    ];

    #endregion

    #region Properties

    public const ID = "idItem";
    #[PDO_Object_Id(Item::ID)]
    public int $Id = -1;

    public const NAME = "nom";
    #[PDO_Object_Id(Item::NAME)]
    public string $Name = "";

    public const DESCRIPTION = "description";
    #[PDO_Object_Id(Item::DESCRIPTION)]
    public string $Description = "";

    public const PRICE = "prix";
    #[PDO_Object_Id(Item::PRICE)]
    public int $Price = 0;

    public const QUANTITY = "quantiteStock";
    #[PDO_Object_Id(Item::QUANTITY)]
    public int $Quantity = -1;

    public const TYPE = "type";
    #[PDO_Object_Id(Item::TYPE)]
    public string $Type = "";

    public const SELLABLE = "vendable";
    #[PDO_Object_Id(Item::SELLABLE)]
    public bool $Sellable = false;

    public const IMAGE = "image";
    #[PDO_Object_Id(Item::IMAGE)]
    public string $Image = "";

    #endregion

    #region Functions 

    public function getIcon(): string
    {
        $icon = "missing-icon";
        switch ($this->Type) {
            case "armure":
                $icon = "shield.svg";
                break;
            case "potion":
                $icon = "potion.svg";
                break;
            case "ingredient":
                $icon = "plant.svg";
                break;
            case "arme":
                $icon = "gun.svg";
                break;
            default:
                $icon = "nuh-uh.svg";
                break;
        }

        return Item::PATH_ICONS . $icon;
    }

    public function getImage(): string
    {
        return Item::PATH_IMAGES . $this->Image;
    }

    #endregion
}