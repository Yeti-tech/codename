<?php

namespace app\models\game;

use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

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
    private $colour;

    public function __construct(string $card_id, string $card_value, string $colour, $config = [])
    {
        $this->card_id = $card_id;
        $this->card_value = $card_value;
        $this->colour= $colour;

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
            $game_cards[] = $game_card;
        }
         return $game_cards;
    }

    public function getWord(): string
    {
        return $this->card_value;
    }

    public function getColour(): string
    {
        return $this->colour;
    }

    public function getCardId(): string
    {
        return $this->card_id;
    }
}
