<?php


namespace app\models\game;

use app\models\Game;
use yii\db\ActiveRecord;

abstract class GameMode extends ActiveRecord
{

    public static function gameStart(): array
    {
        $card_values = WordCard::prepareCardValues();
        GameCard::fillGameCardTable($card_values);
        $game = new Game();
        $game->words_number = null;
        $game->current_player = 'blue';
        $game->red_cards = '8';
        $game->blue_cards = '9';
        $game->save();
        return GameCard::getCardIds();
    }

    abstract protected static function fillGameCardTable(array $card_values): void;

    abstract protected static function getCardIds(): array;

    abstract public function deactivate();

    //  abstract protected static function resetPattern(): array;

}