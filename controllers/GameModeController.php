<?php

namespace app\controllers;

use app\models\game\ColourPattern;
use app\models\game\GameCard;
use app\models\game\GameMode;

class GameModeController extends \yii\web\Controller

{

    public function actionGame(): string
    {
        $uni_ids = GameMode::gamestart();
        $gameReady = ColourPattern::fillPattern($uni_ids);
        if ($gameReady) {
            $gameCards = GameCard::find()->all();
            return $this->render('game', [
                'gameCards' => $gameCards,
            ]);
        }
        return 'Error occurred while preparing the game';
    }


    public function actionForm(): string
    {
        $gameCards = GameCard::find()->all();
        return $this->render('game', [
            'gameCards' => $gameCards,
        ]);

    }


    public function actionAjax()
    {
        if (isset($_POST['test'])) {

            $card = GameCard::findOne(['id' => $_POST['test']]);
            $card->deactivated = 1;
            $card->save();

            $card = ColourPattern::findOne(['field_id' => $card->uni_id]);
            $result = $card->getFieldColour();
        } else {
            $result = "Ajax failed";
        }
        return $result;
    }
}