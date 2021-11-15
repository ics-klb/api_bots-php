<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Integration\Event.php, v1.03 2020/09/01 12:23:00 Exp $

    __autoload('App_Abstract_Event');
/**
 * Class Event
 *
 * @package Abstract\Socialnet
 */
class App_Abstract_Socialnet_Event
                extends \App_Abstract_Event
{

    /**
     * Unique ID of the message
     *
     * @var string
     */
    protected $message_token;


    /**
     * Alias for getEvent
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->getEvent();
    }

    /**
     * Get the value of Time of the event that triggered the callback
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the value of Unique ID of the message
     *
     * @return string
     */
    public function getMessageToken()
    {
        return $this->message_token;
    }

}