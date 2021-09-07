<?php

namespace app\controllers;

use app\models\field\Wordfield;
use app\models\field\pattern\ColourPattern;



class ColourPatternController extends \yii\web\Controller

{
    public function actionNew(): void
    {

    }

    public function actionFillWordField()
    {
        $res = Wordfield::find()->All();
        //var_dump($res);
    }
}