<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";

// Utilities
require_path("php/php_utilities.php");
require_path("php/pdo/pdo_utilities.php");

// PDO
require_path("php/model/pdo_object.php");
require_path("php/model/recipeIngredient.php");

class Recipe extends PDO_Object
{
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

    #endregion

    #region Functions

    /**
     * @author @WarperSan
     * Date of creation    : 2024/04/11
     * Date of modification: 2024/04/11
     * @return array List of the ingredients that are used by this recipe
     */
    public function getIngredients(): array
    {
        return RecipeIngredient::selectAllComplete(equals(RecipeIngredient::ID_RECIPE, $this->Id));
    }

    /**
     * @author @WarperSan
     * Date of creation    : 2024/04/11
     * Date of modification: 2024/04/11
     * @return Item|bool The product of this recipe or false if not found
     */
    public function getProduct(): Item
    {
        return Item::selectComplete(equals(Item::ID, $this->IdProduct));
    }

    #endregion
}