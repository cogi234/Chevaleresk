<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/php_utilities.php");
require_path("php/model/pdo_object.php");
require_path("php/model/item.php");

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

    #region PDO Functions

    /**
     * Adds the given amount of the item in the player's cart
     * @author @WarperSan
     * Date of creation    : 2024/04/09
     * Date of modification: 2024/04/09
     * @return bool Success of the operation
     */
    public static function add_to_cart(int $idPlayer, int $idItem, int $quantity): bool
    {
        // Skip if quantity invalid
        if ($quantity <= 0)
            return false;

        return callProcedure("ajouterPanier", $idPlayer, $idItem, $quantity);
    }

    /**
     * Removes the given amount of the item in the player's cart
     * @author @WarperSan
     * Date of creation    : 2024/04/09
     * Date of modification: 2024/04/09
     * @return bool Success of the operation
     */
    public static function remove_from_cart(int $idPlayer, int $idItem, int $quantity): bool
    {
        // Skip if quantity invalid
        if ($quantity <= 0)
            return false;

        return callProcedure("enleverPanier", $idPlayer, $idItem, $quantity);
    }

    public static function modify_cart(int $idPlayer, int $idItem, int $quantity) : bool
    {
        // Skip if quantity invalid
        if ($quantity < 0)
            return false;

        return callProcedure("modifierPanier", $idPlayer, $idItem, $quantity);
    }

    #endregion
}