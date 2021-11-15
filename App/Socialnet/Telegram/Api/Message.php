<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api;

/**
 * Class Message
 *
 * @package Telegram\Api
 *
 * General message object
  */
class Message extends Entity
{
    /**
     * Telegram user id
     *
     * @var integer
     */
    protected $receiver;

    /**
     * Message type
     *
     * @var string
     */
    protected $type;

    /**
     * Sender information
     *
     * @var Sender
     */
    protected $sender;

    /**
     * Custom keyboard for message
     *
     * @var Api\Keyboard
     */
    protected $keyboard;

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            'chat_id' => $this->getReceiver(),
            'type'     => $this->getType(),
            'keyboard'        => $this->getKeyboard()
        );
    }

    /**
     * Get the value of Telegram user
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of Telegram user
     *
     * @param string receiver
     *
     * @return self
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of Message type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of Sender information
     *
     * @return Api\Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of Sender information
     *
     * @param Api\Sender sender
     *
     * @return self
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of The text of the message
     *
     * @return string
     */
    public function getText()
    {
        return '';
    }

    /**
     * Get the value of Custom keyboard for message
     *
     * @return Keyboard
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    /**
     * Set the value of Custom keyboard for message
     *
     * @param Keyboard keyboard
     *
     * @return self
     */
    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }
}
