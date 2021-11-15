<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/QuickReplyButton.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class MessageButton
 *
 * @package Facebook\Api\Objects
 */
class QuickReplyButton extends BaseObject
{
    /**
     * Text quick reply
     */
    const TYPE_TEXT = "text";

    /**
     * Location quick reply
     */
    const TYPE_LOCATION = "location";
    
    /**
     * User phone number
     */
    const TYPE_USER_PHONE_NUMBER = "user_phone_number";
    
    /**
     * User email
     */
    const TYPE_USER_EMAIL = "user_email";

    /**
     * Button type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * Button title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Button payload
     *
     * @var null|string
     */
    protected $payload = null;

    /**
     * Image url of quick reply icon
     *
     * @var boolean
     */
    protected $image_url = false;

    /**
     * MessageButton constructor.
     *
     * @param string $type
     * @param string $title
     * @param string $url url or postback
     */
    public function __construct($type, $title = '', $payload = null, $image_url = null)
    {
        $this->type = $type;
        $this->title = $title;
        $this->payload = $payload;
        $this->image_url = $image_url;

    }

    /**
     * Get Button data
     *
     * @return array
     */
    public function getData()
    {
        $result = [
            'content_type' => $this->type
        ];

        switch($this->type)
        {
            case self::TYPE_LOCATION:
                $result['image_url'] = $this->image_url;
                break;

            case self::TYPE_TEXT:
                $result['payload'] = $this->payload;
                $result['title'] = $this->title;
                $result['image_url'] = $this->image_url;
                break;
                
            case self::TYPE_USER_PHONE_NUMBER:
                $result['payload'] = $this->payload;
                break;
                
            case self::TYPE_USER_EMAIL:
                $result['payload'] = $this->payload;
                break;
        }

        return $result;
    }
}
