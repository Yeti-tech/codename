<?php

namespace app\models\field;

use app\models\field\Game;
use Yii;

/**
 * This is the model class for table "wordfield".
 *
 * @property int $id
 * @property string $word
 */
class Wordfield extends Field
{

    public function __construct($word, $config = [])
    {
        $this->word = $word;
        parent::__construct($config);
    }


    public static function fill()
    {
        //$res = self::find()->select(['id'])->All();
        $res = self::find()->All();
        var_dump($res);
       // select rand from table, select its value and id, and send it to new(child);
    }

    public function getPattern(): array
    {
        return Game::getFieldIds();
    }


    public static function tableName(): string
    {
        return 'wordfield';
    }


    public function rules(): array
    {
        return [
            [['word'], 'required'],
            [['word'], 'string', 'max' => 250],
            [['word'], 'unique'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
        ];
    }
}
