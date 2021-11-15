<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/MessageMediaElement.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class MessageElement
 *
 * @package Facebook\Api\Objects
 */
class MediaElement extends BaseObject
{
    /**
     * Type
     *
     * @var null|string
     */
    protected $type = null;

    /**
     * Image url
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * Attachment id
     *
     * @var null|string
     */
    protected $attachment_id = null;


    /**
     * Buttons
     *
     * @var array
     */
    protected $buttons = array();

    /**
     * Default Action
     *
     * @var array
     */
    protected $default_action = array();

    /**
     * MessageElement constructor.
     *
     * @param string $title
     * @param string $subtitle
     * @param string $image_url
     * @param array  $buttons
     */
    public function __construct($type, $url = '', $attachment_id = '', $buttons = array())
    {
        $this->type = $type;
        $this->url = $url;
        $this->attachment_id = $attachment_id;
        $this->buttons = $buttons;
    }

    /**
     * Get Element data
     *
     * @return array
     */
    public function getData()
    {
        $result = array(
            'type' => $this->type,
        );

        if (!empty($this->url)) {
            $result['url'] = $this->url;
        }

        if (!empty($this->attachment_id)) {
            $result['attachment_id'] = $this->attachment_id;
        }

        if (!empty($this->buttons)) {
            $result['buttons'] = array();

            foreach ($this->buttons as $btn) {
                $result['buttons'][] = $btn->getData();
            }
        }

        return $result;
    }
}
