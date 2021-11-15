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
 * Class Referral
 *
 * @package Facebook\Api
 * Text-only message
 */
class Referral extends BaseObject
{

    private $elements = null;
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'referral';
    }

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'source' => array( 'value' => null, 'type' => 'string'),
        'type'      => array( 'value' => null, 'type' => 'string'),
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {

        return array(
            'type' => $this->_properties['type'],
            'source' => $this->_properties['source']
        );
    }

}
