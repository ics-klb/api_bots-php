<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Message;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class Photo
 *
 * @package Telegram\Api
 * Text-only message
 */
class Photo extends Api\Message
{
    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'file_id'   => array( 'value' => null, 'type' => 'string'),
        'file_size' => array( 'value' => null, 'type' => 'int'),
        'width'     => array( 'value' => null, 'type' => 'int'),
        'height'    => array( 'value' => null, 'type' => 'int')
    );

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::PHOTO;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(

            'hashid' => \Core_Api::getUniqueHash()
        ));
    }

}
