<?php

namespace app\models\field;

abstract class Field extends \yii\db\ActiveRecord
{

    public static function gameStart(): bool
    {
        $card_values = WordCard::fillCardValues();
        Game::fillGameTable($card_values);
        return true;
    }

    public function defineColors(): void
    {
        echo 'sth';
    }

    public function resetColors(): void
    {
        echo 'sth';
    }


}