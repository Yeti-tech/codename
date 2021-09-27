<?php

namespace app\controllers;

use app\models\Test;
use yii\helpers\VarDumper;

class TestController extends \yii\web\Controller
{

    public function actionTest(): string
    {
      //  Test::createTest();
       // $test = new Test('notAgain');
        //$test->beforeSave(true);
       // $test->save();
       $test = Test::find()->select(['test'])->where(['id' => 5])->one();
       echo $test->uni_id;
       // VarDumper::dump($test);
     //   return $this->render('test', [
      //      'test' => $test,
       // ]);
    }

}