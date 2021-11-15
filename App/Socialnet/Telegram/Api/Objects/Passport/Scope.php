<?php

namespace App\Socialnet\Telegram\Api\Objects\Passport;

use App\Socialnet\Telegram\Api\Objects\BaseObject;

/**
 * @property PassportScopeElement[]  $data            List of requested elements, each type may be used only once in the entire array of PassportScopeElement objects
 * @property int                     $v               Scope version, must be 1
 *
 * @link https://core.telegram.org/bots/api#passportscope
 */
class PassportScope extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
        );
    }
}
