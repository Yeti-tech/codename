<?php

namespace app\models\game;


interface GameInterface
{
    /**
     * Returns an array with card values (words or images) to be played in the game
     *
     */
    public static function prepareCardValues();

}
//    * @return array $card_values
