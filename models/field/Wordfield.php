<?php

namespace app\models\field;

use app\models\field\Game;
use ReflectionClass;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "wordfield".
 *
 * @property int $id
 * @property string $word
 * @property string $uni_id
 */
class Wordfield extends Field
{
    public function __construct($uni_id, $word, $config = [])
    {
        $this->uni_id = $uni_id;
        $this->word = $word;
        parent::__construct($config);
    }

    public static function instance($refresh = false): self
    {
        return self::instantiate([]);
    }

    public static function instantiate($row)
    {
        $class = static::class;
        $object = new ReflectionClass($class);
        $object = $object->newInstanceWithoutConstructor();
        $object->init();
        return $object;
    }


    public static function fill()
    {
        $res = self::find()->select(['uni_id'])->All();
        var_dump($res);
       // $res = self::find()->All();
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
            [['uni_id'], 'string'],
            [['uni_id'], 'required'],
            [['word'], 'unique'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'uni_id' => 'UNI',
        ];
    }

}
