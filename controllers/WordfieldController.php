<?php


namespace app\controllers;

use app\models\field\Field;
use app\models\field\Wordfield;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\data\ActiveDataProvider;


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


    public function actionFill()
    {

        $res = Wordfield::fillgame();
        echo '<pre>';
        var_dump($res);
        echo '</pre>';
    }

    public function actionGamestart(): void
    {
        Field::gamestart();
    }
}