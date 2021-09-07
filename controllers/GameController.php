<?php

namespace app\controllers;

use app\models\field\Field;
use app\models\field\Game;
use app\models\field\pattern\ColourPattern;
use app\models\field\Wordfield;


class GameController extends \yii\web\Controller

{

    public function actionPattern()
    {
       $array = Game::getPattern();
       ColourPattern::fillPattern($array, $player);
    }


    public function actionGameStart(): void
    {
        Field::gamestart();
    }

}