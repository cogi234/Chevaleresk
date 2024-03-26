<?php

require_once "php/phpUtilities.php";
require_once "php/pdo_object.php";
require_once "php/items.php";

class CartItem extends PDO_Object{

    public const TABLE = "dbo.cartItem";

    public const PLAYER = "idJoueur";
    #[PDO_Object_Id(CartItem::PLAYER)]
    public int $idJoueur = -1;

    public const ITEM = "idItem";
    #[PDO_Object_Id(CartItem::ITEM)]
    public int $idItem = -1;

    public const QUANTITY = "quantite";
    #[PDO_Object_Id(CartItem::QUANTITY)]
    public int $Quantite = -1;

    public const NAME = "nom";
    #[PDO_Object_Id(CartItem::NAME)]
    public string $nom = "";

    public const IMAGE = "image";
    #[PDO_Object_Id(CartItem::IMAGE)]
    public string $image = "";

    public const PRICE = "prix";
    #[PDO_Object_Id(CartItem::PRICE)]
    public int $prix = 0;

    public const QUANTITY_STOCK = "quantiteStock";
    #[PDO_Object_Id(CartItem::QUANTITY_STOCK)]
    public int $QuantiteStock = -1;
}