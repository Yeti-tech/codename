<?php

namespace app\models\field;

abstract class Field extends \yii\db\ActiveRecord
{

    public static function gamestart(): bool
    {
        $card_values = Wordfield::fillCardValues();
        Game::fillGameTable($card_values);
        return true;
        // foreach($card_values as $word) {
        //   new Game ($word);
        // }
    }

    public function definePattern(): void
    {
        echo 'sth';
    }

    public function resetPattern(): void
    {
        echo 'sth';
    }

    abstract public static function getPattern();

}