<?php

namespace app\controllers;

use app\models\Game;
use app\models\game\ColourPattern;
use app\models\game\GameCard;
use app\models\game\GameMode;
use app\models\game\WordCard;
use yii\helpers\VarDumper;


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
        //$current_team = Game::getCurrentPlayer();

        return $this->render('form', [
            'game_cards' => $game_cards,
        ]);

    }

    public function actionWordsNumber()
    {
        if (isset($_POST['words_number'])) {

            $game_record = Game::find()->one();
            $game_record->words_number = $_POST['words_number'];
            $game_record->save();
        }
    }

    public function actionAjax()
    {
        if (isset($_POST['id'])) {

            $card = GameCard::findOne(['id' => $_POST['id']]);
            $card->setDeactivate(1);
            $card->save();
            $result['colour']  = $card->getColour($card->getCardId());
            $result['turn'] = Game::defineWhoseTurn($result);

        } else {
            $result[] = "Ajax failed";
        }
        //VarDumper::dump($result);
        return json_encode($result);
    }


    public function actionTest()
    {

        $card = GameCard::findOne(['id' => '390']);
        $result['colour']  = $card->getColour($card->getCardId());
        $result['turn'] = Game::defineWhoseTurn($result);
        $result = json_encode($result);
        VarDumper::dump($result);

    }
}