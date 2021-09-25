<?php

namespace app\controllers;

use app\models\field\Game;
use app\models\field\pattern\ColourPattern;


class CardController extends \yii\web\Controller
{
    public function actionAjax()
    {
        if (isset($_POST['test'])) {

           $card = Game::findOne(['id' => $_POST['test']]);
           $card->deactivated = 1;
           $card->save();

           $card = ColourPattern::findOne(['field_id' => $card->uni_id]);
           $result = $card->getFieldColour();
        } else {
            $test = "Ajax failed";
        }
        return $result;
    }
}