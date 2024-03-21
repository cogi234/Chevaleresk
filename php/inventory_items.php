<?php

require_once "php/phpUtilities.php";
require_once "php/pdo_object.php";
require_once "php/items.php";

class InventoryItem extends PDO_Object
{
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->Item = new Item($data);
    }

    protected const TABLE = "vInventaire";

    public const IDJOUEUR = "idJoueur";
    #[PDO_Object_Id(InventoryItem::IDJOUEUR)]
    public int $IdJoueur = -1;

    public const QUANTITY = "quantite";
    #[PDO_Object_Id(InventoryItem::QUANTITY)]
    public int $Quantite = -1;

    public Item $Item;
}