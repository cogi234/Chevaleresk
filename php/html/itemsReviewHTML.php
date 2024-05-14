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