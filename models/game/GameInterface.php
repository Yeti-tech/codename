<?php

namespace app\models\game;


interface GameInterface
{
    /**
     * Returns an array with card values (words or images) to be played in the game
     * @return array $card_values
     */
    public static function prepareCardValues(): array;

}
//    * @return array $card_values
