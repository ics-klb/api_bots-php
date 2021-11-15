<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Event;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Factory
 *
 * @package Viber\Api\Event
 *
 * Event factory
 */
class Factory
{
    /**
     * Make some event from api-request array
     *
     * @param  array $data api request data
     * @return Event
     */
    public static function makeFromApi(array $data)
    {
        $event = null;

        if (isset($data['event'])) {
            switch ($data['event']) {
                case Type::MESSAGE:
                        $event = new Message($data);
                    break;
                case Type::SUBSCRIBED:
                        $event = new Subscribed($data);
                    break;
                case Type::CONVERSATION:
                        $event = new Conversation($data);
                    break;
                case Type::UNSUBSCRIBED:
                         $event = new Unsubscribed($data);
                    break;
                case Type::DELIVERED:
                        $event = new Delivered($data);
                    break;
                case Type::SEEN:
                        $event = new Seen($data);
                    break;
                case Type::FAILED:
                        $event = new Failed($data);
                    break;
                case Type::WEBHOOK:
                         $event = new Webhook($data);
                    break;
            }
        } 

        if ( !is_object($event))  $event = new Error($data);
   	
        return $event;
    }
}
