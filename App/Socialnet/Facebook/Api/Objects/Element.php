<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/MessageElement.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class MessageElement
 *
 * @package Facebook\Api\Objects
 */
class Element extends BaseObject
{

    /**
     * Url
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'title'          => array( 'value' => null, 'type' => 'string'),
        'subtitle'       => array( 'value' => null, 'type' => 'string'),
        'image_url'      => array( 'value' => null, 'type' => 'string'),
        'buttons'        => array( 'value' => null, 'type' => 'object'),
        'default_action' => array( 'value' => null, 'type' => 'object')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'buttons'        => 'Button',
            'default_action' => 'DefaultAction',
        );
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
            $result['buttons'] = array();

            foreach ($this->buttons as $btn) {
                $result['buttons'][] = $btn->getData();
            }
        }

        return $result;
    }
}
