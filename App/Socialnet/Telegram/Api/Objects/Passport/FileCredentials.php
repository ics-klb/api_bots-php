<?php

namespace App\Socialnet\Telegram\Api\Objects\Passport;

use App\Socialnet\Telegram\Api\Objects\BaseObject;

/**
 * @property string  $fileHash     Checksum of encrypted file
 * @property string  $secret       Secret of encrypted file
 *
 * @link https://core.telegram.org/bots/api#filecredentials
 */
class FileCredentials extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array();
    }
}
