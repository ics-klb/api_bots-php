<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Message;

use App\Socialnet\Facebook\Api as Api;

/**
 * Class Chat
 *
 * @package Facebook\Api
 * Text-only message
 */
class Text extends Api\Message
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
        'id' => array( 'value' => null, 'type' => 'object',    'handler' => 'setId'),
        'text'          => array( 'value' => null, 'type' => 'string')
    );


    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'id' => $this->getId(),
            'text' => $this->getText()
        ));
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
     * Get the value of User's Facebook name
     *
     * @return string
     */
    public function getName()
    {
        return $this->fistname;
    }

    /**
     * Set the value of User's Facebook name
     *
     * @return string
     */
    public function setName($value)
    {
        $this->fistname = $value;
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
