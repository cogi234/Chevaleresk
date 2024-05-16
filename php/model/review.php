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

    public static function reviewsStats(int $itemId): string
    {
        $reviews = Review::selectAll([Review::STARS], equals(Review::ITEMID, $itemId));
        $countTotal = count($reviews);
        $count5 = 0;
        $count4 = 0;
        $count3 = 0;
        $count2 = 0;
        $count1 = 0;

        foreach ($reviews as $review) {
            switch ($review->Stars) {
                case 1:
                    $count1++;
                    break;
                case 2:
                    $count2++;
                    break;
                case 3:
                    $count3++;
                    break;
                case 4:
                    $count4++;
                    break;
                case 5:
                    $count5++;
                    break;
            }
        }

        if ($countTotal <= 0)
            return "";
    
        $count5 = round( 100 * $count5 / $countTotal , 2);
        $count4 = round( 100 * $count4 / $countTotal , 2);
        $count3 = round( 100 * $count3 / $countTotal , 2);
        $count2 = round( 100 * $count2 / $countTotal , 2);
        $count1 = round( 100 * $count1 / $countTotal , 2);

        $display5 = $count5 < 3 ? "opacity: 0" : "";
        $display4 = $count4 < 3 ? "opacity: 0" : "";
        $display3 = $count3 < 3 ? "opacity: 0" : "";
        $display2 = $count2 < 3 ? "opacity: 0" : "";
        $display1 = $count1 < 3 ? "opacity: 0" : "";
    
        return <<<HTML
            <p class="nb-total-reviews">$countTotal évaluations</p>
            <div class="reviews-stats-container">
                <div class="reviews-percent-container" title="$count5%">
                    <div class="reviews-percent-label"><p>5</p><i class="fa-solid fa-star"></i></div>
                    <div class="reviews-percent-full" title="$count5%"><div class="reviews-percent" style="width: $count5%; $display5"></div></div>
                </div>
                <div class="reviews-percent-container" title="$count4%">
                    <div class="reviews-percent-label"><p>4</p><i class="fa-solid fa-star"></i></div>
                    <div class="reviews-percent-full" title="$count4%"><div class="reviews-percent" style="width: $count4%; $display4"></div></div>
                </div>
                <div class="reviews-percent-container" title="$count3%">
                    <div class="reviews-percent-label"><p>3</p><i class="fa-solid fa-star"></i></div>
                    <div class="reviews-percent-full" title="$count3%"><div class="reviews-percent" style="width: $count3%; $display3"></div></div>
                </div>
                <div class="reviews-percent-container" title="$count2%">
                    <div class="reviews-percent-label"><p>2</p><i class="fa-solid fa-star"></i></div>
                    <div class="reviews-percent-full" title="$count2%"><div class="reviews-percent" style="width: $count2%; $display2"></div></div>
                </div>
                <div class="reviews-percent-container" title="$count1%">
                    <div class="reviews-percent-label"><p>1</p><i class="fa-solid fa-star"></i></div>
                    <div class="reviews-percent-full" title="$count1%"><div class="reviews-percent" style="width: $count1%; $display1"></div></div>
                </div>
            </div>
    HTML;
    }
    #endregion
}
