<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api;

/**
 * Class Entity
 *
 * @package Telegram\Api
 *
 * Api entity interface
 */
class Entity extends \App_Abstract_Socialnet_Entity
{

    /**
     * Build multi-level array for api call`s, filter or upgrade properties
     *
     * @return array
     */
    public function toApiArray()
    {
        $entity = $this->toArray();
        foreach ($entity as $name => &$value)
        {
            if (is_null($value)) {

                unset($entity[$name]);
            } elseif ($value instanceof Entity) {

                $value = $value->toArray();
                foreach($value as $key => $item) {
                    if (is_null($item)) unset($value[$key]);
                }
            }
        }
        return $entity;
    }

    /**
     * Instantiates an exception to be thrown later.
     */
    public function thrownException($error)
    {
        throw new Exceptions\CoreSDKException($error);
    }
}
