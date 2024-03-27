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

    public const IDPLAYER = "idJoueur";
    #[PDO_Object_Id(InventoryItem::IDPLAYER)]
    public int $IdPlayer = -1;

    public const QUANTITY = "quantite";
    #[PDO_Object_Id(InventoryItem::QUANTITY)]
    public int $Quantity = -1;

    public Item $Item;
}