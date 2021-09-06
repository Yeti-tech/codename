<?php


namespace app\models\field;

use app\models\field\AbstractField;
use app\models\field\Wordfield;
use Yii;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string $word
 */
class Game extends Wordfield
{

    private $id;
    private $word;

  //  public function __construct(int $id, string $word, $config = [])
  //  {
   //     $this->id = $id;
    //    $this->word = $word;
    //    parent::__construct($config);
   // }

    public static function getFieldIds() : array
    {
        return self::find()->select(['id'])->All();
    }

    public static function tableName(): string
    {
        return 'game';
    }


    public function rules(): array
    {
        return [
            [['word'], 'required'],
            [['word'], 'string', 'max' => 250],
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
