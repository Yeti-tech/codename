<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string|null $blue_cards
 * @property string|null $green_cards
 * @property string|null $current_player
 * @property integer|null $words_number
 * @property string|null $blue_team_name
 * @property string|null $green_team_name
 *
 */
class Game extends \yii\db\ActiveRecord
{

    public static function newGame(): int
    {
        $game = new self();
        $game->words_number = null;
        $game->current_player = 'blue';
        $game->green_cards = '8';
        $game->blue_cards = '9';
        $game->save();
        return $game->id;
    }

    public function collectData($result): array
    {
        $result['winner'] = $this->calculateProgress($result);
        $result['turn'] = $this->defineWhoseTurn($result);
        $result['newTeam'] = $this->defineNewTeam($result);
        $result['number'] = $this->words_number;
        $result['bluename'] = $this->blue_team_name;
        $result['greenname'] = $this->green_team_name;

        return $result;

    }
    public function defineWordsNumber(int $word_number): void
    {
        $this->words_number = $word_number;
        $this->save();
    }

    public function saveTeamNames(array $res)
    {
        $this->blue_team_name = $res[1];
        $this->green_team_name = $res[2];
        $this->save();
    }

    private function defineWhoseTurn(array $result): string
    {
        if ($result['colour'] === $this->current_player && $this->words_number > 1) {
            $this->words_number = --$this->words_number;
            $this->save();
            return $this->current_player;
        }

        if ($result['colour'] !== $this->current_player || $this->words_number === 1) {
            $this->words_number = null;
            if ($this->current_player !== 'green') {
                $this->current_player = 'green';
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

    public function calculateProgress(array $result): string
    {
        if ($result['colour'] === 'blue') {
            $this->blue_cards = --$this->blue_cards;
            if ($this->blue_cards === 0) {
                return 'blue';
            }
        }

        if ($result['colour'] === 'green') {
            $this->green_cards = --$this->green_cards;
            if ($this->green_cards === 0) {
                return 'green';
            }
        }

        if ($result['colour'] === 'black') {
            if ($this->current_player === 'green') {
                return 'blue';
            }
            return 'green';
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
            [['words_number', 'blue_cards', 'green_cards'], 'integer'],
            [['blue_team_name'], 'string', 'max' => 255],
            [['green_team_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'blue_cards' => 'blue cards',
            'green_cards' => 'green cards',
            'current_player' => 'Current Player',
            'words_number' => 'Words Number',
            'blue_team_name' => 'BlueTeamName',
            'green_team_name' => 'GreenTeamName',
        ];
    }
}
