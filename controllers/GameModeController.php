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
        $game_record = Game::find()->one();
        $result = $game_record->showWhoseTurn($game_record);


            $game_cards = GameCard::find()->all();
            return $this->render('form', [
                'game_cards' => $game_cards,
                'result'  => $result,
            ]);
    }


    public function actionWord(): void
    {
        WordCard::newWordCard('крепость');
    }

    public function actionForm(): string
    {

        $game_cards = GameCard::find()->all();

        return $this->render('game', [
            'game_cards' => $game_cards,

        ]);

    }

    public function actionShow()
    {
       if (isset($_POST['id'])) {
           // $result = GameCard::find()->all();
           $game_cards = GameCard::find()->all();
           $i = 0;
           foreach ($game_cards as $game_card) {

               $result[$i]['card_value'] = $game_card->getWord();
               $result[$i]['colour'] = $game_card->getColour($game_card->getCardId());
               $i++;
           }

           return json_encode($result,JSON_UNESCAPED_UNICODE);
       }
        return $result[] = "Ajax failed";
    }

    public function actionTest()
    {
        $game_cards = GameCard::find()->all();
            $i = 0;
            foreach ($game_cards as $game_card) {

                    $result[$i]['card_value'] = $game_card->getWord();
                    $result[$i]['colour'] = $game_card->getColour($game_card->getCardId());
                    $i++;
                }

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
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
            $result['number'] = $game->words_number;
            $result['bluename'] = $game->blue_team_name;
            $result['redname'] = $game->red_team_name;

        } else {
            $result[] = "Ajax failed";
        }
        return json_encode($result);
    }

    public function actionBlue(): string
    {
        if (isset($_POST['nameBlueTeam'])) {
            $result = $_POST['nameBlueTeam'];
            $game_record = Game::find()->one();
            $game_record->saveBlueTeamName();
            return $result;
        }
       return "Ajax failed";
    }


    public function actionRed(): string
    {
        if (isset($_POST['nameRedTeam'])) {
            $result = $_POST['nameRedTeam'];
            $game_record = Game::find()->one();
            $game_record->saveRedTeamName();
            return $result;
        }
        return "Ajax failed";
    }


    public function actionColours(): string
    {
        $game_cards = GameCard::find()->all();

        return $this->render('colours', [
            'game_cards' => $game_cards,
        ]);
    }

    public function actionBeforeBegin(): string
    {
        GameCard::deleteAll();
        Game::deleteAll();
        ColourPattern::deleteAll();

        $card_ids = GameMode::gameStart();
        ColourPattern::setColours($card_ids);

        return $this->render('start', [
        ]);
    }
}