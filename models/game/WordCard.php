<?php

namespace app\models\game;

use ReflectionClass;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "wordCard".
 *
 * @property int $id
 * @property string $word_value
 */
class WordCard extends ActiveRecord
{
    private $word;

    public function __construct(string $word, $config = [])
    {
        $this->word = $word;
        parent::__construct($config);
        $this->beforeSave(true);
    }

    public static function prepareCardValues(): array
    {
        $card_values = self::find()->select(['word_value', 'id'])->all();
        return array_rand(array_flip(ArrayHelper::getColumn
        ($card_values, 'word_value')), 25);
    }

    public static function addNewWords(): void
    {
        $needle = array("=", "+", "'", "-", ":", ",", ".", "?", ")", "(", "0", "1", "2", "3", "4", "5", "6", "7",
            "8", "9", "!", "@", '"', "#", "%", "№", ";", "^", "&", "*", "-", "`", "~", "{", "}", "'", "\\", "|",
            "/", "<", ">", "[", "]", "\\n", "\\t", "\\n1", "\\n2", "\\n3", "\\n4", "n", "t");

        $newWords = explode(" ", str_replace($needle, " ", $_POST['words']));

        foreach ($newWords as $word) {
            $word = trim($word);
            if ($word !== "" && iconv_strlen($word) <= 11) {
                $wordCard = new self($word);
                $wordCard->save();
            }
        }
    }

    public function beforeSave($insert): bool
    {
        $this->word_value = $this->word;

        return parent::beforeSave($insert);
    }

    public function afterFind(): void
    {
        $this->word = $this->word_value;

        parent::afterFind();
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
        return 'wordCard';
    }

    public function rules(): array
    {
        return [
            [['word_value'], 'required'],
            [['word_value'], 'string', 'max' => 250],
            [['word_value'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'word_value' => 'Word',
        ];
    }

}
