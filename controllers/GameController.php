<?php

namespace app\controllers;

use app\models\field\Field;
use app\models\field\Game;
use app\models\field\Wordfield;
use yii\data\ActiveDataProvider;


class GameController extends \yii\web\Controller

{

    public function actionFillWordFieldTable()
    {
        //new WordField()
    }


    public function actionPattern()
    {
        Game::getPattern();
    }


    public function actionGamestart(): void
    {
        Field::gamestart();
    }

}