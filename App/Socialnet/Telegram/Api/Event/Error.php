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
 * Class Error
 *
 * @package Telegram\Api\Event
 *
 * Triggers if a message has reached the client but failed any of
 * the client validations.
 */
class Error extends Api\Event
{
    /**
     * Telegram user id
     *
     * @var string
     */
    protected $user_id;
    /**
     * Message data
     *
     * @var error message
     */
    protected $message;

    public function toArray()
    {
        return array_merge(parent::toArray(), $this->_properties);
    }

    /**
     * Get the value of Event type
     *
     * @return string
     */
    public function getEvent()
    {
        return Type::ERROR;
    }

    /**
     * Get the value of Message data
     *
     * @return Api\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}


