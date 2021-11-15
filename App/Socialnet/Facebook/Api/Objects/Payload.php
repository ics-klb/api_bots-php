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

use App\Socialnet\Facebook\Api\Message\Type;

/**
 * Class Payload
 *
 * @package Facebook\Api
 * Text-only message
 */
class Payload extends BaseObject
{

    private $elements = null;
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::TEXT;
    }

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'template_type' => array( 'value' => null, 'type' => 'string'),
        'elements'      => array( 'value' => null, 'type' => 'object'),
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'elements'  => 'Elements',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {

        return array(
            'elements' => $this->getElements()
        );
    }

    public function getElements(){

        return '';
    }

}
