<?php

namespace App\Socialnet\Telegram\Api\Objects;

/**
 * Class PollOption.
 *
 *
 * @property string $text           Option text, 1-100 characters
 * @property int    $voterCount     Number of users that voted for this option
 */
class PollOption extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array();
    }
}
