<?php

require_once "../php/model/quest.php";
require_once "../php/model/answer.php";

/**
 * Creates the visual for an quest in enigma
 * @author Colin Bougie
 * Date of creation    : 2024/04/11
 * Date of modification: 2024/04/11
 */
function quest(
    Quest $quest
): string {
    $title = $quest->Title;
    $question = $quest->Question;
    switch ($quest->Difficulty) {
        case 1:
            $difficulty = "Facile";
            break;
        case 2:
            $difficulty = "Intermédiaire";
            break;
        case 3:
            $difficulty = "Difficile";
            break;
        default:
            $difficulty = "Erreur";
            break;
    }
    $alchemy = $quest->Alchemy;

    //Buttons for every answer
    isset_default($answerButtons);
    foreach ($quest->Answers as $answer) {
        $answerId = $answer->Id;
        $answerText = $answer->Text;
        $answerButtons .= <<<HTML
        <button class="answer-button"
            hx-post="operations/answerQuest.php"
            hx-trigger="click"
            hx-target="#quest-container"
            hx-swap="innerHTML"
            name="id"
            value="$answerId">
            $answerText
        </button>
    HTML;
    }

    isset_default($content);
    $content = <<<HTML
    <h2 class="quest-title">$title</h2>
    <div class="quest-difficulty">$difficulty</div>
    <p class="quest-question">$question</p>
    <div class="quest-answers">
        $answerButtons
    </div>
HTML;

    return $content;
}
/**
 * Creates the visuals for the result of an answer for a quest
 * @author Akuma
 * Date of creation    : 2024/04/13
 * Date of modification: 2024/04/16
 */
function Result(bool $isRight, Quest $quest){
    isset_default($isRight);
    isset_default($content);
    if(!$isRight){
        $content =<<<HTML
            <p class="result-msg">Désolé! Mauvaise réponse...</p>
        HTML;
        return $content;
    }

    $content .=<<<HTML
        <p class="result-msg">Bravo! Vous avez reussi!</p>
    HTML;

    switch($quest->Difficulty){
        case 1:
            $content .=<<<HTML
                <p class="result-msg">Vous avez reçu 50 écus!</p>
            HTML;
            break;
        case 2:
            $content .=<<<HTML
                <p class="result-msg">Vous avez reçu 100 écus!</p>
            HTML;
            break;
        case 3:
            $content .=<<<HTML
                <p class="result-msg">Vous avez reçu 200 écus!</p>
            HTML;
            break;
    }

    
    return $content;
}