<?php

function show_review($review):string {
    $star = $review->Stars;
    $comment = $review->Comment;

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
    for ($i=0; $i < MAX_STARS; $i++) { 
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
                <div class="review-stars" title="$star étoiles">$stars_html</div>
                <hr>
                <div class="review-comment" style="flex: 1;">$comment</div>
            </div>
        </div>
HTML;
}