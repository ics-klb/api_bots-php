<?php

namespace App\Socialnet\Telegram\Api\Objects\Passport;

use App\Socialnet\Telegram\Api\Objects\BaseObject;

/**
 * @property SecureData $secureData   Credentials for encrypted data
 * @property string     $nonce        Bot-specified nonce
 *
 * @link https://core.telegram.org/bots/api#credentials
 */
class Credentials extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'secure_data' => SecureData::class,
        );
    }
}
