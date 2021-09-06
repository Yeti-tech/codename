<?php

namespace app\models\field;

abstract class Field extends \yii\db\ActiveRecord
{

    public function definePattern(): void
    {
        echo 'sth';
    }

    public function resetPattern(): void
    {
        echo 'sth';
    }

    abstract public function getPattern(): array;

}