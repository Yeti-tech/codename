<?php

/** @var app\models\game\GameCard $game_cards */

/** @var array $result */

#efede8 instead of beige
//  background-color: #FFA07A;
//table.fixed tr {
 //   height: 100px;
 //       background-color: cornflowerblue;
//border: 20px solid cornflowerblue;
// box-shadow: 0 0 4px 4px cornflowerblue;
use yii\helpers\Html;
?>


<style>

    body {
        background-image: url('/web/images/gory-sneg-dom.jpg'); /* Путь к фоновому изображению */
        background-color: #c7b39b; /* Цвет фона */
    }


    .lower {
        position: absolute;
        top: 360px;
        right: 300px;
        z-index: 100;
    }

    .blueteam {
        color: #07ceed;
        position: relative;
        left: 450px;
        bottom: 155px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
    }

    .redteam {
        color: #14c95c;
        position: relative;
        left: 450px;
        bottom: 155px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
    }

    .fixed {
        table-layout: fixed;
        width: 1100px;
        position: relative;
        bottom: 180px;
        border:  20px solid #d1d2d4;
        border-radius: 15px;
        box-shadow: 0 0 4px 4px #244560;

    }

    table.fixed td {
        padding: 20px;
    }

    table.fixed tr {
        height: 100px;
        background-color: #d1d2d4;
    }

    button:active {
        padding: 0;
    }

    .button {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: beige;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .blue {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: #426d9b;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .red {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: #4c9c5e;
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

    .button:hover {
        background: rgba(0,0,0,0);
        color: #012a4d;
        box-shadow: inset 0 0 0 3px #3a7999;
    }

    .black {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: #333a3f;
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
        left: 340px;
        bottom: 190px;

        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        background-image: linear-gradient(to right,
        #093c61 7%,
        #788dbf 41%, #012e4a 100%);
        background-color:
                #8696aa;
        background-size: 200% auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        transition: .5s;
        margin-top: 1em;
    }

    .gradient-button:hover {
        background-position: right center;
    }

    .active {
        color: red;
    }

    .number {
        text-decoration: none;
        display: inline-block;
        color: white;
        padding: 20px 30px;
        position: relative;
        left: 340px;
        bottom: 190px;


        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        background-image: linear-gradient(to right,
        #558db4 3%, #dbdad8 61%, #6b7888 100%);
        background-color:
                #284d67;
        background-size: 200% auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        transition: .5s;
        margin-top: 1em;

    p span {
        font: 26px Monaco, MonoSpace;
        height: 200px;
        position: absolute;
        width: 20px;
        left: 0;
        top: 0;
        transform-origin: bottom center;
    }

    }

</style>
<link href="/stylesheets/style2.css" rel="stylesheet" />
<span class = "btn-blue" onclick="addColourClass()"></span>


<audio preload="auto">
    <source src="https://github.com/nclud/2011.beercamp.com/blob/gh-pages/audio/inception.mp3?raw=true"
            type="audio/mp3"/>
    <source src="https://github.com/nclud/2011.beercamp.com/blob/gh-pages/audio/inception.ogg?raw=true"
            type="audio/ogg"/>
</audio>

<button class = "button" id = "77777" onclick = "start()">новая игра</button>

<p id="main" class=<?= $result['colour'] ?>><?= $result['name'] ?></p>

<p id="1" class="gradient-button" onclick="foo(this.id)">1</p>
<p id="2" class="gradient-button" onclick="foo(this.id)">2</p>
<p id="3" class="gradient-button" onclick="foo(this.id)">3</p>
<p id="4" class="gradient-button" onclick="foo(this.id)">4</p>
<p id="5" class="gradient-button" onclick="foo(this.id)">5</p>

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
                    <?php $class = $gameCard->getColour($gameCard->getCardId()) ?>
                    id="<?= $gameCard->id ?>" class=<?= $class ?> onclick="event.preventDefault()">

                    <?= $gameCard->getWord();
                    continue;
                endif; ?>
                <td>
                    <button
                            id="<?= $gameCard->id ?>" class="button" onclick="game(this.id)"
                            data-*="<?= $gameCard->getColour($gameCard->getCardId()) ?>">
                        <?= $gameCard->getWord() ?>
                    </button>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="//cdn.jsdelivr.net/npm/sweetalert2"></script>
<script src="//cdn.circletype.min."></script>

<?php
require("E:\OSPanel\domains\codename\web\js\script.js");
require("E:\OSPanel\domains\codename\web\js\ajax.js");

?>





