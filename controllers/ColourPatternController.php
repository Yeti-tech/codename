<?php

namespace app\controllers;

use app\models\field\Wordfield;
use app\models\pattern\ColourPattern;



class ColourPatternController extends \yii\web\Controller

{

    public function actionNew(): void
    {
        $pattern = new ColourPattern('red', '97979');
        var_dump($pattern);

    }

    public function actionFillWordField()
    {
        $res = Wordfield::find()->All();
        //var_dump($res);
    }
}