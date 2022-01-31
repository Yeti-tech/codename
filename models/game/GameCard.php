<?php

namespace app\models\game;

use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

class GameCard extends ActiveRecord
{

    private $card_id;
    private $card_value;

    public function __construct(string $card_id, string $card_value, $config = [])
    {
        $this->card_id = $card_id;
        $this->card_value = $card_value;

        parent::__construct($config);
    }

    public static function fillGameCardTable(array $card_values): array
    {
        shuffle($card_values);

        for ($i = 0; $i < 25; $i++) {
            $card_id = Uuid::uuid4()->toString();
            $game_card = new self ($card_id, $card_values[$i]);
            $game_cards[] = $game_card;
        }
         return $game_cards;
    }

    public function getWord(): string
    {
        return $this->card_value;
    }

    public function getCardId(): string
    {
        return $this->card_id;
    }
}
