<?php

namespace app\models\field\pattern;

use app\models\field\Game;
use app\models\pattern\Pattern;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "colourpattern".
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
    private $uni;


    public function __construct(string $colour, string $id, $config = [])
    {
        $this->fieldColour = $colour;
        $this->uni = $id;
        parent::__construct($config);
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('colour', $this->fieldColour);
        $this->setAttribute('field_id', $this->uni);

        return parent::beforeSave($insert);
    }

    public function getFieldColour(): string
    {
        return $this->fieldColour;
    }

    public function getUni(): string
    {
        return $this->uni;
    }

    public static function fillPattern(array $uni_ids): void
    {

        $colours = self::PATTERN;
        shuffle($colours);

        for ($i = 0; $i <= 25; $i++) {
            $pattern = new ColourPattern($colours[$i], $uni_ids[$i]);
            $pattern->beforeSave(true);
            $pattern->save();
        }
    }


    public static function tableName(): string
    {
        return 'colourpattern';
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

    //   public function beforeSave($insert): bool
    //  {
    //      $this->field_id = $this->getUni();
    //     $this->colour = $this->getTeamcolour();

    //    return parent::beforeSave($insert);
    // }
}
