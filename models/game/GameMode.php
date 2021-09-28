<?php


namespace app\models\game;

use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

abstract class GameMode extends ActiveRecord
{

    public static function gameStart(): array
    {
        $card_values = WordCard::prepareCardValues();
       // VarDumper::dump ($card_values);
        GameCard::fillGameCardTable($card_values);
        return GameCard::getCardIds();
    }


    abstract protected static function fillGameCardTable(array $card_values): void;

    abstract protected static function getCardIds(): array;

    //  abstract protected static function resetPattern(): array;

}