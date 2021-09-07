<?php

namespace app\models\pattern;

use app\models\field\Game;
use Yii;

/**
 * This is the model class for table "pattern".
 *
 * @property int $id
 * @property string $colour
 * @property int|null $field_id
 */
class ColourPattern extends Pattern
{

    private const PATTERN = ['red', 'black', 'blue'];


    public function __construct(string $colour, $id, $config = [])
    {
        $this->colour = $colour;
        $this->field_id = $id;
        parent::__construct($config);
    }


    public static function fillPattern(array $field_ids): array
    {
        $i = 0;
        while($i<20) {
            $colour = new ColourPattern(self::PATTERN[$i], $field_ids[$i]);
            $colour->save();
            $i++;
        }
    }


    public function getElemValue($id)
    {
        echo 'fff';
    }


    public static function tableName(): string
{
    return 'pattern';
}


    public function rules(): array
    {
        return [
            [['colour'], 'required'],
            [['field_id'], 'integer'],
            [['colour'], 'string', 'max' => 250],
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
