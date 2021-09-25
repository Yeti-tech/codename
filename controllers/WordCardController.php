<?php

namespace app\controllers;

use app\models\game\GameCard;
use app\models\game\WordCard;


class WordCardController extends \yii\web\Controller

{
    public function newWordCard(): void
    {
        WordCard::newWordCard('Корзина');
    }

}