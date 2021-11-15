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

/**
 * Class Message
 *
 * @package Facebook\Api
 *
 * General message object
  */
class Message extends Entity
{
    /**
     * Messaging types //https://developers.facebook.com/docs/messenger-platform/send-messages#messaging_types
     */
    const TYPE_RESPONSE = "RESPONSE";
    const TYPE_UPDATE   = "UPDATE";
    const TYPE_MESSAGE_TAG = "MESSAGE_TAG";

    /**
     * Tag types // https://developers.facebook.com/docs/messenger-platform/send-messages/message-tags
     */
    const TAG_SHIPPING_UPDATE = "SHIPPING_UPDATE";
    const TAG_RESERVATION_UPDATE = "RESERVATION_UPDATE";
    const TAG_ISSUE_RESOLUTION = "ISSUE_RESOLUTION";
    const TAG_ACCOUNT_UPDATE = "ACCOUNT_UPDATE";
    const TAG_PAYMENT_UPDATE = "PAYMENT_UPDATE";
    const TAG_PERSONAL_FINANCE_UPDATE = "PERSONAL_FINANCE_UPDATE";
    const TAG_PAIRING_UPDATE = "PAIRING_UPDATE";
    const TAG_APPLICATION_UPDATE = "APPLICATION_UPDATE";
    const TAG_APPOINTMENT_UPDATE = "APPOINTMENT_UPDATE";
    const TAG_FEATURE_FUNCTIONALITY_UPDATE = "FEATURE_FUNCTIONALITY_UPDATE";
    const TAG_GAME_EVENT = "GAME_EVENT";
    const TAG_TRANSPORTATION_UPDATE = "TRANSPORTATION_UPDATE";
    const TAG_TICKET_UPDATE = "TICKET_UPDATE";
    const TAG_NON_PROMOTIONAL_SUBSCRIPTION = "NON_PROMOTIONAL_SUBSCRIPTION";

    /**
     * Notification types
     */
    const NOTIFY_REGULAR = "REGULAR";
    const NOTIFY_SILENT_PUSH = "SILENT_PUSH";
    const NOTIFY_NO_PUSH = "NO_PUSH";

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
     * @var null|string
     */
    protected $recipient = null;

    /**
     * @var null|string
     */
    protected $text = null;

    /**
     * @var bool
     */
    protected $user_ref = false;

    /**
     * @var null|string
     */
    protected $tag = null;

    /**
     * @var null|string
     */
    protected $notification_type = null;

    /**
     * @var null|string
     */
    protected $messaging_type = null;

    /**
     * @var null|array
     */
    protected $quick_replies = null;


    protected function toInit()
    {

//        $this->tag   = static::TAG_ACCOUNT_UPDATE;

        $this->messaging_type = static::TYPE_RESPONSE;

        $this->notification_type = static::NOTIFY_REGULAR;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        $_result = array(
            'recipient' => array(
  		        'id' => $this->getReceiver()
	        ),
            'message' => array(
                'text' => $this->getText()
            )
        );

        // Signature matching
        // $expected_signature = hash_hmac('sha1', $raw_post_data, $appsecret);

        if ($this->tag) 
            $_result['tag'] = $this->tag;

        $_result['messaging_type']   = $this->messaging_type;

//        $_result['notification_type'] = $this->notification_type;

        return $_result;
    }

    /**
     * Get the value of Facebook user
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->recipient;
    }

    /**
     * Set the value of Facebook user
     *
     * @param string recipient
     *
     * @return self
     */
    public function setReceiver($receiver)
    {
        $this->recipient = $receiver;

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
        return $this->text;
    }

    public function setText($value)
    {
        $this->text = $value;

        return $this;
    }
}
