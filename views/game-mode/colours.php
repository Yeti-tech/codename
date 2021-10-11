<?php

/** @var app\models\game\GameCard $game_cards */

use yii\helpers\Html;
$this->registerJsFile('@web/js/fuck.js',   ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
<style>

    body {
        background-color: lightblue;
    }

    table.fixed {
        table-layout:fixed; width:1100px;
    }

    .fixed {
        border: 40px solid cornflowerblue;
        border-radius: 15px;
        box-shadow: 0 0 4px 4px cornflowerblue;
    }

    table.fixed td {
        padding: 20px;
    }

    table.fixed td:nth-of-type(1) {
        width:200px;
    }
    table.fixed td:nth-of-type(2) {
        width:200px;
    }
    table.fixed td:nth-of-type(3) {
        width:200px;
    }
    table.fixed td:nth-of-type(4) {
        width:200px;
    }
    table.fixed td:nth-of-type(5) {
        width:200px;
    }

    table.fixed tr {
        height: 100px;
        background-color: cornflowerblue;
    }
    button:active {
        padding: 0;
    }

    .button {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: beige;
        border: 10px solid beige;
        align-items: center;
        border-radius: 10px;
    }

    .blue {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: lightblue;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .red {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: #FFA07A;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .gray {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: lightslategray;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .black {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: midnightblue;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

<script src ="../../web/js/fuck.js"></script>
<br><br>
<table class=fixed>
    <button id = 'gg' class = "button" onclick ="fuck()">fuck me</button>
    <?php
    $gameAllCards = array_chunk($game_cards, 5);
    ?>

    <?php
    foreach ($gameAllCards as $gameFiveCards):?>
        <tr>
            <?php foreach ($gameFiveCards as $gameCard): ?>
                    <td>
                    <button
                    id="<?= $gameCard->id ?>" class=<?= $gameCard->getColour($gameCard->getCardId()) ?> >
                    <?= $gameCard->getWord();
                ?>
                        </button>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<?= Html::a('Обратно', ['game-mode/form']) ?>





