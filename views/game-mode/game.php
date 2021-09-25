<?php

/** @var app\models\game\GameCard $gameCards */
/** @var string $word */
/** @var string $uni_id */

?>

    <style>
        .button {
            background-color: red;
        }

        .black {
            color: black
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">

    </script>

    <table>

<?php

foreach ($gameCards as $gameCard) {
    ?>
        <tr>
        <button
                id="<?= $gameCard->id ?>" class="button">
            <script>

                $('.button').click(function () {
                    color = this.id;
                    $.ajax({
                        url: '<?php echo \Yii::$app->getUrlManager()->createUrl('card/ajax') ?>',
                        type: 'POST',
                        data: {test: this.id},
                        success: function (result) {
                            if (result === 'blue') {
                                $('#21').css('background-color', 'green');
                                });
                            }
                        );
                    }
                }
                ;
                // alert(result);
                })
                })
                ;
            </script>
        <tr>
            <?php

            echo $gameCard->word;
            ?>
        </tr>
        </button>

        </table>
    <?php
}






// location.href = "//codename/views/game/form.php?text=" + this.id;
// $.get('//codename/views/game/func.php', {text: id}, function(data){
//   $.get("http://codename/web/game/sample", {text: id}, function(response){