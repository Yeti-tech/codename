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

    public function actionNew(): void
    {
        $newWordField = new Wordfield('fire');
        var_dump($newWordField);
        $newWordField->save();
    }

    public function actionFillWordField()
    {
        $res = Wordfield::find()->All();
       //var_dump($res);
    }

   // public function actionGamestart(): void
   // {
   //     Field::gamestart();
   // }

    public function actionGet (): void
    {
        Game::getPattern();
    }
}