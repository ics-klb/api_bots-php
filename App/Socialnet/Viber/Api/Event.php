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
 * Class Event
 *
 * @package Viber\Api
 *
 * General event data
  */
class Event extends \App_Abstract_Socialnet_Event
{
    protected $user;

    /**
     * Viber user id
     *
     * @var string
     */
    protected $user_id;

    protected $sender = null;

    protected $subscribed = null;

    protected $message;

    /**
     * Event type
     *
     * @var string
     */
    protected $event;

    /**
     * Time of the event that triggered the callback
     *
     * @var integer
     */
    protected $timestamp;

    /**
     * Unique ID of the message
     *
     * @var string
     */
    protected $message_token;

    /**
     * Init event from api array
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->_properties = $properties;

        foreach ($this->_properties as $propName => $propValue)
        {
            if ($propName == 'sender') {

                $this->sender = new Sender($propValue);
            } elseif ($propName == 'message') {

                $this->message = Message\Factory::makeFromApi($propValue);
            } elseif ($propName == 'user') {

                $this->user = new User($propValue);
                $this->user_id = $this->user->getId();

            } else {

                $this->setProperties($propName, $propValue);
            }
        }
    }

    public function toArray()
    {
        return array(
            'event' => array(
                    'name' => $this->getEvent(),
                    'type' => $this->getType()
            ),
            'user' =>   is_object($this->user)  ? $this->getUser()->toArray() : $this->getUser(),
            'user_id'   => $this->getUserId(),
            'sender'     => is_object($this->sender) ? $this->getSender() ->toArray() : null,
            'subscribed' => $this->getSubscribed(),
            'timestamp'  => $this->getTimestamp(),
            'message_token' => $this->getMessageToken()
        );
    }

    public function getUser() {
        return $this->user;
    }

    /**
     * Get the value of Viber user id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    public function getSender() {
        return $this->sender;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getSubscribed() {
        return $this->subscribed;
    }

    /**
     * Get the value of Event type
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Alias for getEvent
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->getEvent();
    }

    /**
     * Get the value of Time of the event that triggered the callback
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the value of Unique ID of the message
     *
     * @return string
     */
    public function getMessageToken()
    {
        return $this->message_token;
    }
}
