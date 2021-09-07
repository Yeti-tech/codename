<?php

namespace app\models\field;

use app\models\field\pattern\ColourPattern;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string $word
 * @property string $uni_id
 */
class Game extends Field
{

    public function __construct(string $uni_id, string $word, $config = [])
    {
        $this->uni_id = $uni_id;
        $this->word = $word;
        parent::__construct($config);
    }

    public static function fillGameTable($card_values): void
    {
        foreach ($card_values as $card_value) {
            $uni_id = Uuid::uuid4()->toString();
            $gameField = new Game ($uni_id, $card_value);
            $gameField->save();
        }
    }


    public static function getPattern(): void
    {
        $uni_ids = self::find()->select(['uni_id'])->All();
        $uni_ids = ArrayHelper::getColumn($uni_ids, 'uni_id');
        ColourPattern::fillPattern($uni_ids);
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
