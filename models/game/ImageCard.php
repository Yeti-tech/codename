<?php


namespace app\models\game;

use yii\db\ActiveRecord;

class ImageCard extends ActiveRecord implements GameInterface
{

    /**
     * Selects 25 random records from table 'imageCard' (id and value) and sends it to class Game to be further sent
     * to GameCard table;
     * @return array
     */

    public static function prepareCardValues(): array
    {

    }
}