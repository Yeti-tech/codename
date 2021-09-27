<?php

namespace app\models;

use ReflectionClass;
use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "testTable".
 *
 * @property int $id
 * @property string $test
 */
class Test extends \yii\db\ActiveRecord
{
    private $privateTest;

    public function __construct(string $privateTest, $config = [])
    {
        $this->privateTest = $privateTest;
        parent::__construct($config);
    }


    public static function createTest(): void
    {
        $private = new Test('anyString');
        $private->beforeSave(true);
        $private->save();
        //$test = Test::find()->select(['test'])->all();
        VarDumper::dump($private);
    }

    public function getUni_id(): string
    {
        return $this->privateTest;
    }

    public static function testPrivate(): string
    {
        return self::find()->select(['test'])->one()->privateTest;
        //       return $this->privateTest;
    }


    public function beforeSave($insert): bool
    {
        $this->test = $this->privateTest;
        return parent::beforeSave($insert);
    }


    public function afterFind(): void
    {
        $this->privateTest = $this->test;
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
        return 'testTable';
    }


    public function rules(): array
    {
        return [
            [['test'], 'string', 'max' => 250],
            [['test'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'test' => 'Test',
        ];
    }
}
