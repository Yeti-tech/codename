<?php


namespace app\controllers;

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

    public function actionNew(): void
    {
        $uni_id = Uuid::uuid4()->toString();
        if (\Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $word = $request->getBodyParam("word");
            var_dump($word);
           // $artist->number = $param["number"];
        }
        $newWordField = new Wordfield($uni_id, $word);
        var_dump($newWordField);
        $newWordField->save();
    }

    public function actionFill()
    {
        $res = Wordfield::find()->All();
        //var_dump($res);
    }
}