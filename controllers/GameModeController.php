<?php

namespace app\controllers;

use app\models\Game;
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

    public function actionWord(): void
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

    public function actionNumber()
    {
        if (isset($_POST['number'])) {
            $game_record = Game::find()->one();
            $game_record->defineWordsNumber();
        }
        return $_POST['number'];
    }

    public function actionAjax()
    {
        if (isset($_POST['id'])) {
            $card = GameCard::findOne(['id' => $_POST['id']]);
            $game = Game::find()->one();
            $card->deactivate();


            $result['colour']  = $card->getColour($card->getCardId());
            $result['winner'] = $game->checkWinner($result);
            $result['turn'] = $game->defineWhoseTurn($result);
            $result['newTeam'] = $game->defineNewTeam($result);

        } else {
            $result[] = "Ajax failed";
        }
        return json_encode($result);
    }

    public function actionColours()
    {
        $game_cards = GameCard::find()->all();

        return $this->render('colours', [
            'game_cards' => $game_cards,
        ]);
    }

}