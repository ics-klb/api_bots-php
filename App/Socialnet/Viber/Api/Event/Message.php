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
 * Class Message
 *
 * @package Viber\Api\Event
 *
 * Triggers when user send message
 */
class Message extends Api\Event
{
    protected $type = 'message';

    /**
     * Who send message
     *
     * @var App\Socialnet\Viber\Api\Sender
     */
    protected $sender;

    /**
     * Message data
     *
     * @var App\Socialnet\Viber\Api\Message
     */
    protected $message;

    /**
     * Get the value of Who send message
     *
     * @return App\Socialnet\Viber\Api\Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Get the value of Message data
     *
     * @return App\Socialnet\Viber\Api\Message
     */
    public function getMessage()
    {

        return $this->message;
    }
}
