<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Event;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class Factory
 *
 * @package Telegram\Api\Event
 *
 * Event factory
 */
class Factory
{
    private static function prepareRequest(array &$data) {

        if (isset($data['message'])) {
            $data['event'] = Type::MESSAGE;
            $data['message']['type']  = isset($data['message']['text']) ? Api\Message\Type::TEXT : Api\Message\Type::UNKNOW;
        }
            else $data['event'] = Type::UNKNOW;
    }
    /**
     * Make some event from api-request array
     *
     * @param  array $data api request data
     * @return Event
     */
    public static function makeFromApi(array $data)
    {
        $event = null;

        static::prepareRequest($data);

        if (isset($data['event']))
        {
            switch ($data['event'])
            {
                case Type::MESSAGE:
                        $event = new Message($data);
                    break;
                case Type::WEBHOOK:
                        $event = new Webhook($data);
                    break;
                case Type::SUBSCRIBED:
                        $event = new Subscribed($data);
                    break;
                case Type::UNSUBSCRIBED:
                        $event = new Unsubscribed($data);
                    break;
                case Type::FAILED:
                        $event = new Failed($data);
                    break;
            }
        } 

        if ( !is_object($event))  $event = new Error($data);

	    return $event;
    }
}
