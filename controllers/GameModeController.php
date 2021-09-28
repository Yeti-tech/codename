<?php

namespace app\controllers;

use app\models\game\ColourPattern;
use app\models\game\GameCard;
use app\models\game\GameMode;
use app\models\game\WordCard;


class GameModeController extends \yii\web\Controller

{


    public function actionGame(): string
    {
        $card_ids = GameMode::gameStart();
        $gameReady = ColourPattern::setColours($card_ids);
        if ($gameReady) {
            $game_cards = GameCard::find()->all();
            return $this->render('game', [
                'game_cards' => $game_cards,
            ]);
        }
        return 'Error occurred while preparing the game';
    }

    public function actionWord()
    {
        WordCard::newWordCard('крепость');
    }

    public function actionForm(): string
    {

        $game_cards = GameCard::find()->all();

        return $this->render('form', [
            'game_cards' => $game_cards,
        ]);

    }


    public function actionAjax(): string
    {
        if (isset($_POST['id'])) {

            $card = GameCard::findOne(['id' => $_POST['id']]);
            $card->deactivated = 1;
            $card->save();

            $card = ColourPattern::findOne(['uni_id' => $card->uni_id]);
            $result = $card->getColour();
        } else {
            $result = "Ajax failed";
        }
        return $result;
    }
}