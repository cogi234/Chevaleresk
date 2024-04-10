<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/item.php";

class RecipeIngredient extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "recettes";
    #endregion

    #region Properties
    public const ID_RECIPE = "idRecette";
    #[PDO_Object_Id(RecipeIngredient::ID_RECIPE)]
    public int $IdRecipe = -1;
    
    public const ID_INGREDIENT = "idIngredient";
    #[PDO_Object_Id(RecipeIngredient::ID_INGREDIENT)]
    public int $IdProduct = -1;
    
    public const QUANTITY = "quantite";
    #[PDO_Object_Id(RecipeIngredient::QUANTITY)]
    public int $Quantity = -1;
    #endregion
}