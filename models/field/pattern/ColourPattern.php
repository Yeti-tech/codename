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

    private const PATTERN = ['red', 'black', 'blue'];
    private $teamcolour;
    private $uni;

    public function __construct(string $colour, $id, $config = [])
    {
        $this->teamcolour = $colour;
        $this->uni = $id;
        parent::__construct($config);
    }

 //   public function beforeSave($insert): bool
  //  {
  //      $this->field_id = $this->getUni();
   //     $this->colour = $this->getTeamcolour();

    //    return parent::beforeSave($insert);
   // }

     public function beforeSave($insert): bool
     {
       $this->setAttribute('colour', $this->teamcolour);
       $this->setAttribute('field_id', $this->uni);

       return parent::beforeSave($insert);
      }

    public function getTeamcolour(): string
    {
        return $this->teamcolour;
    }

    public function getUni(): string
    {
        return $this->uni;
    }

    public static function newColourField($colour, $uni_id)
    {
        $pattern = new ColourPattern($colour, 'another_stroka');
        $pattern->beforeSave(true);
        $pattern->save();
    }

    public static function fillPattern(array $uni_ids): void
    {
        echo '<pre>';
        var_dump($uni_ids);
        echo '</pre>';
        //$i = 0;
       // while ($i < 20)
        // {
       // foreach($uni_ids as $id) {
        //    $pattern = new ColourPattern(self::PATTERN[$i], $uni_ids[$i]);
          //  $pattern->beforeSave(true);
          //  $pattern->save();
         //   $i++;
       // }
    }


    public function getElemValue($id)
    {
        echo 'fff';
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
}
