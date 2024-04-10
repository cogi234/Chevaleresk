<?php
require_once "php/php_utilities.php";
require_once "php/model/pdo_object.php";
require_once "php/model/recipeIngredient.php";

class Recipe extends PDO_Object
{
    protected function on_create_self(array $data): void
    {
        $this->Ingredients = RecipeIngredient::selectAllComplete(equals(RecipeIngredient::ID_RECIPE, $this->Id));
    }

    #region PDO_Object
    protected const TABLE = "recettes";
    #endregion

    #region Properties
    public const ID = "idRecette";
    #[PDO_Object_Id(Recipe::ID)]
    public int $Id = -1;
    
    public const ID_PRODUCT = "idProduit";
    #[PDO_Object_Id(Recipe::ID_PRODUCT)]
    public int $IdProduct = -1;
    
    public const ALCHEMY_LEVEL = "niveauAlchimie";
    #[PDO_Object_Id(Recipe::ALCHEMY_LEVEL)]
    public int $AlchemyLevel = -1;

    public array $Ingredients = [];
    #endregion
}