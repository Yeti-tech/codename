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
 * @property string $word_value
 * @property string $uni_id
 * @property integer $deactivated
 * @property string $colour_value
 */


class GameCard extends ActiveRecord
{

    public const PATTERN = ['green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'black', 'blue',
        'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
        'gray', 'gray', 'gray', 'gray'];

    private const PATTERN_2 = ['green', 'green', 'green', 'green', 'green', 'green', 'green', 'green', 'black', 'blue',
        'blue', 'blue', 'blue', 'red', 'blue', 'blue', 'blue', 'blue', 'gray', 'gray', 'gray',
        'gray', 'gray', 'gray', 'gray'];

    private $card_id;
    private $card_value;
    private $deactivate;
    private $colour;

    public function __construct(string $card_id, string $card_value, string $colour, int $deactivate = 0, $config = [])
    {
        $this->card_id = $card_id;
        $this->card_value = $card_value;
        $this->colour= $colour;
        $this->deactivate = $deactivate;

        parent::__construct($config);
    }

    public static function fillGameCardTable(array $card_values): array
    {
        shuffle($card_values);

        $colours = self::PATTERN;
        shuffle($colours);

        for ($i = 0; $i < 25; $i++) {
            $card_id = Uuid::uuid4()->toString();
            $game_card = new self ($card_id, $card_values[$i], $colours[$i]);
            $game_card->beforeSave(true);
            $game_card->save();
            $game_cards[] = $game_card;
        }
         return $game_cards;
    }

    protected static function getCardIds(): array
    {
        $card_ids = self::find()->select(['uni_id'])->all();
        return ArrayHelper::getColumn($card_ids, 'uni_id');
    }

    public function deactivate(): void
    {
        $this->setDeactivate(1);
        $this->save();
    }

    public function beforeSave($insert): bool
    {
        $this->uni_id = $this->card_id;
        $this->word_value = $this->card_value;
        $this->deactivated = $this->deactivate;
        $this->colour_value = $this->colour;

        return parent::beforeSave($insert);
    }

    public function afterFind(): void
    {
        $this->card_id = $this->uni_id;
        $this->card_value = $this->word_value;
        $this->deactivate = $this->deactivated;
        $this->colour = $this->colour_value;

        parent::afterFind();
    }

    public function getCardId(): string
    {
        return $this->card_id;
    }

    public function getWord(): string
    {
        return $this->card_value;
    }

    public function getColour(): string
    {
        return $this->colour;
    }

    public function getDeactivate()
    {
        return $this->deactivate;
    }

    public function setDeactivate($int)
    {
        return $this->deactivate = $int;
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
            [['word_value'], 'required'],
            [['word_value'], 'string', 'max' => 250],
            [['colour_value'], 'string', 'max' => 250],
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
            'colour' => 'Colour',
        ];
    }
}
