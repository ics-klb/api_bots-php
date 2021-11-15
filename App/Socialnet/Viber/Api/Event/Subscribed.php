<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Event;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Subscribed
 *
 * @package Viber\Api\Event
 *
 * Triggers when user unsubscribe from the PA
 */
class Subscribed extends Api\Event
{

    /**
     * Get the value of Viber user
     *
     * @return Viber\Api\User
     */
    public function getUser()
    {
        return $this->user;
    }

}
