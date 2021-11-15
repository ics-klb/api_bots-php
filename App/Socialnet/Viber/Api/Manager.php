<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Bot_Manager.php, v1.00 2017/05/26 14:07:00 Exp $

namespace App\Socialnet\Viber\Api;

/**
 * Class Manager
 *
 * @package Viber\Extended
 *
 * Bot event manager.
 */
class Manager extends \App_Abstract_Socialnet_Manager
{

    /**
     * While event checker match current event?
     *
     * @param  Event $event
     * @return boolean
     */
    public function isMatch($event)
    {

        if (is_callable($this->checker)) {
            return call_user_func($this->checker, $event);
        }
        return false;
    }

    /**
     * Process event with handler function
     *
     * @param  Event $event
     * @return mixed event handler result
     */
    public function runHandler($event)
    {

        if (is_callable($this->handler)) {
            return call_user_func($this->handler, $event);
        }
        return false;
    }
}
