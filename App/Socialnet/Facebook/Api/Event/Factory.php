<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Event;

use App\Socialnet\Facebook\Api as Api;


/**
 * Class Factory
 *
 * @package Facebook\Api\Event
 *
 * Event factory
 */
class Factory
{
    private static function prepareRequest(array &$data) {

        if (isset($data['object'])) {

            $data['event'] = Type::PAGE;
        }
           else {
               $data['event'] = Type::UNKNOW;
           }
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

        switch ($data['event']) {
            case Type::PAGE:
                    $event = new Page($data);
                break;
            case Type::MESSAGE:
                    $event = new Message($data['prepare']);
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

	        case Type::UNKNOW:
            default:
                    $event = new Error($data);
        }

	    return $event;
    }
}
