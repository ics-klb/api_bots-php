<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Message;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class Text
 *
 * @package Telegram\Api
 * Text-only message
 */
class Text extends Api\Message
{
    protected $message_id;
    /**
     * The text of the message
     *
     * @var string
     */
    protected $text;

    protected $chat;

    protected $user;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'text' => array( 'value' => null, 'type' => 'object',    'handler' => 'setText'),
        'from' => array( 'value' => null, 'type' => 'object',    'handler' => 'setUser'),
        'chat' => array( 'value' => null, 'type' => 'object',    'handler' => 'setChat'),
        'forward_from' => array( 'value' => null, 'type' => 'object',    'handler' => 'setUser'),
        'reply_to_message' => array( 'value' => null, 'type' => 'object',    'handler' => 'setMessage'),
    );

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::TEXT;
    }

    public function getChat(){

        return $this->chat;
    }
    public function setChat($items){
;
        $this->chat = new Chat($items);
        return $this;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($items){

        $this->user = new User($items);
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'text' => $this->getText()
        ));
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
