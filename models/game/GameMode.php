<?php


namespace app\models\game;

use yii\db\ActiveRecord;

abstract class GameMode extends ActiveRecord
{

    public static function gameStart(): array
    {
        $card_values = GameInterface::prepareCardValues();

        return $card_values->fillGameCardTable($card_values)->getUniIds();

    }


    abstract protected function fillGameCardTable(array $card_values): void;

    abstract protected function getUniIds(): array;

    //  abstract protected static function resetPattern(): array;

}