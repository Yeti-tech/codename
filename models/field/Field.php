<?php

namespace app\models\field;

abstract class Field extends \yii\db\ActiveRecord
{

    public $firstTeam;
    public $secondTeam;

    public static function gameStart(): bool
    {
        $card_values = Wordfield::fillCardValues();
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