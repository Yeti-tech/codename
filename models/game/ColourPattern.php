<?php

namespace app\models\game;

use ReflectionClass;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "colourPattern".
 *
 * @property int $id
 * @property string $colour
 * @property string|null $field_id
 */
class ColourPattern extends ActiveRecord
{

    private const PATTERN = ['red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'black', 'blue',
        'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
        'gray', 'gray', 'gray', 'gray'];

    private const PATTERN_2 = ['red', 'red', 'red', 'red', 'red', 'red', 'red', 'red', 'black', 'blue',
        'blue', 'blue', 'blue', 'red', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
        'gray', 'gray', 'gray', 'gray'];


    private $fieldColour;
    private $uni_id;

    public function __construct(string $colour, string $id, $config = [])
    {
        $this->fieldColour = $colour;
        $this->uni_id = $id;
        parent::__construct($config);
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('colour', $this->fieldColour);
        $this->setAttribute('field_id', $this->uni_id);

        return parent::beforeSave($insert);
    }

    public function afterFind(): void
    {
        $this->fieldColour = $this->colour;
        $this->uni_id = $this->field_id;

        parent::afterFind();
    }

    public function getFieldColour(): string
    {
        return $this->fieldColour;
    }

    public function getUniId(): string
    {
        return $this->uni_id;
    }


    public static function fillPattern(array $uni_ids): bool
    {

        $colours = self::PATTERN;
        shuffle($colours);

        for ($i = 0; $i <= 25; $i++) {
            $pattern = new ColourPattern($colours[$i], $uni_ids[$i]);
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
            [['colour'], 'required'],
            [['colour'], 'string', 'max' => 250],
            [['field_id'], 'string', 'max' => 250],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'colour' => 'Colour',
            'field_id' => 'Field ID',
        ];
    }
}
