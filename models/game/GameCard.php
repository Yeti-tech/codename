<?php

namespace app\models\game;

use Ramsey\Uuid\Uuid;
use ReflectionClass;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "gameCard".
 *
 * @property int $id
 * @property string $word
 * @property string $uni_id
 * @property integer $deactivated
 */

class GameCard extends GameMode
{

    public function __construct(string $uni_id, string $word, $config = [])
    {
        $this->uni_id = $uni_id;
        $this->word = $word;
        parent::__construct($config);
    }


    protected static function fillGameCardTable($card_values): void
    {
        foreach ($card_values as $card_value) {
            $card_id = Uuid::uuid4()->toString();
            $game_card = new self ($card_id, $card_value);
            $game_card->save();
        }
    }


    protected static function getCardIds(): array
    {
        $card_ids = self::find()->select(['uni_id'])->all();
        return ArrayHelper::getColumn($card_ids, 'uni_id');
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
            [['uni_id'], 'string', 'max' => 255],
            [['deactivated'], 'integer'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'uni_id' => 'Unique',
            'deactivated' => 'Deactivated',
        ];
    }

}
