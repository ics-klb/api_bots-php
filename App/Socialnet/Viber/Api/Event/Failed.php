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
 * Class Failed
 *
 * @package Viber\Api\Event
 *
 * Triggers if a message has reached the client but failed any of
 * the client validations.
 */
class Failed extends Api\Event
{
    /**
     * Viber user id
     *
     * @var string
     */
    protected $user_id;

    /**
     * A string describing the failure
     *
     * @var string
     */
    protected $dsc;

    /**
     * Get the value of Viber user id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of A string describing the failure
     *
     * @return string
     */
    public function getDsc()
    {
        return $this->dsc;
    }
}
