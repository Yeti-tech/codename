<?php

/** @var app\models\game\GameCard $game_cards */
/** @var string $word */
/** @var string $card_id */
/** @var string $current_team */

require('E:\OSPanel\domains\codename\web\script.js');

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
<br>
<div id="main"></div>


<br>
<br>
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
                    id="<?= $gameCard->id ?>" class=<?= $gameCard->getColour($gameCard->getCardId()) ?>>
                    <?= $gameCard->getWord();
                    continue;
                endif; ?>
                <td>
                    <button
                            id="<?= $gameCard->id ?>" class="button">
                        <?= $gameCard->getWord() ?>
                        <script>
                           // $(".button").on('click', function() {
                           $('.button').unbind();
                                $('.button').click(function () {
                                    let clickId = this.id;
                                    $.ajax({
                                        url: '<?php echo \Yii::$app->getUrlManager()->createUrl('game-mode/ajax') ?>',
                                        type: 'POST',
                                        data: {id: this.id},
                                        success: function (result) {
                                            let obj = JSON.parse(result);
                                            if (obj.colour === 'blue') {
                                                $("#" + clickId).css("background", "lightblue");
                                            }
                                            if (obj.colour === 'red') {
                                                $("#" + clickId).css("background", "red");
                                            }
                                            if (obj.colour === 'black') {
                                                $("#" + clickId).css("background", "black");
                                            }
                                            if (obj.colour === 'gray') {
                                                $("#" + clickId).css("background", "gray");
                                                //сохранить изменения в куки или сеанс
                                            }
                                            //var contactHTML = $('#main').html();
                                            //console.log(obj.colour);
                                            $('#main').html('<div>' + obj.turn + '</div>');
                                            // $('#main').html('<li>' + result['turn'] + '</li>');
                                            //   var main = document.getElementById("main");
                                            //  main.value = 'new value';
                                        }
                                    })
                                //$('.button').click();

                            });

                        </script>
                    </button>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>


