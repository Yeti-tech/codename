<?php

/** @var app\models\game\GameCard $game_cards */

/** @var array $result */

use yii\helpers\Html;
?>


<style>


    body {
        background-color: lightblue;

    }

    .up {
        position: relative
        top: 200px;
    }

    .lower {
        position: absolute;
        top: 360px;
        right: 300px;
        z-index: 100;
    }

    .blueteam {
        color: blue;
        position: relative;
        left: 450px;
        bottom: 85px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
    }

    .redteam {
        color: #800000;
        position: relative;
        left: 450px;
        bottom: 85px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
    }

    table.fixed {
        table-layout: fixed;
        width: 1100px;
        position: relative;
        bottom: 105px;
    }

    .fixed {
        border: 20px solid cornflowerblue;
        border-radius: 15px;
        box-shadow: 0 0 4px 4px cornflowerblue;

    }

    table.fixed td {
        padding: 20px;
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
        border: #0a73bb;
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

    .button:hover {
        background: rgba(0,0,0,0);
        color: #ffffff;
        box-shadow: inset 0 0 0 3px #3a7999;
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
        left: 340px;
        bottom: 105px;

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
        bottom: 105px;


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

<link href="/stylesheets/style2.css" rel="stylesheet" type="text/css" />

<span class = "btn-blue" onclick="showColours(this.id)">
</span>

<button class = gradient-button onclick="showRect(this)">Узнать координаты</button>
<audio preload="auto">
    <source src="https://github.com/nclud/2011.beercamp.com/blob/gh-pages/audio/inception.mp3?raw=true"
            type="audio/mp3"/>
    <source src="https://github.com/nclud/2011.beercamp.com/blob/gh-pages/audio/inception.ogg?raw=true"
            type="audio/ogg"/>
</audio>

<span id='myDynamicTable'></span>
<p id="main" class=<?= $result['colour'] ?>><?= $result['name'] ?></p>

<p id="1" class="gradient-button" onclick="foo(this.id)">1</p>
<p id="2" class="gradient-button" onclick="foo(this.id)">2</p>
<p id="3" class="gradient-button" onclick="foo(this.id)">3</p>
<p id="4" class="gradient-button" onclick="foo(this.id)">4</p>
<p id="5" class="gradient-button" onclick="foo(this.id)">5</p>


<script>$('td').hover(function(){
        var xPos = Math.floor($(this).offset().left);
        var yPos = Math.floor($(this).offset().top);
    });</script>
<script>
    function showRect(elem) {
        let r = elem.getBoundingClientRect();
        alert(`x:${r.x}
y:${r.y}
width:${r.width}
height:${r.height}
top:${r.top}
bottom:${r.bottom}
left:${r.left}
right:${r.right}
`);
    }</script>
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
                            id="<?= $gameCard->id ?>" class="button" onclick="game(this.id)">
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
<?php

require("E:\OSPanel\domains\codename\web\js\script.js");
require("E:\OSPanel\domains\codename\web\js\ajax.js");
require("E:\OSPanel\domains\codename\web\js\showColours.js")

?>







