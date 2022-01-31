<?php

namespace app\controllers;

use app\models\game\GameCard;
use app\models\game\WordCard;


class GameController extends \yii\web\Controller
{

    public function actionGame(): string
    {
        return $this->render('game');
    }

    public function actionShow()
    {
        if (isset($_POST['id'])) {

            $card_values = WordCard::prepareCardValues();
            $game_cards = GameCard::fillGameCardTable($card_values);
            $i = 0;
            foreach ($game_cards as $game_card) {
                $result[$i]['card_value'] = $game_card->getWord();
                $result[$i]['card_id'] = $game_card->getCardId();
                $i++;
            }
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        return $result[] = "Ajax failed";
    }

    public function actionNewWords()
    {
        if (isset($_POST['words'])) {
            WordCard::addNewWords();

         $result[] = "Ajax is good";
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        return $result[] = "Ajax failed";
    }

}






