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
 * Class User
 *
 * @package Facebook\Api
 */
class User extends Entity
{
    /**
     * Unique Facebook user id
     *
     * @var string
     */
    protected $id;

    /**
     * User name
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
     * User's country code
     *
     * @var string
     */
    protected $country;

    /**
     * User’s phone language. Will be returned according to the device language
     *
     * @see ISO 639-1
     *
     * @var string
     */
    protected $language;

    /**
     * Create user instance from api response array
     *
     * @throws Api\Exception\ApiException
     * @param  array $properties list of properties
     */
    public function __construct($properties)
    {
        if (!is_array($properties) && !$properties instanceof ArrayAccess) {

            $this->thrownException('Properties must be an array or implement ArrayAccess');
        }

        foreach ($properties as $propertyName => $propertyValue) {

            $this->setProperties($propertyName, $propertyValue);
        }
    }

    public function setProperties($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'userhash' => $this->getId(),
            'name' => $this->getName(),
            'country' => $this->getCountry(),
            'language' => $this->getLanguage() ? $this->getLanguage() : 'ru',
        );
    }

    /**
     * Get the value of Unique Facebook user id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of User's Facebook name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

}
