<?php

namespace app\models\game;

use ReflectionClass;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "colourPattern".
 *
 * @property int $id
 * @property string|null $uni_id
 * @property string $colour_value
 */
class ColourPattern extends ActiveRecord
{

    private const PATTERN = ['red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'black', 'blue',
        'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
        'gray', 'gray', 'gray', 'gray'];

    private const PATTERN_2 = ['red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'black', 'blue',
        'blue', 'blue', 'blue', 'red', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
        'gray', 'gray', 'gray', 'gray'];

    private $card_id;
    private $colour;

    public function __construct(string $card_id, string $colour, $config = [])
    {
        $this->card_id = $card_id;
        $this->colour = $colour;
        parent::__construct($config);
    }

    public function beforeSave($insert): bool
    {
        $this->uni_id = $this->card_id;
        $this->colour_value = $this->colour;

        return parent::beforeSave($insert);
    }

    public function afterFind(): void
    {
        $this->card_id = $this->uni_id;
        $this->colour = $this->colour_value;

        parent::afterFind();
    }

    public function getCardId(): string
    {
        return $this->card_id;
    }

    public function getColour(): string
    {
        return $this->colour;
    }


    public static function setColours(array $card_ids): bool
    {

        $colours = self::PATTERN;
        shuffle($colours);

        for ($i = 0; $i <= 25; $i++) {
            $pattern = new ColourPattern($colours[$i], $card_ids[$i]);
            $pattern->beforeSave(true);
            $pattern->save();
        }
        return true;
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



    public static function tableName(): string
    {
        return 'colourPattern';
    }


    public function rules(): array
    {
        return [
            [['colour_value'], 'required'],
            [['colour_value'], 'string', 'max' => 250],
            [['uni_id'], 'string', 'max' => 250],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'colour_value' => 'ColourValue',
            'uni_id' => 'Unique',
        ];
    }
}
