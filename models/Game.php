<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string|null $blue_cards
 * @property string|null $red_cards
 * @property string|null $current_player
 * @property integer|null $words_number
 * @property string|null $blue_team_name
 * @property string|null $red_team_name
 *
 */
class Game extends \yii\db\ActiveRecord
{

    public static function getWordsNumber(): int
    {
        return self::find()->one()->words_number;
    }


    public function defineWordsNumber(): void
    {
        $this->words_number = $_POST['number'];
        $this->save();
    }

    public function saveBlueTeamName()
    {
        $this->blue_team_name = $_POST['nameBlueTeam'];
        $this->save();
    }

    public function saveRedTeamName()
    {
        $this->red_team_name = $_POST['nameRedTeam'];
        $this->save();
    }


    public function defineWhoseTurn(array $result): string
    {
        if ($result['colour'] === $this->current_player && $this->words_number > 1) {
            $this->words_number = --$this->words_number;
            $this->save();
            return $this->current_player;
        }

        if ($result['colour'] !== $this->current_player || $this->words_number = 1) {
            $this->words_number = null;
            if ($this->current_player !== 'red') {
                $this->current_player = 'red';
            } else {
                $this->current_player = 'blue';
            }
            $this->save();
        }

        return $this->current_player;
    }

    public function defineNewTeam(array $result): string
    {
        if ($result['colour'] === $this->current_player && $this->words_number >= 1) {
            return 'false';
        }
        return 'true';
    }

    public function checkWinner(array $result): string
    {
        if ($result['colour'] === 'blue') {
            $this->blue_cards = --$this->blue_cards;
            if ($this->blue_cards === 0) {
                return 'blue won';
            }
        }

        if ($result['colour'] === 'red') {
            $this->red_cards = --$this->red_cards;
            if ($this->red_cards === 0) {
                return 'red';
            }
        }

        if ($result['colour'] === 'black') {
            if ($this->current_player === 'red') {
                return 'blue';
            }
            return 'red';
        }
        $this->save();
        return false;
    }


    public static function tableName(): string
    {
        return 'game';
    }


    public function rules(): array
    {
        return [
            [['current_player'], 'string', 'max' => 250],
            [['words_number', 'blue_cards', 'red_cards'], 'integer'],
            [['blue_team_name'], 'string', 'max' => 255],
            [['red_team_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'blue_cards' => 'blue cards',
            'red_cards' => 'red cards',
            'current_player' => 'Current Player',
            'words_number' => 'Words Number',
            'blue_team_name' => 'BlueTeamName',
            'red_team_name' => 'RedTeamName',
        ];
    }
}
