<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Message;

use App\Socialnet\Facebook\Api\Objects\Message;

/**
 * Class Factory
 *
 * @package Telegram\Api
 *
 * Message factory
 */
class Factory
{
    /**
     * Make certain message from api-request array
     *
     * @param  array $items api request data
     * @return Api\Message
     */
    public static function makeFromApi(array $data)
    {
        _develop("Api\Message::makeFromApi: %d", __LINE__ );

        return new Message($data);
    }
}
