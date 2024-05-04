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
    public static function createReview(int $itemId, int $stars, string $comment): bool
    {
        return callProcedure("ajouterCommentaire", Player::getLocalPlayer()->Id, $itemId, $stars, $comment);
    }

    /**
     * @author Colin Bougie
     * Date of creation    : 2024/05/01
     * Date of modification: 2024/05/01
     */
    public static function removeReview(int $itemId): bool
    {
        return callProcedure("retirerCommentaire", Player::getLocalPlayer()->Id, $itemId);
    }

    public static function averageStarsHTML($itemId, $MAX_STARS): string
    {
        $avg = select("AVG(nbEtoiles)", "commentaires", "idItem = " . $itemId)["AVG(nbEtoiles)"];
        isset_default($avg, 0);
        $avg = round($avg);
        $stars_html = "";
        for ($i = 0; $i < $MAX_STARS; $i++) {
            $star_class = $i < $avg ? "selected" : "";
            $stars_html .= <<<HTML
                <i class="fa-solid fa-star review-star $star_class"></i>
HTML;
        }
        return $stars_html;
    }

    public static function reviewsStats(int $itemId): string
    {
        $reviews = Review::selectAll([Review::STARS], equals(Review::ITEMID, $itemId));
        $countTotal = 0;
        $count5 = 0;
        $count4 = 0;
        $count3 = 0;
        $count2 = 0;
        $count1 = 0;

        foreach ($reviews as $review) {
            $countTotal++;
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

        $count5 = 100 * $count5 / $countTotal;
        $count4 = 100 * $count4 / $countTotal;
        $count3 = 100 * $count3 / $countTotal;
        $count2 = 100 * $count2 / $countTotal;
        $count1 = 100 * $count1 / $countTotal;

        $style5 = 100 - $count5;
        $style4 = 100 - $count4;
        $style3 = 100 - $count3;
        $style2 = 100 - $count2;
        $style1 = 100 - $count1;

        return <<<HTML
        <div>
            <p class="nb-total-reviews">$countTotal</p>
            <div>
                <div class="reviews-percent" style="right: $style5%"></div>
            </div>
            <div>
                <div class="reviews-percent" style="right: $style4%"></div>
            </div>
            <div>
                <div class="reviews-percent" style="right: $style3%"></div>
            </div>
            <div>
                <div class="reviews-percent" style="right: $style2%"></div>
            </div>
            <div>
                <div class="reviews-percent" style="right: $style1%"></div>
            </div>
        </div>
HTML;
    }

    #endregion
}
