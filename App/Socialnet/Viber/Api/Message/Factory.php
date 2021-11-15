<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Message;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Factory
 *
 * @package Viber\Api
 *
 * Message factory
 */
class Factory
{
    /**
     * Make certain message from api-request array
     *
     * @param  array $data api request data
     * @return Api\Message
     */
    public static function makeFromApi(array $data)
    {

        $_evtType = false;
        if ( isset($data['type']) ) {
            $_evtType = $data['type'];
        }
        $message = null;
        if ( $_evtType ) {

            switch ($_evtType) {
                case Type::TEXT:
                        $message = new Text($data);
                    break;
                case Type::URL:
                        $message = new Url($data);
                    break;
                case Type::PICTURE:
                        $message = new Picture($data);
                    break;
                case Type::CONTACT:
                        $message = new Contact($data);
                    break;
                case Type::VIDEO:
                        $message = new Video($data);
                    break;
                case Type::FILE:
                        $message = new File($data);
                    break;
                case Type::STICKER:
                        $message = new Sticker($data);
                    break;
                case Type::LOCATION:
                        $message = new Location($data);
                    break;
            }
        }

            if ( !is_object($message)) $message = new Error($data);

        return $message;
    }
}
