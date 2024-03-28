<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/item.php";

class CartItem extends PDO_Object
{
    protected function on_create_self(array $data): void
    {
        $this->Item = new Item($data);
    }

    protected const TABLE = "vPanier";

    public const ID_PLAYER = "idJoueur";
    #[PDO_Object_Id(CartItem::ID_PLAYER)]
    public int $IdPlayer = -1;

    public const QUANTITY = "quantite";
    #[PDO_Object_Id(CartItem::QUANTITY)]
    public int $Quantity = -1;

    public Item $Item;
}