<?php

namespace app\models\field;

use Ramsey\Uuid\Uuid;
use ReflectionClass;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "wordfield".
 *
 * @property int $id
 * @property string $word
 * @property string $uni_id
 */
class Wordfield extends Field
{
    public function __construct(string $uni_id, string $word, $config = [])
    {
        $this->uni_id = $uni_id;
        $this->word = $word;
        parent::__construct($config);
    }

    public function newWordField($card_value)
    {
        $uni_id = Uuid::uuid4()->toString();
        $newWordField = new Wordfield($uni_id, $card_value);
        $newWordField->save();
    }

    /**
     * 'Instance' and 'Instantiate' allows using static functions of the class without
     * having to call constructor, returns instance of the class
     * @return Wordfield
     */

    public static function instance($refresh = false): self
    {
        return self::instantiate([]);
    }

    public static function getPattern()
    {
       echo 'gh';
    }

    public static function instantiate($row)
    {
        $class = static::class;
        $object = new ReflectionClass($class);
        $object = $object->newInstanceWithoutConstructor();
        $object->init();
        return $object;
    }


    /**
     * Selects 20 random records from table 'wordfield',
     * selects their value and id, and sends it to ancestor for further use in the game;
     * @return array
     */

    public static function fillCardValues(): array
    {
        $cardValues = self::find()->select(['word', 'uni_id'])->All();
        return array_rand(array_flip(ArrayHelper::getColumn
        ($cardValues, 'word')), 25);
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
