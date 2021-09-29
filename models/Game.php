<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string|null $first_player
 * @property string|null $second_player
 * @property string|null $current_player
 * @property integer|null $words_number
 *
 */
class Game extends \yii\db\ActiveRecord
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';

    public const STATUSES = [
        self::STATUS_NEW => 'Добавлена',
        self::STATUS_IN_PROGRESS => 'В работе',
        self::STATUS_COMPLETED => 'Завершена',
    ];


    public static function getWordsNumber():int
    {
        return self::find()->one()->words_number;
    }


    public static function getCurrentPlayer(): string
    {
        $current_team = self::find()->one();
        $current_team = $current_team->current_player;
        if($current_team === 'blue') {
            $current_team = 'ХОД СИНИХ';
        } else {
            $current_team = 'ХОД КРАСНЫХ';
        }
        return $current_team;
    }

    public static function defineWhoseTurn(array $result): string
    {
        $game_record = self::find()->one();
        if ($result['colour'] === $game_record->current_player && $game_record->words_number > 1) {
            $game_record->words_number = --$game_record->words_number;
            $game_record->save();
            return $game_record->current_player;
        }

        if($result['colour'] !== $game_record->current_player|| $game_record->words_number = 1) {
            $game_record->words_number = null;
            if($game_record->current_player !== 'red'){
                $new_team = 'red';
            } else {
                $new_team = 'blue';
            }
            $game_record->current_player = $new_team;
            $game_record->save();
            return $new_team;
        }

        return $game_record->current_player;
    }


    public static function tableName(): string
    {
        return 'game';
    }


    public function rules(): array
    {
        return [
            [['first_player', 'second_player', 'current_player'], 'string', 'max' => 250],
            [['words_number'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_player' => 'First Player',
            'second_player' => 'Second Player',
            'current_player' => 'Current Player',
            'words_number' => 'Words Number',
        ];
    }
}
