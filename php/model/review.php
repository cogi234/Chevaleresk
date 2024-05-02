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
    #endregion

    #region Functions

    /**
     * @author Colin Bougie
     * Date of creation    : 2024/05/01
     * Date of modification: 2024/05/01
     */
    public function createEvaluation(int $itemId, int $stars, string $comment) : void
    {
        callProcedure("ajouterCommentaire", Player::getLocalPlayer()->Id, $itemId, $stars, $comment);
    }
    
    /**
     * @author Colin Bougie
     * Date of creation    : 2024/05/01
     * Date of modification: 2024/05/01
     */
    public function removeEvaluation(int $itemId) : void
    {
        callProcedure("retirerCommentaire", Player::getLocalPlayer()->Id, $itemId);
    }

    public static function averageStarsHTML($itemId, $MAX_STARS){
        $avg = select("AVG(nbEtoiles)", "commentaires", "idItem = " . $itemId)["AVG(nbEtoiles)"];
        isset_default($avg, 0);
        $avg = round($avg);
        $stars_html = "";
        for ($i=0; $i < $MAX_STARS; $i++) { 
            $star_class = $i < $avg ? "selected" : "";
            $stars_html .= <<<HTML
                <i class="fa-solid fa-star review-star $star_class"></i>
HTML;
        }
        return $stars_html;
    }

    #endregion
}