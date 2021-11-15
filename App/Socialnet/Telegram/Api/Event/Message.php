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
 * Class Message
 *
 * @package Telegram\Api\Event
 *
 * Triggers when user send message
 */
class Message extends Api\Event
{
    protected $type = 'message';

    /**
     * Who send message
     *
     * @var App\Socialnet\Telegram\Api\Sender
     */
    protected $sender;

    /**
     * Message data
     *
     * @var App\Socialnet\Telegram\Api\Message
     */
    protected $message;

}
