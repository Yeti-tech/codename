<?php

/** @var app\models\game\GameCard $game_cards */
/** @var string $word */
/** @var string $card_id */

?>
    <style>
        .button {
            background-color: beige;
            display: flex;
            height:60px;
            width: 100%;
            margin:0 0 20px;
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
            background-color:#cda;
        }
    </style>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <br>
    <br>
    <table class = card_list >

        <?php
        $gameAllCards = array_chunk($game_cards, 5);
        ?>

        <?php
        foreach ($gameAllCards as $gameFiveCards):?>
        <tr>
            <?php foreach ($gameFiveCards as $gameCard): ?>
            <td>
            <button
                    id="<?= $gameCard->id ?>" class="button">
                <?=$gameCard->word?>
                <script>
                    $('.button').click(function () {
                        $.ajax({
                            url: '<?php echo \Yii::$app->getUrlManager()->createUrl('card/ajax') ?>',
                            type: 'POST',
                            data: {test: this.id},
                            success: function (result) {
                                if (result === 'blue') {
                                    alert(result);
                                }
                             }
                    })
                    // alert(result);
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

   /**
     <style type="text/css">

          BODY {
              background: white;  Цвет фона веб-страницы
          }

          TABLE {
              width: 300px;  Ширина таблицы
              border-collapse: collapse;  Убираем двойные линии между ячейками
              border: 2px solid white;  Прячем рамку вокруг таблицы
          }

          TD, TH {
              padding: 3px;  Поля вокруг содержимого таблицы
              border-collapse: collapse;
              text-align: left;  Выравнивание по левому краю
          }
      </style>
 */
