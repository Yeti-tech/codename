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
 * @property string $word_value
 * @property string $field_id
 */
class WordCard extends ActiveRecord implements GameInterface
{

    private $uni_id;
    private $word;

    public function __construct(string $uni_id, string $word, $config = [])
    {
        $this->uni_id = $uni_id;
        $this->word = $word;
        parent::__construct($config);
    }


    public static function newWordCard($card_value): void
    {
        $uni_id = Uuid::uuid4()->toString();
        $newWordCard = new WordCard($uni_id, $card_value);
        $newWordCard->save();
    }


    /**
     * Selects 25 random records from table 'wordCard' (unique id and value) and sends it to class Game
     * to be further sent to gameCard table;
     * @return array
     */

    public static function prepareCardValues(): array
    {
        $cardValues = self::find()->select(['word', 'uni_id'])->all();
        return array_rand(array_flip(ArrayHelper::getColumn
        ($cardValues, 'word')), 25);
    }


    public function beforeSave($insert): bool
    {
        $this->setAttribute('field_id', $this->uni_id);
        $this->setAttribute('word_value', $this->word);

        return parent::beforeSave($insert);
    }

    public function afterFind(): void
    {
        $this->uni_id = $this->field_id;
        $this->word = $this->word_value;

        parent::afterFind();
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
            [['field_id'], 'string'],
            [['field_id'], 'required'],
            [['word_value'], 'unique'],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word_value' => 'Word',
            'field_id' => 'UNIQUE',
        ];
    }

}
