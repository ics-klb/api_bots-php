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
 * Class Conversation
 *
 * @package Viber\Api\Event
 *
 * Triggers when a user opens a conversation with the PA using the “message”
 * button (found on the PA’s info screen) or using a deep link.
 *
 * @see https://developers.viber.com/tools/deep-links/index.html
 */
class Conversation extends Api\Event
{
    /**
     * Context information
     *
     * @var string
     */
    protected $context;

    /**
     * Viber user
     *
     * @var Viber\Api\User
     */
    protected $user;

    /**
     * Conversation action
     *
     * @var string
     */
    protected $type;

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'content' => $this->getContext()
        ));
    }

    /**
     * Get the value of Context information
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Get the value of Viber user
     *
     * @return Viber\Api\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get conversation type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
