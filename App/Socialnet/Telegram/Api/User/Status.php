<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\User;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class Event
 *
 * @package Telegram\Api
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
     * Telegram user id
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

}