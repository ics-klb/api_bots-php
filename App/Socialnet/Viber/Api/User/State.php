<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\User;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Event
 *
 * @package Viber\Api
 *
 * Represent user state: online, offline, unsubscribed, hidden
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class State extends Api\Entity
{
    /**
     * Available status
     *
     * @var integer
     */
    const ONLINE = 0;
    const OFFLINE = 1;
    const UNDISCLOSED = 2;
    const ERROR = 3;
    const UNAVAILABLE = 4;

    /**
     * Viber user id
     * @var integer
     */
    protected $id;

    /**
     * User status
     * @var integer
     */
    protected $status;

    /**
     * Status description
     * @var string
     */
    protected $message;

    /**
     * {@inheritDoc}
     */
    protected $propertiesMap = array(
        'id' =>            array( 'value' => null, 'type' => 'string',    'handler' => 'setId'),
        'online_status' => array( 'value' => null, 'type' => 'string',    'handler' => 'setStatus'),
        'online_status_message' => array( 'value' => null, 'type' => 'string',    'handler' => 'setMessage')
    );

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'online_status' => $this->getStatus(),
            'online_status_message' => $this->getMessage()
        );
    }

    /**
     * Get the value of Viber user id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Viber user id
     *
     * @param integer id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Status code
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of Status code
     *
     * @param integer status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of Status description
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of Status description
     *
     * @param string message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Is user online?
     *
     * @return boolean
     */
    public function isOnline()
    {
        return $this->status == self::ONLINE;
    }
}
