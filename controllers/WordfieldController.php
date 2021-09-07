<?php


namespace app\controllers;

use app\models\field\Field;
use app\models\field\Game;
use app\models\field\Wordfield;
use Ramsey\Uuid\Uuid;


class WordfieldController extends \yii\web\Controller

{

    public function actionFillWordFieldTable()
    {
        //new WordField()
    }

    public function newWordFields($card_value)
    {
        $uni_id = Uuid::uuid4()->toString();
        $newWordField = new Wordfield($uni_id, $card_value);
        $newWordField->save();
    }


    public function actionPattern()
    {
        Game::getPattern();
    }

    public function actionGamestart(): void
    {
        Field::gamestart();
    }
}