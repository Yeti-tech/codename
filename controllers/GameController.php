<?php

namespace app\controllers;

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

    public function actionFill()
    {
        $res = Wordfield::find()->All();
       //var_dump($res);
    }
}