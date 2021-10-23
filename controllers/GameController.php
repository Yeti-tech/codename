<?php

namespace app\controllers;

use app\models\Game;
use app\models\game\GameCard;
use app\models\game\WordCard;

class GameController extends \yii\web\Controller
{
    public function actionGame(): string
    {
        $card_values = WordCard::prepareCardValues();
        $game_cards = GameCard::fillGameCardTable($card_values);
        $game_id = Game::newGame();

        return $this->render('game', [
            'game_cards' => $game_cards,
            'game_id'  => $game_id,
        ]);
    }

    public function actionBegin(): string
    {
        if (isset($_POST['start'])) {
            $res = json_decode($_POST['start'], true);

            $game_record = Game::find()->where(['id' => $res[0]])->one();
            $game_record->saveTeamNames($res);

            return json_encode($res[1]);
        }
        return 'false';
    }

    public function actionNumber(): string
    {
        if (isset($_POST['number'])) {
            $res = json_decode($_POST['number'], true);

            $game_record = Game::find()->where(['id' => $res[0]])->one();
            $game_record->defineWordsNumber($res[1]);

            return json_encode($res[1]);
        }
        return 'false';
    }


    public function actionCard()
    {
        if (isset($_POST['data'])) {
            $res = json_decode($_POST['data'], true);

            $card = GameCard::find()->where(['id' => $res[1]])->one();
            $card->deactivate();
            $result['colour']  = $card->getColour();


            $game_record = Game::find()->where(['id' => $res[0]])->one();
            $result = $game_record->collectData($result);

        } else {
            $result[] = "Ajax failed";
        }
        return json_encode($result);
    }
}