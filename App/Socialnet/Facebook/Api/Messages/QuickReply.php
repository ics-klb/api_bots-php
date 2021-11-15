<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/QuickReply.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Messages;

/**
 * Class QuickReply
 *
 * @package Facebook\Api\Messages
 */
class QuickReply extends Message
{
    // /**
    //  * @var array
    //  */
    // protected $quick_replies = array();

    /**
     * Message constructor.
     *
     * @param $recipient
     * @param $text - string
     * @param array $quick_replies - array of array("content_type","title","payload"),..,..
     * @param string $tag - SHIPPING_UPDATE, RESERVATION_UPDATE, ISSUE_RESOLUTION
     */
    public function __construct($recipient, $text, $quick_replies = array()
                            , $tag = null, $notification_type = parent::NOTIFY_REGULAR, $messaging_type = parent::TYPE_RESPONSE)
    {
        $this->recipient = $recipient;
        $this->text = $text;
        $this->quick_replies = $quick_replies;
        $this->tag = $tag;
        $this->notification_type = $notification_type;
        $this->messaging_type = $messaging_type;
    }

    public function getData() {
        $result = array(
            'recipient' =>  array(
                'id' => $this->recipient
            ),
            'message' => array(
                'text' => $this->text
            ),
            'tag'=> $this->tag,
            'notification_type'=> $this->notification_type,
            'messaging_type' => $this->messaging_type
        );

        foreach ($this->quick_replies as $qr) {
            if($qr instanceof QuickReplyButton){
                $result['message']['quick_replies'][] = $qr->getData();
            } else {
                $result['message']['quick_replies'][] = $qr;
            }
        }

        return $result;
    }
}
