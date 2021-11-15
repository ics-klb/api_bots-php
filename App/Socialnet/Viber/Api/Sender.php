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
 * Class Sender
 *
 * @package Viber\Api
 */
class Sender extends Entity
{
    /**
     * Viber User id
     *
     * @var string
     */
    protected $id;

    /**
     * Viber name
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
        'id' =>      array( 'value' => null, 'type' => 'string',    'handler' => 'setId') ,
        'name' =>    array( 'value' => null, 'type' => 'string',    'handler' => 'setName'),
        'avatar' =>  array( 'value' => null, 'type' => 'string',    'handler' => 'setAvatar'),
        'country' =>  array( 'value' => null, 'type' => 'string'    ),
        'language' =>  array( 'value' => null, 'type' => 'string'    ),
        'api_version' =>  array( 'value' => null, 'type' => 'string' )
    );

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'userhash' => $this->getId(),

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

    /**
     * Get the value of Viber User id
     *
     * @return [type]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Viber User id
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
     * Get the value of Viber name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Viber name
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
