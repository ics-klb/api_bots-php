<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook\Api\Objects\Entry.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class Entry (develop)
 *
 * @package Facebook\Api\Objects
 */
class Entry extends BaseObject
{
    /**
     * Id
     *
     * @var null|string
     */
    protected $id = null;

    protected $time = null;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
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
     * Get Element data
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
