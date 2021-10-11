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
        margin-bottom: -100px;
    }

    .redteam {
        color: darkred;
        margin-bottom: -100px;
    }


    .card_list {
        width: 90%;
        height: 200%;
        border: 40px solid cornflowerblue;
        border-radius: 15px;
        box-shadow: 0 0 4px 4px cornflowerblue;
    }

    .card_list td {
        width: 20%;
        padding: 7px 10px;
        background-color: cornflowerblue;
    }

    .button {
        display: inline-block;
        cursor: pointer;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        background-color: beige;
        border: 10px solid beige;
        align-items: center;
        border-radius: 10px;

    }

    .blue {
        display: inline-block;
        cursor: pointer;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        background-color: lightblue;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .red {
        display: inline-block;
        cursor: pointer;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        background-color: #FFA07A;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .gray {
        display: inline-block;
        cursor: pointer;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
        background-color: lightslategray;
        border: #0a73bb;
        align-items: center;
        border-radius: 10px;
    }

    .black {
        display: inline-block;
        cursor: pointer;
        height: 60px;
        width: 100%;
        margin: 0 0 20px;
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
        background-color: black;
        background-size: 200% auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        transition: .5s;
        margin-top: 1em;
    }

    .gradient-button:hover {
        background-position: right center;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

<b><div id="main" class=blueteam>ХОД СИНИХ</div></b>

<script>
    function foo(id) {
        $('.p').unbind()
        $.ajax({
            url: '<?php echo \Yii::$app->getUrlManager()->createUrl('game-mode/number') ?>',
            type: 'POST',
            data: {number: id},
            success: function (result) {
                wordsNumber = 1
            }
        })
    }
</script>
<br>
<p id="1" class="gradient-button" onclick="foo(this.id)">1</p>
<p id="2" class="gradient-button" onclick="foo(this.id)">2</p>
<p id="3" class="gradient-button" onclick="foo(this.id)">3</p>
<p id="4" class="gradient-button" onclick="foo(this.id)">4</p>
<p id="5" class="gradient-button" onclick="foo(this.id)">5</p>


<br><br>
<table class=card_list>

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
                            id="<?= $gameCard->id ?>" class="button">
                        <?= $gameCard->getWord() ?>

                        <script>
                            var wordsNumber = 0;
                            $('.button').unbind()
                            $('.button').click(function () {
                                if (wordsNumber === 0) {
                                    swal("Cначала выберите число слов");
                                } else {
                                    let clickId = this.id;
                                    $.ajax({
                                        url: '<?php echo \Yii::$app->getUrlManager()->createUrl('game-mode/ajax') ?>',
                                        type: 'POST',
                                        data: {id: this.id},
                                        success: function (result) {
                                            let obj = JSON.parse(result)
                                            if (obj.colour === 'blue') {
                                                $("#" + clickId).addClass('blue');
                                            }
                                            if (obj.colour === 'red') {
                                                $("#" + clickId).addClass('red');
                                            }
                                            if (obj.colour === 'black') {
                                                $("#" + clickId).addClass('black');
                                            }
                                            if (obj.colour === 'gray') {
                                                $("#" + clickId).addClass('gray');
                                            }
                                            if (obj.winner) {
                                                if (obj.winner === 'red') {
                                                    swal("Красные всех сделали!!!!")
                                                } else {
                                                    swal("Синие всех сделали!!!!")
                                                }
                                                $.ajax({
                                                    url: '<?php echo \Yii::$app->getUrlManager()->createUrl('game-mode/gameOver') ?>',
                                                    type: 'POST',
                                                    data: {gaveOver: gameOver},
                                                    success: function (result) {
                                                        confirm('Хотите сыграть еще?');
                                                    }
                                                })
                                            }
                                            if (obj.newTeam === 'true') {
                                                wordsNumber = 0
                                            }
                                            if (obj.turn === 'blue') {
                                                $('#main').removeClass('redteam');
                                                $('#main').addClass('blueteam');
                                                $('#main').html('<div class=blueteam>' + 'ХОД СИНИХ' + '</div>')
                                                // $('#main').removeClass('redteam').addClass('blueteam');
                                                // $('#main').html('<div class=blueteam>'+'ХОД СИНИХ'+'</div>')
                                            } else {
                                                $('#main').removeClass('blueteam');
                                                $('#main').addClass('redteam');
                                                $('#main').html('<div class=redteam>' + 'ХОД КРАСНЫХ' + '</div>')
                                            }
                                        }
                                    })
                                }
                            })

                        </script>
                    </button>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<?= Html::a('Посмотреть цвета карточек', ['game-mode/colours'], ['class' => 'profile-link']) ?>



