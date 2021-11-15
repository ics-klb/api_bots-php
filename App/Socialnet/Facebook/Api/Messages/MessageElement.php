<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/MessageElement.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Messages;

/**
 * Class MessageElement
 *
 * @package Facebook\Api\Messages
 */
class MessageElement
{
    /**
     * Title
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Image url
     *
     * @var null|string
     */
    protected $image_url = null;

    /**
     * Subtitle
     *
     * @var null|string
     */
    protected $subtitle = null;

    /**
     * Url
     *
     * @var null|string
     */
    protected $url = null;

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
    public function __construct($title, $subtitle, $image_url = ''
                                , $buttons = array(), $url = '', $default_action = array())
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->url = $url;
        $this->image_url = $image_url;
        $this->buttons = $buttons;
        if (!empty($default_action)) {
            $this->default_action = $default_action;
        }
    }

    /**
     * Get Element data
     *
     * @return array
     */
    public function getData()
    {
        $result = array(
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'item_url' => $this->url,
            'image_url' => $this->image_url,
        );
        
        if (!empty($this->default_action)) {
            $result['default_action'] = $this->default_action;
        }

        if (!empty($this->buttons)) {
            $result['buttons'] = [];

            foreach ($this->buttons as $btn) {
                $result['buttons'][] = $btn->getData();
            }
        }

        return $result;
    }
}
