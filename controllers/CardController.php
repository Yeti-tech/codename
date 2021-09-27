<?php

namespace app\controllers;

use app\models\game\GameCard;
use app\models\game\ColourPattern;


class CardController extends \yii\web\Controller
{

    public function actionAjax()
    {
        if (isset($_POST['test'])) {

           $card = GameCard::findOne(['id' => $_POST['test']]);
           $card->deactivated = 1;
           $card->save();

           $card = ColourPattern::findOne(['uni_id' => $card->uni_id]);
           $result = $card->getColour();
        } else {
            $test = "Ajax failed";
        }
        return $result;
    }
}