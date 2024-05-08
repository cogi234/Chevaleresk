<?php

const MAX_STARS = 5;

function show_review(Review $review): string
{
    $star = $review->Stars;
    $comment = $review->Comment;

    $date_string = date("Y/m/d", $review->getDate());
    $date_tooltip = date("H:i:s", $review->getDate());

    $playerId = $review->PlayerId;

    $player = Player::select([
        Player::ALIAS,
        Player::AVATAR,
        Player::FIRST_NAME,
        Player::LAST_NAME,
    ], equals(Player::ID, $playerId));

    $image = $player->getAvatar();
    $name = $player->getFullname();

    $stars_html = "";
    for ($i = 0; $i < MAX_STARS; $i++) {
        $star_class = $i < $star ? "selected" : "";
        $stars_html .= <<<HTML
            <i class="fa-solid fa-star review-star $star_class"></i>
HTML;
    }

    return <<<HTML
        <div class="review-parent">
            
            <div style="flex: 1;">
                <div class="review-player" >
                    <a 
                        class="review-avatar" 
                        style="background-image: url('$image')" 
                        href="details.php?type=player&id=$playerId" 
                        title="Voir les détails de $name"></a>
                    <div class="review-author-name">$name</div>
                </div>
            </div>

            <div class="review-content" style="flex: 9;">
                <div class="review-stars" title="$star étoiles">
                    $stars_html
                    <span title="$date_tooltip">$date_string</span>
                </div>
                <hr>
                <div class="review-comment" style="flex: 1;">$comment</div>
            </div>
        </div>
HTML;
}

function showAverageStars($itemId)
{
    $avg = select("AVG(nbEtoiles)", "commentaires", "idItem = " . $itemId)["AVG(nbEtoiles)"];
    isset_default($avg, 0);
    $avg = round($avg);
    $stars_html = "";
    for ($i = 0; $i < MAX_STARS; $i++) {
        $star_class = $i < $avg ? "selected" : "";
        $stars_html .= <<<HTML
            <i class="fa-solid fa-star review-star $star_class"></i>
HTML;
    }
    return $stars_html;
}

function showReviewStats(int $itemId): string
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

    $count5 = round( 100 * $count5 / $countTotal , 2);
    $count4 = round( 100 * $count4 / $countTotal , 2);
    $count3 = round( 100 * $count3 / $countTotal , 2);
    $count2 = round( 100 * $count2 / $countTotal , 2);
    $count1 = round( 100 * $count1 / $countTotal , 2);

    return <<<HTML
    <p class="nb-total-reviews">$countTotal évaluations</p>
    <div class="reviews-stats-container">
        <div class="reviews-percent-container" title="$count5%">
            <div class="reviews-percent-label"><p>5</p><i class="fa-solid fa-star"></i></div>
            <div class="reviews-percent-full"><div class="reviews-percent" style="width: $count5%"></div></div>
        </div>
        <div class="reviews-percent-container" title="$count4%">
            <div class="reviews-percent-label"><p>4</p><i class="fa-solid fa-star"></i></div>
            <div class="reviews-percent-full"><div class="reviews-percent" style="width: $count4%"></div></div>
        </div>
        <div class="reviews-percent-container" title="$count3%">
            <div class="reviews-percent-label"><p>3</p><i class="fa-solid fa-star"></i></div>
            <div class="reviews-percent-full"><div class="reviews-percent" style="width: $count3%"></div></div>
        </div>
        <div class="reviews-percent-container" title="$count2%">
            <div class="reviews-percent-label"><p>2</p><i class="fa-solid fa-star"></i></div>
            <div class="reviews-percent-full"><div class="reviews-percent" style="width: $count2%"></div></div>
        </div>
        <div class="reviews-percent-container" title="$count1%">
            <div class="reviews-percent-label"><p>1</p><i class="fa-solid fa-star"></i></div>
            <div class="reviews-percent-full"><div class="reviews-percent" style="width: $count1%"></div></div>
        </div>
    </div>
HTML;
}