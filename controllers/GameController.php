<?php

namespace app\controllers;

use app\models\field\Field;
use app\models\field\Game;
use app\models\field\pattern\ColourPattern;

class GameController extends \yii\web\Controller

{
    public function actionPattern(): void
    {
        $array = Game::getPattern();
        ColourPattern::fillPattern($array);
    }

    public function actionGameStart(): void
    {
        Field::gamestart();
    }


    public function actionForm(): string
    {
        $gameCards = Game::find()->all();
        return $this->render('form', [
            'gameCards' => $gameCards,
        ]);
    }

}