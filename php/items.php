<?php

require_once "phpUtilities.php";
require_once "pdo_object.php";

class Item extends PDO_Object
{
    #region PDO_Object
https://github.com/cogi234/Chevaleresk/pull/23/conflict?name=php%252Fitems.php&ancestor_oid=4a0cf7fd89d4a23f387329af88a9ce04008cf211&base_oid=169597902d8753001d6ecd08e4ebb6e41011e7b5&head_oid=b405c19416d0a9f0ee1dff9250b7ca87e1f8fa59
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

    #endregion

    #region Functions 

    public function getIcon(): string
    {
        $icon = "";
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