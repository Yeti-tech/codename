<?php

/** @var app\models\game\GameCard $game_cards */
//#426d9b
?>

<style>
    html { overflow:  hidden; }

    body::before {
        content: '';
        position: fixed;
        left: 0; right: 0;
        top: 0; bottom: 0;
        z-index: -1;
        background: url('/web/images/gory-sneg-dom.jpg') center / cover no-repeat;
        filter: blur(3px);
    }

    body.stop-scrolling {
        overflow: hidden;
    }

    .btn {
        position: relative;
    }
    .newGame {
        letter-spacing: 1px;
        position: absolute;
        top: 80px;
        left: 30px;
        color: black;
        width: 205px;
        height: 80px;
        align-items: center;
        font-weight: 900;
        text-decoration: none;
        user-select: none;
        background: #46A438;
        padding: 20px;
    }

    .newGame:hover { background: #74D964;
        padding: 20px;
    }

    .newDuetGame {
        letter-spacing: 1px;
        position: absolute;
        top: 180px;
        left: 30px;
        width: 205px;
        height: 80px;
        align-items: center;
        color: black;
        font-weight: 900;
        text-decoration: none;
        user-select: none;
        background: #36ACBA;
        padding: 20px;
    }

    .newDuetGame:hover { background: #5BE6F7;
        padding: 20px;
    }

    .uploadNewWords {
        letter-spacing: 1px;
        position: absolute;
        top: 280px;
        left: 30px;
        width: 205px;
        height: 80px;
        line-height: 25px;
        align-items: center;
        color: black;
        font-weight: 900;
        vertical-align: middle;
        font-size: small;
        text-decoration: none;
        user-select: none;
        background: #D8D85D;
        padding: 20px;
    }

    .uploadNewWords:hover { background: #F3F375;
        padding: 20px;
    }

    .blueteam {
        color: #07ceed;
        position: relative;
        left: 450px;
        bottom: 155px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
        text-shadow:
                -0   -2px 1px #000000,
                0   -2px 1px #000000,
                -0    2px 1px #000000,
                0    2px 1px #000000,
                -2px -0   1px #000000,
                2px -0   1px #000000,
                -2px  0   1px #000000,
                2px  0   1px #000000,
                -1px -2px 1px #000000,
                1px -2px 1px #000000,
                -1px  2px 1px #000000,
                1px  2px 1px #000000,
                -2px -1px 1px #000000,
                2px -1px 1px #000000,
                -2px  1px 1px #000000,
                2px  1px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000;
    }
    .greenteam {
        color: #14c95c;
        position: relative;
        left: 450px;
        bottom: 155px;
        font-family: sans-serif;
        font-weight: 900;
        font-size: 35px;
        text-shadow:
                -0   -2px 1px #000000,
                0   -2px 1px #000000,
                -0    2px 1px #000000,
                0    2px 1px #000000,
                -2px -0   1px #000000,
                2px -0   1px #000000,
                -2px  0   1px #000000,
                2px  0   1px #000000,
                -1px -2px 1px #000000,
                1px -2px 1px #000000,
                -1px  2px 1px #000000,
                1px  2px 1px #000000,
                -2px -1px 1px #000000,
                2px -1px 1px #000000,
                -2px  1px 1px #000000,
                2px  1px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000;

    }
    .fixed {
        table-layout: fixed;
        width: 1100px;
        position: absolute;
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
        font-weight: bold;
        font-family: sans-serif;
        color: black;
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
    .eblue {
        background-color: #426d9b;
    }
    .green {
        cursor: pointer;
        height: 70px;
        width: 160px;
        background-color: #4c9c5e;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }
    .egreen {
        background-color: #4c9c5e;
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
    .egray {
        background-color: lightslategray;
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
    .eblack {
        background-color: #333a3f;
    }
    .button:hover {
        background: rgba(0,0,0,0);
        color: #012a4d;
        box-shadow: inset 0 0 0 3px #3a7999;
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
        background-color: #284d67;
        background-size: 200% auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        transition: .5s;
        margin-top: 1em;
    }
    .my-swal-green {
        color: greenyellow;
        font-size: x-large;
        font-weight: 900;
        backdrop-filter: blur(2px);
        text-shadow:
                -0   -2px 1px #000000,
                0   -2px 1px #000000,
                -0    2px 1px #000000,
                0    2px 1px #000000,
                -2px -0   1px #000000,
                2px -0   1px #000000,
                -2px  0   1px #000000,
                2px  0   1px #000000,
                -1px -2px 1px #000000,
                1px -2px 1px #000000,
                -1px  2px 1px #000000,
                1px  2px 1px #000000,
                -2px -1px 1px #000000,
                2px -1px 1px #000000,
                -2px  1px 1px #000000,
                2px  1px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000;
    }
    .my-swal-blue {
        color: #00ffff;
        font-size: x-large;
        font-weight: 900;
        backdrop-filter: blur(2px);
        text-shadow:
                -0   -2px 1px #000000,
                0   -2px 1px #000000,
                -0    2px 1px #000000,
                0    2px 1px #000000,
                -2px -0   1px #000000,
                2px -0   1px #000000,
                -2px  0   1px #000000,
                2px  0   1px #000000,
                -1px -2px 1px #000000,
                1px -2px 1px #000000,
                -1px  2px 1px #000000,
                1px  2px 1px #000000,
                -2px -1px 1px #000000,
                2px -1px 1px #000000,
                -2px  1px 1px #000000,
                2px  1px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000;
    }
    .white {
        color: white;
        font-size: x-large;
        font-weight: 700;
    }
    .title-green {
        color: greenyellow;
        text-shadow:
                -0   -2px 1px #000000,
                0   -2px 1px #000000,
                -0    2px 1px #000000,
                0    2px 1px #000000,
                -2px -0   1px #000000,
                2px -0   1px #000000,
                -2px  0   1px #000000,
                2px  0   1px #000000,
                -1px -2px 1px #000000,
                1px -2px 1px #000000,
                -1px  2px 1px #000000,
                1px  2px 1px #000000,
                -2px -1px 1px #000000,
                2px -1px 1px #000000,
                -2px  1px 1px #000000,
                2px  1px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000;
    }
    .title-blue {
        text-shadow:
                -0   -2px 1px #000000,
                0   -2px 1px #000000,
                -0    2px 1px #000000,
                0    2px 1px #000000,
                -2px -0   1px #000000,
                2px -0   1px #000000,
                -2px  0   1px #000000,
                2px  0   1px #000000,
                -1px -2px 1px #000000,
                1px -2px 1px #000000,
                -1px  2px 1px #000000,
                1px  2px 1px #000000,
                -2px -1px 1px #000000,
                2px -1px 1px #000000,
                -2px  1px 1px #000000,
                2px  1px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000,
                -2px -2px 1px #000000,
                2px -2px 1px #000000,
                -2px  2px 1px #000000,
                2px  2px 1px #000000;
        color: #00ffff;
    }
    .swal2-validation-message::before {
        visibility: hidden;
    }
    .swal2-inputerror {
        border-color: #0b2e13 !important;
    }
    .swal2-title{
        background-color: transparent;

    }
    .swal2-modal{
        background-color: transparent;

    }
    .swal2-image{
        border-radius: 10px;
        border: 3px solid #fff;
    }


</style>
<link href="/stylesheets/style2.css" rel="stylesheet" />
<span class = "btn btn-blue" onclick="addColourClass()"></span>

<button id = "newGame" onclick = "gameStart(this.id)" class = "newGame">Новая игра</button>
<button id = "duet" onclick = "gameStart(this.id)" class = "newDuetGame">Игра Дуэт</button>
<button id = "upload" onclick = "gameStart(this.id)" class = "uploadNewWords">Добавить слова</button>
<p id="main" class = 'blueteam' >Codenames</p>

<p id="1" class="gradient-button" onclick="guessNumber(this.id)">1</p>
<p id="2" class="gradient-button" onclick="guessNumber(this.id)">2</p>
<p id="3" class="gradient-button" onclick="guessNumber(this.id)">3</p>
<p id="4" class="gradient-button" onclick="guessNumber(this.id)">4</p>
<p id="5" class="gradient-button" onclick="guessNumber(this.id)">5</p>

<span id='myDynamicTable'></span>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="//cdn.jsdelivr.net/npm/sweetalert2"></script>

<script>
    <?php
        require(__DIR__.'/../../web/js/JSonly.js');
    ?>
</script>





