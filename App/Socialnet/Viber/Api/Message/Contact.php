<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Message;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Contact
 *
 * @package Viber\Api
 *
 * Contact as message
 */
class Contact extends Api\Message
{
    /**
     * Name of the contact. Max 28 characters.
     *
     * @var string
     */
    protected $name;
    /**
     * Phone number of the contact. Max 18 characters
     *
     * @var string
     */
    protected $phone_number;
    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'contact' => array( 'value' => null, 'type' => 'array',    'handler' => 'setConcat'),
    );
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::CONTACT;
    }
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'contact' => array(
                'name' => $this->getName(),
                'phone_number' => $this->getPhoneNumber()
            )
        ));
    }

    /**
     * Get the value of Name of the contact. Max 28 characters.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name of the contact. Max 28 characters.
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
     * Get the value of Phone number of the contact. Max 18 characters
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set the value of Phone number of the contact. Max 18 characters
     *
     * @param string phone_number
     *
     * @return self
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * Set the value of Phone number of the contact from contact array.
     *
     * @param array contact
     *
     * @return self
     */
    public function setConcat($contact)
    {
        $this->phone_number = isset($contact['phone']) ? $contact['phone'] : $contact['phone_number'];

        return $this;
    }
}
