<?php

/** @var app\models\game\GameCard $game_cards */


use yii\helpers\Html;

?>
<style>

    body {
        background-color: lightblue;
    }

    .blueteam {
        color: blue;
        position: relative;
        left: 310px;
        top: 30px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
    }

    .redteam {
        color: #e36532;
        position: relative;
        left: 310px;
        top: 30px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
    }

    table.fixed {
        table-layout: fixed;
        width: 1100px;
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
        width: 200px;
    }

    table.fixed td:nth-of-type(2) {
        width: 200px;
    }

    table.fixed td:nth-of-type(3) {
        width: 200px;
    }

    table.fixed td:nth-of-type(4) {
        width: 200px;
    }

    table.fixed td:nth-of-type(5) {
        width: 200px;
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

    .gradient-button {
        text-decoration: none;
        display: inline-block;
        color: white;
        padding: 20px 30px;
        position: relative;
        left: 20%;

        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        background-image: linear-gradient(to right, #9EEFE1 0%, #4830F0 51%, #9EEFE1 100%);
        background-color: lightblue;
        background-size: 200% auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        transition: .5s;
        margin-top: 1em;
    }

    .gradient-button:hover {
        background-position: right center;
    }

    .number{
        text-decoration: none;
        display: inline-block;
        color: white;
        padding: 20px 30px;
        position: relative;
        left: 20%;


        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        background-image: linear-gradient(to right, #add8e6 20%, #97c4d3 51%, #9EEFE1 100%);
        background-color: lightblue;
        background-size: 200% auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        transition: .5s;
        margin-top: 1em;
    }


</style>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


<?php require("ajax.js")?>
<?php require("script.js")?>
<script src="ajax.js">...</script>
<script src="script.js">...</script>
<b>
    <div id="main" class=blueteam>ХОД СИНИХ</div>
</b>

<br>
<p id="1" class="gradient-button" onclick="foo(this.id)">1</p>
<p id="2" class="gradient-button" onclick="foo(this.id)">2</p>
<p id="3" class="gradient-button" onclick="foo(this.id)">3</p>
<p id="4" class="gradient-button" onclick="foo(this.id)">4</p>
<p id="5" class="gradient-button" onclick="foo(this.id)">5</p>


<br><br>
<table class=fixed>

    <?php
    $gameAllCards = array_chunk($game_cards, 5);
    ?>

    <?php
    foreach ($gameAllCards as $gameFiveCards):?>
        <tr>
            <?php foreach ($gameFiveCards as $gameCard): ?>
                <?php if ($gameCard->getDeactivate() === 1): ?>
                    <td>

                    <button
                    id="<?= $gameCard->id ?>" class=<?= $gameCard->getColour($gameCard->getCardId()) ?> onclick="event.preventDefault()">
                    <?= $gameCard->getWord();
                    continue;
                endif; ?>
                <td>
                    <button
                            id="<?= $gameCard->id ?>" class="button" onclick ="game(this.id)">
                        <?= $gameCard->getWord() ?>
                    </button>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<?= Html::a('Посмотреть цвета карточек', ['game-mode/colours'], ['class' => 'profile-link']) ?>






