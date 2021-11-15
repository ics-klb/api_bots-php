<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook\Api\Objects\Standby.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class Standby (develop)
 *
 * @package Facebook\Api\Objects
 */
class Standby extends BaseObject
{
    /**
     * Id
     *
     * @var null|string
     */
    protected $id = null;

    protected $time = null;

    protected $standby = null;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'message'          => array( 'value' => null, 'type' => 'object')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'message'        => 'Message'
        );
    }

    /**
     * Get Standby data
     *
     * @return array
     */
    public function getData()
    {
        $result = array(
        );

        return $result;
    }
}
