<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api;

    __autoload('App_Abstract_Socialnet_Event');

/**
 * Class Event
 *
 * @package Facebook\Api
 *
 * General event data
  */
class Event extends \App_Abstract_Socialnet_Event
{
    protected $user;

    /**
     * Facebook page id
     *
     * @var string
     */

    protected $page_id;

    protected $sender = null;

    protected $recipient = null;

    protected $message;

    protected $subscribed = null;

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
_develop($properties);
        foreach ($this->_properties as $propName => $propValue)
        {
_develop('Event tag name: %s', $propName);

            if ($propName == 'message') {

                $this->message = Message\Factory::makeFromApi($propValue);
            } elseif ($propName == 'postback') { // pageid || userid

                $this->message = Message\Factory::makeFromApi($propValue);
            } elseif ($propName == 'recipient') { // pageid || userid

                $this->recipient = new Recipient($propValue);
            } elseif ($propName == 'sender') { // pageid || userid

                $this->sender = new Sender($propValue);
            } else {

                $this->setProperties($propName, $propValue);
            }
        }
        $this-> toInit();
    }

    public function toArray()
    {
        return array(
            'event' => array(
                    'name' => $this->getEvent(),
                    'type' => $this->getType()
            ),
            'user' 	=>  is_object($this->user)  ? $this->getUser()->toArray() : $this->getUser(),
            'user_id'   =>  $this->getUserId(),
            'sender'     => is_object($this->sender) ? $this->getSender() ->toArray() : null,
            'subscribed' => $this->getSubscribed(),
            'timestamp'  => $this->getTimestamp(),
            'message_token' => $this->getMessageToken()
        );
    }

    public function getPageId() {

        return $this->page_id > 0 ? $this->page_id : null;
    }

    public function setPageId($pageid) {

        $this->page_id = (int) $pageid;
        return $this;
    }

    public function initUser() {

        $_userId = 0;
        if ($this->isSender() && $this->isRecipient() )
	{
	   if ( $this->page_id == $this->sender->getId()) {

               $_userId = $this->recipient->getId();
           } else if ( $this->page_id == $this->recipient->getId()) {

            $_userId = $this->sender->getId();
	   }
        } else if ( $this->isSender() ) {

            $_userId = $this->sender->getId();
	}

        $this->user = new User( array( 'id' => $_userId) );

        return $this;
    }

    public function getUser() {

        if ( empty($this->user)) {
            $this->initUser();
        }
        return $this->user;
    }

    /**
     * Get the value of Facebook user id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->getUser()->getId();
    }


    public function isSender()
    {
        return  $this->sender instanceof Sender;
    }
    /**
     * Get the value of Who send message
     *
     * @return App\Socialnet\Facebook\Sender
     */
    public function getSender()
    {
        return $this->isSender() ? $this->sender : new Sender() ;
    }


    public function isRecipient()
    {
        return  $this->recipient instanceof Recipient;
    }

    /**
     * Get the value of To send message
     *
     * @return App\Socialnet\Facebook\Recipient
     */
    public function getRecipient()
    {
        return $this->isRecipient() ? $this->recipient : new Recipient();
    }

    public function isMessage()
    {
        return  is_object($this->message);
    }
    /**
     * Get the value of Message data
     *
     * @return App\Socialnet\Facebook\Api\Message
     */
    public function getMessage()
    {
        return $this->isMessage() ? $this->message : new Message();
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
