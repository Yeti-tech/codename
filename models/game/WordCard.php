<?php

namespace app\models\game;

use Ramsey\Uuid\Uuid;
use ReflectionClass;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "wordCard".
 *
 * @property int $id
 * @property string $uni_id
 * @property string $word_value
 */
class WordCard extends ActiveRecord implements GameInterface
{

    private $card_id;
    private $word;

    public function __construct(string $card_id, string $word, $config = [])
    {
        $this->card_id = $card_id;
        $this->word = $word;
        parent::__construct($config);
    }


    public static function newWordCard($card_value): void
    {
        $card_id = Uuid::uuid4()->toString();
        $newWordCard = new WordCard($card_id, $card_value);
        $newWordCard->save();
    }



    public static function prepareCardValues(): array
    {
        $card_values = self::find()->select(['word', 'uni_id'])->all();
        return array_rand(array_flip(ArrayHelper::getColumn
        ($card_values, 'word')), 25);
    }


    public function beforeSave($insert): bool
    {
        $this->uni_id = $this->card_id;
        $this->word_value = $this->word;

        return parent::beforeSave($insert);
    }

    public function afterFind(): void
    {
        $this->card_id = $this->uni_id;
        $this->word = $this->word_value;

        parent::afterFind();
    }


    public function getCardId(): string
    {
        return $this->card_id;
    }


    public function getWord(): string
    {
        return $this->word;
    }


    /**
     * 'Instance' and 'Instantiate' allows using static functions of the class without
     * having to call constructor, returns instance of the class
     * @param bool $refresh
     * @return WordCard
     */
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
        return 'wordCard';
    }


    public function rules(): array
    {
        return [
            [['word_value'], 'required'],
            [['word_value'], 'string', 'max' => 250],
            [['uni_id'], 'string'],
            [['uni_id'], 'required'],
            [['word_value'], 'unique'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word_value' => 'Word',
            'uni_id' => 'UNIQUE',
        ];
    }

}
