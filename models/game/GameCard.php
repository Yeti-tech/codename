<?php

namespace app\models\game;

use app\models\game\GameMode;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "gameCard".
 *
 * @property int $id
 * @property string $word_value
 * @property string $uni_id
 * @property integer $deactivated
 */
class GameCard extends GameMode
{

    private $card_id;
    private $card_value;
    private $deactivate;

    public function __construct(string $card_id, string $card_value, int $deactivate = 0, $config = [])
    {
        $this->card_id = $card_id;
        $this->card_value = $card_value;
        $this->deactivate = $deactivate;
        parent::__construct($config);
    }

    protected static function fillGameCardTable(array $card_values): void
    {
        foreach ($card_values as $card_value) {
            $card_id = Uuid::uuid4()->toString();
            $game_card = new self ($card_id, $card_value);
            $game_card->beforeSave(true);
            $game_card->save();
        }
    }


    protected static function getCardIds(): array
    {
        $card_ids = self::find()->select(['uni_id'])->all();
        return ArrayHelper::getColumn($card_ids, 'uni_id');
    }


    public function getColour($card_id): string
    {
        $card = ColourPattern::findOne(['uni_id' => $card_id]);
        return $card->getColour();
    }

    public function beforeSave($insert): bool
    {
        $this->uni_id = $this->card_id;
        $this->word_value = $this->card_value;
        $this->deactivated = $this->deactivate;

        return parent::beforeSave($insert);
    }


    public function afterFind(): void
    {
        $this->card_id = $this->uni_id;
        $this->card_value = $this->word_value;
        $this->deactivate = $this->deactivated;

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
