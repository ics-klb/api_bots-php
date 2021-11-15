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
 * Class Sender
 *
 * @package Telegram\Api
 */
class Sender extends Entity
{
    /**
     * Telegram User id
     *
     * @var string
     */
    protected $id;

    /**
     * Telegram name
     *
     * @var string
     */
    protected $name;

    /**
     * URL of the user's avatar
     *
     * @var string
     */
    protected $avatar;

    /**
     * {@inheritDoc}
     */
    protected $propertiesMap = array(
        'id' =>      array( 'value' => null, 'type' => 'string',        'handler' => 'setId') ,
        'first_name' =>    array( 'value' => null, 'type' => 'string',  'handler' => 'setName'),
        'username'   =>  array( 'value' => null, 'type' => 'string',    'handler' => 'setAvatar'),
        'country' =>  array( 'value' => null, 'type' => 'string'),
        'language_code' =>  array( 'value' => null, 'type' => 'string',  'handler' => 'setLanguage'),
        'api_version' =>  array( 'value' => null, 'type' => 'string')
    );

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'avatar' => $this->getAvatar(),
            'country' => $this->getCountry(),
            'language' => $this->getLanguage()
        );
    }

    public function getCountry()
    {
        return isset($this->_properties['country']) ? $this->_properties['country'] : null;
    }

    public function getLanguage()
    {
        return isset($this->_properties['language']) ? $this->_properties['language'] : null;
    }

    public function setLanguage($value) {
        $this->_properties['language'] = $value;
    }

    /**
     * Get the value of Telegram User id
     *
     * @return [type]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Telegram User id
     *
     * @param string id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of Telegram name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Telegram name
     *
     * @param string name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set the value of URL of the user's avatar
     *
     * @param string avatar
     *
     * @return self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
}
