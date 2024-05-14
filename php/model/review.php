<?php

require_once dirname(__FILE__, 2) . "/require_utilities.php";
require_path("php/php_utilities.php");
require_path("php/pdo/pdo_utilities.php");
require_path("php/model/pdo_object.php");
require_path("php/model/inventory_item.php");

class Review extends PDO_Object
{
    #region PDO_Object
    protected const TABLE = "commentaires";
    #endregion

    #region Properties
    public const PLAYERID = "idJoueur";
    #[PDO_Object_Id(Review::PLAYERID)]
    public int $PlayerId = -1;

    public const ITEMID = "idItem";
    #[PDO_Object_Id(Review::ITEMID)]
    public int $ItemId = -1;

    public const STARS = "nbEtoiles";
    #[PDO_Object_Id(Review::STARS)]
    public int $Stars = -1;

    public const COMMENT = "commentaire";
    #[PDO_Object_Id(Review::COMMENT)]
    public string $Comment;

    public const DATE = "date";
    #[PDO_Object_Id(Review::DATE)]
    public string $Date;

    #endregion

    #region Functions

    /**
     * @author Colin Bougie
     * Date of creation    : 2024/05/08
     * Date of modification: 2024/05/08
     */
    public function getDate() : int
    {
        return strtotime($this->Date);
    }

    /**
     * @author Colin Bougie
     * Date of creation    : 2024/05/01
     * Date of modification: 2024/05/01
     */
    public static function createReview(int $itemId, int $stars, string $comment = ""): bool
    {
        return callProcedure("ajouterCommentaire", Player::getLocalPlayer()->Id, $itemId, $stars, $comment);
    }

    /**
     * @author Colin Bougie
     * Date of creation    : 2024/05/01
     * Date of modification: 2024/05/01
     */
    public static function removeReview(int $playerId, int $itemId): bool
    {
        return callProcedure("retirerCommentaire", $playerId, $itemId);
    }
    #endregion
}
