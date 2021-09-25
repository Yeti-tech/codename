<?php

namespace app\models\game;

use Ramsey\Uuid\Uuid;
use ReflectionClass;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "gameCard".
 *
 * @property int $id
 * @property string $word
 * @property string $uni_id
 * @property string $deactivated
 */

class GameCard extends GameMode
{


    public function __construct(string $uni_id, string $word, $config = [])
    {
        $this->uni_id = $uni_id;
        $this->word = $word;
        parent::__construct($config);
    }


    protected function fillGameCardTable($card_values): void
    {
        foreach ($card_values as $card_value) {
            $uni_id = Uuid::uuid4()->toString();
            $gameCard = new self ($uni_id, $card_value);
            $gameCard->save();
        }
    }


    protected function getUniIds(): array
    {
        $uni_ids = self::find()->select(['uni_id'])->all();
        return ArrayHelper::getColumn($uni_ids, 'uni_id');
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
        return 'gameCard';
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
