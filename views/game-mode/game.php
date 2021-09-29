<?php


/** @var app\models\game\GameCard $game_cards */
/** @var string $word */
/** @var string $card_id */

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
    <br>
    <table class=card_list>

    <?php
    $gameAllCards = array_chunk($game_cards, 5);

     foreach ($gameAllCards as $gameFiveCards):?>
        <tr>
        <?php foreach ($gameFiveCards as $gameCard): ?>
            <?php if ($gameCard->getDeactivate() === 1) { ?>
            <td> <button id="<?= $gameCard->id ?>" class=<?=$gameCard->getColour($gameCard->getCardId()) ?>>
                <?= $gameCard->getWord();
                    continue;
                  } ?>
                    <td>
                    <button id="<?= $gameCard->id ?>" class="button">
                        <?= $gameCard->getWord() ?>
                            <script>
                                $('.button').click(function () {
                                    let clickId = this.id;
                                    $.ajax({
                                        url: '<?php echo \Yii::$app->getUrlManager()->createUrl('game-mode/ajax') ?>',
                                        type: 'POST',
                                        data: {id: this.id},
                                        success: function (result) {
                                            if (result === 'blue') {
                                                $("#" + clickId).css("background", "lightblue");
                                            }
                                            if (result === 'red') {
                                                $("#" + clickId).css("background", "red");
                                            }
                                            if (result === 'black') {
                                                $("#" + clickId).css("background", "black");
                                            }
                                            if (result === 'gray') {
                                                $("#" + clickId).css("background", "gray");
                                                //сохранить изменения в куки или сеанс?
                                            }
                                        }
                                    })
                                })
                            </script>
                        </button>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>


<?php
// location.href = "//codename/views/game/form.php?text=" + this.id;
// $.get('//codename/views/game/func.php', {text: id}, function(data){
//   $.get("http://codename/web/game/sample", {text: id}, function(response){
