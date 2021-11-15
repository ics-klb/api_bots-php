<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api;

/**
 * Class Message
 *
 * @package Viber\Api
 *
 * General message object
  */
class Message extends Entity
{
    /**
     * Viber user id
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
     * Track messages and user’s replies. Passed back with user’s reply
     *
     * @var string
     */
    protected $tracking_data;

    /**
     * API version required by clients
     *
     * @var integer
     */
    protected $min_api_version = 1;

    /**
     * Custom keyboard for message
     *
     * @var Api\Keyboard
     */
    protected $keyboard;

    /**
     * The text of the message
     *
     * @var string
     */
    protected $text;

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            'receiver' => $this->getReceiver(),
            'type'     => $this->getType(),
            'sender'   => $this->getSender(),
            'keyboard'        => $this->getKeyboard(),
            'tracking_data'   => $this->getTrackingData(),
            'min_api_version' => $this->getMinApiVersion()
        );
    }

    /**
     * Get the value of Viber user
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of Viber user
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
     * Get the value of Track messages and user’s replies. Passed back with user’s reply
     *
     * @return string
     */
    public function getTrackingData()
    {
        return $this->tracking_data;
    }

    /**
     * Set the value of Track messages and user’s replies. Passed back with user’s reply
     *
     * @param string tracking_data
     *
     * @return self
     */
    public function setTrackingData($tracking_data)
    {
        $this->tracking_data = $tracking_data;

        return $this;
    }

    /**
     * Get the value of API version required by clients
     *
     * @return integer
     */
    public function getMinApiVersion()
    {
        return $this->min_api_version;
    }

    /**
     * Set the value of API version required by clients
     *
     * @param integer min_api_version
     *
     * @return self
     */
    public function setMinApiVersion($min_api_version)
    {
        $this->min_api_version = $min_api_version;

        return $this;
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

    /**
     * Get the value of The text of the message
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of The text of the message
     *
     * @param string text
     *
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
