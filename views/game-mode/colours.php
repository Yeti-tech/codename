<?php

/** @var app\models\game\GameCard $game_cards */

use yii\helpers\Html;


?>
<style>
    .button {
        background-color: beige;
        display: flex;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        flex-basis: 12.5%;
    }
</style>

<style>
    .card_list {
        width: 90%;
    }

    .card_list td {
        width: 20%;
        border: 0;
        padding: 7px 10px;
        background-color: #cda;
    }

    .blue {
        display: flex;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        flex-basis: 12.5%;
        background-color: lightblue;
    }

    .red {
        display: flex;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        flex-basis: 12.5%;
        background-color: red;
    }

    .gray {
        display: flex;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        flex-basis: 12.5%;
        background-color: gray;
    }

    .black {
        display: flex;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        flex-basis: 12.5%;
        background-color: black;
    }


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<table class=card_list>
    <br>
    <br>
    <?php
    $gameAllCards = array_chunk($game_cards, 5);
    ?>

    <?php
    foreach ($gameAllCards as $gameFiveCards):?>
        <tr>
            <?php foreach ($gameFiveCards as $gameCard): ?>
                <td>
                    <button
                            id="<?= $gameCard->id ?>" class=<?= $gameCard->getColour($gameCard->getCardId()) ?>>
                        <?= $gameCard->getWord()
                        ?>
                </td>
                </button>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<?= Html::a('Обратно к игре', ['game-mode/form'], ['class' => 'profile-link']) ?>



