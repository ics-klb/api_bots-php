<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Objects, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class Postback
 *
 * @package Facebook\Api
 * Text-only message
 */
class Postback extends BaseObject
{

    private $elements = null;
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'postback';
    }

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'title' => array( 'value' => null, 'type' => 'string', 'handler' => 'setTitle')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'payload'   => 'Payload',
            'referral'  => 'Referral'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {

        return array(
            'title' => $this->getTitle()
        );
    }

    public function getTitle()
    {

        return $this->_properties['title'];
    }

    public function setTitle($value)
    {
            $this->_properties['title'] = $value;
        return $this;
    }

}
