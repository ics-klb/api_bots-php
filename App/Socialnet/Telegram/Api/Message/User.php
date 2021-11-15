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
 * Class User
 *
 * @package Telegram\Api
 * Text-only message
 */
class User extends Api\Message
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

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::USER;
    }

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'id' => array( 'value' => null, 'type' => 'object',         'handler' => 'setId'),
        'first_name' => array( 'value' => null, 'type' => 'object', 'handler' => 'setName'),
        'last_name' => array( 'value' => null, 'type' => 'object', 'handler' => 'setLastname'),
        'username' => array( 'value' => null, 'type' => 'object',   'handler' => 'setLogin'),
        'language_code' => array( 'value' => null, 'type' => 'object', 'handler' => 'setLanguage')
    );

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'id' => $this->getId(),
            'userhash' => $this->getId(),
            'name' => $this->getName(),
            'first_name' => $this->getName(),
            'last_name' => $this->getLastname(),
            'username' => $this->getName(),

            'country' => $this->getCountry(),
            'language' => $this->getLanguage(),
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
     * Get the value of URL of the user's avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the value of User's country code
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of User’s phone language. Will be returned according to the device language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($value)
    {
        $this->language=$value;
        return $this;
    }


}
