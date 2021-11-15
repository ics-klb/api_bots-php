<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/SenderAction.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Messages;

/**
 * Class SenderAction
 *
 * @package Facebook\Api\Messages
 */
class SenderAction
{
    /* sender_action possible values */
    
    const ACTION_MARK_SEEN = "mark_seen";
    
    const ACTION_TYPING_ON = "typing_on";
    
    const ACTION_TYPING_OFF = "typing_off";

    /**
     * @var null|string
     */
    protected $recipient = null;

    /**
     * @var null|string
     */
    protected $action = null;

    /**
     * Message constructor.
     *
     * @param string $recipient
     * @param string $action
     */
    public function __construct($recipient, $action)
    {
        $this->recipient = $recipient;
        $this->action = $action;
    }

    /**
     * Get message data
     *
     * @return array
     */
    public function getData()
    {
        return array(
            'recipient' =>  array(
                'id' => $this->recipient
            ),
            'sender_action' => $this->action
        );
    }
}
