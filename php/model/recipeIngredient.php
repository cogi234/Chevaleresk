<?php
require_once dirname(__FILE__, 2) . "/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");

// PDO
require_path("php/model/pdo_object.php");
require_path("php/model/item.php");

class RecipeIngredient extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "ingredientRecette";
    #endregion

    #region Properties
    public const ID_RECIPE = "idRecette";
    #[PDO_Object_Id(RecipeIngredient::ID_RECIPE)]
    public int $IdRecipe = -1;

    public const ID_INGREDIENT = "idIngredient";
    #[PDO_Object_Id(RecipeIngredient::ID_INGREDIENT)]
    public int $IdIngredient = -1;

    public const QUANTITY = "quantite";
    #[PDO_Object_Id(RecipeIngredient::QUANTITY)]
    public int $Quantity = -1;
    #endregion
}