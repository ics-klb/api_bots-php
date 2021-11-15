<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Message;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class Chat
 *
 * @package Telegram\Api
 * Text-only message
 */
class Chat extends Api\Message
{
    /**
     * The text of the message
     *
     * @var string
     */
    protected $text;

    protected $id;
    protected $login;
    protected $fistname;
    protected $lastname;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::CHAT;
    }

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'id'         => array( 'value' => null, 'type' => 'object',    'handler' => 'setId'),
        'first_name' => array( 'value' => null, 'type' => 'object',    'handler' => 'setName'),
        'last_name'  => array( 'value' => null, 'type' => 'object',    'handler' => 'setLastname'),
        'username'   => array( 'value' => null, 'type' => 'object',    'handler' => 'setLogin'),
        'title'      => array( 'value' => null, 'type' => 'object',    'handler' => 'setChatTitle'),
        'type'       => array( 'value' => null, 'type' => 'object',    'handler' => 'setChatType'),
        'language_code' => array( 'value' => null, 'type' => 'string')
    );


    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'login' => $this->getName()
        ));
    }
    /**
     * Get the value of Unique Telegram user id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($value)
    {
        $this->login = $value;
        return $this;
    }


    /**
     * Get the value of User's Telegram name
     *
     * @return string
     */
    public function getName()
    {
        return $this->fistname;
    }

    /**
     * Set the value of User's Telegram name
     *
     * @return string
     */
    public function setName($value)
    {
        $this->fistname = $value;
        return $this;
    }

    /**
     * Get the value of User's Telegram name
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of User's Telegram name
     *
     * @return string
     */
    public function setLastname($value)
    {
        $this->lastname = $value;
        return $this;
    }

    /**
     * Set the value of User's Telegram name
     *
     * @return string
     */
    public function getChatTitle($value)
    {
        return $this->title;
    }

    public function setChatTitle($value)
    {
        $this->title = $value;
        return $this;
    }

    public function getChatType()
    {
        return $this->chat_type;
    }

    public function setChatType($value)
    {
        $this->chat_type = $value;
        return $this;
    }
}
