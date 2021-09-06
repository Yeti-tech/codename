<?php

namespace app\models\pattern;


abstract class Pattern extends \yii\db\ActiveRecord
{

    abstract protected static function fillPattern(array $field_ids);

    abstract protected function getElemValue($id);

}